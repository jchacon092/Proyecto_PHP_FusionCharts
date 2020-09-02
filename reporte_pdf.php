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
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE PRODUCTOS VENDIOS</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>nombre_producto</strong></td>
    <td><strong>cantidad_venta</strong></td>
    
    
  </tr>';
  
$fechainicio = $_POST['fecha1'];
$fechafin = $_POST['fecha2'];


$sql=mysql_query("SELECT producto.nombre_producto, venta.cantidad_venta FROM venta, producto, lote_producto where venta.id_lote = lote_producto.id_lote and producto.id_producto = lote_producto.id_producto and  fecha_venta between '$fechainicio' and '$fechafin'");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['nombre_producto'].'</td>
		<td>'.$res['cantidad_venta'].'</td>										
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