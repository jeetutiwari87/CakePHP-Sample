<div class="sign-up">
       		<div class="sign-up-blue">
            <h2>Login</h2>
            <div class="cross-icon" onclick="$('.sign-up').fadeOut(); $('.login-container').remove();"><a href="javascript:void(0);"><!--<img src="images_front/close.png" alt="" border="0" >--><?php echo $this->Html->image('../images_front/close.png')?></a></div>
            </div>
            <div class="popup-contant">
			
			<div class="error">
				
			</div>
			
            <p class="popup-center">To create a new account, please enter your contact and company information below. This information 
will be kept completely confidential and will only be used to deliver leads to you. When you are 
finished entering this information, click "Save and Continue" to finish your account registration.</p>
			<div class="login-form"><!--<form name="userForm" class="userForm">--><?php echo $this->Form->create('User', array('class'=>'userForm', 'url' => array('controller' => 'users', 'action' => 'login'))); ?>
            
			<?php echo $this->Form->input('email', array('label'=>false, 'class'=>'loginFields email', 'placeholder'=>'EMAIL ADDRESS')); ?>
            
			<?php echo $this->Form->input('password', array('label'=>false, 'class'	=>'loginFields password', 'placeholder'=>'PASSWORD')); ?>
            <div class="full text-right"><a href="javascript:void(0);" class="button-signup" onclick="doLogin()" >Login >></a></div>
			
			<?php echo $this->Form->end(); ?>
            </div>
            </div>
            
        </div>
		