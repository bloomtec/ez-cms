<?php
App::uses('AppModel', 'Model');
/**
 * Inventory Model
 *
 * @property Product $Product
 * @property ProductSize $ProductSize
 */
class Inventory extends AppModel {
	
	/**
	 * Virtual Fields
	 * 
	 * @var array
	 */
	public $virtualFields = array(
		'color' => 'SELECT `colors`.`name` FROM `colors` WHERE `colors`.`id` = Inventory.color_id',
		'size' => 'SELECT `product_sizes`.`name` FROM `product_sizes` WHERE `product_sizes`.`id` = Inventory.product_size_id',
		'product' => 'SELECT `products`.`name` FROM `products` WHERE `products`.`id` = Inventory.product_id',
	);
	
	public $displayField = 'color';
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'product_size_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Product.name ASC'
		),
		'ProductSize' => array(
			'className' => 'ProductSize',
			'foreignKey' => 'product_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'ProductSize.name ASC'
		),
		'Color' => array(
			'className' => 'Color',
			'foreignKey' => 'color_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Color.name ASC'
		)
	);
	
	/**
	 * hasOne associations
	 *
	 * @var array
	 */
	public $hasOne = array(
		'Gallery' => array(
			'className' => 'Gallery',
			'foreignKey' => 'inventory_id',
			'dependent' => true,
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
	
}
