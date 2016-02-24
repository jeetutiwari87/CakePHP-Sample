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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if(isset($cssIncludes) && $cssIncludes!=''){
	foreach($cssIncludes as $css){
		echo $this->Html->css($css);
	}
}
if(isset($jsIncludes) && $jsIncludes!=''){
	foreach($jsIncludes as $js){
		echo $this->Html->script($js);
	}
}
?>
<?php echo $this->fetch('content'); ?>
