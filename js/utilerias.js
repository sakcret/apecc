/**
 * @summary     utilerias
 * @description Utilerias para jquery
 * @version     1
 * @file        utilerias.js
 * @author      Jose Adrian Ruiz Carmona
 * @contact     sakcret_arte8@hotmail.com,sakcret@gmail.com
 *
 * @requires jQuery v1.2.3 o superior,jQuery blockUI Version 2.39 o superior
 * @copyright Copyright 2012.
 * 
 *  Este archivo consta de algunas utilerias necesarias para el proyecto apecc, que facilitan algunas funcions de uso comun 
 * 
 */

/** @lends <global> timestamp devuelve la fecha actual */
var timestamp = new Date().getTime();

/**
*  Peticion ajax que recibe una respuesta del servidor en fomato de texto
*  @param {string} purl -url a donde se hará la petición
*  @param {objet} pparameters -conjunto de valores que se envian al servidor y se recuperarán por post
*  @returns {string} valor -representa la respuesta del servidor en formato de texto,
*   si no se realiza la llamada ajax por un error devolvera el error como cadena
*  @example 
*           //optengo el texto del imput que tiene id="uninput"
*           var undato = $('#uninput').val();
*           //hago la peticion ajax al servidor pasandole como parametro undato
*           var respuesta_srv = get_value('pparametersreservaciones_temporales/usuarios/',{undato:undato});
*  @memberof jquery
*/
function get_value(purl, pparameters) {
    var valor = 'N/A_';
    if ($.blockUI) {
        $.blockUI.defaults.baseZ = 200000;
        $.blockUI({ 
            message:'<img src="./images/loading3.gif" width="50" heigth="50"><h1>Cargando...</h1>Espere un momento por favor.',   
            showOverlay: false, 
            centerY: false, 
            css: { 
                width: '350px', 
                border: 'none', 
                margin:'auto',
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity:'0.4',
                filter:'alpha(opacity=40)',
                color: '#fff' 
            } 
        });
    }

    $.ajax({
        url: base_url + 'index.php/' + purl,
        type: 'POST',
        data: pparameters,
        async: false,
        cache: false,
        dataType: 'text',
        timeout: 30000,
        error: function(a, b) {
            valor = b;
        },
        success: function(msg) {
            valor = msg;
        }
    });
    document.body.style.cursor="wait";
    if ($.blockUI) {
        $.unblockUI();
    }
    
    setTimeout(function(){
        document.body.style.cursor="default";
    },400);
    return valor;
}

/**
*  Peticion ajax que recibe una respuesta del servidor en fomato de texto
*  @param {string} urll -url a donde se hará la petición
*  @param {objet} datos -conjunto de valores que se envian al servidor y se recuperaran por post
*  @returns {string} msg -representa la respuesta del servidor en formato de texto,
*   si no se realiza la llamada ajax por un error devolvera el error como cadena
*  @example 
*           //serializar los valores del formulario con id="unformulario" y le agrego un valor extra otrovalor=otro
*           var datos = $('#unformulario').serialize()+'&otrovalor=otro';
*           var urll="index.php/uncontrolador/unmetodo";
*           //hago la llamada a la funcion enviando la url y los datos
*           var respuesta = ajax_peticion(urll,datos);
*           if (respuesta=='ok'){
*               location.reload(true);
*           }else{
*               alert('error');
*           }
*  @memberof jquery
*/
function ajax_peticion(urll,datos){
    if ($.blockUI) {
        $.blockUI.defaults.baseZ = 200000;
        $.blockUI({ 
            message:'<img src="./images/loading3.gif" width="50" heigth="50"><h1>Cargando...</h1>Espere un momento por favor.',   
            showOverlay: false, 
            centerY: false, 
            css: { 
                width: '350px', 
                border: 'none', 
                margin:'auto',
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity:'0.4',
                filter:'alpha(opacity=40)',
                color: '#fff' 
            } 
        });
    }
    var msg = 'N/A_';
    $.ajax({
        url:urll,
        data: datos,
        type:"POST",
        async: false,
        cache: false,
        dataType: 'text',
        timeout: 30000,
        error: function(a, b) {
            msg = b;
        },
        success:
        function(r){                                
            msg=r;                                                              
        }
    });
    document.body.style.cursor="wait";
    if ($.blockUI) {
        $.unblockUI();
    }
    setTimeout(function(){
        document.body.style.cursor="default";
    },400);
    return msg;
}

/**
*  Peticion ajax que recibe una respuesta del servidor en fomato json
*  @param {string} urll -url a donde se hará la petición
*  @param {objet} datos -conjunto de valores que se envian al servidor y se recuperaran por post
*  @returns {json|false} json -representa la respuesta del servidor en formato de json,
*   si no se realiza la llamada ajax por un error devolvera el error como false
*  @example 
*           //serializar los valores del formulario con id="unformulario" y le agrego un valor extra otrovalor=otro
*           var datos = $('#unformulario').serialize()+'&otrovalor=otro';
*           var urll="index.php/uncontrolador/unmetodo";
*           //hago la llamada a la funcion enviando la url y los datos
*           var respuesta = ajax_peticion_json(urll,datos);
*           if (respuesta!=false){
*               alert(respuesta.undatojson);
*           }else{
*               alert('error');
*           }
*  @memberof jquery
*/
function ajax_peticion_json(urll,datos){
    var json;
    if ($.blockUI) {
        $.blockUI.defaults.baseZ = 200000;
        $.blockUI({ 
            message:'<img src="./images/loading3.gif" width="50" heigth="50"><h1>Cargando...</h1>Espere un momento por favor.',   
            showOverlay: false, 
            centerY: false, 
            css: { 
                width: '350px', 
                border: 'none', 
                margin:'auto',
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity:'0.4',
                filter:'alpha(opacity=40)',
                color: '#fff' 
            } 
        });
    }
    $.ajax({
        url:urll,
        data: datos,
        type:"POST",
        async: false,
        cache: false,
        dataType: "json",
        timeout: 30000,
        error: function(a, b) {
            json = false;
        },
        success:
        function(r){                                
            json=r;                                                              
        }
    });
    if ($.blockUI) {
        $.unblockUI();
    }
    document.body.style.cursor="wait";
    setTimeout(function(){
        document.body.style.cursor="default";
    },400);
    return json;
}

/**
*  Muestra una notificación(tip) en la parte superior derecha de la pagina
*  @param {string} url_img -ruta de alguna imagen simbolica al tipo de notificación o tip a mostrar
*  @param {objet} titulo -titulo del tip o notificación
*  @returns   
*  @example 
*           var datos = $( "#form_modifica_usuario" ).serialize();//obtener los datos del formulario y serializarlos
*                        var urll="index.php/usuarios/modificaUsuario";
*                        var respuesta = ajax_peticion(urll,datos);
*                        if (respuesta=='ok'){
*                           //si la peticion ajax responde ok muestro la notificación
*                           notificacion_tip("./images/msg/ok.png","Modificar Usuario","El usuario se modific&oacute; satisfactoriamente.");
*                            dt_usuarios.fnDraw();//recargar los datos del datatable
*                        }else{
*                            notificacion_tip("./images/msg/error.png","Modificar Usuario","Error al modificar.");
*                        }
*  @memberof jquery
*/
function notificacion_tip(url_img,titulo,msg){
    $.blockUI({ 
        message: '<div><img src="'+url_img+'"/><h1>'+titulo+'</h1></div>'+msg, 
        fadeIn: 700, 
        fadeOut: 700, 
        timeout: 3000, 
        showOverlay: false, 
        centerY: false, 
        css: { 
            width: '350px', 
            top: '10px', 
            left: '', 
            right: '10px', 
            border: 'none', 
            padding: '5px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .6, 
            color: '#fff' 
        } 
    }); 
}

function get_object(purl, pparameters) {
    var t = get_value(purl, pparameters);
    var j = eval('(' + t + ')');
    return j;
}

/**
*  abre una url en una nueva ventana o pestaña 
*  @param {string} purl -url ala que se redirecionará
*  @example 
*           redirect_to("http://www.google.com.mx/");
*                                   
*  @memberof jquery
*/
function redirect_to(purl) {
    setTimeout(function() {
        window.location.href = base_url + 'index.php/' + purl;
    },
    0);
}

/**
*  abre una url en una nueva ventana o pestaña 
*  @param {string} purl -url que se abrirá en una nueva ventana del navegador
*  @example 
*           open_in_new("http://www.google.com.mx/");
*                                   
*  @memberof jquery
*/
function open_in_new(purl){
    window.open(base_url + 'index.php/' + purl,"_new");
}

/**
*  Quita espacios al principio y fin de la cadena
*  @param {string} inputString -cadena ala que se le quitarán espacios en blanco
*  @returns {string} inputString -cadena sin espacios al final ni al principio
*  @example 
*           var nombre = '    Adrian    ';
*           var sinespacios=trim(nombre);
*           //resultado sinespacios='Adrian';
*                                   
*  @memberof jquery
*/
function trim(inputString) {
    return $.trim(inputString);
}

var nav4 = window.Event ? true : false;
function IsNumber(evt){
    // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57));
}
function IsNumberFloat(evt){
    // Backspace = 8, Enter = 13, ’0′ = 48, ’9′ = 57, ‘.’ = 46
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57 || key == 46));
}

function fillZeroDateElement(elemento){
    if ((elemento >= 0)&&(elemento <= 9)){ 
        elemento="0"+elemento; 
    }
    return elemento;
}

Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
    return this;
}

function allCheckboxUICheck(id_obj,estado){
    $("#"+id_obj+" input[type=checkbox]").each(function() { 
        $(this).checkbox( "option", "disabled",estado);
    });
    
}


