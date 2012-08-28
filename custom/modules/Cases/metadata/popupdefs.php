<?php
$popupMeta = array (
    'moduleMain' => 'Cases',
    'varName' => 'CASE',
    'orderBy' => 'name',
    'whereClauses' => array (
  'case_number' => 'cases.case_number',
  'application_number' => 'cases.application_number',
  'invention_name' => 'cases.invention_name',
  'account_name' => 'cases.account_name',
),
    'searchInputs' => array (
  0 => 'case_number',
  1 => 'application_number',
  3 => 'invention_name',
  4 => 'account_name',
),
    'searchdefs' => array (
  'case_number' => 
  array (
    'name' => 'case_number',
    'width' => '10%',
  ),
  'invention_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_INVENTION_NAME',
    'id' => 'INVENTION_ID',
    'width' => '10%',
    'name' => 'invention_name',
  ),
 /* 'application_number' => 
  array (
    'name' => 'application_number',
    'width' => '10%',
  ),*/
  'account_name' , 
  /*array (
    'name' => 'account_name',
    'displayParams' => 
    array (
      'hideButtons' => 'true',
      'size' => 30,
      'class' => 'sqsEnabled sqsNoAutofill',
    ),
    'width' => '10%',
  ),*/
),
    'listviewdefs' => array (
  'ACCOUNT_NAME' => 
  array (
    'width' => '25',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'module' => 'Accounts',
    'id' => 'ACCOUNT_ID',
    'default' => true,
    'ACLTag' => 'ACCOUNT',
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'INVENTION' => 
  array (
    'width' => '25',
    'label' => 'LBL_INVENTION_NAME',
    'module' => 'Inv_Inventions',
    'id' => 'INVENTION_ID',
    'default' => true,
    'ACLTag' => 'INVENTION',
    'related_fields' => 
    array (
      0 => 'invention_id',
    ),
  ),
  'TRADE_TRADEMARK_CASES_NAME' =>
  array(
  	'width' => '25',
    'label' => 'LBL_TRADEMARK_NAME',
    'module' => 'trade_trademark',
    'id' => 'TRADE_TRADEMARK_CASESTRADE_TRADEMARK_IDA',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'trade_trademark_casestrade_trademark_ida',
    ),

  ),

  'CASETYPE' => 
  array (
    'width' => '25',
    'label' => 'LBL_CASE_TYPE',
    'module' => 'C_CASE_TYPE',
    'id' => 'TYPE',
    'default' => true,
    'ACLTag' => 'CASETYPE',
    'related_fields' => 
    array (
      0 => 'type',
    ),
  ),
  'APPLICATION_NUMBER' => 
  array (
    'width' => '25',
    'label' => 'LBL_APPLICATION_NUMBER',
    'link' => true,
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '35',
    'label' => 'LBL_LIST_NUMBER',
    'link' => true,
    'default' => true,
  ),
  'PRIORITY' => 
  array (
    'width' => '8',
    'label' => 'LBL_LIST_PRIORITY',
    'default' => true,
  ),
),
);
