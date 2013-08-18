<?php

// Recupero i dati da google Analytics
require 'adds-on/stats/gapi.class.php';

$ga = new gapi($ga_email, $ga_password);

// Recupero la data di oggi
$fine = date('Y-m-d');

$ga->requestReportData($ga_profile_id, array('deviceCategory'), array('visits', 'pageviews'), array('-visits'), null, null, $fine);
$result = $ga->getResults();

$tot = 0;
foreach($result as $row) {
    $tot += $row->getVisits();
}

// Array dei colori per la legenda
$color = array('#0066CC', '#009933', '#ed561b', '#edef00', '#24cbe5', '#64e572', '#ff9655', '#fff263', '#6af9c4', '#b2deff', '#ccc');

?>

<!-- Div con i dati di riepilogo -->
<div class="dati-tot">
    <div class="title-table">Device</div>
    <table class="stat-table">
        <tr class="headers">
            <td style="width: 20px;">Legenda</td>
	    <td style="min-width:100px;">Categoria Dispositivo</td>
	    <td style="min-width:50px;">Visite</td>
	    <td style="min-width:60px;">Pagine Visitate</td>
            <td style="min-width:50px;">Percentuale</td>
	</tr>


        <?php
            // Counter per i colori
            $i=0;
            foreach($result as $row) {
                echo '<tr>';
                echo '<td style="text-align: center;" class="td-square"><div class="square" style="background-color: '.$color[$i].'"></div></td>';
                echo '<td>'.$row.'</td>';
                echo '<td>'.$row->getVisits().'</td>';
                echo '<td>'.$row->getPageviews().'</td>';
                echo '<td>'.number_format(($row->getVisits()*100)/$tot, 2).'%</td>';
                echo '</tr>';
                $i++;
            }
        ?>

    </table>

    <div id="dev-pie-cont" class="pie-cont">
        <canvas id="dev-pie" class="pie" height="200" width="200"></canvas>
    </div>
    
    <!-- Carico lo script per la creazione dei grafici -->
<script src="../../adds-on/stats/Chart.js"></script>

<script>

	var data = [
                <?php

                $i=0;
                foreach($result as $row) {
                    echo '{';
                    echo 'value: '.number_format(($row->getVisits()*100)/$tot, 2).',';
                    echo 'color: "'.$color[$i].'"';
                    echo '},';
                    $i++;
                }
                
                ?>
	]
	
	var pie = new Chart(document.getElementById("dev-pie").getContext("2d")).Pie(data);

</script>