<?php
// created: 2011-12-16 09:42:10
$dictionary["Case"]["fields"]["oa_officeactions_cases_1"] = array (
  'name' => 'oa_officeactions_cases_1',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases_1',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_1_FROM_OA_OFFICEACTIONS_TITLE',
  'id_name' => 'oa_officeactions_cases_1oa_officeactions_ida',
);
$dictionary["Case"]["fields"]["oa_officeactions_cases_1_name"] = array (
  'name' => 'oa_officeactions_cases_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_1_FROM_OA_OFFICEACTIONS_TITLE',
  'save' => true,
  'id_name' => 'oa_officeactions_cases_1oa_officeactions_ida',
  'link' => 'oa_officeactions_cases_1',
  'table' => 'oa_officeactions',
  'module' => 'oa_officeactions',
  'rname' => 'name',
);
$dictionary["Case"]["fields"]["oa_officeactions_cases_1oa_officeactions_ida"] = array (
  'name' => 'oa_officeactions_cases_1oa_officeactions_ida',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_1_FROM_CASES_TITLE',
);
