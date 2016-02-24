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
			<?php if($manager['Manager']['status']=='1'): ?>
			<span class="label label-success">Active</span>
			<?php else: ?>
			<span class="label">Inactive</span>
			<?php endif;?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo date(Configure::read('site.admin_date_format'),strtotime($manager['Manager']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo date(Configure::read('site.admin_date_format'),strtotime($manager['Manager']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
	</div>
       </div>
  </div>
  </div>
  <!--/span-->
</div>