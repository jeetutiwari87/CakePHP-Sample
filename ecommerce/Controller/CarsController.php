<?php
App::uses('AppController', 'Controller');
/**
 * Cars Controller
 *
 * @property Car $Car
 */
class CarsController extends AppController {

public $components = array(
			'Default',
			'Paypal','Email',			
		   );
 public $uses=array("Car","Testimonial","Page","Order");
/**
 * index method
 *
 * @return void
 */
    public function home() {
		$this->Car->recursive = 0;
		$paginate=array("conditions"=>array("Car.is_featured"=>"1"));
		
		$this->set('cars', $this->paginate());
		$top_makes=$this->Car->Make->find("all",array("conditions"=>array("Make.status"=>"1"),"fields"=>array("Make.name","Make.alias"),"limit"=>"10"));
		$top_models=$this->Car->CarModel->find("all",array("conditions"=>array("CarModel.status"=>"1"),"fields"=>array("CarModel.name","CarModel.alias"),"limit"=>"10"));
		$top_states=$this->Car->State->find("all",array("conditions"=>array("State.status"=>"1"),"fields"=>array("State.name","State.code"),"limit"=>"10"));
		$testimonials=$this->Testimonial->find("all",array("Order"=>"Testimonial.created DESC"));
		$sellcar_page=$this->Page->find("first",array("conditions"=>array("Page.alias"=>"sell-your-car")));
		
		$makes=$this->Car->Make->find("list",array("conditions"=>array("Make.status"=>"1")));
		$years=array();
		 for($i=1985;$i<=date('Y');$i++){
		  $years[$i]=$i;
		 }
		$this->set(compact('top_makes','top_models','top_states','testimonials','makes','sellcar_page','years'));
	}
	
	public function index() {
		$this->Car->recursive = 0;
		
		
		
		
		$params=array();
		if(isset($this->params['car_alias']) && $this->params['car_alias']!=''){
		  $matches=explode("+", $this->params['car_alias']);
		 	  
		  for($i=0;$i<count($matches);) {
		   $params[$matches[$i]]=(isset($matches[$i+1]))?$matches[$i+1]:'';
		   $i=$i+2;
		  }
		}
		
		$params_arr=array();
		$conditions=array();
		if(isset($params['make']) && $params['make']!=''){
		  $conditions['Make.alias']=$params['make'];
		  $params_arr=array_merge($params_arr,array("make"=>$params['make']));
		}
		
		if(isset($params['model']) && $params['model']!=''){
		  $conditions['CarModel.alias']=$params['model'];
		  $params_arr=array_merge($params_arr,array("model"=>$params['model']));
		}
		if(isset($params['bodystyle']) && $params['bodystyle']!=''){
		  $conditions['Bodystyle.alias']=$params['bodystyle'];
		  $params_arr=array_merge($params_arr,array("bodystyle"=>$params['bodystyle']));
		}
		
		if(isset($params['extcolor']) && $params['extcolor']!=''){
		  $conditions['ExteriorColor.alias']=$params['extcolor'];
		  $params_arr=array_merge($params_arr,array("extcolor"=>$params['extcolor']));
		}
		
		if(isset($params['intcolor']) && $params['intcolor']!=''){
		  $conditions['InteriorColor.alias']=$params['intcolor'];
		  $params_arr=array_merge($params_arr,array("intcolor"=>$params['intcolor']));
		}
		if(isset($params['year']) && $params['year']!=''){
		  $conditions['YEAR(Car.created)']=$params['year'];
		  $params_arr=array_merge($params_arr,array("year"=>$params['year']));
		}
		if(isset($params['transmission']) && $params['transmission']!=''){
		  $conditions['Car.transmission']=$params['transmission'];
		  $params_arr=array_merge($params_arr,array("transmission"=>$params['transmission']));
		}
		
		if(isset($params['state']) && $params['state']!=''){
		  $conditions['State.code']=$params['state'];
		  $params_arr=array_merge($params_arr,array("state"=>$params['state']));
		}
		
		if(isset($this->request->data['Car']['make_id']) && $this->request->data['Car']['make_id']!=''){
		 $conditions['Car.make_id']=$this->request->data['Car']['make_id'];
		 $params_arr=array("make"=>$this->request->data['Car']['make_id']);
		}
		
		if(isset($this->request->data['Car']['car_model_id']) && $this->request->data['Car']['car_model_id']!=''){
		 $conditions['Car.car_model_id']=$this->request->data['Car']['car_model_id'];
		 $params_arr=array_merge($params_arr,array("model"=>$this->request->data['Car']['model_id']));
		}
		if(isset($this->request->data['Car']['zip']) && $this->request->data['Car']['zip']!='-- Please enter zip code --'){
		 $conditions['Car.zip']=$this->request->data['Car']['zip'];
		 $params_arr=array_merge($params_arr,array("zip"=>$this->request->data['Car']['zip']));
		}
		
		if(preg_match("/page:[0-9]/",$this->request->url,$matches)){
		 $page=str_replace("page:","",$matches[0]);
		 $params_arr=array_merge($params_arr,array("page"=>$page));
		}
		
		$this->params['named']=$params_arr;
	
	
		$this->paginate=array("conditions"=>$conditions);
		$this->set('cars', $this->paginate());
		
		$left_makes=$this->Car->Make->find("all",array("conditions"=>array("Make.status"=>"1"),"fields"=>array("Make.name","Make.alias","Make.id")));
		$left_models=$this->Car->CarModel->find("all",array("conditions"=>array("CarModel.status"=>"1"),"fields"=>array("CarModel.name","CarModel.alias","CarModel.id"),"recursive"=>"-1"));
		$left_bodystyles=$this->Car->Bodystyle->find("all",array("conditions"=>array("Bodystyle.status"=>"1"),"fields"=>array("Bodystyle.name","Bodystyle.alias","Bodystyle.id"),"recursive"=>"-1"));
		$left_extcolors=$this->Car->ExteriorColor->find("all",array("conditions"=>array("ExteriorColor.status"=>"1","ExteriorColor.color_type"=>"Exterior"),"fields"=>array("ExteriorColor.name","ExteriorColor.alias","ExteriorColor.id"),"recursive"=>"-1"));
		$left_intcolors=$this->Car->InteriorColor->find("all",array("conditions"=>array("InteriorColor.status"=>"1","InteriorColor.color_type"=>"Interior"),"fields"=>array("InteriorColor.name","InteriorColor.alias","InteriorColor.id"),"recursive"=>"-1"));
		
		$left_states=$this->Car->find("all",array("conditions"=>array("Car.status"=>"1"),"fields"=>array("State.name","State.code","State.id"),"group"=>array("Car.state_id")));
		
		$left_years=$this->Car->find("all",array("conditions"=>array("Car.status"=>"1"),"fields"=>array("YEAR(Car.created) as year"),"group"=>array("YEAR(Car.created)")));
		
		
		$this->set(compact('left_makes','left_models','left_bodystyles','left_extcolors','left_intcolors','left_states','left_years'));
	}
	
	public function listing(){
	    
	    $conditions['Car.user_id']=$this->Auth->User('id');
		$conditions['Car.status']='1';
		
	    $this->paginate=array("conditions"=>$conditions);
		$this->set('cars', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view() {
	    $cars=$this->Car->find("first",array("conditions"=>array("Car.alias"=>$this->params['alias']),"fields"=>array("Car.id"),"recursive"=>"-1"));
				
		$this->Car->id = $cars['Car']['id'];
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		$page=$this->Page->find("first",array("conditions"=>array("Page.alias"=>"detail-page-introduction-text")));
		$this->set('page', $page);
		$cardetails=$this->Car->read(null, $cars['Car']['id']);
		$this->set('car', $this->Car->read(null, $cars['Car']['id']));
		if ($this->request->is('post')) {
		        $html='';
				$html.='Hello '.$cardetails['User']['username'].' ,	<br /> Please check the enquiry notification<br>Userame: '.$this->request['Car']['first_name'].' '.$this->request['Car']['last_name'].'<br />Phone:'.$this->request['Car']['phone'].'<br />Message: '.$this->request['Car']['message'].'<br /><br />Thanks<br />ownerfinancecars.com team';	
		        $this->Email->from = 'admin@admin.com';
				$this->Email->to = $cardetails['User']['email'];
				$this->Email->sendAs = 'html';
				$this->Email->subject = __('ownerfinancecars.com Dealer Notification');
				$this->Email->send($html);
				
				if(isset($this->request['Car']['copy_mail']) && $this->request['Car']['copy_mail']==1){
				    $this->Email->from = $this->request['Car']['email'];
					$this->Email->to = 'admin@admin.com';
					$this->Email->sendAs = 'html';
					$this->Email->subject = __('ownerfinancecars.com Dealer Notification');
					$this->Email->send($html);
				}
							
				$this->Session->setFlash(__('Notification sent to dealer Successfully'), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => '/',"action"=>$cardetails['Car']['alias'].'.html'));
				
		}
		
	}
	
	public function addtocart($id){
	     $this->autoRender=false;
	     $sid=   $this->Session->read('sessID');
		 $qty=1;
		 $this->Car->clearcart(2);
		 $cart_id=$this->Car->getcartid($sid);
		 $this->Car->addtocart($cart_id,$id,$this->params['named']['name'],$qty);
		 $this->Session->setFlash(__('Successfully Added to cart'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
		
		 
	}
  public function viewcart($cart_id=NULL){
   if ($this->request->is('post')) {
    
	 if($this->request->data['Viewcart']['action']=='update'){
	   $i=0;
	   foreach($this->request->data['Viewcart']['qty'] as $val){
	    $this->Car->Cartdetail->updateAll(array('Cartdetail.qty'=>"'".$val."'"),array('Cartdetail.id'=> $this->request->data['Viewcart']['cart_id'][$i]));
		$i++;
		 
	   }
	    $this->Session->setFlash(__('Record update successfully'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
	 }
	 
   }
   
	 if(!empty($cart_id)){
	       	$i=0;
			$this->Car->Cartdetail->id = $cart_id;
			if (!$this->Car->Cartdetail->exists()) {
				throw new NotFoundException(__('Invalid cardetail'),"default",array("class"=>"error"));
			}
		 $this->Car->Cartdetail->delete();
	     $this->Session->setFlash(__('Record deleted successfully'),"default",array("class"=>"success"));
		 $this->redirect(array('action' => 'viewcart'));
	 }
  
   $sid=$this->Session->read('sessID');
   App::Import("Model","Cart");
   $carobj=new Cart();
   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
   if(count($carts)>0) {
    $cartdetails=$this->Car->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
   } else {
    $cartdetails=array();
   }
  
   $this->set(compact('cartdetails'));
  }
  
  public function checkout(){
   
   $sid=$this->Session->read('sessID');
   App::Import("Model","Cart");
   $carobj=new Cart();
   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
   if(count($carts)>0) {
    $cartdetails=$this->Car->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
   } else {
       $this->Session->setFlash(__('No Item in your cart'));
	   $this->redirect(array('action' => 'viewcart'));
   }
   
   if(empty($cartdetails)){
       $this->Session->setFlash(__('No Item in your cart'));
	   $this->redirect(array('action' => 'viewcart'));
   }
   
   $countries = $this->Car->Country->find('list');
   $states = $this->Car->State->find('list');

   $this->set(compact('cartdetails','countries','states'));
   	
  }
  
   public function confirm(){
    if ($this->request->is('post')) {
	 
	    $country_arr = $this->Car->Country->find('first',array("conditions"=>array("Country.id"=>$this->request->data['Car']['country_id'])));
	    $state_arr = $this->Car->State->find('first',array("conditions"=>array("State.id"=>$this->request->data['Car']['state_id'])));
		
		   $sid=$this->Session->read('sessID');
		   App::Import("Model","Cart");
		   $carobj=new Cart();
		   $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
		   $cartdetails=$this->Car->Cartdetail->find("all",array("conditions"=>array("Cartdetail.cart_id"=>$carts['Cart']['id']),"recursive"=>"2")); 
		   
     
	
	    $sender_info['API_UserName'] 			= 	'jeetut_1352051581_biz_api1.gmail.com';
		$sender_info['API_Password'] 			= 	'1352051616';
		$sender_info['API_Signature'] 			= 	'A5tprm6FI.ACh-wzk7qNE2xSOARYAxMXCEXFZUVfpnI5KKujidIEiDcx';
	    $sender_info['is_testmode'] 			= 	'1';
		$data_credit_card['firstName'] 			= 	$this->request->data['Car']['first_name'];
		$data_credit_card['lastName'] 			=	$this->request->data['Car']['last_name'];
		$data_credit_card['creditCardType']     = 	$this->request->data['Car']['card_type'];
		$data_credit_card['creditCardNumber'] 	= 	$this->request->data['Car']['card_number'];
		$data_credit_card['expDateMonth'] 		= 	$this->request->data['Car']['expiration'];
		$data_credit_card['expDateYear'] 		= 	$this->request->data['Car']['expiry_year'];
		$data_credit_card['cvv2Number'] 		= 	$this->request->data['Car']['CCVN'];
		$data_credit_card['address'] 			= 	$this->request->data['Car']['card_address'];
		$data_credit_card['city'] 				= 	$this->request->data['Car']['city'];
		$data_credit_card['state'] 				= 	$state_arr['State']['code'];
		$data_credit_card['zip'] 				= 	$this->request->data['Car']['card_zip'];
		$data_credit_card['country'] 			= 	$country_arr['Country']['iso_code_2'];
		$data_credit_card['paymentType'] 		= 	'Sale';
		$data_credit_card['amount'] 			= 	$this->request->data['Car']['amount'];
		
		$payment_response = $this->Paypal->doDirectPayment($data_credit_card, $sender_info);
		
		//if not success show error msg as it received from paypal
		if (!empty($payment_response) && $payment_response['ACK'] != 'Success') {
		
			$this->Session->setFlash($payment_response['L_LONGMESSAGE0'] , 'default', null, 'error');
			$this->redirect(array('action' => 'checkout'));
		}
		
		$user_id=$this->Auth->User('id');
		
		if(isset($this->request->data['Car']['user_type']) && $this->request->data['Car']['user_type']=='register'){
		  $data['User']['username']=$this->request->data['Car']['first_name'].' '.$this->request->data['Car']['last_name'];
		  $data['User']['email']=$this->request->data['Car']['email'];
		  $data['User']['password']=$this->request->data['Car']['password'];
		  $data['User']['phone']=$this->request->data['Car']['phone'];
		  $data['User']['address']=$this->request->data['Car']['address'];
		  $data['User']['zip']=$this->request->data['Car']['zip'];
		  $data['User']['country_id']=$this->request->data['Car']['country_id'];
		  $data['User']['state_id']=$this->request->data['Car']['state_id'];
		  $data['User']['city']=$this->request->data['Car']['city'];
		  $data['User']['role_id']='2';
		  $data['User']['status']='1';
		  
		  $this->Car->User->create();
		  $this->Car->User->save($data);
		  $user_id=$this->Car->User->id;
		}
		//Save the order table data 
		
		  $data_order['Order']['user_id']=$user_id;
		  $data_order['Order']['transactionid']=$payment_response['TRANSACTIONID'];
		  $data_order['Order']['correlationid']=$payment_response['CORRELATIONID'];
		  $data_order['Order']['email']=$this->request->data['Car']['email'];
		  $data_order['Order']['first_name']=$this->request->data['Car']['first_name'];
		  $data_order['Order']['last_name']=$this->request->data['Car']['last_name'];
		  $data_order['Order']['phone']=$this->request->data['Car']['phone'];
		  $data_order['Order']['address']=$this->request->data['Car']['address'];
		  $data_order['Order']['zip']=$this->request->data['Car']['zip'];
		  $data_order['Order']['country_id']=$this->request->data['Car']['country_id'];
		  $data_order['Order']['state_id']=$this->request->data['Car']['state_id'];
		  $data_order['Order']['city']=$this->request->data['Car']['city'];
		  $data_order['Order']['amount']=$this->request->data['Car']['amount'];
		  $data_order['Order']['status']='1';
		 
		  $this->Order->create();
		  $this->Order->save($data_order);
		  $order_id=$this->Order->id;
		  
		  if(count($cartdetails)>0){
		   foreach($cartdetails as $cartdetail){
		      $data_orderdetails=array();
		      $data_orderdetails['OrderDetail']['order_id']=$order_id;
			  $data_orderdetails['OrderDetail']['car_id']=$cartdetail['Car']['id'];
			  $data_orderdetails['OrderDetail']['name']=$cartdetail['Car']['name'];
			  $data_orderdetails['OrderDetail']['qty']=$cartdetail['Cartdetail']['qty'];
			  $data_orderdetails['OrderDetail']['price']=$cartdetail['Car']['price'];
			  $data_orderdetails['OrderDetail']['currency']='USD';
			  $data_orderdetails['OrderDetail']['status']='1';
			  
			  $this->Order->OrderDetail->create();
		      $this->Order->OrderDetail->save($data_orderdetails);
			  
		   }
		  }
		  
		  $carobj->Cartdetail->deleteAll(array('Cartdetail.cart_id' => $carts['Cart']['id']), false);
		  $carobj->deleteAll(array('Cart.id' => $carts['Cart']['id']), false);
		  
		  $this->Session->setFlash(__('Your Order is successfully completed'),'default',array("class"=>"success"));
		  $this->redirect(array('action' => 'success'));
		
	}
   }
   
   public function success(){
   
   }
/**
 * add method
 *
 * @return void
 */
	public function add() {
	$user=$this->Car->User->find("first",array("conditions"=>array("User.id"=>$this->Auth->User('id'))));
	    if((int)$user['User']['plan_id']==0){
		  $this->Session->setFlash(__('Please Upgrade your packages to add your vehicle'),'default',array("class"=>"success"));
		  $this->redirect(array("controller"=>"users",'action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			$this->Car->create();
			$this->request->data['Car']['alias']=$this->Default->Cleanstring($this->request->data['Car']['name']);
			$this->request->data['Car']['user_id']=$this->Auth->User('id');
			$this->request->data['Car']['status']='1';
			
			$this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && count($this->request->data['Car']['finance_option'])>0)?@implode(",",$this->request->data['Car']['finance_option']):'sale';
			
			if ($this->Car->save($this->request->data)) {
			    if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.image' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
			
				$this->Session->setFlash(__('The car has been saved'),array("class"=>"success"));
				$this->redirect(array('action' => 'listing'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'),array("class"=>"error"));
			}
		}
		$makes = $this->Car->Make->find('list',array("conditions"=>array("Make.status"=>"1")));
		//$carModels = $this->Car->CarModel->find('list');
		$exteriorColors = $this->Car->ExteriorColor->find('list',array("conditions"=>array("ExteriorColor.color_type"=>"Exterior","ExteriorColor.status"=>"1")));
		$interiorColors = $this->Car->InteriorColor->find('list',array("conditions"=>array("InteriorColor.color_type"=>"Interior","InteriorColor.status"=>"1")));
		
		$users = $this->Car->User->find('list',array("fields"=>array("User.id","User.username"),"conditions"=>array("User.status"=>"1")));
		$bodystyles = $this->Car->Bodystyle->find('list',array("conditions"=>array("Bodystyle.status"=>"1")));
		$countries = $this->Car->Country->find('list',array("conditions"=>array("Country.status"=>"1")));
		//$states = $this->Car->State->find('list');
		$transmissions=array("Automatic "=>"Automatic ","Manual"=>"Manual");
		$this->set(compact('makes','users', 'bodystyles', 'countries','exteriorColors','interiorColors','transmissions'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		     $this->request->data['Car']['alias']=$this->Default->Cleanstring($this->request->data['Car']['name']);
			 $this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && count($this->request->data['Car']['finance_option'])>0)?implode(",",$this->request->data['Car']['finance_option']):'sale';
			 
			 
			if ($this->Car->save($this->request->data)) {
			 if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.image' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
				$this->Session->setFlash(__('The car has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'listing'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'),array("class"=>"error"));
			}
		} else {
			$this->request->data = $this->Car->read(null, $id);
			$this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && $this->request->data['Car']['finance_option']!='')?explode(",",$this->request->data['Car']['finance_option']):'';
		}
		$makes = $this->Car->Make->find('list',array("conditions"=>array("Make.status"=>"1")));
		$carModels = $this->Car->CarModel->find('list',array("conditions"=>array("CarModel.make_id"=>$this->request->data['Car']['make_id'],"CarModel.status"=>"1")));
		$exteriorColors = $this->Car->ExteriorColor->find('list',array("conditions"=>array("ExteriorColor.color_type"=>"Exterior","ExteriorColor.status"=>"1")));
		$interiorColors = $this->Car->InteriorColor->find('list',array("conditions"=>array("InteriorColor.color_type"=>"Interior","InteriorColor.status"=>"1")));
		
		$users = $this->Car->User->find('list',array("fields"=>array("User.id","User.username"),"conditions"=>array("User.status"=>"1")));
		$bodystyles = $this->Car->Bodystyle->find('list',array("conditions"=>array("Bodystyle.status"=>"1")));
		$countries = $this->Car->Country->find('list',array("conditions"=>array("Country.status"=>"1")));
		$states = $this->Car->State->find('list',array("conditions"=>array("State.country_id"=>$this->request->data['Car']['country_id'],"State.status"=>"1")));
		$transmissions=array("Automatic "=>"Automatic ","Manual"=>"Manual");
		
		
		$this->set(compact('makes', 'carModels', 'users', 'bodystyles', 'countries', 'states','exteriorColors','interiorColors','transmissions'));
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
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		if ($this->Car->delete()) {
			$this->Session->setFlash(__('Car deleted'));
			$this->redirect(array('action' => 'listing'));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'listing'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Car->recursive = 0;
		$this->set('cars', $this->paginate());
		
		$active_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"1")));
		$inactive_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"0")));
		$total_pages=$this->Car->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}
	public function admin_carimages() {
		$this->Car->recursive = 0;
		
		$this->paginate=array("conditions"=>array("CarImage.car_id"=>$this->params['pass'][0]));
		$this->set('carimages', $this->paginate('CarImage'));
		
		
	}
	public function carimages() {
		$this->Car->recursive = 0;
		
		$this->paginate=array("conditions"=>array("CarImage.car_id"=>$this->params['pass'][0]));
		$this->set('carimages', $this->paginate('CarImage'));
		
		
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		$this->set('car', $this->Car->read(null, $id));
		
		$active_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"1")));
		$inactive_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"0")));
		$total_pages=$this->Car->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Car->create();
			$this->request->data['Car']['alias']=$this->Default->Cleanstring($this->request->data['Car']['name']);
			
			$this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && count($this->request->data['Car']['finance_option'])>0)?implode(",",$this->request->data['Car']['finance_option']):'';
			
			if ($this->Car->save($this->request->data)) {
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.image' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
			   if(isset($this->request->data['Image']['logo']['name']) && $this->request->data['Image']['logo']['name']!=''){
			    $imagename='logo-'.$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['logo']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['logo']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.logo' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
			
			
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		}
		$makes = $this->Car->Make->find('list');
		//$carModels = $this->Car->CarModel->find('list');
		$exteriorColors = $this->Car->ExteriorColor->find('list',array("conditions"=>array("ExteriorColor.color_type"=>"Exterior")));
		$interiorColors = $this->Car->InteriorColor->find('list',array("conditions"=>array("InteriorColor.color_type"=>"Interior")));
		
		$users = $this->Car->User->find('list',array("fields"=>array("User.id","User.username")));
		$bodystyles = $this->Car->Bodystyle->find('list');
		$countries = $this->Car->Country->find('list');
		//$states = $this->Car->State->find('list');
		$transmissions=array("Automatic "=>"Automatic ","Manual"=>"Manual");
		$this->set(compact('makes','users', 'bodystyles', 'countries','exteriorColors','interiorColors','transmissions'));
		
		$active_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"1")));
		$inactive_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"0")));
		$total_pages=$this->Car->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}
	
	function admin_carimageadd(){
	  if ($this->request->is('post')) {
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Car->CarImage->create();
			$this->request->data['CarImage']['car_id']=$this->params['pass'][0];
			if ($this->Car->CarImage->save($this->request->data)) {
			   $cars=$this->Car->find("first",array("conditions"=>array("Car.id"=>$this->params['pass'][0])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$cars['car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->CarImage->updateAll(
                    array('CarImage.image' => "'" . $filename . "'"), array('CarImage.id'=>$this->CarImage->id)
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'carimages',$this->params['pass'][0]));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		  } else {
		   $this->Session->setFlash(__('The car could not be saved. Please, try again.'));
		  }
		}
	}
	
	function admin_carimageedit($id = null){
	  $this->Car->CarImage->id = $id;
		if (!$this->Car->CarImage->exists()) {
			throw new NotFoundException(__('Invalid car Image'));
		}
		
	  if ($this->request->is('post')) {
	  
	 
			
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Car->CarImage->create();
			$this->request->data['CarImage']['car_id']=$this->params['named']['car_id'];
			
			if ($this->Car->CarImage->save($this->request->data)) {
			   $cars=$this->Car->find("first",array("conditions"=>array("Car.id"=>$this->params['named']['car_id'])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$cars['car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->CarImage->updateAll(
                    array('CarImage.image' => "'" . $filename . "'"), array('CarImage.id'=>$this->request->data['CarImage']['id'])
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		  } else {
		   $this->Session->setFlash(__('The car could not be saved. Please, try again.'));
		  }
		}
	}
	
	
	function carimageadd(){
	  if ($this->request->is('post')) {
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Car->CarImage->create();
			$this->request->data['CarImage']['car_id']=$this->params['pass'][0];
			if ($this->Car->CarImage->save($this->request->data)) {
			   $cars=$this->Car->find("first",array("conditions"=>array("Car.id"=>$this->params['pass'][0])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$cars['car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->CarImage->updateAll(
                    array('CarImage.image' => "'" . $filename . "'"), array('CarImage.id'=>$this->CarImage->id)
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The car has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'carimages',$this->params['pass'][0]));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		  } else {
		   $this->Session->setFlash(__('The car could not be saved. Please, try again.'),'default',array("class"=>"error"));
		  }
		}
	}
	
	function carimageedit($id = null){
	  $this->Car->CarImage->id = $id;
		if (!$this->Car->CarImage->exists()) {
			throw new NotFoundException(__('Invalid car Image'));
		}
		
	  if ($this->request->is('post')) {
	  
	 
			
	  if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			$this->Car->CarImage->create();
			$this->request->data['CarImage']['car_id']=$this->params['named']['car_id'];
			
			if ($this->Car->CarImage->save($this->request->data)) {
			   $cars=$this->Car->find("first",array("conditions"=>array("Car.id"=>$this->params['named']['car_id'])));
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$cars['car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->CarImage->updateAll(
                    array('CarImage.image' => "'" . $filename . "'"), array('CarImage.id'=>$this->request->data['CarImage']['id'])
                );
			  }
			   
			
			
				$this->Session->setFlash(__('The car has been saved'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		  } else {
		   $this->Session->setFlash(__('The car could not be saved. Please, try again.'),'default',array("class"=>"error"));
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
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Car']['alias']=$this->Default->Cleanstring($this->request->data['Car']['name']);
			 $this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && count($this->request->data['Car']['finance_option'])>0)?implode(",",$this->request->data['Car']['finance_option']):'';
			 
						
			if ($this->Car->save($this->request->data)) {
			   
			   if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.image' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
			   if(isset($this->request->data['Image']['logo']['name']) && $this->request->data['Image']['logo']['name']!=''){
			    $imagename='logo-'.$this->request->data['Car']['alias'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['logo']['name'],WWW_ROOT.'/uploads/cars/',$imagename);
				move_uploaded_file($this->request->data['Image']['logo']['tmp_name'],WWW_ROOT.'/uploads/cars/'.$filename);
				$this->Car->updateAll(
                    array('Car.logo' => "'" . $filename . "'"), array('Car.id'=>$this->Car->id)
                );
			  }
			
				$this->Session->setFlash(__('The car has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Car->read(null, $id);
			$this->request->data['Car']['finance_option']=(isset($this->request->data['Car']['finance_option']) && $this->request->data['Car']['finance_option']!='')?explode(",",$this->request->data['Car']['finance_option']):'';
		}
		$makes = $this->Car->Make->find('list');
		$carModels = $this->Car->CarModel->find('list',array("conditions"=>array("CarModel.make_id"=>$this->request->data['Car']['make_id'])));
		$exteriorColors = $this->Car->ExteriorColor->find('list',array("conditions"=>array("ExteriorColor.color_type"=>"Exterior")));
		$interiorColors = $this->Car->InteriorColor->find('list',array("conditions"=>array("InteriorColor.color_type"=>"Interior")));
		
		$users = $this->Car->User->find('list',array("fields"=>array("User.id","User.username")));
		$bodystyles = $this->Car->Bodystyle->find('list');
		$countries = $this->Car->Country->find('list');
		$states = $this->Car->State->find('list',array("conditions"=>array("State.country_id"=>$this->request->data['Car']['country_id'])));
		$transmissions=array("Automatic "=>"Automatic ","Manual"=>"Manual");
		$this->set(compact('makes', 'carModels', 'users', 'bodystyles', 'countries', 'states','exteriorColors','interiorColors','transmissions'));
		
		$active_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"1")));
		$inactive_pages=$this->Car->find('count',array("conditions"=>array("Car.status"=>"0")));
		$total_pages=$this->Car->find('count');
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
		$this->Car->id = $id;
		if (!$this->Car->exists()) {
			throw new NotFoundException(__('Invalid car'));
		}
		if ($this->Car->delete()) {
			$this->Session->setFlash(__('Car deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	public function admin_carimagedelete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Car->CarImage->id = $id;
		if (!$this->Car->CarImage->exists()) {
			throw new NotFoundException(__('Invalid car image'),'default',array("class"=>"error"));
		}
		if ($this->Car->CarImage->delete()) {
			$this->Session->setFlash(__('Car deleted'),'default',array("class"=>"success"));
			$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']),'default',array("class"=>"error"));
	}
	public function carimagedelete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Car->CarImage->id = $id;
		if (!$this->Car->CarImage->exists()) {
			throw new NotFoundException(__('Invalid car image'),'default',array("class"=>"error"));
		}
		if ($this->Car->CarImage->delete()) {
			$this->Session->setFlash(__('Car deleted'),'default',array("class"=>"success"));
			$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']));
		}
		$this->Session->setFlash(__('Car was not deleted'));
		$this->redirect(array('action' => 'carimages',$this->params['named']['car_id']),'default',array("class"=>"error"));
	}
	public function states($country_id){
	if(empty($country_id)) return;
	
	 $states = $this->Car->State->find('list',array("conditions"=>array("State.country_id"=>$country_id,"State.status"=>"1"),"recursive"=>"-1"));
	 $this->set('states', $states);
	 $this->set('country_id',$country_id);
	}
	public function carmodel($make_id){
	if(empty($make_id)) return;
	
	 $carmodels = $this->Car->CarModel->find('list',array("conditions"=>array("CarModel.make_id"=>$make_id,"CarModel.status"=>"1"),"recursive"=>"-1"));
	 $this->set('carmodels', $carmodels);
	 $this->set('make_id',$make_id);
	}
	
	function compare(){
	  if ($this->request->is('post') || $this->request->is('put')) {
	    $car_ids=(isset($this->request->data['Car']['car_ids']) && count($this->request->data['Car']['car_ids'])>0)?implode(",",$this->request->data['Car']['car_ids']):0;
				
	    $cars = $this->Car->find('all',array("conditions"=>array("Car.id IN (".$car_ids.")")));
		$this->set('cars',$cars);
	  } else{
	  	$this->redirect(array('action' => 'home'));
	  }
	}
}
