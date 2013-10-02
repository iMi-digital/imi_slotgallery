<?php

 /**
  * PHP version 5
  * @copyright  Stephan Jahrling (Stephan Jahrling - Softwarelösungen), 2013
  * @author     Stephan Jahrling <info@jahrling-software.de>
  * @license    commercial
  */


/**
 * Class CE_iMi_slotgallery
 *
 * @copyright  Stephan Jahrling 2013
 * @author     Stephan Jahrling 
 * @package    Controller
 */
class CE_iMi_slotgallery extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_imi_slotgallery';


	/**
	 * Generate content element
	 */
	public function generate()
	{
		
		$this->multiSRC = deserialize($this->multiSRC);
		
		// Return if there are no files
		if (!is_array($this->multiSRC) || empty($this->multiSRC))
		{
			return '';
		}
		
		
		// Get the file entries from the database
		if (version_compare(VERSION, '3.2', '<'))
		{
			// Contao 3.1.x: use id
			$this->objFiles = \FilesModel::findMultipleByIds($this->multiSRC);
		}
		else
		{
			// Contao 3.2: use uuid
			$this->objFiles = \FilesModel::findMultipleByUuids($this->multiSRC);
		}

		if ($this->objFiles === null)
		{
			return '';
		}
		
		
		// get slot data
		if (strlen($this->imi_slots))
		{
			$this->arrSlotData = deserialize($this->imi_slots);
		}
		
		if (!is_array($this->arrSlotData) || !count($this->arrSlotData))
		{
			return '';
		}
		
		
		return parent::generate();
	}


	/**
	 * Parse the template
	 * @return string
	 */
	protected function compile()
	{
		global $objPage;
		
		$arrSlots = array();
		$arrImages = array();
		$objFiles = $this->objFiles;
		
		
		// load all images in array
		while ($objFiles->next())
		{
			// Continue if the files has been processed or does not exist
			if (isset($arrImages[$objFiles->path]) || !file_exists(TL_ROOT . '/' . $objFiles->path))
			{
				continue;
			}

			
			if ($objFiles->type == 'file')
			{
				// file
				$objFile = new \File($objFiles->path, true);

				if (!$objFile->isGdImage)
				{
					continue;
				}
				
				
				$arrMeta = $this->getMetaData($objFiles->meta, $objPage->language);

				// Use the file name as title if none is given
				if ($arrMeta['title'] == '')
				{
					$arrMeta['title'] = specialchars(str_replace('_', ' ', $objFile->filename));
				}

				// Add the image
				$arrImages[$objFiles->path] = array
				(
					'id'        => $objFiles->id,
					'uuid'      => $objFiles->uuid,
					'name'      => $objFile->basename,
					'singleSRC' => $objFiles->path,
					'alt'       => $arrMeta['title'],
					'imageUrl'  => $arrMeta['link'],
					'caption'   => $arrMeta['caption']
				);
				
			}
			else
			{
			
				// folder -> get files
				if (version_compare(VERSION, '3.2', '<'))
				{
					// Contao 3.1.x: use id
					$objSubfiles = \FilesModel::findByPid($objFiles->id);
				}
				else
				{
					// Contao 3.2: use uuid
					$objSubfiles = \FilesModel::findByPid($objFiles->uuid);
				}
				

				if ($objSubfiles === null)
				{
					continue;
				}

				while ($objSubfiles->next())
				{
					// Skip subfolders
					if ($objSubfiles->type == 'folder')
					{
						continue;
					}
					
					// Continue if the files has been processed or does not exist
					if (isset($arrImages[$objSubfiles->path]) || !file_exists(TL_ROOT . '/' . $objSubfiles->path))
					{
						continue;
					}


					$objFile = new \File($objSubfiles->path, true);

					if (!$objFile->isGdImage)
					{
						continue;
					}

					$arrMeta = $this->getMetaData($objSubfiles->meta, $objPage->language);

					// Use the file name as title if none is given
					if ($arrMeta['title'] == '')
					{
						$arrMeta['title'] = specialchars(str_replace('_', ' ', $objFile->filename));
					}

					// Add the image
					$arrImages[$objSubfiles->path] = array
					(
						'id'        => $objSubfiles->id,
						'uuid'      => $objSubfiles->uuid,
						'name'      => $objFile->basename,
						'singleSRC' => $objSubfiles->path,
						'alt'       => $arrMeta['title'],
						'imageUrl'  => $arrMeta['link'],
						'caption'   => $arrMeta['caption']
					);
				}
			}
			
		}
		
		
		// create slots
		if (count($arrImages) && is_array($this->arrSlotData) && count($this->arrSlotData))
		{
			$strLightboxId = 'lightbox[lb' . $this->id . ']';
			foreach ($this->arrSlotData as $i => $arrSlot)
			{
				
				// skip if image array is empty
				if (!is_array($arrImages) || !count($arrImages))
				{
					continue;
				}
				
				// get random image
				$random_key = array_rand($arrImages);
				$random_img = $arrImages[$random_key];
				
				// unset key so we have no duplicates
				unset( $arrImages[$random_key] );
				
				
				// add slot data
				$random_img = array_merge($random_img, array(
					'size' 			=> $arrSlot['size'],
					'imagemargin'	=> $arrSlot['imagemargin'],
					'fullsize'		=> $arrSlot['fullsize']
				));
				
				
				// create standard class and add image
				$objImg = new \stdClass();
				$strClass = '';
				if ($i == count($this->arrSlotData)-1)
					$strClass = ' last';
				if ($i == 0)
					$strClass = ' first';
				
					
				$objImg->class = 'slot_' . $i . $strClass;
				$this->addImageToTemplate($objImg, $random_img, $GLOBALS['TL_CONFIG']['maxImageWidth'], $strLightboxId);
				
				$arrSlots[$i] = $objImg;
			}
		}
		
		
		$strTemplate = 'imi_slotgallery_default';

		// Use a custom template
		if (TL_MODE == 'FE' && $this->gallery_template != '')
		{
			$strTemplate = $this->gallery_template;
		}

		$objTemplate = new \FrontendTemplate($strTemplate);
		$objTemplate->setData($this->arrData);
		$objTemplate->slots = $arrSlots;
		
		$this->Template->images = $objTemplate->parse();
		
	}
} 
  
?>