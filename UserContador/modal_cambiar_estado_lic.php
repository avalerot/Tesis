<?php 
$licencia=$_POST['licencia'];
?>

<div class="modal-dialog" role"document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<center>  <h4 class="modal-title">Cambiar estado a licencia<h2>  <?php echo "N° ".$licencia; ?></h2> </h4></center>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-2 col-lg-2"></div>
				<div class="col-md-8 col-lg-8">
					<form method="post" action="cambiar_estado.php">
						<p>
							<label>Seleccione Estado</label>
							<select class="form-control" name="estado">
								<option value="1">En espera de recibo</option>
								<option value="2">Recibida</option>
								<option value="3">Rechazada</option>
							</select>
						</p>
						<input type="hidden" name="licencia" value="<?php echo $licencia?>" />
						<div class="modal-footer">
        					<button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        					<button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Cambiar Estado</button>	
      					</div>
					</form>
				</div>
			</div>
		</div>		
      				
	</div>
</div>
