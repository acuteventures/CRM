<script language="javascript" type="text/javascript">

	xmlHttpCaseTypes1 = "";
	
	function getCaseTypes1(){
		var rp = document.getElementById("relatedtoparent").value;
		var url = "GetCaseTypes.php?rp="+rp;
		if (window.XMLHttpRequest){
		    
			xmlHttpCaseTypes1 = new XMLHttpRequest();
		}
		else{
		  	
			xmlHttpCaseTypes1 = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		xmlHttpCaseTypes1.open("Get",url,true);
		xmlHttpCaseTypes1.onreadystatechange = caseTypeList1;
		xmlHttpCaseTypes1.send(null);		
	}
	function caseTypeList1()
	{
		if(xmlHttpCaseTypes1.readyState == 4)
		{
			if(xmlHttpCaseTypes1.status == 200)
			{
				var resText = xmlHttpCaseTypes1.responseText;
				if(resText != ""){
					document.getElementById('type').innerHTML = resText;
				}
				
			}
		}
	}

</script>

<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
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
 ********************************************************************************/
 
 // AUTHOR : BASUDEBA RATH
 // DATE:    16-DEC-2011
 // VEON CONSULTING PVT. LTD.
 
/* 
global $db;

$sql_caseType = "SELECT * FROM `c_case_type` WHERE deleted = '0'";
$res_caseType = $db->query($sql_caseType);
$cs_types = "<option></option>";
while($row_types = $db->fetchByAssoc($res_caseType)){
	
	$cs_types .= "<option value= ".$row_types['id'].">".$row_types['name']."</option>";
}
*/

$viewdefs['Cases']['QuickCreate'] = array(
'templateMeta' => array('maxColumns' => '2', 
                        'widths' => array(
                                        array('label' => '10', 'field' => '30'), 
                                        array('label' => '10', 'field' => '30')
                                        ),
                       ),
'panels' =>

array (
  
  array (
    //array ('name'=>'name', 'displayParams'=>array('size'=>65, 'required'=>true)),
    'priority',
  ),
  
  array (
    // Basudeba Rath, Date : 30-Jan-2012.	
	array(
		'name'=>'case_number',
		'customCode' => '<input type = "text" id = "case_number" name = "case_number" value = "{$CS_NO}" readonly = true />',
	),
    array(
		'name'=>'account_name',
		'customCode' => '<input type="text"  value="{$ACC_SUBPANEL_NAME}" id="account_name" name="account_name" readonly = true /><input id="account_id" type="hidden" value="{$ACC_SUBPANEL_ID}" name="account_id" />',

	),
	
  ),
  
  array (
  	array(
    	'name' => 'assigned_user_name',
	),
	array (
			'name' => 'relatedtoparent',
			'customCode' => '<select id = "relatedtoparent" name = "relatedtoparent" onchange = "getCaseTypes1();">"{$REL_PARENT}"</select>',
	),
  ),
  
  array (
    array (
      'name' => 'description',
      'displayParams' => array ('rows' => '4','cols' => '60'),
      'nl2br' => true,
    ),
	array(
			 'name' =>'type',
			 'customCode' => '<select id = "type" name = "type" >{$PANEL_CS_TYPE}</select>',
	),
  ),

),

);
?>