<?php

class Reservaciones_salas_model extends CI_Model {

    function Reservaciones_salas_model() {
        parent ::__construct();
        $this->load->database();
    }

    function getsalas() {
        $this->db->select("idSala as id, Sala as sala");
        $this->db->from('salas');
        $this->db->order_by("Sala", "asc");
        $result = $this->db->get();
        return $result->result_array();
    }

    function cancelar_resevacion($idreserv) {
        $this->db->trans_begin();
        $this->db->where('IdReservSala', $idreserv);
        $this->db->delete('reservacionessalas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_resevacion($sala, $actividad, $encargado, $hora_inicio, $hora_fin, $fecha_inicio, $fecha_fin) {
        $datos = array(
            'NombreActividad' => $actividad,
            'HoraInicio' => $hora_inicio,
            'HoraFin' => $hora_fin,
            'FechaInicio' => $fecha_inicio,
            'FechaFin' => $fecha_fin,
            'NumeroPersonal' => $encargado,
            'idSala' => $sala
        );
        $this->db->trans_begin();
        $this->db->insert('reservacionessalas', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function actualiza_estado($id, $st){
        $datos = array(
            'Estado' => $st
        );
        $this->db->trans_begin();
        $this->db->where('IdReservSala', $id);
        $this->db->update('reservacionessalas', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function modifica_resevacion($idreserv, $sala, $actividad, $encargado, $hora_inicio, $hora_fin, $fecha_inicio, $fecha_fin) {
        $datos = array(
            'NombreActividad' => $actividad,
            'HoraInicio' => $hora_inicio,
            'HoraFin' => $hora_fin,
            'FechaInicio' => $fecha_inicio,
            'FechaFin' => $fecha_fin,
            'NumeroPersonal' => $encargado,
            'idSala' => $sala
        );
        $this->db->trans_begin();
        $this->db->where('IdReservSala', $idreserv);
        $this->db->update('reservacionessalas', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function getdatosreserv($idreserv) {
        $this->db->where('IdReservSala', $idreserv);
        return $this->db->get('reservacionessalas');
    }

}

?>