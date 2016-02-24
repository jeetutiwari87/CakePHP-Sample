<?php
App::uses('AppController', 'Controller');
/**
 * ItemStocks Controller
 * @developer searchtechnow.com
 *
 * @property ItemStock $ItemStock
 */
class ItemStocksController extends AppController {
var $uses = array('ItemStock', 'SitePermission');

/**
 * admin_index method
 *
 * @return void
 * @developer jeetu tiwari
 */
	public function admin_index($item_id) {
	    if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('action' => 'dashboard'));
		}
		$this->ItemStock->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
	    $conditions=array();
		if (isset($this->params['named']['keyword']) && $this->params['named']['keyword'] != '')
		{
	    	$conditions = array(
		    														 'OR' => array(
																	 'ItemStock.qty LIKE ' => '%' . $this->params['named']['keyword'] . '%',
																	 'Item.item_name LIKE ' => '%' . $this->params['named']['keyword'] . '%',
																	 'User.first_name LIKE ' => '%' . $this->params['named']['keyword'] . '%'
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
																	 'ItemStock.qty LIKE ' => '%' . $this->request->data['keyword'] . '%',
																	 'Item.item_name LIKE ' => '%' . $this->request->data['keyword'] . '%',
																	 'User.first_name LIKE ' => '%' . $this->request->data['keyword'] . '%'
		   															)
											   );
			
	    	}
		}
		
		$conditions['ItemStock.item_id']=$item_id;
		
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"ItemStock.".$this->ItemStock->primaryKey);
        $this->set(compact('limit','item_id'));
		$this->set('itemStocks', $this->paginate());
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
	public function admin_delete($id = null,$item_id) {
		$response=array();
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		 $this->autoRender=false;
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_delete'))
			{
				$response['status']=0;
			    $response['message']=__('You are not authorised to access that location');
				echo json_encode($response);
		        exit;
			}
			$this->ItemStock->id = $id;
			if (!$this->ItemStock->exists())
			{
				$response['status']=0;
			    $response['message']=__('Invalid item stock');
				echo json_encode($response);
		        exit;
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->ItemStock->delete())
			{
				$response['status']=1;
			    $response['message']=__('Item stock deleted');
				echo json_encode($response);
		        exit;
			}
			$response['status']=0;
			$response['message']=__('Invalid request');
			echo json_encode($response);
		    exit;
			
		} else {
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>'users','action' => 'dashboard'));
			}
			
			$this->ItemStock->id = $id;
			if (!$this->ItemStock->exists()) {
				throw new NotFoundException(__('Invalid item stock'));
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->ItemStock->delete()) {
					$this->Session->setFlash(__('Item stock deleted'));
				$this->redirect(array('action' => 'index',$item_id));
				}
				$this->Session->setFlash(__('Item stock was not deleted'));
				$this->redirect(array('action' => 'index',$item_id));
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
    public function admin_deleteall($item_id)
	{
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		 $this->autoRender=false;
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_delete'))
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
				$this->ItemStock->id = $ids;
				$this->ItemStock->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$response['status']=1;
			    $response['message']=__('Item stock deleted successfully!');
				echo json_encode($response);
		        exit;
		
			}
			else
			{
				$response['status']=0;
			    $response['message']=__('Item stock was not deleted');
				echo json_encode($response);
		        exit;
			
			}
		}
		 
		}else{
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'itemStocks', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>'users','action' => 'dashboard'));
			}
			$ids_arr = $this->request->data['ids'];
			$flag = 0;
			foreach ($ids_arr as $id)
			{
				$this->ItemStock->id = $id;
				$this->ItemStock->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$this->Session->setFlash(__('Item stock deleted successfully!'));
				$this->redirect(array('action' => 'index',$item_id));
			}
			else
			{
				$this->Session->setFlash(__('Item stock was not deleted'));
				$this->redirect(array('action' => 'index',$item_id));
			}
		}
    }

}
