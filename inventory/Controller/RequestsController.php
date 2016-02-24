<?php
App::uses('AppController', 'Controller');
/**
 * Requests Controller
 * @developer searchtechnow.com
 *
 * @property Request $Request
 */
class RequestsController extends AppController {
var $uses = array('Request', 'SitePermission', "EmailTemplate");

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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'requisition_history', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		$this->Request->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
	    $conditions=array();
		if (!empty($this->request->data))
		{
	    	if (isset($this->request->data['showperpage']) && $this->request->data['showperpage'] != '')
			{
				$limit = $this->request->data['showperpage'];
				$this->params['named'] = array("showperpage" => $limit);
	    	}
	    	
		}
		$conditions['Request.request_requestedby']=$this->Auth->user("id");
		
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"Request.".$this->Request->primaryKey.' DESC','recursive'=>"-1");
        $this->set(compact('limit'));
		$this->set('requests', $this->paginate());
	}
	
	public function admin_view_requisitions() {
	    if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'view_requisition', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		$this->Request->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
		
	    $conditions=array();
		if (!empty($this->request->data))
		{
	    	if (isset($this->request->data['showperpage']) && $this->request->data['showperpage'] != '')
			{
				$limit = $this->request->data['showperpage'];
				$this->params['named'] = array("showperpage" => $limit);
	    	}
	    	
		}
		//$conditions['Request.request_requestedby']=$this->Auth->user("id");
		
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"Request.".$this->Request->primaryKey.' DESC','recursive'=>"-1");
        $this->set(compact('limit'));
		$this->set('requests', $this->paginate());
	}
	
	public function admin_requisitions() {
	    if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'admin_requisition', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		$this->Request->recursive = 0;
		$limit=(isset($this->params['named']['showperpage']))?$this->params['named']['showperpage']:Configure::read('site.admin_paging_limit');
		
		
	    $conditions=array();
		if (!empty($this->request->data))
		{
	    	if (isset($this->request->data['showperpage']) && $this->request->data['showperpage'] != '')
			{
				$limit = $this->request->data['showperpage'];
				$this->params['named'] = array("showperpage" => $limit);
	    	}
	    	
		}
		//$conditions['Request.request_requestedby']=$this->Auth->user("id");
		
		if($limit=='ALL') {
		 $paging_limit='1000000';
		} else {
		 $paging_limit=$limit;
		}

		$this->paginate=array("conditions"=>$conditions,"limit"=>$paging_limit,"order"=>"Request.".$this->Request->primaryKey.' DESC','recursive'=>"-1");
        $this->set(compact('limit'));
		$this->set('requests', $this->paginate());
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
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'requisition_history', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		
		$this->set('request', $this->Request->find('first', $options));
	}
	
	public function admin_view_details($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'view_requisition', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		
		$this->set('request', $this->Request->find('first', $options));
	}
	
	public function admin_details($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'admin_requisition', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
		
		
		
		$this->set('request', $this->Request->find('first', $options));
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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'requisition_requests', 'is_add'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if ($this->request->is('post') && !empty($this->request->data)) {
			$this->Request->create();
			
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_eventfromdate'])):0;
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_todate'])):0;
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_returnto'])):0;
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['event_collectiondate']) && $this->request->data['Request']['event_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_collectiondate'])):0;
			}else{
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['gallery_collectiondate']) && $this->request->data['Request']['gallery_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['gallery_collectiondate'])):0;
			}
			
			$this->request->data['Request']['gallery_other_text']=(isset($this->request->data['Request']['other_text']) && $this->request->data['Request']['other_text']!='')?$this->request->data['Request']['other_text']:'';
			
			$this->request->data['Request']['request_requestedby']=$this->Auth->user("id");
			
			
			
			if ($this->Request->save($this->request->data)) {
			    //Save request Items
				if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
				   foreach($this->request->data['item_ids'] as $key=>$ids){
					 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
					 if($qty>0){
					   $request_item=array();
					   $request_item['RequestItem']['request_id']=$this->Request->id;
					   $ids_arr=explode("##",$ids);
					   
					   $request_item['RequestItem']['item_id']=$ids_arr[1];
					   $request_item['RequestItem']['category_id']=$ids_arr[0];
					   $request_item['RequestItem']['reqitem_quantity']=$qty;
					   $this->Request->RequestItem->create();
					   $this->Request->RequestItem->save($request_item);
					   
					   $this->loadModel('Item');
					   $this->Item->updateAll(
                                array('Item.item_stocklevel' => "Item.item_stocklevel-$qty"), array('Item.id' => $ids_arr[1])
                        );
						
					 }
				   }
				}
				
				//Send email to manage and admin
				$this->loadModel('User');
				$emails=array();
				$users_data=$this->User->find("all",array("conditions"=>array("User.role_id"=>array("1","2"),"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				if(isset($users_data) && count($users_data)>0){
				  foreach($users_data as $user_row){
				    $emails[]=$user_row['User']['email'];
				  }
				}
				
				$email = $this->EmailTemplate->selectTemplate('requisition_requests_email');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $this->Auth->user("first_name") . ' ' . $this->Auth->user("last_name"),
                    '##SITE_NAME##' => Configure::read('site.name'),
                    '##SUPPORT_EMAIL##' => Configure::read('site.contactus_email'),
                    '##WEBSITE_URL##' => Router::url('/', true),
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']),
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => '/',
                        'logo-big.png',
                        'admin' => false
                            ), true),
                );

                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
               // $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $emails;
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['description'], $emailFindReplace));
				
				
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The request has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The request has been saved'));
				  $this->redirect(array('action' => 'index'));
				}

			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		}
		
		$this->loadModel('Category');
		$this->loadModel('Item');
		
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $items_data[$i]['category_id']=$cat_key;
		  $items_data[$i]['category_name']=$cat_val;
		  $items_data[$i]['items']=$this->Item->find("all",array("conditions"=>array("Item.category_id"=>$cat_key,"Item.status"=>"0"),"recursive"=>"-1"));
		  $i++;
		}
		
		
		$galleries=$this->Request->Gallery->find('list',array("conditions"=>array("Gallery.status"=>'1')));
		$this->set(compact('galleries','items_data'));

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
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'view_requisition', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_eventfromdate'])):0;
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_todate'])):0;
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_returnto'])):0;
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['event_collectiondate']) && $this->request->data['Request']['event_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_collectiondate'])):0;
			}else{
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['gallery_collectiondate']) && $this->request->data['Request']['gallery_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['gallery_collectiondate'])):0;
			}
			
			$this->request->data['Request']['gallery_other_text']=(isset($this->request->data['Request']['other_text']) && $this->request->data['Request']['other_text']!='')?$this->request->data['Request']['other_text']:'';
			
			
			if($this->request->data['Request']['request_status']==1){
			 $this->request->data['Request']['request_approvedby']=$this->Auth->user("id");
			 $this->request->data['Request']['request_approvaldatetime']=date('Y-m-d H:i:s');
			}else{
			 $this->request->data['Request']['request_rejectedby']=$this->Auth->user("id");
			 $this->request->data['Request']['request_rejecteddatetime']=date('Y-m-d H:i:s');
			}
			
			
			
			if ($this->Request->save($this->request->data)) {
			    //update request Items
				if($this->request->data['Request']['request_status']==1){
					if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
					   foreach($this->request->data['item_ids'] as $key=>$ids){
						 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
						 if($qty>0){
						   $ids_arr=explode("##",$ids);
						   
						   $request_item=array();
						  
						   $request_item['RequestItem']['id']=(isset($this->request->data['request_item_id'][$key]) && $this->request->data['request_item_id'][$key]!='')?$this->request->data['request_item_id'][$key]:0;
						   $request_item['RequestItem']['reqitem_quantityapproved']=$qty;
						   
						   $this->Request->RequestItem->save($request_item);
						   
							
						 }
					   }
					}
				}else{
				   if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
					   foreach($this->request->data['item_ids'] as $key=>$ids){
						 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
						 if($qty>0){
						   $ids_arr=explode("##",$ids);
						   $this->loadModel('Item');
						   $this->Item->updateAll(
									array('Item.item_stocklevel' => "Item.item_stocklevel+$qty"), array('Item.id' => $ids_arr[1])
							);
							
						 }
					   }
					}
				}
				
				//Send email to manage and admin
				$request_info=$this->Request->find('first', array("conditions"=>array("Request.id"=>$id),"fields"=>array("Request.request_requestedby"),"recursive"=>"-1"));
				
				$this->loadModel('User');
				$users_info=$this->User->find("first",array("conditions"=>array("User.id"=>$request_info['Request']['request_requestedby'],"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				
				
				$emails=array();
				$emails[]=$users_info['User']['email'];
				$users_data=$this->User->find("all",array("conditions"=>array("User.role_id"=>array("1"),"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				if(isset($users_data) && count($users_data)>0){
				  foreach($users_data as $user_row){
				    $emails[]=$user_row['User']['email'];
				  }
				}
				
				if($this->request->data['Request']['request_status']==1){
				 $email = $this->EmailTemplate->selectTemplate('requisition_request_approve_email');
				}else{
				 $email = $this->EmailTemplate->selectTemplate('requisition_request_reject_email');
				}
				
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $this->Auth->user("first_name") . ' ' . $this->Auth->user("last_name"),
                    '##SITE_NAME##' => Configure::read('site.name'),
                    '##SUPPORT_EMAIL##' => Configure::read('site.contactus_email'),
                    '##WEBSITE_URL##' => Router::url('/', true),
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']),
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => '/',
                        'logo-big.png',
                        'admin' => false
                            ), true),
                );

                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
               // $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $emails;
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['description'], $emailFindReplace));
				
				
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The request has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The request has been updated'));
				  $this->redirect(array('action' => 'view_requisitions'));
				}

			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_eventfromdate'])):'';
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['event_todate'])):'';
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_returnto'])):'';
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['event_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}else{
			 $this->request->data['Request']['gallery_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}
			
			$this->request->data['Request']['other_text']=(isset($this->request->data['Request']['gallery_other_text']) && $this->request->data['Request']['gallery_other_text']!='')?$this->request->data['Request']['gallery_other_text']:'';
			
			
			
		}
		
		$this->loadModel('Category');
	
		$this->Request->RequestItem->bindModel(array(
                   	'belongsTo' => array('Item'),
                ),false);
				
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $category_items=$this->Request->RequestItem->find("all",array("conditions"=>array("RequestItem.category_id"=>$cat_key,"RequestItem.request_id"=>$id)));
		 
		  if(count($category_items)>0){
			  $items_data[$i]['category_id']=$cat_key;
			  $items_data[$i]['category_name']=$cat_val;
			  $k=0;
			  foreach($category_items as $cat_item){
			   $items_data[$i]['items'][$k]['Item']['id']=$cat_item['RequestItem']['item_id'];
			   $items_data[$i]['items'][$k]['Item']['request_item_id']=$cat_item['RequestItem']['id'];
			   $items_data[$i]['items'][$k]['Item']['item_serialno']=$cat_item['Item']['item_serialno'];
			   $items_data[$i]['items'][$k]['Item']['item_name']=$cat_item['Item']['item_name'];
			   $items_data[$i]['items'][$k]['Item']['item_stocklevel']=$cat_item['Item']['item_stocklevel'];
			   $items_data[$i]['items'][$k]['Item']['item_measurementunit']=$cat_item['Item']['item_measurementunit'];
			   $items_data[$i]['items'][$k]['Item']['item_photo']=$cat_item['Item']['item_photo'];
			   $items_data[$i]['items'][$k]['Item']['item_unitprice']=$cat_item['Item']['item_unitprice'];
			   $items_data[$i]['items'][$k]['Item']['item_isasset']=$cat_item['Item']['item_isasset'];
			   $items_data[$i]['items'][$k]['Item']['item_iscollateral']=$cat_item['Item']['item_iscollateral'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantity']=$cat_item['RequestItem']['reqitem_quantity'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityapproved']=$cat_item['RequestItem']['reqitem_quantityapproved'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantitycollected']=$cat_item['RequestItem']['reqitem_quantitycollected'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityreturned']=$cat_item['RequestItem']['reqitem_quantityreturned'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityverified']=$cat_item['RequestItem']['reqitem_quantityverified'];
			   $items_data[$i]['items'][$k]['Item']['collect_remark']=$cat_item['RequestItem']['collect_remark'];
			   $items_data[$i]['items'][$k]['Item']['return_remark']=$cat_item['RequestItem']['return_remark'];
			   $items_data[$i]['items'][$k]['Item']['verify_remark']=$cat_item['RequestItem']['verify_remark'];
			   
			   $k++;
			  }
			  
			  $i++;
		  }
		}
		
		
		
		
		$galleries=$this->Request->Gallery->find('list',array("conditions"=>array("Gallery.status"=>'1')));
		$this->set(compact('galleries','items_data'));

	}
	
	public function admin_collect($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'admin_requisition', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_eventfromdate'])):0;
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_todate'])):0;
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_returnto'])):0;
			
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['event_collectiondate']) && $this->request->data['Request']['event_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_collectiondate'])):0;
			}else{
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['gallery_collectiondate']) && $this->request->data['Request']['gallery_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['gallery_collectiondate'])):0;
			}
			
			$this->request->data['Request']['gallery_other_text']=(isset($this->request->data['Request']['other_text']) && $this->request->data['Request']['other_text']!='')?$this->request->data['Request']['other_text']:'';
			$this->request->data['Request']['request_collectedby']=$this->Auth->user("id");
			$this->request->data['Request']['request_status']='3';
			$this->request->data['Request']['request_collectiondatetime']=date('Y-m-d H:i:s');
			
			
			
			
			
			if ($this->Request->save($this->request->data)) {
			    //update request Items
				
					if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
					   foreach($this->request->data['item_ids'] as $key=>$ids){
						 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
						 if($qty>0){
						   $remarks=(isset($this->request->data['remarks'][$key]) && $this->request->data['remarks'][$key]!='')?$this->request->data['remarks'][$key]:'';
						   $ids_arr=explode("##",$ids);
						   
						   $request_item=array();
						  
						   $request_item['RequestItem']['id']=(isset($this->request->data['request_item_id'][$key]) && $this->request->data['request_item_id'][$key]!='')?$this->request->data['request_item_id'][$key]:0;
						   $request_item['RequestItem']['reqitem_quantitycollected']=$qty;
						   $request_item['RequestItem']['collect_remark']=$remarks;
						   
						   $this->Request->RequestItem->save($request_item);
						   
							
						 }
					   }
					}
				
				
				//Send email to manage and admin
				$request_info=$this->Request->find('first', array("conditions"=>array("Request.id"=>$id),"fields"=>array("Request.request_requestedby"),"recursive"=>"-1"));
				
				$this->loadModel('User');
				$users_info=$this->User->find("first",array("conditions"=>array("User.id"=>$request_info['Request']['request_requestedby'],"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				
				
				$emails=array();
				$emails[]=$users_info['User']['email'];
				/*$users_data=$this->User->find("all",array("conditions"=>array("User.role_id"=>array("1"),"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				if(isset($users_data) && count($users_data)>0){
				  foreach($users_data as $user_row){
				    $emails[]=$user_row['User']['email'];
				  }
				}*/
				
				$email = $this->EmailTemplate->selectTemplate('requisition_request_collected_email');
				
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $this->Auth->user("first_name") . ' ' . $this->Auth->user("last_name"),
                    '##SITE_NAME##' => Configure::read('site.name'),
                    '##SUPPORT_EMAIL##' => Configure::read('site.contactus_email'),
                    '##WEBSITE_URL##' => Router::url('/', true),
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']),
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => '/',
                        'logo-big.png',
                        'admin' => false
                            ), true),
                );

                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
               // $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $emails;
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['description'], $emailFindReplace));
				
				
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The request has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The request has been updated'));
				  $this->redirect(array('action' => 'requisitions'));
				}

			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_eventfromdate'])):'';
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['event_todate'])):'';
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_returnto'])):'';
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['event_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}else{
			 $this->request->data['Request']['gallery_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}
			
			$this->request->data['Request']['other_text']=(isset($this->request->data['Request']['gallery_other_text']) && $this->request->data['Request']['gallery_other_text']!='')?$this->request->data['Request']['gallery_other_text']:'';
			
			
			
		}
		
		$this->loadModel('Category');
	
		$this->Request->RequestItem->bindModel(array(
                   	'belongsTo' => array('Item'),
                ),false);
				
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $category_items=$this->Request->RequestItem->find("all",array("conditions"=>array("RequestItem.category_id"=>$cat_key,"RequestItem.request_id"=>$id)));
		 
		  if(count($category_items)>0){
			  $items_data[$i]['category_id']=$cat_key;
			  $items_data[$i]['category_name']=$cat_val;
			  $k=0;
			  foreach($category_items as $cat_item){
			   $items_data[$i]['items'][$k]['Item']['id']=$cat_item['RequestItem']['item_id'];
			   $items_data[$i]['items'][$k]['Item']['request_item_id']=$cat_item['RequestItem']['id'];
			   $items_data[$i]['items'][$k]['Item']['item_serialno']=$cat_item['Item']['item_serialno'];
			   $items_data[$i]['items'][$k]['Item']['item_name']=$cat_item['Item']['item_name'];
			   $items_data[$i]['items'][$k]['Item']['item_stocklevel']=$cat_item['Item']['item_stocklevel'];
			   $items_data[$i]['items'][$k]['Item']['item_measurementunit']=$cat_item['Item']['item_measurementunit'];
			   $items_data[$i]['items'][$k]['Item']['item_photo']=$cat_item['Item']['item_photo'];
			   $items_data[$i]['items'][$k]['Item']['item_unitprice']=$cat_item['Item']['item_unitprice'];
			   $items_data[$i]['items'][$k]['Item']['item_isasset']=$cat_item['Item']['item_isasset'];
			   $items_data[$i]['items'][$k]['Item']['item_iscollateral']=$cat_item['Item']['item_iscollateral'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantity']=$cat_item['RequestItem']['reqitem_quantity'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityapproved']=$cat_item['RequestItem']['reqitem_quantityapproved'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantitycollected']=$cat_item['RequestItem']['reqitem_quantitycollected'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityreturned']=$cat_item['RequestItem']['reqitem_quantityreturned'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityverified']=$cat_item['RequestItem']['reqitem_quantityverified'];
			   $items_data[$i]['items'][$k]['Item']['collect_remark']=$cat_item['RequestItem']['collect_remark'];
			   $items_data[$i]['items'][$k]['Item']['return_remark']=$cat_item['RequestItem']['return_remark'];
			   $items_data[$i]['items'][$k]['Item']['verify_remark']=$cat_item['RequestItem']['verify_remark'];
			   
			   $k++;
			  }
			  
			  $i++;
		  }
		}
		
		
		
		
		$galleries=$this->Request->Gallery->find('list',array("conditions"=>array("Gallery.status"=>'1')));
		$this->set(compact('galleries','items_data'));

	}
	
	public function admin_return($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'requisition_history', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_eventfromdate'])):0;
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_todate'])):0;
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_returnto'])):0;
			
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['event_collectiondate']) && $this->request->data['Request']['event_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_collectiondate'])):0;
			}else{
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['gallery_collectiondate']) && $this->request->data['Request']['gallery_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['gallery_collectiondate'])):0;
			}
			
			$this->request->data['Request']['gallery_other_text']=(isset($this->request->data['Request']['other_text']) && $this->request->data['Request']['other_text']!='')?$this->request->data['Request']['other_text']:'';
			
			$this->request->data['Request']['request_returnedby']=$this->Auth->user("id");
			$this->request->data['Request']['request_status']='4';
			$this->request->data['Request']['request_returndatetime']=date('Y-m-d H:i:s');
			
			
			
			
			
			if ($this->Request->save($this->request->data)) {
			    //update request Items
				
					if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
					   foreach($this->request->data['item_ids'] as $key=>$ids){
						 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
						 if($qty>0){
						   $remarks=(isset($this->request->data['remarks'][$key]) && $this->request->data['remarks'][$key]!='')?$this->request->data['remarks'][$key]:'';
						   $ids_arr=explode("##",$ids);
						   
						   $request_item=array();
						  
						   $request_item['RequestItem']['id']=(isset($this->request->data['request_item_id'][$key]) && $this->request->data['request_item_id'][$key]!='')?$this->request->data['request_item_id'][$key]:0;
						   $request_item['RequestItem']['reqitem_quantityreturned']=$qty;
						   $request_item['RequestItem']['return_remark']=$remarks;
						   
						   $this->Request->RequestItem->save($request_item);
						   
							
						 }
					   }
					}
				
				
				//Send email to manage and admin
				//$request_info=$this->Request->find('first', array("conditions"=>array("Request.id"=>$id),"fields"=>array("Request.request_requestedby"),"recursive"=>"-1"));
				
				$this->loadModel('User');
				//$users_info=$this->User->find("first",array("conditions"=>array("User.id"=>$request_info['Request']['request_requestedby'],"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				
				
				$emails=array();
				//$emails[]=$users_info['User']['email'];
				$users_data=$this->User->find("all",array("conditions"=>array("User.role_id"=>array("1"),"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				if(isset($users_data) && count($users_data)>0){
				  foreach($users_data as $user_row){
				    $emails[]=$user_row['User']['email'];
				  }
				}
				
				$email = $this->EmailTemplate->selectTemplate('requisition_request_returned_email');
				
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $this->Auth->user("first_name") . ' ' . $this->Auth->user("last_name"),
                    '##SITE_NAME##' => Configure::read('site.name'),
                    '##SUPPORT_EMAIL##' => Configure::read('site.contactus_email'),
                    '##WEBSITE_URL##' => Router::url('/', true),
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']),
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => '/',
                        'logo-big.png',
                        'admin' => false
                            ), true),
                );

                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
               // $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $emails;
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['description'], $emailFindReplace));
				
				
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The request has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The request has been updated'));
				  $this->redirect(array('action' => 'index'));
				}

			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_eventfromdate'])):'';
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['event_todate'])):'';
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_returnto'])):'';
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['event_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}else{
			 $this->request->data['Request']['gallery_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}
			
			$this->request->data['Request']['other_text']=(isset($this->request->data['Request']['gallery_other_text']) && $this->request->data['Request']['gallery_other_text']!='')?$this->request->data['Request']['gallery_other_text']:'';
			
			
			
		}
		
		$this->loadModel('Category');
	
		$this->Request->RequestItem->bindModel(array(
                   	'belongsTo' => array('Item'),
                ),false);
				
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $category_items=$this->Request->RequestItem->find("all",array("conditions"=>array("RequestItem.category_id"=>$cat_key,"RequestItem.request_id"=>$id)));
		 
		  if(count($category_items)>0){
			  $items_data[$i]['category_id']=$cat_key;
			  $items_data[$i]['category_name']=$cat_val;
			  $k=0;
			  foreach($category_items as $cat_item){
			   $items_data[$i]['items'][$k]['Item']['id']=$cat_item['RequestItem']['item_id'];
			   $items_data[$i]['items'][$k]['Item']['request_item_id']=$cat_item['RequestItem']['id'];
			   $items_data[$i]['items'][$k]['Item']['item_serialno']=$cat_item['Item']['item_serialno'];
			   $items_data[$i]['items'][$k]['Item']['item_name']=$cat_item['Item']['item_name'];
			   $items_data[$i]['items'][$k]['Item']['item_stocklevel']=$cat_item['Item']['item_stocklevel'];
			   $items_data[$i]['items'][$k]['Item']['item_measurementunit']=$cat_item['Item']['item_measurementunit'];
			   $items_data[$i]['items'][$k]['Item']['item_photo']=$cat_item['Item']['item_photo'];
			   $items_data[$i]['items'][$k]['Item']['item_unitprice']=$cat_item['Item']['item_unitprice'];
			   $items_data[$i]['items'][$k]['Item']['item_isasset']=$cat_item['Item']['item_isasset'];
			   $items_data[$i]['items'][$k]['Item']['item_iscollateral']=$cat_item['Item']['item_iscollateral'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantity']=$cat_item['RequestItem']['reqitem_quantity'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityapproved']=$cat_item['RequestItem']['reqitem_quantityapproved'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantitycollected']=$cat_item['RequestItem']['reqitem_quantitycollected'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityreturned']=$cat_item['RequestItem']['reqitem_quantityreturned'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityverified']=$cat_item['RequestItem']['reqitem_quantityverified'];
			   $items_data[$i]['items'][$k]['Item']['collect_remark']=$cat_item['RequestItem']['collect_remark'];
			   $items_data[$i]['items'][$k]['Item']['return_remark']=$cat_item['RequestItem']['return_remark'];
			   $items_data[$i]['items'][$k]['Item']['verify_remark']=$cat_item['RequestItem']['verify_remark'];
			   
			   $k++;
			  }
			  
			  $i++;
		  }
		}
		
		
		
		
		$galleries=$this->Request->Gallery->find('list',array("conditions"=>array("Gallery.status"=>'1')));
		$this->set(compact('galleries','items_data'));

	}
	
	public function admin_verify($id = null) {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'admin_requisition', 'is_edit'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		if (!$this->Request->exists($id)) {
			throw new NotFoundException(__('Invalid request'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_eventfromdate'])):0;
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_todate'])):0;
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='')?date('Y-m-d',strtotime($this->request->data['Request']['request_returnto'])):0;
			
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['event_collectiondate']) && $this->request->data['Request']['event_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['event_collectiondate'])):0;
			}else{
			 $this->request->data['Request']['collectiondate']=(isset($this->request->data['Request']['gallery_collectiondate']) && $this->request->data['Request']['gallery_collectiondate']!='')?date('Y-m-d',strtotime($this->request->data['Request']['gallery_collectiondate'])):0;
			}
			
			$this->request->data['Request']['gallery_other_text']=(isset($this->request->data['Request']['other_text']) && $this->request->data['Request']['other_text']!='')?$this->request->data['Request']['other_text']:'';
			
			$this->request->data['Request']['request_verifiedby']=$this->Auth->user("id");
			$this->request->data['Request']['request_verifydatetime']=date('Y-m-d H:i:s');
			
			
			
			
			
			if ($this->Request->save($this->request->data)) {
			    //update request Items
				
					if(isset($this->request->data['item_ids']) && count($this->request->data['item_ids'])>0){
					   foreach($this->request->data['item_ids'] as $key=>$ids){
						 $qty=(isset($this->request->data['qty'][$key]) && $this->request->data['qty'][$key]!='')?$this->request->data['qty'][$key]:0;
						 if($qty>0){
						   $remarks=(isset($this->request->data['remarks'][$key]) && $this->request->data['remarks'][$key]!='')?$this->request->data['remarks'][$key]:'';
						   $ids_arr=explode("##",$ids);
						   
						   $request_item=array();
						  
						   $request_item['RequestItem']['id']=(isset($this->request->data['request_item_id'][$key]) && $this->request->data['request_item_id'][$key]!='')?$this->request->data['request_item_id'][$key]:0;
						   $request_item['RequestItem']['reqitem_quantityverified']=$qty;
						   $request_item['RequestItem']['verify_remark']=$remarks;
						   
						   $this->Request->RequestItem->save($request_item);
						   
							
						 }
					   }
					}
				
				
				//Send email to manage and admin
				$request_info=$this->Request->find('first', array("conditions"=>array("Request.id"=>$id),"fields"=>array("Request.request_requestedby"),"recursive"=>"-1"));
				
				$this->loadModel('User');
				$users_info=$this->User->find("first",array("conditions"=>array("User.id"=>$request_info['Request']['request_requestedby'],"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				
				
				$emails=array();
				$emails[]=$users_info['User']['email'];
				$users_data=$this->User->find("all",array("conditions"=>array("User.role_id"=>array("1"),"User.status"=>"1"),"fields"=>array("User.email"),"recursive"=>"-1"));
				if(isset($users_data) && count($users_data)>0){
				  foreach($users_data as $user_row){
				    $emails[]=$user_row['User']['email'];
				  }
				}
				
				if($this->request->data['Request']['request_status']=='5'){
				 $email = $this->EmailTemplate->selectTemplate('requisition_request_returned_incomplete_email');
				}else {
				 $email = $this->EmailTemplate->selectTemplate('requisition_request_returned_ok_email');
				}
				
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $this->Auth->user("first_name") . ' ' . $this->Auth->user("last_name"),
                    '##SITE_NAME##' => Configure::read('site.name'),
                    '##SUPPORT_EMAIL##' => Configure::read('site.contactus_email'),
                    '##WEBSITE_URL##' => Router::url('/', true),
                    '##FROM_EMAIL##' => $this->User->changeFromEmail(($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from']),
                    '##SITE_LOGO##' => Router::url(array(
                        'controller' => 'img',
                        'action' => '/',
                        'logo-big.png',
                        'admin' => false
                            ), true),
                );

                $this->Email->from = ($email['from'] == '##FROM_EMAIL##') ? Configure::read('EmailTemplate.from_email') : $email['from'];
               // $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $emails;
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                $this->Email->send(strtr($email['description'], $emailFindReplace));
				
				
				if($this->request->is('ajax')){
					 $response['status']=1;
					 $response['message']=__('The request has been saved');
					 $response['redirect_url']=(isset($this->request->data['current_url']) && $this->request->data['current_url']!='')?$this->request->data['current_url']:'';
					 echo json_encode($response);
					 exit;
				}else{
				  $this->Session->setFlash(__('The request has been updated'));
				  $this->redirect(array('action' => 'requisitions'));
				}

			} else {
				$this->Session->setFlash(__('The request could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Request.' . $this->Request->primaryKey => $id));
			$this->request->data = $this->Request->find('first', $options);
			$this->request->data['Request']['request_eventfromdate']=(isset($this->request->data['Request']['request_eventfromdate']) && $this->request->data['Request']['request_eventfromdate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_eventfromdate'])):'';
			$this->request->data['Request']['event_todate']=(isset($this->request->data['Request']['event_todate']) && $this->request->data['Request']['event_todate']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['event_todate'])):'';
			$this->request->data['Request']['request_returnto']=(isset($this->request->data['Request']['request_returnto']) && $this->request->data['Request']['request_returnto']!='0000-00-00')?date('m/d/Y',strtotime($this->request->data['Request']['request_returnto'])):'';
			if($this->request->data['Request']['request_for']=='event'){
			 $this->request->data['Request']['event_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}else{
			 $this->request->data['Request']['gallery_collectiondate']=(isset($this->request->data['Request']['collectiondate']) && $this->request->data['Request']['collectiondate']!='')?date('m/d/Y',strtotime($this->request->data['Request']['collectiondate'])):'';
			}
			
			$this->request->data['Request']['other_text']=(isset($this->request->data['Request']['gallery_other_text']) && $this->request->data['Request']['gallery_other_text']!='')?$this->request->data['Request']['gallery_other_text']:'';
			
			
			
		}
		
		
		
		$this->loadModel('Category');
	
		$this->Request->RequestItem->bindModel(array(
                   	'belongsTo' => array('Item'),
                ),false);
				
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $category_items=$this->Request->RequestItem->find("all",array("conditions"=>array("RequestItem.category_id"=>$cat_key,"RequestItem.request_id"=>$id)));
		 
		  if(count($category_items)>0){
			  $items_data[$i]['category_id']=$cat_key;
			  $items_data[$i]['category_name']=$cat_val;
			  $k=0;
			  foreach($category_items as $cat_item){
			   $items_data[$i]['items'][$k]['Item']['id']=$cat_item['RequestItem']['item_id'];
			   $items_data[$i]['items'][$k]['Item']['request_item_id']=$cat_item['RequestItem']['id'];
			   $items_data[$i]['items'][$k]['Item']['item_serialno']=$cat_item['Item']['item_serialno'];
			   $items_data[$i]['items'][$k]['Item']['item_name']=$cat_item['Item']['item_name'];
			   $items_data[$i]['items'][$k]['Item']['item_stocklevel']=$cat_item['Item']['item_stocklevel'];
			   $items_data[$i]['items'][$k]['Item']['item_measurementunit']=$cat_item['Item']['item_measurementunit'];
			   $items_data[$i]['items'][$k]['Item']['item_photo']=$cat_item['Item']['item_photo'];
			   $items_data[$i]['items'][$k]['Item']['item_unitprice']=$cat_item['Item']['item_unitprice'];
			   $items_data[$i]['items'][$k]['Item']['item_isasset']=$cat_item['Item']['item_isasset'];
			   $items_data[$i]['items'][$k]['Item']['item_iscollateral']=$cat_item['Item']['item_iscollateral'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantity']=$cat_item['RequestItem']['reqitem_quantity'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityapproved']=$cat_item['RequestItem']['reqitem_quantityapproved'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantitycollected']=$cat_item['RequestItem']['reqitem_quantitycollected'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityreturned']=$cat_item['RequestItem']['reqitem_quantityreturned'];
			   $items_data[$i]['items'][$k]['Item']['reqitem_quantityverified']=$cat_item['RequestItem']['reqitem_quantityverified'];
			   $items_data[$i]['items'][$k]['Item']['collect_remark']=$cat_item['RequestItem']['collect_remark'];
			   $items_data[$i]['items'][$k]['Item']['return_remark']=$cat_item['RequestItem']['return_remark'];
			   $items_data[$i]['items'][$k]['Item']['verify_remark']=$cat_item['RequestItem']['verify_remark'];
			   
			   $k++;
			  }
			  
			  $i++;
		  }
		}
		
		
		
		
		$galleries=$this->Request->Gallery->find('list',array("conditions"=>array("Gallery.status"=>'1')));
		$this->set(compact('galleries','items_data'));

	}
	
	public function admin_inventory_report() {
		if($this->request->is('ajax')){
		 $this->layout='ajax';
		}
		$response=array();
		
		if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'inventory_report', 'is_read'))
		{
	   		$this->Session->setFlash(__('You are not authorised to access that location'));
	    	$this->redirect(array('controller'=>"users",'action' => 'dashboard'));
		}
		
		
		$this->loadModel('Category');
		
		$this->loadModel('Item');
	
		$this->Request->RequestItem->bindModel(array(
                   	'belongsTo' => array('Request')
					
                ),false);
		$this->Request->RequestGallery->bindModel(array(
                   	'belongsTo' => array('Gallery')
					
                ),false);
				
		$categories=$this->Category->find('list',array("conditions"=>array("Category.status"=>'1')));
		$items_data=array();
		$i=0;
		foreach($categories as $cat_key=>$cat_val){
		  $category_items=$this->Item->find("all",array("conditions"=>array("Item.category_id"=>$cat_key)));
		  
		  if(count($category_items)>0){
			  $items_data[$i]['category_id']=$cat_key;
			  $items_data[$i]['category_name']=$cat_val;
			  $k=0;
			  foreach($category_items as $cat_item){
			       $request_data=$this->Request->RequestItem->find("first",array("conditions"=>array("RequestItem.item_id"=>$cat_item['Item']['id'],"Request.request_status"=>'3'),'order'=>'Request.id DESC'));
				   
				   
				   if(isset($request_data['Request']['request_for']) && $request_data['Request']['request_for']=='gallery'){
				     $galleries=$this->Request->RequestGallery->find("all",array("conditions"=>array("RequestGallery.request_id"=>$request_data['Request']['id'])));
					 $gal_str='';
					 foreach($galleries as $gallery){
					   if($gallery['Gallery']['id']=='10'){
					    $gal_str.=$gallery['Gallery']['name'].'('.$request_data['Request']['gallery_other_text'].'), ';
					   }else{
					    $gal_str.=$gallery['Gallery']['name'].', ';
					   }
					 }
					 $current_location=$gal_str;
					 
					 
				   }elseif(isset($request_data['Request']['request_for']) && $request_data['Request']['request_for']=='event'){
				     $current_location=$request_data['Request']['event_name'];
				   }else{
				     $current_location='';
				   }
				  
				   $items_data[$i]['items'][$k]['Item']['id']=$cat_item['Item']['id'];
				   $items_data[$i]['items'][$k]['Item']['item_serialno']=$cat_item['Item']['item_serialno'];
				   $items_data[$i]['items'][$k]['Item']['item_name']=$cat_item['Item']['item_name'];
				   $items_data[$i]['items'][$k]['Item']['item_stocklevel']=$cat_item['Item']['item_stocklevel'];
				   $items_data[$i]['items'][$k]['Item']['item_measurementunit']=$cat_item['Item']['item_measurementunit'];
				   $items_data[$i]['items'][$k]['Item']['item_photo']=$cat_item['Item']['item_photo'];
				   $items_data[$i]['items'][$k]['Item']['item_unitprice']=$cat_item['Item']['item_unitprice'];
				   $items_data[$i]['items'][$k]['Item']['item_isasset']=$cat_item['Item']['item_isasset'];
				   $items_data[$i]['items'][$k]['Item']['item_iscollateral']=$cat_item['Item']['item_iscollateral'];
				   $items_data[$i]['items'][$k]['Item']['current_location']=$current_location;
				
				   $k++;
			  }
			  
			  $i++;
		  }
		}
		 
		$this->set(compact('items_data'));

	}


}
