<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    var $uses = array("User", "SitePermission", "EmailTemplate");

    public function admin_login() {
        $this->layout = 'admin_login';

        $this->set('title_for_layout', __('Admin Login'));
        if ($this->request->is('post')) {


            $this->Auth->authenticate['Form'] = array('fields' => array('username' => 'email'), 'scope' => array('User.status' => 1));

            if ($this->Auth->login()) {

                if (empty($this->request->data['User']['remember_me'])) {
                    $this->Cookie->delete('User');
                } else {
                    $cookie = array();
                    $cookie['email'] = $this->request->data['User']['email'];
                    $cookie['password'] = $this->request->data['User']['password'];
                    $cookie['remember_me'] = $this->request->data['User']['remember_me'];

                    $this->Cookie->write('User', $cookie, true, '+2 weeks');
                }

                $this->User->updateAll(array(
                    'User.last_login' => '\'' . date('Y-m-d h:i:s') . '\''
                        ), array(
                    'User.id' => $this->Auth->user('id')
                ));
                $this->Session->setFlash(__('Logged in successfully'));
                return $this->redirect(array("action" => "dashboard"));
            } else {
                $this->Session->setFlash(__('Invalid email and password'));
                $this->Session->setFlash($this->Auth->authError, 'default', array(), 'auth');
                $this->redirect($this->Auth->loginAction);
            }
        } else {
            $this->request->data['User'] = $this->Cookie->read('User');
        }

        $jsIncludes = array("admin/login.js");
        $this->set(compact('jsIncludes'));
    }

    public function admin_dashboard() {

        $total_user = $this->User->find('count');
        $recent_users = $this->User->find('all', array('order' => 'User.id DESC', 'limit' => 10));

        $jsIncludes = array();
        $cssIncludes = array();
        $this->set(compact('jsIncludes', 'cssIncludes', 'total_user', 'recent_users'));
    }


    public function admin_update_status($id = null, $status) {
        $response = array();
        if ($status == 0) {
            $mark = 1;
        } else {
            $mark = 0;
        }
        if (!empty($id)) {
            if ($this->request->is('ajax')) {
                $this->layout = 'ajax';
                $this->autoRender = false;

                if ($this->User->updateAll(array('User.status' => "'" . $mark . "'"), array('User.id' => $id))) {
                    $response['status'] = 1;
                    $response['message'] = __('Status updated successfully');
                } else {
                    $response['status'] = 0;
                    $response['message'] = __('There is some problem to update status. please try again');
                }
                echo json_encode($response);
                exit;
            } else {
                if ($this->User->updateAll(array('User.status' => "'" . $mark . "'"), array('User.id' => $id))) {
                    $this->Session->setFlash(__('Status updated successfully'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('There is some problem to update status. please try again'));
                    $this->redirect(array('action' => 'index'));
                }
            }
        }

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            $response['status'] = 0;
            $response['message'] = __('Invalid request');
            echo json_encode($response);
            exit;
        } else {
            $this->Session->setFlash(__('Invalid request'));
            $this->redirect(array('action' => 'index'));
        }
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
        $this->set('user_list', 'active');
        if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_read')) {
            $this->Session->setFlash(__('You are not authorised to access that location'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }

        $this->User->recursive = 0;

        $limit = (isset($this->params['named']['showperpage'])) ? $this->params['named']['showperpage'] : Configure::read('site.admin_paging_limit');
        $conditions = array();

        if (isset($this->params['named']['keyword']) && $this->params['named']['keyword'] != '') {
            $conditions = array(
                'OR' => array(
                    'User.first_name LIKE ' => '%' . $this->params['named']['keyword'] . '%',
                    'User.last_name LIKE ' => '%' . $this->params['named']['keyword'] . '%',
					'User.user_company LIKE ' => '%' . $this->params['named']['keyword'] . '%',
					'User.email LIKE ' => '%' . $this->params['named']['keyword'] . '%'
                )
            );
        }
        if (!empty($this->request->data)) {
            if (isset($this->request->data['showperpage']) && $this->request->data['showperpage'] != '') {
                $limit = $this->request->data['showperpage'];
                $this->params['named'] = array("showperpage" => $limit);
            }
            if (isset($this->request->data['keyword']) && $this->request->data['keyword'] != '') {
                $this->params['named'] = array("keyword" => $this->request->data['keyword']);
                $conditions = array(
                    'OR' => array(
                        'User.first_name LIKE ' => '%' . $this->request->data['keyword'] . '%',
                        'User.last_name LIKE ' => '%' . $this->request->data['keyword'] . '%',
						'User.user_company LIKE ' => '%' . $this->request->data['keyword'] . '%',
						'User.email LIKE ' => '%' . $this->request->data['keyword'] . '%'
                    )
                );
            }
        }
       

        if ($limit == 'ALL') {
            $paging_limit = '1000000';
        } else {
            $paging_limit = $limit;
        }

        $this->paginate = array("conditions" => $conditions, "limit" => $paging_limit, "order" => "User.id DESC");
        $this->set(compact('limit'));
        $this->set('users', $this->paginate());
    }

 

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }


        if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_read')) {
            $this->Session->setFlash(__('You are not authorised to access that location'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
       
        $response = array();

        if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_add')) {
            $this->Session->setFlash(__('You are not authorised to access that location'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }

        if ($this->request->is('post') && !empty($this->request->data)) {

            $this->request->data['User']['username'] = $this->Default->Cleanstring($this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name']);

            $this->User->create();


            if ($this->User->save($this->request->data)) {
               
                if ($this->request->is('ajax')) {
                    $response['status'] = 1;
                    $response['message'] = __('The user has been saved');
                    $response['redirect_url'] = (isset($this->request->data['current_url']) && $this->request->data['current_url'] != '') ? $this->request->data['current_url'] : '';
                    echo json_encode($response);
                    exit;
                } else {
                    $this->Session->setFlash(__('The user has been saved.'));
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }


        $this->loadModel('Role');
        $roles = $this->Role->find("list");

        $this->set(compact('roles'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null) {

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
        $response = array();
      

        if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_add')) {
            $this->Session->setFlash(__('You are not authorised to access that location'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data)) {

            $this->request->data['User']['username'] = $this->Default->Cleanstring($this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name']);

            if (empty($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }

            if ($this->User->save($this->request->data)) {
                
                if ($this->request->is('ajax')) {
                    $response['status'] = 1;
                    $response['message'] = __('The user has been saved');
                    $response['redirect_url'] = (isset($this->request->data['current_url']) && $this->request->data['current_url'] != '') ? $this->request->data['current_url'] : '';
                    echo json_encode($response);
                    exit;
                } else {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                pr($this->User->validationErrors);
                exit;
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);

        }

      
        $this->loadModel('Role');
        $roles = $this->Role->find("list");

        $this->set(compact('roles','id'));
    }
	
	public function admin_profile($id = null) {

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
        }
        $response = array();
      

        if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_add')) {
            $this->Session->setFlash(__('You are not authorised to access that location'));
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
        }
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if (($this->request->is('post') || $this->request->is('put')) && !empty($this->request->data)) {

            $this->request->data['User']['username'] = $this->Default->Cleanstring($this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name']);

            if (empty($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }

            if ($this->User->save($this->request->data)) {
                
                if ($this->request->is('ajax')) {
                    $response['status'] = 1;
                    $response['message'] = __('The user has been saved');
                    $response['redirect_url'] = (isset($this->request->data['current_url']) && $this->request->data['current_url'] != '') ? $this->request->data['current_url'] : '';
                    echo json_encode($response);
                    exit;
                } else {
                    $this->Session->setFlash(__('The profile updated successfully'));
                    $this->redirect(array('action' => 'dashboard'));
                }
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                pr($this->User->validationErrors);
                exit;
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);

        }

      
        $this->loadModel('Role');
        $roles = $this->Role->find("list");

        $this->set(compact('roles','id'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $response = array();
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_delete')) {
                $response['status'] = 0;
                $response['message'] = __('You are not authorised to access that location');
                echo json_encode($response);
                exit;
            }
            $this->User->id = $id;
            if (!$this->User->exists()) {
                $response['status'] = 0;
                $response['message'] = __('Invalid user');
                echo json_encode($response);
                exit;
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->User->delete()) {
                $response['status'] = 1;
                $response['message'] = __('User deleted');
                echo json_encode($response);
                exit;
            }
            $response['status'] = 0;
            $response['message'] = __('Invalid request');
            echo json_encode($response);
            exit;
        } else {
            if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_delete')) {
                $this->Session->setFlash(__('You are not authorised to access that location'));
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            $this->User->id = $id;
            if (!$this->User->exists()) {
                throw new NotFoundException(__('Invalid user'));
            }
            //$this->request->onlyAllow('post', 'delete');
            if ($this->User->delete()) {
                $this->Session->setFlash(__('User deleted'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('User was not deleted'));
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
    public function admin_deleteall() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_delete')) {
                $response['status'] = 0;
                $response['message'] = __('You are not authorised to access that location');
                echo json_encode($response);
                exit;
            }
            $userids = $this->request->data['ids'];
            $flag = 0;
            if (count($userids) > 0) {
                foreach ($userids as $ids) {
                    $this->User->id = $ids;
                    $this->User->delete();
                    $flag++;
                }
                if ($flag > 0) {
                    $response['status'] = 1;
                    $response['message'] = __('users deleted successfully!');
                    echo json_encode($response);
                    exit;
                } else {
                    $response['status'] = 0;
                    $response['message'] = __('Users was not deleted');
                    echo json_encode($response);
                    exit;
                }
            }
        } else {
            if (!$this->SitePermission->CheckPermission($this->Auth->user("role_id"), 'users', 'is_delete')) {
                $this->Session->setFlash(__('You are not authorised to access that location'));
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }


            $userids = $this->request->data['ids'];
            $flag = 0;
            if (count($userids) > 0) {
                foreach ($userids as $ids) {
                    $this->User->id = $ids;
                    $this->User->delete();
                    $flag++;
                }
                if ($flag > 0) {
                    $this->Session->setFlash(__('users deleted successfully!'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Users was not deleted'));
                    $this->redirect(array('action' => 'index'));
                }
            }
        }
    }

    public function admin_change_password() {
        if ($this->request->is('post')) {
            if ($this->request->data['User']['old_password'] != '') {
                $old_password = Security::hash($this->data['User']['old_password'], null, true);
                $password = Security::hash($this->data['User']['password'], null, true);
                $CheckPassword = $this->User->find('first', array(
                    'conditions' => array(
                        'User.id' => $this->Auth->user('id'),
                        'User.password' => $old_password
                    )
                ));

                if (!empty($CheckPassword)) {
                    $this->User->updateAll(array('User.password' => "'" . $password . "'"), array('User.id' => $this->Auth->user('id')));
                    $this->Session->setFlash(__('Password changed successfully.'), 'default', array('class' => 'success'));
                    $this->redirect(array('action' => "change_password"));
                } else {
                    $this->Session->setFlash(__('old password is wrong. Please try again.'), 'default', array('class' => 'error'));
                    $this->redirect(array('action' => 'change_password'));
                }
            } else {
                $this->Session->setFlash(__('Enter old password.'), 'default', array('class' => 'error'));
                $this->redirect(array('action' => 'change_password'));
            }
        }
        $jsIncludes = array('admin/jquery.validationEngine.js', 'admin/jquery.validationEngine-en.js');
        $cssIncludes = array('admin/validationEngine.jquery.css');
        $this->set(compact('jsIncludes', 'cssIncludes'));
    }

    public function admin_logout() {
        $this->Session->setFlash(__('Log out successful.'), 'default', array('class' => 'success'));
        $this->redirect($this->Auth->logout());
    }

    public function admin_forgot() {
        $this->layout = 'admin_login';
        $this->set('title_for_layout', Configure::read('site.name') . ' :: ' . __('Forgot Password'));
        if ($this->Auth->user('id')) {
            $this->redirect(Router::url('/', true));
        }
        if (!empty($this->request->data)) {
            $user = $this->User->find('first', array(
                'conditions' => array(
                    'User.email =' => $this->request->data['User']['email'],
                    'User.status' => 1,
                    'User.role_id' => '1'
                ),
                'fields' => array(
                    'User.id',
                    'User.email'
                ),
                'recursive' => -1
            ));

            if (!empty($user['User']['email'])) {
                $user = $this->User->find('first', array(
                    'conditions' => array(
                        'User.email' => $user['User']['email']
                    ),
                    'recursive' => -1
                ));

                $new_password = $this->User->randomPassword();
                $this->request->data['User']['password'] = $new_password;
                $this->request->data['User']['id'] = $user['User']['id'];
                $this->User->save($this->request->data);
                $email = $this->EmailTemplate->selectTemplate('forgot_password');
                $emailFindReplace = array(
                    '##SITE_LINK##' => Router::url('/', true),
                    '##USERNAME##' => $user['User']['first_name'] . ' ' . $user['User']['last_name'],
                    '##USER_EMAIL##' => $user['User']['email'],
                    '##USER_PASSWORD##' => $new_password,
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
                $this->Email->replyTo = ($email['reply_to_email'] == '##REPLY_TO_EMAIL##') ? Configure::read('EmailTemplate.reply_to') : $email['reply_to_email'];
                $this->Email->to = $user['User']['email'];
                $this->Email->subject = strtr($email['subject'], $emailFindReplace);
                $this->Email->sendAs = ($email['is_html']) ? 'html' : 'text';
                if ($this->Email->send(strtr($email['description'], $emailFindReplace))) {
                    $this->Session->setFlash(__('An email has been sent with your password'), 'default', array("class" => "success"));
                    $this->redirect(array("controller" => "users", "action" => 'login'));
                } else {
                    $this->Session->setFlash(sprintf(__('There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.'), $this->request->data['User']['email']), 'default', array("class" => "error"));
                }
            } else {
                $this->Session->setFlash(sprintf(__('There is no user registered with the email %s or admin deactivated your account. If you spelled the address incorrectly or entered the wrong address, please try again.'), $this->request->data['User']['email']), 'default', array("class" => "error"));
                //	$this->redirect(array("controller"=>"users","action" =>'login'));
            }
        }

        $jsIncludes = array("admin/login.js");
        $this->set(compact('jsIncludes'));
    }

    public function admin_reset($email = null) {
        $this->set('title_for_layout', Configure::read('site.name') . ' :: ' . __('Reset Password'));

        if ($email == null) {
            $this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
            $this->redirect(array("controller" => "/", 'action' => $this->Default->createseolinks('login')));
        }
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.email' => $email
            ),
        ));
        if (!isset($user['User']['id'])) {
            $this->Session->setFlash(__('An error occurred.'), 'default', array('class' => 'error'));
            $this->redirect(array("controller" => "/", 'action' => $this->Default->createseolinks('login')));
        }

        if (!empty($this->request->data) && isset($this->request->data['User']['password'])) {
            if ($this->request->data['User']['password'] != $this->request->data['User']['confirm_password']) {
                $this->Session->setFlash(__('Password and confirm password not match'), 'default', array('class' => 'success'));
            } else {
                $this->User->id = $user['User']['id'];
                if ($this->User->updateAll(
                                array('User.password' => "'" . AuthComponent::password($this->request->data['User']['password']) . "'"), array('User.id' => $this->User->id)
                        )) {
                    $this->Session->setFlash(__('Your password has been reset successfully.'), 'default', array('class' => 'success'));
                    $this->redirect(array("controller" => "/", 'action' => $this->Default->createseolinks('login')));
                } else {
                    $this->Session->setFlash(__('An error occurred. Please try again.'), 'default', array('class' => 'error'));
                }
            }
        }
        $this->loadModel('Page');
        $reset_page_content_arr = $this->Page->find("first", array("conditions" => array("Page.alias" => 'reset-password-instructions'), "fields" => array("Page.content", "Page.title"), "recusive" => "-1"));
        $this->set(compact('user', 'email', 'reset_page_content_arr'));
    }

    function admin_manageprofile() {

        $id = $this->Auth->user('id');

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('PUT')) {
            if (!empty($this->request->data)) {

                $datevalue = date('Y-m-d H:i:s');
                $this->request->data['User']['modified'] = $datevalue;
                $this->request->data['User']['created'] = $datevalue;
                $this->request->data['User']['last_login'] = $datevalue;

                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('Your profile updated successfully '));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The informetion could not be updated. Please, try again.'));
                }
            }
        } else {
            $options = array("recursive" => -2, 'conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $jsIncludes = array('admin/chosen.jquery.min.js', 'admin/jquery.toggle.buttons.js', 'admin/jquery.reveal.js', 'admin/jquery.validationEngine.js', 'admin/jquery.validationEngine-en.js');
        $cssIncludes = array('admin/chosen.css', 'admin/bootstrap-toggle-buttons.css', 'admin/validationEngine.jquery.css');
        $this->set(compact('jsIncludes', 'cssIncludes'));
    }

}
