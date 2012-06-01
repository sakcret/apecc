<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ubicacion_equipos extends CI_Controller {

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
            $rec = $this->config->item('clvp_ubicacion_equipos');
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
        $this->load->model('reservaciones_temporales_model');
        $this->load->model('salas_model');
        $this->load->model('equipos_model');
        $contenido['titulo_pag'] = "UBICACI&Oacute;N DE EQUIPOS";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/redips-drag.js"></script>' . PHP_EOL;
        $contenido['salas'] = $this->salas_model->datos_salas();
        $contenido['equipos_salas'] = $this->reservaciones_temporales_model->equipos_salas();
        $data['contenido'] = $this->load->view('ubicacion_equipos_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function datosEquiposAlmacen() {
        $sIndexColumn = "NumeroSerie";
        $aColumns = array($sIndexColumn, 'Marca', 'Modelo', 'Procesador', 'RAM', 'DiscoDuro', 'Estado');
        $sTable = "almacen";
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . mysql_real_escape_string($_GET['iDisplayStart']) . ", " .
                    mysql_real_escape_string($_GET['iDisplayLength']);
        }
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
				 	" . mysql_real_escape_string($_GET['sSortDir_' . $i]) . ", ";
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
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch']) . "%' OR ";
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
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysql_real_escape_string($_GET['sSearch_' . $i]) . "%' ";
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
        $numeroSerie = $edo = '';
        for ($x = 0; $x < $rResult->num_rows(); $x++) {
            $aRow = $rResult->row_array($x);
            $row = array();
            //$row['DT_RowId'] = 'row_' . $aRow[$sIndexColumn];
            //$row['DT_RowClass'] = 'gradeA';
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == $sIndexColumn) {
                    $numeroSerie = $aRow[$aColumns[$i]];
                    $row[] = $aRow[$aColumns[$i]];
                } else {
                    if ($aColumns[$i] == "Estado") {
                        $edo = $aRow[$aColumns[$i]];
                        $row[] = $aRow[$aColumns[$i]];
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $row[] = '<div id="' . $numeroSerie . '" align="center" class="mark blank drag drgst">
                <img class="img_resize" src="./images/pc_edos/pc_' . $edo . '.png"/>
                <div>' . $numeroSerie . '</div></div>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function datosEquiposAlmacenJson() {
        $this->load->model('ubicacion_equipos_model');
        $rows = $this->ubicacion_equipos_model->getequiposalmacenjson();
        if ($rows->num_rows() > 0) {
            $i=0;
            foreach ($rows->result() as $row) {
                $jsondata[$i]['ns'] = $row->NumeroSerie;
                $jsondata[$i]['ma'] = $row->Marca;
                $jsondata[$i]['mo'] = $row->Modelo;
                $jsondata[$i]['pr'] = $row->Procesador;
                $jsondata[$i]['rm'] = $row->RAM;
                $jsondata[$i]['dd'] = $row->DiscoDuro;
                $jsondata[$i]['ed'] = $row->Estado;
                $i++;
            }
            echo json_encode($jsondata);
        } else {
            echo false;
        }
    }

    function actualizarSalaEquipo() {
        $idsala = $this->input->Post('id_sala');
        $p = @$_REQUEST['p'];
        list($numeroSerie, $tbl1, $fila1, $columna1, $tbl0, $fila0, $columna0) = explode('_', $p);
        $this->load->model('ubicacion_equipos_model');
        if ($tbl0 == 1) {
            $sepudo = $this->ubicacion_equipos_model->ubicar_equipo($numeroSerie, $fila1, $columna1, ((int) $idsala));
        } else {
            if(($columna0!=0)&&($columna1!=0)&&($fila0!=0)&&($fila1!=0)){
                $sepudo = $this->ubicacion_equipos_model->reubicar_equipo($fila1, $columna1, $numeroSerie, $fila0, $columna0, ((int) $idsala));
            }
        }
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al ubicar el equipo.Revise que el movimiento hecho sea v&aacute;lido.<br>Por favor recarge la p&aacute;gina.";
    }

    function moverAlmacen() {
        $idsala = $this->input->Post('id_sala');
        $p = @$_REQUEST['p'];
        list($numeroSerie, $row, $col) = explode('_', $p);
        $this->load->model('ubicacion_equipos_model');
        if (is_numeric($row) && is_numeric($col) && is_numeric((int) $idsala)) {
            $sepudo = $this->ubicacion_equipos_model->mover_almacen($numeroSerie, $row, $col, (int) $idsala);
        }
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al mover el equipo al almac&eacute;n.";
    }

    function moverAlmacenTodos() {
        $idsala = $this->input->Post('id_sala');
        $this->load->model('ubicacion_equipos_model');
        $sepudo = $this->ubicacion_equipos_model->mover_almacen_todos($idsala);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al mover los equipos al almac&eacute;n.";
    }

}
