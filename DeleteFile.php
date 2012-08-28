<?php
/***********************************
 * Rajesh G - 26/04/12
 * parameters needed - file path
 **********************************/
if(!defined('sugarEntry')) define('sugarEntry', true);
$fileNameWtPath = $_GET['file'];
unlink($fileNameWtPath);
echo "deleted";
/**********************************/
?>
