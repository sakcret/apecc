<?php $roles = $this->config->item('roles'); ?>
<div id="dialog-elimina" title="Eliminar Actividad" style="display:none;">
    <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
        &nbsp;&nbsp;El user_sis se borrar&aacute; permanentemente.<hr class="boxshadowround">
    <b>Nota:&nbsp;</b>Al hacer esto tambi&eacute;n se eliminar&aacute;n las asociaciones de catedraticos de esta user_sis, de igual forma 
    las reservaciones fijas asignadas a cada catedr&aacute;tico ser&aacute;n eliminadas.
    <br><b>¿A&uacute;n as&iacute; Deseas Continuar?</b></p>
</div>
<div id="f_agregar_user_sis" title="Agregar Usuario del Sistema" style="display:none;">
    <p class="form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_agrega_user_sis">
        <fieldset>
            <label for="nombre" >Nombre del usuario(Recomendado):</label>
            <input type="text" name="nombre" id="nombre" maxlength="80"  class="text ui-widget-content ui-corner-all" />
            <label for="login" >Login*:</label>
            <input type="text" name="login" id="login" maxlength="80"  class="text ui-widget-content ui-corner-all" />
            <label for="password">Password*:</label>
            <input type="text" name="password" id="password" maxlength="15" class="text ui-widget-content ui-corner-all" />
            <label for="conf_password">Confirmaci&oacute;n de Password*:</label>
            <input type="text" name="conf_password" id="conf_password" maxlength="15" class="text ui-widget-content ui-corner-all" />
            <label for="rol">Rol(Recomendado):</label>
            <select id="rol" name="rol">
                <option value="0">-- Elegir un rol --</option>
                <?php
                foreach ($roles as $rol) {
                    echo '<option value="' . $rol['clave'] . '">' . $rol['rol'] . '</option>';
                }
                ?>
            </select><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" maxlength="10" title="Fecha inicial" class="text height_widget ui-corner-all"/>
            </fieldset>
    </form>
</div>
<div id="f_modificar_user_sis" title="Modificar Actividad" style="display:none;">
    <p class="m_form_tips">Los campos marcados con * son obligatorios.</p>
    <form method="POST" action="" id="form_modifica_user_sis">
        <fieldset>
            <label for="m_login" >Nombre de la Actividad*:</label>
            <input type="text" name="m_login" id="m_login" maxlength="80"  class="text ui-widget-content ui-corner-all" />
            <label for="m_password">Nombre Corto(max 15 carateres)*:</label>
            <input type="text" name="m_password" id="m_password" maxlength="15" class="text ui-widget-content ui-corner-all" />
            <div class="radios">
                <label for="m_tipo_act">Tipo de Actividad(Solo lectura):</label>
                <input type="text" name="m_tipo_act" id="m_tipo_act" readonly="readonly" class="text readonly ui-widget-content ui-corner-all" />
            </div>
            <label for="m_color">Color:</label><input type="text" id="m_color" readonly="readonly" name="m_color" value="#CCCCCC" class="manita text1 ui-corner-all colors" title="Da click aqu&iacute; para seleccionar un color"/>
            <fieldset id="color_choose2" class="hide ui-widget-content ui-corner-all">
                <legend class="ui-widget-header header_person ui-corner-top">Elige un color asociado a la user_sis:</legend>
                <center><div id="colorpicker2"></div></center>
            </fieldset>
        </fieldset>
    </form>
</div>
<div id="f_asignar_user_sis" title="Asignar Actividad a Catedr&aacute;tico" class="hide">
    <p class="form_tips_asign">Los campos marcados con * son obligatorios.</p>
    <div id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" style="width: 97.8%; margin-top: 10px;">
        <div class="ui-grid-header ui-widget-header ui-corner-top" style=" font-size: 12px !important;">Datos de la Actividad a asignar</div>
        <table id="tb_datos_asign" class="ui-grid-content ui-widget-content" style=" width: 100%" >
            <tbody>
                <tr >
                    <td width="30%" class="ui-state-focus">Nombre de la user_sis:</td>
                    <td width="70%" class="ui-state-focus" id="login_act_asign"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Nombre corto:</td>
                    <td class="ui-state-focus" id="logincorto_act_asign"></td>
                </tr>
                <tr>
                    <td class="ui-state-focus">Tipo de Actividad:</td>
                    <td class="ui-state-focus" id="tipo_act_asign"></td>
                </tr>
            </tbody>
        </table>
        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">
        </div>
    </div>
    <form method="POST" action="" id="form_asigna_user_sis">
        <fieldset>
            <table width="100%" border="1">
                <tr>
                    <td colspan="3"><label for="login_cat" >Nombre del Catedr&aacute;tico*:</label><br>
                        <select name="catedraticos" id="catedraticos"></select><br></td>
                </tr>
                <tr>
                    <td><label for="bloque_act">Bloque de la user_sis*:</label>
                        <input type="text" name="bloque_act" onkeypress="return IsNumber(event);" id="bloque_act" maxlength="15" class="text ui-widget-content ui-corner-all" /></td>
                    <td>&nbsp;&nbsp;</td>
                    <td><label for="seccion_act">Secci&oacute;n de la user_sis*:</label>
                        <input type="text" name="seccion_act" onkeypress="return IsNumber(event);" id="seccion_act" maxlength="15" class="text ui-widget-content ui-corner-all" /></td>
                </tr>
            </table> 
        </fieldset>
    </form>
</div>
<br/>
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
                    <td align="left">Nombre de la user_sis</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">Nombre corto</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">Tipo de user_sis</td>
                    <td align="center"><input type="text"     name="col4_filter" id="col4_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_regex"  id="col4_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_smart"  id="col4_smart" checked></td>
                </tr>
            </tbody>
        </table>
    </center>
</div>
<br/>
<div class="row">
    <div class="twelvecol last">
        <div class="ui-widget-header ui-corner-all" style=" margin-bottom: 0px;">
            <div class="ui-widget-header ui-corner-all" style=" margin-bottom: 0px; height: 38px;">
                <div style="margin-top: 3px; margin-left: 6px;">
                    <button id="btn_actualiza"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_agregar"  class="prm_a"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                    <button id="btn_modificar"  class="prm_c"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                    <button id="btn_eliminar"  class="prm_b"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                    <button id="btn_asignar" class="prm_s"><img src="./images/users.png"/>&nbsp;asignar a Catedr&aacute;tico</button>
                    <button style="height: 30px !important; width: 250px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                </div>
            </div>
        </div>
        <div style=" margin-top: 10px; margin-bottom: 10px;" class="ui-corner_all boxshadowround">
            <table width="100%" border="0">
                <tr>
                    <td><img src="./images/ayuda.png"/>&nbsp;El color sirve para identificar, de una forma mas rápida a las user_sises.</td>
                </tr>
            </table>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="dtusuariossistema">
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Password(Cifrado)</th>                
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Permisos</th>
                    <th>Opciones</th>
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
                    <th>Password(Cifrado)</th>                
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Permisos</th>
                    <th>Opciones</th>
                </tr>
            </tfoot>
        </table><br/>
    </div>
</div>
<div class="row">
    <div class="twelvecol">
        <div class="ui-widget-header ui-corner-all" style="height: 20px; margin-bottom: 10px;">
            <center><div style=" float: left; margin-left: 30px;">Catedr&aacute;tico(s) que imparte(n) la user_sis: </div><div style=" margin-left: 10px; float: left;" id="act_select">No se ha selecionado una user_sis</div></center>
        </div>
        <table cellpadding="0" cellspacing="0" border="1" class="display" id="dtpermisos">
            <thead>
                <tr>
                    <th width="8%">Bloque</th>
                    <th width="8%">Secci&oacute;n</th>
                    <th width="15%">N&uacute;mero de personal</th>
                    <th width="50%">Nombre del catedr&aacute;tico</th>
                    <th width="15%">Login</th>
                    <th width="4%">Opc</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Bloque</th>
                    <th>Secci&oacute;n</th>
                    <th>N&uacute;mero de personal</th>
                    <th>Nombre del catedr&aacute;tico</th>
                    <th>Login</th>
                    <th>Opc</th>
                </tr>
            </tfoot>
        </table> 
    </div>
</div>
<br/>


<script type="text/javascript" charset="utf-8">
    var dt_usuariossistema,data_row_select;
    var row_select=0,row_select_catedra=0;
     
    var mensajes = $( ".tips" ),
    email = $( "#email" ),
    fecha2 = $( "#fecha2" );
    
    function ocultaFechas(oc){
        if(oc){
            $('#periodo-curso').hide(); 
        }else{
            $('#periodo-curso').show(); 
        }
    }
    /*Funcion para aplicar filtro global en el datatable user_sises*/
    function fnFilterGlobal (){
        $('#dtusuariossistema').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable user_sises*/
    function fnFilterColumn ( i ){
        $('#dtusuariossistema').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }
    
    function cambia_color(id,color,o){
        try{
            if(color==''){
                $('#color_m').val('#ffffff');  
            }else{
                $('#color_m').val(color);
            } 
            $('#color_m').css('background-color',color);
        }catch(e) {
            alert(e);
        }
        $('#colorpicker3').farbtastic('#color_m');
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-cambiacolor").dialog({
            autoOpen: false,
            resizable: false,
            width: 400,
            modal: false,
            buttons: {
                "Cambiar Color": function() {
                    var datos ="id="+id+'&color='+$('#color_m').val();
                    var urll="index.php/user_sises/cambiaColor";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        o.css('background-color',$('#color_m').val());
                        notificacion_tip("./images/msg/ok.png","Modificar Color de Actividad","El color de la user_sis se ha actualizado satisfactoriamente.");
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
    
    function carga_catedraticos(){
        var c = get_value('catedraticos/getCatedraticosSelect','');
        $('[name="catedraticos"] option').remove();
        var todos="<option value='0'>Todos</option>";
        $('[name="catedraticos"]').append(todos);
        $('[name="catedraticos"]').append(c);
    }
    
    /*funcion que actualiza el eestatus de un user_sis tomando como referencia el atributo cambia_edo de la imagen
     * para saber a que estado se va a cambiar de manera que si el estado del user_sis es actualizado(imagen verde)
     * el valor del atributo cambia_edo sera 0 ya que se cambiara a no actualizado=0
     * !es importante tener en cuenta que el id(login en la bd)  del user_sis no debe contener espacios en blanco o comillas ya sean
     * agudas, simples o dobles ya que al obtener el id del objeto este creara conflictos con JQuery 
     * ejemplo $(# unlogin) como tiene espacio en blanco creara error algo parecido pasa con las comillas $(#u'nlogi`n)*/
    function actualiza_user_sis(o,id){
        var est=o.attr("cambia_edo");
        var actua='';
        var datos ="id="+id+'&st='+est;
        var urll="index.php/user_sises/actualizaStatusActividad";
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
            notificacion_tip("./images/msg/ok.png","Actualizar Estatus","La cuenta de user_sis con el login: '"+id+"' se se cambi&oacute; a '"+actua+"'.");   
        }else{
            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
        }
    }
    
    function elimina_user_sis(id){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-elimina").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:500,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/user_sises/eliminaActividad";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_usuariossistema.fnDraw();//recargar los datos del datatable
                        dt_permisos.fnClearTable();
                        notificacion_tip("./images/msg/ok.png","Eliminar Actividad","El user_sis se elimin&oacute; satisfactoriamente.");
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
    
    function muestraDatosActividadForm(id){
        $.ajax({
            url:"index.php/user_sises/getActividad",
            type:"POST",
            dataType: "json",
            data: 'id='+id,
            success:
                function(data){
                $( "#m_login" ).val(data.no);
                $( "#m_password" ).val(data.nc); 
                $( "#m_color" ).val(data.cl); 
                if(data.ta==1){
                    $("#m_tipo_act").val('Curso');
                }else{
                    $("#m_tipo_act").val('Experiencia Educativa');
                }
            }
        });//fin ajax   
    }
    
    function modifica_user_sis(id,color_a,o_color_mod){
        var login = $( "#m_login" ),
        password = $( "#m_password" ),
        color = $( "#m_color" ),
        allFields = $( [] ).add( login )
        .add( password).add( color),
        tips = $( ".m_form_tips" );
        muestraDatosActividadForm(id);
        color.css('background-color',color_a); 
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_user_sis").dialog({
            autoOpen: false,
            width: 400,
            modal: true,
            buttons: {
                "Modificar Actividad": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(login,'Nombre',tips);
                    bValid = bValid && campoVacio(password,'Nombre Corto',tips);
                    if ( bValid ) {  
                        var datos = $( "#form_modifica_user_sis" ).serialize()+'&id_act='+id;//obtener los datos del formulario y serializarlos
                        var urll="index.php/user_sises/modificaActividad";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuariossistema.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Modificar Actividad","El user_sis con el login: '"+id+"' se modific&oacute; satisfactoriamente.");
                            o_color_mod.css('background-color',$('#m_color').val());
                        
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
                $("#ee").attr("checked","checked");
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");        
        
    }
    
    function asignar_user_sis(id){
        carga_catedraticos();
        var respuesta=ajax_peticion_json("index.php/user_sises/getActividad",'id='+id);
        if(respuesta!=false){
            $( "#login_act_asign" ).text(respuesta.no);
            $( "#logincorto_act_asign" ).text(respuesta.nc);
            if(respuesta.ta=='0'){
                $( "#tipo_act_asign" ).text('Experiencia Educativa');
            }else{
                if(respuesta.ta=='1'){
                    $( "#tipo_act_asign" ).text('Curso');
                }else{
                    $( "#tipo_act_asign" ).html('Reservaci&oacute;n de Sala');
                }
            }
        }    
   
        var bloque= $( "#bloque_act" ),
        seccion = $( "#seccion_act" ),
        catedratico = $( "#catedraticos" ),
        catedratico_incbx = $( "#form_asigna_user_sis .ui-autocomplete-input" ),
        allFields = $( [] ).add(bloque)
        .add( catedratico).add(seccion).add(catedratico_incbx),
        tips = $( ".form_tips_asign" );
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_asignar_user_sis").dialog({
            autoOpen: false,
            width: 560,
            modal: true,
            buttons: {
                "Asignar Actividad": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && verificaSelectUI(catedratico,catedratico_incbx,'Debe seleccionar un catedratico.',tips);
                    bValid = bValid && campoVacio(bloque,'Bloque',tips);
                    bValid = bValid && campoVacio(seccion,'Sección',tips);
                    if ( bValid ) {  
                        var datos = $( "#form_asigna_user_sis" ).serialize()+'&id_act='+id;//obtener los datos del formulario y serializarlos
                        var urll="index.php/user_sises/asignaActividad";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuariossistema.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Asignar Actividad","Se realiz&oacute; la asignaci&oacute;n satisfactoriamente.");
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
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");        
        
    }
    
    function desasignar_user_sis(id){
        $('#dialog-aux').html('<div id="dialog-desasigna_user_sis" title="Desasignar Catedratico de una Actividad" class="hide">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se desasignar&aacute; el catedr&aacute;tico de la user_sis.<hr class="boxshadowround">Tambi&eacute;n se eliminar&aacute;n las reservaciones fijas asociadas a esta user_sis.<br> <b>¿Deseas Continuar?</b></p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-desasigna_user_sis").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:400,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/user_sises/desasignaActividad";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_permisos.fnClearTable();
                        notificacion_tip("./images/msg/ok.png","Eliminar Actividad","El user_sis se elimin&oacute; satisfactoriamente.");
                    }else{
                        mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                    }
                    
                    $( this ).dialog( "close" );
                    
                    $( this ).dialog( "close" );
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        }).dialog("open"); 
        
    }
                
    
    $(document).ready(function() {
        dt_permisos=$('#dtpermisos').dataTable({
            "bJQueryUI": true,
            "sDom": '<"H">t<"F">',             
            "oLanguage":{
                "sLengthMenu":   "Catedraticos",
                "sZeroRecords":  "!!! No se encontraron resultados. Esta user_sis no aparecer&aacute; en las reservaciones fijas. por no estar asignada a un catedr&aacute;tico.",
                "sInfo":         "Mostrando de _START_ a _END_ de _TOTAL_ consultas",
                "sInfoEmpty":    "Mostrando de 0 a 0 de 0 consultas",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sInfoPostFix":  "",
                "sSearch":       "",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sPrevious": "Anterior",
                    "sNext":     "Siguiente",
                    "sLast":     "&Uacute;ltimo"
                }
            }
        } );
        
        $.datepicker.regional['es'] = {
            closeText: 'Cerrar',
            prevText: 'Ant',
            nextText: 'Sig',
            currentText: 'Hoy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            weekHeader: 'Sm',
            dateFormat: 'dd/mm/yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};        
        $.datepicker.setDefaults($.datepicker.regional['es']);
            
        function clear(obj){
            $(obj).removeClass("ui-state-error")
            mensajes.text("");
        }        
        $( "#radios" ).buttonset();        
        var dates = $( ".datepicker" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            onSelect: function( selectedDate ) {
                var option = this.id == "email" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" ),
                date = $.datepicker.parseDate(
                instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });
        
        /*Funcion que toma como parametro un json y lo codifica en un arreglo para agregar datos
         *a un datatables
         **/
        function getConsultasProy(json){
            var a=[];
            var i=0;
            $.each(json, function(k,v){
                a[k]=[v.bq,v.se,v.np,v.no,v.lo,'<img src="images/eliminar_usuario.png" class="opc prm_b" title="Desasignar" alt="Desasignar" onclick="desasignar_user_sis(\''+v.id+'\')"/>'
                ];});
            return a;
        }
        
        /* selecciona una fila del datatable no aplica para server_aside proccessing*/
        $('#dtusuariossistema tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select=0; 
                dt_permisos.fnClearTable();
                $("#act_select").text('No se ha seleccionado una user_sis');
            }else {
                dt_usuariossistema.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_usuariossistema);
                var datos=dt_usuariossistema.fnGetData(anSelected[0]);
                data_row_select=datos;
                row_select=datos[0];
            }
        } );
        
        $('#dtpermisos tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select_catedra=0; 
            }
            else {
                dt_permisos.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_permisos);
                var datos=dt_permisos.fnGetData(anSelected[0]);
                row_select_catedra=datos[0];
            }
        } );
        
        $("#dtusuariossistema tbody tr").live("click", function(){
            if(row_select!=0){
                dt_permisos.fnClearTable();
                $("#act_select").text(data_row_select[2]);
                var datos='idact='+row_select;
                $.ajax({
                    url:"index.php/user_sises/getCatedraticosActividad",
                    type:"POST",
                    data: datos,
                    dataType: "json",
                    success:
                        function(r){
                        dt_permisos.fnAddData(getConsultasProy(r));
                    }
                }); 
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
       
        /*ocultar y mostrar las ociones de filtro del datatable user_sises(busqueda avanzada)*/
        $('#mas_opc_busq').button().click(function() {            
            if ($(this).html() == 'Ocultar busqueda avanzada') {     
                //$('#global_filter,#col1_filter,#col2_filter,#col3_filter,#col4_filter,#col5_filter').val('');
                //dt_usuariossistema.fnFilterClear();
                $('#busqueda_avanzada').hide('clip', 'slow');                               
                $(this).html('Ver busqueda avanzada');
            }
            else {
                $('#busqueda_avanzada').show('clip');                
                $(this).html('Ocultar busqueda avanzada', 'slow');                                 
            }            
        });
       
        /* se aplica estilo a la tabla datatable con el plugin datatables
         * al cual seleaplican las siguioentes caracteristicas:
         * estilo compatible con Jquery, traduccion del plugin, el tamaño del menu
         * tipo de paginacion ademas de ciertos parametros que hacen que se procesen
         * los datos del datatable de manera asincrona con el servidor*/
        dt_usuariossistema=$('#dtusuariossistema').dataTable( {
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
            "aaSorting": [[1, 'asc']],
            "aLengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "Todos"]],
            "sPaginationType": "full_numbers",            
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/usuarios_sistema/datosUsuariosSistema",
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
       
        verOcultarColDT(1,dt_usuariossistema);
        verOcultarColDT(5,dt_usuariossistema);
        
        $('#login').keyup(function(){
            if($('#password').val().length<15){
                $('#password').val($('#login').val());
            }
        });
        
        $( "#dialog:ui-dialog" ).dialog( "destroy" );		
        var 
        login = $( "#login" ),
        password = $( "#password" ),
        color = $( "#color" ),
        email = $( "#email" ),
        fecha2 = $( "#fecha2" ),
        allFields = $( [] ).add( login )
        .add( password).add(email).add(fecha2),
        tips = $( ".form_tips" );
      
        $( "#f_agregar_user_sis" ).dialog({
            autoOpen: false,
            width: 400,
            modal: true,
            buttons: {
                "Agregar Actividad": function() {                    
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(login,'Nombre',tips);
                    bValid = bValid && campoVacio(password,'Nombre Corto',tips);
                    if( $("#cr")[0].checked){
                        bValid = bValid && validaCampoExpReg(email,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips);            
                        bValid = bValid && validaCampoExpReg(fecha2,/^\d{2}\/\d{2}\/\d{4}$/, "El formato de la fecha debe ser: dd/mm/aaaa. Ejemplo: '05/06/2012'",tips); 
                    }
                    if ( bValid ) {
                        var datos = $( "#form_agrega_user_sis" ).serialize();
                        var urll="index.php/user_sises/agregaActividad";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuariossistema.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Agregar Actividad","La user_sis se agreg&oacute; satisfactoriamente.");
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
                $("#ee").attr("checked");
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        });

        $( "#btn_agregar" ).button().click(function() {
            $( "#f_agregar_user_sis" ).dialog( "open" );
        });
        
        $('#ayuda_st_user_sises').click(function(){
            mensaje($( "#mensaje" ),'Ayuda (Estatus de Cuentas de Actividad)','./images/msg/ayuda.png'
            ,'Puede cambiar el estatus de la cuenta de user_sises dando click sobre el boton de estatus.'
            ,'<br>*Si la cuenta de user_sis no esta actualizada el estatus se mostrar&aacute; como <img src="./images/status_no_actualizado.png"/><br>'+
                'se cambiar&aacute; a <img src="./images/status_actualizado.png"/> y viceversa',400,false);
        });
        $('#tipo_u').selectmenu();
        $('#m_tipo_u').selectmenu();
        $('#col5_filter').datepicker();
        
        //Asigna accion al boton para actualizar datatables
        $("#btn_actualiza").button().click(function(){ 
            dt_usuariossistema.fnDraw();              
        });
        
        $("#color").click(function(){ 
            if ($('#color_choose1').hasClass('hide')) {
                $('#color_choose1').show('clip', 'slow').removeClass('hide'); 
            }else{
                $('#color_choose1').hide('clip', 'slow').addClass('hide');
            }                
        });
    
        $("#m_color").click(function(){ 
            if ($('#color_choose2').hasClass('hide')) {
                $('#color_choose2').show('clip', 'slow').removeClass('hide'); 
            }else{
                $('#color_choose2').hide('clip', 'slow').addClass('hide');
            }                
        });
        
        $('#btn_modificar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if(row_select!=0){
                modifica_user_sis(row_select);
            }else{
                mensaje($( "#mensaje" ),'Warning','./images/msg/warning.png'
                ,'<b>No se ha seleccionado ning&uacute;n user_sis.</b><hr class="boxshadowround"/>'
                ,'Por favor seleccione una user_sis.',400,false);
            }
        } );
        
        $('#btn_asignar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if(row_select!=0){
                asignar_user_sis(row_select);
            }else{
                mensaje($( "#mensaje" ),'Warning','./images/msg/warning.png'
                ,'<b>No se ha seleccionado ning&uacute;n user_sis.</b><hr class="boxshadowround"/>'
                ,'Por favor seleccione una user_sis.',400,false);
            }
        } );

        $('#btn_eliminar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if(row_select!=0){
                elimina_user_sis(row_select);
            }else{
                mensaje($( "#mensaje" ),'Warning','./images/msg/warning.png'
                ,'<b>No se ha seleccionado ning&uacute;n user_sis.</b><hr class="boxshadowround"/>'
                ,'Por favor seleccione una user_sis.',400,false);
            }
        } );
        
    } );
</script>
<style type="text/css">    
    .color_user_sis {
        width: 50px !important;
        height: 25px !important;
        opacity: 0.9;
        filter: alpha(opacity=70);
        border: 1px solid #555;
        border-radius: 3px;
        -moz-border-radius: 3px; 
    }
    #color,#m_color#color_m{
        text-align: center;
        font-weight: bolder;
    }
    #tb_datos_asign tr td{
        text-align: left !important;
        font-size: 11px !important;

    }
    .text1{
        height: 20px !important;
        width: 100% !important;
        padding: 5px !important;
    }
    #f_asignar_user_sis .ui-autocomplete-input{
        width: 80%;
    }
</style>



