<?php

class CRM_Payments_BAO_PartialPayments extends CRM_Payments_DAO_PartialPayments {

    
  public static function create(&$params, &$ids) {
    if (isset($ids['id'])) {
      CRM_Utils_Hook::pre('edit', 'PartialPayments', $ids['id'], $params);
    }
    else {
      CRM_Utils_Hook::pre('create', 'PartialPayments', NULL, $params);
    }

    $partialPayments = new CRM_Payments_BAO_PartialPayments();
    $partialPayments->copyValues($params);
    if (isset($ids['id'])) {
      $partialPayments->id = CRM_Utils_Array::value('id', $ids);
    }
    else {
      $partialPayments->find(TRUE);
    }
    $partialPayments->save();

    if (isset($ids['id'])) {
      CRM_Utils_Hook::post('edit', 'PartialPayments', $ids['id'], $partialPayments);
    }
    else {
      CRM_Utils_Hook::post('create', 'PartialPayments', NULL, $partialPayments);
    }

    $lineItemCount = CRM_Core_DAO::singleValueQuery("select count(*) FROM civicrm_line_item WHERE contribution_id = %1", array(
        1 => array(
          $partialPayment->contribution_id,
          'Integer',
        ),
      ));
    if ($lineItemCount == 1) {
      $sql = "UPDATE civicrm_line_item li
      SET entity_table = 'civicrm_partial_payments', entity_id = %1
      WHERE contribution_id = %2 AND entity_table = 'civicrm_contribution'";
      CRM_Core_DAO::executeQuery($sql, array(
          1 => array($partialPayments->partial_id, 'Integer'),
          2 => array($partialPayments->contribution_id, 'Integer'),
        ));
    }

    return $partialPayments;
  }

  
  public static function deletePartialPayments($params) {
    $partialPayments = new CRM_Payments_DAO_PartialPayments();

    $valid = FALSE;
    foreach ($params as $field => $value) {
      if (!empty($value)) {
        $partialPayments->$field = $value;
        $valid = TRUE;
      }
    }

    if (!$valid) {
      CRM_Core_Error::fatal();
    }

    if ($partialPayments->find(TRUE)) {
      CRM_Utils_Hook::pre('delete', 'PartialPayments', $partialPayments->id, $params);
      CRM_Contribute_BAO_Contribution::deleteContribution($partialPayments->contribution_id);
      $partialPayments->delete();
      CRM_Utils_Hook::post('delete', 'PartialPayments', $partialPayments->id, $partialPayments);
      return $partialPayments;
    }
    return FALSE;
  }

}
