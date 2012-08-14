<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class CategoriesController extends AppController {
	
	public $components = array('Attachment');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('view', 'get','index', 'uploadify_add');
	}
	
	public function index(){
		$categories = $this -> Category -> find('all',array('conditions'=>array('is_promoted'=>true)));
		$this -> set (compact('categories'));
	}
	
	public function get() {
		$this -> Category -> recursive = -1;
		return $this -> Category -> find('all');
	}

	/**
	 * view method
	 *
	 * @return void
	 */
	public function view($id = null) {
		$this -> Category -> id = $id;
		if (!$this -> Category -> exists()) {
			throw new NotFoundException(__('Categoría no válida'));
		}
		
		$products = $this -> Category -> Product -> find(
			'list',
			array(
				'fields' => array('id','id'),
				'conditions' => array(
					'Product.category_id' => $id
				)
			)
		);
		
		$this -> loadModel('Inventory');
		$this -> Inventory -> recursive=-1;
		
		$orders = array(
			1 => array('Product.id' => 'ASC'),
			2 => array('Product.id' => 'DESC'),
			3 => array('Product.ref' => 'ASC'),
			4 => array('Product.ref' => 'DESC'),
			5 => array('Product.price' => 'ASC'),
			6 => array('Product.price' => 'DESC'),
		);
		
		$order = array();
		if(
			$this -> Session -> read('Categories.order')
		) {
			$order = $this -> Session -> read('Categories.order');
		} else {
			$cases = array(1 => 1, 2 => 2, 3 => 3);
			do {
				$index = rand(1, 3);
				if(isset($cases[$index])) {
					switch($index) {
						case 1:
							$option = rand(1, 2);
							$order[key($orders[$option])] = $orders[$option][key($orders[$option])];			
							break;
						case 2:
							$option = rand(3, 4);
							$order[key($orders[$option])] = $orders[$option][key($orders[$option])];
							break;
						case 3:
							$option = rand(5, 6);
							$order[key($orders[$option])] = $orders[$option][key($orders[$option])];
							break;
					}
					unset($cases[$index]);
				}
			} while(!empty($cases));
			if(!$this -> Session -> write('Categories.order', $order)) { debug('no se pudo guardar en la sesión'); }
		}
		
		$this -> paginate = array(
			'limit' => 9,
			'contain' => array('Product'),
			'group' => 'Inventory.gallery',
			'order' => $order
		);
		
		$inventories = $this -> paginate(
			'Inventory',
			array(
				'product_id' => $products,
				'quantity >' => 0
			)
		);
		
		$this -> Category -> recursive = -1;
		$category = $this -> Category -> read(null, $id);
		
		$this -> set(compact('category','inventories'));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Category -> recursive = 0;
		$this -> set('categories', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Category -> id = $id;
		if (!$this -> Category -> exists()) {
			throw new NotFoundException(__('Categoría no válida'));
		}
		$this -> set('category', $this -> Category -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Category -> create();
			if ($this -> Category -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la categoría'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la categoría. Por favor, intente de nuevo.'), 'crud/error');
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
		$this -> Category -> id = $id;
		if (!$this -> Category -> exists()) {
			throw new NotFoundException(__('Categoría no válida'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Category -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la categoría'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la categoría. Por favor, intente de nuevo.'), 'crud/error');
			}
		} else {
			$this -> request -> data = $this -> Category -> read(null, $id);
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
		$this -> Category -> id = $id;
		if (!$this -> Category -> exists()) {
			throw new NotFoundException(__('Categoría no válida'));
		}
		if ($this -> Category -> delete()) {
			$this -> Session -> setFlash(__('Se elminó la categoría'),'crud/success');
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la categoría'),'crud/error');
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
