<?php app::import("Model","SitePermission");
$permission_obj=new SitePermission();
//pr($users);die;

?>

<div
	class="page-content">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN STYLE CUSTOMIZER -->
				<!-- END BEGIN STYLE CUSTOMIZER -->
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Manage Site Permissions <small>Here you can manage your all the Site Permissions
						listings</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard',"admin"=>true),array("escape"=>false)); ?>
						<i class="icon-angle-right"></i>
					</li>
					<li><?php echo $this->Html->link('Manage Site Permissions', array('controller' => 'site_permissions', 'action' => 'index',"admin"=>true),array("escape"=>false)); ?>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN EXAMPLE TABLE PORTLET-->
				<div class="portlet box light-grey">
					<div class="portlet-body">
						<div class="clearfix">
							<div class="btn-group pull-right">
							<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'site_permissions','is_add')) { ?>
								<span id="sample_editable_1_new" class="btn green"> <?php echo $this->Html->link('Add Site Permission <i class="icon-plus"></i>', array('controller' => 'site_permissions', 'action' => 'add',"admin"=>true),array("escape"=>false)); ?>
								</span>
								
							
								
								<?php } ?>
							</div>
						</div>
						<?php echo $this->Form->create('SitePermission'); ?>

						<div class="row-fluid">
							<div class="span6">
								<div id="sample_1_length" class="dataTables_length">
									<label> <select name="showperpage"
										onchange="$('form:first').submit();" size="1"
										aria-controls="sample_1" class="m-wrap xsmall">
										<?php foreach (Configure::read('Admin.showperpage') as $showpage): ?>
											<option value="<?php echo $showpage; ?>"
											<?php if ($showpage == $limit) { ?> selected="selected"
											<?php } ?>>
												<?php echo $showpage; ?>
											</option>
											<?php endforeach; ?>
									</select> records per page</label>
								</div>
							</div>
							<div class="span6">
								<div class="dataTables_filter" id="sample_1_filter">
									<label>Search: <input type="text" name="keyword"
										class="m-wrap medium"
										value="<?php echo (isset($this->params['named']['keyword'])) ? $this->params['named']['keyword'] : ''; ?>">

									</label>
								</div>
							</div>
						</div>
						<?php echo $this->Form->end(); ?>
						<table class="table table-striped table-bordered table-hover"
							id="sample_1">
							<thead>
								<tr>
								   
								      <th><?php echo __('Permission For'); ?></th>
									  <th class="hidden-480"><?php echo $this->Paginator->sort('is_read','Read'); ?></th>
									 <th class="hidden-480"><?php echo $this->Paginator->sort('is_add','Add'); ?></th>
									 <th class="hidden-480"><?php echo $this->Paginator->sort('is_edit','Edit'); ?></th>
									 <th class="hidden-480"><?php echo $this->Paginator->sort('is_delete','Delete'); ?></th>
									 <th class="hidden-480"><?php echo $this->Paginator->sort('status'); ?></th>
								 								
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php   $len = count($sitePermissions); if($len >0):
							foreach ($sitePermissions as $sitePermission): ?>
								<tr>
									<td>
									Role: <?php echo $sitePermission['Role']['name']; ?><br />
								
								Manager: <?php echo ucfirst(str_replace("_"," ",$sitePermission['Manager']['name'])); ?>
								
								<td class="hidden-480">
									<?php if($sitePermission['SitePermission']['is_read']=='1'): ?>
								<span class="label label-success">Yes</span>
								<?php else: ?>
								<span class="label label-inactive">No</span>
								<?php endif;?>
								</td>
								<td class="hidden-480">
								<?php if($sitePermission['SitePermission']['is_add']=='1'): ?>
								<span class="label label-success">Yes</span>
								<?php else: ?>
								<span class="label label-inactive">No</span>
								<?php endif;?>
								</td>
								<td class="hidden-480">
									<?php if($sitePermission['SitePermission']['is_edit']=='1'): ?>
								<span class="label label-success">Yes</span>
								<?php else: ?>
								<span class="label label-inactive">No</span>
								<?php endif;?>
								</td>
								<td class="hidden-480">
								<?php if($sitePermission['SitePermission']['is_delete']=='1'): ?>
								<span class="label label-success">Yes</span>
								<?php else: ?>
								<span class="label label-inactive">No</span>
								<?php endif;?></td>
								<td class="hidden-480">
								<?php if($sitePermission['SitePermission']['status']=='1'): ?>
								<span class="label label-success">Active</span>
								<?php else: ?>
								<span class="label">Inactive</span>
								<?php endif;?>
								</td>
								
									</td>
									<td class="center">
									<?php /*?><?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'site_permissions','is_read')) { ?>
									<?php echo $this->Html->link('View', array('action' => 'view', $sitePermission['SitePermission']['id']),array("escape"=>false,"class"=>"btn mini green-stripe")); ?>
									<?php } ?>
									<?php */?>
									<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'site_permissions','is_edit')) { ?>
									<?php echo $this->Html->link('Edit', array('action' => 'edit', $sitePermission['SitePermission']['id']),array("escape"=>false,"class"=>"btn mini green-stripe")); ?>
									<?php } ?>
									
									<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'site_permissions','is_delete')) { ?>
									<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $sitePermission['SitePermission']['id']), array("escape"=>false,"class"=>"btn mini red-stripe"), __('Are you sure you want to delete # %s?', $sitePermission['SitePermission']['id'])); ?>
									<?php } ?>
								
									</td>
								</tr>
								<?php endforeach; ?>
								<?php else :?>
								<tr odd gradeX>
									<td colspan="6">No records to display</td>
								</tr>
								<?php endif; ?>

							</tbody>
						</table>

						<div class="row-fluid">
							<div class="span6">
								<div class="dataTables_info" id="sample_1_info">
								<?php
								echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
								));
								?>
								</div>
							</div>
							<div class="span6">
								<div class="dataTables_paginate paging_bootstrap pagination">
									<ul>
									<?php
									echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'prev disabled','disabledTag' => 'a'));
									echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
									echo $this->Paginator->next(__('Next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'next disabled','disabledTag' => 'a'));
									?>
									</ul>

								</div>
							</div>
						</div>
						
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>
	