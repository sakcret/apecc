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
     *       ejemplo:       usu>ac|act>t         --sobre el recurso usuario tiene permisos de altas y cambios y para las actividades todos los privilegios 
     * @return Array|FALSE
     */
    function getPermisos($s) {
        if($s!=''&&$s!=null) {
            $tmp = explode("|", $s);
            $permisos = array();
            for ($i = 0; $i < count($tmp); $i++) {
                $t = explode(">", $tmp[$i]);
                $permisos[$t[0]] = $t[1];
            }
            if (count($permisos) > 0) {
                return $permisos;
            } else {
                return FALSE;
            }
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
        if($permisos!=FALSE) {
            $post = strpos($permisos, 't');
            $posv = strpos($permisos, 'v');
            if ($post === false) {
                for ($i = 0; $i < count($prm_array); $i++) {
                    $pos = strpos($permisos, $prm_array[$i]);
                    ($pos === false) ? $css_prm .= ".prm_$prm_array[$i]{display: none !important;}" : $css_prm.= '';
                }
            } else {
                $css_prm = '';
            }
            //si se encuentra una v entonces oculta todas las opciones
            if ($posv) {
                 $css_prm ='';
                for ($i = 0; $i < count($prm_array); $i++) {
                    $css_prm .= ".prm_$prm_array[$i]{display: none !important;}";
                }
            }
        } else {
            $css_prm ='';
            for ($i = 0; $i < count($prm_array); $i++) {
                $css_prm .= ".prm_$prm_array[$i]{display: none !important;}";
            }
        }
        return $css_prm;
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
}

?>
