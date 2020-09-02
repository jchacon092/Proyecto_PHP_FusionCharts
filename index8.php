

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <script src="https://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
        <script src="https://static.fusioncharts.com/code/latest/fusioncharts.charts.js"></script>
        <script src="https://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.zune.js"></script>
        <script type="text/javascript" src="tcal.js"></script>  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>

    	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="tcal.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
    <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Envasadora s.a</title>
<link rel="stylesheet" type="text/css" href="index_data/Styles.css">
</head>


<body background="index_data/fondo.jpg">
<div id="Container">
	<div id="Header">
		<img class="glov" src="index_data/envase.jpg" id="Holo" alt="">
		<table>
		<tbody><tr>
		<td id="Title">Bienvenido a la pagina principal "Envasadora el Sol": podra ver estadisticas de produccion de envases</td>
		</tr>
		<tr>
		<td><div id="Subtitle">Bienvenido a nuestro sitio<br>
		aqui encontraras todo respecto a la producion de envases!</div></td>
		</tr>
		</tbody></table>	
	</div>
	<div id="TopMenu">
	</div>
	<div id="Menu">
		<ul>
		<li>Enlaces a opciones y estadisticas...
		</li>
		<li><a href="index.php">Pagina principal</a></li>
		<li> <a href="index1.php">Inventario general</a>

		</li>
		<li> <a href="index3.php">Grafica por tipo de pago</a>
		</li>
		<li><a href="index2.php">Lotes de produccion</a>
		</li>
		</ul>
	</div>
	<div id="BodyContainer">
		<br>
		<!-- Start of main content -->
		<div id="Body">
			<fieldset>
			<legend>Grafica de pie, tipo de pago</legend>
			<form action="index8.php" method="POST">
				Ingrese fecha inicial: <input type="date" class="tcal" name="fecha1"  value= "<?php echo date('d/m/Y');?>"><br><br>
				Ingrese fecha final: <input type="date" class="tcal" name="fecha2" value= ""><br> <br>
				<input type="hidden" id="formsend" name="formsend" value="true">
				<input type="submit" name="enviar"><br><br>
			</form>

			
<?php


   
 include("fusioncharts.php");
    include("conexion.php");

   
			 $fechainicio = $_POST['fecha1'];
			 $fechafin = $_POST['fecha2'];

?>

<form method="POST" action="reporte_pdf3.php">

                                          <input type="hidden" id="fecha1" name="fecha1" value='<?php echo $fechainicio; ?>' >
                                          <input type="hidden" id="fecha2" name="fecha2" value='<?php echo $fechafin; ?>' >
				Exportar Reportes en PDF:<input type=image src="imagenes/pdf.png" width="25" height="25">
				                       

			</form>
				<div id="chart">

<?php
    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$stringQuerry = "SELECT DISTINCT venta.id_tipopago, venta.Cantidad_venta, tipo_pago.Descripcion_tipo  FROM venta inner join tipo_pago on venta.id_tipopago = tipo_pago.id_tipopago WHERE fecha_venta BETWEEN '$fechainicio' and '$fechafin'";
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
                   "xaxisname"=> "Month",
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
          	echo $row["Descripcion_tipo"];
            array_push($categoryArray, array(
            "label" => $row["Descripcion_tipo"]
          )
        );
      /*  array_push($dataseries1, array(
          "value" => $row["cantidad"]
          )
        );*/
         array_push($dataseries2, array(
          "value" => $row["Cantidad_venta"]
          )
        );
       /* array_push($dataseries3, array(
          "value" => $row["cantidad3"]
          )
        );*/
      }

      $arrData["categories"]=array(array("Descripcion_tipo"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(/*array("seriesName"=> "Actual Revenue", "data"=>$dataseries1),*/ array("seriesName"=> "Projected Revenue",  "renderAs"=>"line", "data"=>$dataseries2)/*,array("seriesName"=> "Profit",  "renderAs"=>"area", "data"=>$dataseries3)*/);


     /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */
      $jsonEncodedData = json_encode($arrData);

      // chart object
      /*$msChart = new FusionCharts("mscombi2d", "chart1" , "600", "350", "chart-container", "json", $jsonEncodedData);*/
      $realtimechart1 = new FusionCharts("realtimeline", "chart1" , "100%", "300", "container1", "json",  $jsonEncodedData);

      // Render the chart
      $realtimechart1->render();
   	  $conexion ->close();

   }
  ?>
			</div>
			</fieldset>
			
	</div>
	<div id="Footer">
		Copyright © Your Company Name | Template created by <a href="http://pdp.protopak.net/">Darth Exterus</a> | Valid XHTML | Valid CSS
	</div>
</div>

</body></html>



