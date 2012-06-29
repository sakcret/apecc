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

        <script type="text/javascript" language="javascript" src="./js/jquery-1.7.1.js"></script>
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
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.datepicker1.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.progressbar.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.menu.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.menubar.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.tooltip.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.checkbox.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.radiobutton.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.popup.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery-ui/jquery.ui.mask.js"></script>
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
            
            function muestra_fecha(){
                var  hoy = new Date(),
                hora = fillZeroDateElement(hoy.getHours()),
                minutos = fillZeroDateElement(hoy.getMinutes()),
                segundos = fillZeroDateElement(hoy.getSeconds()),
                dia = fillZeroDateElement(hoy.getDate()),
                mes = hoy.getMonth()+1,
                anio=hoy.getFullYear();
                alert();
                $('#timestamp').html(dia+' de '+mes+' del '+anio+' '+hora+':'+minutos+':'+segundos);
                window.setTimeout("muestra_fecha()",1000); 
            }
            
            function getMesFull(num_mes){
                var mes;
                switch(num_mes) {
                    case 1:mes='Enero'; break;
                    case 2:mes='Febrero'; break;
                    case 3:mes='Marzo'; break;
                    case 4:mes='Abril'; break;
                    case 5:mes='Mayo'; break;
                    case 6:mes='Junio'; break;
                    case 7:mes='Julio'; break;
                    case 8:mes='Agosto'; break;
                    case 9:mes='Septiembre'; break;
                    case 10:mes='Octubre'; break;
                    case 11:mes='Noviembre'; break;
                    case 12:mes='Diciembre'; break;
                    default: mes=num_mes;break;
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
    <body onunload="cerrar_sesion()" onload="actualiza_cache_db();">
        <div class="container">
            <noscript>
                <h1 class='error'>Para utilizar las funcionalidades completas de este sitio es necesario tener     JavaScript habilitado.</h1>    <h1>Aquí están las
                    <a href="http://www.enable-javascript.com/es/" target="_blank"> instrucciones para habilitar JavaScript en tu navegador web</a>.
                    <hr></h1>
            </noscript>
            <div onload="window.setTimeout('muestra_fecha()',1000);" id="header" class="boxshadow ui-widget-header header ui-corner-all twelvecol last"></div> 
            <ul id="ulMenu" class="ui-state-default ui-corner-all boxshadow">
                <li class="itemli no-icon"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li class="itemli"><a>Reservaciones</a>
                    <ul>
                        <li><a id="nav_rt" class="manita">Temportaneas</a></li>
                        <li><a id="nav_rf" class="manita">Fijas</a></li>
                        <li><a id="nav_as" class="manita">Apartado de Salas</a></li>
                    </ul>
                </li>
                <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Usuarios&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                        <li class="manita" id="nav_us"><a>Usuarios</a></li>
                    </ul>
                </li>
                <li><a class="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actividades&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                        <li class="manita" id="nav_ac"><a>Actividades</a></li>
                    </ul>
                </li>
                <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Equipos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                        <li><a class="manita" id="nav_eq">Gesti&oacute;n de Equipos</a></li>
                        <li><a class="manita" id="nav_ue">Ubicaci&oacute;n de Equipos</a></li>
                        <li><a class="manita" id="nav_es">Asignacion de software</a></li>
                    </ul>
                </li>
                <li><a class="itemli">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Software&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                        <li class="manita" id="nav_sw"><a>Software</a></li>
                    </ul>
                </li>
                <li class="itemli"><a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reportes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    <ul>
                        <li><a class="manita" id="nav_rg">Reportes Genrales</a></li>
                        <li><a class="manita" id="nav_rp">Reportes Personalizados</a></li>
                    </ul>
                </li>
                <li class="itemli no-icon"><a>&nbsp;</a></li>

                <div id="timestamp" align="right"></div>
                <span style=" float: right !important;"><img id="refresh" style=" height: 28px !important;" title="Actualizar P&aacute;gina" class="tooltip manita" src="./images/recargar.png">
                </span>
            </ul>
            <div id="titulo_pag"class="twelvecol ui-widget-header header ui-corner-top boxshadow">
                <label style="float: left;  margin-left: 50px;" id="titulo_ventana" class="">
                    <center class="label_titulo">
                        <?php
                        if (isset($titulo_pag) && ($titulo_pag != '')) {
                            echo $titulo_pag . PHP_EOL;
                        }
                        ?>
                    </center>
                    <!--div style="font-size: 10 px; width: auto; float:right; margin-right: 50px;" id="switcher"></div-->
                </label>
                <div style="float:right; width:30%; margin-left: 5px; margin-right: 5px; height: 80%; margin-top: 0.3%;" class="ui-state-focus ui-corner-all">
                    <div class="manita" onclick="cerrar_sesion()" style="float: right; margin-right: 5px; ">
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
            <div id="footer" class="twelvecol last ui-widget-header ui-corner-bottom boxshadow" style="height:70px"></div>
            <?php if($this->config->item('ver_menu_lt')){ ?>
            <ul id="acess_menu">
                <li><a class="boxshadowround" id="ml_hm" href="#">Home</a></li>
                <li><a class="boxshadowround" onclick="window.location.reload()" >Actualizar</a></li>
                <li><a class="boxshadowround" id="ml_us" href="#">Usuarios</a></li>
                <li><a class="boxshadowround" id="ml_rm" href="#">Reservaciones</a></li>
                <li><a class="boxshadowround" id="ml_ex" href="#">Salir</a></li>
                <li><a class="boxshadowround" id="ml_hp" href="#">Ayuda</a></li>
            </ul>
            <?php }?>
        </div>
    </body>
</html>
