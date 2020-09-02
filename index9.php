<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="tcal.js"></script>  
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
 <script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.ocean.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title></title>
</head>
<body>

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
<form id="form1" method="POST" action="index9.php" enctype="multipart/form-data">
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


  ?>


<?php

/*
 * Código para mostrar datos dinámicamente en un combobox.
 

include("conexion.php");
 $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");

$query = 'SELECT * FROM departamento';

$result = $conexion->query($query);

?>

<form id="form2" method="POST" action="index9.php" enctype="multipart/form-data">
Seleccione un tipo de producto a buscar:
<select name="nom2" id="nom2">   

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


			
    
              

<!---chart de otro depto-->



			
    
              <?php

              $parar1=$_POST ['nom2'];

    $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$parametro1=$parar1;

$stringQuerry = "SELECT punteo_indicador.puntaje, indicadores.nombre_indicador, departamento.nombre, punteo_indicador.fechapunteo FROM punteo_indicador INNER JOIN indicadores ON punteo_indicador.id_indicador = indicadores.id_indicador INNER JOIN departamento ON departamento.id_departamento = punteo_indicador.id_departamento WHERE departamento.nombre = '$parametro1' and YEAR(fechapunteo) BETWEEN '2017-01-01' AND CURDATE() ";
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


  */?>

</body>
</html>