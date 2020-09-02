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
	</div>
	<div id="BodyContainer">
		<br>
		<!-- Start of main content -->
		<div id="Body">
			<fieldset>
			<legend>Lotes de produccion: detalle</legend>
			<form method="POST" action="reporte_pdf4.php">

                                          
                Exportar Reportes en PDF:<input type=image src="imagenes/pdf.png" width="25" height="25">
                                       

            </form>

			<?php



    include("conexion.php");


    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$stringQuerry = "SELECT producto.Nombre_producto, lote_producto.fecha_ingreso,lote_producto.cantidad, produccion.cantidad_usada from producto, lote_producto, produccion, materia_prima where producto.id_producto = lote_producto.id_lote and lote_producto.id_produccion = produccion.id_produccion and produccion.id_materiaprima = materia_prima.id_materiaprima  order by produccion.cantidad_usada desc";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
			 if(!$result)

     {

     	printf("Error: %s\n", mysqli_error($conexion));

     	exit();

     }

     echo "<table border ='1'>

            <tr> 

              <th>Nombre del producto</th> <th>Fecha de ingreso</th> <th>Cantidad de lote</th> <th>Cantidad utilizada</th>

            </tr>";

     while( $fila = mysqli_fetch_array($result, MYSQLI_BOTH))

     {

     	   echo "<tr>";

     	   echo "<td>" . $fila['Nombre_producto']. "</td>";

            echo "<td>" . $fila['fecha_ingreso']. "</td>";

            echo "<td>" . $fila['cantidad']. "</td>";

           echo "<td>" . $fila['cantidad_usada']. "</td>";
     

            echo " </tr>";

     }

     echo "</table>";




  ?>
			</div>
			</fieldset>
			
	
	<div id="Footer">
		Copyright © Your Company Name | Template created by <a href="http://pdp.protopak.net/">Darth Exterus</a> | Valid XHTML | Valid CSS
	</div>
</div>

</body></html>