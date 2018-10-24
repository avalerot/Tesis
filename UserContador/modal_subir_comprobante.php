<?php
$licencia=$_POST['licencia'];
?>

<div class="modal-dialog" role"document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center>  <h4 class="modal-title">Adjuntar comprobante a licencia<h2>  <?php echo "N° ".$licencia; ?></h2> </h4></center>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" action="subirComprobante.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="licencia" value="<?php echo $licencia?>" />
				<center><input type="file" name="imagen" style="margin-bottom: 15px" required /></center>
				<div class="modal-footer"><center>
        			<button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        			<button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Adjuntar</button>	
    			</center></div>
			</form>
		</div>
	</div>
</div>
