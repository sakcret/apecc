<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Software extends CI_Controller {

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
            $rec = $this->config->item('clvp_software');
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
        //$this->load->model("software_model");
        $data['titulo_pag'] = "ADMINISTRACI&Oacute;N DE SOFTWARE - CCFEI";
        $data['contenido'] = $this->load->view('software_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    function datosGruposSW() {
        $aColumns = array('idGrupo', 'nombre', 'descripcion', 'so');
        $sIndexColumn = "idGrupo";
        $sTable = "datos_grupo_software";
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
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc prm_c" title="Modificar" alt="Modificar" onclick="modifica_gruposw(\'' . $id . '\')"/>
                      <img src="images/eliminar.png" class="opc prm_b" title="Eliminar" alt="Eliminar" onclick="elimina_gruposw(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    public function datosSoftware() {
        $sIndexColumn = "idSoftware";
        $aColumns = array($sIndexColumn, 'software', 'version', 'descripcion', 'sistemaOperativo', 'idso');
        $sTable = "datos_software";
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
        $nombresw=$idso = $id = $st = $color = '';
        for ($x = 0; $x < $rResult->num_rows(); $x++) {
            $aRow = $rResult->row_array($x);
            $row = array();
            $row['DT_RowId'] = 'row_' . $aRow[$sIndexColumn];
            $row['DT_RowClass'] = 'gradeA';
            for ($i = 0; $i < count($aColumns); $i++) {
                if($aColumns[$i] =='software'){
                    $nombresw= $aRow[$aColumns[$i]];
                }
                if ($aColumns[$i] == $sIndexColumn) {
                    $id = $aRow[$aColumns[$i]];
                    $row[] = $aRow[$aColumns[$i]];
                } else {
                    if ($aColumns[$i] == 'idso') {
                        $idso = $aRow[$aColumns[$i]];
                        $row[] = $aRow[$aColumns[$i]];
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc prm_c" title="Modificar" alt="Modificar" onclick="modifica_software(\'' . $id . '\',\'' . $color . '\',$(\'#c_' . $id . '\'))"/>
                      <img src="images/eliminar.png" class="opc prm_b" title="Eliminar" alt="Eliminar" onclick="elimina_software(\'' . $id . '\')"/>
                      <img src="images/asigna.ico" class="opc prm_s" title="Asignar un grupo de software" alt="Asignar grupo" onclick="asigna_grupo(\'' . $id . '\',\'' . $idso . '\',\'' . $nombresw . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function datosSO() {
        $sIndexColumn = "idSistemaOperativo";
        $aColumns = array($sIndexColumn, 'sistemaOperativo');
        $sTable = "sistemasoperativos";
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
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc prm_c" title="Modificar" alt="Modificar" onclick="modifica_so(\'' . $id . '\')"/>
                      <img src="images/eliminar.png" class="opc prm_b" title="Eliminar" alt="Eliminar" onclick="elimina_so(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }
    
    function agregaSO() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $so = $this->input->Post("nombre_so");
        $sepudo = $this->software_model->agrega_so($so);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el sistema operativo";
    }
    
    function modificaSO() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $so = $this->input->Post("m_nombre_so");
        $idso = $this->input->Post("idso");
        $sepudo = $this->software_model->modifica_so($idso,$so);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al modificar el sistema operativo";
    }
    
    function asignaGrupoSW() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $grupo = $this->input->Post("grupos_sw");
        $idsw = $this->input->Post("idsw");
        $sepudo = $this->software_model->asigna_grupo($idsw, $grupo);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al asignar el Software.";
    }
    
    function desasignaGrupoSW() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $idgru = $this->input->Post("idgru");
        $idsw = $this->input->Post("idsw");
        $sepudo = $this->software_model->desasigna_grupo($idsw, $idgru);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al desasignar el Software.";
    }

    function eliminaSoftware() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $sepudo = $this->software_model->elimina_software($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el software.";
    }
    
    function eliminaSO() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $sepudo = $this->software_model->elimina_so($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el sistema operativo.";
    }
    
    function eliminaGrupo() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $sepudo = $this->software_model->elimina_grupo($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el grupo de software.";
    }

    function agregaSoftware() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $nombre = $this->input->Post("nombre_sw");
        $version = $this->input->Post("version_sw");
        $descripcion = $this->input->Post("descripcion_sw");
        $so = $this->input->Post("so_sw");
        $sepudo = $this->software_model->agrega_software($nombre, $version, $descripcion, $so);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el Software.";
    }
    
    function agregaGrupo() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $nombre = $this->input->Post("nombre_grupo");
        $descripcion = $this->input->Post("descripcion_grupo");
        $so = $this->input->Post("so_grupo");
        $sepudo = $this->software_model->agrega_grupo($nombre, $descripcion, $so);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el Software.";
    }
    
    function modificaGrupo() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $id = $this->input->Post("idgru");
        $nombre = $this->input->Post("m_nombre_grupo");
        $descripcion = $this->input->Post("m_descripcion_grupo");
        //$so = $this->input->Post("so_grupo");
        $sepudo = $this->software_model->modifica_grupo($id,$nombre, $descripcion);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el Software.";
    }

    function modificaSoftware() {
         //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model('software_model');
        $id = $this->input->Post("id");
        $nombre = $this->input->Post("m_nombre_sw");
        $version = $this->input->Post("m_version_sw");
        $descripcion = $this->input->Post("m_descripcion_sw");
        $so = $this->input->Post("m_so_sw");
        $sepudo = $this->software_model->modifica_software($id, $nombre, $version, $descripcion, $so);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al modificar el Software.";
    }
    
    function getDatosSW() {
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $rows = $this->software_model->getsoftware($id);
        foreach ($rows->result() as $row) {
            $jsondata['nom'] = $row->software;
            $jsondata['ver'] = $row->version;
            $jsondata['des'] = $row->descripcion;
            $jsondata['so'] = $row->idSistemaOperativo;
        }
        echo json_encode($jsondata);
    }
    
    function getDatosGrupo() {
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $rows = $this->software_model->getgrupo($id);
        foreach ($rows->result() as $row) {
            $jsondata['nom'] = $row->nombre;
            $jsondata['des'] = $row->descripcion;
        }
        echo json_encode($jsondata);
    }
    
    function getDatosSO() {
        $this->load->model("software_model");
        $id = $this->input->Post("id");
        $rows = $this->software_model->get_datos_so($id);
        foreach ($rows->result() as $row) {
            $jsondata['nom'] = $row->sistemaOperativo;
        }
        echo json_encode($jsondata);
    }

    function getGruposSW() {
        $this->load->model('software_model');
        $idso = $this->input->post('idso');
        $u = '';
        if ($idso != 0) {
            $datos = $this->software_model->getgrupossw($idso);
            foreach ($datos as $r) {
                $u .= "<option value='" . $r['id'] . "'> " . $r['grupo'] . "</option>" . PHP_EOL;
            }
        }
        echo $u;
    }

    function getGruposxsw() {
        $this->load->model('software_model');
        $idsw = $this->input->post('idsw');
        $jsondata = false;
        if ($idsw != 0) {
            $rows = $this->software_model->getgruposxsw($idsw);
            if ($rows->num_rows()) {
                $i = 0;
                foreach ($rows->result() as $row) {
                    $jsondata[$i]['idgru'] = $row->id;
                    $jsondata[$i]['gru'] = $row->grupo;
                    $jsondata[$i]['idsw'] = $idsw;
                    $i++;
                }
            }
        }
        echo json_encode($jsondata);
    }

    function getSistemasSW() {
        $this->load->model('software_model');
        $datos = $this->software_model->getsistemassw();
        $u = '';
        foreach ($datos as $r) {
            $u .= "<option value='" . $r['id'] . "'> " . $r['so'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

}

