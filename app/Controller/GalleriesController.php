<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 */
class GalleriesController extends AppController {

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Gallery -> recursive = 0;
		$this -> set('galleries', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Galería no válida'));
		}
		$this -> set('gallery', $this -> Gallery -> read(null, $id));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Gallery -> recursive = 0;
		$this -> set('galleries', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Galería no válida'));
		}
		$this -> set('gallery', $this -> Gallery -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Gallery -> create();
			if ($this -> Gallery -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la galería', 'crud/success'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Por favor, intente de nuevo.', 'crud/error'));
			}
		}
		$products = $this -> Gallery -> Product -> find('list');
		$this -> set(compact('products'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Galería no válida'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Gallery -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la galería', 'crud/success'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Por favor, intente de nuevo.', 'crud/error'));
			}
		} else {
			$this -> request -> data = $this -> Gallery -> read(null, $id);
		}
		$products = $this -> Gallery -> Product -> find('list');
		$this -> set(compact('products'));
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
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Galería no válida'));
		}
		if ($this -> Gallery -> delete()) {
			$this -> Session -> setFlash(__('Se eliminó la galería', 'crud/success'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la galería', 'crud/error'));
		$this -> redirect(array('action' => 'index'));
	}

}
