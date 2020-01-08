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

$sql->db_Select("clan_listing", "*", "clan_id='".intval($sub_action)."'");
$row = $sql->db_Fetch();

$sql->db_Select("clan_listing_cat", "*", "clan_cat_id='".intval($row['clan_cat'])."'");
$catname = $sql->db_Fetch();

//----------------------------------------------------------------------------------------------------
if(ADMIN){
$text .= "<a href='".e_PLUGIN."clan_listing/Edit_Clan.php?det.".$row['clan_id']."'><img src='".e_PLUGIN."clan_listing/images/edit.png'></img></a>";
}
elseif (($row['clan_owner'] == "".USERID."") AND ($pref['clanlist_enable_clansubmitedit'] == "1"))
{$text .= "<a href='".e_PLUGIN."clan_listing/Edit_Clan.php?det.".$row['clan_id']."'><img src='".e_PLUGIN."clan_listing/images/edit.png'></img></a>";}


$text .= "<center><a href='".e_PLUGIN."clan_listing/Clans.php?det.".$row['clan_cat']."'><center>[ ".CLANLIST_GB." ]</center></a></center><br>
	  <table class='forumheader3' style='width:100%'>
	  <tr>
          <td class='indent'><center><font size='".$pref['clanlist_detpageclanfsize']."'><b>".$tp->toHTML($row['clan_name'], TRUE)."</b></font><br>".$tp->toHTML($row['clan_tag'], TRUE)."</center></td>
          </tr><tr>
          <td class='indent'><center>[ <a href='".$row['clan_website']."' target='_blank'>".CLANLIST_CW."</a> ]</center></td>
          </tr><tr>
          <td class='indent'><a href='ts3server://".$row['clan_tsip']."?port=".$row['clan_tsport']."' target='_blank'><img src='".e_PLUGIN."clan_listing/images/tsbutton.png' /></a>
          </tr><tr> 
          <td class='indent'>".$tp->toHTML($row['clan_banner'], TRUE)."</td>
          </tr><tr>
          <td class='indent'>".$tp->toHTML($row['clan_game_banner'], TRUE)."</td>
          </tr>
	  </table>";

//----------------------------------------------------------------------------------------------------

$title = "".$tp->toHTML($row['clan_name'], TRUE)." ".CLANLIST_DT."";

//----------------------------------------------------------------------------------------------------

$ns -> tablerender($title, $text);

require_once(FOOTERF);

?>






