<div class="wrapper">

<div class="container sign_in Our_Portal">

<div class="Our_Portal_content">
<h1>Welcome to <span>Inventory Record System</span></h1>

</div>
<?php echo $this->Form->create('User',array("inputDefaults"=>array("div"=>"form-group","class"=>"form-control","required"=>false))); ?>
<div class="col-sm-12  first" >

<p><label> Enter your e-mail address below to reset your password.*</label>
<?php 
echo $this->Form->input('email', array('id'=>"email",'label'=>false,"data-validation"=>"email"));

?>
</p>


 <input name="submit" type="submit" value="<?php echo __('Submit');?>">  


<p class="sign up"><?php echo $this->Html->link(__('Back to login'), array('action' => 'login',"controller"=>"users","admin"=>true),array("class"=>"btn bg-olive btn-block")); ?></p>
</div>
<?php echo $this->Form->end(); ?>

</div>
</div>
