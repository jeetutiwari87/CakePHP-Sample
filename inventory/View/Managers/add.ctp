<div class="managers form">
<?php echo $this->Form->create('Manager'); ?>
	<fieldset>
		<legend><?php echo __('Add Manager'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Managers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Site Permissions'), array('controller' => 'site_permissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Permission'), array('controller' => 'site_permissions', 'action' => 'add')); ?> </li>
	</ul>
</div>
