<?php /* Smarty version 2.6.11, created on 2012-09-04 14:30:48
         compiled from cache/modules/Cases/EditView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Cases/EditView.tpl', 36, false),array('function', 'counter', 'cache/modules/Cases/EditView.tpl', 42, false),array('function', 'sugar_translate', 'cache/modules/Cases/EditView.tpl', 46, false),array('function', 'sugar_number_format', 'cache/modules/Cases/EditView.tpl', 149, false),array('function', 'sugar_getimage', 'cache/modules/Cases/EditView.tpl', 166, false),array('function', 'html_options', 'cache/modules/Cases/EditView.tpl', 231, false),array('function', 'sugar_getimagepath', 'cache/modules/Cases/EditView.tpl', 259, false),array('function', 'sugar_getjspath', 'cache/modules/Cases/EditView.tpl', 843, false),array('modifier', 'default', 'cache/modules/Cases/EditView.tpl', 43, false),array('modifier', 'strip_semicolon', 'cache/modules/Cases/EditView.tpl', 54, false),array('modifier', 'lookup', 'cache/modules/Cases/EditView.tpl', 256, false),array('modifier', 'count', 'cache/modules/Cases/EditView.tpl', 336, false),)), $this); ?>


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
" class="button primary" onclick="<?php if ($this->_tpl_vars['isDuplicate']): ?>this.form.return_id.value=''; <?php endif; ?>this.form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(this.form);return false;" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" id="SAVE_HEADER"><?php endif; ?> 
<?php if (! empty ( $_REQUEST['return_action'] ) && ( $_REQUEST['return_action'] == 'DetailView' && ! empty ( $_REQUEST['return_id'] ) )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $_REQUEST['return_id']; ?>
'); return false;" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" type="button" id="CANCEL_HEADER"> <?php elseif (! empty ( $_REQUEST['return_action'] ) && ( $_REQUEST['return_action'] == 'DetailView' && ! empty ( $this->_tpl_vars['fields']['id']['value'] ) )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_HEADER"> <?php elseif (empty ( $_REQUEST['return_action'] ) || empty ( $_REQUEST['return_id'] ) && ! empty ( $this->_tpl_vars['fields']['id']['value'] )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Cases'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_HEADER"> <?php else: ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $_REQUEST['return_id']; ?>
'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_HEADER"> <?php endif;  if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Cases", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?>
</td>
<td align='right'>
<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="EditView_tabs"
>
<div >
<div id="LBL_CASE_INFORMATION">
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam <?php echo ((is_array($_tmp=@$this->_tpl_vars['def']['templateMeta']['panelClass'])) ? $this->_run_mod_handler('default', true, $_tmp, 'edit view dcQuickEdit edit508') : smarty_modifier_default($_tmp, 'edit view dcQuickEdit edit508')); ?>
">
<tr>
<th align="left" colspan="8">
<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_INFORMATION','module' => 'Cases'), $this);?>
</h4>
</th>
</tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_NUMBER','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<input accesskey="7"  tabindex="0"  type = "text" name="case_number" value="<?php echo $this->_tpl_vars['CASECOUNT']; ?>
" tabindex="1" size="30" maxlength="100" id="case_number"  <?php echo $this->_tpl_vars['DIS']; ?>
 >&nbsp;&nbsp;
<input accesskey="7"  tabindex="0"  type = "checkbox" title= "Click to Override the Case Number" name="caseoverride" id= "caseoverride" <?php echo $this->_tpl_vars['CHECKED_CHECK']; ?>
 onclick = "enableCsNo();" <?php echo $this->_tpl_vars['CHK_DIS']; ?>
 /><input accesskey="7"  tabindex="0"  type = "hidden" id = "case_override" name = "case_override" value = <?php echo $this->_tpl_vars['CASE_OVERRIDE_VALUE']; ?>
 />
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='relatedtoparent_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RELATED_TO_PARENT','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="relatedtoparent"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<select accesskey=""  tabindex="0"  id = "relatedtoparent" name = "relatedtoparent" onchange = "relateToParent();"><?php echo $this->_tpl_vars['RELATED_PARENT']; ?>
</select>
<td valign="top" id='account_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="account_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<input accesskey=""  tabindex="0"  type="text" name="account_name" class="sqsEnabled" tabindex="103" id="account_name" size="25" value="<?php echo $this->_tpl_vars['ACC_DESC']; ?>
" onblur = "saveClientName();" title='' autocomplete="off"  >
<input accesskey=""  tabindex="0"  type="hidden" name="account_id" id="account_id" value="<?php echo $this->_tpl_vars['ACC_ID']; ?>
">
<input accesskey=""  tabindex="0"  type="button" name="btn_account_c" id="btn_account_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_KEY']; ?>
" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
" onclick=' open_popup("Accounts", 600, 400, "", true, false, <?php echo '{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":"account_id","name":"account_name"}}'; ?>
, "single", true);this.form.account_name.focus();'>
<input accesskey=""  tabindex="0"  type="button" name="btn_clr_account_c" id="btn_clr_account_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_KEY']; ?>
" class="button" onclick="this.form.account_name.value = '';this.form.account_id.value = '';" value="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
">
<script type="text/javascript">
			<!--
				enableQS(false);
			-->
			</script>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='type_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="type"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<select accesskey=""  tabindex="0"  id = "type" name = "type" onchange = "callFunctions();"><?php echo $this->_tpl_vars['CASE_TYPE']; ?>
</select>
<td valign="top" id='status_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="status"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<select accesskey=""  tabindex="0"  id = "status" name = "status" <?php echo $this->_tpl_vars['DISABLE']; ?>
 onchange = "populateCurrDate();" ><?php echo $this->_tpl_vars['CASE_STATUS']; ?>
</select>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='amount_owed_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_OWED','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="amount_owed"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['amount_owed']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['amount_owed']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['amount_owed']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['amount_owed']['name']; ?>
'
id='<?php echo $this->_tpl_vars['fields']['amount_owed']['name']; ?>
'
size='30'
maxlength='25'value='<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['value'],'precision' => 2), $this);?>
'
title=''
tabindex='0'
>
<td valign="top" id='due_date_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DUE_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="due_date"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="dateTime">
<?php $this->assign('date_value', $this->_tpl_vars['fields']['due_date']['value']); ?>
<input class="date_input" autocomplete="off" type="text" name="<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
" value="<?php echo $this->_tpl_vars['date_value']; ?>
" title=''  tabindex='0'    size="11" maxlength="10" >
<?php ob_start(); ?>alt="<?php echo $this->_tpl_vars['APP']['LBL_ENTER_DATE']; ?>
" style="position:relative; top:6px" border="0" id="<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
_trigger"<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('other_attributes', ob_get_contents());ob_end_clean();  echo smarty_function_sugar_getimage(array('name' => 'jscalendar','ext' => ".gif",'other_attributes' => ($this->_tpl_vars['other_attributes'])), $this);?>

</span>
<script type="text/javascript">
Calendar.setup ({
inputField : "<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
",
ifFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
daFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
button : "<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
_trigger",
singleClick : true,
dateStr : "<?php echo $this->_tpl_vars['date_value']; ?>
",
startWeekday: <?php echo ((is_array($_tmp=@$this->_tpl_vars['CALENDAR_FDOW'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
,
step : 1,
weekNumbers:false
}
);
</script>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Related to','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span><?php echo $this->_tpl_vars['RELATEPOPUP']; ?>
</span>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Search Type:','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<select accesskey=""  tabindex="0"  id="search_type" name="search_type" style="<?php echo $this->_tpl_vars['SERARCHTYPE']; ?>
"> <?php echo $this->_tpl_vars['SEARCH_TYPE']; ?>
</select>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='priority_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITY','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="priority"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! isset ( $this->_tpl_vars['config']['enable_autocomplete'] ) || $this->_tpl_vars['config']['enable_autocomplete'] == false): ?>
<select name="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" 
title=''       
>
<?php if (isset ( $this->_tpl_vars['fields']['priority']['value'] ) && $this->_tpl_vars['fields']['priority']['value'] != ''):  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['priority']['options'],'selected' => $this->_tpl_vars['fields']['priority']['value']), $this);?>

<?php else:  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['priority']['options'],'selected' => $this->_tpl_vars['fields']['priority']['default']), $this);?>

<?php endif; ?>
</select>
<?php else:  $this->assign('field_options', $this->_tpl_vars['fields']['priority']['options']);  ob_start();  echo $this->_tpl_vars['fields']['priority']['value'];  $this->_smarty_vars['capture']['field_val'] = ob_get_contents(); ob_end_clean();  $this->assign('field_val', $this->_smarty_vars['capture']['field_val']);  ob_start();  echo $this->_tpl_vars['fields']['priority']['name'];  $this->_smarty_vars['capture']['ac_key'] = ob_get_contents(); ob_end_clean();  $this->assign('ac_key', $this->_smarty_vars['capture']['ac_key']); ?>
<select style='display:none' name="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" 
title=''          
>
<?php if (isset ( $this->_tpl_vars['fields']['priority']['value'] ) && $this->_tpl_vars['fields']['priority']['value'] != ''):  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['priority']['options'],'selected' => $this->_tpl_vars['fields']['priority']['value']), $this);?>

<?php else:  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['priority']['options'],'selected' => $this->_tpl_vars['fields']['priority']['default']), $this);?>

<?php endif; ?>
</select>
<input
id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input"
name="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input"
size="30"
value="<?php echo ((is_array($_tmp=$this->_tpl_vars['field_val'])) ? $this->_run_mod_handler('lookup', true, $_tmp, $this->_tpl_vars['field_options']) : smarty_modifier_lookup($_tmp, $this->_tpl_vars['field_options'])); ?>
"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-down.png"), $this);?>
" id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-image"></button><button type="button"
id="btn-clear-<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input', '<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
');sync_<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
()"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<?php echo '
<script>
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo ' = [];
'; ?>

<?php echo '
(function (){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['priority']['name'];  echo '");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:\'\'};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use(\'datasource\', \'datasource-jsonschema\',function (Y) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value==\'\' && selectElem.options[i].innerHTML==\'\'))
ret.push({\'key\':selectElem.options[i].value,\'text\':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
'; ?>

<?php echo '
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputNode = Y.one('#<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input');
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputImage = Y.one('#<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
-image');
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputHidden = Y.one('#<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
');
<?php echo '
function SyncToHidden(selectme){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['priority']['name'];  echo '");
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
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'change\');
}
//global variable 
sync_';  echo $this->_tpl_vars['fields']['priority']['name'];  echo ' = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['priority']['name'];  echo '");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.simulate(\'keyup\');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById(\'';  echo $this->_tpl_vars['fields']['priority']['name']; ?>
-input<?php echo '\'))
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.set(\'value\',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("';  echo $this->_tpl_vars['fields']['priority']['name'];  echo '", syncFromHiddenToWidget);
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 0;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 0;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions = <?php echo count($this->_tpl_vars['field_options']); ?>
;
if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 300) <?php echo '{
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 200;
<?php echo '
}
'; ?>

if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 3000) <?php echo '{
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 500;
<?php echo '
}
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.optionsVisible = false;
<?php echo '
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
'; ?>

minQueryLength: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen,
queryDelay: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay,
zIndex: 99999,
<?php echo '
source: SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds,
resultTextLocator: \'text\',
resultHighlighter: \'phraseMatch\',
resultFilters: \'phraseMatch\',
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName(\'dccontent\');
if(hover[0] != null){
if (ex) {
var h = \'1000px\';
hover[0].style.height = h;
}
else{
hover[0].style.height = \'\';
}
}
}
if('; ?>
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen<?php echo ' == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function () {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.sendRequest(\'\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible = true;
});
}
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'click\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'click\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'dblclick\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'dblclick\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'focus\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mouseup\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mouseup\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mousedown\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mousedown\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'blur\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'blur\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible = false;
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['priority']['name'];  echo '");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.set(\'value\', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputImage.ancestor().on(\'click\', function () {
if (SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.blur();
} else {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.focus();
}
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'query\', function () {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.set(\'value\', \'\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'visibleChange\', function (e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'select\', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
'; ?>

<?php endif; ?>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='case_type_title_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_TYPE_TITLE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="case_type_title"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['case_type_title']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['case_type_title']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['case_type_title']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['case_type_title']['name']; ?>
' 
id='<?php echo $this->_tpl_vars['fields']['case_type_title']['name']; ?>
' size='30' 
maxlength='255' 
value='<?php echo $this->_tpl_vars['value']; ?>
' title=''      >
<td valign="top" id='qb_date_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_QB_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="qb_date"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['QB_DATE']; ?>

</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='amount_paid_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_PAID','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="amount_paid"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['amount_paid']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['amount_paid']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['amount_paid']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['amount_paid']['name']; ?>
'
id='<?php echo $this->_tpl_vars['fields']['amount_paid']['name']; ?>
'
size='30'
maxlength='25'value='<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['value'],'precision' => 2), $this);?>
'
title=''
tabindex='0'
>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_CASE_INFORMATION").style.display='none';</script>
<?php endif; ?>
<div id="LBL_CREDIT_ALLOCATION">
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam <?php echo ((is_array($_tmp=@$this->_tpl_vars['def']['templateMeta']['panelClass'])) ? $this->_run_mod_handler('default', true, $_tmp, 'edit view dcQuickEdit edit508') : smarty_modifier_default($_tmp, 'edit view dcQuickEdit edit508')); ?>
">
<tr>
<th align="left" colspan="8">
<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CREDIT_ALLOCATION','module' => 'Cases'), $this);?>
</h4>
</th>
</tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='client_consultant_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CLIENT_CONSULTANT_NAME','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="client_consultant_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<input accesskey=""  tabindex="0"  type = "text" id = "client_consultant_name" name = "client_consultant_name" value = "<?php echo $this->_tpl_vars['CONSULTANT_NAME']; ?>
" readonly = "true" /><input accesskey=""  tabindex="0"  type = "hidden" id = "client_consultant_id" name ="client_consultant_id" value = "<?php echo $this->_tpl_vars['CONSULTANT_ID']; ?>
"/>
<td valign="top" id='credit_date_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CREDIT_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="credit_date"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['CREDIT_DATE']; ?>

</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='credit_alloc_notes_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ALLOC_NOTES','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="credit_alloc_notes"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (empty ( $this->_tpl_vars['fields']['credit_alloc_notes']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['credit_alloc_notes']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['credit_alloc_notes']['value']);  endif; ?>  
<textarea  id='<?php echo $this->_tpl_vars['fields']['credit_alloc_notes']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['credit_alloc_notes']['name']; ?>
'
rows="4" 
cols="60" 
title='' tabindex="0" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
&nbsp;
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['CREDIT_ALLOCATION']; ?>
<input accesskey=""  tabindex="0"  type = "hidden" name = "cnt_value" id = "cnt_value" value = "<?php echo $this->_tpl_vars['CNT_VALUE']; ?>
" /> <input accesskey=""  tabindex="0"  type="hidden" name="credit_dt_hidden" id="credit_dt_hidden" value=<?php echo $this->_tpl_vars['CREDIT_DATE_HID']; ?>
 />
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_CREDIT_ALLOCATION").style.display='none';</script>
<?php endif; ?>
<div id="LBL_EDIT_FILING">
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam <?php echo ((is_array($_tmp=@$this->_tpl_vars['def']['templateMeta']['panelClass'])) ? $this->_run_mod_handler('default', true, $_tmp, 'edit view dcQuickEdit edit508') : smarty_modifier_default($_tmp, 'edit view dcQuickEdit edit508')); ?>
">
<tr>
<th align="left" colspan="8">
<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDIT_FILING','module' => 'Cases'), $this);?>
</h4>
</th>
</tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Filing date','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['FILING_DATE']; ?>

<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'Application Number','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['APP_NO']; ?>

</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FILING_RECEIPT','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<input accesskey=""  tabindex="0"  type = "checkbox" id = "freceipt" name = "freceipt"  onclick = changeFrecipt() <?php echo $this->_tpl_vars['F_RECEIPT']; ?>
 value = "<?php echo $this->_tpl_vars['FRECIPT_VALUE']; ?>
" />
<td valign="top" id='patent_number_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_NUMBER','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for="patent_number"><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<input accesskey=""  tabindex="0"  type = "text" name = "patent_number" id = "patent_number" value = "<?php echo $this->_tpl_vars['PATENT_NUMBER_VALUE']; ?>
" style="<?php echo $this->_tpl_vars['PATENT_NUMBER_HIDE']; ?>
" />
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_EDIT_FILING").style.display='none';</script>
<?php endif; ?>
<div id="LBL_EDIT_TM_FILING">
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  class="yui3-skin-sam <?php echo ((is_array($_tmp=@$this->_tpl_vars['def']['templateMeta']['panelClass'])) ? $this->_run_mod_handler('default', true, $_tmp, 'edit view dcQuickEdit edit508') : smarty_modifier_default($_tmp, 'edit view dcQuickEdit edit508')); ?>
">
<tr>
<th align="left" colspan="8">
<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_EDIT_TM_FILING','module' => 'Cases'), $this);?>
</h4>
</th>
</tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'TM Filing date','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['TM_FILING_DATE']; ?>

<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'TM Application No','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['TM_APP_NO']; ?>

</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'TM Registration Date','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['TM_REG_DT']; ?>

<td valign="top" id='_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'TM Registration No','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean(); ?>
<label for=""><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:</label>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo $this->_tpl_vars['TM_REG_NO']; ?>

</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("LBL_EDIT_TM_FILING").style.display='none';</script>
<?php endif; ?>
</div></div>

<input type="hidden" id="record_id" name="record_id" value = <?php echo $this->_tpl_vars['BEAN_ID']; ?>
 />
<input type="hidden" id="client_name_popup" name="client_name_popup" value="<?php echo $this->_tpl_vars['CLIENT_POPUP_NAME']; ?>
" />
<input type="hidden" id="client_id_popup" name="client_id_popup" value="<?php echo $this->_tpl_vars['CLIENT_POPUP_ID']; ?>
" />
<!--<div id="search_patent" class="edit view" style="<?php echo $this->_tpl_vars['HIDE_SHOW']; ?>
">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td id="heading"><?php echo $this->_tpl_vars['SEARCH_PATENT']; ?>
</td>
<td>
<input type="hidden" id="record_id" name="record_id" value = <?php echo $this->_tpl_vars['BEAN_ID']; ?>
 />
</td>
</tr>
</table>	
<table >	
<tr>
Date : 16-Jan-2012. Author : Basudeba Rath. 
<input type="hidden" id="client_name_popup" name="client_name_popup" value="<?php echo $this->_tpl_vars['CLIENT_POPUP_NAME']; ?>
" />
<input type="hidden" id="client_id_popup" name="client_id_popup" value="<?php echo $this->_tpl_vars['CLIENT_POPUP_ID']; ?>
" />
<td id="lbl_ril" style="<?php echo $this->_tpl_vars['RIL']; ?>
">Related To Invention :</td>
<td id = "ril" style="<?php echo $this->_tpl_vars['RIL']; ?>
">
<input type="text" name="invention_name" class="sqsEnabled" tabindex="103" id="invention_name" size="25" value="<?php echo $this->_tpl_vars['INVENTION_NAME']; ?>
" title='' autocomplete="off" >
<input type="hidden" name="invention_id" id="invention_id" value="<?php echo $this->_tpl_vars['INVENTION_ID']; ?>
">
<input type="button" name="btn_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_KEY']; ?>
" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
" onclick="open_popup('Inv_Inventions', 600, 400, '&inv_inventions_accounts_name='+ document.getElementById('client_name_popup').value+'&inv_inventd1acccounts_ida='+document.getElementById('client_id_popup').value, true, false, <?php echo '{\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'invention_id\',\'name\':\'invention_name\'}}'; ?>
, 'single', true);this.form.invention_name.focus();">
<input type="button" name="btn_clr_invention_cases_c" id="btn_invention_cases_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_KEY']; ?>
" class="button" onclick="this.form.invention_name.value = '';this.form.invention_id.value = '';" value="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
">
<script type="text/javascript">
			
				enableQS(false);
			
			</script>
</td>
Date : 16-Jan-2012. 
<td id="lbl_trademark" style="<?php echo $this->_tpl_vars['TRADEMARK_POPUP']; ?>
">
Related To Trademark:
</td>
<td id="trademark" style="<?php echo $this->_tpl_vars['TRADEMARK_POPUP']; ?>
">
<input type="text" name="trade_trademark_cases_name" class="sqsEnabled" tabindex="103" id="trade_trademark_cases_name" size="25" value="<?php echo $this->_tpl_vars['TRADEMARK_DESC']; ?>
" title='' autocomplete="off">
<input type="hidden" name="trade_trademark_casestrade_trademark_ida" id="trade_trademark_casestrade_trademark_ida" value="<?php echo $this->_tpl_vars['TRADEMARK_ID']; ?>
">
<input type="button" name="btn_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_KEY']; ?>
" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
" onclick=" open_popup('trade_trademark', 600, 400, '&trade_trademark_accounts_name='+ document.getElementById('client_name_popup').value+'&trade_trademark_accountsaccounts_ida='+document.getElementById('client_id_popup').value,true,false,<?php echo '{\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'trade_trademark_casestrade_trademark_ida\',\'name\':\'trade_trademark_cases_name\'}}'; ?>
, 'single', true);this.form.login_name.focus();">
<input type="button" name="btn_clr_trademark_cases_c" id="btn_trademark_cases_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_KEY']; ?>
" class="button" onclick="this.form.trade_trademark_cases_name.value = '';this.form.trade_trademark_casestrade_trademark_ida.value = '';" value="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
">
<script type="text/javascript">
			
				enableQS(false);
			
			</script>
</td>
</tr>	
<tr>	
<td style="<?php echo $this->_tpl_vars['SEARCH_TYPE_LABEL']; ?>
" id="search_type_label"> Search Type : </td>
<td>
<select id="search_type" name="search_type" style="<?php echo $this->_tpl_vars['SERARCHTYPE']; ?>
"> <?php echo $this->_tpl_vars['SEARCH_TYPE']; ?>
</select>
</td>
</tr>
</table>
</div>-->
<input type="hidden" id="user_id" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
" />
<div id="UsersPopUp" class="edit view" style="<?php echo $this->_tpl_vars['USER_LISTS']; ?>
">
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
<?php echo $this->_tpl_vars['ITEM_ROWS']; ?>

</table>
</td>
</tr>
<tr width="100%">
<td width="37.5%" valign="top" colspan="3">
<input type="hidden" id="item_count" name="item_count" value="<?php echo $this->_tpl_vars['item_count']; ?>
"/>
<input type="button" onClick="addRow();" title="ADD" value="ADD" class="button" name="button" tabindex="125">&nbsp;&nbsp;
<input type="button" onClick="removeRow();" title="DELETE" value="DELETE" class="button" name="button" tabindex="125">
</td>
</tr>
<tr width="100%">
<td  valign="top" scope="row" id="_label">
<div id="item_details" style="display:none;">
<table id='item_details_table'>
<tr width="100%">
<td><input type="text" name="login_name" class="sqsEnabled" tabindex="103" id="login_name" size="25" value="<?php echo $this->_tpl_vars['LOGIN_DESC']; ?>
" title='' autocomplete="off">
<input type="hidden" name="login_id" id="login_id" value="<?php echo $this->_tpl_vars['LOGIN_ID']; ?>
">
<input type="button" name="btn_user_c" id="btn_user_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_KEY']; ?>
" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
" onclick=" open_popup('Users', 600, 400, '', true, false, <?php echo '{\'call_back_function\':\'set_return\',\'form_name\':\'EditView\',\'field_to_name_array\':{\'id\':\'login_id\',\'name\':\'login_name\'}}'; ?>
, 'single', true);this.form.login_name.focus();">
<input type="button" name="btn_clr_login_c" id="btn_clr_user_c" tabindex="103" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_KEY']; ?>
" class="button" onclick="this.form.login_name.value = '';this.form.login_id.value = '';" value="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
">
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
<div class="edit view" style="<?php echo $this->_tpl_vars['CLAIM_DIV']; ?>
" id="clim_div">
<table>
<caption align="left"><h3>Claim Priority</h3></caption>
<tr>
<td width="37.5%"><input type = "button"  style="<?php echo $this->_tpl_vars['BTN_CLAIM']; ?>
" value = "In Possession" id ="btn_priority" name = "btn_priority" onclick = "openPopup();" /> </td>
<td width="37.5%">
<input type = "button"  style="<?php echo $this->_tpl_vars['BTN_CLAIM']; ?>
" value = "No Possession" id ="btn_np" name = "btn_np" onclick = "popup_no_possession();" /> 
</td>
</tr>
</table>
</div>
<div id="clm_info">
<input type="hidden" id="clm_edit" name="clm_edit" value="<?php echo $this->_tpl_vars['CLM_EDIT']; ?>
" />
<input type="hidden" id="clm_ids" name="clm_ids" value="" />
<input type="hidden" id="clm_np_ids" name="clm_np_ids" value="" />
</div>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "custom/modules/Cases/popups.js"), $this);?>
"></script>

<div class="buttons">
<?php if ($this->_tpl_vars['bean']->aclAccess('save')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary" onclick="<?php if ($this->_tpl_vars['isDuplicate']): ?>this.form.return_id.value=''; <?php endif; ?>this.form.action.value='Save'; if(check_form('EditView'))SUGAR.ajaxUI.submitForm(this.form);return false;" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" id="SAVE_FOOTER"><?php endif; ?> 
<?php if (! empty ( $_REQUEST['return_action'] ) && ( $_REQUEST['return_action'] == 'DetailView' && ! empty ( $_REQUEST['return_id'] ) )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $_REQUEST['return_id']; ?>
'); return false;" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" type="button" id="CANCEL_FOOTER"> <?php elseif (! empty ( $_REQUEST['return_action'] ) && ( $_REQUEST['return_action'] == 'DetailView' && ! empty ( $this->_tpl_vars['fields']['id']['value'] ) )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=DetailView&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_FOOTER"> <?php elseif (empty ( $_REQUEST['return_action'] ) || empty ( $_REQUEST['return_id'] ) && ! empty ( $this->_tpl_vars['fields']['id']['value'] )): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=Cases'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_FOOTER"> <?php else: ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="SUGAR.ajaxUI.loadContent('index.php?action=index&module=<?php echo $_REQUEST['return_module']; ?>
&record=<?php echo $_REQUEST['return_id']; ?>
'); return false;" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" id="CANCEL_FOOTER"> <?php endif;  if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Cases", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?>
</div>
</form>
<?php echo $this->_tpl_vars['set_focus_block']; ?>

<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){SUGAR.util.buildAccessKeyLabels();});
</script><?php echo $this->_tpl_vars['overlibStuff']; ?>

<script type="text/javascript">
YAHOO.util.Event.onContentReady("EditView",
    function () { initEditView(document.forms.EditView) });
//window.setTimeout(, 100);
window.onbeforeunload = function () { return onUnloadEditView(); };
</script><?php echo '
<script type="text/javascript">
addForm(\'EditView\');addToValidate(\'EditView\', \'name\', \'name\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SUBJECT','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'date_entered_date\', \'date\', false,\'Date Created\' );
addToValidate(\'EditView\', \'date_modified_date\', \'date\', false,\'Date Modified\' );
addToValidate(\'EditView\', \'modified_user_id\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'modified_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'created_by\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'created_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'description\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPTION','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'deleted\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DELETED','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'assigned_user_id\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_ID','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'assigned_user_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'case_number\', \'varchar\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'type\', \'char\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'status\', \'char\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'priority\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITY','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'resolution\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RESOLUTION','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'work_log\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_WORK_LOG','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'modified_status_date\', \'date\', false,\'Modified Status Date\' );
addToValidate(\'EditView\', \'case_type_title\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_TYPE_TITLE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'user_name\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_USER_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'patent_number\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'client_consultant_id\', \'char\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CLIENT_CONSULTANT_ID','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'client_consultant_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CLIENT_CONSULTANT_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'amount_owed\', \'decimal\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_OWED','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'case_start_date_date\', \'date\', false,\'Start Date\' );
addToValidate(\'EditView\', \'case_end_date_date\', \'date\', false,\'Completion Date\' );
addToValidate(\'EditView\', \'prioritydate\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITYDATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'patent_publication_number\', \'int\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_PUBLICATION_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'patent_issued_number\', \'varchar\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_ISSUED_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'tm_filing_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TM_FILING_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'tm_application_number\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TM_APPLICATION_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'tm_registration_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TM_REGISTRATION_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'tm_registration_number\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TM_REGISTRATION_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'tm_classes[]\', \'multienum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TM_CLASSES','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'case_status_age\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_STATUS_AGE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'spec_writing_call\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SPEC_WRITING_CALL','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'patent_drawing_fee\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_DRAWING_FEE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'caseoverride\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASEOVER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'casetype\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_TYPE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'type_name\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'status_name\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'casestatus\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'invention\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVENTION_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'invention_id\', \'char\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVENTION_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'invention_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVENTION_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'search_type\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SEARCH_TYPE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'due_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DUE_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'filing_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FILING_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'application_number\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_APPLICATION_NUMBER','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'freceipt\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FILING_RECEIPT','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'assigned_to[]\', \'multienum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'credit_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREDIT_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'credit_alloc_notes\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALLOC_NOTES','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'account_name\', \'relate\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'account_id\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_ID','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'relatedtoparent\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RELATED_TO_PARENT','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'case_origin\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_ORIGIN','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'amount_paid\', \'decimal\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_PAID','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'qb_date\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_QB_DATE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'date_case_status_modified_date\', \'date\', false,\'LBL_DATE_CASE_STATUS_MODIFIED\' );
addToValidate(\'EditView\', \'case_end_user_id\', \'char\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_END_USER_ID','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'case_end_user_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_END_USER_NAME','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidate(\'EditView\', \'trade_trademark_cases_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE','module' => 'Cases','for_js' => true), $this); echo '\' );
addToValidateBinaryDependency(\'EditView\', \'assigned_user_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Cases','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Cases','for_js' => true), $this); echo '\', \'assigned_user_id\' );
addToValidateBinaryDependency(\'EditView\', \'client_consultant_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Cases','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_CLIENT_CONSULTANT_NAME','module' => 'Cases','for_js' => true), $this); echo '\', \'client_consultant_id\' );
addToValidateBinaryDependency(\'EditView\', \'account_name\', \'alpha\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Cases','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Cases','for_js' => true), $this); echo '\', \'account_id\' );
</script><script language="javascript">if(typeof sqs_objects == \'undefined\'){var sqs_objects = new Array;}sqs_objects[\'EditView_account_name\']={"form":"EditView","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["EditView_account_name","account_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["account_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects[\'EditView_client_consultant_name\']={"form":"EditView","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>'; ?>
