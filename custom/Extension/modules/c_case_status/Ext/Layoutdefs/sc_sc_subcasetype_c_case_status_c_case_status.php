<?php
 // created: 2012-01-31 08:12:09
$layout_defs["c_case_status"]["subpanel_setup"]['sc_sc_subcasetype_c_case_status'] = array (
  'order' => 100,
  'module' => 'sc_sc_subcasetype',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SC_SC_SUBCASETYPE_C_CASE_STATUS_FROM_SC_SC_SUBCASETYPE_TITLE',
  'get_subpanel_data' => 'sc_sc_subcasetype_c_case_status',
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
