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
		$this -> Auth -> allow('uploadify_add', 'view', 'getNovelty', 'getTopSeller', 'search');
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
	
	private function checkIfColorExists() {
		$this -> loadModel('Color');
		if ($this -> Color -> find('count')) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Verificar productos que tengan inventario
	 * @return ID's de productos con inventario'
	 */
	private function productsWithInventory() {
		$products = $this -> Product -> Inventory -> find(
			'list',
			array(
				'fields' => array(
					'Inventory.product_id'
				),
				'conditions' => array(
					'Inventory.quantity >=' => 1
				),
				'recursive' => -1
			)
		);
		return $products;
	}

	/**
	 * getNovedad method
	 *
	 * @return Array
	 */
	public function getNovelty() {
		$product = $this -> Product -> find(
			'first',
			array(
				'conditions' => array(
					'Product.is_novelty' => true,
					'Product.id' => $this -> productsWithInventory()
				),
				'order' => 'RAND()'
			)
		);
		return $product;
	}

	/**
	 * getTopSeller method
	 *
	 * @return Array
	 */
	public function getTopSeller() {
		$product = $this -> Product -> find(
			'first',
			array(
				'conditions' => array(
					'Product.is_top_seller' => true,
					'Product.id' => $this -> productsWithInventory()
				),
				'order' => 'RAND()'
			)
		);
		return $product;
	}
	
	/**
	 * getTopSeller method
	 *
	 * @return Array
	 */
	public function getPromoted() {
		$product = $this -> Product -> find(
			'first',
			array(
				'conditions' => array(
					'Product.is_promoted' => true,
					'Product.id' => $this -> productsWithInventory()
				),
				'order' => 'RAND()'
			)
		);
		return $product;
	}
	
	public function search() {
		if($this -> request -> is('post')) {
			$products = $this -> Product -> find(
				'all',
				array(
					'conditions' => array(
						'Product.reference LIKE' => '%' . $this -> request -> data['Product']['search'] . '%',
					)
				)
			);
			
			if(
				count($products) == 1
				&& count($products[0]['Inventory'] >= 1)
			) {
				$this -> redirect(array('action' => 'view', $products[0]['Product']['id'], $products[0]['Inventory'][0]['color_id']));
			} else {
				$product_ids = array();
				foreach ($products as $key => $product) {
					$product_ids[] = $product['Product']['id'];
				}
				$this -> paginate = array('conditions' => array('Product.id' => $product_ids));
				$this -> set('products', $this -> paginate());
			}
		}
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
	public function view($id = null, $color) {
		$this -> layout="product-view";
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		$product = $this -> Product -> find('first', array(
			'conditions'=>array(
				'Product.id'=>$id
			),
			'contain'=>array(
				'Category',
				'Inventory'=>array(
					'conditions'=>array(
						'quantity >'=>0
					)
				),
				
			),
			
		));
		foreach($product['Inventory'] as $inventory){			
			if($inventory['color_id']==$color){
				$product['Product']['image']=$inventory['image'];				
				break;
			}
		}
		$this -> set('product', $product);
		
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Product -> recursive = 0;
		if($this -> request -> is('post') || $this -> request -> is('put')) {
			$conditions = array();
			if($this -> request -> data['Search']['category_id']) {
				$conditions['Product.category_id'] = $this -> request -> data['Search']['category_id'];
			}
			if(!empty($this -> request -> data['Search']['name'])) {
				$conditions['Product.name LIKE'] = '%' . trim($this -> request -> data['Search']['name']) . '%';
			}
			if(!empty($this -> request -> data['Search']['reference'])) {
				$conditions['Product.reference LIKE'] = '%' . trim($this -> request -> data['Search']['reference']) . '%';
			}
			if($this -> request -> data['Search']['is_active']) {
				$conditions['Product.is_active'] = $this -> request -> data['Search']['is_active'];
			}
			if($this -> request -> data['Search']['is_novelty']) {
				$conditions['Product.is_novelty'] = $this -> request -> data['Search']['is_novelty'];
			}
			if($this -> request -> data['Search']['is_top_seller']) {
				$conditions['Product.is_top_seller'] = $this -> request -> data['Search']['is_top_seller'];
			}
			if($this -> request -> data['Search']['is_promoted']) {
				$conditions['Product.is_promoted'] = $this -> request -> data['Search']['is_promoted'];
			}
			$this -> paginate = array('conditions' => $conditions);
		}
		$this -> set('products', $this -> paginate());
		$this -> set('categories', $this -> Product -> Category -> find('list'));
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
		if (!$this -> checkIfCategoryExists()) {
			$this -> Session -> setFlash('No hay categorías creadas, cree al menos una categoría.', 'crud/error');
			$this -> redirect(array('plugin' => false, 'controller' => 'categories', 'action' => 'index'));
		}
		if (!$this -> checkIfColorExists()) {
			$this -> Session -> setFlash('No hay color creado, cree al menos un color.', 'crud/error');
			$this -> redirect(array('plugin' => false, 'controller' => 'colors', 'action' => 'index'));
		}
		if (!$this -> checkIfSizeExists()) {
			$this -> Session -> setFlash('No hay tallas creadas, cree al menos una talla.', 'crud/error');
			$this -> redirect(array('plugin' => false, 'controller' => 'product_sizes', 'action' => 'index'));
		}
		if ($this -> request -> is('post')) {
			$selected_Inventory = false;
			if(isset($this -> request -> data['Matrix']) && !empty($this -> request -> data['Matrix'])) {
				foreach($this -> request -> data['Matrix'] as $size_color => $selected) {
					if($selected) $selected_Inventory = true;
				}
			}
			if($selected_Inventory) {
				$this -> Product -> create();
				if ($this -> Product -> save($this -> request -> data)) {
					$inventory_errors = false;
	
					// Crear inventarios
					foreach($this -> request -> data['Matrix'] as $size_color => $selected) {
						if($selected) {
							$sizeAndColorId = explode('-', $size_color);
							$color_id = $sizeAndColorId[1];
							$product_size_id = $sizeAndColorId[0];
							if (!$this -> requestAction('/inventories/addInventory/' . $this -> Product -> id . '/' . $color_id . '/' . $product_size_id)) {
								$inventory_errors = true;
							}
						}
					}
	
					if (!$inventory_errors) {
						$this -> Session -> setFlash(__('Se creó el producto. Por favor,  Suba la foto principal de cada color del producto.'), 'crud/success');
						$this -> redirect(array('controller' => 'galleries', 'action' => 'productGalleryWizard', $this -> Product -> id));
					} else {
						$this -> Session -> setFlash(__('Se creó el producto. Error al iniciar inventarios seleccionados'), 'crud/error');
						$this -> redirect(array('action' => 'index'));
					}
				} else {
					$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'), 'crud/error');
				}
			} else {
				$this -> Session -> setFlash('Debe inicializar al menos un inventario', 'crud/error');
				//$this -> request -> data = $this -> request -> data;
			}			
		}
		$this -> set('categories', $this -> Product -> Category -> find('list'));
		$this -> loadModel('ProductSize');
		$this -> set('sizes', $this -> ProductSize -> find('list'));
		$this -> loadModel('Color');
		$this -> set('colors', $this -> Color -> find('list'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null, $after_wizard = false) {
		$this -> Product -> id = $id;
		if (!$this -> Product -> exists()) {
			throw new NotFoundException(__('Producto no válido'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Product -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó el producto'), 'crud/success');
								
				if(!$after_wizard) {
					$errors = false;
					$inventory_added = false;
					// Crear inventarios
					foreach($this -> request -> data['Matrix'] as $size_color => $selected) {
						if($selected) {
							$sizeAndColorId = explode('-', $size_color);
							$color_id = $sizeAndColorId[1];
							$product_size_id = $sizeAndColorId[0];
							if (!$this -> requestAction('/inventories/addInventory/' . $this -> Product -> id . '/' . $color_id . '/' . $product_size_id)) {
								$inventory_errors = true;
							} else {
								$inventory_added = true;
							}
						}
					}
					
					if($errors) {
						$this -> Session -> setFlash(__('Error al tratar de crear un inventario. Se omitió el proceso de cambios en cantidades de inventarios y la asignación de imagenes de galerías para cualquier inventario extra inicializado.'), 'crud/error');
						$this -> redirect(array('action' => 'index'));
					}
				}
				
				foreach($this -> request -> data['Inventory'] as $key => $data) {
					if($data['modify']) {
						if(!$this -> requestAction('/inventories/modifyInventory/' . $data['id'] . '/' . $data['modify'] . '/' . $data['amount_to_modify'])) {
							$errors = true;
						}
					}
				}
				if(!$after_wizard) {
					if($errors) {
						$this -> Session -> setFlash(__('Errores al modificar inventario. Verifique las cantidades actuales vs el cambio para continuar.'), 'crud/error');
					}
					if($inventory_added) {
						$this -> redirect(array('controller' => 'galleries', 'action' => 'productGalleryWizard', $this -> Product -> id));
					}
				}
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Product -> read(null, $id);
		}
		$this -> set('inventories', $this -> Product -> Inventory -> find('all', array('conditions' => array('Inventory.product_id' => $id), 'recursive' => -1)));
		$this -> set('categories', $this -> Product -> Category -> find('list'));
		$this -> loadModel('ProductSize');
		$this -> set('sizes', $this -> ProductSize -> find('list'));
		$this -> loadModel('Color');
		$this -> set('colors', $this -> Color -> find('list'));		
		$size_ids_color_ids = $this -> requestAction('/inventories/hasInventory/' . $id);
		$this -> set('size_ids_color_ids', $size_ids_color_ids);
		$this -> set('after_wizard', $after_wizard);
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
		
		echo true;
		exit(0);

	}

}
