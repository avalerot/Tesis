<?php
$rut=$_POST['rut_persona'];
$id=$_POST['id_empresa'];
$contrato=$_POST['contrato'];
include '../conection.php';

$select = $mysqli -> query("SELECT priNomb,segNomb,apePat,apeMat FROM empleado WHERE rutEmpleado='$rut'");
while($row = $select -> fetch_array()){
	$pnombre=$row[0];
	$snombre=$row[1];
	$apepat=$row[2];
	$apemat=$row[3];
}

?>
<div class="modal-dialog" role"dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center>  <h4 class="modal-title">Deshabilitar empleado</h4></center>
		</div>
		<div class="modal-body">
			<center><h4>Está seguro que desea deshabilitar a</h4> 
			<h4><b><?php echo $pnombre." ".$snombre." ".$apepat." ".$apemat;?></b>?</h4></center>
		</div>
		<div class="modal-footer">
			<form action="deshabilitar_empleado.php" method="post">
				<input type="hidden" name="numCont" value="<?php echo $contrato?>" />
				<button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        		<button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Deshabilitar</button>	
			</form>
    	</div>
	</div>
</div>



