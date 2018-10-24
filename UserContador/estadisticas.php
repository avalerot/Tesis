<?php
setlocale(LC_ALL, "es_ES");
$idEmpresa=$_POST['id'];
include "../conection.php";
$empresa = $mysqli -> query("SELECT NombreEmpresa,Rut,VerificadorEmpresa FROM empresa WHERE idEmpresa='$idEmpresa'");
while($row = $empresa -> fetch_array()){
	$nombreEmpresa=$row[0];
	$rutEmpresa=$row[1]."-".$row[2];
}
$a= date('Y');
//Consultas gráfico 1
$vista = $mysqli -> query("CREATE OR REPLACE VIEW licencia_x_anio AS
							SELECT Count(L.id_licencia) as licencias, YEAR(L.fec_emision) as anio
							FROM licencia_medica L JOIN contrato C 
							ON L.numCont=C.numCont WHERE L.estado='2' AND C.idEmpresa='$idEmpresa'
                            GROUP BY YEAR(L.fec_emision)");
$select1 = $mysqli -> query("SELECT * FROM licencia_x_anio ORDER BY anio ASC");
$i=1;
$mayor=0;
$menor=3000;
$anios[0]=array("Año","Total de Licencias");
while($row = $select1->fetch_array()){
	$anios[$i]=array($row[1],(int) $row[0]);
	if($row[0]>$mayor){$mayor=$row[0];}
	if($row[0]<$menor){$menor=$row[0];}
	$i++;
}
$select2="SELECT anio FROM licencia_x_anio WHERE licencias='$menor';";
$select2.="SELECT anio FROM licencia_x_anio WHERE licencias='$mayor';";
$select2.="SELECT AVG(licencias) FROM licencia_x_anio";
$i=0;
if ($mysqli->multi_query($select2)) {
    do {
        /* almacenar primer juego de resultados */
        if ($result = $mysqli->store_result()) {
        	$datos[$i]="";
            while ($row = $result->fetch_row()) {
                $datos[$i].=$row[0]." ";
            }
            $result->free();
        }
        /* mostrar divisor */
        if ($mysqli->more_results()) {
			$i++;
        }
    } while ($mysqli->next_result());
}
//Fin consultas grafico 1
//Consultas grafico 2
$vista2 = $mysqli -> query("CREATE OR REPLACE VIEW licencia_x_mes AS
							SELECT Count(L.id_licencia) as licencias, MONTH(L.fec_emision) as mes,
							YEAR(L.fec_emision) as anio
							FROM licencia_medica L JOIN contrato C 
							ON L.numCont=C.numCont WHERE L.estado='2' AND C.idEmpresa='$idEmpresa'
							AND YEAR(L.fec_emision)='$a'
                            GROUP BY YEAR(L.fec_emision), MONTH(L.fec_emision)");
$select3 = $mysqli -> query("SELECT * FROM licencia_x_mes ORDER BY mes ASC");
$i=1;
$mayor2=0;
$menor2=3000;
$meses[0]=array("Mes","Total de Licencias");
while($row = $select3->fetch_array()){
	$fecha=mktime(0,0,0,$row[1],1,$a);
	$meses[$i]=array(date("F-Y",$fecha),(int) $row[0]);
	if($row[0]>$mayor2){$mayor2=$row[0];}
	if($row[0]<$menor2){$menor2=$row[0];}
	$i++;
}
$select4="SELECT mes FROM licencia_x_mes WHERE licencias='$menor2';";
$select4.="SELECT mes FROM licencia_x_mes WHERE licencias='$mayor2'";

$i=0;
if ($mysqli->multi_query($select4)) {
    do {
        /* almacenar primer juego de resultados */
        if ($result = $mysqli->store_result()) {
        	$datos2[$i]="";
            while ($row = $result->fetch_row()) {
            	$mes=mktime(0,0,0,$row[0],1,$a);
                $datos2[$i].=date("F",$mes)." ";
            }
            $result->free();
        }
        /* mostrar divisor */
        if ($mysqli->more_results()) {
			$i++;
        }
    } while ($mysqli->next_result());
}
$select5=$mysqli->query("SELECT AVG(licencias) FROM licencia_x_mes");
while($row=$select5->fetch_array()){
	$prom=$row[0];
}
//Fin consultas grafico 2
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Estadísticas de Licecias</title>
	<script src="../recursos/js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  	<script type="text/javascript">
  		google.charts.load("current", {packages:['corechart']});
    	google.charts.setOnLoadCallback(drawChart);

 	function drawChart() {
      var cargaDatos = <?php echo json_encode($anios);?>;
      var datosFinales = google.visualization.arrayToDataTable(cargaDatos);
	  var options = {
	  	title: 'Total de Licencias por Año',
	  	titleTextStyle: { fontSize: 22 },
	  	hAxis: {
          title: 'Año'
        },
        vAxis: {
          title: 'Total de Licencias'
        },
        legend: { position: 'none'}
	  };
      var chart = new google.visualization.ColumnChart(
        document.getElementById('anios'));

	  chart.draw(datosFinales, options);
	  }
  	</script>
  	<script type="text/javascript">
  		google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart2);

 	function drawChart2() {
      var cargaDatos = <?php echo json_encode($meses);?>;
      var datosFinales = google.visualization.arrayToDataTable(cargaDatos);
	  var options = {
	  	title: 'Total de Licencias por Mes',
	  	titleTextStyle: { fontSize: 22 },
	  	hAxis: {
          title: 'Mes'
        },
        vAxis: {
          title: 'Total de Licencias'
        },
        legend: { position: 'none'}
	  };
      var chart = new google.visualization.ColumnChart(
        document.getElementById('meses'));

	  chart.draw(datosFinales, options);
	  }
  	</script>
</head>
<body>
	<center>
		<p style="padding: 2px 0px 2px 0px; font-size: 20px" class="bg-primary">Licencia Médica</p>
	</center>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
					<li><a href="opciones.php?rut=<?php echo $rutEmpresa?>">Volver a Empresa</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<center>
		<div style="background-color: #F2F2F2; margin-bottom: 20px" class="col-xs-12 col-sm-12 col-lg-12 col-md-12"><h4>Empresa: <b><?php echo "$nombreEmpresa";?></b> - Rut: <b><?php echo "$rutEmpresa";?></b> </h4>	
	</center>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="row">
					<div id="anios" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 350px; margin-top: 50px"></div>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Año con mayor total de licencias:</b> <?php echo $datos[1];?></p>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Año con menor total de licencias:</b> <?php echo $datos[0];?></p>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Promedio anual de licencias:</b> <?php echo $datos[2];?></p>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="row">
					<div class="col-md-6 col-lg-6 col-sm-hidden col-xs-hidden"></div>
					<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-8 col-lg-8 col-sm-6 col-xs-6">Seleccione año a mostrar: </label>
								<div class="col-md-4 col-lg-4 col-sm-6 col-xs-6">
									<select class="form-control">
										<?php
										for($i=1;$i<sizeof($anios);$i++){
											if($i==sizeof($anios)-1){
												echo "<option value='".$anios[$i][0]."' selected>".$anios[$i][0]."</option>";
											}
											else{
												echo "<option value='".$anios[$i][0]."'>".$anios[$i][0]."</option>";
											}
										}
										?>
									</select>	
								</div>	
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					<div id="meses" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: 350px"></div>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Mes con mayor total de licencias:</b> <?php echo $datos2[1];?></p>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Mes con menor total de licencias:</b> <?php echo $datos2[0];?></p>
					<p class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>Promedio mensual de licencias:</b> <?php echo $prom;?></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

