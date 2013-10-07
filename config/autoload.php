<?php

 /**
  * PHP version 5
  * @copyright  Stephan Jahrling (Stephan Jahrling - Softwarelösungen), 2013
  * @author     Stephan Jahrling <info@jahrling-software.de>
  * @license    commercial
  */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Content elements
	'CE_iMi_slotgallery'=> 'system/modules/imi_slotgallery/classes/CE_iMi_slotgallery.php',
	
	
	// helper classes
	'tl_imi_slotgallery_content'	=> 'system/modules/imi_slotgallery/classes/tl_imi_slotgallery_content.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_imi_slotgallery'       => 'system/modules/imi_slotgallery/templates',
	'imi_slotgallery_default'  => 'system/modules/imi_slotgallery/templates',
));
  
  
?>