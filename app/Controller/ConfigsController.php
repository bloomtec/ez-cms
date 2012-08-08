<?php
App::uses('AppController', 'Controller');
/**
 * Configs Controller
 *
 * @property Config $Config
 */
class ConfigsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getShipmentCost');
	}
	
	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit() {
		$id = 1;
		$this -> Config -> id = $id;
		if (!$this -> Config -> exists()) {
			throw new NotFoundException(__('Invalid config'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> Config -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se guardó la configuración'), 'crud/success');
				//$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo guardar la configuración. Por favor, intente de nuevo.'), 'crud/error');
			}
		} else {
			$this -> request -> data = $this -> Config -> read(null, $id);
		}
	}
	
	public function getShipmentCost() {
		$this -> autoRender = false;
		$config = $this -> Config -> find('first', array('fields' => array('shipment_cost')));
		return $config['Config']['shipment_cost'];
	}

}
