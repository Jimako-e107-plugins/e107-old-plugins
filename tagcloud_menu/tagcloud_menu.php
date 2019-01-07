<?php
/*
+---------------------------------------------------------------+
| e107 Tag Cloud Menu v-1.1
| /tagcloud_menu.php
|
| Compatible with the e107 content management system
|  http://e107.org
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: /cvsroot/e107/e107_0.7/e107_plugins/tagcloud_menu/tagcloud_menu.php,v $
| $Date: 2008/05/05  $
| $Author: Jeez! jeez73@ya.ru  http://www.4goodluck.org $
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

global $menu_pref;
$indexArray = array('cloud_mins','cloud_maxs','cloud_pts','cloud_align');
foreach($indexArray as $ind)
{
	if(!isset($menu_pref[$ind]))
	{
		$menu_pref[$ind]='';
	}
}

$ec_dir = e_PLUGIN."tagcloud_menu/";
$lan_file = $ec_dir."languages/".e_LANGUAGE.".php";
e107_include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."tagcloud_menu/languages/English.php");
if (!defined("e_HTTP")) {
	exit;
}
$tag_txt ="";
$tag_list = split ("[,]", $menu_pref['cloud_words']);
$sarr = sizeof($tag_list);
$step = ($menu_pref['cloud_maxs'] - $menu_pref['cloud_mins'])/$sarr;
$size = $menu_pref['cloud_mins'];
for ( $tag=0; $tag<$sarr; $tag++)
{
$size=$size+$step;
$tag_txt .= "<strong><a href='search.php?q=".urlencode($tag_list[$tag])."&r=0' style=\"font-size:".round($size).$menu_pref['cloud_pts'].";\">".$tag_list[$tag]."</a></strong>&nbsp;
";
}
$ns->tablerender($menu_pref['cloud_caption'], "<div style='text-align:".$menu_pref['cloud_align']."'>".$tag_txt."</div>");




?>