<?php
	date_default_timezone_set('America/Santiago');
include '../conection.php';
$hoy = date("Y-m-d");
$iva=$_POST['iva'];


$desactivarIva= $mysqli->query("UPDATE iva SET estado = 0 WHERE Estado = 1 ");
   
   	$subiriva= "INSERT INTO iva VALUES (null, '$iva',1,'$hoy')";

       
         if ($mysqli->query($desactivarIva)) {
	           
}else{
	 if ($mysqli->query($subiriva)) {
	
                  header("Location: index.php");
                 }
}
 ?>