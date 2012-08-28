<?php
$module_name = 'oa_officeactions';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'SUBCASE' => 
  array (
    'width' => '32',
    'label' => 'LBL_SUBCASE_NAME',
    'default' => true,
  ),
  /*'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),*/
  //by anuradha 21/8/2012
 'SUBCASE_STATUS' =>
  array (
    'width' => '32',
    'label' => 'LBL_OFFICEACTIONSTATUS',
    'default' => true,
  ),
  'OA_OFFICEACTIONS_CASES_NAME' =>
  array (
    'width' => '32',
    'label' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
    'default' => true,
  ),
  //end
  //by swapna dt:17-03-2012
   'SUBCASE_STATUS_AGE' => 
  array (
    'width' => '32',
    'label' => 'LBL_SUBCASE_STATUS_AGE',
    'default' => true,
  ),
  'DUEDATE' =>
	array (
		'width' => '32',
		'label' => 'LBL_DUEDATE',
		'default' => true,
	),
    'DATE_ENTERED' => 
  array (
    'width' => '32',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),

);
?>
