<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1, 'Accounts InsideView frame', 'modules/Connectors/connectors/sources/ext/rest/insideview/InsideViewLogicHook.php','InsideViewLogicHook', 'showFrame'); 


// Added By Basudeba Rath, Date : 11-May-2012.
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'Consultant Name before update', 'custom/modules/Accounts/combiningNames.php','combiningNames', 'updateConsultant_before'); 

//by anuradha 14/3/2012
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(1, 'combining first,last names', 'custom/modules/Accounts/combiningNames.php','combiningNames', 'assignName');
//end
//by anuradha 4/7/2012
$hook_array['after_save'][] = Array(2, 'combining first,last names', 'custom/modules/Accounts/combiningNames.php','combiningNames', 'officePhoneUpdate');
//end


// Added By Basudeba Rath, Date : 11-May-2012.
$hook_array['after_save'][] = Array(3, 'Consultant Name after update', 'custom/modules/Accounts/combiningNames.php','combiningNames', 'updateConsultant');

?>