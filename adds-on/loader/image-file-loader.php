<!-- If Javascript is disabled -->
<noscript>
    <div align="center"><a href="index.php">Go Back To Upload Form</a></div>
</noscript>

<?php

ini_set('memory_limit', '-1'); // Illimitata per la possibilitˆ di caricare pi file

echo '<div class="name">File caricati...</div>';

if (isset($_POST)) {
    //Some settings
    $ThumbSquareSize        = 200; //Thumbnail wiil be 200x200
    $BigImageMaxSize        = 500; //Image Maximum height or Width
    $ThumbPrefix            = "thumb_"; //Normal thumb Prefix
    $DestinationDirectory   = $_SERVER['DOCUMENT_ROOT'].'/Boomer/media/images/'; //Upload Directory must end with / (slash)
    $Quality                = 90;
    
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
        $ImageName = str_replace(' ', '-', strtolower($file["name"]));
        $ImageSize = $file["size"];
        $TempSrc = $file["tmp_name"];
        $ImageType = $file["type"];
        
        // PHP getimagesize() function returns height-width from image file stored in PHP tmp folder.
        // Let's get first two values from image, width and height. list assign values to $CurWidth, $CurHeight
        list($CurWidth, $CurHeight)=getimagesize($TempSrc);
        
        // Set the Destination Image
        $thumb_DestImageName    = $DestinationDirectory."thumbs/".$ThumbPrefix.$ImageName;
        $DestImageName          = $DestinationDirectory.$ImageName;
        
        // Imposto il resource
        $CreatedImage = imagecreatefromstring(file_get_contents($TempSrc));
        
        // Resize image to our specified Size by calling resizeImage function.
        if (resizeImage($CurWidth, $CurHeight, $BigImageMaxSize, $DestImageName, $CreatedImage, $Quality, $ImageType)) {
            //Create a square Thumbnailright after, this time we are using cropImage() function
            if (!cropImage($CurWidth, $CurHeight, $ThumbSquareSize, $thumb_DestImageName, $CreatedImage, $Quality, $ImageType)) {
                echo 'Error Creating Thumbnail';
            }
            
            /*
            At this point we have succesfully resized and created thumbnail image
            We can render image to user's browser or store information in the database
            For demo, we are going to output results on browser.
            */

            //Get New Image Size
            list($ResizedWidth, $ResizedHeight)=getimagesize($DestImageName);

            // Mostro i file caricati
            echo '<div class="linea"><img src="/Boomer/media/images/thumbs/'.$ThumbPrefix.$ImageName.'" alt="Thumbnail" height="50px" width="50px"><p>'.$ImageName.'</p></div>';

            // Carico i file nel database
            $link = mysql_connect('localhost', 'root', 'root') or die('Could not connect: '.mysql_error());
            mysql_select_db('Boomer', $link) or die('Could not select Database');
            
            // Tolgo l'estensione dal nome
            $Name = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
            // Path del file
            $ThumbPath = 'media/images/thumbs/'.$ThumbPrefix.$ImageName;
            $Path = 'media/images/'.$ImageName;
            
            $sql = ("
                INSERT INTO Media (media_nome, media_link, media_thumb_link, media_tipo)
                VALUES ('".$Name."', '".$Path."', '".$ThumbPath."', 'image')
            ");
            mysql_query($sql, $link);
            
            mysql_close($link);

        } else {
            die('Resize Error'); //output error
        }
    }
}

// This function will proportionally resize image
function resizeImage($CurWidth, $CurHeight, $MaxSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
    //Check Image size is not 0
    if ($CurWidth <=0 || $CurHeight <= 0) {
        return false;
    }
    
    //Construct a proportional size of new image
    $ImageScale         = min($MaxSize/$CurWidth, $MaxSize/$CurHeight);
    $NewWidth           = ceil($ImageScale*$CurWidth);
    $NewHeight          = ceil($ImageScale*$CurHeight);
    
    if ($CurWidth < $NewWidth || $CurHeight < $NewHeight) {
        $NewWidth = $CurWidth;
        $NewHeight = $CurHeight;
    }
    
    
    $NewCanvas = imagecreatetruecolor($NewWidth, $NewHeight);
    // Resize Image
    if (imagecopyresampled($NewCanvas, $SrcImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight)) {
        switch(strtolower($ImageType)) {
            case 'image/png':
                imagepng($NewCanvas,$DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanvas,$DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanvas,$DestFolder,$Quality);
                break;
            default:
                return false;
        }
        if (is_resource($NewCanvas)) {
            imagedestroy($NewCanvas);
        }
        return true;
    }
}

// This function crop image to create exact square image, no matter what is original size!
function cropImage($CurWidth, $CurHeight, $iSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
    //Check Image size is not 0
    if ($CurWidth <=0 || $CurHeight <= 0) {
        return false;
    }
    
    if ($CurWidth>$CurHeight) {
        $y_offset = 0;
        $x_offset = ($CurWidth - $CurHeight) / 2;
        $square_size = $CurWidth - ($x_offset * 2);
    } else {
        $x_offset = 0;
        $y_offset = ($CurHeight - $CurWidth) / 2;
        $square_size = $CurHeight - ($y_offset * 2);
    }
    
    $NewCanvas = imagecreatetruecolor($iSize, $iSize);
    if (imagecopyresampled($NewCanvas, $SrcImage, 0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)) {
        switch(strtolower($ImageType)) {
            case 'image/png':
                imagepng($NewCanvas,$DestFolder);
                break;
            case 'image/gif':
                imagegif($NewCanvas,$DestFolder);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                imagejpeg($NewCanvas,$DestFolder,$Quality);
                break;
            default:
                return false;
        }
        if (is_resource($NewCanvas)) {
            imagedestroy($NewCanvas);
        }
        return true;
    }
}

?>