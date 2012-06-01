<?php
App::uses('AppController', 'Controller');
/**
 * MenuItems Controller
 *
 * @property MenuItem $MenuItem
 */
class MenuItemsController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> MenuItem -> recursive = 0;
		$this -> set('menuItems', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> MenuItem -> id = $id;
		if (!$this -> MenuItem -> exists()) {
			throw new NotFoundException(__('Invalid menu item'));
		}
		$this -> set('menuItem', $this -> MenuItem -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> MenuItem -> create();
			if ($this -> MenuItem -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The menu item has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu item could not be saved. Please, try again.'));
			}
		}
		$menus = $this -> MenuItem -> Menu -> find('list');
		$this -> set(compact('menus'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> MenuItem -> id = $id;
		if (!$this -> MenuItem -> exists()) {
			throw new NotFoundException(__('Invalid menu item'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> MenuItem -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The menu item has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu item could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> MenuItem -> read(null, $id);
		}
		$menus = $this -> MenuItem -> Menu -> find('list');
		$this -> set(compact('menus'));
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
		$this -> MenuItem -> id = $id;
		if (!$this -> MenuItem -> exists()) {
			throw new NotFoundException(__('Invalid menu item'));
		}
		if ($this -> MenuItem -> delete()) {
			$this -> Session -> setFlash(__('Menu item deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Menu item was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}

}
