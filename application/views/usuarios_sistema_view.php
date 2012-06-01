<?php $roles = $this->config->item('roles'); ?>
<div id="dialog-elimina" title="Eliminar Usuario del Sistema" style="display:none;">
    <p><span  style="float:left; margin:0 7px 20px 0;"><img src="./images/msg/warning.png"/></span>
        &nbsp;&nbsp;El usuario se borrar&aacute; permanentemente.<hr class="boxshadowround">
    <br><b>¿Deseas Continuar?</b></p>
</div>
<div id="f_agregar_user_sis" title="Agregar Usuario del Sistema" cstyle="display:none;">
    <form id="form_agrega_user_sis">
        <div id="tabs">
            <div class="r_usu ui-widget-content ui-corner-all boxshadowround">
                <div class="title ui-widget-header ui-corner-all">Datos Generales</div>
                <p id="form_tips">Los campos marcados con * son obligatorios.</p>
                <fieldset>
                    <label for="nombre" >Nombre del usuario(Recomendado):</label>
                    <input type="text" name="nombre" id="nombre" maxlength="100"  class="text ui-widget-content ui-corner-all" />
                    <label for="login" >Login*:</label>
                    <input type="text" name="login" id="login" maxlength="15"  class="text ui-widget-content ui-corner-all" />
                    <label for="password">Password*:</label>
                    <input type="password" name="password" id="password" maxlength="15" class="text ui-widget-content ui-corner-all" />
                    <label for="conf_password">Confirmaci&oacute;n de Password*:</label>
                    <input type="password" name="conf_password" id="conf_password" maxlength="15" class="text ui-widget-content ui-corner-all" />
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" maxlength="80" title="Fecha inicial" class="text height_widget ui-corner-all"/>
                    <label for="rol">Rol(Recomendado) este determinar&aacute; los permisos:</label><br>
                    <select id="rol" width="90%" name="rol">
                        <option value="0">-- Elegir un rol --</option>
                        <?php
                        foreach ($roles as $rol) {
                            echo '<option value="' . $rol['clave'] . '">' . $rol['rol'] . '</option>';
                        }
                        ?>
                    </select><br>
                    <div id="man_prm" style=" margin-top: 5px; margin-bottom: 5px;">
                        <input type="checkbox" id="prm_manual" name="prm_manual" class="checkbox-ui"/> <label for="prm_manual">Definir manualmente los permisos </label>
                    </div>

                </fieldset>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Warning:</strong> Antes de agregar el usuario del sistema, verifique que se le han asignado permisos correspondientes, 
                            para mayor informaci&oacute;n Consultar Manual en la secci&oacute;n de permisos.</p>
                    </div>
                </div>
            </div>
            <div id="permisos_usu" class="l_usu ui-widget-content ui-corner-all boxshadowround">
                <div class="title ui-widget-header ui-corner-all">Permisos</div>
                <div id="f_permisos" >
                    <div  id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all"  style=" width: 98%">
                        <div class="ui-grid-header ui-widget-header ui-corner-top" >Permisos Generales para APECC</div>
                        <table id="tb_permisos" class="ui-grid-content ui-widget-content" style=" width: 100%" >
                            <tr>
                                <td class="ui-widget-header"><b>Nombre del Recurso</b></td>
                                <td class="ui-widget-header"><b>A</b></td>
                                <td class="ui-widget-header"><b>B</b></td>
                                <td class="ui-widget-header"><b>C</b></td>
                                <td class="ui-widget-header"><b>S</b></td>
                                <td class="ui-widget-header">&nbsp;</td>
                                <td class="ui-widget-header"><b>Solo Lectura</b></td>
                                <td class="ui-widget-header"><b>Todos</b></td>
                            </tr>
                            <tbody>
                                <tr>
                                    <td class="ui-state-focus">Actividades</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_a" class="act checkbox-ui" name="prm[]" id="a_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_b" class="act checkbox-ui" name="prm[]" id="b_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_c" class="act checkbox-ui" name="prm[]" id="c_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_s" class="act checkbox-ui" name="prm[]" id="s_act" disabled="disabled"></td>
                                    <td rowspan="6" class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_v" class="checkbox-ui" name="prm[]" id="v_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_t" class="checkbox-ui" name="prm[]" id="t_act" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Equipos</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_a" class="equ checkbox-ui" name="prm[]" id="a_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_b" class="equ checkbox-ui" name="prm[]" id="b_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_c" class="equ checkbox-ui" name="prm[]" id="c_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_v" class="checkbox-ui" name="prm[]" id="v_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_t" class="checkbox-ui" name="prm[]" id="t_equ" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Software</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_a" class="swr checkbox-ui" name="prm[]" id="a_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_b" class="swr checkbox-ui" name="prm[]" id="b_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_c" class="swr checkbox-ui" name="prm[]" id="c_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_s" class="swr checkbox-ui" name="prm[]" id="s_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_v" class="checkbox-ui" name="prm[]" id="v_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_t" class="checkbox-ui" name="prm[]" id="t_swr" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Apartado de Salas</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_a" class="rss checkbox-ui" name="prm[]" id="a_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_b" class="rss checkbox-ui" name="prm[]" id="b_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_c" class="rss checkbox-ui" name="prm[]" id="c_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_v" class="checkbox-ui" name="prm[]" id="v_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox"  value="rss_t" class="checkbox-ui" name="prm[]" id="t_rss" disabled="disabled"></td>
                                </tr
                                <tr>
                                    <td class="ui-state-focus">Usuarios del CC</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_a" class="usu checkbox-ui" name="prm[]" id="a_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_b" class="usu checkbox-ui" name="prm[]" id="b_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_c" class="usu checkbox-ui" name="prm[]" id="c_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_v" class="checkbox-ui" name="prm[]" id="v_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_t" class="checkbox-ui"name="prm[]" id="t_usu" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Usuarios del Sistema</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_a" class="siu checkbox-ui" name="prm[]" id="a_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_b" class="siu checkbox-ui" name="prm[]" id="b_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_c" class="siu checkbox-ui" name="prm[]" id="c_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_v" class="checkbox-ui" name="prm[]" id="v_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_t" class="checkbox-ui"name="prm[]" id="t_siu" disabled="disabled"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix" style=" font-size: 8px !important;"><?php echo $this->config->item("desc_permisos"); ?>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" style="width: 98%">
                        <div class="ui-grid-header ui-widget-header ui-corner-top">Otros permisos para APECC</div>
                        <table id="tb_datos_asign" class="ui-grid-content ui-widget-content" style=" width: 100%" >
                            <tbody>
                                <tr>
                                    <td class="ui-widget-header"><b>Nombre del Recurso</b></td>
                                    <td class="ui-widget-header"><b>&nbsp;</b></td>
                                    <td class="ui-widget-header"><b>Todos</b></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reservaciones Temporales</td>
                                    <td rowspan="7" class="ui-state-focus">&nbsp;    </td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rst_t" name="prm[]" id="t_rst" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reservaciones Fijas</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rst_f" name="prm[]" id="t_rsf" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Ubicación de Equipos</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="eqb_t" name="prm[]" id="t_eqb" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reportes Personalizados</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rpp_t" name="prm[]" id="t_rpp" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reportes Generales</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rpg_t" name="prm[]" id="t_rpg" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Asignacion de Software</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="eqs_t" name="prm[]" id="t_eqs" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Configuraciones del sistema</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="sic_t" name="prm[]" id="t_sic" disabled="disabled"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="f_modificar_user_sis" title="Agregar Usuario del Sistema" style="display:none;">
    <form id="form_modifica_user_sis">
        <div id="tabsm">
            <div class="r_usu ui-widget-content ui-corner-all boxshadowround">
                <div class="title ui-widget-header ui-corner-all">Datos Generales</div>
                <p id="m_form_tips">Los campos marcados con * son obligatorios.</p>
                <fieldset>
                    <label for="m_nombre" >Nombre del usuario(Recomendado):</label>
                    <input type="text" name="m_nombre" id="m_nombre" maxlength="100"  class="text ui-widget-content ui-corner-all" />
                    <label for="m_login" >Login*:</label>
                    <input type="text" name="m_login" id="m_login" maxlength="15"  class="readonly text ui-widget-content ui-corner-all" readonly="readonly" />
                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>No mostrarse la contraseña por cuestiones de cifrado:</strong> Si desea cambiar contraseña proporcione una nueva si no ,deje el campo en blanco y el cambio no se realizar&aacute; .para mayor informaci&oacute;n Consultar Manual en la secci&oacute;n de permisos y seguridad.</p>
                    </div>
                    <label for="m_password">Password*:</label>
                    <input type="password" name="m_password" id="m_password" maxlength="15" class="text ui-widget-content ui-corner-all" />
                    <label for="m_conf_password">Confirmaci&oacute;n de Password*:</label>
                    <input type="password" name="m_conf_password" id="m_conf_password" maxlength="15" class="text ui-widget-content ui-corner-all" />
                    <label for="m_email">Email:</label>
                    <input type="text" id="m_email" name="m_email" maxlength="80" title="Fecha inicial" class="text height_widget ui-corner-all"/>
                    <label for="m_rol">Rol(Recomendado) este determinar&aacute; los permisos:</label><br>
                    <select id="m_rol" width="90%" name="m_rol">
                        <option value="0">-- Elegir un rol --</option>
                        <?php
                        foreach ($roles as $rol) {
                            echo '<option value="' . $rol['clave'] . '">' . $rol['rol'] . '</option>';
                        }
                        ?>
                    </select><br>
                    <div id="m_man_prm" style=" margin-top: 5px; margin-bottom: 5px;">
                        <input type="checkbox" id="m_prm_manual" name="m_prm_manual" class="checkbox-ui"/> <label for="m_prm_manual">Definir manualmente los permisos </label>
                    </div>
                </fieldset>
                <div class="ui-widget">
                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
                        <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
                            <strong>Warning:</strong> Antes de agregar el usuario del sistema, verifique que se le han asignado permisos correspondientes.</p>
                    </div>
                </div>
            </div>
            <div class="l_usu ui-widget-content ui-corner-all boxshadowround">
                <div class="title ui-widget-header ui-corner-all">Permisos</div>
                <div id="m_f_permisos" >
                    <div  id="m_datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" style=" width: 98%" >
                        <div class="ui-grid-header ui-widget-header ui-corner-top" >Permisos Generales para APECC</div>
                        <table id="m_tb_permisos" class="ui-grid-content ui-widget-content" style=" width: 100%" >
                            <tr>
                                <td class="ui-widget-header"><b>Nombre del Recurso</b></td>
                                <td class="ui-widget-header"><b>A</b></td>
                                <td class="ui-widget-header"><b>B</b></td>
                                <td class="ui-widget-header"><b>C</b></td>
                                <td class="ui-widget-header"><b>S</b></td>
                                <td class="ui-widget-header">&nbsp;</td>
                                <td class="ui-widget-header"><b>Solo Lectura</b></td>
                                <td class="ui-widget-header"><b>Todos</b></td>
                            </tr>
                            <tbody>
                                <tr>
                                    <td class="ui-state-focus">Actividades</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_a" class="act checkbox-ui" name="prm[]" id="m_a_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_b" class="act checkbox-ui" name="prm[]" id="m_b_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_c" class="act checkbox-ui" name="prm[]" id="m_c_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_s" class="act checkbox-ui" name="prm[]" id="m_s_act" disabled="disabled"></td>
                                    <td rowspan="6" class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_v" class="checkbox-ui" name="prm[]" id="m_v_act" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="act_t" class="checkbox-ui" name="prm[]" id="m_t_act" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Equipos</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_a" class="equ checkbox-ui" name="prm[]" id="m_a_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_b" class="equ checkbox-ui" name="prm[]" id="m_b_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_c" class="equ checkbox-ui" name="prm[]" id="m_c_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_v" class="checkbox-ui" name="prm[]" id="m_v_equ" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="equ_t" class="checkbox-ui" name="prm[]" id="m_t_equ" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Software</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_a" class="swr checkbox-ui" name="prm[]" id="m_a_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_b" class="swr checkbox-ui" name="prm[]" id="m_b_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_c" class="swr checkbox-ui" name="prm[]" id="m_c_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_s" class="swr checkbox-ui" name="prm[]" id="m_s_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_v" class="checkbox-ui" name="prm[]" id="m_v_swr" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="swr_t" class="checkbox-ui" name="prm[]" id="m_t_swr" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Apartado de Salas</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_a" class="rss checkbox-ui" name="prm[]" id="m_a_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_b" class="rss checkbox-ui" name="prm[]" id="m_b_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_c" class="rss checkbox-ui" name="prm[]" id="m_c_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="rss_v" class="checkbox-ui" name="prm[]" id="m_v_rss" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox"  value="rss_t" class="checkbox-ui" name="prm[]" id="m_t_rss" disabled="disabled"></td>
                                </tr
                                <tr>
                                    <td class="ui-state-focus">Usuarios del CC</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_a" class="usu checkbox-ui" name="prm[]" id="m_a_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_b" class="usu checkbox-ui" name="prm[]" id="m_b_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_c" class="usu checkbox-ui" name="prm[]" id="m_c_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_v" class="checkbox-ui" name="prm[]" id="m_v_usu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="usu_t" class="checkbox-ui"name="prm[]" id="m_t_usu" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Usuarios del Sistema</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_a" class="siu checkbox-ui" name="prm[]" id="m_a_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_b" class="siu checkbox-ui" name="prm[]" id="m_b_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_c" class="siu checkbox-ui" name="prm[]" id="m_c_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus">&nbsp;</td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_v" class="checkbox-ui" name="prm[]" id="m_v_siu" disabled="disabled"></td>
                                    <td class="ui-state-focus"><input type="checkbox" value="siu_t" class="checkbox-ui"name="prm[]" id="m_t_siu" disabled="disabled"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix" style=" font-size: 8px !important;"><?php echo $this->config->item("desc_permisos"); ?>
                        </div>
                    </div>
                    <p>&nbsp;</p>
                    <div id="m_datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" style="width: 98%">
                        <div class="ui-grid-header ui-widget-header ui-corner-top">Otros permisos para APECC</div>
                        <table id="m_tb_datos_asign" class="ui-grid-content ui-widget-content" style=" width: 100%" >
                            <tbody>
                                <tr>
                                    <td class="ui-widget-header"><b>Nombre del Recurso</b></td>
                                    <td class="ui-widget-header"><b>&nbsp;</b></td>
                                    <td class="ui-widget-header"><b>Todos</b></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reservaciones Temporales</td>
                                    <td rowspan="7" class="ui-state-focus">&nbsp;    </td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rst_t" name="prm[]" id="m_t_rst" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reservaciones Fijas</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rst_f" name="prm[]" id="m_t_rsf" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Ubicación de Equipos</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="eqb_t" name="prm[]" id="m_t_eqb" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reportes Personalizados</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rpp_t" name="prm[]" id="m_t_rpp" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Reportes Generales</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="rpg_t" name="prm[]" id="m_t_rpg" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Asignacion de Software</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="eqs_t" name="prm[]" id="m_t_eqs" disabled="disabled"></td>
                                </tr>
                                <tr>
                                    <td class="ui-state-focus">Configuraciones del sistema</td>
                                    <td class="ui-state-focus"><input type="checkbox" class="checkbox-ui" value="sic_t" name="prm[]" id="m_t_sic" disabled="disabled"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix">&nbsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                <tr id="filter_col1">
                    <td align="left">Login</td>
                    <td align="center"><input type="text"     name="col1_filter" id="col1_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_regex"  id="col1_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col1_smart"  id="col1_smart" checked></td>
                </tr>
                <tr id="filter_col3">
                    <td align="left">Nombre</td>
                    <td align="center"><input type="text"     name="col3_filter" id="col3_filter" class="text ui-widget-content ui-corner-all"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_regex"  id="col3_regex"></td>
                    <td align="center"><input class="checkbox-ui" type="checkbox" name="col3_smart"  id="col3_smart" checked></td>
                </tr>
                <tr id="filter_col4">
                    <td align="left">Nombre</td>
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
                    <button style="height: 30px !important; width: 250px;" id="mas_opc_busq"class="opc ui-icon-search">Ver busqueda avanzada</button>
                </div>
            </div>
        </div><br>
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="dtusuariossistema">
            <thead>
                <tr>
                    <th>Login</th>
                    <th>Password(Cifrado)</th>                
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Correo</th>
                    <th>Permisos</th>
                    <th width="30">Opciones</th>
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
<br/>

<script type="text/javascript" charset="utf-8">
    var dt_usuariossistema,data_row_select;
    var row_select=0,row_select_catedra=0;
    
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
    
    function ver_permisos(id){ 
        $("#f_permisos input[type=checkbox]").each(function() { 
            this.checked = false; 
        });
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        var respuesta = ajax_peticion_json('index.php/usuarios_sistema/getPrmUsuario','id='+id);
        if (respuesta!=false){
            marcaPermisos(respuesta);
        }else{
            mensaje($( "#mensaje" ),'Error ! ','./images/msg/error.png',respuesta,'<span class="ui-icon ui-icon-lightbulb"></span>Actualiza la pagina e intenta de nuevo. Si el <b>Error</b> persiste consulta al administrador.');
        }
        
        $( "#permisos_usu").attr("title","Permisos");
        $( "#permisos_usu").dialog({
            autoOpen: false,
            width: 1000,
            modal: false,
            buttons: {
                Cerrar : function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                $( "#permisos_usu").removeAttr("title");
            }
        }).dialog("open");  
    }
    
    function elimina_usuario_sis(id){
        $("#dialog:ui-dialog").dialog( "destroy" );
        $("#dialog-elimina").dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width:300,
            buttons: {
                "Eliminar": function() {
                    var datos ="id="+id;
                    var urll="index.php/usuarios_sistema/eliminaUsuarioSistema";
                    var respuesta = ajax_peticion(urll,datos);
                    if (respuesta=='ok'){
                        dt_usuariossistema.fnDraw();//recargar los datos del datatable
                        notificacion_tip("./images/msg/ok.png","Eliminar Usuario","El ususario se elimin&oacute; satisfactoriamente.");
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
    
    function modifica_usuario_sis(id){ 
        var nombre= $( "#m_nombre" ),
        login = $( "#m_login" ),
        password = $( "#m_password" ),
        conf_password = $( "#m_conf_password" ),
        rol = $( "#m_rol" ),
        email = $( "#m_email" ),
        allFields = $( [] ).add( nombre).add(login).add(password).add(conf_password).add(rol).add(email),
        tips = $( "#m_form_tips" );
        
        var respuesta = ajax_peticion_json('index.php/usuarios_sistema/getUsuarios_sistema','id='+id);
        if (respuesta!=false){
            login.val(respuesta.lo);
            rol.val(respuesta.rl);
            nombre.val(respuesta.no);
            email.val(respuesta.em);
            var rprm= ajax_peticion_json('index.php/usuarios_sistema/getPrmUsuario','id='+id);
            if (rprm!=false){
                marcaPermisosm(rprm);
            }
        }
        
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_modificar_user_sis" ).dialog({
            autoOpen: false,
            width: 1000,
            modal: true,
            buttons: {
                "Modificar Usuario": function() {     
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(login,'Login',tips);
                    if(esCampoVacio(password)){
                        bValid = bValid && campoVacio(password,'Password',tips);
                        bValid = bValid && campoVacio(conf_password,'Confirmaci&oacute;n de Password',tips);
                        bValid = bValid && confirmacionCampo( password, conf_password, "Los password no coinciden. ",tips ) ;
                        bValid = bValid && passSeguro( password,"El password no es seguro, formato para password seguro: Como m&iacute;nimo una may&uacute;scula, una min&uacute;scula, un n&uacute;mero y un caracter. ",tips ) ;
                    }
                    // bValid = bValid && validaCampoExpReg(email,/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/, "Direcci&oacute;n de correo electr&oacute;nico no v&aacute;lida. ",tips);            
                     
                    if ( bValid ) {
                        var datos = $( "#form_modifica_user_sis" ).serialize()+'&login='+id;
                        var urll="index.php/usuarios_sistema/modificaUsuarioSistema";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuariossistema.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Modificar Usuario del sistema","El usuario se modific&oacute; satisfactoriamente.");
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
                //desmarcar todos los checkboxes de los permisos
                $("#f_permisos input[type=checkbox]").each(function() { 
                    this.checked = false; 
                });
                //bloquear los checkbox de los permisos
                $("#f_permisos input[type=checkbox]").each(function() { 
                    $(this).checkbox( "option", "disabled",true);
                });
                $( "#m_rol" ).val(0);
                $('#m_prm_manual').checkbox( "option", "disabled",false);
                $('#m_prm_manual').get(0).checked=false;
                $("#m_rol").removeAttr("disabled");  
            }
        }).dialog("open"); 
        
    }
    
    function blockPrm(e){
        $("#rol").val(0);
        $("#f_permisos input[type=checkbox]").each(function() { 
            this.checked = false; 
        });
        $("#f_permisos input[type=checkbox]").each(function() { 
            $(this).checkbox( "option", "disabled",!e);
        });
        if(e){
            $("#rol").attr("disabled", "disabled");     
        }else{
            $("#rol").removeAttr("disabled");     
            
        }
    }
    
    function blockPrmm(e){
        $("#m_rol").val(0);
        $("#m_f_permisos input[type=checkbox]").each(function() { 
            $(this).checkbox( "option", "disabled",!e);
        });
        if(e){
            $("#m_rol").attr("disabled", "disabled");     
        }else{
            $("#m_rol").removeAttr("disabled");     
            
        }
    }
    
    function marcaPermisos(permisos){
        //marco todos los permisos
        $("#f_permisos input[type=checkbox]").each(function() { 
            this.checked = false; 
        });
        if(permisos!=false){
            $.each(permisos, function(k,v){
                try{
                    $("#"+v).get(0).checked=true;  
                }catch(e){}
            });
        }
    }
    function marcaPermisosm(permisos){
        //marco todos los permisos
        $("#m_f_permisos input[type=checkbox]").each(function() { 
            this.checked = false; 
        });
        if(permisos!=false){
            $.each(permisos, function(k,v){
                try{
                    $("#m_"+v).get(0).checked=true;  
                }catch(e){}
            });
        }
    }   
    
    $(document).ready(function() {
        //determinar permisos manulmente o po rol
        $( "#prm_manual" ).live("change", function(){
            if($(this).get(0).checked){
                blockPrm(true);
            }else{
                blockPrm(false);
            }
        });
        
        //determinar permisos manulmente o po rol
        $( "#m_prm_manual" ).live("change", function(){
            if($(this).get(0).checked){
                blockPrmm(true);
            }else{
                blockPrmm(false);
            }
            
        });
        
        
        //marcar permisos de acuerdo al rol
        $("#rol").live("change", function(){
            var respuesta= ajax_peticion_json('index.php/usuarios_sistema/getPermisosRol/'+$(this).val());
            marcaPermisos(respuesta);
        });  
        $("#m_rol").live("change", function(){
            var respuesta= ajax_peticion_json('index.php/usuarios_sistema/getPermisosRol/'+$(this).val());
            marcaPermisosm(respuesta);
        });  
      
        /* selecciona una fila del datatable no aplica para server_aside proccessing*/
        $('#dtusuariossistema tbody tr').live('click', function (e) {
            if ( $(this).hasClass('row_selected') ) {
                $(this).removeClass('row_selected');
                row_select=0; 
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

        var nombre= $( "#nombre" ),
        login = $( "#login" ),
        password = $( "#password" ),
        conf_password = $( "#conf_password" ),
        rol = $( "#rol" ),
        email = $( "#email" ),
        allFields = $( [] ).add( nombre).add(login).add(password).add(conf_password).add(rol).add(email),
        tips = $( "#form_tips" );
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#f_agregar_user_sis" ).dialog({
            autoOpen: false,
            width: 1000,
            modal: true,
            buttons: {
                "Agregar Usuario": function() {     
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
                    bValid = bValid && campoVacio(login,'Login',tips);
                    bValid = bValid && campoVacio(password,'Password',tips);
                    bValid = bValid && campoVacio(conf_password,'Confirmaci&oacute;n de Password',tips);
                    bValid = bValid && confirmacionCampo( password, conf_password, "Los password no coinciden. ",tips ) ;
                    bValid = bValid && passSeguro( password,"El password no es seguro, formato para password seguro: Como m&iacute;nimo una may&uacute;scula, una min&uacute;scula, un n&uacute;mero y un caracter. ",tips ) ;
                    // bValid = bValid && validaCampoExpReg(email,/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/, "Direcci&oacute;n de correo electr&oacute;nico no v&aacute;lida. ",tips);            
                     
                    if ( bValid ) {
                        var datos = $( "#form_agrega_user_sis" ).serialize();
                        var urll="index.php/usuarios_sistema/agregaUsuarioSistema";
                        var respuesta = ajax_peticion(urll,datos);
                        if (respuesta=='ok'){
                            dt_usuariossistema.fnDraw();//recargar los datos del datatable
                            notificacion_tip("./images/msg/ok.png","Agregar Usuario del sistema","El usuario se agreg&oacute; satisfactoriamente.");
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
                //desmarcar todos los checkboxes de los permisos
                $("#f_permisos input[type=checkbox]").each(function() { 
                    this.checked = false; 
                });
                //bloquear los checkbox de los permisos
                $("#f_permisos input[type=checkbox]").each(function() { 
                    $(this).checkbox( "option", "disabled",true);
                });
                $( "#rol" ).val(0);
                $('#prm_manual').checkbox( "option", "disabled",false);
                $('#prm_manual').get(0).checked=false;
                $("#rol").removeAttr("disabled");  
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
        
        //Asigna accion al boton para actualizar datatables
        $("#btn_actualiza").button().click(function(){ 
            dt_usuariossistema.fnDraw();              
        });
        
        $('#btn_modificar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if(row_select!=0){
                modifica_usuario_sis(row_select);
            }else{
                mensaje($( "#mensaje" ),'Warning','./images/msg/warning.png'
                ,'<b>No se ha seleccionado ning&uacute;n usuario.</b><hr class="boxshadowround"/>'
                ,'Por favor seleccione un usuario.',400,false);
            }
        } );

        $('#btn_eliminar').button().click(function() {
            //se intenta obtener valores de la fila seleccionada en el datatables almacenados en la variable global row_select
            if(row_select!=0){
                elimina_usuario_sis(row_select);
            }else{
                mensaje($( "#mensaje" ),'Warning','./images/msg/warning.png'
                ,'<b>No se ha seleccionado ning&uacute;n usuario.</b><hr class="boxshadowround"/>'
                ,'Por favor seleccione un usuario.',400,false);
            }
        } );
        
    } );
</script>


<script type="text/javascript" charset="utf-8">
    /*
        -------------------------------------------------------------------------------------------
                JS PARA LA TABLA DEL ACL (PERMISOS DEL SISTEMA)
         -------------------------------------------------------------------------------------------*/
    $(document).ready(function(){
        /*
         *funcion que toma como parametro un objeto jquery que es un checkbox que invoca este metodo para marcar/bloquea los checkboxes
         *que tengan la clase class_s del formulario con el id idform
         **/
        function marca_prm(obj_jq,idform,class_s){
            var e=false;
            try{
                if(obj_jq.get(0).checked){
                    e=true;
                }else{
                    e=false;
                }
                $("#"+idform+" ."+class_s).each(function() { 
                    this.checked = e; 
                });
                $("#"+idform+" ."+class_s).each(function() { 
                    $(this).checkbox( "option", "disabled",e);
                });
                $("#v_"+class_s).checkbox( "option", "disabled",e);
                $("#m_v_"+class_s).checkbox( "option", "disabled",e);
                
            }catch(e1){}
        }
        /*
         *funcion que toma como parametro un objeto jquery que es un checkbox que invoca este metodo para desmarcar/bloquear los checkboxes
         *que tengan la clase class_s del formulario con el id idform
         **/
        function desmarca_prm(obj_jq,idform,class_s){
            var e=false;
            try{
                if(obj_jq.get(0).checked){
                    e=true;
                }else{
                    e=false;
                }
                $("#"+idform+" ."+class_s).each(function() { 
                    this.checked = false; 
                });
                $("#"+idform+" ."+class_s).each(function() { 
                    $(this).checkbox( "option", "disabled",e);
                });
                $("#t_"+class_s).checkbox( "option", "disabled",e);
                $("#m_t_"+class_s).checkbox( "option", "disabled",e);
                $("#m_t_"+class_s).checkbox( "option", "disabled",e);
            }catch(e1){}
        }
        $("select").addClass('selectmenu-ui');
        
        $("#t_act").live('change',function(){marca_prm($(this),'f_permisos','act'); });
        $("#t_equ").live('change',function(){marca_prm($(this),'f_permisos','equ'); });
        $("#t_swr").live('change',function(){marca_prm($(this),'f_permisos','swr');});
        $("#t_rss").live('change',function(){marca_prm($(this),'f_permisos','rss'); });
        $("#t_usu").live('change',function(){marca_prm($(this),'f_permisos','usu');});
        $("#t_siu").live('change',function(){marca_prm($(this),'f_permisos','siu');});
         
        $("#v_act").live('change',function(){desmarca_prm($(this),'f_permisos','act'); });
        $("#v_equ").live('change',function(){desmarca_prm($(this),'f_permisos','equ'); });
        $("#v_swr").live('change',function(){desmarca_prm($(this),'f_permisos','swr'); });
        $("#v_rss").live('change',function(){desmarca_prm($(this),'f_permisos','rss'); });
        $("#v_usu").live('change',function(){desmarca_prm($(this),'f_permisos','usu'); });
        $("#v_siu").live('change',function(){desmarca_prm($(this),'f_permisos','siu'); });
        
        $("#m_t_act").live('change',function(){marca_prm($(this),'m_f_permisos','act'); });
        $("#m_t_equ").live('change',function(){marca_prm($(this),'m_f_permisos','equ'); });
        $("#m_t_swr").live('change',function(){marca_prm($(this),'m_f_permisos','swr');});
        $("#m_t_rss").live('change',function(){marca_prm($(this),'m_f_permisos','rss'); });
        $("#m_t_usu").live('change',function(){marca_prm($(this),'m_f_permisos','usu');});
        $("#m_t_siu").live('change',function(){marca_prm($(this),'m_f_permisos','siu');});
         
        $("#m_v_act").live('change',function(){desmarca_prm($(this),'m_f_permisos','act'); });
        $("#m_v_equ").live('change',function(){desmarca_prm($(this),'m_f_permisos','equ'); });
        $("#m_v_swr").live('change',function(){desmarca_prm($(this),'m_f_permisos','swr'); });
        $("#m_v_rss").live('change',function(){desmarca_prm($(this),'m_f_permisos','rss'); });
        $("#m_v_usu").live('change',function(){desmarca_prm($(this),'m_f_permisos','usu'); });
        $("#m_v_siu").live('change',function(){desmarca_prm($(this),'m_f_permisos','siu'); });
        
    });
</script>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>
<style>#rol{ width: 96%;}
    .r_usu{
        width: 36% !important;
        float: left !important;
        padding: 15px;
        padding-right: 10px;
    }
    .l_usu{
        margin-left: 10px;
        width: 56% !important;
        float: left !important;
        padding: 15px;

    }
    .title{
        paddin:15px !important;
        margin-bottom: 10px;
        text-align: center;
        font-size: 12px;
    }
</style>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>

