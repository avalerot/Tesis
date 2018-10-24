<link rel="stylesheet" href="css/bootstrap.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php 
$nombreE=$_POST['nombreE'];
$rutE=$_POST['rutE'];
include '../conection.php';



$sql = "UPDATE empresa SET Estado=0 WHERE Rut=$rutE";

if ($mysqli->query($sql)) {
    ?>
    <mensaje>
<div style="height: 50px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div class="hidden-xs hidden-sm col-md-2 col-lg-2"></div>
<div  style="background-color: #F2F2F2; height: 500px; border-color:#5cb85c; border: solid; " class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<center>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
  <h2 style="color: #5cb85c">Empresa <?php echo $nombreE ?> desactivada correctamente</h2>
  <div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
  </center>
  <br><br>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="index.php">Ir a inicio</a></div>
</div>
</center>
</mensaje>

    <?php
} else {
    echo "EERROR INESPERADO " . $mysqli->error;
}


?>