<?php
session_start();
if(!isset($_SESSION["session_username"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username"]);
?>
 
<link rel="stylesheet" href="css/bootstrap.css">

   <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<?php 
include '../conection.php';
$Rut=$_POST['Rut'];
$tipo=$_POST['tipo'];
$tabla=$_POST['tabla'];
$desde=$_POST['desde'];
$hasta=$_POST['hasta'];

if(isset($_POST['confi'])){
$confi=$_POST['confi'];
//FAC COMPRA
 if($confi=='1'){

 	$deletesec = "DELETE FROM secuenciafactcompra WHERE rutEmpre='$Rut' AND TipoDoc='$tipo' and NumeroFact='$desde' ";

if ($mysqli->query($deletesec)) {

  $delete = "DELETE FROM facturacompra WHERE rutEmpre='$Rut' AND TipoDoc='$tipo' and numeroFactCompra='$desde' ";

if ($mysqli->query($delete)){
?>
<h4>
	<center>
<div style="margin: 20px 0px 20px 0px " class="alert alert-success" role="alert">Documento<i> Nº <?php echo$desde ?></i> eliminado correctamente</i> </div></center></h4>


<?php


}else{
	echo"factura fallo";
}

} else {
   echo"secuencia fallo"; 
}

?>

<?php

}
//FAC VENTA
if($confi=='2'){

	$deletesec = "DELETE FROM secuenciafactventa WHERE rutEmpre='$Rut' AND TipoDoc='$tipo' and NumeroFact='$desde' ";

if ($mysqli->query($deletesec)) {

  $delete = "DELETE FROM facturaventa WHERE rutEmpre='$Rut' AND TipoDoc='$tipo' and numeroFactVenta='$desde' ";

if ($mysqli->query($delete)){
?>
<h4>
	<center>
<div style="margin: 20px 0px 20px 0px " class="alert alert-success" role="alert">Documento<i> Nº <?php echo$desde ?></i> eliminado correctamente</i> </div></center></h4>

<?php


}else{
	echo"factura fallo";
}

} else {
   echo"secuencia fallo"; 
}
?>

<?php
}
//FAC BOLETA
if($confi=='3'){


  $delete = "DELETE FROM boleta WHERE rutEmpre='$Rut' AND TipoDoc='$tipo' and desde='$desde' and hasta='$hasta' ";

if ($mysqli->query($delete)){
	?>
<h4>
	<center>
<div style="margin: 20px 0px 20px 0px " class="alert alert-success" role="alert">Documento<i> Nº <?php echo$desde ?> - <?php echo$hasta ?></i> eliminado correctamente</i> </div></center></h4>
	<?php
echo"Factura eliminada correctamente";


}else{
	echo"factura fallo";
}


?>


<?php
}
?>
<div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><a href="opciones.php?rut=<?php echo$Rut ?>" class="btn btn-primary">Opciones</a></div>
<?php 
}else{

if($tabla=='facCompra'){
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="confi" value="1" >
<input type="hidden" name="Rut" value="<?php echo $Rut ?>" >
<input type="hidden" name="tipo" value="<?php echo $tipo ?>" >
<input type="hidden" name="tabla" value="<?php echo $tabla ?>" >
<input type="hidden" name="desde" value="<?php echo $desde ?>" >
<input type="hidden" name="hasta" value="<?php echo $hasta ?>" >
<center>
<div class="hidden-xs hidden-sm-12 col-md-3 col-lg-3"></div>
<div style="background-color: #ccc; padding: 10px 10px 10px 10px; border: solid; margin: 50px 0px 0px 0px" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	<label>Estas seguro que deseas eliminar permanentemente el documento de compra Nº <?php echo $desde ?> de la empresa <?php echo $Rut ?> </label>

	<p><div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" class="btn btn-primary">Confirmar</button></div>
<div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><a href="opciones.php?rut=<?php echo$Rut ?>" class="btn btn-danger">Cancelar</a></div>
	</p>
</div>
</center>

</form>

<?php

}
if($tabla=='facVenta'){
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="confi" value="2" >
<input type="hidden" name="Rut" value="<?php echo $Rut ?>" >
<input type="hidden" name="tipo" value="<?php echo $tipo ?>" >
<input type="hidden" name="tabla" value="<?php echo $tabla ?>" >
<input type="hidden" name="desde" value="<?php echo $desde ?>" >
<input type="hidden" name="hasta" value="<?php echo $hasta ?>" >
<center>
<div class="hidden-xs hidden-sm-12 col-md-3 col-lg-3"></div>
<div style="background-color: #ccc; padding: 10px 10px 10px 10px; border: solid; margin: 50px 0px 0px 0px" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	<label>Estas seguro que deseas eliminar permanentemente el documento de venta Nº <?php echo $desde ?> de la empresa <?php echo $Rut ?> </label>

	<p><div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" class="btn btn-primary">Confirmar</button></div>
<div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><a href="opciones.php?rut=<?php echo$Rut ?>" class="btn btn-danger">Cancelar</a></div>
	</p>
</div>
</center>

</form>
<?php
}

if($tabla=='boleta'){
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="confi" value="3" >
<input type="hidden" name="Rut" value="<?php echo $Rut ?>" >
<input type="hidden" name="tipo" value="<?php echo $tipo ?>" >
<input type="hidden" name="tabla" value="<?php echo $tabla ?>" >
<input type="hidden" name="desde" value="<?php echo $desde ?>" >
<input type="hidden" name="hasta" value="<?php echo $hasta ?>" >
<center>
<div class="hidden-xs hidden-sm-12 col-md-3 col-lg-3"></div>
<div style="background-color: #ccc; padding: 10px 10px 10px 10px; border: solid; margin: 50px 0px 0px 0px" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	<label>Estas seguro que deseas eliminar permanentemente las boletas desde <?php echo $desde ?> hasta <?php echo $hasta ?>  de la empresa <?php echo $Rut ?> </label>

	<p><div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" class="btn btn-primary">Confirmar</button></div>
<div class="col-md-2 col-lg-2 "  style="padding: 5px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><a href="opciones.php?rut=<?php echo$Rut ?>" class="btn btn-danger">Cancelar</a></div>
	</p>
</div>
</center>

</form>

<?php
}
}

}
?>