<?php
 // created: 2011-12-16 09:42:09
$layout_defs["oa_officeactions"]["subpanel_setup"]['oa_officeactions_cases_1'] = array (
  'order' => 100,
  'module' => 'Cases',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_OA_OFFICEACTIONS_CASES_1_FROM_CASES_TITLE',
  'get_subpanel_data' => 'oa_officeactions_cases_1',
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
