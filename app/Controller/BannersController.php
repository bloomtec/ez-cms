<?php
App::uses('AppController', 'Controller');
/**
 * Banners Controller
 *
 * @property Banner $Banner
 */
class BannersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('get');
	}
	
	/**
	 * Obtener el contenido de un banner dado su nombre
	 * 
	 * @param string $name El nombre del banner
	 * @return El contenido del banner
	 */
	public function get($name) {
		if(isset($name) && strlen($name) >= 1) {
			$banner = $this -> Banner -> findByName($name);
			return $banner['Banner']['content'];
		} else {
			return array();
		}
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Banner -> recursive = 0;
		$this -> set('banners', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Banner -> id = $id;
		if (!$this -> Banner -> exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		$this -> set('banner', $this -> Banner -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	/*
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Banner -> create();
			if ($this -> Banner -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The banner has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The banner could not be saved. Please, try again.'));
			}
		}
	}
	 */ 

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Banner -> id = $id;
		if (!$this -> Banner -> exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Banner -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The banner has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The banner could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Banner -> read(null, $id);
		}
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	/*
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Banner -> id = $id;
		if (!$this -> Banner -> exists()) {
			throw new NotFoundException(__('Invalid banner'));
		}
		if ($this -> Banner -> delete()) {
			$this -> Session -> setFlash(__('Banner deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Banner was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}
	 */

}
