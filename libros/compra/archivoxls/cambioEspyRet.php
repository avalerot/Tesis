
<?php
$esp=$_POST['esp'];
$tipo=$_POST['tipo'];
$espTotal=$_POST['espTotal'];
$rutEmpre=$_POST['rutEmpre'];
$numFac=$_POST['numFac'];
$numSec=$_POST['numSec'];
$item=$_POST['item'];
$totaActualEsp=0;
include '../../../conection.php';
$incam=0;

//echo "$esp - $tipo - $espTotal - $rutEmpre - $numFac - $numSec - $item";

$cambEspyRet = "UPDATE secuenciafactcompra SET $tipo='$esp' WHERE rutEmpre='$rutEmpre' AND NumeroFact='$numFac'AND numSec='$numSec' AND TipoDoc=33 ";

if ($mysqli->query($cambEspyRet)) {
   
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

//Sacar total especificos subido para que no sobrepase el especifico Total
$totales = $mysqli->query("SELECT EspeDisel, EspePisco, EspeBebida,EspeVinos,RetCarne,RetHarina FROM secuenciafactcompra where rutEmpre='$rutEmpre' AND NumeroFact='$numFac' AND TipoDoc=33 ");

while($espePor = $totales ->fetch_array()){
	$EspeDisel=$espePor[0];
$EspePisco=$espePor[1];
$EspeBebida=$espePor[2];
$EspeVinos=$espePor[3];
$RetCarne=$espePor[4];
$RetHarina=$espePor[5];
$totaActualEsp=$EspeDisel+$EspePisco+$EspeBebida+$EspeVinos+$RetCarne+$RetHarina+$totaActualEsp;
}


//echo"$totaActualEsp";
if($totaActualEsp>$espTotal){
$cambEspyRet2 = "UPDATE secuenciafactcompra SET EspeDisel=0, EspePisco=0, EspeBebida=0,EspeVinos=0,RetCarne=0,RetHarina=0 WHERE rutEmpre='$rutEmpre' AND NumeroFact='$numFac'AND numSec='$numSec' AND TipoDoc=33  ";
if ($mysqli->query($cambEspyRet2)) {
$incam=1
	
   ?>
<img class="hidden-xs hidden-md hidden-lg hidden-md" src="carga.png" onload="espeacero(<?php echo $item ?>)" >




   <?php

} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}


?>
