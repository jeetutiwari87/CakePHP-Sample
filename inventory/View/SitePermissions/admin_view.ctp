<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header well" data-original-title>
      <h2><i class="icon-edit"></i> <?php  echo __('Manager Details'); ?></h2>
      <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> </div>
    </div>
	<div class="box-content">
    <div class="roles view">
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
		<dt><?php echo __('Read'); ?></dt>
		<dd>
		<?php if($sitePermission['SitePermission']['is_read']=='1'): ?>
				<span class="label label-success">Yes</span>
				<?php else: ?>
				<span class="label label-inactive">No</span>
			<?php endif;?>
			
		</dd>
		<dt><?php echo __('Add'); ?></dt>
		<dd>
			<?php if($sitePermission['SitePermission']['is_add']=='1'): ?>
				<span class="label label-success">Yes</span>
				<?php else: ?>
				<span class="label label-inactive">No</span>
			<?php endif;?>
		</dd>
		<dt><?php echo __('Edit'); ?></dt>
		<dd>
		<?php if($sitePermission['SitePermission']['is_edit']=='1'): ?>
				<span class="label label-success">Yes</span>
				<?php else: ?>
				<span class="label label-inactive">No</span>
			<?php endif;?>
			
			&nbsp;
		</dd>
		<dt><?php echo __('Delete'); ?></dt>
		<dd>
		<?php if($sitePermission['SitePermission']['is_delete']=='1'): ?>
				<span class="label label-success">Yes</span>
				<?php else: ?>
				<span class="label label-inactive">No</span>
			<?php endif;?>
			
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php if($sitePermission['SitePermission']['status']=='1'): ?>
				<span class="label label-success">Active</span>
				<?php else: ?>
				<span class="label">Inactive</span>
			<?php endif;?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo date(Configure::read('site.admin_date_format'),strtotime($sitePermission['SitePermission']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo date(Configure::read('site.admin_date_format'),strtotime($sitePermission['SitePermission']['modified'])); ?>
			&nbsp;
		</dd>
		
	</dl>
	</div>
       </div>
  </div>
  </div>
  <!--/span-->
</div>