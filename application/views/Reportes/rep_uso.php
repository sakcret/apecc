<?php
$resrv_ciclo = array();
$resrv_sem = array();
$resrv_mes = array();
$resrv_ciclo_mes = array();
$resrv_mes_sem = array();
$meses_ciclo = array();
$resrv_ciclo_total = array();

//parsear lso resultados de la consulta en un arreglo indizado por fecha y sala
foreach ($datos_salas->result() as $row) {
    $resrv_ciclo[$row->fecha][$row->sala] = array('sala' => $row->sala, 'horas' => $row->horas);
}

///////////////////////////////obtener el arreglos//////////////////////////////////
$mes_ant = '';
$ind = 0;
$a = date('Y');
$m = date('m');
$d = date('d');
$w = date('W');
//$ds = date('N');
$hoy = new DateTime(date('Y-m-d'));
$fl = $this->utl_apecc->getDiaLunesSemana($hoy);
//obtener los periodos para el mes
$periodos_mes_actual = $this->utl_apecc->periodo_semana_mes($hoy);

///////////////////////////////obtener el arreglo $reserv_ciclo_mes indizado por mes y fecha//////////////////////////////////
foreach ($resrv_ciclo as $k => $v) {
    $mes_ant = substr($k, 5, 2);
    $resrv_ciclo_total[$k] = array();
    if (!array_key_exists($mes_ant, $v)) {
        $meses_ciclo[$mes_ant] = $this->utl_apecc->getMesStr($mes_ant);
    }
///////////////////////////////obtener el arreglo $reserv_ciclo_total indizado por fecha no importando la sala//////////////////////////////////
    foreach ($v as $key => $value) {
        array_push($resrv_ciclo_total[$k], $value['horas']);
    }

///////////////////////////////obtener el arreglo $reserv_mes_mes indizado por mes y fecha//////////////////////////////////
//si el el año extraido del indice es igual al mes actual
    if ($a == substr($k, 0, 4)) {

        //si el mes  extraido del indice es igual al mes actual
        if ($m == substr($k, 5, 2)) {
            $f_temp = new DateTime($k); //obtengo la fecha del indice $k
            $dia = $f_temp->format('d');
            $resrv_mes[$k] = $v;
            ///////////////////////////////obtener el arreglo $reserv_sem indizado por mes y fecha//////////////////////////////////
            //si el dia extraido del arreglo esta en la semana actual lo agrego al arreglo
            if (($dia <= $d) && ($dia >= $fl->format('d'))) {
                $resrv_sem[$k] = $v;
            }
        }
    }
    $ind++;
}

foreach ($meses_ciclo as $kmes => $vnomes) {
    $resrv_ciclo_mes[$kmes] = array();
    foreach ($resrv_ciclo as $k => $v) {
        $mes = substr($k, 5, 2);
        foreach ($v as $k1 => $v1) {
            if (!array_key_exists($k1, $resrv_ciclo_mes[$kmes])) {
                $resrv_ciclo_mes[$kmes][$k1] = array();
                if ($kmes == $mes) {
                    array_push($resrv_ciclo_mes[$kmes][$k1], $v[$k1]['horas']);
                }
            } else {
                if ($kmes == $mes) {
                    array_push($resrv_ciclo_mes[$kmes][$k1], $v[$k1]['horas']);
                }
            }
        }
    }
}


foreach ($salas->result() as $s) {
    $ind = 0;
    $resrv_mes_sem[$s->idSala] = array();
    foreach ($periodos_mes_actual as $k2 => $v2) {
        $resrv_mes_sem[$s->idSala][$k2] = array();
        foreach ($resrv_mes as $key => $value) {
            $f_temp = new DateTime($key); //obtengo la fecha del indice $k
            $semana_t = $f_temp->format('W');
            if (array_key_exists($s->idSala, $value)) {
                if ($semana_t == $k2) {
                    array_push($resrv_mes_sem[$s->idSala][$semana_t], $value[$s->idSala]['horas']);
                }
                $ind++;
            }
        }
    }
}
?>
<br>
<img alt="Reporte de uso del Centro de Computo" src="./images/rep_gral_uso.png">
<div class="row">
    <div  id="datos_act_asign" >
        <h3>Reporte Semanal de uso del Centro de Computo</h3>
        <div align="right" class="detalle_periodo"><?php echo ' Semana ' . $w . ' del a&ntilde;o Mes: ' . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?></div>
        <table id="tb_repsem" class="table" border="1" style=" width: 100%">
            <thead>
                <tr>
                    <th>D&iacute;a</th>
                    <?php
                    $total_hrs_mes = 0;
                    foreach ($salas->result() as $v) {
                        echo '<th>Sala ' . $v->Sala . '</th>';
                    }
                    $totales = array();
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resrv_sem as $k => $v) { ?>
                    <tr>
                        <th class="ui-widget-content"><?php
                $ft = new DateTime($k);
                echo $this->utl_apecc->getDiaStr($ft->format('N'));
                    ?></th>
                        <?php
                        foreach ($salas->result() as $s) {
                            if (array_key_exists($s->idSala, $v)) {
                                $hrs = $v[$s->idSala]['horas'];
                                $total_hrs_mes+=$hrs;
                                if (!array_key_exists($s->idSala, $totales)) {
                                    $totales[$s->idSala] = array();
                                    array_push($totales[$s->idSala], $hrs);
                                } else {
                                    array_push($totales[$s->idSala], $hrs);
                                }
                                echo '<td class="ui-widget-content">' . $hrs . '</td>';
                            } else {
                                echo ' <td class="ui-widget-content">0</td>';
                            }
                            ?>

                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total de Horas</th>
                    <?php
                    foreach ($salas->result() as $v) {
                        if (array_key_exists($v->idSala, $totales)) {
                            echo '<th>' . array_sum($totales[$v->idSala]) . '</th>';
                        } else {
                            echo '<th>0</th>';
                        }
                    }
                    ?>
                </tr>
            </tfoot>
        </table>
        <img alt="__________"  src="./images/barra.png">
        <strong>Total de horas en la semana: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.
    </div>

    <div id="" class="ui-state-active">
        <h3>Reporte Mensual de uso del Centro de Computo</h3>
        <div  id="datos_act_asign" >
            <div  align="right" class="detalle_periodo"><?php echo $this->utl_apecc->getMesStr($m) . ' ' . $a; ?></div>
            <table id="tb_resxmesact" class="table"  border="1" style=" width: 100%">
                <thead>
                    <tr>
                        <th>D&iacute;a</th>
                        <?php
                        $total_hrs_mes = 0;
                        foreach ($salas->result() as $v) {
                            echo '<th>' . $v->Sala . '</th>';
                        }
                        $totales = array();
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $detalles = '<table style=" width: 100%"><tr>';
                    foreach ($periodos_mes_actual as $key => $value) {
                        $detalles.='<td class="pad ui-widget-header ui-corner-bottom"><b>Semana ' . $key . ': </b><br>  ' . $value['dia_inicio'] . ' al ' . $value['dia_fin'] . ' de ' . $this->utl_apecc->getMesStr($m) . '<t/d>';
                        ?>
                        <tr>
                            <th><?php echo 'Semana ' . $key; ?></th>
                            <?php
                            foreach ($salas->result() as $s) {
                                if ((array_key_exists($s->idSala, $resrv_mes_sem))) {
                                    $suma = array_sum($resrv_mes_sem[$s->idSala][$key]);
                                    $total_hrs_mes+=$suma;
                                    if (!array_key_exists($s->idSala, $totales)) {
                                        $totales[$s->idSala] = array();
                                        array_push($totales[$s->idSala], $suma);
                                    } else {
                                        array_push($totales[$s->idSala], $suma);
                                    }
                                    echo '<td class="ui-widget-content">' . $suma . '</td>';
                                } else {
                                    echo ' <td class="ui-widget-content">0' . $s->idSala . '</td>';
                                }
                            }
                            ?>
                        </tr>
                    <?php } $detalles.='</tr></table>'; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total de Horas</th>
                        <?php
                        foreach ($salas->result() as $v) {
                            if (array_key_exists($v->idSala, $totales)) {
                                echo '<th>' . array_sum($totales[$v->idSala]) . '</th>';
                            } else {
                                echo '<th>0</th>';
                            }
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>
            <img alt="__________" src="./images/barra.png">
            <strong>Total de horas en el mes: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.
        </div>
        <br>
        <b>Detalles de las semanas:</b>

        <?php echo $detalles ?>
    </div>

    <div>
        <h3>Reporte de Uso del Centro de Computo en el Periodo Actual</h3>
        <div  id="datos_act_asign" >
            <div align="right" class="detalle_periodo">Periodo Actual <?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?></div>
            <table id="tb_repcicloact" class="table" border="1" style=" width: 100%">
                <thead>
                    <tr>
                        <th>D&iacute;a</th>
                        <?php
                        $total_hrs_mes = 0;
                        foreach ($salas->result() as $v) {
                            echo '<th> Sala ' . $v->Sala . '</th>';
                        }
                        $totales = array();
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($meses_ciclo as $km => $vm) { ?>
                        <tr>
                            <th class="ui-widget-content"><?php echo $vm; ?></th>
                            <?php
                            foreach ($salas->result() as $s) {
                                if ((array_key_exists($s->idSala, $resrv_ciclo_mes[$km]))) {
                                    $suma = array_sum($resrv_ciclo_mes[$km][$s->idSala]);
                                    if (!array_key_exists($s->idSala, $totales)) {
                                        $totales[$s->idSala] = array();
                                        array_push($totales[$s->idSala], $suma);
                                    } else {
                                        array_push($totales[$s->idSala], $suma);
                                    }
                                    $total_hrs_mes+=$suma;
                                    echo '<td class="ui-widget-content">' . $suma . '</td>';
                                } else {
                                    echo ' <td class="ui-widget-content">0' . '</td>';
                                }
                                ?>

                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total de Horas</th>
                        <?php
                        foreach ($salas->result() as $v) {
                            if (array_key_exists($v->idSala, $totales)) {
                                echo '<th>' . array_sum($totales[$v->idSala]) . '</th>';
                            } else {
                                echo '<th>0</th>';
                            }
                        }
                        ?>
                    </tr>
                </tfoot>
            </table>
            <img  alt="__________" src="./images/barra.png">
            <strong>Total de horas en el periodo: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.
        </div>
    </div>
</div>
<style>
    h1 {color:#022a73;  }
    h2 {color:#022a73; padding: 3px !important;}
    h3 {color:#18479c;}
    .shadow{
        color:#000000; 
        background-color:#E6E6E6; 
    }
    table thead tr th,table tfoot tr th{
        background-color:#EBEBEB;
    }

    .tablas{
        width:100%;
        margin-top:10px;
        float:none;
        height:auto;
        border-collapse: collapse;
        border: 1px solid #666666 !important;  
    }     
    .table {
        border-collapse: collapse;
        border: 1px solid #666666 !important;        
        text-align:left;
    }  
    .barra_titulo{
        background: url('/images/titulo_barra.png') no-repeat !important;
        overflow: hidden;
    }
    .detalle_periodo{
        font-size: 9px;
    }

</style>