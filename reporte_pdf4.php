<?php
 
		require_once("dompdf/dompdf_config.inc.php");
		$conexion=mysql_connect("localhost","root","");
		mysql_select_db("proyectofinal",$conexion);


$codigoHTML='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE LOTES</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>Nombre_producto</strong></td>
    <td><strong>fecha_ingreso</strong></td>
    <td><strong>cantidad</strong></td>
    <td><strong>cantidad_usada</strong></td>
  </tr>';
  
$parar=$_POST ['fecha2'];
$parametro=$parar; 



$sql=mysql_query("SELECT producto.Nombre_producto, lote_producto.fecha_ingreso,lote_producto.cantidad, produccion.cantidad_usada from producto, lote_producto, produccion, materia_prima where producto.id_producto = lote_producto.id_lote and lote_producto.id_produccion = produccion.id_produccion and produccion.id_materiaprima = materia_prima.id_materiaprima  order by produccion.cantidad_usada desc");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['Nombre_producto'].'</td>
		<td>'.$res['fecha_ingreso'].'</td>
		<td>'.$res['cantidad'].'</td>
		<td>'.$res['cantidad_usada'].'</td>										
	</tr>';
	
}
$codigoHTML.='
</table>
</body>
</html>';
$codigoHTML=utf8_encode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Reporteusuarios.pdf");
?>