<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}


if ($pref['gamelist_enable_gold'] == "1")
{$gold_obj = new gold();}

if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//---------------------------------------------------------------------------------

$title .= "".$pref['gamelist_pagetitle'].""; 

//-----------------------------------------------------------------------------------
$totalgames = $sql -> db_Count("aacgc_gamelist");

if ($pref['gamelist_enable_clantotal'] =="1"){
$clans = $sql -> db_Count("clan_listing");}

if ($pref['gamelist_enable_servertotal'] =="1"){
$servers = $sql -> db_Count("aacgc_serverlist");}

if ($pref['gamelist_enable_producttotal'] =="1"){
$products = $sql -> db_Count("aacgc_gamelist_products");}


$text .= "    
        <table style='width:75%' class=''>
        <tr>
        <td><center><font size='".$pref['gamelist_detailstitlefs']."'><b><u>".$pref['gamelist_detailstitle']."</u></b></font>
        <br>Total Games Listed: ".$totalgames."";

if ($pref['gamelist_enable_clantotal'] =="1"){$text .= "<br>Total Clans Listed: ".$clans."";}
if ($pref['gamelist_enable_servertotal'] =="1"){$text .= "<br>Total Servers Listed: ".$servers."";}
if ($pref['gamelist_enable_producttotal'] =="1"){$text .= "<br>Total Purchasable Games: ".$products."";}

$text .= "<br><br><font size='".$pref['gamelist_detailsfs']."'>".$pref['gamelist_details']."</font></td>
          </tr>";

$text .= "</table><br><br>";



//---------------------------------------# Theme 1 #-------------------------------------------------------------

$text .= "
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

$text .= "
<tr>
<td style='width:100%' class='".$themea."'><center><a href='".e_PLUGIN."aacgc_gamelist/Game_List.php?det.".$row['cat_id']."'><font size='".$pref['gamelist_catftsize']."'><b>".$tp->toHTML($row['cat_name'], TRUE)."</b></font></a> (".$gameslisted['games'].")";

if($pref['gamelist_show_popup'] == "1"){
$text .= "<br>
<center>
<script type='text/javascript' src='thumbnailviewer.js' defer='defer'></script>
<div id='loadarea".$catname."' style='width:256px, height:256px' class=''></div>
</center>
";}

$text .= "
</td>
</tr>";


if($pref['gamelist_show_mini'] == "1"){
$text .= "
<tr><td class='".$themeb."' valign = top>";

       $sql7 = new db;
       $sql7 ->db_Select("aacgc_gamelist", "*", "game_cat='".intval($row['cat_id'])."' ORDER BY game_name ASC");
       while($row7 = $sql7 ->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_catmenuiconpath'] == "")
{$caticonpath = "icons";}
else
{$caticonpath = "".$pref['gamelist_catmenuiconpath']."";}
//---------------------------------------+

if($pref['gamelist_show_popup'] == "1"){
$text .= "
<a href='".e_PLUGIN."/aacgc_gamelist/icons/".$row7['game_pic']."' rel='enlargeimage::click' rev='loadarea".$catname."::Game_Details.php?det.".$row7['game_id']."' title=''><img width='".$pref['gamelist_cat_minisize']."px' src='".e_PLUGIN."/aacgc_gamelist/".$caticonpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img></a>";}

else

{$text .= "
<a href='Game_Details.php?det.".$row7['game_id']."'><img width='".$pref['gamelist_cat_minisize']."px' src='".e_PLUGIN."/aacgc_gamelist/".$caticonpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img></a>";}}

$text .= "<td></tr>";}}





$text .= "</table><br><br>";












//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_gamelist/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text);











//----------------------------------------------------------------------------------

require_once(FOOTERF);



?>
