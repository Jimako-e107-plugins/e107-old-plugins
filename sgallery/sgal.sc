//<?php
/**
 * Corllete Lab Gallery
 * 
 * Copyright (C) 2006-2009 Corllete ltd (clabteam.com)
 * Support and updates at http://www.free-source.net/
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * 
 * SGallery 1 Shortcode File
 * 
 * $Id: sgal1.sc 859 2011-03-28 14:42:23Z berckoff $
 * 
 * 
 * 
 * 
 * Shortcode params:
 * 
 *	album=all			- int album ID, comma separated IDs or not used for all
 *	category=all		- int cateogry ID, comma separated IDs or not used for all
 *	tmpl=tmpl_name		- name of the template to be used ("default" by default)
 *	pps=all|int			- the number of pictures to show on a page (slide); default 5; 'all' to override limitation
 *	nocats				- hide the categories and albums navigation
 *	nothumbs			- hide the thumbs navigation (suitable for limited pics continuous slideshow in combination with 'nocats')
 *	slideshow[=X]		- whether to autoscroll the gallery pictures for current page (X is slide time in seconds (optional, default=7))
 *	loop				- whether to stop or not when last pic is reached if slideshow is enabled
 *	shadowbox			- if this option is set, the main picture container won't be displayed, as good as pictures will be shown in shadowbox window
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

function check_ids($str, $as_array=false)
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

function getTemplate($tmpl)
{
	if (is_readable(THEME.'templates/sgallery/sgallery_one_tmpl.php'))
	{
		include_once THEME.'templates/sgallery/sgallery_one_tmpl.php';
	}
	elseif (is_readable(e_PLUGIN.'sgallery/templates/sgallery_one_tmpl.php'))
	{
		include_once e_PLUGIN.'sgallery/templates/sgallery_one_tmpl.php';
	}
	
	return (isset($SGALLERY_ONE[$tmpl]) ? $SGALLERY_ONE[$tmpl] : '');
}

if (!defined('SGAL_INCPATH'))        define('SGAL_INCPATH',       e_PLUGIN.'sgallery/includes/');
if (!defined('SGAL_ALBUMPATH'))      define('SGAL_ALBUMPATH',     e_PLUGIN.'sgallery/pics/');
if (!defined('SGAL_ALBUMPATH_ABS'))  define('SGAL_ALBUMPATH_ABS', e_PLUGIN_ABS.'sgallery/pics/');

if (false !== strpos($parm, '|'))    list($parm, $thparm) = explode('|', $parm);
if (is_string($parm))                parse_str($parm, $scparams);
if (!isset($scparams['tmpl']))       $scparams['tmpl'] = 'default';

parse_str(htmlspecialchars_decode(e_QUERY), $qryparams);

$params     = array_merge($scparams, $qryparams);
$tmpl       = getTemplate($params['tmpl']);

if (!$tmpl)   return (defset('e_DEBUG') && true == e_DEBUG ? 'Error loading tmpl file!' : '');
if ($thparm)  $params['thumb'] = str_replace('thumb=', '', $thparm);

$qa			= isset($params['album'])    && 'all' != $params['album']    && 0 != intval($params['album'])    ? intval($params['album'])	   : 'all';
$qc			= isset($params['category']) && 'all' != $params['category'] && 0 != intval($params['category']) ? intval($params['category']) : 'all';

$page		= isset($params['page'])     && 0 != intval($params['page']) ? intval($params['page']) : 0;

$albums		= isset($params['album'])		? check_ids($params['album'])    : '';
$categories	= isset($params['category'])	? check_ids($params['category']) : '';
$p_cats_arr	= $categories					? check_ids($categories, true)   : array();
$p_albs_arr	= $albums						? check_ids($albums,     true)   : array();

$navi_c		= isset($params['nocats'])		? 0 : 1;
$navi_t		= isset($params['nothumbs'])	? 0 : 1;

$pps		= isset($params['pps'])			? $params['pps'] : 5;	# all - to override the limitation
$shadowbox	= isset($params['shadowbox'])	? true			 : false;

$ccats		=
$cfiles		=
$calbums	= array();

if (!is_a($tp, 'e_parse'))	$tp	 = new e_parse();
if (!is_a($sql, 'db'))		$sql = new db();

if (isset($_SESSION['sgal1_cache']) && is_array($_SESSION['sgal1_cache']) && !empty($_SESSION['sgal1_cache']) && md5($qc.$qa.$categories.$albums) == $_SESSION['sgal1_cache']['md5'])
{
	$ccats	= $_SESSION['sgal1_cache']['cats'];
	$cfiles	= $_SESSION['sgal1_cache']['files'];
	$calbums= $_SESSION['sgal1_cache']['albums'];
}
else
{
	$db_query = '
		SELECT
			c.cat_id, c.title AS cat_title,
			a.album_id, a.title AS album_title, a.path AS album_path
		FROM
			#sgallery_cats AS c
		INNER JOIN
			#sgallery AS a
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
			require_once SGAL_INCPATH.'/sgal_file_class.php';
			
			if (!empty($p_cats_arr) && !in_array($row['cat_id'], $p_cats_arr))	continue;
			
			$calbums[$row['cat_id']][$row['album_id']]	= $row;
			$ccats[$row['cat_id']]						= $row['cat_title'];
			
			if ('all' != $qc && !in_array($row['cat_id'],   $p_cats_arr))  continue;
			if ('all' != $qa && !in_array($row['album_id'], $p_albs_arr))  continue;
			
			$fClass  = new sgal_file();
			$files_t = $fClass->get_files(SGAL_ALBUMPATH.$row['album_path'].'/');
			
			if ($files_t)  foreach ($files_t as $filedata) { $cfiles[] = $row['album_path'].'/'.$filedata['fname']; }
		}
	}
	
	if ($cfiles)
	{
		$cfiles = array_unique($cfiles);
		
		sort($cfiles);
		
		if (!session_id())	session_start();
		
		$_SESSION['sgal1_cache']['md5']    = md5($qc.$qa.$categories.$albums);
		$_SESSION['sgal1_cache']['cats']   = $ccats;
		$_SESSION['sgal1_cache']['files']  = $cfiles;
		$_SESSION['sgal1_cache']['albums'] = $calbums;
	}
}

require SGAL_INCPATH.'sgal1_batch.php';

if (!$cfiles)
{
	$ret = $tp->parseTemplate($tmpl['empty']);
}
else
{
	# Start and End for pictures loops
	$total	= count($cfiles);
	$start	= 'all' == $pps ? 0		 : $page*$pps;
	$end	= 'all' == $pps ? $total : (($page+1)*$pps);
	
	if ($end > $total)  $end = $total;
	if ('all' == $pps)  $params['pps'] = $total;
	
	# Cache params for shortcode retrieval
	cachevars('sgal1_params',
				array_intersect_key(
					$params,
					array('pps'=>'', 'loop'=>'', 'tmpl'=>'', 'album'=>'', 'nocats'=>'', 'nothumbs'=>'', 'category'=>'', 'shadowbox'=>'', 'slideshow'=>'', 'thumb'=>'')
				)
	);
	
	# Categories and albums navigation pane
	if ($navi_c)
	{
		foreach ($cats as $id=>$title)
		{
			cachevars('sgal1_category_item', array('cat_id'=>$id, 'cat_title'=>$title, 'cat_albums'=>$albums[$id]));
			
			$ret_c[] = $tp->parseTemplate($tmpl['navi_cat']['item'], true, $sgal1_shortcodes);
		}
	}
	
	if ($navi_t)
	{
		$navi_p['current']			= $page;
		$navi_p['left']['page']		= ($page-1) < 0 ? false : $page-1;
		$navi_p['left']['active']	= ($page-1) < 0 ? false : true;
		$navi_p['right']['page']	= (($page+1)*$pps) >= $total ? false : $page+1 ;
		$navi_p['right']['active']	= (($page+1)*$pps) >= $total ? false : true;
		
		cachevars('sgal1_navigation', $navi_p);
	}
	
	$j = 0;
	
	for ($i=$start; $i<$end; $i++)
	{
		$j++;
		
		cachevars('sgal1_current_pic', array('img_id'=>($j), 'img_path'=>$cfiles[$i]));
		
		$ret_f[] = $tp->parseTemplate($tmpl['main']['item'], true, $sgal1_shortcodes);
		
		if (false === $navi_t)	continue;
		
		$ret_n[] = $tp->parseTemplate($tmpl['navi_pics'][(true == $shadowbox ? 'shbox_item' : 'item')],	true, $sgal1_shortcodes);
	}
	
	$ret =	(false == $navi_c ? '' :	# Categories navigation pane
			$tp->parseTemplate($tmpl['navi_cat']['start'], true, $sgal1_shortcodes).
			implode($tp->parseTemplate($tmpl['navi_cat']['separator'], true, $sgal1_shortcodes), $ret_c).
			$tp->parseTemplate($tmpl['navi_cat']['end'], true, $sgal1_shortcodes)).
			
			(true == $shadowbox ? '' :
			$tp->parseTemplate($tmpl['main']['start'], true, $sgal1_shortcodes).
			implode($tp->parseTemplate($tmpl['main']['separator'], true, $sgal1_shortcodes), $ret_f).
			$tp->parseTemplate($tmpl['main']['end'], true, $sgal1_shortcodes)).
			
			(false == $navi_t ? '' :	# Thumbs navigation pane
			$tp->parseTemplate($tmpl['navi_pics']['start'], true, $sgal1_shortcodes).
			implode($tp->parseTemplate($tmpl['navi_pics']['separator'], true, $sgal1_shortcodes), $ret_n).
			$tp->parseTemplate($tmpl['navi_pics']['end'], true, $sgal1_shortcodes));
}

if (isset($params['e_ajax']))  return $ret;

return	$tp->parseTemplate($tmpl['start'], true, $sgal1_shortcodes).
		$ret.
		$tp->parseTemplate($tmpl['end'], true, $sgal1_shortcodes);