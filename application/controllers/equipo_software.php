<?php

class Equipo_software extends CI_Controller {

    public function index() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        $permisos_us = $this->session->userdata('puedo');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        //si el usuario no tiene ningún permiso asignado
        if ($permisos_us == '') {
            redirect('acceso/acceso_home/inicio');
        }
        $this->load->library('utl_apecc');
        //obtener el arreglo con los permisos para el usuario del sistema
        $ptemp = $this->utl_apecc->getPermisos($this->session->userdata('puedo'));
        //si el usuario tiene permisos asignados entonces obtengo la clave de permisos para el controlador usuarios
        //que servirá como indice del arreglo de permisos y asi obtenerlos solo para el controlador actual(usuarios)
        $prm_array = $this->config->item('prm_permisos');
        if ($ptemp != FALSE) {
            $rec = $this->config->item('clvp_equipos_software');
            //si en el arreglo de permisos esta la clave de usuarios
            if (array_key_exists($rec, $ptemp)) {
                $permisos = $this->utl_apecc->getCSS_prm($ptemp[$rec], $prm_array);
            } else {
                redirect('acceso/acceso_home/inicio');
            }
        } else {
            $permisos = $this->utl_apecc->getCSS_prm(false, $prm_array); //si es falso no se encontraron permisos por lo tanto se ponen los atributos para solo lectura
        }
        $contenido['permisos'] = $permisos;
        $this->load->model('reservaciones_temporales_model');
        $this->load->model('salas_model');
        setlocale(LC_TIME, 'Spanish');
        $contenido['titulo_pag'] = "ASIGNACI&Oacute;N DE SOFTWARE";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/jsequipos.js"></script>' . PHP_EOL;
        $contenido['salas'] = $this->salas_model->datos_salas();
        $contenido['equipos_salas'] = $this->reservaciones_temporales_model->equipos_salas();
        $data['contenido'] = $this->load->view('equipo_software_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function getSoftware($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getSoftwareEquipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $jsondata[$i]['sw'] = $row->nombre;
            $jsondata[$i]['de'] = $row->descripcion;
            $jsondata[$i]['so'] = $row->so;
            $jsondata[$i]['idso'] = $row->idso;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSosEquipo($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getsosequipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSwEquipo($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getswequipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSos() {
        $this->load->model('equipo_software_model');
        $so_equipo = $this->equipo_software_model->get2Sos();
        $i = 0;
        $jsondata = null;
        foreach ($so_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->idSistemaOperativo;
            $jsondata[$i]['so'] = $row->sistemaOperativo;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function agregaSos() {
        $sos = $this->input->post('so');
        $numserie = $this->input->post('num_serie');
        $this->load->model('equipo_software_model');
        if (count($sos) >= 0 && $sos[0] != '') {
            $sepudo = $this->equipo_software_model->agrega_sos($numserie, $sos);
            if ($sepudo)
                echo "ok"; else
                echo "Error al asignar Sistemas Operativos.";
        }
    }

    public function agregaSw() {
        $sw = $this->input->post('sw');
        $numserie = $this->input->post('num_serie');
        $this->load->model('equipo_software_model');
        if (count($sw) >= 0 && $sw[0] != '') {
            $sepudo = $this->equipo_software_model->agrega_sw($numserie, $sw);
            if ($sepudo)
                echo "ok"; else
                echo "Error al asignar Software.";
        }
    }

    function grupos_so() {
        $so = $this->input->post('so');
        $this->load->model('equipo_software_model');
        $result = $this->equipo_software_model->getGruposSo($so);
        $s = '';
        if ($result->num_rows() != 0) {
            foreach ($result->result() as $r) {
                $s .= "<option value='" . $r->idGrupo . "'> " . $r->nombre . "</option>";
            }
            echo $s;
        } else {
            echo '';
        }
    }

    function getSwGru($gru) {
        $this->load->model('equipo_software_model');
        $ids = $this->equipo_software_model->getSWGrupos($gru);
        $sws=array();
        if (($ids !== false) && $ids->num_rows() > 0) {
            foreach ($ids->result() as $v) {
                array_push($sws,$v->idSoftware);
            }
            echo json_encode($sws);
        }else {
            echo false;
        }
    }

}

?>
