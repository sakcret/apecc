<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
    <head>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <title>APECC</title>
        <meta name="author" content="CGT">
        <meta http-equiv="content-type" CONTENT="text/html; charset=utf-8">
        <link rel="shortcut icon" href="./images/favicon.ico">

        <!--CSS Grid 1440-->
        <script type="text/javascript" language="javascript" src="./js/cssgrid1140/css3-mediaqueries.js"></script>
        <link rel="stylesheet" href="./css/cssgrid1140/1140.css" type="text/css"/>
        <link rel="stylesheet" href="./css/cssgrid1140/styles.css" type="text/css"/>
        <!--datatables-->
        <style type="text/css" title="currentStyle">
            @import "./css/datatables/demo_page.css";        
            @import "./css/datatables/demo_table.css";
            @import "./css/datatables/adaptacion_themeroller.css";
        </style>

        <link rel="stylesheet" href="./css/jquery-ui/demos.css">
        <link rel="stylesheet" href="./css/jquery-ui/jquery-ui-1.8.20.custom.css">
        <link rel="stylesheet" href="./css/jquery-ui/jquery.ui.base.css">
        <link rel="stylesheet" href="./css/extensiones_jqueryui.css">
        <link rel="stylesheet" href="./css/estilo_gral.css" type="text/css"/>

        <script type="text/javascript" language="javascript" src="./js/jquery-1.7.2.js"></script>
        <script type="text/javascript" language="javascript" src="./js/datatables/jquery.dataTables.js"></script>
        <!--sweet menu-->
        <script type="text/javascript" language="javascript" src="./js/menu_access/jquery.easing.js"></script>
        <script type="text/javascript" language="javascript" src="./js/menu_access/jquery.sweet-menu-1.0.js"></script>

        <!--jquery ui-->
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.effects.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.base.js"></script>
         <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.mousewheel-3.0.4.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.accordion.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.autocomplete.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.button.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.slider.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.tabs.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.progressbar.js"></script>
        
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.menu.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.menubar.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.tooltip.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.checkbox.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.radiobutton.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.popup.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.spinner.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.tooltip.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.selectmenu.js"></script>
        <!-- fin jquery ui-->
        <script type="text/javascript" language="javascript" src="./js/jquery.blockUI.js"></script>
        <script type="text/javascript" language="javascript" src="./js/js_gral.js"></script>
        <script type="text/javascript" language="javascript" src="./js/utilerias.js"></script>
        <script type="text/javascript" language="javascript" src="./js/nav_menu.js"></script>
        <?php
        if (isset($include) && ($include != '')) {
            echo $include . PHP_EOL;
        }
        ?>
        <script type="text/javascript">
            var base_url = '<?php echo $this->config->item('base_url'); ?>';
            var cache_on = '<?php echo $this->config->item('actualizacion_cache'); ?>';
            function actualiza_cache_db(){
                if(cache_on){
                    var urll="index.php/inicio/actualiza_cache";
                    var r = ajax_peticion(urll,'');
                    if (r=='ok'){
                        //mensaje($( "#mensaje" ),'Actualizacion de cache ','./images/msg/ok.png','Se actualizo el cache...','Se proceder&aacute; a recargar la p&aacute;gina para reflejar cambios.');
                    }else{
                        mensaje($( "#mensaje" ),'Error al actualizar el cache ! ','./images/msg/error.png',respuesta,'<b>Consulte al administrador.</b>');
                    }
                }else{
                    //notificacion_tip("./images/msg/war_tip.png","Cache desactivado","El cache se encuentra desactivado.");
                }
            }
        </script>
    </head>
    <?php
    ob_flush();
    flush();
    ?>
    <!--script>
        $(document).ready(function(){
            $('#switcher').themeswitcher({height:300});
        });
    </script>
    <script type="text/javascript"
      src="http://jqueryui.com/themeroller/themeswitchertool/">
    </script-->
    <body>
        <div class="container">
            <noscript>
                <h1 class='error'>Para utilizar las funcionalidades completas de este sitio es necesario tener     JavaScript habilitado.</h1>    <h1>Aquí están las
                    <a href="http://www.enable-javascript.com/es/" target="_blank"> instrucciones para habilitar JavaScript en tu navegador web</a>.
                    <hr></h1>
            </noscript>
            <div onload="window.setTimeout('muestra_fecha()',1000);" id="header" class="boxshadow ui-widget-header header ui-corner-all twelvecol last">
                <img align="left" style=" margin-left: 15px;" src="./images/BANNER_APECC_2.png">
                <img align="right" style=" margin-right: 15px;" src="./images/logo-uv.png">
                <img align="right"  src="./images/BANNER_APECC.png">
            </div> 
            <ul id="ulMenu" class="ui-state-default ui-corner-all boxshadow">
                <li class="itemli no-icon"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <?php
                $hidem = '';
                $permisos = $this->session->userdata('puedo');
                $pos = stripos($permisos, 'rs');
                if ($pos !== false) {
                    ?>
                    <li class="itemli"><a>Reservaciones</a>
                        <ul><?php if (stripos($permisos, 'rst') !== false) {?>
                            <li><a id="nav_rt" class="manita">Temportaneas</a></li>
                            <?php } if (stripos($permisos, 'rsf') !== false) {?>
                            <li><a id="nav_rf" class="manita">Fijas</a></li>
                            <?php }if (stripos($permisos, 'rss') !== false) {?>
                            <li><a id="nav_as" class="manita">Apartado de Salas</a></li>
                            <?php }else { $hidem.='$("#rs_d").css("display","none"); '; }?>
                        </ul>
                    </li>
                <?php
                } 
                $pos = stripos($permisos, 'us');
                if ($pos !== false) {
                    ?>
                    <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usuarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <ul>
                            <li class="manita" id="nav_us"><a>Usuarios</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                    $hidem.='$("#us_d").css("display","none"); ';
                }
                $pos = stripos($permisos, 'ac');
                if ($pos !== false) {
                    ?>
                    <li><a class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actividades&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <ul>
                            <li class="manita" id="nav_ac"><a>Actividades</a></li>
                        </ul>
                    </li>
                <?php
                }
                $pos = stripos($permisos, 'eq');
                if ($pos !== false) {
                    ?>
                    <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <ul>
                            <?php if (stripos($permisos, 'equ') !== false) {?>
                            <li><a class="manita" id="nav_eq">Gesti&oacute;n de Equipos</a></li>
                            <?php }if (stripos($permisos, 'eqb') !== false) {?>
                            <li><a class="manita" id="nav_ue">Ubicaci&oacute;n de Equipos</a></li>
                            <?php }if (stripos($permisos, 'eqs') !== false) {?>
                            <li><a class="manita" id="nav_es">Asignacion de software</a></li>
                            <?php }?>
                        </ul>
                    </li>
                <?php
                }
                $pos = stripos($permisos, 'sw');
                if ($pos !== false) {
                    ?>
                    <li><a class="itemli">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Software&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <ul>
                            <li class="manita" id="nav_sw"><a>Software</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    $pos = stripos($permisos, 'rp');
                    if ($pos !== false) {
                        ?>
                    <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reportes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <ul>
                            <?php if (stripos($permisos, 'rpg') !== false) {?>
                            <li><a class="manita" id="nav_rg">Reportes Generales</a></li>
                            <?php }if (stripos($permisos, 'rpp') !== false) {?>
                            <li><a class="manita" id="nav_rp">Reportes Personalizados</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } 
                    unset($pos)?>
                <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sistema&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                            <?php if (stripos($permisos, 'siu') !== false) {?>
                            <li><a class="manita" id="nav_su">Usuarios del sistema</a></li>
                            <?php }if (stripos($permisos, 'sic') !== false) {?>
                            <li><a class="manita" id="nav_sc">Configuraciones</a></li>
                            <?php  } ?>
                            <li><a class="manita" id="nav_ay">Ayuda</a></li>
                            <li><a class="manita" id="nav_ad">Acerca de APECC</a></li>
                        </ul>
                </li>

                <div id="timestamp" align="right"></div>
                <span style=" float: right !important;"><img id="refresh" style=" height: 28px !important;" title="Actualizar P&aacute;gina" class="tooltip manita" src="./images/recargar.png">
                </span>
            </ul>
            <div id="titulo_pag"class="twelvecol ui-widget-header header ui-corner-top boxshadow">
                <label style="float: left;  margin-left: 50px;" id="titulo_ventana" class="">
                    <center class="label_titulo">
                    <?php  if (isset($titulo_pag) && ($titulo_pag != '')) { echo $titulo_pag . PHP_EOL; }  ?>
                    </center>
                    <!--div style="font-size: 10 px; width: auto; float:right; margin-right: 50px;" id="switcher"></div-->
                </label>
                <div style="float:right; width:30%; margin-left: 5px; margin-right: 5px; height: 80%; margin-top: 0.3%;" class="ui-state-focus ui-corner-all">
                    <div class="manita" style="float: right; margin-right: 5px; ">
                        <img title="Cerrar sesi&oacute;n" Style="height: 30px !important;" id="salir" onclick="cerrar_sesion()" class="manita" src="./images/salir.png"/>
                    </div>
                    <div style="float:left; margin-right: 10px;">
                        <?php
                        echo $this->session->userdata('img');
                        $nom_u = $this->session->userdata('nombre');
                        ?>
                    </div>
                    <div class="user_lb">    
                        <?php
                        if (($nom_u != '')) {
                            echo $nom_u;
                        } else {
                            echo $this->session->userdata('login');
                        }
                        ?> 
                    </div>
                </div>
            </div>
            <div id="content" class="twelvecol last ui-widget-content boxshadow tooltip">
                <div id="mensaje" class="hide"></div><!--Div donde se crearan los mensajes para cada accion de la pagina-->
                <div id="dialog-aux" class="hide"></div> <!--Div auxilar donde se crearan los mensajes en caso de que mensajes este ocupado-->
                <?php
                if (isset($contenido) && ($contenido != '')) {
                    echo $contenido . PHP_EOL;
                }
                ?>
            </div>
            <div id="footer" class="twelvecol last ui-widget-header ui-corner-bottom boxshadow" style="height:70px">
                <div align="center" id="foot_lb">
                    Automatizaci&oacute;n de Procesos en el Centro de Computo (APECC&nbsp; <?php echo $this->config->item("sis_version");?>)<br>
                    Proyecto realizado para la facultad de Estad&iacute;stica e Inform&aacute;tica de la UNIVERSIDAD VERACRUZANA<br>
                    Jos&eacute; Adrian Ruiz Carmona
                    &reg; <?php
                    setlocale(LC_TIME, 'Spanish');
                    echo date("F") . " " . date("Y"); 
                    ?>
                </div>
            </div>
                <?php if ($this->config->item('ver_menu_lt')) { ?>
                <ul id="acess_menu">
                    <li><a class="boxshadowround" id="ml_hm" href="#">Home</a></li>
                    <li><a class="boxshadowround" onclick="window.location.reload()" >Actualizar</a></li>
                    <li id="us_d"><a class="boxshadowround" id="ml_us" href="#">Usuarios</a></li>
                    <li id="rs_d"><a class="boxshadowround" id="ml_rm" href="#">Reservaciones</a></li>
                    <li><a class="boxshadowround" id="ml_ex" href="#">Salir</a></li>
                    <li><a class="boxshadowround" id="ml_hp" href="#">Ayuda</a></li>
                </ul>
               <script type="text/javascript">
            $(document).ready(function(){ <?php echo $hidem ?>  });
        </script>
                <?php } ?>
        </div>
    </body>
</html>
