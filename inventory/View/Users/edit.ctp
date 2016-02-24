<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('status');
		echo $this->Form->input('last_login');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Settings'), array('controller' => 'client_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Setting'), array('controller' => 'client_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Stores'), array('controller' => 'client_stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Store'), array('controller' => 'client_stores', 'action' => 'add')); ?> </li>
	</ul>
</div>
