
<?php 
$rut=$_POST['rut_empre'];
	
	include '../conection.php';

	$empresa =  $mysqli->query("SELECT nombreEmpresa,Rut,VerificadorEmpresa FROM empresa WHERE Rut='$rut'");
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
     <center>  <h4 class="modal-title">Agregar cuenta auxiliar a la empresa <?php echo $nombreE; ?> <h2>  <?php echo $rutE; ?></h2> </h4></center> 
      </div>
      <div class="modal-body">


<div class="row">
<center>
<div class="xs-hidden col-md-2 col-lg-2"></div>

<div class="col-xs-12 col-md-8 col-lg-8">
<form method="post" action="Agregarca.php">
	<p><label>Nueva cuenta auxiliar</label><input class="form-control" type="text" name="ca"></p>
	<input type="hidden" name="rutE" value="<?php echo $rutE ?>">
		<input type="hidden" name="nombreE" value="<?php echo $nombreE ?>">

  <div  class="modal-footer" >
        <button style="margin: 15px 0px 0px 0px;"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button style="margin: 15px 0px 0px 0px;" type="submit" class="btn btn-success">Agregar cuenta auxiliar</button>
      </div>
</form>
</center>
</div>
</div>

      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->


