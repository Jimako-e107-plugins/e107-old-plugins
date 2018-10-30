//<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery Categories Navigation Shortcode File
 * 
 * $Id: sgal1.sc 859 2011-03-28 14:42:23Z berckoff $
 * 
 * 
 * 
 * 
 * Shortcode params:
 * 
 *	tmpl=tmpl_name		- name of the template to be used ("default" by default)
 *	album=all			- int album ID, comma separated IDs or not used for all
 *	category=all		- int cateogry ID, comma separated IDs or not used for all
 * 
 * Example calls:
 * 
 *		{SGAL=album=3&tmpl=slide&pps=all&nocats&nothumbs&slideshow=5&loop}
 *						- flash like looped album view without navigation
 * 
 *		{SGAL=tmpl=shadowbox&pps=5&nocats&shadowbox}
 *						- thumbs navigation strip only with main pictures opening in shadowbox
 */

global $tp, $sql, $parm;

if (!defset('SGAL_INCPATH'))		define('SGAL_INCPATH',			e_PLUGIN.'sgallery/includes/');
if (!defset('SGAL_ALBUMPATH'))		define('SGAL_ALBUMPATH',		e_PLUGIN.'sgallery/pics/');
if (!defset('SGAL_ALBUMPATH_ABS'))	define('SGAL_ALBUMPATH_ABS',	e_PLUGIN_ABS.'sgallery/pics/');

function check_nav_ids($str, $as_array=false)
{
	$ids = array();
	$str = explode(',', str_replace(' ', '', $str));
	
	foreach ($str as $id)
	{
		$id = intval($id);
		if (0 != $id)	$ids[] = $id;
	}
	
	if ($as_array)	return $ids;
	
	return ($ids ? implode(',', array_unique($ids)) : '');
}

function getNavTemplate($tmpl)
{
	if (is_readable(THEME.'templates/sgallery/sgallery_nav_tmpl.php'))
	{
		include_once THEME.'templates/sgallery/sgallery_nav_tmpl.php';
	}
	elseif (is_readable(e_PLUGIN.'sgallery/templates/sgallery_nav_tmpl.php'))
	{
		include_once e_PLUGIN.'sgallery/templates/sgallery_nav_tmpl.php';
	}
	
	return (isset($SGALLERY_NAV[$tmpl]) ? $SGALLERY_NAV[$tmpl] : '');
}

if (is_string($parm))  parse_str($parm, $scparams);

parse_str(htmlspecialchars_decode(e_QUERY), $qryparams);

$params		= array_merge($scparams, $qryparams);
$tmpl_name  = isset($params['tmpl']) && '' != $params['tmpl'] ? $params['tmpl'] : 'default';
$tmpl       = getNavTemplate($tmpl_name);

$albums     = isset($params['album'])		? check_nav_ids($params['album'])		: '';
$categories = isset($params['category'])	? check_nav_ids($params['category'])	: '';
$p_cats_arr = $categories					? check_nav_ids($categories, true)		: array();

$cats       =
$albums     = array();

if (!is_a($tp, 'e_parse'))	$tp	 = new e_parse();
if (!is_a($sql, 'db'))		$sql = new db();

if (isset($_SESSION['sgal_navi_cache']) && is_array($_SESSION['sgal_navi_cache']) && !empty($_SESSION['sgal_navi_cache']) && md5('sgal_navi_'.$categories.$albums) == $_SESSION['sgal_navi_cache']['md5'])
{
	$cats	= $_SESSION['sgal_navi_cache']['cats'];
	$files	= $_SESSION['sgal_navi_cache']['files'];
	$albums	= $_SESSION['sgal_navi_cache']['albums'];
}
else
{
	$db_query = '
		SELECT
			c.cat_id, c.title as cat_title,
			a.album_id, a.title as album_title, a.path as album_path
		FROM
			#sgallery_cats as c
		INNER JOIN
			#sgallery as a
		ON
			c.cat_id = a.cat_id
		WHERE
			a.album_ustatus = 1
		AND
			a.active = 1
		AND
			c.active = 1'.(!$categories ? '' : '
		AND
			c.cat_id IN ('.$categories.')').(!$albums ? '' : '
		AND
			a.album_id IN ('.$albums.')');
	
	if ($sql->db_Select_gen($db_query))
	{
		while ($row = $sql->db_Fetch(MYSQL_ASSOC))
		{
			if (!empty($p_cats_arr)		&& !in_array($row['cat_id'], $p_cats_arr))	continue;
			
			$albums[$row['cat_id']][$row['album_id']]	= $row;
			$cats[$row['cat_id']]						= $row['cat_title'];
		}
	}
	
	if (!session_id())	session_start();
	
	$_SESSION['sgal_navi_cache']['md5']    = md5('sgal_navi_'.$categories.$albums);
	$_SESSION['sgal_navi_cache']['cats']   = $cats;
	$_SESSION['sgal_navi_cache']['albums'] = $albums;
}

require SGAL_INCPATH.'sgal_navi_batch.php';

# Cache params for shortcode retrieval
cachevars('sgal_navi_params', array_intersect_key($params, array('tmpl'=>'', 'album'=>'', 'category'=>'',)));

$total = count($cats);

foreach ($cats as $id=>$title)
{
	cachevars('sgal_navi_cat_item', array('cat_id'=>$id, 'cat_title'=>$title, 'cat_albums'=>$albums[$id]));
	
	foreach ($albums[$id] as $adata)
	{
		cachevars('sgal_navi_album_item', $adata);
		
		$aret[] = $tp->parseTemplate($tmpl['navi|sub']['item'],  true, $sgal_navi_shortcodes);
	}
	
	$cret[] = $tp->parseTemplate($tmpl['navi|main']['item'], true, $sgal_navi_shortcodes).
			  $tp->parseTemplate($tmpl['navi|sub']['pre'],   true, $sgal_navi_shortcodes).
			  implode($tp->parseTemplate($tmpl['navi|sub']['separator']), $aret).
			  $tp->parseTemplate($tmpl['navi|sub']['post'],  true, $sgal_navi_shortcodes);
}
	
return	$tp->parseTemplate($tmpl['navi|main']['pre'],  true, $sgal_navi_shortcodes).
		implode($tp->parseTemplate($tmpl['navi|main']['separator']), $cret).
		$tp->parseTemplate($tmpl['navi|main']['post'],  true, $sgal_navi_shortcodes);