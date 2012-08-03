<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipo_software extends CI_Controller {

    public function index() {
        $this->load->model('reservaciones_temporales_model');
        $this->load->model('salas_model');
        setlocale(LC_TIME, 'Spanish');
        $contenido['titulo_pag'] = "ASIGNACI&Oacute;N DE SOFTWARE";
        $contenido['include'] = '<script type="text/javascript" language="javascript" src="./js/jsequipos.js"></script>' . PHP_EOL;
        $contenido['salas'] = $this->salas_model->datos_salas();
        $contenido['equipos_salas'] = $this->reservaciones_temporales_model->equipos_salas();
        $data['contenido'] = $this->load->view('equipo_software_view', $contenido, true);
        $this->load->view('plantilla', $data);
    }

    public function getSoftware($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getSoftwareEquipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $jsondata[$i]['sw'] = $row->nombre;
            $jsondata[$i]['de'] = $row->descripcion;
            $jsondata[$i]['so'] = $row->so;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSosEquipo($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getsosequipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSwEquipo($numserie) {
        $this->load->model('equipo_software_model');
        $software_equipo = $this->equipo_software_model->getswequipo($numserie);
        $i = 0;
        $jsondata = null;
        foreach ($software_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->id;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function getSos() {
        $this->load->model('equipo_software_model');
        $so_equipo = $this->equipo_software_model->get2Sos();
        $i = 0;
        $jsondata = null;
        foreach ($so_equipo->result() as $row) {
            $jsondata[$i]['id'] = $row->idSistemaOperativo;
            $jsondata[$i]['so'] = $row->sistemaOperativo;
            $i++;
        }
        echo json_encode($jsondata);
    }

    public function agregaSos() {
       
        $sos = $this->input->post('so');
        $numserie = $this->input->post('num_serie');
        $this->load->model('equipo_software_model');
        if (count($sos) >= 0 && $sos[0] != '') {
            $sepudo = $this->equipo_software_model->agrega_sos($numserie, $sos);
            if ($sepudo)
                echo "ok"; else
                echo "Error al asignar Sistemas Operativos.";
        }
    }

    public function agregaSw() {
        $sw = $this->input->post('sw');
        $numserie = $this->input->post('num_serie');
        $this->load->model('equipo_software_model');
        if (count($sw) >= 0 && $sw[0] != '') {
            $sepudo = $this->equipo_software_model->agrega_sw($numserie, $sw);
            if ($sepudo)
                echo "ok"; else
                echo "Error al asignar Software.";
        }
    }

}
?>

