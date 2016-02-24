<div class="sitePermissions view">
<h2><?php  echo __('Site Permission'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sitePermission['Role']['name'], array('controller' => 'roles', 'action' => 'view', $sitePermission['Role']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sitePermission['Package']['name'], array('controller' => 'packages', 'action' => 'view', $sitePermission['Package']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Manager'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sitePermission['Manager']['name'], array('controller' => 'managers', 'action' => 'view', $sitePermission['Manager']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Read'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['is_read']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Add'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['is_add']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Edit'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['is_edit']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Delete'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['is_delete']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sitePermission['SitePermission']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Site Permission'), array('action' => 'edit', $sitePermission['SitePermission']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Site Permission'), array('action' => 'delete', $sitePermission['SitePermission']['id']), null, __('Are you sure you want to delete # %s?', $sitePermission['SitePermission']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Site Permissions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Site Permission'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Packages'), array('controller' => 'packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Package'), array('controller' => 'packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Managers'), array('controller' => 'managers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manager'), array('controller' => 'managers', 'action' => 'add')); ?> </li>
	</ul>
</div>
