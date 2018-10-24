<!DOCTYPE html>
<html>
<head>
	<title>Facturas electrónica de venta</title>
	<!-- Latest compiled and minified CSS -->
<!-- Scrip para ventana modal -->
<script type="text/javascript">
	
	function modal(rut,cd,anotrabajo,fecha,mestrabajo,numero,aux,Rutempre,cc,razon,totalespe,div,url){
$.post(
	url,
{rut:rut,cd:cd,anotrabajo:anotrabajo,fecha:fecha,mestrabajo:mestrabajo,numero:numero,aux:aux,Rutempre:Rutempre,cc:cc,razon:razon,totalespe:totalespe},
function(resp){

	$("#"+div+"").html(resp);
}

	);

	}


	function modalespe(esbebidas,espdisel,espiscos,esvinos,retharina,retcarne,div,url){
$.post(
	url,
{esbebidas:esbebidas,espdisel:espdisel,espiscos:espiscos,esvinos:esvinos,retharina:retharina,retcarne,retcarne},
function(resp){

	$("#"+div+"").html(resp);
}

	);

	}





</script>
</head>
<body>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">

  </div>


  <!--FIN Modal -->
<?php 


?>





<table class="table table-hover">
 <tr class="active">
        	<th style='width:5%; text-align:center'>Cuenta de abono</th>
            <th style='width:5%; text-align:center'>neto</th>
            
            <th style='width:5%; text-align:center'>iva</th>
                <th style='width:5%; text-align:center'>Esp Y Ret</th>
              <th style='width:5%; text-align:center'>Total</th>
              <th style='width:5%; text-align:center'>Eliminar</th>
      
 
        </tr>
<!-- ----------------------------------------------------------------- -->

        
        <?php 


        if(isset($largosecu)){
$largosecu=$largosecu;
}else{
$largosecu=0;

}
if (isset($_SESSION["arraySecuen"])) {
	$totaltodo=0;
	$totaliva=0;
	$totalEsyRet=0;
	$totalneto=0;

foreach ($_SESSION["arraySecuen"] as $key => list($total,$ivapes,$abono,$neto,$espeSec,$espdisel,$espiscos,$esvinos,$esbebidas,$retcarne,$retharina)) {
$totaltodo=$totaltodo+$total;
$totaliva=$totaliva+$ivapes;
$totalEsyRet=$totalEsyRet+$espdisel+$espiscos+$esbebidas+$esvinos+$retharina+$retcarne;
$totalneto=$totalneto+$neto;
$espeSec=$espdisel+$espiscos+$esbebidas+$esvinos+$retharina+$retcarne;

        ?>

        <tr href="javascript:void(0);"  onclick="modalespe('<?php echo$esbebidas ?>','<?php echo$espdisel ?>','<?php echo$espiscos ?>','<?php echo$esvinos ?>','<?php echo$retharina ?>','<?php echo$retcarne ?>','myModal','detalleEspe.php');"  data-toggle="modal" data-target="#myModal"  >
			<td style='vertical-align:middle'><?php echo $abono?></td>
					<td style='vertical-align:middle'><?php echo $neto?></td>
				
					<td style='vertical-align:middle'><?php echo $ivapes?></td>        
					<td style='vertical-align:middle'><?php echo $espeSec ?></td>
						<td style='vertical-align:middle'><?php echo $total?></td>
					<td style='vertical-align:middle'> <center><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
						<input type="hidden" value="<?php echo $key ?>" name="i">
						<input type="hidden" value="<?php echo $fecha ?>" name="fecha">
						<input type="hidden" value="<?php echo $mestrabajo ?>" name="mestrabajo">
						<input type="hidden" value="<?php echo $numero ?>" name="numero">
						<input type="hidden" value="<?php echo $rut ?>" name="Rut">
						<input type="hidden" value="<?php echo $cd ?>" name="cd">
						<input type="hidden" value="<?php echo $anotrabajo ?>" name="anotrabajo">
						<input type="hidden" value="<?php echo $aux ?>" name="aux">
						<input type="hidden" value="<?php echo $cc ?>" name="cc">
						<input type="hidden" value="<?php echo $Rutempre ?>" name="Rutempre">
						<input type="hidden" value="<?php echo $Razon ?>" name="razonsoc">
						<input type="hidden" value="<?php echo $totalespe ?>" name="totalespe">
						<button  class="btn btn-primary" type="submit"><img src="../../../recursos/img/eliminar.png" width="20px" height="20px"></button>
					</form></td>
				
				</tr>



				<?php } ?> 
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<p style="align-content: center;" class="bg-info">
<?php echo "<b>Total:<b/> $ $totaltodo || <b>IVA:<b/> $ $totaliva || <b>Esp y Ret:<b/> $ $totalEsyRet || <b>Neto:<b/> $ $totalneto";?></div></p>
				<?php  }else{



}?>

 
</table>
<!-- Boton para abrir ventana modal e ingresar detalle de factura-->
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
<a class="btn btn-success" href="javascript:void(0);" onclick="modal('<?php echo$rut ?>','<?php echo$cd ?>','<?php echo$anotrabajo ?>','<?php echo$fecha ?>','<?php echo$mestrabajo ?>','<?php echo$numero ?>','<?php echo$aux ?>','<?php echo$Rutempre ?>','<?php echo$cc ?>','<?php echo$Razon ?>','<?php echo$totalespe ?>','myModal','Form_DetalleFctrs.php');" id="agregar_licencia" data-toggle="modal" data-target="#myModal">Agregar secuencia </a>
<a href="descartarFactura.php?Rutempre=<?php echo $Rutempre ?>&anotrabajo=<?php echo $anotrabajo ?>&mestrabajo=<?php echo $mestrabajo?>" onclick=""  class="btn btn-warning" >Descartar</a>
<div  style="height: 10px " class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<form action="subirFacManual.php" method="post">
<input type="hidden" value="<?php echo$rut ?>" name="rut">
<input type="hidden" value="<?php echo$Rutempre ?>" name="Rutempre">
<input type="hidden" value="<?php echo$mestrabajo ?>" name="mestrabajo">
<input type="hidden" value="<?php echo$anotrabajo ?>" name="anotrabajo">
<input type="hidden" value="<?php echo$numero ?>" name="numero">
<input type="hidden" value="<?php echo$fecha ?>" name="fecha">
<input type="hidden" value="<?php echo$cd ?>" name="cd">
<input type="hidden" value="<?php echo$aux ?>" name="aux">
<input type="hidden" value="<?php echo$cc ?>" name="cc">
<input type="hidden" value="<?php echo$Razon ?>" name="razon">
<input type="hidden" value="<?php echo$totalespe ?>" name="totalespe">


<button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registrar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button> 
</form>
</div>
<div style="height: 10px" class="hidden-lg hidden-md- col-sm-12 col-xs-12"></div>

</body>
</html>