<?php

class Acceso_model extends CI_Model {

    function Login_model() {
        parent ::__construct();
        $this->load->database();
    }

    function ValidarUsuario($login,$password){ 
        $this->load->database();
        $this->db->where("login",$login);
        $this->db->where("pass",$password);
        $this->db->limit(1);
        $query = $this->db->get('usuariossistema');
        return $query;
    }
}
?>