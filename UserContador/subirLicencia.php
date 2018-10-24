<?php
include '../conection.php';
$id=$_POST['id'];
date_default_timezone_set('America/Santiago');
$idEmpresa=$_POST['id'];
$rutEmpleado=$_POST['rutp'];
$numCont=$_POST['contrato'];
$fechaEmision=$_POST['fecha_emision'];
$inicioReposo=$_POST['inicio_reposo'];
$numeroLicencia=$_POST['numero_lic'];
$fecharepecion=$_POST['recepcion'];
$diasLicencia=$_POST['dias_lic'];
$fecha_prese=Date("Y-m-d");
$Fecha_termino= date("Y-m-d", strtotime("$inicioReposo +$diasLicencia day")); 

 
$subirlic= "INSERT INTO licencia_medica VALUES ('$numeroLicencia','$fechaEmision','$inicioReposo','$diasLicencia','$Fecha_termino','$fecharepecion',NULL,'$numCont','1','Sin Comprobante')";
if ($mysqli->query($subirlic)) {
	            echo'<script>window.location="Mostrar_lic.php?numero_lic='.$numeroLicencia.'";</script>';
                 
}else{
	echo 'No se puedo guardar, verifiqué el numero de licencia';
}
?>