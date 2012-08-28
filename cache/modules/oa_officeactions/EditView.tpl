

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
{if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_HEADER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=oa_officeactions'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_HEADER"> {/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=oa_officeactions", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
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
<div id="Default_{$module}_Subpanel">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME' module='oa_officeactions'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
<input accesskey="7"  tabindex="0"  type="text" name="name" id="name"  value="{$fields.name.value}">&nbsp;&nbsp;<input accesskey="7"  tabindex="0"  type = "checkbox" title= "Click to Override the Sub Case Number" name="subcaseoverride" id= "subcaseoverride" {$CHECKED_CHECK} onclick = "enableCsNo();" {$CHK_DIS} />
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='oa_officeactions_cases_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE' module='oa_officeactions'}{/capture}
<label for="oa_officeactions_cases_name">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type="text" name="oa_officeactions_cases_name" class="sqsEnabled" id="oa_officeactions_cases_name" size="25" value="{$CASE_NAME}" title='' autocomplete="off" readonly="readonly" onblur="subcaseDisplay();">
<input accesskey=""  tabindex="0"  type="hidden" name="oa_officeactions_casescases_ida" id="oa_officeactions_casescases_ida" value="{$CASE_ID}">
<button type="button" name="btn_oa_officeactions_cases_name" id="btn_oa_officeactions_cases_name" title="{$APP.LBL_SELECT_BUTTON_TITLE}" accessKey="{$APP.LBL_SELECT_BUTTON_KEY}" class="button firstChild" value="Select" onclick=' open_popup("Cases", 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"oa_officeactions_casescases_ida","name":"oa_officeactions_cases_name"}}{/literal}, "single", true); this.form.oa_officeactions_cases_name.focus();'><img alt="" src="themes/default/images/id-ff-select.png?v=OIXX-lwlUV73favZcB3MQg"></button>
<button type="button" name="btn_clr_oa_officeactions_cases_name" id="btn_clr_oa_officeactions_cases_name" tabindex="103" title="{$APP.LBL_CLEAR_BUTTON_TITLE}" accessKey="{$APP.LBL_CLEAR_BUTTON_KEY}" class="button lastChild" onclick="document.forms['EditView'].oa_officeactions_cases_name.value= '';document.forms['EditView'].oa_officeactions_casescases_ida.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}" >
<img src="themes/default/images/id-ff-clear.png?v=OIXX-lwlUV73favZcB3MQg"></button>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' &amp;&amp; typeof(sqs_objects['EditView_oa_officeactions_cases_name']) != 'undefined'",
		enableQS
);,
</script>
<td valign="top" id='duedate_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DUEDATE' module='oa_officeactions'}{/capture}
<label for="duedate">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.duedate.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.duedate.name}" id="{$fields.duedate.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.duedate.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.duedate.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.duedate.name}_trigger",
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
<td valign="top" id='amount_owed_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_OWED' module='oa_officeactions'}{/capture}
<label for="amount_owed">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
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
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='description_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='oa_officeactions'}{/capture}
<label for="description">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if empty($fields.description.value)}
{assign var="value" value=$fields.description.default_value }
{else}
{assign var="value" value=$fields.description.value }
{/if}  
<textarea  id='{$fields.description.name}' name='{$fields.description.name}'
rows="6" 
cols="80" 
title='' tabindex="0" 
 >{$value}</textarea>
<td valign="top" id='credit_alloc_notes_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ALLOC_NOTES' module='oa_officeactions'}{/capture}
<label for="credit_alloc_notes">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
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
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  name="subcase_name" id="subcase_name" onchange="getStatus();" ><option value="">-none-</option>{$EDIT_SUBCASE_NAME}</select>
<td valign="top" id='_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  name="subcase_status_id" id="subcase_status_id" onchange="populateCurrDate();">{$SUBCASE_STATUS_OPTIONS}</select>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='sub_case_title_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_TITLE' module='oa_officeactions'}{/capture}
<label for="sub_case_title">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.sub_case_title.value) <= 0}
{assign var="value" value=$fields.sub_case_title.default_value }
{else}
{assign var="value" value=$fields.sub_case_title.value }
{/if}  
<input type='text' name='{$fields.sub_case_title.name}' 
id='{$fields.sub_case_title.name}' size='30' 
maxlength='255' 
value='{$value}' title=''      >
<td valign="top" id='visible_to_client_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_VISIBLE_TO_CLIENT' module='oa_officeactions'}{/capture}
<label for="visible_to_client">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.visible_to_client.name}" 
id="{$fields.visible_to_client.name}" 
title=''       
>
{if isset($fields.visible_to_client.value) && $fields.visible_to_client.value != ''}
{html_options options=$fields.visible_to_client.options selected=$fields.visible_to_client.value}
{else}
{html_options options=$fields.visible_to_client.options selected=$fields.visible_to_client.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.visible_to_client.options }
{capture name="field_val"}{$fields.visible_to_client.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.visible_to_client.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.visible_to_client.name}" 
id="{$fields.visible_to_client.name}" 
title=''          
>
{if isset($fields.visible_to_client.value) && $fields.visible_to_client.value != ''}
{html_options options=$fields.visible_to_client.options selected=$fields.visible_to_client.value}
{else}
{html_options options=$fields.visible_to_client.options selected=$fields.visible_to_client.default}
{/if}
</select>
<input
id="{$fields.visible_to_client.name}-input"
name="{$fields.visible_to_client.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.visible_to_client.name}-image"></button><button type="button"
id="btn-clear-{$fields.visible_to_client.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.visible_to_client.name}-input', '{$fields.visible_to_client.name}');sync_{$fields.visible_to_client.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.visible_to_client.name}{literal}");
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
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.visible_to_client.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.visible_to_client.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.visible_to_client.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.visible_to_client.name}{literal}");
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
sync_{/literal}{$fields.visible_to_client.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.visible_to_client.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.visible_to_client.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.visible_to_client.name}{literal}", syncFromHiddenToWidget);
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
var selectElem = document.getElementById("{/literal}{$fields.visible_to_client.name}{literal}");
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

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type="hidden" name="subcase_number" id="subcase_number" readonly value="{$fields.subcase_number.value}">
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
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='amount_paid_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT_PAID' module='oa_officeactions'}{/capture}
<label for="amount_paid">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
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
<td valign="top" id='qb_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_QB_DATE' module='oa_officeactions'}{/capture}
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
<td valign="top" id='credit_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_CREDIT_DATE' module='oa_officeactions'}{/capture}
<label for="credit_date">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
<div id="LBL_APPLICATION_EDIT_FILING">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
<tr>
<th align="left" colspan="8">
<h4>{sugar_translate label='LBL_APPLICATION_EDIT_FILING' module='oa_officeactions'}</h4>
</th>
</tr>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='filing_date_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='Filing date' module='oa_officeactions'}{/capture}
<label for="filing_date">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

<span class="dateTime">
{assign var=date_value value=$fields.filing_date.value }
<input class="date_input" autocomplete="off" type="text" name="{$fields.filing_date.name}" id="{$fields.filing_date.name}" value="{$date_value}" title=''  tabindex='0'    size="11" maxlength="10" >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.filing_date.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
</span>
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{$fields.filing_date.name}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$fields.filing_date.name}_trigger",
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
&nbsp;
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}
{$CREDIT_ALLOCATION}<input accesskey=""  tabindex="0"  type = "hidden" name = "cnt_value" id = "cnt_value" value = "{$CNT_VALUE}" />
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
<script>document.getElementById("LBL_APPLICATION_EDIT_FILING").style.display='none';</script>
{/if}
</div></div>

<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="{if $isDuplicate}this.form.return_id.value=''; {/if}this.form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(this.form);return false;" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}" id="SAVE_FOOTER">{/if} 
{if !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($smarty.request.return_id))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" type="button" id="CANCEL_FOOTER"> {elseif !empty($smarty.request.return_action) && ($smarty.request.return_action == "DetailView" && !empty($fields.id.value))}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module={$smarty.request.return_module}&record={$fields.id.value}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {elseif empty($smarty.request.return_action) || empty($smarty.request.return_id) && !empty($fields.id.value)}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=oa_officeactions'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module={$smarty.request.return_module}&record={$smarty.request.return_id}'); return false;" type="button" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL_FOOTER"> {/if}
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=oa_officeactions", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
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
addForm('EditView');addToValidate('EditView', 'name', 'name', false,'{/literal}{sugar_translate label='LBL_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'date_entered_date', 'date', false,'Creation Date' );
addToValidate('EditView', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('EditView', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'modified_status_date', 'date', false,'Status Modified Date' );
addToValidate('EditView', 'visible_to_client', 'enum', true,'{/literal}{sugar_translate label='LBL_VISIBLE_TO_CLIENT' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'sub_case_title', 'varchar', true,'{/literal}{sugar_translate label='LBL_SUBCASE_TITLE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'duedate', 'date', false,'{/literal}{sugar_translate label='LBL_DUEDATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'officeactiontype', 'enum', false,'{/literal}{sugar_translate label='LBL_OFFICEACTIONTYPE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'extensionallowed', 'enum', false,'{/literal}{sugar_translate label='LBL_EXTENSIONALLOWED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase_status_id', 'id', true,'{/literal}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase_status', 'relate', true,'{/literal}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase_status_age', 'int', false,'{/literal}{sugar_translate label='LBL_SUBCASE_STATUS_AGE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'filing_date', 'date', false,'{/literal}{sugar_translate label='LBL_FILING_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'application_number', 'int', true,'{/literal}{sugar_translate label='LBL_APPLICATION_NUMBER' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'freceipt', 'int', true,'{/literal}{sugar_translate label='LBL_FILING_RECEIPT' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase_name', 'id', true,'{/literal}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase', 'relate', true,'{/literal}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcase_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_SUBCASE_NUMBER' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'amount_owed', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_OWED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'case_start_date_date', 'date', false,'Start Date' );
addToValidate('EditView', 'case_end_date_date', 'date', false,'Completion Date' );
addToValidate('EditView', 'credit_alloc_notes', 'text', false,'{/literal}{sugar_translate label='LBL_ALLOC_NOTES' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'oa_officeactions_cases_name', 'relate', true,'{/literal}{sugar_translate label='LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'amount_paid', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_PAID' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'qb_date', 'date', false,'{/literal}{sugar_translate label='LBL_QB_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'credit_date', 'date', false,'{/literal}{sugar_translate label='LBL_CREDIT_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('EditView', 'subcaseoverride', 'bool', false,'{/literal}{sugar_translate label='LBL_SUBCASE_OVERRIDE' module='oa_officeactions' for_js=true}{literal}' );
addToValidateBinaryDependency('EditView', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='oa_officeactions' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='oa_officeactions' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('EditView', 'oa_officeactions_cases_name', 'alpha', true,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='oa_officeactions' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE' module='oa_officeactions' for_js=true}{literal}', 'oa_officeactions_casescases_ida' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['EditView_oa_officeactions_cases_name']={"form":"EditView","method":"query","modules":["Cases"],"group":"or","field_list":["name","id"],"populate_list":["oa_officeactions_cases_name","oa_officeactions_casescases_ida"],"required_list":["parent_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"order":"name","limit":"30","no_match_text":"No Match"};</script>{/literal}
