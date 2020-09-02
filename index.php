    <html>

    <head>
        <title>FusionCharts | Multi-Series Chart using PHP and MySQL</title>
        <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="https://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
        <script src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.zune.js"></script>
        <script type="text/javascript" src="tcal.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>

    	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    </head>

    <body>
			
			<?php


    include("fusioncharts.php");
    include("conexion.php");
              
             
			/*$fechainicio = $_POST['fecha1'];
			 $fechafin = $_POST['fecha2'];*/
              ?>
<!--<form method="POST" action="reporte_pdf.php">

                                          <input type="hidden" id="fecha1" name="fecha1" value='<?php /*echo*/ $fechainicio; ?>' >
                                          <input type="hidden" id="fecha2" name="fecha2" value='<?php /*echo*/ $fechafin; ?>' >
				Exportar Reportes en PDF:<input type=image src="imagenes/pdf.png" width="25" height="25">
				                       

			</form>-->

				<div id="chart">
    
              <?php
    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$stringQuerry = "SELECT  nombre, cantidad, cantidad2, cantidad3 FROM pilar;";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
if($result)
    {
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")

$arrData = array( 
                "chart" => array(
                  "caption"=>"Unidades producidas: entre fechas",
                  "subCaption"=>"por tipo de envase",
                   "xaxisname"=> "Mes",
        		   "yaxisname"=> "Cantidad producida",
        		   "numberPrefix"=> "Q",
        		   "legendItemFontColor"=> "#666666",
                  "exportEnabled "=> "1",
                  "theme"=>"zune"
               )
      );

	 	  $categoryArray=array();
         /* $dataseries1=array();*/
          $dataseries2=array();
         /* $dataseries3=array();*/

 // pushing category array values
          while($row = mysqli_fetch_array($result)) {
          	echo $row["nombre"];
            array_push($categoryArray, array(
            "label" => $row["nombre"]
          )
        );
      /*  array_push($dataseries1, array(
          "value" => $row["cantidad"]
          )
        );*/
         array_push($dataseries2, array(
          "value" => $row["cantidad3"]
          )
        );
       /* array_push($dataseries3, array(
          "value" => $row["cantidad3"]
          )
        );*/
      }

      $arrData["categories"]=array(array("nombre"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(/*array("seriesName"=> "Actual Revenue", "data"=>$dataseries1),*/ array("seriesName"=> "Pilares al año",  "renderAs"=>"line", "data"=>$dataseries2)/*,array("seriesName"=> "Profit",  "renderAs"=>"area", "data"=>$dataseries3)*/);


     /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      $msChart = new FusionCharts("mscombi2d", "chart1" , "600", "350", "chart-container", "json", $jsonEncodedData);

      // Render the chart
      $msChart->render();
   	  $conexion ->close();

   }
  ?>
            <center>
                <div id="chart-container">Chart will render here!</div>
            </center>
    </body>

    </html>