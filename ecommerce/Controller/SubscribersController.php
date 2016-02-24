<?php
App::uses('AppController', 'Controller');
/**
 * Subscribers Controller
 *
 * @property Subscriber $Subscriber
 */
class SubscribersController extends AppController {

 var $uses=array("Subscriber","Notification");

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		$this->set('subscriber', $this->Subscriber->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subscriber->create();
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('controller'=>'cars','action' => 'home'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'),'default',array("class"=>"error"));
				$this->redirect(array('controller'=>'cars','action' => 'home'));
			}
		}
	}
	
	public function notify(){
	 $this->autoRender=false;
	 if ($this->request->is('post')) {
			$this->Notification->create();
			
			
			$this->request->data['Notification']=$this->request->data['Subscriber'];
			unset($this->request->data['Subscriber']);
			
			
			if ($this->Notification->save($this->request->data)) {
				$this->Session->setFlash(__('The Notification details has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('controller'=>'cars','action' => 'home'));
			} else {
				$this->Session->setFlash(__('The notification could not be saved. Please, try again.'),'default',array("class"=>"error"));
				$this->redirect(array('controller'=>'cars','action' => 'home'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Subscriber->read(null, $id);
		}
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
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->Subscriber->delete()) {
			$this->Session->setFlash(__('Subscriber deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Subscriber was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Subscriber->recursive = 0;
		$this->set('subscribers', $this->paginate());
		$total_pages=$this->Subscriber->find('count');
		$this->set(compact('total_pages'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		$this->set('subscriber', $this->Subscriber->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Subscriber->create();
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Subscriber->save($this->request->data)) {
				$this->Session->setFlash(__('The subscriber has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subscriber could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Subscriber->read(null, $id);
		}
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
		$this->Subscriber->id = $id;
		if (!$this->Subscriber->exists()) {
			throw new NotFoundException(__('Invalid subscriber'));
		}
		if ($this->Subscriber->delete()) {
			$this->Session->setFlash(__('Subscriber deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Subscriber was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
