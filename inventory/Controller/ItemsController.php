<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 * @developer searchtechnow.com
 *
 * @property Item $Item
 */
class ItemsController extends AppController {
var $uses = array('Item', 'SitePermission');

/**
 * admin_index method
 *
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_index() {
	    if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		$this->Item->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
	    $conditions=array();
		if (isset($this->params['named']['keyword']) && $this->params['named']['keyword'] != '')
		{
	    	$conditions = array(
		    														 'OR' => array(
																	 'Item.item_serialno LIKE ' => '%' . $this->params['named']['keyword'] . '%',
																	 'Item.item_name LIKE ' => '%' . $this->params['named']['keyword'] . '%',
																	 'Category.name LIKE ' => '%' . $this->params['named']['keyword'] . '%'
		   															)
											   );
		}
		if (!empty($this->request->data))
		{
	    	if (isset($this->request->data['showperpage']) && $this->request->data['showperpage'] != '')
			{
				$limit = $this->request->data['showperpage'];
				$this->params['named'] = array("showperpage" => $limit);
	    	}
	    	if (isset($this->request->data['keyword']) && $this->request->data['keyword'] != '')
			{
				$this->params['named'] = array("keyword" => $this->request->data['keyword']);
												$conditions = array(
		    														 'OR' => array(
																	 'Item.item_serialno LIKE ' => '%' . $this->request->data['keyword'] . '%',
																	 'Item.item_name LIKE ' => '%' . $this->request->data['keyword'] . '%',
																	 'Category.name LIKE ' => '%' . $this->request->data['keyword'] . '%'
		   															)
											   );
			
	    	}
		}
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"Item.".$this->Item->primaryKey.' DESC');
        $this->set(compact('limit'));
		$this->set('items', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_view($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
		$this->set('item', $this->Item->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_add() {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_add'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->Item->create();
			if ($this->Item->save($this->request->data)) {
			    if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The item has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The item has been saved'));
				  $this->redirect(array('action' => 'index'));
				}

			} else {
												$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
							}
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories'));

}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_edit($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data)) {
			if ($this->Item->save($this->request->data)) {
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The item has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The item has been saved'));
				  $this->redirect(array('action' => 'index'));
				}
						} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Item.' . $this->Item->primaryKey => $id));
			$this->request->data = $this->Item->find('first', $options);
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories'));

	}
    
	
	public function admin_add_stock($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_add'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Item->exists($id)) {
			throw new NotFoundException(__('Invalid item'));
		}
		if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data)) {
			
			$qty=(isset($this->request->data['Item']['qty']) && $this->request->data['Item']['qty']!='')?$this->request->data['Item']['qty']:0;
			$item_stocks=array();
			$item_stocks['ItemStock']['item_id']=$this->request->data['Item']['id'];
			$item_stocks['ItemStock']['user_id']=$this->Auth->user("id");
			$item_stocks['ItemStock']['qty']=$qty;
			
			if ($this->Item->ItemStock->save($item_stocks)) {
				 $this->Item->updateAll(
									array('Item.item_stocklevel' => "Item.item_stocklevel+$qty"), array('Item.id' => $item_stocks['ItemStock']['item_id'])
				 );
							
				$this->Session->setFlash(__('The stock has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('There is some problem to add stock. Please, try again.'));
			}
		}
		 
		$this->set(compact('id'));

	}
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_delete($id = null) {
		$response=array();
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		 $this->autoRender=false;
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_delete'))
			{
				$response['status']=0;
			    $response['message']=__('You are not authorised to access that location');
				echo json_encode($response);
		        exit;
			}
			$this->Item->id = $id;
			if (!$this->Item->exists())
			{
				$response['status']=0;
			    $response['message']=__('Invalid item');
				echo json_encode($response);
		        exit;
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->Item->delete())
			{
				$response['status']=1;
			    $response['message']=__('Item deleted');
				echo json_encode($response);
		        exit;
			}
			$response['status']=0;
			$response['message']=__('Invalid request');
			echo json_encode($response);
		    exit;
			
		} else {
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
			}
			
			$this->Item->id = $id;
			if (!$this->Item->exists()) {
				throw new NotFoundException(__('Invalid item'));
			}
			
			$this->Item->deleteFile('item_photo','items');
			//$this->request->onlyAllow('post', 'delete');
			if ($this->Item->delete()) {
					$this->Session->setFlash(__('Item deleted'));
				$this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Item was not deleted'));
				$this->redirect(array('action' => 'index'));
	 }
	}
	
	/**
     * admin_delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function admin_deleteall()
	{
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		 $this->autoRender=false;
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_delete'))
		 {
				$response['status']=0;
			    $response['message']=__('You are not authorised to access that location');
				echo json_encode($response);
		        exit;
		 }
		$ids_arr = $this->request->data['ids'];
		$flag = 0;
		if(count($ids_arr)>0){
			foreach ($ids_arr as $ids)
			{
				$this->Item->id = $ids;
				$this->Item->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$response['status']=1;
			    $response['message']=__('Item deleted successfully!');
				echo json_encode($response);
		        exit;
		
			}
			else
			{
				$response['status']=0;
			    $response['message']=__('Item was not deleted');
				echo json_encode($response);
		        exit;
			
			}
		}
		 
		}else{
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'items', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
			}
			$ids_arr = $this->request->data['ids'];
			$flag = 0;
			foreach ($ids_arr as $id)
			{
				$this->Item->id = $id;
				$this->Item->deleteFile('item_photo','items');
				$this->Item->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$this->Session->setFlash(__('Item deleted successfully!'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('Item was not deleted'));
				$this->redirect(array('action' => 'index'));
			}
		}
    }

/**
 * admin_update status method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id,$status
 * @return void
 * @developer jeetu tiwari
 */
  public function admin_update_status($id = null,$status) {
		 $response=array();
		  if($status==0){
		   $mark=1;
		  }else{
		   $mark=0;
		  }
		
		if(!empty($id)){
	    if($this->request->is('ajax')){
		 $this->layout='ajax';
		 $this->autoRender=false;
		 
		 if($this->Item->updateAll(array('Item.status' => "'" . $mark . "'"), array('Item.id' => $id))){
			  $response['status']=1;
			  $response['message']=__('Status updated successfully');
		 }else{
			  $response['status']=0;
			  $response['message']=__('There is some problem to update status. please try again');
		 }
		 echo json_encode($response);
		 exit;
		 
		}else{
			if($this->Item->updateAll(array('Item.status' => "'" . $mark . "'"), array('Item.id' => $id))){
			  $this->Session->setFlash(__('Status updated successfully'));
			  $this->redirect(array('action' => 'index'));
			}else{
			  $this->Session->setFlash(__('There is some problem to update status. please try again'));
			  $this->redirect(array('action' => 'index'));
			}
		}
	  }
	  
	  if($this->request->is('ajax')){
	    $this->layout='ajax';
		$this->autoRender=false;
		$response['status']=0;
	    $response['message']=__('Invalid request');
		echo json_encode($response);
		exit;
	  }else{
	    $this->Session->setFlash(__('Invalid request'));
		$this->redirect(array('action' => 'index'));
	  }
	
	}
}
