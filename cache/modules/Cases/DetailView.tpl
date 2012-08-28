

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
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$id}'; this.form.action.value='EditView';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} 
{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value=true; this.form.action.value='EditView'; this.form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} 
{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='ListView'; this.form.action.value='Delete'; return confirm('{$APP.NTC_DELETE_CONFIRMATION}');" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} 
{if $bean->aclAccess("edit") && $bean->aclAccess("delete")}<input title="{$APP.LBL_DUP_MERGE}" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.return_id.value='{$id}'; this.form.action.value='Step1'; this.form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Merge" value="{$APP.LBL_DUP_MERGE}" id="merge_duplicate_button">{/if} 
{$WORKFLOW_BUTTONS}
{$FLAGCASE}
<input type = "hidden" value = "{$USER_ID}" id = "user_id" name = "user_id"><input type = "hidden" value = "{$BEAN_ID}" id = "record_id" name = "record_id" >
</form>
</td>
<td class="buttons" align="left" NOWRAP>
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Cases", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</td>
<td align="right" width="100%">{$ADMIN_EDIT}
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<div id="Cases_detailview_tabs"
>
<div >
<div id='LBL_CASE_INFORMATION' class='detail view  detail508'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>{sugar_translate label='LBL_CASE_INFORMATION' module='Cases'}</h4>
<table id='detailpanel_1' cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.case_number.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_NUMBER' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_number.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.case_number.value) <= 0}
{assign var="value" value=$fields.case_number.default_value }
{else}
{assign var="value" value=$fields.case_number.value }
{/if} 
<span class="sugar_field" id="{$fields.case_number.name}">{$fields.case_number.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.priority.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORITY' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.priority.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.priority.options)}
<input type="hidden" class="sugar_field" id="{$fields.priority.name}" value="{ $fields.priority.options }">
{ $fields.priority.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.priority.name}" value="{ $fields.priority.value }">
{ $fields.priority.options[$fields.priority.value]}
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
{if !$fields.status.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.status.hidden}
{counter name="panelFieldCount"}
<span id="status" class="sugar_field">{$STATUS}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.case_status_age.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_STATUS_AGE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_status_age.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.case_status_age.name}">
{assign var="value" value=$fields.case_status_age.value }
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
{if !$fields.type.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TYPE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.type.hidden}
{counter name="panelFieldCount"}
<span id="type" class="sugar_field">{$TYPE}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.account_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNT_NAME' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.account_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.account_id.value)}
{capture assign="detail_url"}index.php?module=Accounts&action=DetailView&record={$fields.account_id.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="account_id" class="sugar_field">{$fields.account_name.value}</span>
{if !empty($fields.account_id.value)}</a>{/if}
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
{if !$fields.relatedtoparent.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RELATED_TO_PARENT' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.relatedtoparent.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.relatedtoparent.options)}
<input type="hidden" class="sugar_field" id="{$fields.relatedtoparent.name}" value="{ $fields.relatedtoparent.options }">
{ $fields.relatedtoparent.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.relatedtoparent.name}" value="{ $fields.relatedtoparent.value }">
{ $fields.relatedtoparent.options[$fields.relatedtoparent.value]}
{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.search_type.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SEARCH_TYPE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.search_type.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.search_type.options)}
<input type="hidden" class="sugar_field" id="{$fields.search_type.name}" value="{ $fields.search_type.options }">
{ $fields.search_type.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.search_type.name}" value="{ $fields.search_type.value }">
{ $fields.search_type.options[$fields.search_type.value]}
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
{if !$fields.due_date.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DUE_DATE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.due_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.due_date.value) <= 0}
{assign var="value" value=$fields.due_date.default_value }
{else}
{assign var="value" value=$fields.due_date.value }
{/if} 
<span class="sugar_field" id="{$fields.due_date.name}">{$fields.due_date.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.patent_number.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PATENT_NUMBER' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.patent_number.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.patent_number.value) <= 0}
{assign var="value" value=$fields.patent_number.default_value }
{else}
{assign var="value" value=$fields.patent_number.value }
{/if} 
<span class="sugar_field" id="{$fields.patent_number.name}">{$fields.patent_number.value}</span>
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
{if !$fields.trade_trademark_cases_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.trade_trademark_cases_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.trade_trademark_casestrade_trademark_ida.value)}
{capture assign="detail_url"}index.php?module=trade_trademark&action=DetailView&record={$fields.trade_trademark_casestrade_trademark_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="trade_trademark_casestrade_trademark_ida" class="sugar_field">{$fields.trade_trademark_cases_name.value}</span>
{if !empty($fields.trade_trademark_casestrade_trademark_ida.value)}</a>{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.invention_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVENTION_NAME' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.invention_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.invention_id.value)}
{capture assign="detail_url"}index.php?module=Inv_Inventions&action=DetailView&record={$fields.invention_id.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="invention_id" class="sugar_field">{$fields.invention_name.value}</span>
{if !empty($fields.invention_id.value)}</a>{/if}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_START_DATE' module='Cases'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_END_DATE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_end_date.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.case_end_date.value) <= 0}
{assign var="value" value=$fields.case_end_date.default_value }
{else}
{assign var="value" value=$fields.case_end_date.value }
{/if} 
<span class="sugar_field" id="{$fields.case_end_date.name}">{$fields.case_end_date.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='Cases'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_MODIFIED' module='Cases'}{/capture}
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
{if !$fields.case_type_title.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_TYPE_TITLE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.case_type_title.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.case_type_title.value) <= 0}
{assign var="value" value=$fields.case_type_title.default_value }
{else}
{assign var="value" value=$fields.case_type_title.value }
{/if} 
<span class="sugar_field" id="{$fields.case_type_title.name}">{$fields.case_type_title.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.client_consultant_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CLIENT_CONSULTANT_NAME' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.client_consultant_name.hidden}
{counter name="panelFieldCount"}

<span id="client_consultant_id" class="sugar_field">{$fields.client_consultant_name.value}</span>
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
{if !$fields.spec_writing_call.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SPEC_WRITING_CALL' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.spec_writing_call.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.spec_writing_call.value) <= 0}
{assign var="value" value=$fields.spec_writing_call.default_value }
{else}
{assign var="value" value=$fields.spec_writing_call.value }
{/if} 
<span class="sugar_field" id="{$fields.spec_writing_call.name}">{$fields.spec_writing_call.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.patent_drawing_fee.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PATENT_DRAWING_FEE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.patent_drawing_fee.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.patent_drawing_fee.value) <= 0}
{assign var="value" value=$fields.patent_drawing_fee.default_value }
{else}
{assign var="value" value=$fields.patent_drawing_fee.value }
{/if} 
<span class="sugar_field" id="{$fields.patent_drawing_fee.name}">{$fields.patent_drawing_fee.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_PAID' module='Cases'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_QB_DATE' module='Cases'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIMARY_CLIENT_EMAIL' module='Cases'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
{counter name="panelFieldCount"}
<span id="" class="sugar_field">{$PRIMARY_CLIENT_EMAIL}</span>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIMARY_CLIENT_PHONE' module='Cases'}{/capture}
{$label|strip_semicolon}:
</td>
<td width='37.5%'  >
{counter name="panelFieldCount"}
<span id="" class="sugar_field">{$PRIMARY_CLIENT_PHONE}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_MODIFIED_STATUS' module='Cases'}{/capture}
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
<script>document.getElementById("LBL_CASE_INFORMATION").style.display='none';</script>
{/if}
<div id='LBL_PANEL_ASSIGNMENT' class='detail view  detail508'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>{sugar_translate label='LBL_PANEL_ASSIGNMENT' module='Cases'}</h4>
<table id='detailpanel_2' cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.amount_owed.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_OWED' module='Cases'}{/capture}
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
{if !$fields.prioritydate.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORITYDATE' module='Cases'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td width='37.5%'  >
{if !$fields.prioritydate.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.prioritydate.value) <= 0}
{assign var="value" value=$fields.prioritydate.default_value }
{else}
{assign var="value" value=$fields.prioritydate.value }
{/if} 
<span class="sugar_field" id="{$fields.prioritydate.name}">{$fields.prioritydate.value}</span>
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
<script>document.getElementById("LBL_PANEL_ASSIGNMENT").style.display='none';</script>
{/if}
</div></div>

<!--
AUTHOR: BASUDEBA RATH
DATE: 25-Nov-2011
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
<table style="{$DISP_INPUT}"  width="100%">
<tr>
<td width="7%">Filing Date : </td>
<td width="6%">
<input type="text" id="fdate" name="fdate" value="{$FDT}" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger" align="absmiddle" />
</td>
<td width="7%">Application Number : </td>
<td width="5%"><input type="text" id="ano" name="ano" value = "{$ANO}" /></td>
<td width="7%">Filing Receipt : </td>
<td width="5%"><input type="checkbox" id="freceipt" name="freceipt" class="ac_input"/></td>
</tr>
</table>
<table style="{$IP_LBL_PN}" width="100%">
<tr>	
<td width="20%">Publication Number</td>
<td width="15%"><input type="text" id="pp_number" name="pp_number" /></td>
<td width="20%">Issued Number</td>
<td width="15%"><input type="text" id="pi_number" name="pi_number" /></td>
</tr>
</table>
<table style="{$DISPLAY_DET}" width="100%">
<tr>
<td>Filing Date:</td>
<td>{$FDATE}</td>
<td>Application Number :</td>
<td>{$APP_NO}</td>
<td>Filing Receipt : </td>
<td><input type = "checkbox" name = "freceipt" id = "freceipt" {$F_RECEIPT}  disabled="disabled"/></td>
</tr>
</table>
<table style="{$DET_LBL_PN}" width="100%">
<tr>	
<td>Patent Publication Number :</td>
<td>{$PUBLICATION_NO}</td>
<td>Patent Issued Number :</td>
<td>{$ISSUED_NO}</td>
</tr>
</table>
</div>
<div id="tm_app_filed"  class="detail view" style="{$TM_VISIBITY}">
<table>
<tr>
<td align="left"> <h4>{$TM_APPLICATION_FILED}</h4></td>
<td></td>
</tr>
<tr>
</tr>
</table>
<table style="{$DISP_TA_INPUT}">
<tr>
<td>TM Filing Date : </td>
<td>
<input type="text" id="tm_fdate" name="tm_fdate" value="{$TM_FDATE_VAL}" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger1" align="absmiddle" />
</td>
<td>Application Number : </td>
<td><input type="text" id="tm_ano" name="tm_ano" value="{$TM_APP_NO_VAL}" /></td>
<td>TM Classes : </td>
<td>
<select id="tm_classes" name="tm_classes[]" multiple="multiple">
<option value="Chemicals">1: Chemicals</option>
<option value="Paints">2: Paints</option>
<option value="Cosmetics_and_cleaning_preparations">3: Cosmetics and cleaning preparations</option>
<option value="Lubricants_and_fuels">4: Lubricants and fuels</option>
<option value="Pharmaceuticals">5: Pharmaceuticals</option>
<option value="Metal_goods">6: Metal goods</option>
<option value="Machinery">7: Machinery</option>
<option value="Hand_tools">8: Hand tools</option>
<option value="Electrical_and_scientific_apparatus">9: Electrical and scientific apparatus</option>
<option value="Medical_apparatus">10: Medical apparatus</option>
<option value="Environmental_control_apparatus">11: Environmental control apparatus</option>
<option value="Vehicles">12: Vehicles</option>
<option value="Firearms">13: Firearms</option>
<option value="Jewelry">14: Jewelry</option>
<option value="Musical_Instruments">15: Musical Instruments</option>
<option value="Paper_goods_and_printed_matter">16: Paper goods and printed matter</option>
<option value="Rubber_goods">17: Rubber goods</option>
<option value="Leather_goods">18: Leather goods</option>
<option value="Nonmetallic_building_materials">19: Nonmetallic building materials</option>
<option value="Furniture_and_articles_not_otherwise_classified">20: Furniture and articles not otherwise classified</option>
<option value="Housewares_and_glass">21: Housewares and glass</option>
<option value="Cordage_and_fibers">22: Cordage and fibers</option>
<option value="Yarns_and_threads">23: Yarns and threads</option>
<option value="Fabrics">24: Fabrics</option>
<option value="Clothing">25: Clothing</option>
<option value="Fancy_goods">26: Fancy goods</option>
<option value="Floor_coverings">27: Floor coverings</option>
<option value="Toys_sporting_goods">28: Toys and sporting goods</option>
<option value="Meats_and_processed_foods">29: Meats and processed foods</option>
<option value="Staple_foods">30: Staple foods</option>
<option value="Natural_agricultural_products">31: Natural agricultural products</option>
<option value="Light_beverages">32: Light beverages</option>
<option value="Wine_and_spirits">33: Wine and spirits</option>
<option value="Smokers_articles">34: Smokers’ articles</option>
<option value="Advertising_and_business">35: Advertising and business</option>
<option value="Insurance_and_financial">36: Insurance and financial</option>
<option value="Building_construction_and_repair">37: Building construction and repair</option>
<option value="Telecommunications">38: Telecommunications</option>
<option value="Transportation_and_storage">39: Transportation and storage</option>
<option value="Treatment_of_materials">40: Treatment of materials</option>
<option value="Education_and_entertainment">41: Education and entertainment</option>
<option value="Computer_and_scientific">42: Computer and scientific</option>
<option value="Hotels_and_restaurants">43: Hotels and restaurants</option>
<option value="Medical_beauty_agricultural">44: Medical, beauty & agricultural</option>
<option value="Personal">45: Personal</option>
</select>
</td>
</tr>
<tr>
<td>TM Registration Date : </td>
<td>
<input type="text" id="tm_registration_date" name="tm_registration_date"  value = "{$TM_REG_DT_VAL}" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger2" align="absmiddle" />
</td>
<td>Registration No.:</td>
<td><input type="text" id="tm_registration_number" name="tm_registration_number" value="{$TM_REG_NO_VAL}" /></td>
<td></td><td></td>
</tr>
</table>
<table style="{$TM_FILING}" >
<tr>
<td>TM Filing Date:</td>
<td>{$TM_FDATE}</td>
<td>TM Registration Date : </td>
<td>{$TM_REG_DATE}</td>
<td>TM Classes : </td>
<td>{$TM_CLASSES_VALUES}</td>
</tr>
<tr>	
<td>TM Application Number :</td>
<td>{$TM_APP_NO}</td>
<td>Registration No.:</td>
<td>{$TM_REG_NO}</td>
<td></td>
<td></td>
</tr>
</table>
</div>
<div id="contribute" class="detail view">
<b>{$CONTRIBUTE}</b>
{$CONT_LISTS}
<input type="button" name="btn_cont" id="btn_cont" value = "Contribute Case" onclick="contributeCase(this.id);" />
<input type="button" name="btn_assigned" id="btn_assigned" value="Assign to Case"  onclick="open_assign_popup();" {$DIS_BTN_ASSIGNTO} />
</div>
<div id="claim_priority" >
<table>
<tr>
<td scope="row" align="left" colspan="7"><h4>{$CLAIM}</h4></td>
<td></td>
</tr>
</table>
<table width="100%">
<tr>
<td>{$CLAIMED_CASES}</td>
</tr>
</table>
</div>
<!-- Added By Basudeba Rath, Date : 11-Jun-2012. -->
<div id="claimed_priority" >
<table>
<tr>
<td scope="row" align="left" colspan="7"><h4>{$PRIORITY_CLAIMED_BY}</h4></td>
<td></td>
</tr>
</table>
<table width="100%">
<tr>
<td>{$PRIORITY_CLAIM_BY}</td>
</tr>
</table>
</div>
<!--*************************************************-->
<div id="dv_case_history">
<table  border="0" cellpadding="0" cellspacing="{$gridline}">
<tr>
<td scope="row" align="left" colspan="7"><h4>{$CASE_HISTORY}</h4></td>
<td></td>
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
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/WorkFlows.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/CaseHistory.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/popups.js"}"></script>
<script type="text/javascript" src="{sugar_getjspath file="custom/modules/Cases/ClaimPriority.js"}"></script>