function sistemas_operativos(ns){
    var urll='index.php/equipo_software/getSos';
    var html='';
    var sos=sos_equipo(ns);
    var ch='';
    var respuesta = ajax_peticion_json(urll,'');
    if (respuesta!=false&&respuesta!=null){
        $.each(respuesta, function(k,v){
            if(sos!=null){
                $.each(sos, function(j,y){
                    if(v.id==y){
                        ch='checked="checked"';
                    }
                });
            }
            html+='<input class="check" '+ch+' type="checkbox" value="'+v.id+'" id="chkso_'+v.id+'" name="so[]"/>'+'<label for="chkso_'+v.id+'">'+v.so+'</label><br>';
            ch='';
        });
        $('#so_equipo').html(html);
            
    }else{
        if(respuesta==null){
            $('#so_equipo').html('<b>No se han encontrado Sistemas Operativos.</b><br>Agrega sistemas operativos en el apartado de software');
        }
    }                      
}

function marcaSW(sws){
    //$("#m_f_permisos input[type=checkbox]").each(function() { 
      //  this.checked = false; });
      try{
    if(sws!=false&&sws.length!=null){
        $.each(sws, function(k,v){
            try{
                $('#chk_'+v).get(0).checked=true;  
            }catch(e){}
        });
    }
    }catch(e){
       
    }
}

function software_equipo(ns){
    var urll='index.php/equipo_software/getSoftware/'+ns;
    var html='<div id="accordion" class="boxshadowround ui-corner-all">';
    var js='<script>$(function() {';
    var respuesta = ajax_peticion_json(urll,'');
    var sw=sw_equipo(ns),ch='';
    var i=0,sosig='';
    var b=true;
    if (respuesta!=false&&respuesta!=null){
        so=respuesta[0].so;
        idso=respuesta[0].so;
        for (i=0;i<=respuesta.length;i++){
            try{
                so=respuesta[i].so;
                var grupos='';
                if(b==true){
                    idso=respuesta[i].idso;
                    id_select='igrupos_so'+idso;
                    grupos=ajax_peticion('index.php/equipo_software/grupos_so','so='+idso);
                    // html+='<div id="grupos"><select></select></div>';
                    html+='<h3><a href="#">'+so+'</a></h3><div><div>Grupos de software:&nbsp;<select id="'+id_select+'">'+grupos+'</select></div>';
                    js+='$("#'+id_select+'").live("change", function(){var r= ajax_peticion_json(\'index.php/equipo_software/getSwGru/\'+$(this).val()); marcaSW(r); });  ';
         //js='';    
          }
                sosig=respuesta[i+1].so;
                if(i==respuesta.length){
                    sosig='dsa$%';
                }
                if(sw!=null){
                    $.each(sw, function(j,y){
                        if(respuesta[i].id==y){
                            ch='checked="checked"';
                        }
                    });
                }
                html+='<input class="check" '+ch+' title="'+respuesta[i].de+'"  type="checkbox" value="'+respuesta[i].id+'" id="chk_'+respuesta[i].id+'" name="sw[]"/>'+'<label for="chk_'+respuesta[i].id+'">'+respuesta[i].sw+'</label><br>';
                ch='';
            }catch(e){}
            if(so==sosig){
                b=false;
            }else{
                html+='</div>';
                b=true;
            }
                
        }
        html+='</div>';
        js+='});</script>';
        html+=js;
          $('#sw_equipo').html(html); 
    }else{
        
    }
    
}//
    
function sos_equipo(ns){
    var urll='index.php/equipo_software/getSosEquipo/'+ns;
    var sos=[];
    var respuesta = ajax_peticion_json(urll,'');
    if (respuesta!=false&&respuesta!=null){
        $.each(respuesta, function(k,v){
            sos[k]=v.id;
        });
        return sos;
    }else{
        if(respuesta==null){
            $('#sw_equipo').html('<b>No se han encontrado Software. </b><br> Por favor agrega un <b>Sistema Operativo</b>, para tener acceso al software correspondiente al sistema agregado.');
            return null;
        }
    }                       
}
    
function sw_equipo(ns){
    var urll='index.php/equipo_software/getSwEquipo/'+ns;
    var sw=[];
    var respuesta = ajax_peticion_json(urll,'');
    if (respuesta!=false&&respuesta!=null){
        $.each(respuesta, function(k,v){
            sw[k]=v.id;
        });
        return sw;
    }else{
        return null;
    }  
                                
}

function getStringEdo(edo){
    var estado='';
    switch(edo){
        case 'L':
            estado='Libre';
            break;
        case 'O':
            estado='Reservado';
            break;
        case 'C':
            estado='En clase';
            break;
        case 'D':
            estado='Descompuesto';
            break;
        case 'M':
            estado='Mantenimiento';
            break;
        default:
            estado='';
            break;
    }
    return estado;
}
    
function ver_software(ns){
    var urll='index.php/equipos/getSoftwareEquipo/'+ns;
    var html='<img src="./images/pc_edos/pc.ico"/>&nbsp;<b>Software</b><hr class="boxshadowround"/>';
    var respuesta = ajax_peticion_json(urll,'');
    var sw=sw_equipo(ns),ch='';
    var i=0,so='',sosig='';
    var b=true;
    if (respuesta!=false&&respuesta!=null){
        so=respuesta[0].so;
        for (i=0;i<=respuesta.length;i++){
            try{
                so=respuesta[i].so;
                if(b==true){
                    html+='<b>'+so+'</b></br>';
                }
                html+='- '+respuesta[i].sw+'<br/>';
                sosig=respuesta[i+1].so;
                if(i==respuesta.length){
                    sosig='dsa$%';
                }
            }catch(e){}
            if(so==sosig){
                b=false;
            }else{
                b=true;
            }
                
        }
    }else{
        html='<img src="./images/warning.png"/>&nbsp;No se ha encontrado software asignado al equipo.';
    }
    $('#pop_sw_'+ns).html(html);
}
    
    
function ver_sos(ns){
    var html='<img src="./images/pc_edos/pc.ico"/>&nbsp;<b>Sistemas Operativos</b><hr class="boxshadowround"/>';
    var respuesta = ajax_peticion_json("index.php/equipos/getSos2Equipo/"+ns,'');
    var img='';
    if (respuesta!=false&&respuesta!=null){
        $.each(respuesta, function(k,v){
            if (v.so.indexOf("Windows")!=-1){
                img='<img src="./images/win.png"/>'
            }else{
                if (v.so.indexOf("Linux")!=-1){
                    img='<img src="./images/lin.png"/>'
                }else{
                    if (v.so.indexOf("Mac")!=-1){
                        img='<img src="./images/mac.png"/>'
                    } 
                }
            }
            html+=img+v.so+'<br>';
        });
    }else{
        html='<img src="./images/warning.png"/>&nbsp;No hay Sistemas operativos asociados al equipo.';
    }   
    $('#pop_so_'+ns).html(html);
}
    
function ver_detalles(ns){
    var html='<img src="./images/pc_edos/pc.ico"/>&nbsp;<b>Detalles del equipo</b><hr class="boxshadowround"/>';
    var respuesta = ajax_peticion_json("index.php/equipos/getEquipo",'id='+ns);
    if (respuesta!=false&&respuesta!=null){
        html+='<b>N&uacute;mero de Serie:&nbsp;&nbsp;</b>'+respuesta.ns+'<br>'+
        '<b>Marca:&nbsp;&nbsp;</b>'+respuesta.ma+'<br>'+
        '<b>Modelo:&nbsp;&nbsp;</b>'+respuesta.mo+'<br>'+
        '<b>N&uacute;mero de Inventario:&nbsp;&nbsp;</b>'+respuesta.ni+'<br>'+
        '<b>Procesador:&nbsp;&nbsp;</b>'+respuesta.pr+'<br>'+
        '<b>Memoria RAM:&nbsp;&nbsp;</b>'+respuesta.ram+'&nbsp;GB<br>'+
        '<b>Disco Duro:&nbsp;&nbsp;</b>'+respuesta.dd+'&nbsp;GB<br>'+
        '<b>Estado:&nbsp;&nbsp;</b><img src="./images/pc_edos/pc_'+respuesta.edo+'_min.png"/>&nbsp;'+getStringEdo(respuesta.edo)+'<br>';
    }else{
        html='<img src="./images/warning.png"/>&nbsp;No hay Sistemas operativos asociados al equipo.'
    }   
    $('#pop_dt_'+ns).html(html);
}

