$(function() {
     
            
    //links para el menu principal                    
    $( "#nav" ).buttonset();
    $( "#btn_conf" );
    $( "#btn_reload" ).click(function(){
        redirect_to(purl);
    }
    );
        
    function habre_link_clicks(event,adonde){
        switch (event.which) {
            case 1:
                redirect_to(adonde);
                break;
            case 3:
                open_in_new(adonde);
                break;
            default:
        }
    }

    $('#nav_rt').mousedown(function(event) {
        habre_link_clicks(event,'reservaciones_temporales');
        });
        
    $("#nav_rf").mousedown(function(event) {
        redirect_to('Reservaciones_fijas');
    }
    );
        
    $("#nav_ue").mousedown(function(event) {
        habre_link_clicks(event,'ubicacion_equipos');
    }
    );
        
    $("#nav_us" ).mousedown(function(event) {
        habre_link_clicks(event,'usuarios');
    }
    );
        
    $("#nav_eq" ).mousedown(function(event) {
        habre_link_clicks(event,'equipos');
    }
    );
        
    $("#nav_ac" ).mousedown(function(event) {
        habre_link_clicks(event,'actividades');
    }
    );
        
    $("#nav_sw").mousedown(function(event) {
        habre_link_clicks(event,'software');
    }
    );
    $("#nav_es").mousedown(function(event) {
        habre_link_clicks(event,'equipo_software');
    }
    );
    $("#nav_as").mousedown(function(event) {
        habre_link_clicks(event,'reservaciones_salas');
    }
    );
        
    $("#nav_rg").mousedown(function(event) {
        habre_link_clicks(event,'reportes');
    }
    );
    $("#nav_rp").mousedown(function(event) {
        habre_link_clicks(event,'reportes_per');
    }
    );
    $("#nav_su").mousedown(function(event) {
        habre_link_clicks(event,'usuarios_sistema');
    }
    );
    $("#nav_sc").mousedown(function(event) {
        habre_link_clicks(event,'configura_sistema');
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

