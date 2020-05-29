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
$gallery_name		= "slideshow_news";

$text = gallery_js($gallery_name);

global $e107cache;
$f_text = $e107cache->retrieve($gallery_name, 120);
if($f_text == false) 
{
	$qry = "SELECT * FROM #news WHERE news_render_type='0' AND (news_class IN (".USERCLASS_LIST.")) ORDER BY news_id DESC LIMIT 0,".$slideshow_shows;
	$sql->db_Select_Gen($qry);
	$counter = 1;
	$f_text = $navigation_text = $element_text = '';
	$href = SITEURL."news.php?item.";
	while($row = $sql -> db_Fetch())
	{
		$news_thumbnail = $row['news_thumbnail'];
		$news_summary = $row['news_summary'];
		$news_body = $row['news_body'];
		$news_id = $row['news_id'];
		$news_title = $row['news_title'];
		$img_path = $thumb_path = e_IMAGE_ABS.'newspost_images/';
		if (strlen($news_thumbnail) == 0)
		{	// If news thumbnail is empty display the no_image.png
			$img_path = $thumb_path = e_PLUGIN_ABS."slideshow/images/";
			$news_thumbnail = "no_image.png";
		}
		if (strlen($news_summary) == 0)
		{	// If the news summary is empty create a news summary from the body text without tags and BBcodes
			$news_summary = substr(strip_tags($tp->toHTML($news_body, true)), 0 , $slideshow_summary);
		}
		$navigation_text .= gallery_nav($counter, $thumb_path, $news_thumbnail, $news_title);
		$element_text .= gallery_element($counter, $href, $news_id, $news_title, $news_summary, $img_path, $news_thumbnail, $thumb_path, $news_thumbnail);
		$counter++;
		unset($news_summary);
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
$ns -> tablerender($pref['slideshow_news_title'],  $text);
?>