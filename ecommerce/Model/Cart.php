<?php
App::uses('AppModel', 'Model');
/**
 * Cart Model
 *

 */
class Cart extends AppModel {


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		
		'Cartdetail' => array(
			'className' => 'Cartdetail',
			'foreignKey' => 'cart_id',
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
