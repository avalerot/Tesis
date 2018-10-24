

<?php

$e=$_POST['e'];

$totalespe=$_POST['totalespe'];


if($e=='esp'){
?>
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<div class="col-md-3 col-lg-3 col-xs-8 col-sm-8"><p><label>Disel </label><input class="form-control " type="number"   name="esdisel" onkeypress='return solonumeros(event)' placeholder="$" onchange='calcularespe(<?php echo $totalespe  ?>,"disel")'></div>
<div class="col-md-3 col-lg-3 col-xs-8 col-sm-8"><p><label>piscos  </label><input  onchange="calcularespe(<?php echo $totalespe  ?>,'piscos')"  onkeypress='return solonumeros(event)' class="form-control " type="number" name="espiscos" placeholder="$"></div>
<div class="col-md-3 col-lg-3 col-xs-8 col-sm-8"><p><label>vinos  </label><input onchange="calcularespe(<?php echo $totalespe  ?>,'vinos')"  onkeypress='return solonumeros(event)' class="form-control " type="number" name="esvinos" placeholder="$"></div>
<div class="col-md-3 col-lg-3 col-xs-8 col-sm-8"><p><label>bebidas  </label><input onchange="calcularespe(<?php echo $totalespe  ?>,'bebidas')"  onkeypress='return solonumeros(event)' class="form-control " type="number" name="esbebidas" placeholder="$"></div>


</div>


<?php }
if($e=='ret'){
 ?>
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
<div class="col-md-6 col-lg-6 col-xs-8 col-sm-8"><p><label>Harinas </label><input onchange="calcularespe(<?php echo $totalespe  ?>,'harina')" onkeypress='return solonumeros(event)' class="form-control " type="number" name="retharina" placeholder="$"></div>
<div class="col-md-6 col-lg-6 col-xs-8 col-sm-8"><p><label>Carnes  </label><input onchange="calcularespe(<?php echo $totalespe  ?>,'carne')" onkeypress='return solonumeros(event)' class="form-control " type="number" name="retcarne" placeholder="$"></div>

<?php } ?>
