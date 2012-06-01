<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipos extends CI_Controller {

    public function index() {
          //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        $permisos_us = $this->session->userdata('puedo');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        //si el usuario no tiene ningún permiso asignado
        if($permisos_us==''){
             redirect('acceso/acceso_home/inicio');
        }
        $this->load->library('utl_apecc');
        //obtener el arreglo con los permisos para el usuario del sistema
        $ptemp = $this->utl_apecc->getPermisos($this->session->userdata('puedo'));
        //si el usuario tiene permisos asignados entonces obtengo la clave de permisos para el controlador usuarios
        //que servirá como indice del arreglo de permisos y asi obtenerlos solo para el controlador actual(usuarios)
        $prm_array = $this->config->item('prm_permisos');
        if ($ptemp != FALSE) {
            $rec = $this->config->item('clvp_equipos');
            //si en el arreglo de permisos esta la clave de usuarios
            if (array_key_exists($rec, $ptemp)) {
                $permisos = $this->utl_apecc->getCSS_prm($ptemp[$rec], $prm_array);
            }else{
                redirect('acceso/acceso_home/inicio');
            }
        } else {
            $permisos = $this->utl_apecc->getCSS_prm(false, $prm_array);//si es falso no se encontraron permisos por lo tanto se ponen los atributos para solo lectura
        }
        $contenido['permisos'] = $permisos;
        $this->load->model("equipos_model");
        $data['titulo_pag'] = "GESTI&Oacute;N DE EQUIPOS";
        //$data['include'] = '<script src="./js/j.js" type="text/javascript"></script>';
        $contenido['tipos_u_rows'] = ''; //$this->equipos_model->getTipos();
        $data['contenido'] = $this->load->view('equipos_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function datosEquipos() {
        $aColumns = array('NumeroSerie', 'Marca', 'Modelo', 'NumeroInventario', 'Procesador', 'DiscoDuro', 'RAM', 'Estado');
        $sIndexColumn = "NumeroSerie";
        $sTable = "equipos";
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . $_GET['iDisplayStart'] . ", " .
                    $_GET['iDisplayLength'];
        }
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
				 	" . $_GET['sSortDir_' . $i] . ", ";
                }
            }
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . $_GET['sSearch_' . $i] . "%' ";
            }
        }
        $this->load->model("sql_generico_model");
        $rResult = $this->sql_generico_model->datosDataTable($aColumns, $sTable, $sWhere, $sOrder, $sLimit);
        $sQuery = $this->sql_generico_model->numFilasSQL();
        $fft = $sQuery->row_array(0);
        $iFilteredTotal = $fft['filas'];
        $sQuery = $this->sql_generico_model->countResults($sIndexColumn, $sTable);
        $ft = $sQuery->row_array(0);
        $iTotal = $ft['numreg'];
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        $id = $st = '';
        for ($x = 0; $x < $rResult->num_rows(); $x++) {
            $aRow = $rResult->row_array($x);
            $row = array();
            $row['DT_RowId'] = 'row_' . $aRow[$sIndexColumn];
            $row['DT_RowClass'] = 'gradeA';
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == $sIndexColumn) {
                    $id = $aRow[$aColumns[$i]];
                    $row[] = $aRow[$aColumns[$i]];
                } else {
                    if ($aColumns[$i] == "Estado") {
                        $st = $aRow[$aColumns[$i]];
                        $row[] = '<img src="images/pc_edos/pc_' . $st . '_min.png" id="' . $id . '" title="Estado del equipo" alt="' . $st . '"/>';
                        $row[] = $aRow[$aColumns[$i]];
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc prm_c" title="Modificar" alt="Modificar" onclick="modifica_equipo(\'' . $id . '\')"/>
                      <img src="images/eliminar.png" class="opc prm_b" title="Eliminar" alt="Eliminar" onclick="elimina_equipo(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function getEquipo() {
        $this->load->model("equipos_model");
        $numSer = $this->input->Post("id"); //obtengo por medio de post el valor de num_per
        $rows = $this->equipos_model->getequipo($numSer);
        foreach ($rows->result() as $row) {
            $jsondata['ns'] = $row->NumeroSerie;
            $jsondata['ma'] = $row->Marca;
            $jsondata['mo'] = $row->Modelo;
            $jsondata['ni'] = $row->NumeroInventario;
            $jsondata['pr'] = $row->Procesador;
            $jsondata['dd'] = $row->DiscoDuro;
            $jsondata['ram'] = $row->RAM;
            $jsondata['edo'] = $row->Estado;
        }
        echo json_encode($jsondata);
    }

    function eliminaEquipo() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login){
            redirect('acceso/acceso_denegado');
        }
        $this->load->model("equipos_model");
        $numSer = $this->input->Post("id");
        $sepudo = $this->equipos_model->elimina_equipo($numSer);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el equipo con el N&uacute;mero de Serie: <b>$numSer</b>.";
    }

    function agregaEquipo() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login){
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('equipos_model');
        $numSer = $this->input->Post("numser");
        $marca = $this->input->Post("marca");
        $modelo = $this->input->Post("modelo");
        $numInv = $this->input->Post("numinv");
        $procesador = $this->input->Post("procesador");
        $disco = $this->input->Post("disco");
        $ram = $this->input->Post("ram");
        $sepudo = $this->equipos_model->agrega_equipo($numSer, $marca, $modelo, $numInv, $procesador, $disco, $ram);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el Equipo.";
    }

    function modificaEquipo() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login){
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('equipos_model');
        $numSer = $this->input->Post("m_numser");
        $marca = $this->input->Post("m_marca");
        $modelo = $this->input->Post("m_modelo");
        $numInv = $this->input->Post("m_numinv");
        $procesador = $this->input->Post("m_procesador");
        $disco = $this->input->Post("m_disco");
        $ram = $this->input->Post("m_ram");
        $edo = $this->input->Post("m_edo");
        $sepudo = $this->equipos_model->modifica_equipo($numSer, $marca, $modelo, $numInv, $procesador, $disco, $ram, $edo);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del equipo con el número de serie: <b>$numSer</b>.";
    }

    function actualizaStatusEquipo() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login){
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('equipos_model');
        $numSer = $this->input->Post("id");
        $st = $this->input->Post("st");
        $sepudo = $this->equipos_model->actualiza_st_equipo($numSer, $st);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del equipo con el numSer <b>$numSer</b>.";
    }

    function dateToMysql($f) {
        $fechaMySQL = substr($f, 6, 4) . '-' . substr($f, 3, 2) . '-' . substr($f, 0, 2);
        return $fechaMySQL;
    }

    function maxNumCred() {
        $this->load->model('sql_generico_model');
        $numax = $this->sql_generico_model->getMax('num_cred', 'equipos');
        $row = $numax->row_array(0);
        $jsondata['max'] = $row['nmax'];
        echo json_encode($jsondata);
    }
    
    public function getSos2Equipo($numserie) {
        $this->load->model('equipos_model');
        $software_equipo = $this->equipos_model->getsos2equipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $jsondata[$i]['so'] = $row->so;
            $i++;
        }
        echo json_encode($jsondata);
    }
    
    public function getDetallesEquipo($numserie) {
        $this->load->model('equipos_model');
        $software_equipo = $this->equipos_model->getdetallesequipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $jsondata[$i]['so'] = $row->so;
            $i++;
        }
        echo json_encode($jsondata);
    }
    
    public function getSoftwareEquipo($numserie) {
        $this->load->model('equipos_model');
        $software_equipo = $this->equipos_model->getSoftwareEquipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $jsondata[$i]['sw'] = $row->software;
            $jsondata[$i]['so'] = $row->so;
            $i++;
        }
        echo json_encode($jsondata);
    }

}

