<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
  var $components = array('Email',"Default");
  
  
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$id=$this->Auth->User('id');
		
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			
			$this->request->data['User']=$this->request->data;
			$this->request->data['User']['role_id']='3';
			unset($this->request->data['User']['x']);
			unset($this->request->data['User']['y']);
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('You have registered successfully Please login now'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'login'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		}
		$roles = $this->User->Role->find('list');
		
		$countries = $this->User->Country->find('list');
		$states = $this->User->State->find('list');
		$this->set(compact('roles', 'countries', 'states'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			
			
			if ($this->User->save($this->request->data)) {
			    if(isset($this->request->data['Image']['image']['name']) && $this->request->data['Image']['image']['name']!=''){
			    $imagename=$this->request->data['User']['username'];
			    $filename=$this->Default->createImageName($this->request->data['Image']['image']['name'],WWW_ROOT.'/uploads/users/',$imagename);
				move_uploaded_file($this->request->data['Image']['image']['tmp_name'],WWW_ROOT.'/uploads/users/'.$filename);
				$this->User->updateAll(
                    array('User.image' => "'" . $filename . "'"), array('User.id'=>$this->User->id)
                );
			  }
			
				$this->Session->setFlash(__('Profile Updated successfully'),'default',array("class"=>"success"));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'),'default',array("class"=>"error"));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list');
		
		$countries = $this->User->Country->find('list');
		$states = $this->User->State->find('list',array("conditions"=>array("State.country_id"=>$this->request->data['User']['country_id'])));
		$this->set(compact('roles', 'countries', 'states'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		$active_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"1")));
		$inactive_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"0")));
		$total_pages=$this->User->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
		$active_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"1")));
		$inactive_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"0")));
		$total_pages=$this->User->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			  
			  $this->User->create();
			  $this->User->set($this->request->data);
			  $this->User->setValidation('Admin');
			
			 
			  if($this->User->validates()){
			
		        if ($this->User->save($this->request->data)) {
				
				
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			  }
		}
		$roles = $this->User->Role->find('list',array("conditions"=>array("Role.status"=>"1")));
		
		$countries = $this->User->Country->find('list');
		$states = $this->User->State->find('list');
		$this->set(compact('roles', 'countries', 'states'));
		$active_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"1")));
		$inactive_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"0")));
		$total_pages=$this->User->find('count');
		$this->set(compact('active_pages','inactive_pages','total_pages'));
	}

/**
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			  $this->User->create();
			  $this->User->set($this->request->data);
			  $this->User->setValidation('Admin');
			
			if($this->User->validates()){
			 	if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$roles = $this->User->Role->find('list',array("conditions"=>array("Role.status"=>"1")));
		
		$countries = $this->User->Country->find('list');
		$states = $this->User->State->find('list',array("conditions"=>array("State.country_id"=>$this->request->data['User']['country_id'],"State.status"=>"1")));
		$this->set(compact('roles', 'countries', 'states'));
		
		$active_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"1")));
		$inactive_pages=$this->User->find('count',array("conditions"=>array("User.status"=>"0")));
		$total_pages=$this->User->find('count');
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
/**
 * admin_login method
 *
 */
	public function admin_login() {
	    $this->layout='login';
		$this->set('title_for_layout', __('Admin Login'));
	    if ($this->request->is('post')) {
						
					
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Logged in successfully'));
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid Username and Password'));
				$this->Session->setFlash($this->Auth->authError, 'default', array(), 'auth');
				$this->redirect($this->Auth->loginAction);
			}
		}
	}
	public function admin_dashboard() {
		$this->set('title_for_layout', __('Dashboard'));
	}
	public function admin_logout() {
		$this->Session->setFlash(__('Log out successful.'), 'default', array('class' => 'success'));
		$this->redirect($this->Auth->logout());
	}
	public function login() {
		$this->set('title_for_layout', __('Log in'));
		if ($this->request->is('post')) {
		
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Logged in successfully'),'default',array("class"=>"success"));
				if(isset($this->request->data['User']['types']) && $this->request->data['User']['types']!=''){
				 return $this->redirect(array('controller'=>"products",'action' => 'checkout'));
				} else {
				return $this->redirect(array('controller'=>"users",'action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('Invalid Username and Password'),'default',array("class"=>"error"));
								if(isset($this->request->data['User']['types']) && $this->request->data['User']['types']!=''){
				 return $this->redirect(array('controller'=>"products",'action' => 'checkout'));
				} else {
				 $this->redirect($this->Auth->loginAction);
				}
			}
		}
	}
	
	
	
	 /*Forgot Password*/
  public function forgot_password() {
   		$this->set('title_for_layout', __('Forgot Password', true));
		if ($this->request->is('post')) {
			if (!empty($this->request->data['User']['email']) && isset($this->request->data['User']['email'])) {
				$user = $this->User->findByEmail($this->request->data['User']['email']);
				if (!isset($user['User']['id'])) {
					$this->Session->setFlash(__('Invalid Email.', true), 'default', array('class' => 'error'));
					$this->redirect(array('controller' =>'users','action' => 'forgot_password'));
				}
	
				$this->set(compact('user'));
					
				$this->Email->from = Configure::read('Site.admin_email');
				$this->Email->to = $user['User']['email'];
				$this->Email->subject = __('iphoneparts.com Reset Password');
			   	$this->Email->template = 'forgot_password';
								
				if ($this->Email->send()) {
					$this->Session->setFlash(__('An email has been sent with instructions for resetting your password.'), 'default', array('class' => 'success'));
					$this->redirect(array('action' => 'login'));
				} else {
					$this->Session->setFlash(__('An error occurred. Please try again.'), 'default', array('class' => 'error'));
				}
			
			   
			}
			else
			{
				 $this->Session->setFlash(__('An error occurred. Please try again.', true), 'default', array('class' => 'error'));
			}
		}
    
  } 
  /**
     * Reset your password
     *
     */
    public function resetpassword($email = null) {
    
        $this->set('title_for_layout', __('Reset Password', true));
        $email=base64_decode($email);
        if ($email == null) {
    
            $this->Session->setFlash(__('An error occurred.', true), 'default', array('class' => 'error'));
            $this->redirect(array('controller' =>'products','action' => 'home'));
        }
        
        $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $email
                    ),
                ));
   
        if ($user['User']['id'] ==='') {
    
            $this->Session->setFlash(__('An error occurred.', true), 'default', array('class' => 'error'));
           $this->redirect(array('controller' =>'products','action' => 'home'));
        }
    
        if ($this->request->is('post')) {
				
		    $this->User->id = $user['User']['id'];
            $user['User']['password'] = AuthComponent::password($this->request->data['User']['password'], null, true);
            if ($this->User->save($user['User'])) {
			    $this->Session->setFlash("Your password has been reset successfully.", 'default', array('class' => 'success'));
                $this->redirect(array('controller' =>'users','action' => 'login'));
            } else {
			    $this->Session->setFlash("An error occurred. Please try again.", 'default', array('class' => 'error'));
                $this->redirect(array('controller' =>'products','action' => 'home'));
            }
		}
        $this->request->data['User']['hash'] = $email;
       
    }
  
  public function change_password() 
  {
  	
        //$this->set('title_for_layout', __('Change Password', true));
		       
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->set($this->request->data);
		     $this->User->updateAll(array(
                    'User.password' => '\'' . AuthComponent::password($this->request->data['User']['passwd']) . '\'',
                ) , array(
                    'User.id' => $this->Auth->user('id')
             ));
			 
			  $this->Auth->logout();
			  $this->redirect(array(
						'controller' => 'users',
						'action' => 'login'
               ));
            unset($this->data['User']['passwd']);
            unset($this->data['User']['confirm_password']);
        } 
        
    }

	public function logout() {
		$this->Session->setFlash(__('Log out successful.'), 'default', array('class' => 'success'));
		$this->Auth->logout();
		$this->redirect(array('controller'=>"products",'action' => 'home'));
		//$this->redirect($this->Auth->logout());
		
	}
	public function states($country_id){
	if(empty($country_id)) return;
	
	 $states = $this->User->State->find('list',array("conditions"=>array("State.country_id"=>$country_id,"State.status"=>"1"),"recursive"=>"-1"));
	 $this->set('states', $states);
	 $this->set('country_id',$country_id);
	}
	

}
