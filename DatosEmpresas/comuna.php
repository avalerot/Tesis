
<?php

$q=$_POST['q'];

if($q!=null){
include '../conection.php';
$comunas = $mysqli->query("Select comuna_numero, Nombre_comuna FROM comunas WHERE  provincia_numero='$q'
         ORDER BY Nombre_comuna ASC");
?>

<label>Comuna</label>
<select onblur="getComuna(this.value)" class="form-control" type="text"  >
		<option value=""></option>
	 <?php while($row = $comunas ->fetch_array()){ ?>

      <option value="<?php echo $row[0] ?>"> <?php echo utf8_encode($row[1])  ?> </option>

      <?php } ?>
</select>


<?php }else{} ?>

