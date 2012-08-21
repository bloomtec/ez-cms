<?php
App::uses('BCartAppModel', 'BCart.Model');
/**
 * ShoppingCart Model
 *
 * @property User $User
 * @property CartItem $CartItem
 */
class ShoppingCart extends BCartAppModel {
	
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'user_id' => array(
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
		'User' => array(
			'className' => 'UserControl.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => 'username',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'CartItem' => array(
			'className' => 'BCart.CartItem',
			'foreignKey' => 'shopping_cart_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('CartItem.price' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
