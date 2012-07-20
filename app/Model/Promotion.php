<?php
App::uses('AppModel', 'Model');
/**
 * Promotion Model
 *
 * @property CouponType $CouponType
 * @property Coupon $Coupon
 */
class Promotion extends AppModel {
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'coupon_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Seleccione el tipo de cupon',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ingrese un nombre',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	public function beforeSave() {
		$tmp_data = $this -> data;
		if(isset($this -> data['Promotion']['id'])) {
			$this -> id = $this -> data['Promotion']['id'];
			$promotion = $this -> read(null, $this -> id);
			// Desactivar el cupon relacionado antes de hacer cambios
			$this -> Coupon -> id = $promotion['Promotion']['coupon_id'];
			$this -> Coupon -> saveField('is_active', 0);
			$this -> data = $tmp_data;
			return true;
		} else {
			return false;
		}
	}
	
	public function afterSave($created = null) {
		if($created) {
			
		} else {
			$coupon_id = null;
			if(isset($this -> data['Promotion']['coupon_type_id']) && isset($this -> data['Promotion']['name']) && isset($this -> data['Promotion']['discount'])) {
				$coupon_type_id = $this -> data['Promotion']['coupon_type_id'];
				$name = $this -> data['Promotion']['name'];
				$quantity = 1;
				$discount = $this -> data['Promotion']['discount'];
				$coupon_id = $this -> requestAction('/admin/coupon_batches/add/' . $coupon_type_id . '/' . $name . '/' . $quantity . '/' . $discount);
			}
			if($coupon_id) {
				// Asignar el ID del cupon a la hora de ingresar una nueva promo
				$this -> saveField('coupon_id', $coupon_id);
			}
			// Verificar el estado de la promoción y asignar el mismo estado al cupon
			$promotion = null;
			if(isset($this -> data['Promotion']['id'])) {
				$promotion = $this -> read(null, $this -> data['Promotion']['id']);
			} else {
				$promotion = $this -> read(null, $this -> id);
			}
			if($promotion) {
				$this -> Coupon -> id = $promotion['Promotion']['coupon_id'];
				if($promotion['Promotion']['is_active']) {
					$this -> Coupon -> saveField('is_active', 1);
				} else {
					$this -> Coupon -> saveField('is_active', 0);
				}
			}
		}
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'CouponType' => array(
			'className' => 'CouponType',
			'foreignKey' => 'coupon_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Coupon' => array(
			'className' => 'Coupon',
			'foreignKey' => 'coupon_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
