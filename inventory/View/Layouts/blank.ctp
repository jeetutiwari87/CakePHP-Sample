<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
         <?php  if(isset($description_for_layout)): ?>
        <meta name="description" content="<?php echo $description_for_layout;?>" />
        <?php endif; if(isset($keywords_for_layout)): ?>
            <meta name='keywords' content="<?php echo $keywords_for_layout;?>" />
        <?php endif;?>
		
	<?php
		echo $this->Html->meta('icon');
        echo $this->Html->js();
		echo $this->fetch('meta');
	
        echo $this->Html->css('style');
        echo $this->Html->css('jquery-ui-1.8.21.custom.css');
        echo $this->Html->css('jquery.datepick');
		echo $this->Html->css('jquery.ui.timepicker');
		echo $this->Html->css('jquery.jgrowl.css');
	
        echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('admin/jquery-ui-1.8.21.custom.min');
		echo $this->Html->script('jquery.jgrowl');
		echo $this->Html->script('jquery.datepick');
		echo $this->Html->script('jquery.ui.timepicker');
		
		
		$cssfiles=array();
		if(isset($cssIncludes) && $cssIncludes!=''){
			foreach($cssIncludes as $css){
				echo $this->Html->css($css);
			}
		}
		$jsfiles=array();
		if(isset($jsIncludes) && $jsIncludes!=''){
			foreach($jsIncludes as $js){
				echo $this->Html->script($js);
			}
		}
       
        echo $this->Html->script('luxury');
        if($this->params['controller']=='property_rooms' && $this->params['action']=='view')
        echo $this->Html->script('luxury_property_details');
	
	    echo $this->fetch('css');
		echo $this->fetch('script');

if ($this->Session->check('Message.flash')==1) 
{	
	?>
<script type="text/javascript">
	/**
	 ***
	 *** Show the message 
	 ***
	**/
	 jQuery(function(){

	  <?php
		if ($this->Session->check('Message.flash')==1) {
		 $message=$this->Session->read('Message');
	   ?>
		jQuery.jGrowl("<?php echo $this->Session->flash(); ?>", { header: 'Message' });
	  <?php } ?>
 	});
   </script>
 <?php } ?>
<!--[if lt IE 9]>
<?php  echo $this->Html->script('http://html5shim.googlecode.com/svn/trunk/html5.js'); ?>
<![endif]-->
</head>
<body>

<?php echo $this->fetch('content'); ?>


</body>
</html>
