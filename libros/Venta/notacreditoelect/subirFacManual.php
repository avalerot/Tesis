
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<?php 
include '../../../conection.php';
$aux=$_POST['aux'];
$cc=$_POST['cc'];
$rutfac=$_POST['rut'];
$Razon=$_POST['razon'];
$Razoncd=$_POST['cd'];
$totalespe=$_POST['totalespe'];
$razoncount = $mysqli->query("SELECT count(nombreRazon) FROM razonsoc where rutRazon='$rutfac'");
$razonscou = mysqli_fetch_array($razoncount, MYSQLI_NUM);
$razonscouf=$razonscou[0];

if ($razonscouf==1){}else{
$subirazon= "INSERT INTO razonsoc VALUES (null,'$rutfac','$Razon','$Razoncd')";
if ($mysqli->query($subirazon)) {


}else{


}
}



$Rutempre=$_POST['Rutempre'];
$ivaAct = $mysqli->query("SELECT idIva FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$idiva=$iva[0];

$idcenc = $mysqli->query("SELECT idCentroCostos FROM centrocostos where Estado='1' and nombre='$cc' and rutEmpresa='$Rutempre' ");
$idcc = mysqli_fetch_array($idcenc, MYSQLI_NUM);
$idCc=$idcc[0];

$auxx= $mysqli->query("SELECT idCuentaCorriente FROM cuentacorriente where Estado='1' and numeroCuenta='$aux' and rutEmpresa='$Rutempre' ");
$auxf = mysqli_fetch_array($auxx, MYSQLI_NUM);
$auxiliar=$auxf[0];



session_start();
$arraySecuenF=array();
$arraySecuenF=$_SESSION['arraySecuen'];
//print_r($arraySecuenF); -> imprime array
unset($_SESSION['arraySecuen']);
  $totalneto=0;
     $totaliva=0;
        $tottal=0;

$mestrabajo=$_POST['mestrabajo'];
$anotrabajo=$_POST['anotrabajo'];
$numero=$_POST['numero'];
$fecha=$_POST['fecha']; // se tiene que agregar
$cd=$_POST['cd'];
?>

<a  class="btn btn-success" style="margin: 10px 0px 0px 10px" href="Form_FacturasDts.php?Rutempre=<?php echo$Rutempre ?>&anotrabajo=<?php echo$anotrabajo?>&mestrabajo=<?php echo$mestrabajo ?>">Listo</a>
<?php
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


foreach ($arraySecuenF as $key => list($total,$ivapes,$abono,$neto,$espeSec,$espdisel,$espiscos,$esvinos,$esbebidas,$retcarne,$retharina))
	      {
        $totalneto=$neto+$totalneto;
     $totaliva=$ivapes+$totaliva;
        $tottal=$total+$tottal;

	      }
echo"$totalneto - $totaliva - $tottal";
$subirfacventa= "INSERT INTO facturaventa VALUES (null, '$numero','$rutfac','$Rutempre','$mestrabajo','$anotrabajo','$auxiliar','$idCc','$fecha','$totalneto',0,'$totaliva','$tottal','$totalespe',61)";
if ($mysqli->query($subirfacventa)) {
	     foreach ($arraySecuenF as $key => list($total,$ivapes,$abono,$neto,$espeSec,$espdisel,$espiscos,$esvinos,$esbebidas,$retcarne,$retharina))
	      {
	      	$subirsecuefac= "INSERT INTO secuenciafactVenta VALUES (null, '$numero','$idiva','$total','$ivapes','$abono','$neto','$espdisel','$espiscos','$esbebidas','$esvinos','$retcarne','$retharina','$Rutempre','$key',61)";
if ($mysqli->query($subirsecuefac)) {


}else{


}
}     
  echo '<script>window.location="Form_FacturasDts.php?Rutempre='.$Rutempre.'&anotrabajo='.$anotrabajo.'&mestrabajo='.$mestrabajo.'"</script>'            
                 
}else{
	$empresa = $mysqli->query("SELECT NombreEmpresa FROM empresa where Rut='$Rutempre'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
	?>
	

	<h4>
	<center>
<div style="margin: 100px 0px 0px 0px " class="alert alert-danger" role="alert"><a href="Form_FacturasDts.php?Rutempre=<?php echo$Rutempre ?>&anotrabajo=<?php echo$anotrabajo?>&mestrabajo=<?php echo$mestrabajo ?>">la factura <i>Nº <?php echo$numero ?></i> ya está agregada en la empresa <i> <?php echo$nombreEmpresa ?> -  <?php echo$Rutempre ?></i> ------> Presiona aquí para ingresar otra vez</a> </div></center></h4>
	<?php

}

	}else{

?>
	<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">la factura <i>Nº <?php echo$numero ?></i> ESTA FUERA DE PLAZO  <i>  -  <?php echo$Rutempre ?></i> </div></center></h4>
	<?php

	}

 
 
?>