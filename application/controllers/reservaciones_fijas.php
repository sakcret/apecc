<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservaciones_fijas extends CI_Controller {

    public function index() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        $permisos_us = $this->session->userdata('puedo');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        //si el usuario no tiene ningún permiso asignado
        if($permisos_us==''){
             redirect('acceso/acceso_home/inicio');
        }
        $this->load->library('utl_apecc');
        //obtener el arreglo con los permisos para el usuario del sistema
        $ptemp = $this->utl_apecc->getPermisos($this->session->userdata('puedo'));
        //si el usuario tiene permisos asignados entonces obtengo la clave de permisos para el controlador usuarios
        //que servirá como indice del arreglo de permisos y asi obtenerlos solo para el controlador actual(usuarios)
        $prm_array = $this->config->item('prm_permisos');
        if ($ptemp != FALSE) {
            $rec = $this->config->item('clvp_reservaciones_fijas');
            //si en el arreglo de permisos esta la clave de usuarios
            if (array_key_exists($rec, $ptemp)) {
                $permisos = $this->utl_apecc->getCSS_prm($ptemp[$rec], $prm_array);
            }else{
                redirect('acceso/acceso_home/inicio');
            }
        } else {
            $permisos = $this->utl_apecc->getCSS_prm(false, $prm_array);//si es falso no se encontraron permisos por lo tanto se ponen los atributos para solo lectura
        }
        $contenido['permisos'] = $permisos;
        $this->load->model('reservaciones_fijas_model');
        $this->load->model('salas_model');
        $this->load->model('actividades_model');
        $contenido['titulo_pag'] = "RESERVACIONES FIJAS";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/redips-drag.js"></script>' . PHP_EOL .
                '<link rel="stylesheet" href="css/estilo_reservaciones_fijas.css" type="text/css" media="screen"/>' . PHP_EOL;
        $contenido['actividades_color'] = $this->actividades_model->actividades_color();
        $contenido['actividades'] = $this->reservaciones_fijas_model->actividades();
        $val=$this->input->Post('tindex');
        if(isset($val)){
        $contenido['val']=$val;
        
        }else $contenido['val']=0;
        $salas_t = array();
        $s = $contenido['salas'] = $this->salas_model->datos_salas();
        $ra = $s->result_array();
        for ($i = 0; $i < count($ra); $i++) {
            $this->load->model('reservaciones_fijas_model');
            $salas_t[$ra[$i]["idSala"]] = $this->getdatoseehorarios($ra[$i]["idSala"]);
        }
        $contenido['datos_salas'] = $salas_t;
        $data['contenido'] = $this->load->view('reservaciones_fijas_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    //fincion que obtiene las materias que estan en una hora determinada
    function horario($hora, $id_sala) {
        $fila = 0;
        $fila_html = '';
        $temp = array();
        $fila = $this->getfilahora($hora);
        $this->load->model('reservaciones_fijas_model');
        $rs = $this->reservaciones_fijas_model->datos_reserv($fila, $id_sala);
        $fila_html.= '<tr>';
        $fila_html.= '<td class="mark blank ui-state-default">' . $hora . '</td>';
        for ($i = 0; $i < count($rs); $i++) {
            $temp[$rs[$i]['dia']] = $rs[$i];
        }
        for ($col = 1; $col <= 6; $col++) {
            $fila_html.= '<td class=" wid_act ui-state-focus">';
            if (array_key_exists($col, $temp) && (count($temp) > 0)) {
                $nombre_act = $temp[$col]['nombreActividad'];
                $idReservacionFija = $temp[$col]['idReservacionFija'];
                $sala = $temp[$col]['sala'];
                $bloque = $temp[$col]['bloque'];
                $seccion = $temp[$col]['seccion'];
                $catedratico = $temp[$col]['nombreacademico'];
                $act_idAcademico = $temp[$col]['idActividadAcademico'];
                $act_id = $temp[$col]['idActividad'];
                $fila_html.= "<div id=\"" . $act_idAcademico . '%' . $sala . '%' . 'b' . $idReservacionFija . "\" class=\"drag color_$act_id glass\"><div class=\"label1\" style=\"margin-bottom:0px !important;\"> $nombre_act &nbsp;&nbsp;B$bloque/S$seccion</div><div style=\"margin-top:0px !important;\" class=\"label2\">$catedratico</div></div>";
            }
            $fila_html.= '</td>';
        }
        $fila_html.= "</tr>\n";
        return $fila_html;
    }

    function eliminarhorario() {
        $idsala = $this->input->Post('id_sala');
        $p = @$_REQUEST['p'];
        list($act_id, $row, $col) = explode('_', $p);
        list($act_id, $sala) = explode('%', $act_id);
        $this->load->model('reservaciones_fijas_model');
        if (is_numeric($row) && is_numeric($col) && is_numeric((int) $idsala)) {
             $sepudo= $this->reservaciones_fijas_model->eliminahorario((int) $act_id, $row, $col, (int) $idsala);
        }
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar la Catedratico.";
    }

    function guardarhorario() {
        $idsala = $this->input->Post('id_sala');
        $p = @$_REQUEST['p'];
        list($sub_id, $tbl1, $row1, $col1, $tbl0, $row0, $col0) = explode('_', $p);
        list($sub_id) = explode('%', $sub_id);
        $this->load->model('reservaciones_fijas_model');
        if ($tbl0 == 1) {
            $sepudo=$this->reservaciones_fijas_model->insertarhorario((int) $sub_id, $row1, $col1, ((int) $idsala));
        }
        // si el elemento es movido a una nueva posicion de la tabla
        else {
            $sepudo=$this->reservaciones_fijas_model->actualizarhorario($row1, $col1, (int) $sub_id, $row0, $col0,$idsala);
        }
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar la Catedratico.";
    }

    function getdatoseehorarios($id_sala) {
        $filas = array();
        $filas[0] = $this->horario('07:00', $id_sala);
        $filas[1] = $this->horario('08:00', $id_sala);
        $filas[2] = $this->horario('09:00', $id_sala);
        $filas[3] = $this->horario('10:00', $id_sala);
        $filas[4] = $this->horario('11:00', $id_sala);
        $filas[5] = $this->horario('12:00', $id_sala);
        $filas[6] = $this->horario('13:00', $id_sala);
        $filas[7] = $this->horario('14:00', $id_sala);
        $filas[8] = $this->horario('15:00', $id_sala);
        $filas[9] = $this->horario('16:00', $id_sala);
        $filas[10] = $this->horario('17:00', $id_sala);
        $filas[11] = $this->horario('18:00', $id_sala);
        $filas[12] = $this->horario('19:00', $id_sala);
        $filas[13] = $this->horario('20:00', $id_sala);
        $filas[14] = $this->horario('21:00', $id_sala);
        return $filas;
    }

    function getfilahora($hora) {
        $h = 0;
        switch ($hora) {
            case '07:00':$h = 1;
                break;
            case '08:00':$h = 2;
                break;
            case '09:00':$h = 3;
                break;
            case '10:00':$h = 4;
                break;
            case '11:00':$h = 5;
                break;
            case '12:00':$h = 6;
                break;
            case '13:00':$h = 7;
                break;
            case '14:00':$h = 8;
                break;
            case '15:00':$h = 9;
                break;
            case '16:00':$h = 10;
                break;
            case '17:00':$h = 11;
                break;
            case '18:00':$h = 12;
                break;
            case '19:00':$h = 13;
                break;
            default:break;
        }
        return $h;
    }

}
