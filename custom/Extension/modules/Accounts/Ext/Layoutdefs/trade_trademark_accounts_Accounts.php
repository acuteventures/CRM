<?php
 // created: 2012-01-10 11:49:05
$layout_defs["Accounts"]["subpanel_setup"]['trade_trademark_accounts'] = array (
  'order' => 100,
  'module' => 'trade_trademark',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_TRADE_TRADEMARK_ACCOUNTS_FROM_TRADE_TRADEMARK_TITLE',
  'get_subpanel_data' => 'trade_trademark_accounts',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
