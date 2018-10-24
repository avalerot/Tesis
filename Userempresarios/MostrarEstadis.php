
<?php

include '../conection.php';
$regiones = $mysqli->query("Select region_numero,region_numero_romano, nombre_region FROM regiones
           ORDER BY region_numero ASC");
if(isset($_POST['ccelegida'])){
$ccelegida=$_POST['ccelegida'];;

}else{

}
$Rutempre=0;
if(isset($_POST['rueEmpr'])){
$Rutempre=$_POST['rueEmpr'];;

}else{

}
$mesact=date("m");
$anoact=date("Y");

//--------------------------FACTURAS
$tot = $mysqli->query("SELECT sum(TotalFact),sum(TotalIva),sum(TotalNeto),sum(TotalExento),sum(TotalEspyRet) FROM facturaventa where Mestrab='$mesact'  AND anoTrab='$anoact' and rutEmpre='$Rutempre' ");
$tota = mysqli_fetch_array($tot, MYSQLI_NUM);
$totalfacs=$tota[0];
$totaliva=$tota[1];
$netooo=$tota[2];
$exeen=$tota[3];
$espe=$tota[4];
//--------------------------boletas
$bole = $mysqli->query("SELECT sum(total),sum(totaliva),sum(neto) FROM boleta where Mestrab='$mesact'  AND anoTrab='$anoact' and rutEmpre='$Rutempre' ");
$bolet = mysqli_fetch_array($bole, MYSQLI_NUM);
$totalbols=$bolet[0];
$ivabols=$bolet[1];
$netobols=$bolet[2];

//--------------CALCULANDO TOTALES---------------------S
$todototal=$totalfacs+$totalbols;
$todoiva=$totaliva+$ivabols;
$todoneto=$netooo+$netobols;


?>

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Mes', 'IVA FACTURAS'],
          ['Total iva venta facturas',   <?php echo $totaliva ?>],
          ['Total neto facturas',      <?php echo $netooo ?>],
          ['Total específico',  <?php echo $espe ?>],
        ]);

        var options = {
          title: 'Facturas venta'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Mes', 'IVA BOLETAS'],
          ['Total iva venta boletas',   <?php echo $ivabols ?>],
          ['Total neto boletas',      <?php echo $netobols ?>],
        ]);

        var options = {
          title: 'Boletas venta'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
      }
    </script>



<div class="col-md-6 col-sm-12">
	<div id="piechart" style="width: 600px; height: 500px;"></div>
</div>
<div class="col-md-6 col-sm-12">
	<div id="piechart2" style="width: 600px; height: 500px;"></div>
</div>
