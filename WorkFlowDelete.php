<?php

/****************************************************************************

Author : PHANEENDRA
Dt . 25-Dec-2011
Veon Consulting Pvt. Ltd.
****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$note_id = $_REQUEST['notesid'];
	
	$note_delete = new Note();
	$note_delete->mark_deletedByNoteid($note_id);
	
	

/****************************************************************************/
?>