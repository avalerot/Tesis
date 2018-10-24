<?php 
include '../../conection.php';
$Rutempre=$_REQUEST['Rutempre'];
$anotrabajo=$_REQUEST['anotrabajo'];
$mestrabajo=$_REQUEST['mestrabajo'];
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$Rutempre'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
//--------------------------FACTURAS
$tot = $mysqli->query("SELECT sum(TotalFact),sum(TotalIva),sum(TotalNeto),sum(TotalExento),sum(TotalEspyRet) FROM facturacompra where Mestrab='$mestrabajo'  AND anoTrab='$anotrabajo' and rutEmpre='$Rutempre' ");
$tota = mysqli_fetch_array($tot, MYSQLI_NUM);
$totalfacs=$tota[0];
$totaliva=$tota[1];
$netooo=$tota[2];
$exeen=$tota[3];
$espe=$tota[4];


//--------------CALCULANDO TOTALES---------------------S
$todototal=$totalfacs;
$todoiva=$totaliva;
$todoneto=$netooo;





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Libro y Resumen</title>
<!--Gonzalo Maldonado Saavedra!-->
<script src="ajax1.js"></script>
<!-- Gonzalo Salvador Maldonado Saavedra -->
<link rel="stylesheet" href="../../UserContador/css/bootstrap.css">

<!-- jQuery library -->




	<link rel="stylesheet" type="text/css" href="../../recursos/tabladinamic/jquery.dataTables.min.css">
	
	<script type="text/javascript" language="javascript" src="../../recursos/tabladinamic/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="../../recursos/tabladinamic/jquery.dataTables.min.js">
	</script>
	
<script type="text/javascript" class="init">
	
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- Latest compiled JavaScript -->
<script src="css/jquery.Jcrop.min.css"></script>


<!--------------------------------------------------------------------------------------- -->
<?php   


//CONSULTAS PARA MOSTRAR EN LA TABLAS
$fac = $mysqli->query("SELECT numeroFactCompra, TotalFact, TotalNeto, TotalIva, TotalEspyRet,TotalExento ,TipoDoc FROM facturacompra WHERE Mestrab='$mestrabajo'  AND anoTrab='$anotrabajo' and rutEmpre='$Rutempre' ");



			 ?>
    
<!--------------------------------------------------------------------------------------- -->
</head>

<body>




<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Resumen de compra de la empresa <?php echo $nombreEmpresa ?> - <?php echo $Rutempre ?></</p></center>
   <p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-danger" id="aler"> </p>
<div class="container">


	
	<div class="container-fluid">



  <div  class="col-xs-5 col-sm-5 col-md-2">
  <a href="../../UserContador/opciones.php?rut=<?php echo$Rutempre ?>" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volver a opciones&nbsp;&nbsp;&nbsp;&nbsp;</a>
  </div>
  
 </div>

<div class="container" style="margin:30px 0px 0px 0px">

<div class="row">
  <div class="col-md-12">
<div class="row">
<center>
	<div style="border: solid; height: 100px; margin: 0px 0px 20px 0px" class="col-xs-12 col-sm-12 col-md-12">
		<h4 style="margin: 5px 0px 25px 0px ">Resume del mes <?php echo $mestrabajo ?> del año <?php echo $anotrabajo ?></h4>
		<h5>
Total:<?php echo $todototal ?>  || Total neto: <?php echo $todoneto ?> || Total iva: <?php echo $todoiva ?> || Total especificos y retenciones: <?php echo $espe ?> || Total exento: <?php echo $exeen ?></h5>
	</div>
</center>
</div>


	<div class="row">
<table style="border: solid;"  id="example" class="table table-hover" cellspacing="0" width="100%">
  <thead>
            <tr>
            <th style='width:10%; text-align:center'>Nº</th>
            <th style='width:10%; text-align:center'>Total</th>
            <th style='width:10%; text-align:center'>Neto</th>
                  <th style='width:10%; text-align:center'>Total iva</th>
                        <th style='width:20%; text-align:center'>Espe y Ret</th>
                        <th style='width:20%; text-align:center'>Total exento</th>
                          <th style='width:30%; text-align:center'>Tipo</th>
                 
        
            
            </tr>
        </thead>
        <tfoot>
            <tr>
         <th style='width:10%; text-align:center'>Nº</th>
            <th style='width:10%; text-align:center'>Total</th>
            <th style='width:10%; text-align:center'>Neto</th>
                  <th style='width:10%; text-align:center'>Total iva</th>
                        <th style='width:20%; text-align:center'>Espe y Ret</th>
                        <th style='width:20%; text-align:center'>Total exento</th>
                            <th style='width:30%; text-align:center'>Tipo</th>
          
            
            </tr>
        </tfoot>
    
  <tbody>
   
    	<?php
        while($row = $fac ->fetch_array()){
if($row[6]=='30'){
	$tipoo='Factura';
}
if($row[6]=='33'){
	$tipoo='Factura Electronica';
}
if($row[6]=='34'){
	$tipoo='Factura exenta';
}
if($row[6]=='55'){
	$tipoo='Nota de debito';
}
if($row[6]=='56'){
	$tipoo='Nota de debito electrónica';
}
if($row[6]=='60'){
	$tipoo='Nota de credito ';
}
if($row[6]=='61'){
	$tipoo='Nota de credito electrónica ';
}
if($row[6]=='45'){
	$tipoo='Factura de compra';
}
if($row[6]=='46'){
	$tipoo='Factura de compra electrónica';
}



		
        	echo" 
        	        
   		<script type='text/javascript'>
		   
     function redireccionar(rutt){
  window.location='opciones.php?rut='+rutt;
 
} 


</script>
  
			
        	<tr style='cursor: pointer' onclick='javascript:redireccionar($row[1])'>
			
					<td style='vertical-align:middle; text-align:center'>$row[0]</td>
					<td style='vertical-align:middle; text-align:center'>$row[1]</td>
					<td style='vertical-align:middle; text-align:center'>$row[2]</td>
					<td style='vertical-align:middle; text-align:center'>$row[3]</td>
					<td style='vertical-align:middle; text-align:center'>$row[4]</td>
					<td style='vertical-align:middle; text-align:center'>$row[5]</td>
					<td style='vertical-align:middle; text-align:center'>$tipoo</td>
				
					
					
				
				</tr>
			";
        }
		//-------------------------MOSTRAR BOLETAS-----------------------------------------------------
		?>
    </tbody>
 </table>
</div>

   </div>

</div>
</center>
</div>
</div>
</div>
</div>

 <div style="height: 30px; width: 100%"></div>
</body>

</html>