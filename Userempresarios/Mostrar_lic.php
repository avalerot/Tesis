<?php
session_start();
if(!isset($_SESSION["session_username"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username"]);
?>
 <?php 
<?php
include '../conection.php';
$numero_lic=$_GET['numero_lic'];

$consulta = $mysqli->query("SELECT M.NombreEmpresa,M.Rut,M.VerificadorEmpresa,O.Nombre_comuna,L.fec_emision,
					L.fec_ini_rep,L.dias_lic,L.fec_ter_lic,L.fec_rec_emp,E.rutEmpleado,E.priNomb,E.segNomb,E.apePat,
					E.apeMat,E.sistSalud,E.sistPrev,E.fecAfil,C.fecIni FROM empresa M JOIN contrato C ON M.idEmpresa=C.idEmpresa
					JOIN empleado E ON C.rutEmpleado=E.rutEmpleado JOIN licencia_medica L ON C.numCont=L.numCont JOIN
					comuna O ON M.comuna_numero=O.comuna_numero WHERE L.id_licencia='$numero_lic'");

while($row = $consulta -> fetch_array()){
	$nombreEmpresa=$row[0];
	$rutE=$row[1];
	$rutEmpresa=$row[1]."-".$row[2];
	$comuna=$row[3];
	$fechaEmision=$row[4];
	$inicioReposo=$row[5];
	$diasLicencia=$row[6];
	$terminoLicencia=$row[7];
	$recepcionEmpleador=$row[8];
	$rutEmpleado=$row[9];
	$nombre=$row[10]." ".$row[11];
	$apellido=$row[12]." ".$row[13];
	$salud=$row[14];
	$prevision=$row[15];
	$afiliacion=$row[16];
	$fechaContrato=$row[17];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Vista Previa</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<link rel="stylesheet" href="../modelo/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="../modelo/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="../modelo/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<center>
<p class="bg-primary">Vista previa del comprobante</p>
	<div style=" width:1200px; height:500px; border: dashed; ">
	
		<div style=" float: left; width: 500px; height: 60; margin: 5px 0px 0px 5px; padding: 10px 0px 0px 0px; border: solid;" ><b><?php echo $nombreEmpresa?></b><br><?php echo $rutEmpresa?></div>
		<div style=" float: left; width: 1200px; height: 20; margin: 5px 0px 0px 0px; background-color: #E6E6E6" ><b>COMPROBANTE DE ENTREGA DE LICENCIA MEDICA</b></div>
		<div style=" float: right; width: 400px; height: 20; margin: 5px 10px 0px 0px" ><?php echo$comuna.", ".$fechaEmision?></div>
		<div style=" float: left; width: 1200px; height: 25; margin: 10px 0px 0px 0px" >Se deja constancia, que con esta fecha se hace entrega de licencia médica correspondiente a <b><?php echo $nombre." ".$apellido;?></b></div>
        <div style=" float: left; width: 500px; height: 120; margin: 10px 0px 0px 5px; padding: 25px 0px 0px 0px; border: solid;" >
        	<b>Rut empleado:</b> <?php echo $rutEmpleado?><br>
        	<b>Dias de licencia:</b> <?php echo $diasLicencia?><br>
        	<b>Fecha de inicio:</b> <?php echo $inicioReposo?><br>
        	<b>Fecha de término:</b> <?php echo $terminoLicencia?><br>
        	<b>Número de licencia:</b> <?php echo$numero_lic?><br>

        </div>
         <div style=" float: right; width: 500px; height: 40; margin: 280px 60px 0px 5px" >_______________________________<br>FIRMA RECEPCION</div>
 <div style="; float: left; width: 500px; height: 120; margin: 10px 0px 0px 5px; padding: 25px 0px 0px 0px; border: solid;" >
 	 	<b>Sistema de salud:</b> <?php echo $salud?><br>
        	<b>Sistema de prevision:</b> <?php echo $prevision?><br>
        	<b>Fecha del contrato:</b> <?php echo $fechaContrato?><br>
        	<b>Fecha de afiliación:</b> <?php echo $afiliacion?><br>
        	


 </div>
	</div>
	<a href="opciones.php?rut=<?php echo $rutE?>"><img style="margin: 10px 10px 10px 10px" height="60px" width="60px" src="../recursos/img/volver.png"> </a>
	<a href="cert_pdf.php?num_lic=<?php echo $numero_lic ?>"><img style="margin: 10px 10px 10px 10px" height="50px" width="50px" src="../recursos/img/PDF.png">  </a>



</center>




</body>
</html>
<?php  }?>