<?php

/*
####################################
#  AACGC Game List                 #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/



global $sc_style;


//-------------------------Menu Title--------------------------------+

$gamelistmenu_title .= "".$pref['gamelist_menutitle']."";

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

$gamelistmenu_text .= "<table style='width:200px' class=''>

                       <tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'>Total Games Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$gameslisted."</center></td>
                       </tr>";

if ($pref['gamelist_enable_clantotalmenu'] =="1"){
$gamelistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'>Total Clans Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$clans."</td>
                       </tr>";}

if ($pref['gamelist_enable_servertotalmenu'] =="1"){
$gamelistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."aacgc_serverlist/Server_Categories.php'>Total Servers Listed:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$servers."</td>
                       </tr>";}

if ($pref['gamelist_enable_producttotalmenu'] =="1"){
$gamelistmenu_text .= "<tr>
                       <td class='forumheader3'><a href='".e_PLUGIN."product_listing/Product_Categories.php'>Total Purchasable Games:</a></td>
                       <td style='text-align:right' class='forumheader3'>".$products."</td>
                       </tr>";}


$gamelistmenu_text .= "</table><br>";

/*
$gamelistmenu_text .= "<center><table style='width:200px' class='".$themeb."'>";

        $sql9 = new db;
        $sql9 ->db_Select("aacgc_gamelist_marks", "*", "ORDER BY mark_id ASC","");
        while($row9 = $sql9 ->db_Fetch()){

$gamelistmenu_text .= "<tr><td class='".$themeb."'><img src='".e_PLUGIN."aacgc_gamelist/marks/".$row9['mark_img']."'></img> = <font size='1'>".$row9['mark_name']."</td></tr>";}


$gamelistmenu_text .= "</table><br>";
*/
//-------------------------#Game List Start#-------------------+
if ($pref['gamelistmenu_enable_scroll'] == "1"){
$gamelistmenu_text .= "
<script type=\"text/javascript\">
function gamelistmenuup(){gamelistmenu.direction = \"up\";}
function gamelistmenudown(){gamelistmenu.direction = \"down\";}
function gamelistmenustop(){gamelistmenu.stop();}
function gamelistmenustart(){gamelistmenu.start();}
</script>";

$gamelistmenu_text .= "
<marquee height='".$pref['gamelist_menuheight']."px' id='gamelistmenu' scrollamount='".$pref['gamelistmenu_speed']."' onMouseover='this.scrollAmount=".$pref['gamelistmenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['gamelistmenu_mouseoutspeed']."' direction='".$pref['gamelist_menu_direction']."' loop='true'>";}
else
{$gamelistmenu_text .= "<div style='border : 0; padding : 4px; width : auto; height : ".$pref['gamelist_menuheight']."px; overflow : auto; '>";}


$gamelistmenu_text .= "
<table style='width:95%' class=''>";



if ($pref['gamelist_menu_order'] == "ASC"){
$ordergames = "game_name ".$pref['gamelist_menu_order']."";}
if ($pref['gamelist_menu_order'] == "DESC"){
$ordergames = "game_name ".$pref['gamelist_menu_order']."";}
if ($pref['gamelist_menu_order'] == "Random"){
$ordergames = "rand()";}
if ($pref['gamelist_menu_limit'] == "0"){
$limit = "";}
else
{$limit = "LIMIT 0,".$pref['gamelist_menu_limit']."";}


        $sql2 = new db;
        $sql2 ->db_Select("aacgc_gamelist", "*", "ORDER BY ".$ordergames." ".$limit."","");
        while($row2 = $sql2 ->db_Fetch()){


if ($row2['game_cat'] == "".$pref['gamelist_menu_catexclude']."")
{}
else
{



$gamelistmenu_text .= "
<table style='width:95%' class='".$themeb."'><tr>
<td style='width:100%' class='".$themea."'><center><a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."'>".$row2['game_name']."</a></center></td>
</tr>";


//-----------# Icon Path #---------------+
if($pref['gamelist_listmenuiconpath'] == "")
{$listiconpath = "icons";}
else
{$listiconpath = "".$pref['gamelist_listmenuiconpath']."";}
//---------------------------------------+


$gamelistmenu_text .= "</tr>
<td style='width:100%' class=''><center><a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."'><img width='".$pref['gamelistmenu_img']."' src='".e_PLUGIN."aacgc_gamelist/".$listiconpath."/".$row2['game_pic']."' alt = '".$row2['game_name']."'></img></a></center>";


//-----------------------# Game Mark #--------------------------


        $sql8 = new db;
        $sql8 ->db_Select("aacgc_gamelist_markedgames", "*", "game='".intval($row2['game_id'])."'");
        while($row8 = $sql8 ->db_Fetch()){
        $sql10 = new db;
        $sql10 ->db_Select("aacgc_gamelist_marks", "*", "mark_id='".intval($row8['mark'])."'");
        $row10 = $sql10 ->db_Fetch();

if($row8['mark'] == ""){}
else
{$gamelistmenu_text .= "<img src='".e_PLUGIN."aacgc_gamelist/marks/".$row10['mark_img']."' alt='".$row10['mark_name']."'></img>";}}


//-----------------------# CMMS #-------------------------- 
if ($pref['gamelist_enable_cmmscount'] =="1"){

$sql11 = new db;
$sql11 ->db_Select("aacgc_gamelist_cmms", "*", "game='".intval($row2['game_id'])."'");
while($row11 = $sql11 ->db_Fetch()){
$sql12 = new db;
$sql12->mySQLresult = @mysql_query("select clan_game, count(clan_id) as cmmscls from ".MPREFIX."aacgc_cmms_clans where clan_game='".intval($row11['cmmscat'])."';");
$cmmsc = $sql12->db_fetch();  if($cmmsc['cmmscls'] == "0"){} 
else 
{$gamelistmenu_text .= "<br>Clans Listed: ".$cmmsc['cmmscls']."";}}
} //---------------------------------------------------------------


//-----------------------# Clan Listing #--------------------------
if ($pref['gamelist_enable_clangtotalmenu'] =="1"){
        $sql11 = new db;
        $sql11 ->db_Select("aacgc_gamelist_clanlist", "*", "game='".intval($row2['game_id'])."'");
        while($row11 = $sql11 ->db_Fetch()){
        $sql12 = new db;
        $sql12->mySQLresult = @mysql_query("select clan_cat, count(clan_id) as cls from ".MPREFIX."clan_listing where clan_cat='".intval($row11['clancat'])."';");
        $clanic = $sql12->db_fetch();

if($clanic['cls'] == "0"){}
else
{$gamelistmenu_text .= "<br>Clans Listed: ".$clanic['cls']."";}}}
//----------------------------------------------------------------


//-----------------------# Game Server List #--------------------------
if ($pref['gamelist_enable_servergtotalmenu'] =="1"){
        $sql13 = new db;
        $sql13 ->db_Select("aacgc_gamelist_gameservers", "*", "game='".intval($row2['game_id'])."'");
        while($row13 = $sql13 ->db_Fetch()){
        $sql14 = new db;
        $sql14->mySQLresult = @mysql_query("select server_cat, count(server_id) as servs from ".MPREFIX."aacgc_serverlist where server_cat='".intval($row13['servercat'])."';");
        $serveric = $sql14->db_fetch();

if($serveric['servs'] == "0"){}
else
{$gamelistmenu_text .= "<br>Servers Listed: ".$serveric['servs']."";}}}
//----------------------------------------------------------------

//-----------------------# Game Players #-------------------------

$sql6 = new db;
$sql6->mySQLresult = @mysql_query("select user_id, count(user_id) as plyrs from ".MPREFIX."aacgc_gamelist_members where chosen_game_id='".intval($row2['game_id'])."';");
$players = $sql6->db_fetch();

if($players['plyrs'] == "0"){}
else
{$gamelistmenu_text .= "<br>Gamers Listed: ".$players['plyrs']."";}

//----------------------------------------------------------------



//-----------------------# Game Rating #--------------------------
if ($pref['gamelist_enable_rating'] == "1"){
include_once(e_HANDLER."rate_class.php");
$rater = new rater;
$gamelistmenu_text .= "<span>";
if($rating = $rater->getrating('aacgc_gamelist', $row2['game_id'])){
$gamelistmenu_text .= "<br>Rating: ";
$gamelistmenu_text .= $rating[2] ? "{$rating[1]}.{$rating[2]} ({$rating[0]})" : "{$rating[1]} ({$rating[0]})";
$gamelistmenu_text .= "<br>";
$num = $rating[1];
for($i=1; $i<= $num; $i++){
$gamelistmenu_text .= "<img src='".e_IMAGE_ABS."user_icons/user_star_".IMODE.".png' style='border:0' alt='' />";}}
$gamelistmenu_text .= "</span>";}
//----------------------------------------------------------------


$gamelistmenu_text .= "</td></tr></table></br>";}}






if ($pref['gamelistmenu_enable_scroll'] == "1"){
$gamelistmenu_text .= "</marquee>
<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"gamelistmenustart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"gamelistmenustop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"gamelistmenuup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"gamelistmenudown();\" type=\"button\">
</center>
</td></tr></table>
<br>";}
else
{$gamelistmenu_text .= "</div>";}

//--------------------------------------------------------------------+








$ns -> tablerender($gamelistmenu_title, $gamelistmenu_text);


?>