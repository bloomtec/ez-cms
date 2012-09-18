<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $cacheAction = true;

	public $components = array('Auth', 'Acl', 'Session', 'Cookie');

	public function beforeFilter() {
		if (isset($this -> params["prefix"]) && $this -> params["prefix"] == "admin") {
			$this -> layout = "Ez.default";
		}
		$this -> beforeFilterAuthConfig();
		$this -> beforeFilterCookieConfig();
		$this -> setIdentifier();
		// Verificación ACL
		//$this -> aclVerification();
		debug($this -> getIdentifier());
	}

	private function beforeFilterAuthConfig() {
		$this -> Auth -> authorize = array('Actions' => array('actionPath' => 'controllers'));
		$this -> Auth -> authenticate = array('Form' => array('scope' => array('is_active' => 1)));
		$this -> Auth -> authError = __('No tiene permiso para ver esta sección', true);
		if (isset($this -> params["prefix"]) && $this -> params["prefix"] == "admin") {
			$this -> Auth -> loginAction = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'login', 'admin' => true);
			$this -> Auth -> logoutRedirect = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'login', 'admin' => true);
			$this -> Auth -> loginRedirect = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'index', 'admin' => true);
		} else {
			$this -> Auth -> loginAction = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'login', 'admin' => false);
			$this -> Auth -> logoutRedirect = '/';
			$this -> Auth -> loginRedirect = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'profile', 'admin' => false);
		}
	}

	private function beforeFilterCookieConfig() {
		$this -> Cookie -> time = 3600;  // or '1 hour'
		$this -> Cookie -> key = 'qS2574qs*&sXO!adre@34SasdfeAv!@*(X$%)asGb$@11~_+!@#HKis~#^';
		$this -> Cookie -> name = 'PriceShoesData';
		$this -> Cookie -> httpOnly = true;
	}

	protected function setIdentifier() {
		if (!$this -> Cookie -> read('User.identifier')) {
			$this -> Session -> write('User.identifier', rand(100000000000, 999999999999));
			$this -> Cookie -> write('User.identifier', $this -> getIdentifier());
			$this -> loadModel('BCart.ShoppingCart');
			if($this -> ShoppingCart -> findByIdentifier($this -> getIdentifier())) {
				$this -> setIdentifier();
			}
		} else {
			$this -> Session -> write('User.identifier', $this -> Cookie -> read('User.identifier'));
		}
	}

	public function getIdentifier() {
		return $this -> Session -> read('User.identifier');
	}

	protected function cleanImages() {
		// Llamar los modelos que usan imagenes
		$this -> loadModel('Category');
		$this -> loadModel('Gallery');
		$this -> loadModel('Image');

		$fileNames = array();

		$tmpFileNames = null;

		// Obtener nombres de archivos registrados en las diferentes tablas
		$tmpFileNames = $this -> Category -> find('list', array('recursive' => -1, 'conditions' => array('Category.image NOT' => null), 'fields' => array('Category.image')));
		foreach ($tmpFileNames as $index => $tmpFileName) {
			$fileNames[] = $tmpFileName;
		}
		$tmpFileNames = $this -> Gallery -> find('list', array('recursive' => -1, 'conditions' => array('Gallery.image NOT' => null), 'fields' => array('Gallery.image')));
		foreach ($tmpFileNames as $index => $tmpFileName) {
			$fileNames[] = $tmpFileName;
		}
		$tmpFileNames = $this -> Image -> find('list', array('recursive' => -1, 'conditions' => array('Image.path NOT' => null), 'fields' => array('Image.path')));
		foreach ($tmpFileNames as $index => $tmpFileName) {
			$fileNames[] = $tmpFileName;
		}

		$directories = array(0 => IMAGES . 'uploads', 1 => IMAGES . 'uploads/50x50', 2 => IMAGES . 'uploads/100x100', 3 => IMAGES . 'uploads/150x150', 4 => IMAGES . 'uploads/215x215', 5 => IMAGES . 'uploads/360x360', 6 => IMAGES . 'uploads/750x750', );

		foreach ($directories as $index => $directory) {

			if (is_dir($directory) && $directoryHandle = opendir($directory)) {

				$directoryFiles = array();

				while (false !== ($fileEntry = readdir($directoryHandle))) {
					if ($fileEntry != 'empty' && is_file($directory . DS . $fileEntry))
						$directoryFiles[] = $fileEntry;
				}
				closedir($directoryHandle);

				foreach ($directoryFiles as $index => $directoryFile) {
					if (!in_array($directoryFile, $fileNames)) {
						unlink($directory . DS . $directoryFile);
					}
				}

			}

		}

	}

	/**
	 * Cuadrar accesos mediante ACL
	 *
	 * @return void
	 */
	protected function aclVerification() {
		if ($this -> Auth -> user()) {
			$this -> loadModel('Role');
			$roles = $this -> Role -> find('all');
			foreach ($roles as $key => $role) {
				if ($role['Role']['role'] != 'Administrador') {

					// Permitir acceso total en ciertos controladores inicialmente si no se es admin
					$this -> Acl -> allow($role['Role']['role'], $this -> name);

					// Negar acceso a los siguientes métodos administrativos
					foreach ($this -> methods as $key => $method) {
						if ((!strstr($method, 'admin_')) && (!strstr($method, 'aclVerification')) && (!strstr($method, 'verifyUserAccess')) && (!strstr($method, 'getIdentifier')) && (!strstr($method, 'cleanImages'))) {
							if (!$this -> Acl -> check($role['Role']['role'], $this -> name . '/' . $method)) {
								$this -> Acl -> deny($role['Role']['role'], $this -> name . '/' . $method);
							}
						} elseif (strstr($method, 'admin_')) {
							if ($this -> Acl -> check($role['Role']['role'], $this -> name . '/' . $method)) {
								$this -> Acl -> deny($role['Role']['role'], $this -> name . '/' . $method);
							}
						}
					}

				}
			}
		}
	}

}
