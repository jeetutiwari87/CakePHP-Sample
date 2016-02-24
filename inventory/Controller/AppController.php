<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'RequestHandler',
		'Default',
		'Email'
		);
		/**
		 * Helpers
		 *
		 * @var array
		 * @access public
		 */
		public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Text',
		'Js',
		'Time',
        'thumbnail',
		//'Layout'
		
	
	);


	public function __construct($request = null, $response = null) {


		parent::__construct($request, $response);
		
		if ($this->name == 'CakeError') {
			$this->_set(Router::getPaths());
			$this->request->params = Router::getParams();
			$this->constructClasses();
			$this->startupProcess();
		}
		
		
	}

	/**
	 * beforeFilter
	 *
	 * @return void
	 * @throws MissingComponentException
	 */
	public function beforeFilter() {
		parent::beforeFilter();
		Configure::write('Config.language', 'eng');
		 
		App::import('Model', 'Setting');
		$setting_model_obj = new Setting();
		$settings = $setting_model_obj->getKeyValuePairs();

		Configure::write($settings);

		$this->_checkAuth();
		
		

		$this->RequestHandler->setContent('json', 'text/x-json');

		
		if (isset($this->request->params['admin']) && $this->name != 'CakeError') {
			$this->layout = 'admin';
		}

		if ($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
		}


		if (!isset($this->request->params['admin']) &&
		Configure::read('site.status') == 1) {
			$this->layout = 'maintenance';
			$this->set('title_for_layout', __('Site down for maintenance'));
			$this->render('../Elements/blank');
		}

		$this->_setLanguage();
	}
	private function _setLanguage() {
        $this->loadModel('Setting');
        
        if(isset($this->params['named']['language']) && ($this->params['named']['language'] !=  $this->Session->read('Config.language'))){
            $this->Session->write('Config.language', $this->params['named']['language']);
            $this->Cookie->write('Config.language', $this->params['named']['language'], false, '20 days');
            Configure::write('Config.language', $this->params['named']['language']);
            $data = array('id' =>70, 'value' =>Configure::read("Config.language"));
            $this->Setting->save($data);
        }else if($this->Cookie->read('language') && !$this->Session->check('Config.language')){
            $this->Session->write('Config.language', $this->Cookie->read('language'));
        }

    }
	
	public function _checkAuth(){


        $exception_array = array(
           	'users/admin_login',
            'users/admin_logout',
			'users/admin_forgot'
            );


        $cur_page = $this->params['controller'] . '/' . $this->params['action'];
        $is_admin = false;
        if (isset($this->params['prefix']) and $this->params['prefix'] == 'admin') {
            $is_admin = true;
        }

        if (!in_array($cur_page, $exception_array)) {


            if (!$this->Auth->user('id')) {
                $this->Session->setFlash(__('Authorization Required'));

                if (isset($this->params['prefix']) and $this->params['prefix'] == 'admin') {
                    $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login',
                        'admin' => true
                    ));
                } else {

                   $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login',
                        'admin' => true
                    ));
                }
            }


            if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin' && (!in_array($this->Auth->user('role_id'),array("1","2","3")))) {
                $this->redirect(array(
                        'controller' => 'users',
                        'action' => 'login',
                        'admin' => true
                    ));
            }
        } else {
            $this->Auth->allow();
            if ($this->params['action'] == 'admin_login' && $this->Auth->user('id')) {
                $this->redirect(array(
                    'controller' => 'users',
                    'action' => 'dashboard',
                    'admin' => true
                ));
            }
        }

        $this->set('UsersDetails', $this->Auth->user());
    }
}