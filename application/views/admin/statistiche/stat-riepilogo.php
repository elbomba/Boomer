<?php

// Recupero i dati da google Analytics
require 'adds-on/stats/gapi.class.php';

$ga = new gapi($ga_email, $ga_password);

$ga->requestReportData($ga_profile_id, null, array('visitors', 'newVisits', 'visits', 'pageviews', 'percentNewVisits'), array('-visitors'), null, null, null);
$gaResult = $ga->getResults();

foreach($gaResult as $row){
    $visits = $row->getVisits();
    $visitors = $row->getVisitors();
    $pageviews = $row->getPageviews();
    $new = $row->getNewVisits();
    $returning = $row->getVisits()-$row->getNewVisits();
    $newPercent = number_format($row->getPercentNewVisits(), 1);
    $returningPercent = number_format((100-$row->getPercentNewVisits()), 1);
}

?>

<!-- Div con i dati di riepilogo -->
<div class="dati-tot">
    <div id="visite" class="stat-element">
        <div class="title">
            Visite totali:
        </div>
        <canvas id="visite_line" height="50" width="125"></canvas>
        <div class="text">
            <?php echo $visits; ?>
        </div>
    </div>

    <div id="unique" class="stat-element">
        <div class="title">
            Visitatori unici:
        </div>
        <canvas id="visite_uniche" height="50" width="125"></canvas>
        <div class="text">
            <?php echo $visitors; ?>
        </div>
    </div>

    <div id="pages" class="stat-element">
        <div class="title">
            Visualizzazioni di pagine:
        </div>
        <canvas id="page_view" height="50" width="125"></canvas>
        <div class="text">
            <?php echo $pageviews; ?>
        </div>
    </div>

    <div id="new" class="stat-element">
        <div class="title">
            Nuove visite:
        </div>
        <canvas id="new_visits" height="50" width="125"></canvas>
        <div class="text">
            <?php echo $new; ?> (<?php echo $newPercent; ?>%)
        </div>
    </div>
    
    <div id="pie" class="stat-element">
        <div class="title">
            Nuovi e vecchi visitatori:
        </div>
        <div id="legenda">
            <div class="element"><div id="new-square" class="square"></div><div class="cont">Nuovi: <?php echo $new; ?> (<?php echo $newPercent; ?>%)</div></div>
            <div class="element"><div id="old-square" class="square"></div><div class="cont">Ritornati: <?php echo $returning; ?> (<?php echo $returningPercent; ?>%)</div></div>
        </div>
        <canvas id="new_old" height="100" width="100"></canvas>
    </div>
</div>

<!-- Carico lo script per la creazione dei grafici -->
<script src="../adds-on/stats/Chart.js"></script>

<?php

// Recupero la data di oggi
$fine = date('Y-m-d');

// Carico i risultati divisi per data per i grafici
$ga->requestReportData($ga_profile_id, array('date'), array('visits', 'visitors', 'pageviews', 'newVisits'), 'date', null, null, $fine);
$result = $ga->getResults();

?>

<script>

        // Opzioni generali dei grafici a linee
        var options = {
		scaleShowLabels : false,
		scaleLineColor : "#fff",
		scaleLineWidth : 0,
		pointDot : false,
		bezierCurve : false,
		datasetStroke : false,
		scaleShowGridLines : false,
//		animation : false,
		scaleFontColor : "#fff"
	}

        // Grafico visite totali 
	var data = {
		labels: [
			<?php foreach($result as $row) {
				echo substr($row, 6).",";
			} ?>
		],
		datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php foreach($result as $row){echo $row->getVisits().",";} ?>]
				}
		]
	};
	
	var line = new Chart(document.getElementById("visite_line").getContext("2d")).Line(data, options);
	
        // Grafico visitatori unici
	var data = {
		labels: [
			<?php foreach($result as $row) {
				echo substr($row, 6).",";
			} ?>
		],
		datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php foreach($result as $row){echo $row->getVisitors().",";} ?>]
				}
		]
	};

	var line2 = new Chart(document.getElementById("visite_uniche").getContext("2d")).Line(data, options);
	
        // Grafico pagine viste
	var data = {
		labels: [
			<?php foreach($result as $row) {
				echo substr($row, 6).",";
			} ?>
		],
		datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php foreach($result as $row){echo $row->getPageviews().",";} ?>]
				}
		]
	}
	
	var line3 = new Chart(document.getElementById("page_view").getContext("2d")).Line(data, options);
	
        // Grafico nuove visite
        var data = {
		labels: [
			<?php foreach($result as $row) {
				echo substr($row, 6).",";
			} ?>
		],
		datasets : [
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [<?php foreach($result as $row){echo $row->getNewVisits().",";} ?>]
				}
		]
	}
        
        var line3 = new Chart(document.getElementById("new_visits").getContext("2d")).Line(data, options);
        
	var data = [
		{
			value: <?php echo $returningPercent; ?>,
			color: "#093"
		},
		{
			value: <?php echo $newPercent; ?>,
			color: "#06C"
		}
	]
	
	var pie = new Chart(document.getElementById("new_old").getContext("2d")).Pie(data);

</script>