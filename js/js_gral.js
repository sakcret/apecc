/*
 * File:        js_gral.js
 * Version:     1.0
 * Description: herramientas generales para el proyecto sequelrepo requiere de jquery-ui-1.8.18.js
 * Author:      
 * Language:    Javascript
 * License:	    GPL v2 
 * Project:	    apecc
 */

/*funcion que crea un widget como combobox utilizando JqueryUi*/
(function( $ ) {
    $.widget( "ui.combobox", {
        _create: function() {
            var self = this,
            select = this.element.hide(),
            selected = select.children( ":selected" ),
            value = selected.val() ? selected.text() : "";
            var input = this.input = $( "<input>" )
            .insertAfter( select )
            .val( value )            
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                    response( select.children( "option" ).map(function() {
                        var text = $( this ).text();
                        if ( this.value && ( !request.term || matcher.test(text) ) )
                            return {
                                label: text.replace(
                                    new RegExp(
                                        "(?![^&;]+;)(?!<[^<>]*)(" +
                                        $.ui.autocomplete.escapeRegex(request.term) +
                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                        ), "<strong>$1</strong>" ),
                                value: text,
                                option: this
                            };
                    }) );
                },
                select: function( event, ui ) {
                    ui.item.option.selected = true;
                    self._trigger( "selected", event, {
                        item: ui.item.option
                    });
                },
                change: function( event, ui ) {
                    if ( !ui.item ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
                        valid = false;
                        select.children( "option" ).each(function() {
                            if ( $( this ).text().match( matcher ) ) {
                                this.selected = valid = true;
                                return false;
                            }
                        });
                        if ( !valid ) {
                            $( this ).val( "" );
                            select.val( "" );
                            input.data( "autocomplete" ).term = "";
                            return false;
                        }
                    }
                }
            })
            .addClass( "ui-widget ui-widget-content ui-corner-left" );

            input.data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
            };

            this.button = $( "<button type='button'>&nbsp;</button>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Mostrar todo" )
            .insertAfter( input )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "ui-corner-right ui-button-icon" )
            .click(function() {
                if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                    input.autocomplete( "close" );
                    return;
                }
                $( this ).blur();
                input.autocomplete( "search", "" );
                input.focus();
            });
        },

        destroy: function() {
            this.input.remove();
            this.button.remove();
            this.element.show();
            $.Widget.prototype.destroy.call( this );
        }
    });
})( jQuery );

/*funcion que cambia el idioma del widget datepicker de jquery*/
$(function() {
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
        yearSuffix: ''
    };        
    $.datepicker.setDefaults($.datepicker.regional['es']);        
    $( ".datepicker" ).datepicker({
        changeMonth: true            
    });     
});

/**
 *funcion que actualiza un componente del dom para mostrar mensajes al usuario
 *utilizando clases de estado de JqueryUi para atraer la atencion del usuario
 * @param {String} texto Texto que sera mostrado
 * @param {Object} tips Elemento al cual se le agregara el mensaje
 */
function updateTips( texto,tips ) {
    tips.
    html(texto)
    .addClass( "ui-state-highlight" );
    setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
}

function mensaje_tips(url_img,text){
    var msg='<p><span style="float:left; margin:0 7px 0px 0;"><img src="'
    +url_img+'"/></span>'
    +text+'</p>';
    
    /*var msg='<div style="float: left; width: 5%; height: 70px;">'+
    '<img style=" margin-top: 5px; margin-left: 5px;" src="'+url_img+'"/>'+
    '</div>'+
    '<div style="float: left; width: 95%; height: 60px;">'+
    '<blockquote>'+text+
    '</blockquote>'+
    '</div>'*/
    return msg;
                
}


/**
 *funcion que verifica la longitud de un campo
 * @param {Object} texto Texto que sera mostrado
 * @param {Object} o Es el objeto al cual se le aplicara el test de logitud
 * @param {Object} n nombre del objeto
 * @param {Object} min Longitud minima en caracteres del objeto o
 * @param {Object} max Longitud axima en caracteres del objeto o
 * @param {Object} tips Elemento al cual se le enviaran mensajes
 */        
function verificaLongitud( o, n, min, max,tips) {
    if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "El tamaño del campo '" + n + "' debe estar entre " +
            min + " y " + max + ".",tips );
        return false;
    } else {
        return true;
    }
}
        
/**
 *funcion que valida un campo del formulario basado en expresiones regulares
 * @param {Object} o Texto que sera mostrado
 * @param {Object} regexp Es el objeto al cual se le aplicara el test de logitud
 * @param {Object} n nombre del objeto
 * @param {Object} tips Elemento del dom al cual se le enviaran mensajes para mostrar al usuario
 */
function validaCampoExpReg( o, regexp, n,tips ) {
    if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n,tips);
        return false;
    } else {
        return true;
    }
}
        
function eliminaRegAsync(id,url,dialog_elimina){
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    $("#dialog:ui-dialog").dialog( "destroy" );
    dialog_elimina.dialog({
        autoOpen: false,
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            "Eliminar": function() {
                $.ajax({
                    url:url,
                    data: "id="+id,
                    type:"POST",
                    success:
                    function(r){
                        if(r){                                
                            location.reload(true);                            
                        }else{
                            alert(r);
                        }  
                    }
                });
                $( this ).dialog( "close" );
            },
            Cancelar: function() {
                $( "#mensaje" ).attr('title', '');
                $( this ).dialog( "close" );
            }
        }
    }).dialog("open");    
}
   
   
function mensaje(o,titulo,url_img,text1,text2,ancho,es_modal){
    var stmodal=true;
    var h=400;
    if((es_modal==true)||(es_modal==false)){
        stmodal =es_modal;
    }
    if(!isNaN(ancho)){
        h=ancho; 
    }
    
    $( "#dialog:ui-dialog" ).dialog( "destroy" );
    o.attr('title','');
    o.html('<p><span style="float:left; margin:0 7px 0px 0;"><img src="'
        +url_img+'"/></span>'
        +text1+'</p><p style="font-size: 13px;">'+text2+'</p>');
    o.attr('title',titulo);
    $("#ui-dialog-title-mensaje").html(titulo);
    o.dialog({
        modal: stmodal,
        width:h,
        buttons: {
            Aceptar: function() {
                o.attr('title','');
                o.html('');
                $( this ).dialog( "close" );
                
            }
        },
        close: function() {
            o.attr('title','');
            o.html('');
        }
    }).dialog("open");
}


/*Funcion que toma como parametro un textarea(textarea)
                 * al cual se le calculará el maximo de caracteres permitidos(num_car_max)
                 * ademas de un el nombre del div donde se mostraran los mansajes para saber el resto de chars(div_mostrar)
                 */
function contar_chars_restantes(textarea,num_car_max,div_mostrar){
    if (textarea.value.length >= num_car_max) {
        textarea.value = textarea.value.substring(0,num_car_max);
    }
    var resto = num_car_max - textarea.value.length;
    //imprimimos los caracteres restantes en el span
    var letras=document.getElementById(div_mostrar);
    letras.innerHTML=resto+"/"+num_car_max+" caracteres";
}


//busca caracteres que no sean espacio en blanco en una cadena  
function vacio(q) {  
    for ( var i = 0; i < q.length; i++ ) {  
        if ( q.charAt(i) != " " ) {  
            return true  
        }  
    }  
    return false  
}  
  
//valida que el campo no este vacio y no tenga solo espacios en blanco  
function validaInt(o,n,tips) { 
    if(isNaN(o.val())) {  
        o.addClass( "ui-state-error" );
        updateTips( "El campo '" + n + "' no parece ser un n&uacute;mero.Por favor proporciona un n&uacute;",tips ); 
        return false;  
    } else {  
        return true;  
    }  
          
}  
//valida que el campo no este vacio y no tenga solo espacios en blanco  
function campoVacio(o,n,tips) {  
    var cadena=o.val();  
    if( vacio(cadena) == false ) {  
        o.addClass( "ui-state-error" );
        updateTips( "El campo '" + n + "' es requerido.",tips ); 
        return false;  
    } else {  
        return true;  
    }  
          
}  

function esCampoVacio(o) {  
    var cadena=o.val();  
    if( vacio(cadena) == false ) {  
        return false;  
    } else {  
        return true;  
    }  
          
}  


/*Oculta columnas del datatables*/
function verOcultarColDT( iCol,obtdt ){
    var oTable = obtdt.dataTable();
    var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
    oTable.fnSetColumnVis( iCol, bVis ? false : true );
}
  
/* obtener la fila seleccionada */
function fnGetSelected( oTableLocal ){
    return oTableLocal.$('tr.row_selected');
}

function verificaSelect(o,texto,tips) {
    if (o.val()==0||o.val()==null) {
        o.addClass( "ui-state-error" );
        updateTips( texto,tips );
        return false;
    } else {
        return true;
    }
}
function verificaSelectUI(obj_select,obj_ui,texto,tips) {
    if (obj_select.val()==0||obj_select.val()==null) {
        obj_ui.addClass( "ui-state-error" );
        updateTips( texto,tips );
        return false;
    } else {
        return true;
    }
}

//theming JQUERY_UI general
$(document).ready(function() {
    $( ".tabs" ).tabs(); //aplicar estilo de tab jquery ui a todos lod divs que tengan la clase tabs
    $( "input:submit,input:button,button").button();//agregar estilo button jquery ui a todos los input typo submit y tipo button adema de los elemetos tipo buttop <button>
    $( ".text").addClass("ui-corner-all paddleft5 height_widget ui-widget-content");
    $( "textarea").addClass("ui-corner-all paddleft5 ui-widget-content"); 
    $( ".checkbox-ui" ).checkbox();
    $( ".radio-ui" ).radiobutton();
    $( ".selectmenu-ui" ).selectmenu();
    $(".popup-ui").popup();
    /*$(".tooltip" ).tooltip({
        show: null,
        position: {
            my: "left top",
            at: "left bottom"
        },
        open: function( event, ui ) {
            ui.tooltip.animate({
                top: ui.tooltip.position().top + 10
            }, "fast" );
        }
    });*/
});//findocument ready

function carga_datos_combobox(obj_name,urll,data,first_elem){
    var c = get_value(urll,data);
    $('[name="'+obj_name+'"] option').remove();
    var todos="<option value='0'>"+first_elem+"</option>";
    $('[name="'+obj_name+'"]').append(todos);
    $('[name="'+obj_name+'"]').append(c);
    $('#'+obj_name+'').combobox();
        
}
function carga_datos_select(obj_name,urll,data,first_elem){
    var c = get_value(urll,data);
    $('[name="'+obj_name+'"] option').remove();
    var todos="<option value='0'>"+first_elem+"</option>";
    $('[name="'+obj_name+'"]').append(todos);
    $('[name="'+obj_name+'"]').append(c);
    $('#'+obj_name+'').selectmenu();
        
}