<?php

if (!defined('BASEPATH'))
    exit('Acceso denegado');

class Actualiza_estado_db_model extends CI_Model {

    function Actualiza_estado_db_model() {
        parent ::__construct();
        $this->load->database();
    }

    function datos_reservaciones_fijas($dia, $hora) {
        $this->db->trans_begin();
        $this->db->select("Dia as dia, Hora as hora, Sala as sala, Login as encargardo,
            Actividad as nombre_actividad, Bloque as bloque, Seccion as seccion,
            TipoActividad as tipo_actividad,actividades.FechaInicio as fecha_inicio, actividades.FechaFin as fecha_fin");
        $this->db->from("reservacionesfijas");
        $this->db->join("actividad_academico", "actividad_academico.IdActividadAcademico=reservacionesfijas.IdActividadAcademico");
        $this->db->join("actividades", "actividad_academico.IdActividad=actividades.idActividad");
        $this->db->join("academicos", "academicos.NumeroPersonal=actividad_academico.NumeroPersonal");
        $this->db->where("Dia", $dia);
        $this->db->where("Hora", $hora);
        $datos = $this->db->get();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        if ($result) {
            return $datos;
        } else {
            return false;
        }
    }

    function equipos_salas($idsala) {
        $this->db->trans_begin();
        $this->db->select("equipos_salas.NumeroSerie as numserie,Estado as edo");
        $this->db->from("equipos_salas");
        $this->db->join("equipos", "equipos_salas.NumeroSerie=equipos.NumeroSerie");
        $this->db->where("idSala", $idsala);
        $datos = $this->db->get();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        if ($result) {
            return $datos;
        } else {
            return false;
        }
    }

    function libera_equipo($ns) {
        $this->db->trans_begin();
        $this->db->where("NumeroSerie", $ns);
        $this->db->where('Estado', 'O');
        $this->db->update('equipos', array('Estado' => 'L'));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
    }

    function resevacion($clave_reservacion, $fecha, $horaInicio, $horaFin, $login, $numserie, $importe, $edo, $hrs, $edo_equipo, $diasemana, $salaaux, $tipoActAux) {
        $insertreserv = array(
            'idReservacionesMomentaneas' => $clave_reservacion,
            'Fecha' => $fecha,
            'HoraInicio' => $horaInicio,
            'HoraFin' => $horaFin,
            'Login' => $login,
            'NumeroSerie' => $numserie,
            'Importe' => $importe,
            'Estado' => $edo,
            'Horas' => $hrs,
            'TipoActividadAux' => $tipoActAux,
            'DiaSemana' => $diasemana,
            'SalaAux' => $salaaux
        );

        $updatequipo = array('Estado' => $edo_equipo);
        $this->db->trans_begin();
        //insertar una nueva reservacion
        $this->db->insert('reservacionesmomentaneas', $insertreserv);
        //actualizar el estado del equipo a ocupado
        $this->db->where('NumeroSerie', $numserie);
        $this->db->where('Estado', 'C');
        $this->db->update('equipos', $updatequipo);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function reservacionesSalas($hora) {
        
        return $this->db->query('select * from reservacionessalas where Estado=\'A\'');
    }

    function terminaRF($sala) {
        $datos = array('Estado' => 'T');
        $this->db->trans_begin();
        $this->db->where('SalaAux', $sala);
        $this->db->update('reservacionesmomentaneas', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function getReservacionesActivas() {
        return $this->db->query('select * from reservacionesmomentaneas where Estado=\'A\' and TipoActividadAux=-1');
    }

    function liberaReservActiva($idreserv, $equipo) {
        $this->db->trans_begin();
        //liberar equipo cambiando su estado a (L)libre
        $this->db->where('NumeroSerie', $equipo);
        $this->db->where('Estado', 'O');
        $this->db->update('equipos', array('Estado' => 'L'));
        //cambiar el estado de la reservacion a (T)terminado
        $this->db->where('idReservacionesMomentaneas', $idreserv);
        $this->db->update('reservacionesmomentaneas', array('Estado' => 'T'));
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
