<?php

class Equipo_software_model extends CI_Model {

    function Equipo_software_model() {
        parent ::__construct();
        $this->load->database();
    }

    function getSoftwareEquipo($equipo) {
        $this->db->select("software.idSoftware as id");
        $this->db->select("software.software as nombre");
        $this->db->select("software.descripcion");
        $this->db->select("sistemasoperativos.sistemaOperativo as so");
        $this->db->select("sistemasoperativos.idSistemaOperativo as idso");
        $this->db->from("equipos_sistemasoperativos");
        $this->db->join("sistemasoperativos", "sistemasoperativos.idSistemaOperativo=equipos_sistemasoperativos.idSistemaOperativo");
        $this->db->join("software", "sistemasoperativos.idSistemaOperativo=software.idSistemaOperativo");
        $this->db->where("NumeroSerie", $equipo);
        $query = $this->db->get();
        return $query;
    }

    function getsosequipo($equipo) {
        $this->db->select("idSistemaOperativo as id");
        $this->db->from("equipos_sistemasoperativos");
        $this->db->where("NumeroSerie", $equipo);
        $query = $this->db->get();
        return $query;
    }

    function get2Sos() {
        return $query = $this->db->get('sistemasoperativos');
    }

    function getswequipo($equipo) {
        $this->db->select("idSoftware as id ");
        $this->db->from("equipos_software");
        $this->db->where("NumeroSerie", $equipo);
        $query = $this->db->get();
        return $query;
    }

    function agrega_sos($numserie, $sos) {
        $this->db->trans_begin();
        $this->db->where('NumeroSerie', $numserie);
        $this->db->delete('equipos_sistemasoperativos');
        foreach ($sos as $s) {
            $datos = array(
                'NumeroSerie' => $numserie,
                'idSistemaOperativo' => $s
            );
            $this->db->insert('equipos_sistemasoperativos', $datos);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function agrega_sw($numserie, $sw) {
        $this->db->trans_begin();
        $this->db->where('NumeroSerie', $numserie);
        $this->db->delete('equipos_software');
        foreach ($sw as $s) {
            $datos = array(
                'NumeroSerie' => $numserie,
                'idSoftware' => $s
            );
            $this->db->insert('equipos_software', $datos);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function getGruposSo($so) {
        $this->db->select('idGrupo,nombre');
        $this->db->where('idSistemaOperativo', $so);
        return $this->db->get('grupo_software');
    }
    
    function getSWGrupos($gru) {
        $this->db->select('idSoftware');
        $this->db->where('idGrupo', $gru);
        return $this->db->get('software_grupos');
    }

}

?>