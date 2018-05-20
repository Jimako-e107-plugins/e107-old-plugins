<?php
/**
*clanmanage.php
*
*
*/

require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(e_PLUGIN.'ebattles/include/clan.php');
// Specify if we use WYSIWYG for text areas
global $e_wysiwyg;
$e_wysiwyg	= "clandescription";  // set $e_wysiwyg before including HEADERF
require_once(HEADERF);

/*******************************************************************
********************************************************************/
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");
$text .= '
<script type="text/javascript" src="'.e_PLUGIN.'ebattles/js/clan.js"></script>
';

$clan_id = intval($_GET['clanid']);
$game_id = intval($_GET['gameid']);
if(!$clan_id)
{
	header("Location: ./clans.php");
	exit();
}

$q = "SELECT ".TBL_CLANS.".*, "
.TBL_USERS.".*"
." FROM ".TBL_CLANS.", "
.TBL_USERS
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
." AND (".TBL_USERS.".user_id = ".TBL_CLANS.".Owner)";

$result = $sql->db_Query($q);
$clan_owner  = mysql_result($result,0, TBL_USERS.".user_id");
$clan_owner_name   = mysql_result($result,0, TBL_USERS.".user_name");

$clan = new Clan($clan_id);

$can_manage = 0;
if (check_class($pref['eb_mod_class'])) $can_manage = 1;
if (USERID==$clan_owner) $can_manage = 1;
if ($can_manage == 0)
{
	header("Location: ./claninfo.php?clanid=$clan_id");
	exit();
}

$q = "SELECT ".TBL_CLANS.".*, "
.TBL_DIVISIONS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_CLANS.", "
.TBL_DIVISIONS.", "
.TBL_GAMES
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";
$result = $sql->db_Query($q);
$num_divs = mysql_numrows($result);

if ($num_divs>0)
{
	//$text .= '<div>'.$uname.'&nbsp;'.EB_USER_L35.'</div>';

	// Display list of games icons
	$games_links_list = '<div class="spacer">';
	for($i=0; $i<$num_divs; $i++)
	{
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
		if($game_id=="") $game_id = $gid;

		if($gid==$game_id)
		{
			$gname_selected = $gname;
		}

		$games_links_list .= '<a href="'.e_PLUGIN.'ebattles/clanmanage.php?clanid='.$clan_id.'&amp;gameid='.$gid.'"><img '.getGameIconResize($gicon).' title="'.$gname.'"/></a>';
		$games_links_list .= '&nbsp;';
	}
	$games_links_list .= '<br /><b>'.$gname_selected.'</b></div><br />';
}


$text .= '<div id="tabs">';
$text .= '<ul>';
$text .= '<li><a href="#tabs-1">'.EB_CLANM_L2.'</a></li>';
$text .= '<li><a href="#tabs-2">'.EB_CLANM_L36.'</a></li>';
$text .= '<li><a href="#tabs-3">'.EB_CLANM_L3.'</a></li>';
$text .= '</ul>';

//***************************************************************************************
// tab-page "Team Summary"
$text .= '<div id="tabs-1">';

$text .= '<table class="eb_table" style="width:95%">';
$text .= '<tbody>';
$text .= '<tr><td>';
$text .= '
<form action="'.e_PLUGIN.'ebattles/claninfo.php?clanid='.$clan_id.'" method="post">
'.ebImageTextButton('submit', 'magnify.png', EB_CLANM_L35).'
</form>';
$text .= '</td></tr>';
$text .= '</tbody>';
$text .= '</table>';

$text .= '<form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
// Delete team
$q_ClanScores = "SELECT ".TBL_DIVISIONS.".*, "
.TBL_TEAMS.".*, "
.TBL_PLAYERS.".*, "
.TBL_SCORES.".*"
." FROM ".TBL_DIVISIONS.", "
.TBL_TEAMS.", "
.TBL_PLAYERS.", "
.TBL_SCORES
." WHERE (".TBL_DIVISIONS.".Clan = '$clan_id')"
." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
$result_ClanScores = $sql->db_Query($q_ClanScores);
$numClanScores = mysql_numrows($result_ClanScores);
if ($numClanScores == 0)
{
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tbody>';
	$text .= '<tr><td>';
	$text .= ebImageTextButton('clandelete', 'delete.png', EB_CLANM_L5, 'negative jq-button', EB_CLANM_L6);
	$text .= '</td></tr>';
	$text .= '</tbody>';
	$text .= '</table>';
}

$text .= '<table class="eb_table" style="width:95%">';
$text .= '<tbody>';

$text .= '<!-- Clan Owner -->';
$text .= '<tr>';
$text .= '<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L7.'<br />';
$text .= '<a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$clan_owner.'">'.$clan_owner_name.'</a>';
$text .= '</td>';

$q_2 = "SELECT ".TBL_USERS.".*"
." FROM ".TBL_USERS;
$result_2 = $sql->db_Query($q_2);
$row = mysql_fetch_array($result_2);
$num_rows_2 = mysql_numrows($result_2);

$text .= '<td class="eb_td">';
$text .= '<table class="table_left">';
$text .= '<tr>';
$text .= '<td><select class="tbox" name="clanowner">';
for($j=0; $j<$num_rows_2; $j++)
{
	$uid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
	$uname  = mysql_result($result_2,$j, TBL_USERS.".user_name");

	if ($clan_owner == $uid)
	{
		$text .= '<option value="'.$uid.'" selected="selected">'.$uname.'</option>';
	}
	else
	{
		$text .= '<option value="'.$uid.'">'.$uname.'</option>';
	}
}
$text .= '</select>';
$text .= '</td>';
$text .= '<td>';
$text .= ebImageTextButton('clanchangeowner', 'user_go.ico', EB_CLANM_L8);
$text .= '</td>';
$text .= '</tr>';
$text .= '</table>';
$text .= '</td>';
$text .= '</tr>';

$text .= '
</tbody>
</table>
</form>
</div>';  // tab-page "Team Summary"

//***************************************************************************************
// tab-page "Team Settings"
$text .= '<div id="tabs-2">';

$text .= $clan->displayClanSettingsForm();

$text .= '</div>';  // tab-page "Team Settings"

//***************************************************************************************
// tab-page "Team Divisions"
$text .= '<div id="tabs-3">';

$q = "SELECT DISTINCT ".TBL_GAMES.".*"
." FROM ".TBL_GAMES
." ORDER BY Name";
$result = $sql->db_Query($q);
/* Error occurred, return given name by default */
$numGames = mysql_numrows($result);
if ($numGames > 0)
{
	$text .= '<form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
	$text .= '<table class="eb_table" style="width:95%">';
	$text .= '<tbody>';
	$text .= '<tr>';
	$text .= '<td class="eb_td">';
	$text .= EB_CLANM_L13;
	$text .= '</td>';
	$text .= '<td class="eb_td">';
	$text .= '<table class="table_left"><tr>';
	$text .= '<td><div>';
	$text .= '<select class="tbox" name="divgame">';
	for($i=0; $i < $numGames; $i++){
		$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
		$gid  = mysql_result($result,$i, TBL_GAMES.".GameId");
		$text .= '<option value="'.$gid.'">'.htmlspecialchars($gname).'</option>';
	}
	$text .= '</select></div></td>';
	$text .= '<td><div><input type="hidden" name="clanowner" value="'.$clan_owner.'"/>';
	$text .= ebImageTextButton('clanadddiv', 'add.png', EB_CLANM_L14);
	$text .= '';
	$text .= '</div></td>';
	$text .= '</tr></table>';
	$text .= '</td>';
	$text .= '</tr>';
	$text .= '</tbody>';
	$text .= '</table>';
	$text .= '</form>';
}

$text .= $games_links_list;

$q = "SELECT ".TBL_CLANS.".*, "
.TBL_DIVISIONS.".*, "
.TBL_USERS.".*, "
.TBL_GAMES.".*"
." FROM ".TBL_CLANS.", "
.TBL_DIVISIONS.", "
.TBL_USERS.", "
.TBL_GAMES
." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
." AND (".TBL_USERS.".user_id = ".TBL_DIVISIONS.".Captain)"
." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";

$result = $sql->db_Query($q);
$num_divs = mysql_numrows($result);
for($i=0; $i<$num_divs; $i++)
{
	$gid  = mysql_result($result,$i, TBL_GAMES.".GameID");
	$gname  = mysql_result($result,$i, TBL_GAMES.".Name");
	$gicon  = mysql_result($result,$i , TBL_GAMES.".Icon");
	$div_id  = mysql_result($result,$i, TBL_DIVISIONS.".DivisionID");
	$div_captain  = mysql_result($result,$i, TBL_USERS.".user_id");
	$div_captain_name  = mysql_result($result,$i, TBL_USERS.".user_name");

	if($gid == $game_id)
	{
		$text .= '<table class="eb_table" style="width:95%">';
		$text .= '<tbody>';
		$text .= '<tr>';
		$text .= '<td class="eb_td">';
		$text .= EB_CLANM_L15.': <a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$div_captain.'">'.$div_captain_name.'</a>';

		// Delete division
		$q_DivScores = "SELECT ".TBL_DIVISIONS.".*, "
		.TBL_TEAMS.".*, "
		.TBL_PLAYERS.".*, "
		.TBL_SCORES.".*"
		." FROM ".TBL_DIVISIONS.", "
		.TBL_TEAMS.", "
		.TBL_PLAYERS.", "
		.TBL_SCORES
		." WHERE (".TBL_DIVISIONS.".DivisionID = '$div_id')"
		." AND (".TBL_TEAMS.".Division = ".TBL_DIVISIONS.".DivisionID)"
		." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)"
		." AND (".TBL_SCORES.".Player = ".TBL_PLAYERS.".PlayerID)";
		$result_DivScores = $sql->db_Query($q_DivScores);
		$numDivScores = mysql_numrows($result_DivScores);
		if ($numDivScores == 0)
		{
			$text .= '<br /><form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
			$text .= '<div>';
			$text .= '<input type="hidden" name="clandiv" value="'.$div_id.'"/>';
			$text .= ebImageTextButton('clandeletediv', 'delete.png', EB_CLANM_L16, 'negative jq-button', EB_CLANM_L17);
			$text .= '</div></form>';
		}

		$text .= '</td>';
		$q_2 = "SELECT ".TBL_CLANS.".*, "
		.TBL_DIVISIONS.".*, "
		.TBL_MEMBERS.".*, "
		.TBL_USERS.".*, "
		.TBL_GAMES.".*"
		." FROM ".TBL_CLANS.", "
		.TBL_DIVISIONS.", "
		.TBL_USERS.", "
		.TBL_MEMBERS.", "
		.TBL_GAMES
		." WHERE (".TBL_CLANS.".ClanID = '$clan_id')"
		." AND (".TBL_DIVISIONS.".Clan = ".TBL_CLANS.".ClanID)"
		." AND (".TBL_DIVISIONS.".DivisionID = '$div_id')"
		." AND (".TBL_MEMBERS.".Division = ".TBL_DIVISIONS.".DivisionID)"
		." AND (".TBL_USERS.".user_id = ".TBL_MEMBERS.".User)"
		." AND (".TBL_GAMES.".GameID = ".TBL_DIVISIONS.".Game)";
		$result_2 = $sql->db_Query($q_2);
		if(!$result_2 || (mysql_numrows($result_2) < 1))
		{
			$text .= '<td class="eb_td">'.EB_CLANM_L18.'</td></tr>';
		}
		else
		{
			$row = mysql_fetch_array($result_2);
			$num_rows_2 = mysql_numrows($result_2);

			$text .= '<td class="eb_td">';
			$text .= '<form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
			$text .= '<table class="table_left">';
			$text .= '<tr>';
			$text .= '<td><select class="tbox" name="divcaptain">';
			for($j=0; $j<$num_rows_2; $j++)
			{
				$mid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
				$mname  = mysql_result($result_2,$j, TBL_USERS.".user_name");

				if ($div_captain == $mid)
				{
					$text .= '<option value="'.$mid.'" selected="selected">'.$mname.'</option>';
				}
				else
				{
					$text .= '<option value="'.$mid.'">'.$mname.'</option>';
				}
			}
			$text .= '</select>';
			$text .= '</td>';
			$text .= '<td>';
			$text .= '<div>';
			$text .= '<input type="hidden" name="clandiv" value="'.$div_id.'"/>';
			$text .= ebImageTextButton('clanchangedivcaptain', 'user_go.ico', EB_CLANM_L19);
			$text .= '</div>';
			$text .= '</td>';
			$text .= '</tr>';
			$text .= '</table>';
			$text .= '</form>';
			$text .= '</td>';
			$text .= '</tr>';

			$text .= '<tr>';
			$text .= '<td class="eb_td">'.$num_rows_2.'&nbsp;'.EB_CLANM_L20.'</td>';
			$text .= '<td class="eb_td">';
			$text .= '<form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
			$text .= '<div><input type="hidden" name="clandiv" value="'.$div_id.'"/>';
			$text .= '<table class="eb_table" style="width:95%"><tbody>';
			$text .= '<tr>
			<th class="eb_th2">'.EB_CLANM_L21.'</th>
			<th class="eb_th2">'.EB_CLANM_L22.'</th>
			<th class="eb_th2">'.EB_CLANM_L23.'</th>
			<th class="eb_th2">'.EB_CLANM_L24.'</th>
			</tr>';
			for($j=0; $j<$num_rows_2; $j++)
			{
				$mid  = mysql_result($result_2,$j, TBL_MEMBERS.".MemberID");
				$muid  = mysql_result($result_2,$j, TBL_USERS.".user_id");
				$mname  = mysql_result($result_2,$j, TBL_USERS.".user_name");
				$mjoined  = mysql_result($result_2,$j, TBL_MEMBERS.".timestamp");
				$mjoined_local = $mjoined + TIMEOFFSET;
				$date  = date("d M Y",$mjoined_local);

				$text .= '<tr>';
				$text .= '<td class="eb_td"><b><a href="'.e_PLUGIN.'ebattles/userinfo.php?user='.$muid.'">'.$mname.'</a></b></td>
				<td class="eb_td">'.EB_CLANM_L25.'</td>
				<td class="eb_td">'.$date.'</td>';

				// Checkbox to select which member to kick
				$text .= '<td class="eb_td"><input type="checkbox" name="del[]" value="'.$mid.'" /></td>';
				$text .= '</tr>';
			}
			$text .= '<tr>';
			$text .= '<td colspan="4">';
			$text .= ebImageTextButton('kick', 'user_delete.ico', EB_CLANM_L26);
			$text .= '</td>';
			$text .= '</tr>';
			$text .= '</tbody></table></div>';
			$text .= '</form>';
			$text .= '</td>';
			$text .= '</tr>';
		}
		$text .= '</tbody>';
		$text .= '</table>';
		
		// Form to Invite a user
		$q = "SELECT ".TBL_USERS.".*"
		." FROM ".TBL_USERS;
		$result = $sql->db_Query($q);
		$numUsers = mysql_numrows($result);
		$text .= '<form action="'.e_PLUGIN.'ebattles/clanprocess.php?clanid='.$clan_id.'" method="post">';
		$text .= '<input type="hidden" name="clandiv" value="'.$div_id.'"/>';
		$text .= '
		<table class="eb_table" style="width:95%">
		<tbody>
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L37.'</td>
		<td class="eb_td">
		<table class="table_left">
		<tr>
		<td><div><select class="tbox" name="user">
		';
		for($i=0; $i<$numUsers; $i++)
		{
			$uid  = mysql_result($result,$i, TBL_USERS.".user_id");
			$uname  = mysql_result($result,$i, TBL_USERS.".user_name");

			// fm: can we do this in 1 query?
			$q_Members = "SELECT COUNT(*) as NbrMembers"
			." FROM ".TBL_MEMBERS
			." WHERE (".TBL_MEMBERS.".Division = '$div_id')"
			." AND (".TBL_MEMBERS.".User = '$uid')";
			$result_Members = $sql->db_Query($q_Members);
			$row = mysql_fetch_array($result_Members);
			$nbrMembers = $row['NbrMembers'];
			if ($nbrMembers==0)
			{
				$text .= '<option value="'.$uid.'">'.$uname.'</option>';
			}
		}
		$text .= '
		</select></div></td>
		<td>'.ebImageTextButton('claninviteuser', 'user_add.png', EB_CLANM_L38).'</td>
		</tr>
		</table>
		</td>
		</tr>';
		$text .= '
		</tbody>
		</table>
		</form>
		';			
	}
}

$text .= '</div>';  // tab-page "Team Divisions"
$text .= '</div>';  // tabs"

$ns->tablerender($clan->getField('Name')." - ".EB_CLANM_L1, $text);

require_once(FOOTERF);
exit;
?>
