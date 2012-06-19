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
|

*/

$config['fecha_periodo_inicio']	= '2012-01-01';
$config['fecha_periodo_fin']	= '2012-06-30';
$config['actualizacion_cache']	= FALSE;
$config['costoxhora']	= 1.5;
$config['tiempo_recarga_rt']	= 1.5;
$config['respaldos_db']	= TRUE;
$config['formato_respaldo_db']	= "csv";
$config['ver_detalles_actdb']	= TRUE;

?>