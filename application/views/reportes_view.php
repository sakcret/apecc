<script type="text/javascript">
    if ($.blockUI) {
        $.blockUI.defaults.baseZ = 200000;
        $.blockUI({ 
            message:'<img src="./images/loading3.gif" width="50" heigth="50"><h1>Cargando...</h1>Espere un momento por favor. Cargando Contenido',   
            showOverlay: false, 
            centerY: false, 
            css: { 
                width: '350px', 
                border: 'none', 
                margin:'auto',
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity:'0.4',
                filter:'alpha(opacity=40)',
                color: '#fff' 
            } 
        });
    }
</script>
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
<script type="text/javascript">
    $(document).ready(function() {
        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });

            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });

            var chart = new Highcharts.Chart(options);
        }

        var table = document.getElementById('tb_resxmesact'),
        options = {
            chart: {
                renderTo: 'rep_gral_hrs',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Reporte Mensual de uso del Centro de Computo'
            },
            subtitle: {
                text: '<?php echo "Mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?>'
            },
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +'  '+ this.x;
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true
                    }
                }
            }
        };
        
        var options_area = {
            chart: {
                renderTo: 'rep_gral_hrs_area',
                defaultSeriesType: 'area'
            },
            title: {
                text:'Reporte Mensual de uso del Centro de Computo'
            },
            subtitle: {
                text: '<?php echo "Mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?>'
            }, 
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +'  '+ this.x;
                }
            },credits: {
                enabled: false
            }
        };

        Highcharts.visualize(table, options);
        Highcharts.visualize(table, options_area);
        
        /*
         *Graficas para reporte por ciclo
         */
        var table = document.getElementById('tb_repcicloact'),
        options = {
            chart: {
                renderTo: 'rep_ciclo_hrs',
                defaultSeriesType: 'column'
            },
            title: {
                text:  'Reporte de Uso del Centro de Computo en el Periodo Actual'
            },
            subtitle: {
                text: ' (<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>)'
            },
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +' <b>Mes:</b> '+ this.x.toLowerCase();
                }
            },credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true
                    }
                }
            }
        };
        
        var options_area = {
            chart: {
                renderTo: 'rep_ciclo_hrs_area',
                defaultSeriesType: 'area'
            },
            title: {
                text:  'Reporte de Uso del Centro de Computo en el Periodo Actual'
            },
            subtitle: {
                text: ' (<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>)'
            },
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +' <b>Mes:</b> '+ this.x.toLowerCase();
                }
            },
            credits: {
                enabled: false
            }
        };

        Highcharts.visualize(table, options);
        Highcharts.visualize(table, options_area);
        
        /*
         *Graficas para reporte por semana
         */
        var table = document.getElementById('tb_repsem'),
        options = {
            chart: {
                renderTo: 'rep_sem_hrs',
                defaultSeriesType: 'column'
            },
            title: {
                text:'Reporte Semanal de uso del Centro de Computo Semana'
            },
            subtitle: {
                text: 'Semana <?php echo $w . " en el mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?>'
            },
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +' <b>Día:</b> '+ this.x.toLowerCase();
                }
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    dataLabels: {
                        enabled: true
                    }
                }
            }
        };
        
        var options_area = {
            chart: {
                renderTo: 'rep_sem_hrs_area',
                defaultSeriesType: 'area'
            },
            title: {
                text: 'Reporte Semanal de uso del Centro de Computo Semana'
            },
            subtitle: {
                text: 'Semana <?php echo $w . " en el mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?>'
            },
            xAxis: {
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        font: 'normal 13px Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Horas'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b> '+ this.series.name +'</b><br/>'+
                        '<b>Horas:</b>'+this.y +' <b>Día:</b> '+ this.x.toLowerCase();
                }
            },
            credits: {
                enabled: false
            }
        };

        Highcharts.visualize(table, options);
        Highcharts.visualize(table, options_area);
        
    });

</script>
<div class="row1"> 
    <div class="ui-widget-header ui-corner-all but_bar_content bar">
        <div style="margin-top: 3px; margin-left: 6px;">
            <button id="btn_savepdf" class="prm_r"><img src="./images/save_pdf.ico"/>&nbsp;Guardar como PDF</button>
            <button id="btn_savexls" class="prm_r"><img src="./images/save_xls.png"/>&nbsp;Guardar como XLS</button>
            <button id="btn_calendario"><img src="./images/calendario.gif"/>&nbsp;Ver/Ocultar Calendario</button>
        </div>
    </div>
</div>
<div class="row1" style=" margin-left: 30px; margin-right: 30px;"> 
    <div id="barra_calendario" align="center" class="ui-widget-content ui-corner-all oculto" style="overflow: auto; padding: 8px; margin-top: 10px; margin-bottom: 10px;">
        <div id="calendario">
        </div>
    </div>
</div>
<div class="row1">
    <div id="accordion_tiporep">
        <div>
            <h3><a href="#">Reporte Semanal de uso del Centro de Computo</a></h3>
            <div class="ui-state-focus">
                <div id="tab_resumen_horas_mes">
                    <ul>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-1">Gr&aacute;fico de barras</a></li>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-2">Gr&aacute;fico de &Aacute;rea</a></li>
                        <li style="width: 20%"><a style="width: 90%" href="#tabs-3">Tabla</a></li>
                    </ul>
                    <div Style="height: 450px;" id="tabs-1">
                        <div  id="rep_sem_hrs" Style="height: 400px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                    </div>
                    <div Style="height: 450px;" id="tabs-2">
                        <div  id="rep_sem_hrs_area" Style="height: 400px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                    </div>
                    <div id="tabs-3" class="ui-state-active">
                        <div  id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" >
                            <div class="ui-grid-header ui-widget-header ui-corner-top" >Reporte Semanal de uso del Centro de Computo Semana <?php echo $w . " en el mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?></div>
                            <table id="tb_repsem" class="ui-grid-content ui-widget-content" style=" width: 100%">
                                <thead>
                                    <tr>
                                        <th class="ui-widget-header">D&iacute;a</th>
                                        <?php
                                        $total_hrs_mes = 0;
                                        foreach ($salas->result() as $v) {
                                            echo '<th class="ui-widget-header">Sala ' . $v->Sala . '</th>';
                                        }
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
                                                    echo '<td class="ui-widget-content">' . $hrs . '</td>';
                                                } else {
                                                    echo ' <td class="ui-widget-content">0</td>';
                                                }
                                                ?>

                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix"> 
                                <div class="ui-widget">
                                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
                                        <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                            <strong>Total de horas en la semana: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--Fin acc1-->
        <div>
            <h3><a href="#">Reporte Mensual de uso del Centro de Computo</a></h3>
            <div class="ui-state-focus">
                <div id="tab_resumen_horas_mes">
                    <ul>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-1m">Gr&aacute;fico de barras</a></li>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-2m">Gr&aacute;fico de &Aacute;rea</a></li>
                        <li style="width: 20%"><a style="width: 90%" href="#tabs-3m">Tabla</a></li>
                    </ul>
                    <div Style="height: 510px;" id="tabs-1m">
                        <div  id="rep_gral_hrs" Style="height: 420px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                        <hr class="boxshadowround">
                        <center><b style=" color: black">Detalles de las semanas:</b></center>
                        <hr class="boxshadowround">
                        <div class="detales_rep_mes_sem"></div>
                    </div>
                    <div Style="height: 510px;" id="tabs-2m">
                        <div  id="rep_gral_hrs_area" Style="height: 420px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                        <hr class="boxshadowround">
                        <center><b style=" color: black">Detalles de las semanas:</b></center>
                        <hr class="boxshadowround">
                        <div class="detales_rep_mes_sem"></div>
                    </div>
                    <div id="tabs-3m" class="ui-state-active">
                        <div  id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" >
                            <div class="ui-grid-header ui-widget-header ui-corner-top" >Reporte Mensual de uso del Centro de Computo <?php echo "en el mes de " . $this->utl_apecc->getMesStr($m) . ' ' . $a; ?></div>
                            <table id="tb_resxmesact" class="ui-grid-content ui-widget-content" style=" width: 100%">
                                <thead>
                                    <tr>
                                        <th class="ui-widget-header">D&iacute;a</th>
                                        <?php
                                        $total_hrs_mes = 0;
                                        foreach ($salas->result() as $v) {
                                            echo '<th class="ui-widget-header"> Sala ' . $v->Sala . '</th>';
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $detalles = '<table><tr>';
                                    foreach ($periodos_mes_actual as $key => $value) {
                                        $detalles.='<td class="pad ui-widget-header ui-corner-bottom"><b>Semana ' . $key . ' </b>  ' . $value['dia_inicio'] . ' al ' . $value['dia_fin'] . ' de ' . $this->utl_apecc->getMesStr($m) . '<t/d>';
                                        ?>
                                        <tr>
                                            <th class="ui-widget-content" title="<?php echo $value['dia_inicio'] . ' al ' . $value['dia_fin'] . ' de ' . $this->utl_apecc->getMesStr($m) ?>"><?php echo 'Semana ' . $key; ?></th>
                                            <?php
                                            foreach ($salas->result() as $s) {
                                                if ((array_key_exists($s->idSala, $resrv_mes_sem))) {
                                                    $suma = array_sum($resrv_mes_sem[$s->idSala][$key]);
                                                    $total_hrs_mes+=$suma;
                                                    echo '<td class="ui-widget-content">' . $suma . '</td>';
                                                } else {
                                                    echo ' <td class="ui-widget-content">0' . $s->idSala . '</td>';
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php } $detalles.='</tr></table>'; ?>
                                </tbody>
                            </table>
                            <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix"> 
                                <div class="ui-widget">
                                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
                                        <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                            <strong>Total de horas en el mes: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="boxshadowround">
                        <center><b style=" color: black">Detalles de las semanas:</b></center>
                        <hr class="boxshadowround">
                        <?php echo $detalles ?>
                    </div>
                </div>
            </div>
        </div><!--fin acc2-->

        <div>
            <h3><a href="#">Reporte de Uso del Centro de Computo en el Periodo Actual</a></h3>
            <div class="ui-state-focus">
                <div id="tab_resumen_horas_per">
                    <ul>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-1c">Gr&aacute;fico de barras</a></li>
                        <li style="width: 20%"><a  style="width: 90%" href="#tabs-2c">Gr&aacute;fico de &Aacute;rea</a></li>
                        <li style="width: 20%"><a style="width: 90%" href="#tabs-3c">Tabla</a></li>
                    </ul>
                    <div Style="height: 450px;" id="tabs-1c">
                        <div  id="rep_ciclo_hrs" Style="height: 400px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                    </div>
                    <div Style="height: 450px;" id="tabs-2c">
                        <div  id="rep_ciclo_hrs_area" Style="height: 400px !important; overflow: auto !important;" class="boxshadowround ui-corner_all "></div>
                    </div>
                    <div id="tabs-3c" class="ui-state-active">
                        <div  id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all" >
                            <div class="ui-grid-header ui-widget-header ui-corner-top" > Reporte de Uso del Centro de Computo en el Periodo Actual (<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>)</div>
                            <table id="tb_repcicloact" class="ui-grid-content ui-widget-content" style=" width: 100%">
                                <thead>
                                    <tr>
                                        <th class="ui-widget-header">D&iacute;a</th>
                                        <?php
                                        $total_hrs_mes = 0;
                                        foreach ($salas->result() as $v) {
                                            echo '<th class="ui-widget-header">Sala ' . $v->Sala . '</th>';
                                        }
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
                                                    $total_hrs_mes+=$suma;
                                                    echo '<td class="ui-widget-content">' . $suma . '</td>';
                                                } else {
                                                    echo ' <td class="ui-widget-content">0' . '</td>';
                                                }
                                            }
                                            ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix"> 
                                <div class="ui-widget">
                                    <div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;"> 
                                        <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
                                            <strong>Total de horas en el mes: </strong> <?php echo $total_hrs_mes; ?>&nbsp; horas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class=" boxshadowround">
                <div class=" ui-widget-header ui-corner-all pad">Resumen Total/Resumen Total por Sala</div>
                <hr class=" boxshadowround">
                <div id="tabs_rep1_salas">
                    <ul>
                        <?php
                        $numreg = $salas->num_rows() + 1;
                        $porcentaje = (100 / $numreg) - 0.5;
                        echo '<li style=" width: ' . $porcentaje . '%"><a style=" width: 90%" href="#tabs-stodas"</a>Todas</li>';
                        foreach ($salas->result() as $sala) {
                            echo '<li style=" width: ' . $porcentaje . '%"><a style=" width: 90%" href="#tabs-s' . $sala->idSala . '">Sala ' . $sala->Sala . '</a></li>';
                        }
                        ?>
                    </ul>
                    <div id="tabs-stodas"> 
                        <script type="text/javascript">
                            var chart;
                            $(document).ready(function() {
                                                       
                                chart = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'sala_rep',
                                        zoomType: 'x',
                                        spacingRight: 20
                                    },
                                    title: {
                                        text: 'Reporte de Uso del Centro de Computo en el Periodo Actual (<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>)'
                                    },
                                    subtitle: {
                                        text: document.ontouchstart === undefined ?
                                            'Para hacer zoom en el gráfico, da click sobre este y sin soltar arrastra hata el completar el subperiodo deseado' :
                                            'Para hacer zoom en el gráfico, da click sobre este y sin soltar arrastra hata el completar el subperiodo deseado'
                                                                       
                                    },
                                    xAxis: {
                                        type: 'datetime',
                                        maxZoom: 14 * 24 * 3600000, // fourteen days
                                        title: {
                                            text: null
                                        }
                                    },
                                    yAxis: {
                                        title: {
                                            text: 'Horas'
                                        },
                                        min: 0.6,
                                        startOnTick: false
                                        //showFirstLabel: false
                                    },
                                    tooltip: {
                                        shared: true
                                    },
                                    legend: {
                                        enabled: false
                                    },credits: {
                                        enabled: false
                                    },
                                    plotOptions: {
                                        area: {
                                            fillColor: {
                                                linearGradient: [0, 0, 0, 300],
                                                stops: [
                                                    [0, Highcharts.getOptions().colors[0]],
                                                    [1, 'rgba(2,0,0,0)']
                                                ]
                                            },
                                            lineWidth: 1,
                                            marker: {
                                                enabled: false,
                                                states: {
                                                    hover: {
                                                        enabled: true,
                                                        radius: 5
                                                    }
                                                }
                                            },
                                            shadow: false,
                                            states: {
                                                hover: {
                                                    lineWidth: 1
                                                }
                                            }
                                        }
                                    },
                                    series: [
<?php
$num_reg = count($resrv_ciclo_total);
$c = 1;
$coma = ',';
echo '{' . PHP_EOL . '
type: \'area\',' . PHP_EOL . 'pointInterval: 24 * 3600 * 1000,' . PHP_EOL . '
pointStart: Date.UTC(2012, 01, 01),pointEnd: Date.UTC(2012, 06, 30),' . PHP_EOL . '
name: \'Horas\',' . PHP_EOL . '
data: [';
foreach ($resrv_ciclo_total as $key => $value) {
    $fecha = $key;
    if ($num_reg == $c) {
        echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . array_sum($value) . ']';
    } else {
        echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . array_sum($value) . '],';
    }
}
$c++;
echo ']}';
?>                  
                                                                
            ]
        });
    });

                        </script>
                        <div  class="ui-corner-all boxshadowround" style="width: 80%; height: 500px; margin: 0 auto" id="sala_rep">

                        </div>
                    </div>      <?php
foreach ($salas->result() as $sala) {
    ?>
                        <div id="tabs-s<?php echo $sala->idSala; ?>">
                            <script type="text/javascript">
                                var chart;
                                $(document).ready(function() {
                                                                                       
                                    chart = new Highcharts.Chart({
                                        chart: {
                                            renderTo: 'sala_rep1_<?php echo $sala->idSala; ?>',
                                            zoomType: 'x',
                                            spacingRight: 20
                                        },
                                        title: {
                                            text: 'Uso de las sala <?php echo $sala->Sala; ?> en el periodo actual (<?php echo $this->config->item('fecha_periodo_inicio') . ' - ' . $this->config->item('fecha_periodo_fin'); ?>)'
                                        },
                                        subtitle: {
                                            text: document.ontouchstart === undefined ?
                                                'Para hacer zoom en el gráfico, da click sobre este y sin soltar arrastra hata el completar el subperiodo deseado' :
                                                'Para hacer zoom en el gráfico, da click sobre este y sin soltar arrastra hata el completar el subperiodo deseado'
                                                                                                       
                                        },
                                        xAxis: {
                                            type: 'datetime',
                                            maxZoom: 14 * 24 * 3600000, // fourteen days
                                            title: {
                                                text: null
                                            }
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Horas'
                                            },
                                            min: 0.6,
                                            startOnTick: false
                                            //showFirstLabel: false
                                        },
                                        tooltip: {
                                            shared: true
                                        },
                                        legend: {
                                            enabled: false
                                        },
                                        credits: {
                                            enabled: false
                                        },
                                        plotOptions: {
                                            area: {
                                                fillColor: {
                                                    linearGradient: [0, 0, 0, 300],
                                                    stops: [
                                                        [0, Highcharts.getOptions().colors[0]],
                                                        [1, 'rgba(2,0,0,0)']
                                                    ]
                                                },
                                                lineWidth: 1,
                                                marker: {
                                                    enabled: false,
                                                    states: {
                                                        hover: {
                                                            enabled: true,
                                                            radius: 5
                                                        }
                                                    }
                                                },
                                                shadow: false,
                                                states: {
                                                    hover: {
                                                        lineWidth: 1
                                                    }
                                                }
                                            }
                                        },
                                        series: [
    <?php
    $num_reg = $salas->num_rows();
    $c = 1;
    $coma = ',';
    echo '{' . PHP_EOL . '
type: \'area\',' . PHP_EOL . 'pointInterval: 24 * 3600 * 1000,' . PHP_EOL . '
pointStart: Date.UTC(2012, 01, 01),pointEnd: Date.UTC(2012, 06, 30),' . PHP_EOL . '
name: \'' . $sala->Sala . '\',' . PHP_EOL . '
data: [';
    foreach ($datos_salas_full[$sala->idSala]->result() as $row) {
        $fecha = $row->fecha;
        if ($num_reg == $c) {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . ']';
        } else {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . '],';
        }
    }
    $c++;
    echo ']}';
    ?>                  
                                                                                                
                ]
            });
        });
                            </script>
                            <div  class="ui-corner-all boxshadowround" style="width: 80%; height: 500px; margin: 0 auto" id="sala_rep1_<?php echo $sala->idSala; ?>">

                            </div>
                        </div>
                    <?php }
                    ?>


                </div>
            </div>

        </div><!--Fin acc3-->

    </div><!--Fin accordion-->
</div><!--Fin row-->
<style>
    .oculto{
        display:none !important;
    }
    #accordion_tiporep .ui-state-focus{
        background-image: none !important;
    }
    #accordion_tiporep{
        margin: 30px;
        margin-top: 10px;
        width: auto !important;
    }
    .bar{
        margin-top: 10px;
        margin-left: 30px;
        margin-right: 30px;
    }
    .pad{padding: 5px !important;
         text-align: center !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $( "#tab_resumen_horas_mes,#tab_resumen_horas_per,#tabs_rep1_salas" ).tabs();
        $( "#accordion_tiporep" ).accordion({
            header: "h3",
            autoHeight: false,
            navigation: true
        });
        $('.detales_rep_mes_sem').html('<?php echo $detalles ?>');
        $('#btn_savepdf').click(function(){
            open_in_new('reportes/reporte_gral_uso');
        });
        $('#btn_savexls').click(function(){
            open_in_new('reportes/reporte_gral_uso_xls');
        });
        $('#calendario').datepicker({showWeek: true,firstDay: 1,numberOfMonths: 5,changeMonth: true,changeYear: true });
        $('#btn_calendario').click(function(){
            if($('#barra_calendario').hasClass('oculto')){
                $('#barra_calendario').removeClass('oculto');
            }else{
                $('#barra_calendario').addClass('oculto');
            }
        });
    });
    if ($.blockUI) {
        $.unblockUI();
    }
</script>
<?php
if ($permisos == '') {
    redirect('acceso/acceso_home/inicio');
} else {
    echo '<style type="text/css">' . $permisos . '</style>';
}
?>