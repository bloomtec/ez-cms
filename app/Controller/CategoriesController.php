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
	 * admin_index method
	 *
	 * @return void
	 */
	public function view($id=null) {
		$this -> Category -> id = $id;
		if (!$this -> Category -> exists()) {
			throw new NotFoundException(__('Categoría no válida'));
		}
		$this -> paginate=array('limit'=>6);
		$products = $this -> Category -> Product -> find('list',array('conditions'=>array('Product.category_id'=>$id)));
		//$inventories = $this -> paginate('Inventory',array('product_id'=>$products,'quantity >'=>0));
		$this -> Category -> recursive = -1;
		$category= $this -> Category -> read(null, $id);
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
				$this -> Session -> setFlash(__('Se guardó la categoría'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la categoría. Por favor, intente de nuevo.'));
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
				$this -> Session -> setFlash(__('Se guardó la categoría'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la categoría. Por favor, intente de nuevo.'));
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
			$this -> Session -> setFlash(__('Se elminó la categoría'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se eliminó la categoría'));
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
