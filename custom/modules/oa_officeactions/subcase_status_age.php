<?php
//by swapna 15-03-2011
class SubcaseStatusAge
{
	function subcasestatusAge_before(&$bean, $event, $arguments){
	
		if($_REQUEST['flag_hook']!=1){
			$GLOBALS['cs_status_before_save'] = $bean->fetched_row['subcase_status_id'];
		}
	}

	function subcasestatusAge(&$bean, $event, $arguments)
	{
		global $current_user,$db;
		$bef_date = "";
		$after_date = "";
		//echo $bean->date_entered."asdfsadf";
		
		if(isset($bean->id) && ($_REQUEST['flag_hook']!=1)){
						
			if($bean->subcase_status_id != $GLOBALS['cs_status_before_save'] ){
				
				//$st_obj = new c_case_status();
				//$rec_status = $st_obj->retrieve($GLOBALS['cs_status_before_save']);
				
				/*$sql_subcase_audit_before = "SELECT * FROM oa_officeactions_audit WHERE parent_id = '".$bean->id."' 
							 AND after_value_string = '".$GLOBALS['cs_status_before_save']."' ORDER BY  `date_created` DESC ";
											  
				$res_subcase_audit = $db->query($sql_subcase_audit_before);
				if($row_audit = $db->fetchByAssoc($res_subcase_audit)){
				
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
					 $bef_date = gmdate ("Y-m-d H:i:s", time() );
				}*/

				/*$sql_case_audit_after = "SELECT * FROM cases_audit WHERE parent_id = '".$bean->id."' 
										 AND before_value_string = '".$GLOBALS['cs_status_before_save']."'";
										 
				/*$res_case_audit_after = $db->query($sql_case_audit_after);
				$row_audit_after = $db->fetchByAssoc($res_case_audit_after);*/
				
				/*$now = gmdate ("Y-m-d", time() );//time(); // or your date as well
				//echo $row_audit_after['date_created'];
				
				//echo $bef_date;
				$bef_date1 = explode(" ",$bef_date);
									
				$after_date = strtotime($now); //strtotime($row_audit_after['date_created']);
				$before_date = strtotime($bef_date1[0]);
				
				$datediff = $after_date - $before_date;
				$subcase_status_age = floor($datediff/(60*60*24));//die;
				
				//$st_obj1 = new c_case_status();
				//$rec_status1 = $st_obj1->retrieve($bean->status);
				
				/*if($rec_status1->name == "Abandoned"){
					$status_age = "";
				}
				
				else if($rec_status1->name == "Completed"){
					$status_age = "";
				}
				*/
				$mod_date = gmdate("Y-m-d H:i:s",time()); // Added By Basudeba, Date : 22-Jun-2012.
				$subcase_status_age=0;
				$sql_subcase_status_age = " UPDATE oa_officeactions SET subcase_status_age = '".$subcase_status_age."', `modified_status` = '".$mod_date."' WHERE id = '".$bean->id."'";
				$db->query($sql_subcase_status_age);
				
				// * by preethi on 24-08-2012 des: updating case status age in c_s_d_case_subcase_dashlet table
				$sql_case_status_age_new = " UPDATE `c_s_d_case_subcase_dashlet` SET case_subcase_status_age = '".$subcase_status_age."' WHERE case_subcase_id = '".$bean->id."'";
				$db->query($sql_case_status_age_new);
				// * End
				//* preethi on 01-09-2012
				//* des: updating the case end user id
				if($bean->subcase_status_id == 'd7b78682-00e9-943d-ecc6-4ed9c63407f5'){
					
					$update_case_end_user_id = "UPDATE `oa_officeactions` SET case_end_user_id='".$current_user->id."' WHERE id='".$bean->id."'";
					$res_update_case_end_user_id = $db->query($update_case_end_user_id);		
				}
				//* End
			}
		}
	}
}
?>
