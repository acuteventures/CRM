<?php
require_once('modules/c_s_d_case_subcase_dashlet/c_s_d_case_subcase_dashlet.php');
class saveCase {
      function insertCase(&$bean, $event, $arguments)
      {
	  		global $db;
            $sub_case_id = $bean->id;
			//QUERY FOR FETCHING THE PARENT CASE ID
			$sql_parent_case_id = "SELECT oa_officeactions_casescases_ida FROM `oa_officeactions_cases_c` WHERE oa_officeactions_casesoa_officeactions_idb='".$sub_case_id."' AND deleted=0";
			$result_parent_case_id=$db->query($sql_parent_case_id);
			$row_parent_case_id=$db->fetchByAssoc($result_parent_case_id);
			$case_id = $row_parent_case_id['oa_officeactions_casescases_ida'];
			//END
			$sql_case_subcase = "SELECT case_subcase_id FROM `c_s_d_case_subcase_dashlet` WHERE case_subcase_id='".$bean->id."' AND deleted=0";
			$res_sql_case_subcase = $db->query($sql_case_subcase);
			$count = $db->getRowCount($res_sql_case_subcase);
			
			if($count >0){
				//echo EDIT;
				$update = "UPDATE `c_s_d_case_subcase_dashlet` SET `name`='".$bean->name."', `modified_user_id`='".$bean->modified_user_id."', `created_by`='".$bean->created_by."', `assigned_user_id`='".$bean->assigned_user_id."', `sub_case_type_id`='".$bean->subcase_name."', `status`='".$bean->subcase_status_id."', `invention_id`='".$bean->oa_officeactions_cases->beans[$case_id]->fetched_row['invention_id']."', `account_id`='".$bean->oa_officeactions_cases->beans[$case_id]->fetched_row['account_id']."', `client_consultant_id`='".$bean->oa_officeactions_cases->beans[$case_id]->fetched_row['client_consultant_id']."', `due_date`='".$bean->duedate."', `freceipt`='".$bean->freceipt."', `application_number`='".$bean->application_number."', `parent_subcase_id`='".$bean->id."' WHERE case_subcase_id='".$bean->id."'";
				$update_query = $db->query($update);
			}else{
				//echo ADD;
				$sql="SELECT name FROM `oa_officeactions` WHERE id='".$bean->id."'";
				$result=$db->query($sql);
				$row=$db->fetchByAssoc($result);
				$focus = new c_s_d_case_subcase_dashlet();
				//SAVING THE CASE IN TO THE c_s_d_case_subcase_dashlet
				$focus->name 			 		= $row['name'];
				$focus->modified_user_id 		= $bean->modified_user_id;
				$focus->created_by		 		= $bean->created_by;
				$focus->assigned_user_id 		= $bean->assigned_user_id;
				$focus->case_subcase_id		 	= $bean->id;
				$focus->sub_case_type_id		= $bean->subcase_name;
				$focus->status		 			= $bean->subcase_status_id;
				$focus->invention_id			= $bean->oa_officeactions_cases->beans[$case_id]->fetched_row['invention_id'];
				$focus->account_id				= $bean->oa_officeactions_cases->beans[$case_id]->fetched_row['account_id'];
				$focus->client_consultant_id	= $bean->oa_officeactions_cases->beans[$case_id]->fetched_row['client_consultant_id'];
				$focus->case_subcase_status_age	= $bean->subcase_status_age;
				$focus->due_date				= $bean->duedate;
				$focus->freceipt		        = $bean->freceipt;  //* preethi on 29-08-2012
				$focus->application_number		= $bean->application_number;  //* preethi on 29-08-2012
				$focus->parent_subcase_id		= $bean->id;				
				$focus->save();
			}
      } 
	  // * preethi des : deleting record from c_s_d_case_subcase_dashlet table when it got delted from oa_officeactions
	  function deleteCase(&$bean, $event, $arguments){
	  		global $db;
            $sub_case_id = $bean->id;
			
			$delete = "UPDATE `c_s_d_case_subcase_dashlet` SET `deleted`='1' WHERE case_subcase_id='".$bean->id."'";
			$delete_query = $db->query($delete);
	  }
	  // * End
}
?>