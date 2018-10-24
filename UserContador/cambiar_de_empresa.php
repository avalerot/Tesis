<?php
$rut=$_POST['rutempleado'];
$id=$_POST['idempresa'];
$idantiguo=$_POST['idantiguo'];
$contrato=$_POST['contrato'];
$numCont=$_POST['numCont'];
try{
	$mbd = new PDO("mysql:host=localhost;dbname=licencia","root","");
}catch(exception $e){
	die("No se pudo conectar a la base de datos".$e->getMessage());
}

try{
	$mbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$mbd->beginTransaction();
	$mbd->exec("UPDATE contrato SET estado='Inactivo' WHERE numCont='$numCont'");
	$mbd->exec("INSERT INTO contrato (idEmpresa,rutEmpleado,fecIni,estado) VALUES ('$id','$rut','$contrato','Activo')");
	$mbd->commit();
	header("Location: cambio_empresa.php?rut=$rut&id=$id&idantiguo=$idantiguo");
}catch(exception $e){
	$mbd->rollBack();
  	echo "Error. No se realizó el cambio de empresa" . $e->getMessage();
}

$mbd=null;
?>