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
    <td colspan="6" bgcolor="skyblue"><CENTER><strong>REPORTE DE TIPO DE PAGO</strong></CENTER></td>
  </tr>
  <tr bgcolor="red">
    <td><strong>id_tipopago</strong></td>
    <td><strong>Cantidad_venta</strong></td>
    <td><strong>Descripcion_tipo</strong></td>
    
    
  </tr>';
  
$fechainicio = $_POST['fecha1'];
$fechafin = $_POST['fecha2'];


$sql=mysql_query("SELECT  venta.id_tipopago, venta.Cantidad_venta, tipo_pago.Descripcion_tipo  FROM venta inner join tipo_pago on venta.id_tipopago = tipo_pago.id_tipopago WHERE fecha_venta BETWEEN '$fechainicio' and '$fechafin'");
while($res=mysql_fetch_array($sql)){
$codigoHTML.='	
	<tr>
		<td>'.$res['id_tipopago'].'</td>
		<td>'.$res['Cantidad_venta'].'</td>	
		<td>'.$res['Descripcion_tipo'].'</td>										
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