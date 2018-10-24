<?php 
$rutRat=$_POST['e'];


include '../../../conection.php';
$razon = $mysqli->query("SELECT nombreRazon FROM Razonsoc where rutRazon='$rutRat'");
$razons = mysqli_fetch_array($razon, MYSQLI_NUM);
$razonSoc=$razons[0];


$razoncount = $mysqli->query("SELECT count(nombreRazon) FROM Razonsoc where rutRazon='$rutRat'");
$razonscou = mysqli_fetch_array($razoncount, MYSQLI_NUM);
$razonscouf=$razonscou[0];


if ($razonscouf==1){ ?>
<label>Razon social</label><input  class="form-control" name="razonsoc" value="<?php echo$razonSoc ?>" type="text" readonly >


<?php
$razonscouf=0;
$razonSoc=null;

}else{ ?>
<label>Razon social</label><input minlength="6"  class="form-control" name="razonsoc"  autocomplete="off" onkeyup="this.value=this.value.toUpperCase()"  type="text" required  >

<?php

}


?>



