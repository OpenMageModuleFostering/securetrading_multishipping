<?php

class Securetrading_Multishipping_Model_Resource_Order_Set extends Mage_Core_Model_Resource_Db_Abstract {
	protected function _construct() {
		$this->_init('securetrading_multishipping/order_set', 'set_id');
	}
}