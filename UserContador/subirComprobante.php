<?php
$licencia=$_POST['licencia'];
$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];
include "../conection.php";

$select = $mysqli -> query("SELECT C.rutEmpleado FROM contrato C JOIN licencia_medica L ON C.numCont=L.numCont
						WHERE L.id_licencia='$licencia'");
						
while($row = $select -> fetch_array()){
	$rut=$row[0];
}
						
if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 16000000)) 
{
   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      // Ruta donde se guardarán las imágenes que subamos
      $directorio = '../DatosEmpleados/Comprobantes/'.$rut.'/';
	  if(!file_exists($directorio)){
	  	mkdir($directorio);
	  }
	  $extension=explode(".", $_FILES['imagen']['name']);
	  $nombre_img="licencia_".$licencia.".".$extension[1];
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
      $comprobante=$directorio.$nombre_img;
      echo $comprobante;
      $insert = $mysqli -> query("UPDATE licencia_medica SET comprobante='$comprobante'
      						WHERE id_licencia='$licencia'");
	  if(!$insert){
	  	die("No se pudo subir la imagen");
	  }
	  else {
		  header("Location: licencia.php?num_lic=$licencia");
	  }
    } 
    else 
    {
       //si no cumple con el formato
       echo "No se puede subir una imagen con ese formato ";
    }
} 
else 
{
   //si existe la variable pero se pasa del tamaño permitido
   if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
}


?>