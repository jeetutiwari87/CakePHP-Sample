<?php echo $this->Form->create('User', array("id" => "DataDeleteForm", 'action' => "deleteall")); ?>
<table id="example1" class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th class="hidecolumns"><input type="checkbox" name="deleteall" class="deleteall" /></th>
            <th><?php echo __($this->Paginator->sort('first_name', 'Name')); ?></th>
			<th class="hidecolumns"><?php echo __($this->Paginator->sort('role_id', 'User Type')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('email')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('status')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('created', 'Date Added')); ?></th>
            <th><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
<?php
if (count($users) > 0):
    foreach ($users as $user):
        ?>
                <tr>
                    <td class="hidecolumns"><input class="check1" type="checkbox" name="ids[]" value="<?php echo $user['User']['id']; ?>" /></td>
                    <td><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></td>
					 <td class="hidecolumns"><?php echo $user['Role']['name']; ?></td>
                    <td class="hidecolumns"><?php echo $user['User']['email']; ?></td>
                    <td class="hidecolumns">
        <?php if ($user['User']['status'] == '1'): ?>
                            <?php echo $this->Html->link('<span class="label label-success">Active</span>', array('controller' => 'users', 'action' => 'update_status', $user['User']['id'], $user['User']['status'], "admin" => true), array("escape" => false, "class" => "status")); ?>

                        <?php else: ?>
                            <?php echo $this->Html->link('<span class="label label-warning">Inactive</span>', array('controller' => 'users', 'action' => 'update_status', $user['User']['id'], 0, "admin" => true), array("escape" => false, "class" => "status")); ?>


        <?php endif; ?>
                    </td>
                    <td class="hidecolumns"><?php echo date(Configure::read('site.admin_date_format'), strtotime($user['User']['created'])); ?></td>
                    <td>
        <?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'users','is_read')) { ?>
          <?php echo $this->Html->link('<i class="fa fa-pause"></i>View', array('controller' => 'users', 'action' => 'view',"admin"=>true, $user['User']['id']), array("escape" => false, "class" => "btn btn-app view")); ?>
          <?php }  ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_edit')) { ?>
                            <?php echo $this->Html->link('<i class="fa fa-edit"></i>Edit', array('controller' => 'users', 'action' => 'edit', "admin" => true, $user['User']['id']), array("escape" => false, "class" => "btn btn-app edit")); ?>
                        <?php } ?>
                     
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_edit') && $user['User']['role_id'] == '5') { ?>
                            <?php echo $this->Html->link('<i class="fa fa-users"></i>Make as Seller', array('controller' => 'users', 'action' => 'moveotseller', "admin" => true, $user['User']['id']), array("escape" => false, "class" => "btn btn-app edit")); ?>
                        <?php } ?>
                        <?php if ($permission_obj->CheckPermission($UsersDetails['role_id'], 'users', 'is_delete')) { ?>
                            <?php echo $this->Html->link('<i class="fa fa-lock"></i>Delete', array('action' => 'delete', $user['User']['id']), array("escape" => false, "class" => "btn btn-app delete")); ?>
                        <?php } ?> 
                    </td>
                </tr>
    <?php endforeach;
else: ?> 
            <tr><td colspan="5"><?php echo __('No Record found'); ?></td></tr>
        <?php endif; ?>



    </tbody>
    <tfoot>
        <tr>
            <th class="hidecolumns"><input type="checkbox" name="deleteall" class="deleteall" /></th>
            <th><?php echo __($this->Paginator->sort('first_name', 'Name')); ?></th>
			<th class="hidecolumns"><?php echo __($this->Paginator->sort('role_id', 'User Type')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('email')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('status')); ?></th>
            <th class="hidecolumns"><?php echo __($this->Paginator->sort('created', 'Date Added')); ?></th>
            <th><?php echo __('Actions'); ?></th>
        </tr>
    </tfoot>
</table>
<?php echo $this->Form->end(); ?>


<div class="row">
    <div class="col-xs-6">
        <div class="dataTables_info" id="example1_info"><?php
echo $this->Paginator->counter(array(
    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?></div>
    </div>
    <div class="col-xs-6">
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                <?php
                echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'prev disabled', 'disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                echo $this->Paginator->next(__('Next'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'next disabled', 'disabledTag' => 'a'));
                ?>

            </ul>
        </div>
    </div>
</div>
<?php echo $this->Html->script('admin/default.js'); ?>									  