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
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"> Billing Information </h3>
          <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
      </div>
      <!-- END PAGE HEADER-->
      <div id="dashboard">
        <!-- BEGIN DASHBOARD STATS -->
        <div class="row-fluid">
          <div class="span4">
            <div class="portlet box red">
              <div class="portlet-title">
                <h4><i class="icon-cogs"></i>Summary</h4>
              </div>
              <div class="portlet-body">
                <div class="details">
                  <div class="number">$500.00</div>
                  <div class="title">Current Balance</div>
                </div>
                <div class="basic-toggle-button">
                  <input type="checkbox" class="toggle" checked="checked"  name="autorefill" id="autorefill" onclick="AutoRefilltoggle();"/>
                </div>
                <div class="title">Auto-Refill</div>
              </div>
            </div>
            <div class="portlet box red">
              <div class="portlet-title">
                <h4><i class="icon-cogs"></i>Credit Card(s)</h4>
              </div>
              <div class="portlet-body">
			  	<?php foreach( $User_creditcards as $credit_card ): ?>
					<div class="credit-details">
						<span class="full">
							<?php echo $credit_card['UserCreditcard']['description']; ?> (*****<?php echo substr($credit_card['UserCreditcard']['card_number'], -4); ?>)
                        </span>
						<span class="full psdB10">
                      		<?php echo $this->Form->input("Make Deposit",array("type"=>"button","label"=>false,"div"=>false,"onClick"=>"makeDepositForm('".$credit_card['UserCreditcard']['id']."');","class"=>"btn green"));?>                     
                    	</span>
						<br>
							<?php echo $this->Html->link('Edit', array('controller' => 'users', 'action' => 'edit_creditcard', $credit_card['UserCreditcard']['id']),array("escape"=>false, 'class'=>'btn_small yellow')); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'del_creditcard', $credit_card['UserCreditcard']['id']), array('class'=>'btn_small red'), __('Are you sure you want to delete # %s?', $credit_card['UserCreditcard']['id'])); ?>					
					</div>
				<?php endforeach; ?>
              </div>
            </div>
            <span class="full psdB10">
			<?php echo $this->Html->link('Add New Card', array('controller' => 'users', 'action' => 'add_creditcard'),array("escape"=>false, 'class'=>'btn bluee')); ?>
			<?php
			//echo $this->Form->button('Add New Card', array('type'=>'button', 'class'=>'btn bluee', 'onclick'=>"window.location.href='".Router::url('/dashboards/add_creditcard', true)."'"));
			?></span>
            <br>
			  <?php echo $this->Form->input("Auto-Refill",array("type"=>"button","label"=>false,"div"=>false,"onClick"=>"AutoRefill()","class"=>"btn green"));?>
          </div>
          <div id="makeDepositId" style="display:none;" class="span8">
          	test 123
			
          </div>
          <div class="span8">
            <div class="portlet box green">
              <div class="portlet-title">
                <h4><i class="icon-coffee"></i>Date Range</h4>
                <div class="tools"> </div>
              </div>
              <div class="portlet-body ">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Receipt Code</th>
                      <th class="hidden-480">Description</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php foreach( $transaction_histories as $trans ): ?>
						<tr>
						  <td><?php echo $trans['TransactionHistories']['created']; ?></td>
						  <td><?php echo '&#36;'.$trans['TransactionHistories']['amount']; ?></td>
						  <td><?php echo $trans['TransactionHistories']['transactionid']; ?></td>
						  <td class="hidden-480"><?php echo $trans['TransactionHistories']['description']; ?></td>
						</tr>
					<?php endforeach; ?>
                  </tbody>
                </table>
              </div>
			  
            </div>
			<div class="row-fluid">
              <div class="span6">
                <div id="sample_1_info" class="dataTables_info">
                <span class="full psdB10">Showing 1 to 5 of 25 entries</span>
				
				 <span class="full psdB10">
				 	
					<?php echo $this->Html->link('Export', array('controller' => 'users', 'action' => 'export'),array("escape"=>false, 'class'=>'btn bluee')); ?>
				 </span>
				</div>
              </div>
              <div class="span6">
                <div class="dataTables_paginate paging_bootstrap pagination">
                  <ul>
                    <!--<li class="prev disabled"><a href="#">? Prev</a></li>-->
					<?php if($this->Paginator->hasPrev()) : ?>
					<?php echo $this->Paginator->prev(__('Prev'), array('tag'=>'li', 'currentTag'=>'li', 'disabledTag'=>'li'), null, array('class' => 'prev disabled')); ?>
					<?php endif; ?>
					<?php echo $this->Paginator->numbers(array('first' => 2, 'last' => 2, 'tag'=>'li', 'currentTag'=>'li', 'disabledTag'=>array('li','span'))); ?>
                    <!--<li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>-->
					<?php if($this->Paginator->hasNext()) : ?>
					<?php echo $this->Paginator->next(__('Next'), array('tag'=>'li', 'currentTag'=>'li', 'disabledTag'=>'li'), null, array('class' => 'next disabled')); ?>
					<?php endif; ?>
                    <!--<li class="next"><a href="#">Next ? </a></li>-->
                  </ul>
                </div>
              </div>
            </div>            
          </div>
        </div>
     
      </div>
    </div>
    <!-- END PAGE CONTAINER-->
  </div>
  <script>
	$("#autorefill").change(function () {
		if($("#autorefill").prop('checked') == true){
			AutoRefilltoggle();
		}
    });

 function makeDepositForm(id)
	{
		var url =  CommanPath.basePath+'users/makeDeposit/'+id;
		$.ajax({
  			url: url,
  			beforeSend: function( xhr )
			{
    			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
  			}
		})
  	  	.done(function( data )
		{
			$("#makeDepositId").html(data);
			$("#makeDepositId").css("display","block");
		});
		
	}
	function AutoRefill()
	{
		var url =  CommanPath.basePath+'users/autoRefill';
		$.ajax({
  			url: url,
  			beforeSend: function( xhr )
			{
    			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
  			}
		})
  	  	.done(function( data )
		{
			$("#makeDepositId").html(data);
			$("#makeDepositId").css("display","block");
		});
		
	}
	
	function AutoRefilltoggle()
	{
		
		var url =  CommanPath.basePath+'users/autoRefill/1';
		$.ajax({
  			url: url,
  			beforeSend: function( xhr )
			{
    			xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
  			}
		})
  	  	.done(function( data )
		{
			$("#makeDepositId").html(data);
			$("#makeDepositId").css("display","block");
		});
		
	}
  </script>