<?php
//by anuradha
require_once('modules/oa_officeactions/oa_officeactions.php');
class saveSubCaseNames{
   function saveSubCaseName(&$bean, $event, $arguments) 
   {
		global $current_user,$db;
		$subcase_type_obj = new sc_sc_subcasetype();
		$subcase_id = $bean->subcase_name;
		$subcase_type_obj = $subcase_type_obj->retrieve($subcase_id);
		$bean->name = $subcase_type_obj->name;
   }

}	  
?>