<html>
    <head>
        <base href= "<?php echo $this->config->item('base_url'); ?>">
        <title>Acceso denegado</title>
        <meta name="author" content="CGT">
        <meta http-equiv="content-type" CONTENT="text/html; charset=utf-8">
        <link rel="shortcut icon" href="./images/favicon.ico">
        <link rel="stylesheet" href="./css/cssgrid1140/1140.css" type="text/css"/>
        <link rel="stylesheet" href="./css/cssgrid1140/styles.css" type="text/css"/>
        <script type="text/javascript" language="javascript" src="./js/cssgrid1140/css3-mediaqueries.js"></script>
        <link rel="stylesheet" href="./css/jquery-ui/jquery-ui-1.8.20.custom.css">
        <link rel="stylesheet" href="./css/jquery-ui/jquery.ui.base.css">
        <link rel="stylesheet" href="./css/extensiones_jqueryui.css">
         <script type="text/javascript" language="javascript" src="./js/jquery-1.7.2.js"></script>
        <script type="text/javascript" language="javascript" src="./js/jquery.blockUI.js"></script>
        <script type="text/javascript" language="javascript" src="./js/utilerias.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo $this->config->item('base_url'); ?>';
            var cuentaInicial = "5";
            function unoMenos() {
                cuentaInicial--;
                $('#redic_sec').text(cuentaInicial);
                if(cuentaInicial==0){
                    redirect_to('<?php echo $url;?>');
                }
                setTimeout("unoMenos()", 1000);
            }
            function init_count_redirect() {
                
                setTimeout("unoMenos()", 1000);
            }
        </script>
        <style>
            .boxshadowround{
                box-shadow: 0 0 10px #999;
                -webkit-box-shadow: 0 0 10px #999;
                -moz-box-shadow: 0 0 10px #999;
            }
            #redirect_now{
                float: right; margin-right: 30px; width: 250px; height: 50px; margin-bottom: 20px; 
            }
        </style>
    </head>
    <body onLoad="init_count_redirect();">
        <div class="container">
            <div class="row">
                <div class="ui-widget-content ui-corner-all last boxshadowround" style="margin: 15px; margin-top: 20%">
                    <table width="100%" border="0">
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td rowspan="2"><img style="float: left; margin-top: 10px; margin-bottom: 10px;" src="./images/acceso/lock.png"/>
                            </td>
                            <td colspan="2"><div style="color: #581313; margin-top: 10px; font-size:70px; float: left;">&nbsp;Acceso denegado !</div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><div style="margin-top: 10px; margin-left: 20px; color: #581313; font-size:25px; float: left;">Redireccionando a la p&aacute;gina de inicio en:&nbsp;&nbsp;<span style="float: none; font-weight: bolder;" id="redic_sec">5</span>&nbsp;&nbsp;Segundos</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td>
                                <button id="redirect_now" class="ui-button ui-widget ui-widget-content ui-corner-all" onclick="redirect_to('<?php echo $url;?>')"><b>Redireccionar Ahora</b></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>