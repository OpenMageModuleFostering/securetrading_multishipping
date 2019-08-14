<?php

class Securetrading_Multishipping_Model_Order_Set_Orders extends Mage_Core_Model_Abstract {
	protected function _construct() {
		$this->_init('securetrading_multishipping/order_set_orders');
	}
	
	public function loadByOrderId($orderId, $graceful = false) {
		$object = $this->load($orderId, 'order_id');
		if (!$object->getId()) {
			if ($graceful) {
				return false;
			}
			throw new Exception(sprintf(Mage::helper('securetrading_multishipping')->__('The order "%s" did not have a set ID.  Only orders placed in the multishipping checkout will have a set ID.'), $orderId));
		}
		return $object;
	}
}