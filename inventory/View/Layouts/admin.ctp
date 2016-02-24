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
		
		echo $this->Html->css('admin/bootstrap.min.css');
		echo $this->Html->css('admin/font-awesome.css');
		echo $this->Html->css('admin/bootstrap3-wysihtml5.min.css');
		echo $this->Html->css('admin/ionicons.min.css');
		echo $this->Html->css('admin/admin.css');
		echo $this->Html->js();
		echo $this->Html->script('jquery_min.js'); 
		echo $this->Html->script('admin/jquery-ui-1.10.3.min.js'); 
		echo $this->Html->script('admin/bootstrap.min.js');
		echo $this->Html->script('admin/jquery.oLoader.js');
		echo $this->Html->script('admin/bootstrap3-wysihtml5.all.min.js');
        echo $this->Html->script('admin/placeholder.js');
        echo $this->Html->script('admin/icheck.js');
		echo $this->Html->script('jquery.form.min.js');
		echo $this->Html->script('admin/jquery.form-validator.js');
		
		?>
    </head>
     <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
		<?php echo $this->element('admin/header'); ?>
       
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
			<?php echo $this->element('admin/navigation'); ?>
          
            <!-- Right side column. Contains the navbar and content of the page -->
			<div id="loadData"><?php echo $this->fetch('content'); ?></div>
            
        </div><!-- ./wrapper -->


<?php




echo $this->Html->script('admin/jquery.jgrowl.js'); 
echo $this->Html->css('admin/jquery.jgrowl.css');

echo $this->Html->script('admin/custom.js');

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
<script type="text/javascript">
$(document).ready(function(){
  $('input, textarea').placeholder();
  
  <?php if ($this->Session->check('Message.flash')==1) { 
   $message=$this->Session->read('Message');
  ?>
  jQuery.jGrowl("<?php echo $this->Session->flash(); ?>", { header: 'Message' });
  <?php $this->Session->flash();  } ?>
});
</script>
<?php  echo $this->element('sql_dump'); ?>
</body>
</html>