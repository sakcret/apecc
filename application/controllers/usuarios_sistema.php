<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios_sistema extends CI_Controller {

    public function index() {
        $this->load->library('utl_apecc');
        //obtener el arreglo con los permisos para el usuario del sistema
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $permisos_us = $this->session->userdata('puedo');
        if ($permisos_us == '') {
            redirect('acceso/acceso_home/inicio');
        }
        $rol = $this->session->userdata('rol');
        if ($rol == 'A') {

            $ptemp = $this->utl_apecc->getPermisos($this->session->userdata('puedo'));
            $prm_array = $this->config->item('prm_permisos');
            if ($ptemp != FALSE) {
                $rec = $this->config->item('clvp_sistema_usuarios');
                //si en el arreglo de permisos esta la clave de usuarios
                if (array_key_exists($rec, $ptemp)) {
                    $permisos = $this->utl_apecc->getCSS_prm($ptemp[$rec], $prm_array);
                } else {
                    redirect('acceso/acceso_home/inicio');
                }
            } else {
                $permisos = $this->utl_apecc->getCSS_prm(false, $prm_array); //si es falso no se encontraron permisos por lo tanto se ponen los atributos para solo lectura
            }
            $contenido['permisos'] = $permisos;

            $data['titulo_pag'] = "GESTI&Oacute;N DE USUARIOS DEL SISTEMA - CCFEI";
            $data['contenido'] = $this->load->view('usuarios_sistema_view', $contenido, true);
            $this->load->view('plantilla', $data);
        } else {
            redirect('inicio');
        }
    }

    /* JSON output 
     *  {"lo":"sakcret","rl":"D","no":"Jos\u00e9 Adrian Ruiz Carmona","em":"sakcret_arte8@hotmail.com","pr":"usu>ac|act>v|equ>ac"}
     */

    function getUsuarios_sistema() {
        $this->load->model("usuarios_sistema_model");
        $login = $this->input->Post("id"); //obtengo por medio de post el valor de num_per
        $row = $this->usuarios_sistema_model->getusuario_sis($login)->row();
        $jsondata['lo'] = $row->login;
        $jsondata['rl'] = $row->rol;
        $jsondata['no'] = $row->nombre;
        $jsondata['em'] = $row->correo;
        $jsondata['pr'] = $row->permisos;
        echo json_encode($jsondata);
    }

    public function datosUsuariosSistema() {
        $sIndexColumn = "login";
        $aColumns = array($sIndexColumn, 'pass', 'nombre', 'rol', 'correo', 'permisos');
        $sTable = "usuariossistema";
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
                    if ($aColumns[$i] == 'rol') {
                        $row[] = $this->getNombreRol($aRow[$aColumns[$i]]);
                    } else {
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
            }
            $row[] = '<img src="images/modificar.png" class="opc prm_c" title="Modificar" alt="Modificar" onclick="modifica_usuario_sis(\'' . $id . '\')"/>
                      <img src="images/eliminar.png" class="opc prm_b" title="Eliminar" alt="Eliminar" onclick="elimina_usuario_sis(\'' . $id . '\')"/>' .
                    '<img src="images/lock.ico" class="opc" title="Ver Permisos" alt="Permisos" onclick="ver_permisos(\'' . $id . '\')"/>';
            $output['aaData'][] = $row;
        }
        echo $_GET['callback'] . '(' . json_encode($output) . ');';
    }

    function eliminaUsuarioSistema() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->model("usuarios_sistema_model");
        $id = $this->input->Post("id");
        $sepudo = $this->usuarios_sistema_model->elimina_usuario_sis($id);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al eliminar el usuario.";
    }

    function agregaUsuarioSistema() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->library('utl_apecc');
        /*         * Inicializar permisos con el rol de solo lectura
         */
        $roles = $this->config->item('roles');
        if (array_key_exists('L', $roles)) {
            $permisos = $roles['L']['permisos'];
        }

        $prm = $this->input->post("prm");
        $rol = $this->input->Post("rol");
        //si se definio un rol
        if (isset($rol) && $rol != '' && $rol != '0') {
            if (array_key_exists($rol, $roles)) {
                $permisos = $roles[$rol]['permisos'];
            }
        } else {
            if (isset($prm) && $prm != '') {
                //obtener la cadena de permisos a travez del arreglo prm obtenido por post
                if ($this->utl_apecc->getStringPermisos($prm) != "") {
                    $permisos = $this->utl_apecc->getStringPermisos($prm);
                }
            }
        }
        // ($this->utl_apecc->getPermisos($permisos) );
        $this->load->model('usuarios_sistema_model');

        $nombre = $this->input->Post("nombre");
        $login_u = $this->input->Post("login");
        $p = $this->input->Post("password");
        $email = $this->input->Post("email");
        $this->load->library('encrypt');
        $this->load->helper('security');
        $password = do_hash($this->encrypt->sha1($p), 'md5');
        $sepudo = $this->usuarios_sistema_model->agrega_usuario_sis($nombre, $login_u, $password, $rol, $email, $permisos);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al agregar el  Usuario.";
    }

    function modificaUsuarioSistema() {
        //si se a auntenticado el usuario del sistema podrá entrar sino sera redireccionado para que ingrese
        $login = $this->session->userdata('login');
        if (!$login) {
            redirect('acceso/acceso_denegado');
        }
        $this->load->library('utl_apecc');
        /*         * Inicializar permisos con el rol de solo lectura
         */
        $permisos='';
        $roles = $this->config->item('roles');
        if (array_key_exists('L', $roles)) {
            $permisos = $roles['L']['permisos'];
        }

        $prm = $this->input->post("prm");
        $rol = $this->input->Post("m_rol");
        //si se definio un rol
        if (isset($rol) && $rol != '' && $rol != '0') {
            if (array_key_exists($rol, $roles)) {
                $permisos = $roles[$rol]['permisos'];
            }
        } elseif (isset($prm) && $prm != '') {
                //obtener la cadena de permisos a travez del arreglo prm obtenido por post
                if ($this->utl_apecc->getStringPermisos($prm) != "") {
                    $permisos = $this->utl_apecc->getStringPermisos($prm);
                }
            }else{
               $permisos=FALSE;
               $rol=FALSE;
        }
        $this->load->model('usuarios_sistema_model');

        $nombre = $this->input->Post("m_nombre");
        $login_u = $this->input->Post("login");
        $p = $this->input->Post("m_password");
        $email = $this->input->Post("m_email");
        $password = '';
        if (isset($p) && $p != '') {
            $this->load->library('encrypt');
            $this->load->helper('security');
            $password = do_hash($this->encrypt->sha1($p), 'md5');
        }  else {
            //sin no se proporciono un password nuevo entonces no se agrega asignando false
            $password=FALSE;
        }
        $sepudo = $this->usuarios_sistema_model->modifica_usuario_sis($nombre,$login_u, $password, $rol, $email, $permisos);
        if ($sepudo)
            echo 'ok'; else
            echo "Se produjo un error al modificar la UsuarioSistema.";
    }

    /**
     * @example getPrmUsuario() $login='admin' por post
     * @return JSON
     *   {["t_usu","t_act","t_eqs","t_equ","t_eqb","t_rpg","t_rpp","t_rep","t_rsf","t_rss","t_rst","t_swr","t_uqs","t_siu","t_sic"]}
     * 
     */
    function getPrmUsuario() {
        $this->load->library("utl_apecc");
        $this->load->model("usuarios_sistema_model");
        $login = $this->input->Post("id");
        $row = $this->usuarios_sistema_model->getPermisosUsuario($login);
        $ids = $this->utl_apecc->getIDSPermisos($row->row()->permisos);
        echo json_encode($ids);
    }

    function getUsuarioSistema() {
        $this->load->model("usuarios_sistema_model");
        $id = $this->input->Post("id");
        $rows = $this->usuarios_sistema_model->getusuario_sis($id);
        foreach ($rows->result() as $row) {
            $jsondata['no'] = $row->UsuarioSistema;
            $jsondata['nc'] = $row->NombreCorto;
            $jsondata['cl'] = $row->Color;
            $jsondata['ta'] = $row->TipoUsuarioSistema;
        }
        echo json_encode($jsondata);
    }

    function getNombreRol($claverol) {
        $roles = $this->config->item('roles');
        if (array_key_exists($claverol, $roles)) {
            return $roles[$claverol]['rol'];
        } else {
            return "";
        }
    }

    /**
     * salida JSON ["t_usu","t_act","t_eqs","t_equ","t_eqb","t_rpg","t_rpp","t_rep","t_rsf","t_rss","t_rst","t_swr","t_uqs","t_siu","a_sis"]
     */
    function getPermisosRol($rol) {
        $this->load->library("utl_apecc");
        $roles = $this->config->item("roles");
        if (array_key_exists($rol, $roles)) {
            $ids = $this->utl_apecc->getIDSPermisos($roles[$rol]["permisos"]);
            if (($ids === false) && count($ids) == 0) {
                echo 'no';
            } else {
                echo json_encode($ids);
            }
        } else {
            echo 'no hay permisos';
        }
    }

}

?>
