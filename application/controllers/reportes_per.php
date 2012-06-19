<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes_per extends CI_Controller {

    public function index() {
        $this->load->model("Reportes_model");
        $this->load->model("salas_model");
        $data['titulo_pag'] = "Reportes - CCFEI";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/highcharts/highcharts.js"></script>' . PHP_EOL .
                $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/highcharts/modules/exporting.js"></script>' . PHP_EOL;
        $contenido['datos'] = $this->Reportes_model->datosReserv();
        
        $data['contenido'] = $this->load->view('Reportes_per_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function datosActividades() {
        $aColumns = array('idActividad', 'Actividad', 'NombreCorto', 'TipoActividad', 'Color', 'FechaInicio', 'FechaFin');
        $sIndexColumn = "idActividad";
        $sTable = "actividades";
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
                        $row[] = "<div id='c_$id' onclick=\"cambia_color($id,'" . $aRow[$aColumns[$i]] . "',$(this));\"class=\"color_actividad glass manita color_$id\"><div>";
                        $row[] = $aRow[$aColumns[$i]];
                    } else {
                        if ($aColumns[$i] == "TipoActividad") {
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
            $row[] = '<img src="images/modificar.png" class="opc" title="Modificar" alt="Modificar" onclick="modifica_actividad(\'' . $id . '\',\'' . $color . '\',$(\'#c_' . $id . '\'))"/>
                      <img src="images/eliminar.png" class="opc" title="Eliminar" alt="Eliminar" onclick="elimina_actividad(\'' . $id . '\')"/>
                      <img src="images/users.png" class="opc" title="Asignar a cated&aacute;tico" alt="Asignar" onclick="asignar_actividad(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function getActividades() {
        $this->load->model("Reportes_per_model");
        $login = $this->input->Post("id"); //obtengo por medio de post el valor de num_per
        $rows = $this->Reportes_per_model->getActividades($login);
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

    function cambiaColor() {
        $this->load->model("Reportes_per_model");
        $id = $this->input->Post("id");
        $color = $this->input->Post("color");
        $sepudo = $this->Reportes_per_model->cambiacolor($id, $color);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar la actividad.";
    }

    function eliminaActividad() {
        $this->load->model("Reportes_per_model");
        $id = $this->input->Post("id");
        $sepudo = $this->Reportes_per_model->elimina_actividad($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar la actividad.";
    }

    function desasignaActividad() {
        $this->load->model("Reportes_per_model");
        $id = $this->input->Post("id");
        $sepudo = $this->Reportes_per_model->desasigna_actividad($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar la actividad.";
    }

    function agregaActividad() {
        $this->load->model('Reportes_per_model');
        $nombre = $this->input->Post("nombre");
        $nombre_corto = $this->input->Post("nombre_corto");
        $tipo_act = $this->input->Post("tipo_act");
        $hoy = date("Y-m-d");
        $color = $this->input->Post("color");
        if (isset($tipo_act) && $tipo_act == 0) {
            $f1 = $this->config->item('fecha_periodo_inicio');
            $f2 = $this->config->item('fecha_periodo_fin');
        } elseif (isset($tipo_act) && $tipo_act == 1) {
            $fechaInicio = $this->input->Post("fecha1");
            $fechaFin = $this->input->Post("fecha2");
            $f1 = substr($fechaInicio, 6, 4) . '-' . substr($fechaInicio, 3, 2) . '-' . substr($fechaInicio, 0, 2);
            $f2 = substr($fechaFin, 6, 4) . '-' . substr($fechaFin, 3, 2) . '-' . substr($fechaFin, 0, 2);
        } else {
            $f1 = $hoy;
            $f2 = $hoy;
        }
        $sepudo = $this->Reportes_per_model->agrega_actividad($nombre, $nombre_corto, $tipo_act, $color, $f1, $f2);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar la Actividad.";
    }

    function asignaActividad() {
        $this->load->model('Reportes_per_model');
        $id_act = $this->input->Post("id_act");
        $catedratico = $this->input->Post("catedraticos");
        $bloque = $this->input->Post("bloque_act");
        $seccion = $this->input->Post("seccion_act");
        $sepudo = $this->Reportes_per_model->asigna_actividad($id_act, $catedratico, $bloque, $seccion);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar la Actividad.";
    }

    function modificaActividad() {
        $this->load->model('Reportes_per_model');
        $id = $this->input->Post("id_act");
        $nombre = $this->input->Post("m_nombre");
        $nombre_corto = $this->input->Post("m_nombre_corto");
        $color = $this->input->Post("m_color");
        $sepudo = $this->Reportes_per_model->modifica_actividad($id, $nombre, $nombre_corto, $color);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al modificar la Actividad.";
    }

    function actualizaStatusActividades() {
        $this->load->model('Reportes_per_model');
        $login = $this->input->Post("id");
        $st = $this->input->Post("st");
        $sepudo = $this->Reportes_per_model->actualiza_st_actividades($login, $st);
        if ($sepudo)
            echo 'ok'; else
            echo "Error al actualizar el estado del actividades con el login <b>$login</b>.";
    }

    function getActividad() {
        $this->load->model("Reportes_per_model");
        $id = $this->input->Post("id");
        $rows = $this->Reportes_per_model->getactividad($id);
        foreach ($rows->result() as $row) {
            $jsondata['no'] = $row->Actividad;
            $jsondata['nc'] = $row->NombreCorto;
            $jsondata['cl'] = $row->Color;
            $jsondata['ta'] = $row->TipoActividad;
        }
        echo json_encode($jsondata);
    }

    /* function desasignaActividadCatedratico() {
      $this->load->model("Reportes_per_model");
      $id = $this->input->Post("id");
      $rows = $this->Reportes_per_model->getactividad($id);
      foreach ($rows->result() as $row) {
      $jsondata['no'] = $row->Actividad;
      $jsondata['nc'] = $row->NombreCorto;
      $jsondata['cl'] = $row->Color;
      $jsondata['ta'] = $row->Curso;
      }
      echo json_encode($jsondata);
      } */

    function getCatedraticosActividad() {
        $this->load->model("Reportes_per_model");
        $id = $this->input->Post("idact");
        $rows = $this->Reportes_per_model->getcatedraticosactividad($id);
        $i = 0;
        foreach ($rows->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
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

