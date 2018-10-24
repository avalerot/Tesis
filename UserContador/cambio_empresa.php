<?php
$rut=$_GET['rut'];
$id=$_GET['id'];
$idantiguo=$_GET['idantiguo'];
include '../conection.php';
$empleado=$mysqli->query("SELECT E.rutEmpleado,E.priNomb,E.segNomb,E.apePat,E.apeMat,M.Rut,M.VerificadorEmpresa,
					M.NombreEmpresa,C.fecIni FROM empleado E JOIN contrato C ON E.rutEmpleado=C.rutEmpleado
					JOIN empresa M ON C.idEmpresa=M.idEmpresa WHERE C.rutEmpleado='$rut' AND C.idEmpresa='$id'
					AND C.estado='Activo'");
$antigua=$mysqli->query("SELECT Rut,VerificadorEmpresa,NombreEmpresa FROM empresa WHERE idEmpresa='$idantiguo'");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<center><p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Cambio de Empresa</p>
	<div class="container-fluid" style="background-color: #F2F2F2; margin-top: 10px;">
		<div class="row">
			<div class="col-md-4 col-lg-4" style="border: 1px solid; border-color: #D8D8D8">
				<?php
				while($row = $empleado->fetch_array()){
					$rutEmpleado=explode("-",$row[0]);	
					$nombre=$row[1]." ".$row[2];
					$apellido=$row[3]." ".$row[4];
					$rutEmpresa=$row[5];
					$verificador=$row[6];
					$nombreEmpresa=$row[7];
					$contrato=$row[8];
				}
				?>
				<h3>Empleado</h3><br>
				<h5>RUT: <?php echo $rutEmpleado[0]."-".$rutEmpleado[1]?></h5>
				<h5>Nombres: <?php echo $nombre?></h5>
				<h5>Apellidos: <?php echo $apellido?></h5>
				<form action="fichaEmpleado.php" method="get">
					<input type="hidden" name="rut" value="<?php echo $rutEmpleado[0]?>" />
					<input type="hidden" name="dv" value="<?php echo $rutEmpleado[1]?>"/>
					<input type="hidden" name="rute" value="<?php echo $rutEmpresa?>" />
					<button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Ir a Ficha</button>
				</form>
			</div>
			<div class="col-md-4 col-lg-4" style="border: 1px solid; border-color: #D8D8D8">
				<h3>Nueva Empresa</h3><br>
				<h5>RUT: <?php echo $rutEmpresa."-".$verificador?></h5>
				<h5>Nombre: <?php echo $nombreEmpresa?></h5>
				<h5>Inicio Contrato: <?php echo $contrato?></h5>
				<form action="opciones.php" method="get">
					<input type="hidden" name="rut" value="<?php echo $rutEmpresa?>" />
					<button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Ir a <?php echo $nombreEmpresa?></button>
				</form>
			</div>
			<div class="col-md-4 col-lg-4" style="border: 1px solid; border-color: #D8D8D8">
				<?php
				while ($row=$antigua->fetch_array()){
					$nombreEmpresa=$row[2];
					$rutEmpresa=$row[0];
					$verificador=$row[1];
				}
				?>
				<h3>Empresa Antigua</h3><br>
				<h5>RUT: <?php echo $rutEmpresa."-".$verificador?></h5>
				<h5>Nombre: <?php echo $nombreEmpresa?></h5>
				<h5>Contrato finalizado</h5>
				<form action="opciones.php" method="get">
					<input type="hidden" name="rut" value="<?php echo $rutEmpresa?>" />
					<button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Ir a <?php echo $nombreEmpresa?></button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>