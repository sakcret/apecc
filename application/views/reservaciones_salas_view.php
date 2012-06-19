<div id="dialog-elimina" title="Cancelar reservaci&oacute;n de Sala" class="hide">
    <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
        &nbsp;&nbsp;Se cancelar&aacute; la reservaci&oacute;n Seleccionada. ¿Deseas Continuar?</p>
</div>
<div id="f_agregar_reserva_sala" title="Agregar una Reservaci&oacute;n de Sala" class="hide">
    <p class="form_tips">Los campos marcados con * son obligatorios.</p>
    <form id="form_agrega_reservsala">
        <fieldset>
            <table width="100%" border="1">
                <tr>
                    <td colspan="3"><label for="sala">Sala*:</label>
                        <select name="sala" id="sala"/>
                        </select>
                </tr>
                <tr>
                    <td colspan="3"><label for="nombre_act" >Nombre de la actividad*:</label>
                        <input type="text" name="nombre_act" id="nombre_act" maxlength="100" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="encargado">Encargado*:</label><br>
                        <select name="encargado" id="encargado"/>
                        </select>
                </tr>
                <tr>
                    <td><label for="hora_inicio">Hora de Inicio*:</label>
                        <input type="text" name="hora_inicio" id="hora_inicio" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="hora_fin">Hora de Fin*:</label>
                        <input type="text" name="hora_fin" id="hora_fin" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td><label for="fecha_inicio">Fecha de Inicio*:</label>
                        <input type="text" name="fecha_inicio" id="fecha_inicio" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="fecha_fin">Fecha de Fin*:</label>
                        <input type="text" name="fecha_fin" id="fecha_fin" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
            </table>	
        </fieldset>
    </form>
</div>

<div id="f_modificar_reservsala" title="Modificar Reservaci&oacute;n de Sala" class="hide">
    <p class="m_form_tips">Los campos marcados con * son obligatorios.</p>
    <form id="form_modifica_reservsala">
        <fieldset>
            <table width="100%" border="1">
                <tr>
                    <td colspan="3"><label for="m_sala">Sala*:</label>
                        <select name="m_sala" id="m_sala"/>
                        </select>
                </tr>
                <tr>
                    <td colspan="3"><label for="m_nombre_act" >Nombre de la actividad*:</label>
                        <input type="text" name="m_nombre_act" id="m_nombre_act" maxlength="100" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="m_encargado">Encargado*:</label><br>
                        <select name="m_encargado" id="m_encargado"/>
                        </select>
                </tr>
                <tr>
                    <td><label for="m_hora_inicio">Hora de Inicio*:</label>
                        <input type="text" name="m_hora_inicio" id="m_hora_inicio" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="m_hora_fin">Hora de Fin*:</label>
                        <input type="text" name="m_hora_fin" id="m_hora_fin" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td><label for="m_fecha_inicio">Fecha de Inicio*:</label>
                        <input type="text" name="m_fecha_inicio" id="m_fecha_inicio" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="m_fecha_fin">Fecha de Fin*:</label>
                        <input type="text" name="m_fecha_fin" id="m_fecha_fin" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
            </table>	
        </fieldset>
    </form>
</div>
<br/>
<div align="center" id="ver_campos" class="hide row ui-widget-content ui-corner-all boxshadowround" style=" width: 100%;">
    <center>
        <div class="ui-widget-header ui-corner-top header"><h1>Ver/Ocultar Campos</h1></div>
        <div id="vo_campos" style=" margin-bottom: 10px; margin-top: 10px;">
            <input type="checkbox" onclick="verOcultarColDT(1,dt_reservsalas);" checked="checked" name="vo_sala" id="vo_sala" ><label for="vo_sala">Sala</label>
            <input type="checkbox" onclick="verOcultarColDT(2,dt_reservsalas);" checked="checked" name="vo_actividad" id="vo_actividad" ><label for="vo_actividad">Nombre de la Actividad</label>
            <input type="checkbox" onclick="verOcultarColDT(3,dt_reservsalas);" checked="checked" name="vo_encargado" id="vo_encargado" ><label for="vo_encargado">Encargado</label>
            <input type="checkbox" onclick="verOcultarColDT(4,dt_reservsalas);" checked="checked" name="vo_fecha_inicio" id="vo_fecha_inicio" ><label for="vo_fecha_inicio">Fecha de Inicio</label>
            <input type="checkbox" onclick="verOcultarColDT(5,dt_reservsalas);" checked="checked" name="vo_fecha_fin" id="vo_fecha_fin" ><label for="vo_fecha_fin">Fecha Fin</label>
            <input type="checkbox" onclick="verOcultarColDT(6,dt_reservsalas);" checked="checked" name="vo_hora_inicio" id="vo_hora_inicio" ><label for="vo_hora_inicio">Hora Inicio</label>
            <input type="checkbox" onclick="verOcultarColDT(7,dt_reservsalas);" checked="checked" name="vo_hora_fin" id="vo_hora_fin" ><label for="vo_hora_fin">Hora Fin</label>
        </div>
    </center>
</div>
<div align="center" id="busqueda_avanzada" class="hide row ui-widget-content ui-corner-all boxshadowround" style=" width: 70%;">
    <center>
        <div class="ui-widget-header ui-corner-top header"><h1>Busqueda Avanzada de Equipos</h1></div>
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
                <tr id="filter_col2">
                    <td align="left">Marca</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">hora_inicio</td>
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
                    <td align="left">encargado</td>
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
                <!--tr id="filter_col9">
                    <td align="left">Descripci&oacute;n</td>
                    <td align="center"><input type="text"     name="col9_filter" id="col9_filter" class="text ui-widget-content ui-corner-all" ></td>
                    <td align="center"><input type="checkbox" name="col9_regex"  id="col9_regex"></td>
                    <td align="center"><input type="checkbox" name="col9_smart"  id="col9_smart" checked></td>
                </tr-->
            </tbody>
        </table>
    </center>
</div><br>
<div class="row">
    <div class="twelvecol last">

        <div class="ui-widget-header ui-corner-all" style=" margin-bottom: 0px;">
            <div class="ui-widget-header ui-corner-all" style=" margin-bottom: 0px; height: 38px;">
                <div style="margin-top: 3px; margin-left: 6px;">
                    <button id="btn_actualiza"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_agregar"><img src="./images/agregar.png"/>&nbsp;Nueva Reservaci&oacute;n</button>
                    <button id="btn_modificar"><img src="./images/modificar.png"/>&nbsp;Modificar Reservaci&oacute;n</button>
                    <button id="btn_eliminar"><img src="./images/eliminar.png"/>&nbsp;Cancelar Reservaci&oacute;n</button>
                    <button style="height: 29px !important; width: 200px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                    <button style="height: 29px !important; width: 200px;" id="b_ver_campos"class="opc">Ver opciones de campos</button>
                </div>
            </div>
        </div><br>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="dtreservsalas">
            <thead>
                <tr>
                <tr>
                    <th>id</th>
                    <th>Sala</th>
                    <th>Actividad</th>
                    <th>Encargado</th>                
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Opciones</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="dataTables_empty">Cargando datos del servidor...</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>id</th>
                    <th>Sala</th>
                    <th>Actividad</th>
                    <th>Encargado</th>                
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table><br/>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    var dt_reservsalas;
    var row_select=0;
    
     
    var horas_src = [
        "07:00","08:00","09:00","10:00","11:00","12:00","13:00","14:00",
        "15:00","16:00","17:00","18:00","19:00","20:00","21:00"
    ];
    
    /*Funcion para aplicar filtro global en el datatable equipos*/
    function fnFilterGlobal (){
        $('#dtreservsalas').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable equipos*/
    function fnFilterColumn ( i ){
        $('#dtreservsalas').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }		
    
    function carga_encargados(){
        var c = get_value('usuarios/getUsuariosAcademicos','');
        $('[name="encargado"] option').remove();
        var todos="<option value='0'>Todos</option>";
        $('[name="encargado"]').append(todos);
        $('[name="encargado"]').append(c);
        $('#encargado').combobox();
        
    }
    function carga_salas(){
        var c = get_value('reservaciones_salas/getSalas','');
        $('[name="sala"] option').remove();
        var todos="<option value='0'>--Selecciona una sala--</option>";
        $('[name="sala"]').append(todos);
        $('[name="sala"]').append(c);
        $('#sala').selectmenu({style:'popup',width:230});
        
    }
    
    function carga_mencargados(){
        var c = get_value('usuarios/getUsuariosAcademicos','');
        $('[name="m_encargado"] option').remove();
        var todos="<option value='0'>Todos</option>";
        $('[name="m_encargado"]').append(todos);
        $('[name="m_encargado"]').append(c);
        $(document).ready(function() {
            $('#m_encargado').combobox();});
        
    }
    function carga_msalas(){
        var c = get_value('reservaciones_salas/getSalas','');
        $('[name="m_sala"] option').remove();
        var todos="<option value='0'>--Selecciona una sala--</option>";
        $('[name="m_sala"]').append(todos);
        $('[name="m_sala"]').append(c);
        $('#m_sala').selectmenu({style:'popup',width:230});
        
    }
    
    function cancelar_reservacion(id){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-elimina").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/reservaciones_salas/cancelarReservacion";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_reservsalas.fnDraw();
                        notificacion_tip("./images/msg/ok.png","Cancelar reserva&oacute;n de Sala","Se cancel&oacute; la reservaci&oacute;n satisfactoriamente.");
                    }else{
                        mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                    }
                    
                    $( this ).dialog( "close" );
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        }).dialog("open");    
    }
    
    function muestraDatosReservForm(id){
        $.ajax({
            url:"index.php/reservaciones_salas/getDatosReserv",
            type:"POST",
            dataType: "json",
            data: 'id='+id,
            success:
                function(data){
                $( "#m_nombre_act" ).val(data.no);
                $( "#m_encargado" ).val(data.ec);
                $( "#m_hora_inicio" ).val(data.hi);
                $( "#m_hora_fin" ).val(data.hf);
                $( "#m_fecha_inicio" ).val(data.fi);
                $( "#m_fecha_fin" ).val(data.ff);
                //$( "#m_sala" ).val(data.sa);
               
                $('#m_encargado').combobox();
                $( "#m_sala" ).selectmenu("value", data.sa);
                
            }
        })   
    }
    
    function modifica_reservacion(id){ 
        carga_mencargados();
        carga_msalas();
        var nombre_act = $( "#m_nombre_act" ),
        sala = $( "#m_sala" ),
        hora_inicio = $( "#m_hora_inicio" ),
        hora_fin = $( "#m_hora_fin" ),
        encargado = $( "#m_encargado" ),
        fecha_inicio = $( "#m_fecha_inicio" ),
        fecha_fin = $( "#m_fecha_fin" ),
        sala_ui=$( "#m_sala-button" ),
        ac_encargado=$('#form_modifica_reservsala .ui-autocomplete-input'),
        allFields = $( [] ).add( nombre_act ).add( sala).add(hora_inicio)
        .add(hora_fin).add(encargado).add(fecha_inicio).add(fecha_fin).add(sala_ui).add(ac_encargado),
        tips = $( ".m_form_tips" );
        muestraDatosReservForm(id);
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_reservsala" ).dialog({
            autoOpen: false,
            width: 430,
            modal: true,
            buttons: {
                "Modificar Reservación de Sala": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    $('#sala-button,#form_modifica_reservsala .ui-autocomplete-input').removeClass('ui-state-error');
                    bValid = bValid && verificaSelectUI(sala,$( "#m_sala-button" ),"Debe selecionar una sala",tips);
                    bValid = bValid && campoVacio(nombre_act,'Nombre de Actividad',tips);
                    bValid = bValid && verificaSelect(encargado,'Por favor seleciona un encargado',tips)
                    bValid = bValid && campoVacio($('#form_modifica_reservsala .ui-autocomplete-input'),'Nombre del Encargado',tips);
                    bValid = bValid && campoVacio(hora_inicio,'Hora de Inicio',tips);
                    bValid = bValid && validaCampoExpReg( hora_inicio,/^\[d{2}\:00]|[d{1}\:00]$/, "El formato de la hora de inicio debe ser: hh:00. Ejemplo: '01:00'",tips);         
                    bValid = bValid && campoVacio(hora_fin,'Hora de Fin',tips);
                    bValid = bValid && validaCampoExpReg( hora_fin,/^\[d{2}\:00]|[d{1}\:00]$/, "El formato de la hora de inicio debe ser: hh:00. Ejemplo: '01:00'",tips);         
                    bValid = bValid && campoVacio(fecha_inicio,'Fecha de Inicio',tips);
                    bValid = bValid && validaCampoExpReg( fecha_inicio,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);         
                    bValid = bValid && campoVacio(fecha_fin,'Fecha de Fin',tips);
                    bValid = bValid && validaCampoExpReg( fecha_fin,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);          
                    if ( bValid ) {  
                        var datos = $( "#form_modifica_reservsala" ).serialize()+'&id='+id;
                        alert(datos);
                        var urll="index.php/reservaciones_salas/modificaReservacion";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_reservsalas.fnDraw();
                            notificacion_tip("./images/msg/ok.png","Modificar Reservaci&oacute;n de Sala","La reservaci&oacute;n de la Sala se modific&oacute; satisfactoriamente.");
                        }else{
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,true);
                        }                 
                        $( this ).dialog( "close" );
                    }
                },
                Cancelar : function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");
    }
    
    $(document).ready(function() {
        var dates = $( "#fecha_inicio, #fecha_fin" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onSelect: function( selectedDate ) {
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
        
        var dates = $( "#m_fecha_inicio, #m_fecha_fin" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onSelect: function( selectedDate ) {
                var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
             
        $('#hora_inicio,#hora_fin,#m_hora_inicio,#m_hora_fin').autocomplete({
            source: horas_src
        });
                
        $( "#edoequipo,#edoequipo2" ).buttonset();
        /* selecciona una fila del datatable no aplica para server_aside proccessing*/
        $('#dtreservsalas tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select=0; 
            }else {
                dt_reservsalas.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_reservsalas);
                var datos=dt_reservsalas.fnGetData(anSelected[0]);
                row_select=datos[0];
            }
        } ); 
        
        /*Aplicar filtro al datatables (busqueda avanzada)*/
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
       
        $("#col6_filter").keyup( function() { fnFilterColumn( 5 ); } );
        $("#col6_regex").click(  function() { fnFilterColumn( 5 ); } );
        $("#col6_smart").click(  function() { fnFilterColumn( 5 ); } );
       
        $("#col7_filter").keyup( function() { fnFilterColumn( 6 ); } );
        $("#col7_regex").click(  function() { fnFilterColumn( 6 ); } );
        $("#col7_smart").click(  function() { fnFilterColumn( 6 ); } );
       
        $("#col8_filter").keyup( function() { fnFilterColumn( 7 ); } );
        $("#col8_regex").click(  function() { fnFilterColumn( 7 ); } );
        $("#col8_smart").click(  function() { fnFilterColumn( 7 ); } );
       
        /*ocultar y mostrar las ociones de filtro del datatable equipos(busqueda avanzada)*/
        $('#mas_opc_busq').button().click(function() {            
            if ($(this).html() == 'Ocultar busqueda avanzada') {                
                $('#busqueda_avanzada').hide('clip', 'slow');                               
                $(this).html('Ver busqueda avanzada');
            }
            else {
                $('#busqueda_avanzada').show('clip');                
                $(this).html('Ocultar busqueda avanzada', 'slow');                                 
            }            
        });
        
        /*ocultar y mostrar las ociones de filtro del datatable equipos(busqueda avanzada)*/
        $('#b_ver_campos').button().click(function() {            
            if ($(this).html() == 'Ocultar opciones de campos') {                
                $('#ver_campos').hide('clip', 'slow');                               
                $(this).html('Ver opciones de campos');
            }
            else {
                $('#ver_campos').show('clip');                
                $(this).html('Ocultar opciones de campos', 'slow');                                 
            }            
        }); 
        
         
        /* se aplica estilo a la tabla datatable con el plugin datatables
         * al cual seleaplican las siguioentes caracteristicas:
         * estilo compatible con Jquery, traduccion del plugin, el tamaño del menu
         * tipo de paginacion ademas de ciertos parametros que hacen que se procesen
         * los datos del datatable de manera asincrona con el servidor*/
        dt_reservsalas=$('#dtreservsalas').dataTable( {
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ equipos",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ reservaciones",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 reservaciones",
                "sInfoFiltered": "(filtrado de _MAX_ reservaciones)",
                "sInfoPostFix":  "",
                "sSearch":       "Buscar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sPrevious": "Anterior",
                    "sNext":     "Siguiente",
                    "sLast":     "Último"
                }
            },
            "aLengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todos"]],
            "sPaginationType": "full_numbers", 
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/reservaciones_salas/datosReservSalas",
            "fnServerData": function( sUrl, aoData, fnCallback ) {
                $.ajax( {
                    "url": sUrl,
                    "data": aoData,
                    "success": fnCallback,
                    "dataType": "jsonp",
                    "cache": false
                } );
            }
        } );
        verOcultarColDT(0,dt_reservsalas);
        
        
        $( "#dialog:ui-dialog" ).dialog( "destroy" );		
        var nombre_act = $( "#nombre_act" ),
        sala = $( "#sala" ),
        hora_inicio = $( "#hora_inicio" ),
        hora_fin = $( "#hora_fin" ),
        encargado = $( "#encargado" ),
        fecha_inicio = $( "#fecha_inicio" ),
        fecha_fin = $( "#fecha_fin" ),
        sala_ui=$( "#sala-button" ),
        ac_encargado=$('#form_agrega_reservsala .ui-autocomplete-input'),
        allFields = $( [] ).add( nombre_act ).add( sala).add(hora_inicio)
        .add(hora_fin).add(encargado).add(fecha_inicio).add(fecha_fin).add(sala_ui).add(ac_encargado),
        tips = $( ".form_tips" );
        
        $( "#f_agregar_reserva_sala" ).dialog({
            autoOpen: false,
            width: 430,
            modal: true,
            buttons: {
                "Agregar Reservación de Sala": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    $('#sala-button,#form_agrega_reservsala .ui-autocomplete-input').removeClass('ui-state-error');
                    bValid = bValid && verificaSelectUI(sala,$( "#sala-button" ),"Debe selecionar una sala",tips);
                    bValid = bValid && campoVacio(nombre_act,'Nombre de Actividad',tips);
                    bValid = bValid && verificaSelect(encargado,'Por favor seleciona un encargado',tips)
                    bValid = bValid && campoVacio($('#form_agrega_reservsala .ui-autocomplete-input'),'Nombre del Encargado',tips);
                    bValid = bValid && campoVacio(hora_inicio,'Hora de Inicio',tips);
                    bValid = bValid && validaCampoExpReg( hora_inicio,/^\[d{2}\:00]|[d{1}\:00]$/, "El formato de la hora de inicio debe ser: hh:00. Ejemplo: '01:00'",tips);         
                    bValid = bValid && campoVacio(hora_fin,'Hora de Fin',tips);
                    bValid = bValid && validaCampoExpReg( hora_fin,/^\[d{2}\:00]|[d{1}\:00]$/, "El formato de la hora de inicio debe ser: hh:00. Ejemplo: '01:00'",tips);         
                    bValid = bValid && campoVacio(fecha_inicio,'Fecha de Inicio',tips);
                    bValid = bValid && validaCampoExpReg( fecha_inicio,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);         
                    bValid = bValid && campoVacio(fecha_fin,'Fecha de Fin',tips);
                    bValid = bValid && validaCampoExpReg(fecha_fin,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);         
                    if ( bValid ) {  
                        var datos = $( "#form_agrega_reservsala" ).serialize();
                        alert(datos);
                        var urll="index.php/reservaciones_salas/agregaReservacion";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_reservsalas.fnDraw();
                            notificacion_tip("./images/msg/ok.png","Agregar Equipo","El equipo se agreg&oacute; satisfactoriamente.");
                        }else{
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,true);
                        }                 
                        $( this ).dialog( "close" );
                    }
                },
                Cancelar : function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        });

        $( "#btn_agregar" )
        .button()
        .click(function() {
            carga_encargados();
            carga_salas();
            $( "#f_agregar_reserva_sala" ).dialog( "open" );
        });
        
        $('#tipo_u').selectmenu();
        $('#m_tipo_u').selectmenu();
        $('#ayuda_edos_equ').click(function(){
            mensaje($( "#mensaje" ),'Ayuda (Estados de equipos)','./images/msg/ayuda.png'
            ,'Puede cambiar el estado de los equipos dando clic sobre el boton que repreenta el estado.'
            ,'*Solo se puede cambiar el estado en estos casos: <br><br>De <img src="./images/pc_edos/pc_L_min.png"/>Libre a <img src="./images/pc_edos/pc_D_min.png"/><b>Descompuesto</b> o <img src="./images/pc_edos/pc_M_min.png"/><b>Mantenimiento</b>.<br>'+
                'De <img src="./images/pc_edos/pc_D_min.png"/><b>Descompuesto</b> o <img src="./images/pc_edos/pc_M_min.png"/><b>Mantenimiento</b> a <img src="./images/pc_edos/pc__min.png"/>Sin Estado<br>'+
                '<br>Si lo que desea es asignarlo a una reservacion momentanea puede hacerlo desde <A href="'+base_url+'index.php/reservaciones_temporales" target="_blank">Aqu&iacute;</A>',500,false);
        });
        $('#disco,#m_disco').spinner({min:0,step:80});
        $('#ram,#m_ram').spinner({min:0});
        $( "#vo_campos").buttonset();
        //Asigna accion al boton para actualizar datatables
        $("#btn_actualiza").button().click(function(){ 
            dt_reservsalas.fnDraw();               
        });
        
        $('#btn_modificar').button().click(function() {
            if((row_select!=0)&&(row_select!='')){
                modifica_reservacion(row_select);
            }else{
                mensaje($( "#mensaje" ),'No se ha seleccionado ninguna reservaci&oacute;n','./images/msg/warning.png'
                ,'Por favor seleccione una reservaci&oacute;n de sala.'
                ,'',400,true);
            }
        } );

        $('#btn_eliminar').button().click(function() {
            if((row_select!=0)&&(row_select!='')){
                cancelar_reservacion(row_select);
            }else{
                mensaje($( "#mensaje" ),'No se ha seleccionado ninguna reservaci&oacute;n','./images/msg/warning.png'
                ,'Por favor seleccione una reservaci&oacute;n de sala.'
                ,'',400,true);
            }
        } );
        
        
        //$( ".combobox-ui" ).combobox();
    } );
</script>
<style type="text/css">    
    .ColVis {float: left;margin-bottom: 0}
    .dataTables_length {width: auto;}
    #tipo_u,#m_tipo_u{width: 350px;}
    #ram,#disco{
        height: 20px;
    }
    .ui-autocomplete-input{
        width: 90% !important;
    }

</style>