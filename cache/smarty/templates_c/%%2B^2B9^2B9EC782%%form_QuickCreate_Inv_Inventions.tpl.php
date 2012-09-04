<?php /* Smarty version 2.6.11, created on 2012-09-04 15:06:11
         compiled from cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 36, false),array('function', 'counter', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 42, false),array('function', 'sugar_translate', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 48, false),array('function', 'sugar_getimagepath', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 91, false),array('modifier', 'default', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 43, false),array('modifier', 'strip_semicolon', 'cache/modules/Inv_Inventions/form_QuickCreate_Inv_Inventions.tpl', 49, false),)), $this); ?>


<div class="clear"></div>
<form action="index.php" method="POST" name="<?php echo $this->_tpl_vars['form_name']; ?>
" id="<?php echo $this->_tpl_vars['form_id']; ?>
" <?php echo $this->_tpl_vars['enctype']; ?>
>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<?php if (isset ( $_REQUEST['isDuplicate'] ) && $_REQUEST['isDuplicate'] == 'true'): ?>
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<?php else: ?>
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<?php endif; ?>
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="<?php echo $_REQUEST['return_module']; ?>
">
<input type="hidden" name="return_action" value="<?php echo $_REQUEST['return_action']; ?>
">
<input type="hidden" name="return_id" value="<?php echo $_REQUEST['return_id']; ?>
">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
<?php if (! empty ( $_REQUEST['return_module'] ) || ! empty ( $_REQUEST['relate_to'] )): ?>
<input type="hidden" name="relate_to" value="<?php if ($_REQUEST['return_relationship']):  echo $_REQUEST['return_relationship'];  elseif ($_REQUEST['relate_to'] && empty ( $_REQUEST['from_dcmenu'] )):  echo $_REQUEST['relate_to'];  elseif (empty ( $this->_tpl_vars['isDCForm'] ) && empty ( $_REQUEST['from_dcmenu'] )):  echo $_REQUEST['return_module'];  endif; ?>">
<input type="hidden" name="relate_id" value="<?php echo $_REQUEST['return_id']; ?>
">
<?php endif; ?>
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<?php if ($this->_tpl_vars['bean']->aclAccess('save')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary" onclick="this.form.action.value='Popup';return check_form('form_QuickCreate_Inv_Inventions')" type="submit" name="Inv_Inventions_popupcreate_save_button" id="Inv_Inventions_popupcreate_save_button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
"><?php endif; ?> 
<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="toggleDisplay('addform');return false;" name="Inv_Inventions_popup_cancel_button" type="submit"id="Inv_Inventions_popup_cancel_button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
"> 
<?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Inv_Inventions", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?>
</td>
<td align='right'>
<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_QuickCreate_Inv_Inventions_tabs"
>
<div >
<div id="Default_<?php echo $this->_tpl_vars['module']; ?>
_Subpanel">
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam <?php echo ((is_array($_tmp=@$this->_tpl_vars['def']['templateMeta']['panelClass'])) ? $this->_run_mod_handler('default', true, $_tmp, 'edit view dcQuickEdit edit508') : smarty_modifier_default($_tmp, 'edit view dcQuickEdit edit508')); ?>
">
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Inv_Inventions'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="name"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['name']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['name']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['name']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['name']['name']; ?>
' 
id='<?php echo $this->_tpl_vars['fields']['name']['name']; ?>
' size='30' 
maxlength='255' 
value='<?php echo $this->_tpl_vars['value']; ?>
' title=''      accesskey='7'  >
<td valign="top" id='inv_inventions_accounts_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE','module' => 'Inv_Inventions'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="inv_inventions_accounts_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<input type="text" name="<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" class="sqsEnabled" tabindex="0" id="<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" size="" value="<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['value']; ?>
" title='' autocomplete="off"  	 >
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['id_name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['id_name']; ?>
" 
value="<?php echo $this->_tpl_vars['fields']['inv_inventd1acccounts_ida']['value']; ?>
">
<span class="id-ff multiple">
<button type="button" name="btn_<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" id="btn_<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE'), $this);?>
" class="button firstChild" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL'), $this);?>
"
onclick='open_popup(
"<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['module']; ?>
", 
600, 
400, 
"", 
true, 
false, 
<?php echo '{"call_back_function":"set_return","form_name":"form_QuickCreate_Inv_Inventions","field_to_name_array":{"id":"inv_inventd1acccounts_ida","name":"inv_inventions_accounts_name"}}'; ?>
, 
"single", 
true
);' ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-select.png"), $this);?>
"></button><button type="button" name="btn_clr_<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" id="btn_clr_<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE'), $this);?>
"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
', '<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['id_name']; ?>
');"  value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL'), $this);?>
" ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['<?php echo $this->_tpl_vars['form_name']; ?>
_<?php echo $this->_tpl_vars['fields']['inv_inventions_accounts_name']['name']; ?>
']) != 'undefined'",
		enableQS
);
</script>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("DEFAULT").style.display='none';</script>
<?php endif; ?>
</div></div>

<div class="buttons">
<?php if ($this->_tpl_vars['bean']->aclAccess('save')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary" onclick="this.form.action.value='Popup';return check_form('form_QuickCreate_Inv_Inventions')" type="submit" name="Inv_Inventions_popupcreate_save_button" id="Inv_Inventions_popupcreate_save_button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
"><?php endif; ?> 
<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="toggleDisplay('addform');return false;" name="Inv_Inventions_popup_cancel_button" type="submit"id="Inv_Inventions_popup_cancel_button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
"> 
<?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Inv_Inventions", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?>
</div>
</form>
<?php echo $this->_tpl_vars['set_focus_block']; ?>

<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){SUGAR.util.buildAccessKeyLabels();});
</script><?php echo $this->_tpl_vars['overlibStuff']; ?>

<script type="text/javascript">
YAHOO.util.Event.onContentReady("form_QuickCreate_Inv_Inventions",
    function () { initEditView(document.forms.form_QuickCreate_Inv_Inventions) });
//window.setTimeout(, 100);
window.onbeforeunload = function () { return onUnloadEditView(); };
</script><?php echo '
<script type="text/javascript">
addForm(\'form_QuickCreate_Inv_Inventions\');addToValidate(\'form_QuickCreate_Inv_Inventions\', \'name\', \'name\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'date_entered_date\', \'date\', false,\'Date Created\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'date_modified_date\', \'date\', false,\'Date Modified\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'modified_user_id\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'modified_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED_NAME','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'created_by\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'created_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'description\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPTION','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'deleted\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DELETED','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assigned_user_id\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_ID','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assigned_user_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NAME','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'total_patent_assigned\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_PATENT_ASSIGNED','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_name\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_NAME','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignment\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNMENT','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'fax_docs\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FAX_DOCS','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'email_docs\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_DOCS','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'non_profit_entity\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NON_PROFIT_ENTITY','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'govt_inventions\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_GOVT_INVENTIONS','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_address1\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_ADDRESS1','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_address2\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_ADDRESS2','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_city\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_CITY','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_state\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_STATE','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_zipcode\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_ZIPCODE','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'assignee_country\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNEE_COUNTRY','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'invention_entity_type\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ENTITY_TYPE','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Inv_Inventions\', \'inv_inventions_accounts_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE','module' => 'Inv_Inventions','for_js' => true), $this); echo '\' );
addToValidateBinaryDependency(\'form_QuickCreate_Inv_Inventions\', \'assigned_user_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Inv_Inventions','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Inv_Inventions','for_js' => true), $this); echo '\', \'assigned_user_id\' );
addToValidateBinaryDependency(\'form_QuickCreate_Inv_Inventions\', \'inv_inventions_accounts_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Inv_Inventions','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_ACCOUNTS_TITLE','module' => 'Inv_Inventions','for_js' => true), $this); echo '\', \'inv_inventd1acccounts_ida\' );
</script><script language="javascript">if(typeof sqs_objects == \'undefined\'){var sqs_objects = new Array;}sqs_objects[\'form_QuickCreate_Inv_Inventions_inv_inventions_accounts_name\']={"form":"form_QuickCreate_Inv_Inventions","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["form_QuickCreate_Inv_Inventions_inv_inventions_accounts_name","inv_inventd1acccounts_ida"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["inv_inventd1acccounts_ida"],"order":"name","limit":"30","no_match_text":"No Match"};</script>'; ?>
