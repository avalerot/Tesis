<!DOCTYPE html>
<html>
<head>
	<title>xls - VENTA</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
	<?php
include '../../../conection.php';
$Rutempre=$_REQUEST['Rutempre'];
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$Rutempre'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];



$anotrabajo=$_REQUEST['anotrabajo'];
$mestrabajo=$_REQUEST['mestrabajo'];
$aux = $mysqli->query("Select numeroCuenta FROM cuentaCorriente where rutEmpresa='$Rutempre and Estado=1'");
$centroCostos = $mysqli->query("Select nombre FROM centroCostos where rutEmpresa='$Rutempre and Estado=1'");
?>
</head>
<body>


       
     <center><p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Registro archivo xls - VENTA</p></center> 


<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
<div class="col-xs-1 col-sm-1 col-lg-1 col-md-1"></div>
<div class="col-xs-5 col-sm-5 col-lg-5 col-md-5" style="float: left; "><h4>Nombre de empresa: <b><?php echo "$nombreEmpresa";?></b> <br> Rut de la empresa: <b><?php echo "$Rutempre";?> </h4> </div>

<div class="col-xs-5 col-sm-5 col-lg-5 col-md-5" style="float: right; "> <h4>Año de trabajo: <b><?php echo $anotrabajo ?></b>  <br> Mes de trabajo: <b> <?php echo "$mestrabajo"; ?></b></h4></div>

</b> </h4></div>

</br></br></br>


 
 
<form name="importa" method="post" action="subirdatos.php" enctype="multipart/form-data" >

<div class="col-md-2 col-lg-2  "></div>
<div class="col-md-4 col-lg-4  "><label>Cuenta</label>
<select class="form-control" name="aux" required/>
  <option value=""> </option>
      <?php while($rowaux = $aux ->fetch_array()){?>
      <option value="<?php echo"$rowaux[0]" ?>">     <?php echo utf8_encode($rowaux[0])  ?> </option>

      <?php } ?>
</select></div>

<p><div class="col-md-2 col-lg-2  "><label>Centro de costos</label>
<select class="form-control" name="cc"  required>
<option value=""> </option>
	  <?php while($rowcen = $centroCostos  ->fetch_array()){?>
      <option value="<?php echo"$rowcen[0]" ?>">  <?php echo utf8_encode($rowcen[0])  ?> </option>

      <?php } ?>
</select>
	</div></p>
<div class="col-md-2 col-lg-2  "><label>Archivo xls</label><input type="file" name="excel"  required/></div>
<input type="hidden" name="anotrabajo" value="<?php echo $anotrabajo ?>">
<input type="hidden" name="Rutempre" value="<?php echo $Rutempre ?>">
<input type="hidden" name="mestrabajo" value="<?php echo $mestrabajo ?>">
<div style="height: 30px" class="col-lg-12 col-md-12 col-xs-12 col-sm-12"></div>
<div style="height: 10px" class="col-lg-7 col-md-7 col-xs-4 col-sm-4"></div>
<div style="height: 10px" class="col-lg-1 col-md-1 col-xs-3 col-sm-3"><input class="btn btn-primary" type='submit' name='enviar' value="Importar" /></div>

</form>

<div style="height: 10px" class="col-lg-1 col-md-1 col-xs-3 col-sm-3"><a class="btn btn-danger" href="../../../UserContador/opciones.php?rut=<?php echo$Rutempre ?>" />Cancelar</a></div>
<p>

<div style="  margin: 0px 0px 0px 20px; " class="col-lg-12 col-md-12 col-xs-12 col-sm-12"> 
<div style="  margin: 50px 0px 10px 0px; " class="col-lg-12 col-md-12 col-xs-12 col-sm-12"> 

<div style=" border: solid;  margin: 0px 0px 10px 0px; border-radius: 10px 10px 10px 10px; background-color: #F2F2F2; padding: 5px 5px 5px 5px" class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<b>NOTA 1:</b> Solo quedarán registradas las FACTURAS que estén en el archivo XLS. 
</div> 
<div  class="col-lg-1 col-md-1 col-xs-1 col-sm-1"></div> 
<div style="border: solid;  margin: 0px 0px 10px 0px; border-radius: 10px 10px 10px 10px; background-color: #F2F2F2; padding: 5px 5px 5px 5px"  class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<b>NOTA 2:</b> Puedes descargar este archivo de registros desde la página del SII.</div>
<div  class="col-lg-1 col-md-1 col-xs-1 col-sm-1"></div>  
<div style=" border: solid; margin: 0px 0px 10px 0px; border-radius: 10px 10px 10px 10px; background-color: #F2F2F2; padding: 5px 5px 5px 5px"  class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<b>NOTA 3:</b> No modifiques el archivo que bajas desde la página del SII para el registro. </div>
</body>
</html>



 