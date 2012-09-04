

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
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="disableOnUnloadEditView();this.form.action.value='Save';if(check_form('form_SubpanelQuickCreate_oa_officeactions'))return SUGAR.subpanelUtils.inlineSave(this.form.id, 'oa_officeactions_subpanel_save_button');return false;" type="submit" name="oa_officeactions_subpanel_save_button" id="oa_officeactions_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate('oa_officeactions_subpanel_cancel_button');return false;" type="submit" name="oa_officeactions_subpanel_cancel_button" id="oa_officeactions_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
<input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="disableOnUnloadEditView(this.form); this.form.return_action.value='DetailView'; this.form.action.value='EditView'; if(typeof(this.form.to_pdf)!='undefined') this.form.to_pdf.value='0';" type="submit" name="oa_officeactions_subpanel_full_form_button" id="oa_officeactions_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form">
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=oa_officeactions", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_SubpanelQuickCreate_oa_officeactions_tabs"
>
<div >
<div id="Default_{$module}_Subpanel">
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam {$def.templateMeta.panelClass|default:'edit view dcQuickEdit edit508'}">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='subcase_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions'}{/capture}
<label for="subcase_name">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey="7"  tabindex="0"  id ="subcase_name" name="subcase_name" onclick="getSubcases();getStatus();" onchange = "populateTitle();" ></select><script type="text/javascript">getSubcases();</script>
<td valign="top" id='assigned_user_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='oa_officeactions'}{/capture}
<label for="assigned_user_name">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.assigned_user_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.assigned_user_name.name}" size="" value="{$fields.assigned_user_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.assigned_user_name.id_name}" 
id="{$fields.assigned_user_name.id_name}" 
value="{$fields.assigned_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.assigned_user_name.name}" id="btn_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.assigned_user_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_SubpanelQuickCreate_oa_officeactions","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.assigned_user_name.name}" id="btn_clr_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.assigned_user_name.name}', '{$fields.assigned_user_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.assigned_user_name.name}']) != 'undefined'",
		enableQS
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
<td valign="top" id='sub_case_title_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBCASE_TITLE' module='oa_officeactions'}{/capture}
<label for="sub_case_title">{$label|strip_semicolon}:</label>
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<input accesskey=""  tabindex="0"  type = "text" id = "sub_case_title" name ="sub_case_title" /><input accesskey=""  tabindex="0"  type = "hidden" id = "parent_consultant" name = "parent_consultant" value = "{$PARENT_CONSULTANT}" />
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
{capture name="label" assign="label"}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions'}{/capture}
<label for="">{$label|strip_semicolon}:</label>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<select accesskey=""  tabindex="0"  name="subcase_status_id" id="subcase_status_id"></select>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
</div></div>

<div class="buttons">
{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}"  class="button" onclick="disableOnUnloadEditView();this.form.action.value='Save';if(check_form('form_SubpanelQuickCreate_oa_officeactions'))return SUGAR.subpanelUtils.inlineSave(this.form.id, 'oa_officeactions_subpanel_save_button');return false;" type="submit" name="oa_officeactions_subpanel_save_button" id="oa_officeactions_subpanel_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if} 
<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate('oa_officeactions_subpanel_cancel_button');return false;" type="submit" name="oa_officeactions_subpanel_cancel_button" id="oa_officeactions_subpanel_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"> 
<input title="{$APP.LBL_FULL_FORM_BUTTON_TITLE}" class="button" onclick="disableOnUnloadEditView(this.form); this.form.return_action.value='DetailView'; this.form.action.value='EditView'; if(typeof(this.form.to_pdf)!='undefined') this.form.to_pdf.value='0';" type="submit" name="oa_officeactions_subpanel_full_form_button" id="oa_officeactions_subpanel_full_form_button" value="{$APP.LBL_FULL_FORM_BUTTON_LABEL}"> <input type="hidden" name="full_form" value="full_form">
{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=oa_officeactions", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}
</div>
</form>
{$set_focus_block}
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script>{$overlibStuff}
<script type="text/javascript">
YAHOO.util.Event.onContentReady("form_SubpanelQuickCreate_oa_officeactions",
    function () {ldelim} initEditView(document.forms.form_SubpanelQuickCreate_oa_officeactions) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
</script>{literal}
<script type="text/javascript">
addForm('form_SubpanelQuickCreate_oa_officeactions');addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'name', 'name', false,'{/literal}{sugar_translate label='LBL_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'date_entered_date', 'date', false,'Creation Date' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'modified_status_date', 'date', false,'Status Modified Date' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'visible_to_client', 'enum', true,'{/literal}{sugar_translate label='LBL_VISIBLE_TO_CLIENT' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'sub_case_title', 'varchar', true,'{/literal}{sugar_translate label='LBL_SUBCASE_TITLE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'duedate', 'date', false,'{/literal}{sugar_translate label='LBL_DUEDATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'officeactiontype', 'enum', false,'{/literal}{sugar_translate label='LBL_OFFICEACTIONTYPE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'extensionallowed', 'enum', false,'{/literal}{sugar_translate label='LBL_EXTENSIONALLOWED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase_status_id', 'id', true,'{/literal}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase_status', 'relate', true,'{/literal}{sugar_translate label='LBL_OFFICEACTIONSTATUS' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase_status_age', 'int', false,'{/literal}{sugar_translate label='LBL_SUBCASE_STATUS_AGE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'filing_date', 'date', false,'{/literal}{sugar_translate label='LBL_FILING_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'application_number', 'int', true,'{/literal}{sugar_translate label='LBL_APPLICATION_NUMBER' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'freceipt', 'int', true,'{/literal}{sugar_translate label='LBL_FILING_RECEIPT' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase_name', 'id', true,'{/literal}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase', 'relate', true,'{/literal}{sugar_translate label='LBL_SUBCASE_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcase_number', 'varchar', false,'{/literal}{sugar_translate label='LBL_SUBCASE_NUMBER' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'amount_owed', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_OWED' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'case_start_date_date', 'date', false,'Start Date' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'case_end_date_date', 'date', false,'Completion Date' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'credit_alloc_notes', 'text', false,'{/literal}{sugar_translate label='LBL_ALLOC_NOTES' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'oa_officeactions_cases_name', 'relate', false,'{/literal}{sugar_translate label='LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'amount_paid', 'decimal', false,'{/literal}{sugar_translate label='LBL_AMOUNT_PAID' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'qb_date', 'date', false,'{/literal}{sugar_translate label='LBL_QB_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'credit_date', 'date', false,'{/literal}{sugar_translate label='LBL_CREDIT_DATE' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'case_end_user_id', 'char', false,'{/literal}{sugar_translate label='LBL_CASE_END_USER_ID' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'case_end_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CASE_END_USER_NAME' module='oa_officeactions' for_js=true}{literal}' );
addToValidate('form_SubpanelQuickCreate_oa_officeactions', 'subcaseoverride', 'bool', false,'{/literal}{sugar_translate label='LBL_SUBCASE_OVERRIDE' module='oa_officeactions' for_js=true}{literal}' );
addToValidateBinaryDependency('form_SubpanelQuickCreate_oa_officeactions', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='oa_officeactions' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='oa_officeactions' for_js=true}{literal}', 'assigned_user_id' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_SubpanelQuickCreate_oa_officeactions_assigned_user_name']={"form":"form_SubpanelQuickCreate_oa_officeactions","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>{/literal}
