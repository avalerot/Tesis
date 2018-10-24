<?php 
include '../../../conection.php';
$Rutempre=$_REQUEST['Rutempre'];
$anotrabajo=$_REQUEST['anotrabajo'];
$mestrabajo=$_REQUEST['mestrabajo'];
if($Rutempre!='' and $mestrabajo!='' and $anotrabajo!=''){
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$Rutempre'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
$aux = $mysqli->query("Select numeroCuenta FROM cuentaCorriente where rutEmpresa='$Rutempre and Estado=1'");
$centroCostos = $mysqli->query("Select nombre FROM centroCostos where rutEmpresa='$Rutempre and Estado=1'");

$ivaAct = $mysqli->query("SELECT porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$iva=$iva[0];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Boleta</title>
		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
  function obteneriva(total){
  var ivapor=document.getElementById("poriva").value;
  var ivaporfinal=ivapor*0.01;

  var valoriva=Math.round(total*ivaporfinal);
  var valorNeto=Math.round(parseInt(total)-parseInt(valoriva));


  document.getElementsByName("neto")[0].value =valorNeto;
   document.getElementsByName("totaliva")[0].value =valoriva;

  }
</script>
</head>
<body>
<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Ingreso de boleta electrónica de venta<b><?php echo" $nombreEmpresa - $Rutempre" ?></b></p></center>
</center>

<div class="row">
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>
<div class="col-md-8 col-xs-10 col-lg-8 col-sm-10" style="border: solid; padding-bottom: 10px; margin: 0px 0px 10px 0px" >
<form method="post" action="subirboleta.php">
<p><div class="col-md-4 col-lg-4  "><label>Cuenta</label>
<select class="form-control" name="aux" required/>
  <option value=""> </option>
      <?php while($rowaux = $aux ->fetch_array()){?>
      <option value="<?php echo"$rowaux[0]" ?>">     <?php echo utf8_encode($rowaux[0])  ?> </option>

      <?php } ?>
</select>
</p>
</div>
<p><div class="col-md-4 col-lg-4 "><label>Tipo</label><input class="form-control" id="disabledInput" type="text" placeholder="Boleta electrónica" readonly></div></p>
    <p><div class="col-md-2 col-lg-2 "><label>Desde</label><input onkeypress='return solonumeros(event)' class="form-control" name="desde" type="text" ></div></p>
    <p><div class="col-md-2 col-lg-2 "><label>hasta</label><input onkeypress='return solonumeros(event)' class="form-control" name="hasta" type="text" ></div></p>
<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>
<p><div class="col-md-3 col-lg-3  "><label>total</label><input onchange="obteneriva(this.value)"  class="form-control"  name="total" type="text" placeholder="$" ></div></p>
	
	<p><div class="col-md-2 col-lg-2 "><label>Año de trabajo</label><input  class="form-control" name="anotrabajo" value="<?php echo$anotrabajo ?>" type="text" placeholder="<?php echo$anotrabajo?>" readonly></div></p>
<p><div class="col-md-2 col-lg-2  "><label>Mes de trabajo</label><input class="form-control" name="mestrabajo" value="<?php echo$mestrabajo ?>" type="text" placeholder="<?php echo$mestrabajo?>" readonly></div></p>
	<p><div class="col-md-3 col-lg-3  "><label>Fecha emisión</label><input class="form-control" name="fecha" type="date" placeholder="fecha" required></div></p>



	<p><div class="col-md-2 col-lg-2  "><label>Centro de costos</label>
<select class="form-control" name="cc"  required>
<option value=""> </option>
	  <?php while($rowcen = $centroCostos  ->fetch_array()){?>
      <option value="<?php echo"$rowcen[0]" ?>">  <?php echo utf8_encode($rowcen[0])  ?> </option>

      <?php } ?>
</select>
	</div></p>

<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>
<p><div class="col-md-3 col-lg-3  "><label>Neto</label><input  class="form-control"   name="neto" type="text"  readonly></div></p>


<p><div class="col-md-3 col-lg-3  "><label>iva</label><input   class="form-control"  name="totaliva" type="text"  readonly></div></p>

<p><div class="col-md-1 col-lg-1  "><label>%iva</label><input   class="form-control"  value="<?php echo $iva ?>" id="poriva" name="poriva" type="text"  readonly></div></p>


	<input name="Rutempre" type="hidden" value="<?php echo$Rutempre ?>" ></div>
	<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 10px"></div>
<div class="col-md-8 col-lg-8 col-sm-5 col-xs-5 "></div>
    <div class="col-md-1 col-lg-1 col-sm-7 col-xs-7 "><button type="submit" class="btn btn-success">&nbsp;Registrar&nbsp;</button></div>
    <div style="height: 10px" class="hidden-md hidden-lg col-sm-12 col-xs-12 "></div>
<div class="hidden-md hidden-lg col-sm-5 col-xs-5 "></div>
        <div class="col-md-3 col-lg-3 col-sm-7 col-xs-7 "><a href="../../../opciones.php?rut=<?php echo$Rutempre ?>" class="btn btn-primary">ir a opciones</a></div>
</form>
</div>
</div>
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>

</body>
</html>
<?php }else{

	header('Location: ../../../UserContador/index.php');
	} ?>