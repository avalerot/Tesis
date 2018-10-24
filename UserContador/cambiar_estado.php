<?php
	$estado=$_POST['estado'];
	$licencia=$_POST['licencia'];
	include "../conection.php";
	$insert = $mysqli -> query("UPDATE licencia_medica SET estado = '$estado' WHERE id_licencia = '$licencia'");
	if($insert){
		 header("Location: licencia.php?num_lic=$licencia&resultado=1");
	}
	else{
		header("Location: licencia.php?num_lic=$licencia&resultado=0");
		die();
	}
?>