<?php /* Smarty version 2.6.11, created on 2012-08-27 11:13:29
         compiled from include/ListView/ListViewPagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'include/ListView/ListViewPagination.tpl', 61, false),)), $this); ?>

<?php $this->assign('alt_start', $this->_tpl_vars['navStrings']['start']);  $this->assign('alt_next', $this->_tpl_vars['navStrings']['next']);  $this->assign('alt_prev', $this->_tpl_vars['navStrings']['previous']);  $this->assign('alt_end', $this->_tpl_vars['navStrings']['end']); ?>
<head>
<script type="text/javascript" language="javascript" src="include/javascript/sugar_3.js"></script>
</head>
	<tr class='pagination'  role='presentation'>
		<td colspan='<?php if ($this->_tpl_vars['prerow']):  echo $this->_tpl_vars['colCount']+1;  else:  echo $this->_tpl_vars['colCount'];  endif; ?>'>
			<table border='0' cellpadding='0' cellspacing='0' width='100%' class='paginationTable'>
				<tr>
					<td nowrap="nowrap" width='2%' class='paginationActionButtons'>
						<?php echo $this->_tpl_vars['actionsLink']; ?>
&nbsp;
						&nbsp;<?php echo $this->_tpl_vars['selectedObjectsSpan']; ?>
&nbsp;
						<?php echo $this->_tpl_vars['emailbutton']; ?>
		
					</td>
					<td  nowrap='nowrap' width='1%' align="right" class='paginationChangeButtons'>
						<?php if ($this->_tpl_vars['pageData']['urls']['startPage']): ?>
							<button type='button' id='listViewStartButton' name='listViewStartButton' title='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' class='button' <?php if ($this->_tpl_vars['prerow']): ?>onclick='return sListView.save_checks(0, "<?php echo $this->_tpl_vars['moduleString']; ?>
");'<?php else: ?> onClick='location.href="<?php echo $this->_tpl_vars['pageData']['urls']['startPage']; ?>
"' <?php endif; ?>>
								<?php echo smarty_function_sugar_getimage(array('name' => 'start','ext' => ".png",'alt' => ($this->_tpl_vars['alt_start']),'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php else: ?>
							<button type='button' id='listViewStartButton' name='listViewStartButton' title='<?php echo $this->_tpl_vars['navStrings']['start']; ?>
' class='button' disabled='disabled'>
								<?php echo smarty_function_sugar_getimage(array('name' => 'start_off','ext' => ".png",'alt' => $this->_tpl_vars['navStrings']['start'],'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['pageData']['urls']['prevPage']): ?>
							<button type='button' id='listViewPrevButton' name='listViewPrevButton' title='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' class='button' <?php if ($this->_tpl_vars['prerow']): ?>onclick='return sListView.save_checks(<?php echo $this->_tpl_vars['pageData']['offsets']['prev']; ?>
, "<?php echo $this->_tpl_vars['moduleString']; ?>
")' <?php else: ?> onClick='location.href="<?php echo $this->_tpl_vars['pageData']['urls']['prevPage']; ?>
"'<?php endif; ?>>
								<?php echo smarty_function_sugar_getimage(array('name' => 'previous','ext' => ".png",'alt' => ($this->_tpl_vars['alt_prev']),'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php else: ?>
							<button type='button' id='listViewPrevButton' name='listViewPrevButton' class='button' title='<?php echo $this->_tpl_vars['navStrings']['previous']; ?>
' disabled='disabled'>
								<?php echo smarty_function_sugar_getimage(array('name' => 'previous_off','ext' => ".png",'alt' => $this->_tpl_vars['navStrings']['previous'],'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php endif; ?>
							<span class='pageNumbers'>(<?php if ($this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage'] == 0): ?>0<?php else:  echo $this->_tpl_vars['pageData']['offsets']['current']+1;  endif; ?> - <?php echo $this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage']; ?>
 <?php echo $this->_tpl_vars['navStrings']['of']; ?>
 <?php if ($this->_tpl_vars['pageData']['offsets']['totalCounted']):  echo $this->_tpl_vars['pageData']['offsets']['total'];  else:  echo $this->_tpl_vars['pageData']['offsets']['total'];  if ($this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage'] != $this->_tpl_vars['pageData']['offsets']['total']): ?>+<?php endif;  endif; ?>)</span>
						<?php if ($this->_tpl_vars['pageData']['urls']['nextPage']): ?>
							<button type='button' id='listViewNextButton' name='listViewNextButton' title='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' class='button' <?php if ($this->_tpl_vars['prerow']): ?>onclick='return sListView.save_checks(<?php echo $this->_tpl_vars['pageData']['offsets']['next']; ?>
, "<?php echo $this->_tpl_vars['moduleString']; ?>
")' <?php else: ?> onClick='location.href="<?php echo $this->_tpl_vars['pageData']['urls']['nextPage']; ?>
"'<?php endif; ?>>
								<?php echo smarty_function_sugar_getimage(array('name' => 'next','ext' => ".png",'alt' => ($this->_tpl_vars['alt_next']),'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php else: ?>
							<button type='button' id='listViewNextButton' name='listViewNextButton' class='button' title='<?php echo $this->_tpl_vars['navStrings']['next']; ?>
' disabled='disabled'>
								<?php echo smarty_function_sugar_getimage(array('name' => 'next_off','ext' => ".png",'alt' => $this->_tpl_vars['navStrings']['next'],'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['pageData']['urls']['endPage'] && $this->_tpl_vars['pageData']['offsets']['total'] != $this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage']): ?>
							<button type='button' id='listViewEndButton' name='listViewEndButton' title='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' class='button' <?php if ($this->_tpl_vars['prerow']): ?>onclick='return sListView.save_checks("end", "<?php echo $this->_tpl_vars['moduleString']; ?>
")' <?php else: ?> onClick='location.href="<?php echo $this->_tpl_vars['pageData']['urls']['endPage']; ?>
"'<?php endif; ?>>
								<?php echo smarty_function_sugar_getimage(array('name' => 'end','ext' => ".png",'alt' => ($this->_tpl_vars['alt_end']),'other_attributes' => 'align="absmiddle" border="0" '), $this);?>

							</button>
						<?php elseif (! $this->_tpl_vars['pageData']['offsets']['totalCounted'] || $this->_tpl_vars['pageData']['offsets']['total'] == $this->_tpl_vars['pageData']['offsets']['lastOffsetOnPage']): ?>
							<button type='button' id='listViewEndButton' name='listViewEndButton' title='<?php echo $this->_tpl_vars['navStrings']['end']; ?>
' class='button' disabled='disabled'>
							 	<?php echo smarty_function_sugar_getimage(array('name' => 'end_off','ext' => ".png",'alt' => $this->_tpl_vars['navStrings']['end'],'other_attributes' => 'align="absmiddle" '), $this);?>

							</button>
						<?php endif; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>