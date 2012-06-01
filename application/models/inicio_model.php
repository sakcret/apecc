<?php

class inicio_model extends CI_Model {

    function inicio_model() {
        parent ::__construct();
        $this->load->database();
    }

    /*
     * @note La hore de fin es un campo lógico generado a partir de la hora a la que se encuentra la actividad ya que cada actividad  se reserva por hora
     */
    function getActividadesHoy() {
        $this->db->select("actividades.Actividad AS actividad,
CASE actividades.TipoActividad
		WHEN '1' THEN 'Curso'
		WHEN '0' THEN 'Clase'
		END AS tipoact,
                    CONCAT(academicos.Nombre,' ', academicos.ApellidoPaterno,' ',academicos.ApellidoMaterno) AS encargado,
                            CASE Hora 
		WHEN '1' THEN '07:00'
		WHEN '2' THEN '08:00'
		WHEN '3' THEN '09:00'
		WHEN '4' THEN '10:00'
		WHEN '5' THEN '11:00'
		WHEN '6' THEN '12:00'
		WHEN '7' THEN '13:00'
		WHEN '8' THEN '14:00'
		WHEN '9' THEN '15:00'
		WHEN '10' THEN '16:00'
		WHEN '11' THEN '17:00'
		WHEN '12' THEN '18:00'
		WHEN '13' THEN '19:00'
		WHEN '14' THEN '20:00'
		WHEN '15' THEN '21:00'
		WHEN '16' THEN '22:00' 
	END AS horainicio,
	CASE Hora 
		WHEN '1' THEN '08:00'
		WHEN '2' THEN '09:00'
		WHEN '3' THEN '10:00'
		WHEN '4' THEN '11:00'
		WHEN '5' THEN '12:00'
		WHEN '6' THEN '13:00'
		WHEN '7' THEN '14:00'
		WHEN '8' THEN '15:00'
		WHEN '9' THEN '16:00'
		WHEN '10' THEN '17:00'
		WHEN '11' THEN '18:00'
		WHEN '12' THEN '19:00'
		WHEN '13' THEN '20:00'
		WHEN '14' THEN '21:00'
		WHEN '15' THEN '22:00'
		WHEN '16' THEN '23:00' 
	END AS horafin,
	salas.Sala AS sala,
	concat ('B',actividad_academico.Bloque,'/S',actividad_academico.Seccion) AS bloqueseccion,		
	actividades.FechaInicio AS inicio,
                  actividades.FechaFin AS fin", false);
        $this->db->from('reservacionesfijas');
        $this->db->join('salas', 'salas.idSala= reservacionesfijas.Sala', 'left');
        $this->db->join('actividad_academico', 'actividad_academico.IdActividadAcademico= reservacionesfijas.IdActividadAcademico', 'left');
        $this->db->join('academicos', 'academicos.NumeroPersonal=actividad_academico.NumeroPersonal', 'left');
        $this->db->join('actividades', 'actividades.idActividad=actividad_academico.IdActividad', 'left');
        //obtener solo las actividades vigentes dentro del periodo definido en el archivo de configuracion
        $where_periodo = 'FechaFin BETWEEN \'' . $this->config->item('fecha_periodo_inicio') . '\' and \'' . $this->config->item('fecha_periodo_fin') . '\'';
        $this->db->where($where_periodo);
        $this->db->where('Dia', date('N'));
        return $this->db->get();
    }

}

?>
