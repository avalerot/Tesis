<?php
include "../conection.php";
$contrato=$_POST['numerocontrato'];
$rut=$_POST['rut'];
$pnombre=$_POST['pnombre'];
$snombre=$_POST['snombre'];
$apepat=$_POST['paterno'];
$apemat=$_POST['materno'];
$salud=$_POST['salud'];
$prevision=$_POST['prevision'];
$afiliacion=$_POST['afiliacion'];
$fechacontrato=$_POST['fechacontrato'];

$update = $mysqli -> query("UPDATE empleado E JOIN contrato C ON E.rutEmpleado=C.rutEmpleado SET E.rutEmpleado='$rut',
					E.priNomb='$pnombre',E.segNomb='$snombre',E.apePat='$apepat',E.apeMat='$apemat',E.sistSalud='$salud',
					E.sistPrev='$prevision',E.fecAfil='$afiliacion',C.fecIni='$fechacontrato' WHERE C.numCont='$contrato'" );
$rutsv=explode("-",$rut);
$empresa = $mysqli -> query("SELECT Rut FROM empresa M JOIN contrato C on M.idEmpresa=C.idEmpresa 
						WHERE C.rutEmpleado='$rut' AND C.estado='Activo'");
while($row = $empresa -> fetch_array()){
	$rute=$row[0];
}				
if($update){
	header("Location: fichaEmpleado.php?rut=$rutsv[0]&dv=$rutsv[1]&rute=$rute&resultado=1");
}else{
	header("Location: fichaEmpleado.php?rut=$rutsv[0]&dv=$rutsv[1]&rute=$rute&resultado=0");
	die();
}
?>