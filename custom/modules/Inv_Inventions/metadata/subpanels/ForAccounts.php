<?php

$subpanel_layout = array(
	'top_buttons' => array(
		array('widget_class' => 'SubPanelTopCreateButton'),
		array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Inv_Inventions','mode' => 'MultiSelect'),
	),

	'where' => '',
	
	'list_fields' => array(
		'name'=>array(
			'name'=>'name',
			'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'module' => 'Inv_Inventions',
			'width' => '43%',
		),
		'date_modified'=>array(
			'name'=>'date_modified',
		 	'vname' => 'LBL_DATE_MODIFIED',
		),		
		'edit_button'=>array(
			'vname' => 'LBL_EDIT_BUTTON',
			'widget_class' => 'SubPanelEditButton',
		 	'module' => 'Inv_Inventions',
			'width' => '5%',
		),
		'remove_button'=>array(
			'vname' => 'LBL_REMOVE',
			'widget_class' => 'SubPanelRemoveButton',
		 	'module' => 'Inv_Inventions',
			'width' => '5%',
		),
	),
);		
?>
