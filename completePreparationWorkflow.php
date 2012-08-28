<?php
/***************************************************************
Author : ANURADHA
Date : 31-Jan-2012
Veon Consulting Pvt. Ltd.
***************************************************************/
	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
    require_once('include/SugarPHPMailer.php');
	require_once('modules/Emails/Email.php');
	require_once('modules/Notes/Note.php');
	require_once('include/utils.php');

	global $db;	
	$result = "";
	
	 $id = $_REQUEST['id'];
	 $user_id = $_REQUEST['user_id'];
	 $subcase_status_id  = $_REQUEST['subcase_status_id'];
	 $subcase_number = $_REQUEST['subcase_number'];
	 $oa_obj = new oa_officeactions();
	 $oa_obj = $oa_obj->retrieve($id);
	 
	//Change case status from ‘In Progress’ to ‘To Send’
	/**
	-------------------------------------------------
	* get the To Send status id based on the order no
	-------------------------------------------------
	*/
	$getStatusQuery="SELECT * FROM c_case_status WHERE order_no='40' AND deleted=0 ";
	$getStatusQuery_res = $db->query($getStatusQuery);
	$status_row = $db->fetchByAssoc($getStatusQuery_res);
	
    //$query="UPDATE oa_officeactions SET subcase_status_id='".$status_row['id']."' WHERE id='$id' AND deleted=0 ";
	//by swapna dt:-16-03-2012
    //$status_age_now = subcase_Status_Age($id, $subcase_status_id);
     $status_age_now=0;
    $query="UPDATE oa_officeactions SET subcase_status_id='".$status_row['id']."', subcase_status_age='".$status_age_now."' WHERE id='$id' AND deleted=0 ";
    $res = $db->query($query);
    
    	// subcase status audit table
	// Author: Swapna , Date :16-Mar-2012.
	$sub_audit_id = create_guid();
	$curr_dtTime = gmdate ("Y-m-d H:i:s", time());

	$query_sub_audit = "INSERT INTO oa_officeactions_audit(id,parent_id,date_created,created_by,field_name,data_type,before_value_string,after_value_string) values ('".$sub_audit_id."', '".$id."','".$curr_dtTime."','1','subcase_status_id','id','".$subcase_status_id."','".$status_row['id']."')";
	$db->query($query_sub_audit);

	$result .= "\n Status is changed.";
	
	/**
	* add to the case history secton if complete preparation button clicked
	*/
		$sql_UserName = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$user_id."' AND deleted = '0'";
		$res_User = $db->query($sql_UserName);
		$row_User = $db->fetchByAssoc($res_User);
		
		$dateTime = date("d-m-Y H:i:s");
	
		$caseHistory2 = new Note();
		$caseHistory2->name = "SubCase History";
		$caseHistory2->parent_type = "oa_officeactions";
		$caseHistory2->parent_id = $id;
		$caseHistory2->assigned_user_id = $user_id;
		
		$caseHistory2->set_created_by = false;
		$caseHistory2->update_modified_by = false;
		
		$caseHistory2->modified_user_id = $user_id;
		$caseHistory2->created_by = $user_id;
		
		$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." changed subcase number ".$subcase_number." status from In Progress to To Send ";
		
		$caseHistory2->save();
		$result .= "\n New subcase status is Registered.";
	
		$caseHistory2->set_created_by = true;
		$caseHistory2->update_modified_by = true;
		
	/**
	* Email the employee assigned to the parent Client of the case informing of the status change
	*/
	/**
	------------------------------------------------------------------------------
	* get the parent case id from the relationship table oa_officeactions_cases_c 
	------------------------------------------------------------------------------
	*/
	$getCaseId = "SELECT * FROM oa_officeactions_cases_c WHERE oa_officeactions_casesoa_officeactions_idb = '".$id."' AND deleted = '0'";
	$getCaseId = $db->query($getCaseId);
	$getCaseId_row = $db->fetchByAssoc($getCaseId);
		
		/**
		* get the client id of the case
		*/
		$a = new aCase();
		$case_obj = $a->retrieve($getCaseId_row['oa_officeactions_casescases_ida']);
		$parent_client_id = $case_obj->account_id;
		//get the email address of assigned to employee
		$get_assigned = "SELECT ea.email_address,u.user_name,u.first_name,u.last_name,eabr.email_address_id,eabr.bean_module 
FROM accounts a JOIn users u 
ON u.id=a.assigned_user_id AND u.deleted=0 
JOIn `email_addr_bean_rel` eabr ON eabr.bean_id=u.id AND eabr.deleted=0
JOIN `email_addresses` ea ON ea.id=eabr.email_address_id AND ea.deleted=0
WHERE a.deleted=0 AND a.id='".$parent_client_id."' ";
		$get_assigned = $db->query($get_assigned);
		$get_assigned_row = $db->fetchByAssoc($get_assigned);

		//echo $get_assigned_row['email_address'];

	    $email_focus = new Email();
		$defaults = $email_focus->getSystemDefaultEmail();
	
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$mail->IsHTML(true);
		$mail->From = $defaults['email'];
		$mail->FromName = $defaults['name']; 
		$hasRecipients = false; 
		$mail->AddAddress($get_assigned_row['email_address']);    
		$hasRecipients = true;
		
		$message = "Hi ".$get_assigned_row['last_name']."<br /> sub case status has been changed to <b>To Send.</b>";
		$message .= "<br />Sub Case Number: " . $oa_obj->name . "<br />Client Name : ".$case_obj->account_name;
		
		$mail->Subject = "Sub Case Status"; 
		$mail->Body = '<html><body>'.$message.'<br /></body></html>';
		
		$mail->prepForOutbound();
		
		if($hasRecipients){
			$success = @$mail->Send(); 
			$result .= "\n An Email is sent to assigned to user of client." ;
		}
	
		
	echo $result;
		/**************************** SUBCASE STATUS AGE BY SWAPNA DT:16-03-2011 ******************************************/	
	
	/*function subcase_Status_Age($id,$subcase_status_id){
		
		global $db;
		//$cs_obj = new c_case_status();
		//rec_cs_obj = $cs_obj->retrieve($record->status);
	
		$sql_status_audit_before = "SELECT * FROM oa_officeactions_audit WHERE parent_id = '".$id."' 
							 AND after_value_string = '".$subcase_status_id."' ORDER BY  `date_created` DESC ";
										  
		$res_status_audit = $db->query($sql_status_audit_before);
		if($row_audit = $db->fetchByAssoc($res_status_audit)){
		
			$bef_date_status = $row_audit['date_created'];
		}
		
		else{
			$bef_date_status = gmdate ("Y-m-d H:i:s", time() );
		}
		
		$now1 = gmdate ("Y-m-d H:i:s", time() ); // or your date as well converted into GMT.
			
		$after_date_status = strtotime($now1); //strtotime($row_audit_after['date_created']);
		$before_date_status = strtotime($bef_date_status);
		$datediff_age = $after_date_status - $before_date_status;
		
		$status_age_now = floor($datediff_age/(60*60*24));
		return ($status_age_now);
		
	}*/
	
	/*************************** END OF CASE STATUS AGE CALCULATION*****************************/	

?>