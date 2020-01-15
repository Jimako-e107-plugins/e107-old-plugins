<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

include_lan(e_PLUGIN."clan_listing/languages/".e_LANGUAGE.".php");

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

//------------------------------------------------------------------------

$title = "".$tp->toHTML($pref['clanlist_catpagetitle'], TRUE)."";

//------------------------------------------------------------------------

$text .= "<table style='width:100%' class='forumheader3'>
	  <tr>
	  <td style='' class=''>".$tp->toHTML($pref['clanlist_header'], TRUE)."</td>
	  </tr><tr>
	  <td style='' class='indent'>".$tp->toHTML($pref['clanlist_intro'], TRUE)."</td>
	  </tr>
	  </table>
	  <br>";

//------------------------------------------------------------------------

$text .= "<table style='width:100%' class='forumheader3'>";

$sql->gen("SELECT * FROM ".MPREFIX."clan_listing_cat ORDER BY clan_cat_order ASC");
while($row = $sql->fetch()){

$sql2 = e107::getDb();
$sql2->gen("select clan_cat, count(clan_id) as cls from ".MPREFIX."clan_listing where clan_cat='".intval($row['clan_cat_id'])."';");
$clanic = $sql2->fetch();

$text .= "<tr>
	  <td style='width:0%' class='indent'><a href='".e_PLUGIN."clan_listing/Clans.php?det.".$row['clan_cat_id']."'><img src='".e_PLUGIN."clan_listing/icons/".$row['clan_cat_icon']."' width='".$pref['clanlist_catpageiconsize']."px' align='left' /></td>
	  <td style='width:100%' class='indent'><a href='".e_PLUGIN."clan_listing/Clans.php?det.".$row['clan_cat_id']."'><font size='".$pref['clanlist_catpagefsize']."'><b>".$tp->toHTML($row['clan_cat_name'], TRUE)."</b></font></a> (".$clanic['cls'].")</a></td>
	  </tr>";}

$text .= "</table>";

//------------------------------------------------------------------------
if (USER){
if ($pref['clanlist_enable_clansubmit'] == "1"){
$text .= "<br><center><a href='".e_PLUGIN."clan_listing/Clan_Submit_Form.php'>[ ".CLANLIST_SC." ]</font></a></center>";}}

//------------------------------------------------------------------------

//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'clan_listing/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+

$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>
