<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes_per extends CI_Controller {

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
            $rec = $this->config->item('clvp_reportes_per');
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
        $this->load->model("reportes_model");
        $this->load->model("salas_model");
        $this->load->model("actividades_model");
        $this->load->model("usuarios_model");
        $this->load->model("equipo_software_model");
        $this->load->library("utl_apecc");
        $data['titulo_pag'] = "REPORTES - CCFEI";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/highcharts/highcharts.js"></script>' . PHP_EOL .
                '<script type="text/javascript" language="javascript" src="./js/highcharts/modules/exporting.js"></script>' . PHP_EOL;

        $contenido['datos_salas'] = $this->salas_model->datos_salas();
        $contenido['tipos_u_rows'] = $this->usuarios_model->getTipos();
        $contenido['datos_actividades'] = $this->actividades_model->getActividades_cpt();
        $contenido['datos_sistemasop'] = $this->equipo_software_model->get2Sos();
        $data['contenido'] = $this->load->view('reportes_per_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    function reporte_uso_per() {
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');

        $titulo = $this->input->Post("nom_rep_res");
        $titulo_rep = 'Reporte de Uso en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $f1 = $this->input->Post("fecha_inicio_r1");
        $f2 = $this->input->Post("fecha_fin_r1");
        if ($f1 != '' && $f2 != '') {
            $fecha_inicio = $this->utl_apecc->getSQL_date($f1);
            $fecha_fin = $this->utl_apecc->getSQL_date($f2);
            $titulo_rep.='(Periodo ' . $fecha_inicio . '-' . $fecha_fin . ')';
        } else {
            $fecha_inicio = $fecha_fin = '';
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $sala = $this->input->Post("sala");
        $tipoact = $this->input->Post("tipo_act");
        $detalle_act = $this->input->Post("detalle_act");
        $data_head['titulo_rep'] = '<h3>Reporte de Uso del Centro de Computo</h3>';
        $contenido['datos_reservaciones'] = $this->reportes_model->datosUsoCC($fecha_inicio, $fecha_fin, $sala, $tipoact, $detalle_act);
        $vista = $this->load->view('reportes/uso_personalizado', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }

    function reporte_usoxls() {
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_res"];
        $titulo_rep = 'Reporte de Uso en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $f1 = $_GET["fecha_inicio_r1"];
        $f2 = $_GET["fecha_fin_r1"];
        if ($f1 != '' && $f2 != '') {
            $fecha_inicio = $this->utl_apecc->getSQL_date($f1);
            $fecha_fin = $this->utl_apecc->getSQL_date($f2);
            $titulo_rep.='(Periodo ' . $fecha_inicio . '-' . $fecha_fin . ')';
        } else {
            $fecha_inicio = $fecha_fin = '';
        }
        //$data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $sala = $_GET["sala"];
        $tipoact = $_GET["tipo_act"];
        $detalle_act = $_GET["detalle_act"];
        //$data_head['titulo_rep'] = '<h3>Reporte de Uso del Centro de Computo</h3>';
        $contenido['datos_reservaciones'] = $this->reportes_model->datosUsoCC($fecha_inicio, $fecha_fin, $sala, $tipoact, $detalle_act);
        $vista = $this->load->view('reportes/uso_personalizado', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
    }

    function reporte_actividades() {
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_act");
        $tipoact = $this->input->Post("tipo_act_act");
        $titulo_rep = 'Actividades en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_actividades'] = $this->reportes_model->getActividadesRep($tipoact);
        $vista = $this->load->view('reportes/actividades', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }

    function reporte_actividadesxls() {
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_act"];
        $tipoact = $_GET["tipo_act_act"];
        $titulo_rep = 'Actividades en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_actividades'] = $this->reportes_model->getActividadesRep($tipoact);
        $vista = $this->load->view('reportes/actividades', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
    }

    function reporte_equipos() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_equ");
        $marca = $this->input->Post("mark");
        $modelo = $this->input->Post("mod");
        $procesador = $this->input->Post("proc");
        $ram_op = $this->input->Post("ram_op");
        $ram = $this->input->Post("ram");
        $disco_op = $this->input->Post("dd_op");
        $disco = $this->input->Post("dd");
        $sala = $this->input->Post("sala_eq");
        $edo = $this->input->Post("edo_eq");
        $almacen = $this->input->Post("almacen");
        if (isset($almacen) && $almacen != '') {
            $contenido['datos_equipos_almacen'] = $this->reportes_model->getEquiposAlmacenRep();
        }
        $titulo_rep = 'Equipos en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_equipos'] = $this->reportes_model->getEquiposRep($marca, $modelo, $procesador, $ram, $ram_op, $disco, $disco_op, $sala, $edo);
        $vista = $this->load->view('reportes/equipos', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }

    function reporte_equiposxls() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_equ"];
        $marca = $_GET["mark"];
        $modelo = $_GET["mod"];
        $procesador = $_GET["proc"];
        $ram_op = $_GET["ram_op"];
        $ram = $_GET["ram"];
        $disco_op = $_GET["dd_op"];
        $disco = $_GET["dd"];
        $sala = $_GET["sala_eq"];
        $edo = $_GET["edo_eq"];
        $almacen = $_GET["almacen"];
        if (isset($almacen) && $almacen != '') {
            $contenido['datos_equipos_almacen'] = $this->reportes_model->getEquiposAlmacenRep();
        }
        $titulo_rep = 'Equipos en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_equipos'] = $this->reportes_model->getEquiposRep($marca, $modelo, $procesador, $ram, $ram_op, $disco, $disco_op, $sala, $edo);
        $vista = $this->load->view('reportes/equipos', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
    }

    function reporte_usuariosCC() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_usucc");
        $tipou = $this->input->Post("tipoucc");
        $estatus = $this->input->Post("estatus");
        $titulo_rep = 'Usuarios del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_usuarioscc'] = $this->reportes_model->getUsuariosCCRep($tipou, $estatus);
        $vista = $this->load->view('reportes/usuarioscc', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }

    function reporte_usuariosCCxls() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $_GET["nom_rep_usucc"];
        $tipou = $_GET["tipoucc"];
        $estatus = $_GET["estatus"];
        $titulo_rep = 'Usuarios del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_usuarioscc'] = $this->reportes_model->getUsuariosCCRep($tipou, $estatus);
        $vista = $this->load->view('reportes/usuarioscc', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
    }

    function reporte_reservacionesfijas() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_rsf");
        $act = $this->input->Post("act_rsf");
        $sala = $this->input->Post("sala_rsf");
        $hora = $this->input->Post("hora_rsf");
        $encargado = $this->input->Post("encargado_rsf");
        $tipoact = $this->input->Post("tipoact_rsf");
        $titulo_rep = 'Reservaciones Fijas del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_rsf'] = $this->reportes_model->getReservacionesFijasRep($act, $sala, $hora, $encargado, $tipoact);
        $vista = $this->load->view('reportes/reservacionesfijas', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }

    function reporte_reservacionesfijasxls() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_rsf"];
        $act = $_GET["act_rsf"];
        $sala = $_GET["sala_rsf"];
        $hora = $_GET["hora_rsf"];
        $encargado = $_GET["encargado_rsf"];
        $tipoact = $_GET["tipoact_rsf"];
        $titulo_rep = 'Reservaciones Fijas del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_rsf'] = $this->reportes_model->getReservacionesFijasRep($act, $sala, $hora, $encargado, $tipoact);
        $vista = $this->load->view('reportes/reservacionesfijas', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
    }

    function reporte_reservacionessalas() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_rss");
        $act = $this->input->Post("act_rss");
        $sala = $this->input->Post("sala_rss");
        $f1 = $this->input->Post("fechai_rss");
        $horai = $this->input->Post("horai_rss");
        $encargado = $this->input->Post("encargado_rss");
        $edo = $this->input->Post("edo_rss");
        if ($f1 != '') {
            $fechai = $this->utl_apecc->getSQL_date($f1);
        } else {
            $fechai = '';
        }
        $titulo_rep = 'Apartado de salas del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_rss'] = $this->reportes_model->getReservacionesSalasRep($act, $sala, $horai, $fechai, $encargado, $edo);
        $vista = $this->load->view('reportes/reservacionessalas', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }
    function reporte_reservacionessalasxsl() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_rss"];
        $act = $_GET["act_rss"];
        $sala = $_GET["sala_rss"];
        $f1 = $_GET["fechai_rss"];
        $horai = $_GET["horai_rss"];
        $encargado = $_GET["encargado_rss"];
        $edo = $_GET["edo_rss"];
        if ($f1 != '') {
            $fechai = $this->utl_apecc->getSQL_date($f1);
        } else {
            $fechai = '';
        }
        $titulo_rep = 'Apartado de salas del Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_rss'] = $this->reportes_model->getReservacionesSalasRep($act, $sala, $horai, $fechai, $encargado, $edo);
        $vista = $this->load->view('reportes/reservacionessalas', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
        }

    function reporte_software() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $this->load->library('mpdf');
        $titulo = $this->input->Post("nom_rep_sw");
        $so = $this->input->Post("so");
        $gruposw = $this->input->Post("grupo");
        $siso = $this->input->Post("siso");
        $sigru = $this->input->Post("sigrupos");
        if (isset($sigru) && $sigru != '') {
            $contenido['datos_grupos'] = $this->reportes_model->getGruposRep();
        }
        if (isset($siso) && $siso != '') {
            $contenido['datos_sos'] = $this->reportes_model->getSosRep();
        }

        $titulo_rep = 'Software en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_sw'] = $this->reportes_model->getSoftwareRep($so, $gruposw);
        $vista = $this->load->view('reportes/software', $contenido, TRUE);
        //$this->mpdf->StartProgressBarOutput(2);
        $this->mpdf->SetDefaultFontSize(9);
        $this->mpdf->SetDisplayMode('fullpage');
        $this->mpdf->setAutoTopMargin = 'pad';
        $this->mpdf->orig_tMargin = 1;
        //$this->mpdf->orig_bMargin = 7;
        $this->mpdf->SetHTMLHeader($this->load->view('reportes/encabezado_rep', $data_head, true));
        $this->mpdf->SetHTMLFooter($this->load->view('reportes/pie_pagina_rep', '', true));
        $this->mpdf->AddPage('L');
        ;
        $this->mpdf->WriteHTML($vista);
        $this->mpdf->Output("$titulo_rep.pdf", 'I');
    }
    
    function reporte_softwarexls() {
        $this->load->library('table');
        $this->load->model("reportes_model");
        $this->load->library("utl_apecc");
        $titulo = $_GET["nom_rep_sw"];
        $so = $_GET["so"];
        $gruposw = $_GET["grupo"];
        $siso = $_GET["siso"];
        $sigru = $_GET["sigrupos"];
        if (isset($sigru) && $sigru != '') {
            $contenido['datos_grupos'] = $this->reportes_model->getGruposRep();
        }
        if (isset($siso) && $siso != '') {
            $contenido['datos_sos'] = $this->reportes_model->getSosRep();
        }
        $titulo_rep = 'Software en el Centro de Computo';
        if (isset($titulo) && $titulo != '') {
            $titulo_rep = $titulo;
        }
        $data_head['titulo_rep'] = $titulo_rep;
        $contenido['titulo_rep'] = $titulo_rep;
        $contenido['datos_sw'] = $this->reportes_model->getSoftwareRep($so, $gruposw);
        $vista = $this->load->view('reportes/software', $contenido, TRUE);
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=$titulo_rep.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $vista;
        }

}

