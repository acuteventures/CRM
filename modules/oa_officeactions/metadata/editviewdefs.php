<?php
$module_name = 'oa_officeactions';
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
          1 => 
          array (
            'name' => 'duedate',
            'label' => 'LBL_DUEDATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'oa_officeactions_cases_name',
          ),
          1 => 
          array (
            'name' => 'officeactiontype',
            'studio' => 'visible',
            'label' => 'LBL_OFFICEACTIONTYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'extensionallowed',
            'studio' => 'visible',
            'label' => 'LBL_EXTENSIONALLOWED',
          ),
          1 => 
          array (
            'name' => 'officeactionstatus',
            'studio' => 'visible',
            'label' => 'LBL_OFFICEACTIONSTATUS',
          ),
        ),
      ),
    ),
  ),
);
?>
