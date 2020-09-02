<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
		&nbsp;<br>
		<!-- Start of main content -->
		<div id="Body">
		<h2>Inventario general: <br> Productos existentes</h2>
		
<form method="POST" action="reporte_pdf1.php">

                                          
                Exportar Reportes en PDF:<input type=image src="imagenes/pdf.png" width="25" height="25">
                                       

            </form>
			
			<?php


    include("fusioncharts.php");
    include("conexion.php");

    



    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$stringQuerry = "SELECT producto.id_producto, producto.Nombre_producto, producto.Existencias, tipo_producto.Descripcion_tipoproducto from producto inner join tipo_producto on producto.id_tipoproducto = tipo_producto.id_tipoproducto inner join lote_producto on lote_producto.id_producto = producto.id_producto order by producto.Existencias desc";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
			 if(!$result)

     {

     	printf("Error: %s\n", mysqli_error($conexion));

     	exit();

     }

     echo "<table border ='1'>

            <tr> 

              <th>Codigo de producto</th> <th>Nombre</th> <th>Producto existente</th> <th>Tipo de producto</th>

            </tr>";

     while( $fila = mysqli_fetch_array($result, MYSQLI_BOTH))

     {

     	   echo "<tr>";

     	   echo "<td>" . $fila['id_producto']. "</td>";

            echo "<td>" . $fila['Nombre_producto']. "</td>";

            echo "<td>" . $fila['Existencias']. "</td>";

           echo "<td>" . $fila['Descripcion_tipoproducto']. "</td>";
     

            echo " </tr>";

     }

     echo "</table>";


 

  
  ?>

 <h1>Inventario por tipo de producto</h1>
        

 <?php

/*
 * Código para mostrar datos dinámicamente en un combobox.
 */

include("conexion.php");
 $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");

$query = 'SELECT * FROM tipo_producto';

$result = $conexion->query($query);

?>
<form id="form1" method="POST" action="index1.php" enctype="multipart/form-data">
Seleccione un tipo de producto a buscar:
<select name="produc" id="produc">   

    <?php    
    while ( $row = $result->fetch_array() )    
    {
        ?>
   
        <option value="<?php echo $row['Descripcion_tipoproducto'] ?>"  >
        <?php echo $row['Descripcion_tipoproducto']; ?>
        </option>
       
        <?php
    }    
    ?>       
</select>

				<input type="submit" name="enviar"><br><br>
</form>
<?php


$parar=$_POST ['produc'];

include("conexion.php");



$conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}

$parametro=$parar; 

?>
<form method="POST" action="reporte_pdf2.php">

                                          <input type="hidden" id="fecha2" name="fecha2" value='<?php echo $parametro; ?>' >
                Exportar Reportes en PDF:<input type=image src="imagenes/pdf.png" width="25" height="25">
                                       

            </form>

<?php



$stringQuerry = "SELECT producto.id_producto, producto.Nombre_producto, producto.Existencias, tipo_producto.Descripcion_tipoproducto from producto inner join tipo_producto inner join lote_producto WHERE producto.id_tipoproducto = tipo_producto.id_tipoproducto and lote_producto.id_producto = producto.id_producto and tipo_producto.Descripcion_tipoproducto like '%$parametro%'";

$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");

    // Syntax for the constructor - new FusionCharts("type of chart", "unique chart id", "width of chart", "height of chart", "div id to render the chart", "type of data", "actual data")
			 if(!$result)

     {

     	printf("Error: %s\n", mysqli_error($conexion));

     	exit();

     }

     echo "<table border ='1'>

            <tr> 

              <th>Codigo de producto</th> <th>Nombre</th> <th>Producto existente</th> <th>Tipo de producto</th>

            </tr>";

     while( $fila = mysqli_fetch_array($result, MYSQLI_BOTH))

     {

     	   echo "<tr>";

     	   echo "<td>" . $fila['id_producto']. "</td>";

            echo "<td>" . $fila['Nombre_producto']. "</td>";

            echo "<td>" . $fila['Existencias']. "</td>";

           echo "<td>" . $fila['Descripcion_tipoproducto']. "</td>";
     

            echo " </tr>";

     }

     echo "</table>";


 

    
?>

		

			
		<!-- End of main content -->
	</div>
	<div id="Footer">
		Copyright © Your Company Name | Template created by <a href="http://pdp.protopak.net/">Darth Exterus</a> | Valid XHTML | Valid CSS
	</div>
</div>

</body></html>



