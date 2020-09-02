<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="tcal.js"></script>  
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
 <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>

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
		&nbsp;<br>
		<!-- Start of main content -->
		<div id="Body">
			<fieldset>
			
			
			<?php


    include("fusioncharts.php");
    include("conexion.php");
              
              ?>

	<?php

/*
 * Código para mostrar datos dinámicamente en un combobox.
 */

include("conexion.php");
 $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");

$query = 'SELECT * FROM departamento';

$result = $conexion->query($query);

?>
<form id="form1" method="POST" action="index7.php" enctype="multipart/form-data">
Seleccione un tipo de producto a buscar:
<select name="nom" id="nom">   

    <?php    
    while ( $row = $result->fetch_array() )    
    {
        ?>
   
        <option value="<?php echo $row['nombre'] ?>"  >
        <?php echo $row['nombre']; ?>
        </option>
       
        <?php
    }    
    ?>       
</select>




				<input type="submit" name="enviar"><br><br>
</form>

	
				<div id="chart">

			
    
              <?php

              $parar=$_POST ['nom'];

    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$parametro=$parar;

$stringQuerry = "SELECT punteo_indicador.puntaje, indicadores.nombre_indicador, departamento.nombre, punteo_indicador.fechapunteo FROM punteo_indicador INNER JOIN indicadores ON punteo_indicador.id_indicador = indicadores.id_indicador INNER JOIN departamento ON departamento.id_departamento = punteo_indicador.id_departamento WHERE departamento.nombre = '$parametro' and YEAR(fechapunteo) BETWEEN '2017-01-01' AND CURDATE() ";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
if($result)
    {
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")

$arrData = array( 
                "chart" => array(
                  "caption"=>"Puntaje por indicadores",
                  "subCaption"=>"En el ultimo año: $parametro",
                  "exportEnabled "=> "1",
                  "theme"=>"ocean"
               )
      );
    $arrData["data"] = array();
    while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["nombre_indicador"],
                "value" => $row["puntaje"]
                )
            );
// Render the chart
        }
    }
              $json = json_encode($arrData);
              $columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart", "json", $json);
$columnChart->render();
   $dbhandle ->close();

  ?>


<!---chart de otro depto-->



			
    
              <?php

              $parar=$_POST ['nom2'];

    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$parametro=$parar;

$stringQuerry = "SELECT punteo_indicador.puntaje, indicadores.nombre_indicador, departamento.nombre, punteo_indicador.fechapunteo FROM punteo_indicador INNER JOIN indicadores ON punteo_indicador.id_indicador = indicadores.id_indicador INNER JOIN departamento ON departamento.id_departamento = punteo_indicador.id_departamento WHERE departamento.nombre = '$parametro' and YEAR(fechapunteo) BETWEEN '2017-01-01' AND CURDATE() ";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
if($result)
    {
// Create the chart - Column 2D Chart with data given in constructor parameter 
// Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")

$arrData = array( 
                "chart" => array(
                  "caption"=>"Puntaje por indicadores",
                  "subCaption"=>"En el ultimo año: $parametro",
                  "exportEnabled "=> "1",
                  "theme"=>"ocean"
               )
      );
    $arrData["data"] = array();
    while($row = mysqli_fetch_array($result)) {
            array_push($arrData["data"], array(
                "label" => $row["nombre_indicador"],
                "value" => $row["puntaje"]
                )
            );
// Render the chart
        }
    }
              $json = json_encode($arrData);
              $columnChart = new FusionCharts("column2d", "ex1", "100%", 400, "chart", "json", $json);
$columnChart->render();
   $dbhandle ->close();

  ?>
			</div>



					
			</fieldset>
			
	</div>

	<div id="Footer">
		Copyright © Your Company Name | Template created by <a href="http://pdp.protopak.net/">Darth Exterus</a> | Valid XHTML | Valid CSS
	</div>
</div>

</body></html>