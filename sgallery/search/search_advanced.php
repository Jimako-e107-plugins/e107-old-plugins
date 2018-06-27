<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/content/search/search_advanced.php,v $
|     $Revision: 739 $
|     $Date: 2008-04-22 14:03:31 +0300 (Tue, 22 Apr 2008) $
|     $Author: secretr $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
global $tp;

$advanced['cat']['type'] = 'dropdown';
$advanced['cat']['text'] = LAN_SEARCH_63.':';
$advanced['cat']['list'][] = array('id' => 'all', 'title' => LAN_SEARCH_51);

$advanced_caption['id'] = 'cat';
$advanced_caption['title']['all'] = SGAL_LANSRCH_2;

if ($sql -> db_Select("sgallery_cats", "title, cat_id", "active>0 ORDER BY cat_order ASC")) {
	while ($row = $sql -> db_Fetch()) {
		$advanced['cat']['list'][] = array('id' => $row['cat_id'], 'title' => $tp->toHTML($row['title'], FALSE, 'LINKTEXT'));
		$advanced_caption['title'][$row['content_id']] = $row['title'];
	}
}

$advanced['date']['type'] = 'date';
$advanced['date']['text'] = LAN_SEARCH_68.':';

$advanced['match']['type'] = 'dropdown';
$advanced['match']['text'] = LAN_SEARCH_52.':';
$advanced['match']['list'][] = array('id' => 0, 'title' => LAN_SEARCH_53);
$advanced['match']['list'][] = array('id' => 1, 'title' => LAN_SEARCH_54);

?>