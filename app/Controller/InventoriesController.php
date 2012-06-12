<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 */
class InventoriesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Inventory->recursive = 0;
		$this->set('inventories', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->set('inventory', $this->Inventory->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Inventory->create();
			if ($this->Inventory->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory could not be saved. Please, try again.'));
			}
		}
		$products = $this->Inventory->Product->find('list');
		$productSizes = $this->Inventory->ProductSize->find('list');
		$this->set(compact('products', 'productSizes'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Inventory->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Inventory->read(null, $id);
		}
		$products = $this->Inventory->Product->find('list');
		$productSizes = $this->Inventory->ProductSize->find('list');
		$this->set(compact('products', 'productSizes'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->Inventory->delete()) {
			$this->Session->setFlash(__('Inventory deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inventory was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Inventory->recursive = 0;
		$this->set('inventories', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		$this->set('inventory', $this->Inventory->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Inventory->create();
			if ($this->Inventory->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory could not be saved. Please, try again.'));
			}
		}
		$products = $this->Inventory->Product->find('list');
		$productSizes = $this->Inventory->ProductSize->find('list');
		$this->set(compact('products', 'productSizes'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Inventory->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Inventory->read(null, $id);
		}
		$products = $this->Inventory->Product->find('list');
		$productSizes = $this->Inventory->ProductSize->find('list');
		$this->set(compact('products', 'productSizes'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Inventory->id = $id;
		if (!$this->Inventory->exists()) {
			throw new NotFoundException(__('Invalid inventory'));
		}
		if ($this->Inventory->delete()) {
			$this->Session->setFlash(__('Inventory deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Inventory was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
