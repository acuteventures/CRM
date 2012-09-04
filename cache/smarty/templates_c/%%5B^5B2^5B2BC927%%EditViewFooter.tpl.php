<?php /* Smarty version 2.6.11, created on 2012-09-04 14:30:47
         compiled from custom/modules/Cases/tpls/EditViewFooter.tpl */ ?>
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
 * by SugarCRM are Copyright (C) 2004-2011 SugarCRM, Inc.; All Rights Reserved.
 ********************************************************************************/

*}
<input type="hidden" id="record_id" name="record_id" value = {$BEAN_ID} />
<input type="hidden" id="client_name_popup" name="client_name_popup" value="{$CLIENT_POPUP_NAME}" />
<input type="hidden" id="client_id_popup" name="client_id_popup" value="{$CLIENT_POPUP_ID}" />

<!--<div id="search_patent" class="edit view" style="{$HIDE_SHOW}">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >

	<tr>
		<td id="heading">{$SEARCH_PATENT}</td>
		<td>
			<input type="hidden" id="record_id" name="record_id" value = {$BEAN_ID} />
		</td>
	</tr>
</table>	
<table >	
	<tr>
		 Date : 16-Jan-2012. Author : Basudeba Rath. 
		
		<input type="hidden" id="client_name_popup" name="client_name_popup" value="{$CLIENT_POPUP_NAME}" />
		<input type="hidden" id="client_id_popup" name="client_id_popup" value="{$CLIENT_POPUP_ID}" />
		
		<td id="lbl_ril" style="{$RIL}">Related To Invention :</td>
		<td id = "ril" style="{$RIL}">
			<input type="text" name="invention_name" class="sqsEnabled" tabindex="103" id="invention_name" size="25" value="{$INVENTION_NAME}" title='' autocomplete="off" >
						
						<input type="hidden" name="invention_id" id="invention_id" value="{$INVENTION_ID}">
			
						<input type="button" name="btn_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick="open_popup('Inv_Inventions', 600, 400, '&inv_inventions_accounts_name='+ document.getElementById('client_name_popup').value+'&inv_inventd1acccounts_ida='+document.getElementById('client_id_popup').value, true, false, {literal}{'call_back_function':'set_return','form_name':'EditView','field_to_name_array':{'id':'invention_id','name':'invention_name'}}{/literal}, 'single', true);this.form.invention_name.focus();">
			
						<input type="button" name="btn_clr_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.invention_name.value = '';this.form.invention_id.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
			
			<script type="text/javascript">
			
				enableQS(false);
			
			</script>
		</td>
		 Date : 16-Jan-2012. 
			
		<td id="lbl_trademark" style="{$TRADEMARK_POPUP}">
			Related To Trademark:
		</td>
		<td id="trademark" style="{$TRADEMARK_POPUP}">
			<input type="text" name="trade_trademark_cases_name" class="sqsEnabled" tabindex="103" id="trade_trademark_cases_name" size="25" value="{$TRADEMARK_DESC}" title='' autocomplete="off">
						
						<input type="hidden" name="trade_trademark_casestrade_trademark_ida" id="trade_trademark_casestrade_trademark_ida" value="{$TRADEMARK_ID}">
			
						<input type="button" name="btn_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick=" open_popup('trade_trademark', 600, 400, '&trade_trademark_accounts_name='+ document.getElementById('client_name_popup').value+'&trade_trademark_accountsaccounts_ida='+document.getElementById('client_id_popup').value,true,false,{literal}{'call_back_function':'set_return','form_name':'EditView','field_to_name_array':{'id':'trade_trademark_casestrade_trademark_ida','name':'trade_trademark_cases_name'}}{/literal}, 'single', true);this.form.login_name.focus();">
					
						<input type="button" name="btn_clr_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.trade_trademark_cases_name.value = '';this.form.trade_trademark_casestrade_trademark_ida.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
			
			<script type="text/javascript">
			
				enableQS(false);
			
			</script>
		</td>
	</tr>	
	<tr>	
		
		<td style="{$SEARCH_TYPE_LABEL}" id="search_type_label"> Search Type : </td>
		<td>
			<select id="search_type" name="search_type" style="{$SERARCHTYPE}"> {$SEARCH_TYPE}</select>
		</td>
		
	</tr>
	
</table>
</div>-->

<input type="hidden" id="user_id" name="user_id" value="{$USER_ID}" />

<div id="UsersPopUp" class="edit view" style="{$USER_LISTS}">

	<table cellspacing="1" cellpadding="0" border="0" width="100%">
			<tr width="100%">
				<th align="left" colspan="8" >
				<h4>Add Users </h4>
				</th>
			</tr>
			<tr width="100%">
			    <td colspan='2'>
				    <table id='item_lines'>
					    <tr width="100%">
						    <td>
							    <table>
								    <tr width="100%">
									
										<th class="dataLabel" width="150"></th>
																		
									</tr>
								</table>
							</td>
						</tr>
						{$ITEM_ROWS}
						
					</table>
				</td>
			</tr>
			<tr width="100%">
				<td width="37.5%" valign="top" colspan="3">
				    <input type="hidden" id="item_count" name="item_count" value="{$item_count}"/>
					<input type="button" onClick="addRow();" title="ADD" value="ADD" class="button" name="button" tabindex="125">&nbsp;&nbsp;
					<input type="button" onClick="removeRow();" title="DELETE" value="DELETE" class="button" name="button" tabindex="125">
				</td>
			</tr>
			<tr width="100%">
				<td  valign="top" scope="row" id="_label">
								
				<div id="item_details" style="display:none;">
				<table id='item_details_table'>
				    <tr width="100%">
					
						<td><input type="text" name="login_name" class="sqsEnabled" tabindex="103" id="login_name" size="25" value="{$LOGIN_DESC}" title='' autocomplete="off">
						
						<input type="hidden" name="login_id" id="login_id" value="{$LOGIN_ID}">
			
						<input type="button" name="btn_user_c" id="btn_user_c" tabindex="103" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick=" open_popup('Users', 600, 400, '', true, false, {literal}{'call_back_function':'set_return','form_name':'EditView','field_to_name_array':{'id':'login_id','name':'login_name'}}{/literal}, 'single', true);this.form.login_name.focus();">
			
						<input type="button" name="btn_clr_login_c" id="btn_clr_user_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.login_name.value = '';this.form.login_id.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
			
			<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script>
					
						</td>						
					</tr>
				</table>
				</div>
				
				</td>
			</tr>			
	</table>
				
</div>

<div class="edit view" style="{$CLAIM_DIV}" id="clim_div">
<table>
		<caption align="left"><h3>Claim Priority</h3></caption>
	<tr>
		<td width="37.5%"><input type = "button"  style="{$BTN_CLAIM}" value = "In Possession" id ="btn_priority" name = "btn_priority" onclick = "openPopup();" /> </td>
	
		<td width="37.5%">
			<input type = "button"  style="{$BTN_CLAIM}" value = "No Possession" id ="btn_np" name = "btn_np" onclick = "popup_no_possession();" /> 

		</td>
	</tr>
	</table>

</div>
<div id="clm_info">
	<input type="hidden" id="clm_edit" name="clm_edit" value="{$CLM_EDIT}" />
	<input type="hidden" id="clm_ids" name="clm_ids" value="" />
	<input type="hidden" id="clm_np_ids" name="clm_np_ids" value="" />
</div>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/popups.js"}"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'include/EditView/footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
