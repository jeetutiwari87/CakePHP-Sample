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
					Managers <small>Here you can manage your all the permission Managers
						listings</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard',"admin"=>true),array("escape"=>false)); ?>
						<i class="icon-angle-right"></i>
					</li>
					<li>Managers
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
							<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'managers','is_add')) { ?>
								<span id="sample_editable_1_new" class="btn green"> <?php echo $this->Html->link('Add Manager <i class="icon-plus"></i>', array('controller' => 'managers', 'action' => 'add',"admin"=>true),array("escape"=>false)); ?>
								</span>
						
								<?php } ?>
							</div>
						</div>
						<?php echo $this->Form->create('Manager'); ?>

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
								
                                    <th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('name'); ?></th>
									<th class="hidden-480"><?php echo $this->Paginator->sort('status'); ?></th>
									<th class="hidden-480"><?php echo $this->Paginator->sort('created'); ?></th>
									<th class="hidden-480"><?php echo $this->Paginator->sort('modified'); ?></th>
									
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							<?php   $len = count($managers); if($len >0):
							foreach ($managers as $manager): ?>
								<tr class="odd gradeX">
									
									
									<td><?php echo h($manager['Manager']['id']); ?>&nbsp;</td>
								<td ><?php echo h($manager['Manager']['name']); ?>&nbsp;</td>
								<td class="hidden-480">
								<?php if($manager['Manager']['status']=='1'): ?>
								<span class="label label-success">Active</span>
								<?php else: ?>
								<span class="label">Inactive</span>
								<?php endif;?>
								</td>
								<td class="hidden-480"><?php echo date(Configure::read('site.admin_date_format'),strtotime($manager['Manager']['created'])); ?>&nbsp;</td>
								<td  class="hidden-480"><?php echo date(Configure::read('site.admin_date_format'),strtotime($manager['Manager']['modified'])); ?>&nbsp;</td>
								<td class="center actions">
									<?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'managers','is_edit')) { ?>
									<?php echo $this->Html->link('Edit', array('action' => 'edit', $manager['Manager']['id']), array("escape" => false, "class" => "btn mini green-stripe")); ?>
									<?php } ?> <?php if($permission_obj->CheckPermission($UsersDetails['role_id'],'managers','is_delete')) { ?>
									<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $manager['Manager']['id']), array("escape" => false, "class" => "btn mini red-stripe"), __('Are you sure you want to delete # %s?', $manager['Manager']['id'])); ?>
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
						<div class="clearfix">
							
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