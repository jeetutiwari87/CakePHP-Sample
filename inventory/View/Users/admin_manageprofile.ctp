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
					Manage Profile <small>Here you can edit your profile informations</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('Home', array('controller' => 'dashboard', 'action' => 'index',"admin"=>true),array("escape"=>false)); ?>

						<span class="icon-angle-right"></span></li>

					<li>Manage Profile</li>
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
									<i class="icon-reorder"></i>Edit Profile
								</h4>

							</div>

							<div class="portlet-body form">


								<!-- BEGIN FORM-->
							<?php echo $this->Form->create('User',array('type' => 'file','class'=>'user_form')); ?>
							<?php echo $this->Form->input('id');?>
                            <?php echo $this->Form->input('usernametext',array("type"=>"hidden","value"=>@$this->request->data['User']['username']));?>
								<div class="alert alert-error hide">
									<button class="close" data-dismiss="alert"></button>
									<span>Please fill all the required fields.</span>
								</div>
								<div class="row-fluid">

									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="firstName">First name</label>
											<div class="controls">
											<?php echo $this->Form->input('first_name', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "Firstname is required!")); ?>
												<span class="help-block">Here you can add first name.</span>
											</div>
										</div>
									</div>
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="lastName">Last name</label>
											<div class="controls">
											<?php echo $this->Form->input('last_name', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required] inp-2","data-errormessage-value-missing" => "Lastname is required!")); ?>
												<span class="help-block">Here you can add last name.</span>
											</div>
										</div>
									</div>


								</div>
								<div class="row-fluid">
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="email">Email</label>
											<div class="controls">
											<?php echo $this->Form->input('email', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required,custom[email]] inp-2","data-errormessage-value-missing" => "Email Address is required!")); ?>
												<span class="help-block">Here you can add email.</span>
											</div>
										</div>
									</div>

									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="phonenumber">Phone Number</label>
											<div class="controls">
											<?php echo $this->Form->input('phone', array("label" => false, "div" => false, "class" => "m-wrap span12 validate[required]  inp-2","data-errormessage-value-missing" => "Phonenumber is required!")); ?>
												<span class="help-block">Here you can add Phone Number .</span>
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
 jQuery(document).ready(function(){
    // binds form submission and fields to the validation engine
    jQuery("#UserAdminEditForm").validationEngine({promptPosition : "bottomLeft"});   
 });
</script>