<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2002
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Coppermine";

$eplug_version = "1.3.5c";
$eplug_author = "McFly/MrPete/Gummi";
$eplug_url = "http://www.e107coders.org";
$eplug_email = "";
$eplug_description = "A fully integrated version of the Coppermine Photo Gallery for e107 0.7+";
$eplug_compatible = "e107v7+";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = FALSE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "coppermine_menu";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "coppermine_menu";

// User class for special users ---------------------------------------------------------------------------
$eplug_userclass = "COPPERMINE_ADMIN";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon_small    = $eplug_folder."/e107config/camera16.gif";
$eplug_icon = $eplug_folder."/e107config/camera32.gif";
$eplug_caption = "Configure Coppermine";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
   "cpg_showcats"	=> "",
   "cpg_showalbs"	=> "",
   "cpg_cats"		=> "",
   "cpg_albums"		=> "",
   "cpg_numimages"	=> "2",
   "cpg_title1"		=> "Random Pics",
   "cpg_title2"		=> "",
   "cpg_click_text"	=> "",
   "cpg_opennew"	=> "No",
   "cpg_horiz"		=> "Vertical"
);
// Configuration Tests --------------------------------------------------------------------------------------
define("SAFE_MODE", ini_get('safe_mode'));
if (!defined('CPG_e107PLUG_FUNCS')) {
	define('CPG_e107PLUG_FUNCS', 'done');

	function test_im() {
		global $pref, $eplug_folder;

		$im_installed = false;
		$im_path = $pref['im_path'];

		if ($im_path != '') {
			if (!preg_match('|/\Z|', $im_path)) {
				$im_path .= '/';
			}
			if (!is_dir($im_path)) {
				$errors .= "<hr /><br />Coppermine can't find the '{$im_path}' directory you have specified for ImageMagick, or it does not have permission to access it. Check that your typing is correct and that you have access to the specified directory.<br /><br />";
			}
			elseif (preg_match('/ /', $im_path)) {
				$errors .= "<hr /><br />The path you have entered for ImageMagick ('{$im_path}') contains at least one space. This will cause problems for Coppermine.<br /><br />
	                        You must move ImageMagick to another directory.<br /><br />";
			}
			elseif (!file_exists($im_path.'convert') && !file_exists($im_path.'convert.exe')) {
				$errors .= "<hr /><br />Coppermine can't find the 'convert' or 'convert.exe' ImageMagick program in directory '{$im_path}'. Check that you have entered the correct directory name.<br /><br />";
			} else {
				$output = array();

				$tst_out = e_PLUGIN.$eplug_folder."/albums/userpics/im.gif";
				$tst_in = e_PLUGIN.$eplug_folder."/images/nopic.jpg";
				$execcmd = "{$im_path}convert -verbose $tst_in $tst_out";
				exec($execcmd, $output, $result);
				$size = getimagesize($tst_out);
				unlink ($tst_out);
				$im_installed = ($size[2] == 1);

				if (!$im_installed) {
					$errors .= "<br />
	                Coppermine found the ImageMagick 'convert' program in '{$im_path}', however it can't be executed.";

					if (SAFE_MODE) {
						$errors .= "<br/>This is probably because your server is running in Safe Mode, which makes it very difficult to execute external programs.";
					}
					$errors .= "<br /><br />You may want to consider using GD instead of ImageMagick.<br /><br />";
				}
				if ($result && count($output)) {
					$errors .= "The ImageMagick convert program said:<br /><pre>";

					foreach ($output as $line)
						$errors .= htmlspecialchars($line)."\n";
					$errors .= "</pre><br /><br />";
				}
			}
		}

		return $im_installed ? '' : $errors;
	}

}

if(e_PAGE == 'plugin.php')
{
// List of sql requests to create tables -----------------------------------------------------------------------------
require_once (e_PLUGIN.$eplug_folder.'/include/sql_parse.php');
$db_schema = e_PLUGIN.$eplug_folder.'/sql/schema.sql';
$sql_query = fread(fopen($db_schema, 'r'), filesize($db_schema));
$db_basic = e_PLUGIN.$eplug_folder.'/sql/basic.sql';
$sql_query .= fread(fopen($db_basic, 'r'), filesize($db_basic));
// Insert the admin account
// (not for e107)
// Set configuration values for image package
$thumb_method = $pref['resize_method'];
$plug_done_errors = '';

if ($thumb_method == 'ImageMagick') {
	$thumb_method = 'im'; // translate from e107 to cpg
	$plug_done_errors = test_im();
	$sql_query .= "REPLACE INTO CPG_config VALUES ('thumb_method', '".$thumb_method."');\n";
}

$sql_query .= "REPLACE INTO CPG_config VALUES ('impath', '".$pref['im_path']."');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('ecards_more_pic_target', '".SITEURL.str_replace(e_BASE, "", e_PLUGIN).$eplug_folder."');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('theme', 'e107');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('gallery_admin_email', '".SITEADMINEMAIL."');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('gallery_name', '".SITENAME." Photo Gallery');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('read_exif_data', '1');\n";
$sql_query .= "REPLACE INTO CPG_config VALUES ('forbiden_fname_char', '$/\\\\:*?&quot;\'&lt;&gt;|`');\n";
// Test write permissions for main dir
if (!is_writable('.')) {
	$sql_query .= "REPLACE INTO CPG_config VALUES ('default_dir_mode', '0777');\n";
	$sql_query .= "REPLACE INTO CPG_config VALUES ('default_file_mode', '0666');\n";
}

$sql_query = remove_remarks($sql_query);
$sql_query = split_sql_file($sql_query, ';');

// List of table names -----------------------------------------------------------------------------------------------
// (Used for uninstall)
$tablenames = array();

while (list($key, $sql_req) = each($sql_query)) {
	$test = array();

	if (preg_match('/CPG_(\w+)\W/', $sql_req, $test)) {
		$tablenames[] = 'CPG_'.$test[1];
	}
}

$eplug_table_names = array_unique($tablenames);

// Now complete the process of creating SQL statements for installation
// Update table prefix -- ok to do on array
$sql_query = preg_replace('/CPG_/', $mySQLprefix.'CPG_', $sql_query);

$eplug_tables = $sql_query;
}

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Gallery";
$eplug_link_url = e_PLUGIN.$eplug_folder."/";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "
Coppermine is now installed.
<br /><br />
It should have created a link called 'Gallery' in your main menu.  As an admin, when you go
to a coppermine page it will automatically make sure you have the currect permissions
set in your directories.
<br /><br />
Please go to the coppermine admin 'config' area and fix any errors that are seen.
<br /><br />
Also:<br/>
* Edit your coppermine 'groups' area as needed, <br/>
* Make sure that you create at least one album or you won't be able to do anything :)<br/>
* Give users ('visitors') appropriate permission to upload to albums.
";

if (SAFE_MODE)
{
	@include_once (e_PLUGIN.$eplug_folder.'/include/config.inc.php');

	if (!defined('SILLY_SAFE_MODE')) {
		$eplug_done .= "
		<br /><br /><b>WARNING: Your server is running in PHP Safe Mode, and needs special configuration.</b> Please edit coppermine_menu/includes/config.inc.php and remove the '//' that comments-out the SILLY_SAFE_MODE definition. Also note the mkdir in coppermine_menu/other, which may provide a workaround for this issue. Read the comments at the top of the mkdir file to learn how to configure it. (The impact: in safe mode, coppermine cannot create directories with proper permissions, so it will upload all files to a single directory.)";
	}
}

if (strlen($plug_done_errors))
{
	$eplug_done .= '<br/><br/><b>CAUTION:</b><br/>'.$plug_done_errors;
}

// upgrading ... //

$upgrade_add_prefs = array(
   "cpg_e107custompages"	=> "1"
  );

$upgrade_remove_prefs = "";
$upgrade_errors_exit = FALSE;

// Only create the upgrade info in upgrading
if(strpos(e_QUERY, "upgrade") !== FALSE)
{
	$db_update = e_PLUGIN.$eplug_folder.'/sql/update.sql';
	$sql_query = fread(fopen($db_update, 'r'), filesize($db_update));
	
	$sql_query .= "REPLACE INTO CPG_config VALUES ('ecards_more_pic_target', '".SITEURL.str_replace(e_BASE, "", e_PLUGIN).$eplug_folder."');\n";
	$sql_query .= "REPLACE INTO CPG_config VALUES ('theme', 'e107');\n";
	$sql_query .= "REPLACE INTO CPG_config VALUES ('read_exif_data', '1');\n";
	$sql_query .= "REPLACE INTO CPG_config VALUES ('forbiden_fname_char', '$/\\\\:*?&quot;\'&lt;&gt;|`');\n";
	
	
	// Update table prefix
	$sql_query = preg_replace('/CPG_/', $mySQLprefix.'CPG_', $sql_query);
	
	$sql_query = remove_remarks($sql_query);
	$sql_query = split_sql_file($sql_query, ';');

	if(!function_exists('coppermine_menu_upgrade'))
	{
		function coppermine_menu_upgrade()
		{
			global $sql, $sql_query;
			foreach($sql_query as $tab)
			{
				$tab = trim($tab);
				$sql->db_Query_all($tab);
			}
		}
	}
}

$eplug_upgrade_done = "If there are no errors, the upgrade has been completed successfully. You are now running version ".$eplug_version;
if (strlen($plug_done_errors)) {
	$eplug_upgrade_done .= '<br/><br/><b>CAUTION:</b><br/>'.$plug_done_errors;
}

?>
