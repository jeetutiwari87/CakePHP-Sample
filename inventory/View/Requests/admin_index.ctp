<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>

<aside class="requests right-side">
  <section class="content-header">
    <h1> <?php echo __('Requisition Histories'); ?> <small><?php echo __('Here you can manage all Requisition History');?></small> </h1>
    <ol class="breadcrumb">
      <li>
       
        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_delete')) { ?>
        <?php echo $this->Html->link('<i class="fa fa-lock"></i>'.__('Delete'), 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-app DeleteallRecord')); ?>
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
            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper"> <?php echo $this->Form->create('Request',array('id'=>'DataForm')); ?>
              <div class="row">
                <div class="col-xs-6">
                  <div id="example1_length" class="dataTables_length">
                    <label>
                    <select name="showperpage" <?php if($is_ajax!='1') { ?> onchange="$('form:first').submit();" <?php } ?> id="showperpage" size="1" aria-controls="sample_1" class="m-wrap xsmall">
                      <?php foreach (Configure::read('Admin.showperpage') as $showpage): ?>
                      <option value="<?php echo $showpage; ?>"
											<?php if ($showpage == $limit) { ?> selected="selected"
											 <?php } ?>> <?php echo $showpage; ?> </option>
                      <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="current_url" id="current_url" value="<?php echo Router::url('/');?>admin/<?php echo $this->params['controller'];?>/index" />
                    <?php echo __('records per page');?> </label>
                  </div>
                </div>
                
              </div>
              <?php echo $this->Form->end(); ?>
              <div id="content_manage_data"> <?php echo $this->Form->create('Request',array('id'=>'DataDeleteForm','action'=>'deleteall')); ?>
                <table id="example1" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                     
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('id'); ?></th>
                      <th><?php echo $this->Paginator->sort('request_for'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('collectiondate'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('request_status'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('created'); ?></th>
                      <th><?php echo __('Actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($requests) >0):
foreach ($requests as $request): ?>
                    <tr>
                     
                      <td  class='hidecolumns'><?php echo h($request['Request']['id']); ?>&nbsp;</td>
                      <td><?php echo h($request['Request']['request_for']); ?>&nbsp;</td>
                      <td  class='hidecolumns'><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['collectiondate'])); ?>&nbsp;</td>
                      <td  class='hidecolumns'>
					    <?php if ($request['Request']['request_status'] == '0'): ?>
                        <?php echo '<span class="label label-info">'.__('Pending').'</span>'; ?>
                        <?php elseif ($request['Request']['request_status'] == '1'): ?>
						 <?php echo '<span class="label label-success">'.__('Approved').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '2'): ?>
						 <?php echo '<span class="label label-danger">'.__('Rejected').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '3'): ?>
						 <?php echo '<span class="label label-warning">'.__('Collected').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '4'): ?>
						 <?php echo '<span class="label label-info">'.__('Returned').'</span>'; ?>
						  <?php elseif ($request['Request']['request_status'] == '5'): ?>
						 <?php echo '<span class="label label-warning">'.__('Returned incomplete').'</span>'; ?>
						<?php else: ?>
                        <?php echo '<span class="label label-warning">'.__('Returned ok').'</span>'; ?>
                        <?php endif; ?>
					  </td>
                      <td  class=\'hidecolumns'><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['created'])); ?>&nbsp;</td>
                      <td class="actions\ center"><?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_read')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-pause"></i>'.__('View'), array('action' => 'view', $request['Request']['id']),array('escape' => false,'class'=>'btn btn-app view')); ?>
                        <?php } ?>
						<?php if ($request['Request']['request_status'] == '3'): ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_edit')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>'.__('Return'), array('action' => 'return', $request['Request']['id']), array('escape' => false,'class'=>'btn btn-app edit')); ?>
                        <?php } ?>
						<?php endif;?>
						
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'requisition_history', 'is_delete')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-lock"></i>Delete', array('action' => 'delete', $request['Request']['id']), array('escape' => false, 'class' => 'btn btn-app delete')); ?>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php endforeach;  else: ?>
                    <tr>
                      <td colspan='6'><?php echo __('No Record found');?></td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('id'); ?></th>
                      <th><?php echo $this->Paginator->sort('request_for'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('collectiondate'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('request_status'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('created'); ?></th>
                      <th><?php echo __('Actions'); ?></th>
                    </tr>
                  </tfoot>
                </table>
                <?php echo $this->Form->end(); ?>
                <div class="row">
                  <div class="col-xs-6">
                    <div class="dataTables_info" id="example1_info">
                      <?php
								echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
								));
								?>
                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="dataTables_paginate paging_bootstrap">
                      <ul class="pagination">
                        <?php
												echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'prev disabled','disabledTag' => 'a'));
												echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
												echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'next disabled','disabledTag' => 'a'));
												?>
                      </ul>
                    </div>
                  </div>
                </div>
                <?php echo $this->Html->script('admin/default.js'); ?> </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</aside>
