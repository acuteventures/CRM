 <?php
/***************************************************************

Author :  Basudeba Rath
Date : 05-Dec-2011
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
	$clnt_name = $_REQUEST['client_name'];
	$caseNo = $_REQUEST['caseNo'];

	if($btn_id == 'Start Search'){
		
		$new_status = "In Progress";
		contribute($user_id,$id,$db); // Added Date :  19-Dec-2011
		
		//$status_age_now = case_Status_Age($id, $record->status, $record->date_entered);
		
	}
	else if($btn_id == 'Complete Search'){
		
		//$new_status = "Completed";
		$new_status = "To Send"; // Added Date :  19-Dec-2011.
		contribute($user_id,$id,$db);

		//$status_age_now = case_Status_Age($id, $record->status, $record->date_entered);
		
	}
	$sql_caseStatus = "SELECT id FROM `c_case_status` WHERE name ='".$new_status."' AND deleted = '0' ";
	$res_caseStatus = $db->query($sql_caseStatus);
	$row_caseStatus = $db->fetchByAssoc($res_caseStatus);
	
	$caseObj = new aCase();
	$record = $caseObj->retrieve($id);
	$record->status =  $row_caseStatus['id'];
	$record->case_status_age = 0;	// Added By Basudeba, Date : 20-Jun-2012.
	$record->modified_status = gmdate("Y-m-d H:i:s",time()); // Added By Basudeba, Date : 14-Jun-2012.

	$record->save();
	$result .= "\n Status is changed.";
	
	$sql_UserName = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$user_id."' AND deleted = '0'";
	$res_User = $db->query($sql_UserName);
	$row_User = $db->fetchByAssoc($res_User);
	
	$dateTime = date("d-m-Y H:i:s");

	$caseHistory1 = new Note();
	$caseHistory1->name = "Case History - Search Patent";
	$caseHistory1->parent_type = "Cases";
	$caseHistory1->parent_id = $id;
	$caseHistory1->assigned_user_id = $user_id;
	
	$caseHistory1->set_created_by = false;
	$caseHistory1->update_modified_by = false;
	
	$caseHistory1->modified_user_id = $user_id;
	$caseHistory1->created_by = $user_id;
	if($btn_id == 'Start Search'){
		$caseHistory1->description = $row_User['first_name']. " ". $row_User['last_name'] ." started the search. ";
	}
	else if($btn_id == 'Complete Search'){
	
		$caseHistory1->description = $row_User['first_name']. " ". $row_User['last_name'] ." completed the search. ";
	}
	$caseHistory1->save();
	$result .= "\n New Case is Registered.";
	
	$caseHistory1->set_created_by = true;
	$caseHistory1->update_modified_by = true;
		
	if($btn_id == 'Complete Search'){
		
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
		
		$message = "case has been completed.";
		$message .= "<br />Case No : " . $caseNo . "<br />Client Name : ".$clnt_name;
		$mail->Subject = "Case Status"; 
		$mail->Body = '<html><body>'.$message.'<br /></body></html>'; 
		$mail->prepForOutbound();
		
		if($hasRecipients){
			$success = @$mail->Send(); 
			$result .= "\n An Email is sent to assigned to user of client." ;
		}
 	}
	
	function contribute($user_id,$id,$db){
	
		$sql_cont1 = "SELECT * from `c_contribute` WHERE login_id = '".$user_id."' AND case_id = '".$id."' AND deleted = '0' ";		
		$res_cont1 = $db->query($sql_cont1);
		$row_cont1 = $db->fetchByAssoc($res_cont1);
		
		if(!(($row_cont1['login_id'] == $user_id) && ($row_cont1['case_id'] == $id))){

			$cont_search1 = new c_contribute();
			$cont_search1->name = "Contribute Search";
			$cont_search1->login_id = $user_id;
			$cont_search1->assigned_user_id = $user_id;
			
			$cont_search1->set_created_by = false;
			$cont_search1->update_modified_by = false;
			
			$cont_search1->created_by = $user_id;
			$cont_search1->modified_user_id = $user_id;
			$cont_search1->case_id = $id;
			$cont_search1->save();
			
			$cont_search1->set_created_by = true;
			$cont_search1->update_modified_by = true;
		}
	}
	
	
/**************************** CASE STATUS AGE ******************************************/
			
	/* function case_Status_Age($id,$record_status, $record_date_entered){
		
		global $db;
		$cs_obj = new c_case_status();
		$rec_cs_obj = $cs_obj->retrieve($record->status);
	
		$sql_status_audit_before = "SELECT * FROM cases_audit WHERE parent_id = '".$id."' 
							 AND after_value_string = '".$record_status."' ORDER BY  `date_created` DESC ";
										  
		$res_status_audit = $db->query($sql_status_audit_before);
		if($row_audit = $db->fetchByAssoc($res_status_audit)){
		
			$bef_date_status = $row_audit['date_created'];
		}
		else {
			//$bef_date_status = $record_date_entered;
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