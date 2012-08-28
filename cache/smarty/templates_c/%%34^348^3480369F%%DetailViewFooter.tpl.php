<?php /* Smarty version 2.6.11, created on 2012-08-27 11:19:18
         compiled from custom/modules/Accounts/tpls/DetailViewFooter.tpl */ ?>
{*
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Professional Subscription
 * Agreement ("License") which can be viewed at
 * http://www.sugarcrm.com/crm/products/sugar-professional-eula.html
 * By installing or using this file, You have unconditionally agreed to the
 * terms and conditions of the License, and You may not use this file except in
 * compliance with the License.  Under the terms of the license, You shall not,
 * among other things: 1) sublicense, resell, rent, lease, redistribute, assign
 * or otherwise transfer Your rights to the Software, and 2) use the Software
 * for timesharing or service bureau purposes such as hosting the Software for
 * commercial gain and/or for the benefit of a third party.  Use of the Software
 * may be subject to applicable fees and any use of the Software without first
 * paying applicable fees is strictly prohibited.  You do not have the right to
 * remove SugarCRM copyrights from the source code or user interface.
 *
 * All copies of the Covered Code must include on each user interface screen:
 *  (i) the "Powered by SugarCRM" logo and
 *  (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2010 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/
*}
{php}
	//echo "fasdfaS";
	//echo $this->bean->id;
	//$note = new Account();
	//echo "<pre>";
	//print_r($note);
	//echo $_REQUEST['clnt_hist'];
{/php}
{$ID}

<div>
<table width="100%" border="0" cellpadding="0" cellspacing="{$gridline}">
<tr>
	<td scope="row" align="left" colspan="7"><h4>{$CLIENT_HISTORY}</h4></td>
	<td></td>
</tr>
<tr>
	
</tr>
</table>
{$BUTTONS}
	<!-- BEGIN: client_history -->
	<table width="100%">
		<tr>
			<td>{$NOTES}</td>
		</tr>
	</table>
	<input type="hidden" id="beanid" name="beanid" value="{$BEAN_ID}" />
	<input type="hidden" id="userid" name="userid" value="{$USER_ID}" />
	<input type="hidden" id="noteid" name="noteid" value="{$NOTE_ID}" />
	
	<table>	
		<tr>
			<td align="right" width="450"><textarea name="clnt_hist" id="clnt_hist" cols="188" rows="3">{$NOTES_TEXT}</textarea></td>
		</tr>
	</table>
	<table>
		<tr>
			<td ><input type="button" id="btn_clnt"  value="Save" onclick="return callAjax();"></td>
			<td>{$BTN_CANCEL}</td>
			<td><input type="button" id="btn_clear" value="Clear"  onclick="clr();"></td>
		</tr>
	</table>

</div>

<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Accounts/client_history.js"}"></script>