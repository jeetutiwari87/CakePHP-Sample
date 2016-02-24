<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
$is_ajax=Configure::read('site.run_admin_ajax');
?>


<aside class="right-side">
  <section class="content-header">
    <h1> Inventory Report <small>Here you can manage Inventory Report</small> </h1>
    
  </section>
  
  <div class="nav-tabs-custom">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-body" style="clear: both; overflow: hidden;">
              <div class="tab-pane active">
                
				
				<div id="request_item_div">
				 <table class="in_table" style="width:100%;">
                  
                    <tr>
                      <th style="width:60%;text-align:left;"><?php echo __('Item'); ?></th>
					  <th style="width:15%;"><?php echo __('Current Stock Balance'); ?></th>
					  <th style="width:25%;"><?php echo __('Current Location'); ?></th>
					 
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
							<li style="width:60%;text-align:left;"><img src="<?php echo Router::url('/',true);?>img/arro_tab.png" alt="image" style="margin-right:3px;position:relative;top:-3px;" /><?php echo h($item['Item']['item_name']); ?>(<?php echo h($item['Item']['item_serialno']); ?>)<span style="float:right;">
							<?php if((isset($item['Item']['item_photo']) && $item['Item']['item_photo']!='') && file_exists(WWW_ROOT.'uploads/items/'.$item['Item']['item_photo'])) { ?>							
							<a href="<?php echo Router::url('/',true);?>uploads/items/<?php echo h($item['Item']['item_photo']); ?>" title="<?php echo h($item['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } else { ?>
							<a href="<?php echo Router::url('/',true);?>img/no_image.jpg" title="<?php echo h($item['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } ?>
							
							</span></li>
							<li style="width:15%;"><?php echo h($item['Item']['item_stocklevel']); ?></li>
							<li style="width:25%;"><?php echo h($item['Item']['current_location']); ?></li>
							
						</ul>
						<?php } } else { ?>
						<ul class="add_tab">
							<li style="width:60%;text-align:left;"><?php echo __('No Item found');?></li>
						</ul>
						<?php } ?>
						</div>
			        </div>
				
					<?php } } ?>
					
				
				</div>
				
              </div>
            </div>
            <!-- /.box-body -->
            
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

<?php echo $this->Html->css('admin/jquery.fancybox.css'); ?>
<?php echo $this->Html->script('admin/jquery.fancybox.js'); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
 
  jQuery('.fancybox').fancybox();
  
  jQuery(".ExpandRow").on('click',function(){
     if(jQuery(this).next('.expand_item').css('display')=='none'){
	   jQuery(this).next('.expand_item').slideDown();
	   jQuery(this).find('span').html('-');
	 }else{
	   jQuery(this).next('.expand_item').slideUp();
	   jQuery(this).find('span').html('+');
	 }
	 
  });
  
});

</script>