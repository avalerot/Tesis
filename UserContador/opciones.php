<?php
session_start();
if(!isset($_SESSION["session_username0"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username0"]);
?>
<?php 
$Rut=$_REQUEST['rut'];
include '../conection.php';
//obtener nombre de la empresa 
$empresa = $mysqli->query("SELECT  NombreEmpresa,idEmpresa FROM empresa where Rut='$Rut'");
$nombre_empresa = mysqli_fetch_array($empresa, MYSQLI_NUM);
$nombreEmpresa=$nombre_empresa[0];
$idEmpresa=$nombre_empresa[1];
$licencia = $mysqli->query("SELECT L.id_licencia,E.priNomb,E.segNomb,E.apePat,E.apeMat,L.estado FROM licencia_medica L JOIN
              contrato C ON L.numCont=C.numCont JOIN empleado E ON C.rutEmpleado=E.rutEmpleado 
              WHERE C.idEmpresa='$idEmpresa'");
$empleado = $mysqli->query("SELECT E.priNomb,E.segNomb,E.apePat,E.apeMat,E.rutEmpleado FROM empleado E JOIN contrato C
              ON E.rutEmpleado=C.rutEmpleado JOIN empresa M ON C.idEmpresa=M.idEmpresa 
              WHERE E.rutEmpleado=C.rutEmpleado AND C.estado='Activo' AND C.idEmpresa='$idEmpresa'");


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
  
  <link rel="stylesheet" type="text/css" href="../recursos/tabladinamic/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../recursos/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../recursos/css/dataTables.bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="../recursos/tabladinamic/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="../recursos/tabladinamic/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="../recursos/tabladinamic/dataTables.bootstrap.min.js">
	</script>
  
	

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

        function modaladdusr(rut_empre,div,url){
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

<script type="text/javascript" class="init">
  
  	$(document).ready(function() {
    	$('#empleados').DataTable({
        	"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        	},
        	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
    	});
	} );
  	</script>
	
	
  <script type="text/javascript" class="init">
  
  	$(document).ready(function() {
    	$('#licencias').DataTable({
        	"language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        	},
        	"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todo"]]
    	});
	} );
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
 <ul style="background-color: #D8D8D8; margin:0px 0px 15px 0px; border-radius: 10px 10px 0px 0px"  class="nav nav-tabs" >

   
    <li class="active col-xs-12 col-sm-12 col-lg-2 col-md-2 "><a style="height: 100%" data-toggle="tab"  href="#menu1"> Compra y venta <i class="fa fa-pencil-square" ></i></a></li>
    <li class="col-xs-6 col-sm-6 col-lg-2 col-md-2" ><a style="height: 100%" data-toggle="tab" href="#menu2"> Licencias <i class="fa fa-users"></i></a></li>
    <li class="col-xs-6 col-sm-6 col-lg-2 col-md-2"><a  style="height: 100%" data-toggle="tab" href="#menu3"> Gestión empleado <i class="fa fa-info-circle"></i></a></li>
        <li class="col-xs-6 col-sm-6 col-lg-3 col-md-3" ><a style="height: 100%"data-toggle="tab" href="#menu4"> Actua. de datos de empresa <i class="fa-refresh"></i></a></li>
        <li class="col-xs-6 col-sm-6 col-lg-3 col-md-3" ><a style="height: 100%"data-toggle="tab" href="#menu5"> Eliminar doc. <i class="fa fa-trash"></i></a></li>
  </ul>
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
<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
<div class="list-group-item active " style=" height: auto; background:#428bca; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Registrar ventas</b></h5>
  </div>

  <a href="../libros/venta/boleta/form_boleta.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Boletas
  </a>
   <a href="../libros/venta/BoletaElectronica/form_boleta.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Boletas electrónicas
  </a>

    <a href="../libros/venta/Factura/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas
  </a>
    <a href="../libros/venta/FacturaElectronica/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas electrónicas
  </a>
    <a href="../libros/venta/archivoxls/Formularioxls.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Archivo xls del SII
  </a>
    <a href="../libros/venta/notadebito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito
  </a>
   <a href="../libros/venta/notacredito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito
  </a>
    </a>
    <a href="../libros/venta/notadebitoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito electrónica
  </a>
   <a href="../libros/venta/notacreditoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito electrónica
  </a>


</div>
</div>
<!-- ---------------------------------------------------------------------- -->
<div style="height: 10px" class="hidden-lg hidden-md col-xs-12 col-sm-12"></div>
<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
<div class="list-group-item active " style=" height: auto; background:#428bca; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Registrar compras</b></h5>
  </div>

 
  <a href="../libros/compra/Factura/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas
  </a>
    <a href="../libros/compra/FacturaElectronica/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas electrónicas
  </a>
    <a href="../libros/compra/archivoxls/Formularioxls.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Archivo xls del SII
  </a>
    <a href="../libros/compra/notacredito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito
  </a>
    <a href="../libros/compra/notadebito/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito
  </a>
      <a href="../libros/compra/notadebitoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de débito electrónica
  </a>
   <a href="../libros/compra/notacreditoelect/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Nota de crédito electrónica
  </a>
   <a href="../libros/compra/facexen/Form_FacturasDts.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Facturas exentas
  </a>
   <a href="#" class="list-group-item">&nbsp;</a>



</div>
</div>
<div style="height: 10px" class="hidden-lg hidden-md col-xs-12 col-sm-12"></div>
<!-- ---------------------------------------------------------------------- -->

<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
<div class="list-group-item active " style=" height: auto; background:#428bca; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Informaciones</b></h5>
  </div>

  <a href="#" class="list-group-item">Detalle de empresa
  </a>
    <a href="../libros/informacion/libroventas.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Libro de ventas
  </a>
    <a href="../libros/informacion/librocompras.php?Rutempre=<?php echo$Rut ?>&mestrabajo=<?php echo$mestrabajo ?>&anotrabajo=<?php echo$añotrabajo ?>" class="list-group-item">Libro de compras 
  </a>
    <a href="../libros/informacion/libroventasef.php?Rutempre=<?php echo$Rut ?>" class="list-group-item">Resumen entre fechas de compras
  </a>
   <a href="../libros/informacion/libroventasef.php?Rutempre=<?php echo$Rut ?>" class="list-group-item">Resumen entre fechas de ventas
  </a>
   <a href="l#" class="list-group-item">&nbsp;
  </a>
     <a href="#" class="list-group-item">&nbsp;</a>
   <a href="#" class="list-group-item">&nbsp;</a>  
      <a href="#" class="list-group-item">
   &nbsp;
  </a>
 
   

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

<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
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
    <a href="#" style="background: #eee" onclick='avisoo(" registrar archivo xls las ventas")' class="list-group-item">Archivo xls del SII
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
<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
<div class="list-group-item active " style=" height: auto; background: #d9534f; ">
<div style="height: 50px; padding: 0px 0px 0px 0px" class="panel-body">
   <h5><b>Registrar compras</b></h5>
  </div>

 
  <a href="#" style="background: #eee" class="list-group-item">Facturas
  </a>
    <a href="#" style="background: #eee" class="list-group-item">Facturas electrónicas
  </a>
    <a href="#"  style="background: #eee" class="list-group-item">Archivo xls del SII
  </a>
    <a href="#" style="background: #eee" class="list-group-item">Nota de crédito
  </a>
    <a href="#" style="background: #eee" class="list-group-item">Nota de débito
  </a>
     <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de credito en las compras")' style="background: #eee" class="list-group-item">Nota de crédito electrónica 
  </a>
    <a href="#" style="background: #eee" onclick='avisoo(" registrar una nota de credito electrónica en las compras")' style="background: #eee" class="list-group-item">Nota de débito electrónica
  </a>
   <a href="#" style="background: #eee" class="list-group-item">Facturas exentas
  </a>
   <a href="#" style="background: #eee" class="list-group-item">&nbsp;</a>


</div>
</div>
<div style="height: 10px" class="hidden-lg hidden-md col-xs-12 col-sm-12"></div>
<!-- ---------------------------------------------------------------------- -->

<div class="col-xs-12 col-sm-12 col-lg-4 col-md-4">
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
    <a href="../libros/informacion/libroventasef.php?Rutempre=<?php echo$Rut ?>" class="list-group-item">Resumen entre fechas de compras
  </a>
   <a href="../libros/informacion/libroventasef.php?Rutempre=<?php echo$Rut ?>" class="list-group-item">Resumen entre fechas de ventas
  </a>
   <a href="#" style="background: #eee" class="list-group-item">&nbsp;
  </a>

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


    <div id="menu2" class="tab-pane fade">
    <center>
   	<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$Rut";?></b> </h4></div></center>
	<br><br><br>
	<div style="background-color: #F2F2F2" class="col-lg-12 col-md-12">
		<div class="container" style="margin-top: 30px">
			<div class="row">
				<div class="col-lg-3 col-md-3">
					<form class="form-horizontal" action="estadisticas.php" method="post">
						<input type="hidden" value="<?php echo $idEmpresa;?>" name="id" />
						<button type="submit" class="btn btn-primary">Estadísticas</button>
					</form>
				</div>
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-3 col-md-3">
					<label><h5><b>Buscar N° Licencia, Apellido o Estado</b></h5></label>
				</div>
			</div>
			<div class="row">
				<table id="licencias" class="table table-hover table-bordered" cellspacing="0" width="100%">
        			<thead>
            			<tr>
                			<th>Numero de Licencia</th>
                			<th>Empleado</th>
                			<th>Estado</th>
            			</tr>
        			</thead>
        			<tfoot>
            			<tr>
                			<th>Numero de Licencia</th>
                			<th>Empleado</th>
                			<th>Estado</th>
            			</tr>
        			</tfoot>
        			<tbody>
          				<?php
         					while($fila = $licencia ->fetch_array()){
         						if($fila[5]==1){
											$estado="En espera de recibo";
										}
										elseif($fila[5]==2){
											$estado="Recibida";
										}
										elseif($fila[5]==3){
											$estado="Rechazada";
										}
								echo" 
								<script type='text/javascript'>
									function redireccionarl(licencia){
										window.location='licencia.php?num_lic='+licencia;
									} 
								</script>
								<tr style='cursor: pointer' onclick='javascript:redireccionarl($fila[0])'>
									<td style='vertical-align:middle; text-align:center'>$fila[0]</td>
									<td style='vertical-align:middle; text-align:center'>";echo utf8_decode(utf8_encode($fila[3]." ".$fila[4]." ".$fila[1]." ".$fila[2]));echo"</td>
									<td style='vertical-align:middle; text-align:center'>$estado</td>
								</tr>
								";
        					}
						?>
        			</tbody>
    			</table>
			</div>
		</div>
	</div>
	</center>


    </div>


 <div id="menu3" class="tab-pane fade">
    <center>
  <div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$Rut";?></b> </h4></div></center>
  <br><br><br>
  <div style="background-color: #F2F2F2" class="col-lg-12 col-md-12">
    <div class="container" style="margin-top: 30px">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="row">
            <div class="col-lg-3 col-md-3">
              <form class="form-horizontal" action="ingresoEmpleado.php" method="post">
                <input type="hidden" value="<?php echo $idEmpresa;?>" name="id" />
                <button type="submit" class="btn btn-primary">Agregar Empleado</button>
              </form>
            </div>
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-3 col-md-3">
              <label><h5><b>Buscar RUT, Nombre o Apellido</b></h5></label>
            </div>  
          </div>
        </div>
        <div class="col-md-12">
          <div class="row">
            <table id="empleados" class="table table-hover table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                          <th>Empleado</th>
                          <th>RUT</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Empleado</th>
                          <th>RUT</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        while($row = $empleado ->fetch_array()){
                        $rutsv=explode("-", $row[4]);
                  echo" 
                  <script type='text/javascript'>
                    function redireccionar(rutEmpleado,ver,rutemp){
                    window.location='fichaEmpleado.php?rut='+rutEmpleado+'&dv='+ver+'&rute='+rutemp;
                    } 
                  </script>
                  <tr style='cursor: pointer' onclick='javascript:redireccionar($rutsv[0],$rutsv[1],$Rut)'>
                    <td style='vertical-align:middle; text-align:center'>";echo utf8_decode(utf8_encode($row[2]." ".$row[3]." ".$row[0]." ".$row[1]));echo"</td>
                    <td style='vertical-align:middle; text-align:center'>$row[4]</td>
                  </tr>
                  ";
                      }
                ?>
                  </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
    
  </div>


    </div>






    <div id="menu4" class="tab-pane fade">
    <center>
    <div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$Rut";?></b> </h4></div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin: 40px 0px 0px 0px"></div>
<div style="margin-top:10px  " class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a href="javascript:void(0);" onclick="modalcc('<?php echo $Rut?>','myModal', 'modal_agregar_cc.php');"  data-toggle="modal" data-target="#myModal" class="btn btn-primary">Agregar centro de costos</a></div>
<div style="margin-top:10px  "  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a href="javascript:void(0);" onclick="modalca('<?php echo $Rut?>','myModal', 'modal_agregar_ca.php');"  data-toggle="modal" data-target="#myModal" class="btn btn-primary">Agregar cuenta auxiliar</a></div>
<div  style="margin-top:10px  "  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a href="javascript:void(0);" onclick="modaladdusr('<?php echo $Rut?>','myModal', 'modal_addusr.php');"  data-toggle="modal" data-target="#myModal" class="btn btn-primary">Agregar usuario</a></div>
<div style="margin-top:10px  "  class="col-xs-12 col-sm-12 col-md-3 col-lg-3"><a href="javascript:void(0);" onclick="modaldes('<?php echo $Rut?>','myModal', 'modal_des.php');"  data-toggle="modal" data-target="#myModal" class="btn btn-primary">Desactivar empresa</a></div>

</div>

</center>
    



    <div id="menu5" class="tab-pane fade">
    <center>
<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$Rut";?></b> </h4></div></center>

<!-- FORMULARIO PARA BUSCAR DOCUMENTO QUE SE QUIERE BORRAR -->
<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12">

<p><div class="col-md-3 col-lg-3 "><label>Tipo de documento</label>

<select id="tipo" class="form-control" name="añotrabajo" >
  
  <option value=""> </option>
   <option value="30">Factura </option>
    <option value="33">Factura Electrónica </option>
    <option value="34">Factura Exenta </option>
     <option value="55">Nota de debito </option>
      <option value="60"> Nota de credito</option>
       <option value="56">Nota de debito electrónica </option>
      <option value="61"> Nota de credito electrónica</option>
       <option value="2">Boleta </option>
        <option value="3">Boleta electrónica </option>
  
</select>

</div></p>




<p><div  class="col-md-3 col-lg-3 "><label>Tipo de registro</label>
<select id="fin" class="form-control" name="mestrabajo" required>
<option value=""></option>
  <option value="compra">1 - Compra</option>
  <option value="venta">2 - Venta</option>

</select>    </div></p>


<p><div class="col-md-3 col-lg-3 "><label>Número de documento - (Desde en boletas)</label>
<input  id="numeroo" class="form-control" name="ndoc" required>
  </div></p>

<input   type="hidden" value="<?php echo$Rut ?>" name="rut" >

<p><div class="col-md-2 col-lg-2 "  style="padding: 25px 0px 20px 0px; "> <label>&nbsp; &nbsp;</label><button type="submit" onclick="obtdocumento(<?php echo$Rut ?>)" class="btn btn-primary">Buscar</button></div></p>



<!-- MOSTRAR DOCUMENTO ENCONTRADO -->


    </div>

</div>


<!-- --------------------------------------------------------------------------------------------------------------------------------------------- -->
<div id="docenco"></div>  
<center>

 </center>

<!-- ---------------------------------------------------------------------- -->
<div style="height: 10px" class="col-lg-12 col-md-12 col-xs-12 col-sm-12"></div>


<div style="height: 10px" class="col-lg-9 col-md-9 col-xs-4 col-sm-4"></div>
<div style="height: 10px" class="col-lg-1 col-md-1 col-xs-3 col-sm-3"><a href="index.php" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
<div style="height: 50px" class="col-lg-2 col-md-2 col-xs-3 col-sm-3"><a href="listaEmpresas.php" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Lista de empresas&nbsp;&nbsp;&nbsp;</a></div>


</body>

</html>
<?php } ?>