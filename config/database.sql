-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the Contao    *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- 
-- Table `tl_content`
-- 

CREATE TABLE `tl_content` (
  `fbtools_clientid` varchar(255) NOT NULL default '',
  `fbtools_clientsecret` varchar(255) NOT NULL default '',
  `fbtools_clientusername` varchar(255) NOT NULL default '',
  `fbtools_limit` int(10) NOT NULL default '0',
  `fbtools_template` varchar(255) NOT NULL default '',
  `fbtools_modid` varchar(255) NOT NULL default '',
  `fbtools_appid` varchar(255) NOT NULL default '',
  `fbtools_color` varchar(255) NOT NULL default '',  
  `fbtools_width` int(10) NOT NULL default '0',  
  `fbtools_maxposts` int(10) NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `fbtools_clientid` varchar(255) NOT NULL default '',
  `fbtools_clientsecret` varchar(255) NOT NULL default '',
  `fbtools_clientusername` varchar(255) NOT NULL default '',
  `fbtools_limit` int(10) NOT NULL default '0',
  `fbtools_template` varchar(255) NOT NULL default '',
  `fbtools_modid` varchar(255) NOT NULL default '',
  `fbtools_appid` varchar(255) NOT NULL default '',
  `fbtools_color` varchar(255) NOT NULL default '',  
  `fbtools_width` int(10) NOT NULL default '0',  
  `fbtools_maxposts` int(10) NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------
