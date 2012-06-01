<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| CONFIGURACIONES DEL SISTEMA
| -------------------------------------------------------------------
| Este archivo contiene las configuraciones básicas del sistema.
|
| .
|
| -------------------------------------------------------------------
| EXPLICACION DE LAS VARIABLES DE CONFIGURACION
| -------------------------------------------------------------------
|
|    $config['fecha_periodo_inicio']	= '2012-01-01';
|    $config['fecha_periodo_fin']	= '2012-06-30';
                                        NOTA: solo se relizarán reservaciones fijas y momentaneas en este rango de tiempo
                                        es decir entre $config['fecha_periodo_inicio'] y $config['fecha_periodo_fin']
                                        esto con excepción de las reservaciones por sala las cuales se puede reservar una sala completa
                                        en un periodo especificado a una hora determinada ejemplo de 07:00:00 a 08:00:00
                                        la limitante es que no se pueden especificar diferentes horas en diferentes dias ya que estan pensadas
                                        solo para reservaciones de un dia y un periodo determinado de lo contrario puede agregar una actividad como curso
|    $config['actualizacion_cache']	= TRUE/FALSE - Desactiva la actualizacion del cahe del sito
            !!! IMPORTANTE: Es necesario estar consiente del cambi de esta variable ya que debe tener congruencia con la configuracion de la base de datos
            en su archivo de configuracion apecc/application/config/database.php en $db['default']['cache_on'] = FALSE; den ser iguales
            para que no haya incongruencia
|    $config['costoxhora']              = Costo por hora de una reservacion momentanea
|    $config['tiempo_recarga_rt']	= Tiempo en milisegundos para recargar la pagina de reservaciones
|    $config['respaldos_db']            = TRUE/FALSE - respaldos activados=true desactivados false respaldos para consultas al eliminar registros
|    $config['formato_respaldo_db']	= "csv"/"xml" Formato en el cual se crearan los respaldos de la base de datos;
                                        NOTA: No confundir estos respaldos con el respaldo de toda la base de datos, ya que este se creara en sentencias
                                              SQL por lo tanto la extension será .sql
|    $config['ver_detalles_actdb']	= TRUE/FALSE - si se activa mostrará mensajes acerca de la accion que se realiza en ese momento
                                            con respecto a la actualizacion de la base de datos ;
|    $config['ver_menu_lt']             = TRUE/FALSE ver u ocultar el menu lateral
|

*/

$config['fecha_periodo_inicio']	= '2012-01-01';
$config['fecha_periodo_fin']	= '2012-08-30';
$config['actualizacion_cache']	= FALSE;
$config['costoxhora']	= 1.5;
$config['respaldos_db']	= TRUE;
$config['formato_respaldo_db']	= "csv";
$config['ver_detalles_actdb']	= TRUE;
$config['ver_menu_lt']	= TRUE;

/*
 * -------------------------------------------------------------------
|   ACERCA DEL SISTEMA
|   -------------------------------------------------------------------
 */
$config['sis_encargados_cc']	=  array("Jefe del Centro de Computo: LI Martha Elizabet Domínguez Bárcenas","MCC Fredy Castañeda Sánchez"); 
$config['sis_desarralladores']	=   array("Desarrollador: José Adrian Ruiz Carmona","Idea original: Issac Salazar Herrera"); 
$config['sis_mantenimiento']	=   array("",""); 
$config['sis_contacto']	=   array("Correo: sakcret_arte8@hotmail.com"); 
$config['sis_version']	=   "1.0"; 
/*
| -------------------------------------------------------------------
| PERMISOS DEL SISTEMA
| -------------------------------------------------------------------
 * Definir permisos
 * $config['prm_permisos']=  array('permiso1','permiso2'... ,'permison');
 * los permisos se representan con un arrego de caracteres opcionalmente se puede cambiar
 * -------Descripción de permisos--------
 *      t= Todos los permisos No se ocultan opciones alasignar t no ocultara nada todas las opciones estaran disponibles
 *      v= solo permisos de lectura !IMPORTANTE si se agrega este permiso se ignoraran todos los demas si es que los existiera
 *      a= Permiso para dar de alta (representado en las vistas(html-css) con la clase prm_a)
 *      b= Permiso para dar de baja (representado en las vistas(html-css) con la clase prm_b)
 *      c= Permiso para dar de baja (representado en las vistas(html-css) con la clase prm_c)
 *      s= Permiso para dar de asignaciones para actividades asignar catedraticos (representado en las vistas(html-css) con la clase prm_s)
 *      w= Permiso para abc de software a los equipos (representado en las vistas(html-css) con la clase prm_w)
 */
$config['prm_permisos']=array('t','v','a','b','c','s','w');
$config['desc_permisos']="A = Agregar registros(altas).<br>
                                         B = Eliminar registros(bajas).<br>
                                         C = Cambiar registros(cambios).<br>
                                         S = Asignación de materias a catedráticos y/o Asociación de software a grupos.<br>
                                         W = abc de software a los equipos";

/* Claves de permiso para cada controlador
//!!! IMPORTANTE: no cambiar estos parametros de configuracion a menos que este seguro de lo que hace ya que esto las primeras 2 letar de la clave
 * no pueden repetirse ya que identifican un conjunto de elementos del sistema pr ejemplo: 'rs' para reservaciones y la tercera letra para
 * representar los subconjuntos por ejemplo 'rsf' reservaciones fijas o 'rst' reservaciones temporaneas
afectará directamente a los usuarios que tengan acceso al controlador que desea modificar un caso viable seria la eliminacion de modulos o al agrearlos
*/
$config['clvp_actividades']= 'act';
$config['clvp_equipos_software']='eqs';
$config['clvp_equipos']	= 'equ';
$config['clvp_ubicacion_equipos']='eqb';
$config['clvp_reportes']= 'rpg';
$config['clvp_reportes_per']= 'rpp';
$config['clvp_reservaciones_fijas']= 'rsf';
$config['clvp_reservaciones_salas']= 'rss';
$config['clvp_reservaciones_temporaneas']='rst';
$config['clvp_software']='swr';
$config['clvp_usuarios']='usu';
$config['clvp_sistema_usuarios']='siu';
$config['clvp_sistema_config']='sic';

/* 
 * Definición de permisos para roles predereminados
 */
$config['roles']=array( 
    'A'=>array('rol'=>'Administador','clave'=>'A','permisos'=>'usu>t|act>t|eqs>t|equ>t|eqb>t|rpg>t|rpp>t|rep>t|rsf>t|rss>t|rst>t|swr>t|uqs>t|siu>t|sic>t'),
    'C'=>array('rol'=>'Encargado del Centro de Computo','clave'=>'C','permisos'=>'usu>t|act>t|eqs>t|equ>t|eqb>t|rpg>t|rpp>t|rep>t|rsf>t|rss>t|rst>t|swr>t|uqs>t'),
    'S'=>array('rol'=>'Servicio Social','clave'=>'S','permisos'=>'usu>ac|act>v|esw>t|equ>t|rep>t|rsf>t|rss>t|rst>t|swr>abc|ueq>t'),
    'M'=>array('rol'=>'Academico','clave'=>'M','permisos'=>'usu>v|act>v|eqs>t|equ>v|eqb>t|rpg>t|rpp>t|rep>t|rsf>t|rss>t|rst>t|swr>t|uqs>t'),
    'I'=>array('rol'=>'Invitado','clave'=>'I','permisos'=>'usu>v|act>v|eqs>v|equ>v|eqb>v|rpg>v|rpp>v|rep>v|rsf>v|rss>v|rsv>v|swr>v|uqs>v'),
    'L'=>array('rol'=>'Solo Lectura','clave'=>'L','permisos'=> 'usu>v|act>v|eqs>v|equ>v|eqb>v|rpg>v|rpp>v|rep>v|rsf>v|rss>v|rsv>v|swr>v|uqs>v')
    );


?>