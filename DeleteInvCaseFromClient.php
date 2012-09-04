<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');
	
global $db;
        
$record_id = $_REQUEST['recordId'];
$module = $_REQUEST['module'];

if($module == "Invention"){
    
    $set_inv_query = "UPDATE inv_inventions SET inv_inventions.deleted = 1 WHERE id='".$record_id."'";
    $db->query($set_inv_query);
    $set_inv_acc_query = "UPDATE inv_inventions_accounts_c SET deleted =1 WHERE inv_invent9feaentions_idb='".$record_id."'";
    $db->query($set_inv_acc_query);
    $get_cases_query = "SELECT id FROM cases WHERE invention_id = '".$record_id."' AND deleted = 0";
    $get_cases_result = $db->query($get_cases_query);
    while($get_cases_row = $db->fetchByAssoc($get_cases_result)){
        $get_subcase_query = "SELECT oa_officeactions_casesoa_officeactions_idb AS id FROM oa_officeactions_cases_c WHERE oa_officeactions_casescases_ida = '".$get_cases_row['id']."' AND deleted = 0";
        $get_subcase_result = $db->query($get_subcase_query);
        while ($get_subcase_row = $db->fetchByAssoc($get_subcase_result)){
            $get_oa_query = "UPDATE oa_officeactions SET deleted = 1 WHERE id = '".$get_subcase_row['id']."'";
            $db->query($get_oa_query);
        }
        
        $set_oa_cases_query = "UPDATE oa_officeactions_cases_c SET deleted = 1 WHERE oa_officeactions_casescases_ida = '".$get_cases_row['id']."'";
        $db->query($set_oa_cases_query);
    }
    
    $set_cases_query = "UPDATE cases SET deleted = 1 WHERE invention_id = '".$record_id."'";
    $db->query($set_cases_query);
}elseif ($module == "Trademark") {
    
    $set_tm_query = "UPDATE trade_trademark SET deleted = 1 WHERE id='".$record_id."'";
    $db->query($set_tm_query);
    
    $set_tm_acc_query = "UPDATE trade_trademark_accounts_c SET deleted = 1 WHERE trade_trademark_accountstrade_trademark_idb = '".$record_id."'";
    $db->query($set_tm_acc_query);
    $get_tm_cases_query = "SELECT trade_trademark_casescases_idb AS case_id FROM trade_trademark_cases_c WHERE trade_trademark_casestrade_trademark_ida = '".$record_id."' AND deleted = 0";
    $get_tm_cases_result = $db->query($get_tm_cases_query);
    while ($get_tm_cases_row = $db->fetchByAssoc($get_tm_cases_result)){
        $get_subcase_query = "SELECT oa_officeactions_casesoa_officeactions_idb AS id FROM oa_officeactions_cases_c WHERE oa_officeactions_casescases_ida = '".$get_tm_cases_row['case_id']."' AND deleted = 0";
        $get_subcase_result = $db->query($get_subcase_query);
        while ($get_subcase_row = $db->fetchByAssoc($get_subcase_result)){
            $get_oa_query = "UPDATE oa_officeactions SET deleted = 1 WHERE id = '".$get_subcase_row['id']."'";
            $db->query($get_oa_query);
        }
        
        $set_oa_cases_query = "UPDATE oa_officeactions_cases_c SET deleted = 1 WHERE oa_officeactions_casescases_ida = '".$get_tm_cases_row['case_id']."'";
        $db->query($set_oa_cases_query);
        $set_cases_query = "UPDATE cases SET deleted = 1 WHERE id = '".$get_tm_cases_row['case_id']."'";
        $db->query($set_cases_query);
    }
    
    $set_tm_cases_query = "UPDATE trade_trademark_cases_c SET deleted = 1 WHERE trade_trademark_casestrade_trademark_ida = '".$record_id."'";
    $db->query($set_tm_cases_query);
    
}elseif ($module == "Case" || $module == "Other") {
    
    $get_subcase_query = "SELECT oa_officeactions_casesoa_officeactions_idb AS id FROM oa_officeactions_cases_c WHERE oa_officeactions_casescases_ida = '".$record_id."' AND deleted = 0";
        $get_subcase_result = $db->query($get_subcase_query);
        while ($get_subcase_row = $db->fetchByAssoc($get_subcase_result)){
            $get_oa_query = "UPDATE oa_officeactions SET deleted = 1 WHERE id = '".$get_subcase_row['id']."'";
            $db->query($get_oa_query);
            
            $set_oa_cases_query = "UPDATE oa_officeactions_cases_c SET deleted = 1 WHERE oa_officeactions_casesoa_officeactions_idb = '".$get_subcase_row['id']."'";
        $db->query($set_oa_cases_query);
        }
    
    $set_cases_query = "UPDATE cases SET deleted = 1 WHERE id = '".$record_id."'";
    $db->query($set_cases_query);
}

echo $module." record deleted successfully..";
?>
