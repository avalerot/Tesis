<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<script>
		function load(str,tipo,espTotal,rutEmpre,numFac,numSec,item)
{
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","cambioEspyRet.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("esp="+str+"&"+"tipo="+tipo+"&"+"espTotal="+espTotal+"&"+"rutEmpre="+rutEmpre+"&"+"numFac="+numFac+"&"+"numSec="+numSec+"&"+"item="+item);

}
	



  // document.getElementsByName("cd")[0].value ='';


function solonumeros(e){
  Key=e.KeyCode || e.which;
  teclado=String.fromCharCode(Key).toLowerCase();
  Letras="0123456789";
  especiales="8-37-38-46-164";
  teclado_especial=false;
  for(var i in especiales){
    if(Key==especiales[i])
        {
      teclado_especial=true;break;
      }
    
    }
    if (Letras.indexOf(teclado)==-1 && !teclado_especial){
      return false;
      
      }
  
  }

</script>

<script type="text/javascript">
	
function espeacero(item){
document.getElementsByName("EspeDisel")[item].value =0;
document.getElementsByName("EspePisco")[item].value =0;
document.getElementsByName("EspeBebida")[item].value =0;
document.getElementsByName("EspeVinos")[item].value =0;
document.getElementsByName("RetCarne")[item].value =0;
document.getElementsByName("RetHarina")[item].value =0;

}
</script>

<?php

$Rutempre=$_REQUEST['Rutempre'];
$anotrabajo=$_REQUEST['anotrabajo'];
$mestrabajo=$_REQUEST['mestrabajo'];
$aux=$_POST['aux'];
$cc=$_POST['cc'];
$subirsefacelec=0;
date_default_timezone_set('America/Santiago');
$Fechahoy = date("Y-m-d");
?>
<a  class="btn btn-success" style="margin: 10px 0px 0px 10px" href="Formularioxls.php?Rutempre=<?php echo$Rutempre ?>&anotrabajo=<?php echo$anotrabajo?>&mestrabajo=<?php echo$mestrabajo ?>">Listo</a>
<?php
include '../../../conection.php';
$idcenc = $mysqli->query("SELECT idCentroCostos FROM CentroCostos where Estado='1' and nombre='$cc' and rutEmpresa='$Rutempre' ");
$idcc = mysqli_fetch_array($idcenc, MYSQLI_NUM);
$idCc=$idcc[0];

$auxx= $mysqli->query("SELECT idCuentaCorriente FROM cuentaCorriente where Estado='1' and numeroCuenta='$aux' and rutEmpresa='$Rutempre' ");
$auxf = mysqli_fetch_array($auxx, MYSQLI_NUM);
$auxiliar=$auxf[0];

$empresaNombreee= $mysqli->query("SELECT NombreEmpresa FROM empresa where Rut='$Rutempre' ");
$empresaNombree = mysqli_fetch_array($empresaNombreee, MYSQLI_NUM);
$empresaNombre=$empresaNombree[0];

require_once("PHPExcel-1.8/Classes/PHPExcel.php");
require_once("PHPExcel-1.8/Classes/PHPExcel/Reader/Excel2007.php");
    $clave=0;
   $tipo='';
	if (substr($_FILES['excel']['name'],-3)=="xls")
	{
		$fecha		= date("Y-m-d");
		$carpeta 	= "xlstemp/";
		$excel  	= $fecha."-".$_FILES['excel']['name'];

		move_uploaded_file($_FILES['excel']['tmp_name'], "$carpeta$excel");


		$objPHPExcel=PHPExcel_IOFactory::load("$carpeta$excel");
		
		$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

		foreach ($objHoja as $Indice => $objCelda) {
			
			$accion=$objCelda['A'];
			$accionfiladatos=$objCelda['N'];


$empresa = $mysqli->query("SELECT Rut,VerificadorEmpresa FROM Empresa  where Estado='1' AND Rut='$Rutempre' ");
$VerificadorEmpre = mysqli_fetch_array($empresa, MYSQLI_NUM);


		
			 //toma datos de factura o documento
                 $ruut=$Rutempre."-".$VerificadorEmpre[1];

             if($ruut==$accionfiladatos){
				$RutEmpresa=$objCelda['N'];
				$nombreEmpresa=$objCelda['O'];
				$RutRazon=$objCelda['F'];
				$NombreRazon=$objCelda['G'];
				$fechaEmision=$objCelda['C'];
				$neto=$objCelda['T'];
				$iva=$objCelda['V'];
				$total=$objCelda['W'];
				$tipo=$objCelda['A'];
				$numeroFac=$objCelda['B'];
				$exento=$objCelda['U'];
				//Sacar total de especificos y retenciones (SI LAS HAY)

		$TotalEspyRet=$total-($neto+$iva);
//sacar diferencia de fecha de hoy y fecha de emision del documento
//diferencia contanto dias 
		$diaEmi=date("d", strtotime($fechaEmision));
		$fechatrab=$anotrabajo."-".$mestrabajo."-".$diaEmi;		
$dateTRAB=new DateTime($fechatrab);//DateTime::sub($Fechahoy) 
$dateEMISION=new DateTime($fechaEmision);//DateTime::sub($fechaEmision) 
$interval=$dateEMISION->diff($dateTRAB);
$diferenMesess=$interval->format("%m");
$intervalAnos = $interval->format("%y")*12;
$mestrabajoo=date("m", strtotime($fechatrab)); 
$mesemision=date("m",strtotime($fechaEmision));
$diferenMeses=$diferenMesess+$intervalAnos;
//echo "$fechatrab - $fechaEmision - $diferenMeses"; <- PARA COMPROBAR FECHAS (PRUEBA)
//
//FIN DE sacar diferencia de fecha de hoy y fecha de emision del documento

//subir razon si no está registrada.
$rutRazonsinGuion=substr($RutRazon,0,-2);
$Verificadorrazon=substr($RutRazon,-1);
$razoncount = $mysqli->query("SELECT count(nombreRazon) FROM Razonsoc where rutRazon='$rutRazonsinGuion'");
$razonscou = mysqli_fetch_array($razoncount, MYSQLI_NUM);
$razonscouf=$razonscou[0];
if ($razonscouf==1){}else{
$subirazon= "INSERT INTO Razonsoc VALUES (null,'$rutRazonsinGuion','$NombreRazon','$Verificadorrazon')";
if ($mysqli->query($subirazon)) {
}else{
}
}
//termino subir razon! 



if ($tipo=='33'){ //Ver si datos son de facturaselec
	if ($diferenMeses<3 AND $dateTRAB>=$dateEMISION ){//VER SI LA FACTURA ESTÁ DENTO DEL PLAZO DE REGISTRO(3 MESES ANTERIORES)
	

$subirfacventa= "INSERT INTO facturacompra VALUES (null, '$numeroFac','$RutRazon','$Rutempre','$mestrabajo','$anotrabajo','$auxiliar','$idCc','$fechaEmision','$neto','$exento','$iva','$total','$TotalEspyRet',33)";
if ($mysqli->query($subirfacventa)) { 
	 ?>
	<h4>
	<center>
<div style="margin: 20px 0px 20px 0px " class="alert alert-success" role="alert">la factura electrónica <i>Nº <?php echo$numeroFac ?></i> Se registro correctamente en la empresa <i> <?php echo$empresaNombre ?> Total neto:  <?php echo$neto ?> - Total IVA: <?php echo$iva ?> - Total exento: <?php echo$exento ?> - Total Esp. y Ret: <?php echo$TotalEspyRet ?> - Total FACT: <?php echo$total ?></i> </div></center></h4>

	<?php
	 $subirsefacelec=1;
//echo"factura subida";   
  // header("Location: Form_FacturasDts.php?Rutempre=$Rutempre&anotrabajo=$anotrabajo&mestrabajo=$mestrabajo");   
  ?>
  <div class="row">
    <div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-3 col-md-3 col-lg-3">ABONO</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">NETO</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">IVA</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">TOTAL</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">ESP.DISEL</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">ESP.PISCO</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">ESP.BEBIDAS</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">ESP.VINOS</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">RET.CARNE</div>
<div style="background-color: #ccc;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">RET.HARINA</div>
</div>

  <?php        
                 
}else{
	$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$RutEmpresa'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
	?>
	<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-danger" role="alert">la factura <i>Nº <?php echo$numeroFac ?></i> YA ESTÁ AGREGADA EN LA EMPRESA <i> <?php echo$empresaNombre ?> -  <?php echo$Rutempre ?></i>  </div></center></h4>
	<?php
 $subirsefacelec=0;
}

}else{//ELSE DE VERIFICAR FECHA DENTRO DE PLAZO FECHA
	?>
	<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">la factura <i>Nº <?php echo$numeroFac ?></i> ESTA FUERA DE PLAZO  <i>  -  <?php echo$Rutempre ?></i> </div></center></h4>
	<?php
 $subirsefacelec=0;

}//TERMINA IF DE VERIFICACION DE FECHA

}else{

?>
	<h4>
	<center>
<div style="margin: 20px 0px 0px 0px " class="alert alert-warning" role="alert">Se encontró un documento que NO ES UNA FACTURA ELECTRÓNICA </i>  </div></center></h4>



	<?php
 $subirsefacelec=0;

} //TERMINA VER SI ES FACTELEC




}else{

	//echo"El archivo que desea subir no pertenece a la empresa seleccionada";
}//termina de ver si pertenece a la
 
if($subirsefacelec==1){
 if($tipo=='33'){//Agregar secuencia factelec
 	
 if($objCelda['A']=='' AND $objCelda['B']!='' AND $objCelda['L']=='' AND $objCelda['M']=='' AND $objCelda['N']==''){//PARA VER SI ES LA SECUENCIA
 	$abono=$objCelda['E'];
				//echo "estoy en una factura electronica" ;
				$ivaAct = $mysqli->query("SELECT idIva,porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
                $idiva=$iva[0];
                $poriva=$iva[1];
                $porivaparamultiplicar=$iva[1]*0.01;
				$NetoSec=$objCelda['K'];
			    $NumSec=$objCelda['B'];
				$TotalSec=round(($NetoSec*$porivaparamultiplicar)+$NetoSec,0);
				$TotalIVA=$TotalSec-$NetoSec;

				//echo" ---------------- $RutEmpresa - $numeroFac - $NetoSec - $TotalSec - $TotalIVA - $idiva -----------";
		        //Si no tiene especificos especificos NI RETENCIONES
		        
          $espdisel=0; $espiscos=0; $esbebidas=0; $esvinos=0; $retcarne=0; $retharina=0;
           

$subirsecuefac= "INSERT INTO secuenciafactcompra VALUES (null, '$numeroFac','$idiva','$TotalSec','$TotalIVA','$abono','$NetoSec','$espdisel','$espiscos','$esbebidas','$esvinos','$retcarne','$retharina','$Rutempre','$NumSec',33)";
if ($mysqli->query($subirsecuefac)) {
//echo "Secuencia subida correctamente";
	if($objCelda['J']!='' and $TotalEspyRet>0){
if(isset($item)){}else{$item=0;}
?>

<div id="myDiv"></div>
<div class="row">
    <div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-3 col-md-3 col-lg-3"><?php echo $abono ?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$NetoSec?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$TotalIVA?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$TotalSec?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)' onchange="load(this.value,'EspeDisel',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)"  class="form-control" style="height: 20px; width: 100%" name="EspeDisel" id="EspeDisel" ></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)'  onchange="load(this.value,'EspePisco',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)" class="form-control" style="height: 20px; width: 100%"    name="EspePisco" id="EspePisco" ></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)' onchange="load(this.value,'EspeBebida',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)" class="form-control" style="height: 20px; width: 100%"    name="EspeBebida"  id="EspeBebida"></div>
<div  style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)' onchange="load(this.value,'EspeVinos',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)"  class="form-control" style="height: 20px; width: 100%"    name="EspeVinos"  id="EspeVinos"></div>
<div  style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)' onchange="load(this.value,'RetCarne',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)" class="form-control" style="height: 20px; width: 100%"    name="RetCarne"  id="RetCarne"></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1">
<input  onkeypress='return solonumeros(event)' onchange="load(this.value,'RetHarina',<?php echo $TotalEspyRet ?>,<?php echo $Rutempre ?>,<?php echo $numeroFac ?>,<?php echo $NumSec ?>,<?php echo $item ?>)" class="form-control" style="height: 20px; width: 100%"    name="RetHarina"  id="RetHarina"></div>

</div>


<?php
$item=$item+1;
	}else{

	?>
	<div class="row">
    <div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-3 col-md-3 col-lg-3"><?php echo $abono ?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$NetoSec?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$TotalIVA?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$TotalSec?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$espdisel?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$espiscos?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$esbebidas?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$esvinos?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$retcarne?></div>
<div style="background-color: #fff;border: solid;" class="hidden-xs col-sm-1 col-md-1 col-lg-1"><?php echo$retharina?></div>

</div>


	<?php 
}
}else{
//echo "Secuencia no subida correctamente";



}



		        //
     
		
			
			}else{//ver si es secuencia


			}//TERMINO VER SI ES SECUENCIA

			}else{


			}//Termino factura electronica

}else{

}//VER SI TIENE PERMISO SI ES QUE SUBIO LA FACTURA




			//print_r($objCelda);
			//echo $Indice."<br></br>";
			//echo $accion."<br></br>";
			
		}




	}



?>