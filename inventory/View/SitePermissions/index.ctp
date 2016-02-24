<div class="sitePermissions index">
	<h2><?php echo __('Site Permissions'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th><?php echo $this->Paginator->sort('package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('manager_id'); ?></th>
			<th><?php echo $this->Paginator->sort('is_read'); ?></th>
			<th><?php echo $this->Paginator->sort('is_add'); ?></th>
			<th><?php echo $this->Paginator->sort('is_edit'); ?></th>
			<th><?php echo $this->Paginator->sort('is_delete'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($sitePermissions as $sitePermission): ?>
	<tr>
		<td><?php echo h($sitePermission['SitePermission']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sitePermission['Role']['name'], array('controller' => 'roles', 'action' => 'view', $sitePermission['Role']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sitePermission['Package']['name'], array('controller' => 'packages', 'action' => 'view', $sitePermission['Package']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sitePermission['Manager']['name'], array('controller' => 'managers', 'action' => 'view', $sitePermission['Manager']['id'])); ?>
		</td>
		<td><?php echo h($sitePermission['SitePermission']['is_read']); ?>&nbsp;</td>
		<td><?php echo h($sitePermission['SitePermission']['is_add']); ?>&nbsp;</td>
		<td><?php echo h($sitePermission['SitePermission']['is_edit']); ?>&nbsp;</td>
		<td><?php echo h($sitePermission['SitePermission']['is_delete']); ?>&nbsp;</td>
		<td><?php echo h($sitePermission['SitePermission']['created']); ?>&nbsp;</td>
		<td><?php echo h($sitePermission['SitePermission']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sitePermission['SitePermission']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sitePermission['SitePermission']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sitePermission['SitePermission']['id']), null, __('Are you sure you want to delete # %s?', $sitePermission['SitePermission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Site Permission'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Managers'), array('controller' => 'managers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manager'), array('controller' => 'managers', 'action' => 'add')); ?> </li>
	</ul>
</div>
