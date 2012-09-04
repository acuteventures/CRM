<?php

/*****************************************************************
 Author : Basudeba Rath.
 Dt. 05-Dec-2011.
 Veon Consulting Pvt. Ltd.
*****************************************************************/
    require_once('include/SugarPHPMailer.php');
	require_once('modules/Emails/Email.php');
	require_once('modules/Notes/Note.php');

	require_once('include/utils.php');
	class WorkFlows
	{
		function status(&$bean, $event, $arguments){

			global $current_user,$db;
			
			$sql_caseType = "SELECT name FROM `c_case_type` WHERE id = '".$bean->type."' AND deleted = '0'";
			$res_caseType = $db->query($sql_caseType);
			$row_caseType = $db->fetchByAssoc($res_caseType);
			
			if($_REQUEST['flag_hook']!=1 && ($bean->fetched_row['name'] != "")){  	
				
				if($bean->status != $bean->fetched_row['status']){
					
					$sql_caseStatus = "SELECT name FROM `c_case_status` WHERE id = '".$bean->fetched_row['status']."' AND deleted = '0' ";
					$res_caseStatus = $db->query($sql_caseStatus);				
					$row_caseStatus = $db->fetchByAssoc($res_caseStatus);
					
					$sql_caseStatus1 = "SELECT name FROM `c_case_status` WHERE id = '".$bean->status."' AND deleted = '0' ";
					$res_caseStatus1 = $db->query($sql_caseStatus1);				
					$row_caseStatus1 = $db->fetchByAssoc($res_caseStatus1);
									
					$sql_UserName   = "SELECT `first_name`,`last_name` FROM `users` WHERE id = '".$current_user->id."' AND deleted = '0'";
					$res_User = $db->query($sql_UserName);
					$row_User = $db->fetchByAssoc($res_User);
									
					$caseHistory = new Note();
					if($row_caseType['name'] == 'Search - Patent'){
						$caseHistory->name = "Case History - Patent Search";
					}
					else if($row_caseType['name'] == 'Provisional Patent'){
						$caseHistory->name = "Case History - Provisional Patent";
					}
					$caseHistory->parent_type = "Case";
					$caseHistory->parent_id = $bean->id;
					$caseHistory->assigned_user_id = $current_user->id;
					if($row_caseStatus['name'] == ""){
						
						$caseHistory->description= $row_User['first_name']. " ". $row_User['last_name'] ." set the status of the Case ". $row_caseStatus1['name'] ;
					}
					else{
						$caseHistory->description= $row_User['first_name']. " ". $row_User['last_name'] ." changed the status of the Case from " .$row_caseStatus['name']." to ". $row_caseStatus1['name'] ;
					}
					$caseHistory->save();
					
				}
			}
		}
		
		// Date : 13-Dec-2011
		
		function contributeUser(&$bean, $event, $arguments){
			
			global $current_user,$db;
			$cont_records = array();
			
			if($_REQUEST['flag_hook']!=1 && $bean->fetched_row['name'] != ""){ // && (($bean->status == $bean->fetched_row['status']) || ($bean->fetched_row['status']==""))){

			
				$no_item = $_REQUEST["item_count"];
				
							
				$sql_cont_rec = "SELECT id,login_id FROM `c_contribute` WHERE `case_id` = '".$bean->id."' AND deleted = '0'";
				$res_rec = $db->query($sql_cont_rec);
				while($row_rec = $db->fetchByAssoc($res_rec)){
								
					$delFlag = 0;
					for($j=1;$j<=$no_item;$j++)
					{	
						if($row_rec['id'] == $_REQUEST['cont_id'.$j]){
							
							$delFlag = 1;
						}
					}
					if($delFlag == 0){
					
						$cont_del = new c_contribute();
						$cont_del->mark_deleted($row_rec['id']);
						
						$names_user = new User();
						$record_user = $names_user->retrieve($row_rec['login_id']);
						
						$ca_hist = new Note();
						$ca_hist->name = "Remove Employee";
						$ca_hist->parent_id = $bean->id;
						$ca_hist->description = "Employee ".$record_user->first_name." ".$record_user->last_name." is removed by ".$current_user->name;
						$ca_hist->save();
					}
				}
					
				
				for($i=1; $i<=$no_item; $i++)
				{
					
					if(isset($_REQUEST['cont_id'.$i])){
						
						$cont_obj_update = new c_contribute();
						$cont_obj_update->id = $_REQUEST['cont_id'.$i];
						$cont_obj_update->login_id = $_REQUEST['login_id'.$i];
						$cont_obj_update->save(true);
					}
					
					else{	
						
						$cont_obj = new c_contribute();
						$cont_obj->name = "Contributed by Manager";
						$cont_obj->assigned_user_id = $current_user->id;
						$cont_obj->login_id = $_REQUEST['login_id'.$i];
						$cont_obj->case_id = $bean->id;
						$cont_obj->save();
						
						$names_user = new User();
						$record_user = $names_user->retrieve($_REQUEST['login_id'.$i]);
						
						$ca_hist = new Note();
						$ca_hist->name = "Added Employee";
						$ca_hist->parent_id = $bean->id;
						$ca_hist->description = "Employee ".$record_user->first_name." ".$record_user->last_name." is added by ".$current_user->name;
						$ca_hist->save();
						
						$sql_email_addr = "SELECT ea.`email_address`,eb.`email_address_id` FROM `email_addresses` ea,`email_addr_bean_rel` eb WHERE eb.bean_id = '".$_REQUEST['login_id'.$i]."' AND ea.id = eb.email_address_id AND ea.deleted = '0' AND eb.deleted = '0'";
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
						
						$message = "You have been assigned to ".$bean->name." by ".$current_user->first_name." ".$current_user->last_name;
						$message .= "<br />Case No : " . $bean->case_number;
						$mail->Subject = "Contribute"; 
						$mail->Body = '<html><body>'.$message.'<br /></body></html>'; 
						$mail->prepForOutbound();
						
						if($hasRecipients){
							$success = @$mail->Send(); 
						}
					}
					
				}
			}
		}
	
	// Date : 05-Jan-2012.
	// CREDIT ALLOCATE TO USER.
	
	function creditAllocation(&$bean, $event, $arguments){
		global $db;
		
	  if(isset($bean->id)){
		
		$cnt = $_REQUEST['cnt_value'];
		if($cnt != 0){
			for($i=0; $i<$cnt; $i++){
				
				$cont_obj_update = new c_contribute();
				$cont_obj_update->id = $_REQUEST['cid_'.$i];
				$cont_obj_update->credits = $_REQUEST['credits_'.$i];
				$cont_obj_update->save(true);
			}
			
		}
		$statusObj = new c_case_status();
		$status_record = $statusObj->retrieve($bean->status);
                // Date : 02-Feb-2012.
                        /*
                        * Rajesh G - 07/05/12
                        */
		if($status_record->order_no == 100 && empty($_REQUEST['credit_date'])){
                        $creditDate = date("Y-m-d");
		}
                else if($status_record->order_no == 100 && !empty($_REQUEST['credit_date']))
                {
                    $creditDate = date("Y-m-d", strtotime($_REQUEST['credit_date']));
                }
                else if(!empty($_REQUEST['credit_date']))
                {
                    $creditDate = date("Y-m-d", strtotime($_REQUEST['credit_date']));
                }
                else if (empty($_REQUEST['credit_date']))
                {
                    $creditDate = "";
                }
                $sql_case = "UPDATE cases SET credit_date = '".$creditDate."' WHERE id = '".$bean->id."'";
                $db->query($sql_case);
	   }
	}

/************************** EVALUATE STATUS AGE, Date :01-Feb-2012. **********************************/ 
	
	function statusAge_before(&$bean, $event, $arguments){
	
		if($_REQUEST['flag_hook']!=1){
			$GLOBALS['cs_status_before_save'] = $bean->fetched_row['status'];
		}
	}
	function statusAge(&$bean, $event, $arguments){
	
		global $current_user,$db;
		$bef_date = "";
		$after_date = "";
		//echo $bean->date_entered."asdfsadf";
		
		if(isset($bean->id) && ($_REQUEST['flag_hook']!=1)){
						
			if($bean->status != $GLOBALS['cs_status_before_save'] ){
				
				/*$st_obj = new c_case_status();
				$rec_status = $st_obj->retrieve($GLOBALS['cs_status_before_save']);
				
				$sql_case_audit_before = "SELECT * FROM cases_audit WHERE parent_id = '".$bean->id."' 
							 AND after_value_string = '".$GLOBALS['cs_status_before_save']."' ORDER BY  `date_created` DESC ";
											  
				$res_case_audit = $db->query($sql_case_audit_before);
				if($row_audit = $db->fetchByAssoc($res_case_audit)){
				
				    $bef_date = $row_audit['date_created'];
				}
				else{
					 //$bef_date = $bean->fetched_row['date_entered'];
					$bef_date = gmdate ("Y-m-d", time() );
				}*/
				/*if($rec_status->name == "Not Started"){
					 $bef_date = $bean->fetched_row['date_entered'];
				}*/
				/*if($bef_date == ""){
					 $bef_date = gmdate ("Y-m-d", time() );
				}*/

				/*$sql_case_audit_after = "SELECT * FROM cases_audit WHERE parent_id = '".$bean->id."' 
										 AND before_value_string = '".$GLOBALS['cs_status_before_save']."'";
										 
				$res_case_audit_after = $db->query($sql_case_audit_after);
				$row_audit_after = $db->fetchByAssoc($res_case_audit_after);*/
				
				/*$now = gmdate ("Y-m-d", time() );//time(); // or your date as well
				//echo $row_audit_after['date_created'];
				
				//echo $bef_date;
				$bef_date1 = explode(" ",$bef_date);
									
				$after_date = strtotime($now); //strtotime($row_audit_after['date_created']);
				//echo "<br>";
				$before_date = strtotime($bef_date1[0]);
				//die;	
				$datediff = $after_date - $before_date;
				$status_age = floor($datediff/(60*60*24));//die;
				
				$st_obj1 = new c_case_status();
				$rec_status1 = $st_obj1->retrieve($bean->status);*/
				
				/*if($rec_status1->name == "Abandoned"){
					$status_age = "";
				}
				
				else if($rec_status1->name == "Completed"){
					$status_age = "";
				}
				*/
				
				
				$mod_date = gmdate("Y-m-d H:i:s",time()); // Added By Basudeba, Date : 14-Jun-2012.

				$status_age=0;
				$sql_case_status_age = " UPDATE cases SET case_status_age = '".$status_age."', `modified_status` = '".$mod_date."' WHERE id = '".$bean->id."'";
				$db->query($sql_case_status_age);
				
				// * by preethi on 24-08-2012 des: updating case status age in c_s_d_case_subcase_dashlet table
				$sql_case_status_age_new = " UPDATE `c_s_d_case_subcase_dashlet` SET case_subcase_status_age = '".$status_age."' WHERE case_subcase_id = '".$bean->id."'";
				$db->query($sql_case_status_age_new);
				// * End
				
				//* preethi on 31-08-2012
				//* des: updating the case end user id
				if($bean->status == 'd7b78682-00e9-943d-ecc6-4ed9c63407f5'){
					
					$update_case_end_user_id = "UPDATE `cases` SET case_end_user_id='".$current_user->id."' WHERE id='".$bean->id."'";
					$res_update_case_end_user_id = $db->query($update_case_end_user_id);		
				}
				//* End
			}
		}
	}
/*************************************** END CODE OF STATUS AGE ******************************************************/

/************************** SAVE DEFAULT CONSULTANT TO CONTRIBUTION, Date :08-May-2012. ******************************/ 	
	function setConsultantToClaim(&$bean, $event, $arguments){
		
		global $db;	
		
		if($_REQUEST['flag_hook']!=1 && ($bean->client_consultant_id != "")){
			
			$sql_cont_rec1 = "SELECT id,login_id FROM `c_contribute` WHERE `case_id` = '".$bean->id."' AND login_id = '".$bean->client_consultant_id."' AND deleted = '0'";
			$res_rec1 = $db->query($sql_cont_rec1);
			if(!($row_rec1 = $db->fetchByAssoc($res_rec1))){
			
				$cont_user_obj = new c_contribute();
				$cont_user_obj->name = "Consultant Default User";
				$cont_user_obj->login_id = $bean->client_consultant_id;
				$cont_user_obj->case_id = $bean->id;
				$cont_user_obj->save();
			}
			
		}
	}
	
    //********************************************** set priority date *********************************************************//
	function setPriorityDate(&$bean, $event, $arguments){
       
	  global $db;	
	  $casetype=$bean->type_name;
	  $p_date = "";
	  
	  if($casetype=="Utility Patent" || $casetype=="International Patent"){
	     	$sql_claim_priority = "SELECT min(filing_date) as mindate  FROM cp_claimpriority WHERE acase_id_c = '".$bean->id."' AND deleted = '0'";
		   $res_claim_priority = $db->query($sql_claim_priority);
		   $row_sql_claim_priority = $db->fetchByAssoc($res_claim_priority);
		   // echo $row_sql_claim_priority['mindate'];//die;
		   
		   $sql_clm_pr_np = "SELECT min(filing_date) as mindate  FROM cp_claim_no_possession WHERE acase_id_c = '".$bean->id."' AND deleted = '0'";
		   $res_clm_pr_np = $db->query($sql_clm_pr_np);
		   $row_clm_pr_np = $db->fetchByAssoc($res_clm_pr_np);
		   //echo $row_clm_pr_np['mindate'];
		   
		   // * preethi Des: priority date was not getting added so changed the logic
		   // previous logic works only when both the priority and nonpriotiry dates are there
		   if($row_sql_claim_priority['mindate'] != "" && $row_clm_pr_np['mindate'] != ""){
		   
			   if($row_sql_claim_priority['mindate'] < $row_clm_pr_np['mindate']){
					$p_date = $row_sql_claim_priority['mindate'];
			   }
			   else{
					$p_date = $row_clm_pr_np['mindate'];
			   }
		   }else if($row_sql_claim_priority['mindate'] != "" || $row_clm_pr_np['mindate'] != ""){
		   
			   if($row_sql_claim_priority['mindate'] != ""){
					$p_date = $row_sql_claim_priority['mindate'];
			   }
			   else if($row_clm_pr_np['mindate'] != ""){
					$p_date = $row_clm_pr_np['mindate'];
			   }
		   }
		   //* End
		   $updatePriority="UPDATE cases SET prioritydate='".$p_date."' WHERE id='".$bean->id."'";
		   $res_updatePriority = $db->query($updatePriority);
		   // * preethi on 24-08-2012 des: updating priority date in the c_s_d_case_subcase_dashlet table
		   $updatePriority_for_new="UPDATE c_s_d_case_subcase_dashlet SET prioritydate='".$p_date."' WHERE case_subcase_id='".$bean->id."'";
		   $res_updatePriority_for_new = $db->query($updatePriority_for_new);
		   // * End
		}		   
     }
    //********************************************** End set priority date ***************************************************//
    //********************************************** change priority date ******************************************************//
	//* preethi on 23-08-2012
	function changePriorityDate(&$bean, $event, $arguments){
       
		global $db;
		
		$cp_sql = "SELECT * FROM `cp_claimpriority` WHERE claimed_case_id='".$bean->id."' AND deleted = '0'";
		$cp_res = $db->query($cp_sql);
		$cp_row = $db->getRowCount($cp_res);
		// updating filing date in cp_claimpriority table
		if($cp_row >=1){
			$cp_update_sql = "UPDATE cp_claimpriority SET filing_date='".$bean->filing_date."' WHERE claimed_case_id='".$bean->id."'";
			$res_cp_update_sql = $db->query($cp_update_sql);
			
			// * updating priority date in cases table
			$get_case_ids = "SELECT acase_id_c FROM `cp_claimpriority` WHERE claimed_case_id='".$bean->id."' AND deleted = '0'";
			$get_case_ids_res = $db->query($get_case_ids);
			while($get_case_ids_row = $db->fetchByAssoc($get_case_ids_res)){
				//echo $get_case_ids_row['acase_id_c'];
				//echo "<br/>";
				
				$sql_claim_priority = "SELECT min(filing_date) as mindate  FROM cp_claimpriority WHERE acase_id_c = '".$get_case_ids_row['acase_id_c']."' AND deleted = '0'";
			   $res_claim_priority = $db->query($sql_claim_priority);
			   $row_sql_claim_priority = $db->fetchByAssoc($res_claim_priority);
			   
			   $sql_clm_pr_np = "SELECT min(filing_date) as mindate  FROM cp_claim_no_possession WHERE acase_id_c = '".$get_case_ids_row['acase_id_c']."' AND deleted = '0'";
			   $res_clm_pr_np = $db->query($sql_clm_pr_np);
			   $row_clm_pr_np = $db->fetchByAssoc($res_clm_pr_np);
			   
			   if($row_sql_claim_priority['mindate'] != "" && $row_clm_pr_np['mindate'] != ""){
			   
				   if($row_sql_claim_priority['mindate'] < $row_clm_pr_np['mindate']){
						$p_date = $row_sql_claim_priority['mindate'];
				   }
				   else{
						$p_date = $row_clm_pr_np['mindate'];
				   }
			   }else if($row_sql_claim_priority['mindate'] != "" || $row_clm_pr_np['mindate'] != ""){
			   
				   if($row_sql_claim_priority['mindate'] != ""){
						$p_date = $row_sql_claim_priority['mindate'];
				   }
				   else if($row_clm_pr_np['mindate'] != ""){
						$p_date = $row_clm_pr_np['mindate'];
				   }
			   }
			   $updatePriority="UPDATE cases SET prioritydate='".$p_date."' WHERE id='".$get_case_ids_row['acase_id_c']."'";
			   $res_updatePriority = $db->query($updatePriority);
			   // * preethi on 24-08-2012 des: updating priority date in the c_s_d_case_subcase_dashlet table
			   $updatePriority_for_new="UPDATE c_s_d_case_subcase_dashlet SET prioritydate='".$p_date."' WHERE case_subcase_id='".$get_case_ids_row['acase_id_c']."'";
			   $res_updatePriority_for_new = $db->query($updatePriority_for_new);
			   // * End
			}
			// * End of while
		} // * End of if
     } // * End of function
    //********************************************** End change priority date ***************************************************//
// Author : Basudeba Rath.
// Date : 22-Jun-2012

	function setFrecipt(&$bean, $event, $arguments){
		
		global $db;
		
		if($_REQUEST['freceipt'] == ""){
			$updateFreceipt="UPDATE cases SET freceipt='0' WHERE id='".$bean->id."'";
			$res_updateFreceipt = $db->query($updateFreceipt);
		}
	}
	// * preethi on 27-08-2012
	// des : for deleting the previous relation of case with trademark
	function deleteRelation(&$bean, $event, $arguments){
	
		global $db;
		
		/*echo $bean->id;
		echo "<br/>";
		echo $bean->fetched_row['relatedtoparent'];
		echo "<br/>";
		echo $bean->rel_fields_before_value['trade_trademark_casestrade_trademark_ida'];
		echo "<br/>";
		echo $bean->trade_trademark_casestrade_trademark_ida;
		echo "<br/>";
		echo "<pre>";
		//print_r($bean);
		exit;*/
		if($bean->fetched_row['relatedtoparent'] == 'Trademark' && $bean->rel_fields_before_value['trade_trademark_casestrade_trademark_ida'] != $bean->trade_trademark_casestrade_trademark_ida){
			$delete_sql = "DELETE FROM `trade_trademark_cases_c` WHERE trade_trademark_casestrade_trademark_ida='".$bean->rel_fields_before_value['trade_trademark_casestrade_trademark_ida']."' AND trade_trademark_casescases_idb = '".$bean->id."'";
			$res_delete_sql = $db->query($delete_sql);
		}
	}
	// * End	
}

?>