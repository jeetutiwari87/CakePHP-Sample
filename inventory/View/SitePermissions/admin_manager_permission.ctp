<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>
<?php echo $this->Form->create('SitePermission',array('id'=>'DataDeleteForm')); ?>
<aside class="domains right-side">
  <section class="content-header">
    <h1> <?php echo __('Assign Permissions'); ?> <small><?php echo __('Here you can manage assign permissions');?></small> </h1>
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
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"> </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper"> 
              <div id="content_manage_data"> 
			   <?php echo $this->form->input('role_id',array('type'=>'hidden','escape'=>'false','value'=>$user_id))?>
                <table id="example1" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
						<th>Manager</th>
						<th>View</th>
						<th>Add</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
                  </thead>
                  <tbody>
                    <?php 
	foreach ($managers as $manager):
        
            ?>
                                        <tr>
                                            <td><?php echo $manager['Manager']['name'] ?>&nbsp;</td>
                                            <td>
                                            <label class="checkbox inline">
                
                  <input type="checkbox"   value="1" <?php if(isset($users_permissions[$manager['Manager']['id']]['is_read']) && $users_permissions[$manager['Manager']['id']]['is_read']==1) { ?> checked="checked" <?php } ?> name="data[Permission][is_read][<?php echo $manager['Manager']['id'];?>]"  >
                           </label>
                            </td>

                          <td> <label class="checkbox inline">
                                  <input type="checkbox"  value="1" <?php if(isset($users_permissions[$manager['Manager']['id']]['is_add']) && $users_permissions[$manager['Manager']['id']]['is_add']==1) { ?> checked="checked" <?php } ?> name="data[Permission][is_add][<?php echo $manager['Manager']['id'];?>]" >
                         </label></td>
                                  <td> <label class="checkbox inline">  <input type="checkbox"  value="1" <?php if(isset($users_permissions[$manager['Manager']['id']]['is_edit']) && $users_permissions[$manager['Manager']['id']]['is_edit']==1) { ?> checked="checked" <?php } ?> name="data[Permission][is_edit][<?php echo $manager['Manager']['id'];?>]">  </label></td>
                                   <td><label class="checkbox inline">  <input type="checkbox"  value="1" <?php if(isset($users_permissions[$manager['Manager']['id']]['is_delete']) && $users_permissions[$manager['Manager']['id']]['is_delete']==1) { ?> checked="checked" <?php } ?> name="data[Permission][is_delete][<?php echo $manager['Manager']['id'];?>]"> </label></td>

	    </tr>  
                  
                                   <?php endforeach; ?>
                   
                  </tbody>
                  <tfoot>
                    <tr>
						<th>Manager</th>
						<th>View</th>
						<th>Add</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
                  </tfoot>
                </table>
                
                
                <?php echo $this->Html->script('admin/default.js'); ?> </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
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
  </section>
  
</aside>
<?php echo $this->Form->end(); ?>
