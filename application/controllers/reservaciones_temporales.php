<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservaciones_temporales extends CI_Controller {

    public function index() {
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
        $clave_reservacion = $numserie. substr($usuario, 0, 4) . date("ymdHis");

        $alrato = $ahorita->add(new DateInterval('PT' . $horas . 'H')); // a la hora actual le sumo las horas que se especificaron en la reservacion
        $horafin = $alrato->format("H").':00:00';
        /*Si se marco la opcion no especificar hora fin la reservacion sera abierta para esto el estado de la reservacion
         *  se cambia a I, el importe la hora y hora de inicio se establecen en 0*/
        if (isset($reserv_no_especifica) && $reserv_no_especifica == "reservacion_abierta") {
            $edo = 'I';
            $horas = 0;
            $horafin = 0;
            $importe=0;
        }
        
        $sepudo = $this->reservaciones_temporales_model->resevacion($clave_reservacion, $hoy, $horainicio, $horafin, $usuario, $numserie, $importe, $edo, $horas, $edo_equipo,$diasemana,$sala);

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
        $sepudo = $this->reservaciones_temporales_model->termina_resevacion($idreserv, $numSerie);
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

    function liberaSala() {
        $sala = $this->input->post('sala');

        echo "ok";
    }
}
?>
