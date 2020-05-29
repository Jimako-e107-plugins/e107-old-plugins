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
$gallery_name		= "slideshow_show";

$text = gallery_js($gallery_name);

global $e107cache;
$f_text = $e107cache->retrieve($gallery_name, 120);
if($f_text == false) 
{
	$qry = "SELECT * FROM #slideshow WHERE (slideshow_visible IN (".USERCLASS_LIST.") AND slideshow_active = 1) ORDER BY slideshow_datestamp DESC LIMIT 0,".$slideshow_shows;
	$sql->db_Select_Gen($qry);
	$counter = 1;
	$f_text = $navigation_text = $element_text = $slideshow_summary_text = '';
	while($row = $sql -> db_Fetch())
	{
		extract($row);
		if(substr($slideshow_url,0,3) == "www")
		{	// Append http:// for entries that just have www in them
			$slideshow_url = str_replace("www", "http://www", $slideshow_url);
		}
		$href = $tp->replaceConstants($slideshow_url); // supports some e107 constants in URL like {e_PLUGIN}
		$img_path = SITEURL.e_IMAGE.'slideshowimages/';
		$thumb_path = SITEURL.e_IMAGE.'slideshowthumbs/';
		if (strlen($slideshow_image) == 0)
		{	// If slideshow image is empty display the no_image.png
			$img_path = SITEURLBASE.e_PLUGIN_ABS."slideshow/images/";
			$slideshow_image = "no_image.png";
		}
		if (strlen($slideshow_thumb) == 0)
		{	// If slideshow thumb is empty display the no_image.png
			$thumb_path = SITEURLBASE.e_PLUGIN_ABS."slideshow/images/";
			$slideshow_thumb = "no_image.png";
		}
		if (strlen(trim($slideshow_summary_text)) == 0) // or !isset($slideshow_summary))
		{	// If the slideshow summary is empty create a summary from the body text without tags and BBcodes
			$slideshow_summary_text = substr(strip_tags($tp->toHTML($slideshow_description, true)), 0 , $slideshow_summary);
		}
		$navigation_text .= gallery_nav($counter, $thumb_path, $slideshow_thumb, $slideshow_name);
		$element_text .= gallery_element($counter, $href, '', $slideshow_name, $slideshow_summary_text, $img_path, $slideshow_image, $thumb_path, $slideshow_thumb); // NOTE: no id to be added to url!
		$counter++;
		unset($slideshow_summary_text);
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
$ns -> tablerender($pref['slideshow_show_title'],  $text);
?>