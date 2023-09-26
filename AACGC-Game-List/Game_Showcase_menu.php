<?php

/*
####################################
#  AACGC Game List                 #
#  M@CH!N3 admin@aacgc.com         # 
####################################
*/


//-------------------------------------------------------------------+

$gameshowcase_title .= "".$pref['gamelist_showcasetitle']."";

//-------------------------------------------------------------------+

if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------------------------------------------------+

$gameslisted = $sql -> db_Count("aacgc_gamelist");
if ($pref['gamelist_enable_clantotalmenu'] =="1"){
$clans = $sql -> db_Count("clan_listing");}
if ($pref['gamelist_enable_servertotalmenu'] =="1"){
$servers = $sql -> db_Count("aacgc_serverlist");}
if ($pref['gamelist_enable_producttotalmenu'] =="1"){
$products = $sql -> db_Count("aacgc_gamelist_products");}
if ($pref['gamelist_enable_cmmscount'] =="1"){
$cmmsclans = $sql -> db_Count("aacgc_cmms_clans");}


//--------------#Custom Logo#------------------------------
if ($pref['gamelist_enable_showcaselogo'] == "1"){

$logoheight = "width='".$pref['gamelist_showcaselogoheight']."'";
$logowidth = "height='".$pref['gamelist_showcaselogowidth']."'";

if($pref['gamelist_showcaselogotype'] == "Image")
{$logo = "<img $width, $height src='".$pref['gamelist_showcaselogo']."'></img>";}
if($pref['gamelist_showcaselogotype'] == "Flash")
{$logo = "<embed $width, $height src='".$pref['gamelist_showcaselogo']."'></embed>";}

$gameshowcase_text .= "<table style='width:100%' class=''><tr>";
$gameshowcase_text .= "<td><center>".$logo."</center></td>";
$gameshowcase_text .= "</tr></table>";
}
//---------------------------------------------------------

//-------------------------#Game Pop-Up#-----------------------------+
if ($pref['gamelist_enable_showcasepopup'] == "1"){
$gameshowcase_text .= "<table style='width:100%' class=''><tr><td>";
$gameshowcase_text .= "<center>
                       <script type='text/javascript' src='".e_PLUGIN."aacgc_gamelist/thumbnailviewer.js' defer='defer'></script>
                       <div id='loadareashowcase' style='width:100%' class=''>(<i>Click Each Icon To Enlarge</i>)</div>
                       </center><br>";
$gameshowcase_text .= "</td></tr></table>";
}
//-------------------------#Game List Start#-------------------------+


$gameshowcase_text .= "<table style='width:100%' class=''>";


//----------# Top Caution Stripe #-----------------
if ($pref['gamelist_enable_showcasecaution'] == "1"){
$gameshowcase_text .= "<tr>
                       <td style='width:50px' class=''></td>
                       <td class=''><center><img width='100%' src='".e_PLUGIN."aacgc_gamelist/images/caution_top.png'></img></center></td>
                       <td style='width:50px' class=''></td>
                       </tr>";}
//-------------------------------------------------


$gameshowcase_text .= "<tr>";


if ($pref['gamelist_enable_showcasescroll'] == "1"){

//-----------------------------------------------------#Arrow Sets#----------+
if ($pref['gamelist_showcasemenu_arrow'] == "Set 1"){
$leftarrow = "leftarrow.png";
$rightarrow = "rightarrow.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 2"){
$leftarrow = "leftarrow2.png";
$rightarrow = "rightarrow2.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 3"){
$leftarrow = "leftarrow3.png";
$rightarrow = "rightarrow3.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 4"){
$leftarrow = "leftarrow4.png";
$rightarrow = "rightarrow4.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 5"){
$leftarrow = "leftarrow5.png";
$rightarrow = "rightarrow5.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 6"){
$leftarrow = "leftarrow6.png";
$rightarrow = "rightarrow6.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 7"){
$leftarrow = "leftarrow7.png";
$rightarrow = "rightarrow7.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 8"){
$leftarrow = "leftarrow8.png";
$rightarrow = "rightarrow8.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 9"){
$leftarrow = "leftarrow9.png";
$rightarrow = "rightarrow9.png";}
if ($pref['gamelist_showcasemenu_arrow'] == "Set 10"){
$leftarrow = "leftarrow10.png";
$rightarrow = "rightarrow10.png";}
//---------------------------------------------------------------+
$fast = $pref['gamelist_showcasemenu_mouseoverspeed'];
$norm = $pref['gamelist_showcasemenu_speed'];
$slow = "1";

$gameshowcase_text .= "
<script type=\"text/javascript\">
function gameshowcaseleft(){gameshowcase.direction = \"left\";}
function gameshowcaseright(){gameshowcase.direction = \"right\";}
function gameshowcasespeedup(){gameshowcase.scrollAmount = \"$fast\";}
function gameshowcasespeed(){gameshowcase.scrollAmount = \"$norm\";}
function gameshowcaseslowdown(){gameshowcase.scrollAmount = \"$slow\";}
</script>";
}


//-----# Left Arrow #----
if ($pref['gamelist_enable_showcasescroll'] == "1"){
$gameshowcase_text .= "<td style='width:0%' class='' rowspan=2><input onClick=\"gameshowcaseleft();\" type=\"image\" src=\"".e_PLUGIN."aacgc_gamelist/images/".$leftarrow."\"></td>";}
else
{$gameshowcase_text .= "<td rowspan=2></td>";}
//-----------------------


if ($pref['gamelist_showcasemaxgames'] == "0")
{$gameshowcase_text .= "<td></td>";}
else
{$gameshowcase_text .= "<td class='".$themea."'><center>".$pref['gamelist_showcasemaxgames']." Random Games:</center></td>";}

//-----# Right Arrow #----
if ($pref['gamelist_enable_showcasescroll'] == "1"){
$gameshowcase_text .= "<td style='width:0%' class='' rowspan=2><input onClick=\"gameshowcaseright();\" type=\"image\" src=\"".e_PLUGIN."aacgc_gamelist/images/".$rightarrow."\">
</td>";}
else
{$gameshowcase_text .= "<td rowspan=2></td>";}
//-------------------------

$gameshowcase_text .= "</tr><tr>";
$gameshowcase_text .= "<td style='width:100%' class='".$themeb."'>";


//--------# Auto Scroll or Not #----------

if ($pref['gamelist_enable_showcasescroll'] == "1"){
$gameshowcase_text .= "<marquee id='gameshowcase' behavior='alternate' scrollamount='".$norm."' direction='".$pref['gamelist_showcasemenu_direction']."' loop='true'>
<table><tr>";}
else
{$gameshowcase_text .= "<div style='border : 0; padding : 4px; width:600px; height:auto; overflow : auto; '>
		        <table style='width:100%' class=''><tr>";}
//----------------------------------------

if ($pref['gamelist_showcasemenu_order'] == "ASC"){
$ordergames = "game_name ".$pref['gamelist_menu_order']."";}
if ($pref['gamelist_showcasemenu_order'] == "DESC"){
$ordergames = "game_name ".$pref['gamelist_menu_order']."";}
if ($pref['gamelist_showcasemenu_order'] == "Random"){
$ordergames = "rand()";}

if($pref['gamelist_showcasemaxgames'] == "0")
{$max = "";}
else
{$max = " LIMIT 0,".$pref['gamelist_showcasemaxgames']."";}

        $sql2 = new db;
        $sql2 ->db_Select("aacgc_gamelist", "*", "ORDER BY ".$ordergames."".$max."","");
        while($row2 = $sql2 ->db_Fetch()){

if ($row2['game_cat'] == "".$pref['gamelist_showcase_catexclude'].""){}
else
{

//-----------# Icon Path #---------------+
if($pref['gameshowcase_scrollericonpath'] == "")
{$showcasescrollericonpath = "icons";}
else
{$showcasescrollericonpath = "".$pref['gameshowcase_scrollericonpath']."";}
//---------------------------------------+

if ($pref['gamelist_enable_showcasepopup'] == "1"){
$gameshowcase_text .= "<td>
<a href='".e_PLUGIN."/aacgc_gamelist/icons/".$row2['game_pic']."' rel='enlargeimage::click' rev='loadareashowcase::".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."' title='Click Icon To View Game Details'><img width='".$pref['gamelist_showcaseicon']."px' src='".e_PLUGIN."/aacgc_gamelist/".$showcasescrollericonpath."/".$row2['game_pic']."' alt = '".$row2['game_name']."'></img></a></td>";}
else
{$gameshowcase_text .= "<td>
<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."'>
<img width='".$pref['gamelist_showcaseicon']."px' src='".e_PLUGIN."/aacgc_gamelist/".$showcasescrollericonpath."/".$row2['game_pic']."' alt = '".$row2['game_name']."'></img>
</a></td>";}}}


//--------# Auto Scroll or Not #----------
if ($pref['gamelist_enable_showcasescroll'] == "1"){
$gameshowcase_text .= "</tr></table></marquee>";}
else
{$gameshowcase_text .= "</tr></table></div>";}
//----------------------------------------


$gameshowcase_text .= "</td></tr>";

//--------# Auto Scroll Controls #---------------
if ($pref['gamelist_enable_showcasecontrols'] == "1"){
$gameshowcase_text .= "<tr>
<td colspan='3'>
<div class=''><center>
<input onClick=\"gameshowcasespeedup();\" type=\"button\" value=\"Fast\"> 
<input onClick=\"gameshowcasespeed();\" type=\"button\" value=\"Normal\">
<input onClick=\"gameshowcaseslowdown();\" type=\"button\" value=\"Slow\">
</center></div>
</td></tr>";}
//-----------------------------------------------

//----------# Bottom Caution Stripe #-----------------
if ($pref['gamelist_enable_showcasecaution'] == "1"){
$gameshowcase_text .= "<tr>
                       <td style='width:0%' class=''></td>
                       <td class=''><center><img width='100%' src='".e_PLUGIN."aacgc_gamelist/images/caution_bottom.png'></img></center></td>
                       <td style='width:0%' class=''></td>
                       </tr>";}
//----------------------------------------------------

$gameshowcase_text .= "</table>";

//-------------------------------------------------------------------+

$gameshowcase_text .= "<table style='' class='' cellspacing='5' cellpadding='5'><tr>";

if ($pref['gamelist_enable_showcasegametotal'] =="1"){
$gameshowcase_text .= "<td class='".$themea."'><a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'>Games Listed</a>: ".$gameslisted."</center></td>";}

if ($pref['gamelist_enable_showcaseclantotal'] =="1"){
$gameshowcase_text .= "<td class='".$themea."'><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'>Clans Listed</a>: ".$clans."</td>";}

if ($pref['gamelist_enable_cmmscount'] =="1"){
$gameshowcase_text .= "<td class='".$themea."'><a href='".e_PLUGIN."aacgc_cmms/CMMS_Main.php'>Clans Listed</a>: ".$cmmsclans."</td>";}

if ($pref['gamelist_enable_showcaseservertotal'] =="1"){
$gameshowcase_text .= "<td class='".$themea."'><a href='".e_PLUGIN."aacgc_serverlist/Server_Categories.php'>Servers Listed</a>: ".$servers."</td>";}

if ($pref['gamelist_enable_showcaseproducttotal'] =="1"){
$gameshowcase_text .= "<td class='".$themea."'><a href='".e_PLUGIN."product_listing/Product_Categories.php'>Purchasable Games</a>: ".$products."</td>";}

$gameshowcase_text .= "</table>";

//--------------------------------------------------------------------+

if ($pref['gamelist_enable_showcasenewest'] =="1"){
$gameshowcase_text .= "<table style='width:100%' class='".$themeb."' cellspacing='' cellpadding=''>
                       <tr>
                       <td class='".$themea."'><center>".$pref['gamelist_showcase_newest']." Most Recently Added Games:</center></td>
                       </tr><tr><td><center>";

        $sql456 = new db;
        $sql456 ->db_Select("aacgc_gamelist", "*", "ORDER BY game_id DESC LIMIT 0,".$pref['gamelist_showcase_newest']."","");
        while($row456 = $sql456 ->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gameshowcase_newlisticonpath'] == "")
{$newlisticonpath = "icons";}
else
{$newlisticonpath = "".$pref['gameshowcase_newlisticonpath']."";}
//---------------------------------------+

$gameshowcase_text .= "<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row456['game_id']."'>
<img width='".$pref['gamelist_showcasenewesticon']."px' src='".e_PLUGIN."/aacgc_gamelist/".$newlisticonpath."/".$row456['game_pic']."' alt = '".$row456['game_name']."'></img>
";}


$gameshowcase_text .= "</center></td></tr></table>";}
//--------------------------------------------------------------------+

if ($pref['gamelist_enable_showcasecatlist'] =="1"){

$gameshowcase_text .= "<br>
<table style='width:100%' class='".$themeb."' cellspacing='0' cellpadding='0'>
<tr>
<td class='".$themea."' colspan=".$pref['gamelist_showcasecatcol']."><center><b><u>Game Categories</u></b></center></td>
</tr><tr>";


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

$rows2 = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows2; $i++) {

while($row = $sql ->db_Fetch()){
$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select game_cat, count(game_id) as games from ".MPREFIX."aacgc_gamelist WHERE game_cat='".intval($row['cat_id'])."';");
$gameslisted = $sql2->db_fetch();

$catname = "".$row['cat_name']."";


$gameshowcase_text .= "<td style='width:50%' valign=top><center>
<table style='width:100%' class=''>
<tr><td class='".$themea."'><center>
<a href='".e_PLUGIN."aacgc_gamelist/Game_List.php?det.".$row['cat_id']."'><font size='".$pref['gamecatlistmenu_catftsize']."'>".$row['cat_name']."</font></a> (".$gameslisted['games'].")</td></tr>";


if($pref['gamecatlistmenu_show_mini'] == "1"){
$gameshowcase_text .= "
<tr><td class='".$themeb."' valign = top>";

       $sql7 = new db;
       $sql7 ->db_Select("aacgc_gamelist", "*", "game_cat='".intval($row['cat_id'])."' ORDER BY game_name ASC","");
       while($row7 = $sql7 ->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_catmenuiconpath'] == "")
{$caticonpath = "icons";}
else
{$caticonpath = "".$pref['gamelist_catmenuiconpath']."";}
//---------------------------------------+

$gameshowcase_text .= "
<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row7['game_id']."'><img width='".$pref['gamecatlistmenu_cat_minisize']."px' src='".e_PLUGIN."/aacgc_gamelist/".$caticonpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img></a>";}

$gameshowcase_text .= "<td></tr>";}

$gameshowcase_text .= "</table></td>";


if ($pcol == $pref['gamelist_showcasecatcol']) 
{$gameshowcase_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}}





$gameshowcase_text .= "</table>";}


//--------------------------------------------------------------------+



$gameshowcase_text .= "<br>";


$ns -> tablerender($gameshowcase_title, $gameshowcase_text);


?>
