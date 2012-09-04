<?php /* Smarty version 2.6.11, created on 2012-09-04 14:30:43
         compiled from cache/modules/Cases/DetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Cases/DetailView.tpl', 32, false),array('function', 'counter', 'cache/modules/Cases/DetailView.tpl', 37, false),array('function', 'sugar_translate', 'cache/modules/Cases/DetailView.tpl', 38, false),array('function', 'sugar_ajax_url', 'cache/modules/Cases/DetailView.tpl', 158, false),array('function', 'sugar_number_format', 'cache/modules/Cases/DetailView.tpl', 492, false),array('function', 'sugar_getjspath', 'cache/modules/Cases/DetailView.tpl', 846, false),array('modifier', 'strip_semicolon', 'cache/modules/Cases/DetailView.tpl', 48, false),)), $this); ?>


<table cellpadding="1" cellspacing="0" border="0" width="100%" class="actionsContainer">
<tr>
<td class="buttons" align="left" NOWRAP>
<form action="index.php" method="post" name="DetailView" id="form">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<input type="hidden" name="action" value="EditView">
<?php if ($this->_tpl_vars['bean']->aclAccess('edit')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="button primary" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; this.form.action.value='EditView';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Edit" id="edit_button" value="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
"><?php endif; ?> 
<?php if ($this->_tpl_vars['bean']->aclAccess('edit')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_KEY']; ?>
" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.isDuplicate.value=true; this.form.action.value='EditView'; this.form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Duplicate" value="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_LABEL']; ?>
" id="duplicate_button"><?php endif; ?> 
<?php if ($this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='ListView'; this.form.action.value='Delete'; return confirm('<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
');" type="submit" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
" id="delete_button"><?php endif; ?> 
<?php if ($this->_tpl_vars['bean']->aclAccess('edit') && $this->_tpl_vars['bean']->aclAccess('delete')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_DUP_MERGE']; ?>
" class="button" onclick="this.form.return_module.value='Cases'; this.form.return_action.value='DetailView'; this.form.return_id.value='<?php echo $this->_tpl_vars['id']; ?>
'; this.form.action.value='Step1'; this.form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(this.form);" type="button" name="Merge" value="<?php echo $this->_tpl_vars['APP']['LBL_DUP_MERGE']; ?>
" id="merge_duplicate_button"><?php endif; ?> 
<?php echo $this->_tpl_vars['WORKFLOW_BUTTONS']; ?>

<?php echo $this->_tpl_vars['FLAGCASE']; ?>

<input type = "hidden" value = "<?php echo $this->_tpl_vars['USER_ID']; ?>
" id = "user_id" name = "user_id"><input type = "hidden" value = "<?php echo $this->_tpl_vars['BEAN_ID']; ?>
" id = "record_id" name = "record_id" >
</form>
</td>
<td class="buttons" align="left" NOWRAP>
<?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Cases", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?>
</td>
<td align="right" width="100%"><?php echo $this->_tpl_vars['ADMIN_EDIT']; ?>

<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<div id="Cases_detailview_tabs"
>
<div >
<div id='LBL_CASE_INFORMATION' class='detail view  detail508'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_INFORMATION','module' => 'Cases'), $this);?>
</h4>
<table id='detailpanel_1' cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['case_number']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_NUMBER','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['case_number']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['case_number']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['case_number']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['case_number']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['case_number']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['case_number']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['priority']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITY','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['priority']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['priority']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['priority']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['priority']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['priority']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['priority']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['priority']['options'][$this->_tpl_vars['fields']['priority']['value']]; ?>

<?php endif;  endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['status']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['status']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="status" class="sugar_field"><?php echo $this->_tpl_vars['STATUS']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['case_status_age']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_STATUS_AGE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['case_status_age']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['case_status_age']['name']; ?>
">
<?php $this->assign('value', $this->_tpl_vars['fields']['case_status_age']['value']);  echo $this->_tpl_vars['value']; ?>

</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['type']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['type']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="type" class="sugar_field"><?php echo $this->_tpl_vars['TYPE']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['account_name']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['account_name']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['account_id']['value'] )):  ob_start(); ?>index.php?module=Accounts&action=DetailView&record=<?php echo $this->_tpl_vars['fields']['account_id']['value'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('detail_url', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo smarty_function_sugar_ajax_url(array('url' => $this->_tpl_vars['detail_url']), $this);?>
"><?php endif; ?>
<span id="account_id" class="sugar_field"><?php echo $this->_tpl_vars['fields']['account_name']['value']; ?>
</span>
<?php if (! empty ( $this->_tpl_vars['fields']['account_id']['value'] )): ?></a><?php endif;  endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['relatedtoparent']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_RELATED_TO_PARENT','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['relatedtoparent']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['relatedtoparent']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['relatedtoparent']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['relatedtoparent']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['relatedtoparent']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['relatedtoparent']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['relatedtoparent']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['relatedtoparent']['options'][$this->_tpl_vars['fields']['relatedtoparent']['value']]; ?>

<?php endif;  endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['search_type']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SEARCH_TYPE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['search_type']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>



<?php if (is_string ( $this->_tpl_vars['fields']['search_type']['options'] )): ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['search_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['search_type']['options']; ?>
">
<?php echo $this->_tpl_vars['fields']['search_type']['options']; ?>

<?php else: ?>
<input type="hidden" class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['search_type']['name']; ?>
" value="<?php echo $this->_tpl_vars['fields']['search_type']['value']; ?>
">
<?php echo $this->_tpl_vars['fields']['search_type']['options'][$this->_tpl_vars['fields']['search_type']['value']]; ?>

<?php endif;  endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['due_date']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DUE_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['due_date']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['due_date']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['due_date']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['due_date']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['due_date']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['due_date']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['patent_number']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_NUMBER','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['patent_number']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['patent_number']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['patent_number']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['patent_number']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['patent_number']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['patent_number']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['trade_trademark_cases_name']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TRADE_TRADEMARK_CASES_FROM_TRADE_TRADEMARK_TITLE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['trade_trademark_cases_name']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['trade_trademark_casestrade_trademark_ida']['value'] )):  ob_start(); ?>index.php?module=trade_trademark&action=DetailView&record=<?php echo $this->_tpl_vars['fields']['trade_trademark_casestrade_trademark_ida']['value'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('detail_url', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo smarty_function_sugar_ajax_url(array('url' => $this->_tpl_vars['detail_url']), $this);?>
"><?php endif; ?>
<span id="trade_trademark_casestrade_trademark_ida" class="sugar_field"><?php echo $this->_tpl_vars['fields']['trade_trademark_cases_name']['value']; ?>
</span>
<?php if (! empty ( $this->_tpl_vars['fields']['trade_trademark_casestrade_trademark_ida']['value'] )): ?></a><?php endif;  endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['invention_name']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_INVENTION_NAME','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['invention_name']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! empty ( $this->_tpl_vars['fields']['invention_id']['value'] )):  ob_start(); ?>index.php?module=Inv_Inventions&action=DetailView&record=<?php echo $this->_tpl_vars['fields']['invention_id']['value'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('detail_url', ob_get_contents());ob_end_clean(); ?>
<a href="<?php echo smarty_function_sugar_ajax_url(array('url' => $this->_tpl_vars['detail_url']), $this);?>
"><?php endif; ?>
<span id="invention_id" class="sugar_field"><?php echo $this->_tpl_vars['fields']['invention_name']['value']; ?>
</span>
<?php if (! empty ( $this->_tpl_vars['fields']['invention_id']['value'] )): ?></a><?php endif;  endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['case_start_date']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_START_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['case_start_date']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['case_start_date']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['case_start_date']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['case_start_date']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['case_start_date']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['case_start_date']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['case_end_date']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_END_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['case_end_date']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="case_end_date" class="sugar_field"><?php echo $this->_tpl_vars['fields']['case_end_date']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['case_end_user_name']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_ENTERED','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['date_entered']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="date_entered" class="sugar_field"><?php echo $this->_tpl_vars['fields']['date_entered']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['created_by_name']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['date_modified']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_MODIFIED','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['date_modified']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="date_modified" class="sugar_field"><?php echo $this->_tpl_vars['fields']['date_modified']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['modified_by_name']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['case_type_title']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CASE_TYPE_TITLE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['case_type_title']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['case_type_title']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['case_type_title']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['case_type_title']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['case_type_title']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['case_type_title']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['client_consultant_name']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_CLIENT_CONSULTANT_NAME','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['client_consultant_name']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span id="client_consultant_id" class="sugar_field"><?php echo $this->_tpl_vars['fields']['client_consultant_name']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['spec_writing_call']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_SPEC_WRITING_CALL','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['spec_writing_call']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['spec_writing_call']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['spec_writing_call']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['spec_writing_call']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['spec_writing_call']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['spec_writing_call']['value']; ?>
</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['patent_drawing_fee']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PATENT_DRAWING_FEE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['patent_drawing_fee']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['patent_drawing_fee']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['patent_drawing_fee']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['patent_drawing_fee']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['patent_drawing_fee']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['patent_drawing_fee']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['amount_paid']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_PAID','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['amount_paid']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['amount_paid']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['amount_paid']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['qb_date']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_QB_DATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['qb_date']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['qb_date']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['qb_date']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['qb_date']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['qb_date']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['qb_date']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_CLIENT_EMAIL','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="" class="sugar_field"><?php echo $this->_tpl_vars['PRIMARY_CLIENT_EMAIL']; ?>
</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_CLIENT_PHONE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<td width='37.5%'  >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="" class="sugar_field"><?php echo $this->_tpl_vars['PRIMARY_CLIENT_PHONE']; ?>
</span>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['modified_status']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED_STATUS','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%' colspan='3' >
<?php if (! $this->_tpl_vars['fields']['modified_status']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id="modified_status" class="sugar_field"><?php echo $this->_tpl_vars['fields']['modified_status']['value']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_BY']; ?>
 <?php echo $this->_tpl_vars['fields']['modified_by_name']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0 && ! $this->_tpl_vars['useTabs']): ?>}
<script>document.getElementById("LBL_CASE_INFORMATION").style.display='none';</script>
<?php endif; ?>
<div id='LBL_PANEL_ASSIGNMENT' class='detail view  detail508'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<h4><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PANEL_ASSIGNMENT','module' => 'Cases'), $this);?>
</h4>
<table id='detailpanel_2' cellspacing='<?php echo $this->_tpl_vars['gridline']; ?>
'>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php echo smarty_function_counter(array('name' => 'fieldsHidden','start' => 0,'print' => false,'assign' => 'fieldsHidden'), $this);?>

<?php ob_start(); ?>
<tr>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['amount_owed']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT_OWED','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['amount_owed']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['amount_owed']['name']; ?>
">
<?php echo smarty_function_sugar_number_format(array('var' => $this->_tpl_vars['fields']['amount_owed']['value'],'precision' => 2), $this);?>

</span>
<?php endif; ?>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>

<td width='12.5%' scope="col">
<?php if (! $this->_tpl_vars['fields']['prioritydate']['hidden']):  ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITYDATE','module' => 'Cases'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<?php endif; ?>
</td>
<td width='37.5%'  >
<?php if (! $this->_tpl_vars['fields']['prioritydate']['hidden']):  echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['prioritydate']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['prioritydate']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['prioritydate']['value']);  endif; ?> 
<span class="sugar_field" id="<?php echo $this->_tpl_vars['fields']['prioritydate']['name']; ?>
"><?php echo $this->_tpl_vars['fields']['prioritydate']['value']; ?>
</span>
<?php endif; ?>
</td>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0 && $this->_tpl_vars['fieldsUsed'] != $this->_tpl_vars['fieldsHidden']):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0 && ! $this->_tpl_vars['useTabs']): ?>}
<script>document.getElementById("LBL_PANEL_ASSIGNMENT").style.display='none';</script>
<?php endif; ?>
</div></div>

<!--
AUTHOR: BASUDEBA RATH
DATE: 25-Nov-2011
VEON CONSULTING PVT LTD.
-->
<div id="app_filed"  class="detail view" style="<?php echo $this->_tpl_vars['VISIBITY']; ?>
" > 
<table >
<tr>
<td align="left"> <h4><?php echo $this->_tpl_vars['APPLICATION_FILED']; ?>
</h4></td>
<td></td>
</tr>
<tr>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['DISP_INPUT']; ?>
"  width="100%">
<tr>
<td width="7%">Filing Date : </td>
<td width="6%">
<input type="text" id="fdate" name="fdate" value="<?php echo $this->_tpl_vars['FDT']; ?>
" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger" align="absmiddle" />
</td>
<td width="7%">Application Number : </td>
<td width="5%"><input type="text" id="ano" name="ano" value = "<?php echo $this->_tpl_vars['ANO']; ?>
" /></td>
<td width="7%">Filing Receipt : </td>
<td width="5%"><input type="checkbox" id="freceipt" name="freceipt" class="ac_input"/></td>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['IP_LBL_PN']; ?>
" width="100%">
<tr>	
<td width="20%">Publication Number</td>
<td width="15%"><input type="text" id="pp_number" name="pp_number" /></td>
<td width="20%">Issued Number</td>
<td width="15%"><input type="text" id="pi_number" name="pi_number" /></td>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['DISPLAY_DET']; ?>
" width="100%">
<tr>
<td>Filing Date:</td>
<td><?php echo $this->_tpl_vars['FDATE']; ?>
</td>
<td>Application Number :</td>
<td><?php echo $this->_tpl_vars['APP_NO']; ?>
</td>
<td>Filing Receipt : </td>
<td><input type = "checkbox" name = "freceipt" id = "freceipt" <?php echo $this->_tpl_vars['F_RECEIPT']; ?>
  disabled="disabled"/></td>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['DET_LBL_PN']; ?>
" width="100%">
<tr>	
<td>Patent Publication Number :</td>
<td><?php echo $this->_tpl_vars['PUBLICATION_NO']; ?>
</td>
<td>Patent Issued Number :</td>
<td><?php echo $this->_tpl_vars['ISSUED_NO']; ?>
</td>
</tr>
</table>
</div>
<div id="tm_app_filed"  class="detail view" style="<?php echo $this->_tpl_vars['TM_VISIBITY']; ?>
">
<table>
<tr>
<td align="left"> <h4><?php echo $this->_tpl_vars['TM_APPLICATION_FILED']; ?>
</h4></td>
<td></td>
</tr>
<tr>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['DISP_TA_INPUT']; ?>
">
<tr>
<td>TM Filing Date : </td>
<td>
<input type="text" id="tm_fdate" name="tm_fdate" value="<?php echo $this->_tpl_vars['TM_FDATE_VAL']; ?>
" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger1" align="absmiddle" />
</td>
<td>Application Number : </td>
<td><input type="text" id="tm_ano" name="tm_ano" value="<?php echo $this->_tpl_vars['TM_APP_NO_VAL']; ?>
" /></td>
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
<input type="text" id="tm_registration_date" name="tm_registration_date"  value = "<?php echo $this->_tpl_vars['TM_REG_DT_VAL']; ?>
" />
<img border="0" src="themes/Sugar5/images/jscalendar.gif?s=56edbfd31f58ddaef7105e2f7049754f&c=1" alt="Enter Date" id="created_trigger2" align="absmiddle" />
</td>
<td>Registration No.:</td>
<td><input type="text" id="tm_registration_number" name="tm_registration_number" value="<?php echo $this->_tpl_vars['TM_REG_NO_VAL']; ?>
" /></td>
<td></td><td></td>
</tr>
</table>
<table style="<?php echo $this->_tpl_vars['TM_FILING']; ?>
" >
<tr>
<td>TM Filing Date:</td>
<td><?php echo $this->_tpl_vars['TM_FDATE']; ?>
</td>
<td>TM Registration Date : </td>
<td><?php echo $this->_tpl_vars['TM_REG_DATE']; ?>
</td>
<td>TM Classes : </td>
<td><?php echo $this->_tpl_vars['TM_CLASSES_VALUES']; ?>
</td>
</tr>
<tr>	
<td>TM Application Number :</td>
<td><?php echo $this->_tpl_vars['TM_APP_NO']; ?>
</td>
<td>Registration No.:</td>
<td><?php echo $this->_tpl_vars['TM_REG_NO']; ?>
</td>
<td></td>
<td></td>
</tr>
</table>
</div>
<div id="contribute" class="detail view">
<b><?php echo $this->_tpl_vars['CONTRIBUTE']; ?>
</b>
<?php echo $this->_tpl_vars['CONT_LISTS']; ?>

<input type="button" name="btn_cont" id="btn_cont" value = "Contribute Case" onclick="contributeCase(this.id);" />
<input type="button" name="btn_assigned" id="btn_assigned" value="Assign to Case"  onclick="open_assign_popup();" <?php echo $this->_tpl_vars['DIS_BTN_ASSIGNTO']; ?>
 />
</div>
<div id="claim_priority" >
<table>
<tr>
<td scope="row" align="left" colspan="7"><h4><?php echo $this->_tpl_vars['CLAIM']; ?>
</h4></td>
<td></td>
</tr>
</table>
<table width="100%">
<tr>
<td><?php echo $this->_tpl_vars['CLAIMED_CASES']; ?>
</td>
</tr>
</table>
</div>
<!-- Added By Basudeba Rath, Date : 11-Jun-2012. -->
<div id="claimed_priority" >
<table>
<tr>
<td scope="row" align="left" colspan="7"><h4><?php echo $this->_tpl_vars['PRIORITY_CLAIMED_BY']; ?>
</h4></td>
<td></td>
</tr>
</table>
<table width="100%">
<tr>
<td><?php echo $this->_tpl_vars['PRIORITY_CLAIM_BY']; ?>
</td>
</tr>
</table>
</div>
<!--*************************************************-->
<div id="dv_case_history">
<table  border="0" cellpadding="0" cellspacing="<?php echo $this->_tpl_vars['gridline']; ?>
">
<tr>
<td scope="row" align="left" colspan="7"><h4><?php echo $this->_tpl_vars['CASE_HISTORY']; ?>
</h4></td>
<td></td>
</tr>
</table>
<?php echo $this->_tpl_vars['BUTTONS']; ?>

<!-- BEGIN: case_history -->
<table width="100%">
<tr>
<td><?php echo $this->_tpl_vars['NOTES']; ?>
</td>
</tr>
</table>
<input type="hidden" id="beanid" name="beanid" value="<?php echo $this->_tpl_vars['BEAN_ID']; ?>
" />
<input type="hidden" id="userid" name="userid" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
" />
<input type="hidden" id="noteid" name="noteid" value="<?php echo $this->_tpl_vars['NOTE_ID']; ?>
" />
<table>	
<tr>
<td align="right" width="450"><textarea name="clnt_hist" id="clnt_hist" cols="188" rows="3"><?php echo $this->_tpl_vars['NOTES_TEXT']; ?>
</textarea></td>
</tr>
</table>
<table>
<tr>
<td ><input type="button" id="btn_clnt"  value="Save" onclick="return callAjax();"></td>
<td><?php echo $this->_tpl_vars['BTN_CANCEL']; ?>
</td>
<td><input type="button" id="btn_clear" value="Clear"  onclick="clr();"></td>
</tr>
</table>
</div>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "custom/modules/Cases/WorkFlows.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "custom/modules/Cases/CaseHistory.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "custom/modules/Cases/popups.js"), $this);?>
"></script>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => "custom/modules/Cases/ClaimPriority.js"), $this);?>
"></script>