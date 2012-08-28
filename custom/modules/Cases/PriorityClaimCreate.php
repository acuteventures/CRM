<?php

	if(!defined('sugarEntry'))define('sugarEntry', true);
 	require_once('include/entryPoint.php');
	require_once('include/utils.php');
	
class PriorityClaimCreate{

	function claimCase(&$bean, $event, $arguments){
		
		$edit_flag = $_REQUEST['clm_edit'];
		
		if($edit_flag == 0 ){
			
			$clm_id_arr= array();
		    $clm_id_arr = (explode(" ", $_REQUEST['clm_ids']));
		
			for($i=0; $i<sizeof($clm_id_arr);$i++){
			
				if($clm_id_arr[$i] != ""){
					$clm_obj1 = new cp_claimpriority();
					$rec_clm_obj1 = $clm_obj1->retrieve($clm_id_arr[$i]);
					
					$clm_obj1->id = $clm_id_arr[$i];
					$clm_obj1->acase_id_c = $bean->id;
					$clm_obj1->save(true);
				}				
			}
		}
	}
// claim with no possesion. Dt . 09-Mar-2012.
		function claimCaseNP(&$bean, $event, $arguments){
		
		$edit_flag1 = $_REQUEST['clm_edit'];
		
		if($edit_flag1 == 0 ){
			
			$clm_id_arr1= array();
		    $clm_id_arr1 = (explode(" ", $_REQUEST['clm_np_ids']));
		
			for($i=0; $i<sizeof($clm_id_arr1);$i++){
			
				if($clm_id_arr1[$i] != ""){
					$clm_obj_np = new cp_claim_no_possession();
					$rec_clm_obj_np = $clm_obj_np->retrieve($clm_id_arr1[$i]);
					
					$rec_clm_obj_np->id = $clm_id_arr1[$i];
					$rec_clm_obj_np->acase_id_c = $bean->id;
					$rec_clm_obj_np->save(true);
				}				
			}
		}
	}
}

?>