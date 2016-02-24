<?php

app::import("Model","User");
$user_obj=new User();
?>
<div id="stntab1" class="tab-pane active">
    
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('User Type');?></label>
        <?php echo $this->Form->input('role_id', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('User Type'),"data-validation"=>"required","empty"=>__('User Type'))); ?>
    </div>
    
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('First Name');?></label>
 <?php 
 echo $this->Form->input('id');
 
 echo $this->Form->input('first_name', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('First Name'),"data-validation"=>"required")); ?>

    </div>
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('Last Name');?></label>
 <?php echo $this->Form->input('last_name', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Last Name'),"data-validation"=>"required")); ?>

    </div>
	<div class="form-group">
        <label><span class="required">*</span><?php echo __('Company');?></label>
 <?php echo $this->Form->input('user_company', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Company'),"data-validation"=>"required")); ?>

    </div>
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('Email');?></label>
 <?php echo $this->Form->input('email', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Email'),"data-validation"=>"email")); ?>

    </div>
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('Password');?></label>
<?php if(isset($id) && $id!=''){ ?>
 <?php echo $this->Form->input('password', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Password'),"value"=>"")); ?>
<?php } else { ?>
 <?php echo $this->Form->input('password', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Password'),"data-validation"=>"required")); ?>
<?php } ?>
    </div>
    <div class="form-group">
        <label><span class="required">*</span><?php echo __('Confirm Password');?></label>
 <?php echo $this->Form->input('confirm_password', array("label" => false, "div" => false,"type"=>"password", "class" => "form-control", 'placeholder'=>__('Confirm Password'))); ?>

    </div>
	<div class="form-group">
        <label><?php echo __('Address');?></label>
 <?php echo $this->Form->input('address', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Address'))); ?>

    </div>
	<div class="form-group">
        <label><?php echo __('Zip');?></label>
 <?php echo $this->Form->input('zip', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Zip'))); ?>

    </div>
	<div class="form-group">
        <label><?php echo __('Mobile');?></label>
 <?php echo $this->Form->input('mobile', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Mobile'))); ?>

    </div>
	<div class="form-group">
        <label><?php echo __('Remarks');?></label>
 <?php echo $this->Form->input('remarks', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Remarks'))); ?>

    </div>
	
	
    <div class="form-group">
        <label><?php echo __('Status');?></label>
 <?php echo $this->Form->input('status', array("label" => false, "div" => false, "class" => "fancycheck")); ?>

    </div>
</div>




<?php echo $this->Html->script('admin/default.js'); ?>	

