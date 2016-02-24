<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Role $Role

 * @developer jeetu tiwari
 */
class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'role_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),

        'first_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter first name.'
            ),
        ),
        'last_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter last name.'
            ),
        ),
        'username' => array(
            'notempty' => array(
                'rule' => array('notempty')
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'message' => 'Please enter valid email address.',
            ),
            'rule1' => array(
                'rule' => array(
                    '_checkemail',
                    'email'
                ),
                'message' => 'Email address is already in use.',
            ),
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter password.',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'confirm_password' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'Password and confirm password does not match.',
                'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
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
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array();

    function equaltofield($check, $otherfield) {
        $fname = '';
        foreach ($check as $key => $value) {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    function _checkemail($field1 = array(), $field2 = null) {

        if (isset($this->data['User']['id']) && ($this->data['User']['id'] != '')) {
            $conditions['User.id <>'] = $this->data[$this->name]['id'];
        }
        $conditions['User.email'] = $this->data[$this->name][$field2];
        $user = $this->find('count', array(
            'conditions' => $conditions,
            'recursive' => -1
        ));

        if ($user > 0)
            return false;

        return true;
    }

    public function beforeSave($options = array()) {
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        } else {
            unset($this->data['User']['password']);
        }
        return true;
    }

    function GetUserName($user) {
        $data = $this->find('first', array("conditions" => array("User.id" => $user)));
        $username = $data['User']['first_name'] . ' ' . $data['User']['last_name'];

        return ucfirst($username);
    }

    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    function getState($country_id) {

        $states = $this->UserAddress->State->find("list", array("conditions" => array("State.country_id" => $country_id, "State.status" => "1")));
        return $states;
    }

    function getCountryName($country_id) {

        $country = $this->UserAddress->Country->find("first", array("conditions" => array("Country.id" => $country_id)));
        return (isset($country['Country']['name']) && $country['Country']['name'] != '') ? $country['Country']['name'] : '';
    }

    function getStateName($state_id) {

        $state = $this->UserAddress->State->find("first", array("conditions" => array("State.id" => $state_id)));
        return (isset($state['State']['name']) && $state['State']['name'] != '') ? $state['State']['name'] : '';
    }

}
