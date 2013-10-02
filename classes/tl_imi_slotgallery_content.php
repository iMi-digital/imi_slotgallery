<?php

 /**
  * PHP version 5
  * @copyright  Stephan Jahrling (Stephan Jahrling - Softwarelösungen), 2013
  * @author     Stephan Jahrling <info@jahrling-software.de>
  * @license    commercial
  */



/**
 * Class tl_imi_slotgallery_content
 *
 * @copyright  Stephan Jahrling 2013
 * @author     Stephan Jahrling
 */
class tl_imi_slotgallery_content extends \Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Return all gallery templates as array
	 * @return array
	 */
	public function getGalleryTemplates()
	{
		return $this->getTemplateGroup('imi_slotgallery_');
	}

}
  
  
?>