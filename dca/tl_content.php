<?php

 /**
  * PHP version 5
  * @copyright  Stephan Jahrling (Stephan Jahrling - Softwarelösungen), 2013
  * @author     Stephan Jahrling <info@jahrling-software.de>
  * @license    commercial
  */


/**
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['imi_slotgallery'] = '{type_legend},type,headline;{source_legend},multiSRC;{image_legend},imi_slots;{template_legend:hide},gallery_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space;{invisible_legend:hide},invisible,start,stop';



/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['gallery_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['gallery_template'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_imi_slotgallery_content', 'getGalleryTemplates'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['imi_slots'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['imi_slots'],
	'exclude'                 => true,
	'inputType' 			  => 'multiColumnWizard',
	'eval' 					  => array
	(
		'minCount'		=> 1,
		'columnFields' 	=> array
		(
			'size' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
				'exclude'                 => true,
				'inputType'               => 'imageSize',
				'options'                 => $GLOBALS['TL_CROP'],
				'reference'               => &$GLOBALS['TL_LANG']['MSC'],
				'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'helpwizard'=>true),
			),
			
			'imagemargin' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_content']['imagemargin'],
				'exclude'                 => true,
				'inputType'               => 'trbl',
				'options'                 => array('px', '%', 'em', 'ex', 'pt', 'pc', 'in', 'cm', 'mm'),
				'eval'                    => array('includeBlankOption'=>true),
			),
			'fullsize' => array
			(
				'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fullsize'],
				'exclude'                 => true,
				'inputType'               => 'checkbox',
				'eval'                    => array('style'=>'width: 80px;'),
 
			)
		)
	),
	'sql'                     => "blob NULL"
); 
 
  
?>