<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/advanced_search.php
|
| Revision: 0.9.6.2
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

//$advanced['cat']['type'] = 'dropdown';
//$advanced['cat']['text'] = LAN_SEARCH_63.':';
//$advanced['cat']['list'][] = array('id' => 'all', 'title' => LAN_SEARCH_51);

//$advanced_caption['id'] = 'cat';
//$advanced_caption['title']['all'] = CONT_SCH_LAN_2;

if ($sql -> db_Select("tbl_image", "im_id, im_album_id, im_title, im_description,
   im_image, im_thumbnail")) {
   while ($row = $sql -> db_Fetch()) {
      //$advanced['cat']['list'][] = array('id' => $row['im_id'], 'title' => $row['im_title']);
      //$advanced_caption['title'][$row['im_id']] = $row['im_title'];
   }
}

//$advanced['date']['type'] = 'date';
//$advanced['date']['text'] = LAN_SEARCH_68.':';

//$advanced['match']['type'] = 'dropdown';
//$advanced['match']['text'] = LAN_SEARCH_52.':';
//$advanced['match']['list'][] = array('id' => 0, 'title' => LAN_SEARCH_53);
//$advanced['match']['list'][] = array('id' => 1, 'title' => LAN_SEARCH_54);

?>