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
				<h3 class="page-title">
					Edit Site Permission <small>Here you can add your Site Permission</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard',"admin"=>true),array("escape"=>false)); ?>
						<i class="icon-angle-right"></i>
					</li>
					<li><?php echo $this->Html->link('Site Permissions', array('controller' => 'site_permissions', 'action' => 'index',"admin"=>true),array("escape"=>false)); ?>
						<i class="icon-angle-right"></i>
					</li>
					<li>Edit Site Permission
					</li>
				</ul>
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="tabbable tabbable-custom boxless">

					<div class="tab-content">
						<div class="portlet box blue">
							<div class="portlet-title">
								<h4>
									<i class="icon-reorder"></i>Edit Site Permission
								</h4>

							</div>

							<div class="portlet-body form">


								<!-- BEGIN FORM-->
							<?php echo $this->Form->create('SitePermission',array('type' => 'file','class'=>'user_form')); ?>
<?php echo $this->Form->input('id'); ?>
								<div class="alert alert-error hide">
									<button class="close" data-dismiss="alert"></button>
									<span>Please fill all the required fields.</span>
								</div>
								<div class="row-fluid">

									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="title">Role</label>
											<div class="controls">
											<?php echo $this->Form->input('role_id', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "Role is required!","empty"=>"Select Role")); ?>
												<span class="help-block">Here you can add role.</span>
											</div>
										</div>
									</div>
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="title">Manager</label>
											<div class="controls">
											<?php echo $this->Form->input('manager_id', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "Manager is required!","empty"=>"Select Manager")); ?>
												<span class="help-block">Here you can add Manager.</span>
											</div>
										</div>
									</div>
							
								</div>
								
								<div class="row-fluid">

								<div class="span6 ">
										<div class="control-group">
											<label class="control-label">View</label>
											<div class="controls">
												<div class="basic-toggle-button">
												<?php echo $this->Form->input('is_read', array("label" => false, "div" => false, "class" => "toggle")); ?>

												</div>
											</div>
										</div>
									</div>
								<div class="span6 ">
										<div class="control-group">
											<label class="control-label">Add</label>
											<div class="controls">
												<div class="basic-toggle-button">
												<?php echo $this->Form->input('is_add', array("label" => false, "div" => false, "class" => "toggle")); ?>

												</div>
											</div>
										</div>
									</div>	
									
							
								</div>
								<div class="row-fluid">

								<div class="span6 ">
										<div class="control-group">
											<label class="control-label">Edit</label>
											<div class="controls">
												<div class="basic-toggle-button">
												<?php echo $this->Form->input('is_edit', array("label" => false, "div" => false, "class" => "toggle")); ?>

												</div>
											</div>
										</div>
									</div>
								<div class="span6 ">
										<div class="control-group">
											<label class="control-label">Delete</label>
											<div class="controls">
												<div class="basic-toggle-button">
												<?php echo $this->Form->input('is_delete', array("label" => false, "div" => false, "class" => "toggle")); ?>

												</div>
											</div>
										</div>
									</div>	
									
							
								</div>
								<div class="row-fluid">

								<div class="span6 ">
										<div class="control-group">
											<label class="control-label">Status</label>
											<div class="controls">
												<div class="basic-toggle-button">
												<?php echo $this->Form->input('status', array("label" => false, "div" => false, "class" => "toggle")); ?>

												</div>
											</div>
										</div>
									</div>
																
							
								</div>
								
							
								<!--/row-->
								
								<div class="form-actions">
									<button type="submit" class="btn blue">
										<i class="icon-ok"></i> Save
									</button>

									<button type="button" onclick="javascript:history.back(1)"
										class="btn">Cancel</button>
								</div>
								<?php echo $this->Form->end(); ?>
								<!-- END FORM-->
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>

<script type="text/javascript">
 jQuery(window).load(function(){
    // binds form submission and fields to the validation engine
    jQuery("#SitePermissionAdminEditForm").validationEngine({promptPosition : "bottomLeft"});
    	
    
 });

 
</script>
