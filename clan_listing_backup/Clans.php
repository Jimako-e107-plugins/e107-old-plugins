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

//----------------------------------------------------------------------------------------------------

$sql->db_Select("clan_listing_cat", "*", "clan_cat_id='".intval($sub_action)."'");
$catname = $sql->db_Fetch();


$text .= "<center><a href='".e_PLUGIN."clan_listing/Clan_Categories.php'><center>[ ".CLANLIST_GB." ]</center></a><br>
	  <table class='forumheader3' style='width:100%'>
          <tr>
          <td colspan='2' class='forumheader3'><center><font size='".$pref['clanlist_listpagecatfsize']."'><b>".$tp->toHTML($catname['clan_cat_name'], TRUE)."</b></font><br><img src='".e_PLUGIN."clan_listing/icons/".$catname['clan_cat_icon']."' /></center></td>
          </tr>";
    


$sql->db_Select("clan_listing", "*", "clan_cat='".intval($sub_action)."'");
while($row = $sql->db_Fetch()){

$text .= "
<tr>
<td style='width:100%' class='indent'><a href='".e_PLUGIN."clan_listing/Clan_Details.php?det.".$row['clan_id']."'><font size='".$pref['clanlist_listpageclanfsize']."'>".$tp->toHTML($row['clan_name'], TRUE)."</font></a></td>
<td style='width:0%; text-align:center' class='indent'>".$tp->toHTML($row['clan_tag'], TRUE)."</td>
</tr>";}



$text .= "</table>";

//----------------------------------------------------------------------------------------------------
if (USER){
if ($pref['clanlist_enable_clansubmit'] == "1"){
$text .= "<br><center><a href='".e_PLUGIN."clan_listing/Clan_Submit_Form.php'>[ ".CLANLIST_SC." ]</a></center>";}}

//----------------------------------------------------------------------------------------------------

$title = "".$tp->toHTML($catname['clan_cat_name'], TRUE)." ".CLANLIST_CS."";

//----------------------------------------------------------------------------------------------------

$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>






