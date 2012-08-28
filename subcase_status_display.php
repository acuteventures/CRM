<?php
/**************************************************
 Autor: Anuradha
 Organization: Veon Consulting Pvt Ltd.
 Date: 27-01-2012
 Description: ajax functionality for displaying subcases status based on the subcase selection
***************************************************/
chdir(realpath(dirname(__FILE__)));
define("sugarEntry", true);
require_once('include/entryPoint.php');
require_once('modules/Cases/Case.php');
require_once("modules/oa_officeactions/language/en_us.lang.php");

$subcase_id = $_GET['subcase_id'];

global $mod_strings,$db;
global $app_strings;
global $app_list_strings;

//$get_subcase_status = "SELECT * FROM `sc_sc_subcasetype_c_case_status_c` WHERE `sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida` = '".$subcase_id."' AND deleted=0";
$get_subcase_status = "SELECT cs.id,cs.name,cs.order_no FROM sc_sc_subcasetype_c_case_status_c rt ,c_case_status cs WHERE rt.sc_sc_subcasetype_c_case_statussc_sc_subcasetype_ida = '".$subcase_id."' AND rt.deleted=0 AND rt.sc_sc_subcasetype_c_case_statusc_case_status_idb=cs.id AND cs.deleted=0 ORDER BY cs.order_no";

$get_subcase_status_res = $db->query($get_subcase_status);
$subcase_status_array = array();
while($subcase_status_row = $db->fetchByAssoc($get_subcase_status_res))
{	
	//by default value should be Not Started
	if($subcase_status_row['order_no']=='10'){
		$default_id = $subcase_status_row['id'];
	}
	//$subcase_status_array[$id] = $name;
	$subcase_status_array[$subcase_status_row['id']] = $subcase_status_row['name'];
}
echo get_select_options_with_id($subcase_status_array,$default_id);


?>