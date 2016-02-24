<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Category $Category
 * @property User $User
 * @property OrderDetail $OrderDetail
 * @property ProductImage $ProductImage
 * @property Promo $Promo
 */
class Product extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'alias' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'max_qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'image' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_featured' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'OrderDetail' => array(
			'className' => 'OrderDetail',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductImage' => array(
			'className' => 'ProductImage',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PromoProduct' => array(
			'className' => 'PromoProduct',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Cartdetail' => array(
			'className' => 'Cartdetail',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Remind' => array(
			'className' => 'Remind',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Promo' => array(
			'className' => 'Promo',
			'joinTable' => 'promo_products',
			'foreignKey' => 'product_id',
			'associationForeignKey' => 'promo_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	
	function getproductImage($car_id){
	 $cars=$this->find("first",array("conditions"=>array("Product.id"=>$car_id),"fields"=>array("Product.image"),"recursive"=>"-1"));
	 return (isset($cars['Product']['image']))?$cars['Product']['image']:'';
	 
	}
	function getproductname($car_id){
	 $cars=$this->find("first",array("conditions"=>array("Product.id"=>$car_id),"fields"=>array("Product.name"),"recursive"=>"-1"));
	 return (isset($cars['Product']['name']))?$cars['Product']['name']:'';
	 
	}
	
	function getcartid($sid)
	{
	  App::Import("Model","Cart");
	  $carobj=new Cart();
	  $carts=$carobj->find("first",array("conditions"=>array("Cart.sessionid"=>$sid)));
	 
	  
	  if(!empty($carts) && count($carts)>0)
	  {
	   	$cart_id=$carts['Cart']['id'];
	  }
	  else
	  {
	      
	     $data['Cart']['sessionid']=$sid;
         $data['Cart']['created']=time();
		
		 $carobj->save($data);		 
		 $cart_id=$carobj->id;
	  }
	 return $cart_id;
			
	}
	function clearcart($hours)
	{
	    App::Import("Model","Cart");
	    $carobj=new Cart();
	  
	    $carobj->Cartdetail->deleteAll(array('Cartdetail.created <' => time()-(60*60*$hours)), false);
		$carobj->deleteAll(array('Cart.created <' => time()-(60*60*$hours)), false);
		
	}

	function addtocart($cart_id,$product_id,$name,$qty)
	{
	  $carts=$this->Cartdetail->find("first",array("conditions"=>array("Cartdetail.cart_id"=>$cart_id,"Cartdetail.product_id"=>$product_id)));
	  if(!empty($carts) && count($carts)>0)
	  {
	    $this->Cartdetail->updateAll(array('Cartdetail.qty'=>"'".($qty+$carts['Cartdetail']['qty'])."'"),array('Cartdetail.cart_id'=> $cart_id,'Cartdetail.product_id'=> $product_id));
		
	  }
	  else
	  {
	     $data['Cartdetail']['cart_id']=$cart_id;
		 $data['Cartdetail']['product_id']=$product_id;
		 $data['Cartdetail']['name']=$name;
		 $data['Cartdetail']['qty']=$qty;
		 $data['Cartdetail']['created']=time();
		 $this->Cartdetail->save($data);		 
		 
		
	  }
	}
  public function getProductInfo($product_id){
    $cars=$this->find("first",array("conditions"=>array("Product.id"=>$product_id)));
	return $cars;
	
  }
  public function CheckShipping($amount){

  
      App::Import("Model","Shipping");
	  $carobj=new Shipping();
	  $shipping_row=$carobj->find("first",array("conditions"=>array("Shipping.status"=>"1","Shipping.to_amount > ABS(".$amount.")"),"limit"=>"1"));
	
	  $shipping_data=array();
	  if(empty($shipping_row)){
	    $shipping_data['shipping']=0;
	  }else{
	    $shipping_data['shipping']=1;
		$shipping_data['charges']=$shipping_row['Shipping']['charges'];
	  }
	  
	  return $shipping_data;
	  
	  
  }

}
