<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actualiza_bd extends CI_Controller {

    public function index() {
        $this->load->model("actualiza_estado_db_model");
        $this->load->view('v');
    }

    private function reservacionesFijas($dia, $hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->actualiza_estado_db_model->datos_reservaciones_fijas($dia, $hora);
        return $datos_rf;
    }

    function getEquiposSalas($idsala) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->actualiza_estado_db_model->equipos_salas($idsala);
        return $datos_rf;
    }

    function cambiaComentarioSala($idsala, $comentario) {
        $this->load->model("salas_model");
        $datos_rf = $this->salas_model->cambia_comentario_sala($idsala, $comentario);
        return $datos_rf;
    }

    function reservaSalaRF($dia, $hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->reservacionesFijas($dia, $hora);
        $countrf = $datos_rf->num_rows();
        if ($countrf > 0) {
            for ($x = 0; $x < $countrf; $x++) {
                $drf = $datos_rf->row_array($x);
                $usuario = $drf['encargardo'];
                //dar formato al mensaje de reservacion de sala
                if ($drf['tipo_actividad'] == 0)
                    $act = ' En clase de ' . $drf['nombre_actividad'] . ' B' . $drf['bloque'] . '/S' . $drf['seccion'];
                else
                    $act = ' En curso de ' . $drf['nombre_actividad'] . ' B' . $drf['bloque'] . '/S' . $drf['seccion'];
                //obtener los equipos para una sala determinada
                $datos_eq_sala = $this->getEquiposSalas($drf['sala']);
                //cambiar el comentario de la sala
                $this->cambiaComentarioSala($drf['sala'], $act);
                $counteqsa = $datos_eq_sala->num_rows();
                if ($counteqsa > 0) {
                    for ($y = 0; $y < $counteqsa; $y++) {
                        $des = $datos_eq_sala->row_array($y);
                        $numserie = $des['numserie'];
                        $horas = 1;
                        $importe = 0;
                        $edo = 'A'; //establecemos el estado de la reservacion a activa
                        $edo_equipo = 'C'; //establecemos el estado del equipo en actividad(clase o curso
                        $salaaux = $drf['sala'];
                        $hoy = date("Y-m-d");
                        $diasemana = date('N'); //1=lunes 2=martes ... 7=domingo
                        $ahorita = new DateTime(date("H:i:s"));
                        $horainicio = $ahorita->format("H:i:s");
                        $clave_reservacion = $numserie . substr($usuario, 0, 4) . date("ymdHis");
                        $alrato = $ahorita->add(new DateInterval('PT' . $horas . 'H')); // a la hora actual le sumo las horas que se especificaron en la reservacion
                        $horafin = $alrato->format("H") . ':00:00'; //redondear la reservacion
                        $this->actualiza_estado_db_model->resevacion($clave_reservacion, $hoy, $horainicio, $horafin, $usuario, $numserie, $importe, $edo, $horas, $edo_equipo, $diasemana, $salaaux);
                    }
                }
            }
        }
    }

    function liberaSala($hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_ra = $this->actualiza_estado_db_model->getReservacionesActivas();
        $countrf = $datos_ra->num_rows();
       if ($countrf > 0) {
            for ($x = 0; $x < $countrf; $x++) {
                $dra = $datos_ra->row_array($x);
                //si la hora de fin de la reservacion es igual a la hora actual $hora entonces libero
                if ($dra['HoraFin'] == $this->gethoratext($hora).':00') {
                    $this->liberaReservActiva($dra['idReservacionesMomentaneas'], $dra['NumeroSerie']);
                    echo 'libero';
                }
            }
        }
    }

    function liberaSalaRF($dia, $hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->reservacionesFijas($dia, $hora);

        $countrf = $datos_rf->num_rows();
        if ($countrf > 0) {
            for ($x = 0; $x < $countrf; $x++) {
                $drf = $datos_rf->row_array($x);
                $this->actualiza_estado_db_model->terminaRF($dia, $drf['sala']);
                $this->cambiaComentarioSala($drf['sala'], "");
                //obtener los equipos para una sala determinada
                $datos_eq_sala = $this->getEquiposSalas($drf['sala']);
                $counteqsa = $datos_eq_sala->num_rows();
                if ($counteqsa > 0) {
                    for ($y = 0; $y < $counteqsa; $y++) {
                        $des = $datos_eq_sala->row_array($y);
                        $this->actualiza_estado_db_model->libera_equipo($des['numserie']);
                    }
                }
            }
        }
    }

   function actualiza() {
        $this->liberaSala(1);
        echo 'listo....';
    }

    function actualizar_bd() {
        $dia = $_POST['dia']; //$this->input->Post();
        $hora = $_POST['hora']; //$this->input->Post('hora');
        if ($dia == 0 && $hora == 0) {
            $this->liberaSalaRF($dia, $hora);
        }
        $this->reservaSalaRF($dia, $hora);
        $this->liberaSalaRF($dia, $hora - 1);
        echo 'ok';
    }

    function actualiza_db() {
        $diadehoy = date('N'); //1=lunes 2=martes ... 7=domingo
        $hoy = date('d-m-Y'); //ejemplo 1989-05-05
        $ahorita = date("H:i"); //ejemplo 07:00
        $inicio_periodo = $this->config->item('fecha_periodo_inicio');
        $fin_periodo = $this->config->item('fecha_periodo_fin');
        while (true) {
            $horarf = $this->gethora($ahorita);
            switch ($diadehoy) {
                case '1':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(1, $horarf, $diadehoy);
                        $this->reservaSalaRF(1, $horarf);
                    }
                    break;
                case '2':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(2, $horarf, $diadehoy);
                        $this->reservaSalaRF(2, $horarf);
                    }
                    break;
                case '3':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(3, $horarf, $diadehoy);
                        $this->reservaSalaRF(3, $horarf);
                    }
                    break;
                case '4':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(4, $horarf, $diadehoy);
                        $this->reservaSalaRF(4, $horarf);
                    }
                    break;
                case '5':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(5, $horarf, $diadehoy);
                        $this->reservaSalaRF(5, $horarf);
                    }
                    break;
                case '6':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(6, $horarf, $diadehoy);
                        $this->reservaSalaRF(6, $horarf);
                    }
                    break;
                case '7':
                    if ($horarf != 0) {
                        $this->liberaSalaRF(1, $horarf, $diadehoy);
                        $this->reservaSalaRF(7, $horarf);
                    }
                    break;
                default:break;
            }
        }
    }

    function gethora($hora) {
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
            case '20:00':$h = 14;
                break;
            case '21:00':$h = 15;
                break;
            case '22:00':$h = 16;
                break;
            default:break;
        }
        return $h;
    }

    function gethoratext($hora) {
        $h = 0;
        switch ($hora) {
            case 1:$h = '07:00';
                break;
            case 2:$h = '08:00';
                break;
            case 3:$h = '09:00';
                break;
            case 4:$h = '10:00';
                break;
            case 5:$h = '11:00';
                break;
            case 6:$h = '12:00';
                break;
            case 7:$h = '13:00';
                break;
            case 8:$h = '14:00';
                break;
            case 9:$h = '15:00';
                break;
            case 10:$h = '16:00';
                break;
            case 11:$h = '17:00';
                break;
            case 12:$h = '18:00';
                break;
            case 13:$h = '19:00';
                break;
            case 14:$h = '20:00';
                break;
            case 15:$h = '21:00';
                break;
            case 16:$h = '22:00';
                break;
            default:break;
        }
        return $h;
    }

}

