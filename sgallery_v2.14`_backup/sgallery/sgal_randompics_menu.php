<?php
/*
 * Corllete Lab Gallery
 *
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Random/Latest pictures menu
 *
 * $Id: sgal_randompics_menu.php 1563 2011-04-21 12:52:27Z secretr $
*/
if(!defined('e107_INIT'))
{
	exit();
}
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $sgal_pref, $SGAL_RANDPICS_MENU, $sgalobj;

if(!method_exists('e107', 'getInstance'))
{
	return 'This menu requires e107 v0.8';
}

$tp = e107::getParser();
$pref = e107::getPref();
$ns = e107::getRender();

if(!check_class($pref['sgal_active']))
{
	return '';
}

if(!defined('SGAL_PATH'))
	require_once ('init.php');
include_lan(SGAL_LAN.'.php');

require_once (SGAL_INCPATH."sgal_file_class.php");
$fl = new sgal_file();
$rpiclabel = 'Random Picture'; //TODO - lan


$text = '';

//template
if(!isset($SGAL_RANDPICS_MENU)||!$SGAL_RANDPICS_MENU)
{
	if(is_readable(THEME.'templates/sgallery/sgallery_randpics_tmpl.php'))
		require_once (THEME.'templates/sgallery/sgallery_randpics_tmpl.php');
	else
		require_once (SGAL_TMPL.'sgallery_randpics_tmpl.php');
}

//width, height, far
$cfgarr['w'] = defined('SGAL_RANDPICS_W') ? SGAL_RANDPICS_W : $sgal_pref['sgal_thumb_w'];
$cfgarr['h'] = defined('SGAL_RANDPICS_H') ? SGAL_RANDPICS_H : $sgal_pref['sgal_thumb_h'];
$cfgarr['far'] = defined('SGAL_RANDPICS_FAR') ? SGAL_RANDPICS_FAR : $sgal_pref['sgal_far'];

//number albusm to show
if(defined('SGAL_RANDPICS_NUM'))
	$sgalnum = intval(SGAL_RANDPICS_NUM);
else
	$sgalnum = 1;

$imagelist = $fl->sgal_all_pics(0, '', false);
$images = count($imagelist);
$ignore = array();
if(e107::getDb()->db_Select('sgallery', 'path', 'active=0'))
{
	while($tmp = e107::getDb()->db_Fetch())
	{
		$ignore[] = $tmp['path'];
	}
}

if($images)
{
	if($sgalnum > $images) $sgalnum = $images;
	$text = $SGAL_RANDPICS_MENU['start'];
	for ($i = 0; $i < $sgalnum; $i++)
	{
		if(!$imagelist) break;

		$rand_key = array_rand($imagelist);
		$albumpath = basename($imagelist[$rand_key]['path']);

		if($ignore && in_array($albumpath, $ignore))
		{
			$i = $i-1;
			unset($imagelist[$rand_key]);
			continue;
		}
		$albumpath .= '/';

		$thumburl = showThumb($albumpath.$imagelist[$rand_key]['fname'], $cfgarr);
		$thumb = "<img src='".$thumburl."' alt='{$rpiclabel}' class='image'/>";

		$v = array(
			'IMAGE_NAME' => $imagelist[$rand_key]['fname'],
			'IMAGE_URL' => SITEURL.$imagelist[$rand_key]['path'].$imagelist[$rand_key]['fname'],
			'IMAGE_OPEN' => "<a href='".SITEURL.$imagelist[$rand_key]['path'].$imagelist[$rand_key]['fname']."' rel='shadowbox__gallery_rpics___' onclick=\"sgalSmartOpen('".showJsThumb($albumpath.$imagelist[$rand_key]['fname'], $rpiclabel)."');return false;\" title='{$rpiclabel}'>{$thumb}</a>",
			'IMAGE_THUMB' => $thumb,
			'IMAGE_THUMB_URL' => $thumburl,
			'IMAGE_TOTAL' => $images,
			'IMAGE_COUNT' => $sgalnum,
			'IMAGE_INDEX' => $i + 1,
		);

		$evars = new e_vars($v);
		$text .= $tp->simpleParse($SGAL_RANDPICS_MENU['item'], $evars);

		unset($imagelist[$rand_key]);
	}

	$text .= $SGAL_RANDPICS_MENU['end'];
}

$title = SGAL_RAND ? SGAL_RANDM_1 : SGAL_RANDM_1a;

if($text)
	$ns->tablerender($title, $text, 'clGallery');
