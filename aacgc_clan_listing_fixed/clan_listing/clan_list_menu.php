<?php

include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

//--------------------------------------------------------------------------------

$clanmenu_title .= "".$pref['clanlist_menutitle']."";

//--------------------------------------------------------------------------------

$clans = $sql -> db_Count("clan_listing");

//--------------------------------------------------------------------------------

if ($pref['clanlist_enable_clantotal'] == "1"){
$clanmenu_text .= "<center>".CLANLIST_MT." ".$clans."</center>";}

if ($pref['clanlist_enable_scroll'] == "1"){
$clanmenu_text .= "
<script type=\"text/javascript\">
function clanmenuup(){clanmenu.direction = \"up\";}
function clanmenudown(){clanmenu.direction = \"down\";}
function clanmenustop(){clanmenu.stop();}
function clanmenustart(){clanmenu.start();}
</script>";

$clanmenu_text .= "
<marquee height='".$pref['clanlist_menuheight']."px' id='clanmenu' scrollamount='".$pref['clanlist_menuspeeds']."' onMouseover='this.scrollAmount=".$pref['clanlist_menuspeedon']."' onMouseout='this.scrollAmount=".$pref['clanlist_menuspeedout']."' direction='up' loop='true'>";
}
else
{
$clanmenu_text .= "<div style='width:100%; height:".$pref['clanlist_menuheight']."px; overflow:auto'>";}

//--------------------------------------------------------------------------------

$clanmenu_text .= "<table style='width:100%' class=''>";

$sql ->db_Select("clan_listing_cat", "*", "ORDER BY clan_cat_name ASC","");
while($row = $sql ->db_Fetch()){

$sqlcc = e107::getDb();
$sqlcc->gen("select clan_cat, count(clan_id) as cls from ".MPREFIX."clan_listing where clan_cat=".$row['clan_cat_id'].";");
$clanic = $sqlcc->fetch();

$clanmenu_text .= "
<tr>
<td style='width:0%' class='forumheader3'><a href='".e_PLUGIN."clan_listing/Clans.php?det.".$row['clan_cat_id']."'><img src='".e_PLUGIN."clan_listing/icons/".$row['clan_cat_icon']."' width='".$pref['clanlist_menuiconsize']."px' /></td>
<td style='width:100%' class='forumheader3'><a href='".e_PLUGIN."clan_listing/Clans.php?det.".$row['clan_cat_id']."'><font size='".$pref['clanlist_menugamefsize']."'>".$row['clan_cat_name']."</font></a></td>
<td style='width:0%' class='forumheader3'>".$clanic['cls']."</td>
</tr>";

if ($pref['clanlist_enable_showclans'] == "1"){
$sql2 = e107::getDb();
$rows = $sql2 ->retrieve("clan_listing", "*", "WHERE clan_cat='".$row['clan_cat_id']."' ORDER BY clan_name ASC", true);
foreach($rows as $row2) {
$clanmenu_text .= "
<tr>
<td style='width:100%' class='indent' colspan='3'>
<table style='width:100%'><tr>
<td style='width:100%'><a href='".e_PLUGIN."clan_listing/Clan_Details.php?det.".$row2['clan_id']."'><font size=' ".$pref['clanlist_menuclanfsize']." '>".$row2['clan_name']."</font></a></td>
<td style='width:0%'>".$row2['clan_tag']."</td>
</tr></table>
<tr>";}
}

}

$clanmenu_text .= "</table>";

//--------------------------------------------------------------------------------

if ($pref['clanlist_enable_scroll'] == "1"){
$clanmenu_text .= "
</marquee>
<br><br>
<table style='width:100%' class=''><tr><td>
<center>
<input class=\"button\" value=\"Start\" onClick=\"clanmenustart();\" type=\"button\">
<input class=\"button\" value=\"Stop\" onClick=\"clanmenustop();\" type=\"button\">
<input class=\"button\" value=\"Up\" onClick=\"clanmenuup();\" type=\"button\">
<input class=\"button\" value=\"Down\" onClick=\"clanmenudown();\" type=\"button\">
</center>
</td></tr></table>
";
}
else
{
$clanmenu_text .= "</div>";}
//--------------------------------------------------------------------------------

if (USER){
if ($pref['clanlist_enable_clansubmit'] == "1"){
$clanmenu_text .= "<br><center><a href='".e_PLUGIN."clan_listing/Clan_Submit_Form.php'>[ ".CLANLIST_SC." ]</font></a></center>";}}

//--------------------------------------------------------------------------------

$ns -> tablerender($clanmenu_title, $clanmenu_text);

?>
