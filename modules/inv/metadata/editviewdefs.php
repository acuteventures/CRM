<?php
$module_name = 'c_case_status';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 'description',
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'action_no',
            'label' => 'LBL_ACTION_NO',
          ),
          1 => 
          array (
            'name' => 'order_no',
            'label' => 'LBL_ORDER_NO',
          ),
        ),
		array (
          0 => 
          array (
            'name' => 'display_order',
            'label' => 'LBL_DISPLAY_ORDER',
          ),
        
        ),
      ),
    ),
  ),
);
?>
