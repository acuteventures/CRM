<?php
$module_name = 'oa_officeactions';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
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
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'date_modified',
            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
            'label' => 'LBL_DATE_MODIFIED',
          ),
        ),
      ),
    ),
  ),
);
?>
