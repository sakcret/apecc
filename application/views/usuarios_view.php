<div id="dialog-elimina" title="Eliminar Usuario" class="hide">
    <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
        &nbsp;&nbsp;El usuario se borrar&aacute; permanentemente. ¿Deseas Continuar?</p>
</div>
<div id="f_agregar_usuario" title="Agregar un Usuario" style="display:none;">
    <p class="form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_agrega_usuario">
        <fieldset>
            <label for="login" >Login(Solo lectura):</label>
            <input type="text" name="login" id="login" readonly="readonly" maxlength="10"  class="text" />
            <label for="nombre">Nombre(s)*:</label>
            <input type="text" name="nombre" id="nombre" onblur="trimOnBlur($(this));" maxlength="20" class="text" />
            <label for="apaterno">Apellido Paterno*:</label>
            <input type="text" name="apaterno" id="apaterno" onblur="trimOnBlur($(this));" maxlength="15" class="text" />
            <label for="amaterno">Apellido Materno*:</label>
            <input type="text" name="amaterno" id="amaterno" onblur="trimOnBlur($(this));" maxlength="15" class="text" />
            <label for="tipo_u">Tipo de usuario*:</label>
            <div class="ui-corner-all">
                <select name="tipo_u" class="ui-corner-all" id="tipo_u">
                    <option value="0">Selecciona tipo de usuario</option>
                    <?php
                    if (isset($tipos_u_rows) && ($tipos_u_rows != false)) {
                        foreach ($tipos_u_rows->result() as $row) {
                            echo '<option value="' . $row->idtipo . '">' . $row->descripcion . "</option>" . PHP_EOL;
                        }
                    }
                    ?>
                </select><br/>
            </div><br/>
            <div id="div_mat">
                <label for="matricula">Matricula*:</label>
                <input type="text" name="matricula" id="matricula" maxlength="9" class="text" />
            </div>
            <div style=" display: none;" id="div_numper">
                <label for="numepersonal">N&uacute;mero de Personal*:</label>
                <input type="text" name="numepersonal" id="numepersonal" maxlength="9" onkeypress="return IsNumber(event);" class="text" />
            </div>
            <label for="ncredencial">Numero de credencial(Solo lectura):</label>            
            <input type="text" name="ncredencial" id="ncredencial" maxlength="9" readonly="readonly" class="text" />		
        </fieldset>
    </form>
</div>

<div id="f_modificar_usuario" title="Modificar Usuario" style="display:none;">
    <p class="m_form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_modifica_usuario">
        <fieldset>
            <label for="m_login" >Login(Solo lectura):</label>
            <input type="text" name="m_login" id="m_login" readonly="readonly" maxlength="10"  class="text" />
            <label for="m_nombre">Nombre(s)*:</label>
            <input type="text" name="m_nombre" id="m_nombre" maxlength="20" class="text" />
            <label for="m_apaterno">Apellido Paterno*:</label>
            <input type="text" name="m_apaterno" id="m_apaterno" maxlength="15" class="text" />
            <label for="m_amaterno">Apellido Materno*:</label>
            <input type="text" name="m_amaterno" id="m_amaterno" maxlength="15" class="text" />
            <label for="tipo_u">Tipo de usuario(Solo lectura):</label>
            <div class="ui-corner-all">
                <select name="m_tipo_u" class="ui-corner-all" id="m_tipo_u">
                    <option value="0">Selecciona tipo de usuario</option>
                    <?php
                    if (isset($tipos_u_rows) && ($tipos_u_rows != false)) {
                        foreach ($tipos_u_rows->result() as $row) {
                            echo '<option value="' . $row->idtipo . '">' . $row->descripcion . "</option>" . PHP_EOL;
                        }
                    }
                    ?>
                </select><br/>
            </div>
            <div id="m_div_mat">
                <label for="m_matricula">Matricula*:</label>
                <input type="text" name="m_matricula" id="m_matricula" maxlength="9" class="text" />
            </div>
            <div style=" display: none;" id="m_div_numper">
                <label for="m_numepersonal">N&uacute;mero de Personal(Solo lectura)*:</label>
                <input type="text" name="m_numepersonal" id="m_numepersonal" readonly="readonly" maxlength="9" class="text" />
            </div>
            <label for="m_ncredencial">Numero de credencial(Solo lectura):</label>            
            <input type="text" name="m_ncredencial" id="m_ncredencial" maxlength="9" readonly="readonly" class="text" />
            <label for="radios">Estatus:</label>
            <div align="center" id="radios">
                <input type="radio" id="st1" value="1" name="estatus" /><label for="st1">&nbsp;&nbsp;Actualizado&nbsp;&nbsp;</label>
                <input type="radio" id="st0" value="0" name="estatus" /><label for="st0">&nbsp;No Actualizado</label>
            </div>		
        </fieldset>
    </form><br>
</div>
<div class="row">
    <div class="twelvecol last">
        <div style=" margin-top: 10px; margin-bottom: 14px;" class="ui-corner_all boxshadowround">
            <table width="100%" border="0">
                <tr>
                    <td id="ayuda_edos_equ" width="45%">&nbsp;&nbsp;&nbsp;&nbsp;<img src="./images/ayuda.png"/>&nbsp;&nbsp;Duracion del periodo(Las cuentas de usuario caducan con el fin de periodo):</td>
                    <td width="30%">Fecha de inicio del periodo:&nbsp;<b><?php echo $this->config->item('fecha_periodo_inicio'); ?></b></td>
                    <td width="20%">Fecha de fin del periodo:&nbsp;<b><?php echo $this->config->item('fecha_periodo_fin'); ?></b></td>
                </tr>
            </table>
        </div>
    </div>  
</div>

<div align="center" id="ver_campos" class="hide row ui-widget-content ui-corner-all boxshadowround bottom10" style=" width: 70%;">
    <center>
        <div class="ui-widget-header ui-corner-top header"><h1>Ver/Ocultar Campos</h1></div>
        <div id="vo_campos" style=" margin-bottom: 10px; margin-top: 10px;">
            <input type="checkbox" onclick="verOcultarColDT(0,dt_usuarios);" checked="checked" name="vo_login" id="vo_login" ><label for="vo_login">Login</label>
            <input type="checkbox" onclick="verOcultarColDT(1,dt_usuarios);" checked="checked" name="vo_matricula" id="vo_matricula" ><label for="vo_matricula">Matricula</label>
            <input type="checkbox" onclick="verOcultarColDT(2,dt_usuarios);" checked="checked" name="vo_nombre" id="vo_nombre" ><label for="vo_nombre">Nombre</label>
            <input type="checkbox" onclick="verOcultarColDT(3,dt_usuarios);" checked="checked" name="vo_tipo_u" id="vo_tipo_u" ><label for="vo_tipo_u">Tipo de usuario</label>
            <input type="checkbox" onclick="verOcultarColDT(4,dt_usuarios);" name="vo_fecha_c" id="vo_fecha_c" ><label for="vo_fecha_c">Fecha de creaci&oacute;n</label>
            <input type="checkbox" onclick="verOcultarColDT(5,dt_usuarios);" name="vo_fecha_e" id="vo_fecha_e" ><label for="vo_fecha_e">Fecha de expiraci&oacute;n</label>
            <input type="checkbox" onclick="verOcultarColDT(6,dt_usuarios);" checked="checked" name="vo_st" id="vo_st" ><label for="vo_st">Estatus</label>
        </div>
    </center>
</div>
<div align="center" id="busqueda_avanzada" class="hide row ui-widget-content ui-corner-all boxshadowround bottom10" style=" width: 70%;">
    <center>
        <div class="ui-widget-header ui-corner-top header"><h1>Busqueda Avanzada de Usuarios</h1></div>
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
                <tr id="filter_col1">
                    <td align="left">Login</td>
                    <td align="center"><input type="text"     name="col1_filter" id="col1_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_regex"  id="col1_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_smart"  id="col1_smart" checked></td>
                </tr>
                <tr id="filter_col2">
                    <td align="left">Matricula</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">Nombre</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">Tipo de usuario</td>
                    <td align="center"><input type="text"     name="col4_filter" id="col4_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_regex"  id="col4_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_smart"  id="col4_smart" checked></td>
                </tr>
                <tr id="filter_col5">
                    <td align="left">Fecha de creaci&oacute;n</td>
                    <td align="center"><input type="text"     name="col5_filter" id="col5_filter" class="text" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_regex"  id="col5_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_smart"  id="col5_smart" checked></td>
                </tr>
            </tbody>
        </table>
    </center>
</div>
<div class="row">
    <div class="twelvecol last">
        <div class="ui-widget-header ui-corner-all but_bar_content">
            <div style="margin-top: 3px; margin-left: 6px;">
                <button id="btn_actualiza"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                <button id="btn_agregar" class="prm_a"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                <button id="btn_modificar" class="prm_c"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                <button id="btn_eliminar" class="prm_b"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                <button style="height: 30px !important; width: 250px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                <button style="height: 30px !important; width: 250px;" id="b_ver_campos"class="opc">Ver opciones de campos</button>
            </div>
        </div>
        <div style=" margin-top: 10px; margin-bottom: 10px;" class="ui-corner_all boxshadowround">
            <table width="100%" border="0">
                <tr><td width="130">&nbsp;</td>
                    <td id="ayuda_st_usuarios" class="manita" width="200" ><img src="./images/ayuda.png"/>&nbsp;Estatus de Usuario:</td>
                    <td><img src="./images/status_no_actualizado.png"/>&nbsp;Cuenta de usuario <b>Actualizada</b> (Activa)</td>
                    <td><img src="./images/status_actualizado.png"/>&nbsp;Cuenta de usuario <b>No Actualizada</b> (Inactiva)</td>
                </tr>
            </table>
        </div>
        <div id="tabla_dt">
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="dtusuarios">
                <thead>
                    <tr>
                        <th width="8%">Login</th>
                        <th width="10%">Matricula</th>
                        <th width="26%">Nombre completo</th>                
                        <th width="26%">Tipo de Usuario</th>
                        <th width="10%">Fecha de creaci&oacute;n</th>
                        <th width="10%">Fecha de expiraci&oacute;n</th>
                        <th width="5%">Estatus</th>
                        <th id="opciones_" width="5%" >Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="dataTables_empty">Cargando datos del servidor...</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Login</th>
                        <th>Matricula</th>
                        <th>Nombre completo</th>  
                        <th>Tipo de Usuario</th>
                        <th>Fecha de creaci&oacute;n</th>
                        <th>Fecha de expiraci&oacute;n</th>
                        <th>Estatus</th>
                        <th>Opciones</th>
                    </tr>
                </tfoot>
            </table><br/>
        </div>
    </div>
</div>
<div class="spacer"></div>
<script type="text/javascript" charset="utf-8">
    var dt_usuarios,
    row_select=0,
    numperesobliga=false,
    matesobliga=true;
    
    function trimOnBlur(o){
        var str=o.val();
        o.val(trim(str));
    }
    
    /*Funcion para aplicar filtro global en el datatable usuarios*/
    function fnFilterGlobal (){
        $('#dtusuarios').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable usuarios*/
    function fnFilterColumn ( i ){
        $('#dtusuarios').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }
    
    /*funcion que actualiza el eestatus de un usuario tomando como referencia el atributo cambia_edo de la imagen
     * para saber a que estado se va a cambiar de manera que si el estado del usuario es actualizado(imagen verde)
     * el valor del atributo cambia_edo sera 0 ya que se cambiara a no actualizado=0
     * !es importante tener en cuenta que el id(login en la bd)  del usuario no debe contener espacios en blanco o comillas ya sean
     * agudas, simples o dobles ya que al obtener el id del objeto este creara conflictos con JQuery 
     * ejemplo $(# unlogin) como tiene espacio en blanco creara error algo parecido pasa con las comillas $(#u'nlogi`n)*/
    function actualiza_usuario(o,id){
        var est=o.attr("cambia_edo");
        var actua='';
        var datos ="id="+id+'&st='+est;
        var urll="index.php/usuarios/actualizaStatusUsuario";
        var respuesta = ajax_peticion(urll,datos);
        if (respuesta=='ok'){
            if(est==0){
                o.attr('src','./images/status_no_actualizado.png');
                o.attr('cambia_edo','1');
                actua='No Actualizado';
            }else{
                o.attr('src','./images/status_actualizado.png');
                o.attr('cambia_edo','0');
                actua='Actualizado';
            }
            notificacion_tip("./images/msg/ok.png","Actualizar Estatus","La cuenta de usuario con el login: '"+id+"' se se cambi&oacute; a '"+actua+"'.");   
        }else{
            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
        }
    }
    
    function elimina_usuario(id){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-elimina").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/usuarios/eliminaUsuario";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_usuarios.fnDraw();//recargar los datos del datatable
                        notificacion_tip("./images/msg/ok.png","Eliminar Usuario","El usuario se elimin&oacute; satisfactoriamente.");
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
    
    function muestraDatosUsuarioForm(id){
        $.ajax({
            url:"index.php/usuarios/getUsuario",
            type:"POST",
            dataType: "json",
            data: 'id='+id,
            success:
                function(data){
                if(data!=null&&data!=false){
                    $( "#m_login" ).val(data.lo);
                    $( "#m_matricula" ).val(data.ma);
                    $( "#m_nombre" ).val(data.no);
                    $( "#m_apaterno" ).val(data.ap); 
                    $( "#m_amaterno" ).val(data.am); 
                    $( "#m_ncredencial" ).val(data.nc);           
                    //$( "#m_tipo_u" ).val(data.tu);
                    $('#m_tipo_u').selectmenu("value", data.tu);
                    if($('#m_tipo_u').val()==9){
                        $('#m_div_mat').hide();
                        $('#m_div_numper').show();
                    }else{
                        $('#m_div_numper').hide();
                        $('#m_div_mat').show();
                    }
                    
                    if(data.st==1){
                        $("#st1").attr("checked", "checked");
                    }else{
                        $("#st0").attr("checked", "checked");
                    }
                    $( "#radios" ).buttonset();
                }
            }
        })   
    }
    
    function modifica_usuario(id){ 
        var login = $( "#m_login" ),
        matricula = $( "#m_matricula" ),
        nombre = $( "#m_nombre" ),
        apaterno = $( "#m_apaterno" ),
        amaterno = $( "#m_amaterno" ),
        ncred = $( "#m_ncredencial" ),
        tipou = $( "#m_tipou" ),
        numper = $( "#m_numepersonal" ),
        tipouui=$( "#m_tipo_u-button" ),
        allFields = $( [] ).add( login ).add( matricula).add(nombre).add(tipouui).add(numper)
        .add( apaterno).add( amaterno).add(ncred),
        tips = $( ".m_form_tips" );
        muestraDatosUsuarioForm(id);
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_usuario").dialog({
            autoOpen: false,
            width: 450,
            modal: true,
            buttons: {
                "Modificar Usuario": function() {                    
                    var bValid = true;
                    var esMaestro='no';
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && verificaLongitud(nombre,"Nombre",1,20,tips);
                    bValid = bValid && validaCampoExpReg(nombre,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Nombre' válido.",tips );
                    bValid = bValid && verificaLongitud(apaterno,"Apellido Paterno",1,15,tips);
                    bValid = bValid && validaCampoExpReg(apaterno,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Apellido Paterno' válido." ,tips);
                    bValid = bValid && verificaLongitud(amaterno,"Apellido Materno",1,15,tips);
                    bValid = bValid && validaCampoExpReg(amaterno,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Apellido Materno' válido.",tips );
                
                    if ( bValid ) {  
                        if($('#m_tipo_u').val()==9){
                            esMaestro='si';
                        
                        }
                        var datos = $( "#form_modifica_usuario" ).serialize()+'&esmaestro='+esMaestro;//obtener los datos del formulario y serializarlos
                        var urll="index.php/usuarios/modificaUsuario";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuarios.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Modificar Usuario","El usuario con el login: '"+id+"' se modific&oacute; satisfactoriamente.");
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
                $('#tipo_u').selectmenu("value", "0");
                $('#m_div_numper').hide();
                $('#m_div_mat').show();
                numperesobliga=false;
                matesobliga=true;
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");        
        
    }
    
    $(document).ready(function() { 
        /* selecciona una fila del datatable no aplica para server_aside proccessing*/
        $('#dtusuarios tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select=0; 
            }else {
                dt_usuarios.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_usuarios);
                var datos=dt_usuarios.fnGetData(anSelected[0]);
                row_select=datos[0];
            }
        } ); 
        
        $('#tipo_u').change(function(){
            if($(this).val()==9){
                $('#div_numper').show('highlight', 'slow');
                $('#div_mat').hide('highlight', 'slow');
                numperesobliga=true;
                matesobliga=false;
            }else{
                $('#div_numper').hide('highlight', 'slow');
                $('#div_mat').show('highlight', 'slow');
                numperesobliga=false;
                matesobliga=true;
            }
        });
        
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
                          
        /*ocultar y mostrar las ociones de filtro del datatable usuarios(busqueda avanzada)*/
        $('#mas_opc_busq').button().click(function() {            
            if ($(this).html() == 'Ocultar busqueda avanzada') {     
                //$('#global_filter,#col1_filter,#col2_filter,#col3_filter,#col4_filter,#col5_filter').val('');
                //dt_usuarios.fnFilterClear();
                $('#busqueda_avanzada').hide('clip', 'slow');                               
                $(this).html('Ver busqueda avanzada');
            }
            else {
                $('#busqueda_avanzada').show('clip');                
                $(this).html('Ocultar busqueda avanzada', 'slow');                                 
            }            
        });
        
        /*ocultar y mostrar las ociones de filtro del datatable usuarios(busqueda avanzada)*/
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
        dt_usuarios=$('#dtusuarios').dataTable( {
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
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
            "sAjaxSource": "index.php/usuarios/datosUsuarios",
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
        
        verOcultarColDT(4,dt_usuarios);
        verOcultarColDT(5,dt_usuarios);
       
     
        /* Al dar clicen el boton con id delete borra la fila seleccionada
    $('#delete').click( function() {
        var anSelected = fnGetSelected( oTable );
        oTable.fnDeleteRow( anSelected[0] );
    } );*/
        
         
       
        
        /*funcion que obtiene el numero maximo de credencial asignado, para calcular
         *el login y numero de credencial para un nuevo usuario esto a travez de una 
         *llamada asincrona por medio de ajax codificando los datos en JSON*/
        function getSigMaxJson(datos,url){
            $.ajax({
                url:url,
                type:"POST",
                dataType: "json",
                data: datos,
                success:
                    function(data){                   
                    ncred.val(parseInt(data.max)+1);
                    login.val(parseInt(data.max)+1);
                }
            }) 
        }
        /*funcion que calucula el login del usuario a agregar formado de la siguiente manera
         *la primera letra del apellido paterno+la primera letra del apellido materno
         *la primera letra del nombre + el numero siguiente del maximo de credencial*/
        function calcLogin(n,p,m){            
            var login = p.val().substr(0,1).toLowerCase()+m.val().substr(0,1).toLowerCase()+n.val().substr(0,1).toLowerCase()+ncred.val();
            return login;
        }
        
        $( "#dialog:ui-dialog" ).dialog( "destroy" );		
        var login = $( "#login" ),
        matricula = $( "#matricula" ),
        nombre = $( "#nombre" ),
        apaterno = $( "#apaterno" ),
        amaterno = $( "#amaterno" ),
        ncred = $( "#ncredencial" ),
        tipou = $( "#tipo_u" ),
        numper = $( "#numepersonal" ),
        tipouui = $( "#tipo_u-button" ),
        fechaexpira= $( "#fecha_expira" ),
        foto = $( "#foto" ),
        allFields = $( [] ).add( login ).add( matricula).add(nombre).add(tipouui).add(numper)
        .add( apaterno).add( amaterno).add( ncred).add( fechaexpira).add( foto),
        tips = $( ".form_tips" );
        
        nombre.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });
        apaterno.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });
        amaterno.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });
        matricula.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });
        fechaexpira.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });   
        tipou.blur(function(){           
            login.val(calcLogin(nombre,apaterno,amaterno));              
        });
	
        $( "#f_agregar_usuario" ).dialog({
            autoOpen: false,
            width: 450,
            modal: true,
            buttons: {
                "Agregar Usuario": function() {                    
                    var bValid = true;
                    var esMaestro='no';
                    allFields.removeClass( "ui-state-error" );
                    $( "#tipo_u-button" ).removeClass( "ui-state-error" );
                    bValid = bValid && verificaLongitud(nombre,"Nombre",1,20,tips);
                    bValid = bValid && validaCampoExpReg(nombre,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Nombre' válido.",tips );
                    bValid = bValid && verificaLongitud(apaterno,"Apellido Paterno",1,15,tips);
                    bValid = bValid && validaCampoExpReg(apaterno,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Apellido Paterno' válido." ,tips);
                    bValid = bValid && verificaLongitud(amaterno,"Apellido Materno",1,15,tips);
                    bValid = bValid && validaCampoExpReg(amaterno,/^[A-Za-z\s áéíóúñÁÉÍÓÚÑ]*$/,"Por favor ingresa un 'Apellido Materno' válido.",tips );
                    bValid = bValid && verificaSelectUI(tipou,$( "#tipo_u-button" ),"Debe selecionar un tipo de usuario",tips);
                    if(matesobliga) {
                        esMaestro='no';
                        bValid = bValid && campoVacio(matricula,"Matricula",tips);
                        bValid = bValid && validaCampoExpReg(matricula,/^\S\d{8}$/,"Matricula inválida... El formato de la 'Matricula debe ser: una letra S seguida de 8 números \nEjemplo: S07010150.",tips );
                    }
                    if(numperesobliga) {
                        esMaestro='si';
                        bValid = bValid && campoVacio(numper,"N&uacute;mero de personal",tips);
                        bValid = bValid && validaCampoExpReg(numper,/^\S\d+$/,"N&uacute;mero de personal inválido... ",tips );
                    }
                    if ( bValid ) {
                        login.val(calcLogin(nombre,apaterno,amaterno));   
                        var datos = $( "#form_agrega_usuario" ).serialize()+'&esmaestro='+esMaestro;
                        var urll="index.php/usuarios/agregaUsuario";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuarios.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Agregar Usuario","El usuario se agreg&oacute; satisfactoriamente.");
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
                $('#div_numper').hide();
                $('#div_mat').show();
                numperesobliga=false;
                matesobliga=true;
                allFields.val( "" ).removeClass( "ui-state-error" );
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        });

        $( "#btn_agregar" )
        .click(function() {
            getSigMaxJson("","index.php/usuarios/maxNumCred");
            $('#tipo_u').selectmenu("value", "0");
            $( "#f_agregar_usuario" ).dialog( "open" );
        });
        
        $('#ayuda_st_usuarios').click(function(){
            mensaje($( "#mensaje" ),'Ayuda (Estatus de Cuentas de Usuario)','./images/msg/ayuda.png'
            ,'Puede cambiar el estatus de la cuenta de usuarios dando click sobre el boton de estatus.'
            ,'<br>*Si la cuenta de usuario no esta actualizada el estatus se mostrar&aacute; como <img src="./images/status_no_actualizado.png"/><br>'+
                'se cambiar&aacute; a <img src="./images/status_actualizado.png"/> y viceversa',400,false);
        });
        
        $( "#vo_campos").buttonset();
        $('#tipo_u').selectmenu();
        $( "#radios" ).buttonset();
        $('#m_tipo_u').selectmenu();
        $('#m_tipo_u').selectmenu("disable");
        $('#col5_filter').datepicker();
        
        //Asigna accion al boton para actualizar datatables
        $("#btn_actualiza").button().click(function(){ 
            dt_usuarios.fnDraw();
            //location.reload(true);               
        });
        
        $('#btn_modificar').button().click(function() {
            if((row_select!=0)&&(row_select!='')){
                modifica_usuario(row_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un usuario  ! ','./images/msg/warning.png','Selecciona un usuario por favor.','');
            }
        } );

        $('#btn_eliminar').button().click(function() {
            if((row_select!=0)&&(row_select!='')){
                elimina_usuario(row_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un usuario  ! ','./images/msg/warning.png','Selecciona un usuario por favor.','');
            }
        } );
    });
</script>
<style type="text/css">    
    .ColVis {
        float: left;
        margin-bottom: 0
    }    
    .dataTables_length {
        width: auto;
    }
    #tipo_u,#m_tipo_u{width: 400px;}
    .ui-selectmenu{width: 96% !important;}
</style>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>
<br>

