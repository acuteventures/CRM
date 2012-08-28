<?php
/***************************************************************

Author :  Basudeba Rath
Date : 08-Dec-2011
Veon Consulting Pvt. Ltd.

***************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	require_once('include/SugarPHPMailer.php');
	require_once('modules/Emails/Email.php');
	require_once('modules/Notes/Note.php');
	global $db;
	
	$id = $_REQUEST['id'];
	$user_id = $_REQUEST['user_id'];
	$btn_id  = $_REQUEST['btn_id'];
	$clnt_name = $_REQUEST['client_name'];
	$caseNo = $_REQUEST['caseNo'];
	$fdate = $_REQUEST['fdate'];
	$app_no = $_REQUEST['app_no'];
	$freceipt = $_REQUEST['freceipt'];
	$case_type = $_REQUEST['case_type'];

	$pp_number = $_REQUEST['pp_number'];
	$pi_number = $_REQUEST['pi_number'];
	
	$result = "";
	
	$caseObj_prov = new aCase();
	$record_prov = $caseObj_prov->retrieve($id);
	
	if($btn_id == 'Start Preparation'){
		
		contribute($id, $user_id,$db);		
		$new_status = "In Progress";
		
		//$status_age_now = case_Status_Age($id, $record_prov->status, $record_prov->date_entered);
		$record_prov->case_status_age = 0;		
	}
	else if($btn_id == 'Complete Preparation'){
			
		contribute($id, $user_id,$db);
		$new_status = "To Send";

		//$status_age_now = case_Status_Age($id, $record_prov->status, $record_prov->date_entered);
		$record_prov->case_status_age = 0;		
	}
	else if($btn_id == "Application Filed"){
		
		$new_status = "Filed";

		//$status_age_now = case_Status_Age($id, $record_prov->status, $record_prov->date_entered);
		$record_prov->case_status_age = 0;
	}
	$sql_caseStatus = "SELECT id FROM `c_case_status` WHERE name ='".$new_status."' AND deleted = '0' ";
	$res_caseStatus = $db->query($sql_caseStatus);
	$row_caseStatus = $db->fetchByAssoc($res_caseStatus);
	if($row_caseStatus['id'] == ""){
		echo "New Status is not present in Case status.";
		exit;
	}
	
	
	$record_prov->status =  $row_caseStatus['id'];
	if($btn_id == 'Application Filed'){
	
		$record_prov->filing_date = $fdate; 
		$record_prov->application_number = $app_no;
		$record_prov->freceipt = $freceipt;
		
		$record_prov->patent_publication_number = $pp_number;
		$record_prov->patent_issued_number = $pi_number;
	}

	
        $record_prov->modified_status = gmdate("Y-m-d H:i:s",time()); // Added By Basudeba, Date : 14-Jun-2012.

	$record_prov->save();
	$result .= "\n Status is changed.";
	
	if($btn_id != 'Application Filed'){ // case log is not required for complete prepairation.
	
		//$btn_id != 'Complete Preparation' && removed from if: date: 08-May-2012. 

		$sql_UserName = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$user_id."' AND deleted = '0'";
		$res_User = $db->query($sql_UserName);
		$row_User = $db->fetchByAssoc($res_User);
		
		$dateTime = date("d-m-Y H:i:s");
	
		$caseHistory2 = new Note();
		$caseHistory2->name = "Case History - Provisional Patent";
		$caseHistory2->parent_type = "Cases";
		$caseHistory2->parent_id = $id;
		$caseHistory2->assigned_user_id = $user_id;
		
		$caseHistory2->set_created_by = false;
		$caseHistory2->update_modified_by = false;
		
		$caseHistory2->modified_user_id = $user_id;
		$caseHistory2->created_by = $user_id;
		
		if($btn_id == "Start Preparation"){
			//$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." has started preparing the provisional patent application on ".$dateTime;
			
			// commented By Basudeba on 04-May-2012.
			
			//$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." has started preparing the ".$case_type." application on ".$dateTime; // Date : 02-jan-2012
			
			$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." has started preparing the ".$case_type; // Date : 04-May-2012.
		}
		else if($btn_id == "Complete Preparation"){ // date : 08-May-2012. By Basudeba Rath
			$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." changed the status of the Case from In Progress to To Send";
			
		}
		$caseHistory2->save();
		$result .= "\n New Case is Registered.";
	
		$caseHistory2->set_created_by = true;
		$caseHistory2->update_modified_by = true;
	}	
	
	// mail send after complete prepairation or application filed only.
	
	else if( $btn_id == 'Complete Preparation' || $btn_id == 'Application Filed' ){	
	
		$message = "";	
		$sql_email_bean = "SELECT `email_address_id` FROM `email_addr_bean_rel` WHERE `bean_id` = '".$user_id."' AND deleted = '0'";
		$res_email_bean = $db->query($sql_email_bean);
		$row_email_bean = $db->fetchByAssoc($res_email_bean);
		
		$sql_email_addr = "SELECT `email_address` FROM `email_addresses` WHERE `id` = '".$row_email_bean['email_address_id']."' AND deleted = '0' ";
		$res_email_addr = $db->query($sql_email_addr);
		$row_email_addr = $db->fetchByAssoc($res_email_addr);
		
		$email_focus = new Email();
		$defaults = $email_focus->getSystemDefaultEmail();
	
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$mail->IsHTML(true);
		$mail->From = $defaults['email'];
		$mail->FromName = $defaults['name']; 
		$hasRecipients = false; 
		$mail->AddAddress($row_email_addr['email_address']);    
		$hasRecipients = true;
		
		if($btn_id == 'Complete Preparation'){
			$message  = "The case has been prepared and completed.";
			$message .= "<br />Case No : " . $caseNo . "<br />Client Name : ".$clnt_name;
		}
		else{
			$message = "Application has been filed.";
		}
		
		$mail->Subject = "Case Status"; 
		$mail->Body = '<html><body>'.$message.'<br /></body></html>'; 
		$mail->prepForOutbound();
		
		if($hasRecipients){
			$success = @$mail->Send(); 
			$result .= "\n An Email is sent to assigned to user of client." ;
		}
	}
	function contribute($id, $user_id, $db)
	{
		$sql_cont2 = "SELECT * from `c_contribute` WHERE login_id = '".$user_id."' AND case_id = '".$id."'  AND deleted = '0'";		
		$res_cont2 = $db->query($sql_cont2);
		$row_cont2 = $db->fetchByAssoc($res_cont2);
		
		if(!($row_cont2['login_id'] == $user_id && $row_cont2['case_id'] == $id)){

			$cont_search2 = new c_contribute();
			$cont_search2->name = "Contribute Case";
			$cont_search2->login_id = $user_id;
			$cont_search2->assigned_user_id = $user_id;
			
			$cont_search2->set_created_by = false;
			$cont_search2->update_modified_by = false;
			
			$cont_search2->created_by = $user_id;
			$cont_search2->modified_user_id = $user_id;
			$cont_search2->case_id = $id;
			$cont_search2->save();
			
			$cont_search2->set_created_by = true;
			$cont_search2->update_modified_by = true;
		
		}
	}

/**************************** CASE STATUS AGE ******************************************/	
// Date : 05-Mar-2012.

/*
	function case_Status_Age($id,$record_status, $record_date_entered){
		
		global $db;
		$cs_obj = new c_case_status();
		$rec_cs_obj = $cs_obj->retrieve($record->status);
	
		$sql_status_audit_before = "SELECT * FROM cases_audit WHERE parent_id = '".$id."' 
							 AND after_value_string = '".$record_status."' ORDER BY  `date_created` DESC ";
										  
		$res_status_audit = $db->query($sql_status_audit_before);
		if($row_audit = $db->fetchByAssoc($res_status_audit)){
		
			$bef_date_status = $row_audit['date_created'];
		}
		else{
			// $bef_date_status = $record_date_entered;
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
	echo $result;

?>