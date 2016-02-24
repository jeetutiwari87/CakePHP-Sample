<link rel="stylesheet" type="text/css" medial="all" title="Default" href="<?php echo Router::url('/',true);?>app/webroot/css/print.css"/>
<?php
//echo $this->Html->css("print", "stylesheet", array("media"=>"all"), false);
//header("Content-type: application/pdf");
echo $content_for_layout;
?>
