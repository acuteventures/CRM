<?php
if(!defined('sugarEntry')) define('sugarEntry', true);

$invId = $_GET['invId'];
$clientId = $_GET['clientId'];
$path = $_SERVER['DOCUMENT_ROOT']."/test/upload/Invention/".$clientId."/".$invId."/";
$fullPath = $path.$_GET['file_name'];

if ($fd = fopen($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); 
        break;
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); 
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
?>