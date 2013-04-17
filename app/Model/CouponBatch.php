<?php
App::uses('AppModel', 'Model');
/**
 * CouponBatch Model
 *
 * @property CouponType $CouponType
 * @property Coupon $Coupon
 */
class CouponBatch extends AppModel {
	
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';
	
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
		),
		'quantity' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Ingrese una cantidad',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Este valor debe ser un número',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'cantidadMayorAUno' => array(
				'rule' => array('cantidadMayorAUno'),
				'message' => 'El valor debe ser mayor o igual a uno',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	
	public function cantidadMayorAUno() {
		if($this -> data['CouponBatch']['quantity'] >= 1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function beforeSave($options = array()) {
		if(isset($this -> data['CouponBatch']['discount']) && !empty($this -> data['CouponBatch']['discount'])) {
			$discount = (double) $this -> data['CouponBatch']['discount'];
			$discount = (double) ($discount / 100) * -1 + 1;
			$this -> data['CouponBatch']['discount'] = $discount;
		}
		return true;
	}
	
	public function afterSave($created = null) {
		if($created) {
			$coupon = array(
				'Coupon' => array(
					'coupon_batch_id' => $this -> id,
					'code' => null,
					'is_active' => true,
					'is_used' => false
				)
			);
			for ($i=$this -> data['CouponBatch']['quantity']; $i > 0 ; $i--) {
				$coupon['Coupon']['code'] = $this -> setCouponCode();
				$this -> Coupon -> create();
				if(!$this -> Coupon -> save($coupon)) $i++;
			}
		}
	}
	
	private function setCouponCode() {
		$coupon_batch = $this -> read(null, $this -> id);
		// Código de 10 digitos
		// xy-generated, donde x = tipo cupon, y = coupon batch
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$code = $coupon_batch['CouponBatch']['coupon_type_id'] . '-';
		while(strlen($code) < 10) {
			$code .= substr($str, rand(0, 62), 1);
			$code = trim($code);
		}
		return $code;
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
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Coupon' => array(
			'className' => 'Coupon',
			'foreignKey' => 'coupon_batch_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array('Coupon.updated' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
