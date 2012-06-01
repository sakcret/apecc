<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acceso extends CI_Controller {

    public function index() {
        $this->load->library('encrypt');
        $this->load->view('acceso/acceso_view');
    }

    function acceso_sistema() {
        $this->load->library('encrypt');
        $this->load->helper('security');
        $this->load->helper('file');
        $this->load->model("acceso_model");
        $login = $this->input->post("usuario");
        //encripto el password con el algoritmo sh1(unidireccional) para compararlo con la base de datos
        $p = $this->encrypt->sha1($this->input->post("pass"));
        $password = do_hash($p, 'md5');
        $result = $this->acceso_model->ValidarUsuario($login, $password);
        if ($result->num_rows() > 0) {
            $row = $result->row_array(0);
            $this->session->set_userdata('login', $row['login']);
            if (($this->get_image_user($row['login'] . '.jpg', $row['foto'])) && ($row['foto'] != null)) {
                $this->session->set_userdata('img', '<img class="ui-corner-tl ui-corner-bl boxshadowround img_user" src="./images/temp/' . $row['login'] . '.jpg' . '"/>');
            } else {
                $this->session->set_userdata('img', '<img class="ui-corner-tl ui-corner-bl boxshadowround img_user" src="./images/nofoto.jpg' . '"/>');
            }
            $this->session->set_userdata('nombre', $row['nombre']);
            $this->session->set_userdata('rol', $row['rol']);
            $this->session->set_userdata('puedo', $row['permisos']);
            echo $this->session->userdata('rol');
        } else
            echo 'no';
    }

    function get_image_user($nombre, $data) {
        if (!write_file('./images/temp/' . $nombre, $data)) {
            return false;
        } else {
            return true;
        }
    }

    function logout() {
        $this->load->helper('file');
        $login = $this->session->userdata('login');
        $this->session->sess_destroy();
        try {
            delete_files('./images/temp/' . $login . '.jpg');
        } catch (Exception $e) {
            delete_files('./images/temp/');
        }
        redirect();
    }

    function acceso_denegado() {
        $this->load->view('acceso/acceso_denegado_view');
    }

    function en_construccion() {
        $this->load->view('acceso/construccion_view');
    }
    function acceso_home($pag_redirect) {
        $data['url']=$pag_redirect;
        $this->load->view('acceso/home_acces_view',$data);
    }

}

?>