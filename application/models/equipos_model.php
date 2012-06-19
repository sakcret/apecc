<?php

class Equipos_model extends CI_Model {

    function Equipos_model() {
        parent ::__construct();
        $this->load->database();
    }

    function num_rows_equipos() {
        return $this->db->count_all('equipos');
    }

    function agrega_equipo($numSer, $marca, $modelo, $numInv, $procesador, $disco, $ram) {
        $datos = array(
            'NumeroSerie' => $numSer,
            'Marca' => $marca,
            'Modelo' => $modelo,
            'NumeroInventario' => $numInv,
            'Procesador' => $procesador,
            'DiscoDuro' => $disco,
            'RAM' => $ram,
            'Estado' => 'S'
        );
        $this->db->trans_begin();
        $this->db->insert('equipos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }

    function modifica_equipo($numSer, $marca, $modelo, $numInv, $procesador, $disco, $ram, $edo) {
        $datos = array(
            'Marca' => $marca,
            'Modelo' => $modelo,
            'NumeroInventario' => $numInv,
            'Procesador' => $procesador,
            'DiscoDuro' => $disco,
            'RAM' => $ram,
            'Estado' => $edo
        );
        $this->db->trans_begin();
        $this->db->where('NumeroSerie', $numSer);
        $this->db->update('equipos', $datos);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function elimina_equipo($numSer) {
        $this->db->trans_begin();
        $this->db->where('NumeroSerie', $numSer);
        $this->db->delete('equipos');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
        return $result;
    }
    
    function getequipo($numSer){
        return $this->db->get_where('equipos',array('NumeroSerie'=>$numSer));
    }
    
    function getsos2equipo($equipo) {
        $this->db->select("equipos_sistemasoperativos.idSistemaOperativo as id");
        $this->db->select("sistemaOperativo as so");
        $this->db->from("equipos_sistemasoperativos");
        $this->db->join("sistemasoperativos","equipos_sistemasoperativos.idSistemaOperativo=sistemasoperativos.idSistemaOperativo");
        $this->db->where("NumeroSerie", $equipo);
        $query = $this->db->get();
        return $query;
    }
    function getdetallesequipo($numserie){
        $this->db->select("equipos_sistemasoperativos.idSistemaOperativo as id");
        $this->db->select("sistemaOperativo as so");
        $this->db->from("equipos_sistemasoperativos");
        $this->db->join("sistemasoperativos","equipos_sistemasoperativos.idSistemaOperativo=sistemasoperativos.idSistemaOperativo");
        $this->db->where("NumeroSerie", $equipo);
        $query = $this->db->get();
        return $query;
    }
    
    function getSoftwareEquipo($numserie){
        $this->db->select("software.idSoftware as id,
        software.software as software,
        sistemasoperativos.sistemaOperativo so");
        $this->db->from("equipos_software");
        $this->db->join("software","software.idSoftware=equipos_software.idSoftware");
        $this->db->join("sistemasoperativos","software.idSistemaOperativo=sistemasoperativos.idSistemaOperativo");
        $this->db->where("equipos_software.NumeroSerie", $numserie);
        $query = $this->db->get();
        return $query;
        
    }

}

?>