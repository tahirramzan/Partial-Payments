<?php

function civicrm_api3_partial_payments_create($params) {

  $ids = array();
  if (!empty($params['id'])) {
    $ids['id'] = $params['id'];
  }
  $partialPaymentsInstallments = CRM_Payments_BAO_PartialPaymentsInstallments::create($params, $ids);

  $payment = array();
  _civicrm_api3_object_to_array(partialPaymentsInstallments, $payment[partialPaymentsInstallments->id]);

  return civicrm_api3_create_success($payment, $params);
}


function _civicrm_api3_partial_payments_create_spec(&$params) {
  $params['id']['api.required'] = 1;
  $params['contribution_id']['api.required'] = 1;
}


function civicrm_api3_partial_payments_delete($params) {
  partialPaymentsInstallments = new CRM_Payments_BAO_PartialPaymentsInstallments();
  return partialPaymentsInstallments->deletePartialPaymentsInstallments($params) ? civicrm_api3_create_success() : civicrm_api3_create_error('Error while deleting');
}


function civicrm_api3_partial_payments_get($params) {
  return _civicrm_api3_basic_get('CRM_Payments_DAO_PartialPaymentsInstallments', $params);
}
