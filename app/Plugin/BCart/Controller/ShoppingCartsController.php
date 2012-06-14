<?php
App::uses('BCartAppController', 'BCart.Controller');
/**
 * ShoppingCarts Controller
 *
 */
class ShoppingCartsController extends BCartAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> Allow('get', 'addCartItem', 'removeCartItem', 'updateCartItem');
	}
	
	/**
	 * Obtener el carrito
	 * 
	 * @return Información del carrito
	 */
	public function get() {
		$user_id = $this -> getUserId();
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
		if($product_id && $product_size_id && $quantity) {
			/** llegó la info proceder a guardar **/
			$user_id = $this -> getUserId();
			if($user_id) {
				/** tratar de obtener el carrito de la BD y verificar si existe **/
				$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
				if($shopping_cart) {
					/** carrito existe, agregar el ítem **/
					$cart_item = array(
						'shopping_cart_id' => $shopping_cart['ShoppingCart']['id'],
						'product_id' => $product_id,
						'product_size_id' => $product_size_id,
						'quantity' => $quantity
					);
					$this -> ShoppingCart -> CartItem -> create();
					if($this -> ShoppingCart -> CartItem -> save($cart_item)) {
						$shopping_cart['success'] = true;
					} else {
						$shopping_cart['success'] = false;
					}
					echo json_encode($shopping_cart);
				} else {
					echo json_encode(array('success' => false)); // No existe el carrito
				}
			} else {
				/** carrito en la cookie **/
				$shopping_cart = $this -> readCookie();
				$this -> ShoppingCart -> CartItem -> Product -> recursive = -1;
				$product = $this -> ShoppingCart -> CartItem -> Product -> read(null, $product_id);
				$this -> ShoppingCart -> CartItem -> ProductSize -> recursive = -1;
				$product_size = $this -> ShoppingCart -> CartItem -> ProductSize -> read(null, $product_size_id);
				$cart_item = array(
					'CartItem' => array(
						'id' => count($shopping_cart['ShoppingCart']['CartItem']) + 1,
						'product_id' => $product_id,
						'product_size_id' => $product_size_id,
						'quantity' => $quantity
					),
					'Product' => $product['Product'],
					'ProductSize' => $product_size['ProductSize']
				);
				$shopping_cart['ShoppingCart']['CartItem'][] = $cart_item;
				$this -> writeCookie($shopping_cart);
				$shopping_cart = $this -> readCookie();
				$shopping_cart['success'] = true;
				echo json_encode($shopping_cart);
			}
		} else {
			echo json_encode(array('success' => false)); // Error en los datos pasados al método
		}
		exit(0);
	}
	
	public function removeCartItem($cart_item_id = null) {
		if($cart_item_id) {
			/** verificar sesión **/
			$user_id = $this -> getUserId();
			if($user_id) {
				/** tratar de obtener el carrito de la BD y verificar si existe **/
				$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
				if($shopping_cart) {
					/** carrito existe, verificar si el item es del carrito del usuario, borrar si sí **/
					$this -> ShoppingCart -> CartItem -> recursive = -1;
					$cart_item = $this -> ShoppingCart -> CartItem -> read(null, $cart_item_id);
					if($cart_item['CartItem']['shopping_cart_id'] == $shopping_cart['ShoppingCart']['id']) {
						if($this -> ShoppingCart -> CartItem -> delete($cart_item_id)) {
							$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
							$shopping_cart['success'] = true;
							echo json_encode($shopping_cart);
						}
					} else {
						$shopping_cart['success'] = false;
						echo json_encode($shopping_cart);
					}
				}
			} else {
				/** carrito en la cookie **/
				$shopping_cart = $this -> readCookie();
				$item_deleted = false;
				foreach($shopping_cart['ShoppingCart']['CartItem'] as $key => $cart_item) {
					if($cart_item['CartItem']['id'] == $cart_item_id) {
						unset($shopping_cart['ShoppingCart']['CartItem'][$key]);
						$item_deleted = true;
					}
				}
				$this -> writeCookie($shopping_cart);
				$shopping_cart = $this -> readCookie();
				$shopping_cart['success'] = $item_deleted;
				echo json_encode($shopping_cart);
			}
		} else {
			echo json_encode(array('success' => false));
		}
		exit(0);
	}
	
	public function updateCartItem($cart_item_id = null, $quantity = null) {
		if($cart_item_id && $quantity) {
			/** verificar sesión **/
			$user_id = $this -> getUserId();
			if($user_id) {
				/** tratar de obtener el carrito de la BD y verificar si existe **/
				$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
				if($shopping_cart) {
					/** carrito existe, verificar si el item es del carrito del usuario, borrar si sí **/
					$this -> ShoppingCart -> CartItem -> recursive = -1;
					$cart_item = $this -> ShoppingCart -> CartItem -> read(null, $cart_item_id);
					if($cart_item['CartItem']['shopping_cart_id'] == $shopping_cart['ShoppingCart']['id']) {
						/** modificar la cantidad **/
						$cart_item['CartItem']['quantity'] = $quantity;
						if($this -> ShoppingCart -> CartItem -> save($cart_item)) {
							$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
							$shopping_cart['success'] = true;
							echo json_encode($shopping_cart);
						}
					} else {
						$shopping_cart['success'] = false;
						echo json_encode($shopping_cart);
					}
				}
			} else {
				/** carrito en la cookie **/
				$shopping_cart = $this -> readCookie();
				$item_modified = false;
				foreach($shopping_cart['ShoppingCart']['CartItem'] as $key => $cart_item) {
					if($cart_item['CartItem']['id'] == $cart_item_id) {
						$shopping_cart['ShoppingCart']['CartItem'][$key]['CartItem']['quantity'] = $quantity;
						$item_modified = true;
					}
				}
				$this -> writeCookie($shopping_cart);
				$shopping_cart = $this -> readCookie();
				$shopping_cart['success'] = $item_deleted;
				echo json_encode($shopping_cart);
			}
		} else {
			echo json_encode(array('success' => false));
		}
		exit(0);
	}
	
	private function readCookie() {
		return $this -> Cookie -> read('ShoppingCart');
	}
	
	private function writeCookie($shopping_cart = null) {
		$this -> Cookie -> write('ShoppingCart', $shopping_cart);
	}
	
	private function getUserId() {
		return $this -> Auth -> user('id');
	}

}
