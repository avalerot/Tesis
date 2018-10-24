
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	<title>Registrar empresa</title>
	<link rel="stylesheet" href="../recursos/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="../recursos/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="../recursos/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php
include '../conection.php';
$nombreEmpre=$_POST['nombreEmp'];
$rut=$_POST['Rut'];
$verificador=$_POST['cd'];
$comuna=$_POST['comu'];
$mail=$_POST['mail'];
$ncel=$_POST['ncel'];
$nfijo=$_POST['nfij'];
$region=$_POST['region'];
$calle=$_POST['calle'];
$numeroDirec=$_POST['numeroDirec'];
$codigodirect=$rut;
$cc1=$_POST['cc1'];
$ca1=$_POST['ca1'];



if($nombreEmpre!=null AND $rut!=null AND $verificador!=null AND $comuna!=null AND $calle!=null AND $numeroDirec!=null AND $cc1!=null AND $ca1 !=null AND $ncel!=null and $mail!=null){

   $subirempresa= "INSERT INTO empresa VALUES (null, '$rut','$verificador','$nombreEmpre',1,'$mail','$ncel','$nfijo','$comuna')";

	            if ($mysqli->query($subirempresa)) {
//Crear carpeta de empresa
$nombre_carpeta = "Empresas/$rut"; 

if(!is_dir($nombre_carpeta)){ 
@mkdir($nombre_carpeta, 0777); 
chmod($nombre_carpeta,0777);
}else{ 
}


	            	//codigobarra

require_once "Image/Barcode2.php";
 $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : $rut;
$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'Code128';
$imgtype = isset($_REQUEST['imgtype']) ? $_REQUEST['imgtype'] : 'jpg';
$direct='Empresas/'.$rut.'/'.$num.'.jpg';
imagepng(Image_Barcode2::draw($num, $type,  false), 
$direct);
//CODIGO QR -----------------------------------------------------------------
 include('phpqrcode/qrlib.php'); 
     
 
     
    $tempDir = 'Empresas/'.$rut.'';
     
    $codeContents = 'www.contadores.cl/qrconsulta.php?rut='.$rut; 

    $fileName = $rut.md5($codeContents).'.png'; 
     
    $pngAbsoluteFilePath = $tempDir.'/'.$fileName; 
    $urlRelativeFilePath = 'Empresas/'.$rut.''.$fileName; 
     
   
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($codeContents, $pngAbsoluteFilePath); 
        
    } else { 
        
    }    


$cod= "INSERT INTO codigo VALUES (null, '$rut','$direct','$pngAbsoluteFilePath',1)";
            if ($mysqli->query($cod)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado con los codigos... Intentalo otra vez</a>
</div></center>';}





     $detalledireccion= "INSERT INTO detalledirecion VALUES (null, '$calle','$numeroDirec','$comuna',1,'$rut')";
            if ($mysqli->query($detalledireccion)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error la dirección de la empresa... Intentalo otra vez</a>
</div></center>';}



$centroCostos= "INSERT INTO centrocostos VALUES (null, '$cc1','$rut',1)";
            if ($mysqli->query($centroCostos)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}


$cuentaAux= "INSERT INTO cuentacorriente VALUES (null, '$ca1','$rut',1)";
            if ($mysqli->query($cuentaAux)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}



//-------------------------------------------------------------


if(isset($_POST['cc2']) and $_POST['cc2']!=null){
	//cuando estan
	$cc2=$_POST['cc2'];

	$centroCostos= "INSERT INTO centrocostos VALUES (null, '$cc2','$rut',1)";
            if ($mysqli->query($centroCostos)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}
}else{


}

if(isset($_POST['cc3']) and $_POST['cc3']!=null){
	//cuando estan
	$cc3=$_POST['cc3'];
$centroCostos= "INSERT INTO centrocostos VALUES (null, '$cc3','$rut',1)";
            if ($mysqli->query($centroCostos)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}
}else{


}

//-------------------------------------------------------------


if(isset($_POST['ca2']) and $_POST['ca2']!=null){
	//cuando estan
	$ca2=$_POST['ca2'];
	$cuentaAux= "INSERT INTO cuentacorriente VALUES (null, '$ca2','$rut',1)";
            if ($mysqli->query($cuentaAux)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}
}else{


}

if(isset($_POST['ca3']) and $_POST['ca3']!=null){
	//cuando estan
	$ca3=$_POST['ca3'];
	$cuentaAux= "INSERT INTO cuentacorriente VALUES (null, '$ca3','$rut',1)";
            if ($mysqli->query($cuentaAux)) {

                 }else{echo'
	<center>
	<div class="alert alert-danger" role="alert">
  <a href="../UserContador/index.php" class="alert-link">Ocurrio un error inesperado... Intentalo otra vez</a>
</div></center>';}
}else{


}
?>

<mensaje>
<div style="height: 50px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div class="hidden-xs hidden-sm col-md-2 col-lg-2"></div>
<div  style="background-color: #F2F2F2; height: 500px; border-color:#5cb85c; border: solid; " class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<center>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
	<h2 style="color: #5cb85c">Empresa <?php echo $nombreEmpre ?> registrada correctamente</h2>
  <div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
  </center>
  <br><br>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="../UserContador/index.php">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Ir al inicio &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></div>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="../UserContador/listaEmpresas.php">Ir a la lista de empresas</a></div>
</div>
</center>
</mensaje>







<?php

                }else{echo'

<mensaje>
<div style="height: 50px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
<div class="hidden-xs hidden-sm col-md-2 col-lg-2"></div>
<div  style="background-color: #F2F2F2; height: 500px; border-color:#5cb85c; border: solid; " class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<center>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
  <h2 style="color: #C62300">Empresa '.$nombreEmpre.' ya está en los registros</h2>
  <div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"></div>
  </center>
  <br><br>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="../UserContador/index.php">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Ir al inicio &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></div>
<div style="height: 150px" class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a class="btn btn-primary" href="../UserContador/listaEmpresas.php">Ir a la lista de empresas</a></div>
</div>
</center>
</mensaje>





';}


}else{
header("../UserContador/index.php");
}



    
    //------------------------------------------------------------------

    



?>
</body>
</html>
