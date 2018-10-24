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