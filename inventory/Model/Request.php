<?php
App::uses('AppModel', 'Model');
/**
 * Request Model
 *
 * @property RequestGallery $RequestGallery
 * @property RequestItem $RequestItem
* @developer jeetu tiwari
 */
class Request extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	/*public $validate = array(
		'request_for' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'event_todate' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'event_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_approvaldatetime' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_rejecteddatetime' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_collectiondatetime' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_requestedby' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'collect_remark' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'return_remark' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'verify_remark' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
   public $belongsTo = array(
       
		 'Requestedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_requestedby',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		 'Approvedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_approvedby',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		 'Rejectedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_rejectedby',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		 'Collectedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_collectedby',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		 'Returnedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_returnedby',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		 'Verifiedby' => array(
            'className' => 'User',
            'foreignKey' => 'request_verifiedby',
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
		
		'RequestItem' => array(
			'className' => 'RequestItem',
			'foreignKey' => 'request_id',
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
	
	 public $hasAndBelongsToMany = array(
        'Gallery' => array(
            'className' => 'Gallery',
            'joinTable' => 'request_galleries',
            'foreignKey' => 'request_id',
            'associationForeignKey' => 'gallery_id',
            'with' => 'RequestGallery',
            'deleteQuery' => true,
        ),
    );

}
