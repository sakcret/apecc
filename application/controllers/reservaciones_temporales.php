<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservaciones_temporales extends CI_Controller {

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
            $rec = $this->config->item('clvp_reservaciones_temporaneas');
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
        //setlocale(LC_TIME, 'es_MX');
        setlocale(LC_TIME, 'Spanish');
        $contenido['titulo_pag'] = "RESERVACIONES MOMENTANEAS";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/jsequipos.js"></script>' . PHP_EOL;
        $contenido['salas'] = $this->salas_model->datos_salas();
        $contenido['equipos_salas'] = $this->reservaciones_temporales_model->equipos_salas();
        $contenido['reserv_temp'] = $this->reservaciones_temporales_model->reserv_temp();
        $data['contenido'] = $this->load->view('reservaciones_temporales_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function reservacion_momentanea() {
        $numserie = $this->input->post('numserie');
        $usuario = $this->input->post('usuario');
        $sala = $this->input->post('id_sala');
        $horas = $this->input->post('horas');
        $importe = $this->input->post('importe');
        $reserv_no_especifica = $this->input->post('hora_fin_ne');
        $edo = 'A'; //establecemos el estado de la reservacion a activa
        $edo_equipo = 'O'; //establecemos el estado del equipo a ocupado
        $this->load->model('reservaciones_temporales_model');
        $hoy = date("Y-m-d");
        $diasemana = date("N");
        $ahorita = new DateTime(date("H:i:s"));
        $horainicio = $ahorita->format("H:i:s");
        /*         * crear la clave de la reservacion ++esta consta de los primeros 6 caracteres del numero de serie del equipo
         * seguido de los primero 4 caracteres del usuario, seguido de la fecha de la reservacion con el formato ymdHis
         */
        $clave_reservacion = $numserie . substr($usuario, 0, 4) . date("ymdHis");

        $alrato = $ahorita->add(new DateInterval('PT' . $horas . 'H')); // a la hora actual le sumo las horas que se especificaron en la reservacion
        $horafin = $alrato->format("H") . ':00:00';
        /* Si se marco la opcion no especificar hora fin la reservacion sera abierta para esto el estado de la reservacion
         *  se cambia a I, el importe la hora y hora de inicio se establecen en 0 */
        if (isset($reserv_no_especifica) && $reserv_no_especifica == "reservacion_abierta") {
            $edo = 'I';
            $horas = 0;
            $horafin = 0;
            $importe = 0;
        }

        $sepudo = $this->reservaciones_temporales_model->resevacion($clave_reservacion, $hoy, $horainicio, $horafin, $usuario, $numserie, $importe, $edo, $horas, $edo_equipo, $diasemana, $sala);

        $jsondata['idreser'] = $clave_reservacion;
        $jsondata['horai'] = $horainicio;
        $jsondata['horaf'] = $horafin;
        $jsondata['usuario'] = $usuario;
        $jsondata['estado_reserv'] = $edo;
        $jsondata['importe'] = $importe;
        $jsondata['horas'] = $horas;
        if ($sepudo) {
            echo json_encode($jsondata);
        } else {
            echo 'error';
        }
    }

    public function termina_actualiza_reservacion() {
        $idreserv = $this->input->post('idereserv');
        $numSerie = $this->input->post('equipo');
        $this->load->model('reservaciones_temporales_model');
        if($numSerie!=''){
        $sepudo = $this->reservaciones_temporales_model->termina_resevacion($idreserv, $numSerie);
        
        }
        if ($sepudo) {
            echo 'ok';
        } else {
            echo 'Error al terminar la reservaci&oacute;n Momentanea.';
        }
    }

    //funcion que devuelve los usuarios en forma de <option></option> para el combo de usuarios filtrados
    //por el tipo de usuario seleccionado ademas de seleccionar solo aquellos donde el campo actualiza=1
    function usuarios() {
        $this->load->model('reservaciones_temporales_model');
        $tipo_u = $this->input->post('tipo_u');
        if (!isset($tipo_u)) {
            $tipo_u = '0';
        }
        $users = $this->reservaciones_temporales_model->getusuarios($tipo_u);
        $u = '';
        foreach ($users as $r) {
            $u .= "<option value='" . $r['login'] . "'> " . $r['nombre'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

    function tipos_usuarios() {
        $this->load->model('reservaciones_temporales_model');
        $datos = $this->reservaciones_temporales_model->gettiposusuarios();
        $u = '';
        foreach ($datos as $r) {
            $u .= "<option value='" . $r['idtipo'] . "'> " . $r['descripcion'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

    function valida_existencia_rm($login) {
        $this->load->model('reservaciones_temporales_model');
        $result = $this->reservaciones_temporales_model->valid_exist_rm($login);
        //echo $this->db->last_query();
        if ($result->num_rows() == 0) {
            echo json_encode('puede');
        } else {
            $d = $result->row();
            $jsondata['id'] = $d->idReservacionesMomentaneas;
            $jsondata['eq'] = $d->NumeroSerie;
            $jsondata['hi'] = $d->HoraInicio;
            $jsondata['hf'] = $d->HoraFin;
            $jsondata['im'] = $d->Importe;
            $jsondata['hr'] = $d->Horas;
            echo json_encode($jsondata);
        }
    }

    function reubicarUsuario() {
        $idreserv = $this->input->post('id');
        $equipo = $this->input->post('eq');
        $equipoant = $this->input->post('eqant');
        $this->load->model('reservaciones_temporales_model');
        $sepudo = $this->reservaciones_temporales_model->reubicaUsuario($idreserv,$equipo,$equipoant);
        if ($sepudo) {
            echo 'ok';
        } else {
            echo 'Error al reubicar al usuario.';
        }
    }

}

?>
