<?php
App::uses('AppModel', 'Model');
/**
 * Gallery Model
 *
 * @property Inventory $Inventory
 */
class Gallery extends AppModel {
	
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
		/**'inventory_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe seleccionar el inventario al que se relaciona la galería',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Este campo es numérico',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'La galería debe tener un nombre',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			/**
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'La galería debe tener una imagen',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			 */
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	/**
	public $belongsTo = array(
		'Inventory' => array(
			'className' => 'Inventory',
			'foreignKey' => 'inventory_id',
			//'conditions' => array('Inventory.gallery' => 'Gallery.prod_color_code'),
			'fields' => '',
			'order' => ''
		)
	);
	 */
	
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'gallery_id',
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
