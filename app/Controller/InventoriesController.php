<?php
App::uses('AppController', 'Controller');
/**
 * Inventories Controller
 *
 * @property Inventory $Inventory
 */
class InventoriesController extends AppController {

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Inventory -> recursive = 0;
		$this -> set('inventories', $this -> paginate());
	}

	/**
	 * addInventory method
	 *
	 * @return void
	 */
	public function addInventory($product_id = null, $product_size_id = null) {
		if($product_id && $product_size_id) {
			$inventory = array(
				'Inventory' => array(
					'product_id' => $product_id,
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
