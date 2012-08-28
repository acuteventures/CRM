<?php 

/****************************************************************************

Author : Basudeba Rath
Dt . 19-Jan-2012
Veon Consulting Pvt. Ltd.


****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$note_id = $_REQUEST['notesid'];
	
	$note_delete = new Note();
	$note_delete->mark_deletedByNoteid($note_id);
	echo "Successfully Deleted.";

/****************************************************************************/


?>