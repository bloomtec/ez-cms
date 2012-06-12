<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 */
class InventoriesController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Inventory -> id = $id;
		if (!$this -> Inventory -> exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this -> set('inventory', $this -> Inventory -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function addInventory($product_id = null, $product_size_id = null) {
		if($product_id && $product_size_id) {
			$inventory = array(
				'Inventory' => array(
					'product_id' => $product_id,
					'product_size_id' => $product_size_id,
					'quantity' => 0
				)
			);
			$this -> Inventory -> create();
			return $this -> Inventory -> save($inventory);
		} else {
			return false;
		}
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Inventory -> id = $id;
		if (!$this -> Inventory -> exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Inventory -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The inventory has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The inventory could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Inventory -> read(null, $id);
		}
		$products = $this -> Inventory -> Product -> find('list');
		$productSizes = $this -> Inventory -> ProductSize -> find('list');
		$this -> set(compact('products', 'productSizes'));
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
		$this -> Inventory -> id = $id;
		if (!$this -> Inventory -> exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this -> Inventory -> delete()) {
			$this -> Session -> setFlash(__('Inventory deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Inventory was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}

}
