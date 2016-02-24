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
		echo $this->Html->meta('icon', 'images_front/favicon.ico');
        echo $this->Html->js();
		echo $this->fetch('meta');
	
        //echo $this->Html->css('front/style');
		//echo $this->Html->css('front/responsive');
	    echo $this->Html->css('admin/jquery.jgrowl.css');
	  
		echo $this->Html->script('admin/jquery.jgrowl.js'); 
		
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
       
	    echo $this->fetch('css');
		echo $this->fetch('script');


	?>



</head>
<body>
		
<?php echo $this->fetch('content'); ?>

<script type="text/javascript">
<?php
if ($this->Session->check('Message.flash')==1) 
{	
	?>

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

 <?php } ?>
	
</script>
</body>
</html>