<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class Utilerias extends CI_Controller {

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
    
    static public function getSQL_date($fecha){
        $f = substr($fechaInicio, 6, 4) . '-' . substr($fechaInicio, 3, 2) . '-' . substr($fechaInicio, 0, 2);
        return $f;
    }

}

?>
