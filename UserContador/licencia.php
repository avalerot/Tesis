<?php
include "../conection.php";
$licencia=$_GET['num_lic'];
$consulta = $mysqli -> query("SELECT E.rutEmpleado,L.estado,E.priNomb,E.segNomb,E.apePat,E.apeMat,
						L.fec_emision,L.fec_ini_rep,L.dias_lic,L.fec_ter_lic FROM licencia_medica L JOIN contrato C
						ON L.numCont=C.numCont JOIN empleado E ON C.rutEmpleado=E.rutEmpleado WHERE
						L.id_licencia='$licencia'");
while($row = $consulta -> fetch_array()){
	$rut=$row[0];
	if($row[1]==1){
		$estado="En espera de recibo";
	}
	elseif($row[1]==2){
		$estado="Recibida";
	}
	elseif($row[1]==3){
		$estado="Rechazada";
	}
	$nombre=$row[2]." ".$row[3]." ".$row[4]." ".$row[5];
	$emision=$row[6];
	$inicio=$row[7];
	$dias=$row[8];
	$termino=$row[9];
}
$empresa = $mysqli -> query("SELECT Rut FROM empresa M JOIN contrato C on M.idEmpresa=C.idEmpresa 
						WHERE C.rutEmpleado='$rut' AND C.estado='Activo'");
while($fila = $empresa -> fetch_array()){
	$rutEmpresa=$fila[0];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
		function modal(licencia,div,url){
			$.post(url,{licencia:licencia},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
		function imagen(ruta,div,url){
			$.post(url,{ruta:ruta},
			function(resp){
				$("#"+div+"").html(resp);
			}
			);
		}
	</script>
</head>
<body>
	<center><p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Licencia Médica</p></center>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
					<li><a href="opciones.php?rut=<?php echo $rutEmpresa?>">Volver a Empresa</a></li>
					<li><a href="javascript:void(0);" onclick="modal('<?php echo $licencia?>','myModal','modal_cambiar_estado_lic.php');" id="cambiar_estado_lic" data-toggle="modal" data-target="#myModal">Cambiar Estado</a></li>
					<li><a href="javascript:void(0);" onclick="modal('<?php echo $licencia?>','comprobante','modal_subir_comprobante.php');" id="subir_comprobante" data-toggle="modal" data-target="#comprobante">Adjuntar Comprobante</a></li>
					<li><a href="Mostrar_lic.php?numero_lic=<?php echo $licencia?>">Generar Comprobante</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php
			if(isset($_GET['resultado'])){
				if($_GET['resultado']==1){
					echo"<div class='alert alert-success alert-dismissable' style='margin-bottom: 10px'>
  						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  						<strong>Estado cambiado con éxito!</strong>
						</div>";
				}
				else {
					echo"<div class='alert alert-danger alert-dismissable' style='margin-bottom: 10px'>
    					<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
    					<strong>Error al cambiar el estado!</strong>
  						</div>";
				}
			}
		
		?>
	<div class="container-fluid" style="background-color: #F2F2F2">
		<div class="row">
			<div class="col-md-7 col-lg-7">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Número de Licencia:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $licencia?></p>	
					</div>
					<div class="col-lg-6 col-md-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Estado de Recepción:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $estado?></p>	
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<p style="font-size: 18px; padding-top: 10px"><label>RUT:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $rut?></p>	
					</div>
					<div class="col-md-6 col-lg-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Nombre:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $nombre?></p>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Fecha de Emisión:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $emision?></p>	
					</div>
					<div class="col-md-6 col-lg-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Fecha de Inicio:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $inicio?></p>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Días de Licencia:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $dias?></p>	
					</div>
					<div class="col-md-6 col-lg-6">
						<p style="font-size: 18px; padding-top: 10px"><label>Fecha de Término:</label></p>
						<p style="font-size: 20px; padding-top: 2px"><?php echo $termino?></p>	
					</div>
				</div>
			</div>
			<div class="col-md-5 col-lg-5" style="height: 300px;">
				<div class="row">
					<center><h4><b>Comprobante</b></h4></center>
				</div>
				<div class="row">
					<center>
					<?php
					$select = $mysqli -> query("SELECT comprobante FROM licencia_medica WHERE id_licencia='$licencia'");
					while($row = $select -> fetch_array()){
							$imagen=$row[0];
						}
					if($imagen=="Sin Comprobante"){
						echo"<img src='../DatosEmpleados/Comprobantes/no_disponible.png' width='250px' height='250px'>";
						echo"<br><div class='row'>
								<h5>No se ha adjuntado comprobante</h5>
								</div>";
								echo $imagen;
					}
					else{?>
						<a href="javascript:void(0);" onclick="imagen('<?php echo $imagen?>','imagen','modal_ver_imagen.php');" id="ver_imagen" data-toggle="modal" data-target="#imagen">
						<img src="<?php echo $imagen?>" style="margin-bottom: 15px" class="media-object" width="360px" height="270px">
						</a><?php
					}
					?>
					</center>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog"></div>
	<div class="modal fade" id="comprobante" role="dialog"></div>
	<div class="modal fade" id="imagen" role="dialog"></div>
</body>	
</html>