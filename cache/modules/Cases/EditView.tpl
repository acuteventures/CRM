

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
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="{if $isDuplicate}this.form.return_id.value=''; {/if}this.form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(this.form);return false;" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" id="SAVE_HEADER">{/if} 
{if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_HEADER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Cases'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Cases", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="EditView_tabs"
>
<div >
<div id="LBL_CASE_INFORMATION">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
<tr>
<th align="left" colspan="8">
<h4>{sugar_translate label='LBL_CASE_INFORMATION' module='Cases'}</h4>
</th>
</tr>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NUMBER' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey="7"  tabindex="0"  type = "text" name="case_number" value="{$CASECOUNT}" tabindex="1" size="30" maxlength="100" id="case_number"  {$DIS} >&nbsp;&nbsp;
<input accesskey="7"  tabindex="0"  type = "checkbox" title= "Click to Override the Case Number" name="caseoverride" id= "caseoverride" {$CHECKED_CHECK} onclick = "enableCsNo();" {$CHK_DIS} /><input accesskey="7"  tabindex="0"  type = "hidden" id = "case_override" name = "case_override" value = {$CASE_OVERRIDE_VALUE} />
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='relatedtoparent_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_RELATED_TO_PARENT' module='Cases'}{/capture}
<label for="relatedtoparent">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  id = "relatedtoparent" name = "relatedtoparent" onchange = "relateToParent();">{$RELATED_PARENT}</select>
<td valign="top" id='account_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNT_NAME' module='Cases'}{/capture}
<label for="account_name">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type="text" name="account_name" class="sqsEnabled" tabindex="103" id="account_name" size="25" value="{$ACC_DESC}" onblur = "saveClientName();" title='' autocomplete="off"  >
<input accesskey=""  tabindex="0"  type="hidden" name="account_id" id="account_id" value="{$ACC_ID}">
<input accesskey=""  tabindex="0"  type="button" name="btn_account_c" id="btn_account_c" tabindex="103" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick=' open_popup("Accounts", 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"account_id","name":"account_name"}}{/literal}, "single", true);this.form.account_name.focus();'>
<input accesskey=""  tabindex="0"  type="button" name="btn_clr_account_c" id="btn_clr_account_c" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button" onclick="this.form.account_name.value = '';this.form.account_id.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">
<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='type_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TYPE' module='Cases'}{/capture}
<label for="type">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  id = "type" name = "type" onchange = "callFunctions();">{$CASE_TYPE}</select>
<td valign="top" id='status_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Cases'}{/capture}
<label for="status">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  id = "status" name = "status" {$DISABLE} onchange = "populateCurrDate();" >{$CASE_STATUS}</select>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='amount_owed_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_OWED' module='Cases'}{/capture}
<label for="amount_owed">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.amount_owed.value) <= 0}
{assign var="value" value=$fields.amount_owed.default_value }
{else}
{assign var="value" value=$fields.amount_owed.value }
{/if}  
<input type='text' name='{$fields.amount_owed.name}'
id='{$fields.amount_owed.name}'
size='30'
maxlength='25'value='{sugar_number_format var=$value precision=2 }'
title=''
tabindex='0'
>
<td valign="top" id='due_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DUE_DATE' module='Cases'}{/capture}
<label for="due_date">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.due_date.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.due_date.name}" id="{$fields.due_date.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.due_date.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.due_date.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.due_date.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Related to' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<span>{$RELATEPOPUP}</span>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Search Type:' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  id="search_type" name="search_type" style="{$SERARCHTYPE}"> {$SEARCH_TYPE}</select>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='priority_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIORITY' module='Cases'}{/capture}
<label for="priority">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.priority.name}" 
id="{$fields.priority.name}" 
title=''       
>
{if isset($fields.priority.value) && $fields.priority.value != ''}
{html_options options=$fields.priority.options selected=$fields.priority.value}
{else}
{html_options options=$fields.priority.options selected=$fields.priority.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.priority.options }
{capture name="field_val"}{$fields.priority.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.priority.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.priority.name}" 
id="{$fields.priority.name}" 
title=''          
>
{if isset($fields.priority.value) && $fields.priority.value != ''}
{html_options options=$fields.priority.options selected=$fields.priority.value}
{else}
{html_options options=$fields.priority.options selected=$fields.priority.default}
{/if}
</select>
<input
id="{$fields.priority.name}-input"
name="{$fields.priority.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.priority.name}-image"></button><button type="button"
id="btn-clear-{$fields.priority.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.priority.name}-input', '{$fields.priority.name}');sync_{$fields.priority.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.priority.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.priority.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.priority.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.priority.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.priority.name}{literal}");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.priority.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.priority.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.priority.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.priority.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.priority.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
<td valign="top" id='patent_number_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_PATENT_NUMBER' module='Cases'}{/capture}
<label for="patent_number">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type = "text" name = "patent_number" id = "patent_number" value = "{$PATENT_NUMBER_VALUE}" style="{$PATENT_NUMBER_HIDE}" />
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='case_type_title_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CASE_TYPE_TITLE' module='Cases'}{/capture}
<label for="case_type_title">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.case_type_title.value) <= 0}
{assign var="value" value=$fields.case_type_title.default_value }
{else}
{assign var="value" value=$fields.case_type_title.value }
{/if}  
<input type='text' name='{$fields.case_type_title.name}' 
id='{$fields.case_type_title.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='qb_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_QB_DATE' module='Cases'}{/capture}
<label for="qb_date">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.qb_date.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.qb_date.name}" id="{$fields.qb_date.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.qb_date.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.qb_date.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.qb_date.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='amount_paid_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_PAID' module='Cases'}{/capture}
<label for="amount_paid">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if strlen($fields.amount_paid.value) <= 0}
{assign var="value" value=$fields.amount_paid.default_value }
{else}
{assign var="value" value=$fields.amount_paid.value }
{/if}  
<input type='text' name='{$fields.amount_paid.name}'
id='{$fields.amount_paid.name}'
size='30'
maxlength='25'value='{sugar_number_format var=$value precision=2 }'
title=''
tabindex='0'
>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_CASE_INFORMATION").style.display='none';</script>
{/if}
<div id="LBL_CREDIT_ALLOCATION">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
<tr>
<th align="left" colspan="8">
<h4>{sugar_translate label='LBL_CREDIT_ALLOCATION' module='Cases'}</h4>
</th>
</tr>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='client_consultant_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CLIENT_CONSULTANT_NAME' module='Cases'}{/capture}
<label for="client_consultant_name">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type = "text" id = "client_consultant_name" name = "client_consultant_name" value = "{$CONSULTANT_NAME}" readonly = "true" /><input accesskey=""  tabindex="0"  type = "hidden" id = "client_consultant_id" name ="client_consultant_id" value = "{$CONSULTANT_ID}"/>
<td valign="top" id='credit_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CREDIT_DATE' module='Cases'}{/capture}
<label for="credit_date">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.credit_date.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.credit_date.name}" id="{$fields.credit_date.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.credit_date.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.credit_date.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.credit_date.name}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='credit_alloc_notes_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ALLOC_NOTES' module='Cases'}{/capture}
<label for="credit_alloc_notes">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

{if empty($fields.credit_alloc_notes.value)}
{assign var="value" value=$fields.credit_alloc_notes.default_value }
{else}
{assign var="value" value=$fields.credit_alloc_notes.value }
{/if}  
<textarea  id='{$fields.credit_alloc_notes.name}' name='{$fields.credit_alloc_notes.name}'
rows="4" 
cols="60" 
title='' tabindex="0" 
 >{$value}</textarea>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
{$CREDIT_ALLOCATION}<input accesskey=""  tabindex="0"  type = "hidden" name = "cnt_value" id = "cnt_value" value = "{$CNT_VALUE}" />
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_CREDIT_ALLOCATION").style.display='none';</script>
{/if}
<div id="LBL_EDIT_FILING">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
<tr>
<th align="left" colspan="8">
<h4>{sugar_translate label='LBL_EDIT_FILING' module='Cases'}</h4>
</th>
</tr>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Filing date' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$FILING_DATE}
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Application Number' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$APP_NO}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FILING_RECEIPT' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type = "checkbox" id = "freceipt" name = "freceipt"  onclick = changeFrecipt() {$F_RECEIPT} value = "{$FRECIPT_VALUE}" />
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDIT_FILING").style.display='none';</script>
{/if}
<div id="LBL_EDIT_TM_FILING">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
<tr>
<th align="left" colspan="8">
<h4>{sugar_translate label='LBL_EDIT_TM_FILING' module='Cases'}</h4>
</th>
</tr>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='TM Filing date' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$TM_FILING_DATE}
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='TM Application No' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$TM_APP_NO}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='TM Registration Date' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$TM_REG_DT}
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='TM Registration No' module='Cases'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{$TM_REG_NO}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDIT_TM_FILING").style.display='none';</script>
{/if}
</div></div>

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

<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="{if $isDuplicate}this.form.return_id.value=''; {/if}this.form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(this.form);return false;" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" id="SAVE_FOOTER">{/if} 
{if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_FOOTER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Cases'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Cases", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>
</form>
{$set_focus_block}
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>{$overlibStuff}
<script type="text/javascript">
YAHOO.util.Event.onContentReady("EditView",
    function () {ldelim} initEditView(document.forms.EditView) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
</script>{literal}
<script type="text/javascript">
addForm('EditView');addToValidate('EditView', 'name', 'name', true,'{/literal}{sugar_translate label='LBL_SUBJECT' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'date_entered_date', 'date', false,'Date Created' );
addToValidate('EditView', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('EditView', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'case_number', 'varchar', true,'{/literal}{sugar_translate label='LBL_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'type', 'char', true,'{/literal}{sugar_translate label='LBL_TYPE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'status', 'char', false,'{/literal}{sugar_translate label='LBL_STATUS' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'priority', 'enum', false,'{/literal}{sugar_translate label='LBL_PRIORITY' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'resolution', 'text', false,'{/literal}{sugar_translate label='LBL_RESOLUTION' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'work_log', 'text', false,'{/literal}{sugar_translate label='LBL_WORK_LOG' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'modified_status_date', 'date', false,'Modified Status Date' );
addToValidate('EditView', 'case_type_title', 'varchar', false,'{/literal}{sugar_translate label='LBL_CASE_TYPE_TITLE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'user_name', 'relate', true,'{/literal}{sugar_translate label='LBL_USER_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'patent_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_PATENT_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'client_consultant_id', 'char', false,'{/literal}{sugar_translate label='LBL_CLIENT_CONSULTANT_ID' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'client_consultant_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CLIENT_CONSULTANT_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'amount_owed', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_OWED' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'case_start_date_date', 'date', false,'Start Date' );
addToValidate('EditView', 'case_end_date_date', 'date', false,'Completion Date' );
addToValidate('EditView', 'prioritydate', 'date', false,'{/literal}{sugar_translate label='LBL_PRIORITYDATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'patent_publication_number', 'int', true,'{/literal}{sugar_translate label='LBL_PATENT_PUBLICATION_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'patent_issued_number', 'varchar', true,'{/literal}{sugar_translate label='LBL_PATENT_ISSUED_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'tm_filing_date', 'date', false,'{/literal}{sugar_translate label='LBL_TM_FILING_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'tm_application_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_TM_APPLICATION_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'tm_registration_date', 'date', false,'{/literal}{sugar_translate label='LBL_TM_REGISTRATION_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'tm_registration_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_TM_REGISTRATION_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'tm_classes[]', 'multienum', false,'{/literal}{sugar_translate label='LBL_TM_CLASSES' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'case_status_age', 'int', false,'{/literal}{sugar_translate label='LBL_CASE_STATUS_AGE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'spec_writing_call', 'varchar', false,'{/literal}{sugar_translate label='LBL_SPEC_WRITING_CALL' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'patent_drawing_fee', 'varchar', false,'{/literal}{sugar_translate label='LBL_PATENT_DRAWING_FEE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'caseoverride', 'bool', false,'{/literal}{sugar_translate label='LBL_CASEOVER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'casetype', 'relate', true,'{/literal}{sugar_translate label='LBL_CASE_TYPE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'type_name', 'relate', true,'{/literal}{sugar_translate label='LBL_TYPE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'status_name', 'relate', true,'{/literal}{sugar_translate label='LBL_STATUS' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'casestatus', 'relate', true,'{/literal}{sugar_translate label='LBL_STATUS' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'invention', 'relate', true,'{/literal}{sugar_translate label='LBL_INVENTION_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'invention_id', 'char', false,'{/literal}{sugar_translate label='LBL_INVENTION_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'invention_name', 'relate', false,'{/literal}{sugar_translate label='LBL_INVENTION_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'search_type', 'enum', false,'{/literal}{sugar_translate label='LBL_SEARCH_TYPE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'due_date', 'date', false,'{/literal}{sugar_translate label='LBL_DUE_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'filing_date', 'date', false,'{/literal}{sugar_translate label='LBL_FILING_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'application_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_APPLICATION_NUMBER' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'freceipt', 'int', false,'{/literal}{sugar_translate label='LBL_FILING_RECEIPT' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_to[]', 'multienum', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'credit_date', 'date', false,'{/literal}{sugar_translate label='LBL_CREDIT_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'credit_alloc_notes', 'text', false,'{/literal}{sugar_translate label='LBL_ALLOC_NOTES' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'account_name', 'relate', true,'{/literal}{sugar_translate label='LBL_ACCOUNT_NAME' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'account_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ACCOUNT_ID' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'relatedtoparent', 'enum', false,'{/literal}{sugar_translate label='LBL_RELATED_TO_PARENT' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'case_origin', 'varchar', false,'{/literal}{sugar_translate label='LBL_CASE_ORIGIN' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'amount_paid', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_PAID' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'qb_date', 'date', false,'{/literal}{sugar_translate label='LBL_QB_DATE' module='Cases' for_js=true}{literal}' );
addToValidate('EditView', 'date_case_status_modified_date', 'date', false,'LBL_DATE_CASE_STATUS_MODIFIED' );
addToValidate('EditView', 'trade_trademark_cases_name', 'relate', false,'{/literal}{sugar_translate label='LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE' module='Cases' for_js=true}{literal}' );
addToValidateBinaryDependency('EditView', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Cases' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='Cases' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('EditView', 'client_consultant_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Cases' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_CLIENT_CONSULTANT_NAME' module='Cases' for_js=true}{literal}', 'client_consultant_id' );
addToValidateBinaryDependency('EditView', 'account_name', 'alpha', true,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Cases' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ACCOUNT_NAME' module='Cases' for_js=true}{literal}', 'account_id' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['EditView_account_name']={"form":"EditView","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["EditView_account_name","account_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["account_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['EditView_client_consultant_name']={"form":"EditView","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>{/literal}
