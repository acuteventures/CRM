<?php
require_once('modules/c_s_d_case_subcase_dashlet/c_s_d_case_subcase_dashlet.php');
class saveCase {
      function insertCase(&$bean, $event, $arguments) 
      {
	  		global $db;
            $case_id = $bean->id;
			
			$sql_case_subcase = "SELECT case_subcase_id FROM `c_s_d_case_subcase_dashlet` WHERE case_subcase_id='".$bean->id."' AND deleted=0";
			$res_sql_case_subcase = $db->query($sql_case_subcase);
			$count = $db->getRowCount($res_sql_case_subcase);
			
			if($count >0){
				//echo EDIT;
				$update = "UPDATE `c_s_d_case_subcase_dashlet` SET `name`='".$bean->name."', `modified_user_id`='".$bean->modified_user_id."', `created_by`='".$bean->created_by."', `assigned_user_id`='".$bean->assigned_user_id."', `case_type_id`='".$bean->type."', `status`='".$bean->status."', `invention_id`='".$bean->invention_id."', `account_id`='".$bean->account_id."', `client_consultant_id`='".$bean->client_consultant_id."', `due_date`='".$bean->due_date."', `parent_case_id`='".$bean->id."' WHERE case_subcase_id='".$bean->id."'";
				$update_query = $db->query($update);
			}else{
				//echo ADD;
				$sql="SELECT name,id FROM `cases` WHERE id='".$bean->id."' AND deleted=0";
				$result=$db->query($sql);
				$row=$db->fetchByAssoc($result); 
				$focus = new c_s_d_case_subcase_dashlet();
				//SAVING THE CASE IN TO THE c_s_d_case_subcase_dashlet
				$focus->name 			 		= $row['name'];
				$focus->modified_user_id 		= $bean->modified_user_id;
				$focus->created_by		 		= $bean->created_by;
				$focus->assigned_user_id 		= $bean->assigned_user_id;
				$focus->case_subcase_id		 	= $bean->id;
				$focus->case_type_id			= $bean->type;
				$focus->status		 			= $bean->status;
				$focus->invention_id			= $bean->invention_id;  
				$focus->account_id				= $bean->account_id;
				$focus->client_consultant_id	= $bean->client_consultant_id;
				$focus->case_subcase_status_age	= $bean->case_status_age;
				$focus->due_date				= $bean->due_date;
				$focus->parent_case_id		    = $bean->id;
				$focus->save();
			}
      } 
	  // * preethi des : deleting record from c_s_d_case_subcase_dashlet table when it got delted from cases
	  function deleteCase(&$bean, $event, $arguments){
	  		global $db;
            $case_id = $bean->id;
			
			$delete = "UPDATE `c_s_d_case_subcase_dashlet` SET `deleted`='1' WHERE case_subcase_id='".$bean->id."'";
			$delete_query = $db->query($delete);
	  }
	  // * End
}
?>