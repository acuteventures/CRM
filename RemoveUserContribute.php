<?php

/*********************************************************************************************************************/		
		// Author : Basudeba Rath.
		// Dt. 13-Dec-2011.
		// Veon Consulting Pvt. Ltd.
/*********************************************************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$cont_id = $_REQUEST['cont_id'];
	
	$contObj = new c_contribute();
	$contObj->mark_deletedByContId($cont_id);
	echo "Successfully Deleted.";
	
?>