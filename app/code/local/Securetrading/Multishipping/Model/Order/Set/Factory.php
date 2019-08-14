<?php

class Securetrading_Multishipping_Model_Order_Set_Factory extends Varien_Object {
	public function addSet(array $orders) {
		$set = Mage::getModel('securetrading_multishipping/order_set')->setDataChanges(true)->save();
		$setId = $set->getId();
		foreach($orders as $order) {
			$orderId = $order->getId();
			Mage::getModel('securetrading_multishipping/order_set_orders')->setSetId($setId)->setOrderId($orderId)->save();
		}
	}
	
	public function getOrderIdsInSameSet($orderId, $excludeCurrentOrder = true) {
		$orderSetOrders = Mage::getModel('securetrading_multishipping/order_set_orders')->loadByOrderId($orderId, false);
		$setId = $orderSetOrders->getSetId();
		
		$collection = Mage::getModel('securetrading_multishipping/order_set_orders')->getCollection();
		$collection->getSelect()->reset(Zend_Db_Select::COLUMNS);
		$collection->addFieldToFilter('set_id', $setId);
		$collection->addFieldToSelect('order_id');
		
		$orderIds = array();
		foreach($collection->getData() as $entry) {
			#if ($excludeCurrentOrder && $entry['order_id'] !== $orderId) {
			if (!$excludeCurrentOrder || ($excludeCurrentOrder && $entry['order_id'] !== $orderId)) {
				$orderIds[] = $entry['order_id'];
			}
		}
		return $orderIds;
	}
	
	public function orderBelongsToAnySet($orderId) {
		return (bool) Mage::getModel('securetrading_multishipping/order_set_orders')->loadByOrderId($orderId, true);
	}
}