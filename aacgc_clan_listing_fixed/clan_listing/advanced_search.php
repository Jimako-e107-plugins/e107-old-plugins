<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

if (!defined('e107_INIT')) { exit; }

$advanced['cat']['type'] = 'dropdown';
$advanced['cat']['text'] = LAN_SEARCH_63.':';
$advanced['cat']['list'][] = array('id' => 'all', 'title' => LAN_SEARCH_51);

$advanced_caption['id'] = 'cat';
$advanced_caption['title']['all'] = CONT_SCH_LAN_2;

if ($sql -> db_Select("pcontent", "content_id, content_heading", "LEFT(content_parent,1)='0'")) {
   while ($row = $sql -> db_Fetch()) {
      $advanced['cat']['list'][] = array('id' => $row['content_id'], 'title' => $row['content_heading']);
      $advanced_caption['title'][$row['content_id']] = $row['content_heading'];
   }
}

$advanced['date']['type'] = 'date';
$advanced['date']['text'] = LAN_SEARCH_68.':';

$advanced['match']['type'] = 'dropdown';
$advanced['match']['text'] = LAN_SEARCH_52.':';
$advanced['match']['list'][] = array('id' => 0, 'title' => LAN_SEARCH_53);
$advanced['match']['list'][] = array('id' => 1, 'title' => LAN_SEARCH_54);




?>