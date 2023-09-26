<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

//-------------------------------------------------------------------------+

$table = "aacgc_gamelist";
$return_fields = "game_id, game_name, game_pic, game_text";
$search_fields = array("game_name");
$weights = array("0.5", "0.5", "0.5", "0.5", "0.5");

$no_results = LAN_198;
$advanced_where = "";
$where = "1 and".$advanced_where;
$order = array('game_name' => ASC);


//-------------------------------------------------------------------------+


$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_games', $no_results, $where, $order);


$text .= $ps['text'];
$results = $ps['results'];


function search_games($row) {
   global $pref;
   global $con;

   $res['link'] = e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row["game_id"];
   $res['pre_title'] = "";
   $res['title'] = $row["game_name"];
   $res['pre_summary'] = "<img width='100px' src='".e_PLUGIN."aacgc_gamelist/icons/".$row['game_pic']."'></img>";
   $res['summary'] = $row["game_text"];
 
   return $res;

}


//-------------------------------------------------------------------------+

?>