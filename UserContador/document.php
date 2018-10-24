<?php 
$tipo=$_POST['tipo'];
$numeroFAC=$_POST['numero'];
$fin=$_POST['fin'];
$Rut=$_REQUEST['rut'];
include '../conection.php';
//obtener nombre de la empresa 
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$Rut'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];

?>
<!DOCTYPE html>
<html>
<head>


  

	<title>Documento</title>
	<link rel="stylesheet" href="css/bootstrap.css">

   <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


   <script type="text/javascript">
  function confieli(conf){
    if(confirm('¿Seguro que quieres ELIMINAR este documento')){ 
          return true;
      }
      return false;
  }
  </script>
</head>
<body>
<?php 
if($tipo=='' or $numeroFAC=='' or $fin==''){
?>
<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">LLENE TODOS LOS CAMPOS</i>  </div></center></h4>
<?php
}
//COMPRA
if($tipo!='' and $numeroFAC!='' and $fin!='' and $Rut!='' and $fin=='compra'  ){
	if($tipo=='30'){
		$tipo=45;
	}
		if($tipo=='33'){
		$tipo=46;
	}
$doc = $mysqli->query("SELECT numeroFactCompra, TotalFact, TotalNeto, TotalIva, TipoDoc FROM facturacompra WHERE numeroFactCompra='$numeroFAC' and rutEmpre='$Rut' and TipoDoc='$tipo' ");
?>

<div class="container"">

<div class="row">
 <div class="col-md-1 col-lg-1"></div>
  <div class="col-md-10 col-lg-10">
	<div class="row">
 <table class="table table-responsive table-bordered table-hover table-condensed" style="margin:50px 0px 0px 0px;">
    <thead>
    	</a>
    	<tr class="active">

        	<th style='width:10%; text-align:center'>Numero</th>
            <th style='width:20%; text-align:center'>Total</th>
            <th style='width:20%; text-align:center'>Neto</th>
            
            <th style='width:25%; text-align:center'>IVA</th>
                 <th style='width:20%; text-align:center'>Tipo</th>
            <th style='width:5%; text-align:center'>Eliminar</th>
        
      
        </tr>
    </thead>
    <body>
   

</script>
  <?php
  while($row = $doc ->fetch_array()){
  	if($row[4]=='30'){
	$tipoo='Factura';
}
if($row[4]=='33'){
	$tipoo='Factura Electronica';
}
if($row[4]=='34'){
	$tipoo='Factura exenta';
}
if($row[4]=='55'){
	$tipoo='Nota de debito';
}
if($row[4]=='56'){
	$tipoo='Nota de debito electrónica';
}
if($row[4]=='60'){
	$tipoo='Nota de credito ';
}
if($row[4]=='61'){
	$tipoo='Nota de credito electrónica ';
}
if($row[4]=='45'){
	$tipoo='Factura de compra';
}
if($row[4]=='46'){
	$tipoo='Factura de compra electrónica';
}
   ?>
			
					<td style='vertical-align:middle'><?php echo$row[0]?></td>
					<td style='vertical-align:middle'><?php echo$row[1]?></td>
					<td style='vertical-align:middle'><?php echo$row[2]?></td>
					<td style='vertical-align:middle'><?php echo$row[3]?></td>
					<td style='vertical-align:middle'><?php echo$tipoo?></td>
					<td>
										<form action="deleteDoc.php" method="post" >
<input type="hidden" value="<?php echo $Rut ?>" name="Rut">
<input type="hidden" value="<?php echo $row[4] ?>" name="tipo">
<input type="hidden" value="<?php echo "facCompra" ?>" name="tabla">
<input type="hidden" value="<?php echo "$row[0]" ?>" name="desde">
<input type="hidden" value="<?php echo "0" ?>" name="hasta">
	<button type="submit"><img src='../recursos/img/eliminar.png' width='48' height='48'></button>	
</form>
					
					
					
				
				</tr>

		<?php }?>
    </tbody>
 </table>
</div>

   </div>

</div>
</center>

<?php
}

?>



<!-- VENTA -->
<?php

//VENTA
if($tipo!='' and $numeroFAC!='' and $fin!='' and $Rut!='' and $fin=='venta'  ){
if($tipo=='2' or $tipo=='3'  ){



$doc = $mysqli->query("SELECT desde, hasta, total ,neto, totaliva,TipoDoc FROM Boleta WHERE desde='$numeroFAC' and rutEmpre='$Rut' and TipoDoc='$tipo' ");

?>

<div class="container"">

<div class="row">
 <div class="col-md-1 col-lg-1"></div>
  <div class="col-md-10 col-lg-10">
	<div class="row">
 <table class="table table-responsive table-bordered table-hover table-condensed" style="margin:50px 0px 0px 0px;">
    <thead>
    	</a>
    	<tr class="active">

        	<th style='width:10%; text-align:center'>Numero</th>
            <th style='width:20%; text-align:center'>Total</th>
            <th style='width:20%; text-align:center'>Neto</th>
            
            <th style='width:25%; text-align:center'>IVA</th>
                 <th style='width:20%; text-align:center'>Tipo</th>
            <th style='width:5%; text-align:center'>Eliminar</th>
            
      
        </tr>
    </thead>
    <body>
   

</script>
  <?php
  while($row = $doc ->fetch_array()){
  	if($row[5]=='2'){
	$tipoo='Boleta manual';
}
if($row[5]=='3'){
	$tipoo='Boleta Electronica';
 }
 $n=$row[0].'-'.$row[1];
   ?>
			
					<td style='vertical-align:middle'><?php echo$n?></td>
					<td style='vertical-align:middle'><?php echo$row[1]?></td>
					<td style='vertical-align:middle'><?php echo$row[2]?></td>
					<td style='vertical-align:middle'><?php echo$row[3]?></td>
					<td style='vertical-align:middle'><?php echo$tipoo?></td>
			<td>
<form action="deleteDoc.php" method="post" >
<input type="hidden" value="<?php echo $Rut ?>" name="Rut">
<input type="hidden" value="<?php echo $row[5] ?>" name="tipo">
<input type="hidden" value="<?php echo "boleta" ?>" name="tabla">
<input type="hidden" value="<?php echo "$row[0]" ?>" name="desde">
<input type="hidden" value="<?php echo "$row[1]" ?>" name="hasta">
		<button type="submit"><img src='../recursos/img/eliminar.png' width='48' height='48'></button>	
</form>
			</td>
				
					
					
				
				</tr>

		<?php }?>
    </tbody>
 </table>
</div>

   </div>

</div>
</center>

<?php




}else{
$doc = $mysqli->query("SELECT numeroFactVenta, TotalFact, TotalNeto, TotalIva, TipoDoc FROM facturaventa WHERE numeroFactVenta='$numeroFAC' and rutEmpre='$Rut' and TipoDoc='$tipo' ");
?>

<div class="container"">

<div class="row">
 <div class="col-md-1 col-lg-1"></div>
  <div class="col-md-10 col-lg-10">
	<div class="row">
 <table class="table table-responsive table-bordered table-hover table-condensed" style="margin:50px 0px 0px 0px;">
    <thead>
    	</a>
    	<tr class="active">

        	<th style='width:10%; text-align:center'>Numero</th>
            <th style='width:20%; text-align:center'>Total</th>
            <th style='width:20%; text-align:center'>Neto</th>
            
            <th style='width:25%; text-align:center'>IVA</th>
                 <th style='width:20%; text-align:center'>Tipo</th>
            <th style='width:5%; text-align:center'>Eliminar</th>
       
      
        </tr>
    </thead>
    <body>
   

</script>
  <?php
  while($row = $doc ->fetch_array()){
  	if($row[4]=='30'){
	$tipoo='Factura';
}
if($row[4]=='33'){
	$tipoo='Factura Electronica';
}
if($row[4]=='34'){
	$tipoo='Factura exenta';
}
if($row[4]=='55'){
	$tipoo='Nota de debito';
}
if($row[4]=='56'){
	$tipoo='Nota de debito electrónica';
}
if($row[4]=='60'){
	$tipoo='Nota de credito ';
}
if($row[4]=='61'){
	$tipoo='Nota de credito electrónica ';
}
if($row[4]=='45'){
	$tipoo='Factura de compra';
}
if($row[4]=='46'){
	$tipoo='Factura de compra electrónica';
}
   ?>
			
					<td style='vertical-align:middle'><?php echo$row[0]?></td>
					<td style='vertical-align:middle'><?php echo$row[1]?></td>
					<td style='vertical-align:middle'><?php echo$row[2]?></td>
					<td style='vertical-align:middle'><?php echo$row[3]?></td>
					<td style='vertical-align:middle'><?php echo$tipoo?></td>
			<td>
				<form  action="deleteDoc.php" method="post" >
<input type="hidden" value="<?php echo $Rut ?>" name="Rut">
<input type="hidden" value="<?php echo $row[4] ?>" name="tipo">
<input type="hidden" value="<?php echo "facVenta" ?>" name="tabla">
<input type="hidden" value="<?php echo "$row[0]" ?>" name="desde">
<input type="hidden" value="<?php echo "0" ?>" name="hasta">
	<button type="submit"><img src='../recursos/img/eliminar.png' width='48' height='48'></button>	
</form>

			</td>

					
					
				
				</tr>

		<?php }?>
    </tbody>
 </table>
</div>

   </div>

</div>
</center>

<?php
}
}
?>


</body>
</html>

