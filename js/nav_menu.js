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

