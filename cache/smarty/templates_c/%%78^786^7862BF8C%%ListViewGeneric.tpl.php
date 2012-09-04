<?php /* Smarty version 2.6.11, created on 2012-09-04 14:15:58
         compiled from include/ListView/ListViewGeneric.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'include/ListView/ListViewGeneric.tpl', 43, false),array('function', 'sugar_translate', 'include/ListView/ListViewGeneric.tpl', 58, false),array('function', 'counter', 'include/ListView/ListViewGeneric.tpl', 66, false),array('function', 'sugar_getimage', 'include/ListView/ListViewGeneric.tpl', 86, false),array('function', 'sugar_ajax_url', 'include/ListView/ListViewGeneric.tpl', 154, false),array('function', 'sugar_evalcolumn_old', 'include/ListView/ListViewGeneric.tpl', 157, false),array('function', 'sugar_field', 'include/ListView/ListViewGeneric.tpl', 159, false),array('modifier', 'default', 'include/ListView/ListViewGeneric.tpl', 69, false),array('modifier', 'lower', 'include/ListView/ListViewGeneric.tpl', 72, false),array('modifier', 'upper', 'include/ListView/ListViewGeneric.tpl', 75, false),)), $this); ?>

<script type='text/javascript' src='<?php echo smarty_function_sugar_getjspath(array('file' => 'include/javascript/popup_helper.js'), $this);?>
'></script>

<?php if ($this->_tpl_vars['overlib']): ?>
<script type='text/javascript' src='cache/include/javascript/sugar_grp_overlib.js'></script>
<div id='overDiv' style='position:absolute; visibility:hidden; z-index:1000;'></div>
<?php endif; ?>

<?php echo $this->_tpl_vars['multiSelectData']; ?>


<table cellpadding='0' cellspacing='0' width='100%' border='0' class='list view'>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'include/ListView/ListViewPagination.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr height='20'>
		<?php if ($this->_tpl_vars['prerow']): ?>
			<td width='1%' class="selectCol td_alt">
				<div>
				<input title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_SELECT_ALL_TITLE'), $this);?>
" type='checkbox' class='checkbox' name='massall' id='massall' value='' onclick='sListView.check_all(document.MassUpdate, "mass[]", this.checked);' />
				<?php echo $this->_tpl_vars['selectLink']; ?>

				</div>
			</td>
		<?php endif; ?>
		<?php if (! empty ( $this->_tpl_vars['quickViewLinks'] )): ?>
		<td class='td_alt' width='1%' style="padding: 0px;">&nbsp;</td>
		<?php endif; ?>
		<?php echo smarty_function_counter(array('start' => 0,'name' => 'colCounter','print' => false,'assign' => 'colCounter'), $this);?>

		<?php $_from = $this->_tpl_vars['displayColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['colHeader'] => $this->_tpl_vars['params']):
?>
			<th scope='col' width='<?php echo $this->_tpl_vars['params']['width']; ?>
%'>
				<div style='white-space: normal;'width='100%' align='<?php echo ((is_array($_tmp=@$this->_tpl_vars['params']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'left') : smarty_modifier_default($_tmp, 'left')); ?>
'>
                <?php if (((is_array($_tmp=@$this->_tpl_vars['params']['sortable'])) ? $this->_run_mod_handler('default', true, $_tmp, true) : smarty_modifier_default($_tmp, true))): ?>
                    <?php if ($this->_tpl_vars['params']['url_sort']): ?>
                        <a href='<?php echo $this->_tpl_vars['pageData']['urls']['orderBy'];  echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['params']['orderBy'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['colHeader']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['colHeader'])))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
' class='listViewThLinkS1'>
                    <?php else: ?>
                        <?php if (((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['params']['orderBy'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['colHeader']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['colHeader'])))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == $this->_tpl_vars['pageData']['ordering']['orderBy']): ?>
                            <a href='javascript:sListView.order_checks("<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageData']['ordering']['sortOrder'])) ? $this->_run_mod_handler('default', true, $_tmp, 'ASCerror') : smarty_modifier_default($_tmp, 'ASCerror')); ?>
", "<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['params']['orderBy'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['colHeader']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['colHeader'])))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
" , "<?php echo $this->_tpl_vars['pageData']['bean']['moduleDir'];  echo '2_';  echo ((is_array($_tmp=$this->_tpl_vars['pageData']['bean']['objectName'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp));  echo '_ORDER_BY'; ?>
")' class='listViewThLinkS1'>
                        <?php else: ?>
                            <a href='javascript:sListView.order_checks("ASC", "<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['params']['orderBy'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['colHeader']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['colHeader'])))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
" , "<?php echo $this->_tpl_vars['pageData']['bean']['moduleDir'];  echo '2_';  echo ((is_array($_tmp=$this->_tpl_vars['pageData']['bean']['objectName'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp));  echo '_ORDER_BY'; ?>
")' class='listViewThLinkS1'>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo smarty_function_sugar_translate(array('label' => $this->_tpl_vars['params']['label'],'module' => $this->_tpl_vars['pageData']['bean']['moduleDir']), $this);?>

					&nbsp;&nbsp;
					<?php if (((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['params']['orderBy'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['colHeader']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['colHeader'])))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == $this->_tpl_vars['pageData']['ordering']['orderBy']): ?>
						<?php if ($this->_tpl_vars['pageData']['ordering']['sortOrder'] == 'ASC'): ?>
							<?php ob_start(); ?>arrow_down.<?php echo $this->_tpl_vars['arrowExt'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('imageName', ob_get_contents());ob_end_clean(); ?>
                            <?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_SORT_DESC'), $this); $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('alt_sort', ob_get_contents());ob_end_clean(); ?>
							<?php echo smarty_function_sugar_getimage(array('name' => $this->_tpl_vars['imageName'],'attr' => 'align="absmiddle" border="0" ','alt' => ($this->_tpl_vars['alt_sort'])), $this);?>

						<?php else: ?>
							<?php ob_start(); ?>arrow_up.<?php echo $this->_tpl_vars['arrowExt'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('imageName', ob_get_contents());ob_end_clean(); ?>
                            <?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_SORT_ASC'), $this); $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('alt_sort', ob_get_contents());ob_end_clean(); ?>
							<?php echo smarty_function_sugar_getimage(array('name' => $this->_tpl_vars['imageName'],'attr' => 'align="absmiddle" border="0" ','alt' => ($this->_tpl_vars['alt_sort'])), $this);?>

						<?php endif; ?>
					<?php else: ?>
						<?php ob_start(); ?>arrow.<?php echo $this->_tpl_vars['arrowExt'];  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('imageName', ob_get_contents());ob_end_clean(); ?>
                        <?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_SORT'), $this); $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('alt_sort', ob_get_contents());ob_end_clean(); ?>
						<?php echo smarty_function_sugar_getimage(array('name' => $this->_tpl_vars['imageName'],'attr' => 'align="absmiddle" border="0" ','alt' => ($this->_tpl_vars['alt_sort'])), $this);?>

					<?php endif; ?>
                    </a>
				<?php else: ?>
                    <?php if (! isset ( $this->_tpl_vars['params']['noHeader'] ) || $this->_tpl_vars['params']['noHeader'] == false): ?> 
					  <?php echo smarty_function_sugar_translate(array('label' => $this->_tpl_vars['params']['label'],'module' => $this->_tpl_vars['pageData']['bean']['moduleDir']), $this);?>

                    <?php endif; ?>
				<?php endif; ?>
				</div>
			</th>
			<?php echo smarty_function_counter(array('name' => 'colCounter'), $this);?>

		<?php endforeach; endif; unset($_from); ?>
		<td class='td_alt' nowrap="nowrap" width='1%'>&nbsp;</td>
	</tr>
		
	<?php echo smarty_function_counter(array('start' => $this->_tpl_vars['pageData']['offsets']['current'],'print' => false,'assign' => 'offset','name' => 'offset'), $this);?>
	
	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rowIteration'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rowIteration']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['rowData']):
        $this->_foreach['rowIteration']['iteration']++;
?>
	    <?php echo smarty_function_counter(array('name' => 'offset','print' => false), $this);?>

        <?php $this->assign('scope_row', true); ?>

		<?php if ((1 & $this->_foreach['rowIteration']['iteration'])): ?>
			<?php $this->assign('_rowColor', $this->_tpl_vars['rowColor'][0]); ?>
		<?php else: ?>
			<?php $this->assign('_rowColor', $this->_tpl_vars['rowColor'][1]); ?>
		<?php endif; ?>
		<tr height='20' class='<?php echo $this->_tpl_vars['_rowColor']; ?>
S1'>
			<?php if ($this->_tpl_vars['prerow']): ?>
			<td width='1%' class='nowrap'>
			 <?php if (! $this->_tpl_vars['is_admin'] && is_admin_for_user && $this->_tpl_vars['rowData']['IS_ADMIN'] == 1): ?>
					<input type='checkbox' disabled="disabled" class='checkbox' value='<?php echo $this->_tpl_vars['rowData']['ID']; ?>
'>
			 <?php else: ?>
                    <input title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_SELECT_THIS_ROW_TITLE'), $this);?>
" onclick='sListView.check_item(this, document.MassUpdate)' type='checkbox' class='checkbox' name='mass[]' value='<?php echo $this->_tpl_vars['rowData']['ID']; ?>
'>
			 <?php endif; ?>
			</td>
			<?php endif; ?>
			<?php if (! empty ( $this->_tpl_vars['quickViewLinks'] )): ?>
            <?php ob_start();  if ($this->_tpl_vars['params']['dynamic_module']):  echo $this->_tpl_vars['rowData'][$this->_tpl_vars['params']['dynamic_module']];  else:  echo $this->_tpl_vars['pageData']['bean']['moduleDir'];  endif;  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('linkModule', ob_get_contents());ob_end_clean(); ?>
            <?php ob_start();  if ($this->_tpl_vars['act']):  echo $this->_tpl_vars['act'];  else: ?>EditView<?php endif;  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('action', ob_get_contents());ob_end_clean(); ?>
			<td width='2%' nowrap>
                <?php if ($this->_tpl_vars['pageData']['rowAccess'][$this->_tpl_vars['id']]['edit']): ?>
                <a title='<?php echo $this->_tpl_vars['editLinkString']; ?>
' id="edit-<?php echo $this->_tpl_vars['rowData']['ID']; ?>
"
href="index.php?module=<?php echo $this->_tpl_vars['linkModule']; ?>
&offset=<?php echo $this->_tpl_vars['offset']; ?>
&stamp=<?php echo $this->_tpl_vars['pageData']['stamp']; ?>
&return_module=<?php echo $this->_tpl_vars['linkModule']; ?>
&action=<?php echo $this->_tpl_vars['action']; ?>
&record=<?php echo $this->_tpl_vars['rowData']['ID']; ?>
"
                >
                    <?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LNK_EDIT'), $this); $this->_smarty_vars['capture']['tmp1'] = ob_get_contents();  $this->assign('alt_edit', ob_get_contents());ob_end_clean(); ?>
                    <?php echo smarty_function_sugar_getimage(array('name' => "edit_inline.gif",'attr' => 'border="0" ','alt' => ($this->_tpl_vars['alt_edit'])), $this);?>
</a>
                <?php endif; ?>
            </td>

			<?php endif; ?>
			<?php echo smarty_function_counter(array('start' => 0,'name' => 'colCounter','print' => false,'assign' => 'colCounter'), $this);?>

			<?php $_from = $this->_tpl_vars['displayColumns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['col'] => $this->_tpl_vars['params']):
?>
			    <?php echo '<td ';  if ($this->_tpl_vars['scope_row']):  echo ' scope=\'row\' ';  endif;  echo ' align=\'';  echo ((is_array($_tmp=@$this->_tpl_vars['params']['align'])) ? $this->_run_mod_handler('default', true, $_tmp, 'left') : smarty_modifier_default($_tmp, 'left'));  echo '\' valign="top" class="';  if (( $this->_tpl_vars['params']['type'] == 'teamset' )):  echo 'nowrap';  endif;  echo '';  if (preg_match ( '/PHONE/' , $this->_tpl_vars['col'] )):  echo ' phone';  endif;  echo '">';  if ($this->_tpl_vars['col'] == 'NAME' || $this->_tpl_vars['params']['bold']):  echo '<b>';  endif;  echo '';  if ($this->_tpl_vars['params']['link'] && ! $this->_tpl_vars['params']['customCode']):  echo '';  ob_start();  echo '';  if ($this->_tpl_vars['params']['dynamic_module']):  echo '';  echo $this->_tpl_vars['rowData'][$this->_tpl_vars['params']['dynamic_module']];  echo '';  else:  echo '';  echo ((is_array($_tmp=@$this->_tpl_vars['params']['module'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['pageData']['bean']['moduleDir']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['pageData']['bean']['moduleDir']));  echo '';  endif;  echo '';  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('linkModule', ob_get_contents());ob_end_clean();  echo '';  ob_start();  echo '';  if ($this->_tpl_vars['act']):  echo '';  echo $this->_tpl_vars['act'];  echo '';  else:  echo 'DetailView';  endif;  echo '';  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('action', ob_get_contents());ob_end_clean();  echo '';  ob_start();  echo '';  echo ((is_array($_tmp=@$this->_tpl_vars['rowData'][$this->_tpl_vars['params']['id']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['rowData']['ID']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['rowData']['ID']));  echo '';  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('record', ob_get_contents());ob_end_clean();  echo '';  ob_start();  echo 'index.php?module=';  echo $this->_tpl_vars['linkModule'];  echo '&offset=';  echo $this->_tpl_vars['offset'];  echo '&stamp=';  echo $this->_tpl_vars['pageData']['stamp'];  echo '&return_module=';  echo $this->_tpl_vars['linkModule'];  echo '&action=';  echo $this->_tpl_vars['action'];  echo '&record=';  echo $this->_tpl_vars['record'];  echo '';  $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('url', ob_get_contents());ob_end_clean();  echo '<';  echo ((is_array($_tmp=@$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']][$this->_tpl_vars['params']['ACLTag']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']]['MAIN']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']]['MAIN']));  echo ' href="';  echo smarty_function_sugar_ajax_url(array('url' => $this->_tpl_vars['url']), $this); echo '">';  endif;  echo '';  if ($this->_tpl_vars['params']['customCode']):  echo '';  echo smarty_function_sugar_evalcolumn_old(array('var' => $this->_tpl_vars['params']['customCode'],'rowData' => $this->_tpl_vars['rowData']), $this); echo '';  else:  echo '';  echo smarty_function_sugar_field(array('parentFieldArray' => $this->_tpl_vars['rowData'],'vardef' => $this->_tpl_vars['params'],'displayType' => 'ListView','field' => $this->_tpl_vars['col']), $this); echo '';  endif;  echo '';  if (empty ( $this->_tpl_vars['rowData'][$this->_tpl_vars['col']] ) && empty ( $this->_tpl_vars['params']['customCode'] )):  echo '&nbsp;';  endif;  echo '';  if ($this->_tpl_vars['params']['link'] && ! $this->_tpl_vars['params']['customCode']):  echo '</';  echo ((is_array($_tmp=@$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']][$this->_tpl_vars['params']['ACLTag']])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']]['MAIN']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['pageData']['tag'][$this->_tpl_vars['id']]['MAIN']));  echo '>';  endif;  echo '';  if ($this->_tpl_vars['col'] == 'NAME' || $this->_tpl_vars['params']['bold']):  echo '</b>';  endif;  echo '</td>'; ?>

                <?php $this->assign('scope_row', false); ?>
				<?php echo smarty_function_counter(array('name' => 'colCounter'), $this);?>

			<?php endforeach; endif; unset($_from); ?>
			<td align='right'><?php echo $this->_tpl_vars['pageData']['additionalDetails'][$this->_tpl_vars['id']]; ?>
</td>
	    	</tr>
	<?php endforeach; else: ?>
	<tr height='20' class='<?php echo $this->_tpl_vars['rowColor'][0]; ?>
S1'>
	    <td colspan="<?php echo $this->_tpl_vars['colCount']; ?>
">
	        <em><?php echo $this->_tpl_vars['APP']['LBL_NO_DATA']; ?>
</em>
	    </td>
	</tr> 
	<?php endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'include/ListView/ListViewPagination.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>
<?php if ($this->_tpl_vars['contextMenus']): ?>
<script type="text/javascript">
<?php echo $this->_tpl_vars['contextMenuScript']; ?>

<?php echo '
function lvg_nav(m,id,act,offset,t){
    if(t.href.search(/#/) < 0){return;}
    else{
        if(act==\'pte\'){
            act=\'ProjectTemplatesEditView\';
        }
        else if(act==\'d\'){
            act=\'DetailView\';
        }else if( act ==\'ReportsWizard\'){
            act = \'ReportsWizard\';
        }else{
            act=\'EditView\';
        }
    '; ?>

        url = 'index.php?module='+m+'&offset=' + offset + '&stamp=<?php echo $this->_tpl_vars['pageData']['stamp']; ?>
&return_module='+m+'&action='+act+'&record='+id;
        t.href=url;
    <?php echo '
    }
}'; ?>

<?php echo '
    function lvg_dtails(id){'; ?>

        return SUGAR.util.getAdditionalDetails( '<?php echo ((is_array($_tmp=@$this->_tpl_vars['pageData']['bean']['moduleDir'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['params']['module']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['params']['module'])); ?>
',id, 'adspan_'+id);<?php echo '}'; ?>

</script>
<?php endif; ?>