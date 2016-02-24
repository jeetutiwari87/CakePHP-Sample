<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController {
 public $name = 'Pages';
 
var $components = array('Email',"Default");
	   
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($alias = null) {
				
		$page_data=$this->Page->find("first",array("conditions"=>array("Page.alias"=>$alias)));
		$this->set('title_for_layout',$page_data['Page']['page_title']);
        $this->set('description_for_layout',$page_data['Page']['meta_description']);
        $this->set('keywords_for_layout',$page_data['Page']['meta_keywords']);
		$this->Page->id = $page_data['Page']['id'];
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$pages=$this->Page->find("all",array("conditions"=>array("Page.status"=>'1',"Page.alias <>"=>$alias)));
		$this->set('page', $page_data);
		$this->set('content_pages', $pages);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		}
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('parentPages'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Page->read(null, $id);
		}
		$parentPages = $this->Page->ParentPage->find('list');
		$this->set(compact('parentPages'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Page->delete()) {
			$this->Session->setFlash(__('Page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
		$active_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"1")));
		$inactive_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"0")));
		$total_pages=$this->Page->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
		
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		$this->set('page', $this->Page->read(null, $id));
		$active_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"1")));
		$inactive_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"0")));
		$total_pages=$this->Page->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Page->create();
			$this->request->data['Page']['alias']=$this->Default->Cleanstring($this->request->data['Page']['name']);
			if ($this->Page->save($this->request->data)) {
			
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		}
		$parents = $this->Page->ParentPage->find('list');
		
		$this->set(compact('parents'));
		$active_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"1")));
		$inactive_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"0")));
		$total_pages=$this->Page->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		//$this->request->data['Page']['alias']=$this->Default->Cleanstring($this->request->data['Page']['name']);
		
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Page->read(null, $id);
		}
		$parents = $this->Page->ParentPage->find('list');
		$this->set(compact('parents'));
		$active_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"1")));
		$inactive_pages=$this->Page->find('count',array("conditions"=>array("Page.status"=>"0")));
		$total_pages=$this->Page->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Page->id = $id;
		if (!$this->Page->exists()) {
			throw new NotFoundException(__('Invalid page'));
		}
		if ($this->Page->delete()) {
			$this->Session->setFlash(__('Page deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Page was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	public function contact(){
	    $this->set('title_for_layout', __('Contact Us', true));
		if ($this->request->is('post')) {
				$this->set('message',$this->request->data);
					
				$this->Email->from = $this->request->data['Contact']['email'];
				$this->Email->to = Configure::read('Site.admin_email');
				$this->Email->subject = __('iphoneparts.com Contact Us Mail');
			   	$this->Email->template = 'contact';
								
				if ($this->Email->send()) {
					$this->Session->setFlash(__('Contact Us mail send successfully'), 'default', array('class' => 'success'));
					$this->redirect(array('controller'=>"products",'action' => 'home'));
				} else {
					$this->Session->setFlash(__('An error occurred. Please try again.'), 'default', array('class' => 'error'));
				}
			
			
		}
		$page_data=$this->Page->find("first",array("conditions"=>array("Page.status"=>'1',"Page.alias"=>'contact-us')));
		$this->set(compact('page_data'));
	}
}
