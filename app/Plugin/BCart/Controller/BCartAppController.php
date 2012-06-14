<?php

class BCartAppController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		//$this -> beforeFilterCookieConfig();
	}
	
	private function beforeFilterCookieConfig() {
		if(isset($this -> Cookie -> name) && !empty($this -> Cookie -> name)) {
			$this -> Cookie -> name = 'BCart';
		}
		if(isset($this -> Cookie -> time) && !empty($this -> Cookie -> time)) {
			$this -> Cookie -> time = 3600;  // 3600 = '1 hour'
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
			$this -> Cookie -> key = 'qSI2Web64qs*&BlsXOoomw!';
		}
		if(isset($this -> Cookie -> httpOnly) && !empty($this -> Cookie -> httpOnly)) {
			$this -> Cookie -> httpOnly = true;
		}
	}
	
}

