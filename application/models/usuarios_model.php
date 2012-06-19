<?php

class Usuarios_model extends CI_Model {

    function Usuarios_model() {
        parent ::__construct();
        $this->load->database();
    }

    function getUsuario($login) {
        $query = $this->db->where('login', $login);
        $query = $this->db->get('usuarios');
        return $query;
    }

    function getTipos() {
        $query = $this->db->get('tipo_usuario');
        return $query;
    }

    function getUsuarios() {
        $this->db->cache_on();
        $query = $this->db->get('usuarios');
        $this->db->cache_off();
        if ($query->num_rows() > 0) {
            return $query;
        }
        return false;
    }

    function elimina_usuario($login) {
        $this->db->trans_begin();
        $this->db->where('Login', $login);
        $this->db->limit(1);
        $this->db->delete('academicos');
        $this->db->where('login', $login);
        $this->db->limit(1);
        $this->db->delete('usuarios');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_usuario($login, $matricula, $nombre, $apaterno, $amaterno, $tipou, $ncredencial, $fechacreacion, $fechaexpira, $numpersonal, $esmaestro) {
        $datos = array(
            'login' => $login,
            'matricula' => $matricula,
            'nombre' => $nombre,
            'paterno' => $apaterno,
            'materno' => $amaterno,
            'idtipo' => $tipou,
            'num_cred' => $ncredencial,
            'fecha_creacion' => $fechacreacion,
            'fecha_expira' => $fechaexpira,
            'actualiza' => 1
        );
        $this->db->trans_begin();
        $this->db->insert('usuarios', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            if ($esmaestro == 'si') {
                $datos_academico = array(
                    'NumeroPersonal' => $numpersonal,
                    'Nombre' => $nombre,
                    'ApellidoPaterno' => $apaterno,
                    'ApellidoMaterno' => $amaterno,
                    'Login' => $login
                );
                $this->db->insert('academicos', $datos_academico);
            }
            $result = TRUE;
        }
        return $result;
    }

    function modifica_usuario($login, $matricula, $nombre, $apaterno, $amaterno, $actualiza,$esmaestro ) {
        $datos = array(
            'matricula' => $matricula,
            'nombre' => $nombre,
            'paterno' => $apaterno,
            'materno' => $amaterno,
            'actualiza' => $actualiza
        );
        $this->db->trans_begin();
        $this->db->where('login', $login);
        $this->db->update('usuarios', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            if ($esmaestro == 'si') {
                $datos_academico = array(
                    'Nombre' => $nombre,
                    'ApellidoPaterno' => $apaterno,
                    'ApellidoMaterno' => $amaterno
                );
                $this->db->where('Login', $login);
                $this->db->update('academicos', $datos_academico);
            }
            $result = TRUE;
        }
        return $result;
    }

    function actualiza_st_usuario($login, $st) {
        $datos = array(
            'actualiza' => $st
        );
        $this->db->trans_begin();
        $this->db->where('login', $login);
        $this->db->update('usuarios', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function getacademicos() {
        $this->db->select('concat(Nombre,\' \',ApellidoPaterno,\' \',ApellidoMaterno) as academico,NumeroPersonal as num_per',FALSE);
        $this->db->from('academicos');
        return $this->db->get()->result_array();
    }
}
?>