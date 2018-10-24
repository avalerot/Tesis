<?php
$id=$_POST['id'];
include '../conection.php';
$empresa=$mysqli -> query("SELECT idEmpresa,Rut,NombreEmpresa FROM empresa WHERE idEmpresa='$id'");
while($row = $empresa -> fetch_array()){
	$idEmpresa=$row[0];
	$rutEmpresa=$row[1];
	$nombreEmpresa=$row[2];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ingreso Empleado</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="rut.js" type="text/javascript"></script>
	<script src="ajax_verifica.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type='text/javascript'>
		function redireccionar(rut){
		window.location='fichaEmpleado.php?rut='+rut;
		}
	</script>
	<script>
		function solorut(e){
  			Key=e.KeyCode || e.which;
  			teclado=String.fromCharCode(Key).toLowerCase();
  			Letras="0123456789kK";
  			especiales="8-37-38-46-164";
  			teclado_especial=false;
  			for(var i in especiales){
    			if(Key==especiales[i]){
      				teclado_especial=true;break;
      			}
    
    		}
    		if (Letras.indexOf(teclado)==-1 && !teclado_especial){
      			return false;
      		}
  		}
  		
  		function sololetras(e){
  			Key=e.KeyCode || e.which;
  			teclado=String.fromCharCode(Key);
  			Letras="áéíóúüabcde fghijklmnñopqrstuvwxyzÁÉÍÓÚÜABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
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
</head>
<body>
	<center>
	<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Ingreso de Empleado</p>
	<div style="background-color: #F2F2F2" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$rutEmpresa";?></b> </h4>
	<p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-danger" id="incorrecto"></p>
	<p style="padding: 0px 0px 0px 10px; margin: 0px 0px 5px 0px" class="bg-success" id="correcto"></p>
	<div id="ingresado"></div>
	</center><br><br><br>
	<div class="container-fluid">
	<center><form class="form-horizontal" action="subirEmpleado.php" method="post">
		<div class="row" style="background-color: #F2F2F2">
			<div class="col-md-12 col-lg-12">
				<div class="row">
					<div class="col-lg-5 col-md-5"></div>
					<div class="col-lg-2 col-md-2">
						<label><h4>Ingrese RUT: </h4></label>
						<input class="form-control" type="text" maxlength="10" autocomplete="off" id="rut" name="rut" onkeypress="return solorut(event)" onkeyup="checkRut(this)" onblur="verifica(this.value)" />
					</div>
				<div class="col-lg-5 col-md-5"></div>
				</div>
			</div>
		</div>
		<div class="row" style="background-color: #F2F2F2" id="formulario">
			<div class="col-lg-12 col-md-12">
				<div class="row">
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Primer Nombre</b></h4></label>
						<input class="form-control" type="text" name="nombre1" id="nombre1" autocomplete="off" required onkeypress="return sololetras(event)" disabled/>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Segundo Nombre</b></h4></label>
						<input class="form-control" type="text" name="nombre2" id="nombre2" autocomplete="off" onkeypress="return sololetras(event)" disabled/>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Apellido Paterno</b></h4></label>
						<input class="form-control" type="text" name="apellido1" id="apellido1" autocomplete="off" required onkeypress="return sololetras(event)" disabled/>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Apellido Materno</b></h4></label>
						<input class="form-control" type="text"  name="apellido2" id="apellido2" autocomplete="off" onkeypress="return sololetras(event)" disabled/>
					</div>
				</div>
			</div>
			<div class="col-lg-12 col-md-12">
				<div class="row">
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Sistema de Salud</b></h4></label>
						<select class="form-control" name="salud" id="salud" disabled/>
							<option value="">Seleccione una opción</option>
							<option value="FONASA">FONASA</option>
							<option value="Banmédica">Banmédica</option>
							<option value="Colmena">Colmena</option>
							<option value="Consalud">Consalud</option>
							<option value="Cruz Blanca">Cruz Blanca</option>
							<option value="Vida Tres">Vida Tres</option>
							<option value="Río Blanco">Río Blanco</option>
						</select>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Previsión</b></h4></label>
						<select class="form-control" name="prevision" id="prevision" disabled/>
							<option value="">Seleccione una opción</option>
							<option value="Modelo">Modelo</option>
							<option value="Cuprum">Cuprum</option>
							<option value="Habitat">Habitat</option>
							<option value="Planvital">Planvital</option>
							<option value="Provida">Provida</option>
						</select>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Fecha de Contrato</b></h4></label>
						<input class="form-control" type="date" name="contrato" id="contrato" min="1910-01-01" disabled required/>
					</div>
					<div class="col-lg-3 col-md-3">
						<label><h4><b>Fecha de Afiliación</b></h4></label>
						<input class="form-control" type="date" name="afiliacion" id="afiliacion" min="1910-01-01" required disabled/>
						<input type="hidden" name="empresa" value="<?php echo $idEmpresa;?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="background-color: #F2F2F2; padding-bottom: 10px">
			<br><button type="submit" class="btn btn-primary" name="boton" id="boton" disabled>Registrar</button>
		</div>
	</form></center>
	</div>
	<br>
	<div style="height: 10px" class="col-lg-9 col-md-9 col-xs-4 col-sm-4"></div>
	<div style="height: 10px" class="col-lg-1 col-md-1 col-xs-3 col-sm-3"><a href="index.php" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;inicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
	<div style="height: 50px" class="col-lg-2 col-md-2 col-xs-3 col-sm-3"><a href="listaEmpresas.php" class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;Lista de empresas&nbsp;&nbsp;&nbsp;</a></div>
</body>
</html>
