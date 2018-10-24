<?php
session_start();
if(!isset($_SESSION["session_username"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username"]);
?>
 <?php 
<?php
$rutEmpleado=$_GET['rut'];
$dv=$_GET['dv'];
$rutEmpleado.="-".$dv;
$rutEmpresa=$_GET['rute'];
include '../conection.php';
$empresa = $mysqli->query("SELECT NombreEmpresa,idEmpresa,VerificadorEmpresa FROM Empresa where Rut='$rutEmpresa'");
while($row = $empresa -> fetch_array()){
	$nombreEmpresa=$row[0];
	$id=$row[1];
	$verificador=$row[2];
}
$rutEmpresa.="-".$verificador;
$empleado = $mysqli->query("SELECT * FROM empleado WHERE rutEmpleado='$rutEmpleado'");
while($row = $empleado -> fetch_array()){
	$pNombre=$row[1];
	$sNombre=$row[2];
	$apePat=$row[3];
	$apeMat=$row[4];
	$salud=$row[5];
	$prevision=$row[6];
	$afiliacion=$row[7];
}
$contrato =  $mysqli->query("SELECT numCont FROM contrato WHERE idEmpresa='$id' AND rutEmpleado='$rutEmpleado'");
while($row = $contrato -> fetch_array()){
	$idContrato=$row[0];
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
		function modal(rut_persona,id_empresa,div,url){
			$.post(url,{rut_persona:rut_persona,id_empresa:id_empresa},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
</script>
</head>
<body>
	<center><p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Ficha Empleado</p>
	<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$rutEmpresa";?></b> </h4>
	</center><br>
	<div class="container" style="margin-top: 10px">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p style="font-size: 18px; padding-top: 10px"><label>Rut Empleado:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $rutEmpleado;?></p>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p style="font-size: 18px; padding-top: 10px"><label>Apellidos:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $apePat." ".$apeMat;?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p style="font-size: 18px; padding-top: 10px"><label>Nombres:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $pNombre." ".$sNombre;?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4">
						<p style="font-size: 18px; padding-top: 10px"><label>Sistema de Salud:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $salud;?></p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p style="font-size: 18px; padding-top: 10px"><label>Previsión:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $prevision;?></p>
					</div>
					<div class="col-lg-4 col-md-4">
						<p style="font-size: 18px; padding-top: 10px"><label>Fecha de Afiliación:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $afiliacion;?></p>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2">
				<div class="row">
					<div class="btn-group-vertical" style="margin-top: 10px">
  						<a href="javascript:void(0);" onclick="modal('<?php echo $rutEmpleado?>','<?php echo $id?>','myModal', 'modal_agregar_licencia.php');" id="agregar_licencia" data-toggle="modal" data-target="#myModal" class="btn btn-success">Agregar Licencia</a>
  						<a href="#" class="btn btn-warning" style="padding-top:10px">Modificar Datos</a>
  						<a href="#" class="btn btn-warning">Cambiar de Empresa</a>
  						<a href="#" class="btn btn-danger">Deshabilitar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-6 col-lg-8"></div>
			<div class="col-md-6 col-lg-4">
				<div class="btn-group">
  					<a href="index.php"><button type="button" class="btn btn-primary">Inicio</button></a>
  					<a href="listaEmpresas.php"><button type="button" class="btn btn-primary">Lista Empresas</button></a>
  					<a href="opciones.php?rut=<?php echo $_GET['rute']?>"><button type="button" class="btn btn-primary">Menu Empresa</button></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog"></div>
	
</body>
</html>
<?php }?>