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
 * @copyright  2011 Winans Creative 
 * @author     Blair Winans <blair@winanscreative.com>
 * @package    Facebook Tools
 * @license    LGPL 
 */


/**
 * Fields
 */ 
$GLOBALS['TL_LANG']['tl_module']['fbtools_clientid'] = array('Facebook Client ID','Please enter your Facebook Client ID of the person/page whose feed you want to display.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_clientsecret'] = array('Facebook Client Secret Key','Please enter your Facebook Client Secret key of the person/page whose feed you want to display.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_clientusername'] = array('Facebook Client Username','Please specify the username or ID of the page/person whose feed you want to display.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_limit'] = array('Number of entries','Specify the max number of entries to display. Set to <strong>0</strong> to display all results.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_template'] = array('Facebook Feed template','Specify the template you would like to use for each individual entry.'); 

$GLOBALS['TL_LANG']['tl_module']['fbtools_appid'] = array('Facebook Application ID','Please specify the facebook application ID.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_modid'] = array('Facebook Moderator Username','Please specify the facebook ID of the person who you want to moderate the newsfeed.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_color'] = array('Facebook Color Scheme', 'Please specify the color scheme light or dark.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_width'] = array('Facebook Comment Width','Please specify the width of the comments box in pixels.');
$GLOBALS['TL_LANG']['tl_module']['fbtools_maxposts'] = array('Facebook Maximum Posts','Please specify the maximum number of posts shown upon entry to the page.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_module']['facebook_legend'] = 'Facebook Settings';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_module']['colors']['light'] = 'Light Colored';
$GLOBALS['TL_LANG']['tl_module']['colors']['dark'] 	= 'Dark Colored';

?>