<script>
    $(function() {
        $( "#tabs" ).tabs();
        $( "#bt_reset" ).button();
        
        $( "#cambia_periodo" ).click(function(){
            $("#mensajeper").html('<p><span style="float:left; margin:0 7px 0px 0;"><img src="./images/msg/info.png"/></span>'+
                '</p><p style="font-size: 13px;"><strong>Importante !</strong> <br>Para cambiar el periodo es necesario cambiar las fechas de inicio y fin en el archivo de configuraci&oacute;n.'+
                ' <br><br><strong>&nbsp;&nbsp;&nbsp;&nbsp;Consideraciones al cambiar el periodo:</strong><br><blockquote style=" margin-right: 20px; margin-left: 30px;">'+
                '1.Se cambiar&aacute;n las fechas de inicio y fin de las actividades.<br>'+
                '2.Se cambiar&aacute; el estatus de todos los usuarios del centro de computo a In&aacute;ctivo por lo tanto no pdr&aacute;n hacer reservaciones moment&aacute;neas.<br>'+
                '3.Los Reportes Generales cambiar&aacute;n en funci&oacute;n del nuevo periodo.</blockquote> </p>');
            $("#dialog:ui-dialog").dialog( "destroy" );
            $("#mensajeper").dialog({
                autoOpen: false,
                width:500,
                resizable: false,
                modal: true,
                buttons: {
                    "He leido las consideraciones deseo continuar": function() {
                        var datos =""
                        var urll="index.php/configura_sistema/cambiaPeriodo";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            $( "#respuesta" ).html('<div class="ui-widget">'+
                                '<div class="ui-state-error ui-corner-all" style="padding: 5px;"> '+
                                '<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> '+
                                '<strong>Se ha actualizado el periodo:</strong> Por favor recarga la p&aacute;gina para validar los cambios.</p>'+
                                '</div>'+
                                '</div>');
                            notificacion_tip("./images/msg/ok.png","Cambiar Periodo","El periodo se ha cambiado.");
                        }else{
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                        }
                    
                        $( this ).dialog( "close" );
                    },
                    Cancelar: function() {
                        $( this ).dialog( "close" );
                    }
                },close:function(){
                    $("#mensaje").html();
                }
            }).dialog("open"); 
        });
        
        $( "#bt_guarda_conf_gral" ).click(function(){
            var 
            fecha1=$('#fecha_inicio_r1'),
            fecha2=$('#fecha_fin_r1'),
            costo=$('#costo_reservaciones'),
            vermenu=$('#ver_menult'),
            allFields = $( [] ).add( fecha1 ).add( fecha2).add(costo).add(vermenu),
            tips = $( "#tips_gral" );
            allFields.removeClass( "ui-state-error" );
            var bValid=true;
            bValid = bValid && campoVacio(fecha1,'Fecha inicial del periodo',tips);
            bValid = bValid && validaCampoExpReg( fecha1,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);         
            bValid = bValid && campoVacio(fecha2,'Fecha final del periodo',tips);
            bValid = bValid && validaCampoExpReg( fecha1,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);         
                 
            bValid = bValid && campoVacio(costo,'Costo de reservaciones momentaneas',tips);
            // bValid = bValid && validaCampoExpReg( costo,/^$/, "No parece ser un costo v&aacute;lido. Formato requerido (n).nn Ejemplo: 2.00'",tips);         
            if(bValid){
                var urll="index.php/configura_sistema/guardaConfGrales";
                var datos=$( "#form_configura_gral" ).serialize();
                alert(datos);
                var respuesta = ajax_peticion(urll,datos);
                if (respuesta=='ok'){
                    notificacion_tip("./images/msg/ok.png","Modificar Configuraciones","Se modificar&oacute;n las configuraciones satisfactoriamente.");
                }else{
                    mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                }
            }
            allFields.removeClass( "ui-state-error" );
        });
        
        var dates = $( "#fecha_inicio_r1, #fecha_fin_r1" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onSelect: function( selectedDate ) {
                var option = this.id == "fecha_inicio_r1" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
    });
</script>
<?php
$menuchk = '';
$s = $this->config->item('ver_menu_lt');
if ($s) {
    $menuchk = ' checked';
}
?>
<style>
    #tabs{margin-right: 10px;}
    a{width:95%}
    #tabs li{
        width: 30%;
    }
    #f_configura_gral{
        padding: 30px !important;
    }
    .pad30{
        padding: 30px !important;
    }
    table td{
        padding-left: 20px;
    }
    .datepicker-ui{
        width: 96%  !important;
        padding-left: 8px;
    }
</style>
<div class="row">
    <div id="mensajeper" style="display: none;" title="Cambiar periodo"></div>
    <br>
    <div class=" twelvecol last">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">Configuraciones Generales</a></li>
                <!--li><a href="#tabs-2">Base de Datos</a></li>
                <li><a href="#tabs-3">Permisos</a></li-->
            </ul>
            <div id="tabs-1">
                <div id="f_configura_gral" class=" ui-widget-content ui-corner-all">
                    <p style="padding: 5px; padding-left: 20px !important;" class=" ui-corner-all" id="tips_gral">Solo lectura</p><br>
                    <form action="" id="form_configura_gral">
                        <table width="100%" border="0">
                            <tr>
                                <td width="25%"><label for="fecha_inicio_r1">Fecha de Inicio del Periodo:</label><br>
                                    <input type="text" name="fecha_inicio_r1" id="fecha_inicio_r1" value="<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')); ?>" class="datepicker-ui ui-corner-all height_widget ui-widget-content" disabled></td>
                                <td width="25%"><label for="fecha_fin_r1">Fecha de Fin del Periodo:</label><br>
                                    <input type="text" name="fecha_fin_r1" id="fecha_fin_r1" value="<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>" class="datepicker-ui ui-corner-all height_widget ui-widget-content" disabled></td>
                                <td><label for="costo_reservaciones">Costo para las Reservaciones Momentaneas:</label><br>
                                    <b style="width:5% !important;"> $</b><input type="text" name="costo_reservaciones" id="costo_reservaciones" value="<?php echo $this->config->item('costoxhora'); ?>"  onkeypress="return IsNumberFloat(event);" class="text" style="width:80% !important;" disabled><b style="width:10% !important;"> m/n</b></td>
                                <td><input type="checkbox" value="true" name="ver_menult" id="ver_menult" class=" checkbox-ui" <?php echo $menuchk; ?> disabled>
                                    <label for="ver_menult">Mostrar Menu Lateral:</label></td>
                            </tr>
                        </table>
                        <input type="reset"  value="Limpiar Configuraciones" class="hide" id="bt_reset">
                    </form>
                    <button id="bt_guarda_conf_gral" class="hide">Guardar</button>
                </div>
                <br>
                <div id="f_configura_periodo" class="pad30 ui-widget-content ui-corner-all"  Style=" padding-top: 0px !important">
                    <div align="center" Style="margin: 5px; padding: 5px;" class="ui-corner-all ui-widget-header boxshadowround">Cambiar periodo</div>
                    <div class="ui-widget">
                        <div class="ui-widget-content ui-corner-all" style="margin-top: 8px; padding: 8px;;"> 
                            <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                <strong>Importante !</strong> Para cambiar el periodo es necesario cambiar las fechas de inicio y fin en el archivo de configuraci&oacute;n.
                                <br> <strong>&nbsp;&nbsp;&nbsp;&nbsp;Consideraciones al cambiar el periodo:</strong><br><blockquote style=" margin-right: 20px; margin-left: 30px;">1.Se cambiar&aacute;n las fechas de inicio y fin de las actividades.<br>2.Se cambiar&aacute; el estatus de todos los usuarios del centro de computo a In&aacute;ctivo por lo tanto no pdr&aacute;n hacer reservaciones moment&aacute;neas.<br>
                                3.Los Reportes Generales cambiar&aacute;n en funci&oacute;n del nuevo periodo.</blockquote> 
                            </p>
                        </div>
                    </div>
                    <div>
                        <table width="100%" style="margin-top: 8px;" border="0">
                            <tr>
                                <td width="25%"><button id="cambia_periodo">Cambiar Periodo</button></td>
                                <td colspan="3" id="respuesta"></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
            <!--div id="tabs-2">
            </div>
            <div id="tabs-3">
            </div-->
        </div>
    </div>

</div>
<br>
<br>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>