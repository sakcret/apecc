<?php

class Reservaciones_fijas_model extends CI_Model {

    function Reservaciones_fijas_model() {
        parent ::__construct();
        $this->load->database();
    }

    function actividades() {
        $this->db->select("actividad_academico.IdActividadAcademico as id,
        actividad_academico.Bloque as bloque,
        actividad_academico.Seccion as seccion,
        actividades.IdActividad as idactividad,
        actividades.Actividad as nombrecompleto,
        actividades.TipoActividad as escurso,
        actividades.NombreCorto as nombre,
        academicos.NumeroPersonal as numper,
        concat(academicos.Nombre,' ',academicos.ApellidoPaterno) as catedratico", false);
        $this->db->from('actividad_academico');
        $this->db->join('academicos', 'actividad_academico.NumeroPersonal = academicos.NumeroPersonal');
        $this->db->join('actividades', 'actividades.idActividad = actividad_academico.idActividad');
        $this->db->order_by("actividades.Actividad", "asc");
        $result = $this->db->get();
        return $result->result_array();
    }

    /* esfurzos enlazados union y fuerza */

    function datos_reserv($fila, $id_sala) {
        $this->db->select("reservacionesfijas.idReservacionesFijas as idReservacionFija, 
        reservacionesfijas.Hora as hora,
        reservacionesfijas.Dia as dia,
        reservacionesfijas.Sala as sala,
        reservacionesfijas.IdActividadAcademico as idActividadAcademico,
        actividad_academico.Bloque as bloque,
        actividad_academico.Seccion as seccion,
        actividades.NombreCorto as nombreActividad,
        actividades.idActividad as idActividad,
        concat(academicos.Nombre,' ',academicos.ApellidoPaterno) as nombreacademico", false);
        $this->db->from("reservacionesfijas");
        $this->db->join('actividad_academico', 'actividad_academico.IdActividadAcademico=reservacionesfijas.IdActividadAcademico');
        $this->db->join('actividades', 'actividad_academico.IdActividad=actividades.IdActividad');
        $this->db->join('academicos', 'actividad_academico.NumeroPersonal = academicos.NumeroPersonal');
        $this->db->where("reservacionesfijas.Hora", $fila);
        $this->db->where("reservacionesfijas.Sala", $id_sala);
        $result = $this->db->get();
        return $result->result_array();
    }

    function eliminahorario($act_id, $row, $col, $sala) {
        $this->db->trans_begin();
        $this->db->where('IdActividadAcademico', $act_id);
        $this->db->where('Hora', $row);
        $this->db->where('Dia', $col);
        $this->db->where('Sala', $sala);
        $this->db->delete('reservacionesfijas');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function insertarhorario($act_id, $row1, $col1, $sala) {
        if ($row1 != 0 && $col1 != 0) {
            $datos = array(
                'IdActividadAcademico' => $act_id,
                'Hora' => $row1,
                'Dia' => $col1,
                'Sala' => $sala
            );
            $this->db->trans_begin();
            $this->db->insert('reservacionesfijas', $datos);
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

    function actualizarhorario($row1, $col1, $sub_id, $row0, $col0, $idsala) {
        if ($row1 != 0 && $col1 != 0 && $col0!=0 && $row0!=0) {
            $this->db->trans_begin();
            $sql = "update reservacionesfijas set Hora=$row1, Dia=$col1 where IdActividadAcademico='$sub_id' and Hora=$row0 and Dia=$col0 and Sala=$idsala";
            $this->db->query($sql);
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

}

?>