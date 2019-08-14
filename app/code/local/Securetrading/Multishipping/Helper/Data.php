<?php

class Securetrading_Multishipping_Helper_Data extends Mage_Core_Helper_Abstract {
  public function getRelatedMultishippingOrders($orderIncrementId) {
    $multishippingModel = Mage::getModel('securetrading_multishipping/order_set_factory');
    $orderId = Mage::getModel('sales/order')->loadByIncrementId($orderIncrementId)->getId();
    
    if (!$orderId) {
      return false;
    }
    
    if ($multishippingModel->orderBelongsToAnySet($orderId)) {
      $orderIds = $multishippingModel->getOrderIdsInSameSet($orderId, false);
    } else {
      $orderIds = array($orderId);
    }
    return $orderIds;
  }	
}