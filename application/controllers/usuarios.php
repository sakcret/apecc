<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function index() {
        $this->load->model("usuarios_model");
        $data['titulo_pag'] = "GESTI&Oacute;N DE USUARIOS - CCFEI";
        $contenido['tipos_u_rows'] = $this->usuarios_model->getTipos();
        $data['contenido'] = $this->load->view('usuarios_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function datosUsuarios() {
        $aColumns = array('login', 'matricula', 'nombrecompleto', 'tipousuario', 'fechacreacion', 'expira', 'estatus');
        $sIndexColumn = "login";
        $sTable = "datos_usuarios";
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
            $row['DT_RowId'] = 'row_'.$aRow[$sIndexColumn];
            $row['DT_RowClass'] = 'gradeA';
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == $sIndexColumn) {
                    $id = $aRow[$aColumns[$i]];
                    $row[] = $aRow[$aColumns[$i]];
                } else {
                    if ($aColumns[$i] == "estatus") {
                        $st = $aRow[$aColumns[$i]];
                        if ($st == 'Actualizado') {
                            $row[] = '<img src="images/status_actualizado.png" cambia_edo="0" id="' . $id . '" class="opc" title="Cambiar Estatus" alt="' . $st . '" onclick="actualiza_usuario($(\'#' . $id . '\'),\'' . $id . '\')"/>';
                        } else {
                            $row[] = '<img src="images/status_no_actualizado.png" cambia_edo="1" id="' . $id . '" class="opc" title="Cambiar Estatus" alt="' . $st . '" onclick="actualiza_usuario($(\'#' . $id . '\'),\'' . $id . '\')"/>';
                        }
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc" title="Modificar" alt="Modificar" onclick="modifica_usuario(\'' . $id . '\')"/>
                      <img src="images/eliminar.png" class="opc" title="Eliminar" alt="Eliminar" onclick="elimina_usuario(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function getUsuario() {
        $this->load->model("usuarios_model");
        $login = $this->input->Post("id"); //obtengo por medio de post el valor de num_per
        $rows = $this->usuarios_model->getUsuario($login);
        foreach ($rows->result() as $row) {
            $jsondata['lo'] = $row->login;
            $jsondata['ma'] = $row->matricula;
            $jsondata['no'] = $row->nombre;
            $jsondata['ap'] = $row->paterno;
            $jsondata['am'] = $row->materno;
            $jsondata['nc'] = $row->num_cred;
            $jsondata['tu'] = $row->idtipo;
            $jsondata['st'] = $row->actualiza;
        }
        echo json_encode($jsondata);
    }

    function eliminaUsuario() {
        $this->load->model("usuarios_model");
        $login = $this->input->Post("id");
        $sepudo = $this->usuarios_model->elimina_usuario($login);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el usuario con el login: <b>$login</b>.";
    }

    function agregaUsuario() {
        $this->load->model('usuarios_model');
        $login = $this->input->Post("login");
        $matricula = $this->input->Post("matricula");
        $numpersonal = $this->input->Post("numepersonal");
        $esmaestro = $this->input->Post("esmaestro");
        $nombre = $this->input->Post("nombre");
        $apaterno = $this->input->Post("apaterno");
        $amaterno = $this->input->Post("amaterno");
        $tipou = $this->input->Post("tipo_u");
        $ncredencial = $this->input->Post("ncredencial");
        $fechacreacion = date('Y-m-d');
        $fechaexpira = $this->config->item("fecha_periodo_fin");
       if ($esmaestro=='si') {
            $matricula=NULL;
        }
        $sepudo = $this->usuarios_model->agrega_usuario($login, $matricula, $nombre, $apaterno, $amaterno, $tipou, $ncredencial, $fechacreacion, $fechaexpira,$numpersonal,$esmaestro);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el Usuario.";
    }

    function modificaUsuario() {
        $this->load->model('usuarios_model');
        $login = $this->input->Post("m_login");
        $matricula = $this->input->Post("m_matricula");
        $esmaestro = $this->input->Post("esmaestro");
        $nombre = $this->input->Post("m_nombre");
        $apaterno = $this->input->Post("m_apaterno");
        $amaterno = $this->input->Post("m_amaterno");
        $actualiza = $this->input->Post("estatus");
        if ($esmaestro=='si') {
            $matricula=NULL;
        }
        $sepudo = $this->usuarios_model->modifica_usuario($login, $matricula, $nombre, $apaterno, $amaterno, $actualiza,$esmaestro);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del usuario con el login <b>$login</b>.";
        
    }

    function actualizaStatusUsuario() {
        $this->load->model('usuarios_model');
        $login = $this->input->Post("id");
        $st = $this->input->Post("st");
        $sepudo = $this->usuarios_model->actualiza_st_usuario($login, $st);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del usuario con el login <b>$login</b>.";
    }

    function dateToMysql($f) {
        $fechaMySQL = substr($f, 6, 4) . '-' . substr($f, 3, 2) . '-' . substr($f, 0, 2);
        return $fechaMySQL;
    }

    function maxNumCred() {
        $this->load->model('sql_generico_model');
        $numax = $this->sql_generico_model->getMax('num_cred', 'usuarios');
        $row = $numax->row_array(0);
        $jsondata['max'] = $row['nmax'];
        echo json_encode($jsondata);
    }
    
    function getUsuariosAcademicos(){
        $this->load->model('usuarios_model');
        $datos = $this->usuarios_model->getacademicos();
        $u = '';
        foreach ($datos as $r) {
            $u .= "<option value='" . $r['num_per'] . "'> " . $r['academico'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

}

