<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

//-------------------------------------------------------------------------+

$advanced_where = "";


$return_fields = "clan_id, clan_name, clan_tag, clan_website, clan_banner, clan_cat";
$search_fields = array("clan_name, clan_website, clan_tag");
$weights = array("0.5", "0.5", "0.5", "0.5", "0.5");
$no_results = LAN_198;
$where = "1 and ".$advanced_where;
$order = array('clan_name' => ASC);

$table = "clan_listing";

//-------------------------------------------------------------------------+


$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_clans', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];


function search_clans($row) {
   global $pref;
   global $con;
   global $tp;
   $sqlCon = new db;

   $res['link'] = e_PLUGIN."clan_listing/Clan_Details.php?det.".$row['clan_id'];
   $res['pre_title'] = $row['clan_tag']." ";
   $res['title'] = " ".$tp->toHTML($row['clan_name']);

   $qry = "SELECT c.* FROM #clan_listing_cat as c WHERE c.clan_cat_id = '".$row['clan_cat']."' ";
   $sqlCon -> db_Select_gen($qry);
   $cat = $sqlCon -> db_Fetch();

   $res['pre_summary'] = "<a href='".e_PLUGIN."clan_listing/Clans.php?det.".$cat['clan_cat_id']."'><img width='50px' src='".e_PLUGIN."clan_listing/icons/".$cat['clan_cat_icon']."' /></a>";
   $res['summary'] = $tp->toHTML($row['clan_banner']);
 

   return $res;

}


//-------------------------------------------------------------------------+

?>