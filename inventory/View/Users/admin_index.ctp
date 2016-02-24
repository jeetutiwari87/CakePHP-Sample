<?php

app::import("Model","SitePermission");
$permission_obj=new SitePermission();
$is_ajax=Configure::write('site.run_admin_ajax');

?>

<aside class="right-side">

    <section class="content-header">
        <h1>
                        <?php echo __('Users');?>
            <small><?php echo __('Here you can manage all Users');?></small>
        </h1>
        <ol class="breadcrumb">

            <li>
						<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'users','is_add')) { ?>
							<?php echo $this->Html->link('<i class="fa fa-plus"></i>'.__('Add'), array('controller' => 'users', 'action' => 'add',"admin"=>true), array("escape" => false, "class" => "btn btn-app","id"=>"Add")); ?>
						<?php } ?>
						<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'users','is_delete')) { ?>
							<?php echo $this->Html->link('<i class="fa fa-lock"></i>'.__('Delete'), 'javascript:void(0);', array("escape" => false, "class" => "btn btn-app Deleteall")); ?>
						<?php } ?>
            </li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">

                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper">
								  <?php echo $this->Form->create('User',array("id"=>"DataForm")); ?>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div id="example1_length" class="dataTables_length">
                                        <label>

                                            <select name="showperpage" <?php // if($is_ajax!='1') { ?> onchange="$('form:first').submit();" <?php //} ?> id="showperpage" size="1" aria-controls="sample_1" class="m-wrap xsmall">
										<?php foreach (Configure::read('Admin.showperpage') as $showpage): ?>
                                                <option value="<?php echo $showpage; ?>"
											<?php if ($showpage == $limit) { ?> selected="selected"
											<?php } ?>>
												<?php echo $showpage; ?>
                                                </option>
											<?php endforeach; ?>
                                            </select>
                                            <input type="hidden" name="current_url" id="current_url" value="<?php echo Router::url('/');?>admin/<?php echo $this->params['controller'];?>/index" />
									  <?php echo __('records per page');?> 
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="dataTables_filter" id="example1_filter">
                                        <label><?php echo __('Search:');?>  
                                            <input type="text" name="keyword" id="keyword" value="<?php echo (isset($this->params['named']['keyword'])) ? $this->params['named']['keyword'] : ''; ?>">
                                        </label>
                                        <button class="btn btn-primary" type="submit"><?php echo __('Search');?>  </button>
                                    </div>
                                </div>
                            </div>
								 <?php echo $this->Form->end(); ?>

                            <div id="content_manage_data">
								      <?php
										include 'ajx/listing.ctp';
										?>
                            </div>

                        </div>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div>
        </div>

    </section>
</aside>
