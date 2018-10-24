<?php
$ruta=$_POST['ruta'];
echo $ruta;
?>

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<center><img src="<?php echo $ruta?>" class="img-responsive" /></center>
				</div>
			</div>	
		</div>
	</div>
</div>
