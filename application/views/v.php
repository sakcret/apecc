<html lang="es">
    <head>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <script type="text/javascript" language="javascript" src="./js/jquery-1.7.2.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery.blockUI.js"></script>
        <script type="text/javascript" language="javascript" src="./js/utilerias.js"></script>

    </head>
    <body onload="window.setTimeout('actualiza_pag()',1000);">
        <div>listo...

        </div>
    </body>
</html>
<script type="text/javascript">
    function ajax(datos){
        $.ajax({
            url:"actualizar_bd",
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
        document.write(hora_cmp+'<br>');
                    
        switch (hora_cmp) {
            case '06:00:00' :
                var datos='dia='+dia_semana+'&hora=0';
                ajax(datos);
                break;
            case '07:00:00' :
                var datos='dia='+dia_semana+'&hora=1';
                ajax(datos);
                break;
            case '08:00:00' :
                var datos='dia='+dia_semana+'&hora=2';
                ajax(datos);
                break;
            case '09:00:00' :
                var datos='dia='+dia_semana+'&hora=3';
                ajax(datos);
                break;
            case '10:00:00' :
                var datos='dia='+dia_semana+'&hora=4';
                ajax(datos);
                break;
            case '11:00:00' :
                var datos='dia='+dia_semana+'&hora=5';
                ajax(datos);
                break;
            case '12:00:00' :
                var datos='dia='+dia_semana+'&hora=6';
                ajax(datos);
                break;
            case '13:00:00' :
                var datos='dia='+dia_semana+'&hora=7';
                ajax(datos);
                break;
            case '14:00:00' :
                var datos='dia='+dia_semana+'&hora=8';
                ajax(datos);
                break;
            case '15:00:00' :
                var datos='dia='+dia_semana+'&hora=9';
                ajax(datos);
                break;
            case '16:00:00' :
                var datos='dia='+dia_semana+'&hora=10';
                ajax(datos);
                break;
            case '17:00:00' :
                var datos='dia='+dia_semana+'&hora=11';
                ajax(datos);
                break;
            case '18:00:00' :
                var datos='dia='+dia_semana+'&hora=12';
                ajax(datos);
                break;
            case '19:00:00' :
                var datos='dia='+dia_semana+'&hora=13';
                ajax(datos);
                break;
            case '20:00:00' :
                var datos='dia='+dia_semana+'&hora=14';
                ajax(datos);
                break;
            case '21:00:00' :
                var datos='dia='+dia_semana+'&hora=15';
                ajax(datos);
                break;
            case '22:00:00' :
                var datos='dia='+dia_semana+'&hora=0';
                ajax(datos);
                break;
                   
            default :
                ;
        }     
        window.setTimeout("actualiza_pag()",1000);
    }
    
           
</script>

