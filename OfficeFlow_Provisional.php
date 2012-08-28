<?php
/***************************************************************

Author :  PHANEENDRA
Date : 25-Dec-2011
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
	
	$fdate = $_REQUEST['fdate'];
	$app_no = $_REQUEST['app_no'];
	$freceipt = $_REQUEST['freceipt'];
	
	$result = "";
	
	
	if($btn_id == 'Complete Preparation'){
			
	    $new_status = "ToSend";
	    contribute($id, $user_id,$db);
	}
	else if($btn_id == "Application Filed"){
		
		$new_status = "Filed";
	}
	$sql_Status = "UPDATE oa_officeactions SET officeactionstatus='$new_status' WHERE id='$id' ";
	$res = $db->query($sql_Status);
	
	$oa_prov = new oa_officeactions();
	$record_prov = $oa_prov->retrieve($id);
	if($btn_id == 'Application Filed'){
	
		$record_prov->filing_date = $fdate; 
		$record_prov->application_number = $app_no;
		$record_prov->freceipt = $freceipt;
	}
	
	$record_prov->save();
	$result .= "\n Status is changed.";
	
	if($btn_id = 'Complete Preparation'){ // case log is not required for complete prepairation.
	
		$sql_UserName = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$user_id."' AND deleted = '0'";
		$res_User = $db->query($sql_UserName);
		$row_User = $db->fetchByAssoc($res_User);
		
		$dateTime = date("d-m-Y H:i:s");
	
		$caseHistory2 = new Note();
		$caseHistory2->name = "Office Action History";
		$caseHistory2->parent_type = "oa_officeactions";
		$caseHistory2->parent_id = $id;
		$caseHistory2->assigned_user_id = $user_id;
		
		$caseHistory2->set_created_by = false;
		$caseHistory2->update_modified_by = false;
		
		$caseHistory2->modified_user_id = $user_id;
		$caseHistory2->created_by = $user_id;
		
		$caseHistory2->description = $row_User['first_name']. " ". $row_User['last_name'] ." changed the office action status  from Preparing to ToSend ".$dateTime;
		
		$caseHistory2->save();
		$result .= "\n New Office Action is Registered.";
	
		$caseHistory2->set_created_by = true;
		$caseHistory2->update_modified_by = true;
	}	
	
	// mail send after complete prepairation or application filed only.
	
	 if( $btn_id == 'Complete Preparation' || $btn_id == 'Application Filed' ){	
	
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
			$message  = "The Office Action  has been prepared and completed.";
			//$message .= "<br />Case No : " . $caseNo . "<br />Client Name : ".$clnt_name;
		}
		else{
			$message = "Application has been filed.";
		}
		
		$mail->Subject = "Offcie Action Status"; 
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
			$cont_search2->name = "Contribute Office Action";
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
	echo $result;

?>