
 <img style=" width: 100%" src="./images/barra.png"> 
 <center align="center" id="titulo"><?php echo $titulo_rep;?></center>
 <img style=" width: 100%" src="./images/barra.png">
 <?php $horas_total=0;$money_total=0;?>
  <div  id="datos_act_asign" >
            <table id="tb_repsem" class="table" border="1" style=" width: 100%">
                <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Tipo de Actividad</th>
                    <th>Nombre Corto</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                </tr>
            </thead>
                <?php foreach ($datos_actividades->result() as $r) { ?>
                    <tr>
                        <td><?php echo $r->actividad?></td>
                        <td><?php echo $r->tipoactividad?></td>
                        <td><?php echo $r->nombrecorto?></td>
                        <td><?php echo $r->fechainicio?></td>
                        <td><?php echo $r->fechafin?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th class="shadow" colspan="5">&nbsp;</th>
                </tr>
        </table>
    </div>
<style>
    h3{
        margin-top: 10px;
    }
    .titulo {
        width: 100%;
        height: 31px;
        color:white;  font-size: 13px;
        text-align: center !important;
        font-weight:  bold !important;
        background-image: url('./images/titulo_barra.png');
        background-position: center;
        background-repeat: no-repeat;

    }

    .shadow{
        color:#000000; 
        background-color:#E6E6E6; 
    }
    .centratexto{
        text-align: center;
    }
    table thead tr th,table tfoot tr th{
        background-color:#EBEBEB;
    }  
    .table {
        background-color: white;
        border-collapse: collapse;
        border: 1px solid #666666 !important;        
        text-align:left;

    }  
    .round_div{
        background-color: white;
        border-collapse: collapse;
        border: 1px solid #666666 !important;     
        border-style: dotted;
        border-radius: 10px;
        text-align:center;
    }
    .detalle{
        font-size: 9px;
    }
</style>
