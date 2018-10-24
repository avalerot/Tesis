
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

<script>
	function load(str, totalespe)
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
xmlhttp.open("POST","impespecificos.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("e="+str+"&"+"totalespe="+totalespe );

}


</script>
<script>
  function obteneriva(neto){
  var ivapor=document.getElementById("ivapor").value;
  var ivaporfinal=ivapor*0.01;

  var valoriva=Math.round(neto*ivaporfinal);
  var valorTotal=Math.round(parseInt(neto)+parseInt(valoriva));


  document.getElementsByName("ivapes")[0].value =valoriva;
   document.getElementsByName("total")[0].value =valorTotal;

  }

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
  function calcularespe(valor, tipo){
if(tipo=='disel' || tipo=='piscos' || tipo=='vinos' || tipo=='bebidas'){

   var disel=document.getElementsByName("esdisel")[0].value, piscos=document.getElementsByName("espiscos")[0].value, vinos=document.getElementsByName("esvinos")[0].value, bebidas=document.getElementsByName("esbebidas")[0].value;
   if(disel==""){
    disel=0;
   }

if(piscos==""){
    piscos=0;
   }
   if(vinos==""){
    vinos=0;
   }
   if(bebidas==""){
    bebidas=0;
   }
var totespesec=parseInt(disel)+parseInt(piscos)+parseInt(vinos)+parseInt(bebidas);
if (totespesec>valor){
document.getElementsByName("esdisel")[0].value=0;
document.getElementsByName("espiscos")[0].value=0;
document.getElementsByName("esvinos")[0].value=0;
document.getElementsByName("esbebidas")[0].value=0;
alert("Se superó el total de especificos");

}

  }

if(tipo=='harina' || tipo=='carne'){
   var harina=document.getElementsByName("retharina")[0].value, carne=document.getElementsByName("retcarne")[0].value;
  if(harina==""){
    harina=0;
   }
   if(carne==""){
    carne=0;
   }
var totespesec=parseInt(harina)+parseInt(carne);
if (totespesec>valor){
document.getElementsByName("retharina")[0].value=0;
document.getElementsByName("retcarne")[0].value=0;

alert("Se superó el total de retenciones");
}

  }


}
</script>

<?php 
include '../../../conection.php';
$ivaAct = $mysqli->query("SELECT porcentaje FROM iva where estado='1' ");
$iva = mysqli_fetch_array($ivaAct, MYSQLI_NUM);
$iva=$iva[0];
?>
</head>
<body>
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center>  <h4 class="modal-title">Detalle de factura electrónica </h4></center> 
      </div>
      <div class="modal-body">

<div class="row">
<?php 
$fecha=$_POST['fecha'];
$numero=$_POST['numero'];
$rut=$_POST['rut'];
$cd=$_POST['cd'];
$aux=$_POST['aux'];
$Rutempre=$_POST['Rutempre'];
$anotrabajo=$_POST['anotrabajo'];
$mestrabajo=$_POST['mestrabajo'];
$cc=$_POST['cc'];
$razonsoc=$_POST['razon'];
$totalespe=$_POST['totalespe'];

?>
<form method="post" action="Form_FacturasDts.php">

<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>

<p><div class="col-md-5 col-lg-5  "><label>Total</label><input  class="form-control"   name="total" id="total"  readonly></div></p>
<p><div class="col-md-5 col-lg-5  "><label> iva $</label><input class="form-control" name="ivapes" readonly ></div></p>
<p><div class="col-md-2 col-lg-2  "><label> iva % </label><input class="form-control" id="ivapor" name="ivapor" value="<?php echo$iva ?>" type="text"  readonly></div></p>
<div style="height: 10px" class="col-md-12 col-lg-12  "></div>
	<p><div class="col-md-6 col-lg-6 "><label>Abono</label><input class="form-control" name="abono" type="text" required></div></p>
  <p><div class="col-md-6 col-lg-6 "><label>Neto</label><input  onblur="obteneriva(this.value)" placeholder="$" class="form-control" name="neto" id="neto" onkeypress='return solonumeros(event)'  required ></div></p>
<div class="row">
<div class="col-md-1 col-lg-1 col-sm-1 col-xs-1" ></div>
	<div style="margin: 10px 0px 0px 10px" class="col-md-2 col-lg-2 ">
	<label></label>
	</div>
	<div class="hidden-md hidden-lg col-sm-1 col-xs-1" ></div>
	<div class="col-md-2 col-lg-2 col-sm-1 col-xs-1 ">
 <input class="form-control " type="radio" onchange="load(this.value,<?php echo $totalespe?>)" name="agregado" value="esp" ><b>Especificos</b></div>
 <div class="col-md-2 col-lg-2 col-sm-1 col-xs-1 ">
  <input class="form-control " type="radio" onchange="load(this.value,<?php echo $totalespe?>)" name="agregado" value="ret"> <b>Retenciones</b></div>
   <div class="col-md-2 col-lg-2 col-sm-1 col-xs-1 ">
  <input class="form-control " type="radio" onchange="load(this.value,<?php echo $totalespe ?>)" name="agregado" value="nada" autofocus checked> <b>Nada</b></div>
 </div>

  <div style="margin: 10px" id="myDiv"></div>
	<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 10px"></div>
<div class="col-md-10 col-lg-10 col-sm-4 col-xs-4 "></div>




    <div class="col-md-1 col-lg-1 col-sm-1 col-xs-1 ">


    <!-- --------------------------------------------------- -->

    <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
    <input type="hidden" name="numero" value="<?php echo $numero ?>">
    <input type="hidden" name="mestrabajo" value="<?php echo $mestrabajo ?>">
    <input type="hidden" name="Rut" value="<?php echo $rut ?>">
    <input type="hidden" name="cd" value="<?php echo $cd ?>">
    <input type="hidden" name="anotrabajo" value="<?php echo $anotrabajo ?>">
     <input type="hidden" name="aux" value="<?php echo $aux ?>">
      <input type="hidden" name="Rutempre" value="<?php echo $Rutempre ?>">
        <input type="hidden" name="cc" value="<?php echo $cc ?>">
          <input type="hidden" name="razonsoc" value="<?php echo $razonsoc ?>">
            <input type="hidden" name="totalespe" value="<?php echo $totalespe ?>">

    
    <button type="submit" class="btn btn-primary"> Hecho </button> 

</form>
</div>

<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>


</center>
</div>
</div>

      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->



</body>
</html>

  