
<?php
session_start();
if(!isset($_SESSION["session_username"])) {
 header("location:login.php");
} else {
?>
 
<!--Gonzalo Maldonado Saavedra! Derechos reservados-->

 

 
<?php

}
?>
<?php
$q=$_POST['q'];
if($q=='Fonasa'){
?>


<?php }else{ ?>

  <p><label>Nombre de isapre  </label>
<select  class="form-control " name="Nombre_Isapre" required>

   <option value=""> </option>
  <option value="Cruz Blanca"> Cruz Blanca </option>
  <option value="banmedica"> banmedica </option>
   <option value="Más Vida"> Más Vida </option>
  <option value="Vida Tres"> Vida Tres </option>
  <option value="Colmena"> Colmena </option>
  <option value="Con Salud"> Con Salud </option>

</select>

<?php } ?>
