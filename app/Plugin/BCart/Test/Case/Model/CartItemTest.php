<?php
App::uses('CartItem', 'BCart.Model');

/**
 * CartItem Test Case
 *
 */
class CartItemTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.b_cart.cart_item', 'app.shopping_cart', 'app.product', 'app.category', 'app.inventory', 'app.product_size');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CartItem = ClassRegistry::init('CartItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CartItem);

		parent::tearDown();
	}

}
