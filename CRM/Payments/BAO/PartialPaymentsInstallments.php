<?php

class CRM_Payments_BAO_PartialPaymentsInstallmentsInstallments extends CRM_Payments_DAO_PartialPaymentsInstallmentsInstallments {

    
  public static function create(&$params, &$ids) {
    if (isset($ids['id'])) {
      CRM_Utils_Hook::pre('edit', 'PartialPaymentsInstallments', $ids['id'], $params);
    }
    else {
      CRM_Utils_Hook::pre('create', 'PartialPaymentsInstallments', NULL, $params);
    }

    $partialPaymentsInstallments = new CRM_Payments_BAO_PartialPaymentsInstallments();
    $partialPaymentsInstallments->copyValues($params);
    if (isset($ids['id'])) {
      $partialPaymentsInstallments->id = CRM_Utils_Array::value('id', $ids);
    }
    else {
      $partialPaymentsInstallments->find(TRUE);
    }
    $partialPaymentsInstallments->save();

    if (isset($ids['id'])) {
      CRM_Utils_Hook::post('edit', 'PartialPaymentsInstallments', $ids['id'], $partialPaymentsInstallments);
    }
    else {
      CRM_Utils_Hook::post('create', 'PartialPaymentsInstallments', NULL, $partialPaymentsInstallments);
    }

    $lineItemCount = CRM_Core_DAO::singleValueQuery("select count(*) FROM civicrm_line_item WHERE contribution_id = %1", array(
        1 => array(
          $partialPaymentsInstallments->contribution_id,
          'Integer',
        ),
      ));
    if ($lineItemCount == 1) {
      $sql = "UPDATE civicrm_line_item li
      SET entity_table = 'civicrm_partial_payments', entity_id = %1
      WHERE contribution_id = %2 AND entity_table = 'civicrm_contribution'";
      CRM_Core_DAO::executeQuery($sql, array(
          1 => array($partialPaymentsInstallments->partial_id, 'Integer'),
          2 => array($partialPaymentsInstallments->contribution_id, 'Integer'),
        ));
    }

    return $partialPaymentsInstallments;
  }

  
  public static function deletePartialPaymentsInstallments($params) {
    $partialPaymentsInstallments = new CRM_Payments_DAO_PartialPaymentsInstallments();

    $valid = FALSE;
    foreach ($params as $field => $value) {
      if (!empty($value)) {
        $partialPaymentsInstallments->$field = $value;
        $valid = TRUE;
      }
    }

    if (!$valid) {
      CRM_Core_Error::fatal();
    }

    if ($partialPaymentsInstallments->find(TRUE)) {
      CRM_Utils_Hook::pre('delete', 'PartialPaymentsInstallments', $partialPaymentsInstallments->id, $params);
      CRM_Contribute_BAO_Contribution::deleteContribution($partialPaymentsInstallments->contribution_id);
      $partialPaymentsInstallments->delete();
      CRM_Utils_Hook::post('delete', 'PartialPaymentsInstallments', $partialPaymentsInstallments->id, $partialPaymentsInstallments);
      return $partialPaymentsInstallments;
    }
    return FALSE;
  }

}
