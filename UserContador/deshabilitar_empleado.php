
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		$contrato=$_POST['numCont'];
		include '../conection.php';
		$select = $mysqli -> query("SELECT Rut FROM empresa M JOIN contrato C ON M.idEmpresa=C.idEmpresa 
							WHERE C.numCont='$contrato'");
		while($row=$select->fetch_array()){
			$rut=$row[0];
		}
		$update = $mysqli -> query("UPDATE contrato SET estado='Inactivo' WHERE numCont='$contrato'");
		if($update){
			echo"<center>";
			echo "<p style='padding: 2px 0px 2px 0px; font-size: 20px' class='bg-primary'>El empleado ha sido deshabilitado</p>";
			echo "<a href='opciones.php?rut=".$rut."'><button type='button' class='btn btn-default'>Ir a Empresa</button></a>";
			echo"</center>";
		}else{
			echo"<center>";
			echo "<p style='padding: 2px 0px 2px 0px; font-size: 20px' class='bg-danger'>Error. No se pudo deshabilitar al empleado</p>";
			echo "<a href='opciones.php?rut=".$rut."' <button type='button' class='btn btn-default'>Ir a Empresa</a>";
			echo"</center>";
		}
?>
</body>
</html>