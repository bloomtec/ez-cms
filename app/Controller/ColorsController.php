<?php
App::uses('AppController', 'Controller');
/**
 * Colors Controller
 *
 * @property Color $Color
 */
class ColorsController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Color -> recursive = 0;
		$this -> set('colors', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Color -> id = $id;
		if (!$this -> Color -> exists()) {
			throw new NotFoundException(__('Invalid color'));
		}
		$this -> set('color', $this -> Color -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Color -> create();
			if ($this -> Color -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('El color ha sido guardado') , 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('El color no se pudo guardar. Por favor, intente nuevamente.'), 'crud/error');
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
		$this -> Color -> id = $id;
		if (!$this -> Color -> exists()) {
			throw new NotFoundException(__('Invalid color'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Color -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('El color ha sido guardado') , 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('El color no se pudo guardar. Por favor, intente nuevamente.'), 'crud/error');
			}
		} else {
			$this -> request -> data = $this -> Color -> read(null, $id);
		}
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
		$this -> Color -> id = $id;
		if (!$this -> Color -> exists()) {
			throw new NotFoundException(__('Invalid color'));
		}
		if ($this -> Color -> delete()) {
			$this -> Session -> setFlash(__('Color borrado'), 'crud/success');
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se pudo guardar el color'), 'crud/error');
		$this -> redirect(array('action' => 'index'));
	}

}
