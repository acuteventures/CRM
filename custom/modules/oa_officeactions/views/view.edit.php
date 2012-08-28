<?php
/*
*******************************************
Author: Anuradha
Organization: Veon Consulting Pvt. Ltd.
Date: 13-01-2012
Description: 
*******************************************
*/
require_once('include/MVC/View/views/view.edit.php');

class oa_officeactionsViewEdit extends ViewEdit {

	// Author : Basudeba Rath. Date : 11-May-2012.
	public $useForSubpanel = true;

 	function oa_officeactionsViewEdit(){
 		parent::ViewEdit();
 	}

 	function display() {		
        global $current_user,$db,$app_list_strings,$mod_strings;

		// Author : Basudeba Rath. Date : 11-May-2012.
		$case_obj = new aCase();
		$rec_case = $case_obj->retrieve($_REQUEST['parent_id']);
		$this->ss->assign("PARENT_CONSULTANT", $rec_case->client_consultant_id);
	
		$js = "";
		$js .= '<script type="text/javascript">
               function subcaseDisplay()
			   {   	 			 
				 var case_name = document.getElementById("oa_officeactions_cases_name").value;
				 var case_id = document.getElementById("oa_officeactions_casescases_ida").value;
				 var selected_sub_case_id = document.getElementById("subcase_name").value;
				 //alert(case_id);
                 var callback = {
 	                 success: function(o) {					 			 
					 //alert(o.responseText);
		             document.getElementById("subcase_name").innerHTML = o.responseText;
	                }
                 }
                 var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "subcase_display.php?case_id="+case_id+"&sel_val="+selected_sub_case_id, callback); 
			   }
			   function getStatus()
			   {			     
				 var subcase_id = document.getElementById("subcase_name").value;
				 var caseStatus = document.getElementById("subcase_status_id").value;
                                 if(caseStatus == ""){
				  var status_callback = {
 	                 success: function(x) {					 
					 //alert(x.responseText);
		             document.getElementById("subcase_status_id").innerHTML = x.responseText;
	                }
                 }
                 var connectionStatusObject = YAHOO.util.Connect.asyncRequest ("GET", "subcase_status_display.php?subcase_id="+subcase_id, status_callback); 
				 }
			   }
			   </script>';	
		if(empty($_REQUEST['record']) && isset($_REQUEST['relate_to']) && $_REQUEST['relate_to']=='oa_officeactions_cases')
		{  
		    $case_obj = new aCase();
			$case_obj->retrieve($_REQUEST['relate_id']);
		    $this->ss->assign("CASE_NAME", $case_obj->name);
		    $this->ss->assign("CASE_ID", $_REQUEST['relate_id']);
		}else{
		   $this->ss->assign("CASE_NAME", $this->bean->oa_officeactions_cases_name);
		   $this->ss->assign("CASE_ID", $this->bean->oa_officeactions_casescases_ida);
		}
		/**
		--------------------------------------
		subcase override: anuradha 22/8/2012
		--------------------------------------
		*/
		if($this->bean->subcaseoverride== 1){
			 $this->ss->assign("CHECKED_CHECK","checked=checked");	
		}else{     
			 $this->ss->assign("CHECKED_CHECK","");
			 $this->ss->assign('CHK_DIS','');
		}
		//end
		if(!empty($_REQUEST['record'])){
		    //get the case-id from relationship table
		    $get_case_id = " SELECT * FROM `oa_officeactions_cases_c` WHERE oa_officeactions_casesoa_officeactions_idb = '".$_REQUEST['record']."' AND deleted = '0' ";
			$get_case_id_result = $db->query($get_case_id);
			$case_row = $db->fetchByAssoc($get_case_id_result);				
			if (empty($case_row['oa_officeactions_casescases_ida'])) {
                $sub_case_query = "SELECT
                    sc_sc_subcasetype.id,
                    sc_sc_subcasetype.`name`
                    FROM
                    sc_sc_subcasetype
                    WHERE deleted = '0'";
                $sub_case_result = $db->query($sub_case_query);
                $subcase_array = array();
                while ($sub_case_row = $db->fetchByAssoc($sub_case_result)) {
                    $name = $sub_case_row['name'];
                    $id = $sub_case_row['id'];

                    $subcase_array[$id] = $name;
                }
                $options_data = get_select_options_with_id($subcase_array, "d7a74bed-7a5b-ea8c-355c-4f1a5577a54a");
                $this->ss->assign("EDIT_SUBCASE_NAME", $options_data);
            } else {
                //get the case type
                $a = new aCase();
                $case_obj = $a->retrieve($case_row['oa_officeactions_casescases_ida']);
                $case_type = $case_obj->type;
                //get the case type name
                $case_type_obj = new c_case_type();
                $case_type_obj = $case_type_obj->retrieve($case_type);

                $get_subcase_types = "SELECT * FROM `sc_sc_subcasetype_c_case_type_c` WHERE `sc_sc_subcasetype_c_case_typec_case_type_idb` = '" . $case_type . "' AND deleted=0"; //die;
                $get_subcase_types_res = $db->query($get_subcase_types);
                $subcase_array = array();
                while ($subcase_type_row = $db->fetchByAssoc($get_subcase_types_res)) {
                    //get the subcase type name
                    $subcase_type_obj = new sc_sc_subcasetype();
                    $subcase_type_obj = $subcase_type_obj->retrieve($subcase_type_row['sc_sc_subcasetype_c_case_typesc_sc_subcasetype_ida']);
                    $name = $subcase_type_obj->name;
                    $id = $subcase_type_obj->id;

                    $subcase_array[$id] = $name;
                }
                $options_data = get_select_options_with_id($subcase_array, $this->bean->subcase_name);
                $this->ss->assign("EDIT_SUBCASE_NAME", $options_data);
            }
			
			/**
			-----------------------------------------
			get subcase status dropdown
			-----------------------------------------
			*/
			$get_subcase_status = "SELECT cs.id,cs.name,cs.order_no FROM sc_sc_subcasetype_c_case_status_c rt ,c_case_status cs WHERE rt.sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida = '".$this->bean->subcase_name."' AND rt.deleted=0 AND rt.sc_sc_subcasetype_c_case_statusc_case_status_idb=cs.id AND cs.deleted=0 ORDER BY cs.order_no";

			//$get_subcase_status = "SELECT * FROM `sc_sc_subcasetype_c_case_status_c` WHERE `sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida` = '".$this->bean->subcase_name."' AND deleted=0";
			$get_subcase_status_res = $db->query($get_subcase_status);
			$subcase_status_array = array();
			while($subcase_status_row = $db->fetchByAssoc($get_subcase_status_res))
			{
					
				$subcase_status_array[$subcase_status_row['id']] = $subcase_status_row['name'];
			}			
			$status_options_data = get_select_options_with_id($subcase_status_array,$this->bean->subcase_status_id);
			$this->ss->assign("SUBCASE_STATUS_OPTIONS",$status_options_data);
		
		}
		/**************************************************************************************************
			Author : Anuradha
			Dt.: 05-Mar-2012
			Veon Consulting pvt. ltd
			Credit allocation		
		*************************************************************************************************/
		$sql_cont_list = "SELECT c.id,c.`login_id`,c.credits, u.first_name,u.last_name FROM `c_contribute` c, users u 
						  WHERE c.`case_id` = '".$this->bean->id."' AND u.id = c.login_id 
						  AND c.deleted = '0' AND u.deleted = '0'";
						  
		$res_cont_list = $db->query($sql_cont_list);
		$i = 0;
		$cnt = 1;
		$cr_allocation =  "<tr>";
		while($row_cont_list = $db->fetchByAssoc($res_cont_list)){

			if($cnt == 2){
				$cnt = 0;
			}
			
			$cr_allocation .= "<td>".$row_cont_list['first_name'] . " " . $row_cont_list['last_name'] . "</td>";
			$cr_allocation .= "<td><input type = 'text' name = 'credits_".$i."' id = 'credits_".$i."' value = '".$row_cont_list['credits']."' /><input type = 'hidden' id = 'cid_".$i."' name = 'cid_".$i."' value = '".$row_cont_list['id']."' />";
			$cr_allocation .= "</td>";
			
			if($cnt == 0){
				$cr_allocation .= "</tr>";
			}
			$cnt++;
			$i++;
		}
				
		$this->ss->assign("CNT_VALUE", $i);
		$this->ss->assign("CREDIT_ALLOCATION", $cr_allocation);
		
		
 		parent::display();
		echo $js;
 	}
}
?>
