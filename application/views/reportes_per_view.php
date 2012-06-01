<br>
<div class="row">
    <div class="twelvecol last">
        <div id="accordion_tiporep">
            <h3><a href="#">Reporte de uso en un periodo determinado</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_uso" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>Ejemplo: Si se elige filtro por sala='CC3' colocar un nombre como 'Reservaciones en la sala CC3'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_uso_per" target="_blank" id="form_reporte_uso">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_res">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_res"  value="Reporte de uso en el Centro de Computo" class="text" id="nom_rep_res">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        <label for="fecha_inicio_r1">Fecha Inicio:</label><br>
                                        <input type="text" id="fecha_inicio_r1" name="fecha_inicio_r1" class="datepicker-ui ui-corner-all height_widget ui-widget-content"/>
                                    </td>
                                    <td width="35%">
                                        <label for="fecha_fin_r1">Fecha Fin:</label><br>
                                        <input type="text" id="fecha_fin_r1" name="fecha_fin_r1" class="datepicker-ui ui-corner-all height_widget ui-widget-content"/>
                                    </td>
                                    <td width="29%" rowspan="2">
                                        <label for="sala">Sala:</label><br>
                                        <select class="selectmenu-ui" id="sala" name="sala">
                                            <option selected value="t">Todas</option>
                                            <?php
                                            foreach ($datos_salas->result() as $sala) {
                                                echo '<option value="' . $sala->idSala . '">Sala ' . $sala->Sala . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="tipo_act">Tipo de Actividad:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="tipo_act" id="tipo_act">
                                            <option selected value="t">Todas</option>
                                            <option value="1">Reservaci&oacute;n por clase</option>
                                            <option value="-1">Reservaci&oacute;n Momentanea</option>
                                            <option value="2">Apartado de Sala</option>
                                            <option value="0">Curso</option>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="detalle_act">Detalle de la Actividad:</label><br>
                                        <input type="text" name="detalle_act" id="detalle_act" class="text">
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Atenci&oacute;n !</strong> Si no se proporcionan datos el reporte generado ser&aacute; de todos los registros.</p>
                    </div>
                </div>
            </div>
            <h3><a href="#">Reporte de Actividades en el Centro de Computo</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_act" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>Ejemplo: Si se elige filtro por curso colocar un nombre como 'Actividades tipo Curso en el Centro de Computo'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_actividades" target="_blank" id="form_reporte_act">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_act">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_act"  value="Actividades en el Centro de Computo" class="text" id="nom_rep_act">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        <label for="tipo_act_act">Tipo de Actividad:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="tipo_act_act" id="tipo_act_act">
                                            <option selected value="t">Todas</option>
                                            <option value="0">Reservaci&oacute;n por clase</option>
                                            <option value="1">Curso</option>
                                        </select>
                                    </td>
                                    <td width="35%">&nbsp;</td>
                                    <td width="29%" rowspan="2">&nbsp;</td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf_act" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls_act" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div>    
            </div>
            <h3><a href="#">Reporte de Equipos</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_equ" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>Ejemplo: Si se elige filtro por marca='hp' colocar un nombre como 'Equipos de la marca HP en el Centro de computo'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_equipos" target="_blank" id="form_reporte_equ">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_equ">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_equ"  value="Equipos en el Centro de Computo" class="text" id="nom_rep_equ">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="33%">
                                        <label for="mark">Marca:</label><br>
                                        <input type="text" name="mark" class="text" id="mark">
                                    </td>
                                    <td width="33%"><label for="mod">Modelo:</label><br>
                                        <input type="text" name="mod" id="mod" class="text"></td>
                                    <td width="33%">
                                        <label for="proc">Procesador:</label><br>
                                        <input type="text" name="proc" id="proc" class="text">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="width:100% !important;" for="ram">Memoria RAM:</label><br>
                                        <select id="ram_op"  name="ram_op" >
                                            <option value="=" selected>=</option>
                                            <option value=">">></option>
                                            <option value=">=">>=</option>
                                            <option value="<"><</option>
                                            <option value="<="><=</option>
                                            <option value="<>"><></option>
                                        </select>
                                        <input type="text" name="ram" id="ram" class="text" style="width:40% !important;">
                                        <b style="width:10% !important;">GB</b></td>
                                    <td>
                                        <label style="width:100% !important;" for="dd">Disco Duro:</label><br>
                                        <select  id="dd_op"  name="dd_op" >
                                            <option value="=" selected>=</option>
                                            <option value=">">></option>
                                            <option value=">=">>=</option>
                                            <option value="<"><</option>
                                            <option value="<="><=</option>
                                            <option value="<>"><></option>
                                        </select>
                                        <input type="text" name="dd" id="dd" class="text" style="width:40% !important;">
                                        <b style="width:10% !important;">GB</b></td>

                                    <td><label style="width:100% !important;" for="sala_eq">Sala:</label>
                                        <select class="selectmenu-ui" id="sala_eq" name="sala_eq">
                                            <option selected value="t">Todas</option>
                                            <?php
                                            foreach ($datos_salas->result() as $sala) {
                                                echo '<option value="' . $sala->idSala . '">Sala ' . $sala->Sala . '</option>';
                                            }
                                            ?>
                                        </select>
                                        </select></td>
                                </tr>
                                <tr><td><label for="edo_eq">Estado:</label><br>
                                        <select id="edo_eq" name="edo_eq" class="width98 selectmenu-ui">
                                            <option value="t" selected>Cualquier Estado</option>
                                            <option value="L" selected>Libre</option>
                                            <option value="O">Ocupado</option>
                                            <option value="R">En Reparaci&oacute;n</option>
                                            <option value="D">Descompuesto</option>
                                            <option value="C">En Clase o Curso</option>
                                        </select></td>
                                    <td>
                                        <input type="checkbox" value="almacen" name="almacen" id="almacen" class="checkbox-ui" checked>
                                        <label for="almacen">Incluir equipos en almac&eacute;n.</label></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf_equ" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls_equ" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Atenci&oacute;n !</strong> Si no se proporcionan datos el reporte generado ser&aacute; de todos los equipos.</p>
                    </div>
                </div>
            </div>
            <h3><a href="#">Reporte de Usuarios del Centro de Computo</a></h3>
            <div class="ui-state-focus">
                <div class="ui-state-focus">
                    <div class=" ui-widget-content" id="f_reporte_usucc" style=" padding: 20px !important;">
                        <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                            <br>Ejemplo: Si se elige filtro por tipo de usuario='Alumno de Licenciatura de Inform&aacute;tica' colocar un nombre como 'Reporte de usuarios Alumnos de Licenciatura de Inform&aacute;tica'.</p>
                        <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_usuariosCC" target="_blank" id="form_reporte_usucc">
                            <fieldset>
                                <table width="100%" border="0">
                                    <tr>
                                        <td colspan="3">
                                            <label for="nom_rep_usucc">Titulo del reporte:</label><br>
                                            <input type="text" name="nom_rep_usucc"  value="Reporte de Usuarios del Centro de Computo" class="text" id="nom_rep_usucc">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">

                                            <label for="estatus">Estatus:</label><br>
                                            <select class="selectmenu-ui" width="90%" name="estatus" id="estatus">
                                                <option selected value="t">Cualquier estatus</option>
                                                <option value="1">Actualizado</option>
                                                <option value="0">No Actualizado</option>
                                            </select>
                                        </td>
                                        <td width="35%">
                                            <label for="sala">Sala:</label><br>
                                            <select class="selectmenu-ui" id="tipoucc" name="tipoucc">
                                                <option selected value="t">Cualquier tipo de usuario</option>
                                                <?php
                                                if (isset($tipos_u_rows) && ($tipos_u_rows != false)) {
                                                    foreach ($tipos_u_rows->result() as $row) {
                                                        echo '<option value="' . $row->idtipo . '">' . $row->descripcion . "</option>" . PHP_EOL;
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td width="29%" rowspan="2">
                                            &nbsp;
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </form>
                        <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                            <div align="center" style="margin-top: 3px; margin-left: 6px;">
                                <button style="" id="btn_savepdf_usucc" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                                <button style="" id="btn_savexls_usucc" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                            </div>
                        </div>
                    </div>
                    <div class="ui-widget">
                        <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;"> 
                            <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                                <strong>Atenci&oacute;n !</strong> Si no se proporcionan datos el reporte generado ser&aacute; de todos los registros.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3><a href="#">Reporte de Software</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_sw" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>Ejemplo: Si se elige filtro por Sistema operativo 'Windows 7' colocar un nombre como 'Reporte de Software para Windows 7'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_software" target="_blank" id="form_reporte_sw">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_sw">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_sw"  value="Software en el Centro de Computo" class="text" id="nom_rep_sw">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%">
                                        <label for="so">Sisitema Operativo:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="so" id="so">
                                            <option selected value="t">Todas</option>
                                            <?php
                                            if (isset($datos_sistemasop) && ($datos_sistemasop != false)) {
                                                foreach ($datos_sistemasop->result() as $row) {
                                                    echo '<option value="' . $row->idSistemaOperativo . '">' . $row->sistemaOperativo . "</option>" . PHP_EOL;
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td width="35%">
                                        <label for="grupo">Grupo de Software:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="grupo" id="grupo"></select></td>
                                    <td width="29%" rowspan="2">
                                        <input type="checkbox" value="siso" name="siso" id="siso" class="checkbox-ui" checked>
                                        <label for="siso">Incluir Sistemas Operativos.</label><br>
                                        <input type="checkbox" value="sigrupos" name="sigrupos" id="sigrupos" class="checkbox-ui" checked>
                                        <label for="sigrupos">Incluir Grupos de software.</label>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf_sw" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls_sw" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div> 
            </div>
            <h3><a href="#">Reporte de Reservaciones Fijas</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_rsf" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>
                        Ejemplo: Si se elige filtro por nombre Actividad='Algoritmos' colocar un nombre como 'Reservaciones para la clase de Algoritmos'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_reservacionesfijas" target="_blank" id="form_reporte_rsf">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_rsf">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_rsf"  value="Reservaciones Fijas en el Centro de Computo" class="text" id="nom_rep_rsf">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="33%">
                                        <label for="act_rsf">Nombre de la Actividad:</label>
                                        <br>
                                        <input type="text" name="act_rsf" class="text" id="act_rsf">
                                    </td>
                                    <td width="33%"><label for="encargado_rsf">Encargado:</label>
                                        <br>
                                        <input type="text" name="encargado_rsf" id="encargado_rsf" class="text"></td>
                                    <td width="33%">
                                        <label for="tipoact_rsf">Tipo de actividad:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="tipoact_rsf" id="tipoact_rsf">
                                            <option selected value="t">Todas</option>
                                            <option value="0">Reservaci&oacute;n por clase</option>
                                            <option value="1">Curso</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="width:100% !important;" for="hora_rsf">Hora de inicio:</label>
                                        <br>
                                        <select class="selectmenu-ui" id="hora_rsf"  name="hora_rsf" >
                                            <option value="t" selected>Cualquier hora</option>
                                            <option value= '1'>07:00</option>
                                            <option value= '2' >08:00</option>
                                            <option value= '3' >09:00</option>
                                            <option value= '4' >10:00</option>
                                            <option value= '5' >11:00</option>
                                            <option value= '6' >12:00</option>
                                            <option value= '7' >13:00</option>
                                            <option value= '8' >14:00</option>
                                            <option value= '9' >15:00</option>
                                            <option value= '10' >16:00</option>
                                            <option value= '11' >17:00</option>
                                            <option value= '12' >18:00</option>
                                            <option value= '13' >19:00</option>
                                            <option value= '14' >20:00</option>
                                            <option value= '15' >21:00</option>
                                            <option value= '16' >22:00</option> 
                                        </select>
                                    </td>
                                    <td>&nbsp;</td>

                                    <td><label style="width:100% !important;" for="sala_rsf">Sala:</label>
                                        <select class="selectmenu-ui" id="sala_rsf" name="sala_rsf">
                                            <option selected value="t">Todas</option>
                                            <?php
                                            foreach ($datos_salas->result() as $sala) {
                                                echo '<option value="' . $sala->idSala . '">Sala ' . $sala->Sala . '</option>';
                                            }
                                            ?>
                                        </select>
                                        </select></td>
                                </tr>
                                <tr><td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf_rsf" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls_rsf" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Atenci&oacute;n !</strong> Si no se proporcionan datos el reporte generado ser&aacute; de todos los equipos.</p>
                    </div>
                </div>
            </div>
            <h3><a href="#">Reporte de Apartado de Salas</a></h3>
            <div class="ui-state-focus">
                <div class=" ui-widget-content" id="f_reporte_rss" style=" padding: 20px !important;">
                    <p class="tips_reporte_uso ui-corner-all">El nombre del reporte aparecer&aacute; en el reporte, por lo tanto se sugiere elegir un nombre de acuerdo a los parametros elegidos.
                        <br>
                        Ejemplo: Si se elige filtro por nombre Actividad='Algoritmos' colocar un nombre como 'Reservaciones para la clase de Algoritmos'.</p>
                    <form method="POST" action="<?php echo base_url(); ?>index.php/reportes_per/reporte_reservacionessalas" target="_blank" id="form_reporte_rss">
                        <fieldset>
                            <table width="100%" border="0">
                                <tr>
                                    <td colspan="3">
                                        <label for="nom_rep_rss">Titulo del reporte:</label><br>
                                        <input type="text" name="nom_rep_rss"  value="Reporte de Apartado de Salas" class="text" id="nom_rep_rss">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="33%">
                                        <label for="act_rss">Nombre de la Actividad:</label>
                                        <br>
                                        <input type="text" name="act_rss" class="text" id="act_rss">
                                    </td>
                                    <td width="33%"><label for="encargado_rss">Encargado:</label>
                                        <br>
                                        <input type="text" name="encargado_rss" id="encargado_rss" class="text"></td>
                                    <td width="33%">
                                        <label for="edo_rss">Estado:</label><br>
                                        <select class="selectmenu-ui" width="90%" name="edo_rss" id="edo_rss">
                                            <option selected value="t">Todos</option>
                                            <option value="A">Activo</option>
                                            <option value="I">Inactivo</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label style="width:100% !important;" for="horai_rss">Hora de inicio:</label>
                                        <br>
                                        <select id="horai_rss"  class="selectmenu-ui" name="horai_rss" >
                                            <option value="t" selected>Cualquier hora</option>
                                            <option value='07:00'>07:00</option>
                                            <option value='08:00' >08:00</option>
                                            <option value='09:00' >09:00</option>
                                            <option value='10:00' >10:00</option>
                                            <option value='11:00' >11:00</option>
                                            <option value='12:00' >12:00</option>
                                            <option value='13:00' >13:00</option>
                                            <option value='14:00' >14:00</option>
                                            <option value='15:00' >15:00</option>
                                            <option value='16:00' >16:00</option>
                                            <option value='17:00' >17:00</option>
                                            <option value='18:00' >18:00</option>
                                            <option value='19:00' >19:00</option>
                                            <option value='20:00' >20:00</option>
                                            <option value='21:00' >21:00</option>
                                            <option value='22:00' >22:00</option> 
                                        </select>
                                    </td>
                                    <td><label for="fechai_rss">Fecha Inicio:</label>
                                        <br>
                                        <input type="text" name="fechai_rss" class="text" id="fechai_rss">
                                    </td>
                                    <td><label style="width:100% !important;" for="sala_rss">Sala:</label>
                                        <select id="sala_rss" class="selectmenu-ui" name="sala_rss">
                                            <option selected value="t">Todas</option>
                                            <?php
                                            foreach ($datos_salas->result() as $sala) {
                                                echo '<option value="' . $sala->idSala . '">Sala ' . $sala->Sala . '</option>';
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr><td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                    <div style=" margin-top: 10px;" class="ui-widget-header ui-corner-all but_bar_content bar">
                        <div align="center" style="margin-top: 3px; margin-left: 6px;">
                            <button style="" id="btn_savepdf_rss" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Generar Reporte PDF</button>
                            <button style="" id="btn_savexls_rss" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Generar Reporte XLS</button>
                        </div>
                    </div>
                </div>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="margin-top: 5px; padding: 0 .7em;"> 
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Atenci&oacute;n !</strong> Si no se proporcionan datos el reporte generado ser&aacute; de todos los equipos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
<script>
    function carga_grupos(){   
        var so = $('#so').val();
        var c = get_value('equipo_software/grupos_so/',{ so: so});
        $('[name="grupo"] option').remove();
        var todos="<option value='t'>Todos</option>";
        $('[name="grupo"]').append(todos);
        $('[name="grupo"]').append(c);
        $('#grupo').selectmenu({style:'popup'});
    }

    $(function() {
        $('#so').change( function(){ carga_grupos();} );
        carga_grupos();
        var icons = {
            header: "ui-icon-circle-arrow-e",
            headerSelected: "ui-icon-circle-arrow-s"
        };
        $( "#accordion_tiporep" ).accordion({
            icons: icons,
            autoHeight: false,
            navigation: true
        });
        $( "#ram_op,#dd_op" ).selectmenu({style:'popup'});
        $('#fechai_rss').datepicker();
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
        
        /******************************** generar pdf s *********************************************/
        $('#btn_savepdf').click(function(){ $('#form_reporte_uso').submit();});
        $('#btn_savepdf_act').click(function(){ $('#form_reporte_act').submit(); });
        $('#btn_savepdf_equ').click(function(){ $('#form_reporte_equ').submit();  });
        $('#btn_savepdf_usucc').click(function(){$('#form_reporte_usucc').submit();});
        $('#btn_savepdf_sw').click(function(){ $('#form_reporte_sw').submit(); });
        $('#btn_savepdf_rsf').click(function(){ $('#form_reporte_rsf').submit(); });
        $('#btn_savepdf_rss').click(function(){ $('#form_reporte_rss').submit(); });
        /******************************** generar xsl s *********************************************/
        $('#btn_savexls').click(function(){var datos=$('#form_reporte_uso').serialize();open_in_new('reportes_per/reporte_usoxls?'+datos); });
        $('#btn_savexls_act').click(function(){var datos=$('#form_reporte_act').serialize(); open_in_new('reportes_per/reporte_actividadesxls?'+datos); });
        $('#btn_savexls_equ').click(function(){var datos=$('#form_reporte_equ').serialize(); open_in_new('reportes_per/reporte_equiposxls?'+datos);});
        $('#btn_savexls_usucc').click(function(){var datos=$('#form_reporte_usucc').serialize(); open_in_new('reportes_per/reporte_usuariosCCxls?'+datos); });
        $('#btn_savexls_sw').click(function(){var datos=$('#form_reporte_sw').serialize(); open_in_new('reportes_per/reporte_softwarexls?'+datos); });
        $('#btn_savexls_rsf').click(function(){var datos=$('#form_reporte_rsf').serialize(); open_in_new('reportes_per/reporte_reservacionesfijasxls?'+datos); });
        $('#btn_savexls_rss').click(function(){var datos=$('#form_reporte_rss').serialize(); open_in_new('reportes_per/reporte_reservacionessalasxsl?'+datos); });
         

       
        
    });
</script>
<script>
    $(function() {
        var actividadesTags = [
<?php
$num_reg = $datos_actividades->num_rows();
$c = 1;
foreach ($datos_actividades->result() as $value) {
    if ($num_reg == $c) {
        echo '"' . $value->actividad . '"';
    } else {
        echo '"' . $value->actividad . '",';
    }$c++;
}
?> ];
            $( "#detalle_act" ).autocomplete({
                source: actividadesTags
            });
            $( "#detalle_act" ).removeClass('ui-autocomplete-input');
            $( "#ram_op,#dd_op" ).css('width','20%');
            
        });
</script>
<style>
    #accordion_tiporep .ui-state-focus{
        background-image: none !important;
    }
    .datepicker-ui{
        width: 96%  !important;
        padding-left: 8px;
    }
    td{padding-left: 30px;}
    select { width: 98%; }
    .width98 { width: 98% !important; }
    .width98 ul { width: 96% !important; }
</style>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>