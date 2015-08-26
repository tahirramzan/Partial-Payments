<?php
// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'CRM_Payments_Form_Report_PartialPayments',
    'entity' => 'ReportTemplate',
    'params' => 
    array (
      'version' => 3,
      'label' => 'PartialPayments',
      'description' => 'PartialPayments (civicrm.partial.payments)',
      'class_name' => 'CRM_Payments_Form_Report_PartialPayments',
      'report_url' => 'civicrm.partial.payments/partialpayments',
      'component' => 'CiviContribute',
    ),
  ),
);