<?php

app::import("Model","SitePermission");
$permission_obj=new SitePermission();


$is_ajax=Configure::read('site.run_admin_ajax');

?>

          <?php echo $this->Form->create('User',array("id"=>"SubmitFormData",'enctype' => 'multipart/form-data','inputDefaults' => array('label' => false, 'div' => false, 'required' => false))); ?>
<aside class="right-side">

    <section class="content-header">
        <h1>
                        <?php echo __('Add User');?>
            <small><?php echo __('Here you can add user');?></small>
        </h1>
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

				   <?php
					include 'frm/admin_form.ctp';
					?>

                            </div> 
                        </div><!-- /.box-body -->
                        <section class="content-header" style="float:right; margin-top:10px;">
                            <ol class="breadcrumb">

                                <li>

                                    <button class="btn btn-app" type="submit"><i class="fa fa-save"></i><?php echo __('Save');?></button>
						 <?php if($is_ajax!='1') { ?>
                                    <button type="button" onclick="javascript:history.back(1)" class="btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
						 <?php } else { ?>
                                    <button type="button" onclick="javascript:void(0)" class="Cancel btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
						 <?php } ?>
                                </li>
                            </ol>
                        </section>
                    </div><!-- /.box -->




                    </section>

                </div>

            </div>
    </div>
</aside>

<?php echo $this->Form->end(); ?>
