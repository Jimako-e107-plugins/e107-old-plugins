<?php
/*
 * Corllete Lab Widgets
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * CL Widgets - Configuration data 
 *
 * $Id: plugin.php 1187 2010-10-18 08:03:57Z secretr $
*/

if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."cl_widgets/languages/".e_LANGUAGE."/plugin.php";
include_lan($lan_file);

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  'CLW_LANADM';
$eplug_version = '1.1.3';
$eplug_author = 'SecretR @ Corllete Lab';
$eplug_url = 'http://www.free-source.net';
$eplug_email = '';
$eplug_description = CLW_LANADM_1;
$eplug_compatible = 'e107v0.7.9+';
$eplug_readme = 'readme.txt';
$eplug_compliant = TRUE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'cl_widgets';
//Plugin logo
$eplug_logo = $eplug_folder.'/images/icon_32.png';

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = FALSE;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder.'/images/icon_32.png';
$eplug_icon_small = $eplug_folder.'/images/icon_16.png';
$eplug_caption = CLW_LANADM_2;


// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
        'cl_widget_ver' 			=> $eplug_version,
        'cl_widget_list' 			=> '',
        'cl_widget_prefs' 			=> '',
		'cl_widget_debug' 			=> '0',
		'cl_widget_cache' 			=> '1',
		'cl_widget_jscompression' 	=> '1',
		'cl_widget_list'			=> '',
		'cl_08compat'			  	=> '1',
		'cl_08compat_style' 		=> '0',
		'cl_08compat_style_admin' 	=> '1',
		'cl_widget_cachelm' 		=> time()
);


// List of table names & SQL
$eplug_table_names = array();

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array();

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url = '';
$eplug_link_perms = ''; // Optional: Guest, Member, Admin, Everyone


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = CLW_LANADM_3;


// upgrading ... //
$upgrade_add_prefs =  array(
	'cl_widget_ver' 			=> $eplug_version, 
	'cl_widget_jscompression' 	=> '1', 
	'cl_widget_cachelm' 		=> time()
);

//ALTER TABLE
$upgrade_alter_tables = array();

$upgrade_remove_prefs = array(); //array
$upgrade_alter_tables = '';
$eplug_upgrade_done = ''; //msg

if(!function_exists("cl_widgets_upgrade")) {
    function cl_widgets_upgrade() {
		global $pref;
		
		$newp = array(
			'cl_08compat'			  	=> '0',
			'cl_08compat_style_admin' 	=> '1',
			'cl_08compat_style' 		=> '0',
			'cl_widget_jscompression' 	=> '1', 
		);
		
		//add new perfs only
		foreach ($newp as $k => $v) 
		{
			if(!isset($pref[$k]))
			{
				$pref[$k] = $v;
			}
		}

    	//clear server cache
    	require_once(e_PLUGIN.'cl_widgets/widget.php');
        clw_widget::clear_jslib_cache();
        
        //browser cache already refreshed by the new cl_widget_cachelm GET value
        $pref['cl_widget_cachelm'] = time();
        save_prefs();
    }
}

?>