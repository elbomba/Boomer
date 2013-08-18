<?php

// Recupero i dati da google Analytics
require 'adds-on/stats/gapi.class.php';

$ga = new gapi($ga_email, $ga_password);

// Recupero la data di oggi
$fine = date('Y-m-d');

$ga->requestReportData($ga_profile_id, array('language'), array('visits', 'pageviews'), array('-visits'), null, null, $fine);
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
    <div class="title-table">Per lingua</div>
    <table class="stat-table">
        <tr class="headers">
            <td style="width: 20px;">Legenda</td>
	    <td style="min-width:100px;">Lingua</td>
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

    <div id="demo-pie-cont" class="pie-cont">
        <canvas id="demo-pie" class="pie" height="200" width="200"></canvas>
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
	
	var pie = new Chart(document.getElementById("demo-pie").getContext("2d")).Pie(data);

</script>
    
    <!-- Tabella per paesi -->
    <?php    
        $ga->requestReportData($ga_profile_id, array('country'), array('visits', 'pageviews'), array('-visits'), null, null, $fine);
        $result = $ga->getResults();
        
        $tot = 0;
        foreach($result as $row) {
            $tot += $row->getVisits();
        }
    ?>
    
    <div class="title-table">Per Paese/Zona</div>
    <table class="stat-table">
        <tr class="headers">
            <td style="width: 20px;">Legenda</td>
	    <td style="min-width:100px;">Paese/Zona</td>
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
    
    <div id="country-pie-cont" class="pie-cont">
        <canvas id="country-pie" class="pie" height="200" width="200"></canvas>
    </div>
    
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
	
	var pie2 = new Chart(document.getElementById("country-pie").getContext("2d")).Pie(data);

    </script>
    
    
    <!-- Tabella per cittˆ -->
    <?php    
        $ga->requestReportData($ga_profile_id, array('city'), array('visits', 'pageviews'), array('-visits'), null, null, $fine);
        $result = $ga->getResults();
        
        $tot = 0;
        foreach($result as $row) {
            $tot += $row->getVisits();
        }
    ?>
    
    <div class="title-table">Per Citt&agrave</div>
    <table class="stat-table">
        <tr class="headers">
            <td style="width: 20px;">Legenda</td>
	    <td style="min-width:100px;">Citt&agrave</td>
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
                if ($i < 10) {
                    $i++;
                }
            }
        ?>

    </table>
    
    <div id="city-pie-cont" class="pie-cont">
        <canvas id="city-pie" class="pie" height="200" width="200"></canvas>
    </div>
    
    <script>

	var data = [
            <?php

            $oltre = false;
            $i=0;
            $altro=0;
            foreach($result as $row) {
                if ($i < 10) {
                    echo '{';
                    echo 'value: '.number_format(($row->getVisits()*100)/$tot, 2).',';
                    echo 'color: "'.$color[$i].'"';
                    echo '},';
                    $i++;
                } else {
                    $oltre = true;
                    $altro += number_format(($row->getVisits()*100)/$tot, 2);
                }
            }
            
            if ($oltre) {
                echo '{';
                    echo 'value: '.$altro.',';
                    echo 'color: "'.$color[10].'"';
                    echo '},';
            }

            ?>
	]
	
	var pie2 = new Chart(document.getElementById("city-pie").getContext("2d")).Pie(data);

    </script>
    
</div>

