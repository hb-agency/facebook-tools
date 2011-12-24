<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Winans Creative 2011
 * @author     Blair Winans <blair@winanscreative.com>
 * @author     Russell Winans <russ@winanscreative.com>
 * @package    Facebook Tools
 * @license    LGPL
 */


/**
 * Palettes 
 */
 
$GLOBALS['TL_DCA']['tl_content']['palettes']['fbtools_feed'] = '{type_legend},type;{headline_legend},headline;{facebook_legend},fbtools_clientid,fbtools_clientsecret,fbtools_clientusername,fbtools_limit,fbtools_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_content']['palettes']['fbtools_comments'] = '{type_legend},type,headline;{facebook_legend},fbtools_modid,fbtools_appid,fbtools_color,fbtools_width,fbtools_maxposts;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_clientid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_clientid'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
);
 
$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_clientsecret'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_clientsecret'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_clientusername'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_clientusername'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'tl_class'=>'long m12 clr'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_limit'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_limit'],
	'exclude'                 => true,
	'default'                 => 0,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>5, 'rgxp'=>'digit', 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_template'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_content_fbtools', 'getFacebookFeedTemplates')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_appid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_appid'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_modid'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_modid'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_color'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_color'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'select',
	'default'				  => 'light',
	'options'                 => array('light', 'dark'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_content']['colors'],
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_width'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_width'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'default'				  => 400,
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'rgxp'=>'digit', 'tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_content']['fields']['fbtools_maxposts'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['fbtools_maxposts'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'default'				  => 5,
	'eval'                    => array('mandatory'=>true,'maxlength'=>255, 'rgxp'=>'digit', 'tl_class'=>'w50'),
);


class tl_content_fbtools extends Backend
{

	/**
	 * Return all gallery twitter as array
	 * @param object
	 * @return array
	 */
	public function getFacebookFeedTemplates(DataContainer $dc)
	{
		// Get the page ID
		$objArticle = $this->Database->prepare("SELECT pid FROM tl_article WHERE id=?")
									 ->limit(1)
									 ->execute($dc->activeRecord->pid);

		// Inherit the page settings
		$objPage = $this->getPageDetails($objArticle->pid);

		// Get the theme ID
		$objLayout = $this->Database->prepare("SELECT pid FROM tl_layout WHERE id=?")
									->limit(1)
									->execute($objPage->layout);

		// Return all twitter templates
		return $this->getTemplateGroup('fbfeed', $objLayout->pid);
	}
	
}
 
 ?>