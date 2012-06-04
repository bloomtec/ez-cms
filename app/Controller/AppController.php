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
		'Session',
		'Cookie'
	);
	
	public function beforeFilter() {
		$this -> beforeFilterAuthConfig();
		$this -> beforeFilterCookieConfig();
		if (isset($this -> params["prefix"]) && $this -> params["prefix"] == "admin") {
				$this -> layout="Ez.default";
		}
	}
	
	private function beforeFilterAuthConfig() {
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
		$this -> Auth -> loginRedirect = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'profile');
		$this -> Auth -> logoutRedirect = array('plugin' => 'user_control', 'controller' => 'users', 'action' => 'login');
	}
	
	private function beforeFilterCookieConfig() {
		if(isset($this -> Cookie -> name) && !empty($this -> Cookie -> name)) {
			$this -> Cookie -> name = 'PriceShoes';
		}
		if(isset($this -> Cookie -> time) && !empty($this -> Cookie -> time)) {
			$this -> Cookie -> time = 1800;  // 3600 = '1 hour'
		}
		if(isset($this -> Cookie -> path) && !empty($this -> Cookie -> path)) {
			$this -> Cookie -> path = '/';
		}
		if(isset($this -> Cookie -> domain) && !empty($this -> Cookie -> domain)) {
			$this -> Cookie -> domain = 'priceshoes.com.co';
		}
		if(isset($this -> Cookie -> secure) && !empty($this -> Cookie -> secure)) {
			$this -> Cookie -> secure = true;  // i.e. only sent if using secure HTTPS
		}
		if(isset($this -> Cookie -> key) && !empty($this -> Cookie -> key)) {
			$this -> Cookie -> key = 'qSI2Web32qs*&BlsXOoomw!';
		}
		if(isset($this -> Cookie -> httpOnly) && !empty($this -> Cookie -> httpOnly)) {
			$this -> Cookie -> httpOnly = true;
		}
	}
	
}
