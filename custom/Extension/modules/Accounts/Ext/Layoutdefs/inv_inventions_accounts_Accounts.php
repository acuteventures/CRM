<?php
// created: 2011-12-01 05:26:41
$layout_defs["Accounts"]["subpanel_setup"]["inv_inventions_accounts"] = array (
  'order' => 100,
  'module' => 'Inv_Inventions',
  'subpanel_name' => 'ForAccounts',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_INV_INVENTIONS_ACCOUNTS_FROM_INV_INVENTIONS_TITLE',
  'get_subpanel_data' => 'inv_inventions_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
     // 'mode' => 'MultiSelect',
    ),
  ),
);
?>
