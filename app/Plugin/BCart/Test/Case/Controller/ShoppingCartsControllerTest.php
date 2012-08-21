<?php
App::uses('ShoppingCartsController', 'BCart.Controller');

/**
 * TestShoppingCartsController *
 */
class TestShoppingCartsController extends ShoppingCartsController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * ShoppingCartsController Test Case
 *
 */
class ShoppingCartsControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.shopping_cart');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ShoppingCarts = new TestShoppingCartsController();
		$this->ShoppingCarts->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ShoppingCarts);

		parent::tearDown();
	}

}
