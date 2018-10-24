<?php
$rut=$_POST['rut_persona'];
$id=$_POST['id_empresa'];
include "../conection.php";
$empleado = $mysqli -> query("SELECT E.priNomb,E.segNomb,E.apePat,E.apeMat,C.numCont FROM empleado E JOIN contrato C
					ON E.rutEmpleado=C.rutEmpleado WHERE C.rutEmpleado='$rut' AND C.estado='Activo'");
while($row = $empleado -> fetch_array()){
	$pnombre=$row[0];
	$snombre=$row[1];
	$apepat=$row[2];
	$apemat=$row[3];
	$numCont=$row[4];
}
$empresas = $mysqli -> query("SELECT idEmpresa,NombreEmpresa from empresa ORDER BY NombreEmpresa ASC");
?>
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center>  <h4 class="modal-title">Cambiar de empresa a</h4><h2><?php echo $pnombre." ".$snombre." ".$apepat." ".$apemat;?></h2></center>
		</div>
		<div class="modal-body">
			<form action="cambiar_de_empresa.php" method="post">
				<div class="form-group">
					<label>Seleccione nueva empresa</label>
					<select class="form-control" name="idempresa">
						<?php
						while($row = $empresas -> fetch_array()){
							echo"<option value='".$row[0]."'>".$row[1]."</option>";
						}
						?>
					</select>
					<input type="hidden" name="rutempleado" value="<?php echo $rut?>" />
					<input type="hidden" name="idantiguo" value="<?php echo $id?>" />
					<input type="hidden" name="numCont" value="<?php echo $numCont?>"/>
				</div>
				<div class="form-group">
					<label>Fecha del nuevo contrato</label>
					<input type="date" class="form-control" required name="contrato" />
				</div>
				<div class="modal-footer">
        			<button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        			<button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Cambiar Empresa</button>	
    			</div>
    		</form>
		</div>
	</div>
</div>
