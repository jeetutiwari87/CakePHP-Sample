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
					General Settings <small>Here you can manage the site General settings.</small>
				</h3>
				<ul class="breadcrumb">
					<li><i class="icon-home"></i> <?php echo $this->Html->link('General Settings', array('controller' => 'settings', 'action' => 'index',"admin"=>true),array("escape"=>false)); ?>
						<span class="icon-angle-right"></span></li>
					<li>General Settings</li>
				</ul>
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<div class="span12">
				<div class="tabbable tabbable-custom boxless">
					<div class="tab-content">
						<div class="portlet box grey">
							<div class="portlet-title">
								<h4>
									<i class="icon-reorder"></i>General Settings
								</h4>

							</div>
							<div class="portlet-body form">
							<!-- BEGIN FORM-->
							 <?php echo $this->Form->create('Setting', array('action' => 'index',"class" => "form-horizontal","enctype"=>"multipart/form-data")); ?>
								<div class="alert alert-error hide">
									<button class="close" data-dismiss="alert"></button>
									<span>Please fill all the required fields.</span>
								</div>
								
								<div class="row-fluid">
										<div class="control-group">
											<?php foreach($settingcategories as $scategory):?>
											<fieldset>
													 <p class="help-block "><?php echo $scategory['SettingCategory']['description'];?></p>
												  <?php
													
												   
													$inputDisplay = 0;
													foreach ($settings[$scategory['SettingCategory']['id']] as $setting):
													   $field_name = explode('.', $setting['Setting']['name']);
														
														$options['type'] = $setting['Setting']['type'];
														$options['value'] = $setting['Setting']['value'];
														$options['div'] = array('id' => "setting-{$setting['Setting']['name']}");
														if($options['type'] == 'checkbox' && $options['value']):
															$options['checked'] = 'checked';
														endif;
														if($options['type'] == 'radio' && $options['value']):
															$options['default'] = $options['value'];
														endif;
														if($options['type'] == 'select'):
															$selectOptions = explode(',', $setting['Setting']['options']);
															$setting['Setting']['options'] = array();
															
																		  
															if(!empty($selectOptions)):
																foreach($selectOptions as $key => $value):
																	if(!empty($value)):
																		$setting['Setting']['options'][trim($value)] = trim($value);
																	endif;
																endforeach;
															endif;
															$options['options'] = $setting['Setting']['options'];
														endif;
														if($options['type'] == 'radio'):
															$selectOptions = explode(',', $setting['Setting']['options']);
															$setting['Setting']['options'] = array();
																		  
															if(!empty($selectOptions)):
																foreach($selectOptions as $key => $value):
																  $value_arr=explode("=>",$value);
																	if(!empty($value)):
																		$setting['Setting']['options'][trim($value_arr[0])] = trim($value_arr[1]);
																	endif;
																endforeach;
															endif;
															$options['options'] = $setting['Setting']['options'];
														endif;
													   $options['label'] = false;
													   $options['div'] = false;
													   $options['legend'] = false;
													   
													   if($options['type'] == 'checkbox'):
														 $options['class'] = "on_off_checkbox";
													   else:
														 $options['class'] = "medium";
													   endif;
													   //default account		
													?>
													<div class="control-group">
																<label class="control-label" for="typeahead"><?php echo $setting['Setting']['label'];?></label>
																<div class="controls"> <?php echo $this->Form->input("Setting.{$setting['Setting']['id']}.name", $options); ?>
																<?php echo $this->Form->input("Setting.{$setting['Setting']['id']}.type", array("type"=>"hidden","value"=>$options['type'])); ?>
																
																<p class="help-block"><?php echo  $setting['Setting']['description'];?></p>
																<?php if($options['type']=='file') { ?>
																<p>
																
																  
																		<?php $this->thumbnail->show(
																	array(
																	 'save_path' => ROOT . '/app/webroot/uploads/thumbs',
																	 'display_path' => Router::url('/',true).'uploads/thumbs', // or 'display_path' => 'http://images.domain.com',
																	'error_image_path' => Router::url('/',true).'img/no_image.jpg',
																	'src' => ROOT.'/app/webroot/uploads/settings/'.$options['value'],
																	'w' => 200,
																	'h' => 100,
																	'q' => 100,
																	'zc' => 1
																	),
																	// This is the tag options array for adding any other properties to the image tag
																	array('style' => 'border: 5px solid #EEEEEE;')
																); ?>
																
																</p>
																<?php } ?>
																</div>
													</div>
												  
													 <?php 	  
														$inputDisplay = ($inputDisplay == 2) ? 0 : $inputDisplay;
														unset($options);
													endforeach;
													?>
											</fieldset>
											<?php endforeach; ?>
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
<?php echo $this->Html->script('ckeditor/ckeditor.js'); ?> 
<script type="text/javascript">
 jQuery(document).ready(function(){
    // binds form submission and fields to the validation engine
    //jQuery("#SettingIndexForm").validationEngine({promptPosition : "bottomLeft"});
    
 });	
</script>
