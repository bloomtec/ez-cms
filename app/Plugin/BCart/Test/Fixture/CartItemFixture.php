<?php
/**
 * CartItemFixture
 *
 */
class CartItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'shopping_cart_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'product_size_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'quantity' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'shopping_cart_id' => 1,
			'product_id' => 1,
			'product_size_id' => 1,
			'quantity' => 1,
			'created' => '2012-06-13 11:07:38',
			'updated' => '2012-06-13 11:07:38'
		),
	);
}
