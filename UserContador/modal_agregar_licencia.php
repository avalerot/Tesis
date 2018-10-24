<?php $rut=$_POST['rut_persona'];
	$id=$_POST['id_empresa'];
	include '../conection.php';
	$empleado = $mysqli->query("SELECT * FROM empleado WHERE rutEmpleado='$rut'");
	while($row = $empleado -> fetch_array()){
		$pNombre = $row[1];
		$sNombre = $row[2];
		$apePat = $row[3];
		$apeMat = $row[4];
		$salud = $row[5];
		$prevision = $row[6];
		$afiliacion = $row[7];
	}
	$contrato = $mysqli->query("SELECT numCont,fecIni FROM contrato WHERE idEmpresa='$id' AND rutEmpleado='$rut'
				AND estado='Activo'");
	while ($row = $contrato -> fetch_array()){
		$numCont=$row[0];
		$iniCont=$row[1];
	}
	$empresa =  $mysqli->query("SELECT nombreEmpresa,Rut,VerificadorEmpresa,comuna_numero FROM empresa WHERE idEmpresa='$id'");
	while($row = $empresa -> fetch_array()){
		$nombreE=$row[0];
		$rutE=$row[1]."-".$row[2];
		$comuna=$row[3];
	}
	
	
?>



  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center>  <h4 class="modal-title">Ingresar licencia a <?php echo $pNombre." ".$apePat; ?> <h2>  <?php echo $rut; ?></h2> </h4></center> 
      </div>
      <div class="modal-body">


<div class="row">
<center>
<div class="xs-hidden col-md-2 col-lg-2"></div>

<div class="col-xs-12 col-md-8 col-lg-8">
<form method="post" action="subirLicencia.php">
	<p><label>Fecha de emisión</label><input class="form-control" type="date" name="fecha_emision" required></p>
	<p><label>Fecha de inicio de reposo</label><input class="form-control" type="date" name="inicio_reposo" required></p>
	<p><label>Días de licencia</label><input class="form-control" type="number" name="dias_lic" required=""></p>
  	<p><label>Número de licencia</label><input class="form-control" type="number" name="numero_lic" required></p>
  	<label>Fecha de recepción empleador</label><input class="form-control" type="date" name="recepcion" required></p>
	<input class="form-control" type="hidden" name="rutp" value="<?php echo $rut; ?>" required>
 	<input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" required>
 	<input class="form-control" type="hidden" name="contrato" value="<?php echo $numCont; ?>" required>

  <div class="modal-footer" >
        <button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Hacer licencia</button>
      </div>
    </form>
</div>
<div class="col-lg-2 col-md-2"></div>
</center>

</div>

      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


