<?php
//generating subcase number
//	Sample sub-case number: TTP12001 OA1
	class subcaseNumber
	{ 
		function generateSubcasenumber(&$bean, $event, $arguments){
			global $current_user,$db; 
			
			/**
			---------------------------
			get the parent case number	
			---------------------------			
			*/
			
			$subcase_id = $bean->id;  //$bean->oa_officeactions_casesoa_officeactions_idb;		
			$sql_query_case = " SELECT * FROM oa_officeactions_cases_c WHERE oa_officeactions_casesoa_officeactions_idb = '".$subcase_id."' AND deleted=0 ";
			$result_query_case=$db->query($sql_query_case);
			$row_query_case= $db->fetchByAssoc($result_query_case);
			//echo $row_query_case['oa_officeactions_casescases_ida'];]

			/**
			------------------------------------
			get case_number of the parent case
			------------------------------------
			*/
			$a = new aCase();
			$case_obj = $a->retrieve($row_query_case['oa_officeactions_casescases_ida']);
			$parent_case_number = $case_obj->case_number;
			/**
			---------------------------------
			get the subcase type code
			---------------------------------
			*/
			$subcase_type_id = $bean->subcase_name;
			$subcase_type_obj = new sc_sc_subcasetype();
            $subcase_type_obj = $subcase_type_obj->retrieve($subcase_type_id);
            $subcase_type_code = $subcase_type_obj->subcase_type_code;
			/**
			checking whether subcase code already exists in db
			*/
			$initialSubCaseNumber = $parent_case_number.$subcase_type_code;
			//$submitted_cnt = $db->getRowCount($q_get_candidate_submitted);
			$sql_1=" SELECT max(CAST(substr(subcase_number,11)AS UNSIGNED)) AS maxnum FROM oa_officeactions WHERE subcase_number like '".$initialSubCaseNumber."%' AND deleted=0 ORDER BY max(CAST(substr(subcase_number,11)AS UNSIGNED)) DESC limit 1";
			//echo $sql_1.'<br />'; 
			
				   $result_1=$db->query($sql_1, true, 'Error MAX CODE Sub Cases');
				   while($row_1=$GLOBALS['db']->fetchByAssoc($result_1)){
					   $code[] = $row_1;
				   }	   
				   
				   $numrows = count($result_1);
				   
				   if($numrows == 0){
					   $num = 0;
					   $num = $num + 1;
					   $subCaseCodeNum = $initialSubCaseNumber.$num;		
				   }
				   else{
			  
					    $string_slice = "".$code[0]['maxnum'];
					    $abc = $string_slice+1;
					    $subCaseCodeNum = $initialSubCaseNumber.$abc;
				   }
				  //echo '<br />number='.$subCaseCodeNum.'<br />';
				  
				  
			/**
			---------------------------------------------------------------
			Appending parent casenumber with subcase type code+some integer
			---------------------------------------------------------------
			*/			
			if((!empty($_POST['subcase_number']) && ($_POST['subcase_number'] == $bean->subcase_number) && ($bean->subcaseoverride != 1) && (!empty($_POST['record'])))){
          	    $finalSubCaseNumber=$_POST['subcase_number'];
			}
			else if($bean->subcaseoverride == 1){
			//by anuradha on 22/8/2012
				$finalSubCaseNumber=$_POST['name'];
			}
			else{
				$finalSubCaseNumber=$subCaseCodeNum;		   
			
			 }
			 $update_sql_1=" UPDATE oa_officeactions SET subcase_number='".$finalSubCaseNumber."',name='".$finalSubCaseNumber."' WHERE id='".$bean->id."' AND deleted=0";
			 $update_result_1=$db->query($update_sql_1);	
		     
	   } //end fn
   }