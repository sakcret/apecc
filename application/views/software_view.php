<div id="forms">
    <div id="f_agregar_sw" title="Agregar Software" class="hide">
        <p id="form_tips_sw">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_agrega_sw">
            <fieldset>

                <table width="100%" border="0">
                    <tr>
                        <td>
                            <label for="nombre_sw">Nombre del Software*:</label>
                            <input type="text" name="nombre_sw" id="nombre_sw" maxlength="45" class="text" />
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td>
                            <label for="version_sw">Versi&oacute;n*:</label>
                            <input type="text" name="version_sw" id="version_sw" maxlength="45" class="text" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><label for="descripcion_sw">Descripci&oacute;n:</label>
                            <textarea name="descripcion_sw"  id="descripcion_sw"  rows="6" class="textarea" ></textarea>
                    </tr>
                    <tr>
                        <td>
                            <label for="so_sw">Sistema Operativo*:</label><br>
                            <select id="so_sw" name="so_sw">
                                <option value="Slower">Slower</option>
                                <option value="Slow" selected="selected">Slow</option>
                                <option value="Medium">Medium</option>
                                <option value="Fast">Fast</option>
                                <option value="Faster">Faster</option>
                                <option value="11">Up to eleven</option>
                            </select>

                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </table> 
            </fieldset>
        </form>
    </div>
    <div id="f_modificar_sw" title="Modificar Software" class="hide">
        <p id="form_tips_msw">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_modifica_sw">
            <fieldset>
                <table width="100%" border="0">
                    <tr>
                        <td>
                            <label for="m_nombre_sw">Nombre del Software*:</label>
                            <input type="text" name="m_nombre_sw" id="m_nombre_sw" maxlength="45" class="text" />
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td>
                            <label for="m_version_sw">Versi&oacute;n*:</label>
                            <input type="text" name="m_version_sw" id="m_version_sw" maxlength="45" class="text" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><label for="m_descripcion_sw">Descripci&oacute;n:</label>
                            <textarea name="m_descripcion_sw"  id="m_descripcion_sw"  rows="6" class="textarea" ></textarea>
                    </tr>
                    <tr>
                        <td>
                            <label for="m_so_sw">Sistema Operativo*:</label>
                            <select id="m_so_sw" name="m_so_sw" class="select"></select>

                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td>&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </table> 
            </fieldset>
        </form>
    </div>

    <div id="f_asigna_grupo" title="Asignar Grupo de Software" class="hide">
        <p id="form_tips_asw">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_asigna_grupo">
            <fieldset>
                <label for="asg_software">Nombre del Software(solo lectura):</label>
                <input type="text" name="asg_software" id="asg_software" readonly="readonly" maxlength="45" class="text readonly" />
                <label for="grupos_sw">Grupo de software*:</label>
                <select id="grupos_sw" name="grupos_sw"></select><br>
            </fieldset>
        </form>
    </div>
    <div id="f_so" title="Agregar Sistema Operativo" class="hide">
        <p id="form_tips_so">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_so">
            <fieldset>
                <label for="nombre_so">Nombre del Sistema Operativo*:</label>
                <input type="text" name="nombre_so" id="nombre_so" maxlength="45" class="text" />
            </fieldset>
        </form>
    </div>
    <div id="f_mso" title="Modificar Sistema Operativo" class="hide">
        <p id="form_tips_mso">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_mso">
            <fieldset>
                <label for="m_nombre_so">Nombre del Sistema Operativo*:</label>
                <input type="text" name="m_nombre_so" id="m_nombre_so" maxlength="45" class="text" />
            </fieldset>
        </form>
    </div>

    <div id="f_agregar_grupo" title="Agregar Grupo Software" class="hide">
        <p id="form_tips_agrupo">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_agregar_grupo">
            <fieldset>
                <table width="100%" border="0">
                    <tr>
                        <td>
                            <label for="nombre_grupo">Nombre del Grupo*:</label>
                            <input type="text" name="nombre_grupo" id="nombre_grupo" maxlength="45" class="text ui-widget-content ui-corner-all" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="descripcion_grupo">Descripci&oacute;n:</label>
                            <textarea style="padding: 5px; width:95%" name="descripcion_grupo" onkeyup="contar_chars_restantes(this,3000,'chars_desc');" class="text ui-widget-content ui-corner-all" id="descripcion_grupo" rows="6"></textarea>
                            <div align="right" id="chars_desc">3000/3000 caracteres</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="so_grupo">Sistema operativo*:</label><br>
                            <select id="so_grupo" name="so_grupo" class="select"></select>
                        </td>
                    </tr>
                </table>    
            </fieldset>
        </form>
    </div>

    <div id="f_modifica_grupo" title="Modificar Grupo Software" class="hide">
        <p id="form_tips_mgrupo">Los campos marcados con * son obligatorios.</p>
        <form method="POST" action="" id="form_modificar_grupo">
            <fieldset>
                <table width="100%" border="0">
                    <tr>
                        <td>
                            <label for="m_nombre_grupo">Nombre del Grupo*:</label>
                            <input type="text" name="m_nombre_grupo" id="m_nombre_grupo" maxlength="45" class="text ui-widget-content ui-corner-all" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="m_descripcion_grupo">Descripci&oacute;n*:</label>
                            <textarea style="padding: 5px; width:95%" name="m_descripcion_grupo" onkeyup="contar_chars_restantes(this,3000,'chars_desc_m');" class="text ui-widget-content ui-corner-all" id="m_descripcion_grupo" rows="6"></textarea>
                            <div align="right" id="chars_desc_m">3000/3000 caracteres</div>
                        </td>
                    </tr>
                    <!--tr>
                        <td>
                            <label for="m_so_grupo">Sistema operativo*:</label><br>
                            <select id="m_so_grupo" name="m_so_grupo" class="select"></select>
                        </td>
                    </tr-->
                </table>    
            </fieldset>
        </form>
    </div>
</div>
<br>
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
                <tr id="filter_col2">
                    <td align="left">Nombre del software</td>
                    <td align="center"><input type="text"     name="col2_filter" id="col2_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_regex"  id="col2_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col2_smart"  id="col2_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">versi&oacute;n</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">Descripci&oacute;n</td>
                    <td align="center"><input type="text"     name="col4_filter" id="col4_filter" class="text"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_regex"  id="col4_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col4_smart"  id="col4_smart" checked></td>
                </tr>
                <tr id="filter_col5">
                    <td align="left">Sistema Operativo</td>
                    <td align="center"><input type="text"     name="col5_filter" id="col5_filter" class="text" ></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_regex"  id="col5_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col5_smart"  id="col5_smart" checked></td>
                </tr>
            </tbody>
        </table>
    </center>
</div>
<div class="row boxshadowround ui-widget-content ui-corner-bottom">
    <div class="twelvecol last">
        <div class="tabs">
            <ul>
                <li><a href="#tabs-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Software&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                <li><a href="#tabs-2">Grupos de Software</a></li>
                <li><a href="#tabs-3">Sistemas Operativos</a></li>
            </ul>
            <div id="tabs-1">
                <div class="ui-widget-header ui-corner-all but_bar_content">
                    <button id="btn_agregar_sw" class="but_bar"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                    <button id="btn_modificar_sw" class="but_bar"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                    <button id="btn_actualizar_sw" class="but_bar"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_eliminar_sw" class="but_bar"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                    <button id="btn_asignar_grupo_sw" class="but_bar"><img src="./images/asigna.ico"/>&nbsp;Asignar Grupo</button>
                    <button class="but_bar" style="height: 32px !important; width: 240px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                </div>
                <table cellpadding="0" cellspacing="0" border="1" class="display" id="dtsoftware">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th width="20%">Nombre del Software</th>
                            <th width="7%">Versi&oacute;n</th>
                            <th width="35%">Descripci&oacute;n</th> 
                            <th width="15%">Sistema Operativo</th>
                            <th>idso</th>
                            <th width="8%">.</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombre del Software</th>
                            <th>Versi&oacute;n</th>
                            <th>Descripci&oacute;n</th> 
                            <th>Sistema Operativo</th>
                            <th>idso</th>
                            <th>.</th>
                        </tr>
                    </tfoot>
                </table> <br>
                <div class="ui-widget-header ui-corner-all" style="height: 20px; margin-bottom: 10px;">
                    <center><div style=" float: left; margin-left: 30px;">Grupos en los que se encuentra el Software: </div><div style=" margin-left: 10px; float: left;" id="gru_select">No se ha selecionado un Software</div></center>
                </div>
                <table cellpadding="0" cellspacing="0" border="1" class="display" id="dtgrupossw">
                    <thead>
                        <tr>
                            <th>idgru</th>
                            <th>Nombre del Grupo</th>
                            <th>idsw</th>
                            <th>Opc</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>idgru</th>
                            <th>Nombre del Grupo</th>
                            <th>idsw</th>
                            <th>Opc</th>
                        </tr>
                    </tfoot>
                </table> 
            </div>
            <br/>
            <div id="tabs-2">
                <div class="ui-widget-header ui-corner-all but_bar_content">
                    <button id="btn_agregar_gsw" class="but_bar"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                    <button id="btn_modificar_gsw" class="but_bar"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                    <button id="btn_actualizar_gsw" class="but_bar"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_eliminar_gsw" class="but_bar"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                </div>
                <table cellpadding="0" cellspacing="0" border="1" class="display" id="dtgrupossoftware" width="100%">
                    <thead>
                        <tr>
                            <th width="4%">id</th>
                            <th width="25%">Nombre del grupo</th>
                            <th width="40%">Descripci&oacute;n</th>
                            <th width="25%">Sistema Operativo</th>
                            <th width="6%">.</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Nombre del grupo</th>
                            <th>Descripci&oacute;n</th>
                            <th>Sistema Operativo</th>
                            <th>.</th>
                        </tr>
                    </tfoot>
                </table> 

            </div>
            <div id="tabs-3">
                <div class="ui-widget-header ui-corner-all but_bar_content">
                    <button id="btn_agregar_so" class="but_bar"><img src="./images/agregar.png"/>&nbsp;Agregar</button>
                    <button id="btn_modificar_so" class="but_bar"><img src="./images/modificar.png"/>&nbsp;Modificar</button>
                    <button id="btn_actualizar_so" class="but_bar"><img src="./images/actualizar.png"/>&nbsp;Actualizar</button>
                    <button id="btn_eliminar_so" class="but_bar"><img src="./images/eliminar.png"/>&nbsp;Eliminar</button>
                </div>
                <table cellpadding="0" cellspacing="0" border="1" class="display" id="dtso" width="100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Sistema Operativo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Sistema Operativo</th>
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                </table> 
            </div>

        </div>
    </div>
</div><br>
<script type="text/javascript" charset="utf-8">
    var dt_grupossoftware,dt_so,dt_software,dt_grupos_sw,datos_grupo_sw_selec,datos_sw_selec;
    var sw_select=0,so_select=0,gsw_select=0,grupo_sw_selec=0;
    
     /*Funcion para aplicar filtro global en el datatable usuarios*/
    function fnFilterGlobal (){
        $('#dtsoftware').dataTable().fnFilter( 
        $("#global_filter").val(),
        null, 
        $("#global_regex")[0].checked, 
        $("#global_smart")[0].checked
    );
    }
    /*Funcion para aplicar filtro aun campo en el datatable usuarios*/
    function fnFilterColumn ( i ){
        $('#dtsoftware').dataTable().fnFilter( 
        $("#col"+(i+1)+"_filter").val(),
        i, 
        $("#col"+(i+1)+"_regex")[0].checked, 
        $("#col"+(i+1)+"_smart")[0].checked
    );
    }
    
    function muestra_datos_form_msw(id){
        var respuesta= ajax_peticion_json('index.php/software/getDatosSW','id='+id);
        if(respuesta!=false){
            var nombre = $( "#m_nombre_sw" ), version= $( "#m_version_sw" ),descripcion = $( "#m_descripcion_sw" ),
            so = $( "#m_so_sw" );
            nombre.val(respuesta.nom);
            version.val(respuesta.ver);
            descripcion.val(respuesta.des);
            so.selectmenu("value", respuesta.so);
        }
    }
    
    function desasignar_grupo(idgru,idsw){
        $('#mensaje').html('<div id="desasigna_grupo" title="Eliminar sofware" class="hide">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se eliminar&aacute; el software permanentemente. ¿Deseas Continuar?</p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#desasigna_grupo").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:350,
            buttons: {
                "Eliminar": function() {
                    var respuesta = ajax_peticion("index.php/software/desasignaGrupoSW","idgru="+idgru+"&idsw="+idsw);
                    if (respuesta=='ok'){dt_grupos_sw.fnClearTable();
                        $.ajax({
                            url:"index.php/software/getGruposxsw",
                            type:"POST",
                            data: 'idsw='+idsw,
                            dataType: "json",
                            success:
                                function(respuesta){
                                if(respuesta!=false){
                                    var a=[];
                                    $.each(respuesta, function(k,v){
                                        a[k]=[v.idgru,v.gru,v.idsw,'<img src="images/desasigna.ico" class="opc" title="Desasignar Grupode software" alt="Desasignar Grupo" onclick="desasignar_grupo(\''+v.id+'\',\''+v.idsw+'\')"/>'
                                        ];});
                                    dt_grupos_sw.fnAddData(a);
               
                                }}
                        });
                        notificacion_tip("./images/msg/ok.png","Desasignar Grupo de Software","El grupo de software se desasign&oacute; satisfactoriamente.");
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
    
    function asigna_grupo(idsw,idso,software){
        carga_grupos_sw(idso);
        $('#asg_software').val(software);
        var grupos=$('#grupos_sw'),select_ui=$('#grupos_sw-button'),tips=$('#form_tips_asw');
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#f_asigna_grupo").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:350,
            buttons: {
                "Asignar Grupo": function() {
                    select_ui.removeClass( "ui-state-error" );
                    grupos.removeClass( "ui-state-error" );
                    var bValid = true;
                    bValid = bValid && verificaSelect(grupos,'Selecione un <b>Grupo de software</b> por favor',tips);
                    if ( bValid ) {
                        var datos =$("#form_asigna_grupo").serialize();
                        var respuesta = ajax_peticion("index.php/software/asignaGrupoSW",datos+"&idsw="+idsw);
                        if (respuesta=='ok'){
                            dt_grupos_sw.fnClearTable();
                            $("#gru_select").text(software);
                            $.ajax({
                                url:"index.php/software/getGruposxsw",
                                type:"POST",
                                data: 'idsw='+idsw,
                                dataType: "json",
                                success:
                                    function(respuesta){
                                    if(respuesta!=false){
                                        var a=[];
                                        $.each(respuesta, function(k,v){
                                            a[k]=[v.idgru,v.gru,v.idsw,'<img src="images/desasigna.ico" class="opc" title="Desasignar Grupo de '+datos[1]+'" alt="Desasignar Grupo" onclick="desasignar_grupo(\''+v.idgru+'\',\''+v.idsw+'\')"/>'
                                            ];});
                                        dt_grupos_sw.fnAddData(a);
                                    }}
                            });
                            notificacion_tip("./images/msg/ok.png","Eliminar Software","El Software se elimin&oacute; satisfactoriamente.");
                        }else{
                            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                        }
                        $( this ).dialog( "close" );
                    }else{select_ui.addClass("ui-state-error");}
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                select_ui.removeClass( "ui-state-error" );
                grupos.removeClass( "ui-state-error" );
                $('#asg_software').val();
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");
    }
    
    function modifica_gruposw(id){
        var nombre = $( "#m_nombre_grupo" ),
        descripcion = $( "#m_descripcion_grupo" ),
        //so = $( "#m_so_grupo" ),
        //select_ui = $( "#m_so_grupo-button" ),
        allFields = $( [] ).add(nombre).add(descripcion),
        tips = $( "#form_tips_mgrupo" );
        var respuesta= ajax_peticion_json('index.php/software/getDatosGrupo','id='+id);
        if(respuesta!=false){
            nombre.val(respuesta.nom);
            descripcion.val(respuesta.des);
        }
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modifica_grupo").dialog({
            autoOpen: false,
            width: 550,
            modal: true,
            buttons: {
                'Agregar Software': function() {
                    allFields.removeClass( "ui-state-error" );
                    var bValid = true;
                    bValid = bValid && campoVacio(nombre,'Nombre del Grupo',tips);
                    /*var sel_valid=verificaSelect(so,'Selecione un <b>Sistema Operativo</b> por favor',tips);
                    if(!sel_valid){select_ui.addClass("ui-state-error");
                    }   
                    bValid = bValid && sel_valid;*/
                    if ( bValid ) {  
                        var datos = $( "#form_modificar_grupo" ).serialize()+'&idgru='+id;
                        var urll="index.php/software/modificaGrupo";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_grupossoftware.fnDraw();   
                            notificacion_tip("./images/msg/ok.png","Modificar Grupo de Software","El grupo de software se modific&oacute; satisfactoriamente.");
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
        
    function elimina_gruposw(id){
        $('#mensaje').html('<div id="dialog_elimina_grupo" title="Eliminar Grupo de Sofware" class="hide">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se eliminar&aacute;n las asignaciones de software relacionadas con este grupo. ¿Deseas Continuar?</p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog_elimina_grupo").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:350,
            buttons: {
                "Eliminar": function() {
                    var respuesta = ajax_peticion("index.php/software/eliminaGrupo","id="+id);
                    if (respuesta=='ok'){
                        dt_grupossoftware.fnDraw();  
                        notificacion_tip("./images/msg/ok.png","Eliminar Grupo de software","El grupo de Software se elimin&oacute; satisfactoriamente.");
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
    /**
     *  Funcion que modifica los datos del software seleccionado
     *  @param {integer} id -id del software a modifcar
     *  @returns {}
     */
    function modifica_software(id){
        carga_sos_sw();
        var nombre = $( "#m_nombre_sw" ),
        version= $( "#m_version_sw" ),
        descripcion = $( "#m_descripcion_sw" ),
        so = $( "#m_so_sw" ),
        select_ui = $( "#m_so_sw-button" ),
        allFields = $( [] ).add(nombre).add(version).add(descripcion).add(so).add(select_ui),
        tips = $( "#form_tips_msw" );
        muestra_datos_form_msw(id);
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_sw").dialog({
            autoOpen: false,
            width: 550,
            modal: true,
            buttons: {
                'Modificar Software': function() { 
                    allFields.removeClass( "ui-state-error" );
                    var bValid = true;
                    bValid = bValid && campoVacio(nombre,'Nombre del Software',tips);
                    bValid = bValid && verificaSelect(so,'Selecione un <b>Sistema Operativo</b> por favor',tips);
                    if ( bValid ) {  
                        var datos = $( "#form_modifica_sw" ).serialize()+'&id='+id;
                        var urll="index.php/software/modificaSoftware";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_software.fnDraw();
                            notificacion_tip("./images/msg/ok.png","Modificar Software","El software se modific&oacute; satisfactoriamente.");
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
                so.val(0);
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");   
    }
    
    function elimina_software(id){
        $('#mensaje').html('<div id="dialog_elimina_sw" title="Eliminar sofware" class="hide">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se eliminar&aacute; el software permanentemente. ¿Deseas Continuar?</p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog_elimina_sw").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:350,
            buttons: {
                "Eliminar": function() {
                    var respuesta = ajax_peticion("index.php/software/eliminaSoftware","id="+id);
                    if (respuesta=='ok'){
                        dt_software.fnDraw();
                        $("#gru_select").text("No se ha selecionado un Software");
                        sw_select=0;
                        notificacion_tip("./images/msg/ok.png","Eliminar Software","El Software se elimin&oacute; satisfactoriamente.");
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
    
    function modifica_so(id){
        var nombre = $( "#m_nombre_so" ),
        tips = $( "#form_tips_mso" );
        var json_so=ajax_peticion_json("index.php/software/getDatosSO","id="+id);
        if (json_so!=false){nombre.val(json_so.nom)}
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_mso").dialog({
            autoOpen: false,
            width: 550,
            modal: true,
            buttons: {
                'Modificar Sistema Operativo': function() {
                    nombre.removeClass( "ui-state-error" );
                    var bValid = true;
                    bValid = bValid && campoVacio(nombre,'Nombre del Sistema Operativo',tips);
                    if ( bValid ) {  
                        var datos = $( "#form_mso" ).serialize()+'&idso='+id;
                        var urll="index.php/software/modificaSO";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_so.fnDraw();   
                            notificacion_tip("./images/msg/ok.png","Modificarar Sistema operativo","El sistema operativo se modific&oacute; satisfactoriamente.");
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
                nombre.val( "" ).removeClass( "ui-state-error" );
                updateTips('Los campos marcados con * son obligatorios.',tips);
            }
        }).dialog("open");
    }
    
    function elimina_so(id){
        $('#mensaje').html('<div id="dialog_elimina_so" title="Eliminar Sistema Operativo" class="hide">'+
            '<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'+
            '&nbsp;&nbsp;Se eliminar&aacute; el sistema operativo permanentemente. ¿Deseas Continuar?</p></div>');
        
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog_elimina_so").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:350,
            buttons: {
                "Eliminar": function() {
                    var respuesta = ajax_peticion("index.php/software/eliminaSO","id="+id);
                    if (respuesta=='ok'){
                        dt_so.fnDraw();
                        notificacion_tip("./images/msg/ok.png","Eliminar Sistema Operativo","El Sistema operativo se elimin&oacute; satisfactoriamente.");
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
    
    function carga_sos_sw(){
        var c = get_value('software/getSistemasSW/',{});
        $('[name="so_sw"] option').remove();
        $('[name="m_so_sw"] option').remove();
        var selec="<option value='0'>Selecciona un Sistema Operativo</option>";
        $('[name="so_sw"]').append(selec);
        $('[name="so_sw"]').append(c);
        $('[name="m_so_sw"]').append(selec);
        $('[name="m_so_sw"]').append(c);
        $("#so_sw").selectmenu();
        $("#m_so_sw").selectmenu();
    }
        
    function carga_sos_grupos(){
        var c = get_value('software/getSistemasSW/',{});
        $('[name="so_grupo"] option').remove();
        // $('[name="m_so_grupo"] option').remove();
        var selec="<option value='0'>Selecciona un Sistema Operativo</option>";
        $('[name="so_grupo"]').append(selec);
        $('[name="so_grupo"]').append(c);
        //$('[name="m_so_grupo"]').append(selec);
        //$('[name="m_so_grupo"]').append(c);
        $("#so_grupo").selectmenu();
        //$("#m_so_grupo").selectmenu();
    }
    
    function carga_grupos_sw(idso){
        var c = get_value('software/getGruposSW/',{idso:idso});
        $('[name="grupos_sw"] option').remove();
        var selec="<option value='0'>Selecciona un grupo</option>";
        $('[name="grupos_sw"]').append(selec);
        $('[name="grupos_sw"]').append(c);
        $("#grupos_sw").selectmenu();
    }
   
    $(document).ready(function() {
        $("#so_sw").selectmenu();
        $("#m_so_sw").selectmenu();
        $("#grupos_sw").selectmenu();
        $("#so_grupo").selectmenu();
        $("#m_so_grupo").selectmenu();
        /*ocultar y mostrar las ociones de filtro del datatable usuarios(busqueda avanzada)*/
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
        
        /*********************************************************************************************/
        /*Crear datatables de sw de software*/
        dt_grupossoftware=$('#dtgrupossoftware').dataTable({
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "",
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
            "aLengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 1000, "Todos"]],
            "sPaginationType": "full_numbers", 
            "aaSorting": [[1, 'asc']],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/software/datosGruposSW",
            "fnServerData": function( sUrl, aoData, fnCallback ) {
                $.ajax({
                    "url": sUrl,
                    "data": aoData,
                    "success": fnCallback,
                    "dataType": "jsonp",
                    "cache": false
                });
            }
        });
        verOcultarColDT(0,dt_grupossoftware);//ocultar el primer campo del datatable
        
        /*agregar la clase row_select al datatable para determinar que elemento esta seleccionado*/
        $("#dtgrupossoftware tbody tr").live('click', function( e1 ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                gsw_select=0;
            }
            else {
                dt_grupossoftware.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_grupossoftware);
                var datos=dt_grupossoftware.fnGetData(anSelected[0]);
                gsw_select=datos[0];
                
            }
        });
        
        $('#btn_actualizar_gsw').click(function(){
            dt_grupossoftware.fnDraw();
        });
        $('#btn_agregar_gsw').click(function(){
            carga_sos_grupos();
            var nombre = $( "#nombre_grupo" ),
            descripcion = $( "#descripcion_grupo" ),
            so = $( "#so_grupo" ),
            select_ui = $( "#so_grupo-button" ),
            allFields = $( [] ).add(nombre).add(descripcion).add(so).add(select_ui),
            tips = $( "#form_tips_agrupo" );
            $( "#dialog:ui-dialog" ).dialog( "destroy" );
            $( "#f_agregar_grupo").dialog({
                autoOpen: false,
                width: 550,
                modal: true,
                buttons: {
                    'Agregar Software': function() {
                        allFields.removeClass( "ui-state-error" );
                        var bValid = true;
                        bValid = bValid && campoVacio(nombre,'Nombre del Grupo',tips);
                            
                        var sel_valid=verificaSelect(so,'Selecione un <b>Sistema Operativo</b> por favor',tips);
                        if(!sel_valid){select_ui.addClass("ui-state-error");
                        }
                            
                        bValid = bValid && sel_valid;
                        if ( bValid ) {  
                            var datos = $( "#form_agregar_grupo" ).serialize();
                            var urll="index.php/software/agregaGrupo";
                            var respuesta = ajax_peticion(urll,datos);
                            if (respuesta=='ok'){
                                dt_grupossoftware.fnDraw();   
                                notificacion_tip("./images/msg/ok.png","Agregar Grupo de Software","El grupo de software se agreg&oacute; satisfactoriamente.");
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
                    so.val(0);
                    updateTips('Los campos marcados con * son obligatorios.',tips);
                }
            }).dialog("open");
        });
            
        $('#btn_modificar_gsw').click(function(){
            if((gsw_select!=0)&&(gsw_select!='')){
                modifica_gruposw(gsw_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un grupo de software ! ','./images/msg/warning.png','Selecciona un grupo de software por favor.','');
            }
        });
        $('#btn_eliminar_gsw').click(function(){
            if((gsw_select!=0)&&(gsw_select!='')){
                elimina_gruposw(gsw_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un grupo de software ! ','./images/msg/warning.png','Selecciona un grupo de software por favor.','');
            }
        });
        
        /*********************************************************************************************/
        /*Crear datatables de sistemas operativos*/
        dt_so=$('#dtso').dataTable({
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "",
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
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "sPaginationType": "full_numbers",      
            "aaSorting": [[1, 'asc']],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/software/datosSO",
            "fnServerData": function( sUrl, aoData, fnCallback ) {
                $.ajax({
                    "url": sUrl,
                    "data": aoData,
                    "success": fnCallback,
                    "dataType": "jsonp",
                    "cache": false
                });
            }
        });
        verOcultarColDT(0,dt_so);//ocultar el primer campo del datatable
        /*agregar la clase row_select al datatable para determinar que elemento esta seleccionado*/
        $("#dtso tbody tr").live('click', function( e1 ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                so_select=0;
            }
            else {
                dt_so.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_so);
                var datos=dt_so.fnGetData(anSelected[0]);
                so_select=datos[0];
            }
        });
        
        $('#btn_actualizar_so').click(function(){
            dt_so.fnDraw();
        });
        $('#btn_agregar_so').click(function(){
            var nombre = $( "#nombre_so" ),
            tips = $( "#form_tips_so" );
            $( "#dialog:ui-dialog" ).dialog( "destroy" );
            $( "#f_so").dialog({
                autoOpen: false,
                width: 550,
                modal: true,
                buttons: {
                    'Agregar Sistema Operativo': function() {
                        nombre.removeClass( "ui-state-error" );
                        var bValid = true;
                        bValid = bValid && campoVacio(nombre,'Nombre del Sistema Operativo',tips);
                        if ( bValid ) {  
                            var datos = $( "#form_so" ).serialize();
                            var urll="index.php/software/agregaSO";
                            var respuesta = ajax_peticion(urll,datos);
                            if (respuesta=='ok'){
                                dt_so.fnDraw();   
                                notificacion_tip("./images/msg/ok.png","Agregar Sistema operativo","El sistema operativo se agreg&oacute; satisfactoriamente.");
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
                    nombre.val( "" ).removeClass( "ui-state-error" );
                    updateTips('Los campos marcados con * son obligatorios.',tips);
                }
            }).dialog("open");
        });
        
        $('#btn_modificar_so').click(function(){
            if((so_select!=0)&&(so_select!='')){
                modifica_so(so_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un sistema operativo  ! ','./images/msg/warning.png','Selecciona un sistema operativo por favor.','');
            }
        });
        $('#btn_eliminar_so').click(function(){
            if((so_select!=0)&&(so_select!='')){
                elimina_so(so_select);
            }else{
                mensaje($( "#mensaje" ),'No ha selecionado un sistema operativo ! ','./images/msg/warning.png','Selecciona un sistema operativo por favor.','');
            }
        });
        
        /*********************************************************************************************/
        /*Crear datatables de software dsiponible*/
        dt_software=$('#dtsoftware').dataTable({
            "bJQueryUI": true,              
            "oLanguage":{
                "sProcessing":   "<div class=\"ui-widget-header boxshadowround\"><strong>Procesando...</strong><img src='./images/load.gif'./></div>",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "",
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
            "aLengthMenu": [[5,10, 25, 50, 100, 1000, -1], [5,10, 25, 50, 100, 1000, "Todos"]],
            "sPaginationType": "full_numbers",  
            "aaSorting": [[1, 'asc']],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "index.php/software/datosSoftware",
            "fnServerData": function( sUrl, aoData, fnCallback ) {
                $.ajax({
                    "url": sUrl,
                    "data": aoData,
                    "success": fnCallback,
                    "dataType": "jsonp",
                    "cache": false
                });
            }
        });
        verOcultarColDT(0,dt_software);//ocultar el primer campo del datatable
        verOcultarColDT(5,dt_software);
        /*agregar la clase row_select al datatable para determinar que elemento esta seleccionado*/
        $("#dtsoftware tbody tr").live('click', function( e ) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                $("#gru_select").text("No se ha selecionado un Software");
                dt_grupos_sw.fnClearTable();
                sw_select=0;
            }
            else {
                dt_software.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_software);
                var datos=dt_software.fnGetData(anSelected[0]);
                datos_sw_selec=datos;
                var respuesta=false;
                sw_select=datos[0];
                /**Agregar al datatables los grupos asociados al software seleccionado*/
                dt_grupos_sw.fnClearTable();
                $("#gru_select").text(datos[1]);
                $.ajax({
                    url:"index.php/software/getGruposxsw",
                    type:"POST",
                    data: 'idsw='+datos[0],
                    dataType: "json",
                    success:
                        function(respuesta){
                        if(respuesta!=false){
                            var a=[];
                            $.each(respuesta, function(k,v){
                                a[k]=[v.idgru,v.gru,v.idsw,'<img src="images/desasigna.ico" class="opc" title="Desasignar Grupo de '+datos[1]+'" alt="Desasignar Grupo" onclick="desasignar_grupo(\''+v.idgru+'\',\''+v.idsw+'\')"/>'
                                ];});
                            dt_grupos_sw.fnAddData(a);
               
                        }}
                });
                
            }
        });
        
        $('#btn_actualizar_sw').click(function(){
            dt_software.fnDraw();
        });
        
        $('#btn_agregar_sw').click(function(){
            carga_sos_sw();
            var nombre = $( "#nombre_sw" ),
            version= $( "#version_sw" ),
            descripcion = $( "#descripcion_sw" ),
            so = $( "#so_sw" ),
            select_ui = $( "#so_sw-button" ),
            grupo = $( "#grupo_sw" ),
            allFields = $( [] ).add(nombre).add(version).add(descripcion).add(so).add(grupo).add(select_ui),
            tips = $( "#form_tips_sw" );
            $( "#dialog:ui-dialog" ).dialog( "destroy" );
            $( "#f_agregar_sw").dialog({
                autoOpen: false,
                width: 550,
                modal: true,
                buttons: {
                    'Agregar Software': function() {
                        allFields.removeClass( "ui-state-error" );
                        var bValid = true;
                        bValid = bValid && campoVacio(nombre,'Nombre del Software',tips);
                        var sel_valid=verificaSelect(so,'Selecione un <b>Sistema Operativo</b> por favor',tips);
                        if(!sel_valid){select_ui.addClass("ui-state-error");}
                        bValid = bValid && sel_valid;
                        if ( bValid ) {  
                            var datos = $( "#form_agrega_sw" ).serialize();
                            var urll="index.php/software/agregaSoftware";
                            var respuesta = ajax_peticion(urll,datos);
                            if (respuesta=='ok'){
                                dt_software.fnDraw();   
                                notificacion_tip("./images/msg/ok.png","Agregar Software","El software se agreg&oacute; satisfactoriamente.");
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
                    so.val(0);
                    grupo.val(0);updateTips('Los campos marcados con * son obligatorios.',tips);
                }
            }).dialog("open");
        });
        
        $('#btn_modificar_sw').click(function(){
            if((sw_select!=0)&&(sw_select!='')){
                modifica_software(sw_select);
            }else{
                mensaje($( "#mensaje" ),'No hay software selecionado ! ','./images/msg/warning.png','Selecciona un software por favor.','',400,true);
            }
        });
        
        $('#btn_eliminar_sw').click(function(){
            if((sw_select!=0)&&(sw_select!='')){
                elimina_software(sw_select);
            }else{
                mensaje($( "#mensaje" ),'No hay software selecionado ! ','./images/msg/warning.png','Selecciona un software por favor.','',400,true);
            }
        });
        
        $('#btn_asignar_grupo_sw').click(function(){
            if((sw_select!=0)&&(sw_select!='')){
                asigna_grupo(sw_select,datos_sw_selec[5],$("#gru_select").text());
            }else{
                mensaje($( "#mensaje" ),'No hay software selecionado ! ','./images/msg/warning.png','Selecciona un software por favor.','');
            }
        });
        
        /*********************************************************************************************/
        
        dt_grupos_sw=$('#dtgrupossw').dataTable({
            "bJQueryUI": true,
            "sDom": '<"H">t<"F">',             
            "oLanguage":{
                "sLengthMenu":   "Catedraticos",
                "sZeroRecords":  "!!! No se encontraron resultados.",
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
        verOcultarColDT(0,dt_grupos_sw);
        verOcultarColDT(2,dt_grupos_sw);
        $('#dtgrupossw tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                grupo_sw_selec=0;
            }
            else {
                dt_grupos_sw.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
                var anSelected = fnGetSelected(dt_software);
                var datos=dt_software.fnGetData(anSelected[0]);
                grupo_sw_selec=datos[0];
                datos_grupo_sw_selec=datos;
            }
        } );
        
    });//findocument ready
</script>
<style>
    #so_sw,#m_so_sw,#grupos_sw,#grupos_so{width: 300px !important;}
    #m_so_grupo,#so_grupo{width: 300px !important;}
</style>
<!-- clor de letra color: #2779AA; -->