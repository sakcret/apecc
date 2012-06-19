<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reservaciones_salas extends CI_Controller {

    public function index() {
        $this->load->model('reservaciones_salas_model');
        $this->load->model('salas_model');
        //setlocale(LC_TIME, 'es_MX');
        setlocale(LC_TIME, 'Spanish');
        $contenido['titulo_pag'] = "RESERVACIONES DE SALA";
        $data['contenido'] = $this->load->view('reservaciones_salas_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    function datosReservSalas() {
        $sIndexColumn = "IdReservSala";
        $aColumns = array($sIndexColumn, 'Sala', 'NombreActividad', 'encargado', 'FechaInicio', 'FechaFin', 'HoraInicio', 'HoraFin');
        $sTable = "datos_reservsalas";
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
            $row[] = '<img src="images/modificar.png" class="opc" title="Modificar Reservaci&oacute;n de sala" alt="Modificar Reservaci&oacute;n de Sala" onclick="modifica_reservacion(\'' . $id . '\',\'' . $color . '\',$(\'#c_' . $id . '\'))"/>
                      <img src="images/eliminar.png" class="opc" title="Cancelar Reservaci&oacute;n de sala" alt="Cancelar Reservaci&oacute;n de Sala" onclick="cancelar_reservacion(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function agregaReservacion() {
        $sala = $this->input->post('sala');
        $actividad = $this->input->post('nombre_act');
        $encargado = $this->input->post('encargado');
        $hora_inicio = $this->input->post('hora_inicio');
        $hora_fin = $this->input->post('hora_fin');
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
        $fecha_inicio = substr($fecha_inicio, 6, 4) . '-' . substr($fecha_inicio, 3, 2) . '-' . substr($fecha_inicio, 0, 2);
        $fecha_fin = substr($fecha_fin, 6, 4) . '-' . substr($fecha_fin, 3, 2) . '-' . substr($fecha_fin, 0, 2);
        $this->load->model('reservaciones_salas_model');
        $sepudo = $this->reservaciones_salas_model->agrega_resevacion($sala, $actividad, $encargado, $hora_inicio, $hora_fin, $fecha_inicio, $fecha_fin);
        if ($sepudo) {
            echo 'ok';
        } else {
            echo 'Error al agregar la reservaci&oacute;n de la sala.';
        }
    }

    function modificaReservacion() {
        $idreserv = $this->input->post('id');
        $sala = $this->input->post('m_sala');
        $actividad = $this->input->post('m_nombre_act');
        $encargado = $this->input->post('m_encargado');
        $hora_inicio = $this->input->post('m_hora_inicio');
        $hora_fin = $this->input->post('m_hora_fin');
        $fecha_inicio = $this->input->post('m_fecha_inicio');
        $fecha_fin = $this->input->post('m_fecha_fin');
        $fecha_inicio = substr($fecha_inicio, 6, 4) . '-' . substr($fecha_inicio, 3, 2) . '-' . substr($fecha_inicio, 0, 2);
        $fecha_fin = substr($fecha_fin, 6, 4) . '-' . substr($fecha_fin, 3, 2) . '-' . substr($fecha_fin, 0, 2);
        $this->load->model('reservaciones_salas_model');
        $sepudo = $this->reservaciones_salas_model->modifica_resevacion($idreserv, $sala, $actividad, $encargado, $hora_inicio, $hora_fin, $fecha_inicio, $fecha_fin);
        if ($sepudo) {
            echo 'ok';
        } else {
            echo 'Error al actualizar la reservaci&oacute;n de la sala.';
        }
    }

    public function cancelarReservacion() {
        $idreserv = $this->input->post('id');
        $this->load->model('reservaciones_salas_model');
        $sepudo = $this->reservaciones_salas_model->cancelar_resevacion($idreserv);
        if ($sepudo) {
            echo 'ok';
        } else {
            echo 'Error al cancelar la reservaci&oacute;n de sala.';
        }
    }

    //funcion que devuelve los usuarios en forma de <option></option> para el combo de usuarios filtrados
    //por el tipo de usuario seleccionado ademas de seleccionar solo aquellos donde el campo actualiza=1
    function getSalas() {
        $this->load->model('reservaciones_salas_model');
        $users = $this->reservaciones_salas_model->getsalas();
        $u = '';
        foreach ($users as $r) {
            $u .= "<option value='" . $r['id'] . "'> " . $r['sala'] . "</option>" . PHP_EOL;
        }
        echo $u;
    }

    function getDatosReserv() {
        $this->load->model("reservaciones_salas_model");
        $idreserv = $this->input->Post("id"); 
        $rows = $this->reservaciones_salas_model->getdatosreserv($idreserv);
        foreach ($rows->result() as $row) {
            $jsondata['no'] = $row->NombreActividad;
            $jsondata['hi'] = $row->HoraInicio;
            $jsondata['hf'] = $row->HoraFin;
            $jsondata['fi'] = $row->FechaInicio;
            $jsondata['ff'] = $row->FechaFin;
            $jsondata['sa'] = $row->idSala;
            $jsondata['ec'] = $row->NumeroPersonal;
        }
        echo json_encode($jsondata);
    }

}

?>
