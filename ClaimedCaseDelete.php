<?php
/****************************************************************************

Author : Basudeba Rath
Dt . 07-Feb-2012.
Veon Consulting Pvt. Ltd.

****************************************************************************/

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	
	global $db;
	
	$clm_case_id = $_REQUEST['clm_case_id'];
	$clm_flag = $_REQUEST['clm_flag'];
	if($clm_flag == 1){
	
		$poss_obj = new cp_claimpriority();
		$poss_obj->mark_deleted($clm_case_id);
		// * preethi on 23-08-2012
		// * updating priority date in cases table
		$get_case_ids = "SELECT acase_id_c FROM `cp_claimpriority` WHERE id='".$clm_case_id."'";
		$get_case_ids_res = $db->query($get_case_ids);
		$get_case_ids_row = $db->fetchByAssoc($get_case_ids_res);
			
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
		   // * preethi on 24-08-2012 Des : updating priority date in the c_s_d_case_subcase_dashlet table
		   $updatePriority_for_new="UPDATE c_s_d_case_subcase_dashlet SET prioritydate='".$p_date."' WHERE case_subcase_id='".$get_case_ids_row['acase_id_c']."'";
		   $res_updatePriority_for_new = $db->query($updatePriority_for_new);
		   // * End
		   // * End of updating cases priority date
	} // * End of function
	if($clm_flag == 2){
		$no_poss_obj = new cp_claim_no_possession();
		$no_poss_obj->mark_deleted($clm_case_id);
		// * preethi on 23-08-2012
		// * updating priority date in cases table
		$get_case_ids = "SELECT acase_id_c FROM `cp_claim_no_possession` WHERE id='".$clm_case_id."'";
		$get_case_ids_res = $db->query($get_case_ids);
		$get_case_ids_row = $db->fetchByAssoc($get_case_ids_res);
			
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
		   // * preethi on 24-08-2012 Des : updating priority date in the c_s_d_case_subcase_dashlet table
		   $updatePriority_for_new="UPDATE c_s_d_case_subcase_dashlet SET prioritydate='".$p_date."' WHERE case_subcase_id='".$get_case_ids_row['acase_id_c']."'";
		   $res_updatePriority_for_new = $db->query($updatePriority_for_new);
		   // * End
		   // * End of updating cases priority date
	}
	echo "Successfully Deleted.";

/****************************************************************************/
?>