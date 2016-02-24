<?php 
app::import("Model","SitePermission");
$permission_obj=new SitePermission();

app::import("Model","User");
$user_obj=new User();

$is_ajax=Configure::write('site.run_admin_ajax');

?>

      
            <aside class="right-side">
                
                <section class="content-header">
                    <h1>
                        <?php echo __('View User Information');?>
                        <small><?php echo __('Here you can view User');?></small>
                    </h1>
                    
                </section>
               
               <div class="nav-tabs-custom">
			    
				
				  <section class="content">
				  
                  <div class="row">
                   <div class="col-xs-12">
				         
                 <div class="box box-info">
               
                <div class="box-body">
				  
				  <div class="tab-content table-responsive no-padding">
                
				   <div id="stntab1" class="tab-pane active">
					 
					  <table class="table table-hover">
                    <tbody>
					<tr>
                      <td><?php echo __('User Type');?></td>
                      <td><?php echo $user['Role']['name'];?></td>
                     </tr>
                     <tr>
                      <td><?php echo __('First Name');?></td>
                      <td><?php echo $user['User']['first_name'];?></td>
                     </tr>
					 <tr>
                      <td><?php echo __('Last Name');?></td>
                      <td><?php echo $user['User']['last_name'];?></td>
                     </tr>
					
					 <tr>
                      <td><?php echo __('Email');?></td>
                      <td><?php echo $user['User']['email'];?></td>
                     </tr>
					  <tr>
                      <td><?php echo __('Company');?></td>
                      <td><?php echo $user['User']['user_company'];?></td>
                     </tr>
					  <tr>
                      <td><?php echo __('Address');?></td>
                      <td><?php echo $user['User']['address'];?></td>
                     </tr>
					  <tr>
                      <td><?php echo __('Zip');?></td>
                      <td><?php echo $user['User']['zip'];?></td>
                     </tr>
					  <tr>
                      <td><?php echo __('Mobile');?></td>
                      <td><?php echo $user['User']['mobile'];?></td>
                     </tr>
					 <tr>
                      <td><?php echo __('Remarks');?></td>
                      <td><?php echo $user['User']['remarks'];?></td>
                     </tr>
					 <tr>
                      <td><?php echo __('Status');?></td>
                      <td>
					   <?php if ($user['User']['status'] == '1'): ?>
						 <span class="label label-success"><?php echo __('Active');?></span>
						
						<?php else: ?>
						 <span class="label label-warning"><?php echo __('Inactive');?></span>
						
						
						<?php endif; ?>
					  </td>
                     </tr>
					 
					
                  
                  </tbody></table>
					</div>
					
				  </div> 
                </div><!-- /.box-body -->
				
              </div><!-- /.box -->
                       
                 </div></div>
				 

                </section>
				
				 </div>
				
				</div>
			   </div>
            </aside>
<?php echo $this->Html->script('admin/default.js'); ?>	

