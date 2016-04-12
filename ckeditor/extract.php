<?php 
    $zip = new ZipArchive();
    $x = $zip->open('ckeditor.zip'); // open the zip file to extract
    if ($x === true) {
        echo "vo";
        $zip->extractTo('ckeditor'); // place in the directory with same name
        $zip->close();
    }
?>