<?php

error_reporting(E_ALL);
ini_set("display_errors", 0);

$temp_dir = __DIR__.'/temp/';
$source_dir = __DIR__.'/profile/';

$file_name = $temp_dir.$_POST['dosyaAdi'].'.'.$_POST['uzanti'];
$source_name = $source_dir.$_POST['dosyaAdi'].'.webp';

if(file_exists($source_name)){
    unlink($source_name);
}

file_put_contents($file_name, base64_decode($_POST['b64']));

function convertImageToWebP($source, $destination, $quality = 100) {
    $file_extension = pathinfo($source, PATHINFO_EXTENSION);
    if ($file_extension == 'jpeg' || $file_extension == 'jpg') {
        $image = imagecreatefromjpeg($source);
    } else if ($file_extension == 'gif') {
        $image = imagecreatefromgif($source);
    } else if ($file_extension == 'png') {
        $image = imagecreatefrompng($source);
    }
    unlink($source);
    return imagewebp($image, $destination, $quality);
}
convertImageToWebP($file_name,$source_name);
echo json_encode(array('result'=>true));

?>