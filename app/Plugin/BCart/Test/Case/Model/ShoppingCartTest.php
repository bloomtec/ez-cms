<?php
App::uses('ShoppingCart', 'BCart.Model');

/**
 * ShoppingCart Test Case
 *
 */
class ShoppingCartTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('plugin.b_cart.shopping_cart', 'app.user', 'app.cart_item');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShoppingCart = ClassRegistry::init('ShoppingCart');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShoppingCart);

		parent::tearDown();
	}

}
