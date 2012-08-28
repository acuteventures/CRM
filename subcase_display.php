<?php
/**************************************************
 Autor: Anuradha
 Organization: Veon Consulting Pvt Ltd.
 Date: 14-01-2012
 Description: ajax functionality for displaying parent casetype and subcase name
***************************************************/
chdir(realpath(dirname(__FILE__)));
define("sugarEntry", true);
require_once('include/entryPoint.php');
require_once('modules/Cases/Case.php');
require_once("modules/oa_officeactions/language/en_us.lang.php");
$case_id = $_GET['case_id'];
$selected_sub_case = $_GET['sel_val'];
global $mod_strings;
global $app_strings;
global $app_list_strings;

//get the case type
$a = new aCase();
$case_obj = $a->retrieve($case_id);
$case_type = $case_obj->type;
//get the case type name
$case_type_obj = new c_case_type();
$case_type_obj = $case_type_obj->retrieve($case_type);

//$data = $mod_strings['LBL_CASE_TYPE'].":<input type='text' value='".$case_type_obj->name."' readonly>";
//$data.= "<br><br />";
/*if($case_obj->relatedtoparent =='Invention')
{
	$data.= $mod_strings['LBL_SUBCASE_NAME'].":<select name='subcase_name' id='subcase_name'>".get_select_options_with_id($app_list_strings['patent_subcase__list'],'')."</select>";	
}

if($case_obj->relatedtoparent =='Trademark')
{
	$data.= $mod_strings['LBL_SUBCASE_NAME'].":<select name='subcase_name' id='subcase_name'>".get_select_options_with_id($app_list_strings['trademark_subcase_list'],'')."</select>";

}*/
$get_subcase_types = "SELECT * FROM `sc_sc_subcasetype_c_case_type_c` WHERE `sc_sc_subcasetype_c_case_typec_case_type_idb` = '".$case_type."' AND deleted=0";
$get_subcase_types_res = $db->query($get_subcase_types);
$subcase_array = array();
$subcase_array[''] = '';
while($subcase_type_row = $db->fetchByAssoc($get_subcase_types_res))
{
	//get the subcase type name
    $subcase_type_obj = new sc_sc_subcasetype();
    $subcase_type_obj = $subcase_type_obj->retrieve($subcase_type_row['sc_sc_subcasetype_c_case_typesc_sc_subcasetype_ida']);
    $name = $subcase_type_obj->name;
	$id = $subcase_type_obj->id;
	
	$subcase_array[$id] = $name;	
}
//echo '<select name="subcase_name" id="subcase_name"><option value=""></option>'.get_select_options_with_id($subcase_array,'').'</select>';
echo get_select_options_with_id($subcase_array,$selected_sub_case);


?>