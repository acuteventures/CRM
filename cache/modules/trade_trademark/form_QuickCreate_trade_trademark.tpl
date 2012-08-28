

<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if !empty($smarty.request.return_module) || !empty($smarty.request.relate_to)}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="this.form.action.value='Popup';return check_form('form_QuickCreate_trade_trademark')" type="submit" name="trade_trademark_popupcreate_save_button" id="trade_trademark_popupcreate_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="toggleDisplay('addform');return false;" name="trade_trademark_popup_cancel_button" type="submit"id="trade_trademark_popup_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=trade_trademark", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_QuickCreate_trade_trademark_tabs"
>
<div >
<div id="Default_{$module}_Subpanel">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME' module='trade_trademark'}{/capture}
<label for="name">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if}  
<input type='text' name='{$fields.name.name}' 
id='{$fields.name.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      accesskey='7'  >
<td valign="top" id='trade_trademark_accounts_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_ACCOUNTS_TITLE' module='trade_trademark'}{/capture}
<label for="trade_trademark_accounts_name">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.trade_trademark_accounts_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.trade_trademark_accounts_name.name}" size="" value="{$fields.trade_trademark_accounts_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.trade_trademark_accounts_name.id_name}" 
id="{$fields.trade_trademark_accounts_name.id_name}" 
value="{$fields.trade_trademark_accountsaccounts_ida.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.trade_trademark_accounts_name.name}" id="btn_{$fields.trade_trademark_accounts_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL"}"
onclick='open_popup(
"{$fields.trade_trademark_accounts_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_QuickCreate_trade_trademark","field_to_name_array":{"id":"trade_trademark_accountsaccounts_ida","name":"trade_trademark_accounts_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.trade_trademark_accounts_name.name}" id="btn_clr_{$fields.trade_trademark_accounts_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.trade_trademark_accounts_name.name}', '{$fields.trade_trademark_accounts_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.trade_trademark_accounts_name.name}']) != 'undefined'",
		enableQS
);
</script>
<td valign="top" id='_label' width='%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
<div id="Default_{$module}_Subpanel">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("0").style.display='none';</script>
{/if}
</div></div>

<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="this.form.action.value='Popup';return check_form('form_QuickCreate_trade_trademark')" type="submit" name="trade_trademark_popupcreate_save_button" id="trade_trademark_popupcreate_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="toggleDisplay('addform');return false;" name="trade_trademark_popup_cancel_button" type="submit"id="trade_trademark_popup_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=trade_trademark", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>
</form>
{$set_focus_block}
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>{$overlibStuff}
<script type="text/javascript">
YAHOO.util.Event.onContentReady("form_QuickCreate_trade_trademark",
    function () {ldelim} initEditView(document.forms.form_QuickCreate_trade_trademark) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
</script>{literal}
<script type="text/javascript">
addForm('form_QuickCreate_trade_trademark');addToValidate('form_QuickCreate_trade_trademark', 'name', 'name', true,'{/literal}{sugar_translate label='LBL_NAME' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'date_entered_date', 'date', false,'Date Created' );
addToValidate('form_QuickCreate_trade_trademark', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('form_QuickCreate_trade_trademark', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='trade_trademark' for_js=true}{literal}' );
addToValidate('form_QuickCreate_trade_trademark', 'trade_trademark_accounts_name', 'relate', false,'{/literal}{sugar_translate label='LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_ACCOUNTS_TITLE' module='trade_trademark' for_js=true}{literal}' );
addToValidateBinaryDependency('form_QuickCreate_trade_trademark', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='trade_trademark' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='trade_trademark' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('form_QuickCreate_trade_trademark', 'trade_trademark_accounts_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='trade_trademark' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_ACCOUNTS_TITLE' module='trade_trademark' for_js=true}{literal}', 'trade_trademark_accountsaccounts_ida' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_QuickCreate_trade_trademark_trade_trademark_accounts_name']={"form":"form_QuickCreate_trade_trademark","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["form_QuickCreate_trade_trademark_trade_trademark_accounts_name","trade_trademark_accountsaccounts_ida"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["trade_trademark_accountsaccounts_ida"],"order":"name","limit":"30","no_match_text":"No Match"};</script>{/literal}
