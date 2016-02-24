<div class="sitePermissions form">
<?php echo $this->Form->create('SitePermission'); ?>
	<fieldset>
		<legend><?php echo __('Edit Site Permission'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id');
		echo $this->Form->input('package_id');
		echo $this->Form->input('manager_id');
		echo $this->Form->input('is_read');
		echo $this->Form->input('is_add');
		echo $this->Form->input('is_edit');
		echo $this->Form->input('is_delete');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SitePermission.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SitePermission.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Site Permissions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Managers'), array('controller' => 'managers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manager'), array('controller' => 'managers', 'action' => 'add')); ?> </li>
	</ul>
</div>
