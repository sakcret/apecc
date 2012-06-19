<?php

class Software_model extends CI_Model {

    function Software_model() {
        parent ::__construct();
        $this->load->database();
    }

    function getsoftware($id) {
        return $this->db->get_where('software', array('idSoftware' => $id));
    }
    
    function getgrupo($id){
        return $this->db->get_where('grupo_software', array('idGrupo' => $id));
    }

    function elimina_software($id) {
        $this->db->trans_begin();
        $this->db->where('idSoftware', $id);
        $this->db->limit(1);
        $this->db->delete('software');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function elimina_grupo($id){
        $this->db->trans_begin();
        $this->db->where('idGrupo', $id);
        $this->db->delete('software_grupos');
        $this->db->where('idGrupo', $id);
        $this->db->limit(1);
        $this->db->delete('grupo_software');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function elimina_so($id) {
        $this->db->trans_begin();
        $this->db->where('idSistemaOperativo', $id);
        $this->db->limit(1);
        $this->db->delete('sistemasoperativos');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_software($nombre, $version, $descripcion, $so) {
        $datos = array(
            'software' => $nombre,
            'version' => $version,
            'descripcion' => $descripcion,
            'idSistemaOperativo' => $so
        );
        $this->db->trans_begin();
        $this->db->insert('software', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function agrega_grupo($nombre, $descripcion, $so) {
        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'idSistemaOperativo' => $so
        );
        $this->db->trans_begin();
        $this->db->insert('grupo_software', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    function modifica_grupo($id,$nombre, $descripcion) {
        $datos = array(
            'nombre' => $nombre,
            'descripcion' => $descripcion
        );
        $this->db->trans_begin();
        $this->db->where('idGrupo', $id);
        $this->db->update('grupo_software', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function agrega_so($so){
        $datos = array(
            'sistemaOperativo' => $so
        );
        $this->db->trans_begin();
        $this->db->insert('sistemasoperativos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function modifica_so($idso,$so){
        $datos = array(
            'sistemaOperativo' => $so
        );
        $this->db->trans_begin();
        $this->db->where('idSistemaOperativo', $idso);
        $this->db->update('sistemasoperativos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function modifica_software($id, $nombre, $version, $descripcion, $so) {
        $datos = array(
            'software' => $nombre,
            'version' => $version,
            'descripcion' => $descripcion,
            'idSistemaOperativo' => $so
        );
        $this->db->trans_begin();
        $this->db->where('idSoftware', $id);
        $this->db->update('software', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function getsistemassw() {
        //$this->db->cache_on();
        $this->db->select("idSistemaOperativo AS id,sistemaOperativo AS so");
        $this->db->order_by('sistemaOperativo', 'asc');
        $result = $this->db->get('sistemasoperativos')->result_array();
        //$this->db->cache_off();
        return $result;
    }

    function getgruposxsw($idsw) {
        //$this->db->cache_on();
        $this->db->select("software_grupos.idGrupo as id, nombre as grupo, software_grupos.idSoftware as idsw");
        $this->db->from('software_grupos');
        $this->db->join('grupo_software', 'grupo_software.idGrupo=software_grupos.idGrupo');
        $this->db->where('software_grupos.idSoftware', $idsw);
        $this->db->order_by('software_grupos.idGrupo', 'asc');
        $result = $this->db->get();
        //$this->db->cache_off();
        return $result;
    }

    function getgrupossw($idso) {
        //$this->db->cache_on();
        $this->db->select("idGrupo AS id, nombre  AS grupo");
        $this->db->where("idSistemaOperativo", $idso);
        $this->db->order_by('nombre', 'asc');
        $result = $this->db->get('grupo_software')->result_array();
        //$this->db->cache_off();
        return $result;
    }
    function get_datos_so($id){
        $this->db->where("idSistemaOperativo", $id);
        return $this->db->get('sistemasoperativos');
    }

    function asigna_grupo($idsw, $grupo) {
        $datos = array(
            'idSoftware' => $idsw,
            'idGrupo' => $grupo
        );
        $this->db->trans_begin();
        $this->db->insert('software_grupos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function desasigna_grupo($idsw, $idgru){
        $this->db->trans_begin();
        $this->db->where('idSoftware', $idsw);
        $this->db->where('idGrupo', $idgru);
        $this->db->limit(1);
        $this->db->delete('software_grupos');
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