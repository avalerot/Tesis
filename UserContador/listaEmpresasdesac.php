
<?php
session_start();
if(!isset($_SESSION["session_username0"])) {
 header("location:../login.php");
} else {
     $usr=($_SESSION["session_username0"]);
?>
 <?php 

unset($_SESSION['arraySecuen']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista Empresas</title>
<!--Gonzalo Maldonado Saavedra!-->
<script src="ajax1.js"></script>
<!-- Gonzalo Salvador Maldonado Saavedra -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- jQuery library -->
<script src="css/jquery.Jcrop.css"></script>



	<link rel="stylesheet" type="text/css" href="../recursos/tabladinamic/jquery.dataTables.min.css">
	
	<script type="text/javascript" language="javascript" src="../recursos/tabladinamic/jquery-1.12.4.js">
	</script>
	<script type="text/javascript" language="javascript" src="../recursos/tabladinamic/jquery.dataTables.min.js">
	</script>
	
<script type="text/javascript" class="init">
	
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- Latest compiled JavaScript -->
<script src="css/jquery.Jcrop.min.css"></script>
<script>
function sololetras2(e){
	Key=e.KeyCode || e.which;
	teclado=String.fromCharCode(Key).toLowerCase();
	Letras="áéíóúüabcdefghijklmnñopqrstuvwxyz";
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

<!--------------------------------------------------------------------------------------- -->
<?php   
include '../conection.php';
$empresa = $mysqli->query("SELECT E.NombreEmpresa,E.Rut,E.VerificadorEmpresa, C.qr, E.mail FROM empresa E LEFT JOIN codigo C ON C.rutEmpresa=E.rut where E.Estado='0' order by E.NombreEmpresa asc ");


			 ?>
    
<!--------------------------------------------------------------------------------------- -->
</head>

<body>




<center>
<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Lista de empresas activas</p></center>
   <p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-danger" id="aler"> </p>
<div class="container">


	
	<div class="container-fluid">



  <div  class="col-xs-5 col-sm-5 col-md-2">
  <a href="index.php" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Volver al inicio&nbsp;&nbsp;&nbsp;&nbsp;</a>
  </div>
  
 </div>

<div class="container" style="margin:30px 0px 0px 0px">

<div class="row">
  <div class="col-md-12">
	<div class="row">
<table style="border: solid;"  id="example" class="table table-hover" cellspacing="0" width="100%">
  <thead>
            <tr>
            <th style='width:20%; text-align:center'>Nombre empresa</th>
            <th style='width:10%; text-align:center'>Rut empresa</th>
            <th style='width:20%; text-align:center'>Mail empresa</th>
        
            
            </tr>
        </thead>
        <tfoot>
            <tr>
            <th style='width:20%; text-align:center'>Nombre empresa</th>
                 <th style='width:10%; text-align:center'>Rut empresa</th>
            <th style='width:20%; text-align:center'>Mail empresa</th>
          
            
            </tr>
        </tfoot>
    
  <tbody>
   
    	<?php
        while($row = $empresa ->fetch_array()){
		
        	echo" 
        	        
   		<script type='text/javascript'>
		   
     function redireccionar(rutt){
  window.location='opciones.php?rut='+rutt;
 
} 


</script>
  
			
        	<tr style='cursor: pointer' onclick='javascript:redireccionar($row[1])'>
			
					<td style='vertical-align:middle; text-align:center'>$row[0]</td>
					<td style='vertical-align:middle; text-align:center'>$row[1]-$row[2]</td>
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
</center>
</div>
</div>
</div>
</div>

 <div style="height: 30px; width: 100%"></div>
</body>

</html>
<?php } ?>