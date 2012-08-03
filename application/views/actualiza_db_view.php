<html lang="es">
    <head>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <script type="text/javascript" language="javascript" src="./js/jquery-1.7.2.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery.blockUI.js"></script>
        <script type="text/javascript" language="javascript" src="./js/utilerias.js"></script>

    </head>
    <body onload="window.setTimeout('actualiza_pag()',1000);">
        Servicio Actualiza db Iniciado...<br>
        <div id="msg">

        </div>
    </body>
</html>
<script type="text/javascript">
    function ajax(datos){
        $.ajax({
            url:"index.php/actualiza_db/actualizar",
            data: datos,
            type:"POST",
            error: function(a, b) { 
            },
            success:
                function(r){                                                              
            }
        });
    }
    
    function actualiza_pag(){ 
        var  hoy = new Date(),
        hora = fillZeroDateElement(hoy.getHours()),
        minutos = fillZeroDateElement(hoy.getMinutes()),
        segundos = fillZeroDateElement(hoy.getSeconds());
        var hora_cmp=hora + ":" + minutos+':'+segundos;
        var dia_semana = hoy.getDay();
        var dia=hoy.getDate()
        //document.write("Hoy es "+dia+'<br>es el d='+dia_semana);
        //document.write(hora_cmp+'<br>');
        var resp='';            
        switch (hora_cmp) {
            case '06:00:00' :
                $('#msg').text('');
                var datos='dia='+dia_semana+'&hora=0';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '07:00:00' :
                var datos='dia='+dia_semana+'&hora=1';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '08:00:00' :
                var datos='dia='+dia_semana+'&hora=2';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '09:00:00' :
                var datos='dia='+dia_semana+'&hora=3';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '10:00:00' :
                var datos='dia='+dia_semana+'&hora=4';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '11:00:00' :
                var datos='dia='+dia_semana+'&hora=5';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '12:00:00' :
                var datos='dia='+dia_semana+'&hora=6';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '13:00:00' :
                var datos='dia='+dia_semana+'&hora=7';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '14:00:00' :
                var datos='dia='+dia_semana+'&hora=8';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '15:00:00' :
                var datos='dia='+dia_semana+'&hora=9';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '16:00:00' :
                var datos='dia='+dia_semana+'&hora=10';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '17:00:00' :
                var datos='dia='+dia_semana+'&hora=11';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '18:00:00' :
                var datos='dia='+dia_semana+'&hora=12';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '19:00:00' :
                var datos='dia='+dia_semana+'&hora=13';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '20:00:00' :
                var datos='dia='+dia_semana+'&hora=14';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '21:00:00' :
                var datos='dia='+dia_semana+'&hora=15';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            case '22:00:00' :
                var datos='dia='+dia_semana+'&hora=0';
                resp=ajax(datos);
                var text=$('#msg').text();
                $('#msg').text(text+resp);
                break;
            default :
                ;
        }     
        window.setTimeout("actualiza_pag()",1000);
    }
    
           
</script>

