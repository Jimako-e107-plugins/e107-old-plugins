<?php
/*
* e107 website system
*
* Copyright (C) 2008-2013 e107 Inc (e107.org)
* Released under the terms and conditions of the
* GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
*
* Custom install/uninstall/update routines for blank plugin
**
*/


if(!class_exists("tagcloud_setup"))
{
	class tagcloud_setup
	{
	
			/**
		 * For inserting default database content during install after table has been created by the blank_sql.php file.
		 */
		function install_post($var)
		{
			$sql = e107::getDb();
			$mes = e107::getMessage();
			
			// List of preferences -----------------------------------------------------------------------------------------------
			$eplug_prefs = array(
				'tags_number'      => 20,
				'tags_update'      => 0,
				'tags_peritem'     => 5,
				'tags_preview'     => 200,
        'tags_style_cloud' => 'tagcloud',
        'tags_style_item'  => 'tagitem',
        'tags_style_link'  => 'taglink',
        'tags_max_size'    => 250,
        'tags_min_size'    => 100,
        'tags_overwrite'   => 0,
        'tags_credit'      => 1,
        'tags_adminmod'    => 0,
        'tags_usermod'     => 0,
        'tags_autogen'     => 0,
        'tags_emetaforum'  => 1,
        'tags_max_colour'  => 'ffffff',
        'tags_min_colour'  => 'ffffff',
        'tags_tagspace'    => '_',
        'tags_seolink'     => 'tags-',
        'tags_fileext'     => '.html',
        'tags_menuname'    => 'Tagcloud',
        'tags_emetanews'   => 1,
        'tags_errortag'    => 200,
        'tags_cumwidth'    => 100,
        'tags_cumheight'   => 200,
        'tags_cumcolour'   => '000000',
        'tags_cumbackcolour'   => 'ffffff',
        'tags_cumtransparent'  => 0,
        'tags_cumspeed'    => 100
			);
			
			$tags_prefs = e107::getPlugConfig('tagcloud', '', false);
			$tags_prefs -> setPref($eplug_prefs) -> save(false, true);
		 
			
		}
  }
}