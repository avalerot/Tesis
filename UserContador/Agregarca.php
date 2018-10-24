
<?php
session_start();
if(!isset($_SESSION["session_username"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username"]);
?>
 <link rel="stylesheet" href="css/bootstrap.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
$nombreE=$_POST['nombreE'];
$rutE=$_POST['rutE'];
$ca=$_POST['ca'];
include '../conection.php';
$insert= mysqli_query($mysqli,"INSERT INTO cuentacorriente  VALUES (null,'$ca','$rutE',1)");
			
if($insert){
?>
<mensaje>
<div style="height: 50px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div class="hidden-xs hidden-sm col-md-2 col-lg-2"></div>
<div  style="background-color: #F2F2F2; height: 500px; border-color:#5cb85c; border: solid; " class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<center>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
	<h2 style="color: #5cb85c">Cuenta auxiliar <?php echo $ca ?> registrada correctamente en la empresa <?php echo $nombreE ?></h2>
  <div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
  </center>
  <br><br>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="opciones.php?rut=<?php echo $rutE ?>">Ir a opciones</a></div>
</div>
</center>
</mensaje>
<?php
}
else{
	echo'
	<div style="margin-top: 50px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> </div>
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="opciones.php?rut='.$rutE.'" class="alert-link">Cuenta auxiliar no registrada --> presiona aquí para volver</a>
</div></center>';
}
}
?>
