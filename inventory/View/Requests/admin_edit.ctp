<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>
<?php echo $this->Form->create('Request', array('id'=> 'SubmitFormData','enctype' => 'multipart/form-data','inputDefaults' => array('label' => false, 'div' => false, 'required' => false),"onsubmit"=>"return ValidateRequest();")); ?>

<aside class="right-side">
  <section class="content-header">
    <h1> Requisition Approve/Reject Request <small>Here you can manage Requisition Approve/Reject Request</small> </h1>
    <ol class="breadcrumb">
      <li>
        <button class="btn btn-app" type="submit"><i class="fa fa-save"></i><?php echo __('Save');?></button>
        <?php if($is_ajax!='1') { ?>
        <button type="button" onclick="javascript:history.back(1)" class="btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
        <?php } else { ?>
        <button type="button"  onclick="javascript:void(0)" class="Cancel btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
        <?php } ?>
      </li>
    </ol>
  </section>
  <input type="hidden" name="current_url" id="current_url" value="<?php echo Router::url('/');?>admin/<?php echo $this->params['controller'];?>/index" />
  <div class="nav-tabs-custom">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-body" style="clear: both; overflow: hidden;">
              <div class="tab-pane active">
                <div class="form-group">
                  <label for="request_for">Request For</label>
                  <?php
		 echo $this->request->data['Request']['request_for'];
		 echo $this->Form->input('request_for', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'type'=>'hidden'));
		 echo $this->Form->input('id', array('label'=>false, 'div'=>false, 'class' => 'form-control'));
		 ?>
                </div>
				<div id="event_div" <?php if($this->request->data['Request']['request_for']=='gallery') { ?> style="display:none;" <?php } ?>>
                <div class="form-group">
                  <label for="request_eventfromdate"><span class="required">*</span>Event Name</label>
                  <?php
		 echo $this->Form->input('event_name', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('Event Name'))); ?>
                </div>
				<div class="form-group">
                  <label for="request_eventvenue"><span class="required">*</span>Event Venue</label>
                  <?php
		 echo $this->Form->input('request_eventvenue', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('Request Eventvenue'))); ?>
                </div>
				
                <div class="form-group">
                  <label for="event_todate"><span class="required">*</span>Event date</label>
                  <?php
				 echo $this->Form->input('request_eventfromdate', array('label'=>false, 'div'=>false, 'class' => 'form-control datepicker','type'=>'text', 'placeholder'=>__('From'))); ?>   
				 <?php
				 echo $this->Form->input('event_todate', array('label'=>false, 'div'=>false, 'class' => 'form-control datepicker','type'=>'text', 'placeholder'=>__('To'))); ?>
                </div>
                
                <div class="form-group">
                  <label for="request_proposedcollectiondatetime">Items to be collect on</label>
                  <?php
		 echo $this->Form->input('event_collectiondate', array('label'=>false, 'div'=>false, 'class' => 'form-control datepicker', 'placeholder'=>__('Items to be collect on'),'type'=>'text')); ?>
                </div>
				 <div class="form-group">
                  <label for="request_proposedcollectiondatetime">Items to be return on</label>
                  <?php
		 echo $this->Form->input('request_returnto', array('label'=>false, 'div'=>false, 'class' => 'form-control datepicker', 'placeholder'=>__('Items to be return on'),'type'=>'text')); ?>
                </div>
				
				</div>
				
				<div id="gallery_div" <?php if($this->request->data['Request']['request_for']=='event') { ?> style="display:none;" <?php } ?>>
				  <div class="form-group">
                  <label for="request_proposedcollectiondatetime">Select Gallery</label>
                  <?php
				  $key_str = @array_map('intval', @array_values($this->Html->value('Gallery.Gallery')));
				  
		 echo $this->Form->input('Gallery', array('label'=>false, 'div'=>false, 'multiple'=>"checkbox", 'selected' => $key_str)); ?>
                </div>
				<div class="form-group" id="other_div" <?php if(in_array('10',$key_str)){ ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?>>
				 <?php
		 echo $this->Form->input('other_text', array('label'=>false, 'div'=>false, 'class' => 'form-control')); ?>
				</div>
				
				
				
				<div class="form-group">
                  <label for="request_proposedcollectiondatetime">Items to be collect on</label>
                  <?php
		 echo $this->Form->input('gallery_collectiondate', array('label'=>false, 'div'=>false, 'class' => 'form-control datepicker', 'placeholder'=>__('Items to be collect on'),'type'=>'text')); ?>
                </div>
				
				
				</div>
				<div class="form-group" id="request_status">
				 <?php
		 echo $this->Form->input('request_status', array('label'=>false, 'div'=>false, 'legend' => false,"type"=>"radio",'options'=>array("1"=>"Approved","2"=>"Rejected"), 'data-validation' => 'required')); ?>
				</div>
				
				<div class="form-group" id="reject_remark_div" style="display:none;">
				 <?php
		 echo $this->Form->input('approve_remark', array('label'=>false, 'div'=>false, 'class' => 'form-control', 'placeholder'=>__('Remark'))); ?>
				</div>
				
				<div id="request_item_div">
				 <table class="in_table" style="width:100%;">
                  
                    <tr>
                      <th style="width:60%;text-align:left;"><?php echo __('Item'); ?></th>
					  <th style="width:10%;"><?php echo __('Available Stock'); ?></th>
					  <th style="width:10%;"><?php echo __('Price / pack (RM)'); ?></th>
					  <th style="width:10%;"><?php echo __('Quantity & Item'); ?></th>
					  <th style="width:10%;"><?php echo __('Quantity & Item for Approved'); ?></th>
					</tr>
                 </table>
				 
				 
				  
                     <?php if(isset($items_data) && count($items_data)>0){ 
					 foreach($items_data as $items){
					 ?>
					 
					 <div class="tab_col">
						<a href="javascript:void(0);" class="ExpandRow"><span>+</span> <?php echo h($items['category_name']); ?></a>
						<div id="items_<?php echo h($items['category_id']); ?>" class="expand_item" style="display:none;">
						<?php if(isset($items['items']) && count($items['items'])>0){ 
								 foreach($items['items'] as $item){
						?>
						<ul class="add_tab">
							<li style="width:60%;text-align:left;"><img src="<?php echo Router::url('/',true);?>img/arro_tab.png" alt="image" style="margin-right:3px;position:relative;top:-3px;" /><?php echo h($item['Item']['item_name']); ?><span style="float:right;">
							
							<?php if((isset($item['Item']['item_photo']) && $item['Item']['item_photo']!='') && file_exists(WWW_ROOT.'uploads/items/'.$item['Item']['item_photo'])) { ?>							
							<a href="<?php echo Router::url('/',true);?>uploads/items/<?php echo h($item['Item']['item_photo']); ?>" title="<?php echo h($item['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } else { ?>
							<a href="<?php echo Router::url('/',true);?>img/no_image.jpg" title="<?php echo h($item['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } ?>
							
							
							
							</span></li>
							<li style="width:10%;"><?php echo h($item['Item']['item_stocklevel']+$item['Item']['reqitem_quantity']); ?></li>
							<li style="width:10%;"><?php echo h($item['Item']['item_unitprice']); ?> <?php echo h($item['Item']['item_measurementunit']); ?></li>
							<li style="width:10%;"><?php echo h($item['Item']['reqitem_quantity']); ?></li>
							
							<li style="width:10%;"><input size="6" value="<?php echo h($item['Item']['reqitem_quantity']); ?>" type="text" name="qty[]" class="item_blur" dir="<?php echo h($item['Item']['item_stocklevel']); ?>" />
							<input size="6" type="hidden" name="item_ids[]" value="<?php echo $items['category_id'].'##'.$item['Item']['id']; ?>" />
							<input size="6" type="hidden" name="request_item_id[]" value="<?php echo $item['Item']['request_item_id']; ?>" />
							</li>
							
						</ul>
						<?php } } else { ?>
						<ul class="add_tab">
							<li style="width:60%;text-align:left;"><?php echo __('No Item found');?></li>
						</ul>
						<?php } ?>
						</div>
			        </div>
				
					<?php } } ?>
					
				<ul class="add_tab">
					<li style="width:60%;text-align:left;">&nbsp;</li>
					<li style="width:13%;">&nbsp;</li>
					<li style="width:13%;">&nbsp;</li>
					<li style="width:14%;"><input type="checkbox" name="confirmed" id="confirmed" value="1" /> Confirmed</li>
				</ul>
				
				<ul class="add_tab">
					<li style="width:60%;text-align:left;">&nbsp;</li>
					<li style="width:10%;">&nbsp;</li>
					<li style="width:10%;">&nbsp;</li>
					<li style="width:10%;"><?php echo (isset($this->request->data['Requestedby']['first_name']) && $this->request->data['Requestedby']['first_name']!='')?$this->request->data['Requestedby']['first_name'].' '.$this->request->data['Requestedby']['last_name']:'';?></li>
					
					<li style="width:10%; display:none;" id="request_postby"><?php echo $UsersDetails['first_name'];?> <?php echo $UsersDetails['last_name'];?></li>
					
				</ul>
				
				</div>
				
              </div>
            </div>
            <!-- /.box-body -->
            <section class="content-header" style="float:right; margin-top:10px;">
              <ol class="breadcrumb">
                <li>
                  <button class="btn btn-app" type="submit"><i class="fa fa-save"></i><?php echo __('Save');?></button>
                  <?php if($is_ajax!='1') { ?>
                  <button type="button" onclick="javascript:history.back(1)" class="btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
                  <?php } else { ?>
                  <button type="button"  onclick="javascript:void(0)" class="Cancel btn btn-app"><i class="fa fa-lock"></i><?php echo __('Cancel');?></button>
                  <?php } ?>
                </li>
              </ol>
            </section>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
  </div>
  </div>
</aside>
<?php echo $this->Form->end(); ?>
<?php echo $this->Html->script('admin/default.js'); ?>
<?php echo $this->Html->css('admin/datepicker3.css'); ?>
<?php echo $this->Html->script('datepicker/bootstrap-datepicker.js'); ?>
<?php echo $this->Html->css('admin/jquery.fancybox.css'); ?>
<?php echo $this->Html->script('admin/jquery.fancybox.js'); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.datepicker').datepicker();
  jQuery('.fancybox').fancybox();
  
  jQuery("#RequestRequestFor").on('change',function(){
     if(jQuery(this).val()==''){
	   jQuery("#gallery_div").hide();
	   jQuery("#event_div").hide();
	   jQuery("#request_item_div").hide();
	   
	 }else if(jQuery(this).val()=='gallery'){
	   jQuery("#event_div").hide();
	   jQuery("#gallery_div").show();
	   jQuery("#request_item_div").show();
	  
	 }else if(jQuery(this).val()=='event'){
	   jQuery("#gallery_div").hide();
	   jQuery("#event_div").show();
	   jQuery("#request_item_div").show();
	 }
	 
  });
  
  jQuery(".ExpandRow").on('click',function(){
     if(jQuery(this).next('.expand_item').css('display')=='none'){
	   jQuery(this).next('.expand_item').slideDown();
	   jQuery(this).find('span').html('-');
	 }else{
	   jQuery(this).next('.expand_item').slideUp();
	   jQuery(this).find('span').html('+');
	 }
	 
  });
  
  jQuery('.item_blur').on('blur',function(){
  
     if(parseInt(jQuery(this).val())>parseInt(jQuery(this).attr("dir"))){
	   alert('Not in stock');
	   jQuery(this).val('');
	 }
  });
  jQuery('#confirmed').on('click',function(){
     if(jQuery(this).is(":checked")){
	   jQuery('#request_postby').show();
	 }else{
	  jQuery('#request_postby').hide();
	 }
  });
  jQuery('#request_status input').on('click',function(){
 
     if(jQuery(this).val()=='2'){
	   jQuery('#reject_remark_div').show();
	 }else{
	  jQuery('#reject_remark_div').hide();
	 }
  });
  
  
  jQuery('.checkbox').on('click',function(){
      var is_exists=0;
	  jQuery('.checkbox').each(function(){
	      if(jQuery(this).find('input').is(":checked") && jQuery(this).find('input').val()=='10'){
			is_exists=1;
		  }
	  });
	  if(is_exists==1){
	    jQuery('#other_div').show();
	  }else{
	    jQuery('#other_div').hide();
	  }
	 
  });
  
  
});
function ValidateRequest(){
  
  
  if(!jQuery("#confirmed").is(":checked")){
    alert('Please check the confirm tickbox to proceed')
    return false;
  }
  var is_item=0;
  jQuery('.item_blur').each(function(){
     if(jQuery(this).val()!=''){
	   is_item=1;
	 }
  });
  if(is_item==0){
    alert('Please select atleast one item for request');
    return false;
  }else{
    return true;
  }
}
</script>