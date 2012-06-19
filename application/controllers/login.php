<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $this->load->model("login_model");
        $data['contenido'] = $this->load->view('login_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }
    
    }
    ?>