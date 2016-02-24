<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 */
class ProductsController extends AppController {

public $components = array(
			'Default',
			'Paypal','Email',			
		   );
 public $uses=array("Product","Page","Order","Coupon","Promo","Country","State","Shipping");
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Product->recursive = 0;
		/*pr($this->params);
		exit;*/
		$conditions=array();
		if(isset($this->params['car_alias']) && $this->params['car_alias']!=''){
		  $conditions['Category.alias']=$this->params['car_alias'];
		}
		$this->paginate=array("conditions"=>$conditions);
		$this->set('products', $this->paginate());
	}
	public function search() {
		$this->Product->recursive = 0;
		
		$conditions=array();
		if(isset($this->request->data['Product']['search']) && $this->request->data['Product']['search']!=''){
		  $conditions['Product.name LIKE ']='%'.$this->request->data['Product']['search'].'%';
		}
		$this->paginate=array("conditions"=>$conditions);
		$this->set('products', $this->paginate());
	}
	public function home() {
		$this->Product->recursive = 0;
		$this->paginate=array("conditions"=>array("Product.status"=>"1"),"order"=>array("Product.created DESC"),"limit"=>"9");
		$this->set('products', $this->paginate());
		$featured_products=$this->Product->find("all",array("conditions"=>array("Product.is_featured"=>"1","Product.status"=>"1")));
		$this->set('featured_products', $featured_products);
		$this->Product->PromoProduct->bindModel(
		 array('belongsTo' => array(
		   'Promo' => array(
			'className' => 'Promo',
			'foreignKey' => 'promo_id',
		   ),
		    'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
		   )
		  )
		 )
		);
		$special_offers=$this->Product->PromoProduct->find("all",array("conditions"=>array("Promo.status"=>"1"),"group"=>"PromoProduct.product_id"));
		/*pr($special_offers);
		exit;*/
		$shipping_offers=$this->Shipping->find("all",array("conditions"=>array("Shipping.status"=>"1")));
		
		$this->set('special_offers', $special_offers);
		$this->set('shipping_offers', $shipping_offers);
		
		
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
	$products=$this->Product->find("first",array("conditions"=>array("Product.alias"=>$this->params['alias']),"fields"=>array("Product.id"),"recursive"=>"-1"));
		$this->Product->id = $products['Product']['id'];
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		/*pr($this->Product->read(null, $products['Product']['id']));
		exit;*/
		$this->Product->PromoProduct->bindModel(
		 array('belongsTo' => array(
		   'Promo' => array(
			'className' => 'Promo',
			'foreignKey' => 'promo_id',
		   ),
		    'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
		   )
		  )
		 )
		);
		$promo_data=$this->Product->PromoProduct->find('all',array("conditions"=>array("Promo.status"=>'1',"PromoProduct.product_id"=>$products['Product']['id'])));
		
		
		$this->set('product', $this->Product->read(null, $products['Product']['id']));
		$this->set('promo_data', $promo_data);
	}
	
  public function addtocart($id){
	     $this->autoRender=false;
	     $sid=   $this->Session->read('sessID');
		 $qty=1;
		 $this->Product->clearcart(2);
		 $cart_id=$this->Product->getcartid($sid);
		 $this->Product->addtocart($cart_id,$id,$this->params['named']['name'],$qty);
		 $this->Session->setFlash(__('Successfully Added to cart'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
		
		 
	}
  public function viewcart($cart_id=NULL){
   $sid=$this->Session->read('sessID');
   App::Import("Model","Cart");
   $carobj=new Cart();
   $carobj->bindModel(array('belongsTo' => array('Coupon','Promo'))); 
   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
   if(count($carts)>0) {
    $cartdetails=$this->Product->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
   } else {
    $cartdetails=array();
   }
   $qty=0;
   if(count($cartdetails)>0){
    foreach($cartdetails as $cartdetail){
	 $qty+=$cartdetail['Cartdetail']['qty'];
	}
   }
      
   if ($this->request->is('post')) {
     
	 if(isset($this->request->data['Viewcart']['coupon_code']) && $this->request->data['Viewcart']['coupon_code']!=''){
	  if(empty($carts['Coupon']['id'])) { 
		   $coupon_data=$this->Coupon->find('first',array("conditions"=>array("Coupon.code"=>$this->request->data['Viewcart']['coupon_code'],"Coupon.date_start <"=>date('Y-m-d'),"Coupon.date_end >="=>date('Y-m-d'),"Coupon.status"=>'1')));
		   		   
		   if(!empty($coupon_data)){
			  $carobj->updateAll(array('Cart.coupon_id'=>"'".$coupon_data['Coupon']['id']."'"),array('Cart.sessionid'=> $sid));
			  $this->Session->setFlash(__('Coupon discount is added successfully'),"default",array("class"=>"success"));
			  $this->redirect(array('action' => 'viewcart'));
		   
		   } else {
			 $this->Session->setFlash(__('Coupon code is not valid'),"default",array("class"=>"error"));
			 $this->redirect(array('action' => 'viewcart'));
		   }
	  } else {
	     $this->Session->setFlash(__('Coupon code is already used'),"default",array("class"=>"error"));
		 $this->redirect(array('action' => 'viewcart'));
	  }
	 } elseif(isset($this->request->data['Viewcart']['promo_code']) && $this->request->data['Viewcart']['promo_code']!=''){
	 if(empty($carts['Promo']['id'])) { 
	    $promo_data=$this->Promo->find('first',array("conditions"=>array("Promo.code"=>$this->request->data['Viewcart']['promo_code'],"Promo.date_start <"=>date('Y-m-d'),"Promo.date_end >="=>date('Y-m-d'),"Promo.status"=>'1')));
		 
		 
		 $promo_product=array();
		 $cart_product=array();
		 if(isset($promo_data['PromoProduct']) && count($promo_data['PromoProduct'])>0){
		   foreach($promo_data['PromoProduct'] as $promo_prod) {
		    $promo_product[]=$promo_prod['product_id'];
		   }
		 }
		 if(isset($cartdetails) && count($cartdetails)>0){
		   foreach($cartdetails as $cart_prod) {
		    $cart_product[]=$cart_prod['Cartdetail']['product_id'];
		   }
		 }
				 
		$is_valid=0;
		
		if(count($promo_product)>0){
		 foreach($promo_product as $key=>$val){
		   if(in_array($val,$cart_product)){
		     $is_valid=1;
			 
		   }
		 }
		}
		
		   if(!empty($promo_data) && $is_valid==1){
		     if($qty>=$promo_data['Promo']['buy_required_qty']) {
			  $carobj->updateAll(array('Cart.promo_id'=>"'".$promo_data['Promo']['id']."'"),array('Cart.sessionid'=> $sid));
			  $this->Session->setFlash(__('Promo discount is added successfully'),"default",array("class"=>"success"));
			  $this->redirect(array('action' => 'viewcart'));
			 }else {
			   $this->Session->setFlash(__('Please purchase atleast '.$promo_data['Promo']['buy_required_qty'].' to apply promo code'),"default",array("class"=>"error"));
			   $this->redirect(array('action' => 'viewcart'));
			 }
		   
		   } else {
			 $this->Session->setFlash(__('Promo code is not valid'),"default",array("class"=>"error"));
			 $this->redirect(array('action' => 'viewcart'));
		   }
	    } else{
	      $this->Session->setFlash(__('Promo code is already used'),"default",array("class"=>"error"));
		  $this->redirect(array('action' => 'viewcart'));
	    }
	 }
	 
	 if($this->request->data['Viewcart']['action']=='update'){
	   $i=0;
	   foreach($this->request->data['Viewcart']['qty'] as $val){
	    $this->Product->Cartdetail->updateAll(array('Cartdetail.qty'=>"'".$val."'"),array('Cartdetail.id'=> $this->request->data['Viewcart']['cart_id'][$i]));
		$i++;
		 
	   }
	     $this->Session->setFlash(__('Record update successfully'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
	 }
	 
   }
   
	 if(!empty($cart_id)){
	       	$i=0;
			$this->Product->Cartdetail->id = $cart_id;
			if (!$this->Product->Cartdetail->exists()) {
				throw new NotFoundException(__('Invalid cardetail'),"default",array("class"=>"error"));
			}
		 $this->Product->Cartdetail->delete();
	     $this->Session->setFlash(__('Record deleted successfully'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
	 }
    
   $this->set(compact('cartdetails','carts'));
  }
  
  public function checkout(){
   
   $sid=$this->Session->read('sessID');
   App::Import("Model","Cart");
   $carobj=new Cart();
    $carobj->bindModel(array('belongsTo' => array('Coupon','Promo'))); 
	
   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
  
   
   if(count($carts)>0) {
    $cartdetails=$this->Product->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
   } else {
       $this->Session->setFlash(__('No Item in your cart'));
	   $this->redirect(array('action' => 'viewcart'));
   }
   
   if(empty($cartdetails)){
       $this->Session->setFlash(__('No Item in your cart'));
	   $this->redirect(array('action' => 'viewcart'));
   }
   
   $countries = $this->Country->find('list');
   if($this->Auth->User('country_id')!='') {
    $states = $this->State->find('list',array("conditions"=>array("State.country_id"=>$this->Auth->User('country_id'))));
   } else {
    $states = $this->State->find('list');
   }
   
   $cardcountries = $this->Country->find('list');
   $cardstates = $this->State->find('list');
   
   $pagedata = $this->Page->find('first',array("conditions"=>array("Page.alias"=>"secure-checkout")));

   $this->set(compact('cartdetails','countries','states','carts','cardcountries','cardstates','pagedata'));
   	
  }
  
  public function confirm(){
    if ($this->request->is('post')) {
	 
	  
		   $sid=$this->Session->read('sessID');
		   App::Import("Model","Cart");
		   $carobj=new Cart();
		   $carobj->bindModel(array('belongsTo' => array('Coupon','Promo'))); 
		   
		   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
		   $cartdetails=$this->Product->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
		   
       
		
		$user_id=$this->Auth->User('id');
		
		if(isset($this->request->data['Product']['user_type']) && $this->request->data['Product']['user_type']=='register'){
		  $data['User']['username']=$this->request->data['Product']['first_name'].' '.$this->request->data['Product']['last_name'];
		  $data['User']['email']=$this->request->data['Product']['email'];
		  $data['User']['password']=$this->request->data['Product']['password'];
		  $data['User']['phone']=$this->request->data['Product']['phone'];
		  $data['User']['address']=$this->request->data['Product']['address'];
		  $data['User']['zip']=$this->request->data['Product']['zip'];
		  $data['User']['country_id']=$this->request->data['Product']['country_id'];
		  $data['User']['state_id']=$this->request->data['Product']['state_id'];
		  $data['User']['city']=$this->request->data['Product']['city'];
		  $data['User']['role_id']='2';
		  $data['User']['status']='1';
		  
		  $this->Product->User->create();
		  $this->Product->User->save($data);
		  $user_id=$this->Product->User->id;
		}
		//Save the order table data 
		
		$shipping_arr=$this->Product->CheckShipping($this->request->data['Product']['amount']);
		if($shipping_arr['shipping']==1) {
		 $shipping_charges=$shipping_arr['charges'];
		}else{
		 $shipping_charges=0;
		}
		
		 $user_id=(isset($user_id) && $user_id!='')?$user_id:0;
		 
		  $data_order['Order']['user_id']=$user_id;
		  $data_order['Order']['coupon_id']=(isset($this->request->data['Product']['coupon_id']) && $this->request->data['Product']['coupon_id']!='')?$this->request->data['Product']['coupon_id']:0;
		  $data_order['Order']['promo_id']=(isset($this->request->data['Product']['promo_id']) && $this->request->data['Product']['promo_id']!='')?$this->request->data['Product']['promo_id']:0;
		  $data_order['Order']['shipping_charges']=$shipping_charges;
		  
		  $data_order['Order']['email']=$this->request->data['Product']['email'];
		  $data_order['Order']['first_name']=$this->request->data['Product']['first_name'];
		  $data_order['Order']['last_name']=$this->request->data['Product']['last_name'];
		  $data_order['Order']['phone']=$this->request->data['Product']['phone'];
		  $data_order['Order']['address']=$this->request->data['Product']['address'];
		  $data_order['Order']['zip']=$this->request->data['Product']['zip'];
		  $data_order['Order']['country_id']=$this->request->data['Product']['country_id'];
		  $data_order['Order']['state_id']=$this->request->data['Product']['state_id'];
		   $data_order['Order']['cardcountry_id']=$this->request->data['Product']['cardcountry_id'];
		  $data_order['Order']['cardstate_id']=$this->request->data['Product']['cardstate_id'];
		  $data_order['Order']['city']=$this->request->data['Product']['city'];
		  $data_order['Order']['card_city']=$this->request->data['Product']['card_city'];
		  $data_order['Order']['amount']=$this->request->data['Product']['amount'];
		  
		   $data_order['Order']['card_type']=$this->request->data['Product']['card_type'];
		   $data_order['Order']['card_number']=$this->request->data['Product']['card_number'];
		   $data_order['Order']['expiry_month']=$this->request->data['Product']['expiration'];
		   $data_order['Order']['expiry_year']=$this->request->data['Product']['expiry_year'];
		   $data_order['Order']['ccvn']=$this->request->data['Product']['ccvn'];
		   $data_order['Order']['card_zip']=$this->request->data['Product']['card_zip'];
		   $data_order['Order']['card_address']=$this->request->data['Product']['card_address'];
			  
		  $data_order['Order']['status']='1';
		 
		  $this->Order->create();
		  $this->Order->save($data_order);
		  $order_id=$this->Order->id;
		  
		  if(count($cartdetails)>0){
		   foreach($cartdetails as $cartdetail){
		      $data_orderdetails=array();
		      $data_orderdetails['OrderDetail']['order_id']=$order_id;
			  $data_orderdetails['OrderDetail']['product_id']=$cartdetail['Product']['id'];
			  $data_orderdetails['OrderDetail']['name']=$cartdetail['Product']['name'];
			  $data_orderdetails['OrderDetail']['qty']=$cartdetail['Cartdetail']['qty'];
			  $data_orderdetails['OrderDetail']['price']=$cartdetail['Product']['price'];
			  $data_orderdetails['OrderDetail']['currency']='USD';
			  $data_orderdetails['OrderDetail']['status']='1';
			  
			  $this->Product->updateAll(
                    array('Product.max_qty' => "Product.max_qty-1"), array('Product.id'=>$cartdetail['Product']['id'])
              );
			  
			  $this->Order->OrderDetail->create();
		      $this->Order->OrderDetail->save($data_orderdetails);
			  
		   }
		  }
		  
		  $carobj->Cartdetail->deleteAll(array('Cartdetail.cart_id' => $carts['Cart']['id']), false);
		  $carobj->deleteAll(array('Cart.id' => $carts['Cart']['id']), false);
		  
		  $this->Session->setFlash(__('Your Order is successfully completed'),'default',array("class"=>"success"));
		  $this->redirect(array('action' => 'success',$order_id));
		
	}
   }
  
  public function remindme(){
    if ($this->request->is('post')) {
	
	        $this->Product->Remind->create();
			
			if ($this->Product->Remind->save($this->request->data)) {
				$this->Session->setFlash(__('Reminder set successfully'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'home'));
			} else {
				$this->Session->setFlash(__('The reminder could not be saved. Please, try again.'),'default',array("class"=>"error"));
				$this->redirect(array('action' => 'home'));
			}
	  
	}
  }
  public function success($id){
    $this->Order->id = $id;
	$order=$this->Order->read(null, $id);
	
	$this->set(compact('order'));
	$this->Email->from = Configure::read('Site.admin_email');
	$this->Email->to = $order['Order']['email'];
	$this->Email->subject = __('iphoneparts.com Order mail');
	$this->Email->sendAs = 'html';
	$this->Email->template = 'order';
	$this->Email->send();
				
    $this->set('order', $this->Order->read(null, $id));
	
   }
   

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Product->Category->find('list');
		$users = $this->Product->User->find('list');
		$promos = $this->Product->Promo->find('list');
		$this->set(compact('categories', 'users', 'promos'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Product->read(null, $id);
		}
		$categories = $this->Product->Category->find('list');
		$users = $this->Product->User->find('list');
		$promos = $this->Product->Promo->find('list');
		$this->set(compact('categories', 'users', 'promos'));
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$active_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"1")));
		$inactive_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"0")));
		$total_pages=$this->Product->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
		
		$this->set('products', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->set('product', $this->Product->read(null, $id));
		$active_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"1")));
		$inactive_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"0")));
		$total_pages=$this->Product->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			$this->request->data['Product']['alias']=$this->Default->Cleanstring($this->request->data['Product']['name']);
			
			if ($this->Product->save($this->request->data)) {
			  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Product']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/products/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/products/'.$filename);
				$this->Product->updateAll(
                    array('Product.image' => "'" . $filename . "'"), array('Product.id'=>$this->Product->id)
                );
			  }
			  
				$this->Session->setFlash(__('The product has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		}
		$categories = $this->Product->Category->find('list');
		$users = $this->Product->User->find('list');
		$promos = $this->Product->Promo->find('list');
		$this->set(compact('categories', 'users', 'promos'));
		$active_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"1")));
		$inactive_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"0")));
		$total_pages=$this->Product->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		  $this->request->data['Product']['alias']=$this->Default->Cleanstring($this->request->data['Product']['name']);
		  
			if ($this->Product->save($this->request->data)) {
			  
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Product']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/products/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/products/'.$filename);
				$this->Product->updateAll(
                    array('Product.image' => "'" . $filename . "'"), array('Product.id'=>$this->Product->id)
                );
			  }
			
				$this->Session->setFlash(__('The product has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		} else {
			$this->request->data = $this->Product->read(null, $id);
		}
		$categories = $this->Product->Category->find('list');
		$users = $this->Product->User->find('list');
		$promos = $this->Product->Promo->find('list');
		$this->set(compact('categories', 'users', 'promos'));
		$active_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"1")));
		$inactive_pages=$this->Product->find('count',array("conditions"=>array("Product.status"=>"0")));
		$total_pages=$this->Product->find('count');
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
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('Product deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Product was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_productimages() {
		$this->Product->recursive = 0;
		
		$this->paginate=array("conditions"=>array("ProductImage.product_id"=>$this->params['pass'][0]));
		$this->set('carimages', $this->paginate('ProductImage'));
		
		
	}
	function admin_productimageadd(){
	  if ($this->request->is('post')) {
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Product->ProductImage->create();
			$this->request->data['ProductImage']['product_id']=$this->params['pass'][0];
			
			
			if ($this->Product->ProductImage->save($this->request->data)) {
			   $products=$this->Product->find("first",array("conditions"=>array("Product.id"=>$this->params['pass'][0])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$products['Product']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/products/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/products/'.$filename);
				$this->Product->ProductImage->updateAll(
                    array('ProductImage.image' => "'" . $filename . "'"), array('ProductImage.id'=>$this->ProductImage->id)
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The Product Images has been saved'));
				$this->redirect(array('action' => 'productimages',$this->params['pass'][0]));
			} else {
				$this->Session->setFlash(__('The product images could not be saved. Please, try again.'));
			}
		  } else {
		   $this->Session->setFlash(__('The product images could not be saved. Please, try again.'));
		  }
		}
	}
	
	function admin_productimageedit($id = null){
	  $this->Product->ProductImage->id = $id;
		if (!$this->Product->ProductImage->exists()) {
			throw new NotFoundException(__('Invalid Product Image'));
		}
		
	  if ($this->request->is('post')) {
	  
	 
			
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Product->ProductImage->create();
			$this->request->data['ProductImage']['product_id']=$this->params['named']['product_id'];
			
			if ($this->Product->ProductImage->save($this->request->data)) {
			   $products=$this->Product->find("first",array("conditions"=>array("Product.id"=>$this->params['named']['product_id'])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$products['Product']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/products/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/products/'.$filename);
				$this->Product->ProductImage->updateAll(
                    array('ProductImage.image' => "'" . $filename . "'"), array('ProductImage.id'=>$this->request->data['ProductImage']['id'])
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The Product Image has been saved'));
				$this->redirect(array('action' => 'productimages',$this->params['named']['product_id']));
			} else {
				$this->Session->setFlash(__('The product image could not be saved. Please, try again.'));
			}
		  } else {
		   $this->Session->setFlash(__('The product image could not be saved. Please, try again.'));
		  }
		}
	}
	public function admin_productimagedelete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Product->ProductImage->id = $id;
		if (!$this->Product->ProductImage->exists()) {
			throw new NotFoundException(__('Invalid Product image'),'default',array("class"=>"error"));
		}
		if ($this->Product->ProductImage->delete()) {
			$this->Session->setFlash(__('Product image deleted'),'default',array("class"=>"success"));
			$this->redirect(array('action' => 'productimages',$this->params['named']['product_id']));
		}
		$this->Session->setFlash(__('Product Image was not deleted'));
		$this->redirect(array('action' => 'productimages',$this->params['named']['product_id']),'default',array("class"=>"error"));
	}
}
