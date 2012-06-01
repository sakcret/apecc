<?php
//parsear lso resultados de la consulta en un arreglo indizado por fecha y sala
foreach ($datos_salas->result() as $row) {
    $resrv_ciclo[$row->fecha][$row->sala] = array('sala' => $row->sala, 'horas' => $row->horas);
}

foreach ($resrv_ciclo as $k => $v) {
    $resrv_ciclo_total[$k] = array();
    foreach ($v as $key => $value) {
        array_push($resrv_ciclo_total[$k], $value['horas']);
    }
}
?>
<div class="row">
    <br>
    <div style=" margin-left: 10px; margin-bottom: 10px; padding: 1px;" class="threecol ui-widget-content ui-corner-all boxshadowround">
        <img src="./images/logo_apecc_hd.png">
    </div>
    <div class="sixcol ui-corner-all ui-widget-content boxshadowround">
        <div id="" align="center" Style="margin: 5px; padding: 5px;" class="ui-corner-all ui-widget-header boxshadowround">
            Informaci&oacute;n
        </div><div style="padding: 8px">
            <h1 class="dotted_title" style="font-size: 16px !important;">Bienvenido ! &nbsp;&nbsp;&nbsp;&nbsp;"
                <?php
                $nom_u = $this->session->userdata('nombre');
                if (($nom_u != '')) {
                    echo $nom_u;
                } else {
                    echo $this->session->userdata('login');
                }
                ?> "</h1>
            <div class="dotted_title" style=" margin-top: 8px; text-align: left !important">
                <table class="tb_info">
                    <tr>
                        <td colspan="2">
                            <b>APECC &nbsp;<?php echo $this->config->item('sis_version'); ?></b><br><b>A</b>utomatizaci&oacute;n de <b>P</b>rocesos <b>E</b>n el <b>C</b>entro de <b>C</b>omputo

                            <hr class=" boxshadowround">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Periodo actual:&nbsp;</b></td>
                        <td><?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?></td>
                    </tr>
                    <tr>
                        <td><b>Costo de las reservaciones Momentaneas:&nbsp;</b> </td>
                        <td>$<?php echo $this->config->item('costoxhora'); ?>&nbsp;m/n </td>
                    </tr>
                    <tr>
                        <td><b>Encargados del Centro de Computo:&nbsp;</b> </td>
                        <td><?php
                $encargados = $this->config->item('sis_encargados_cc');
                if (count($encargados) > 0) {
                    foreach ($encargados as $e) {
                        echo $e . '<br>';
                    }
                }
                ?> </td>
                    </tr>
                </table>
                <?php ?>
            </div>
        </div>
    </div>
    <div class="threecol last ui-corner-all ui-widget-content boxshadowround">
        <div id="" align="center" Style="margin: 5px; padding: 5px;" class="ui-corner-all ui-widget-header boxshadowround">Calendario</div>
        <div style="padding: 8px">
            <div class=" ui-widget-content ui-corner-all"><div id="calendario"></div></div>
        </div>
    </div>

</div>
<div class="row">
    <div class="twelvecol last ui-corner-all ui-widget-content boxshadowround" style="margin: 10px; width: 98%; ">
        <div style=" padding: 20px">
            <div  id="datos_act_asign" class="ui-grid ui-widget ui-widget-content ui-corner-all"  style=" width: 98%">
                <div class="ui-grid-header ui-widget-header ui-corner-top" >Actividades para hoy</div>

                <?php
                $tmpl = array(
                    'table_open' => '<table id="tb_permisos" class="ui-grid-content ui-widget-content" style=" width: 100%" >',
                    'heading_row_start' => '<tr>',
                    'heading_row_end' => '</tr>',
                    'heading_cell_start' => '<th class="ui-widget-header">',
                    'heading_cell_end' => '</th>',
                    'row_start' => '<tr>',
                    'row_end' => '</tr>',
                    'cell_start' => '<td class="ui-widget-content">',
                    'cell_end' => '</td>',
                    'row_alt_start' => '<tr>',
                    'row_alt_end' => '</tr>',
                    'cell_alt_start' => '<td class="ui-widget-content">',
                    'cell_alt_end' => '</td>',
                    'table_close' => '</table>'
                );
                $this->table->set_template($tmpl);
                $this->table->set_heading('Actividad', 'Tipo de <br>Actividad', 'Encargado', 'Hora de<br> inicio', 'Hora de<br> fin', 'Sala', 'Bloque<br>/Secci&oacute;n', 'Fecha<br> Inicio', 'Fecha<br> Fin');
                echo $this->table->generate($datos_rsf);
                ?>
                <div class="ui-grid-footer ui-widget-header ui-corner-bottom ui-helper-clearfix" style=" font-size: 8px !important;">
                    <?php
                    if ($datos_rsf->num_rows() == 0) {
                        echo '<h3 class=" round_div"><img src="./images/warning.png" alt=" ">&nbsp;No se encontraron resultados</h3>';
                    } else {
                        echo '<center align="center" style="text-align: center !important;"> <b>Resultado: ' . $datos_rsf->num_rows() . ' actividades para hoy.</b></center>';
                    }
                    ?>&nbsp;
                </div></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="twelvecol last ui-corner-all ui-widget-content boxshadowround" style="margin: 10px; width: 98%; ">
        <div style=" padding: 20px">
            <div id="grafico"> 
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
                                text: 'Uso del Centro de Computo en el Periodo Actual (<?php echo $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_inicio')) . ' - ' . $this->utl_apecc->getdate_SQL($this->config->item('fecha_periodo_fin')); ?>)'
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
                <div  class="ui-corner-all boxshadowround" style="width: 99%; height: 300px; margin: 0 auto" id="sala_rep">

                </div>
            </div>  
        </div>
    </div>
</div>
<br>
<br>
<script type="text/javascript">
    $(document).ready(function() {
        $("#calendario").datepicker({showWeek: true,firstDay: 1,changeMonth: true,changeYear: true });
  
    });
</script>
<style>
    .dotted_title{
        border-collapse: collapse;
        border: 1px solid #666666 !important;     
        border-style: dotted !important;
        border-radius: 10px;
        padding: 3px;
        text-align:center !important;
    }
    .tb_info td{
        padding-left: 10px;
    }
</style>