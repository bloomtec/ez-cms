<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 */
class InventoriesController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getInventoryData', 'getQuantity');
	}
	
	/**
	* Funcion que devuelve la cantidad de un inventario
	*/
	public function getQuantity($product_id=null,$color_id=null,$product_size_id=null){
		$this ->Inventory-> recursive = -1;
		return $this ->Inventory-> find ('first',array(
			'conditions'=>array(
				'product_id'=>$product_id,
				'color_id'=>$color_id,
				'product_size_id'=>$product_size_id
			),
			'fields'=>array(
				'id',
				'quantity'
			)
		));
	}
	
	/**
	 * Función ajax para dar datos al front
	 */
	public function getInventoryData($product_id = null, $color_id = null) {
		$this -> autoRender = false;
		Configure::write('debug', 0);
		
		if($product_id && $color_id) {
			// Información inventario
			$inventories = $this -> Inventory -> find(
				'all',
				array(
					'conditions' => array(
						'Inventory.product_id' => $product_id,
						'Inventory.color_id' => $color_id,
						'Inventory.quantity >' => 0
					)
				)
			);
			// Información tallas
			$product_sizes = array();
			foreach($inventories as $key => $inventory) {
				//$product_sizes[$inventory['Inventory']['product_size_id']]['id'] = $inventory['Inventory']['product_size_id'];
				$product_sizes[$inventory['Inventory']['product_size_id']]['size'] = $inventory['Inventory']['size'];
				$product_sizes[$inventory['Inventory']['product_size_id']]['quantity'] = $inventory['Inventory']['quantity'];
			}
			// Información galería
			$this -> loadModel('Gallery');
			$tmp_gallery = $this -> Gallery -> findByProdColorCode("$product_id$color_id");
			$gallery = $tmp_gallery['Gallery'];
			$gallery['Image'] = $tmp_gallery['Image'];
			$return_data = array(
				'ProductSize' => $product_sizes,
				'Gallery' => $gallery
			);
			echo json_encode($return_data);
		} else {
			echo json_encode(array());
		}
		
		exit(0);
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}
	
	public function hasInventory($product_id = null) {
		$this -> loadModel('ProductSize');
		$sizes = $this -> ProductSize -> find('list');
		$this -> loadModel('Color');
		$colors = $this -> Color -> find('list');
		
		// Tratar de armar ó enviar la información de la matriz de una sola vez para que no haya retardo
		$size_ids_color_ids = array();
		foreach($sizes as $size_id => $size_name) {
			foreach($colors as $color_id => $color_name) {
				$inventory = $this -> Inventory -> find('first', array(
					'conditions' => array(
						'Inventory.product_id' => $product_id,
						'Inventory.color_id' => $color_id,
						'Inventory.product_size_id' => $size_id
					),
					'recursive' => -1
				));
				if($inventory) {
					$size_ids_color_ids[$size_id][$color_id] = true;
				} else {
					$size_ids_color_ids[$size_id][$color_id] = false;
				}
			}
		}
		return $size_ids_color_ids;
	}
	
	/*public function hasInventory($product_id = null, $color_id = null, $product_size_id = null) {
		if($product_id && $color_id && $product_size_id) {
			$inventory = $this -> Inventory -> find('first', array(
				'conditions' => array(
					'Inventory.product_id' => $product_id,
					'Inventory.color_id' => $color_id,
					'Inventory.product_size_id' => $product_size_id
				)
			));
			if($inventory) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}*/

	/**
	 * addInventory method
	 *
	 * @return void
	 */
	public function addInventory($product_id = null, $color_id = null, $product_size_id = null) {
		if($product_id && $color_id && $product_size_id) {
			$inventory = array(
				'Inventory' => array(
					'product_id' => $product_id,
					'color_id' => $color_id,
					'product_size_id' => $product_size_id,
					'quantity' => 0
				)
			);
			$this -> Inventory -> create();
			return $this -> Inventory -> save($inventory);
		} else {
			return false;
		}
	}
	
	/**
	 * modifyInventory
	 * 
	 * @return void
	 */
	public function modifyInventory($inventory_id = null, $action = null, $amount_to_modify = null) {
		if($inventory_id && $action && $amount_to_modify) {
			$inventory = $this -> Inventory -> read(null, $inventory_id);
			if($inventory) {
				$quantity = $inventory['Inventory']['quantity'];
				if($action == 'add') {
					$quantity += $amount_to_modify;
				} elseif($action == 'substract') {
					if($amount_to_modify > $quantity) {
						return false;
					} else {
						$quantity -= $amount_to_modify;
					}
				} else {
					return false;
				}
				$inventory['Inventory']['quantity'] = $quantity;
				if($this -> Inventory -> save($inventory)) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
