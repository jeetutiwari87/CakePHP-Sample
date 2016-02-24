<?php
app::import("Model","SitePermission");
$permission_obj=new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>
<?php echo $this->Form->create('User',array("id"=>"SubmitFormData",'enctype' => 'multipart/form-data','inputDefaults' => array('label' => false, 'div' => false, 'required' => false))); ?>

<aside class="right-side">
  <section class="content-header">
    <h1> <?php echo __('Edit Profile');?> <small><?php echo __('Here you can edit Profile');?></small> </h1>
    <ol class="breadcrumb">
      <li>
        <button class="btn btn-app" type="submit"><i class="fa fa-save"></i><?php echo __('Save');?></button>
        <?php if($is_ajax!='1') { ?>
        <button type="button" onclick="javascript:history.back(1)" class="btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
        <?php } else { ?>
        <button type="button"  onclick="javascript:void(0)" class="Cancel btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
        <?php } ?>
      </li>
    </ol>
  </section>
  <input type="hidden" name="current_url" id="current_url" value="<?php echo Router::url('/');?>admin/<?php echo $this->params['controller'];?>/index" />
  <div class="nav-tabs-custom">
    <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-body">
            <div class="tab-content">
              
              <div id="stntab1" class="tab-pane active">
                
                <div class="form-group">
                  <label><span class="required">*</span><?php echo __('First Name');?></label>
                  <?php 
 echo $this->Form->input('id');
 
 echo $this->Form->input('first_name', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('First Name'),"data-validation"=>"required")); ?>
                </div>
                <div class="form-group">
                  <label><span class="required">*</span><?php echo __('Last Name');?></label>
                  <?php echo $this->Form->input('last_name', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Last Name'),"data-validation"=>"required")); ?> </div>
                <div class="form-group">
                  <label><span class="required">*</span><?php echo __('Company');?></label>
                  <?php echo $this->Form->input('user_company', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Company'),"data-validation"=>"required")); ?> </div>
                
                <div class="form-group">
                  <label><span class="required">*</span><?php echo __('Password');?></label>
                  <?php if(isset($id) && $id!=''){ ?>
                  <?php echo $this->Form->input('password', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Password'),"value"=>"")); ?>
                  <?php } else { ?>
                  <?php echo $this->Form->input('password', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Password'),"data-validation"=>"required","value"=>"")); ?>
                  <?php } ?>
                </div>
                
                <div class="form-group">
                  <label><?php echo __('Address');?></label>
                  <?php echo $this->Form->input('address', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Address'))); ?> </div>
                <div class="form-group">
                  <label><?php echo __('Zip');?></label>
                  <?php echo $this->Form->input('zip', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Zip'))); ?> </div>
                <div class="form-group">
                  <label><?php echo __('Mobile');?></label>
                  <?php echo $this->Form->input('mobile', array("label" => false, "div" => false, "class" => "form-control", 'placeholder'=>__('Mobile'))); ?> </div>
                
                
              </div>
              <?php echo $this->Html->script('admin/default.js'); ?> </div>
          </div>
          <!-- /.box-body -->
          <section class="content-header" style="float:right; margin-top:10px;">
            <ol class="breadcrumb">
              <li>
                <button class="btn btn-app" type="submit"><i class="fa fa-save"></i><?php echo __('Save');?></button>
                <?php if($is_ajax!='1') { ?>
                <button type="button" onclick="javascript:history.back(1)" class="btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
                <?php } else { ?>
                <button type="button"  onclick="javascript:void(0)" class="Cancel btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
                <?php } ?>
              </li>
            </ol>
          </section>
        </div>
        <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</aside>
<?php echo $this->Form->end(); ?> 