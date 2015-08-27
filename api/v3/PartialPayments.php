<?php

function civicrm_api3_partial_payments_create($params) {

  $ids = array();
  if (!empty($params['id'])) {
    $ids['id'] = $params['id'];
  }
  $partialPayments = CRM_Payments_BAO_PartialPayments::create($params, $ids);

  $payment = array();
  _civicrm_api3_object_to_array($partialPayment, $payment[$partialPayments->id]);

  return civicrm_api3_create_success($payment, $params);
}


function _civicrm_api3_partial_payments_create_spec(&$params) {
  $params['id']['api.required'] = 1;
  $params['contribution_id']['api.required'] = 1;
}


function civicrm_api3_partial_payments_delete($params) {
  $partialPayments = new CRM_Payments_BAO_PartialPayments();
  return $partialPayments->deletePartialPayments($params) ? civicrm_api3_create_success() : civicrm_api3_create_error('Error while deleting');
}


function civicrm_api3_partial_payments_get($params) {
  return _civicrm_api3_basic_get('CRM_Payments_DAO_PartialPayments', $params);
}
