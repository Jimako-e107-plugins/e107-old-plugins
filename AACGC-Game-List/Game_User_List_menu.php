<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if ($pref['gamelist_enable_gold'] == "1")
{$gold_obj = new gold();}

if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

//-------------------------Menu Title--------------------------------+

$usergamemenu_title .= "".$pref['gameuser_menutitle']."";

//-------------------------------------------------------------------+

$usergamemenu_text .= "<table style='width:100%' class=''>";


if ($pref['gamelist_enable_userjoin'] == "1"){
$usergamemenu_text .= "
<tr><td class='forumheader3'><center>[ <a href='".e_PLUGIN."aacgc_gamelist/Game_User_List.php'>View All Gamers</a> ]</center></td></tr>
";}


$usergamemenu_text .= "</table><br>";
//------------------------------------------------------------------------+



if ($pref['gameuserlistmenu_enable_scroll'] == "1"){
$usergamemenu_text .= "
<script type=\"text/javascript\">
function gameusermenuup(){gameusermenu.direction = \"up\";}
function gameusermenudown(){gameusermenu.direction = \"down\";}
function gameusermenustop(){gameusermenu.stop();}
function gameusermenustart(){gameusermenu.start();}
</script>
<marquee height='".$pref['gameuser_menuheight']."px' id='gameusermenu' scrollamount='".$pref['gameusermenu_speed']."' onMouseover='this.scrollAmount=".$pref['gameusermenu_mouseoverspeed']."' onMouseout='this.scrollAmount=".$pref['gameusermenu_mouseoutspeed']."' direction='".$pref['gamelist_menu_direction']."' loop='true'>";
}
else
{$usergamemenu_text .= "<div style='border : 0; padding : 4px; width : auto; height : ".$pref['gameuser_menuheight']."px; overflow : auto; '>";}
        
        $sql->db_Select("user", "*", "ORDER BY user_id ASC", "");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($row['user_id'])."'");
        while($row2 = $sql2->db_Fetch()){

        if ($pref['gamelist_enable_avatar'] == "1"){
        if ($row['user_image'] == "")
        {$avatar = "<img src='".e_PLUGIN."aacgc_gamelist/images/default.png' width=".$pref['gamelist_avatar_size']."px></img>";}
        else
        {$useravatar = $row[user_image];
        require_once(e_HANDLER."avatar_handler.php");
        $useravatar = avatar($useravatar);
        $avatar = "<img src='".$useravatar."' width=".$pref['gamelist_avatar_size']."px></img>";}}
        if ($pref['gamelist_enable_gold'] == "1")
        {$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row2['user_id'])."</font>";}
        else
        {$userorb = "".$row['user_name']."";}



$usergamemenu_text .= "<table style='width:100%' class=''>";

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select user_id, count(chosen_game_id) as game from ".MPREFIX."aacgc_gamelist_members WHERE user_id='".intval($row2['user_id'])."';");
$games = $sql2->db_fetch();

$usergamemenu_text .= "<tr>";

$usergamemenu_text .= "<td style='width:0%' class='".$themea."'>".$avatar."</td>
                       <td style='width:100%' class='".$themea."'><a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$userorb."</a></td>
                       <td style='width:0%' class='".$themea."'>(".$games['game'].")</td>";

$usergamemenu_text .= "</tr>";


if($pref['gamelist_show_usermini'] == "1"){
$usergamemenu_text .= "<tr><td class='".$themeb."' colspan=3>";

        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($row['user_id'])."'");
        while($row2 = $sql2->db_Fetch()){
        $sql3 = new db;
        $sql3->db_Select("aacgc_gamelist", "*", "game_id='".intval($row2['chosen_game_id'])."' ORDER BY game_name ASC");
        while($row3 = $sql3->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_usermenuiconpath'] == "")
{$usericonpath = "icons";}
else
{$usericonpath = "".$pref['gamelist_usermenuiconpath']."";}
//---------------------------------------+

$usergamemenu_text .= "
<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row3['game_id']."'><img width='25px' src='".e_PLUGIN."aacgc_gamelist/".$usericonpath."/".$row3['game_pic']."' alt='".$row3['game_name']."'></img></a>";}}

$usergamemenu_text .= "</td></tr>";}

$usergamemenu_text .= "</table>";}}

if ($pref['gameuserlistmenu_enable_scroll'] == "1"){
$usergamemenu_text .= "</marquee>
<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"gameusermenustart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"gameusermenustop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"gameusermenuup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"gameusermenudown();\" type=\"button\">
</center>
</td></tr></table>
<br>
";}
else
{$usergamemenu_text .= "</div>";}



//----------------------------------------------------------------------------------

$ns -> tablerender($usergamemenu_title, $usergamemenu_text);

?>

