<?php
App::uses('AppModel', 'Model');
/**
 * Setting Model
 *
 * @property User $User
 */
class Setting extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
  var $belongsTo = array(
        'SettingCategory' => array(
            'className' => 'SettingCategory',
            'foreignKey' => 'setting_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
	
	function getKeyValuePairs() 
    {
        $settings = $this->find('all');
		
        $names = Set::extract($settings, '{n}.Setting.name');
        $values = Set::extract($settings, '{n}.Setting.value');
        $settings = array_combine($names, $values);
		
		
        return $settings;
    }
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	
}
