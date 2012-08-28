<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'Cases push feed', 'modules/Cases/SugarFeeds/CaseFeed.php','CaseFeed', 'pushFeed'); 

/********************************************************

	AUTHOR : BASUDEBA RATH.
	DATE: 30-DEC-2011.
	VEON CONSULTING PVT. LTD.
********************************************************/

$hook_array['before_save'][] = Array(2, 'subcase start completion datetimes', 'custom/modules/oa_officeactions/saveSubCaseDates.php','saveSubCaseDates', 'checkSubCaseDates');
//end

//by Swapna 15-03-2012
$hook_array['before_save'][] = Array(3, 'Status Audit Before', 'custom/modules/oa_officeactions/subcase_status_age.php','SubcaseStatusAge', 'subcasestatusAge_before'); 

$hook_array['after_save'] = Array(); 

//by anuradha 27/1/2012
$hook_array['after_save'][] = Array(4, 'subcase number', 'custom/modules/oa_officeactions/subcaseNumber.php','subcaseNumber', 'generateSubcasenumber');
//end

//by Swapna 15-03-2012
$hook_array['after_save'][] = Array(5, 'Stats Audit', 'custom/modules/oa_officeactions/subcase_status_age.php','SubcaseStatusAge', 'subcasestatusAge');

// By Basudeba Rath, Date: 10-May-2012.
$hook_array['after_save'][] = Array(6, 'Sub Case Logics', 'custom/modules/oa_officeactions/SubCaseLogic.php','SubCaseLogic', 'contConsultant');

//by preethi on 26-07-2012 
//des : for adding the cases in to the newly created table c_s_d_case_subcase_dashlet for showing the dashlets
$hook_array['after_save'][] = Array(7, 'insert in to c_s_d_case_subcase_dashlet', 'custom/modules/oa_officeactions/saveCase.php','saveCase', 'insertCase');

// * by preethi on 22-08-2012
$hook_array['after_delete'][] = Array(8, 'delete from c_s_d_case_subcase_dashlet', 'custom/modules/oa_officeactions/saveCase.php','saveCase', 'deleteCase');

//by anuradha 23/8/2012
$hook_array['after_save'][] = Array(9, 'Sub Case Logics', 'custom/modules/oa_officeactions/SubCaseLogic.php','SubCaseLogic', 'creditAllocation');

?>