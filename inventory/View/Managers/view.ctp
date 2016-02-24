<div class="managers view">
<h2><?php  echo __('Manager'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($manager['Manager']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manager'), array('action' => 'edit', $manager['Manager']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Manager'), array('action' => 'delete', $manager['Manager']['id']), null, __('Are you sure you want to delete # %s?', $manager['Manager']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Managers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manager'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Permissions'), array('controller' => 'site_permissions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Permission'), array('controller' => 'site_permissions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Site Permissions'); ?></h3>
	<?php if (!empty($manager['SitePermission'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Package Id'); ?></th>
		<th><?php echo __('Manager Id'); ?></th>
		<th><?php echo __('Is Read'); ?></th>
		<th><?php echo __('Is Add'); ?></th>
		<th><?php echo __('Is Edit'); ?></th>
		<th><?php echo __('Is Delete'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($manager['SitePermission'] as $sitePermission): ?>
		<tr>
			<td><?php echo $sitePermission['id']; ?></td>
			<td><?php echo $sitePermission['role_id']; ?></td>
			<td><?php echo $sitePermission['package_id']; ?></td>
			<td><?php echo $sitePermission['manager_id']; ?></td>
			<td><?php echo $sitePermission['is_read']; ?></td>
			<td><?php echo $sitePermission['is_add']; ?></td>
			<td><?php echo $sitePermission['is_edit']; ?></td>
			<td><?php echo $sitePermission['is_delete']; ?></td>
			<td><?php echo $sitePermission['created']; ?></td>
			<td><?php echo $sitePermission['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'site_permissions', 'action' => 'view', $sitePermission['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'site_permissions', 'action' => 'edit', $sitePermission['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'site_permissions', 'action' => 'delete', $sitePermission['id']), null, __('Are you sure you want to delete # %s?', $sitePermission['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Site Permission'), array('controller' => 'site_permissions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
