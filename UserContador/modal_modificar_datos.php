<?php
$rut=$_POST['rut_persona'];
$id=$_POST['id_empresa'];
include "../conection.php";
$empleado = $mysqli->query("SELECT E.priNomb,E.segNomb,E.apePat,E.apeMat,E.sistSalud,E.sistPrev,E.fecAfil,C.fecIni,C.numCont
					FROM empleado E JOIN contrato C ON E.rutEmpleado=C.rutEmpleado WHERE E.rutEmpleado='$rut'
					AND C.idEmpresa='$id' AND C.estado='Activo'");
while($row = $empleado -> fetch_array()){
	$pNombre=$row[0];
	$sNombre=$row[1];
	$apePat=$row[2];
	$apeMat=$row[3];
	$salud=$row[4];
	$prevision=$row[5];
	$afiliacion=$row[6];
	$contrato=$row[7];
	$numcontrato=$row[8];
}
?>

<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center>  <h4 class="modal-title">Modificar datos a empleado</h4></center>
		</div>
		<div class="modal-body">
				<form class="form-horizontal" action="modificar_datos.php" method="post">
					<input type="hidden" name="numerocontrato" value="<?php echo $numcontrato?>"/>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Rut Empleado:</label>
						<div class="col-md-8 col-lg-8">
							<input class="form-control" type="text" name="rut" value="<?php echo $rut?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Primer Nombre:</label>
						<div class="col-md-8 col-lg-8">
							<input class="form-control" type="text" name="pnombre" value="<?php echo $pNombre?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Segundo Nombre:</label>
						<div class="col-md-8 col-lg-8">
							<input class="form-control" type="text" name="snombre" value="<?php echo $sNombre;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Apellido Paterno:</label>
						<div class="col-md-8 col-lg-8">
							<input class="form-control" type="text" name="paterno" value="<?php echo $apePat?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Apellido Materno:</label>
						<div class="col-md-8 col-lg-8">
							<input class="form-control" type="text" name="materno" value="<?php echo $apeMat;?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Sistema de Salud:</label>
						<div class="col-md-8 col-lg-8">
							<select class="form-control" name="salud">
								<?php
									switch($salud){
										case "FONASA":
											echo"<option value='FONASA' selected>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Banmédica":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica' selected>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Colmena":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena' selected>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Consalud":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud' selected>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Cruz Blanca":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca' selected>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Vida Tres":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres' selected>Vida Tres</option>
											<option value='Río Blanco'>Río Blanco</option>";
											break;
										case "Río Blanco":
											echo"<option value='FONASA'>FONASA</option>
											<option value='Banmédica'>Banmédica</option>
											<option value='Colmena'>Colmena</option>
											<option value='Consalud'>Consalud</option>
											<option value='Cruz Blanca'>Cruz Blanca</option>
											<option value='Vida Tres'>Vida Tres</option>
											<option value='Río Blanco' selected>Río Blanco</option>";
											break;
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-lg-4">Previsión:</label>
						<div class="col-md-8 col-lg-8">
							<select class="form-control" name="prevision">
								<?php
									switch($prevision){
										case "Modelo":
											echo"<option value='Modelo' selected>Modelo</option>
											<option value='Cuprum'>Cuprum</option>
											<option value='Habitat'>Habitat</option>
											<option value='Planvital'>Planvital</option>
											<option value='Provida'>Provida</option>";
											break;
										case "Cuprum":
											echo"<option value='Modelo'>Modelo</option>
											<option value='Cuprum' selected>Cuprum</option>
											<option value='Habitat'>Habitat</option>
											<option value='Planvital'>Planvital</option>
											<option value='Provida'>Provida</option>";
											break;
										case "Habitat":
											echo"<option value='Modelo'>Modelo</option>
											<option value='Cuprum'>Cuprum</option>
											<option value='Habitat' selected>Habitat</option>
											<option value='Planvital'>Planvital</option>
											<option value='Provida'>Provida</option>";
											break;
										case "Planvital":
											echo"<option value='Modelo'>Modelo</option>
											<option value='Cuprum'>Cuprum</option>
											<option value='Habitat'>Habitat</option>
											<option value='Planvital' selected>Planvital</option>
											<option value='Provida'>Provida</option>";
											break;
										case "Provida":
											echo"<option value='Modelo'>Modelo</option>
											<option value='Cuprum'>Cuprum</option>
											<option value='Habitat'>Habitat</option>
											<option value='Planvital'>Planvital</option>
											<option value='Provida' selected>Provida</option>";
											break;
									}
								?>
							</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-lg-4">Fecha de Afiliacion:</label>
					<div class="col-md-8 col-lg-8">
						<input class="form-control" type="date" name="afiliacion" value="<?php echo $afiliacion;?>">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-lg-4">Inicio de contrato:</label>
					<div class="col-md-8 col-lg-8">
						<input class="form-control" type="date" name="fechacontrato" value="<?php echo $contrato;?>">
					</div>
				</div>
				<div class="modal-footer"><center>
        			<button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        			<button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Modificar Datos</button>	
    			</center></div>
			</form>
		</div>
	</div>
</div>
