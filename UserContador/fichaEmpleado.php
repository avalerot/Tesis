<?php
$rutEmpleado=$_GET['rut'];
$dv=$_GET['dv'];
$rutEmpleado.="-".$dv;
$rutEmpresa=$_GET['rute'];
include '../conection.php';
$empleado = $mysqli->query("SELECT E.priNomb,E.segNomb,E.apePat,E.apeMat,E.sistSalud,E.sistPrev,E.fecAfil,C.fecIni,
					C.numCont,M.NombreEmpresa,M.idEmpresa,M.VerificadorEmpresa
					FROM empleado E JOIN contrato C ON E.rutEmpleado=C.rutEmpleado JOIN empresa M ON C.idEmpresa=M.idEmpresa
					WHERE E.rutEmpleado='$rutEmpleado' AND M.Rut='$rutEmpresa' AND C.estado='Activo'");
while($row = $empleado -> fetch_array()){
	$pNombre=$row[0];
	$sNombre=$row[1];
	$apePat=$row[2];
	$apeMat=$row[3];
	$salud=$row[4];
	$prevision=$row[5];
	$afiliacion=$row[6];
	$fechacontrato=$row[7];
	$contrato=$row[8];
	$nombreEmpresa=$row[9];
	$id=$row[10];
	$verificador=$row[11];
}
$rutEmpresa.="-".$verificador;
$licencias=$mysqli->query("SELECT L.id_licencia,L.dias_lic,L.fec_ini_rep,L.fec_ter_lic FROM licencia_medica L
							JOIN contrato C ON L.numCont=C.numCont
							WHERE C.rutEmpleado='$rutEmpleado' AND L.estado='2' ORDER BY L.fec_ini_rep DESC");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
		function licencia(rut_persona,id_empresa,div,url){
			$.post(url,{rut_persona:rut_persona,id_empresa:id_empresa},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
		function modificar(rut_persona,id_empresa,div,url){
			$.post(url,{rut_persona:rut_persona,id_empresa:id_empresa},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
		function cambiar(rut_persona,id_empresa,div,url){
			$.post(url,{rut_persona:rut_persona,id_empresa:id_empresa},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
		function deshabilitar(rut_persona,id_empresa,contrato,div,url){
			$.post(url,{rut_persona:rut_persona,id_empresa:id_empresa,contrato:contrato},
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
	<?php
			if(isset($_GET['resultado'])){
				if($_GET['resultado']==1){
					echo"<div class='alert alert-success alert-dismissable' style='margin-bottom: 10px; margin-top: 15px'>
  						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  						<strong>Datos cambiados con éxito!</strong>
						</div>";
				}
				else {
					echo"<div class='alert alert-danger alert-dismissable' style='margin-bottom: 10px;margin-top: 15px'>
    					<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
    					<strong>Error al cambiar los datos!</strong>
  						</div>";
				}
			}
		
		?>
	<div class="container" style="margin-top: 10px">
		<div class="row">
			<div class="col-lg-3 col-md-3">
				<div class="row">
					<form class="form-horizontal" style="font-size: 14px; margin-top: 20px">
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Rut Empleado:</label>
							<div class="col-md-4 col-lg-4">
								<p class="form-control-static"><?php echo $rutEmpleado;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Apellidos:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $apePat." ".$apeMat;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Nombres:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $pNombre." ".$sNombre;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Sistema de Salud:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $salud;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Previsión:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $prevision;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Fecha de Afiliacion:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $afiliacion;?></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-lg-4">Inicio de Contrato:</label>
							<div class="col-md-8 col-lg-8">
								<p class="form-control-static"><?php echo $fechacontrato;?></p>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<center><h3>6 Últimas Licencias</h3></center>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>N° Licencia</th>
								<th>Días</th>
								<th>Desde</th>
								<th>Hasta</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($licencias){
									$i=6;
									while($row = $licencias->fetch_array()){
										if($i>0){
											echo "<tr>
												<td>".$row[0]."</td>
												<td>".$row[1]."</td>
												<td>".$row[2]."</td>
												<td>".$row[3]."</td>
											</tr>";
										$i--;
										}
									}
								}else{
									echo"<h4>No se encontraron licencias para esta persona</h4>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="row">
					<div class="btn-group-vertical" style="margin-top: 20px;float: right">
  						<a href="javascript:void(0);" onclick="licencia('<?php echo $rutEmpleado?>','<?php echo $id?>','modalLicencia', 'modal_agregar_licencia.php');" id="agregar_licencia" data-toggle="modal" data-target="#modalLicencia" class="btn btn-success">Agregar Licencia</a>
  						<a href="javascript:void(0);" onclick="modificar('<?php echo $rutEmpleado?>','<?php echo $id?>','modalModificar', 'modal_modificar_datos.php');" id="modificar_datos" data-toggle="modal" data-target="#modalModificar" class="btn btn-warning" >Modificar Datos</a>
  						<a href="javascript:void(0);" onclick="cambiar('<?php echo $rutEmpleado?>','<?php echo $id?>','modalCambiar', 'modal_cambiar_de_empresa.php');" id="cambiar_empresa" data-toggle="modal" data-target="#modalCambiar" class="btn btn-warning">Cambiar de Empresa</a>
  						<a href="javascript:void(0);" onclick="deshabilitar('<?php echo $rutEmpleado?>','<?php echo $id?>','<?php echo $contrato?>','modalDeshabilitar', 'modal_deshabilitar_empleado.php');" id="deshabilitar_empleado" data-toggle="modal" data-target="#modalDeshabilitar" class="btn btn-danger">Deshabilitar</a>
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
	<div class="modal fade" id="modalLicencia" role="dialog"></div>
	<div class="modal fade" id="modalModificar" role="dialog"></div>
	<div class="modal fade" id="modalCambiar" role="dialog"></div>
	<div class="modal fade" id="modalDeshabilitar" role="dialog"></div>
	
</body>
</html>