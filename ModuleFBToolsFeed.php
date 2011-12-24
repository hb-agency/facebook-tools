<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @copyright  Leo Feyer 2005-2010
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Frontend
 * @license    LGPL
 * @filesource
 */


/**
 * Class ModuleFBToolsFeed
 *
 * @copyright  Winans Creative 2011
 * @author     Blair Winans <blair@winanscreative.com>
 * @author     Russell Winans <russ@winanscreative.com>
 * @package    Facebook Tools
 * @license    LGPL
 */
class ModuleFBToolsFeed extends Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_fbtools_feed';
	
	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{

			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### FACEBOOK TOOLS - FRIEND FEED ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->fbtools_clientusername;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate content element
	 */
	protected function compile()
	{
	
		//Get AUTH TOKEN
		$strCurlURL = 'https://graph.facebook.com/oauth/access_token?type=client_cred&client_id=' . $this->fbtools_clientid . "&client_secret=" . $this->fbtools_clientsecret;
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, $strCurlURL); 
		curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //set response to string
		$JSONresult = curl_exec($ch); //execute post and get results
		curl_close ($ch);
		
		
		$strLimit = '';
		if($this->fbtools_limit >0)
		{
			$strLimit = '&limit=' . $this->fbtools_limit;
		}
		
		//Get FEED DATA
		$strFeedCurlURL = 'https://graph.facebook.com/' . $this->fbtools_clientusername . '/feed?' . $JSONresult . $strLimit;
		
		$chf = curl_init();
	
		curl_setopt($chf, CURLOPT_URL, $strFeedCurlURL); 
		curl_setopt($chf, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
		curl_setopt($chf, CURLOPT_RETURNTRANSFER, 1); //set response to string
		$JSONfeedresult = curl_exec($chf); //execute post and get results
		curl_close ($chf);
		
		$objResult = json_decode($JSONfeedresult);
		$arrResults = $objResult->data;
		
		$strBuffer = '';
		
		$strTemplate = $this->fbtools_template ? $this->fbtools_template : 'fbfeed_default';
		
		foreach($arrResults as $objPost)
		{
			$objTemplate = new FrontendTemplate($strTemplate);
			
			$arrData = get_object_vars($objPost);
			
			foreach($arrData as $key=>$value)
			{
				if(is_object($value))
				{
					$arrData[$key] = get_object_vars($value);
				}
			}
			
			$objTemplate->setData($arrData);
			
			//Extra stuff
			$objTemplate->created_time = date($GLOBALS['TL_CONFIG']['dateFormat'], strtotime($objPost->created_time));
			$objTemplate->updated_time = date($GLOBALS['TL_CONFIG']['dateFormat'], strtotime($objPost->updated_time));
			$objTemplate->totallikes = $objPost->likes->count;
			$objTemplate->totalcomments = $objPost->comments->count;
			$objTemplate->fromname = $objPost->from->name;
			$objTemplate->pagelink = 'http://www.facebook.com/' . $this->fbtools_clientusername;
			
			$strBuffer .= $objTemplate->parse();
		}
		
		$this->Template->posts = $strBuffer;
		
	}

}