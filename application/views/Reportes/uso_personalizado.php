<br>
<center align="center" class="titulo"><h3><?php echo $titulo_rep; ?></h3></center>
<?php $horas_total = 0;
$money_total = 0; ?>
<div  id="datos_act_asign" >
    <table id="tb_repsem" class="table" border="1" style=" width: 100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Horas</th>
                <th>Importe</th>
                <th>Sala</th>
                <th>Login</th>
                <th>Nombre del Usuario</th>
                <th>N&uacute;mero de Serie</th>
                <th>Actividad</th>
                <th>Tipo de Actividad</th>
            </tr>
        </thead>
        <?php
        foreach ($datos_reservaciones->result() as $r) {
            $importe = $r->importe;
            $money_total+=$importe;
            $horas = $r->horas;
            $horas_total+=$horas;
            ?>
            <tr>
                <td><?php echo $this->utl_apecc->getdate_SQL($r->fecha) ?></td>
                <td><?php echo $r->inicio ?></td>
                <td><?php echo $r->fin ?></td>
                <td align="right"><?php echo $horas ?></td>
                <td align="right"><?php echo '$ ' . number_format($importe, 2, ".", ","); ?></td>
                <td><?php echo $r->sala ?></td>
                <td><?php echo $r->login ?></td>
                <td><?php echo $r->nombre ?></td>
                <td><?php echo $r->numeroserie ?></td>
                <td><?php echo $r->actividad ?></td>
                <td><?php echo $r->tipoactividad ?></td>
            </tr>
<?php } ?>
        <tr>
            <th class="shadow" colspan="3">Totales</th>
            <th class="shadow" align="right"> <?php echo $horas_total; ?></th>
            <th class="shadow" align="right"> <?php echo '$ ' . number_format($money_total, 2, ".", ","); ?></th>
            <th class="shadow" colspan="6">&nbsp;</th>
        </tr>
    </table>
</div>
<?php
if ($datos_reservaciones->num_rows() == 0) {
    echo '<h3 class=" round_div"><img src="./images/warning.png" alt=" ">&nbsp;No se encontraron resultados</h3>';
} else {
    echo '<br> <img style=" width: 100%" src="./images/barra.png"><center align="center" style="text-align: center !important;"> <b>Resultado: ' . $datos_reservaciones->num_rows() . ' Reservaciones.</b></center> <img style=" width: 100%" src="./images/barra.png"><br>';
}
?>
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
    
    <?php if (isset($xls)&&$xls=='xls'){
     echo 'img{display: none !important;}';
        } ?>
    
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
