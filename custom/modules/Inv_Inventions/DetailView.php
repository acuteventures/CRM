<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

#PATH
define('PATH', $_SERVER['DOCUMENT_ROOT']."/test/upload/Invention");
/**
* Author: Anuradha
* Org: Veon Consulting
* Created On: 24-11-2011
* Description: Detail View
*/

global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme,$db;


$focus = new Inv_Inventions();

//print_r($focus);
if(isset($_REQUEST['record'])) {
    $focus->retrieve($_REQUEST['record']);
    $inventionId = $_REQUEST['record'];
}
if(isset($_REQUEST['isDuplicate']) && $_REQUEST['isDuplicate'] == 'true') {
	$focus->id = "";
}

echo get_module_title($mod_strings['LBL_MODULE_ID'], $mod_strings['LBL_MODULE_NAME'].": ".$focus->name, true);

$GLOBALS['log']->info("Inventions detail view");

$xtpl= new XTemplate ('custom/modules/Inv_Inventions/DetailView.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);
$xtpl->assign("CREATED_BY", $focus->created_by_name);
$xtpl->assign("MODIFIED_BY", $focus->modified_by_name);
$xtpl->assign("DATE_MODIFIED", $focus->date_modified);
$xtpl->assign("DATE_ENTERED", $focus->date_entered);

$xtpl->assign("PRINT_URL", "index.php?".$GLOBALS['request_string']);
$xtpl->assign("ID", $focus->id);

$xtpl->assign("INVENTION_NAME",$focus->name);
$xtpl->assign("CLIENT_NAME", $focus->inv_inventions_accounts_name);  //client_name
//by anuradha
$client_link = "<a href='index.php?module=Accounts&action=DetailView&record=".$focus->inv_inventd1acccounts_ida."'>".$focus->inv_inventions_accounts_name."</a>";
$xtpl->assign("CLIENT_LINK", $client_link);
//end
$xtpl->assign("CLIENT_ID", $focus->inv_inventd1acccounts_ida);
$xtpl->assign('INVENTION_ID', $inventionId);
$xtpl->assign("TOTAL_PATENT_ASSIGNED", $focus->total_patent_assigned);
$xtpl->assign("ASSIGNEE_NAME", $focus->assignee_name);
$xtpl->assign("ASSIGNEE_ADDRESS1", $focus->assignee_address1);
$xtpl->assign("ASSIGNEE_ADDRESS2", $focus->assignee_address2);
$xtpl->assign("ASSIGNEE_CITY", $focus->assignee_city);
$xtpl->assign("ASSIGNEE_STATE", $focus->assignee_state);
$xtpl->assign("ASSIGNEE_ZIPCODE", $focus->assignee_zipcode);
$xtpl->assign("ASSIGNEE_COUNTRY", $focus->assignee_country);

$xtpl->assign("ENTITY_TYPE", $focus->invention_entity_type);
$xtpl->assign("ASSIGNMENT", $focus->assignment);
$xtpl->assign("NON_PROFIT_ENTITY", $focus->non_profit_entity);
$xtpl->assign("GOVT_INVENTIONS", $focus->govt_inventions);

$inv_sql = "SELECT * FROM inventor_list WHERE invention_id='".$focus->id."' AND deleted='0'";
$inv_sql_result = $db->query($inv_sql);
$inv_count = 1;
while($inv_row = $db->fetchByAssoc($inv_sql_result))
{
	if($inv_row['primary_inventor']==1){
		$primary="(Primary)";
	}
	else{
		$primary="";
	}
	$lineItemsHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="detail view">';
	$lineItemsHtml .= '<tr>';
    $lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_FIRST_NAME'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['name'].' '.$primary.'</span sugar="slot"></td>';	
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_LAST_NAME'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['last_name'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';


	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MIDDLE_NAME'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['middle_name'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_ADDRESS1'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_address1'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';


	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_ADDRESS2'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_address2'].'</span sugar="slot"></td>';

	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_CITY'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_city'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';

	
	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_STATE'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_state'].'</span sugar="slot"></td>';
	
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_ZIPCODE'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_zipcode'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';

	
	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_MAILING_COUNTRY'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['mailing_country'].'</span sugar="slot"></td>';

	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_RESIDENCE_CITY'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['residence_city'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';

	
	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_RESIDENCE_STATE'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['residence_state'].'</span sugar="slot"></td>';

	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_RESIDENCE_COUNTRY'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['residence_country'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';

	
	$lineItemsHtml .= '<tr>';
	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_EMAIL_ADDRESS'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['email_address'].'</span sugar="slot"></td>';

	$lineItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_PHONE_NUMBER'].':</span sugar="slot"></td>';
	$lineItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$inv_row['phone_number'].'</span sugar="slot"></td>';
	$lineItemsHtml .= '</tr>';


	$lineItemsHtml .= ' </table>';
	
$inv_count++;

}
	
$xtpl->assign("LINEITEMS_ROWS",$lineItemsHtml);


	/*****************************
		
		Author : Basudeba Rath.
		Date : 31-May-2012. 
		
	**********************************************************************/
	
	$sql_assignment = "SELECT * FROM `as_assignment` WHERE `inv_inventions_id_c` = '".$focus->id."' AND deleted = '0'";
	$res_assignment = $db->query($sql_assignment);
	while($row_assignment = $db->fetchByAssoc($res_assignment)){

		$assignmentItemsHtml .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="detail view">';
		$assignmentItemsHtml .= '<tr>';
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_NAME'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['name'].'</span sugar="slot"></td>';	
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_PERCENT_PATENT_ASSIGNED'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['percent_patent_assigned'].'</span sugar="slot"></td>';
		$assignmentItemsHtml .= '</tr>';
	
	
		$assignmentItemsHtml .= '<tr>';
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_ADDRESS1'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_address1'].'</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_ADDRESS2'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_address2'].'</span sugar="slot"></td>';
		$assignmentItemsHtml .= '</tr>';
	
	
		$assignmentItemsHtml .= '<tr>';
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_CITY'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_city'].'</span sugar="slot"></td>';
	
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_STATE'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_state'].'</span sugar="slot"></td>';
		$assignmentItemsHtml .= '</tr>';

		$assignmentItemsHtml .= '<tr>';
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_ZIPCODE'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_zip'].'</span sugar="slot"></td>';
	
		$assignmentItemsHtml .= '<td width="12.5%" valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3">'.$mod_strings['LBL_ASSIGNEE_COUNTRY'].':</span sugar="slot"></td>';
		$assignmentItemsHtml .= '<td width="37.5%" valign="top" class="tabDetailViewDF"><span sugar="slot3b">'.$row_assignment['assignee_country'].'</span sugar="slot"></td>';
		$assignmentItemsHtml .= '</tr>';
		
		$assignmentItemsHtml .= ' </table>';

	}
	$xtpl->assign("ASSIGNMENT_ITEM_ROWS",$assignmentItemsHtml);

/**
--------------------------------------
Anuradha 26/7/2012
Associates Cases to Specific Invention
--------------------------------------
*/

$getCases = "SELECT c.id, c.name AS case_name, inv.name AS invention_name, ct.name AS case_type, cs.name AS case_status, IF(c.due_date='0000-00-00',' ',c.due_date) AS due_date, c.prioritydate, IF(c.filing_date='0000-00-00',' ',c.filing_date) AS filing_date, c.application_number, c.case_end_date
FROM inv_inventions inv 
INNER JOIN cases c ON c.invention_id=inv.id
INNER JOIN c_case_type ct ON ct.id=c.type
INNER JOIN c_case_status cs ON cs.id=c.status
WHERE 
inv.deleted=0 AND c.deleted=0 AND inv.id='".$focus->id."' AND cs.deleted=0 AND ct.deleted=0 ";

$getCasesResult = $db->query($getCases);

$case_data='';
$case_data.='<table border="0" cellspacing="0" cellpadding="0"  class="detail view">';

$case_data.='<tr>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_NUMBER'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_STATUS'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_TYPE'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_DUE_DATE'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_PRIORITY_DATE'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_COMPLETION_DATE'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_FILING_DATE'].':</strong></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDL"><span sugar="slot3"><strong>'.$mod_strings['LBL_CASE_APPLICATION'].':</strong></span sugar="slot"></td>';

$case_data.='</tr>';

while($case_row = $db->fetchByAssoc($getCasesResult))
{

$due_date = $case_row['due_date'];
if(!empty($due_date)){ 
	$display_due_date = date('m/d/Y',strtotime($due_date)); 
}
if(($due_date==" ")){
	$display_due_date = "";
} 
$filing_date = $case_row['filing_date'];
if(!empty($filing_date)){ 
	$display_filing_date = date('m/d/Y',strtotime($filing_date)); 
}
if(($filing_date==" ")){
	$display_filing_date = "";
} 
$prioritydate = $case_row['prioritydate'];
if(!empty($prioritydate)){ 
	$display_prioritydate = date('m/d/Y',strtotime($prioritydate)); 
}
if(($prioritydate==" ")){
	$display_prioritydate = "";
} 

$case_end_date = $case_row['case_end_date'];
if(!empty($case_end_date)){ 
	$display_case_end_date = date('m/d/Y',strtotime($case_end_date)); 
}
if(($filing_date==" ")){
	$display_case_end_date = "";
} 


$case_data.='<tr>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3"><a href="index.php?module=Cases&action=DetailView&record='.$case_row['id'].'">'.$case_row['case_name'].'</a></span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$case_row['case_status'].'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$case_row['case_type'].'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$display_due_date.'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$display_prioritydate.'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$display_case_end_date.'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$display_filing_date.'</span sugar="slot"></td>';

$case_data.='<td valign="top" scope="row" class="tabDetailViewDF"><span sugar="slot3">'.$case_row['application_number'].'</span sugar="slot"></td>';

$case_data.='</tr>';


}

$case_data.='</table>';

//echo $case_data;

$xtpl->assign("CASE_DATA",$case_data);

/**************************************************
 * By Rajesh G 30/04/12
 * To Display uploaded files Download & Remove
 * used files - Download_custom.php, DeleteFile.php
 **************************************************/

# retrieve accountId from invention id 
$accIdQuery = "SELECT inv_inventions_accounts_c.inv_inventd1acccounts_ida AS acc_id
            FROM
            inv_inventions_accounts_c
            WHERE
            inv_inventions_accounts_c.inv_invent9feaentions_idb = '".$inventionId."'";
$accIdQueryResult = $db->query($accIdQuery);
while($row = $db->fetchByAssoc($accIdQueryResult))
{
    $accId = $row['acc_id'];
}
$filePath = PATH."/".$accId."/".$inventionId."/";
$fileList = '';
if(is_dir($filePath))
{
    $fileArray = scandir($filePath);
    $i = 0;
    if(count($fileArray)>2)
    {
        $fileList = '';
        foreach ($fileArray as $key => $value) {
                $files .=$value;
            if($value == "." || $value == "..")
                continue;
            else
            {
                $i++;
                 $fileNameWtPath = addslashes($filePath.$value);
                 
                $tabData = "<tr id='row".$i."'><td width='12.5%' valign='top' scope='row' class='tabDetailViewDL' style='text-align:left'><span sugar='slot3'>".$value."</span sugar='slot'></td>
                    <td valign='top' scope='row' class='tabDetailViewDL' style='text-align:left;'><span sugar='slot3'></span sugar='slot'><a href='http://".$_SERVER['HTTP_HOST']."/sugarcrm_new/Download_custom.php?file_name=".$value."&clientId=".$accId."&invId=".$inventionId."'>[Download]</a>&nbsp;&nbsp;";
                $tabData2 = "<a href='#' onclick=\"return confirmDelete(this, '$fileNameWtPath');\" name='.$value.' id=".$i.">[Remove]</a></td></tr>";
                $fileList.=$tabData.$tabData2;
            }
        }
    }
    else
    {
        $tabData = '<tr><td width="12.5%" valign="top" scope="row" class="tabDetailViewDL" style="text-align:left"><span sugar="slot3">No files</span sugar="slot"></td>
                    <td valign="top" scope="row" class="tabDetailViewDL" align="left"><span sugar="slot3"></span sugar="slot"></td>
                    </tr>';
                $fileList.=$tabData;
    }
}
else
{
    $tabData = '<tr><td width="12.5%" valign="top" scope="row" class="tabDetailViewDL" style="text-align:left"><span sugar="slot3">No files</span sugar="slot"></td>
                <td valign="top" scope="row" class="tabDetailViewDL" align="left"><span sugar="slot3"></span sugar="slot"></td>
                </tr>';
            $fileList.=$tabData;
}

$xtpl->assign("ACC_ID",$accId);
$xtpl->assign("FILE_LIST",$fileList);
$xtpl->assign("FILE_PATH",$filePath);
/*************end********************/
if (isset($_REQUEST['return_module'])) $xtpl->assign("RETURN_MODULE", $_REQUEST['return_module']);
if (isset($_REQUEST['return_action'])) $xtpl->assign("RETURN_ACTION", $_REQUEST['return_action']);
if (isset($_REQUEST['return_id'])) $xtpl->assign("RETURN_ID", $_REQUEST['return_id']);
// handle Create $module then Cancel
if (empty($_REQUEST['return_id'])) {
	$xtpl->assign("RETURN_ACTION", 'index');
}
$xtpl->parse("main");
$xtpl->out("main");
?>
