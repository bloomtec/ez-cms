<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 */
class GalleriesController extends AppController {
	
	public $components = array('Attachment');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('uploadify_add');
	}

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
			throw new NotFoundException(__('Invalid gallery'));
		}
		$this -> set('gallery', $this -> Gallery -> read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Gallery -> create();
			if ($this -> Gallery -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la galería'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Recuerde agregar una imagen e intente de nuevo.'));
			}
		}
		$inventories = $this -> Gallery -> Inventory -> find('list');
		$this -> set(compact('inventories'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Gallery -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la galería'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Recuerde agregar una imagen e intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Gallery -> read(null, $id);
		}
		$inventories = $this -> Gallery -> Inventory -> find('list');
		$this -> set(compact('inventories'));
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Gallery -> id = $id;
		if (!$this -> Gallery -> exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this -> Gallery -> delete()) {
			$this -> Session -> setFlash(__('Gallery deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Gallery was not deleted'));
		$this -> redirect(array('action' => 'index'));
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
			throw new NotFoundException(__('Invalid gallery'));
		}
		$gallery = $this -> Gallery -> read(null, $id);
		$this -> set('gallery', $gallery);
		$inventory = $this -> Gallery -> Inventory -> find('first', array('conditions' => array('Inventory.id' => $gallery['Gallery']['inventory_id'])));
		$inventory['Inventory']['name_for_gallery'] = $inventory['Inventory']['product'] . " - " . $inventory['Inventory']['color'] . " - " . $inventory['Inventory']['size'];
		$this -> set('inventory', $inventory);
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
				$this -> Session -> setFlash(__('Se guardó la galería'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Recuerde agregar una imagen e intente de nuevo.'));
			}
		}
		$tmp_inventories = $this -> Gallery -> Inventory -> find('all');
		$inventories = array();
		foreach($tmp_inventories as $key => $inventory) {
			$inventories[$inventory['Inventory']['id']] = $inventory['Inventory']['product'] . " - " . $inventory['Inventory']['color'] . " - " . $inventory['Inventory']['size'];
		}
		$galleries = $this -> Gallery -> find('all', array('recursive' => -1));
		foreach ($galleries as $key => $gallery) {
			unset($inventories[$gallery['Gallery']['id']]);
		}
		$this -> set(compact('inventories'));
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
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Gallery -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la galería', 'crud/success'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Recuerde agregar una imagen e intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Gallery -> read(null, $id);
		}
		$tmp_inventories = $this -> Gallery -> Inventory -> find('all');
		$inventories = array();
		foreach($tmp_inventories as $key => $inventory) {
			$inventories[$inventory['Inventory']['id']] = $inventory['Inventory']['product'] . " - " . $inventory['Inventory']['color'] . " - " . $inventory['Inventory']['size'];
		}
		$galleries = $this -> Gallery -> find('all', array('recursive' => -1));
		foreach ($galleries as $key => $gallery) {
			if($id != $gallery['Gallery']['id']) {
				unset($inventories[$gallery['Gallery']['id']]);
			}
		}
		$this -> set(compact('inventories'));
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
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this -> Gallery -> delete()) {
			$this -> Session -> setFlash(__('Gallery deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Gallery was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}
	
	function uploadify_add() {
		$this -> autoRender = false;
		Configure::write("debug", 0);
		
		if ($_POST['name'] && $_POST['folder']) {

			$fileName = $_POST['name'];
			$folder = $_POST['folder'];
			
			if(!$this -> Attachment -> resize_image('resize', $folder . '/' . $fileName, $folder . '/50x50', $fileName, 50,	50)) {
				echo
				"
				Error al tratar de redimensionar imagen 50x50
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			if(!$this -> Attachment -> resize_image("resize", $folder . "/" . $fileName, $folder . "/100x100", $fileName, 100, 100)) {
				echo
				"
				Error al tratar de redimensionar imagen 100x100
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			if(!$this -> Attachment -> resize_image("resize", $folder . "/" . $fileName, $folder . "/150x150", $fileName, 150, 150)) {
				echo
				"
				Error al tratar de redimensionar imagen 150x150
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			if(!$this -> Attachment -> resize_image("resize", $folder . "/" . $fileName, $folder . "/215x215", $fileName, 215, 215)) {
				echo
				"
				Error al tratar de redimensionar imagen 215x215
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			if(!$this -> Attachment -> resize_image("resize", $folder . "/" . $fileName, $folder . "/360x360", $fileName, 360, 360)) {
				echo
				"
				Error al tratar de redimensionar imagen 360x360
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			if(!$this -> Attachment -> resize_image("resize", $folder . "/" . $fileName, $folder . "/750x750", $fileName, 750, 750)) {
				echo
				"
				Error al tratar de redimensionar imagen 750x750
				Folder : $folder
				Archivo : $fileName
				";
				exit(0);
			}
			 			
		}
		
		exit(0);

	}

}
