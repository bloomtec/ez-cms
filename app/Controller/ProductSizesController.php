<?php
App::uses('AppController', 'Controller');
/**
 * ProductSizes Controller
 *
 * @property ProductSize $ProductSize
 */
class ProductSizesController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('reOrder');
	}
	
	public function reOrder() {
		$this -> autoRender = false;
		$success = true;
		$this -> ProductSize -> recursive = -1;
		foreach($this -> request -> data['ProductSize'] as $id => $position) {
			$item = $this -> ProductSize -> findById($id);
			$item['ProductSize']['order'] = $position;
			if(!$this -> ProductSize -> save($item)) {
				$success = false;
			}
		}
		if($success) {
			echo 'yes';
		} else {
			echo 'no';
		}
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> ProductSize -> recursive = 0;
		$this -> paginate = array(
			'order' => array('ProductSize.order' => 'ASC'),
			'limit' => 1000
		);
		$this -> set('productSizes', $this -> paginate());
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> ProductSize -> create();
			if ($this -> ProductSize -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se agregó la talla'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se agregó la talla. Por favor, intente de nuevo.'), 'crud/error');
			}
		}
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> ProductSize -> id = $id;
		if (!$this -> ProductSize -> exists()) {
			throw new NotFoundException(__('Invalid product size'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> ProductSize -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se agregó la talla'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se agregó la talla. Por favor, intente de nuevo.'), 'crud/error');
			}
		} else {
			$this -> request -> data = $this -> ProductSize -> read(null, $id);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	/**
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> ProductSize -> id = $id;
		if (!$this -> ProductSize -> exists()) {
			throw new NotFoundException(__('Invalid product size'));
		}
		if ($this -> ProductSize -> delete()) {
			$this -> Session -> setFlash(__('Product size deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Product size was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}
	 */

}
