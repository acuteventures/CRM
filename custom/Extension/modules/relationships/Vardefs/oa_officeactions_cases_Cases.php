<?php
// created: 2011-12-16 09:41:02
$dictionary["Case"]["fields"]["oa_officeactions_cases"] = array (
  'name' => 'oa_officeactions_cases',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
  'id_name' => 'oa_officeactions_casesoa_officeactions_ida',
);
$dictionary["Case"]["fields"]["oa_officeactions_cases_name"] = array (
  'name' => 'oa_officeactions_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
  'save' => true,
  'id_name' => 'oa_officeactions_casesoa_officeactions_ida',
  'link' => 'oa_officeactions_cases',
  'table' => 'oa_officeactions',
  'module' => 'oa_officeactions',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["oa_officeactions_casesoa_officeactions_ida"] = array (
  'name' => 'oa_officeactions_casesoa_officeactions_ida',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
);
