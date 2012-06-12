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
		$this -> Auth -> allow('uploadify_add');
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
		if ($this -> request -> is('post')) {
			$this -> Product -> create();
			if ($this -> Product -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó el producto'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
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
				$this -> Session -> setFlash(__('Se guardó el producto'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar el producto. Por favor, intente de nuevo.'));
			}
		} else {
			$this -> request -> data = $this -> Product -> read(null, $id);
		}
		$categories = $this -> Product -> Category -> find('list');
		$this -> set(compact('categories'));
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
	
	function uploadify_add(){
		if($_POST["name"]&&$_POST["folder"]){
			$devolver=true;
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/360x360",$_POST["name"],360,360);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/200x200",$_POST["name"],200,200);
			$this->Attachment->resize_image("resize","img/".$_POST["folder"]."/".$_POST["name"],"img/".$_POST["folder"]."/100x100",$_POST["name"],100,100);
			if(isset($_POST["galeriaId"])){
				$imagen["Image"]["gallery_id"]=$_POST["galeriaId"];
				$imagen["Image"]["path"]=$_POST["name"];
				$this->Image->create();
				$this->Image->save($imagen);
				$devolver=$this->Image->id;
			}
			echo $devolver;
		}else{
			echo false;
		}
		Configure::write("debug",0);
		$this->autoRender=false;
		exit(0);
	}

}
