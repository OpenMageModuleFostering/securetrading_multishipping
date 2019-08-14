<?php

class Securetrading_Multishipping_Block_Adminhtml_Sales_Order_View_Tab_Multishipping 
extends Mage_Adminhtml_Block_Sales_Order_Grid
implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
	public function __construct($attributes = array()) {
		parent::__construct($attributes);
		$this->setPagerVisibility(false);
		$this->setFilterVisibility(false);
	}
	
	protected function _prepareLayout() {
		$order = Mage::registry('current_order');
		if (Mage::getModel('securetrading_multishipping/order_set_factory')->orderBelongsToAnySet($order->getId())) {
			$this->getLayout()->getBlock('sales_order_tabs')->addTab('securetrading_multishipping_orders', $this);
		}
	}
	
	protected function _prepareCollection() {
		$order = Mage::registry('current_order');
		$orderIds = Mage::getModel('securetrading_multishipping/order_set_factory')->getOrderIdsInSameSet($order->getId(), true);
		$collection = Mage::getResourceModel('sales/order_grid_collection')->addFieldToFilter('entity_id', array('in' => $orderIds));
		$this->setCollection($collection);
	}
	
	protected function _prepareColumns() {
		parent::_prepareColumns();
		$this->_exportTypes = array();
	}
	
	public function getTabLabel() {
		return Mage::helper('securetrading_stpp')->__('Related Multishipping Orders');
	}
	
	public function getTabTitle() {
		return Mage::helper('securetrading_stpp')->__('Related Multishipping Orders');
	}
	
	public function isHidden() {
		return false;
	}
	
	public function canShowTab() {
		return true;
	}
}