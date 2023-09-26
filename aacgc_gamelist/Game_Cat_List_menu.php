<?php

/*
####################################
#  AACGC Game List                 #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/



global $sc_style;


//-------------------------Menu Title--------------------------------+

$gamecatlistmenu_title .= "".$pref['gamecatlist_menutitle']."";

//-------------------------------------------------------------------+
if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}


$gameslisted = $sql -> db_Count("aacgc_gamelist");
if ($pref['gamelist_enable_clantotalmenu'] =="1"){
$clans = $sql -> db_Count("clan_listing");}
if ($pref['gamelist_enable_servertotalmenu'] =="1"){
$servers = $sql -> db_Count("aacgc_serverlist");}
if ($pref['gamelist_enable_producttotalmenu'] =="1"){
$products = $sql -> db_Count("aacgc_gamelist_products");}

if ($pref['gamelist_enable_catmenutotals'] =="1"){

$gamecatlistmenu_text .= "<table style='width:200px' class=''>

                       <tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'>Total Games Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$gameslisted."</center></td>
                       </tr>";

if ($pref['gamelist_enable_clantotalcatmenu'] =="1"){
$gamecatlistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'>Total Clans Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$clans."</td>
                       </tr>";}

if ($pref['gamelist_enable_servertotalcatmenu'] =="1"){
$gamecatlistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."aacgc_serverlist/Server_Categories.php'>Total Servers Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$servers."</td>
                       </tr>";}

if ($pref['gamelist_enable_producttotalcatmenu'] =="1"){
$gamecatlistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."product_listing/Product_Categories.php'>Total Purchasable Games:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$products."</td>
                       </tr>";}


$gamecatlistmenu_text .= "</table><br>";}




$gamecatlistmenu_text .= "
<table style='width:100%' class='' cellspacing='0' cellpadding='0'>";


if ($pref['gamecatlist_menu_ordertype'] == "Name"){
if ($pref['gamecatlist_menu_order'] == "ASC"){
$ordercats = "cat_name ".$pref['gamecatlist_menu_order']."";}
if ($pref['gamecatlist_menu_order'] == "DESC"){
$ordercats = "cat_name ".$pref['gamecatlist_menu_order']."";}
if ($pref['gamecatlist_menu_order'] == "Random"){
$ordercats = "rand()";}}

if ($pref['gamecatlist_menu_ordertype'] == "ID"){
if ($pref['gamecatlist_menu_order'] == "ASC"){
$ordercats = "cat_id ".$pref['gamecatlist_menu_order']."";}
if ($pref['gamecatlist_menu_order'] == "DESC"){
$ordercats = "cat_id ".$pref['gamecatlist_menu_order']."";}
if ($pref['gamecatlist_menu_order'] == "Random"){
$ordercats = "rand()";}}

$sql ->db_Select("aacgc_gamelist_cat", "*", "ORDER BY ".$ordercats."","");
while($row = $sql ->db_Fetch()){
$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select game_cat, count(game_id) as games from ".MPREFIX."aacgc_gamelist WHERE game_cat='".intval($row['cat_id'])."';");
$gameslisted = $sql2->db_fetch();

$catname = "".$row['cat_name']."";



$gamecatlistmenu_text .= "
<tr>
<td style='width:100%' class='".$themea."'><center><a href='".e_PLUGIN."aacgc_gamelist/Game_List.php?det.".$row['cat_id']."'><font size='".$pref['gamecatlistmenu_catftsize']."'><b>".$row['cat_name']."</b></font></a> (".$gameslisted['games'].")";


if($pref['gamecatlistmenu_show_mini'] == "1"){
$gamecatlistmenu_text .= "
<tr><td class='".$themeb."' valign = top>";

       $sql7 = new db;
       $sql7 ->db_Select("aacgc_gamelist", "*", "WHERE game_cat=".$row['cat_id']." ORDER BY game_name ASC","");
       while($row7 = $sql7 ->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_catmenuiconpath'] == "")
{$caticonpath = "icons";}
else
{$caticonpath = "".$pref['gamelist_catmenuiconpath']."";}
//---------------------------------------+

$gamecatlistmenu_text .= "
<a href='Game_Details.php?det.".$row7['game_id']."'><img width='".$pref['gamecatlistmenu_cat_minisize']."px' src='".e_PLUGIN."/aacgc_gamelist/".$caticonpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img></a>";}

$gamecatlistmenu_text .= "<td></tr>";}}





$gamecatlistmenu_text .= "</table>";


//--------------------------------------------------------------------+








$ns -> tablerender($gamecatlistmenu_title, $gamecatlistmenu_text);


?>