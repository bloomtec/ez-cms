<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Product $Product
 */
class Category extends AppModel {
	
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
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe ingresar un nombre',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_promoted' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Debe ser un valor tipo boolean',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'hasPromotedImage' => array(
				'rule' => array('hasPromotedImage'),
				'message' => 'Debe asignar una imagen para el estado promocionado',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function hasPromotedImage() {
		if(($this -> data['Category']['is_promoted']) & (!isset($this -> data['Category']['promoted_image']) || empty($this -> data['Category']['promoted_image']))) {
			return false;
		} else {
			return true;
		}
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'category_id',
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
	
	public function afterSave($created) {
		if($created) {
			$category_count = $this -> find('count');
			$this -> data['Category']['order'] = $category_count;
			$this -> save($this -> data);
		}
	}
	
}
