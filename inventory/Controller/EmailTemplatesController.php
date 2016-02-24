<?php
App::uses('AppController', 'Controller');
/**
 * EmailTemplates Controller
 * @developer searchtechnow.com
 *
 * @property EmailTemplate $EmailTemplate
 */
class EmailTemplatesController extends AppController {
var $uses = array('EmailTemplate', 'SitePermission');


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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		$this->EmailTemplate->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
	    $conditions=array();
		if (isset($this->params['named']['keyword']) && $this->params['named']['keyword'] != '')
		{
	    	$conditions = array(
								 'OR' => array(
											 'EmailTemplate.subject LIKE ' => '%' . $this->params['named']['keyword'] . '%',
											 'EmailTemplate.description LIKE ' => '%' . $this->params['named']['keyword'] . '%'
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
																	 'EmailTemplate.subject LIKE ' => '%' . $this->request->data['keyword'] . '%',
																	 'EmailTemplate.description LIKE ' => '%' . $this->request->data['keyword'] . '%'
		   															)
											   );
			
	    	}
		}
		
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"EmailTemplate.".$this->EmailTemplate->primaryKey);
        $this->set(compact('limit'));
		$this->set('emailTemplates', $this->paginate());
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
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
		$this->set('emailTemplate', $this->EmailTemplate->find('first', $options));
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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_add'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->EmailTemplate->create();
			if ($this->EmailTemplate->save($this->request->data)) {
			    if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The email template has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The email template has been saved'));
				  $this->redirect(array('action' => 'index'));
				}

			} else {
												$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
							}
		}

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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data)) {
			if ($this->EmailTemplate->save($this->request->data)) {
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The email template has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The email template has been saved'));
				  $this->redirect(array('action' => 'index'));
				}
						} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
			$this->request->data = $this->EmailTemplate->find('first', $options);
		}

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
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_delete'))
			{
				$response['status']=0;
			    $response['message']=__('You are not authorised to access that location');
				echo json_encode($response);
		        exit;
			}
			$this->EmailTemplate->id = $id;
			if (!$this->EmailTemplate->exists())
			{
				$response['status']=0;
			    $response['message']=__('Invalid email template');
				echo json_encode($response);
		        exit;
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->EmailTemplate->delete())
			{
				$response['status']=1;
			    $response['message']=__('Email template deleted');
				echo json_encode($response);
		        exit;
			}
			$response['status']=0;
			$response['message']=__('Invalid request');
			echo json_encode($response);
		    exit;
			
		} else {
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
			}
			
			$this->EmailTemplate->id = $id;
			if (!$this->EmailTemplate->exists()) {
				throw new NotFoundException(__('Invalid email template'));
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->EmailTemplate->delete()) {
					$this->Session->setFlash(__('Email template deleted'));
				$this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Email template was not deleted'));
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
		 if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_delete'))
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
				$this->EmailTemplate->id = $ids;
				$this->EmailTemplate->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$response['status']=1;
			    $response['message']=__('Email template deleted successfully!');
				echo json_encode($response);
		        exit;
		
			}
			else
			{
				$response['status']=0;
			    $response['message']=__('Email template was not deleted');
				echo json_encode($response);
		        exit;
			
			}
		}
		 
		}else{
			if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'emailTemplates', 'is_delete'))
			{
				$this->Session->setFlash(__('You are not authorised to access that location'));
				$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
			}
			$ids_arr = $this->request->data['ids'];
			$flag = 0;
			foreach ($ids_arr as $id)
			{
				$this->EmailTemplate->id = $id;
				$this->EmailTemplate->delete();
				$flag++;
			}
			if ($flag > 0)
			{
				$this->Session->setFlash(__('Email template deleted successfully!'));
				$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->Session->setFlash(__('Email template was not deleted'));
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
		 
		 if($this->EmailTemplate->updateAll(array('EmailTemplate.status' => "'" . $mark . "'"), array('EmailTemplate.id' => $id))){
			  $response['status']=1;
			  $response['message']=__('Status updated successfully');
		 }else{
			  $response['status']=0;
			  $response['message']=__('There is some problem to update status. please try again');
		 }
		 echo json_encode($response);
		 exit;
		 
		}else{
			if($this->EmailTemplate->updateAll(array('EmailTemplate.status' => "'" . $mark . "'"), array('EmailTemplate.id' => $id))){
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
