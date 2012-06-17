<?php
App::uses('BCartAppController', 'BCart.Controller');
/**
 * ShoppingCarts Controller
 *
 */
class ShoppingCartsController extends BCartAppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> ShoppingCart -> Behaviors -> attach('Containable');
		$this -> ShoppingCart -> contain('CartItem', 'CartItem.Product', 'CartItem.ProductSize');
		$this -> Auth -> Allow('get', 'addCartItem', 'removeCartItem', 'updateCartItem');
	}
	
	private function getUserId() {
		return $this -> Auth -> user('id');
	}
	
	/**
	 * Obtener el carrito
	 * 
	 * @return Información del carrito
	 */
	public function get() {
		Configure::write('debug', 0);
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
			// no hay usuario logueado
			$shopping_cart = $this -> ShoppingCart -> findByIdentifier($this -> getIdentifier());
			if($shopping_cart) {
				return $shopping_cart;
			} else {
				$this -> ShoppingCart -> create();
				$shopping_cart = array('ShoppingCart' => array('identifier' => $this -> getIdentifier()));
				if($this -> ShoppingCart -> save($shopping_cart)) {
					return $this -> ShoppingCart -> read(null, $this -> ShoppingCart -> id);
				} else {
					return array();
				}
			}
		}
	}
	
	public function addCartItem($product_id = null, $product_size_id = null, $quantity = null) {
		$this -> autoRender = false;
		Configure::write('debug', 0);
		if($product_id && $product_size_id && $quantity) {
			/** llegó la info proceder a guardar **/
			$shopping_cart = $this -> get();
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
			echo json_encode(array('success' => false)); // Error en los datos pasados al método
		}
		exit(0);
	}
	
	public function removeCartItem($cart_item_id = null) {
		$this -> autoRender = false;
		Configure::write('debug', 0);
		if($cart_item_id) {
			$shopping_cart = $this -> get();
			if($shopping_cart) {
				/** carrito existe, verificar si el item es del carrito del usuario, borrar si sí **/
				$this -> ShoppingCart -> CartItem -> recursive = -1;
				$cart_item = $this -> ShoppingCart -> CartItem -> read(null, $cart_item_id);
				if($cart_item['CartItem']['shopping_cart_id'] == $shopping_cart['ShoppingCart']['id']) {
					if($this -> ShoppingCart -> CartItem -> delete($cart_item_id)) {
						$shopping_cart = $this -> get();
						$shopping_cart['success'] = true;
						echo json_encode($shopping_cart);
					}
				} else {
					$shopping_cart['success'] = false;
					echo json_encode($shopping_cart);
				}
			}
		} else {
			echo json_encode(array('success' => false));
		}
		exit(0);
	}
	
	public function updateCartItem($cart_item_id = null, $quantity = null) {
		$this -> autoRender = false;
		Configure::write('debug', 0);
		if($cart_item_id && $quantity) {
			/** tratar de obtener el carrito de la BD y verificar si existe **/
			$shopping_cart = $this -> get();
			if($shopping_cart) {
				/** carrito existe, verificar si el item es del carrito del usuario, borrar si sí **/
				$this -> ShoppingCart -> CartItem -> recursive = -1;
				$cart_item = $this -> ShoppingCart -> CartItem -> read(null, $cart_item_id);
				if($cart_item['CartItem']['shopping_cart_id'] == $shopping_cart['ShoppingCart']['id']) {
					/** modificar la cantidad **/
					$cart_item['CartItem']['quantity'] = $quantity;
					if($this -> ShoppingCart -> CartItem -> save($cart_item)) {
						$shopping_cart = $this -> get();
						$shopping_cart['success'] = true;
						echo json_encode($shopping_cart);
					}
				} else {
					$shopping_cart['success'] = false;
					echo json_encode($shopping_cart);
				}
			}
		} else {
			echo json_encode(array('success' => false));
		}
		exit(0);
	}

}
