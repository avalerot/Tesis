
<?php 
$rut=$_POST['rut_empre'];
	
	include '../conection.php';

	$empresa =  $mysqli->query("SELECT nombreEmpresa,Rut,VerificadorEmpresa FROM empresa WHERE Rut='$rut'");
	while($row = $empresa -> fetch_array()){
		$nombreE=$row[0];
		$rutE=$row[1];

	}
	
	
?>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center>  <h4 class="modal-title">desactivar a la empresa <?php echo $nombreE; ?> <h2>  <?php echo $rutE; ?></h2> </h4></center> 
      </div>
      <div class="modal-body">


<div class="row">
<center>
<div class="xs-hidden col-md-2 col-lg-2"></div>

<div class="col-xs-12 col-md-8 col-lg-8">
<form method="post" action="desactivarEmpre.php">
	<p><label>¿Estás seguro de desactivar a la empresa <?php echo $nombreE; ?> - <?php echo $rutE; ?> ?</label>
	<input type="hidden" name="rutE" value="<?php echo $rutE ?>">
		<input type="hidden" name="nombreE" value="<?php echo $nombreE ?>">

  <div  class="modal-footer" >
        <button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">No</button>
        <button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Si</button>
      </div>
</form>
</center>
</div>
</div>

      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


