<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	public $components = array('Interpagos');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('add', 'sendPlatformRequest', 'platformResponse', 'platformUpdate');
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this -> Order -> id = $id;
		if (!$this -> Order -> exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this -> autoRender = false;
		if ($this -> request -> is('post')) {
			
			/**
			 * Tener en cuenta
			 * a. Usuario registrado o no registrado
			 * b. Si usuario registrado dirección nueva o registrada
			 */
			
			$order_comment = $this -> request -> data['Order']['comments'];
			$coupon_code = $this -> request -> data['Order']['coupon_code'];
			
			// Usuario NO registrado
			if(!$this -> Auth -> user('id')) {
				// Crear el usuario
				$email = $this -> request -> data['User']['email'];
				$name = $this -> request -> data['User']['name'];
				$lastname = $this -> request -> data['User']['lastname'];
				$user_data = $this -> requestAction('/user_control/users/internalCreateUser/' . $email . '/' . $name . '/' . $lastname);
				$user_id = $user_data['user_id'];
				$user_password = $user_data['password'];
				$user_address = array('UserAddress' => $this -> request -> data['UserAddress']);
				if ($user_id) {
					// El usuario se creó, crear la dirección
					$user_address['UserAddress']['name'] = 'Principal';
					$user_address['UserAddress']['user_id'] = $user_id;
					$this -> Order -> UserAddress -> create();
					if($this -> Order -> UserAddress -> save($user_address)) {
						// Se registró la dirección
						$this -> requestAction('/b_cart/shopping_carts/assignUserToCart/' . $user_id);
						
						/**
						 * Falta:
						 * a.	revisar el proceso de registro para que coincida con el proceso principal
						 * 		i. enviar el correo al usuario
						 */
						
						$this -> requestAction('/user_control/users/internalLoginUser/' . $user_id);
						$this -> requestAction('/user_control/users/internalSendRegistrationData/' . $user_id . '/' . $user_password);
						$this -> createOrder($this -> Auth -> user('id'), $this -> Order -> UserAddress -> id, $order_comment, $coupon_code);
						
					} else {
						// Error al registrar la dirección
						debug($this -> Order -> UserAddress -> invalidFields());
					}
				} else {
					// Error al crear el usuario
					debug('error al crear el usuario');
				}
			}
			// Usuario registrado
			else {
				// Dirección registrada
				if($this -> request -> data['UserAddress']['id']) {
					$this -> createOrder($this -> Auth -> user('id'), $this -> request -> data['UserAddress']['id'], $order_comment, $coupon_code);
				}
				// Dirección nueva
				else {
					// Crear la dirección nueva
					$user_address = array('UserAddress' => $this -> request -> data['UserAddress']);
					unset($user_address['id']);
					$user_address['UserAddress']['user_id'] = $this -> Auth -> user('id');
					$user_address['UserAddress']['name'] = 'Nueva';
					$this -> Order -> UserAddress -> create();
					if($this -> Order -> UserAddress -> save($user_address)) {
						$this -> createOrder($this -> Auth -> user('id'), $this -> Order -> UserAddress -> id, $order_comment, $coupon_code);
					} else {
						debug($this -> Order -> UserAddress -> invalidFields());
					}
				}				
			}
		}
	}
	
	private function createOrder($user_id = null, $user_address_id = null, $order_comment = null, $coupon_code = null) {
		if($user_id && $user_address_id) {
			$this -> loadModel('BCart.ShoppingCart');
			$this -> loadModel('BCart.CartItem');
			$shopping_cart = $this -> ShoppingCart -> findByUserId($user_id);
			
			// Generar el código de la orden
			$total_orders = $this -> Order -> find('count');
			$total_orders += 1;
			//$total_orders += 0000000100;
			while(strlen($total_orders) < 10) {
				$total_orders = '0' . $total_orders;
			}
			
			// Crear la orden
			$this -> Order -> create();
			$order = array(
				'Order' => array(
					'code' => $total_orders,
					'order_state_id' => 1,
					'user_id' => $user_id,
					'user_address_id' => $user_address_id,
					'comments' => $order_comment,
					'coupon_code' => $coupon_code,
					'shipment_cost' => $this -> requestAction('/configs/getShipmentCost')
				)
			);
			
			if($this -> Order -> save($order)) {
				
				/**
				 * Verificar si se envió un código de cupon
				 */
				
				$coupon_info = null;
				
				if($coupon_code) {
					$coupon_info = $this -> requestAction('/coupon_batches/getInternalCouponInfo/' . $coupon_code);
				}
				
				foreach($shopping_cart['CartItem'] as $key => $cart_item) {
						
					$this -> Order -> OrderItem -> create();
					$this -> Order -> OrderItem -> Product -> recursive = -1;
					$product = $this -> Order -> OrderItem -> Product -> findById($cart_item['product_id']);
					$total_items_price = 0;
					
					if($coupon_info) {
						// X% de descuento en la compra
						if($coupon_info['CouponBatch']['coupon_type_id'] == 3) {
							$quantity = $cart_item['quantity'];
							$price = $product['Product']['price'];
							$discount = $price - ($price * $coupon_info['CouponBatch']['discount']);
							$itemTotal = ($price * $quantity) - ($discount * $quantity);
							$total_items_price = round($itemTotal, 2);
						} else {
							/**
							 * Proceso para cuando se es pague uno lleve 2 o paque el 2do a un % de descuento
							 */
							// Obtener el total de pares de zapatos comprados
							$cartItems = $shopping_cart['CartItem'];
							$totalItems = 0;
							foreach($cartItems as $key => $anItem) {
								$totalItems += $anItem['quantity'];
								$cartItems[$key]['displayPrice'] = 0;
							}
							// Ver cuantas parejas de pares de zapatos hay
							$pairs = (int) $totalItems / 2;
							// Procesar el pedido y obtener los descuentos acorde el tipo de cupon (solo aplica a los pares)
							do {
								// Recorrer los items comprados de mayor a menor precio
								for($pos = 0, $foundFirst = false; $pos < count($cartItems) & !$foundFirst; $pos += 1) {
									// Verificar la cantidad de pares comprados del ítem
									if($cartItems[$pos]['quantity'] >= 1) {
										// Hay uno o más de un par de zapatos de este ítem
										$cartItems[$pos]['quantity'] -= 1;
										$foundFirst = true;
										$cartItems[$pos]['displayPrice'] += $cartItems[$pos]['price'];
										/**
										 * Se redujo la cantidad en 1 lo que implica que se reviso este par de zapatos.
										 * Proceder a aplicar descuentos apliclables a los pares con menores precios.
										 * NOTA: Proceso en el siguiente for()...
										 */
									} else {
										// Ya fueron procesados los pares de zapatos de este ítem
									}
								}
								// Recorrer los items comprados de menor a mayor precio
								for($pos = count($cartItems) - 1, $foundLast = false; $pos >= 0  & !$foundLast; $pos -= 1) {
									// Verificar la cantidad de pares comprados del ítem
									if($cartItems[$pos]['quantity'] >= 1) {
										// Hay uno o más de un par de zapatos de este ítem
										$foundLast = true;
										$priceWithDiscount = 0;
										/**
										 * Verificar que tipo de descuento es y aplicarlo
										 */
										// Pague uno lleve 2
										if($coupon_info['CouponBatch']['coupon_type_id'] == 1) {
											// TODO : Nada por el momento!
										}
										// Pague el 2do a X% de descuento
										else if($coupon_info['CouponBatch']['coupon_type_id'] == 2) {
											// Encontrar el valor de descuento y asignar subTotal
											$itemPrice = $cartItems[$pos]['price'];
											$discount = couponInfo.CouponBatch.discount;
											$priceWithDiscount = $itemPrice * $discount;
											$cartItems[$pos]['displayPrice'] += $priceWithDiscount;
										}
										$cartItems[$pos]['quantity'] -= 1;
									} else {
										// Ya fueron procesados los pares de zapatos de este ítem
									}
								}
								$pairs -= 1;
							} while($pairs > 0);
							// Procesar los pares restantes
							for($pos = 0; $pos < count($cartItems); $pos += 1) {
								if($cartItems[$pos]['quantity'] > 0) {
									$cartItems[$pos]['displayPrice'] += $cartItems[$pos]['quantity'] * $cartItems[$pos]['price'];
								}
							};
							foreach($cartItems as $pos => $anItem) {
								if($cart_item['id'] == $anItem['id']) {
									$total_items_price = round($anItem['displayPrice'], 2);
									break;
								}
							}
						}
					} else {
						$total_items_price = round($cart_item['quantity'] * $product['Product']['price'], 2);
					}
					
					$order_item = array(
						'OrderItem' => array(
							'order_id' => $this -> Order -> id,
							'product_id' => $cart_item['product_id'],
							'color_id' => $cart_item['color_id'],
							'product_size_id' => $cart_item['product_size_id'],
							'quantity' => $cart_item['quantity'],
							'single_item_price' => round($product['Product']['price'], 2),
							'single_item_tax' => round($product['Product']['tax_value'], 2),
							'total_items_price' => $total_items_price,
							'total_items_tax' => round($cart_item['quantity'] * $product['Product']['tax_value'], 2)
						)
					);
					
					if($this -> Order -> OrderItem -> save($order_item)) {
						$this -> CartItem -> delete($cart_item['id']);
					}
					
				}

				$this -> Session -> write('OrderInfo', array('order_id' => $this -> Order -> id, 'user_id' => $user_id, 'user_address_id' => $user_address_id));
				$this -> redirect(array('action' => 'sendPlatformRequest'));
				
			} else {
				return false;
			}
			
		} else {
			return false;
		}
		
	}
	
	public function sendPlatformRequest() {
		//$this -> Session -> write('OrderInfo', array('order_id' => 1, 'user_id' => 12, 'user_address_id' => 7));
		$order_info = $this -> Session -> read('OrderInfo');
		$order_id = $order_info['order_id'];
		$user_id = $order_info['user_id'];
		$user_address_id = $order_info['user_address_id'];
		$this -> Order -> Behaviors -> attach('Containable');
		$this -> Order -> contain(
			'User.email', 'User.name', 'User.lastname', 'UserAddress', 'OrderItem', 'OrderItem.Product'
		);
		$order = $this -> Order -> read(null, $order_id);
		
		// Datos de la orden
		$money_data = array(
			'base' => 0,
			'tax' => 0,
			'total' => 0
		);
		
		// Info de precio de los items
		foreach ($order['OrderItem'] as $key => $item) {
			$money_data['total'] += $item['total_items_price'];
			$money_data['tax'] += $item['total_items_tax'];
			$money_data['base'] += $item['total_items_price'] - $item['total_items_tax'];
		}
		
		// Info de precio del envío
		$money_data['base'] += $order['Order']['shipment_cost'];
		$money_data['total'] += $order['Order']['shipment_cost'];
		
		$money_data['total'] = (string) $money_data['total'];
		if(!strstr($money_data['total'], '.')) {
			$money_data['total'] .= '.00';
		}
		$money_data['tax'] = (string) $money_data['tax'];
		if(!strstr($money_data['tax'], '.')) {
			$money_data['tax'] .= '.00';
		}
		$money_data['base'] = (string) $money_data['base'];
		if(!strstr($money_data['base'], '.')) {
			$money_data['base'] .= '.00';
		}

		$this -> set('tax', $money_data['tax']);
		$this -> set('base', $money_data['base']);
		$this -> set('total', $money_data['total']);
		
		// Datos interpagos
		$this -> set('client_id', $this -> Interpagos -> getClientId());
		$this -> set('token', $this -> Interpagos -> getToken($order['Order']['code'], $money_data['total']));
		$this -> set('reference_id', $order['Order']['code']);
		$this -> set('reference', 'Pago compra PriceShoes S.A.S. :: ' . date('Y-m-d H:i:s', time()));
		
		// Datos comprador
		$this -> set('shopper_name', $order['User']['name'] . ' ' . $order['User']['lastname']);
		$this -> set('shopper_email', $order['User']['email']);
		
		// Datos extra
		$this -> set('user_id', $user_id);
		$this -> set('user_address_id', $user_address_id);
		$this -> set('order_id', $order_id);
		
		// Enviar el correo al usuario
		$email_address = Configure::read('email');
		$email_password = Configure::read('email_password');
		$site_name = Configure::read('site_name');
		$gmail = array(
			'host' => 'ssl://smtp.gmail.com',
			'port' => 465,
			'username' => $email_address,
			'password' => $email_password,
			'transport' => 'Smtp'
		);
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail($gmail);
		$email -> from(array($email_address => $site_name));
		$email -> to($order['User']['email']);
		$email -> bcc('servicioalcliente@priceshoes.com.co');
		$email -> subject('Orden Recibida :: ' . $site_name);
		$email -> template('order_received');
		$email -> emailFormat('html');
		$email -> viewVars(
			array(
				'order' => $order
			)
		);
		$email -> send();
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Order -> recursive = 0;
		$this -> set('orders', $this -> paginate());
	}
	
	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Order -> id = $id;
		if (!$this -> Order -> exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			
			if ($this -> Order -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se ha cambiado el estado de la orden'), 'crud/success');
				// Enviar correo dependiendo del nuevo estado
				$this -> Order -> Behaviors -> attach('Containable');
				$this -> Order -> contain(
					'User.email', 'User.name', 'User.lastname', 'UserAddress', 'OrderItem', 'OrderItem.Product'
				);
				$order = $this -> Order -> read(null, $this -> request -> data['Order']['id']);
				$email_address = Configure::read('email');
				$email_password = Configure::read('email_password');
				$site_name = Configure::read('site_name');
				$gmail = array(
					'host' => 'ssl://smtp.gmail.com',
					'port' => 465,
					'username' => $email_address,
					'password' => $email_password,
					'transport' => 'Smtp'
				);
				App::uses('CakeEmail', 'Network/Email');
				$email = new CakeEmail($gmail);
				$email -> from(array($email_address => $site_name));
				$email -> to($order['User']['email']);
				$email -> emailFormat('html');
				$email -> viewVars(
					array(
						'order' => $order
					)
				);
				if($this -> request -> data['Order']['order_state_id'] == 3) {
					// Orden enviada
					$email -> subject('Orden Confirmada :: ' . $site_name);
					$email -> template('order_confirmed');
					// Procesar los ítems para reducir inventarios!
					$this -> loadModel('Inventory');
					$products_with_errors = "";
					foreach($order['OrderItem'] as $key => $item) {
						$inventory = $this -> Inventory -> find(
							'first',
							array(
								'conditions' => array(
									'Inventory.product_id' => $item['product_id'],
									'Inventory.color_id' => $item['color_id'],
									'Inventory.product_size_id' => $item['product_size_id']
								)
							)
						);
						if($inventory && ($inventory['Inventory']['quantity'] >= $item['quantity'])) {
							$inventory['Inventory']['quantity'] -= $item['quantity'];
							if($this -> Inventory -> save($inventory)) {
								// Todo bn!
							} else {
								$products_with_errors .= $inventory['Product']['reference'] . ' ';
							}
						} else {
							$products_with_errors .= $inventory['Product']['reference'] . ' ';
						}
					}
					if($products_with_errors) {
						$this -> Session -> setFlash(__('Verificar cantidad de inventario para las siguientes referencias: ' . $products_with_errors), 'crud/error');
					}
				} elseif($this -> request -> data['Order']['order_state_id'] == 5) {
					// Orden anulada
					$email -> subject('Orden Rechazada :: ' . $site_name);
					$email -> template('order_rejected');
				}
				$email -> send();
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo cambiar el estado de la orden. Por favor, intente de nuevo.'), 'crud/error');
			}
						
		} else {
			$this -> request -> data = $this -> Order -> read(null, $id);
		}
		$orderStates = $this -> Order -> OrderState -> find('list', array('conditions' => array('OrderState.id >' => 2)));
		if($this -> request -> data['Order']['order_state_id'] == 3) {
			unset($orderStates[3]);
			unset($orderStates[5]);
		} elseif($this -> request -> data['Order']['order_state_id'] == 4) {
			unset($orderStates[3]);
			unset($orderStates[5]);
		} elseif($this -> request -> data['Order']['order_state_id'] == 5) {
			unset($orderStates[3]);
			unset($orderStates[4]);
		}
		$this -> set(compact('orderStates'));
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Order -> recursive = 2;
		$this -> Order -> id = $id;
		if (!$this -> Order -> exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this -> set('order', $this -> Order -> read(null, $id));
	}
	
	// "páginas" para recibir modificaciones de interpagos
	
	/**
	 * Recibir respuesta inicial
	 */
	public function platformResponse() {
		$this -> autoRender = false;
		$response = $this -> Interpagos -> checkResponse();
		$order = $this -> Order -> read(null, $response['order_id']);
		$order['Order']['information'] = $response['response_code'] . ' - ' . $this -> Interpagos -> getResponseCodeMessage($response['response_code']);
		$order['Order']['order_state_id'] = 2;
		$this -> Order -> save($order);
		// Revisar el estado del cupon en caso de que haya uno usado
		$coupon_code = $order['Order']['coupon_code'];
		if($coupon_code) {
			$this -> requestAction('/coupon_batches/internalDeactivateCoupon/' . $coupon_code);
		}
		if($response['approved']) {
			$this -> Session -> setFlash($this -> Interpagos -> getResponseCodeMessage($response['response_code']), 'crud/success');
		} else {
			$this -> Session -> setFlash($this -> Interpagos -> getResponseCodeMessage($response['response_code']), 'crud/error');
		}
		$this -> redirect(array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'profile'));
	}
	
	/**
	 * Recibir actualizaciones
	 */
	public function platformUpdate() {
		$this -> autoRender = false;
		$response = $this -> Interpagos -> checkResponse();
		$order = $this -> Order -> read(null, $response['order_id']);
		$order['Order']['information'] = $response['response_code'] . ' - ' . $this -> Interpagos -> getResponseCodeMessage($response['response_code']);
		$order['Order']['order_state_id'] = 2;
		$this -> Order -> save($order);
	}

}
