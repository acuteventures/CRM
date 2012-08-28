<?php
 // created: 2011-12-01 11:07:33
$layout_defs["c_case_type"]["subpanel_setup"]['c_case_type_c_case_status'] = array (
  'order' => 100,
  'module' => 'c_case_status',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_C_CASE_TYPE_C_CASE_STATUS_FROM_C_CASE_STATUS_TITLE',
  'get_subpanel_data' => 'c_case_type_c_case_status',
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
