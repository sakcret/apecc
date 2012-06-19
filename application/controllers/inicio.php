<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function index() {
        $this->load->model("inicio_model");
        $data['contenido'] = $this->load->view('inicio_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }
    
    function actualiza_cache(){
        $this->load->model("sql_generico_model");
        $sepudo=$this->sql_generico_model->borra_todo_cache();
        if ($sepudo)
            echo 'ok'; else
            echo '<b>Error Fatal...</b><br/> No se ha podido actualizar el cache. Por lo que la informaci&oacute;n no ser&aacute; confiable.';
        
        
    }

}

?>