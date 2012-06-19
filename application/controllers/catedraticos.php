<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catedraticos extends CI_Controller {

    public function index() {
        $this->load->model("catedraticos_model");
        $data['titulo_pag'] = "GESTI&Oacute;N DE CATEDR&Aacute;TICOS - CCFEI";
        $contenido['include'] = '' ;
        $data['contenido'] = $this->load->view('catedraticos_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function datosCatedraticos() {
        $aColumns = array('idCatedratico', 'Catedratico', 'NombreCorto', 'Curso', 'Color');
        $sIndexColumn = "idCatedratico";
        $sTable = "catedraticos";
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
                $sWhere .= $aColumns[$i] . " LIKE '%" .$_GET['sSearch_' . $i]. "%' ";
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
        $id = $st = $color = '';
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
                    if ($aColumns[$i] == "Color") {
                        $color = $aRow[$aColumns[$i]];
                        $row[] = "<div onclick=\"cambia_color($id,'" . $aRow[$aColumns[$i]] . "');\"class=\"color_catedratico glass manita color_$id\"><div>";
                        $row[] = $aRow[$aColumns[$i]];
                    } else {
                        if ($aColumns[$i] == "Curso") {
                            if ($aRow[$aColumns[$i]] == 0) {
                                $row[] = 'Experiencia Educativa';
                            } else {
                                $row[] = 'Curso';
                            }
                        } else {
                            $row[] = $aRow[$aColumns[$i]];
                        }
                    }
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc" title="Modificar" alt="Modificar" onclick="modifica_catedratico(\'' . $id . '\',\'' . $color . '\')"/>
                      <img src="images/eliminar.png" class="opc" title="Eliminar" alt="Eliminar" onclick="elimina_catedratico(\'' . $id . '\')"/>
                      <img src="images/users.png" class="opc" title="Asignar a cated&aacute;tico" alt="Asignar" onclick="asignar_catedratico(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function getCatedraticosSelect() {
        $this->load->model("catedraticos_model"); 
        $rows = $this->catedraticos_model->getcatedraticosselect();
        $u = '';
        foreach ($rows  as $r) {
            $u .= "<option value='" . $r['NumeroPersonal'] . "'> " . $r['nombre'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

    function eliminaCatedratico() {
        $this->load->model("catedraticos_model");
        $id = $this->input->Post("id");
        $sepudo = $this->catedraticos_model->elimina_catedratico($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar la catedratico.";
    }

    function agregaCatedratico() {
        $this->load->model('catedraticos_model');
        $nombre = $this->input->Post("nombre");
        $nombre_corto = $this->input->Post("nombre_corto");
        $tipo_act = $this->input->Post("tipo_act");
        $color = $this->input->Post("color");
        $sepudo = $this->catedraticos_model->agrega_catedratico($nombre, $nombre_corto, $tipo_act, $color);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar la Catedratico.";
    }

    function modificaCatedratico() {
        $this->load->model('catedraticos_model');
        $id = $this->input->Post("id_act");
        $nombre = $this->input->Post("m_nombre");
        $nombre_corto = $this->input->Post("m_nombre_corto");
        $tipo_act = $this->input->Post("m_tipo_act");
        $color = $this->input->Post("m_color");
        $sepudo = $this->catedraticos_model->modifica_catedratico($id, $nombre, $nombre_corto, $tipo_act, $color);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al modificar la Catedratico.";
    }

    function actualizaStatusCatedraticos() {
        $this->load->model('catedraticos_model');
        $login = $this->input->Post("id");
        $st = $this->input->Post("st");
        $sepudo = $this->catedraticos_model->actualiza_st_catedraticos($login, $st);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del catedraticos con el login <b>$login</b>.";
    }

    function getCatedratico() {
        $this->load->model("catedraticos_model");
        $id = $this->input->Post("id");
        $rows = $this->catedraticos_model->getcatedratico($id);
        foreach ($rows->result() as $row) {
            $jsondata['no'] = $row->Catedratico;
            $jsondata['nc'] = $row->NombreCorto;
            $jsondata['cl'] = $row->Color;
            $jsondata['ta'] = $row->Curso;
        }
        echo json_encode($jsondata);
    }

    function getCatedraticosCatedratico() {
        $this->load->model("catedraticos_model");
        $id = $this->input->Post("idact");
        $rows = $this->catedraticos_model->getcatedraticoscatedratico($id);
        $i = 0;
        foreach ($rows->result() as $row) {
            $jsondata[$i]['np'] = $row->NumeroPersonal;
            $jsondata[$i]['no'] = $row->Nombre;
            $jsondata[$i]['lo'] = $row->Login;
            $jsondata[$i]['bq'] = $row->Bloque;
            $jsondata[$i]['se'] = $row->Seccion;
            $i++;
        }
        echo json_encode($jsondata);
    }

}

