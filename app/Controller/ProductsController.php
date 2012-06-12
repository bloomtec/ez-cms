<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('view','getNovelty','getTopSeller');
	}
	/**
	 * getNovedad method
	 *
	 * @return Array
	 */
	public function getNovelty(){
		$this -> Product -> recursive=-1;
		$product = $this -> Product -> find('first',array(
			'conditions'=>array(
				'is_novelty'=>true, 
				/*CONDICION QUE TENGA INGENTARIO*/
				), 
			'order'=>'RAND()'
			)
		);
		return $product;
	}
	
	/**
	 * getTopSeller method
	 *
	 * @return Array
	 */
	public function getTopSeller(){
		$this -> Product -> recursive=-1;
		$product = $this -> Product -> find('first',array(
			'conditions'=>array(
				'is_top_seller'=>true, 
				/*CONDICION QUE TENGA INGENTARIO*/
				), 
			'order'=>'RAND()'
			)
		);
		return $product;
	}
	
	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		$this -> set('product', $this -> Product -> read(null, $id));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		$this -> set('product', $this -> Product -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Product -> create();
			if ($this -> Product -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó el producto'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Product -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó el producto'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Product -> read(null, $id);
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		if ($this -> Product -> delete()) {
			$this -> Session -> setFlash(__('Se eliminó el producto'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el producto'));
		$this -> redirect(array('action' => 'index'));
	}

}
