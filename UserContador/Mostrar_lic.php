<?php
include '../conection.php';
$numero_lic=$_GET['numero_lic'];

$consulta = $mysqli->query("SELECT M.NombreEmpresa,M.Rut,M.VerificadorEmpresa,O.Nombre_comuna,L.fec_emision,
					 L.fec_ini_rep,L.dias_lic,L.fec_ter_lic,L.fec_rec_emp,E.rutEmpleado,E.priNomb,E.segNomb,
					 E.apePat, E.apeMat,E.sistSalud,E.sistPrev,E.fecAfil,C.fecIni FROM licencia_medica L 
					 JOIN contrato C ON L.numCont=C.numCont JOIN empresa M ON C.idEmpresa=M.idEmpresa
					 JOIN empleado E ON C.rutEmpleado=E.rutEmpleado JOIN comunas O ON M.comuna_numero=O.comuna_numero
					 WHERE L.id_licencia='$numero_lic'");

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
	<title>Comprobante de Licencia</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body> 

<center>
<p class="bg-primary hidden-print">Vista previa del comprobante</p>

<a class="hidden-print" href="licencia.php?num_lic=<?php echo $numero_lic?>">
	<button type="button" class="hidden-print btn btn-primary btn-lg" aria-label="Left Align">Ver Licencia</button>
</a>
<button type="button" class="hidden-print btn btn-primary btn-lg" aria-label="Left Align" onclick="imprimir()"><span class="glyphicon glyphicon-print" aria-hidden="true"> Imprimir</span></button>

<div class="row" style="width: 80%; margin-top: 15px">
	<div class="col-md-12">
		<div class="panel panel-default">
			<ul class="list-group">
				<li class="list-group-item">
					<h3><b><?php echo utf8_encode($nombreEmpresa) ?></b></h3>
					<p><?php echo $rutEmpresa?></p>
				</li>
				<li class="list-group-item">
					<h4><b>Comprobante de Licencia Médica</b></h4>
					<p style="text-align: right"><?php echo utf8_encode($comuna).", ".$fechaEmision?></p>
					<p>Se deja constancia, que con esta fecha se hace entrega de licencia médica correspondiente a <b><?php echo $nombre." ".$apellido;?></p>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<td><b>Rut empleado: </b><?php echo $rutEmpleado?></td>
								<td><b>Sistema de salud:</b> <?php echo $salud?></td>
							</tr>
							<tr>
								<td><b>Días de licencia: </b><?php echo $diasLicencia?></td>
								<td><b>Sistema de prevision:</b> <?php echo $prevision?></td>
							</tr>
							<tr>
								<td><b>Fecha de inicio:</b> <?php echo $inicioReposo?></td>
								<td><b>Fecha del contrato:</b> <?php echo $fechaContrato?></td>
							</tr>
							<tr>
								<td><b>Fecha de término:</b> <?php echo $terminoLicencia?></td>
								<td><b>Fecha de afiliación:</b> <?php echo $afiliacion?></td>
							</tr>
							<tr>
								<td><b>Número de licencia:</b> <?php echo$numero_lic?></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</li>
				<li class="list-group-item">
					<p>_______________________________</p>
					<p>Firma Recepción</p>
				</li>
			</ul>
		</div>
	</div>
</div>


</center>

<script>
	function imprimir() {
    window.print();
}
</script>




</body>
</html>