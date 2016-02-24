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
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<section class="full my_account_heading">
  <article class="wrapper_full">
    <h1><?php echo __d('cake_dev', 'Missing View'); ?></h1>
  </article>
</section>
<section class="full under_heading">
  <article class="wrapper_full">
    <div class="full paddT33 paddB33">
      <div class="full ">
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
	<?php echo __d('cake_dev', 'The view for %1$s%2$s was not found.', '<em>' . Inflector::camelize($this->request->controller) . 'Controller::</em>', '<em>' . $this->request->action . '()</em>'); ?>
</p>
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
	<?php echo __d('cake_dev', 'Confirm you have created the file: %s', $file); ?>
</p>
<p class="notice">
	<strong><?php echo __d('cake_dev', 'Notice'); ?>: </strong>
	<?php echo __d('cake_dev', 'If you want to customize this error message, create %s', APP_DIR . DS . 'View' . DS . 'Errors' . DS . 'missing_view.ctp'); ?>
</p>

<?php echo $this->element('exception_stack_trace'); ?>

</div></div></article></section>


<h2></h2>
