<?php
App::uses('AppModel', 'Model');
/**
 * SitePermission Model
 *
 * @property Role $Role
 * @property Package $Package
 * @property Manager $Manager
 */
class SitePermission extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'role_id' => array(
			'numeric' => array(
				'rule' => array('notempty'),
				'message' => 'Please Select Role',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'manager_id' => array(
			'numeric' => array(
				'rule' => array('notempty'),
				'message' => 'Please Select manager',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Manager' => array(
			'className' => 'Manager',
			'foreignKey' => 'manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function CheckPermission($role_id,$manager,$permission){
	  //if($role_id==1) return true;
	  // if($role_id==5) return true;
	  
	  $conditions=array();
	  $conditions['SitePermission.role_id']=$role_id;
	  $conditions['Manager.name']=$manager;
	  $conditions['SitePermission.'.$permission]=1;
	 
	  $permission_count=$this->find("count",array("conditions"=>$conditions));
	 
	  if($permission_count>0) return true;
	  else return false;
	}
}
