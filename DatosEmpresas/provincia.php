

<!--Gonzalo Maldonado Saavedra! Derechos reservados-->


<?php
$qp=$_POST['qp'];

if ($qp!=null){

include '../conection.php';
$provincias = $mysqli->query("Select provincia_numero, nombre_provincia FROM provincias WHERE region_numero='$qp'
         ORDER BY nombre_provincia ASC");
?>

<label>Provincia</label>


<select  class="form-control" id="provincia"  name="provincia" onchange="loadc(this.value)"  >
	 <option value=" ">    </option>
	 <?php while($rowp = $provincias ->fetch_array()){
	 	$prov=$rowp[1];
	 	$nprov=$rowp[0];
$prov= str_replace ( "Provincia de" , " " , $prov  );
	 	?>

      <option value="<?php echo"$nprov" ?>">   <?php echo utf8_encode($prov)  ?> </option>

      <?php } ?>
</select>

<?php }else{} ?>