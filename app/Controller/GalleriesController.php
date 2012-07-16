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
	
	public function admin_productGalleryWizard($product_id = null) {
		if($this -> request -> is('post') || $this -> request -> is('put')) {
			foreach($this -> request -> data['Gallery'] as $index => $gallery) {
				$data = array('Gallery' => $gallery);
				if($this -> Gallery -> save($data)) {
					$image = array(
						'Image' => array(
							'gallery_id' => $this -> Gallery -> id,
							'path' => $data['Gallery']['image']
						)
					);
					$this -> Gallery -> Image -> create();
					$this -> Gallery -> Image -> save($image);
				}
			}
			$this -> redirect(array('controller' => 'products', 'action' => 'edit', $product_id, true));
		}
		if($product_id) {
			$this -> loadModel('Inventory');
			$inventories = $this -> Inventory -> find(
				'all',
				array(
					'recursive' => -1,
					'conditions' => array(
						'Inventory.product_id' => $product_id
					)
				)
			);
			$prod_color_codes = array();
			if(!empty($inventories)) {
				foreach ($inventories as $index => $inventory) {
					$prod_color_codes[] = $inventory['Inventory']['gallery'];
					$tmp_gallery = $this -> Gallery -> find(
						'first',
						array(
							'recursive' => -1,
							'conditions' => array(
								'Gallery.prod_color_code' => $inventory['Inventory']['gallery']
							)
						)
					);
					if(!$tmp_gallery) {
						$this -> Gallery -> create();
						$gallery = array(
							'Gallery' => array(
								'prod_color_code' => $inventory['Inventory']['gallery'],
								'name' => $inventory['Inventory']['product'] . " - " . $inventory['Inventory']['color'],
								'description' => '',
								'image' => ''
							)
						);
						if($this -> Gallery -> save($gallery)) {
							//debug('Se creo la galería');
						} else {
							//debug('No se creó la galería');
							//debug($this -> Gallery -> invalidFields());
						}
					}
				}
			}
			$this -> set('galleries', $this -> Gallery -> find('all', array('conditions' => array('Gallery.prod_color_code' => $prod_color_codes))));
		}
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
		//$inventory = $this -> Gallery -> Inventory -> find('first', array('conditions' => array('Inventory.gallery' => $gallery['Gallery']['prod_color_code'])));
		//$inventory['Inventory']['name_for_gallery'] = $inventory['Inventory']['product'] . " - " . $inventory['Inventory']['color'] . " - " . $inventory['Inventory']['size'];
		//$this -> set('inventory', $inventory);
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
		/**
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
		 */
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($prod_color_code = null, $product_id = null) {
		$gallery = $this -> Gallery -> findByProdColorCode($prod_color_code);
		if (!$gallery) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Gallery -> save($this -> request -> data)) {
				$image = $this -> Gallery -> Image -> findByPath($this -> request -> data['Gallery']['image']);
				if(!$image) {
					$image = array(
						'Image' => array(
							'gallery_id' => $this -> Gallery -> id,
							'path' => $this -> request -> data['Gallery']['image']
						)
					);
					$this -> Gallery -> Image -> create();
					$this -> Gallery -> Image -> save($image);
				}
				$this -> Session -> setFlash(__('Se guardó la galería', 'crud/success'));
				$this -> redirect(array('action' => 'closeWindow'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la galería. Recuerde agregar una imagen e intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $gallery;
		}
		$this -> set('product_id', $product_id);
	}
	
	public function admin_closeWindow() {}

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
		
		echo true;
		exit(0);

	}

}
