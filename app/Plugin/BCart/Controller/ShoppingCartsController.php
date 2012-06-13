<?php
App::uses('BCartAppController', 'BCart.Controller');
/**
 * ShoppingCarts Controller
 *
 */
class ShoppingCartsController extends BCartAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> Allow('get');
	}
	
	/**
	 * Obtener el carrito
	 * 
	 * @return Información del carrito
	 */
	public function get() {
		$user_id = $this -> Auth -> user('id');
		if($user_id) {
			/** hay usuario logueado **/
			$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
			if($shopping_cart) {
				return $shopping_cart;
			} else {
				$this -> ShoppingCart -> create();
				$shopping_cart = array('ShoppingCart' => array('user_id' => $user_id));
				if($this -> ShoppingCart -> save($shopping_cart)) {
					return $this -> ShoppingCart -> read(null, $this -> ShoppingCart -> id);
				} else {
					return array();
				}
			}
		} else {
			/** no hay usuario logueado **/
			if(!$this -> readCookie()) {
				$shopping_cart = array(
					'ShoppingCart' => array(
						'CartItem' => array()
					)
				);
				$this -> writeCookie($shopping_cart);
			}
			return $this -> readCookie();
		}
	}
	
	public function addCartItem($product_id = null, $product_size_id = null, $quantity = null) {
		
	}
	
	public function removeCartItem($product_id = null, $product_size_id = null, $quantity = null) {
		
	}
	
	/**
	 * Verificar que el carrito exista
	 * 
	 * @param int $user_id ID de usuario si la hay
	 */
	private function cartExists($user_id = null) {
		if($user_id) {
			/** verificar si el usuario tiene carrito (BD) **/
		} else {
			/** verificar si hay carrito (cookie) **/
		}
	}
	
	private function readCookie() {
		return $this -> Cookie -> read('ShoppingCart');
	}
	
	private function writeCookie($shopping_cart = null) {
		$this -> Cookie -> write('ShoppingCart', $shopping_cart);
	}

}
