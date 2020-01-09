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
		 

			$eplug_tables = array("
			CREATE TABLE ".MPREFIX."tag_main (
			`Tag_ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`Tag_Item_ID` INT NOT NULL,
			`Tag_Type` VARCHAR( 20 ) NOT NULL,
			`Tag_Name` VARCHAR( 50 ) NOT NULL,
			`Tag_Rank` INT NULL,
			`Tag_Created` INT NULL ,
			INDEX ( `Tag_Item_ID` , `Tag_Type`)
			) ENGINE=MyISAM;",
			
			"CREATE TABLE ".MPREFIX."tag_config (
			`Tag_Config_ID`                    INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`Tag_Config_Flag`                  INT NOT NULL,
			`Tag_Config_CloudFlag`             INT NOT NULL,
			`Tag_Config_OnOffFlag`             INT NOT NULL,
			`Tag_Config_Type`                  varchar(20) NOT NULL
			) ENGINE=MYISAM;",
			
			"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'news');",
			"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '1','1','1', 'page');",
			"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'forum');",
			"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'download');",
			"INSERT INTO ".MPREFIX."tag_config VALUES (NULL, '0','1','1', 'content');"
			);			
			
			
			foreach ($eplug_tables as $tags_query)
			{
				e107::getDB()->gen($tags_query);
			}
	
			
		}
		
		
		function uninstall_post($var)
		{    
		  $delete_tables = e107::getSingleton('e107plugin')->unInstallOpts['delete_tables'];   
			 
		  if (vartrue($delete_tables, FALSE))   {   
				
				$eplug_table_names = array(
				"tag_main","tag_config"
				);
				
				foreach ($eplug_table_names as $tags_query)
				{
				  $query = "DROP TABLE ".MPREFIX.$tags_query.";";     
					e107::getDB()->gen($query);
				}	
			}		
 
		}		
		
		// List of table names -----------------------------------------------------------------------------------------------


  }
}