<?php
/***************************************************************
Author :  ANURADHA
Date : 08-Dec-2011
Veon Consulting Pvt. Ltd.
***************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	require_once('include/SugarPHPMailer.php');
	require_once('modules/Emails/Email.php');
	require_once('modules/Notes/Note.php');
	require_once('include/utils.php');

	global $db;
	
	$id = $_REQUEST['id'];
	$user_id = $_REQUEST['user_id'];
	$btn_id  = $_REQUEST['btn_id'];
	$fdate = $_REQUEST['fdate'];
	$x = explode("/",$fdate);
	$db_fdate = $x[2].'-'.$x[0].'-'.$x[1];
	//$app_no = $_REQUEST['app_no'];
	//$freceipt = $_REQUEST['freceipt'];
	
	$result = "";		
	
	//Change case status from ‘To Filed’ to ‘Filed’
	/**
	-------------------------------------------------
	* get the Filed status id based on the order no
	-------------------------------------------------
	*/
	$getStatusQuery="SELECT * FROM c_case_status WHERE order_no='70' AND deleted=0 ";
	$getStatusQuery_res = $db->query($getStatusQuery);
	$status_row = $db->fetchByAssoc($getStatusQuery_res); 
		
	 $oa_obj = new oa_officeactions();
	 $oa_obj = $oa_obj->retrieve($id);	
	
//	$oa_obj->filing_date = $fdate; 
//	$oa_obj->application_number = $app_no;
//	$oa_obj->freceipt = $freceipt;	
	
	// Author: Swapna , Date :16-Mar-2012.
	//$status_age_now = subcase_Status_Age($id, $oa_obj->subcase_status_id);
	$status_age_now=0;
	
	$query="UPDATE oa_officeactions SET subcase_status_id='".$status_row['id']."',filing_date='".$db_fdate."',application_number='".$app_no."' ,subcase_status_age='".$status_age_now."' WHERE id='$id' AND deleted=0 ";
      $res = $db->query($query);
	
		// subcase status audit table
	// Author: Swapna , Date :16-Mar-2012.
	$sub_audit_id = create_guid();
	$curr_dtTime = gmdate ("Y-m-d H:i:s", time());

	$query_sub_audit = "INSERT INTO oa_officeactions_audit(id,parent_id,date_created,created_by,field_name,data_type,before_value_string,after_value_string) values ('".$sub_audit_id."', '".$id."','".$curr_dtTime."','1','subcase_status_id','id','".$oa_obj->subcase_status_id."','".$status_row['id']."')";
	$db->query($query_sub_audit);

	
	$result .= "\n Status is changed.";
	
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
		
		$message = "";	
		
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
		
		$message = "Hi ".$get_assigned_row['last_name']."<br /> sub case status has been changed to <b>Filed.</b>";
		$message .= "<br />Sub Case Number: " . $oa_obj->name . "<br />Client Name : ".$case_obj->account_name;
		
		$message .= "<br />Application has been filed.";		
		
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