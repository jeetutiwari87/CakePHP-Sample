<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {
    public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Js',
	);
    
    public function js() {
      
		$snipps = array();
		if (isset($this->params['locale'])) {
			$snipps['basePath'] = Router::url('/' . $this->params['locale'] . '/');
		} else {
			$snipps['basePath'] = Router::url('/');
		}
		
		
		
		$snipps['run_admin_ajax'] =Configure::read('site.run_admin_ajax');
		
		$snipps['params'] = array(
			'controller' => $this->params['controller'],
			'action' => $this->params['action'],
			'named' => $this->params['named']
		);

		return $this->Html->scriptBlock('var CommanPath = ' . $this->Js->object($snipps) . ';var AdminPanels = {};');
	}
	
	 
	 
     public function createseolinks($link_alias=NULL){
         if($link_alias==NULL) return ;
         return $link_alias.'.html';
     }
     public function PropertyDetailsUrl($property_alias=NULL){ 
         if($property_alias==NULL ) return ;

         return 'property/'.$property_alias.'.html';
     }
     
}
