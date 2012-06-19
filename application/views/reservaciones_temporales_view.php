
<div class="row hide">
    <div id="dialog_asignacion_momentanea" onLoad="window.setTimeout('mostrar_hora()',1000);" title="Reservaciones Momentaneas" >
        <div class="tips_validacion" style="height: auto; width: 100% !important;">
            <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
                &nbsp;&nbsp;Proporciona los datos que se piden.Los campos marcado con * son obligatorios.</p>
        </div>
        <fieldset style="width: 100% !important; margin-top: 20px !important;">
            <form id="form_reservacion">
                <table width="100%" border="0">
                    <tr>
                        <td colspan="2"><label class="space_form" for="tipo_u">Tipo de usuario: </label><br>
                            <select name="tipo_u" class="selectmenu-ui" id="tipo_u"></select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><label class="space_form" for="usuarios">Usuario*:</label><br>
                            <select name="usuario" id="usuario"></select></td>
                    </tr>
                    <tr>
                        <td colspan="2"><span id="no_find_u" style=" margin-top: 5px; margin-bottom: 5px;"><img src="./images/ayuda.ico">&nbsp;&nbsp;No encuentro al Usuario</span></td>
                    </tr>
                    <tr>
                        <td width="86"><label for="hora_inicio">Hora de Inicio(Solo lectura):</label>
                            <input name="hora_inicio" readonly="readonly" id="hora_inicio" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" type="text">&nbsp;</td>
                        <td width="85">
                            <div id="hfhide">
                                <label for="hora_fin">Hora de Fin(Solo lectura):</label>
                                <input name="hora_fin" id="hora_fin" readonly="readonly" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" type="text">&nbsp;
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="86">
                            <div id="hrhide">
                                <label for="horas">N&uacute;mero de Horas*:</label>&nbsp;&nbsp;
                                <input maxlength="2" name="horas" onkeypress="return IsNumber(event);" class="height_widget" id="horas" onkeyup="calc_campos($(this));" value="1" type="text"/>&nbsp;

                            </div> 
                        </td>
                        <td width="85">
                            <div id="imphide">
                                <label for="importe">Importe(Solo lectura):</label>&nbsp;&nbsp;<br>
                                $&nbsp;<input name="importe" type="text" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" id="importe" value="1.0" size="8" maxlength="8" readonly="readonly"/>&nbsp;M/N
                            </div>
                        </td>
                    </tr>
                    <!--tr>
                        <td height="40" colspan="2"><input type="checkbox" class="checkbox-ui" id="hora_fin_ne" value="reservacion_abierta" name="hora_fin_ne">
                            <label for="hora_fin_ne">No deseo proporcionar &quot;Hora Fin&quot; de la reservaci&oacute;n</label></td>
                    </tr-->
                </table>
            </form>
        </fieldset>
    </div>
    <div id="dialog_termina_actualiza_reserv" title="Reservaciones Momentaneas" style="display:none;">
        <p class="tips_termina_reserv"></p>
        <div id="datos_reserv">
            <table width="100%" border="0">

                <tr>
                    <td colspan="2">
                        <label for="b_usuario_rt">Usuario(Login):</label>
                        <input name="b_usuario_rt" id="b_usuario_rt" readonly="readonly" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" type="text">&nbsp;
                        <br></td>
                </tr>
                <tr>
                    <td width="86">
                        <label for="drm_horainicio">Hora de Inicio(solo lectura):</label>
                        <input name="drm_horainicio" id="drm_horainicio" readonly="readonly" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" type="text">&nbsp;
                    </td>
                    <td width="85">
                        <div>
                            <label for="drm_horafin">Hora de Fin(solo lectura):</label>
                            <input name="drm_horafin" id="drm_horafin" readonly="readonly" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" type="text">&nbsp;
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="86">
                        <label for="drm_horas">N&uacute;mero de Horas(Solo lectura):</label>&nbsp;&nbsp;
                        <input maxlength="2" name="drm_horas" readonly="readonly" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" id="drm_horas" value="1" type="text"/>&nbsp;
                    </td>
                    <td height="30" width="85">
                        <label for="drm_importe" >Importe(Solo lectura):</label>&nbsp;&nbsp;<br>
                        $&nbsp;<input name="drm_importe" type="text" class="paddleft5 readonly height_widget ui-widget-content ui-corner-all" id="drm_importe" value="1.0" size="8" maxlength="8" readonly="readonly"/>&nbsp;M/N
                    </td>
                </tr>
            </table>
            <div>
                <!--fieldset class="ui-widget-content ui-corner-all">
                    <legend class="ui-widget-header header_person ui-corner-all">Datos de Reservacion</legend>
               </fieldset-->
            </div>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="twelvecol last">
        <div style=" margin-top: 8px; margin-bottom: 12px;" class="ui-corner_all boxshadowround">
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
        <div style=" margin-top: 8px; margin-bottom: 12px;" class="ui-corner_all boxshadowround">
            <table width="100%" border="0">
                <tr>
                    <td id="ayuda_edos_equ" width="16%"><img src="./images/ayuda.png"/>&nbsp;Barra de detalles de equipo:</td>
                    <td width="14%"><img width="19" src="./images/pc_edos/pc_sos.png"/>&nbsp;Mostrar sistemas operativos</td>
                    <td width="14%"><img width="19" src="./images/pc_edos/pc_sw.png"/>&nbsp;Mostrar software por sistema</td>
                    <td width="14%"><img width="19" src="./images/pc_edos/pc_dt.png"/>&nbsp;Mostrar caracter&iacute;sticas del equipo</td>
                </tr>
            </table>
        </div>
        <?php

        function getv_key($s, $array) {
            reset($array);
            $key = 0;
            for ($x = 0; $x < count($array); $x++) {
                if (($array[$x]['NumeroSerie'] == $s)) {
                    $key = $x;
                } else {
                    $key = false;
                }
            }
            return $key;
        }

        $tmp_row = $tmp_col = $tmp_sal = 0;
        $es = $equipos_salas->result_array();
        $index_rt = 0;

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
        $porcentaje = (100 / $numreg) - 0.4;
        echo ' <div id="tabs">' . PHP_EOL . '<ul>' . PHP_EOL;
        for ($is = 0; $is < $numreg; $is++) {
            echo '<li style="width:' . $porcentaje . '%"><a onclick="sala_actual(' . $s[$is]["idSala"] . ')" href="#tabs-' . $s[$is]["idSala"] . '">&nbsp;&nbsp;Sala ' . $s[$is]["Sala"] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>' . PHP_EOL;
        }
        echo '</ul>' . PHP_EOL;
        for ($i = 0; $i < $numreg; $i++) {
            $tmp_sal = $s[$i]["idSala"];
            if ($i == 0) {
                $sala_actual_1 = $tmp_sal;
            }
            $num_eq = 0;
            ?>
            <script type="text/javascript">
                $(function() {
                    $('#<?php echo $s[$i]["idSala"]; ?> td').click(function() {
                        var tr = $(this).parent();
                        for (var i = 0; i < tr.children().length; i++) {
                            if (tr.children().get(i) == this) {
                                var column = i;
                                break;
                            }
                        }
                        var tbody = tr.parent();
                        for (var j = 0; j < tbody.children().length; j++) {
                            if (tbody.children().get(j) == tr.get(0)) {
                                var row = j+1;
                                break;
                            }
                        }
                        $('#<?php echo $s[$i]["idSala"]; ?>info').text('Fila: '+row + ', Columna: ' + column+' en la sala: '+<?php echo $s[$i]["idSala"]; ?>);
                    });
                });
            </script>         
            <div id="tabs-<?php echo $s[$i]["idSala"]; ?>">
                <br>
                <div style="width:900px;"><center>
                        <div class="ui-grid ui-widget ui-widget-content ui-corner-all" style="width:100%;">
                            <div class="ui-grid-header ui-widget-header ui-corner-top" style="width:98.6%;">SALA: <?php echo $s[$i]["Sala"] . ' ' . $s[$i]["Comentario"]; ?></div>
                            <table id="<?php echo $s[$i]["idSala"]; ?>" class="over ui-grid-content ui-widget-content" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th><img src="./images/borrar_todo.png" onclick="libera_sala('<?php echo $s[$i]["idSala"]; ?>')" title="Liberar sala de Fijas"></th>
                                        <?php
                                        $index_col = 'A';
                                        for ($j = 0; $j < $s[$i]["Columnas"]; $j++) {
                                            echo '<th height=30 class="ui-state-default" style="font-size: 20px;">' . $index_col . '</th>' . PHP_EOL;
                                            $index_col++;
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $index_row = $s[$i]["Indice"];
                                    for ($fi = 0; $fi < $s[$i]["Filas"]; $fi++) {
                                        $tmp_row = $fi + 1;
                                        echo '<tr>' . PHP_EOL;
                                        echo '<th width=30 class="ui-state-default" style="font-size: 20px;">' . $index_row . '</th>' . PHP_EOL;
                                        for ($co = 0; $co < $s[$i]["Columnas"]; $co++) {
                                            $hi = $hf = $lo = $horas = $importe = $estado_reserv = '';
                                            $id = '0';
                                            $tmp_col = $co + 1;
                                            $temp = array();
                                            $temp = get_key_array($es, $tmp_row, $tmp_col, $tmp_sal);
                                            $valores = array_values($temp);
                                            (array_key_exists(0, $valores)) ? $numeroSerie = $valores[0] : $numeroSerie = '';
                                            (array_key_exists(4, $valores)) ? $estado = $valores[4] : $estado = '';
                                            if ((count($reserv_temp) > 0) && ($numeroSerie != '')) {
                                                for ($k = 0; $k < count($reserv_temp); $k++) {
                                                    if ($reserv_temp[$k]['NumeroSerie'] == $numeroSerie) {
                                                        $id = $reserv_temp[$k]['idReservacionesMomentaneas'];
                                                        $hi = $reserv_temp[$k]['HoraInicio'];
                                                        $hf = $reserv_temp[$k]['HoraFin'];
                                                        $importe = $reserv_temp[$k]['Importe'];
                                                        $horas = $reserv_temp[$k]['Horas'];
                                                        $lo = $reserv_temp[$k]['Login'];
                                                        $estado_reserv = $reserv_temp[$k]['Estado']; //obtengo el estado de la reservacion ya sea A=activo o I=indeterminada
                                                        $importe = $reserv_temp[$k]['Importe'];
                                                        $horas = $reserv_temp[$k]['Horas'];
                                                    }
                                                }
                                            }
                                            echo '<td width="130" height="120" class="ui-state-focus">';
                                            if ($estado != '') {
                                                echo '<div align="center" class="label_numser">' . $numeroSerie . '</div>
                                                <div align="center" onclick="asigna_equipo(\'' . $numeroSerie . '\',$(\'#' . $numeroSerie . '_img\'),$(this))" id="' . $numeroSerie . '" edo="' . $estado . '" imp="' . $importe . '" hrs="' . $horas . '" idreserv="' . $id . '" horai="' . $hi . '" estado_reserv="' . $estado_reserv . '" horaf="' . $hf . '" usuario="' . $lo . '">' .
                                                '<img style="width: 100px !important;" id="' . $numeroSerie . '_img" src="./images/pc_edos/pc_' . $estado . '.png"/>
                                                </div><div class="ui-corner-all boxshadowround ui-widget-content" align="center">
                                                <img class="sos-pop" title="Sistemas Operativos" onclick="ver_sos(\'' . $numeroSerie . '\')" src="./images/pc_edos/pc_sos.png">
                                                
                                                <div class="ui-widget-content popup-ui" id="pop_sw" aria-label="Login options">
                                                <div align="left" id="pop_so_' . $numeroSerie . '"></div>
                                                </div>
                                                
                                                <img title="Software" onclick="ver_software(\'' . $numeroSerie . '\')" src="./images/pc_edos/pc_sw.png">
                                                <div class="ui-widget-content popup-ui" id="pop_sw" aria-label="Login options">
                                                <div align="left" id="pop_sw_' . $numeroSerie . '"></div>
                                                </div>
                                                
                                                <img class="sos-pop" title="Detalles del equipo" onclick="ver_detalles(\'' . $numeroSerie . '\')" src="./images/pc_edos/pc_dt.png">
                                                <div class="ui-widget-content popup-ui" id="pop_dt" aria-label="Login options">
                                                <div align="left" id="pop_dt_' . $numeroSerie . '"></div>
                                                </div>
                                                </div>';
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
                                Has seleccionado el equipo localizado en: <span id="<?php echo $s[$i]["idSala"]; ?>info">--------</span>&nbsp;<span class="total-eq"><?php echo $num_eq; ?> Equipos</span>
                            </div>
                        </div> <!--fin del grid-->
                    </center>
                </div> 
                <br>
            </div><!--Fin una tab-->
            <?php
        }
        echo '</div><!--Fin del tabs-->';
        ?>
    </div>
</div>
<script type="text/javascript">
    var cb_usuarios=$('#tipo_u');
    var costoxhora = '<?php echo $this->config->item('costoxhora'); ?>';
    
    function sala_actual(idsala){
        sala_select=idsala;
        selected_tab = $tabs.tabs('option', 'selected');
    }
    /*Funcion que calcula la hora de fin y el importes de la reservacion momentanea*/
    function calc_campos(horas){
        var  hoy = new Date(),
        hora = fillZeroDateElement(hoy.getHours()),
        minutos = fillZeroDateElement(hoy.getMinutes()),
        segundos = fillZeroDateElement(hoy.getSeconds()),
        dia = fillZeroDateElement(hoy.getDate()),
        mes = fillZeroDateElement(hoy.getMonth()+1),
        anio=hoy.getFullYear();
        if ((!isNaN(horas.val()))&&(horas.val()!='')){
            var horainicio = new Date(anio+'/'+mes+"/"+dia+' '+$("#hora_inicio").val());
            var horafin=horainicio.addHours(parseInt(horas.val()));
            $("#hora_fin" ).val(fillZeroDateElement(horafin.getHours())+':00:00');
            $("#importe").val(parseFloat(horas.val())*parseFloat(costoxhora));
        }else{}
        
    }
    /*funcion que muestra la hora en el input con el id hora_inicio*/
    function mostrar_hora(){ 
        var  hoy = new Date(),
        hora = fillZeroDateElement(hoy.getHours()),
        minutos = fillZeroDateElement(hoy.getMinutes()),
        segundos = fillZeroDateElement(hoy.getSeconds());
        $("#hora_inicio").val(" "  + hora + ":" + minutos + ":" + segundos); 
        $("#drm_horafin").val(" "  + hora + ":" + minutos + ":" + segundos); 
        window.setTimeout("mostrar_hora()",1000); 
    }
    
    function actualiza_pag(){ 
        var  hoy = new Date(),
        hora = fillZeroDateElement(hoy.getHours()),
        minutos = fillZeroDateElement(hoy.getMinutes()),
        segundos = fillZeroDateElement(hoy.getSeconds());
        var hora_cmp=hora + ":" + minutos+':'+segundos; 
        if(hora_cmp=='05:59:00'||hora_cmp=='06:59:00'||hora_cmp=='07:59:00'||hora_cmp=='08:59:00'||hora_cmp=='09:59:00'||hora_cmp=='10:59:00'
         ||hora_cmp=='11:59:00'||hora_cmp=='12:59:00'||hora_cmp=='13:59:00'||hora_cmp=='14:59:00'||hora_cmp=='15:59:00'
         ||hora_cmp=='16:59:00'||hora_cmp=='17:59:00'||hora_cmp=='18:00:00'||hora_cmp=='19:59:00'||hora_cmp=='20:59:00'
         ||hora_cmp=='21:59:00'){
            notificacion_tip("./images/msg/info.png","Actualizaci&oacute;n dep&aacute;gina","La p&aacute;gina se recargar&aacute; dentro de un minuto.");                     
        }else{}
        
        if(hora_cmp=='06:00:00'||hora_cmp=='07:00:00'||hora_cmp=='08:00:00'||hora_cmp=='09:00:00'||hora_cmp=='10:00:00'
         ||hora_cmp=='11:00:00'||hora_cmp=='12:00:00'||hora_cmp=='13:00:00'||hora_cmp=='14:00:00'||hora_cmp=='15:00:00'
         ||hora_cmp=='16:00:00'||hora_cmp=='17:00:00'||hora_cmp=='18:00:00'||hora_cmp=='19:00:00'||hora_cmp=='20:00:00'
         ||hora_cmp=='21:00:00'||hora_cmp=='22:00:00'){
            redirect_to('reservaciones_temporales');
        }else{}
        window.setTimeout("actualiza_pag()",1000);
    }
</script>
<script type="text/javascript">
    var sala_select=<?php echo $sala_actual_1; ?>;
    
    function libera_sala(sala){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-aux").attr('title','Liberar Sala');
        $("#dialog-aux").html('<p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>'
            +'&nbsp;&nbsp;Se proceder&aacute; a <b>liberar la sala</b>. ¿Deseas Continuar?</p>');
        $("#dialog-aux").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            buttons: {
                "Liberar": function() {
                    var datos ="sala="+sala;
                    var urll="index.php/reservaciones_temporales/liberaSala";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        location.reload(true);
                        mensaje($( "#mensaje" ),'Liberar Sala ','./images/msg/ok.png','La sala se liber&oacute; Satisfactoriamente.','Se proceder&aacute; a recargar la p&aacute;gina para reflejar cambios.');
                    }else{
                        mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                    }
                    
                    $( this ).dialog( "close" );
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        }).dialog("open"); 
    }
    //funcion que carga los valores del combo con el id=usuarios por medio de ajax, llamando a la funcion get_value definida en utilerias.js
    function cargausuarios(){
        var tipo_u = $('#tipo_u').val();
        var c = get_value('reservaciones_temporales/usuarios/',{tipo_u:tipo_u});
        $('[name="usuario"] option').remove();
        var todos="<option value='0'>Todos</option>";
        $('[name="usuario"]').append(todos);
        $('[name="usuario"]').append(c);
        $('#tipo_u').selectmenu();
        
    }
    function cargatipousuario(){
        var datos = '';
        var c = get_value('reservaciones_temporales/tipos_usuarios/',datos);
        $('[name="tipo_u"] option').remove();
        var todos="<option value='0'>Todos</option>";
        $('[name="tipo_u"]').append(todos);
        $('[name="tipo_u"]').append(c);
    }
    
    /**
     *  Funcion que asigna desasigna (dependiendo el caso del equipo y el estado de la reservacion) un equipo
     *  crea una reservacion momentanea o la libera
     *  @param {string} ns -numero de serie del equipo a asignar
     *  @param {objet}  o - objeto (div) que contiene la imagen referente al equipo a asignar/desasignar para poderle cambiar el atributo src
     *  @param {objet} d -objeto (div) que representa al equipo a asignar contiene los datos de la reservacion correspondiente al ese equipo
     *  @returns {} 
     *  @example 
     *          asigna_equipo('MXJ91607VZ',$('#MXJ91607VZ_img'),$(this));
     */
    function asigna_equipo(ns,o,d){
        mostrar_hora($("#hora_inicio"));
        var edo=d.attr("edo");
        if(edo=='L'||edo=='O'||edo=='C'){         
            if(edo=='L'||edo=='C'){
                cargatipousuario();
                cargausuarios();
                var usuario=$('#usuario'),
                horas=$('#horas'),
                nou=false;
                var allFields = $( [] ).add( usuario ).add( horas ),
                tips = $( ".tips_validacion" );//funcion que actualiza los mensajes de error el formulario alta estudiantesﬁ
                horas.val("1");
                calc_campos(horas);
                try{
                }catch(e){}
                var respuesta ={};
                if(edo=='L'){
                    updateTips("Proporciona los datos que se piden.Los campos marcado con * son obligatorios.",tips);
                }else{
                   
                    updateTips(' <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>Esta a punto de asignar un equipo asociado a una reservacion fija.</b><br>Si esta seguro que el equipo esta disponible continue con la acci&oacute;n sino de click en Cancelar.'+
                        '<br>Si la actividad asignada a la sala no se llev&oacute; a cabo selecione <img width="20" height="20" src="./images/borrar_todo.png"/> para liberar la sala.</p> ' ,tips);
                }
                $('.ui-autocomplete-input').val('');
                $( "#dialog:ui-dialog" ).dialog( "destroy" );
                $( "#dialog_asignacion_momentanea").dialog({
                    autoOpen: false,
                    width: 500,
                    modal: true,
                    buttons: {
                        "Aceptar": function() {
                            var bValid = true;
                            if(usuario.val()==0){
                                bValid = bValid && false;
                                nou=true;
                                usuario.addClass( "ui-state-error" );
                                var msg=mensaje_tips("./images/msg/warning.png","Debe seleccionar un usuario.");
                                updateTips(msg,tips );
                            }
                            if(bValid){
                                var datos =$('#form_reservacion').serialize()+'&numserie='+ns+'&id_sala='+sala_select;
                                alert(datos);
                                var urll='index.php/reservaciones_temporales/reservacion_momentanea';
                                var respuesta = ajax_peticion_json(urll,datos);
                                if (respuesta!=false){
                                    notificacion_tip("./images/msg/ok.png","Reservaciones momentaneas","La reservaci&oacute;n se registr&oacute; satisfactoriamente.");
                                    o.attr('src','./images/pc_edos/pc_O.png');
                                    d.attr("idreserv",respuesta.idreser);
                                    d.attr("horai",respuesta.horai);
                                    d.attr("horaf",respuesta.horaf);
                                    d.attr("usuario",respuesta.usuario);
                                    d.attr("edo","O");
                                    d.attr("estado_reserv",respuesta.estado_reserv);
                                    d.attr("imp",respuesta.importe);
                                    d.attr("hrs",respuesta.horas);
                                }else{
                                    mensaje($( "#mensaje" ),'Error al resgistrar reservaci&oacute;n! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.',400,true);
                                } 
                                $( this ).dialog( "close" );
                            }

                        },
                        "Cancelar": function() {
                            $( this ).dialog( "close" );
                        }
                    },
                    close: function() {
                        allFields.val( "" ).removeClass( "ui-state-error" );
                        updateTips("Proporciona los datos que se piden.Los campos marcado con * son obligatorios.",tips);
                        
                            
                    }
                }).dialog("open");

            }else{
                if(edo=='O'){
                    $("#b_numser_rt").html('&nbsp;&nbsp;'+ns+'&nbsp;&nbsp;');
                    $("#drm_sala").text(ns);
                    $("#drm_fila").text(ns);
                    $("#drm_columna").text(ns);
                    $("#drm_horainicio").val(d.attr("horai"));
                    $("#drm_horafin").val(d.attr("horaf"));
                    $("#drm_importe").val(d.attr("imp"));
                    $("#drm_horas").val(d.attr("hrs"));
                    $("#b_usuario_rt").val(d.attr("usuario"));
                    $( "#dialog:ui-dialog" ).dialog( "destroy" );
                    $( "#dialog_termina_actualiza_reserv").dialog({
                        autoOpen: false,
                        width: 550,
                        modal: true,
                        buttons: {
                            "Terminar Reservación": function() {
                                var datos='idreserv='+d.attr('idreserv')+'&equipo='+d.attr('id');
                                var urll="index.php/reservaciones_temporales/termina_actualiza_reservacion";
                                var respuesta = ajax_peticion(urll,datos);
                                if (respuesta=='ok'){
                                    notificacion_tip("./images/msg/ok.png","Reservaciones momentaneas","La reservaci&oacute;n se registr&oacute; satisfactoriamente.");
                                    o.attr('src','./images/pc_edos/pc_L.png');
                                    d.attr("edo","L");
                                    d.attr("estado_reserv",'T');
                                }else{
                                    mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la p&aacute;gina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
                                }
                    
                                $( this ).dialog( "close" );
                            },
                            "Modificar": function() {
                                $( this ).dialog( "close" );
                            },
                            Cancelar: function() {
                                $( this ).dialog( "close" );
                            }
                        }
                    }).dialog("open");
                }
            }
        
        }else{
            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png','No se puede asignar el equipo.','No se puede asignar el equipo ya que se encuentra en mantenimiento o descompuesto.');                              
        }

    }//fin asigna_equipo

    $(function() {
        $("#usuario").combobox();
        window.setTimeout('actualiza_pag()',1000);
        $('#tipo_u').change( function(){ cargausuarios();} );
        $("#b_numser_rt").button().click(function(){});
        $("#b_usuario_rt").button().click(function(){});
        /** al pasar el mouse sobre cada td de la tabla agrega la clase ui-state-active de jqueryui*/
        $('.over tbody td').hover(
        function(){ $(this).addClass('ui-state-active');},
        function(){ $(this).removeClass('ui-state-active');}
    );
        /** al clic en el boton no encuentro al usuario crea un dialogo con ayuda para localizar al 
         *usurio dando la opcion de abrir en una pestaña nueva con la gestion de usuarios de ser
         * necesari agregara un nuevo usuario o actualizara el estausde la cuenta a activoç
         */                
        $( "#no_find_u" )
        .button()
        .click(function() {
            mensaje($( "#mensaje" ),'No encuentro al Usuario','./images/msg/help.png','<br><br><b>Posibles Causas:</b><br>',
            '* La cuenta de usuario no esta <b>actualizado</b> '
                +'<br>* El usuario <b>No se encuentra en la base de datos o el login</b> no corresponde con sus dem&aacute;s datos.'
                +'<br><A href="'+base_url+'index.php/usuarios" target="_blank">Actualizar/Agregar Usuario</A>');
        });
        $("#tabs" ).tabs();
        var horas=$("#horas" ).spinner({min:1,max:12});
        var hoy=new Date();
        
        $("#hora_fin" ).val(fillZeroDateElement(hoy.getHours()+1)+':'+ fillZeroDateElement(hoy.getMinutes())); 
    });
</script>
<style>
    #tipo_u{
        width: 400px !important;
    }
    #usuario{
        width: 400px !important;
    }
    #horas{
        width: 135px;
    }
    .ui-autocomplete-input{
        width: 90%;
    }label{ margin-left: 10px;}
    .esp_text{
        border-width: 2px; 
        border-style:dashed;
    }
    #accordion{
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .label_numser{
        font-size: 10px !important;
    }
    .total-eq{margin-right: 15px; font-weight: bolder; float: right !important;}
</style><br>
