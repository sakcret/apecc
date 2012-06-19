$(function() {
    
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
        './images/home.png',
        './images/refresh.png',
        './images/usuarios.png',
        './images/salir.png',
        './images/info_2.png'
        ]
    });
});

