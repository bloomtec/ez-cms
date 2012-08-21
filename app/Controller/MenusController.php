<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 */
class MenusController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getMenuItems');
	}
	
	/**
	 * Obtener los items del menu
	 * 
	 * @param string $menu Nombre del menú
	 * @return Arreglo con la información de los menuItems
	 */
	public function getMenuItems($menu) {
		if(isset($menu) && strlen($menu) >= 1) {
			$this -> Menu -> recursive = -1;
			$menu = $this -> Menu -> findByName($menu);
			if($menu) {
				$menu_items = $this -> Menu -> MenuItem -> find(
					'all',
					array(
						'conditions' => array(
							'MenuItem.menu_id' => $menu['Menu']['id']
						),
						'recursive' => -1,
						'order' => array(
							'MenuItem.position' => 'ASC'					
						)
					)
				);
				if($menu_items) {
					return $menu_items;
				} else {
					return array();
				}
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Menu -> recursive = 0;
		$this -> set('menus', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Menu -> id = $id;
		if (!$this -> Menu -> exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this -> set('menu', $this -> Menu -> read(null, $id));
		$this -> loadModel('Page');
		$this -> set('pages', $this -> Page -> find('list'));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	/**
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Menu -> create();
			if ($this -> Menu -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The menu has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu could not be saved. Please, try again.'));
			}
		}
	}
	 */

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	/**
	public function admin_edit($id = null) {
		$this -> Menu -> id = $id;
		if (!$this -> Menu -> exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Menu -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The menu has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The menu could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Menu -> read(null, $id);
		}
	}
	 */

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	/**
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Menu -> id = $id;
		if (!$this -> Menu -> exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this -> Menu -> delete()) {
			$this -> Session -> setFlash(__('Menu deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Menu was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}
	 */

}
