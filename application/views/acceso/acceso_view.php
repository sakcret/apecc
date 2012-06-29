<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <title>APECC</title>
        <meta name="author" content="CGT">
        <link rel="stylesheet" href="./css/jquery-ui/demos.css">
        <link rel="stylesheet" href="./css/jquery-ui/jquery-ui-1.8.20.custom.css">
        <link rel="stylesheet" href="./css/jquery-ui/jquery.ui.base.css">
        <link rel="stylesheet" href="./css/extensiones_jqueryui.css">
        <link rel="stylesheet" href="./css/estilo_gral.css" type="text/css"/>
        <link rel="stylesheet" href="./css/cssgrid1140/1140.css" type="text/css"/>
        <script type="text/javascript" language="javascript" src="./js/jquery-1.7.1.js"></script>
        <script type="text/javascript" language="javascript" src="./js/datatables/jquery.dataTables.js"></script>
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
    </head>
    <script type="text/javascript">
        var base_url = '<?php echo $this->config->item('base_url'); ?>';
    </script>
    <body>
        <div class="container">
            <noscript>
                <h1 class='error'>Para utilizar las funcionalidades completas de este sitio es necesario tener     JavaScript habilitado.</h1>    <h1>Aquí están las
                    <a href="http://www.enable-javascript.com/es/" target="_blank"> instrucciones para habilitar JavaScript en tu navegador web</a>.
                    <hr></h1>
            </noscript>
            <div id="header" class="boxshadow ui-widget-header header ui-corner-all twelvecol last"><!--div align="center" style=" color:#edf1fc; text-shadow: 6px 6px 6px #000; font-size: 65px !important;">SEQUEL-REPO</div--></div> 
            <div id="titulo_pag"class="twelvecol ui-widget-header header ui-corner-top boxshadow">
                <label id="titulo_ventana" class=""></label>                
            </div>
            <div id="content" class="twelvecol last ui-widget-content boxshadow">
                <div id="mensaje" class="hide"></div><!--Div donde se crearan los mensajes para cada accion de la pagina-->
                <div id="dialog-aux" class="hide"></div> <!--Div auxilar donde se crearan los mensajes en caso de que mensajes este ocupado-->
                <div class="row">
                    <div class="threecol"></div>
                    <div align="center" class="sixcol">
                        <br>
                        <div class="ui-widget-header ui-corner-top height_widget"><h1 style=" margin-top: 5px;">Ingreso al sistema</h1></div>
                        <div class="ui-widget-content ui-corner-bottom">
                            <p class="tips readonly">Proporciona usuario y contrase&ntilde;a para entrar al sistema.</p><br>
                            <fieldset class="none" style="display: inline;">
                                <label style=" font-weight: bolder;" for="usuario">Usuario*:</label>
                                <input type="text" name="usuario" id="usuario" value="" size="25" maxlength="20" class="text ui-widget-content ui-corner-all"/>   
                                <label style=" font-weight: bolder;" for="usuario">Contrase&ntilde;a*:</label>
                                <input type="password" name="pass" id="pass" value="" size="25" maxlength="20" class="text ui-widget-content ui-corner-all"/></br>       
                                <br>
                                <input type="submit" style=" margin-bottom: 10px;" id="bt_entrar" value="Entrar" /><br>
                            </fieldset>
                        </div>
                        <br>
                    </div>
                    <div class="threecol last"></div>
                </div>
            </div> 
            <div id="footer" class="twelvecol last ui-widget-header ui-corner-bottom boxshadow" style="height:70px"></div>
        </div>
</html>
<script type="text/javascript" charset="UTF-8">
    $(document).keydown(function(tecla){
        if (tecla.keyCode == 13) {
            $("#bt_entrar").button().click();
        }
    });
    $(document).ready(function() {
        $("#bt_entrar").button().click(function(){
            var usuario=$("#usuario"),
            pass=$("#pass"),
            tips=$(".tips"),
            allFields = $( [] ).add(usuario).add(pass);
            var bValid = true;
            bValid = bValid && campoVacio(usuario,'Usuario',tips);
            bValid = bValid && campoVacio(pass,'Contrase&ntilde;a',tips);
            if ( bValid ) {
                var respuesta = ajax_peticion("index.php/acceso/acceso_sistema","usuario="+usuario.val()+"&pass="+pass.val());
                if (respuesta!='no'){
                 redirect_to('usuarios');
                    //if(respuesta=='A'){redirect_to('proyectos_admin'); }else{redirect_to('proyectos?p='+$( "#combobox" ).val()+'&np='+$( ".ui-autocomplete-input" ).val());} 
                }else{
                    updateTips("Usuario y/o Contrase&ntilde;a incorrecto(s)",tips );
                }
            }
            pass.focus(function(){pass.removeClass( "ui-state-error" );});
            usuario.focus(function(){usuario.removeClass( "ui-state-error" );});
        });
    });//fin document ready
</script>
<style type="text/css">
    #bt_entrar{width: 350px; }
    #usuario,#pass{ text-align: center;}
</style>
<style>
    .ui-combobox {
        position: relative;
        display: inline-block;
    }
    #combobox{
        text-align: center;
    }

    .ui-autocomplete-input {
        margin: 0;
        padding: 0.3em;
        width: 425px;
        height: 19px;
        text-align: center;
    }
</style>
