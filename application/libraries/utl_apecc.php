<?php

/**
 * utl_apecc.php
 *
 * clase con utilerias para el sistema apecc
 *
 * @package		
 * @author		José Adrian Ruiz Carmona
 * @copyright           Copyright (c) 2012 - 2013.
 * @link		
 * @since		Version 1.0
 * @filesource
 */
/*
 * @class Utl_apecc
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utl_apecc {

    /**
     * @brief Funcion que recibe como parametro una cadena que representa los permisos del usuario logeado para cada recurso.
     * @param $s String Cadena con los permisos por cada recurso del sistema.
     * @note El formato de la cadena debe estar previamente validado. El formato es: Nombre del recurso el caracter mayor que '>' segido
     *       de los permisos (a=altas b=bajas c=cambios... t=todos los permisos), para agregar otro recurso se agrega el caracter pipe '|'
     *       @example      usu>ac|act>t         --sobre el recurso usuario tiene permisos de altas y cambios y para las actividades todos los privilegios 
     * @return Array|FALSE
     */
    function getPermisos($s) {
        if ($s != '' && $s != null) {
            $tmp = explode("|", $s);
            $permisos = array();
            //para cada elemento del sistema extraer sus permisos
            for ($i = 0; $i < count($tmp); $i++) {
                $t = explode(">", $tmp[$i]);
                //si hay por lo menos dos elementos
                if (count($t) == 2) {
                    $permisos[$t[0]] = $t[1];
                } else {
                    if (count($t) == 1)
                        $permisos[$t[0]] = '';
                }
            }
            if (count($permisos) > 0) {
                return $permisos;
            } else {
                return FALSE;
            }
        } else {
            return false;
        }
    }

    /**
     * @brief Funcion que recibe como parametro una cadena que representa los permisos del usuario y devuelve un arreglo
     * con los ids para los permisos y poder aignarlos mediante css.
     * @param $s String Cadena con los permisos por cada recurso del sistema.
     * @note El formato de la cadena debe estar previamente validado. El formato es: Nombre del recurso el caracter mayor que '>' segido
     *       de los permisos (a=altas b=bajas c=cambios... t=todos los permisos), para agregar otro recurso se agrega el caracter pipe '|'
     *       @example      usu>ac|act>t         --sobre el recurso usuario tiene permisos de altas y cambios y para las actividades todos los privilegios 
     *                             regresa :
     *                                          Array ( [0] => a_usu [1] => c_usu [2] => b_act [3] => c_act [4] => a_equ [5] => c_equ );
     *                                          'a_usu' clase asignada al checbox ej. <input type="checkbox" value="act_a" name="prm[]" id="a_usu" >
     * @return Array|FALSE
     */
    function getIDSPermisos($s) {
        if ($s != '' && $s != null) {
            $permisos = $this->getPermisos($s);
            if ($permisos !== false) {
                $ids = array();
                $index = 0;
                foreach ($permisos as $key => $value) {
                    if ($value != '') {
                        for ($i = 0; $i < strlen($value); $i++) {
                            array_push($ids, $value[$i] . '_' . $key);
                        }
                    }
                }
                return $ids;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @brief Funcion que crea el css para ocultar ociones segun los permisos.
     * @param $permisos String|FALSE Cadena con los permisos del usuario .Si es FALSE entonces bloqueara todas las opciones. 
     * @param $prm_array Array arrqglo que contiene todos los permisos.
     * @note  La cadena con el CSS devuelto no contiene las etiquetas <style> por lo tanto habra que agregarlas como mejor convenga ya sea dentro del html o en un archivo css
     * @return String  cadena con el css que mostrará u ocultara opciones
     */
    function getCSS_prm($permisos, $prm_array) {
        $css_prm = '';
        if ($permisos != FALSE) {
            $post = strpos($permisos, 't');
            $posv = strpos($permisos, 'v');
            if ($post === false) {
                for ($i = 0; $i < count($prm_array); $i++) {
                    $pos = strpos($permisos, $prm_array[$i]);
                    ($pos === false) ? $css_prm .= ".prm_$prm_array[$i]{display: none !important;}" : $css_prm.= '';
                }
            } else {
                $css_prm = '/*prm all*/';
            }
            //si se encuentra una v entonces oculta todas las opciones
            if ($posv) {
                $css_prm = '';
                for ($i = 0; $i < count($prm_array); $i++) {
                    $css_prm .= ".prm_$prm_array[$i]{display: none !important;}";
                }
            }
        } else {
            $css_prm = '';
            for ($i = 0; $i < count($prm_array); $i++) {
                $css_prm .= ".prm_$prm_array[$i]{display: none !important;}";
            }
        }
        return $css_prm;
    }

    /**
     * @brief Funcion que da formato a los permisos en forma de string.
     * @param $a array Arreglo con los permisos desde un formulario.
     * @note El arreglo de permisos  debe contener por separado cada permiso para cada recurso del sistema.
     *       @example       Arreglo de entrada:  Array(
      [0] => act_a
      [1] => act_c
      [2] => act_s
      [3] => swr_a
      [4] => swr_b
      [5] => rss_b
      )
     *                             Cadena de salida:  act>acs|swr>ab|rss>b
     *                             Llamada a la función:  $permisos = getStringPermisos($prm);
     * @return string 
     */
    function getStringPermisos($prm) {
        $t = array();
        $permisos = "";
        if (count($prm) >= 0 && $prm[0] != '') {
            $leng = count($prm);
            $act = $sig = "";
            for ($i = 0; $i < $leng; $i++) {
                $t[$i] = explode("_", $prm[$i]);
            }
            $leng = count($t);
            $txt = "";
            if ($leng > 0) {
                $act = $t[0][0];
                for ($i = 0; $i < $leng; $i++) {
                    $txt.=$t[$i][1];
                    if ($i == $leng - 1) {
                        $permisos.= $act . '>' . $txt;
                    } else {
                        $posig = $i + 1;
                        if ($t[$i][0] != $t[$posig][0]) {
                            $permisos.= $act . '>' . $txt . '|';
                            $act = $t[$posig][0];
                            $txt = '';
                        }
                    }
                }
            }
        }
        return $permisos;
    }

    function respalda_query($datos, $nombre_resp) {
        // Cargar el helper file y escribir el archivo en el servidor
        $this->load->helper('file');
        if ($this->config->item('formato_respaldo_db') == 'csv') {
            $csv = $this->dbutil->csv_from_result($datos);
            write_file('respaldosdb/csv/' . $nombre_resp . '_' . date('Y-m-d') . '.csv', $csv);
        } else {
            //definir configuracion para el xml
            $config_xml = array(
                'root' => 'root',
                'element' => 'element',
                'newline' => "\n",
                'tab' => "\t"
            );
            $xml = $this->dbutil->xml_from_result($datos, $config_xml);
            write_file('respaldosdb/xml/' . $nombre_resp . '_' . date('Y-m-d') . '.xml', $xml);
        }
    }

    function respaldoBD($server_guarda, $nombre) {
        // Hacer copia de respaldo para la BD entera y asignarla a una variable
        $backup = & $this->dbutil->backup();
        if ($server_guarda) {
            if ($nombre != '' && $nombre != false) {
                write_file('respaldosdb/' . $nombre . '.sql.gz', $backup);
            } else {
                write_file('respaldosdb/ccomputo_backup_db_' . date('Y-m-d') . '.sql.gz', $backup);
            }
        } else {
            $this->load->helper('download');
            force_download('ccomputo_backup_db.sql.gz', $backup);
        }
    }

    public function getSQL_date($fecha) {
        $f = substr($fecha, 6, 4) . '-' . substr($fecha, 3, 2) . '-' . substr($fecha, 0, 2);
        return $f;
    }

    public function getdate_SQL($fecha) {
        $f = substr($fecha, 8, 2) . '/' . substr($fecha, 5, 2) . '/' . substr($fecha, 0, 4);
        return $f;
    }

    /**
     * @brief Funcion devuelve fecha de dia lunes de la semana pasando unna fecha, es decir, si paso una fecha 2012-07-17 y ese dia es martes devolvera el lunes de esa semana 
     * osea 2012-07-16.
     * @param $fecha DateTime  fecha para calcular el lunes de su semana. 
     * @return DateTime  Día lunes de la semana correspondiente a la fecha pasada como parametro.
     */
    public function getDiaLunesSemana($fecha) {
        $dias_menos = 0;
        $ds = $fecha->format('N');
        switch ($ds) {
            case '1': $dias_menos = 0;
                break;
            case '2': $dias_menos = 1;
                break;
            case '3': $dias_menos = 2;
                break;
            case '4': $dias_menos = 3;
                break;
            case '5': $dias_menos = 4;
                break;
            case '6': $dias_menos = 5;
                break;
            case '7': $dias_menos = 6;
                break;
            default:break;
        }
        date_sub($fecha, date_interval_create_from_date_string("$dias_menos days"));
        return $fecha;
    }

    /**
     * @brief Funcion devuelve un arreglo con las semanas por mes cada arreglo contiene el dia de inicio y fin de la semana siempre que se encuentre
     * dentro del mes
     * @param $fecha DateTime fecha de la cual se obtendràn los periodos. 
     * @return DateTime 
     * @example   El siguiente arreglo contiene la salida con los periodos para la fecha=2012-03-10 el indice es el numero de semana del año
     *                     Array ( 
     *                                 [09] => Array ( [dia_inicio] => 01 [dia_fin] => 04 ) 
     *                                 [10] => Array ( [dia_inicio] => 05 [dia_fin] => 11 ) 
     *                                 [11] => Array ( [dia_inicio] => 12 [dia_fin] => 18 ) 
     *                                 [12] => Array ( [dia_inicio] => 19 [dia_fin] => 25 ) 
     *                                 [13] => Array ( [dia_inicio] => 26 [dia_fin] => 31 ) 
     *                               ) 
     */
    public function periodo_semana_mes($fecha) {
        $dia_mesnew = 0;
        $g = 0;
        $a_sem_dias = array();
        $mes_new = FALSE;
        $dia_ant = '01';
        $dia_s = '0';
        for ($i = 1; $i < 32; $i++) {
            if ($i < 10) {
                $dia = '0' . $i;
                $dia_s = '0' . $i;
            } else {
                $dia = $i;
                $dia_s = $i;
            }
            $h = new DateTime($fecha->format('Y-m-') . $dia);
            $h_sig = new DateTime($fecha->format('Y-m-') . $dia);
            date_add($h_sig, date_interval_create_from_date_string("1days"));
            if ($h_sig->format('d') == '01') {
                $mes_new = true;
                $dia_mesnew = $dia;
            }
            //si la semana actual es diferente de la semana siguiente
            if ($h->format('W') != $h_sig->format('W')) {
                $g = 0;
                if (($dia - 6) < 1) {
                    $dia_ant = 1;
                } else {
                    $dia_ant = $dia - 6;
                }
            } elseif ($i == 31) {
                $dia_ant = $dia;
            }

            if ($dia_ant < 10) {
                $dia_ant = '0' . $dia_ant;
            }
            //si el mes es el actual
            if (!$mes_new) {
                $a_sem_dias[$h->format('W')] = array('dia_inicio' => $dia_ant, 'dia_fin' => $dia);
            } else {//si el mes es distinto del actual
                if ($i <= $dia_mesnew) {
                    $dia_ant = $dia - ($g - 1);
                    $a_sem_dias[$h->format('W')] = array('dia_inicio' => $dia_ant, 'dia_fin' => $dia);
                }
            }
            $g++;
        }
        return $a_sem_dias;
    }

    public function getDiaStr($ds) {
        switch ($ds) {
            case '1': $dia = "Lunes";
                break;
            case '2': $dia = "Martes";
                break;
            case '3': $dia = "Miercoles";
                break;
            case '4': $dia = "Jueves";
                break;
            case '5': $dia = "Viernes";
                break;
            case '6': $dia = "Sabado";
                break;
            case '7': $dia = "Domingo";
                break;
            default:break;
        }
        return $dia;
    }

    public function getMesStr($m) {
        switch ($m) {
            case '01': $mes = "Enero";
                break;
            case '02': $mes = "Febrero";
                break;
            case '03': $mes = "Marzo";
                break;
            case '04': $mes = "Abril";
                break;
            case '05': $mes = "Mayo";
                break;
            case '06': $mes = "Junio";
                break;
            case '07': $mes = "Julio";
                break;
            case '08': $mes = "Agosto";
                break;
            case '09': $mes = "Septiembre";
                break;
            case '10': $mes = "Octubre";
                break;
            case '11': $mes = "Noviembre";
                break;
            case '12': $mes = "Diciembre";
                break;
            default:break;
        }
        return $mes;
    }

}

?>
