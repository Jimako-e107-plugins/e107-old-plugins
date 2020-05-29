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
|     $Source: e:\_repository\e107_plugins/yellowpages/search/yellowpages_advanced_search.php,v $
|     $Revision: 1.1.2.1 $
|     $Date: 2007/02/07 00:22:14 $
|     $Author: Neil $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$advanced_caption['id'] = 'yellowpages';
$advanced_caption['title']['all'] = YELP_LAN_YELPOWPAGES;

//$advanced['yellowpages']['type'] = 'dropdown';
//$advanced['yellowpages']['text'] = YELP_LAN_SEARCH_CATEGORY.':';
//$advanced['yellowpages']['list'][] = array('id' => 'all', 'title' => YELP_LAN_SEARCH_ALL);
//
//$ypdao = $yelp->getDAO();
//$ypCatlist = $ypdao->getCategoriesList("all"); // ?????????????????????????????????????????????????????????????????????????????????????????????????
//foreach ($ypCatlist as $cat) {
//   $advanced['yellowpages']['list'][] = array('id' => $cat->getId(), 'title' => $cat->getName());
//	$advanced_caption['title'][$cat->getId()] = YELP_LAN_YELPOWPAGES.$pref["yellowpages_separator"].$cat->getName();
//}

$advanced['match']['type'] = 'dropdown';
$advanced['match']['text'] = YELP_SEARCH_MATCH_IN.':';
$advanced['match']['list'][] = array('id' => 0, 'title' => YELP_SEARCH_MATCH_IN_ALL);
$advanced['match']['list'][] = array('id' => 1, 'title' => YELP_SEARCH_MATCH_IN_NAME);
$advanced['match']['list'][] = array('id' => 2, 'title' => YELP_SEARCH_MATCH_IN_DESCRIPTION);

?>