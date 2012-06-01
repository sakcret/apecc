<?php

class Actividades_model extends CI_Model {

    function Actividades_model() {
        parent ::__construct();
        $this->load->database();
    }

    function actividades_color() {
        $this->db->select('idActividad as idactividad,Color as color');
        $result = $this->db->get('actividades');
        return $result->result_array();
    }

    function getactividad($id) {
        return $this->db->get_where('actividades', array('idActividad' => $id));
    }

    function cambiacolor($id, $color) {
        $datos = array(
            'Color' => $color
        );
        $this->db->trans_begin();
        $this->db->where('idActividad', $id);
        $this->db->limit(1);
        $this->db->update('actividades', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function elimina_actividad($id) {
        $this->load->model('sql_generico_model');
        $this->db->trans_begin();
        /* Obtener las asignaciones de la actividad a eliminar y crear un respaldo */
        $this->db->where('IdActividad', $id);
        $data_acts = $this->db->get('actividad_academico');
        /*Para cada uno de los ids de las asignaciones borramos la(s) reservaciones asociadas*/
        foreach ($data_acts->result() as $row) {
            $this->db->where('IdActividadAcademico', $row->IdActividadAcademico);
            $this->db->delete('reservacionesfijas');
        }
        $this->sql_generico_model->respalda_query($data_acts, 'actividad_academico');
        /* Eliminar las asignaciones de la actividad a eliminar */
        $this->db->where('IdActividad', $id);
        $this->db->delete('actividad_academico');
        /* Eliminar la actividad */
        $this->db->where('idActividad', $id);
        $this->db->limit(1);
        $this->db->delete('actividades');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function desasigna_actividad($id) {
        $this->db->trans_begin();
        /*Eliminar reservaciones fijas asociadas a la actividad del catedratico*/
        $this->db->where('IdActividadAcademico', $id);
        $this->db->delete('reservacionesfijas');
        //desasignar actividad
        $this->db->where('IdActividadAcademico', $id);
        $this->db->delete('actividad_academico');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_actividad($nombre, $nombre_corto, $tipo_act, $color, $fechainicio, $fechafin) {
        $datos = array(
            'Actividad' => $nombre,
            'Color' => $color,
            'TipoActividad' => $tipo_act,
            'NombreCorto' => $nombre_corto,
            'FechaInicio' => $fechainicio,
            'FechaFin' => $fechafin
        );
        $this->db->trans_begin();
        $this->db->insert('actividades', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function asigna_actividad($id_act, $catedratico, $bloque, $seccion) {
        $datos = array(
            'IdActividad' => $id_act,
            'NumeroPersonal' => $catedratico,
            'Bloque' => $bloque,
            'Seccion' => $seccion
        );
        $this->db->trans_begin();
        $this->db->insert('actividad_academico', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function modifica_actividad($id, $nombre, $nombre_corto, $color) {
        $datos = array(
            'Actividad' => $nombre,
            'Color' => $color,
            'NombreCorto' => $nombre_corto
        );
        $this->db->trans_begin();
        $this->db->where('idActividad', $id);
        $this->db->update('actividades', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function actualizarhorario($row1, $col1, $sub_id, $row0, $col0) {
        $ref_hora = 'Hora';
        $ref_dia = 'Dia';
        $ref_act = 'IdActividadAcademico';
        $sql = "update reservacionesfijas set $ref_hora=$row1, $ref_dia=$col1 where $ref_act='$sub_id' and $ref_hora=$row0 and $ref_dia=$col0";
        $result = $this->db->query($sql);
    }

    function getcatedraticosactividad($id) {
        $this->db->select("IdActividadAcademico as id,Bloque,Seccion,actividad_academico.NumeroPersonal as NumeroPersonal,
            CONCAT(ApellidoPaterno,' ',ApellidoPaterno,' ',Nombre) as Nombre, 
            Login", FALSE);
        $this->db->from('actividad_academico');
        $this->db->join('academicos', 'academicos.NumeroPersonal=actividad_academico.NumeroPersonal');
        $this->db->where('actividad_academico.IdActividad', $id);
        $result = $this->db->get();
        return $result;
    }
    function getActividades_cpt(){
        $this->db->select("Actividad as actividad");
        $this->db->from('actividades');
        $result = $this->db->get();
        return $result;
    }

}

?>