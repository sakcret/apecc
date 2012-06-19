<div id="dialog-elimina" title="Eliminar Equipo" class="hide">
    <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
        &nbsp;&nbsp;El equipo se borrar&aacute; permanentemente. ¿Deseas Continuar?</p>
</div>
<div id="f_agregar_equipo" title="Agregar un Equipo" class="hide">
    <p class="form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_agrega_equipo">
        <fieldset>
            <table width="100%" border="1">
                <tr>
                    <td colspan="3"><label for="numser" >N&uacute;mero de Serie*:</label>
                        <input type="text" name="numser" id="numser" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="marca">Marca:</label>
                        <input type="text" name="marca" id="marca" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>

                    <td><label for="modelo">Modelo:</label>
                        <input type="text" name="modelo" id="modelo" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="numinv">N&uacute;mero de Inventario*:</label>
                        <input type="text" name="numinv" id="numinv" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="procesador">Procesador(recomendado):</label>
                        <input type="text" name="procesador" id="procesador" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>

                    <td><label for="disco">Disco Duro (recomendado):</label>            
                        <input type="text" name="disco" onkeypress="return IsNumber(event);" id="disco" value="512" class="height_widget" maxlength="11"/></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="ram">Memoria RAM (recomendado):</label>
                        <input type="text" name="ram" id="ram" value="4" onkeypress="return IsNumberFloat(event);" class="height_widget" maxlength="11"/></td>
                </tr>
            </table>	
        </fieldset>
    </form>
</div>

<div id="f_modificar_equipo" title="Modificar Equipo" class="hide">
    <p class="m_form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_modifica_equipo">
        <fieldset>
            <table width="100%" border="1">
                <tr>
                    <td colspan="3"><label for="m_numser" >N&uacute;mero de Serie(Solo lectura):</label>
                        <input type="text" name="m_numser" id="m_numser" maxlength="25" readonly="readonly" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="m_marca">Marca:</label>
                        <input type="text" name="m_marca" id="m_marca" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>

                    <td><label for="m_modelo">Modelo:</label>
                        <input type="text" name="m_modelo" id="m_modelo" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="m_numinv">N&uacute;mero de Inventario*:</label>
                        <input type="text" name="m_numinv" id="m_numinv" maxlength="10" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="m_procesador">Procesador:</label>
                        <input type="text" name="m_procesador" id="m_procesador" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr>
                    <td><label for="m_disco">Disco Duro:</label>            
                        <input type="text" name="m_disco" id="m_disco" value="512" class="height_widget" maxlength="11"/></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                    <td><label for="m_ram">Memoria RAM:</label>
                        <input type="text" name="m_ram" id="m_ram" value="4" class="height_widget" maxlength="11"/></td>
                </tr>
                <tr>
                    <td colspan="3"><label for="m_edo">Estado Actual(Solo lectura):</label>
                        <input type="text" name="m_edo" id="m_edo" maxlength="25" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
                <tr id="row_edo" class="hide">
                    <td colspan="3">
                <center>
                    <div id="edoequipo" style=" margin-bottom: 10px; margin-top: 10px;">
                        <input type="radio" id="edo_D" name="edoeq" /><label for="edo_D">Descompuesto</label>
                        <input type="radio" id="edo_M" name="edoeq" /><label for="edo_M">Mantenimiento</label>

                    </div>
                </center>
                </td>
                </tr>
                <tr id="row_edo2" class="hide">
                    <td colspan="3">
                <center>
                    <div id="edoequipo2" style=" margin-bottom: 10px; margin-top: 10px;">
                        <input type="radio" id="edo_S" name="edoeq2" /><label for="edo_S">Sin Estado</label>

                    </div>
                </center>
                </td>
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
            <input type="checkbox" onclick="verOcultarColDT(0,dt_equipos);" checked="checked" name="vo_numser" id="vo_numser" ><label for="vo_numser">N&uacute;mero de Serie</label>
            <input type="checkbox" onclick="verOcultarColDT(1,dt_equipos);" checked="checked" name="vo_marca" id="vo_marca" ><label for="vo_marca">Marca</label>
            <input type="checkbox" onclick="verOcultarColDT(2,dt_equipos);" checked="checked" name="vo_modelo" id="vo_modelo" ><label for="vo_modelo">Modelo</label>
            <input type="checkbox" onclick="verOcultarColDT(3,dt_equipos);" checked="checked" name="vo_numinv" id="vo_numinv" ><label for="vo_numinv">N&uacute;mero de Inventario</label>
            <input type="checkbox" onclick="verOcultarColDT(4,dt_equipos);" checked="checked" name="vo_procesador" id="vo_procesador" ><label for="vo_procesador">Procesador</label>
            <input type="checkbox" onclick="verOcultarColDT(5,dt_equipos);" checked="checked" name="vo_dd" id="vo_dd" ><label for="vo_dd">Disco Duro</label>
            <input type="checkbox" onclick="verOcultarColDT(6,dt_equipos);" checked="checked" name="vo_ram" id="vo_ram" ><label for="vo_ram">Memoria RAM</label>
            <input type="checkbox" onclick="verOcultarColDT(7,dt_equipos);" checked="checked" name="vo_edo" id="vo_edo" ><label for="vo_edo">Estado</label>
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
            <div class="ui-widget-header ui-corner-all" style=" margin-bottom: 0px; height: 41px;">
                <div style="margin-top: 3px; margin-left: 6px;">
                    <button id="btn_actualiza"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_agregar"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                    <button id="btn_modificar"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                    <button id="btn_eliminar"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                    <button style="height: 35px !important; width: 250px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                    <button style="height: 35px !important; width: 250px;" id="b_ver_campos"class="opc">Ver opciones de campos</button>
                </div>
            </div>
        </div>
        <div style=" margin-top: 10px; margin-bottom: 10px;" class="ui-corner_all boxshadowround">
            <table width="100%" border="0">
                <tr>
                    <td id="ayuda_edos_equ" class="manita" width="16%"><img src="./images/ayuda.png"/>&nbsp;Estado de equipos:</td>
                    <td width="14%"><img src="./images/pc_edos/pc_O_min.png"/>&nbsp;(O) Ocupado</td>
                    <td width="14%"><img src="./images/pc_edos/pc_L_min.png"/>&nbsp;(L) Libre</td>
                    <td width="14%"><img src="./images/pc_edos/pc_C_min.png"/>&nbsp;(C) En Clase o Curso</td>
                    <td width="14%"><img src="./images/pc_edos/pc_D_min.png"/>&nbsp;(D) Descompuesto</td>
                    <td width="14%"><img src="./images/pc_edos/pc_M_min.png"/>&nbsp;(M) Mantenimiento</td>
                    <td width="14%"><img src="./images/pc_edos/pc__min.png"/>&nbsp;(S) Sin estado</td>
                </tr>
            </table>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="dtequipos">
            <thead>
                <tr>
                    <th width="12%">N&uacute;mero de Serie</th>
                    <th width="11%">Marca</th>
                    <th width="15%">Modelo</th>                
                    <th width="10%">N&uacute;mero de Inventario</th>
                    <th width="20%">Procesador</th>
                    <th width="9%">Disco Duro(GB)</th>
                    <th width="9%">Memoria RAM(GB)</th>
                    <th width="6%">Estado</th>
                    <th>Edo</th>
                    <!--th>Descripci&oacute;n</th-->
                    <th width="7%">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="dataTables_empty">Cargando datos del servidor...</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>N&uacute;mero de Serie</th>
                    <th>Marca</th>
                    <th>Modelo</th>                
                    <th>N&uacute;mero de Inventario</th>
                    <th>Procesador</th>
                    <th>Disco Duro(GB)</th>
                    <th>Memoria RAM(GB)</th>
                    <th>Estado</th>
                    <th>Edo</th>
                    <!--th>Descripci&oacute;n</th-->
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table><br/>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    var dt_equipos;
    var row_select=0;
    /*Funcion para aplicar filtro global en el datatable equipos*/
    function fnFilterGlobal (){
        $('#dtequipos').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable equipos*/
    function fnFilterColumn ( i ){
        $('#dtequipos').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }		
                
    /*funcion que actualiza el eestatus de un equipo tomando como referencia el atributo cambia_edo de la imagen
     * para saber a que estado se va a cambiar de manera que si el estado del equipo es actualizado(imagen verde)
     * el valor del atributo cambia_edo sera 0 ya que se cambiara a no actualizado=0
     * !es importante tener en cuenta que el id(login en la bd)  del equipo no debe contener espacios en blanco o comillas ya sean
     * agudas, simples o dobles ya que al obtener el id del objeto este creara conflictos con JQuery 
     * ejemplo $(# unlogin) como tiene espacio en blanco creara error algo parecido pasa con las comillas $(#u'nlogi`n)*/
    function actualiza_equipo(o,id){
        var est=o.attr("cambia_edo");
        var datos ="id="+id+'&st='+est;
        var urll="index.php/equipos/actualizaStatusEquipo";
        var respuesta = ajax_peticion(urll,datos);
        if (respuesta=='ok'){
            if(est==0){
                o.attr('src','./images/status_no_actualizado.png');
                o.attr('cambia_edo','1');
            
            }else{
                o.attr('src','./images/status_actualizado.png');
                o.attr('cambia_edo','0');
            }
        }else{
            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
        }
    }
    
    function elimina_equipo(id){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-elimina").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/equipos/eliminaEquipo";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_equipos.fnDraw();
                        notificacion_tip("./images/msg/ok.png","Eliminar Equipo","El equipo se elimin&oacute; satisfactoriamente.");
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
    
    function muestraDatosEquipoForm(id){
        $.ajax({
            url:"index.php/equipos/getEquipo",
            type:"POST",
            dataType: "json",
            data: 'id='+id,
            success:
                function(data){
                $( "#m_numser" ).val(data.ns);
                $( "#m_marca" ).val(data.ma);
                $( "#m_modelo" ).val(data.mo);
                $( "#m_numinv" ).val(data.ni);
                $( "#m_procesador" ).val(data.pr);
                $( "#m_disco" ).val(data.dd);
                $( "#m_ram" ).val(data.ram);
                var estado='';
                switch(data.edo) {
                    case 'L':
                        estado='Libre';
                        $('#row_edo').removeClass('hide');
                        break;
                    case 'O':
                        estado='Ocupado';
                        break;
                    case 'M':
                        estado='En Mantenimiento';
                        $('#row_edo2').removeClass('hide');
                        break;
                    case 'D':
                        estado='Descompuesto';
                        $('#row_edo2').removeClass('hide');
                        break;
                    case 'C':
                        estado='En clase o Curso';
                        break;
                    default:
                        estado='Sin estado';
                        break;
                }
                $( "#m_edo" ).val(estado);
            }
        })   
    }
    
    function modifica_equipo(id){ 
        var numser = $( "#m_numser" ),
        marca = $( "#m_marca" ),
        modelo = $( "#m_modelo" ),
        numinv = $( "#m_numinv" ),
        procesador = $( "#m_procesador" ),
        disco = $( "#m_disco" ),
        ram = $( "#m_ram" ),
        edo = $( "#m_edo" ),
        allFields = $( [] ).add( numser ).add( marca).add(modelo)
        .add(numinv).add(procesador).add(disco).add(ram),
        tips = $( ".m_form_tips" );
        muestraDatosEquipoForm(id);
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_equipo").dialog({
            autoOpen: false,
            width: 430,
            modal: true,
            buttons: {
                "Modificar Equipo": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(numser,'N&uacute;mero de serie',tips);
                    bValid = bValid && campoVacio(numinv,'N&uacute;mero de Inventario',tips);
                    bValid = bValid && validaCampoExpReg(numser,/^[A-Za-z\d]*$/,"El n&uacute;mero de serie proporcionado no parece ser v&aacute;lido.<br>No utilice espacios ni carateres raros.",tips );
                    bValid = bValid && validaCampoExpReg(disco,/^[\d]*$/,"Por favor ingresa un tamaño de 'Disco Duro' válido." ,tips);
                    bValid = bValid && validaCampoExpReg(ram,/^([0-9])*[.]?[0-9]*$/,"Por favor ingresa un tamaño de memoria 'RAM' válido.",tips );
                    if ( bValid ) {  
                        var datos = $( "#form_modifica_equipo" ).serialize();
                        var urll="index.php/equipos/modificaEquipo";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_equipos.fnDraw();
                            notificacion_tip("./images/msg/ok.png","Modificar Equipo","El equipo con el n&uacute;mero de Serie: '"+id+"' se modific&oacute; satisfactoriamente.");
                        }else{
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
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
                $('#row_edo,#row_edo2').addClass('hide');
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");        
        
    }
    
    $(document).ready(function() {
        $( "#edoequipo,#edoequipo2" ).buttonset();
        /* selecciona una fila del datatable no aplica para server_aside proccessing*/
        
         $('#dtequipos tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select=0; 
            }else {
                dt_equipos.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_equipos);
                var datos=dt_equipos.fnGetData(anSelected[0]);
                row_select=datos[0];
            }
        } ); 
        
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
        dt_equipos=$('#dtequipos').dataTable( {
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ equipos",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ equipos",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 equipos",
                "sInfoFiltered": "(filtrado de _MAX_ equipos)",
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
            "aLengthMenu": [[10, 25, 50, 100, 1000, -1], [10, 25, 50, 100, 1000, "Todos"]],
            "sPaginationType": "full_numbers",            
            "oTableTools": {
                "sSwfPath": "swf/copy_cvs_xls_pdf.swf"
            },
            
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/equipos/datosEquipos",
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
        
        $( "#dialog:ui-dialog" ).dialog( "destroy" );		
        var numser = $( "#numser" ),
        marca = $( "#marca" ),
        modelo = $( "#modelo" ),
        numinv = $( "#numinv" ),
        procesador = $( "#procesador" ),
        disco = $( "#disco" ),
        ram = $( "#ram" ),
        allFields = $( [] ).add( numser ).add( marca).add(modelo)
        .add(numinv).add(procesador).add(disco).add(ram),
        tips = $( ".form_tips" );
        
        $( "#f_agregar_equipo" ).dialog({
            autoOpen: false,
            width: 430,
            modal: true,
            buttons: {
                "Agregar Equipo": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(numser,'N&uacute;mero de serie',tips);
                    bValid = bValid && campoVacio(numinv,'N&uacute;mero de Inventario',tips);
                    bValid = bValid && validaCampoExpReg(numser,/^[A-Za-z\d]*$/,"El n&uacute;mero de serie proporcionado no parece ser v&aacute;lido.<br>No utilice espacios ni carateres raros.",tips );
                    bValid = bValid && validaCampoExpReg(disco,/^[\d]*$/,"Por favor ingresa un tamaño de 'Disco Duro' válido." ,tips);
                    bValid = bValid && validaCampoExpReg(ram,/^([0-9])*[.]?[0-9]*$/,"Por favor ingresa un tamaño de memoria 'RAM' válido.",tips );
                    if ( bValid ) {  
                        var datos = $( "#form_agrega_equipo" ).serialize();
                        var urll="index.php/equipos/agregaEquipo";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_equipos.fnDraw();
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
        
        verOcultarColDT(8,dt_equipos);

        $( "#btn_agregar" )
        .button()
        .click(function() {
            $( "#f_agregar_equipo" ).dialog( "open" );
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
            dt_equipos.fnDraw();
            //location.reload(true);               
        });
        
        $('#btn_modificar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if((row_select!=0)&&(row_select!='')){
                modifica_equipo(row_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un usuario  ! ','./images/msg/warning.png','Selecciona un usuario por favor.','');
            }
        } );

        $('#btn_eliminar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
           if((row_select!=0)&&(row_select!='')){
                elimina_equipo(row_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un usuario  ! ','./images/msg/warning.png','Selecciona un usuario por favor.','');
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
</style>


