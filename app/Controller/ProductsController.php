<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {

	public $components = array('Attachment');

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('uploadify_add', 'view', 'getNovelty', 'getTopSeller');
	}

	private function checkIfSizeExists() {
		$this -> loadModel('ProductSize');
		if ($this -> ProductSize -> find('count')) {
			return true;
		} else {
			return false;
		}
	}

	private function checkIfCategoryExists() {
		$this -> loadModel('Category');
		if ($this -> Category -> find('count')) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * getNovedad method
	 *
	 * @return Array
	 */
	public function getNovelty() {
		$this -> Product -> recursive = -1;
		$product = $this -> Product -> find('first', array('conditions' => array('is_novelty' => true,
		/*CONDICION QUE TENGA INGENTARIO*/
		), 'order' => 'RAND()'));
		return $product;
	}

	/**
	 * getTopSeller method
	 *
	 * @return Array
	 */
	public function getTopSeller() {
		$this -> Product -> recursive = -1;
		$product = $this -> Product -> find('first', array('conditions' => array('is_top_seller' => true,
		/*CONDICION QUE TENGA INGENTARIO*/
		), 'order' => 'RAND()'));
		return $product;
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		$this -> set('product', $this -> Product -> read(null, $id));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Product -> recursive = 0;
		$this -> set('products', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		$this -> set('product', $this -> Product -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if (!$this -> checkIfSizeExists()) {
			$this -> Session -> setFlash('No hay tallas creadas, cree al menos una talla.', 'crud/error');
			$this -> redirect(array('plugin' => false, 'controller' => 'product_sizes', 'action' => 'index'));
		}
		if (!$this -> checkIfCategoryExists()) {
			$this -> Session -> setFlash('No hay categorías creadas, cree al menos una categoría.', 'crud/error');
			$this -> redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index'));
		}
		if ($this -> request -> is('post')) {
			$this -> Product -> create();
			if ($this -> Product -> save($this -> request -> data)) {
				$inventory_errors = false;

				/** Crear inventarios */
				foreach ($this -> request -> data['ProductSize']['size'] as $key => $product_size_id) {
					if (!$this -> requestAction('/inventories/addInventory/' . $this -> Product -> id . '/' . $product_size_id)) {
						$inventory_errors = true;
					}
				}

				if (!$inventory_errors) {
					$this -> Session -> setFlash(__('Se guardó el producto'));
				} else {
					$this -> Session -> setFlash(__('Se guardó el producto. Error al iniciar inventarios seleccionados'));
				}
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
		$this -> loadModel('ProductSize');
		$sizes = $this -> ProductSize -> find('list');
		$this -> set(compact('sizes'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Product -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó el producto', 'crud/success'));
				$errors = false;
				/** Crear inventarios */
				foreach ($this -> request -> data['ProductSize']['size'] as $key => $product_size_id) {
					if (!$this -> requestAction('/inventories/addInventory/' . $this -> Product -> id . '/' . $product_size_id)) {
						$errors = true;
					}
				}
				if($errors) {
					$this -> Session -> setFlash(__('Error al tratar de agregar talla al inventario. Se omitió el proceso de cambios en cantidades de inventarios.', 'crud/error'));
					$this -> redirect(array('action' => 'index'));
				}
				foreach($this -> request -> data['Inventory'] as $key => $data) {
					if($data['modify']) {
						if(!$this -> requestAction('/inventories/modifyInventory/' . $data['id'] . '/' . $data['modify'] . '/' . $data['amount_to_modify'])) {
							$errors = true;
						}
					}
				}
				if($errors) {
					$this -> Session -> setFlash(__('Errores al modificar inventario. Verifique las cantidades actuales vs el cambio para continuar.', 'crud/error'));
				}
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Product -> read(null, $id);
			//debug($this -> request -> data);
			$product_sizes = array();
			foreach ($this -> request -> data['Inventory'] as $key => $inventory) {
				$product_sizes[] = $inventory['product_size_id'];
			}
			$this -> loadModel('ProductSize');
			$sizes = $this -> ProductSize -> find('list', array('conditions' => array('ProductSize.id NOT' => $product_sizes)));
			$this -> set(compact('sizes'));
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
		$this -> set('inventories', $this -> Product -> Inventory -> find('all', array('conditions' => array('Inventory.product_id' => $id))));
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
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		if ($this -> Product -> delete()) {
			$this -> Session -> setFlash(__('Se eliminó el producto'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó el producto'));
		$this -> redirect(array('action' => 'index'));
	}
	 */

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
