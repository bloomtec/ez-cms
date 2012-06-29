<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 */
class OrdersController extends AppController {
	
	public $components = array('Interpagos');

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
		if ($this -> request -> is('post')) {
			$this -> Order -> create();
			if ($this -> Order -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The order has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The order could not be saved. Please, try again.'));
			}
		}
		/**
		$orderStates = $this -> Order -> OrderState -> find('list');
		$users = $this -> Order -> User -> find('list');
		$userAddresses = $this -> Order -> UserAddress -> find('list');
		$this -> set(compact('orderStates', 'users', 'userAddresses'));
		 */
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
