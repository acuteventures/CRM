<?php

/***************************************************************

Author :  Basudeba Rath
Date : 27-Jan-2012.
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
	$tm_fdate = $_REQUEST['tm_fdate'];
	$tm_app_no = $_REQUEST['tm_app_no'];
	$reg_date = $_REQUEST['tm_reg_date'];
	$reg_no = $_REQUEST['tm_reg_no'];
	$tm_classes = $_REQUEST['str'];
	//$freceipt = $_REQUEST['freceipt'];
	$result = "";
	$sql_cs_status = "SELECT id FROM  `c_case_status` WHERE name = 'Filed' AND deleted = '0' ";
	$res_cs_status = $db->query($sql_cs_status);
	$row_cs_status = $db->fetchByAssoc($res_cs_status);
	$cs_obj = new aCase();
	$rec_cs = $cs_obj->retrieve($id);
	//$cs_obj->id = $id; 
	
	//$status_age = case_Status_Age($id,$rec_cs->status, $rec_cs->date_entered); // Finding Case Status age. Dt : 15-Mar-2012.
	$rec_cs->case_status_age = 0;

	$rec_cs->status = $row_cs_status['id'];
	$rec_cs->tm_filing_date = $tm_fdate;
	$rec_cs->tm_application_number = $tm_app_no;
	$rec_cs->tm_registration_date = $reg_date;
 	$rec_cs->tm_registration_number = $reg_no;
	$rec_cs->tm_classes = $tm_classes;
	$rec_cs->save(true);
	echo "success.";
	
// Basudeba Rath ,Date : 15-Mar-2012.
	
/**************************** CASE STATUS AGE ******************************************/
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

	
?>