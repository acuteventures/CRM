

<?php
/****************************************************************************

Author : PHANEENDRA
Dt . 25-Dec-2011
Veon Consulting Pvt. Ltd.
****************************************************************************/

 	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
    $bean_id  = $_REQUEST['beanid'];
	$notes    = $_REQUEST['notes'];
	$user_id  = $_REQUEST['userid'];
	$notes_id = $_REQUEST['notesid'];
	$note_delete = new Note();
	$note_delete->mark_deletedByNoteid($notes_id);
	
	$note_module = new Note();
	
	$note_module->set_created_by = false;
	$note_module->update_modified_by = false;
	
	$note_module->name = 'Case History - Manual';
	$note_module->parent_id = $bean_id;
	$note_module->description = $notes;
	$note_module->parent_type = 'oa_officeactions';
	$note_module->assigned_user_id = $user_id;
	$note_module->created_by  = $user_id;
	$note_module->modified_user_id = $user_id;
	$note_module->entry = 1;

	$note_module->save();
	
?>