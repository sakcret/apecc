<?php
if (!defined('BASEPATH'))
    exit('Acceso denegado');

class Catedraticos_model extends CI_Model {

    function Catedraticos_model() {
        parent ::__construct();
        $this->load->database();
    }
    
    function catedraticos_color() {
        $this->db->select('idActividad as idcatedratico,Color as color');
        $result = $this->db->get('catedraticos');
        return $result->result_array();
    }
    
   function getcatedraticosselect() {
        //$this->db->cache_on();
        $this->db->select("NumeroPersonal,Concat(ApellidoPaterno,' ',ApellidoMaterno,' ',Nombre)as nombre", false);
        $this->db->order_by('nombre', 'asc');
        $result = $this->db->get('academicos')->result_array();
        //$this->db->cache_off();
        return $result;
    }
    
    function  elimina_catedratico($id){
        $this->db->trans_begin();
        $this->db->where('idActividad', $id);
        $this->db->delete('catedraticos');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    
    }

    function agrega_catedratico($nombre, $nombre_corto, $tipo_act,$color) {
        $datos = array(
            'Actividad' => $nombre,
            'Color' => $color,
            'Curso' => $tipo_act,
            'NombreCorto' => $nombre_corto
        );
        $this->db->trans_begin();
        $this->db->insert('catedraticos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function modifica_catedratico($id,$nombre, $nombre_corto, $tipo_act,$color){
        $datos = array(
            'Actividad' => $nombre,
            'Color' => $color,
            'Curso' => $tipo_act,
            'NombreCorto' => $nombre_corto
        );
        $this->db->trans_begin();
        $this->db->where('idActividad', $id);
        $this->db->update('catedraticos', $datos);
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
    
    function getcatedraticoscatedratico($id){
        $this->db->select("Bloque,Seccion,catedratico_academico.NumeroPersonal as NumeroPersonal,
            CONCAT(ApellidoPaterno,' ',ApellidoPaterno,' ',Nombre) as Nombre, 
            Login",FALSE);
        $this->db->from('catedratico_academico');
        $this->db->join('academicos','academicos.NumeroPersonal=catedratico_academico.NumeroPersonal');
        $this->db->where('catedratico_academico.IdActividad',$id);
        $result = $this->db->get();
        return $result;
    }

}
?>