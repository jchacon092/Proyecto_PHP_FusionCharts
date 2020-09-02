<?php

 include("conexion.php");
              


  $conexion = mysqli_connect($servidor,$user,$pw,$db) or 
    die("la cadena tiene algo malo");
    if (!$conexion) 
    {
    die("Conexion fallida: " . mysqli_connect_error());
}
$stringQuerry = "SELECT DISTINCT nombre, cantidad, cantidad2, cantidad3 FROM pilar";
$result = $conexion->query($stringQuerry) or exit("Error code ({$conexion->errno}): {$conexion->error}");
/*$conexion = new mysqli($host_db, $user_db, $pass_db, $name_db);

if ($dbhandle->connect_error) {
  exit("There was an error with your connection: ".$dbhandle->connect_error);
}

// fetching data from DB
$strQuery = "SELECT DISTINCT logtime, logvalue FROM realtimelinedemo; ";

$result = $dbhandle->query($strQuery) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");*/

if ($result) {
	
	// storing query result in array
	$data1 = array();
	$data2 = array();
	while($row = mysqli_fetch_array($result))
	{

    	echo "&label=". $data1[] = $row["nombre"];
    	echo "&value=". $data2[] = $row["cantidad"];
 
   	
	}
	echo "&label=". $data1[] = $row["nombre"] ."&value=". $data2[] = $row["cantidad"];

	


    $conexion->close();
	
}

?>