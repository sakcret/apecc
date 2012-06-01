<style>
    .tabla_actividades_div{
        width: 15%;
        float: left;
        margin-left: 20px;
        margin-bottom: 25px;
        margin-top: 10px;
    }
    #content_almacen{
        margin-top: 7px!important;
        margin-bottom: 7px!important;
        width: 185px !important;
        margin: auto;

    }
    .tabla_salas{
        width: 79%;
        float: right;
        margin-right: 20px;
    }
    .row1{
        width: 100%;
        margin: 0 auto;
        overflow: hidden;
    }

    .drgst{
        height: 120px !important;
        width: 130px !important;
    }
    .buscar_dt{
        width: 68px;
        -moz-border-radius-bottomright: 6px; 
        -webkit-border-bottom-right-radius: 6px; 
        -khtml-border-bottom-right-radius: 6px; 
        border-bottom-right-radius: 6px; 
        -moz-border-radius-topleft: 6px; -webkit-border-top-left-radius: 6px; -khtml-border-top-left-radius: 6px; border-top-left-radius: 6px;
        -moz-border-radius-topright: 6px; -webkit-border-top-right-radius: 6px; -khtml-border-top-right-radius: 6px; border-top-right-radius: 6px;
        -moz-border-radius-bottomleft: 6px; -webkit-border-bottom-left-radius: 6px; -khtml-border-bottom-left-radius: 6px; border-bottom-left-radius: 6px; 
    }
    .tam_td{
        width: 16%;
        height: 16%;
    }
    .img_resize{
        width: 100px !important;
        height: 100px !important;
    }
    .wid_act{
        width: 160px !important;
        height: 27px !important;
    }
    .head_hor{
        width: 67px;
        height: 37px;
    }
</style>

<?php
echo '<style>';
foreach ($actividades_color as $r) {
    echo '.color_' . $r['idactividad'] . ' {background-color: ' . $r['color'] . ';}';
}
echo '</style>';
?> 
<div align="center" title="Busqueda Avanzada de Atividades" id="busqueda_avanzada" class="hide" style=" width: 70%;">
    <center>
        <table cellpadding="0" cellspacing="0" border="0" class="display" >
            <thead>
                <tr>
                    <th width="20%">Campo</th>
                    <th width="35%">Texto a Filtrar</th>
                    <th width="20%">Tratar como <br/>expresi&oacute;n Regular</th>
                    <th width="20%">Filtro <br/>Inteligente</th>
                </tr>
            </thead>
            <tbody>
                <tr id="filter_global">
                    <td align="left">Filtro Global</td>
                    <td align="center"><input type="text"     name="global_filter" id="global_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="global_regex"  id="global_regex" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="global_smart"  id="global_smart"  checked></td>
                </tr>
                <tr id="filter_col2">
                    <td align="left">Nombre corto</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">Catedr&aacute;tico/responsable</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">bloque</td>
                    <td align="center"><input type="text"     name="col1_filter" id="col4_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_regex"  id="col4_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_smart"  id="col4_smart" checked></td>
                </tr>
                <tr id="filter_co5">
                    <td align="left">Secci&oacute;n</td>
                    <td align="center"><input type="text"     name="col1_filter" id="col5_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_regex"  id="col5_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_smart"  id="col5_smart" checked></td>
                </tr>
            </tbody>
        </table>
    </center>
</div>

<div style=" margin-top: 10px; margin-bottom: 12px;" class="ui-corner_all boxshadowround">
    <table width="100%" border="0">
        <tr>
            <td id="ayuda_edos_equ" width="45%">&nbsp;&nbsp;&nbsp;&nbsp;<img src="./images/ayuda.png"/>&nbsp;&nbsp;Duracion del periodo (para reservaciones fijas con experiencias educativas):</td>
            <td width="25%">Fecha de inicio del periodo:&nbsp;<b><?php echo $this->config->item('fecha_periodo_inicio'); ?></b></td>
            <td width="30%">Fecha de fin del periodo:&nbsp;<b><?php echo $this->config->item('fecha_periodo_fin'); ?></b></td>
        </tr>
    </table>
</div>
<div id="drag0"  class="row1">
    <div class="tabla_actividades_div ui-widget-content ui-corner-all"> 
        <div id="content_almacen"> 
            <table cellpadding="0" cellspacing="0" border="0" class="display hover" id="mover_almacen">
                <tr><td class="trash ui-widget-header ui-corner-all" title="Eliminar Horario de la tabla de reservaciones fijas(Arrastralo aqu&iacute;)"><center><img src="./images/trash.png"><br>Eliminar Horario<br></center></td></tr>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="tabla_actividades">
                <thead>
                    <tr>
                        <th class="mark blank">Actividad</th>
                        <th class="mark blank">nombreact</th>
                        <th class="mark blank">responsable</th>
                        <th class="mark blank">bloque</th>
                        <th class="mark blank">seccion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades as $r) { ?>
                        <tr>
                            <td ondblclick="info_act(<?php echo '\'' . $r['nombrecompleto'] . '\',\'' . $r['catedratico'] . '\',' . $r['bloque'] . ',' . $r['seccion']; ?>)" class="ui-state-focus">
                                <div id="<?php echo $r['id'] . '%1d%' ?>" class="drag clone color_<?php echo $r['idactividad']; ?> glass"><?php echo '<div class="label1" style="margin-bottom:0px !important;" >' . $r['nombre'] . ' &nbsp;&nbsp;B' . $r['bloque'] . '/S' . $r['seccion'] . '</div><div style="margin-top:0px !important;" class="label2">' . $r['catedratico'] . '</div>'; ?></div>
                            </td>
                            <td><?php echo $r['nombre']; ?></td>
                            <td><?php echo $r['catedratico']; ?></td>
                            <td><?php echo $r['bloque']; ?></td>
                            <td><?php echo $r['seccion']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" border="0" class="display hover" id="mover_almacen">
                <tr><td class="trash ui-widget-header ui-corner-all" title="Eliminar Horario de la tabla de reservaciones fijas(Arrastralo aqu&iacute;)"><center><img src="./images/trash.png"><br>Eliminar Horario<br></center></td></tr>
            </table>
        </div>
    </div>
    <div class="tabla_salas">
        <?php
        $s = $salas->result_array();
        $numreg = $salas->num_rows();
        $porcentaje = (100 / $numreg) - 0.4;
        echo ' <div id="tabs">' . PHP_EOL . '<ul>' . PHP_EOL;
        for ($is = 0; $is < $numreg; $is++) {
            echo '<li style="width:' . $porcentaje . '%"><a style="width:98%;" onclick="sala_actual(' . $s[$is]["idSala"] . ')" href="#tabs-' . $s[$is]["idSala"] . '">&nbsp;&nbsp;Sala ' . $s[$is]["Sala"] . '&nbsp;&nbsp;&nbsp;</a></li>' . PHP_EOL;
        }
        echo '</ul>' . PHP_EOL;

        for ($i = 0; $i < $numreg; $i++) {
            $tmp_sal = $s[$i]["idSala"];
            if ($i == 0) {
                $sala_actual_1 = $tmp_sal;
            }
            ?>
            <div id="tabs-<?php echo $s[$i]["idSala"]; ?>">
                <br/>
                <div class="row1r" id="dragte<?php echo $i; ?>">
                    <div class="" id="right">
                        <div class="ui-grid ui-widget ui-widget-content ui-corner-all">
                            <div class="ui-grid-header ui-widget-header ui-corner-top">Tabla de Tiempos de Reservaciones Fijas en la Sala:<?php echo $s[$i]["Sala"] ?></div>
                            <table id="table2<?php echo $s[$i]["idSala"]; ?>" class="ui-grid-content ui-widget-content" style=" width: 100%" >
                                <tbody>
                                    <tr>
                                        <td class="mark blank reporte">
                                            <input type="checkbox" id="report" title="Ver reporte de Experiencia Educativa"/><label for="report"><img src="./images/reporte_min.ico"/>&nbsp;Rep.</label>
                                        </td>
                                        <td class="mark blank ui-state-default">Lunes</td>
                                        <td class="mark blank ui-state-default">Martes</td>
                                        <td class="mark blank ui-state-default">Miercoles</td>
                                        <td class="mark blank ui-state-default">Jueves</td>
                                        <td class="mark blank ui-state-default">Viernes</td>
                                        <td class="mark blank ui-state-default">Sabado</td>
                                    </tr>
                                    <?php
                                    foreach ($datos_salas[$s[$i]["idSala"]] as $r) {
                                        echo $r;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div style="text-align: center;" id="message<?php echo $i; ?>" class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">
                                Mensajes !
                            </div>
                        </div> 
                    </div><!-- right container -->                
                </div><!-- drag container -->
                <br/>
            </div><!--Fin una tab-->
            <?php
        }
        echo '</div><!--Fin del tabs-->';
        ?>
        <br/>
    </div>
</div>

<script type="text/javascript">
    var dt_actividades,
    selected_tab;
    
    var sala_select=<?php echo $sala_actual_1; ?>;
    
    function info_act(act,resp,blo,sec){
        $('#mensaje').html('<div id="info_actividad" title="'+act+'" class="hide">'+
            '<p><div><blockquote><b>Catedr&aacute;tico/encargado:&nbsp;&nbsp;</b>'+resp+'.<br><b>Bloque:&nbsp;&nbsp;&nbsp;</b>'+blo+
            '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Secci&oacute;n:&nbsp;&nbsp;&nbsp;</b>'+sec+
            '</blockquote></div></p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#info_actividad").dialog({
            autoOpen: false,
            resizable: false,
            width: 400,
            modal: false,
            buttons: {
                Cerrar: function() {
                    $( this ).dialog( "close" );
                }
            }
        }).dialog("open");
        
    }
    /*Funcion para aplicar filtro global en el datatable actividades*/
    function fnFilterGlobal (){
        $('#tabla_actividades').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable actividades*/
    function fnFilterColumn ( i ){
        $('#tabla_actividades').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }
    
    function sala_actual(idsala){
        sala_select=idsala;
        selected_tab = $tabs.tabs('option', 'selected');
    }
    
    $(document).ready(function() {
        $('#tabla_actividades_filter .buscar_dt').live('keydown',function(){
            rd.init('drag0');
        });
        $('#tabla_actividades_filter .buscar_dt').live('blur',function(){
            rd.init('drag0');
        });
        $('#tabla_actividades_wrapper .ui-button').live('click',function(){
            rd.init('drag0');
        });
        var $tabs = $('#tabs').tabs();
        //var selected = $tabs.tabs('option', 'selected');
        
<?php
echo '//index' . $val;
if (isset($val) && ($val != 0)) {
    echo '$tabs.tabs(\'select\', $val);';
}else
    echo '//nohay nada';
?>
        
        $('.ui-state-focus').hover(
        function(){ $(this).addClass('ui-state-highlight');},
        function(){ $(this).removeClass('ui-state-highlight');}
    );
        
        dt_actividades=$('#tabla_actividades').dataTable( {
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div style=\"width=70%;\" class=\"ui-widget-header boxshadowround\"><strong>Cargando</strong></div>",
                "sLengthMenu":   "<img title=\"Ver Busqueda Avanzada\"  class=\"ui-state-default ui-corner-all\" id=\"b_avan\" src=\"./images/busqueda.png\"> ",
                "sZeroRecords":  "No hay resultados",
                "sInfo":         "_TOTAL_ Actividades",
                "sInfoEmpty":    "0 Equipos",
                "sInfoFiltered": "",
                "sInfoPostFix":  "",
                "sSearch":       "",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sPrevious": "Anterior",
                    "sNext":     "Siguiente",
                    "sLast":     "Último"
                } 
            },
            "iDisplayLength": 12,
            "aLengthMenu": [[12], [12]]
                
        } );
        $("#global_filter").keyup( fnFilterGlobal );
        $("#global_regex").click( fnFilterGlobal );
        $("#global_smart").click( fnFilterGlobal );
				
        $("#col2_filter").keyup( function() { fnFilterColumn( 1 ); } );
        $("#col2_regex").click(  function() { fnFilterColumn( 1 ); } );
        $("#col2_smart").click(  function() { fnFilterColumn( 1 ); } );
				
        $("#col3_filter").keyup( function() { fnFilterColumn( 2 ); } );
        $("#col3_regex").click(  function() { fnFilterColumn( 2 ); } );
        $("#col3_smart").click(  function() { fnFilterColumn( 2 ); } );
        
        $("#col4_filter").keyup( function() { fnFilterColumn( 3 ); } );
        $("#col4_regex").click(  function() { fnFilterColumn( 3 ); } );
        $("#col4_smart").click(  function() { fnFilterColumn( 3 ); } );
        
        $("#col5_filter").keyup( function() { fnFilterColumn( 4 ); } );
        $("#col5_regex").click(  function() { fnFilterColumn( 4 ); } );
        $("#col5_smart").click(  function() { fnFilterColumn( 4 ); } );
        
        $('#b_avan').click(function(){
            $("#dialog:ui-dialog").dialog( "destroy" );
            $("#busqueda_avanzada").dialog({
                autoOpen: false,
                resizable: true,
                width:700,
                modal: false,
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                    }
                }
            }).dialog("open"); 
            
        });
        
        verOcultarColDT(1,dt_actividades);
        verOcultarColDT(2,dt_actividades);
        verOcultarColDT(3,dt_actividades);
        verOcultarColDT(4,dt_actividades);
        $('#b_avan').hover(function(){
            $(this).addClass('ui-state-active ui-corner-all');
        }, function(){
            $(this).removeClass('ui-state-active');
        })
        $(".buscar_dt" ).attr('title','Busqueda r&aacute;pida.');
        
        $('.hover tbody td').hover(
        function(){ $(this).addClass('ui-state-active');},
        function(){ $(this).removeClass('ui-state-active');}
    );  
    }); 
</script>
<script type="text/javascript">
    "use strict";

    var redips_init,		// definir la variable redips_init
    initXMLHttpClient,	// crear XMLHttp request object in a cross-browser manner
    send_request,		// send AJAX request
    request,			// XMLHttp request object
    print_message,           // print message
    report,			// function shows subject occurring in timetable
    report_button,	// show/hide report buttons
    show_all,
    div_nl;
    var rd;
        		

    // redips initialization
    redips_init = function () {
        // reference to the REDIPS.drag object
        rd = REDIPS.drag;
        rd.init('drag0');         
        rd.drop_option = 'single';	
        rd.hover.color_td = '#9BB3DA';
        rd.trash_ask = false;
        
        rd.myhandler_dropped = function () {
            //obtener la posicion
            var pos = rd.get_position();
            try {
                var respuesta=ajax_peticion('index.php/reservaciones_fijas/guardarhorario?p=' + rd.obj.id + '_' + pos.join('_'),'id_sala='+sala_select);
                if (respuesta=='ok'){
                    notificacion_tip("./images/msg/ok.png","Reservaciones fijas","La actualizaci&oacute;n se realiz&oacute;, de manera correcta.");
                }else{
                    mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,false);
                }
            } catch(e) {
                mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',e.name,'-'+e.message,400,false);
            }
        };
        // borrar de la tabla de tiempos
        rd.myhandler_deleted = function () {
            $('#mensaje').html('<div id="mover_almacen_dialog" title="Mover a almacen" style="display:none;">'+
                '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
                '&nbsp;&nbsp;Se mover&aacute; el equipo seleccionado al almac&eacute;n. ¿Deseas Continuar?</p></div>');
            $("#dialog:ui-dialog").dialog( "destroy" );
            $("#mover_almacen_dialog").dialog({
                autoOpen: false,
                resizable: false,
                modal: true,
                buttons: {
                    "Eliminar": function() {
                        //obtener la posicion del elemento
                        var pos = rd.get_position(),
                        row = pos[4],
                        col = pos[5];
                        try {
                            var respuesta=ajax_peticion('index.php/reservaciones_fijas/eliminarhorario?p=' + rd.obj.id + '_' + row + '_' + col,'id_sala='+sala_select);
                            if (respuesta=='ok'){
                                notificacion_tip("./images/msg/ok.png","Eliminar Horario","Se elimin&oacute; el horario de manera correcta.");
                            }else{
                                mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,false);
                            }
                        } catch(e) {
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',e.name,'-'+e.message,400,false);
                        }
                        $( this ).dialog( "close" );
                    },
                    Cancelar: function() {
                        redirect_to('reservaciones_fijas?tindex='+selected_tab);
                        $( this ).dialog( "close" );
                    }
                }
            }).dialog("open");
        };
        
        rd.myhandler_clicked = function () {
        
        };
        // print message to the message line
        //print_message('Los cambios realizados en la tabla de tiempos de reservaciones fijas serán guardados inmediatamente...');
    };
    // add onload event listener
    if (window.addEventListener) {
        window.addEventListener('load', redips_init, false);
    }
    else if (window.attachEvent) {
        window.attachEvent('onload', redips_init);
    }
</script> 
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>