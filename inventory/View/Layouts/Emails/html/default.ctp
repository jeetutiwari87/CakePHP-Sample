<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $title_for_layout;?></title>
</head>
<body style="padding:0; margin:0;">
<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" style="border: solid 1px #CCC; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#585858" >
 <?php /*?> <tr>
    <td style=" background-color:#ffd555; height:7px;"></td>
  </tr>
  <tr>
    <td style=" background-color:#fff; text-align:center; padding:10px; font-size:0;"><img src="<?php echo Router::url('/',true);?>img/luxury_email_logo.png" width="190" height="113" alt="LuxuryFlatshares" /></td>
  </tr>
  <tr>
    <td style=" background-color:#fff; text-align:center; padding:0; font-size:0;"><img src="<?php echo Router::url('/',true);?>img/green_border.jpg"  alt="" width="100%" height="29" /></td>
  </tr>
  <?php echo $this->fetch('content');?>
  
<tr>
    <td style=" background-color:#fff; text-align:center; padding:0; font-size:0;"><img src="<?php echo Router::url('/',true);?>img/gray_border.jpg" width="100%" height="18" alt="gray_border.jpg" /></td>
  </tr>
  <tr>
    <td style=" background-color:#fff; text-align:center; padding:10px;"><p style="font-size:18px; color:#000; padding:0; margin:0;"></p>
      <p  style="padding:15px 0 0 0; margin:0; font-size:12px;"><?php //echo Configure::read('site.name');?> <a href="<?php echo Configure::read('site.url');?>" style="color:#B58425; text-decoration:underline; font-weight:bold;"> <?php echo Configure::read('site.url');?></a></p></td>
  </tr>
  <tr>
    <td style=" background-color:#ffd555; height:45px; font-size:12px; color:#5E5E5E; font-weight:bold; text-align:center; vertical-align:middle;"> Need help? Have feedback? Feel free to <a href="<?php echo Router::url('/',true);?>contact-us.html" style="color:#000; text-decoration:underline; font-weight:bold;">Contact Us</a></td>
  </tr>
</table><?php */?>
<?php echo $this->fetch('content');?>
</body>
</html>