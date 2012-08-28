<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$layout_defs['Cases'] = array(
	// list of what Subpanels to show in the DetailView
	'subpanel_setup' => array(
		'inv_inventions_accounts' => array(
			'order' => 30,
			'module' => 'Accounts',
			'sort_order' => 'asc',
			'sort_by' => 'id',
			'subpanel_name' => 'ForAccounts',
			'get_subpanel_data' => 'inv_inventions_accounts',
			'add_subpanel_data' => 'inv_inventd1acccounts_ida',
			'title_key' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_INV_INVENTIONS_TITLE',
			'top_buttons' => array(
				array('widget_class' => 'SubPanelTopCreateButton'),
				array(
					'widget_class' => 'SubPanelTopSelectButton',
					'popup_module' => 'Inv_Inventions',
					//'mode' => 'MultiSelect', 
					
				),
			),
		),
		
		
	),
);
?>