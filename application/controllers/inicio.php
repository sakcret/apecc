<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index() {
        $this->load->library("utl_apecc");
        $this->load->library('table');
        $this->load->model('inicio_model');
         $this->load->model("reportes_model");
        $this->load->model("salas_model");
        $login = $this->session->userdata('login');
        $permisos = $this->session->userdata('puedo');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $data['titulo_pag'] = "INICIO - APECC (CCFEI)";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/highcharts/highcharts.js"></script>' . PHP_EOL .
                '<script type="text/javascript" language="javascript" src="./js/highcharts/modules/exporting.js"></script>' . PHP_EOL;
        $contenido['datos_salas'] = $this->reportes_model->datosReserv();
        $contenido['datos_rsf']=  $this->inicio_model->getActividadesHoy();
        $data['contenido'] = $this->load->view('inicio_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    function actualiza_cache() {
        $this->load->model("sql_generico_model");
        $sepudo = $this->sql_generico_model->borra_todo_cache();
        if ($sepudo)
            echo 'ok'; else
            echo '<b>Error Fatal...</b><br/> No se ha podido actualizar el cache. Por lo que la informaci&oacute;n no ser&aacute; confiable.';
    }

}

?>