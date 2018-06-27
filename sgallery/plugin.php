<?php
/**
 * e107 website system 
 * e107 Plugin file: e107_plugins/sgallery/plugin.php
 * 
 * Email: m.yovchev@clabteam.com
 * Copyright Corllete Lab ( http://www.clabteam.com ) under GNU GPL License (http://gnu.org)
 * Free Support: http://dev.e107bg.org/
 * 
 * $Id: plugin.php 1645 2011-08-08 15:11:20Z berckoff $
 */

if (!defined('e107_INIT'))  exit;

global $pref;

include_lan(e_PLUGIN.'sgallery/languages/'.e_LANGUAGE.'_admin.php');

# Plugin info
$eplug_name        = 'Corllete Lab Gallery';
$eplug_url         = 'http://www.clabteam.com';
//$eplug_logo        = 'button.png';
$eplug_email       = 'm.yovchev@clabteam.com';
$eplug_author      = 'SecretR @ Corllete Lab';
$eplug_readme      = '';
$eplug_version     = '2.13';
$eplug_compliant   = TRUE;
$eplug_compatible  = 'e107v0.7.25+';
$eplug_description = SGAL_LANADM_3;

# Plugin folder's name
$eplug_folder      = 'sgallery';

# Menu item name for this plugin
$eplug_menu_name   = FALSE;

# Admin config filename
$eplug_conffile    = 'admin_config.php';

# Icon image and caption text
$eplug_icon        = $eplug_folder.'/images/icon_32.png';
$eplug_icon_small  = $eplug_folder.'/images/icon_16.png';
$eplug_caption     = SGAL_LANADM_4;

# Plugin preferences list
$eplug_prefs = array( 
	'sgal_active'		=> e_UC_PUBLIC,
	'sgal_wperms'		=> e_UC_MEMBER, 
	'sgal_advwperms'	=> e_UC_ADMIN,
	'sgal_bbthumbperms'	=> e_UC_MEMBER,
	'sgal_version'		=> $eplug_version
);

# Tables list
$eplug_table_names = array('sgallery', 'sgallery_cats', 'sgallery_submit');


# DB requests list for DB tables creation
$eplug_tables = array(
    "CREATE TABLE ".MPREFIX."sgallery (
      album_id int(10) unsigned NOT NULL auto_increment,
      cat_id int(10) unsigned NOT NULL default '0',
      sgal_user varchar(250) NOT NULL default '',
      title varchar(200) NOT NULL default '',
      album_description TEXT NOT NULL,
      dt int(10) NOT NULL default '0',
      path varchar(12) NOT NULL default '',
      thsrc varchar(50) NOT NULL default '',
      active tinyint(1) NOT NULL default '0',
      album_viewed int(10) unsigned NOT NULL default '0',
      album_ustatus tinyint(1) NOT NULL default '1' ,
      PRIMARY KEY (album_id),
      KEY sgal_user (sgal_user),
      KEY album_ustatus (album_ustatus)
    ) ENGINE=MyISAM",
    
    "CREATE TABLE ".MPREFIX."sgallery_cats (
      cat_id int(10) unsigned NOT NULL auto_increment,
      title varchar(200) NOT NULL default '',
      cat_description text NOT NULL,
      cat_order int(10) unsigned NOT NULL default '0',
      active tinyint(1) NOT NULL default '0',
      cat_viewed int(10) unsigned NOT NULL default '0',
      PRIMARY KEY  (cat_id)
    ) ENGINE=MyISAM",
    
    "CREATE TABLE ".MPREFIX."sgallery_submit (
      submit_id int(10) unsigned NOT NULL auto_increment,
      submit_album_id int(10) unsigned NOT NULL default '0',
      submit_user varchar(250) NOT NULL default '',
      submit_dt int(10) NOT NULL default '0',
      submit_ip varchar(20) NOT NULL default '',
      submit_picnum smallint(4) unsigned NOT NULL default '0',
      PRIMARY KEY  (submit_id),
      KEY submit_album_id (submit_album_id)
    ) ENGINE=MyISAM"
);

# Main menu link creation (yes=TRUE, no=FALSE)
$eplug_link = TRUE;
$eplug_link_url   = e_PLUGIN.$eplug_folder.'/gallery.php';
$eplug_link_name  = SGAL_LANADM_5;
$eplug_link_perms = 'Everyone';  # Optional: Guest, Member, Admin, Everyone

# Successfull installation message
$eplug_done = SGAL_LANADM_6;

# Upgrade/update
$upgrade_add_prefs =  array( 
	'sgal_active'		=> varset($pref['sgal_active'], e_UC_PUBLIC),
	'sgal_wperms'		=> varset($pref['sgal_wperms'], e_UC_MEMBER), 
	'sgal_advwperms'	=> varset($pref['sgal_advwperms'], e_UC_ADMIN),
	'sgal_bbthumbperms'	=> varset($pref['sgal_bbthumbperms'], e_UC_MEMBER),
	'sgal_version'		=> $eplug_version
);

$upgrade_remove_prefs = array(
	'sgal_restrict_size' => '0',
	'sgal_restrict_w' => '640',
	'sgal_restrict_h' => '480',
	'sgal_allow_uresize' => '1',
	'sgal_allow_cropresize' => '0',
	'sgal_allow_autoresize' => '1',
	'sgal_w' => '640',
	'sgal_h' => '480',
	'sgal_thumb_create' => '0',
	'sgal_far' => '0',
	'sgal_bg' => 'FFFFFF',
	'sgal_admin_albums' => '10',
	'sgal_tblrender' => '1',
	'sgal_galperrow' => '4',
	'sgal_thgal_w' => '120',
	'sgal_thgal_h' => '90',
	'sgal_albumperrow' => '3',
	'sgal_albumperpage' => '9',
	'sgal_thalbum_w' => '120',
	'sgal_thalbum_h' => '90',
	'sgal_picperrow' => '4',
	'sgal_picperpage' => '12',
	'sgal_thumb_w' => '120',
	'sgal_thumb_h' => '90',
	'sgal_pagenum' => '5',
	'sgalsys_suspicious_check' => '0'
);

# Bad, bad, bad way to do this - find out whats new in 0.79+, implement better way for upgrading, create sql file, implement check for update routine
if (isset($pref['sgal_version']) && $pref['sgal_version'] < 2)
{  
	$upgrade_alter_tables = array("
		CREATE TABLE IF NOT EXISTS ".MPREFIX."sgallery_submit (
			submit_id int(10) unsigned NOT NULL auto_increment,
			submit_album_id int(10) unsigned NOT NULL default '0',
			submit_user varchar(250) NOT NULL default '',
			submit_dt int(10) NOT NULL default '0',
			submit_ip varchar(20) NOT NULL default '',
			submit_picnum smallint(4) unsigned NOT NULL default '0',
			PRIMARY KEY  (submit_id),
			KEY submit_album_id (submit_album_id)
		) ENGINE=MyISAM",
		"ALTER TABLE `".MPREFIX."sgallery` ADD `sgal_user` VARCHAR( 250 ) NOT NULL AFTER `cat_id`",
		"ALTER TABLE `".MPREFIX."sgallery` ADD `album_description` TEXT NOT NULL AFTER `title`",
		"ALTER TABLE `".MPREFIX."sgallery` ADD `album_viewed` INT( 10 ) DEFAULT '0' NOT NULL",
		"ALTER TABLE `".MPREFIX."sgallery` ADD `album_ustatus` TINYINT( 1 ) DEFAULT '1' NOT NULL",
		"ALTER TABLE `".MPREFIX."sgallery` ADD INDEX `sgal_user` ( `sgal_user` )",
		"ALTER TABLE `".MPREFIX."sgallery` ADD INDEX `album_ustatus` ( `album_ustatus` )",
		"ALTER TABLE `".MPREFIX."sgallery_cats` ADD `cat_description` TEXT NOT NULL AFTER `title`",
		"ALTER TABLE `".MPREFIX."sgallery_cats` ADD `cat_viewed` INT( 10 ) DEFAULT '0' NOT NULL"
	);
}
else
{
    $upgrade_alter_tables = array();
}

# Successfull update/upgrade message
$eplug_upgrade_done = SGAL_LANADM_160.' <a href="'.e_PLUGIN.'sgallery/admin_config.php?config">['.SGAL_LANADM_161.']</a>';

if (!function_exists('sgallery_uninstall'))
{
	//Remove prefs and menu entry during uninstall
	function sgallery_uninstall()
	{
		global $sql;
		$sql->db_Delete("core", "e107_name = 'sgallery_prefs'");
		$sql->db_Delete("menus", "menu_name = 'sgal_random_menu'");
		$sql->db_Delete("menus", "menu_name = 'sgal_multirand_menu'");
		$sql->db_Delete("menus", "menu_name = 'sgal_galmultirand_menu'");
		$sql->db_Delete("menus", "menu_name = 'sgal_user_random_menu'");
	}
}

if (!function_exists('sgallery_upgrade'))
{
    function sgallery_upgrade()
    {	# Upgrade from version 1.0
        global $pref, $sgal_pref, $sgalobj, $sql;
        
        ecache::clear('nomd5_SgalleryPrefs');
        require_once(e_PLUGIN.'sgallery/init.php');
        
        foreach ($sgal_pref as $pname=>$pval)
        {
        	if (isset($pref[$pname]))  $sgal_pref[$pname] = $pref[$pname];
        }
        
        # Merge new and old settings
        $sgal_pref = array_merge($sgalobj->_DefPrefs(), $sgal_pref);
        $sgalobj->updatePref($sgal_pref);
        
        # e107 plugin manager - fix
        $sql->db_Update('plugin', " plugin_name='Corllete Lab Gallery' WHERE plugin_path='sgallery'");
    }
}