<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if( ! defined('e107_INIT')){ exit(); }
$eplug_folder = 'easygallery';
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');

$eplug_name			= 'EG_NAME';
$eplug_version		= '1.1';
$eplug_author		= 'nlstart';
$eplug_url			= 'http://plugins.e107.org/';
$eplug_email		= 'nlstart@users.sourceforge.net';
$eplug_description	= EG_DESC;
$eplug_compatible	= 'e107v0.7+';
$eplug_compliant	= TRUE;
$eplug_readme		= 'readme.txt';

$eplug_menu_name	= EG_MENU;
$eplug_conffile		= 'admin_config.php';
$eplug_icon			= $eplug_folder.'/images/icon_easygallery_32.png';
$eplug_icon_small	= $eplug_folder.'/images/icon_easygallery_16.png';
$eplug_caption		= EG_CAPTION;

// List of preferences ---------------------------------------------------------
// this stores a default value(s) in the preferences. 0 = Off , 1= On
// Preferences are saved with plugin folder name as prefix to make preferences unique and recognisable
$eplug_prefs = array(
	$eplug_folder.'_settings' => array(
		'full_max_size'		=> 600,
		'size'				=> 150,
		'universal'			=> true, 
		'borderR'			=> 255, 
		'borderG'			=> 255, 
		'borderB'			=> 255, 
		'albums'			=> true, 
		'imagequality'		=> 70, 
		'fileName'			=> true, 
		'internalDisplay'	=> true,
		'sortOrder'			=> 'nameASC', 
		'deleteThumbs'		=> 2, 
		'imagemethod'		=> 'gd2', 
		'convert'			=> '', 
		'identify'			=> '',
		'fulls'				=> 'gallery/', 
		'show_comments'		=> 0, 
		'upload_class'		=> 255, 
		'max_uploads'		=> 5
	));

// List of table names ---------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder.'/'.$eplug_folder.'_sql.php');
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables ---------------------------------------
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE '.MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) 
{
	$eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry	
	
// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link			= TRUE;
$eplug_link_name	= EG_LINK_NAME;
$eplug_link_url		= e_PLUGIN.'easygallery/gallery.php';
$eplug_done			= EG_DONE1.' '.EG_NAME.' v'.$eplug_version.' '.EG_DONE2;
// Set the gallery folder to CHMOD 755 and inform the user if it fails
if (!chmod(e_PLUGIN.'easygallery/gallery', 0755)) 
{
  $eplug_done .= '<br />'.EG_CHMOD.'<br />';
}

// upgrading ...
$upgrade_add_prefs		= '';
$upgrade_remove_prefs	= '';
$upgrade_alter_tables	= '';
$eplug_upgrade_done		= EG_DONE3.' '.EG_NAME.' v'.$eplug_version.'.';
?>