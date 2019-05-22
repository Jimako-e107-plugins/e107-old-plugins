<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/links_page/links_page_sql.php $
|     $Revision: 12092 $
|     $Id: links_page_sql.php 12092 2011-03-11 18:49:56Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/
header("location:../index.php");
exit;
?>
# Table structure for table `spiderlog`
#
CREATE TABLE spiderlog (
        spider_id int(11) unsigned NOT NULL auto_increment,
        spider_url varchar(255) NOT NULL default '',
        spider_date varchar(255) NOT NULL default '',
        spider_agent varchar(255) NOT NULL default '',
        spider_ip varchar(255) NOT NULL default '',
        PRIMARY KEY  (spider_id)
        ) ENGINE=MyISAM;
# --------------------------------------------------------

# Table structure for table `seo_keywords`
#
CREATE TABLE seo_keywords (
	keyword_id int(10) unsigned NOT NULL auto_increment,
	keyword_page int(10) NOT NULL,
	keyword_type varchar(200) NOT NULL default '',
	keyword_keywords text NOT NULL,
	keyword_date int(10) unsigned NOT NULL default '0',
	keyword_engine varchar(200) NOT NULL default '',	
    PRIMARY KEY  (keyword_id)	
	) ENGINE=MyISAM;
# --------------------------------------------------------
