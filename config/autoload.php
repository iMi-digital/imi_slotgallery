<?php

/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'iMi\SlotGallery',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Content elements
	'iMi\SlotGallery\CE_iMi_slotgallery'=> 'system/modules/imi_slotgallery/classes/CE_iMi_slotgallery.php',
	
	
	// helper classes
	'iMi\SlotGallery\tl_imi_slotgallery_content'	=> 'system/modules/imi_slotgallery/classes/tl_imi_slotgallery_content.php'
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