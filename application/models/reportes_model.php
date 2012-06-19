<?php

class Reportes_model extends CI_Model {

    function Reportes_model() {
        parent ::__construct();
        $this->load->database();
    }

    function reserv_data($sala) {
        //select count(idReservacionesMomentaneas) as cuantas,Fecha as fecha from `reservacionesmomentaneas` where `SalaAux`=1  group by Fecha
        $this->db->select('count(idReservacionesMomentaneas) as cuantas,Fecha as fecha',false);
        $this->db->from('reservacionesmomentaneas');
        $this->db->where('SalaAux',$sala);
        $this->db->group_by("Fecha");
        $result = $this->db->get();
        return $result;
    }

    function getactividad($id) {
        return $this->db->get_where('reportes', array('idActividad' => $id));
    }

    function cambiacolor($id, $color) {
        $datos = array(
            'Color' => $color
        );
        $this->db->trans_begin();
        $this->db->where('idActividad', $id);
        $this->db->limit(1);
        $this->db->update('reportes', $datos);
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
        $this->db->delete('reportes');
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
        $this->db->insert('reportes', $datos);
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
        $this->db->update('reportes', $datos);
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
    
    function datosReserv(){
        $sql='select sum(Horas) as horas,count(idReservacionesMomentaneas) 
as cuantas, `SalaAux` as sala,
Fecha as fecha 
from `reservacionesmomentaneas` group by Fecha,SalaAux order by Fecha,sala';
        return $this->db->query($sql);
    }

}

?>