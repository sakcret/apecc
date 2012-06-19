<?php
if (!defined('BASEPATH'))
    exit('Acceso denegado');

class Salas_model extends CI_Model {

    function Salas_model() {
        parent ::__construct();
        $this->load->database();
    }

    function datos_salas() {
        //$this->db->cache_on();
        $result = $this->db->get('salas');
        //$this->db->cache_off();
        return $result;
    }
    
    function cambia_comentario_sala($idsala,$comentario) {
        $datos = array(
            'Comentario' =>$comentario
        );
        $this->db->trans_begin();
        $this->db->where('idSala',$idsala);
        $this->db->update('salas', $datos);
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