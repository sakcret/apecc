<?php

class Sql_generico_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function datosDataTable($columnas, $tabla, $where, $order, $limit) {
        $sql = "
		SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $columnas)) . "
		FROM   $tabla
		$where
		$order
		$limit";

        $result = $this->db->query($sql);
        return $result;
    }

    function numFilasSQL() {
        $sql = "SELECT FOUND_ROWS() AS filas";
        $result = $this->db->query($sql);
        ;
        return $result;
    }

    function countResults($indice_clave, $tabla) {
        $sql = "SELECT COUNT(" . $indice_clave . ") as numreg FROM $tabla";
        $result = $this->db->query($sql);
        return $result;
    }

    function getMax($campo, $tabla) {
        $sql = "SELECT MAX(" . $campo . ") AS nmax FROM $tabla";
        $result = $this->db->query($sql);
        return $result;
    }

    //Nota: !Importante verificar que as consultas de esta funcion sean cacheados ya que afectara en la actualizacion del cache
    function borra_todo_cache() {
        $this->db->stop_cache();
        $this->db->cache_off();
        $datos = array('procesada_server' => 1);
        $this->db->trans_begin();
        $this->db->select('COUNT(*)as numero_actualizaciones');
        $this->db->where('procesada_server', 0);
        $na = $this->db->get('bitacora_cch')->result_array();
        if ($na[0]['numero_actualizaciones'] > 0) {
            $this->db->cache_delete_all();
            $this->db->update('bitacora_cch', $datos);
        }$this->db->cache_delete('blog', 'comentarios');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $this->db->cache_delete_all();
            $result = TRUE;
        }
        return $result;
    }

    function borra_cache($controlador, $funcion) {
        $this->db->stop_cache();
        $this->db->cache_off();
        $datos = array('procesada_server' => 1);
        $this->db->trans_begin();
        $this->db->select('COUNT(*)as numero_actualizaciones');
        $this->db->where('procesada_server', 0);
        $na = $this->db->get('bitacora_cch')->result_array();
        if ($na[0]['numero_actualizaciones'] > 0) {
            $this->db->cache_delete_all();
            $this->db->update('bitacora_cch', $datos);
        }$this->db->cache_delete('blog', 'comentarios');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $this->db->cache_delete("$controlador", "$funcion");
            $result = TRUE;
        }
        return $result;
    }

    function respalda_query($datos, $nombre_resp) {
        if ($this->config->item('respaldos_db')) {
            // Cargar el helper file y escribir el archivo en el servidor
            $this->load->helper('file');
            $this->load->dbutil();
            if ($this->config->item('formato_respaldo_db') == 'csv') {
                $csv = $this->dbutil->csv_from_result($datos);
                write_file('respaldosdb/csv/' . $nombre_resp . '_' . date('Y-m-d_H:i:s') . '.csv', $csv);
            } else {
                //definir configuracion para el xml
                $config_xml = array(
                    'root' => 'root',
                    'element' => 'element',
                    'newline' => "\n",
                    'tab' => "\t"
                );
                $xml = $this->dbutil->xml_from_result($datos, $config_xml);
                write_file('respaldosdb/xml/' . $nombre_resp . '_' . date('Y-m-d_H:i:s') . '.xml', $xml);
            }
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

}

?>
