<?php

 /**
  * PHP version 5
  * @copyright  Stephan Jahrling (Stephan Jahrling - Softwarelösungen), 2013
  * @author     Stephan Jahrling <info@jahrling-software.de>
  * @license    commercial
  */



/**
 * Content elements
 */
array_insert($GLOBALS['TL_CTE']['media'], count($GLOBALS['TL_CTE']['media']), array
(
	'imi_slotgallery' => 'CE_iMi_slotgallery'
));  


/**
 * backend styles
 */
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS'][] = 'system/modules/imi_slotgallery/assets/backend.css'; 
}
  
?>