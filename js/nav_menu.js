$(function() {
     
            
    //links para el menu principal                    
    $( "#nav" ).buttonset();
    $( "#btn_conf" );
    $( "#btn_reload" ).click(function(){
        redirect_to(purl);
    }
    );
    $("#nav_rt").click(function(){
        redirect_to('reservaciones_temporales');
    }
    );
        
    $("#nav_rf").click(function(){
        redirect_to('Reservaciones_fijas');
    }
    );
        
    $("#nav_ue").click(function(){
        redirect_to('ubicacion_equipos');
    }
    );
        
    $("#nav_us" ).click(function(){
        redirect_to('usuarios');
    }
    );
        
    $("#nav_eq" ).click(function(){
        redirect_to('equipos');
    }
    );
        
    $("#nav_ac" ).click(function(){
        redirect_to('actividades');
    }
    );
        
    $("#nav_sw").click(function(){
        redirect_to('software');
    }
    );
    $("#nav_es").click(function(){
        redirect_to('equipo_software');
    }
    );
    $("#nav_as").click(function(){
        redirect_to('reservaciones_salas');
    }
    );
        
    $("#nav_rg").click(function(){
        redirect_to('reportes');
    }
    );
    $("#nav_rp").click(function(){
        redirect_to('reportes_per');
    }
    );
    $("#nav_su").click(function(){
        redirect_to('usuarios_sistema');
    }
    );
    $("#nav_sc").click(function(){
        redirect_to('configura_sistema');
    }
    );
    $("#refresh").click(function(){
        window.location.reload();
    }
    );
        
    //menu accesible lateral izquieda				
    $('#acess_menu').sweetMenu({
        top: 200,
        padding: 8,
        iconSize: 34,
        easing: 'easeOutBounce',
        duration: 500,
        icons: [
        './images/menu_lt/home.png',
        './images/menu_lt/refresh.png',
        './images/menu_lt/usuarios.png',
        './images/menu_lt/computer.png',
        './images/menu_lt/salir.png',
        './images/menu_lt/info.png'
        ]
    });
    
    //acciones para el menu lateral
    $("#ml_hm").click(function(){
        redirect_to('inicio');
    }
    );
    $("#ml_us").click(function(){
        redirect_to('usuarios');
    }
    );
    $("#ml_rm").click(function(){
        redirect_to('reservaciones_temporales');
    }
    );
    $("#ml_ex").click(function(){
        cerrar_sesion();
    }
    ); 
    $("#ml_hp").click(function(){
        redirect_to('help');
    }
    );     
        $('#nav_ad').click(function(){
            mensaje($( "#mensaje" ),'Acerca de APECC','./images/BANNER_APECC.png"'
            ,''
            ,'<br><br><br><b>APECC v1.0<br>Licenciado bajo GPL v2</b><br><hr class="boxshadowround"><center>UNIVERSIDAD VERACRUZANA<br>'+
            'Facultad de Estad&iacute;stica e Inform&aacute;tica<br>Jos&eacute; Adrian Ruiz Carmona<br>sakcret@gmail.com<br></center>'+
            '<hr class="boxshadowround"><span style="font-size: 10px !important;">Proyecto Desarrollado a cargo de:<br> &nbsp;&nbsp;&nbsp;- MCC Fredy Castañeda Sánchez<br>&nbsp;&nbsp;&nbsp;- LI Martha Elizabet Domínguez Bárcenas<br>Idea original: Issac Salazar Herrera</span>',400,false);
        });
    //menu principal
    $("#ulMenu").menubar({
        menuIcon: true,
        buttons: true,
        position: {
            within: $("#demo-frame").add(window).first()
        },
        select: function(event, ui) {
            $("<div/>").text("Selected: " + ui.item.text()).appendTo("#log");
        }
    });
    $(".no-icon").find(".ui-button-icon-secondary").removeClass("ui-icon ui-icon-triangle-1-s"); 
    $('#refresh').hover(
        function(){
            $(this).addClass('transparencia')
        },
        function(){
            $(this).removeClass('transparencia')
        }
        );      
});

