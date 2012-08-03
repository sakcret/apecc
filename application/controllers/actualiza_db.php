<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actualiza_db extends CI_Controller {

    public function index() {
        $this->load->view('actualiza_db_view');
    }

    private function reservacionesFijas($dia, $hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->actualiza_estado_db_model->datos_reservaciones_fijas($dia, $hora);
        return $datos_rf;
    }

    private function getEquiposSalas($idsala) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->actualiza_estado_db_model->equipos_salas($idsala);
        return $datos_rf;
    }

    private function cambiaComentarioSala($idsala, $comentario) {
        $this->load->model("salas_model");
        $datos_rf = $this->salas_model->cambia_comentario_sala($idsala, $comentario);
        return $datos_rf;
    }

    private function reservaSalaRF($dia, $hora) {
        $start = new DateTime($this->config->item('fecha_periodo_inicio'));
        $end = new DateTime($this->config->item('fecha_periodo_fin'));
        $hoy = new DateTime(date('Y-m-d'));
        $act = '';
        $nombre_act = '';
        $tipo_act = 0;
        //si la fecha esta dentro del periodo entonces reservo
        if ($this->validaFechaPeriodo($start, $end, $hoy)) {
            $this->load->model("actualiza_estado_db_model");
            $datos_rf = $this->reservacionesFijas($dia, $hora);
            $countrf = $datos_rf->num_rows();
            if ($countrf > 0) {
                //para cada una de las reservaciones hacer...
                for ($x = 0; $x < $countrf; $x++) {
                    $drf = $datos_rf->row_array($x);
                    $f_ini = new DateTime($drf['fecha_inicio']);
                    $f_fin = new DateTime($drf['fecha_fin']);
                    //si hoy esta entre fecha de inicio y fin de la actividad
                    if ($this->validaFechaPeriodo($f_ini, $f_fin, $hoy)) {
                        $usuario = $drf['encargardo'];
                        //dar formato al mensaje de reservacion de sala
                        if ($drf['tipo_actividad'] == 0) {
                            $tipo_act = 0;
                            $nombre_act=$drf['nombre_actividad'];
                            $act = ' En clase de ' . $nombre_act . ' B' . $drf['bloque'] . '/S' . $drf['seccion'];
                        }else{
                            $nombre_act=$drf['nombre_actividad'];
                            $act = ' En curso de ' . $nombre_act . ' B' . $drf['bloque'] . '/S' . $drf['seccion'];
                            $tipo_act=1;
                            }
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
                                $hoy_str = date("Y-m-d");
                                $diasemana = date('N'); //1=lunes 2=martes ... 7=domingo
                                $ahorita = new DateTime(date("H:i:s"));
                                $horainicio = $ahorita->format("H:i:s");
                                $clave_reservacion = $numserie . substr($usuario, 0, 5) . date("ymdHis");
                                $alrato = $ahorita->add(new DateInterval('PT' . $horas . 'H')); // a la hora actual le sumo las horas que se especificaron en la reservacion
                                $horafin = $alrato->format("H") . ':00:00';
                                $this->actualiza_estado_db_model->resevacion($clave_reservacion, $hoy_str, $horainicio, $horafin, $usuario, $numserie, $importe, $edo, $horas, $edo_equipo, $diasemana, $salaaux, $tipo_act,$nombre_act );
                            }
                        }
                    }
                }//fin for
            }//fin para todas las reservaciones
        }//fin si esta dentro del periodo
    }

    function reservaSala($hora) {
        $hoy = new DateTime(date('Y-m-d'));
        $this->load->model("actualiza_estado_db_model");
        $datos_rs = $this->actualiza_estado_db_model->reservacionesSalas($hora, true);
        $countrs = $datos_rs->num_rows();
        $act = '';
        if ($countrs > 0) {
            //para cada una de las reservaciones hacer...
            for ($x = 0; $x < $countrs; $x++) {
                //echo 'reservacion-'.$x.'<--';
                $drs = $datos_rs->row_array($x);
                $f_ini = new DateTime($drs['FechaInicio']);
                $f_fin = new DateTime($drs['FechaFin']);
                //si hoy esta entre fecha de inicio y fin de la actividad
                if ($this->validaFechaPeriodo($f_ini, $f_fin, $hoy)) {
                    //echo 'si esta en rango<br>';
                    $usuario = $drs['encargado'];
                    $nombre_act=$drs['NombreActividad'];
                    $act = ' En reservación de sala con la actividad: ' . $nombre_act;
                    $tipoActAux = 2;
                    //obtener los equipos para una sala determinada
                    $datos_eq_sala = $this->getEquiposSalas($drs['idSala']);
                    //cambiar el comentario de la sala
                    $this->cambiaComentarioSala($drs['idSala'], $act);
                    $counteqsa = $datos_eq_sala->num_rows();
                    echo 'en--' . $counteqsa;
                    if ($counteqsa > 0) {
                        //para cada uno de los equipos de la sala
                        for ($y = 0; $y < $counteqsa; $y++) {
                            $des = $datos_eq_sala->row_array($y);
                            $numserie = $des['numserie'];
                            //echo 'en--'.$numserie;
                            $horas = 1;
                            $importe = 0;
                            $edo = 'A'; //establecemos el estado de la reservacion a activa
                            $edo_equipo = 'C'; //establecemos el estado del equipo en actividad(clase o curso)
                            $salaaux = $drs['idSala'];
                            $hoy_str = date("Y-m-d");
                            $diasemana = date('N'); //1=lunes 2=martes ... 7=domingo
                            $ahorita = new DateTime(date("H:i:s"));
                            $horainicio = $ahorita->format("H:i:s");
                            $clave_reservacion = $numserie . substr($usuario, 0, 5) . date("ymdHis");
                            $alrato = $ahorita->add(new DateInterval('PT' . $horas . 'H')); // a la hora actual le sumo las horas que se especificaron en la reservacion
                            $horafin = $alrato->format("H") . ':00:00';
                            $this->actualiza_estado_db_model->resevacion($clave_reservacion, $hoy_str, $horainicio, $horafin, $usuario, $numserie, $importe, $edo, $horas, $edo_equipo, $diasemana, $salaaux, $tipoActAux, $nombre_act);
                        }
                    }
                }
            }//fin for
        }//fin para todas las reservaciones
    }

    function liberaSalaRS($hora) {
        $this->load->model("actualiza_estado_db_model");
        $datos_rs = $this->actualiza_estado_db_model->reservacionesSalas($hora, false);
        $countrf = $datos_rs->num_rows();
        if ($countrf > 0) {
            for ($x = 0; $x < $countrf; $x++) {
                $drf = $datos_rs->row_array($x);
                $this->actualiza_estado_db_model->terminaRS($drf['idSala']);
                $this->cambiaComentarioSala($drf['idSala'], "");
                //obtener los equipos para una sala determinada
                $datos_eq_sala = $this->getEquiposSalas($drf['idSala']);
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

    /**
     * funcion que libera las reservaciones fijas
     */
    function liberaSalaRF($dia, $hora) {
        $hora_ant=((int)$hora)-1;
        $this->load->model("actualiza_estado_db_model");
        $datos_rf = $this->reservacionesFijas($dia, $hora_ant);
        $countrf = $datos_rf->num_rows();
        if ($countrf > 0) {
            //para cada reservacion fija
            for ($x = 0; $x < $countrf; $x++) {
                $drf = $datos_rf->row_array($x);
                $this->actualiza_estado_db_model->terminaRF($drf['sala']);
                $this->cambiaComentarioSala($drf['sala'], "");
                //obtener los equipos para una sala determinada
                $datos_eq_sala = $this->getEquiposSalas($drf['sala']);
                $counteqsa = $datos_eq_sala->num_rows();
                if ($counteqsa > 0) {
                    //para cada equipo de la sala
                    for ($y = 0; $y < $counteqsa; $y++) {
                        $des = $datos_eq_sala->row_array($y);
                        $this->actualiza_estado_db_model->libera_equipo($des['numserie']);
                    }
                }
            }
        }
    }

    private function liberaReservaciones($hora) {
        $this->load->model("actualiza_estado_db_model");
        $reserv = $this->actualiza_estado_db_model->getReservacionesActivas($hora . ':00');
        if ($reserv->num_rows() > 0) {
            foreach ($reserv->result() as $r) {
                // if ($r->HoraFin == $hora . ':00') {
                $this->actualiza_estado_db_model->liberaReservActiva($r->idReservacionesMomentaneas, $r->NumeroSerie);
                //}
            }
        }
    }

    function actualizar() {
        $diadehoy = $this->input->post('dia');
        $ver_detalles = $this->config->item('ver_detalles_actdb');
        $hoy = date('d-m-Y'); //ejemplo 1989-05-05
        $horarf = $this->input->post('hora');
        $horatext = $this->gethoratexto($horarf);
        switch ($diadehoy) {
            //en caso que sea lunes
            case '1':
                if ($horarf != 0) {
                    //libero las reservaciones momentaneas que terminen a la $horatext
                    $this->liberaReservaciones($horatext);
                    $this->liberaSalaRF(1, $horarf);
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->reservaSalaRF(1, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia lunes ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea martes
            case '2':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(2, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(2, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia martes ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea miercoles
            case '3':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(3, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(3, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia miercoles ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea jueves
            case '4':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(4, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(4, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia jueves ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea viernes
            case '5':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(5, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(5, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia viernes ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea sabado
            case '6':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(6, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(6, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia sabado ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            //en caso que sea domingo
            case '7':
                if ($horarf != 0) {
                    $this->liberaSalaRS($horatext . ':00');
                    $this->reservaSala($horatext . ':00');
                    $this->liberaSalaRF(1, $horarf, $diadehoy);
                    $this->liberaReservaciones($horatext);
                    $this->reservaSalaRF(7, $horarf);
                    if ($ver_detalles) {
                        echo '----------Atendiendo peticion del dia domingo ' . $hoy . ' a las ' . $horatext . ' horas -----------';
                    }
                }
                break;
            default:break;
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

    function gethoratexto($hora) {
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

    function validaFechaPeriodo($start, $end, $fecha) {
        if (($fecha >= $start) && ($fecha <= $end)) {
            return true;
        } else {
            return false;
        }
    }

}

