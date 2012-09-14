<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Inventory $Inventory
 * @property Category $Category
 */
class Product extends AppModel {	

	//public $actsAs = array('Containable','Ez.Auditable');
	public $actsAs = array('Containable');
	
	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';
	
	/**
	 * Virtual fields
	 * 
	 * @var array
	 */
	public $virtualFields = array();
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe seleccionar una categoría',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Este valor es numérico',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar un precio',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tax_base' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar una base de I.V.A.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tax_value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar el valor de I.V.A.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reference' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar una referencia',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Ya existe la referencia ingresada',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_promoted' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_novelty' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_top_seller' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function beforeSave() {
		if(isset($this -> data['Product']['tax_base']) && !empty($this -> data['Product']['tax_base'])) {
			// Ajustes de la base del IVA
			$tax_base = $this -> data['Product']['tax_base'];
			$tax_base = ($tax_base / 100) + 1;
			$this -> data['Product']['tax_base'] = $tax_base;
		}
		if(isset($this -> data['Product']['price']) && !empty($this -> data['Product']['price'])) {
			// Ajusted del valor del IVA
			$tax_value = $this -> data['Product']['price'];
			$tax_value = $tax_value * ($tax_base - 1);
			$this -> data['Product']['tax_value'] = $tax_value;
		}
		return true;
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/**
	 * hasOne associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => array('Inventory.quantity >' => 0),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CartItem' => array(
			'className' => 'BCart.CartItem',
			'foreignKey' => 'product_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
