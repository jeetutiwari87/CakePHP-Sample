<?php
App::uses('AppController', 'Controller');
/**
 * Shippings Controller
 *
 * @property Shipping $Shipping
 */
class ShippingsController extends AppController {
public $components = array(
			'Default'		
		   );


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Shipping->recursive = 0;
		$this->set('shippings', $this->paginate());
		$active_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"1")));
		$inactive_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"0")));
		$total_pages=$this->Shipping->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Shipping->id = $id;
		if (!$this->Shipping->exists()) {
			throw new NotFoundException(__('Invalid shipping'));
		}
		$this->set('coupon', $this->Shipping->read(null, $id));
		$active_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"1")));
		$inactive_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"0")));
		$total_pages=$this->Shipping->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Shipping->create();
			if ($this->Shipping->save($this->request->data)) {
			    
				if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename='shipping_banner';
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/banners/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/banners/'.$filename);
				$this->Shipping->updateAll(
                    array('Shipping.image' => "'" . $filename . "'"), array('Shipping.id'=>$this->Shipping->id)
                );
			  }
			  
				$this->Session->setFlash(__('The shipping has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shipping could not be saved. Please, try again.'));
			}
		}
		$active_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"1")));
		$inactive_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"0")));
		$total_pages=$this->Shipping->find('count');
		
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Shipping->id = $id;
		if (!$this->Shipping->exists()) {
			throw new NotFoundException(__('Invalid shipping'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Shipping->save($this->request->data)) {
			  
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename='shipping_banner';
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/banners/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/banners/'.$filename);
				$this->Shipping->updateAll(
                    array('Shipping.image' => "'" . $filename . "'"), array('Shipping.id'=>$this->Shipping->id)
                );
			  }
			  
				$this->Session->setFlash(__('The shipping has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shipping could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Shipping->read(null, $id);
		}
		$active_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"1")));
		$inactive_pages=$this->Shipping->find('count',array("conditions"=>array("Shipping.status"=>"0")));
		$total_pages=$this->Shipping->find('count');
		
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
		$this->Shipping->id = $id;
		if (!$this->Shipping->exists()) {
			throw new NotFoundException(__('Invalid shipping'));
		}
		if ($this->Shipping->delete()) {
			$this->Session->setFlash(__('Shipping deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Shipping was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
