<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center>  <h4 class="modal-title">Detalle de especificos y retenciones</h4></center> 
      </div>


      <div class="modal-body">



<div class="row">
<?php 

$esbebidas=$_POST['esbebidas'];
$espdisel=$_POST['espdisel'];
$espiscos=$_POST['espiscos'];
$esvinos=$_POST['esvinos'];
$retharina=$_POST['retharina'];
$retcarne=$_POST['retcarne'];

if($esvinos!=0 OR $espiscos!=0 OR $espdisel!=0 OR $esbebidas!=0){
?>


<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
<label> disel $</label>
	<input class="form-control" value="<?php echo$espdisel ?>"  type="text" readonly>
</div>
<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
<label> bebidas $</label>
	<input class="form-control" value="<?php echo$esbebidas ?>"  type="text" readonly>
</div>
<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
<label> vinos $</label>
	<input class="form-control" value="<?php echo$esvinos ?>"  type="text" readonly>
</div>
<div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
<label> piscos $</label>
	<input class="form-control" value="<?php echo$espiscos ?>"  type="text" readonly>
</div>



<?php }


if($retharina!=0 OR $retcarne!=0){ ?>

<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
<label>Retención harina $</label>
	<input class="form-control" value="<?php echo$retharina ?>"  type="text" readonly>
</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
<label>Retención carne $</label>
	<input class="form-control" value="<?php echo$retcarne ?>"  type="text" readonly>
</div>


<?php }

if($retharina==0 AND $retcarne==0 AND $esvinos==0 AND $espiscos==0 AND $espdisel==0 AND $esbebidas==0){ ?>
<center><p style="padding: 0px 0px 0px 10px" class="bg-warning">Secuencia sin específicos  ---  Secuencia sin retenciones</p>
</center>

	<?php }?>

</div>




</center>
</div>


 
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

</body>
</html>

