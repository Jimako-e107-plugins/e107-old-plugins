<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


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



$text .= "<br>
          <center>
          [<a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'> Back To Game Categories </a>]
          </center>
          ";



        $sql9 = new db;
        $sql9 ->db_Select("aacgc_gamelist_marks", "*", "ORDER BY mark_id ASC","");
        while($row9 = $sql9 ->db_Fetch()){

$text .= "<img src='".e_PLUGIN."aacgc_gamelist/marks/".$row9['mark_img']."'></img> = ".$row9['mark_name']."<br>";}


//---------------------------------------# Theme 1 #-------------------------------------------------------------
if ($pref['alt_gamelist_theme'] == "1"){



$iconsperrow = "".$pref['gamelist_alttheme_rows']."";

if ($pref['gamelist_alttheme_rows'] == "2"){
$width = "width:50%";}
if ($pref['gamelist_alttheme_rows'] == "3"){
$width = "width:33%";}
if ($pref['gamelist_alttheme_rows'] == "4"){
$width = "width:25%";}
if ($pref['gamelist_alttheme_rows'] == "5"){
$width = "width:20%";}


        $sql ->db_Select("aacgc_gamelist_cat", "*", "cat_id='".intval($sub_action)."'");
        while($row = $sql ->db_Fetch()){


$text .= "
<table style='width:100%' class='' cellspacing='0' cellpadding='0'>";

$text .= "
<tr>
<td style='width:25%' class='".$themea."' colspan=".$iconsperrow."><center>
<font size='".$pref['gamelist_catftsize']."'><b><u>".$row['cat_name']."</u></b></font>
<br><br>
<font size='".$pref['gamelist_catdetftsize']."'>".$row['cat_text']."</font>
<br><br>
</td>
</tr>";


//--------------# Multipage Script #---------------------------
$catid = $row['cat_id'];

$previcon = "<img src='".e_PLUGIN."aacgc_gamelist/images/prevpage.png'></img>";
$pageonicon = "<img src='".e_PLUGIN."aacgc_gamelist/images/pageon.png'></img>";
$pageofficon = "<img src='".e_PLUGIN."aacgc_gamelist/images/pageoff.png'></img>";
$nexticon = "<img src='".e_PLUGIN."aacgc_gamelist/images/nextpage.png'></img>";

if ($pref['gamelist_gamesperpage'] != '') 
{$rowsPerPage = $pref['gamelist_gamesperpage'];} 
else 
{$rowsPerPage = "";}

if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}

$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}

$offset = ($pageNum - 1) * $rowsPerPage;


$query = @mysql_query("SELECT game_id FROM ".MPREFIX."aacgc_gamelist WHERE game_cat='".intval($sub_action)."'");
$numrows = mysql_num_rows($query);

if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}

$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $pageonicon ";} 
else 
{$nav .= " <a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."&det.".$catid."\">$pageofficon</a> ";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$previcon."</a> ";} 
else 
{$prev  = "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$nexticon."</a> ";} 
else 
{$next = "";}

//---------------------------------------------------------------

if ($pref['gamelist_gamesperpage'] == "") 
{$limit = "";} 
else 
{$limit = "LIMIT ".$offset.", ".$rowsPerPage."";}

        $sql7 = new db;
        $sql7 ->db_Select("aacgc_gamelist", "*", "game_cat='".intval($row['cat_id'])."' ORDER BY game_name ASC $limit");
        $rows = $sql7->db_Rows();
        $pcol = 1;
        for ($i = 0; $i < $rows; $i++){
        while($row7 = $sql7 ->db_Fetch()){

$text .= "
<td style='".$width."' class='".$themeb."' valign = top>
<table style='width:100%' class=''>
<tr><td class='".$themea."'><center><a href='Game_Details.php?det.".$row7['game_id']."'><font size='".$pref['gamelist_namefs']."'>".$row7['game_name']."</font></a></td></tr>";

//-----------# Icon Path #---------------+
if($pref['gamelist_listpageiconpath'] == "")
{$listiconpath = "icons";}
else
{$listiconpath = "".$pref['gamelist_listpageiconpath']."";}
//---------------------------------------+

$text .= "<tr><td class=''><center><a href='Game_Details.php?det.".$row7['game_id']."'><img width='".$pref['gamelist_iconsize']."' src='".e_PLUGIN."/aacgc_gamelist/".$listiconpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img></a></center>";


//-----------------------# Game Mark #----------------------------

        $sql8 = new db;
        $sql8 ->db_Select("aacgc_gamelist_markedgames", "*", "game='".intval($row7['game_id'])."'");
        while($row8 = $sql8 ->db_Fetch()){
        $sql10 = new db;
        $sql10 ->db_Select("aacgc_gamelist_marks", "*", "mark_id='".intval($row8['mark'])."'");
        $row10 = $sql10 ->db_Fetch();

$text .= "<img src='".e_PLUGIN."aacgc_gamelist/marks/".$row10['mark_img']."' alt='".$row10['mark_name']."'></img>";}



//-----------------------# CMMS #--------------------------
if ($pref['gamelist_enable_cmmscount'] =="1"){
        $sql11 = new db;
        $sql11 ->db_Select("aacgc_gamelist_cmms", "*", "game='".intval($row7['game_id'])."'");
        while($row11 = $sql11 ->db_Fetch()){
        $sql12 = new db;
        $sql12->mySQLresult = @mysql_query("select clan_game, count(clan_id) as cmmscls from ".MPREFIX."aacgc_cmms_clans where clan_game='".intval($row11['cmmscat'])."';");
        $cmmsc = $sql12->db_fetch();

if($cmmsc['cmmscls'] == "0"){}
else
{$text .= "<br>Clans Listed: ".$cmmsc['cmmscls']."";}}}
//----------------------------------------------------------------

//-----------------------# Clan Listing #--------------------------
if ($pref['gamelist_enable_clantotallist'] =="1"){
        $sql11 = new db;
        $sql11 ->db_Select("aacgc_gamelist_clanlist", "*", "game='".intval($row7['game_id'])."'");
        while($row11 = $sql11 ->db_Fetch()){
        $sql12 = new db;
        $sql12->mySQLresult = @mysql_query("select clan_cat, count(clan_id) as cls from ".MPREFIX."clan_listing where clan_cat='".intval($row11['clancat'])."';");
        $clanic = $sql12->db_fetch();

if($clanic['cls'] == "0"){}
else
{$text .= "<br>Clans Listed: ".$clanic['cls']."";}}}
//----------------------------------------------------------------


//-----------------------# Game Server List #--------------------------
if ($pref['gamelist_enable_servertotallist'] =="1"){
        $sql13 = new db;
        $sql13 ->db_Select("aacgc_gamelist_gameservers", "*", "game='".intval($row7['game_id'])."'");
        while($row13 = $sql13 ->db_Fetch()){
        $sql14 = new db;
        $sql14->mySQLresult = @mysql_query("select server_cat, count(server_id) as servs from ".MPREFIX."aacgc_serverlist where server_cat='".intval($row13['servercat'])."';");
        $serveric = $sql14->db_fetch();

if($serveric['servs'] == "0"){}
else
{$text .= "<br>Servers Listed: ".$serveric['servs']."";}}}
//----------------------------------------------------------------

//-----------------------# Game Players #-------------------------

$sql6 = new db;
$sql6->mySQLresult = @mysql_query("select user_id, count(user_id) as plyrs from ".MPREFIX."aacgc_gamelist_members where chosen_game_id='".intval($row7['game_id'])."';");
$players = $sql6->db_fetch();

if($players['plyrs'] == "0"){}
else
{$text .= "<br>Gamers Listed: ".$players['plyrs']."";}

//----------------------------------------------------------------
//-----------------------# Game Rating #--------------------------
if ($pref['gamelist_enable_rating'] == "1"){
include_once(e_HANDLER."rate_class.php");
$rater = new rater;
$text .= "<span>";
if($rating = $rater->getrating('aacgc_gamelist', $row7['game_id'])){
$text .= "<br>Rating: ";
$text .= $rating[2] ? "{$rating[1]}.{$rating[2]} ({$rating[0]})" : "{$rating[1]} ({$rating[0]})";
$text .= "<br>";
$num = $rating[1];
for($i=1; $i<= $num; $i++){
$text .= "<img src='".e_IMAGE_ABS."user_icons/user_star_".IMODE.".png' style='border:0' alt='' />";}}
/*
if(!$rater->checkrated('aacgc_gamelist', $row7['game_id'])){
$text .= " &nbsp; &nbsp;".$rater->rateselect('', 'aacgc_gamelist', $row7['game_id']);}
*/
$text .= "</span>";}

//----------------------------------------------------------------


$text .= "</td></tr></table>";


$text .= "</td>";

if ($pcol == $iconsperrow) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}}}


$text .= "</table><br><br>";}

else{

//---------------------------------------# Theme 2 #-------------------------------------------------------------

        $sql ->db_Select("aacgc_gamelist_cat", "*", "cat_id='".intval($sub_action)."'");
        while($row = $sql ->db_Fetch()){


$text .= "
<table style='width:100%' class='' cellspacing='0' cellpadding='0'><tr>
<td style='width:25%' class='".$themea."' colspan=2><center>
<font size='".$pref['gamelist_catftsize']."'><b><u>".$row['cat_name']."</u></b></font>
<br><br>
<font size='".$pref['gamelist_catdetftsize']."'>".$row['cat_text']."</font>
<br><br>
</td>
</tr>";

//--------------# Multipage Script #---------------------------
$catid = $row['cat_id'];

$previcon = "<img src='".e_PLUGIN."aacgc_gamelist/images/prevpage.png'></img>";
$pageonicon = "<img src='".e_PLUGIN."aacgc_gamelist/images/pageon.png'></img>";
$pageofficon = "<img src='".e_PLUGIN."aacgc_gamelist/images/pageoff.png'></img>";
$nexticon = "<img src='".e_PLUGIN."aacgc_gamelist/images/nextpage.png'></img>";

if ($pref['gamelist_gamesperpage'] != '') 
{$rowsPerPage = $pref['gamelist_gamesperpage'];} 
else 
{$rowsPerPage = "";}

if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}

$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}

$offset = ($pageNum - 1) * $rowsPerPage;


$query = @mysql_query("SELECT game_id FROM ".MPREFIX."aacgc_gamelist WHERE game_cat='".intval($sub_action)."'");
$numrows = mysql_num_rows($query);

if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}

$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $pageonicon ";} 
else 
{$nav .= " <a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."&det.".$catid."\">$pageofficon</a> ";}}

if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$previcon."</a> ";} 
else 
{$prev  = "";}

if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">".$nexticon."</a> ";} 
else 
{$next = "";}

//---------------------------------------------------------------

if ($pref['gamelist_gamesperpage'] == "") 
{$limit = "";} 
else 
{$limit = "LIMIT ".$offset.", ".$rowsPerPage."";}

        $sql7 = new db;
        $sql7 ->db_Select("aacgc_gamelist", "*", "game_cat='".intval($row['cat_id'])."' ORDER BY game_name ASC $limit","");
        while($row7 = $sql7 ->db_Fetch()){

$text .= "
<tr>
<td style='width:25%' class='".$themeb."'>";

        $sql8 = new db;
        $sql8 ->db_Select("aacgc_gamelist_markedgames", "*", "game='".intval($row7['game_id'])."'");
        while($row8 = $sql8 ->db_Fetch()){
        $sql10 = new db;
        $sql10 ->db_Select("aacgc_gamelist_marks", "*", "mark_id='".intval($row8['mark'])."'");
        $row10 = $sql10 ->db_Fetch();

$text .= "<img src='".e_PLUGIN."aacgc_gamelist/marks/".$row10['mark_img']."' alt='".$row10['mark_name']."'></img>";}

//-----------# Icon Path #---------------+
if($pref['gamelist_listpageiconpath'] == "")
{$listiconpath = "icons";}
else
{$listiconpath = "".$pref['gamelist_listpageiconpath']."";}
//---------------------------------------+

$text .= "<center>
<a href='Game_Details.php?det.".$row7['game_id']."'>
<img width='".$pref['gamelist_iconsize']."' src='".e_PLUGIN."/aacgc_gamelist/".$listiconpath."/".$row7['game_pic']."' alt = '".$row7['game_name']."'></img>
</a>
<br>
<a href='Game_Details.php?det.".$row7['game_id']."'>
<font size='".$pref['gamelist_namefs']."'>".$row7['game_name']."</font>
</a>
</td>
<td style='width:75%' class='".$themeb."'><font size='".$pref['gamelist_detfs']."'>".$row7['game_text']."</font></td>
</tr>";}



$text .= "</table><br><br>";}}



//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_gamelist/plugin.php');
$copyright .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text."<br><br><div style='width:' class='".$themeb."'><center><u>Page Selection</u><br><br>".$prev."".$nav."".$next."</center></div>".$copyright."");












//----------------------------------------------------------------------------------

require_once(FOOTERF);



?>