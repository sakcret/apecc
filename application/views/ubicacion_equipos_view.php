<div id="datos_equipo_select" title="Datos del Equipo" style="display: none;">
    <h2>DATOS DEL EQUIPO</h2><hr class="boxshadowround">
    <div id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" style="width: 97.8%; margin-top: 10px;">
        <div class="ui-grid-header ui-widget-header ui-corner-top" style=" font-size: 12px !important;">Datos de la Actividad a asignar</div>
        <table id="tb_datos_asign" class="ui-grid-content ui-widget-content" style=" width: 100%" >
            <tbody>
                <tr >
                    <td width="30%" class="ui-state-focus">N&uacute;mero de Serie:</td>
                    <td width="70%" class="ui-state-focus" style=" text-align: left;" id="dt_ns"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Marca:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_ma"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Modelo:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_mo"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">N&uacute;mero de Inventario:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_ni"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Procesador:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_pr"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Disco duro:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_dd"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">RAM:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_ram"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Estado:</td>
                    <td class="ui-state-focus" style=" text-align: left;" id="dt_edo"></td>
                </tr>
            </tbody>
        </table>
        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">
        </div>
    </div>
</div>
<div align="center" title="Busqueda Avanzada de Equipos" id="busqueda_avanzada" class="hide" style=" width: 70%;">
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
                    <td align="center"><input type="text"     name="global_filter" id="global_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="global_regex"  id="global_regex" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="global_smart"  id="global_smart"  checked></td>
                </tr>
                <tr id="filter_col1">
                    <td align="left">N&uacute;mero de Serie</td>
                    <td align="center"><input type="text"     name="col1_filter" id="col1_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_regex"  id="col1_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_smart"  id="col1_smart" checked></td>
                </tr>
                <tr id="filter_col2">
                    <td align="left">Marca</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">Modelo</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">N&uacute;mero de Inventario</td>
                    <td align="center"><input type="text"     name="col4_filter" id="col4_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_regex"  id="col4_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_smart"  id="col4_smart" checked></td>
                </tr>
                <tr id="filter_col5">
                    <td align="left">Procesador</td>
                    <td align="center"><input type="text"     name="col5_filter" id="col5_filter" class="text ui-widget-content ui-corner-all" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_regex"  id="col5_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_smart"  id="col5_smart" checked></td>
                </tr>
                <tr id="filter_col6">
                    <td align="left">Disco Duro(GB)</td>
                    <td align="center"><input type="text"     name="col6_filter" id="col6_filter" class="text ui-widget-content ui-corner-all" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col6_regex"  id="col6_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col6_smart"  id="col6_smart" checked></td>
                </tr>
                <tr id="filter_col7">
                    <td align="left">Memoria RAM(GB)</td>
                    <td align="center"><input type="text"     name="col7_filter" id="col7_filter" class="text ui-widget-content ui-corner-all" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col7_regex"  id="col7_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col7_smart"  id="col7_smart" checked></td>
                </tr>
                <tr id="filter_col8">
                    <td align="left">Estado(solo la letra clave)</td>
                    <td align="center"><input type="text"     name="col8_filter" id="col8_filter" class="text ui-widget-content ui-corner-all" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col8_regex"  id="col8_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col8_smart"  id="col8_smart" checked></td>
                </tr>
            </tbody>
        </table>
    </center>
</div>
<div style=" margin-top: 10px; margin-bottom: 12px;" class="ui-corner_all boxshadowround">
    <table width="100%" border="0">
        <tr>
            <td id="ayuda_edos_equ" width="16%"><img src="./images/ayuda.png"/>&nbsp;Estado de equipos:</td>
            <td width="14%"><img src="./images/pc_edos/pc_O_min.png"/>&nbsp;Ocupado</td>
            <td width="14%"><img src="./images/pc_edos/pc_L_min.png"/>&nbsp;Libre</td>
            <td width="14%"><img src="./images/pc_edos/pc_C_min.png"/>&nbsp;En Clase o Curso</td>
            <td width="14%"><img src="./images/pc_edos/pc_D_min.png"/>&nbsp;Descompuesto</td>
            <td width="14%"><img src="./images/pc_edos/pc_M_min.png"/>&nbsp;Mantenimiento</td>
            <td width="14%"><img src="./images/pc_edos/pc__min.png"/>&nbsp;Sin estado</td>
        </tr>
    </table>
</div>
<div id="drag0"  class="row1">
    <div class="tabla_equipos_almacen ui-widget-content ui-corner-all"> 
        <div id="content_almacen"> 
            <table cellpadding="0" cellspacing="0" border="0" class="display hover" id="mover_almacen">
                <tr><td class="trash ui-widget-header ui-corner-all" title="Mover equipo al almac&eacute;n (Arrastra el equipo aqu&iacute;)"><center><img src="./images/almacen0.png"><br>Mover a Almac&eacute;n<br></center></td></tr>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" border="0" class="display" width="100%" id="tabla_almacen">
                <thead>
                    <tr>
                        <th class="mark blank">numserie</th>
                        <th>marca</th>
                        <th>modelo</th>
                        <th>procesador</th>
                        <th>ram</th>
                        <th>dd</th>
                        <th>edo</th>
                        <th style="display: none;" class="mark blank"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <br>
            <table cellpadding="0" cellspacing="0" border="0" class="display hover" id="mover_almacen">
                <tr><td class="trash ui-widget-header ui-corner-all" title="Mover equipo al almac&eacute;n (Arrastra el equipo aqu&iacute;)"><center><img src="./images/almacen0.png"><br>Mover a Almac&eacute;n<br></center></td></tr>
            </table>
        </div>
    </div>
    <div class="tabla_salas">
        <?php
        $tmp_row = $tmp_col = $tmp_sal = 0;
        $es = $equipos_salas->result_array();
        $sala_actual_1 = 0;

        function get_key_array($array, $f, $c, $s) {
            $newa = array();
            for ($x = 0; $x < count($array); $x++) {
                if (($array[$x]['idSala'] == $s) && ($array[$x]['Fila'] == $f) && ($array[$x]['Columna'] == $c)) {
                    $newa = $array[$x];
                }
            }
            return $newa;
        }

        $s = $salas->result_array();
        $numreg = $salas->num_rows();
        $porcentaje = (100 / $numreg) - 1;
        echo ' <div style="margin-bottom: 20px;" id="tabs">' . PHP_EOL . '<ul>' . PHP_EOL;
        for ($is = 0; $is < $numreg; $is++) {
            echo '<li style="width:' . $porcentaje . '%"><a onclick="sala_actual(' . $s[$is]["idSala"] . ')" href="#tabs-' . $s[$is]["idSala"] . '">&nbsp;&nbsp;Sala ' . $s[$is]["Sala"] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>' . PHP_EOL;
        }
        echo '</ul>' . PHP_EOL;

        for ($i = 0; $i < $numreg; $i++) {
            $tmp_sal = $s[$i]["idSala"];
            $num_eq = 0;
            if ($i == 0) {
                $sala_actual_1 = $tmp_sal;
            }
            ?>
            <div id="tabs-<?php echo $s[$i]["idSala"]; ?>">
                <br/>
                <div id="drag<?php echo $s[$i]["idSala"]; ?>" style="width:900px;">
                    <center>
                        <div class="ui-grid ui-widget ui-widget-content ui-corner-all">
                            <div class="ui-grid-header ui-widget-header ui-corner-top">Ubicaci&oacute;n de equipos en la sala: <?php echo $s[$i]["Sala"]; ?></div>
                            <table align="center" id="<?php echo $s[$i]["idSala"]; ?>" style=" width: 100%" class="ui-grid-content ui-widget-content hover">
                                <thead align="center">
                                    <tr>
                                        <th class="mark blank"><img src="./images/borrar_todo.png" onclick="libera_sala('<?php echo $s[$i]["idSala"] . '\',\'' . $s[$i]["Sala"]; ?>')" title="Mover todos los equipos de la sala <?php echo $s[$i]["Sala"]; ?> al almac&eacute;n  "></th>
                                        <?php
                                        $index_col = 'A';
                                        for ($j = 0; $j < $s[$i]["Columnas"]; $j++) {
                                            echo '<th height=30 class="ui-state-default mark blank" style="font-size: 20px;">' . $index_col . '</th>' . PHP_EOL;
                                            $index_col++;
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $index_row = $s[$i]["Indice"];
                                    for ($fi = 0; $fi < $s[$i]["Filas"]; $fi++) {
                                        $tmp_row = $fi + 1;
                                        echo '<tr>' . PHP_EOL;
                                        echo '<th width=30 class="mark blank ui-state-default" style="font-size: 20px;">' . $index_row . '</th>' . PHP_EOL;
                                        for ($co = 0; $co < $s[$i]["Columnas"]; $co++) {
                                            $tmp_col = $co + 1;
                                            $temp = array();
                                            $temp = get_key_array($es, $tmp_row, $tmp_col, $tmp_sal);
                                            $valores = array_values($temp);
                                            (array_key_exists(0, $valores)) ? $numeroSerie = $valores[0] : $numeroSerie = '';
                                            (array_key_exists(4, $valores)) ? $estado = $valores[4] : $estado = '';
                                            echo '<td width="130" height="120" class="ui-state-focus">';
                                            if ($numeroSerie != '') {
                                                echo
                                                "<center><div align=\"center\" id=\"" . $numeroSerie . "\" class=\"drag mark blank\">
                                                    <img style=\"width: 100px !important;\" ondblclick=\"datos_equipo('" . $numeroSerie . "')\" class=\"img_resize mark blank \" src=\"./images/pc_edos/pc_" . $estado . ".png\"/>
                                                        <div>" . $numeroSerie . "</div></div>";
                                                $num_eq++;
                                            }
                                            echo '</td>' . PHP_EOL;
                                        }
                                        echo '</tr>' . PHP_EOL;
                                        $index_row--;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">
                                <span id="mensaje_<?php echo $s[$i]["idSala"]; ?>">&nbsp;<span class="total-eq"><?php echo $num_eq; ?> Equipos</span></span>
                            </div>
                        </div> 
                    </center>
                </div> 
                <br/>
            </div><!--Fin una tab   <div class="drag"><!--img id="' . $numeroSerie . '" src="./images/pc_edos/pc_' . $estado . '.png">'.$numeroSerie.'</div>';-->
            <?php
        }
        echo '</div><!--Fin del tabs-->';
        ?>
    </div>
</div>
<style>
    .tabla_equipos_almacen{
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
        width: 80%;
        float: right;
        margin-right: 20px;
    }
    .row1{
        width: 100%;
        margin: 0 auto;
        overflow: hidden;
    }
    .total-eq{margin-right: 15px; font-weight: bolder; float: right !important;}

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

    /* drag objects (DIV inside table cells) */
    .drag{
        cursor: move;
        margin: auto;
        z-index: 10;
        color: #222;
        text-align: center;
        opacity: 0.9;
        filter: alpha(opacity=70);
        width: auto !important;
        border: 0px solid #555;
        border-radius: 3px;
        -moz-border-radius: 3px; 
        font-size: 13px !important; 
    }
</style>
<script>
    var dt_tabla_almacen;
    var sala_select=<?php echo $sala_actual_1; ?>;
    
    /*Funcion para aplicar filtro global en el datatable equipos*/
    function fnFilterGlobal (){
        $('#tabla_almacen').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable equipos*/
    function fnFilterColumn ( i ){
        $('#tabla_almacen').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }	
    
    function sala_actual(idsala){
        sala_select=idsala;
    }
    function getStringEdo(edo){
        var estado='';
        switch(edo){
            case 'L':
                estado='Libre';
                break;
            case 'O':
                estado='Reservado';
                break;
            case 'C':
                estado='En clase';
                break;
            case 'D':
                estado='Descompuesto';
                break;
            case 'M':
                estado='Mantenimiento';
                break;
            default:
                estado='Sin Estado (En almac&eacute;n)';
                break;
        }
        return estado;
    }

    function datos_equipo(ns){
        var respuesta=ajax_peticion_json("index.php/equipos/getEquipo",'id='+ns);
        if(respuesta!=false&&respuesta!=null){
            $('#dt_ns').text(respuesta.ns); 
            $('#dt_ma').text(respuesta.ma); 
            $('#dt_mo').text(respuesta.mo); 
            $('#dt_ni').text(respuesta.ni); 
            $('#dt_pr').text(respuesta.pr); 
            $('#dt_dd').text(respuesta.dd); 
            $('#dt_ram').text(respuesta.ram); 
            $('#dt_edo').html('<img src="./images/pc_edos/pc_'+respuesta.edo+'_min.png "/>&nbsp;&nbsp;&nbsp;'+getStringEdo(respuesta.edo)); 
            $("#dialog:ui-dialog").dialog( "destroy" );
            $("#datos_equipo_select").dialog({
                autoOpen: false,
                width:600,
                modal: false,
                buttons: {
                    "Cerrar": function() {
                        $( this ).dialog( "close" );
                    }
                }
            }).dialog("open"); 
        }
    }
    
    function get_datos_almacen(){
        dt_tabla_almacen.fnClearTable();//borro los datos del datatable
        var respuesta=ajax_peticion_json("index.php/ubicacion_equipos/datosEquiposAlmacenJson",'');
        if(respuesta!=false&&respuesta!=null){
            var a=[];
            $.each(respuesta, function(k,v){
                a[k]=[v.ns,v.ma,v.mo,v.pr,v.rm,v.dd,v.ed,'<div id="'+v.ns+'" align="center" class="mark blank drag">'+
                        '<img style="width: 100px !important;" ondblclick="datos_equipo(\''+v.ns+'\')" src="./images/pc_edos/pc_' +v.ed+ '.png"/>'+
                        ' <div>' +v.ns+ '</div></div>'
                ];});
            dt_tabla_almacen.fnAddData(a);
        }
    }
    
    function libera_sala(idsala,sala){
        $('#mensaje').html('<div id="mover_almacen_todos_dialog" title="Mover a almacen" style="display:none;">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se moveran todos los equipos de la sala '+sala+' al almac&eacute;n. ¿Deseas Continuar?</p></div>');
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#mover_almacen_todos_dialog").dialog({
            autoOpen: false,
            width:400,
            modal: true,
            buttons: {
                "Mover equipos a almacén": function() {;
                    var respuesta=ajax_peticion('index.php/ubicacion_equipos/moverAlmacenTodos','id_sala='+sala_select);
                    if (respuesta=='ok'){
                        notificacion_tip("./images/msg/ok.png","Mover Todos los equipos Equipos al Almac&eacute;n","Se movieron todos los equipos de la sala "+sala+" al almac&eacute;n");
                        redirect_to('ubicacion_equipos');
                    }else{
                        mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,false);
                    }
                    $( this ).dialog( "close" );
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        }).dialog("open"); 
    }
    
    $(document).ready(function() {
        
        dt_tabla_almacen=$('#tabla_almacen').dataTable( {
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div style=\"width=70%;\" class=\"ui-widget-header boxshadowround\"><strong>Cargando</strong></div>",
                "sLengthMenu":   "<img title=\"Ver Busqueda Avanzada\"  class=\"ui-state-default ui-corner-all\" id=\"b_avan\" src=\"./images/busqueda.png\">",
                "sZeroRecords":  "No hay resultados",
                "sInfo":         "_TOTAL_ Equipos",
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
            "iDisplayLength": 4,
            "aLengthMenu": [[4], [4]]
        } );
    
        verOcultarColDT(0,dt_tabla_almacen);
        verOcultarColDT(1,dt_tabla_almacen);
        verOcultarColDT(2,dt_tabla_almacen);
        verOcultarColDT(3,dt_tabla_almacen);
        verOcultarColDT(4,dt_tabla_almacen);
        verOcultarColDT(5,dt_tabla_almacen);
        verOcultarColDT(6,dt_tabla_almacen);
        
        /*Aplicar filtro al datatables (busqueda avanzada)*/
        $("#global_filter").keyup( fnFilterGlobal );
        $("#global_regex").click( fnFilterGlobal );
        $("#global_smart").click( fnFilterGlobal );
				
        $("#col1_filter").keyup( function() { fnFilterColumn( 0 ); } );
        $("#col1_regex").click(  function() { fnFilterColumn( 0 ); } );
        $("#col1_smart").click(  function() { fnFilterColumn( 0 ); } );
				
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
       
        $("#col6_filter").keyup( function() { fnFilterColumn( 5 ); } );
        $("#col6_regex").click(  function() { fnFilterColumn( 5 ); } );
        $("#col6_smart").click(  function() { fnFilterColumn( 5 ); } );
       
        $("#col7_filter").keyup( function() { fnFilterColumn( 6 ); } );
        $("#col7_regex").click(  function() { fnFilterColumn( 6 ); } );
        $("#col7_smart").click(  function() { fnFilterColumn( 6 ); } );
       
        $("#col8_filter").keyup( function() { fnFilterColumn( 7 ); } );
        $("#col8_regex").click(  function() { fnFilterColumn( 7 ); } );
        $("#col8_smart").click(  function() { fnFilterColumn( 7 ); } );
        
        get_datos_almacen();
        $('.hover tbody td').hover(
        function(){ $(this).addClass('ui-state-active');},
        function(){ $(this).removeClass('ui-state-active');}
    );     
        $("#tabla_almacen tbody tr").click( function( e ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
            }
            else {
                dt_tabla_almacen.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
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
        
        $('#tabla_almacen_filter .buscar_dt').keydown(function(){
            rd.init('drag0');
        });
        $('#tabla_almacen_filter .buscar_dt').focus(function(){
            rd.init('drag0');
        });
        $('#tabla_almacen_wrapper .ui-button').click(function(){
            rd.init('drag0');
        });
        //$('#tabla_almacen').find('td').addClass('ui-state-focus');
        $('#b_avan').hover(function(){
            $(this).addClass('ui-state-active ui-corner-all');
        }, function(){
            $(this).removeClass('ui-state-active');
        })
        
        $("tbody tr").find('.row_selected').addClass('ui-state-highlight');
        $("#tabs" ).tabs();
        $(".buscar_dt" ).attr('title','Proporciona el N&uacute;mero de serie del equipo a buscar.');
    });
</script>
<script type="text/javascript">
    "use strict";

    var redips_init; // definir la variable redips_init
    var rd;
    //redips inicializacion
    redips_init = function () {
        // referencia al objeto REDIPS.drag 
        rd = REDIPS.drag; 
        rd.init('drag0');        
        rd.drop_option = 'single';	
        rd.hover.color_td = '#9BB3DA';
        rd.trash_ask = false;
        
        rd.myhandler_dropped = function () {
            //obtener la posicion 
            try {       
                var pos = rd.get_position();
                //alert(rd.obj.id + '_' + pos.join('_'));
                var respuesta=ajax_peticion('index.php/ubicacion_equipos/actualizarSalaEquipo?p=' + rd.obj.id + '_' + pos.join('_'),'id_sala='+sala_select);
                if (respuesta=='ok'){
                    notificacion_tip("./images/msg/ok.png","Ubicacion de equipos","La actualizaci&oacute;n se realiz&oacute;, de manera correcta.");
                }else{
                    mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,false);
                    //window.setTimeout(redirect_to('ubicacion_equipos'),40000);
                }
                get_datos_almacen();
                rd.init('drag0');
                $("tbody tr").find('.row_selected').addClass('ui-state-highlight');
            } catch(e) {
                alert(e.name + " - "+e.message);
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
                            var respuesta=ajax_peticion('index.php/ubicacion_equipos/moverAlmacen?p=' + rd.obj.id + '_' + row + '_' + col,'id_sala='+sala_select);
                            if (respuesta=='ok'){
                                get_datos_almacen();
                                rd.init('drag0');
                                notificacion_tip("./images/msg/ok.png","Mover Equipo a Almac&eacute;n","Se movi&oacute; el equipo "+rd.obj.id+' al almac&eacute;');
                            }else{
                                mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,false);
                            }
                        } catch(e) {
                            alert(e.name + " - "+e.message);
                        }
                        $( this ).dialog( "close" );
                    },
                    Cancelar: function() {
                        //redirect_to('ubicacion_equipos');
                        $( this ).dialog( "close" );
                    }
                }
            }).dialog("open"); 
        };
        
        rd.myhandler_clicked = function () {
        
        };
    };
    
    // agregar onload listener
    if (window.addEventListener) {
        window.addEventListener('load', redips_init, false);
    }
    else if (window.attachEvent) {
        window.attachEvent('onload', redips_init);
    }
</script> 
