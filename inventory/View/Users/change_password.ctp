<div class="page-content">
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
					Change Password <small>Here you can change your account password</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('Home', array('controller' => 'users', 'action' => 'dashboard',"admin"=>false),array("escape"=>false)); ?>

						<span class="icon-angle-right"></span></li>

					<li>Change Password</li>
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
									<i class="icon-reorder"></i>Change Password
								</h4>

							</div>

							<div class="portlet-body form">


								<!-- BEGIN FORM-->
							<?php echo $this->Form->create('User',array('type' => 'file','class'=>'user_form')); ?>

								<div class="alert alert-error hide">
									<button class="close" data-dismiss="alert"></button>
									<span>Please fill all the required fields.</span>
								</div>
								<div class="row-fluid">

									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="firstName">Old Password</label>
											<div class="controls">
                                             <?php echo $this->Form->input('old_password', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "Old Password is required!","type"=>"password")); ?>
											
											</div>
										</div>
									</div>
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="lastName">New Password</label>
											<div class="controls">
												<?php echo $this->Form->input('password', array("id"=>"password","label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "New Password is required!","type"=>"password")); ?>
                							</div>
										</div>
									</div>
								</div>
								<div class="row-fluid">
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="password">Confirm Password</label>
											<div class="controls"><?php echo $this->Form->input('confirm_password', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required,equals[password]]  inp-2" ,"data-errormessage-value-missing" => "Confirm Password is required!","type"=>"password")); ?>											
											</div>
										</div>
									</div>


								</div>
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
jQuery(document).ready(function(){
    // binds form submission and fields to the validation engine
    jQuery("#UserChangePasswordForm").validationEngine({promptPosition : "bottomLeft"});
 });

</script>
