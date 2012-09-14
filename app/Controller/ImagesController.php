<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 */
class ImagesController extends AppController {
	
	public $components = array('Attachment');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('uploadify_add');
	}
	
	function uploadify_add() {
		
		if ($_POST['name'] && $_POST['folder'] && $_POST['gallery_id']) {

			$fileName = $_POST['name'];
			$folder = $_POST['folder'];
			$gallery_id = $_POST['gallery_id'];
			$prod_color_code = $_POST['prod_color_code'];
			$product_id = $_POST['product_id'];
			
			//time_nanosleep(0, 500000);
			
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
			
			$this -> Image -> create();
			$image = array(
				'Image' => array(
					'gallery_id' => $gallery_id,
					'path' => $fileName
				)
			);
			if($this -> Image -> save($image)) {
				echo json_encode(array(
					'success' => true,
					'image_id' => $this -> Image -> id,
					'prod_color_code' => $prod_color_code,
					'product_id' => $product_id
				));
			} else {
				echo json_encode(array('success' => false));
			}
				
		}

		exit(0);

	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this -> Image -> recursive = 0;
		$this -> set('images', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this -> Image -> id = $id;
		if (!$this -> Image -> exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this -> set('image', $this -> Image -> read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this -> request -> is('post')) {
			$this -> Image -> create();
			if ($this -> Image -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The image has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The image could not be saved. Please, try again.'));
			}
		}
		$galleries = $this -> Image -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this -> Image -> id = $id;
		if (!$this -> Image -> exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Image -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The image has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The image could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Image -> read(null, $id);
		}
		$galleries = $this -> Image -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Image -> recursive = 0;
		$this -> set('images', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Image -> id = $id;
		if (!$this -> Image -> exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		$this -> set('image', $this -> Image -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Image -> create();
			if ($this -> Image -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The image has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The image could not be saved. Please, try again.'));
			}
		}
		$galleries = $this -> Image -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Image -> id = $id;
		if (!$this -> Image -> exists()) {
			throw new NotFoundException(__('Invalid image'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Image -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The image has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The image could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Image -> read(null, $id);
		}
		$galleries = $this -> Image -> Gallery -> find('list');
		$this -> set(compact('galleries'));
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null, $prod_color_code = null, $product_id = null) {
		if($id && $prod_color_code && $product_id) {
			if (!$this -> request -> is('post')) {
				throw new MethodNotAllowedException();
			}
			$this -> Image -> id = $id;
			if (!$this -> Image -> exists()) {
				throw new NotFoundException(__('Invalid image'));
			}
			if ($this -> Image -> delete()) {
				$this -> Session -> setFlash(__('Imagen eliminada'), 'crud/success');
			} else {
				$this -> Session -> setFlash(__('No se eliminó la imagen'), 'crud/error');
			}
			$this -> redirect(array(
				'controller' => 'galleries',
				'action' => 'edit',
				$prod_color_code,
				$product_id
			));
		}
	}

}
