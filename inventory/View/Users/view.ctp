<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Settings'), array('controller' => 'client_settings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Setting'), array('controller' => 'client_settings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Client Stores'), array('controller' => 'client_stores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client Store'), array('controller' => 'client_stores', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Client Settings'); ?></h3>
	<?php if (!empty($user['ClientSetting'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Quantity Of Locations'); ?></th>
		<th><?php echo __('Input Of Address'); ?></th>
		<th><?php echo __('Contact Info'); ?></th>
		<th><?php echo __('Frequency Of Evaluations'); ?></th>
		<th><?php echo __('Cycle Of Evaluations'); ?></th>
		<th><?php echo __('Amount Of Locations'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['ClientSetting'] as $clientSetting): ?>
		<tr>
			<td><?php echo $clientSetting['id']; ?></td>
			<td><?php echo $clientSetting['user_id']; ?></td>
			<td><?php echo $clientSetting['quantity_of_locations']; ?></td>
			<td><?php echo $clientSetting['input_of_address']; ?></td>
			<td><?php echo $clientSetting['contact_info']; ?></td>
			<td><?php echo $clientSetting['frequency_of_evaluations']; ?></td>
			<td><?php echo $clientSetting['cycle_of_evaluations']; ?></td>
			<td><?php echo $clientSetting['amount_of_locations']; ?></td>
			<td><?php echo $clientSetting['created']; ?></td>
			<td><?php echo $clientSetting['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'client_settings', 'action' => 'view', $clientSetting['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'client_settings', 'action' => 'edit', $clientSetting['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'client_settings', 'action' => 'delete', $clientSetting['id']), null, __('Are you sure you want to delete # %s?', $clientSetting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client Setting'), array('controller' => 'client_settings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Client Stores'); ?></h3>
	<?php if (!empty($user['ClientStore'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Store Group Id'); ?></th>
		<th><?php echo __('Store Name'); ?></th>
		<th><?php echo __('Store Number'); ?></th>
		<th><?php echo __('Store District'); ?></th>
		<th><?php echo __('Store Region'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['ClientStore'] as $clientStore): ?>
		<tr>
			<td><?php echo $clientStore['id']; ?></td>
			<td><?php echo $clientStore['user_id']; ?></td>
			<td><?php echo $clientStore['store_group_id']; ?></td>
			<td><?php echo $clientStore['store_name']; ?></td>
			<td><?php echo $clientStore['store_number']; ?></td>
			<td><?php echo $clientStore['store_district']; ?></td>
			<td><?php echo $clientStore['store_region']; ?></td>
			<td><?php echo $clientStore['created']; ?></td>
			<td><?php echo $clientStore['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'client_stores', 'action' => 'view', $clientStore['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'client_stores', 'action' => 'edit', $clientStore['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'client_stores', 'action' => 'delete', $clientStore['id']), null, __('Are you sure you want to delete # %s?', $clientStore['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Client Store'), array('controller' => 'client_stores', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
