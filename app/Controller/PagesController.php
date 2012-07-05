<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('display', 'home', 'construccion', 'view', 'contacto','carrito','tablaCarrito','registro','resumenCarrito','favoritos','tablaFavoritos','resumenFavoritos');
	}

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'Pages';

	/**
	 * Default helper
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Session');

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	//public $uses = array();

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this -> redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this -> set(compact('page', 'subpage', 'title_for_layout'));
		$this -> render(implode('/', $path));

	}
	
	public function resumenCarrito(){
		$this -> layout="ajax";
	}
	public function resumenFavoritos(){
		$this -> layout="ajax";
		
	}
	public function registro() {
		/*$this -> redirect(
			array(
				'plugin' => 'user_control',
				'controller' => 'users',
				'action' => 'register'
			)
		);*/
		$this -> redirect('/registro');
	}
	
	public function carrito(){
	
	}
	public function favoritos(){
	
	}
	public function tablaFavoritos(){

		$this -> layout="ajax";
	}
	
	public function tablaCarrito(){
		$this -> layout="ajax";
	}
	
	public function view($id = null) {
		$this -> layout = "pages";
		$this -> Page -> id = $id;
		if (!$this -> Page -> exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
	}

	public function admin_beforePrev() {
		$this -> Session -> write('left_content', $_POST['left_content']);
		$this -> Session -> write('content', $_POST['content']);
		echo true;
		exit(0);
	}

	public function admin_preview() {
		$this -> layout = "pages";
		$page = array('Page' => array('left_content' => $this -> Session -> read('left_content'), 'content' => $this -> Session -> read('content')));
		$this -> set(compact('page'));
	}

	public function home() {

	}

	public function contacto() {
		$this -> layout = 'pages';
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			$email_address = Configure::read('email');
			$email_password = Configure::read('email_password');
			$site_name = Configure::read('site_name');
			$gmail = array('host' => 'ssl://smtp.gmail.com', 'port' => 465, 'username' => $email_address, 'password' => $email_password, 'transport' => 'Smtp');
			App::uses('CakeEmail', 'Network/Email');
			$email = new CakeEmail($gmail);
			$email -> from(array($email_address => $site_name));
			$email -> to($email_address);
			$email -> subject('Contacto :: ' . $site_name . ' :: ' . $this -> request -> data['Page']['nombre_contacto']);
			$email -> send('' . '
				' . 'Nombre: ' . $this -> request -> data['Page']['nombre_contacto'] . '
				' . 'Correo: ' . $this -> request -> data['Page']['email'] . '
				' . 'Comentario:
				' . $this -> request -> data['Page']['comentario']);
			$this -> Session -> setFlash('Se ha enviado la información. Gracias por contactarnos.', 'crud/success');
			$this -> redirect($this -> referer());
		}
	}

	public function construccion() {
		$this -> layout = 'ajax';
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Page -> recursive = 0;
		$this -> set('pages', $this -> paginate());
	}

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Page -> id = $id;
		if (!$this -> Page -> exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this -> set('page', $this -> Page -> read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> Page -> create();
			if ($this -> Page -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The page has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Page -> id = $id;
		if (!$this -> Page -> exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Page -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The page has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The page could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> Page -> read(null, $id);
		}
	}

	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Page -> id = $id;
		if (!$this -> Page -> exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this -> Page -> delete()) {
			$this -> Session -> setFlash(__('Page deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Page was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}

}
