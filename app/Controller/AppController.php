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

	public $components = array(
		'Auth',
		'Acl',
		'Session'
	);
	
	public function beforeFilter() {
		$this -> Auth -> authorize = array(
			'Actions' => array(
				'actionPath' => 'controllers'
			)
		);
		$this -> Auth -> loginAction = array(
			'controller' => 'users',
			'action' => 'login',
			'plugin' => 'user_control',
			'admin' => false
		);
		$this -> Auth -> authError = __('No tiene permiso para ver esta sección', true);
		$this -> Auth -> loginRedirect = array('controller' => 'pages', 'action' => 'display', 'home', 'plugin' => null);
		$this -> Auth -> logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this -> Auth -> allow('verifyUserAccess');
	}
	
	/**
	 * Vericar el acceso de un usuario a una función mediante ACL
	 */
	public function verifyUserAccess() {
		// Armar la ruta
		$ruta = '';
		for ($i = 0; $i < count($this -> params['ruta']); $i++) {
			$ruta .= $this -> params['ruta'][$i];
			if ($i != count($this -> params['ruta']) - 1) {
				$ruta .= '/';
			}
		}
		return $this -> Acl -> check($this -> Auth -> user('username'), $ruta);
	}
	
}
