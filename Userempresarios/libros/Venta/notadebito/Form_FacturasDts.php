<?php session_start();
include '../../../conection.php';
$Rutempre=$_REQUEST['Rutempre'];
$anotrabajo=$_REQUEST['anotrabajo'];
$mestrabajo=$_REQUEST['mestrabajo'];
if($Rutempre!='' and $mestrabajo!='' and $anotrabajo!=''){
$empresa = $mysqli->query("SELECT NombreEmpresa FROM Empresa where Rut='$Rutempre'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
$aux = $mysqli->query("Select numeroCuenta FROM cuentaCorriente where rutEmpresa='$Rutempre and Estado=1'");
$centroCostos = $mysqli->query("Select nombre FROM centroCostos where rutEmpresa='$Rutempre and Estado=1'");
        

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Facturas de Ventas</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
	      function getDV(numero) {
        if( numero.length == 0 ||numero.length > 9 || numero.length < 6) {
                    document.getElementById("aviso").innerHTML = "El RUT de la factura es invalido  ";
                   // document.getElementById("boton").innerHTML = "";
                    document.getElementsByName("cd")[0].value ='';
                       return false;
                }else{
                  document.getElementById("aviso").innerHTML = " ";
                 // document.getElementById("boton").innerHTML = "<button type='submit' class='btn btn-success'>Ingresar</button>";
                }

                nuevo_numero = numero.toString().split("").reverse().join("");
                for(i=0,j=2,suma=0; i < nuevo_numero.length; i++, ((j==7) ? j=2 : j++)) {
                    suma += (parseInt(nuevo_numero.charAt(i)) * j); 
                }
                n_dv = 11 - (suma % 11);
       
                var dv=((n_dv == 11) ? 0 : ((n_dv == 10) ? "K" : n_dv));
                 document.getElementsByName("cd")[0].value = dv;
                return ((n_dv == 11) ? 0 : ((n_dv == 10) ? "K" : n_dv));
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
<script>
	function load(str)
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
xmlhttp.open("POST","razonsoci.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("e="+str );

}


</script>
</head>
<body>
<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Ingreso de NOTA DE DEBITO de venta de la empresa <b><?php echo" $nombreEmpresa - $Rutempre" ?></b></p></center>
   <p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-danger" id="aviso"> </p>

<?php 

$espdisel=0;
$espiscos=0;
$esvinos=0;
$esbebidas=0;
$retharina=0;
$retcarne=0;
if(isset($_POST['esdisel'])){
$espdisel=$_POST['esdisel'];

}else{
$espdisel=0;

}


if(isset($_POST['espiscos'])){
$espiscos=$_POST['espiscos'];

}else{
$espiscos=0;

}

if(isset($_POST['esvinos'])){
$esvinos=$_POST['esvinos'];

}else{
$esvinos=0;

}

if(isset($_POST['esbebidas'])){
$esbebidas=$_POST['esbebidas'];

}else{
$esbebidas=0;

}

if(isset($_POST['retharina'])){
$retharina=$_POST['retharina'];

}else{
$retharina=0;

}


if(isset($_POST['retcarne'])){
$retcarne=$_POST['retcarne'];

}else{
$retcarne=0;

}
if(isset($_POST['i']) ){
	$i=$_POST['i'];

unset( $_SESSION['arraySecuen'][$i] ); 



}



if(isset($_POST['total']) AND isset($_POST['ivapor']) AND isset($_POST['ivapes']) and isset($_POST['abono']) and isset($_POST['neto'])){
$total=($_POST['total']);
$ivapes=($_POST['ivapes']);
$ivapor=($_POST['ivapor']);
$abono=($_POST['abono']);
$neto=($_POST['neto']);


//obtener id de iva
$idiva = $mysqli->query("SELECT idIva FROM iva where porcentaje='$ivapor' AND estado=1");
$idIva = mysqli_fetch_array($idiva, MYSQLI_NUM);
$idIVA=$idIva[0];


$_SESSION["arraySecuen"][]= array($total,$ivapes,$abono,$neto,$idIVA,$espdisel,$espiscos,$esvinos,$esbebidas,$retcarne,$retharina);
//print_r($_SESSION["arraySecuen"]);
//$largosecu=count($_SESSION["arraySecuen"]);
//echo "$largosecu";
//unset($_SESSION['arraySecuen']);  //-> Borra datos de la session !! 
}else{


}



if(isset($_POST['fecha']) AND isset($_POST['numero'])AND  isset($_POST['Rut']) AND isset($_POST['cd']) AND isset($_POST['aux']) AND isset($_POST['cc']) AND isset($_POST['razonsoc']) AND isset($_POST['totalespe'])){

$fecha=$_POST['fecha'];
$numero=$_POST['numero'];
$rut=$_POST['Rut'];
$cd=$_POST['cd'];
$aux=$_POST['aux'];
$cc=$_POST['cc'];
$Razon=$_POST['razonsoc'];

$totalespe=$_POST['totalespe'];


?>

<div class="row">
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>
<div class="col-md-8 col-xs-10 col-lg-8 col-sm-10" style="border: solid; padding-bottom: 10px; margin: 0px 0px 10px 0px" >




<p><div class="col-md-4 col-lg-4  "><label>Cuenta</label><input class="form-control" name="aux"  value="<?php echo$aux ?>" placeholder="<?php echo$aux ?>" readonly></div></p>
<p><div class="col-md-4 col-lg-4 "><label>Tipo</label><input class="form-control" id="disabledInput" value="nota de débito" type="text" placeholder="Tipo" readonly></div></p>
    <p><div class="col-md-4 col-lg-4 "><label>Número de factura</label><input class="form-control" value="<?php echo$numero ?>" name="numero" type="text" placeholder="<?php echo $numero ?>" readonly></div></p>
<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>
<p><div class="col-md-2 col-lg-2  "><label>Rut razón social</label><input minlength="6"  class="form-control" name="Rutfact" value="<?php echo $rut ?>" type="text" placeholder="<?php echo $rut ?>" readonly></div></p>
	<p><div class="col-md-1 col-lg-1  "><label> - </label><input class="form-control" name="cd" type="text" value="<?php echo $cd ?>"  placeholder="<?php echo $cd ?>" readonly></div></p>
	<p><div class="col-md-2 col-lg-2 "><label>Año de trabajo</label><input class="form-control" name="anotrabajo" value="<?php echo$anotrabajo?>" type="text" placeholder="<?php echo$anotrabajo ?>" readonly></div></p>
<p><div class="col-md-2 col-lg-2  "><label>Mes de trabajo</label><input class="form-control" name="mestrabajo" value="<?php echo$mestrabajo?>" type="text" placeholder="<?php echo$mestrabajo?>" readonly></div></p>
	<p><div class="col-md-3 col-lg-3  "><label>Fecha emision</label><input class="form-control" name="fecha" value="<?php echo $fecha ?>" type="date" placeholder="<?php echo $fecha ?>" readonly></div></p>

	<p><div class="col-md-2 col-lg-2  "><label>Centro costos</label><input class="form-control" name="cc" value="<?php echo $cc ?>"  placeholder="<?php echo $cc ?>" readonly></div></p>

	<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 10px"></div>
  <p><div class="col-md-3 col-lg-3  "><label>Especificos totales</label><input placeholder="$" class="form-control" name="totalesp" " type="text"   value="<?php echo $totalespe ?>"  readonly></div></p>
<p><div class="col-md-6 col-lg-6  "><label>Razón social</label><input class="form-control" name="cc" value="<?php echo $Razon ?>"  readonly></div></div>

<div class="col-md-8 col-lg-8 col-sm-4 col-xs-4 "></div>
    <div class="col-md-2 col-lg-2 col-sm-2 col-xs-2 "><a href="Form_FacturasDts.php?Rutempre=<?php echo $Rutempre ?>&anotrabajo=<?php echo $anotrabajo ?>&mestrabajo=<?php echo $mestrabajo ?>" class="btn btn-danger">Modificar</a></div>

</div>
</div>
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>
</br>
<div class="col-md-2 col-xs-0 col-lg-2 col-sm-0" ></div>
<div class="col-md-8 col-xs-12 col-lg-8 col-sm-12" >
<?php include 'lista_Detallefact.php'  ?>
</div>
</div>
</div>
<?php }else{ ?>

<div class="row">
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>
<div class="col-md-8 col-xs-10 col-lg-8 col-sm-10" style="border: solid; padding-bottom: 10px; margin: 0px 0px 10px 0px" >
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p><div class="col-md-4 col-lg-4  "><label>Cuenta</label>
<select class="form-control" name="aux" required/>
  <option value=""> </option>
      <?php while($rowaux = $aux ->fetch_array()){?>
      <option value="<?php echo"$rowaux[0]" ?>">     <?php echo utf8_encode($rowaux[0])  ?> </option>

      <?php } ?>
</select>
</p>
</div>
<p><div class="col-md-4 col-lg-4 "><label>Tipo</label><input class="form-control" id="disabledInput" type="text" placeholder="nota de débito" readonly></div></p>
    <p><div class="col-md-4 col-lg-4 "><label>Número de factura</label><input onkeypress='return solonumeros(event)' class="form-control" name="numero" type="text" placeholder="número" ></div></p>
<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>
<p><div class="col-md-2 col-lg-2  "><label>Rut razón social</label><input onchange="load(this.value)" onkeypress='return solonumeros(event)' class="form-control"  onblur="getDV(this.value)" name="Rut" type="text" placeholder="rut" ></div></p>
	<p><div class="col-md-1 col-lg-1  "><label> - </label><input class="form-control" name="cd" id="cd" type="text"  readonly required/></div></p>
	<p><div class="col-md-2 col-lg-2 "><label>Año de trabajo</label><input  class="form-control" name="anotrabajo" value="<?php echo$anotrabajo ?>" type="text" placeholder="<?php echo$anotrabajo?>" readonly></div></p>
<p><div class="col-md-2 col-lg-2  "><label>Mes de trabajo</label><input class="form-control" name="mestrabajo" value="<?php echo$mestrabajo ?>" type="text" placeholder="<?php echo$mestrabajo?>" readonly></div></p>
	<p><div class="col-md-3 col-lg-3  "><label>Fecha emisión</label><input class="form-control" name="fecha" type="date" placeholder="fecha" required></div></p>



	<p><div class="col-md-2 col-lg-2  "><label>Centro de costos</label>
<select class="form-control" name="cc"  required>
<option value=""> </option>
	  <?php while($rowcen = $centroCostos  ->fetch_array()){?>
      <option value="<?php echo"$rowcen[0]" ?>">  <?php echo utf8_encode($rowcen[0])  ?> </option>

      <?php } ?>
</select>
	</div></p>

<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 3px"></div>

<p><div class="col-md-3 col-lg-3  "><label>Especificos totales</label><input placeholder="$" onkeypress='return solonumeros(event)' class="form-control" name="totalespe" " type="text" required></div></p>
<p><div class="col-md-6 col-lg-6  "><div id="myDiv"></div></div></p>

	<input name="Rutempre" type="hidden" value="<?php echo$Rutempre ?>" ></div>
	<div class="hidden-xs hidden-sm col-md-12 col-lg-12 " style="margin: 10px"></div>
<div class="col-md-8 col-lg-8 col-sm-5 col-xs-5 "></div>
    <div class="col-md-1 col-lg-1 col-sm-7 col-xs-7 "><button type="submit" class="btn btn-success">&nbsp;Sellar datos&nbsp;</button></div>
    <div style="height: 10px" class="hidden-md hidden-lg col-sm-12 col-xs-12 "></div>
<div class="hidden-md hidden-lg col-sm-5 col-xs-5 "></div>
        <div class="col-md-3 col-lg-3 col-sm-7 col-xs-7 "><a href="../../../opciones.php?rut=<?php echo$Rutempre ?>" class="btn btn-primary">ir a opciones</a></div>
</form>
</div>
</div>
<div class="col-md-2 col-xs-1 col-lg-2 col-sm-1" ></div>
<?php } }else{

header('Location: ../../../UserContador/index.php');

	}?>



</body>
</html>