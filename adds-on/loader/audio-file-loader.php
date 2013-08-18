<!-- If Javascript is disabled -->
<noscript>
    <div align="center"><a href="index.php">Go Back To Upload Form</a></div>
</noscript>

<?php

ini_set('memory_limit', '-1'); // Illimitata per la possibilitˆ di caricare pi file

echo '<div class="name">File caricati...</div>';

if (isset($_POST)) {
    //Some settings
    $MaxSize                = 20971520; // Max file size 20MB
    $DestinationDirectory   = $_SERVER['DOCUMENT_ROOT'].'/Boomer/media/audio/'; //Upload Directory must end with / (slash)
    
    //Creo un array dei file da caricare
    $tot = count($_FILES["file"]["name"]);
    for($i=0; $i<$tot; $i++) {
        $files[$i]["name"] = $_FILES["file"]["name"][$i];
        $files[$i]["type"] = $_FILES["file"]["type"][$i];
        $files[$i]["size"] = $_FILES["file"]["size"][$i];
        $files[$i]["tmp_name"] = $_FILES["file"]["tmp_name"][$i];
        $files[$i]["error"] = $_FILES["file"]["error"][$i];
    }
    
    //Per ogni file
    foreach($files as $file) {
        // Verifico che l'array del file non sia vuoto
        // "is_uploaded_file" tells whether the file was uploaded via HTTP POST
        if (!isset($file) || !is_uploaded_file($file['tmp_name'])) {
            die('Something went wrong with Upload!'); // output error when above checks fail.
        }
        
        // Elements (values) of $file array
        // let's access these values by using their index position.
        $AudioName = str_replace(' ', '-', strtolower($file["name"]));
        $AudioSize = $file["size"];
        $TempSrc = $file["tmp_name"];
        $AudioType = $file["type"];
        
        // Vedo se la dimensione va bene
        if ($AudioSize > $MaxSize) {
            die('Dimensione del file superiore ai 20Mb!');
        }
        
        $DestAudioName          = $DestinationDirectory.$AudioName;
        
        if (move_uploaded_file($TempSrc, $DestAudioName)) {

            // Mostro i file caricati
            echo '<div class="linea"><img src="/Boomer/adds-on/icons/music.png" alt="sound" width="25px" height="25px" style="padding-top:7px;"><p>'.$AudioName.'</p></div>';

            // Carico i file nel database
            $link = mysql_connect('localhost', 'root', 'root') or die('Could not connect: '.mysql_error());
            mysql_select_db('Boomer', $link) or die('Could not select Database');
            
            // Tolgo l'estensione dal nome
            $Name = preg_replace("/\.[^.\s]{3,4}$/", "", $AudioName);
            // Path del file
            $Path = 'media/audio/'.$AudioName;
            
            $sql = ("
                INSERT INTO Media (media_nome, media_link, media_tipo)
                VALUES ('".$Name."', '".$Path."', 'audio')
            ");
            mysql_query($sql, $link);
            
            mysql_close($link);

        } else {
            die('Load Error'); //output error
        }
    }
}

?>