<?php

class Ubicacion_equipos_model extends CI_Model {

    function Ubicacion_equipos_model() {
        parent ::__construct();
        $this->load->database();
    }

    function ubicar_equipo($numeroSerie, $fila1, $columna1, $idsala) {
        if ($fila1 != 0 && $columna1 != 0) {
            $datos = array(
                'Fila' => $fila1,
                'Columna' => $columna1,
                'NumeroSerie' => $numeroSerie,
                'idSala' => $idsala
            );
            $this->db->trans_begin();
            /* Cambiar el estado del equipo a libre ya que será ubicado */
            $this->db->where('NumeroSerie', $numeroSerie);
            $this->db->update('equipos', array('Estado' => 'L'));
            /* Ubicar equipo */
            $this->db->insert('equipos_salas', $datos);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                $result = TRUE;
            }
            return $result;
        }
    }

    function reubicar_equipo($fila1, $columna1, $numeroSerie, $fila0, $columna0, $idsala) {
        if ($fila1 != 0 && $columna1 != 0) {
            $datos = array(
                'Fila' => $fila1,
                'Columna' => $columna1
            );
            $this->db->trans_begin();
            $this->db->where('NumeroSerie', $numeroSerie);
            $this->db->where('Fila', $fila0);
            $this->db->where('Columna', $columna0);
            $this->db->where('idSala', $idsala);
            $this->db->limit(1);
            $this->db->update('equipos_salas', $datos);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $result = FALSE;
            } else {
                $this->db->trans_commit();
                $result = TRUE;
            }
            return $result;
        }
    }

    function getequiposalmacenjson() {
        return $this->db->get('almacen');
    }

    function mover_almacen($numeroSerie, $row, $col, $idsala) {
        $this->db->trans_begin();
        /* Cambiar el estado del equipo a sin estado ya que será movido al almacén */
        $this->db->where('NumeroSerie', $numeroSerie);
        $this->db->update('equipos', array('Estado' => 'S'));
        /* Mover a almacen */
        $this->db->where('NumeroSerie', $numeroSerie);
        $this->db->where('Fila', $row);
        $this->db->where('Columna', $col);
        $this->db->where('idSala', $idsala);
        $this->db->delete('equipos_salas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function mover_almacen_todos($idsala) {
        $this->db->trans_begin();
        /* obtener los equipos a mover al almacén */
        $this->db->where('idSala', $idsala);
        $eq = $this->db->get('equipos_salas');
        //cambiar estado de equipos a sin estado
        foreach ($eq->result() as $row) {
            $this->db->where('NumeroSerie', $row->NumeroSerie);
            $this->db->update('equipos', array('Estado' => 'S'));
        }
        $this->db->where('idSala', $idsala);
        $this->db->delete('equipos_salas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

}

?>
