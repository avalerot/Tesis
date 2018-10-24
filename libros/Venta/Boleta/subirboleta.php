<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<?php 
include '../../../conection.php';
$aux=$_POST['aux'];
$cc=$_POST['cc'];
$mestrabajo=$_POST['mestrabajo'];
$anotrabajo=$_POST['anotrabajo'];
$desde=$_POST['desde'];
$hasta=$_POST['hasta'];
$total=$_POST['total'];
$fecha=$_POST['fecha']; 
$neto=$_POST['neto'];
$totaliva=$_POST['totaliva'];
$Rutempre=$_POST['Rutempre'];// se tiene que agregar

$idcenc = $mysqli->query("SELECT idCentroCostos FROM centrocostos where Estado='1' and nombre='$cc' and rutEmpresa='$Rutempre' ");
$idcc = mysqli_fetch_array($idcenc, MYSQLI_NUM);
$idCc=$idcc[0];

$auxx= $mysqli->query("SELECT idCuentaCorriente FROM cuentacorriente where Estado='1' and numeroCuenta='$aux' and rutEmpresa='$Rutempre' ");
$auxf = mysqli_fetch_array($auxx, MYSQLI_NUM);
$auxiliar=$auxf[0];


$bolUltima='';

$hast = $mysqli->query("SELECT desde, hasta FROM boleta where rutEmpre='$Rutempre' and tipoDoc=2 ");

   while($row = $hast ->fetch_array()){
          $des=$row[0];
          $has=$row[1];

if(($desde >= $des && $desde <= $has) || ($hasta >= $des && $hasta <= $has) ){
	$bolUltima=1;
}


		}




if($bolUltima==''){


?>
<a  class="btn btn-success" style="margin: 10px 0px 0px 10px" href="form_boleta.php?Rutempre=<?php echo$Rutempre ?>&anotrabajo=<?php echo$anotrabajo?>&mestrabajo=<?php echo$mestrabajo ?>">Listo</a>
<?php
if($desde<$hasta){
//diferencia contanto dias 
		$diaEmi=date("d", strtotime($fecha));
		$fechatrab=$anotrabajo."-".$mestrabajo."-".$diaEmi;		
$dateTRAB=new DateTime($fechatrab);//DateTime::sub($Fechahoy) 
$dateEMISION=new DateTime($fecha);//DateTime::sub($fechaEmision) 
$interval=$dateEMISION->diff($dateTRAB);
$diferenMesess=$interval->format("%m");
$intervalAnos = $interval->format("%y")*12;
$mestrabajoo=date("m", strtotime($fechatrab)); 
$mesemision=date("m",strtotime($fecha));
$diferenMeses=$diferenMesess+$intervalAnos;
//echo "$fechatrab - $fechaEmision - $diferenMeses"; <- PARA COMPROBAR FECHAS (PRUEBA)
//




if ($diferenMeses<3 AND $dateTRAB>=$dateEMISION )//VER SI LA FACTURA ESTÁ DENTO DEL PLAZO DE REGISTRO(3 MESES ANTERIORES)
	{

$subirbolventa= "INSERT INTO boleta VALUES (null, '$Rutempre','$idCc','$auxiliar','$desde','$hasta','$neto','$totaliva','$total','$fecha',2,'$mestrabajo','$anotrabajo')";
if ($mysqli->query($subirbolventa)) { 



echo '<script> window.location="form_boleta.php?Rutempre='.$Rutempre.'&anotrabajo='.$anotrabajo.'&mestrabajo='.$mestrabajo.'"</script>';


}else{
?>
<h4>
	<center>
<div style="margin: 20px 0px 20px 0px " class="alert alert-warning" role="alert">la boleta no se pudo subir correctamente</i> </div></center></h4>


<?php
}
 ?>

<?php
	}else{

		?>
<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">las boletas</i> ESTAN FUERA DE PLAZO  <i>  -  <?php echo$Rutempre ?></i> </div></center></h4>
		<?php
	}
	}else{
	?>
<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">"desde" no puede ser mayor que "hasta"</i> </div></center></h4>
	<?php


}

}else{
?>
<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">Parte del rango de la boleta ya fue registrado</i> </div></center></h4>

<?php

}
?>