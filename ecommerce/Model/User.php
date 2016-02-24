<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Role $Role
 * @property Plan $Plan
 * @property Country $Country
 * @property State $State
 * @property Property $Property
 * @property PropertyReview $PropertyReview
 */
class User extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
 var $actsAs = array(        
        'Multivalidatable'
  );
	
	var $validationSets = array( 
		'Admin'=>array(
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please select Role'
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter Username'
				
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please Enter Email'
			),
			'rule1' => array(
                'rule' => array(
                        '_checkemail',
                        'email'
                    ) ,
				'message' => 'Email address is already in use.',
            )
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter Password',
			),
		),
		'company' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter Company',
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter Address',
			),
		),
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please Select Country',
			),
		),
		'state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please Select state',
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please Enter City',
			),
		),
		'zip' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please Enter zip',
			),
		),
		'status' => array(
			'boolean' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	),
		'changepassword'=>array(
		'old_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter your Old password',
				
			),
			
		),
		'old_password' =>array('rule' => '_checkOldPassword', 'message' => 'Sorry! Incorrect Old password, please try again.'),
		'passwd' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter your desired password',
				
			),
		),
		'confirm_password' => array(
                'rule3' => array(
                    'rule' => array(
                        '_checkPassword',
                        'passwd',
                        'confirm_password'
                    ) ,
                    'message' =>'Confirm password field must match, please try again',
                ) ,
             )
		),
		'invitefriend'=>array(
		'from_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter Your From Name',
				
			),
		),
		'from_email' => array(
			
				'email' => array(
				    'rule' => 'email',
				    'message' => 'Please Enter valid email address.',
				),
			
		),
		'message' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Enter Your Message',
				
			),
		)
		
		),
		'invitestep2'=>array(
			'first_name' => array(
				'notempty' => array(
				'rule' => array('notempty'),
				'message'=>'First Name required.'
				),
			),
			'last_name' => array(
				'notempty' => array(
				'rule' => array('notempty'),
				'message'=>'Last Name required.'
				),
			),
			'creditcard' => array(
				'notempty' => array(
				'rule' => array('notempty'),
				'message'=>'Credit Card required.'
				),
			),
			'cardnumber' => array(
				'notempty' => array(
				'rule' => array('notempty'),
				'message'=>'Card Number required.'
				),
			),
			'expiry_month' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Expiry Month required.'
				),
			),
			'expiry_year' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Expiry year required.'
				),
			),
			'ccv' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'CCV Number required.'
				),
			),
			'country_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Country required.'
				),
			),
			'state_id' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'State required.'
				),
			),
			'city' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'City required.'
				),
			),
			'address' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Address required.'
				),
			),
			'zip' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Zip code required.'
				),
			)
		),
		'compose'=>array(
			'email' => array(
				'email' => array(
				    'rule' => 'email',
				    'message' => 'Please Enter valid email address.',
				),
					'rule1' => array(
				    'rule' => array(
						'is_mail_exist',
						'email'
					  ) ,
					'message' => 'Sorry! this email addess does not match in our database. Please try another.',
				),
			),
			'title' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message'=>'Enter Subject'
				)
			),
			'message' => array(
				'notempty' => array(
					'rule' => array('notempty'),
					'message' => 'Enter Your Message',
					
				)
			)
		),
		'launch'=>array(
			'email' => array(
				'email' => array(
				    'rule' => 'email',
				    'message' => 'Enter valid email.',
				),
			),
			
		),
		
	);
	 
	/*public $validate = array(
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'company' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'website' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'country_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'zip' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mobile' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);*/

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
		'Country' => array(
			'className' => 'Country',
			'foreignKey' => 'country_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'State' => array(
			'className' => 'State',
			'foreignKey' => 'state_id',
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
	public $hasMany = array();
	
	function _checkemail($field1 = array() , $field2 = null) 
    {
	 
	   if(isset($this->data[$this->name]['id']) && $this->data[$this->name]['id']!='') {
	      $conditions['User.id <>'] = $this->data[$this->name]['id'];
	   }
	   $conditions['User.email'] =  $this->data[$this->name][$field2];
	
	   $user = $this->find('count', array(
            'conditions' => $conditions ,
            'recursive' => -1
        ));
		
       if($user>0)
	    return false;
	
	    return true;
	}
	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}

}
