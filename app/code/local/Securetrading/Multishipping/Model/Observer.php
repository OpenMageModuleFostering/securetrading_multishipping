<?php

class Securetrading_Multishipping_Model_Observer {
	public function onCheckoutSubmitAllAfter(Varien_Event_Observer $observer) {
		$orders = $observer->getEvent()->getOrders();
		if (!$orders || (count($orders) < 2)) { // Not multishipping checkout or only one order created in checkout (only one shipping address chosen).
			return;
		}
		Mage::getModel('securetrading_multishipping/order_set_factory')->addSet($orders);
	}
}