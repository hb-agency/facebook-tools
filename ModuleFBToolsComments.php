<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2011
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Frontend
 * @license    LGPL
 * @filesource
 */


/**
 * Class ModuleFBToolsComments
 *
 * Front end module "Facebook Comments Feed".
 * @copyright  Winans Creative 2011
 * @author     Blair Winans <blair@winanscreative.com>
 * @author     Russell Winans <russ@winanscreative.com>
 * @package    Facebook Tools
 * @license    LGPL
 */
class ModuleFBToolsComments extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fbtools_comments';
	
	/**
	 * Generate module
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{

			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### FACEBOOK COMMENT FEED ###';
			$objTemplate->title = $this->headline;
			return $objTemplate->parse();
		}

		return parent::generate();
	}

	/**
	 * Compile module
	 */
	protected function compile()
	{
		$GLOBALS['TL_HEAD'][] = '<meta property="fb:admins" content="'.$this->fbtools_modid.'">';
		$GLOBALS['TL_HEAD'][] = '<meta property="fb:app_id" content="'.$this->fbtools_appid.'">';
				
		//Add javascript
		$objTemplate = new FrontendTemplate('fbjs_comments');
		$objTemplate->appid = $this->fbtools_appid;
		$objTemplate->http = $this->Environment->ssl ? 'https' : 'http';
		$GLOBALS['TL_MOOTOOLS'][] = $objTemplate->parse();

		$this->Template->pageurl = $this->Environment->base . $this->Environment->request;
		$this->Template->modid = $this->fbtools_modid;
		$this->Template->color = $this->fbtools_color;
		$this->Template->width = $this->fbtools_width;
		$this->Template->maxposts = $this->fbtools_maxposts;
	}
}

?>