<table>
<?php if(isset($data['Event']['email_event_to']) && !empty($data['Event']['email_event_to'])){?>
<tr>
	
    <td style="text-align:left;" colspan="2"><p style="padding:0; margin:0;">Hi ,</p>
      <p  style="padding:0 0 0 0; margin:0;"><br/>
	  Site admin created  an event and details are below:<br/>

   
      </p></td>
 </tr>
 <?php }?>
 <tr>
	
	<td>
		Lead Name
	</td>
	
	<td>
		<?php echo $lead['Lead']['name']; ?>
	</td>
	
 </tr>
 <tr>
	
	<td>
		Subject
	</td>
	
	<td>
		<?php echo $data['Event']['subject']; ?>
	</td>
	
 </tr>
 <tr>
	
	<td>
		Label
	</td>
	
	<td>
		<?php echo $data['Event']['label']; ?>
	</td>
	
 </tr>
  <tr>
	
	<td>
		Location
	</td>
	
	<td>
		<?php echo $data['Event']['location']; ?>
	</td>
	
 </tr>
  <tr>
	
	<td>
		Start Date
	</td>
	
	<td>
		<?php echo $data['Event']['start_date']; ?>
	</td>
	
 </tr>
  <tr>
	
	<td>
		Start Time
	</td>
	
	<td>
		<?php echo $data['Event']['start_time']; ?>
	</td>
	
 </tr>
  <tr>
	
	<td>
		Duration
	</td>
	
	<td>
		<?php echo $data['Event']['duration']; ?>
	</td>
	
 </tr>
 <tr>
	
	<td>
		Remind Me
	</td>
	
	<td>
		<?php echo $data['Event']['remind_me']; ?>
	</td>
	
 </tr>
 <tr>
	
	<td>
		Notes
	</td>
	
	<td>
		<?php echo $data['Event']['notes']; ?>
	</td>
	
 </tr>
 <tr>
	
	<td>
		Status
	</td>
	
	<td>
		<?php
		if($data['Event']['status']==1){
		$status	=	'Active';
		}else{
		$status	=	'Inactive';
		}
		echo $status; ?>
	</td>
	
 </tr>
 
</table>