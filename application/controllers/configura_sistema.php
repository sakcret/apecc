<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configura_sistema extends CI_Controller {

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
            $rec = $this->config->item('clvp_sistema_config');
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
        $this->load->library('utl_apecc');
        $this->config->set_item('nombre_item', 'valor_item');
        $data['titulo_pag'] = "CONFIGURACIONES DEL SISTEMA - CCFEI";
        $data['contenido'] = $this->load->view('configura_sistema_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }
    function guardaConfGrales(){
        $this->config->load('configuracion_sistema', FALSE, TRUE);
        $this->load->library('utl_apecc');
        $f1=$this->input->post('fecha_inicio_r1');
        $f2=$this->input->post('fecha_fin_r1');
        $costo=$this->input->post('costo_reservaciones');
        $vermenu=$this->input->post('ver_menult');
        $tipocosto=gettype($costo+1);
        //if ($f1!=''&&$f2!=''&&$costo!=''&& $tipocosto=='double') {
            $this->config->set_item('fecha_periodo_inicio',  $this->utl_apecc->getSQL_date($f1));
            $this->config->set_item('fecha_periodo_fin',  $this->utl_apecc->getSQL_date($f2));
            $this->config->set_item('costoxhora',$costo);
            if (isset($vermenu)&&$vermenu=='true'){
            $this->config->set_item('ver_menu_lt',TRUE);}
        echo 'ok';
    }
    
    function cambiaPeriodo(){
        $this->load->model('configura_sistema_model');
        $sepudo=$this->configura_sistema_model->cambia_periodo();
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al cambiar el periodo.";
    }

}

?>