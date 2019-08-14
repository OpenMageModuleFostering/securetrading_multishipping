<?php

$installer = $this;
$this->startSetup();

$table = $installer->getConnection()
	->newTable($installer->getTable('securetrading_multishipping/order_set'))
	->addColumn('set_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity' => true,
		'unsigned' => true,
		'nullable' => false,
		'primary' => true,
		), 'Set ID')
;
$installer->getConnection()->createTable($table);

$table = $installer->getConnection()
	->newTable($installer->getTable('securetrading_multishipping/order_set_orders'))
	->addColumn('order_set_orders_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'identity' => true,
		'unsigned' => true,
		'nullable' => false,
		'primary' => true,
	), 'Order Set Orders ID')
	->addColumn('set_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => true,
		'nullable' => false,
		), 'Set ID')
	->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
		'unsigned' => null,
		'nullable' => false,
		), 'Order ID')
	->addForeignKey(
		$installer->getFkName('securetrading_multishipping/order_set_orders', 'set_id', 'securetrading_multishipping/order_set', 'set_id'),
		'set_id', $installer->getTable('securetrading_multishipping/order_set'), 'set_id',
		Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addForeignKey(
		$installer->getFkName('securetrading_multishipping/order_set_orders', 'order_id', 'sales/order', 'entity_id'),
		'order_id', $installer->getTable('sales/order'), 'entity_id',
		Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
	->addIndex(
		$installer->getIdxName('securetrading_multishipping/order_set_orders', array('order_id'), Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
		array('order_id'), array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE))
;
$installer->getConnection()->createTable($table);

$installer->endSetup();