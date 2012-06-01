<?php

class Usuarios_sistema_model extends CI_Model {

    function Usuarios_sistema_model() {
        parent ::__construct();
        $this->load->database();
    }

    function getusuario_sis($login) {
        $this->db->select('login,rol,nombre,correo,permisos');
        return $this->db->get_where('usuariossistema', array('login' => $login));
    }
    
    function getPermisosUsuario($login) {
        $this->db->select('permisos');
        $this->db->from('usuariossistema');
        $this->db->where('login', $login);
        return $this->db->get();
    }
    
    function elimina_usuario_sis($id) {
        $this->db->trans_begin();
        $this->db->where('login', $id);
        $this->db->delete('usuariossistema');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_usuario_sis($nombre, $login, $password, $rol, $email,$permisos) {
        $datos = array(
            'nombre' => $nombre,
            'login' => $login,
            'pass' => $password,
            'rol' => $rol,
            'correo' => $email,
            'permisos' => $permisos
        );
        $this->db->trans_begin();
        $this->db->insert('usuariossistema', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function modifica_usuario_sis($nombre, $login, $password, $rol, $email,$permisos) {
        
        $datos = array(
            'nombre' => $nombre,
            'correo' => $email
        );
        if($permisos!=false){
            $datos['permisos'] = $permisos;
        }
        if($rol!=false){
            $datos['rol'] = $rol;
        }
        if($password!=false){
            $datos['pass'] = $password;
        }
        $this->db->trans_begin();
        $this->db->where('login',$login);
        $this->db->update('usuariossistema', $datos);
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