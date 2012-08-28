<?php

/*****************************************************************
 Author : Basudeba Rath.
 Dt. 10-May-2012.
 Veon Consulting Pvt. Ltd.
*****************************************************************/

	class SubCaseLogic
	{ 
		function contConsultant(&$bean, $event, $arguments){
			global $current_user,$db; 
			
			/**
			----------------------------------------------------
			Save parent client's consultant i.e assigned_user_id
			----------------------------------------------------
			*/
			//
						
			if($_REQUEST['parent_consultant'] != ""){
				$parent_consultant = $_REQUEST['parent_consultant'];
			}
			else{
				$case_obj = new aCase();
				$rec_case = $case_obj->retrieve($bean->oa_officeactions_casescases_ida);
				$parent_consultant = $rec_case->client_consultant_id;
			}
			
			
			$sql_cont_rec1 = "SELECT id,login_id FROM `c_contribute` WHERE `case_id` = '".$bean->id."' AND login_id = '".$parent_consultant."' AND deleted = '0'"; // Checking whether already consultant is contributed for subcase.
			$res_rec1 = $db->query($sql_cont_rec1);
			if(!($row_rec1 = $db->fetchByAssoc($res_rec1))){	
				
				$cont_obj = new c_contribute();
				$cont_obj->name = "Parent Consultant in Subcase";
				$cont_obj->login_id = $parent_consultant;
				$cont_obj->case_id = $bean->id;
				$cont_obj->save();
			}	     
	   } //end fn
	    //by anuradha 23/8/2012
	   function creditAllocation(&$bean, $event, $arguments){
		global $db;
			if(isset($bean->id))
			{	
				$cnt = $_REQUEST['cnt_value'];
				if($cnt != 0)
				{
					for($i=0; $i<$cnt; $i++){					
						$cont_obj_update = new c_contribute();
						$cont_obj_update->id = $_REQUEST['cid_'.$i];
						$cont_obj_update->credits = $_REQUEST['credits_'.$i];
						$cont_obj_update->save(true);
					}				
				}
		   }
	   }
	   //end
   }