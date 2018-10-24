<!--Gonzalo Maldonado Saavedra!-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patologías</title>

<script src="ajax1.js"></script>
<!-- Gonzalo Salvador Maldonado Saavedra -->
<link rel="stylesheet" href="../../UserContador/css/bootstrap.css">

<!-- jQuery library -->




	<link rel="stylesheet" type="text/css" href="../../recursos/tabladinamic/jquery.dataTables.min.css">
	
	<script type="text/javascript" language="javascript" src="../../recursos/tabladinamic/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="../../recursos/tabladinamic/jquery.dataTables.min.js">
	</script>
	

<?php  
include '../../conection.php';
 $mes='';
 $mes2='';
$anotrabajo1='';
//Totales
	$todototal=0;
	$todoiva=0;
	$todoneto=0;
$rut=  Htmlspecialchars($_REQUEST['Rutempre']);
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$rut'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];

$consulta = '';	
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if(isset($_POST['mes1']) AND isset($_POST['mes2']) AND isset($_POST['anotrabajo1'])){
	   $mes1=$_POST['mes1'];
	   $mes2=$_POST['mes2'];
	   $anotrabajo1=$_POST['anotrabajo1'];
   }
   

		 if(!empty($mes1)){
        
            if($consulta==""){
                $consulta.="Mestrab BETWEEN '$mes1' AND '$mes2' AND anoTrab = '$anotrabajo1' ";
				
            }
			else {
				 $consulta.="Mestrab BETWEEN '$mes1' AND '$mes2' AND anoTrab = '$anotrabajo1' ";
			}
        
        }
		
		if($consulta!=""){
            $consulta=$consulta;
        }
		
		if($consulta!=""){ $tot = $mysqli->query("SELECT sum(TotalFact),sum(TotalIva),sum(TotalNeto),sum(TotalExento),sum(TotalEspyRet) FROM facturaventa where rutEmpre='$rut' AND $consulta ");
					$tota = mysqli_fetch_array($tot, MYSQLI_NUM);
					$totalfacs=$tota[0];
					$totaliva=$tota[1];
					$netooo=$tota[2];
					$exeen=$tota[3];
					$espe=$tota[4];
      
		}
		else{
			        $tot = $mysqli->query("SELECT sum(TotalFact),sum(TotalIva),sum(TotalNeto),sum(TotalExento),sum(TotalEspyRet) FROM facturaventa where  rutEmpre='$rut'");
					$tota = mysqli_fetch_array($tot, MYSQLI_NUM);
					$totalfacs=$tota[0];
					$totaliva=$tota[1];
					$netooo=$tota[2];
					$exeen=$tota[3];
					$espe=$tota[4];
      
		}
   {
}
}
			   


	
?>

</head>

<body>
<div class="container">
	
	<center>
<div class="container">

	<div style='margin-top:30px' class="container-fluid">
		
	<form class="form-horizontal"  role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="row">
			<div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><label for="example">mes desde:</label>
				<input type="number" autofocus class="form-control input-sm" name="mes1" placeholder="EJ: 10" required  />
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><label for="example">mes hasta:</label>
				<input type="number" autofocus class="form-control input-sm" name="mes2" placeholder="EJ:12" required  />
            </div>
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><label for="example">año desde</label>
				<input type="number" class="form-control input-sm" name="anotrabajo1" placeholder="EJ:2016" required  />
				
            </div>


            
	</div>

	</div>
        
 <input name='Rutempre' type='hidden' value='<?php echo"$rut"?>' />

<div class="row" style="margin:15px 0px 0px 0px;">
  <div class="col-md-1 col-md-offset-1"><button type="submit" class="btn btn-primary">Buscar</button> 
  </form>
  </div>
    <div class="col-md-1 col-md-offset-1"><a href="../../UserContador/opciones.php?rut=<?php echo $rut ?>" class="btn btn-primary">Volver a opciones</a> 
  </div>
 <div class="row">
 	
  <div class="col-md-1">

							
  </div>
    
 </div>

</div>
<div class="container" style="margin:0px 0px 0px 0px">

<div class="row">
  <div class="col-md-12">
	<div class="row">
 <table class="table table-responsive table-bordered table-hover" style="margin:50px 0px 0px 0px;">
    <thead>
    	<tr class="active">
        	<th style='width:100px;  text-align:center'>TOTAL</th>
            <th style='width:100px; text-align:center'>TOTAL IVA</th>
            <th style='width:100px; text-align:center'>TOTAL NETO</th>
            <th style='width:100px; text-align:center'>EXENTOS</th>
            <th style='width:100px; text-align:center'>ESPECIFICOS</th>
        </tr>
    </thead>
    <body>
    
    	<?php
        	echo" <tr style='vertical-align:middle'>
					<td style='vertical-align:middle; '>$totalfacs</td>
					<td style='vertical-align:middle'>$totaliva</td>
					<td style='vertical-align:middle'>$netooo</td>
					<td style='vertical-align:middle'>$exeen</td>
					<td style='vertical-align:middle'>$espe</td>
				</tr>
			";
		?>
    </tbody>
 </table>
</div>

   </div>

</div>
</center>


 
</body>

</html>