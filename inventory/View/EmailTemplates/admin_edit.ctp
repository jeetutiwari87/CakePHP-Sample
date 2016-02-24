<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>
<?php echo $this->Form->create('EmailTemplate', array('id'=> 'SubmitFormData','enctype' => 'multipart/form-data','inputDefaults' => array('label' => false, 'div' => false, 'required' => false))); ?>

<aside class="right-side">
  <section class="content-header">
    <h1> Edit Email Template <small>Here you can Edit Email Template</small> </h1>
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
              <div class="tab-pane active">
                <?php
		 echo $this->Form->input('id', array('label'=>false, 'div'=>false)); ?>
                
                <div class="form-group">
                  <label for="subject"><span class="required">*</span>Subject</label>
                  <?php
		 echo $this->Form->input('subject', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('Subject'), 'data-validation' => 'required')); ?>
                </div>
                <div class="form-group">
                  <label for="description"><span class="required">*</span>Description</label>
                  <?php
		 echo $this->Form->input('description', array('label'=>false, 'div'=>false, 'class' => 'form-control ckeditor', 'placeholder'=>__('Description'), 'data-validation' => 'required')); ?>
                </div>
                <div class="form-group">
                  <label for="from">From</label>
                  <?php
		 echo $this->Form->input('from', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('From'))); ?>
                </div>
                <div class="form-group">
                  <label for="reply_to_email">Reply To Email</label>
                  <?php
		 echo $this->Form->input('reply_to_email', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('Reply To Email'))); ?>
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <?php
		 echo $this->Form->input('status', array('label'=>false, 'div'=>false, 'class' => 'fancycheck')); ?>
                </div>
                
              </div>
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
        </div>
      </div>
    </section>
  </div>
  </div>
  </div>
</aside>
<?php echo $this->Form->end(); ?><?php echo $this->Html->script('admin/default.js'); ?>
<?php echo $this->Html->script('ckeditor/ckeditor.js'); ?> 