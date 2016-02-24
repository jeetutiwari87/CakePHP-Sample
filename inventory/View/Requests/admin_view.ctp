<?php
app::import('Model', 'SitePermission');
$permission_obj = new SitePermission();
app::import('Model', 'Item');
$item_obj = new Item();
$is_ajax=Configure::read('site.run_admin_ajax');
?>

<aside class="right-side">
  <section class="content-header">
    <h1> <?php echo __('View Request Information');?> <small><?php echo __('Here you can view Request');?></small> </h1>
  </section>
  <div class="nav-tabs-custom">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-info">
            <div class="box-body">
              <div class="tab-content table-responsive no-padding">
                <div class="tab-pane active">
                  <table class="table table-hover">
                    <tbody>
                      <tr>
                        <td><?php echo __('Id');?></td>
                        <td><?php echo h($request['Request']['id']); ?> &nbsp; </td>
                      </tr>
                      <tr>
                        <td><?php echo __('Request For');?></td>
                        <td><?php echo h($request['Request']['request_for']); ?> &nbsp; </td>
                      </tr>
					  <?php if($request['Request']['request_for']=='event'){ ?>
					   <tr>
                        <td><?php echo __('Event Name');?></td>
                        <td><?php echo h($request['Request']['event_name']); ?> &nbsp; </td>
                       </tr>
					   <tr>
                        <td><?php echo __('Event Venue');?></td>
                        <td><?php echo h($request['Request']['request_eventvenue']); ?> &nbsp; </td>
                       </tr>
					   <tr>
                        <td><?php echo __('Event Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_eventfromdate'])); ?> to <?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['event_todate'])); ?> </td>
                       </tr>
					   <tr>
                        <td><?php echo __('Items to be collect on');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['collectiondate'])); ?> </td>
                       </tr>
					   <tr>
                        <td><?php echo __('Items to be return on');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_returnto'])); ?> </td>
                       </tr>
					  <?php } else { ?>
					   <tr>
                        <td><?php echo __('Gallery');?></td>
                        <td>
						<?php foreach ($request['Gallery'] as $requestGallery): ?>
						 <?php if($requestGallery['id']=='10'){ ?>
						  <?php echo $requestGallery['name'];?>(<?php echo $request['Request']['gallery_other_text'];?>)<br />
						 <?php } else { ?>
						 <?php echo $requestGallery['name'];?><br />
						 <?php } ?>
						 
						<?php endforeach;?>
						</td>
                       </tr>
					  <?php } ?>
					  
                    
                      <tr>
                        <td><?php echo __('Request Status');?></td>
                        <td> 
						<?php if ($request['Request']['request_status'] == '0'): ?>
                        <?php echo '<span class="label label-info">'.__('Pending').'</span>'; ?>
                        <?php elseif ($request['Request']['request_status'] == '1'): ?>
						 <?php echo '<span class="label label-success">'.__('Approved').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '2'): ?>
						 <?php echo '<span class="label label-danger">'.__('Rejected').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '3'): ?>
						 <?php echo '<span class="label label-warning">'.__('Collected').'</span>'; ?>
						 <?php elseif ($request['Request']['request_status'] == '4'): ?>
						 <?php echo '<span class="label label-info">'.__('Returned').'</span>'; ?>
						  <?php elseif ($request['Request']['request_status'] == '5'): ?>
						 <?php echo '<span class="label label-warning">'.__('Returned incomplete').'</span>'; ?>
						<?php else: ?>
                        <?php echo '<span class="label label-warning">'.__('Returned ok').'</span>'; ?>
                        <?php endif; ?> </td>
                      </tr>
					 
					 
					
					 
					 
					 
					  <?php if($request['Request']['request_requestedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Requested By');?></td>
                        <td><?php echo $request['Requestedby']['first_name']; ?>&nbsp;<?php echo $request['Requestedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					 <?php if($request['Request']['request_approvedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Approved By');?></td>
                        <td><?php echo $request['Approvedby']['first_name']; ?>&nbsp;<?php echo $request['Approvedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_approvaldatetime']!='0000-00-00 00:00:00'){ ?>
                      <tr>
                        <td><?php echo __('Approval Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_approvaldatetime'])); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_rejectedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Rejected By');?></td>
                        <td><?php echo $request['Rejectedby']['first_name']; ?>&nbsp;<?php echo $request['Rejectedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_rejecteddatetime']!='0000-00-00 00:00:00'){ ?>
                      <tr>
                        <td><?php echo __('Reject Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_rejecteddatetime'])); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_collectedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Collected By');?></td>
                        <td><?php echo $request['Collectedby']['first_name']; ?>&nbsp;<?php echo $request['Collectedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_collectiondatetime']!='0000-00-00 00:00:00'){ ?>
                      <tr>
                        <td><?php echo __('Collection Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_collectiondatetime'])); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					  <?php if($request['Request']['request_returnedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Returned By');?></td>
                        <td><?php echo $request['Returnedby']['first_name']; ?>&nbsp;<?php echo $request['Returnedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					 <?php if($request['Request']['request_returndatetime']!='0000-00-00 00:00:00'){ ?>
                      <tr>
                        <td><?php echo __('Returned Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_returndatetime'])); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					 
					<?php if($request['Request']['request_verifiedby']>0){ ?>
                      <tr>
                        <td><?php echo __('Verified By');?></td>
                        <td><?php echo $request['Verifiedby']['first_name']; ?>&nbsp;<?php echo $request['Verifiedby']['last_name']; ?> </td>
                      </tr>
					 <?php } ?>
					 
					  <?php if($request['Request']['request_verifydatetime']!='0000-00-00 00:00:00'){ ?>
                      <tr>
                        <td><?php echo __('Verified Date');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_verifydatetime'])); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					 
                     <?php if($request['Request']['approve_remark']!=''){ ?>
                      <tr>
                        <td><?php echo __('Approve/Reject Remark');?></td>
                        <td><?php echo h($request['Request']['approve_remark']); ?> &nbsp; </td>
                      </tr>
					 <?php } ?>
					 
					
					 
                      <tr>
                        <td><?php echo __('Created');?></td>
                        <td><?php echo date(Configure::read('site.admin_date_format'), strtotime($request['Request']['created'])); ?> &nbsp; </td>
                      </tr>
                     
                    </tbody>
                  </table>
                
                  <div class="box-header">
                    <h3 class="box-title"><?php echo __('Request Items');?></h3>
                  </div>
                  <?php if (!empty($request['RequestItem'])): ?>
                  <table id="example1" class="table table-bordered table-hover table-striped">
                    <thead>
                      <tr>
                        <th><?php echo __('Id'); ?></th>
                        <th><?php echo __('Item'); ?></th>
                        <th><?php echo __('Request Quantity'); ?></th>
                        <th><?php echo __('Quantity Approved'); ?></th>
                        <th><?php echo __('Quantity Collected'); ?></th>
                        <th><?php echo __('Quantity Returned'); ?></th>
                        <th><?php echo __('Quantity Verified'); ?></th>
						<?php if ($request['Request']['request_status'] >=5): ?>
						<th><?php echo __('Total  Expenses'); ?></th>
						<?php endif;?>
						
						<th><?php echo __('Collect Remark'); ?></th>
						<th><?php echo __('Return Remark'); ?></th>
						<th><?php echo __('verify Remark'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$i = 0;
					$total_amount=0;
					foreach ($request['RequestItem'] as $requestItem):
					$item_info=$item_obj->getIteminfo($requestItem['item_id']);
					
					$price=(isset($item_info['Item']['item_unitprice']) && $item_info['Item']['item_unitprice']!='')?$item_info['Item']['item_unitprice']:0;
					 $requestItem['reqitem_quantitycollected']-$requestItem['reqitem_quantityreturned'];
					
					$total_expanses=(($requestItem['reqitem_quantitycollected']-$requestItem['reqitem_quantityreturned'])*$price);
					$total_amount+=$total_expanses;
					 ?>
                      <tr>
                        <td><?php echo $requestItem['id']; ?></td>
                        <td><?php echo $item_obj->getName($requestItem['item_id']); ?>
						<span style="float:right;">
							<?php if((isset($item_info['Item']['item_photo']) && $item_info['Item']['item_photo']!='') && file_exists(WWW_ROOT.'uploads/items/'.$item_info['Item']['item_photo'])) { ?>							
							<a href="<?php echo Router::url('/',true);?>uploads/items/<?php echo h($item_info['Item']['item_photo']); ?>" title="<?php echo h($item_info['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } else { ?>
							<a href="<?php echo Router::url('/',true);?>img/no_image.jpg" title="<?php echo h($item_info['Item']['item_name']); ?>" class="fancybox"><img src="<?php echo Router::url('/',true);?>img/photo-icon.png" /></a>
							<?php } ?>
							
							</span>
						</td>
                        <td><?php echo $requestItem['reqitem_quantity']; ?></td>
                        <td><?php echo (isset($requestItem['reqitem_quantityapproved']) && $requestItem['reqitem_quantityapproved']>0)?$requestItem['reqitem_quantityapproved']:'-'; ?></td>
                        <td><?php echo (isset($requestItem['reqitem_quantitycollected']) && $requestItem['reqitem_quantitycollected']>0)?$requestItem['reqitem_quantitycollected']:'-'; ?></td>
                        <td><?php echo (isset($requestItem['reqitem_quantityreturned']) && $requestItem['reqitem_quantityreturned']>0)?$requestItem['reqitem_quantityreturned']:'-'; ?></td>
                        <td><?php echo (isset($requestItem['reqitem_quantityverified']) && $requestItem['reqitem_quantityverified']>0)?$requestItem['reqitem_quantityverified']:'-'; ?></td>
						<?php if ($request['Request']['request_status'] >=5): ?>
						<th><?php echo Configure::read('site.currency');?><?php echo $total_expanses; ?></th>
						<?php endif;?>
						<td><?php echo $requestItem['collect_remark']; ?></td>
						<td><?php echo $requestItem['return_remark']; ?></td>
						<td><?php echo $requestItem['verify_remark']; ?></td>
                       
                       
                      </tr>
                      <?php endforeach; ?>
					  
					   <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo (isset($request['Requestedby']['first_name']) && $request['Requestedby']['first_name']!='')?$request['Requestedby']['first_name'].' '.$request['Requestedby']['last_name']:'';?></th>
                        <th><?php echo (isset($request['Approvedby']['first_name']) && $request['Approvedby']['first_name']!='')?$request['Approvedby']['first_name'].' '.$request['Approvedby']['last_name']:'';?></th>
                        <th><?php echo (isset($request['Collectedby']['first_name']) && $request['Collectedby']['first_name']!='')?$request['Collectedby']['first_name'].' '.$request['Collectedby']['last_name']:'';?></th>
                        <th><?php echo (isset($request['Returnedby']['first_name']) && $request['Returnedby']['first_name']!='')?$request['Returnedby']['first_name'].' '.$request['Returnedby']['last_name']:'';?></th>
                        <th><?php echo (isset($request['Verifiedby']['first_name']) && $request['Verifiedby']['first_name']!='')?$request['Verifiedby']['first_name'].' '.$request['Verifiedby']['last_name']:'';?></th>
						<?php if ($request['Request']['request_status'] >=5): ?>
						<th><?php echo Configure::read('site.currency');?><?php echo $total_amount; ?></th>
						<?php endif;?>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
                      </tr>
					  
					   <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th><?php echo (isset($request['Request']['created']) && $request['Request']['created']!='')?date(Configure::read('site.admin_date_format'), strtotime($request['Request']['created'])):'';?></th>
                        <th><?php echo (isset($request['Request']['request_approvaldatetime']) && $request['Request']['request_approvaldatetime']!='0000-00-00 00:00:00')?date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_approvaldatetime'])):'';?></th>
                        <th><?php echo (isset($request['Request']['request_collectiondatetime']) && $request['Request']['request_collectiondatetime']!='0000-00-00 00:00:00')?date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_collectiondatetime'])):'';?></th>
                        <th><?php echo (isset($request['Request']['request_returndatetime']) && $request['Request']['request_returndatetime']!='0000-00-00 00:00:00')?date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_returndatetime'])):'';?></th>
                        <th><?php echo (isset($request['Request']['request_verifydatetime']) && $request['Request']['request_verifydatetime']!='0000-00-00 00:00:00')?date(Configure::read('site.admin_date_format'), strtotime($request['Request']['request_verifydatetime'])):'';?></th>
						<?php if ($request['Request']['request_status'] >=5): ?>
						<th>&nbsp;</th>
						<?php endif;?>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
                      </tr>
					  
                    </tbody>
                  </table>
                  <?php endif; ?>
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
<?php echo $this->Html->script('admin/default.js'); ?> 
<?php echo $this->Html->css('admin/jquery.fancybox.css'); ?>
<?php echo $this->Html->script('admin/jquery.fancybox.js'); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.fancybox').fancybox();
});
</script>
 
 