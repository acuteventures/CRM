<?php
/****************************************************************************

Author : Basudeba Rath
Dt . 25-Nov-2011
Veon Consulting Pvt. Ltd.


****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$note_id = $_REQUEST['notesid'];
	/*$sql_del_NOTES = "DELETE FROM `notes` WHERE `id` = '".$note_id."'";
	$res_del_NOTES = $db->query($sql_del_NOTES);
	print_r($res_del_NOTES);*/
	
	$note_delete = new Note();
	$note_delete->mark_deletedByNoteid($note_id);
	echo "Successfully Deleted.";

/****************************************************************************/
?>