<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

/* * *******************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2011 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 * ****************************************************************************** */


require_once('include/MVC/View/views/view.detail.php');

class AccountsViewDetail extends ViewDetail {

    function AccountsViewDetail() {
        parent::ViewDetail();
    }

    /**
     * display
     * Override the display method to support customization for the buttons that display
     * a popup and allow you to copy the account's address into the selected contacts.
     * The custom_code_billing and custom_code_shipping Smarty variables are found in
     * include/SugarFields/Fields/Address/DetailView.tpl (default).  If it's a English U.S.
     * locale then it'll use file include/SugarFields/Fields/Address/en_us.DetailView.tpl.
     */
    function display() {

        if (empty($this->bean->id)) {
            global $app_strings;
            sugar_die($app_strings['ERROR_NO_RECORD']);
        }

        $this->dv->process();
        global $mod_strings;
        global $db;
        if (ACLController::checkAccess('Contacts', 'edit', true)) {
            $push_billing = '<span class="id-ff"><button class="button btn_copy" title="' . $mod_strings['LBL_PUSH_CONTACTS_BUTTON_LABEL'] .
                    '" type="button" onclick=\'open_contact_popup("Contacts", 600, 600, "&account_name=' .
                    urlencode($this->bean->name) . '&html=change_address' .
                    '&primary_address_street=' . str_replace(array("\rn", "\r", "\n"), array('', '', '<br>'), urlencode($this->bean->billing_address_street)) .
                    '&primary_address_city=' . $this->bean->billing_address_city .
                    '&primary_address_state=' . $this->bean->billing_address_state .
                    '&primary_address_postalcode=' . $this->bean->billing_address_postalcode .
                    '&primary_address_country=' . $this->bean->billing_address_country .
                    '", true, false);\' value="' . $mod_strings['LBL_PUSH_CONTACTS_BUTTON_TITLE'] . '">' .
                    SugarThemeRegistry::current()->getImage("id-ff-copy", "", null, null, '.png', $mod_strings["LBL_COPY"]) .
                    '</button></span>';

            $push_shipping = '<span class="id-ff"><button class="button btn_copy" title="' . $mod_strings['LBL_PUSH_CONTACTS_BUTTON_LABEL'] .
                    '" type="button" onclick=\'open_contact_popup("Contacts", 600, 600, "&account_name=' .
                    urlencode($this->bean->name) . '&html=change_address' .
                    '&primary_address_street=' . str_replace(array("\rn", "\r", "\n"), array('', '', '<br>'), urlencode($this->bean->shipping_address_street)) .
                    '&primary_address_city=' . $this->bean->shipping_address_city .
                    '&primary_address_state=' . $this->bean->shipping_address_state .
                    '&primary_address_postalcode=' . $this->bean->shipping_address_postalcode .
                    '&primary_address_country=' . $this->bean->shipping_address_country .
                    '", true, false);\' value="' . $mod_strings['LBL_PUSH_CONTACTS_BUTTON_TITLE'] . '">' .
                    SugarThemeRegistry::current()->getImage("id-ff-copy", '', null, null, '.png', $mod_strings['LBL_COPY']) .
                    '</button></span>';
        } else {
            $push_billing = '';
            $push_shipping = '';
        }

        $this->ss->assign("custom_code_billing", $push_billing);
        $this->ss->assign("custom_code_shipping", $push_shipping);

        if (empty($this->bean->id)) {
            global $app_strings;
            sugar_die($app_strings['ERROR_NO_RECORD']);
        }

        /*         * ****************************************************************************************************************** */
        // Author : Basudeba Rath.
        // Dt. 23-nov-2011.
        // Veon Consulting Pvt. Ltd.
        /*         * ****************************************************************************************************************** */

        $sqlPHONE = "SELECT `phone_no`,`primary_no` FROM `ph_phoneno` WHERE `account_id_c` = '" . $this->bean->id . "' ";
        $sqlPHONE .= " AND deleted = '0' ";

        $resPHONE = $db->query($sqlPHONE);
        while ($rowPHONE = $db->fetchByAssoc($resPHONE)) {

            if ($rowPHONE['primary_no'] == 1) {
                $ph_nos .= $rowPHONE['phone_no'] . " (Primary)<br>";
            } else {
                $ph_nos .= $rowPHONE['phone_no'] . "<br>";
            }
        }
        $this->ss->assign('PHONE_NOS', $ph_nos);

        // Dt.:24-Nov-2011

        global $beanFiles;
        global $current_user;

        require_once($beanFiles['Account']);

        $this->bean->load_relationship('client_history');

        $this->ss->assign('CLIENT_HISTORY', "Client History");


        if (!(strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla/5') === false)) {
            $this->ss->assign('PDFMETHOD', 'POST');
        } else {
            $this->ss->assign('PDFMETHOD', 'GET');
        }

        $this->ss->assign('gridline', $current_user->getPreference('gridline') == 'on' ? '1' : '0');

        $this->ss->assign('BEAN_ID', $this->bean->id);
        $this->ss->assign('USER_ID', $current_user->id);

        $acl_role = new ACLRole();
        $user_role = $acl_role->getUserRoles($current_user->id);

        $sqlNOTE = " SELECT n.id,n.assigned_user_id,n.description,n.date_entered,n.date_modified, ";
        $sqlNOTE .= " n.created_by, u.first_name,u.last_name FROM notes n,users u ";
        $sqlNOTE .= " WHERE n.parent_id = '" . $this->bean->id . "' AND n.deleted = '0' AND n.created_by = u.id ORDER BY n.date_modified DESC ";
        $resNOTE = $db->query($sqlNOTE);

        $history_row .= " <table border='1' width = '100%'><tr><th width = '15%' style='text-align:left;border-bottom: 1px solid ";
        $history_row .= " #C1DAD7;letter-spacing: 2px;padding: 6px 6px 6px 12px;text-transform: uppercase;'>Date & Time</th> ";
        $history_row .= " <th width = '15%' style='border-bottom: 1px solid #C1DAD7; letter-spacing: 2px; text-align:left;";
        $history_row .= " padding: 6px 6px 6px 12px;'>User</th>";

        $history_row .= " <th width = '40%' style='border-bottom: 1px solid #C1DAD7;letter-spacing: 2px; text-align:left;";
        $history_row .= " padding: 6px 6px 6px 12px;'>Comments</th><th width = '1%'  style='border-bottom: 1px solid #C1DAD7; ";
        $history_row .= " letter-spacing: 2px;padding: 6px 6px 6px 12px;'>Action</th></tr>";


        while ($rowNOTE = $db->fetchByAssoc($resNOTE)) {

            // $originalDate = $rowNOTE['date_entered']; 
            // $newDate = date("m/d/Y g:i a", strtotime($originalDate));
            // echo date("m/d/Y");

            $originalDate = $rowNOTE['date_entered'];
            $newDate = date("m/d/Y g:i a", strtotime('-5 hours', strtotime($originalDate))); // Converted date time to EST GMT - 5 .

            if ($this->bean->assigned_user_id == $rowNOTE['created_by']) { //$current_user->id
                $history_row .= "<tr><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $newDate;
                $history_row .= ", <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by " . $rowNOTE['first_name'] . $rowNOTE['last_name'];
                $history_row .= "<b> : </td><td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $rowNOTE['description'] . "</td>";
            } else if ($current_user->id == $rowNOTE['assigned_user_id']) {

                $history_row .= "<tr><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $newDate;
                $history_row .= ", <td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>  by " . $rowNOTE['first_name'] . $rowNOTE['last_name'];
                $history_row .= "<b> : </td><td style='color:#00CCFF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $rowNOTE['description'] . "</td>";
            } else {
                $history_row .= " <tr><td style='color:#5280B1; border-bottom: 1px solid #C1DAD7;";
                $history_row .= " border-top: 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $newDate;
                $history_row .= " ,<td style='color:#5280B1;border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
                $history_row .= " padding:6px 6px 6px 12px'><b>  by " . $rowNOTE['first_name'] . $rowNOTE['last_name'];
                $history_row .= " <b> : </td><td style='color:#5280B1;border-bottom: 1px solid #C1DAD7; border-top: ";
                $history_row .= " 1px solid #C1DAD7; padding:6px 6px 6px 12px'><b>" . $rowNOTE['description'] . "</b></td>";
            }
            $rec_Date = explode(" ", $rowNOTE['date_entered']);
            $expire_date = strtotime($rec_Date[0]);
            $today = strtotime(gmdate("Y-m-d", time()));

            if ($expire_date == $today) {


                $history_row .= "<td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
                $history_row .= " padding:6px 6px 6px 12px'> <img  src='edit.png' onclick='edit(this.id);' ";
                $history_row .= " id='" . $rowNOTE['id'] . "' name='" . $rowNOTE['id'] . "' /> <img src='delete.png' ";
                $history_row .= " onclick='removeNotes(this.id);' id='" . $rowNOTE['id'] . "' name='" . $rowNOTE['id'] . "' /></td></tr>";
            }
            if ($user_role[0] == 'manager' && $expire_date < $today) {

                $history_row .= " <td style='color:#3366FF; border-bottom: 1px solid #C1DAD7;border-top: 1px solid #C1DAD7; ";
                $history_row .= " padding:6px 6px 6px 12px'> <img src='delete.png' ";
                $history_row .= " onclick='removeNotes(this.id);' id='" . $rowNOTE['id'] . "' name='" . $rowNOTE['id'] . "' /></td></tr>";
            } else {
                $history_row .= "</tr>";
            }
        }
        $history_row .= "</table>";
        $this->ss->assign('NOTES', $history_row);

        if ($_REQUEST['notesid']) {
            $sql_edit_NOTE = "SELECT * FROM `notes` WHERE id = '" . $_REQUEST['notesid'] . "' AND `deleted` = '0' ";
            $res_edit_NOTE = $db->query($sql_edit_NOTE);
            if ($row_edit_NOTE = $db->fetchByAssoc($res_edit_NOTE)) {

                $this->ss->assign('NOTES_TEXT', $row_edit_NOTE['description']);
                $this->ss->assign('NOTE_ID', $row_edit_NOTE['id']);
                $btnCancel = "<input type = 'button' id = 'btnCancel' name = 'btnCancel' value = 'Cancel' onclick = 'cancel()' />";
                $this->ss->assign('BTN_CANCEL', $btnCancel);
            }
        }



        /*         * ******************************************************************************************************************* */

        /*
          Author : Ashok Gupta
          Created By: veon
          Dated: 28-12-2011
          Modified: 02-01-2012
          Desc:  Client Record Display
         */
        global $db;
        $recordId = $_REQUEST['record'];

        #Rajesh G - 24/04/12
        #client id display
        $this->ss->assign('CLIENT_ID', $recordId); #END

        $html = '';
        $html .= '</td></tr> <table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        $html .= '<tr><td  width="20.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4">Cases</font></td><td width="40.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4"><a href="index.php?module=Inv_Inventions&action=EditView&return_module=Accounts&account_id=' . $recordId . '&account_name=' . $this->bean->name . '&return_action=DetailView&return_id=' . $recordId . '" title="Click To Create Invantions">Create Invention </a>&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;<a href="index.php?module=Cases&action=EditView&return_module=Accounts&account_id=' . $recordId . '&account_name=' . $this->bean->name . '&consultant_id=' . $this->bean->assigned_user_id . '&return_action=DetailView&return_id=' . $recordId . '" title="Click To Create Cases">Create Case</a></font></td></tr></table>';


        // Phani ************//

        /*         * *PHANEENDRA***** */
        $queryDisplayInventionRecord = "SELECT inv_inventions.name,inv_inventions.id FROM inv_inventions JOIN inv_inventions_accounts_c iiac ON inv_inventions.id=iiac.inv_invent9feaentions_idb JOIN accounts ON iiac.inv_inventd1acccounts_ida=accounts.id WHERE accounts.id='" . $recordId . "' AND accounts.deleted=0 and iiac.deleted=0 and inv_inventions.deleted=0";
        $resultDisplayInventionRecord = $db->query($queryDisplayInventionRecord);
        $inventionName = array();
        $inid = array();
        while ($rowDisplayRecord2 = $db->fetchByAssoc($resultDisplayInventionRecord)) {
            $inventionName[] = $rowDisplayRecord2['name'];
            $inid[] = $rowDisplayRecord2['id'];
        }

        $query_invention = "SELECT inv_inventions.name as inventionTitle,inv_inventions.id as inventionId, cases.name as casesName FROM inv_inventions JOIN  cases ON inv_inventions.id=cases.invention_id  JOIN accounts on accounts.id = cases.account_id WHERE accounts.id='" . $recordId . "' AND cases.deleted=0 AND inv_inventions.deleted=0 AND accounts.deleted=0 group by inv_inventions.id";
        $resultInvention = $db->query($query_invention);
        $html.= '<table width="100%" border="0" cellpadding="0">';
        $inventionTitle = array();
        $inventionId = array();
        while ($rowInvention = $db->fetchByAssoc($resultInvention)) {
            $inventionId[] = $rowInvention['inventionId'];
            $inventionTitle[] = $rowInvention['inventionTitle'];
        }

        $inventionName = array_diff($inventionName, $inventionTitle);
        $ID = array_diff($inid, $inventionId);
        $html .='<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        foreach ($inventionName as $in) {
            $invname[] = $in;
        }
        foreach ($ID as $iid) {
            $iiid[] = $iid;
        }
        //print_r($invname);
        //echo "<hr>";
        //print_r($iiid);
        for ($i = 0; $i < count($invname); $i++) {
            // $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Invention Name :'.$invname[$i].'</p></b></td></tr>';  
            $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Invention  :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $html .= "<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D" . $iiid[$i] . "' title='Click To See The Details Of Invantions'><b>" . $invname[$i] . '</b></a></p></td></tr>';
        }

        /* foreach ($inventionName as $in){
          $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Invention Name :'.$in.'</p></b></td></tr>';
          } */
        /*         * *********************************************************************** */
        /*         * *PHANEENDRA***** */
        $query_invention = "SELECT inv_inventions.name as inventionTitle,inv_inventions.id as inventionId, cases.name as casesName FROM inv_inventions JOIN  cases ON inv_inventions.id=cases.invention_id  JOIN accounts on accounts.id = cases.account_id WHERE accounts.id='" . $recordId . "' AND cases.deleted=0 AND inv_inventions.deleted=0 AND accounts.deleted=0 group by inv_inventions.id";
        $resultInvention = $db->query($query_invention);
        $html.= '<table width="100%" border="0" cellpadding="0">';
        while ($rowInvention = $db->fetchByAssoc($resultInvention)) {
            $inventionId = $rowInvention['inventionId'];

            $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Invention  :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $html .= "<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DInv_Inventions%26action%3DDetailView%26record%3D" . $inventionId . "' title='Click To See The Details Of Invantions'><b>" . $rowInvention['inventionTitle'] . '</b></a></p></td></tr>';
            $html .= '<tr><th width="13%" colspan="3" >Case Docket Number</th><th width="10%" colspan="3">Case Status</th><th width="10%" colspan="3">Case Type</th>';
            $html .= '<th width="10%" colspan="3">Due Date</th><th width="10%" colspan="3">Priority Date</th><th width="10%" colspan="3">Completion Date</th><th width="10%" colspan="3">Filing Date</th><th width="10%" colspan="3">Application #</th>';
            $html .= '<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
            $queryDisplayRecord = "SELECT  cases.id as caseId, 
                cases.name as caseName,
                cases.case_number as caseDocketNumber,
                c_case_type.name as caseType, cases.case_type_title,
                c_case_status.name as caseStatus,
                cases.application_number as applicationNumber,
                cases.filing_date as filingDate,
                cases.case_end_date as completeDate,
                cases.prioritydate as priorityDate,
                cases.due_date as dueDate,
                cases.date_entered as date 
                FROM cases  JOIN c_case_status ON cases.status = c_case_status.id 
                LEFT JOIN c_case_type ON cases.type = c_case_type.id
                WHERE cases.account_id ='" . $recordId . "' AND cases.invention_id='" . $inventionId . "' AND cases.deleted = 0 ORDER BY cases.date_entered DESC";

            $resultDisplayRecord = $db->query($queryDisplayRecord);
            while ($rowDisplayRecord = $db->fetchByAssoc($resultDisplayRecord)) {
                $caseName = $rowDisplayRecord['caseName'];
                $caseId = $rowDisplayRecord['caseId'];
                $caseDocketNumber = $rowDisplayRecord['caseDocketNumber'];

                //$caseType= $rowDisplayRecord['caseType'];
                // Added By Basudeba Rath, Date : 29-May-2012.

                if ($rowDisplayRecord['case_type_title'] != "") {
                    $caseType = $rowDisplayRecord['caseType'] . " (" . $rowDisplayRecord['case_type_title'] . ")";
                } else {
                    $caseType = $rowDisplayRecord['caseType'];
                }

                $caseStatus = $rowDisplayRecord['caseStatus'];
                $applicationNumber = $rowDisplayRecord['applicationNumber'];
                //$filingDate= $rowDisplayRecord['filingDate'];
                #Rajesh G - 11-07-2012
                $filingDate = ($rowDisplayRecord['filingDate'] == "0000-00-00" || $rowDisplayRecord['filingDate'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['filingDate']));
                $completeDate = $rowDisplayRecord['completeDate'];
                $priorityDate = $rowDisplayRecord['priorityDate'];
                //$dueDate = $rowDisplayRecord['dueDate'];
				#Rajesh G - 13-07-2012
                $dueDate = ($rowDisplayRecord['dueDate'] == "0000-00-00" || $rowDisplayRecord['dueDate'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['dueDate']));
                $html .= '<tr>';
                $html .= '<td width="10%" colspan="3">';
                if (($caseStatus == 'Abandoned') || ($caseStatus == 'Completed')) {
                    $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'Not Started') {
                    $html .= "<a  style='color:#CC9933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'To Search') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'In Progress') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'To Prepare') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'Reported to Client') {
                    $html .= "<a  style='color:#0099FF' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif (($caseStatus == 'To Send')) {
                    $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'Client Review') {
                    $html .= "<a style='color:#3366CC' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'To File') {
                    $html .= "<a style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } elseif ($caseStatus == 'Filed') {
                    $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                } else {
                    $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'><p><dd>";
                    $html .= $caseDocketNumber . "</a></p></dd>";
                }
                $html .= '<td width="10%" colspan="3">' . $caseStatus . '</td>';
                $html .= '</td><td width="10%" colspan="3">' . $caseType . '</td>';
                if (($caseStatus == 'Abandoned') || ($caseStatus == 'Completed')) {
                    $dueDate = "";
                    $html .= '<td width="10%" colspan="3">' . $dueDate . '</td>';
                } else {
                    $html .= '<td width="10%" colspan="3">' . $dueDate . '</td>';
                }
                if (isset($priorityDate)) {
                    $html .= '<td width="10%" colspan="3">' . date("m/d/Y", strtotime($priorityDate)) . '</td>';
                } else {
                    $html .= '<td width="10%" colspan="3">' . $priorityDate . '</td>';
                }
                if (isset($completeDate)) {
                    $html .= '<td width="10%" colspan="3">' . date("m/d/Y", strtotime($completeDate)) . '</td>';
                } else {
                    $html .= '<td width="10%" colspan="3">' . $completeDate . '</td>';
                }
                if (isset($filingDate)) {
                    $html .= '<td width="10%" colspan="3">' . $filingDate . '</td>';
                } else {
                    $html .= '<td width="10%" colspan="3">' . $filingDate . '</td>';
                }
                $html .= '<td width="10%" colspan="3">' . $applicationNumber . '</td></tr>';
                $query_rel = " SELECT oa_officeactions.name as officeName,oa_officeactions.id as officeId,
                    oa_officeactions.subcase_name as subcase_type_id,oa_officeactions.subcase_status_id as subcase_status_id,
					oa_officeactions.sub_case_title,
                    oa_officeactions.filing_date as filing_date,oa_officeactions.duedate as dueDate 
                    FROM oa_officeactions 
                    JOIN  oa_officeactions_cases_c  ON oa_officeactions_cases_c.oa_officeactions_casesoa_officeactions_idb=oa_officeactions.id WHERE oa_officeactions_cases_c.oa_officeactions_casescases_ida='" . $caseId . "' AND oa_officeactions.deleted=0  AND oa_officeactions_cases_c.deleted=0  ";
                $resultRel = $db->query($query_rel);
                while ($rowRel = $db->fetchByAssoc($resultRel)) {
                    $officeName = $rowRel['officeName'];
                    $officeId = $rowRel['officeId'];
                    //$dueDateSubCase = $rowRel['dueDate'];
					#Rajesh G - 13-07-2012
                    $dueDateSubCase = ($rowRel['dueDate'] == "0000-00-00" || $rowRel['dueDate'] == "") ? '' : date("m/d/Y", strtotime($rowRel['dueDate']));
                    //anuradha on 5/3/2012
                    //get subcase type
                    $get_subcase_type = "SELECT * FROM sc_sc_subcasetype WHERE id='" . $rowRel['subcase_type_id'] . "' AND deleted=0 ";
                    $get_subcase_type = $db->query($get_subcase_type);
                    $row_subcase_type = $db->fetchByAssoc($get_subcase_type);
                    //get subcase status
                    $get_subcase_status = "SELECT * FROM c_case_status WHERE id='" . $rowRel['subcase_status_id'] . "' AND deleted=0 ";
                    $get_subcase_status = $db->query($get_subcase_status);
                    $row_subcase = $db->fetchByAssoc($get_subcase_status);
                    $subcase_status = $row_subcase['name'];
                    $html .= '<tr><td width="13%" colspan="3" scope="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

                    if ($subcase_status == "Abandoned" || $subcase_status == "Completed") {
                        $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } else if ($subcase_status == 'Not Started') {
                        $html .= "<a  style='color:#CC9933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif ($subcase_status == 'In Progress') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif ($subcase_status == 'To Prepare') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif ($subcase_status == 'To File') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif (($subcase_status == 'To Send')) {
                        $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif (($subcase_status == 'Filed')) {
                        $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } elseif ($subcase_status == 'Client Review') {
                        $html .= "<a style='color:#3366CC' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    } else {
                        $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                        $html .= $officeName . "</a>";
                    }
                    //end
                    $html .= '</td><td width="10%" colspan="3" scope="row" style="text-align:left;">' . $row_subcase['name'] . '</td>';
                    //by anuradha 23/8/2012
					$html .= '<td width="10%" colspan="3" scope="row" style="text-align:left;">' . $row_subcase_type['name'] .'('.$rowRel['sub_case_title'].')</td>';
					
                    if ($subcase_status == "Abandoned" || $subcase_status == "Completed") {
                        $dueDateSubCase = "";
                        $html .= '<td width="10%" colspan="3" style="text-align:left;">' . $dueDateSubCase . '</td>';
                    } else {
                        $html .= '<td width="10%" colspan="3" scope="row" style="text-align:left;">' . $dueDateSubCase . '</td>';
                    }
                    // $html .= '<td width="10%" colspan="3" scope="row">'.$rowRel['dueDate'].'</td>'; 
                    $html .= '<td width="10%" colspan="3" scope="row" style="text-align:left;"></td>';
                    $html .= '<td width="10%" colspan="3" scope="row" style="text-align:left;"></td>';
                    $filing_date = ($rowRel['filing_date'] == '0000-00-00' || $rowRel['filing_date'] == '') ? '' : date("m/d/Y", strtotime($rowRel['filing_date']));
                    $html .= '<td width="10%" colspan="3" style="text-align:left;">' . $filing_date . '</td>';
                    $html .= '<td width="10%" colspan="3" scope="row" style="text-align:left;"></td></tr>';
                }
            }
        }$html .= '</table></tr>';
        $html .= '</table>';
        $html .= '</table>';
        $this->ss->assign("CLIENT_RECORD_DISPLAY", $html);
        /*         * *******************************EoC*Dated:02-01-2012*********************************************************** */


        /*
          Author : Phaneendra
          Created By: veon
          Dated: 05-03-2012
          Modified: 05-03-2012
          Desc:  Client Record Display
         */
        global $db;
        $recordId = $_REQUEST['record'];

        $html = '';
        $html .= '</td></tr> <table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        $html .= '<tr><td  width="20.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4">Cases</font></td><td width="40.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4"><a href="index.php?module=trade_trademark&action=EditView&return_module=Accounts&trade_trademark_accountsaccounts_ida=' . $recordId . '&trade_trademark_accounts_name=' . $this->bean->name . '&return_action=DetailView&return_id=' . $recordId . '" title="Click To Create Trademark">Create Trademark </a>&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;<a href="index.php?module=Cases&action=EditView&return_module=Accounts&account_id=' . $recordId . '&account_name=' . $this->bean->name . '&consultant_id=' . $this->bean->assigned_user_id . '&return_action=DetailView&return_id=' . $recordId . '" title="Click To Create Cases">Create Case</a></font></td></tr></table>';

        $query_trademark = "SELECT trade_trademark.name as trademarkTitle,trade_trademark.id as trademarkId, cases.name as casesName FROM trade_trademark JOIN  trade_trademark_cases_c as ttcc ON trade_trademark.id=ttcc.trade_trademark_casestrade_trademark_ida JOIN cases ON ttcc.trade_trademark_casescases_idb=cases.id JOIN trade_trademark_accounts_c as ttac ON ttac.trade_trademark_accountstrade_trademark_idb =trade_trademark.id JOIN accounts ON accounts.id=ttac.trade_trademark_accountsaccounts_ida  WHERE  accounts.id='" . $recordId . "' AND ttcc.deleted=0 and cases.deleted=0 and trade_trademark.deleted=0 and accounts.deleted=0 and ttac.deleted=0 group by trade_trademark.id";

        $resultTrademark = $db->query($query_trademark);
        $html.= '<table width="100%" border="0" cellpadding="0">';
        $trademarkTitle = array();
        $trademarkId = array();
        while ($rowTrademark = $db->fetchByAssoc($resultTrademark)) {
            $trademarkId[] = $rowTrademark['trademarkId'];
            $trademarkTitle[] = $rowTrademark['trademarkTitle'];
        }

        $queryDisplayTrademarkRecord = "SELECT trade_trademark.name,trade_trademark.id  FROM `trade_trademark` JOIN trade_trademark_accounts_c ttac ON trade_trademark.id=ttac.trade_trademark_accountstrade_trademark_idb JOIN accounts ON accounts.id=ttac.trade_trademark_accountsaccounts_ida WHERE accounts.id='" . $recordId . "' AND accounts.deleted=0 and ttac.deleted=0 and trade_trademark.deleted=0";
        $resultDisplayTrademarkRecord = $db->query($queryDisplayTrademarkRecord);
        $trademarkName = array();
        $traId = array();
        while ($rowDisplayRecord1 = $db->fetchByAssoc($resultDisplayTrademarkRecord)) {
            $trademarkName[] = $rowDisplayRecord1['name'];
            $traId[] = $rowDisplayRecord1['id'];
        }

        $trademark = array_diff($trademarkName, $trademarkTitle);
        $tid = array_diff($traId, $trademarkId);
        foreach ($trademark as $tdn) {
            $tdnname[] = $tdn;
        }
        foreach ($tid as $trid) {
            $trmid[] = $trid;
        }
        /* foreach ($trademark as $tdm){
          $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Trademark Name :'.$tdm.'</p></b></td></tr>';
          } */

        $html .='<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        for ($i = 0; $i < count($tdnname); $i++) {
            // $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Invention Name :'.$invname[$i].'</p></b></td></tr>';  
            $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Trademark :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $html .= "<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Dtrade_trademark%26action%3DDetailView%26record%3D" . $trmid[$i] . "' title='Click To See The Details Of Trademark'><b>" . $tdnname[$i] . '</b></a></p></td></tr>';
        }

        $query_trademark = "SELECT trade_trademark.name as trademarkTitle,trade_trademark.id as trademarkId, cases.name as casesName FROM trade_trademark JOIN  trade_trademark_cases_c as ttcc ON trade_trademark.id=ttcc.trade_trademark_casestrade_trademark_ida JOIN cases ON ttcc.trade_trademark_casescases_idb=cases.id JOIN trade_trademark_accounts_c as ttac ON ttac.trade_trademark_accountstrade_trademark_idb =trade_trademark.id JOIN accounts ON accounts.id=ttac.trade_trademark_accountsaccounts_ida  WHERE  accounts.id='" . $recordId . "' AND ttcc.deleted=0 and cases.deleted=0 and trade_trademark.deleted=0 and accounts.deleted=0 and ttac.deleted=0 group by trade_trademark.id";

        $resultTrademark = $db->query($query_trademark);
        $html.= '<table width="100%" border="0" cellpadding="0">';
        while ($rowTrademark = $db->fetchByAssoc($resultTrademark)) {
            $trademarkId = $rowTrademark['trademarkId'];
            $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Trademark :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $html .= "<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Dtrade_trademark%26action%3DDetailView%26record%3D" . $trademarkId . "' title='Click To See The Details Of Trademark'><b>" . $rowTrademark['trademarkTitle'] . '</b></a></p></td></tr>';
            $html .= '<tr><th width="10%" colspan="3" >Case Docket Number</th><th width="10%" colspan="3">Case Type</th><th width="10%" colspan="3">Case Status</th>';
            $html .= '<th width="10%" colspan="3">Application Number</th><th width="10%" colspan="3">Filing Date</th><th width="10%" colspan="3">Due Date</th><th width="10%" colspan="3">Completion Date</th>';
            $html .= '<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
            $queryDisplayRecord = "SELECT   cases.id as caseId, 
                cases.name as caseName,cases.case_type_title,
                cases.case_number as caseDocketNumber,
                c_case_type.name as caseType, 
                c_case_status.name as caseStatus,
                cases.tm_application_number as applicationNumber,
                cases.tm_filing_date as filingDate,
                cases.due_date,
                cases.case_end_date as completionDate
                FROM cases  JOIN c_case_status ON cases.status = c_case_status.id 
                LEFT JOIN c_case_type ON cases.type = c_case_type.id 
                JOIN trade_trademark_cases_c ttcc ON ttcc.trade_trademark_casescases_idb =cases.id
                JOIN trade_trademark ON trade_trademark.id=ttcc.trade_trademark_casestrade_trademark_ida  
                WHERE cases.account_id ='" . $recordId . "' AND trade_trademark.id='" . $trademarkId . "' AND cases.deleted = 0";

            $resultDisplayRecord = $db->query($queryDisplayRecord);
            while ($rowDisplayRecord = $db->fetchByAssoc($resultDisplayRecord)) {
                $caseName = $rowDisplayRecord['caseName'];
                $caseId = $rowDisplayRecord['caseId'];
                $caseDocketNumber = $rowDisplayRecord['caseDocketNumber'];

                //$caseType= $rowDisplayRecord['caseType'];
                // Added By Basudeba Rath, Date : 29-May-2012.

                if ($rowDisplayRecord['case_type_title'] != "") {
                    $caseType = $rowDisplayRecord['caseType'] . " (" . $rowDisplayRecord['case_type_title'] . ")";
                } else {
                    $caseType = $rowDisplayRecord['caseType'];
                }

                $caseStatus = $rowDisplayRecord['caseStatus'];
                $applicationNumber = $rowDisplayRecord['applicationNumber'];
                //$filingDate = $rowDisplayRecord['filingDate'];
                #Rajesh G - 11-07-2012
                $filingDate = ($rowDisplayRecord['filingDate'] == "0000-00-00" || $rowDisplayRecord['filingDate'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['filingDate']));
                $due_date = ($rowDisplayRecord['due_date'] == "0000-00-00" || $rowDisplayRecord['due_date'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['due_date']));
                $completion_date = ($rowDisplayRecord['completionDate'] == "0000-00-00" || $rowDisplayRecord['completionDate'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['completionDate']));
                $html .= '<tr>';
                $html .= '<td width="10%" colspan="3">';
                if (($caseStatus == 'Abandoned') || ($caseStatus == 'Completed')) {
                    $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'Not Started') {
                    $html .= "<a  style='color:#CC9933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'To Search') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'In Progress') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'To Prepare') {
                    $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'Reported to Client') {
                    $html .= "<a  style='color:#0099FF' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif (($caseStatus == 'To Send')) {
                    $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'Client Review') {
                    $html .= "<a style='color:#3366CC' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'To File') {
                    $html .= "<a style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } elseif ($caseStatus == 'Filed') {
                    $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                } else {
                    $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                    $html .= $caseDocketNumber . "</a>";
                }
                $html .= '</td><td width="10%" colspan="3">' . $caseType . '</td>';
                $html .= '<td width="10%" colspan="3">' . $caseStatus . '</td>';
                $html .= '<td width="10%" colspan="3">' . $applicationNumber . '</td>';
                $html .= '<td width="10%" colspan="3">' . $filingDate . '</td>';
                $html .= '<td width="10%" colspan="3">' . $due_date . '</td>';
                $html .= '<td width="10%" colspan="3">' . $completion_date . '</td></tr>';
                $query_rel = " SELECT
                    oa_officeactions.id AS officeId,
                    oa_officeactions.`name` AS officeName,
                    oa_officeactions.duedate,
                    oa_officeactions.officeactiontype,
                    oa_officeactions.filing_date,
                    oa_officeactions.application_number,
                    oa_officeactions.subcase_number,
                    oa_officeactions.case_end_date,
                    oa_officeactions.sub_case_title,
                    c_case_status.`name` AS status_name,
                    sc_sc_subcasetype.`name` AS sub_case_type
                    FROM oa_officeactions
                    JOIN oa_officeactions_cases_c ON oa_officeactions_cases_c.oa_officeactions_casesoa_officeactions_idb = oa_officeactions.id
                    INNER JOIN c_case_status ON c_case_status.id = oa_officeactions.subcase_status_id
                    INNER JOIN sc_sc_subcasetype ON sc_sc_subcasetype.id = oa_officeactions.subcase_name
                    WHERE oa_officeactions_cases_c.oa_officeactions_casescases_ida='" . $caseId . "' AND 
                    oa_officeactions.deleted=0 AND oa_officeactions_cases_c.deleted=0 ";
                
                $resultRel = $db->query($query_rel);
                while ($rowRel = $db->fetchByAssoc($resultRel)) {
                    $officeName = $rowRel['officeName'];
                    $officeId = $rowRel['officeId'];
                    $oa_type = $rowRel['sub_case_type'];
                    $oa_status = $rowRel['status_name'];
                    $oa_app_num = $rowRel['application_number'];
                    $oa_filingDate = ($rowRel['filing_date'] == "0000-00-00" || $rowRel['filing_date'] == "") ? '' : date("m/d/Y", strtotime($rowRel['filing_date']));
                    $oa_due_date = ($rowRel['duedate'] == "0000-00-00" || $rowRel['duedate'] == "") ? '' : date("m/d/Y", strtotime($rowRel['duedate']));
                    $oa_completion_date = ($rowRel['case_end_date'] == "0000-00-00" || $rowRel['case_end_date'] == "") ? '' : date("m/d/Y", strtotime($rowRel['case_end_date']));
                    /**
                     * Rajesh G - 27/08/12
                     * offfice action names
                     * colors.....
                     */
                    $html .= "<tr><td width='10%' colspan='3' scope='row'>";
                        if (($oa_status == 'Abandoned') || ($oa_status == 'Completed')) {
                        $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'Not Started') {
                        $html .= "<a  style='color:#CC9933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'To Search') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'In Progress') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'To Prepare') {
                        $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'Reported to Client') {
                        $html .= "<a  style='color:#0099FF' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif (($oa_status == 'To Send')) {
                        $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'Client Review') {
                        $html .= "<a style='color:#3366CC' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'To File') {
                        $html .= "<a style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } elseif ($oa_status == 'Filed') {
                        $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    } else {
                        $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a>";
                    }
                    $html .= "</td>";#Office Record:
//                    $html .= "<tr><td width='10%' colspan='3' scope='row'><a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>".$officeName."</a></td>";#Office Record:
                    $html .= "<td width='10%' colspan=3' scope=row>".$oa_type ."(".$rowRel['sub_case_title'].")</td>";
                    $html .=  '<td width="10%" colspan="3" scope="row">'.$oa_status.'</td>
                        <td width="10%" colspan="3" scope="row">'.$oa_app_num.'</td>
                        <td width="10%" colspan="3" scope="row">'.$oa_filingDate.'</td>
                        <td width="10%" colspan="3" scope="row">'.$oa_due_date.'</td>
                        <td width="10%" colspan="3" scope="row">'.$oa_completion_date.'</td>
                        </tr>';
                }
            }
        }
        $html .= '</tr></table>';
        $html .= '</tr></table>';
        $html .= '</table></tr>';
        $html .= '</table>';
        $html .= '</table>';
        $this->ss->assign("CLIENT_TRADEMARK_RECORD_DISPLAY", $html);
        /*         * *******************************EoC*Dated:02-01-2012*********************************************************** */

        /*
          Author : Basudeba
          Created By: veon consulting.
          Dated: 09-Mar-2012
          Desc:  Client Record Display
         */
        global $db;
        $recordId = $_REQUEST['record'];

        $html = '';
        $html .= '</td></tr> <table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        $html .= '<tr><td  width="20.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4">Cases</font></td><td width="40.5%" colspan="0"  style=" background-color:#C0C0C0"><font size="4"><a href="index.php?module=Cases&action=EditView&return_module=Accounts&account_id=' . $recordId . '&account_name=' . $this->bean->name . '&consultant_id=' . $this->bean->assigned_user_id . '&return_action=DetailView&return_id=' . $recordId . '" title="Click To Create Cases">Create Case</a></font></td></tr></table>';


        $html .='<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';

        $html .= '<tr><td width="10%" colspan="0" STYLE="color :#FFFFFF;background-color :#C0CCCC"><p align="left"><b>Others :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';

        $html .= '<tr><th width="10%" colspan="3" >Case Docket Number</th><th width="10%" colspan="3">Case Type</th><th width="10%" colspan="3">Case Status</th>';
        $html .= '<th width="10%" colspan="3">Application Number</th><th width="10%" colspan="3">Filing Date</th>';
        $html .= '<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">';
        $queryDisplayRecord = "SELECT   cases.id as caseId, 
            cases.name as caseName,cases.case_type_title,
            cases.case_number as caseDocketNumber,
            c_case_type.name as caseType, 
            c_case_status.name as caseStatus,
            cases.application_number as applicationNumber,
            cases.filing_date as filingDate 
            FROM cases  JOIN c_case_status ON cases.status = c_case_status.id 
            LEFT JOIN c_case_type ON cases.type = c_case_type.id 
            WHERE cases.account_id ='" . $recordId . "'  AND cases.relatedtoparent='' AND c_case_type.name='Other'  AND cases.deleted = 0";

        $resultDisplayRecord = $db->query($queryDisplayRecord);
        while ($rowDisplayRecord = $db->fetchByAssoc($resultDisplayRecord)) {
            $caseName = $rowDisplayRecord['caseName'];
            $caseId = $rowDisplayRecord['caseId'];
            $caseDocketNumber = $rowDisplayRecord['caseDocketNumber'];

            // Added By Basudeba Rath, Date : 29-May-2012.

            if ($rowDisplayRecord['case_type_title'] != "") {
                $caseType = $rowDisplayRecord['caseType'] . " (" . $rowDisplayRecord['case_type_title'] . ")";
            } else {
                $caseType = $rowDisplayRecord['caseType'];
            }

            $caseStatus = $rowDisplayRecord['caseStatus'];
            $applicationNumber = $rowDisplayRecord['applicationNumber'];
            //$filingDate = $rowDisplayRecord['filingDate'];
            #Rajesh G - 11-07-2012
                $filingDate = ($rowDisplayRecord['filingDate'] == "0000-00-00" || $rowDisplayRecord['filingDate'] == "") ? '' : date("m/d/Y", strtotime($rowDisplayRecord['filingDate']));


            $html .= '<tr>';
            $html .= '<td width="10%" colspan="3">';
            if (($caseStatus == 'Abandoned') || ($caseStatus == 'Completed')) {
                $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'Not Started') {
                $html .= "<a  style='color:#CC9933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'To Search') {
                $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'In Progress') {
                $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'To Prepare') {
                $html .= "<a  style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'Reported to Client') {
                $html .= "<a  style='color:#0099FF' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif (($caseStatus == 'To Send')) {
                $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'Client Review') {
                $html .= "<a style='color:#3366CC' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'To File') {
                $html .= "<a style='color:#339933' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } elseif ($caseStatus == 'Filed') {
                $html .= "<a style='color:#FF0000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            } else {
                $html .= "<a style='color:#000000' href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DCases%26action%3DDetailView%26record%3D" . $caseId . "'>";
                $html .= $caseDocketNumber . "</a>";
            }
            $html .= '</td><td width="10%" colspan="3">' . $caseType . '</td>';
            $html .= '<td width="10%" colspan="3">' . $caseStatus . '</td>';
            $html .= '<td width="10%" colspan="3">' . $applicationNumber . '</td>';
            $html .= '<td width="10%" colspan="3">' . $filingDate . '</td></tr>';
            $query_rel = " SELECT oa_officeactions.name as officeName,oa_officeactions.id as officeId  FROM oa_officeactions JOIN  oa_officeactions_cases_c  ON oa_officeactions_cases_c.oa_officeactions_casesoa_officeactions_idb=oa_officeactions.id WHERE oa_officeactions_cases_c.oa_officeactions_casescases_ida='" . $caseId . "' AND oa_officeactions.deleted=0  AND oa_officeactions_cases_c.deleted=0  ";
            $resultRel = $db->query($query_rel);
            while ($rowRel = $db->fetchByAssoc($resultRel)) {
                $officeName = $rowRel['officeName'];
                $officeId = $rowRel['officeId'];
                $html .= '<tr><td width="10%" colspan="3" scope="row">Office Record:</td><td width="10%" colspan="3" scope="row">';
                $html .= "<a href='index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3Doa_officeactions%26action%3DDetailView%26record%3D" . $officeId . "'>";
                $html .= $officeName . '</a><td width="10%" colspan="3" scope="row"></td><td width="10%" colspan="3" scope="row"></td><td width="10%" colspan="3" scope="row"></td></tr>';
            }
        }
        $html .= '</tr></table>';
        $html .= '</tr></table>';
        $html .= '</table></tr>';
        $html .= '</table>';
        $html .= '</table>';
        $this->ss->assign("CLIENT_OTHERS_RECORD_DISPLAY", $html);
        /*         * *******************************EoC*Dated:10-march-2012*********************************************************** */


        echo $this->dv->display();
    }

}

?>
