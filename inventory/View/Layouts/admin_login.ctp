<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
		<?php echo $title_for_layout; ?>
		</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		
		<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->Html->css('admin/bootstrap.css');
		echo $this->Html->css('admin/bootstrap.min.css');
		echo $this->Html->css('admin/style.css');
	    echo $this->Html->css('admin/jquery.jgrowl.css');
		echo $this->Html->css('admin/validation.css');
		?>
		<!--[If IE]>
		<link rel="stylesheet" href="<?php echo Router::url('/',true);?>css/admin/ie.css" type="text/css" /> 
		
		<![endIf]-->
    </head>
    <body class="Portal">
    <?php echo $this->fetch('content'); ?>
<?php
echo $this->Html->js();

echo $this->Html->script('jquery_min.js'); 
echo $this->Html->script('admin/bootstrap.js');
echo $this->Html->script('admin/html5shiv.js'); 
echo $this->Html->script('admin/jquery.jgrowl.js'); 
echo $this->Html->script('admin/jquery.form-validator.js');
	
echo $this->fetch('css');
echo $this->fetch('script');
?>
<script type="text/javascript">
jQuery(document).ready(function(){
  
   <?php if ($this->Session->check('Message.flash')==1) { 
   $message=$this->Session->read('Message');
  ?>
  jQuery.jGrowl("<?php echo strip_tags($this->Session->flash()); ?>", { header: 'Message' });
 
  <?php $this->Session->flash();  } ?>

    jQuery.validate({
		modules : '',
		onModulesLoaded : function() {
		}
	});
		
});
</script>
    </body>
</html>