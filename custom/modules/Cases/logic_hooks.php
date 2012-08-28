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
	DATE: 05-Dec-2011.
	VEON CONSULTING PVT. LTD.
********************************************************/

$hook_array['before_save'][] = Array(2, 'status change', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'status'); 
$hook_array['before_save'][] = Array(3, 'Case start completion datetimes', 'custom/modules/Cases/saveCaseDates.php','saveCaseDates', 'checkCaseDates');

$hook_array['before_save'][] = Array(4, 'Status Audit Before', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'statusAge_before'); 
// * preethi on 27-08-2012
//Des: for deleting the previous relations with the trademark of this case 
$hook_array['before_save'][] = Array(5, 'delete previous relation', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'deleteRelation'); 
// * End
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(6, 'contribute case', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'contributeUser'); 

// Date : 05-Jan-2012.
$hook_array['after_save'][] = Array(7, 'Credit Allocation', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'creditAllocation'); 

// Date : 01-Feb-2012.
$hook_array['after_save'][] = Array(8, 'Stats Audit', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'statusAge');

// Date : 17-Jan-2012.

$hook_array['after_save'][] = Array(9, 'case number', 'custom/modules/Cases/caseNumber.php','CaseNumbers', 'casenumber'); 

// 29-Feb-2012.
$hook_array['after_save'][] = Array(10, 'update name field', 'custom/modules/Cases/caseNumber.php','CaseNumbers', 'updateCaseName'); 

$hook_array['after_save'][] = Array(11, 'claim priority', 'custom/modules/Cases/PriorityClaimCreate.php','PriorityClaimCreate', 'claimCase'); 

$hook_array['after_save'][] = Array(12, 'claim priority No Possession', 'custom/modules/Cases/PriorityClaimCreate.php','PriorityClaimCreate', 'claimCaseNP'); 

$hook_array['after_save'][] = Array(13, 'update status field', 'custom/modules/Cases/caseNumber.php','CaseNumbers', 'updateStatusName');

// Date : 08-May-2012.
$hook_array['after_save'][] = Array(14, 'update consultant to claim priority', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'setConsultantToClaim');
// Date : 17-May-2012.
//Phaneendra
$hook_array['after_save'][] = Array(15, 'update priority date', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'setPriorityDate');
//* preethi on 23-08-2012 des: updating priority date when the claimed cases filing date is modified
$hook_array['after_save'][] = Array(16, 'update priority date', 'custom/modules/Cases/WorkFlows.php','WorkFlows', 'changePriorityDate');
//* by preethi on 26-07-2012 
//des : for adding the cases in to the newly created table c_s_d_case_subcase_dashlet for showing the dashlets
$hook_array['after_save'][] = Array(17, 'insert in to c_s_d_case_subcase_dashlet', 'custom/modules/Cases/saveCase.php','saveCase', 'insertCase');

// * by preethi on 22-08-2012
$hook_array['after_delete'][] = Array(18, 'delete from c_s_d_case_subcase_dashlet', 'custom/modules/Cases/saveCase.php','saveCase', 'deleteCase');

?>