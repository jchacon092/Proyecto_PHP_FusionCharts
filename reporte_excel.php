<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporteusuariosed.xls");


		$conexion=mysql_connect("localhost","root","");
		mysql_select_db("proyectofinal",$conexion);		


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTA DE USUARIOS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LA TABLA USUARIOS</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>CODIGO</strong></td>
    <td><strong>NOMBRE</strong></td>
    
  </tr>
  
<?PHP

			 
$sql=mysql_query("SELECT nombre_producto , cantidad_venta  FROM venta, producto, lote_producto ");
while($res=mysql_fetch_array($sql)){		

	$codigo=$res["nombre_producto"];
	$nombre=$res["cantidad_venta"];
						

?>  
 <tr>
	<td><?php echo $codigo; ?></td>
	<td><?php echo $nombre; ?></td>
	                   
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>