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
		'Security',
		'Acl',
		'AclFilter',
		'Auth',
		'Session',
		'RequestHandler',
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
		'Time'
	
	);
	
	
  public function __construct($request = null, $response = null) {
		
		Jt::applyHookProperties('Hook.controller_properties', $this);
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
        
		
		App::Import("Model","Page");
        $pageobj=new Page();
		
		App::Import("Model","Category");
        $catobj=new Category();
		
		App::Import("Model","Product");
        $prodobj=new Product();
		
		
		$sessionid = session_id();
        if($this->Session->read('sessID')=='') {
          $this->Session->write('sessID',session_id()); 
        }
		
		$this->set('UserLogin', $this->Auth->User());
		$left_category=$catobj->find("all",array("conditions"=>array("Category.status"=>"1")));
		$top_category=$catobj->find("all",array("conditions"=>array("Category.status"=>"1","Category.top"=>"1")));
		$footer_pages=$pageobj->find("all",array("conditions"=>array("Page.page_type"=>"footer")));
		
	   $sid=$this->Session->read('sessID');
	   App::Import("Model","Cart");
	   $cartobj=new Cart();
	   $cartobj->bindModel(array('belongsTo' => array('Coupon','Promo'))); 
	   $topcarts=$cartobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
	   if(count($topcarts)>0) {
		$top_cartdetails=$prodobj->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$topcarts['Cart']['id']),"recursive"=>"2")); 
	   } else {
		$top_cartdetails=array();
	   }
	   $cart_qty=0;
	   if(count($top_cartdetails)>0){
		foreach($top_cartdetails as $top_cartdetail){
		 $cart_qty+=$top_cartdetail['Cartdetail']['qty'];
		}
	   }
   
		
        /*$header_pages=$pageobj->find("all",array("conditions"=>array("Page.page_type"=>"top")));
		
		
		
		$learn_pages=$pageobj->find("all",array("conditions"=>array("Page.page_type"=>"learn")));
		
		$about_content=$pageobj->find("first",array("conditions"=>array("Page.alias"=>"about-us")));
		
		
		$this->set(compact('header_pages','footer_makes','learn_pages','about_content'));
		*/
		$this->set(compact('left_category','top_category','footer_pages','cart_qty'));
		
		$aclFilterComponent = 'AclFilter';
		
		if (empty($this->{$aclFilterComponent})) {
			throw new MissingComponentException(array('class' => $aclFilterComponent));
		}
		
		$this->{$aclFilterComponent}->auth();
		
		
		$this->RequestHandler->setContent('json', 'text/x-json');
		$this->Security->blackHoleCallback = '_securityError';
		$this->Security->requirePost('admin_delete');

		if (isset($this->request->params['admin']) && $this->request->params['admin']==1) {
			
			$this->layout = 'admin';
		}

		if ($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
		}

		if (Configure::read('Site.theme') && !isset($this->request->params['admin'])) {
			$this->theme = Configure::read('Site.theme');
		} elseif (Configure::read('Site.admin_theme') && isset($this->request->params['admin'])) {
			$this->theme = Configure::read('Site.admin_theme');
		}

		if (!isset($this->request->params['admin']) &&
			Configure::read('Site.status') == 0) {
			$this->layout = 'maintenance';
			$this->response->statusCode(503);
			$this->set('title_for_layout', __('Site down for maintenance'));
			$this->render('../Elements/blank');
		}

		if (isset($this->request->params['locale'])) {
			Configure::write('Config.language', $this->request->params['locale']);
		}
	}
 
}
