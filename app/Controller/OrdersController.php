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
		$this -> Auth -> allow('add');
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
			
			// Usuario NO registrado
			if(!$this -> Auth -> user('id')) {
				$this -> loadModel('BCart.User');
				$this -> loadModel('BCart.UserAddress');
				// Crear una contraseña automatica
				$this -> request -> data['User']['password'] = $password;
				$this -> request -> data['User']['verify_password'] = $password;
				$clientRole = $this -> User -> Role -> find('first', array('order' => array('id' => 'DESC'), 'recursive' => -1));
				$this -> request -> data['User']['role_id'] = $clientRole['Role']['id'];
				// Crear el usuario
				$user = array('User' => $this -> request -> data['User']);
				$address = array('UserAddress' => $this -> request -> data['UserAddress']);
				$this -> User -> create();
				if ($this -> User -> save($user)) {
					$user = $this -> User -> read(null, $this -> User -> id);
					$user_id = $user['User']['id'];
					$user_alias = $user['User']['username'];
					$this -> User -> query("UPDATE `aros` SET `alias`='$user_alias' WHERE `model`='User' AND `foreign_key`=$user_id");
					// El usuario se creó, crear la dirección
					$user_address['UserAddress']['name'] = 'Principal';
					$user_address['UserAddress']['user_id'] = $user_id;
					$this -> UserAddress -> create();
					if($this -> UserAddress -> save($user_address)) {
						// Se registró la dirección
						$this -> requestAction('/b_cart/shopping_carts/assignUserToCart/' . $user_id);
						
						/**
						 * Falta:
						 * a. Crear la orden
						 * b. enviar el correo al usuario
						 * c. redireccionar a interpagos registrado con sus datos.
						 */
						
					} else {
						// Error al registrar la dirección
						debug($this -> UserAddress -> invalidFields());
					}
				} else {
					// Error al crear el usuario
					debug($this -> User -> invalidFields());
				}
			} 
			// Usuario registrado
			else {
				/**
				 * Falta:
				 * a. Revisar si es o no una dirección nueva
				 * b. Crear la orden
				 * c. redireccionar a interpagos
				 */
				 
				// Crear la orden
				$this -> loadModel('BCart.ShoppingCart');						
				$shopping_cart = $this -> ShoppingCart -> findByUserId($this -> Order -> User -> id);
			}
			
			debug($this -> request -> data);
			
			/**
			$this -> Order -> create();
			if ($this -> Order -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The order has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.'));
			}
			 */
		}
		/**
		$orderStates = $this -> Order -> OrderState -> find('list');
		$users = $this -> Order -> User -> find('list');
		$userAddresses = $this -> Order -> UserAddress -> find('list');
		$this -> set(compact('orderStates', 'users', 'userAddresses'));
		 */
	}
	
	/**
	 * Generar una contraseña de manera automática
	 * 
	 * @return Una contraseña aleatoria
	 */
	private function generatePassword() {
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$cad = "";
		for ($i = 0; $i < 8; $i++) {
			$cad .= substr($str, rand(0, 62), 1);
		}
		return $cad;
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
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
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
		
	}
	
	/**
	 * Recibir actualizaciones
	 */
	public function platformUpdate() {
		
	}

}
