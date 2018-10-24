<?php
session_start();
if(!isset($_SESSION["session_username1"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username1"]);
?>
<?php 
$Rut=$_REQUEST['rut'];
include '../conection.php';
//obtener nombre de la empresa 
$empresa = $mysqli->query("SELECT  NombreEmpresa,idEmpresa FROM Empresa where Rut='$Rut'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
$idEmpresa=$nombre_empresa[1];



?>
<!DOCTYPE html>
<html>
<head>
	<title>Opciones</title>

<!-- Gonzalo Salvador Maldonado Saavedra -->
<link rel="stylesheet" href="css/bootstrap.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
  function confi(){
    if(confirm('¿Seguro que quieres ELIMINAR este documento?')){ 
          return true;
      }
      return false;
  }
  
</script>
    <script type="text/javascript">
    function modalcc(rut_empre,div,url){
      $.post(url,{rut_empre:rut_empre},
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
    }

    function modalca(rut_empre,div,url){
      $.post(url,{rut_empre:rut_empre},
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
    }

  function  modaldes(rut_empre,div,url){
      $.post(url,{rut_empre:rut_empre},
      function(resp){
        $("#"+div+"").html(resp);
      }
      );
    }


    modaldes
</script>

<script>


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

    function avisoo(nombre) {
                       document.getElementById("avisoo").innerHTML = "Debes sellar mes y año de trabajo para"+nombre;
                   // document.getElementById("boton").innerHTML = "";
            
                
                

            }


function obtdocumento(rut)
{
  var tipo, fin, numeroo;
  tipo=document.getElementById("tipo").value ;
  fin=document.getElementById("fin").value;
  numeroo=document.getElementById("numeroo").value;
  console.log(tipo + numeroo + fin + rut)
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
    document.getElementById("docenco").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("POST","document.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("tipo="+tipo+"&fin="+fin+"&numero="+numeroo+"&rut="+rut );

}



function getComuna(comuna){
  document.getElementsByName("comu")[0].value =comuna;
}


</script>

<?php 

$empleado = $mysqli->query("SELECT E.priNomb,E.segNomb,E.apePat,E.apeMat,E.rutEmpleado FROM empleado E JOIN contrato C
              ON E.rutEmpleado=C.rutEmpleado JOIN empresa M ON C.idEmpresa=M.idEmpresa 
              WHERE E.rutEmpleado=C.rutEmpleado AND C.estado='Activo' AND C.idEmpresa='$idEmpresa'");

?>


</head>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog"></div>
<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Menú de opciones</p>
<!-- ---------------------------------------------------------------------------------------------------------------------------------------------- -->
<div class=" col-lg-2 col-md-2"></div>
<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
  </div>
<div class="container">

  

 
</center>
  <div class="tab-content">
  
    <div id="menu1" class="tab-pane fade in active">
    
      
<center>


<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$Rut";?></b> </h4></div>

</br></br></br>
<?php 
function obtener_lista_anios($adelanta=0){
    $anios = array();
    for($i = date("Y"); $i >= date("Y") - 10; $i--){
        $anios[] = array($i, $i + $adelanta);
    }
    return $anios;
}
$anio=array();
$anio=obtener_lista_anios();


if(isset($_GET['añotrabajo']) AND isset($_GET['mestrabajo'])){
$añotrabajo=$_GET['añotrabajo'];
$mestrabajo=$_GET['mestrabajo'];
 ?>

<div   style="background-color: #F2F2F2; margin: 0px 0px 0px 0px" class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p><div class="col-md-3 col-lg-3 "><label>Año de trabajo</label>
<select class="form-control" name="añotrabajo" >
  
  <option value=""> </option>
  <?php foreach ($anio as $key => list($a)) { ?>
  <option value="<?php echo$a ?>"> <?php echo$a ?> </option>
  <?php } ?>
</select>
</div></p>
<p><div class="col-md-3 col-lg-3 "><label>Mes de trabajo</label>
<select class="form-control" name="mestrabajo" required>
<option value=""></option>
<option value="1">1 - Enero</option>
  <option value="2">2 - Febrero</option>
  <option value="3">3 - Marzo</option>
  <option value="4">4 - Abril</option>
  <option value="5">5 - Mayo</option>
  <option value="6">6 - Junio</option>
  <option value="7">7 - Julio</option>
  <option value="8">8 - Agosto</option>
  <option value="9">9 - Septiembre</option>
  <option value="10">10 - Octubre</option>
  <option value="11">11 - Noviembre</option>
  <option value="12">12 - Diciembre</option>
</select>
</div></p>
 
<input   type="hidden" value="<?php echo$Rut ?>" name="rut" >
<p><div class="col-md-2 col-lg-2 "  style="padding: 25px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" class="btn btn-primary">Sellar</button></div></p>
<p><div class="col-md-4 col-lg-4" style="padding: 20px 0px 20px 0px;"><h4>Año de trabajo: <b><?php echo $añotrabajo ?></b> - Mes de trabajo: <b><?php echo $mestrabajo ?></b></h4></div></p>

</form>
</div>

<center>
<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12" style="height: 30px"></div>
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
<div class="list-group-item active " style=" height: auto; background:#428bca; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Registrar ventas</b></h5>
  </div>

  <a href="libros/venta/boleta/form_boleta.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Boletas
  </a>
   <a href="libros/venta/BoletaElectronica/form_boleta.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Boletas electrónicas
  </a>

    <a href="libros/venta/Factura/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas
  </a>
    <a href="libros/venta/FacturaElectronica/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas electrónicas
  </a>
    <a href="libros/venta/notadebito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito
  </a>
   <a href="libros/venta/notacredito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito
  </a>
    </a>
    <a href="libros/venta/notadebitoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito electrónica
  </a>
   <a href="libros/venta/notacreditoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito electrónica
  </a>


</div>
</div>
<!-- ---------------------------------------------------------------------- -->

<div style="height: 10px" class="hidden-lg hidden-md col-xs-12 col-sm-12"></div>
<!-- ---------------------------------------------------------------------- -->

<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
<div class="list-group-item active " style=" height: auto; background:#428bca; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Informaciones</b></h5>
  </div>

  <a href="#" class="list-group-item">Detalle de empresa
  </a>
    <a href="libros/informacion/libroventas.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Libro de ventas
  </a>
    <a href="libros/informacion/librocompras.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Libro de compras 
  </a>

     <a href="#"   class="list-group-item">&nbsp;</a>
   <a href="#"  class="list-group-item">&nbsp;</a>   
      <a href="#"  class="list-group-item">&nbsp;</a>  
     <a href="#" class="list-group-item">&nbsp;</a>
   <a href="#" class="list-group-item">&nbsp;</a>  

 
   

</div>
</div>

<!-- ---------------------------------------------------------------------- -->


<?php }else{ ?>
<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<p><div class="col-md-3 col-lg-3 "><label>Año de trabajo</label>

<select class="form-control" name="añotrabajo" >
  
  <option value=""> </option>
  <?php foreach ($anio as $key => list($a)) { ?>
  <option value="<?php echo$a ?>"> <?php echo$a ?> </option>
  <?php } ?>
</select>

</div></p>




<p><div class="col-md-3 col-lg-3 "><label>Mes de trabajo</label>
<select class="form-control" name="mestrabajo" required>
<option value=""></option>
  <option value="1">1 - Enero</option>
  <option value="2">2 - Febrero</option>
  <option value="3">3 - Marzo</option>
  <option value="4">4 - Abril</option>
  <option value="5">5 - Mayo</option>
  <option value="6">6 - Junio</option>
  <option value="7">7 - Julio</option>
  <option value="8">8 - Agosto</option>
  <option value="9">9 - Septiembre</option>
  <option value="10">10 - Octubre</option>
  <option value="11">11 - Noviembre</option>
  <option value="12">12 - Diciembre</option>
</select>    </div></p>
<input   type="hidden" value="<?php echo$Rut ?>" name="rut" >

<p><div class="col-md-2 col-lg-2 "  style="padding: 25px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" class="btn btn-primary">Sellar</button></div></p>

</form>

</div>
<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12" style="height: 30px"></div>
<center>
<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
<div class="list-group-item active " style=" height: auto; background: #d9534f; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Registrar ventas</b></h5>
  </div>

  <a href="#" style="background: #eee" onclick='avisoo(" registrar una boleta de venta")' style="background: #eee" class="list-group-item">Boletas
  </a>
   <a href="#" style="background: #eee" onclick='avisoo(" registrar una boleta electrónica")' style="background: #eee" class="list-group-item">Boletas electrónicas
  </a>
   
    <a href="#" style="background: #eee" onclick='avisoo(" registrar una factura de venta")' style="background: #eee" class="list-group-item">Facturas
  </a>
    <a href="#" style="background: #eee" style="background: #eee" onclick='avisoo(" registrar una factura electrónica")' class="list-group-item">Facturas electrónicas
  </a>
    <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de debito en las ventas")' style="background: #eee" class="list-group-item">Nota de débito
  </a>
   <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de credito en las ventas")' style="background: #eee" class="list-group-item">Nota de crédito
  </a>
    <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de credito electrónica en las ventas")' style="background: #eee" class="list-group-item">Nota de débito electrónica
  </a>
    <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de credito electrónica en las ventas")' style="background: #eee" class="list-group-item">Nota de crédito electrónica
  </a>

  

</div>
</div>
<!-- ---------------------------------------------------------------------- -->
<div style="height: 10px" class="hidden-lg hidden-md col-xs-12 col-sm-12"></div>
<!-- ---------------------------------------------------------------------- -->

<div class="col-xs-12 col-sm-12 col-lg-6 col-md-6">
<div class="list-group-item active " style=" height: auto; background:#d9534f; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Informaciones</b></h5>
  </div>

  <a href="#" style="background: #eee" class="list-group-item">Detalle de empresa
  </a>
  <a href="#" style="background: #eee" class="list-group-item">Libro de ventas
  </a>
    <a href="#" style="background: #eee" class="list-group-item">Libro de compras 
  </a>
    

     <a href="#" style="background: #eee"  class="list-group-item">&nbsp;</a>
   <a href="#" style="background: #eee"  class="list-group-item">&nbsp;</a>   
      <a href="#" style="background: #eee"  class="list-group-item">&nbsp;</a>  

     <a href="#" style="background: #eee"  class="list-group-item">&nbsp;</a>
   <a href="#" style="background: #eee"  class="list-group-item">&nbsp;</a>   


</div>
</div>


<?php 
}
?>

 <p style="padding: 0px 0px 0px 10px; margin: 5px 0px 5px 0px" class="bg-danger" id="avisoo"> </p>

    </div>

<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="docenco"></div>  
<center>

 </center>

<!-- ---------------------------------------------------------------------- -->
<div style="height: 10px" class="col-lg-12 col-md-12 col-xs-12 col-sm-12"></div>


<div style="height: 10px" class="col-lg-9 col-md-9 col-xs-4 col-sm-4"></div>
<div style="height: 10px" class="col-lg-1 col-md-1 col-xs-3 col-sm-3"><a href="index.php?rutE=<?php echo $Rut; ?>" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>



</body>

</html>
<?php } ?>