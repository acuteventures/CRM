<?php
// created: 2011-12-21 09:33:00
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_cases"] = array (
  'name' => 'oa_officeactions_cases',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
  'id_name' => 'oa_officeactions_casescases_ida',
);
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_cases_name"] = array (
  'name' => 'oa_officeactions_cases_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_CASES_TITLE',
  'save' => true,
  'id_name' => 'oa_officeactions_casescases_ida',
  'link' => 'oa_officeactions_cases',
  'table' => 'cases',
  'module' => 'Cases',
  'rname' => 'name',
);
$dictionary["oa_officeactions"]["fields"]["oa_officeactions_casescases_ida"] = array (
  'name' => 'oa_officeactions_casescases_ida',
  'type' => 'link',
  'relationship' => 'oa_officeactions_cases',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OA_OFFICEACTIONS_CASES_FROM_OA_OFFICEACTIONS_TITLE',
);
