<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	Slideshow plugin
|	© nlstart
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }
include_lan(e_PLUGIN.'slideshow/languages/'.e_LANGUAGE.'.php');
require_once(e_PLUGIN.'slideshow/slideshow_class.php');
// Some necessary javascripts for this plugin are included in the head section of the generated HTML page via e_meta.php

// Initial settings
global $tp,$sql;
$text 				= '';
$slideshow_shows	= intval($pref['slideshow_shows']);
$slideshow_summary	= intval($pref['slideshow_summary']); // Default 100 characters
$gallery_name		= "slideshow_dl";

$text = gallery_js($gallery_name);

global $e107cache;
$f_text = $e107cache->retrieve($gallery_name, 120);
if($f_text == false) 
{
	$qry = "SELECT * FROM #download WHERE (download_visible IN (".USERCLASS_LIST.") AND download_active = 1) ORDER BY download_id DESC LIMIT 0,".$slideshow_shows;
	$sql->db_Select_Gen($qry);
	$counter = 1;
	$f_text = $navigation_text = $element_text = '';
	$href = SITEURL."download.php?view.";
	while($row = $sql -> db_Fetch())
	{
		extract($row);
		$img_path = SITEURL.e_FILE.'downloadimages/';
		$thumb_path = SITEURL.e_FILE.'downloadthumbs/';
		if (strlen($download_image) == 0)
		{	// If download image is empty display the no_image.png
			$img_path = SITEURLBASE.e_PLUGIN_ABS."slideshow/images/";
			$download_image = "no_image.png";
		}
		if (strlen($download_thumb) == 0)
		{	// If download thumb is empty display the no_image.png
			$thumb_path = SITEURLBASE.e_PLUGIN_ABS."slideshow/images/";
			$download_thumb = "no_image.png";
		}
		if (strlen(trim($download_summary)) == 0) // or !isset($download_summary))
		{	// If the download summary is empty create a news summary from the body text without tags and BBcodes
			$download_summary = substr(strip_tags($tp->toHTML($download_description, true)), 0 , $slideshow_summary);
		}
		$navigation_text .= gallery_nav($counter, $thumb_path, $download_thumb, $download_name);
		$element_text .= gallery_element($counter, $href, $download_id, $download_name, $download_summary, $img_path, $download_image, $thumb_path, $download_thumb);
		$counter++;
		unset($download_summary);
	}

	$f_text .= '
		<div id="'.$gallery_name.'" >
			<ul class="ui-tabs-nav">'.$navigation_text.'
			</ul>
			'.$element_text.'
		</div>';
	$e107cache->set($gallery_name, $f_text);
}
$text .= $f_text;
$ns -> tablerender($pref['slideshow_download_title'],  $text);
?>