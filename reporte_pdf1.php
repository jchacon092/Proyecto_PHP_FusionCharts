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
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE PRODUCTOS EXISTENTES</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>id_producto</strong></td>
    <td><strong>Nombre_producto</strong></td>
    <td><strong>Existencias</strong></td>
    <td><strong>Descripcion_tipoproducto</strong></td>
  </tr>';
  



$sql=mysql_query("SELECT producto.id_producto, producto.Nombre_producto, producto.Existencias, tipo_producto.Descripcion_tipoproducto from producto inner join tipo_producto on producto.id_tipoproducto = tipo_producto.id_tipoproducto inner join lote_producto on lote_producto.id_producto = producto.id_producto order by producto.Existencias desc");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['id_producto'].'</td>
		<td>'.$res['Nombre_producto'].'</td>
		<td>'.$res['Existencias'].'</td>
		<td>'.$res['Descripcion_tipoproducto'].'</td>										
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