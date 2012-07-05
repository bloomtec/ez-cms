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
		$this -> Auth -> Allow('get', 'assignUserToCart', 'emptyCart', 'addCartItem', 'removeCartItem', 'updateCartItem', 'borrarCarritos');
	}
	
	public function borrarCarritos() {
		$this -> autoRender = false;
		$carritos = $this -> ShoppingCart -> find('list');
		foreach ($carritos as $key => $id) {
			$this -> ShoppingCart -> delete($id);
		}
		$this -> Cookie -> delete('User.identifier');
	}
	
	public function assignUserToCart($user_id = null) {
		if($user_id) {
			$this -> ShoppingCart -> recursive = -1;
			$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
			if(!$shopping_cart) {
				$shopping_cart = $this -> get();
				$shopping_cart['ShoppingCart']['user_id'] = $user_id;
				$shopping_cart['ShoppingCart']['identifier'] = NULL;
				$this -> ShoppingCart -> save($shopping_cart);
			}
		}
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
	
	public function addCartItem($product_id = null, $color_id = null, $product_size_id = null, $quantity = null) {
		$this -> autoRender = false;
		//Configure::write('debug', 0);
		if($product_id && $color_id && $product_size_id && $quantity) {
			/** llegó la info proceder a guardar **/
			$shopping_cart = $this -> get();
			if($shopping_cart) {
				/** carrito existe, agregar el ítem; verificar primero si ya existe el ítem en el carrito **/
				$cart_item = $this -> ShoppingCart -> CartItem -> find(
					'first',
					array(
						'conditions' => array(
							'CartItem.shopping_cart_id' => $shopping_cart['ShoppingCart']['id'],
							'CartItem.product_id' => $product_id,
							'CartItem.color_id' => $color_id,
							'CartItem.product_size_id' => $product_size_id
						),
						'recursive' => -1
					)
				);
				$item_quantity = $this -> requestAction('/inventories/getQuantity/' . $product_id . '/' . $color_id . '/' . $product_size_id);
				// Revisar la cantidad existente vs la cantidad solicitada
				if($item_quantity['Inventory']['quantity'] >= $quantity) {
					// Hay cantidad
					if($cart_item) {
						// Existe el ítem, actualizar
						if($item_quantity['Inventory']['quantity'] >= $cart_item['CartItem']['quantity'] + $quantity) { // Guardar
							$this -> updateCartItem($cart_item['CartItem']['id'], $cart_item['CartItem']['quantity'] + $quantity);
						} else { // Supera la cantidad
							$shopping_cart = $this -> get();
							$shopping_cart['success'] = false;
							$shopping_cart['message'] = 'La cantidad que trata de agregar supera la disponibilidad actual';
							echo json_encode($shopping_cart);
						}						
					} else {
						// No existe el ítem, crear
						$cart_item = array(
							'shopping_cart_id' => $shopping_cart['ShoppingCart']['id'],
							'product_id' => $product_id,
							'color_id' => $color_id,
							'product_size_id' => $product_size_id,
							'quantity' => $quantity
						);
						$this -> ShoppingCart -> CartItem -> create();
						if($this -> ShoppingCart -> CartItem -> save($cart_item)) {
							$shopping_cart = $this -> get();
							$shopping_cart['success'] = true;
						} else {
							$shopping_cart = $this -> get();
							$shopping_cart['success'] = false;
							$shopping_cart['message'] = 'Error a la hora de guardar el carrito';
						}
						echo json_encode($shopping_cart);
					}
				} else {
					echo json_encode(array('success' => false, 'message' => 'No hay suficiente cantidad para agregar al carrito')); //No hay cantidad
				}
			} else {
				echo json_encode(array('success' => false, 'message' => 'No hay carrito asociado en el momento')); // No existe el carrito
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Error en los datos pasados')); // Error en los datos pasados al método
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
					} else {
						$shopping_cart = $this -> get();
						$shopping_cart['success'] = false;
						$shopping_cart['message'] = 'No se pudo eliminar el ítem';
						echo json_encode($shopping_cart);
					}
				} else {
					$shopping_cart = $this -> get();
					$shopping_cart['success'] = false;
					$shopping_cart['message'] = 'No coincide el carrito actual con el carrito del ítem';
					echo json_encode($shopping_cart);
				}
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'No hay carrito asociado en el momento'));
		}
		exit(0);
	}
	
	public function emptyCart() {
		$shoppingCart = $this -> get();
		$cartItems = $this -> ShoppingCart -> CartItem -> find(
			'list',
			array(
				'conditions' => array(
					'CartItem.shopping_cart_id' => $shoppingCart['ShoppingCart']['id']
				)
			)
		);
		foreach ($cartItems as $key => $id) {
			$this -> ShoppingCart -> CartItem -> delete($id);
		}
	}
	
	/**
	 * Actualizar la cantidad de un cartItem
	 * @param int $cart_item_id ID del cartItem
	 * @param int $quantity La cantidad que debe quedar del cartItem
	 */
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
					$shopping_cart = $this -> get();
					$shopping_cart['success'] = false;
					$shopping_cart['message'] = 'No coincide el carrito actual con el carrito del ítem';
					echo json_encode($shopping_cart);
				}
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Error en los datos pasados')); // Error en los datos pasados al método
		}
		exit(0);
	}

}