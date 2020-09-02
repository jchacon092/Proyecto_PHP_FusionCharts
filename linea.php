<?php
   include("fusioncharts.php");
   ?>
<html>

   <head>
  	<title>Real time charts with MySQL Data Stream</title>

  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  	<script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
  	<link rel="stylesheet" type="text/css" href="http://fc.gagansikri.in/workspace/fc-solutions/Samples/php/linecharts/style.css">
   </head>
   <body>
  	<?php

     	/* **Step 3:** Create a `columnChart` chart object using the FusionCharts PHP class constructor. Syntax for the constructor: `FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "data format", "data source")`   */

    	$realtimechart1 = new FusionCharts("realtimeline", "chart1" , "100%", "300", "container1", "json",
            '{
    "chart": {
    "caption": "Server A",
    "canvasBorderThickess": "0.5",
        "manageresize": "1",
        "bgcolor": "FFFFFF",
        "bgalpha": "100",
        "canvasbgcolor": "FFFFFF",
        "decimals": "0",
        "numdivlines": "5",
        "numvdivlines": "15",
        "numdisplaysets": "20",
        "divlinealpha": "100",
        "chartleftmargin": "10",
        "baseFont": "Lato",
        "showAlternateHGridColor": "1",
        "basefontcolor": "000000",
        "showrealtimevalue": "0",
        "datastreamurl": "consulta.php",
        "refreshinterval": "2",
        "slantlabels": "0",
        "basefontsize": "11",
        "showalternatehgridcolor": "0",
        "showlabels": "1",
        "showborder": "1",
        "showLegend": "0",
        "yAxisMaxValue": "30",
        // tooltip configuration
        "toolTipBgColor": "#000",
        "toolTipPadding": "15",
        "toolTipBorderRadius": "3",
        "toolTipBorderThickness": "1",
        "toolTipBorderColor": "008040",
        "toolTipBgAlpha": "70",
        "showPercentValueInToolTip": "1",
        "toolTipFontSize": "20",
        "showLegend": "0",
        "plotToolText": "<div style=\'color:#FFF; font-size: 16px; text-align:center; line-height: 1.8; \'>$seriesname <br> $label: $value%</div>"
    },
    "categories": [
        {
            "category": [
                {
                    "label": "Start"
                }
            ]
        }
    ],
    "dataset": [
        {
            "color": "#0074C1",
            "seriesname": "Processor A",
            "showvalues": "0",
            "alpha": "100",
            "linethickness": "3",
            "drawAnchors": "1",
        	"anchorRadius": "2",
            "data": [
                {
                    "value": "0"
                }
            ]
        }
    ]
}'
    );



     	$realtimechart1->render();

     	
  	?>
  	<div id="container1"><!-- Fusion Charts will render here--></div>
  	<br>
  	<div id="dock">
  	<div id="container2"><!-- Fusion Charts will render here--></div>
  	<div id="container3"><!-- Fusion Charts will render here--></div>
  	</div>
   </body>
</html>