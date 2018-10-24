<?php
$q=$_POST['q'];
$rutsv= explode("-", $q);
include '../conection.php';
$rut=$mysqli->query("SELECT COUNT(rutEmpleado) FROM empleado WHERE rutEmpleado='$q'");
while($row = $rut ->fetch_array()){
	$cuenta=$row[0];
}

if($cuenta==1){
	echo"<p style='padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px' class='bg-danger'>El rut ingresado ya se encuentra registrado</p>
	<a href='fichaEmpleado.php?rut=$rutsv[0]&dv=$rutsv[1]'><button class='btn btn-primary'>Ver Ficha</button></a>"
	;
}
?>
