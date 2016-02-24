<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>

<aside class="emailTemplates right-side">
  <section class="content-header">
    <h1> <?php echo __('Email Templates'); ?> <small><?php echo __('Here you can manage all Email Templates');?></small> </h1>
   <?php /*?> <ol class="breadcrumb">
      <li>
        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_add')) { ?>
        <?php echo $this->Html->link('<i class="fa fa-plus"></i>'.__('Add'), array('action' => 'add','admin'=>true), array('escape' => false, 'class' => 'btn btn-app','id'=>'Add')); ?>
        <?php } ?>
        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_delete')) { ?>
        <?php echo $this->Html->link('<i class="fa fa-lock"></i>'.__('Delete'), 'javascript:void(0);', array('escape' => false, 'class' => 'btn btn-app DeleteallRecord')); ?>
        <?php } ?>
      </li>
    </ol><?php */?>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"> </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <div role="grid" class="dataTables_wrapper form-inline" id="example1_wrapper"> <?php echo $this->Form->create('EmailTemplate',array('id'=>'DataForm')); ?>
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
                <div class="col-xs-6">
                  <div class="dataTables_filter" id="example1_filter">
                    <label><?php echo __('Search:');?>
                    <input type="text" name="keyword" id="keyword" value="<?php echo (isset($this->params['named']['keyword'])) ? $this->params['named']['keyword'] : ''; ?>">
                    </label>
                    <button class="btn btn-primary" type="submit"><?php echo __('Search');?> </button>
                  </div>
                </div>
              </div>
              <?php echo $this->Form->end(); ?>
              <div id="content_manage_data"> <?php echo $this->Form->create('EmailTemplate',array('id'=>'DataDeleteForm','action'=>'deleteall')); ?>
                <table id="example1" class="table table-bordered table-hover table-striped">
                  <thead>
                    <tr>
                      <?php /*?><th class="hidecolumns"><input type="checkbox" name="deleteall" class="deleteall" /></th><?php */?>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('id'); ?></th>
                      <th><?php echo $this->Paginator->sort('subject'); ?></th>
                      
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('from'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('reply_to_email'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('status'); ?></th>
                     
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('created'); ?></th>
                      
                      <th><?php echo __('Actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($emailTemplates) >0):
foreach ($emailTemplates as $emailTemplate): ?>
                    <tr>
                      <?php /*?><td class="hidecolumns"><input class="check1" type="checkbox" name="ids[]" value='<?php echo h($emailTemplate['EmailTemplate']['id']); ?>' /></td><?php */?>
                      <td  class='hidecolumns'><?php echo h($emailTemplate['EmailTemplate']['id']); ?>&nbsp;</td>
                    
                      <td><?php echo h($emailTemplate['EmailTemplate']['subject']); ?>&nbsp;</td>
                      
                      <td  class='hidecolumns'><?php echo h($emailTemplate['EmailTemplate']['from']); ?>&nbsp;</td>
                      <td  class='hidecolumns'><?php echo h($emailTemplate['EmailTemplate']['reply_to_email']); ?>&nbsp;</td>
                      <td class="hidecolumns"><?php if ($emailTemplate['EmailTemplate']['status'] == '1'): ?>
                        <?php echo '<span class="label label-success">'.__('Active').'</span>' //$this->Html->link(, array('action' => 'update_status', $emailTemplate['EmailTemplate']['id'],$emailTemplate['EmailTemplate']['status'],'admin'=>true), array('escape' => false,'class'=>'status')); ?>
                        <?php else: ?>
                        <?php echo '<span class="label label-warning">'.__('Inactive').'</span>'; //$this->Html->link(, array('action' => 'update_status', $emailTemplate['EmailTemplate']['id'],$emailTemplate['EmailTemplate']['status'],'admin'=>true), array('escape' => false,'class'=>'status')); ?>
                        <?php endif; ?></td>
                     
                      <td  class=\'hidecolumns'><?php echo date(Configure::read('site.admin_date_format'), strtotime($emailTemplate['EmailTemplate']['created'])); ?>&nbsp;</td>
                      
                      <td class="actions\ center"><?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_read')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-pause"></i>'.__('View'), array('action' => 'view', $emailTemplate['EmailTemplate']['id']),array('escape' => false,'class'=>'btn btn-app view')); ?>
                        <?php } ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_edit')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>'.__('Edit'), array('action' => 'edit', $emailTemplate['EmailTemplate']['id']), array('escape' => false,'class'=>'btn btn-app edit')); ?>
                        <?php } ?>
                        <?php /*?><?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'emailTemplates', 'is_delete')) { ?>
                        <?php echo $this->Html->link('<i class="fa fa-lock"></i>Delete', array('action' => 'delete', $emailTemplate['EmailTemplate']['id']), array('escape' => false, 'class' => 'btn btn-app delete')); ?>
                        <?php } ?><?php */?>
                      </td>
                    </tr>
                    <?php endforeach;  else: ?>
                    <tr>
                      <td colspan='8'><?php echo __('No Record found');?></td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <?php /*?><th class="hidecolumns"><input type="checkbox" name="deleteall" class="deleteall" /></th><?php */?>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('id'); ?></th>
                     
                      <th><?php echo $this->Paginator->sort('subject'); ?></th>
                    
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('from'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('reply_to_email'); ?></th>
                      <th class="hidecolumns"><?php echo $this->Paginator->sort('status'); ?></th>
                    
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
