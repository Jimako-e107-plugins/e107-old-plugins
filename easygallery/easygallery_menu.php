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
if (!defined('e107_INIT')) { exit(); }
global $tp;
// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');
require_once(e_PLUGIN.'easygallery/eg_class.php');

// Receive the easygallery settings from the preferences
$config = $pref['easygallery_settings'];
$config['thumbs'] = $config['fulls'].'thumbs';

define ('EG_SHOWRENDERTIME', false);
if (EG_SHOWRENDERTIME) $starttime = microtime(true);

$eg_text = '';
$base_gallery_dir = e_PLUGIN.'easygallery/'.$config['fulls'];
$albumlist = GetAlbumList($base_gallery_dir);
$filelist = array();
foreach ($albumlist as &$album) 
{
	$album_name = e_PLUGIN.'easygallery/'.$config['fulls'].$album;
	$filelist[$album] = GetFileList($album_name);
}

$random_album = array_rand($filelist); // Get a random album from the list
$random_album_list = $filelist[$random_album]; // Make a separate array for the randomly picked album
$random_image_nr = array_rand($random_album_list); // Get a random image nr from the album
$random_image = $random_album_list[$random_image_nr]; // Get the random image name
$entry_referral = $config['fulls'].$random_album."/".$random_image; // Create the full path to the image

$thumb_referral = $random_album.$random_image;
if (preg_match("/\.(bmp)$/i",$thumb_referral)) 
{
	$thumb_image = $config['thumbs'].'/'.$thumb_referral.'.jpg';
}
else
{
	$thumb_image = $config['thumbs'].'/'.$thumb_referral;
}

$eg_text .= "
	<div style='text=align:center; vertical-align:middle;'>
		<a href='".e_PLUGIN."easygallery/gallery.php?entry=".$entry_referral."' alt=''><img src='".e_PLUGIN."easygallery/".$thumb_image."' alt='' style='display:block; margin:auto; border:0;' /></a>
	</div>";
unset($thumb_image,$thumb_referral,$random_album,$random_album_list,$random_image_nr,$random_image,$entry_referral,$config['thumbs']);
	
if (EG_SHOWRENDERTIME) 
{	// Show the render time if the parameter is set
	$rendertime = microtime(true) - $starttime;
	$eg_text .= "<div>Render time: ".$rendertime."</div>";
}

$caption = EG_NAME;
$ns -> tablerender($caption, $eg_text);
?>