<?php
$module_name = 'c_s_d_case_subcase_dashlet';
$listViewDefs [$module_name] = 
array (
  
  'PARENT_CASE_NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_PARENT_CASE_NAME',
    'default' => true,
    'link' => true,
	'module' => 'Cases',
    'id' => 'PARENT_CASE_ID',	
  ),
  
   'PARENT_SUBCASE_NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_PARENT_SUBCASE_NAME',
    'default' => true,
    'link' => true,
	'module' => 'oa_officeactions',
    'id' => 'PARENT_SUBCASE_ID',	
  ),


  'ACCOUNT_NAME' => 
  array (
    //'type' => 'relate',
	'module' => 'Accounts',
    'link' => true,
    'label' => 'LBL_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'width' => '30%',
    'default' => true,
	//'ACLTag' => 'ACCOUNT',
    //'related_fields' => array('account_id')
  ),
  'CLIENT_CONSULTANT_NAME' => 
  array (
    'type' => 'relate',
    'link' => false,
    'label' => 'LBL_CLIENT_CONSULTANT_NAME',
    'id' => 'client_consultant_id',
    'width' => '25%',
    'default' => true,
	'module' => 'Users',
  ),
  'CASE_TYPE_NAME' => 
  array (
    'type' => 'relate',
    //'link' => true,
    'label' => 'LBL_CASE_TYPE_NAME',
    'id' => 'CASE_TYPE_ID',
    'width' => '25%',
    'default' => true,
  ),
  'SUBCASE_NAME' => 
  array (
    'type' => 'relate',
    'label' => 'LBL_SUBCASE_NAME',
    'id' => 'SUB_CASE_TYPE_ID',
    'link' => false,
    'width' => '25%',
    'default' => true,
  ),
  'STATUS_NAME' => 
  array (
    'type' => 'relate',
   // 'link' => true,
    'label' => 'LBL_STATUS',
    'id' => 'STATUS',
    'width' => '25%',
    'default' => true,
  ),
  'CASE_SUBCASE_STATUS_AGE' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_CASE_SUBCASE_STATUS_AGE',
    'width' => '10%',
  ),
 'DUE_DATE' =>
  array(
    'default' => true,  
  	'label' => 'LBL_DUE_DATE',
    'width' => '12%',	
  ),
  // * preethi on 24-08-2012
 'PRIORITYDATE' =>
  array(
    'default' => true,  
  	'label' => 'LBL_PRIORITYDATE',
    'width' => '12%',	
  ),
  // * End
);
?>
