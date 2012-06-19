<script type="text/javascript">
    // On document ready, call visualize on the datatable.
    $(document).ready(function() {
        Highcharts.visualize = function(table, options) {
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

        var table = $('#datatable'),
        options = {
            chart: {
                renderTo: 'container2',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Data extracted from a HTML table in the page'
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Units'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };

        Highcharts.visualize(table, options);
    });

</script>
<br>
<div id="container2" class="ui-corner-all boxshadowround" style="width: 1000px; height: 500px; margin: 0 auto"></div>

<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<th>Jane</th>
			<th>John</th>
			<th>John</th>
			<th>John</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Apples</th>
			<td>3</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Pears</th>
			<td>2</td>
			<td></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<th>Plums</th>
			<td>5</td>
			<td>11</td>
			<td>11</td>
			<td>11</td>
		</tr>
		<tr>
			<th>Bananas</th>
			<td>1</td>
			<td>1</td>
			<td>1</td>
			<td>1</td>
		</tr>
		<tr>
			<th>Oranges</th>
			<td>2</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
		</tr>
		<tr>
			<th>Oranges</th>
			<td>2</td>
			<td>4</td>
			<td>4</td>
			<td>4</td>
		</tr>
	</tbody>
</table>
<br>

<?php
$num_reg = $salas->num_rows();
$c = 1;
$coma = ',';
foreach ($salas->result() as $sala) {
    echo '{' . PHP_EOL . 'name: \'' . $sala->Sala . '\',' . PHP_EOL . '
                    data: [';
    foreach ($datos_salas[$sala->idSala]->result() as $row) {
        $fecha = $row->fecha;
        if ($num_reg == $c) {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . ']';
        } else {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . '],';
        }
    }
    $c++;
    echo ']}' . $coma . PHP_EOL;
}

?>


<script type="text/javascript">
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'graf',
                defaultSeriesType: 'area'
            },
            title: {
                text: 'USO DEL CENTRO DE COMPUTO POR SALA'
            },
            subtitle: {
                text: 'Da click sobre el nombre de la sala para filtrar gráfico'
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: '# Reservaciones'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        Highcharts.dateFormat('%e. %b', this.x) +': '+ this.y +' Reservaciones';
                }
            },
            series: [
<?php
$num_reg = $salas->num_rows();
$c = 1;
$coma = ',';
foreach ($salas->result() as $sala) {
    echo '{' . PHP_EOL . 'name: \'' . $sala->Sala . '\',' . PHP_EOL . '
                    data: [';
    foreach ($datos_salas[$sala->idSala]->result() as $row) {
        $fecha = $row->fecha;
        if ($num_reg == $c) {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . ']';
        } else {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . '],';
        }
    }
    $c++;
    echo ']}' . $coma . PHP_EOL;
}
?>                  
                    
            ]
        });
    });

</script>
<script type="text/javascript">
    var chart;
    $(document).ready(function() {
        $('#tabs_rep1_salas').tabs();
        
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'area_rep',
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'USD to EUR exchange rate from 2006 through 2008'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
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
                    text: 'Exchange rate'
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
foreach ($salas->result() as $sala) {
    echo '{' . PHP_EOL . '
        type: \'area\',
			
                        pointInterval: 24 * 3600 * 1000,
                        pointStart: Date.UTC(2006, 0, 01),
        name: \'' . $sala->Sala . '\',' . PHP_EOL . '
                    data: [';
    foreach ($datos_salas[$sala->idSala]->result() as $row) {
        $fecha = $row->fecha;
        if ($num_reg == $c) {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . ']';
        } else {
            echo '[Date.UTC(' . substr($fecha, 0, 4) . ',' . substr($fecha, 5, 2) . ',' . substr($fecha, 8, 2) . '), ' . $row->cuantas . '],';
        }
    }
    $c++;
    echo ']}' . $coma . PHP_EOL;
}
?>                  
                    
            ]
        });
    });

</script>
<br>
<div id="graf" style="width: 93%; height: 500px; margin: 0 auto" class="ui-corner-all boxshadowround"></div>
<br>
<div id="area_rep" style="width: 800px; height: 400px; margin: 0 auto" class="ui-corner-all boxshadowround"></div>
<hr class=" boxshadowround">

<div id="tabs_rep1_salas">
    <ul>
        <?php
        foreach ($salas->result() as $sala) {
            echo '<li><a href="#tabs-s' . $sala->idSala . '">' . $sala->Sala . '</a></li>';
        }
        ?>
    </ul>
    <?php
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
                                text: 'Número de Reservaciones'
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
    foreach ($datos_salas[$sala->idSala]->result() as $row) {
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
<br>
