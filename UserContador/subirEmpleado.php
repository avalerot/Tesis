<?php
$idEmpresa=htmlspecialchars($_POST['empresa']);
$rut=htmlspecialchars($_POST['rut']);
$nombre1=htmlspecialchars($_POST['nombre1']);
$nombre2=htmlspecialchars($_POST['nombre2']);
$apellido1=htmlspecialchars($_POST['apellido1']);
$apellido2=htmlspecialchars($_POST['apellido2']);
$salud=htmlspecialchars($_POST['salud']);
$prevision=htmlspecialchars($_POST['prevision']);
$contrato=htmlspecialchars($_POST['contrato']);
$afiliacion=htmlspecialchars($_POST['afiliacion']);

echo $idEmpresa.$rut.$nombre1.$nombre2.$apellido1.$apellido2.$salud.$prevision.$contrato.$afiliacion;

include '../conection.php';
$insert =mysqli_query($mysqli,"INSERT INTO  empleado (rutEmpleado,priNomb,segNomb,apePat,apeMat,sistSalud,sistPrev,fecAfil) 
			VALUES ('$rut','$nombre1','$nombre2','$apellido1','$apellido2','$salud','$prevision','$afiliacion')");
$insert2 = mysqli_query($mysqli,"INSERT INTO contrato (idEmpresa,rutEmpleado,fecIni,estado) VALUES ('$idEmpresa','$rut','$contrato',
			'Activo')");
$select = $mysqli->query("SELECT Rut FROM empresa WHERE idEmpresa='$idEmpresa'");
while($row = $select -> fetch_array()){
	$rute=$row[0];
}
$rutsv=explode("-", $rut);		
if($insert && $insert2){
	echo "Datos ingresados correctamente";
	header("Location: fichaEmpleado.php?rut=$rutsv[0]&dv=$rutsv[1]&rute=$rute");
}
else{
	die("Fallo en la inserción de datos");
}

?>