

<table cellpadding="1" cellspacing="0" border="0" width="100%" class="actionsContainer">
<tr>
<td class="buttons" align="left" NOWRAP>
<form action="index.php" method="post" name="DetailView" id="form">
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="EditView">
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="this.form.return_module.value='oa_officeactions'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$id}'; this.form.action.value='EditView';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} 
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value='oa_officeactions'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value=true; this.form.action.value='EditView'; this.form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} 
{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value='oa_officeactions'; this.form.return_action.value='ListView'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}');" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} 
{if $bean->aclAccess("edit") && $bean->aclAccess("delete")}<input title="{$APP.LBL_DUP_MERGE}" class="button" onclick="this.form.return_module.value='oa_officeactions'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$id}'; this.form.action.value='Step1'; this.form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Merge" value="{$APP.LBL_DUP_MERGE}" id="merge_duplicate_button">{/if} 
{$WORKFLOW_BUTTONS}
<input type = "hidden" value = "{$USER_ID}" id = "user_id" name = "user_id"><input type = "hidden" value = "{$BEAN_ID}" id = "record_id" name = "record_id" ><input type="hidden" value="{$SUBCASE_NUMBER}" id="subcase_number" name="subcase_number" >
</form>
</td>
<td class="buttons" align="left" NOWRAP>
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=oa_officeactions", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</td>
<td align="right" width="100%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="oa_officeactions_detailview_tabs"
>
<div >
<div id='DEFAULT' class='detail view  detail508'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='detailpanel_1' cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
{if !$fields.name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if} 
<span class="sugar_field" id="{$fields.name.name}">{$fields.name.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.description.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.description.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.duedate.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DUEDATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.duedate.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.duedate.value) <= 0}
{assign var="value" value=$fields.duedate.default_value }
{else}
{assign var="value" value=$fields.duedate.value }
{/if} 
<span class="sugar_field" id="{$fields.duedate.name}">{$fields.duedate.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.oa_officeactions_cases_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.oa_officeactions_cases_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.oa_officeactions_casescases_ida.value)}
{capture assign="detail_url"}index.php?module=Cases&action=DetailView&record={$fields.oa_officeactions_casescases_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="oa_officeactions_casescases_ida" class="sugar_field">{$fields.oa_officeactions_cases_name.value}</span>
{if !empty($fields.oa_officeactions_casescases_ida.value)}</a>{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.subcase_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.subcase_name.hidden}
{counter name="panelFieldCount"}
<span id="subcase_name" class="sugar_field">{$SUBCASE_NAME}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.subcase_status_id.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.subcase_status_id.hidden}
{counter name="panelFieldCount"}
<span id="subcase_status_id" class="sugar_field">{$SUBCASE_STATUS_NAME}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PARENT_CASE_CONSULTANT' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
{counter name="panelFieldCount"}
<span id="" class="sugar_field">{$PARENT_CASE_CONSULTANT}</span>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.amount_owed.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_OWED' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.amount_owed.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.amount_owed.name}">
{sugar_number_format var=$fields.amount_owed.value precision=2 }
</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.credit_alloc_notes.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ALLOC_NOTES' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.credit_alloc_notes.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.credit_alloc_notes.name|escape:'html'|url2html|nl2br}">{$fields.credit_alloc_notes.value|escape:'htmlentitydecode'|escape:'html'|url2html|nl2br}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.case_start_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_START_DATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_start_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.case_start_date.value) <= 0}
{assign var="value" value=$fields.case_start_date.default_value }
{else}
{assign var="value" value=$fields.case_start_date.value }
{/if} 
<span class="sugar_field" id="{$fields.case_start_date.name}">{$fields.case_start_date.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.case_end_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_END_DATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_end_date.hidden}
{counter name="panelFieldCount"}
<span id="case_end_date" class="sugar_field">{$fields.case_end_date.value} {$APP.LBL_BY} {$fields.case_end_user_name.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.filing_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FILING_DATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.filing_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.filing_date.value) <= 0}
{assign var="value" value=$fields.filing_date.default_value }
{else}
{assign var="value" value=$fields.filing_date.value }
{/if} 
<span class="sugar_field" id="{$fields.filing_date.name}">{$fields.filing_date.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.subcase_status_age.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_STATUS_AGE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.subcase_status_age.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.subcase_status_age.name}">
{assign var="value" value=$fields.subcase_status_age.value }
{$value}
</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.sub_case_title.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_TITLE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.sub_case_title.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sub_case_title.value) <= 0}
{assign var="value" value=$fields.sub_case_title.default_value }
{else}
{assign var="value" value=$fields.sub_case_title.value }
{/if} 
<span class="sugar_field" id="{$fields.sub_case_title.name}">{$fields.sub_case_title.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.visible_to_client.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VISIBLE_TO_CLIENT' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.visible_to_client.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.visible_to_client.options)}
<input type="hidden" class="sugar_field" id="{$fields.visible_to_client.name}" value="{ $fields.visible_to_client.options }">
{ $fields.visible_to_client.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.visible_to_client.name}" value="{ $fields.visible_to_client.value }">
{ $fields.visible_to_client.options[$fields.visible_to_client.value]}
{/if}
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CLIENT_NAME' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
{counter name="panelFieldCount"}
<span id="" class="sugar_field">{$CLIENT_NAME}</span>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.credit_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CREDIT_DATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.credit_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.credit_date.value) <= 0}
{assign var="value" value=$fields.credit_date.default_value }
{else}
{assign var="value" value=$fields.credit_date.value }
{/if} 
<span class="sugar_field" id="{$fields.credit_date.name}">{$fields.credit_date.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.amount_paid.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_PAID' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.amount_paid.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.amount_paid.name}">
{sugar_number_format var=$fields.amount_paid.value precision=2 }
</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.qb_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_QB_DATE' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.qb_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.qb_date.value) <= 0}
{assign var="value" value=$fields.qb_date.default_value }
{else}
{assign var="value" value=$fields.qb_date.value }
{/if} 
<span class="sugar_field" id="{$fields.qb_date.name}">{$fields.qb_date.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_modified.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_MODIFIED' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.date_modified.hidden}
{counter name="panelFieldCount"}
<span id="date_modified" class="sugar_field">{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.modified_status.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MODIFIED_STATUS' module='oa_officeactions'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%' colspan='3' >
{if !$fields.modified_status.hidden}
{counter name="panelFieldCount"}
<span id="modified_status" class="sugar_field">{$fields.modified_status.value} {$APP.LBL_BY} {$fields.modified_by_name.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0 && !$useTabs}}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
</div></div>

<!--
AUTHOR: BASUDEBA RATH
DATE: 30-DEC-2011
VEON CONSULTING PVT LTD.
-->
<div id="app_filed"  class="detail view" style="{$VISIBITY}" > 
<table >
<tr>
<td align="left"> <h4>{$APPLICATION_FILED}</h4></td>
<td></td>
</tr>
<tr>
</tr>
</table>
<table style="{$DISP_INPUT}">
<tr>
<td>Filing Date : </td>
<td>
<input type="text" id="fdate" name="fdate" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="fdate_trigger" align="absmiddle" />
</td>
<!--<td>Application Number : </td>
<td><input type="text" id="ano" name="ano" /></td>
<td>Filing Receipt : </td>
<td><input type="checkbox" id="freceipt" name="freceipt" class="ac_input"/></td>-->
</tr>
</table>
<table style="{$DISPLAY_DET}" >
<tr>
<td>Filing Date:</td>
<td>{$FDATE}</td>
<!--<td>Application Number :</td>
<td>{$APP_NO}</td>
<td>Filing Receipt : </td>
<td><input type = "checkbox" name = "freceipt" id = "freceipt" {$F_RECEIPT}  disabled="disabled"/></td>-->
</tr>
</table>
</div>
<div id="contribute" class="detail view">
<b>{$CONTRIBUTE}</b>
{$CONT_LISTS}
<input type="button" name="btn_cont" id="btn_cont" value = "Contribute Case" onclick="contributeCase(this.id);" />
<input type="button" name="btn_assigned" id="btn_assigned" value="Assign to Case"  onclick="open_assign_popup();" {$DIS_BTN_ASSIGNTO} />
</div>
<div id="dv_case_history">
<table  border="0" cellpadding="0" cellspacing="{$gridline}">
<tr>
<td scope="row" align="left" colspan="7"><h4>{$CASE_HISTORY}</h4></td>
<td></td>
</tr>
<tr>
</tr>
</table>
{$BUTTONS}
<!-- BEGIN: case_history -->
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
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/oa_officeactions/WorkFlows.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/oa_officeactions/CaseHistory.js"}"></script>