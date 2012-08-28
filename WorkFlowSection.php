<?php
/***************************************************************

Author : PHANEENDRA
Date : 25-Dec-2011
Veon Consulting Pvt. Ltd.

***************************************************************/


	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
    require_once('include/SugarPHPMailer.php');
	require_once('modules/Emails/Email.php');
	require_once('modules/Notes/Note.php');

	global $db;
	$new_status = "";
	$result = "";
	
	$id = $_REQUEST['id'];
	 $user_id = $_REQUEST['user_id'];
	 $btn_id  = $_REQUEST['btn_id'];
	
	if($btn_id == 'Start Work'){
		
		$new_status = "Preparing";
	}
    $query="UPDATE oa_officeactions SET officeactionstatus='$new_status' WHERE id='$id'";
    $res = $db->query($query);
	$result .= "\n Status is changed.";
	if($btn_id =='Start Work'){ // case log is not required for complete prepairation.
	
		$sql_UserName = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$user_id."' AND deleted = '0'";
		$res_User = $db->query($sql_UserName);
		$row_User = $db->fetchByAssoc($res_User);
		
		$dateTime = date("d-m-Y H:i:s");
	
		$caseHistory2 = new Note();
		$caseHistory2->name = "Office Action  History";
		$caseHistory2->parent_type = "oa_officeactions";
		$caseHistory2->parent_id = $id;
		$caseHistory2->assigned_user_id = $user_id;
		
		$caseHistory2->set_created_by = false;
		$caseHistory2->update_modified_by = false;
		
		$caseHistory2->modified_user_id = $user_id;
		$caseHistory2->created_by = $user_id;
		
		//if($btn_id == "Start Prepair"){
			$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." changed the office action status  from To Prepare to Preparing  ".$dateTime;
		//}
		
		$caseHistory2->save();
		$result .= "\n New office action status  is Registered.";
	
		$caseHistory2->set_created_by = true;
		$caseHistory2->update_modified_by = true;
	}	
	
	echo $result;
?>