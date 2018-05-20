<?php
// functions for clan.
//___________________________________________________________________
require_once(e_PLUGIN.'ebattles/include/main.php');
require_once(e_PLUGIN.'ebattles/include/event.php');

class Clan extends DatabaseTable
{
	protected $tablename = TBL_CLANS;
	protected $primary_key = "ClanID";

	/***************************************************************************************
	Functions
	***************************************************************************************/
	function setDefaultFields()
	{
	}

	function deleteClan()
	{
		global $sql;
		$q = "DELETE FROM ".TBL_CLANS
		." WHERE (".TBL_CLANS.".ClanID = '".$this->fields['ClanID']."')";
		$result = $sql->db_Query($q);
	}

	function displayClanSettingsForm($create=false)
	{
		global $sql;

		if (e_WYSIWYG)
		{
			$insertjs = "rows='15'";
		}
		else
		{
			require_once(e_HANDLER."ren_help.php");
			$insertjs = "rows='5' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
		}

		if($create==true)
		{
			$clan_str='';
			$action_str='actionid=create';
		}
		else
		{
			$clan_str='clanid='.$this->getField('ClanID');
			$action_str='&amp;actionid=edit';
		}

		$text .= "
		<script type='text/javascript'>
		<!--//
		function changeteamtext(v)
		{
		document.getElementById('clanavatar').value=v;
		}    //-->
		</script>
		";

		if ($this->getField('Image') == '' && $pref['eb_avatar_default_team_image'] != '') $this->setFieldDB('Image', $pref['eb_avatar_default_team_image']);

		$text .= '<form id="form-clan-settings" action="'.e_PLUGIN.'ebattles/clanprocess.php?'.$clan_str.$action_str.'" method="post">';
		$text .= '
		<table class="eb_table" style="width:95%">
		<tbody>
		';
		//<!-- Clan Name -->'
		$text .= '<tr>';
		$text .= '
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L9.'<span class="required">*</span></td>
		<td class="eb_td">
		<input class="tbox required" type="text" size="40" name="clanname" value="'.$this->getField('Name').'"/>
		</td>
		</tr>';

		//<!-- Clan Avatar -->
		$text .= '<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L29.'<div class="smalltext">'.EB_CLANM_L30.'</div></td>
		<td class="eb_td">';
		if ($this->getField('Image') != '')
		{
			$text .= '<img '.getAvatarResize(getImagePath($this->getField('Image'), 'team_avatars')).'/>&nbsp;';
		}
		$text .= '<input class="tbox" type="text" id="clanavatar" name="clanavatar" size="20" value="'.$this->getField('Image').'"/>';

		$text .= '<div><br />';
		$avatarlist = array();
		$avatarlist[0] = "";
		$handle = opendir(e_PLUGIN."ebattles/images/team_avatars/");
		while ($file = readdir($handle))
		{
			if ($file != "." && $file != ".." && $file != "index.html" && $file != ".svn" && $file != "Thumbs.db")
			{
				$avatarlist[] = $file;
			}
		}
		closedir($handle);

		for($c = 1; $c <= (count($avatarlist)-1); $c++)
		{
			$text .= '<a href="javascript:changeteamtext(\''.$avatarlist[$c].'\')"><img src="'.e_PLUGIN.'ebattles/images/team_avatars/'.$avatarlist[$c].'" alt="'.$avatarlist[$c].'" style="border:0"/></a> ';
		}
		$text .= '
		</div>
		</td>
		</tr>';

		//<!-- Clan Tag -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L10.'</td>
		<td class="eb_td">
		<input class="tbox" type="text" size="40" name="clantag" value="'.$this->getField('Tag').'"/>
		</td>
		</tr>
		';

		//<!-- Clan Password -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L11.'</td>
		<td class="eb_td">
		<input class="tbox" type="text" size="40" name="clanpassword" value="'.$this->getField('password').'"/>
		</td>
		</tr>
		';

		//<!-- Clan Website -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L31.'</td>
		<td class="eb_td">
		<input class="tbox" type="text" size="40" name="clanwebsite" value="'.$this->getField('websiteURL').'"/>
		</td>
		</tr>
		';

		//<!-- Clan Email -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L32.'</td>
		<td class="eb_td">
		<input class="tbox" type="text" size="40" name="clanemail" value="'.$this->getField('email').'"/>
		</td>
		</tr>
		';

		//<!-- Clan IM -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L33.'</td>
		<td class="eb_td">
		<input class="tbox" type="text" size="40" name="clanIM" value="'.$this->getField('IM').'"/>
		</td>
		</tr>
		';

		//<!-- Clan Description -->
		$text .= '
		<tr>
		<td class="eb_td eb_tdc1 eb_w40">'.EB_CLANM_L34.'</td>
		<td class="eb_td">
		';
		$text .= '<textarea class="tbox" id="clandescription" name="clandescription" cols="70" '.$insertjs.'>'.$this->getField('Description').'</textarea>';
		if (!e_WYSIWYG)
		{
			$text .= '<br />'.display_help("helpb",1);
		}
		$text .= '
		</td>
		</tr>
		</tbody>
		</table>
		';

		//<!-- Save Button -->
		$text .= '
		<table><tbody><tr><td>
		<div>
		'.ebImageTextButton('clansettingssave', 'disk.png', EB_CLANM_L12).'
		</div>
		</td></tr></tbody></table>
		</form>';

		return $text;
	}
}

class Division extends DatabaseTable
{
	protected $tablename = TBL_DIVISIONS;
	protected $primary_key = "DivisionID";

	//----------------------------------------------------------
	function deleteMemberPlayers()
	{
		global $sql;

		$q_MemberPlayers = "SELECT ".TBL_MEMBERS.".*, "
		.TBL_TEAMS.".*, "
		.TBL_PLAYERS.".*"
		." FROM ".TBL_MEMBERS.", "
		.TBL_TEAMS.", "
		.TBL_PLAYERS
		." WHERE (".TBL_MEMBERS.".User = ".USERID.")"
		." AND (".TBL_MEMBERS.".Division = '".$this->fields['DivisionID']."')"
		." AND (".TBL_TEAMS.".Division = '".$this->fields['DivisionID']."')"
		." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)";
		$result_MemberPlayers = $sql->db_Query($q_MemberPlayers);
		$numMemberPlayers = mysql_numrows($result_MemberPlayers);
		for($j=0; $j<$numMemberPlayers; $j++)
		{
			$pID  = mysql_result($result_MemberPlayers,$j, TBL_PLAYERS.".PlayerID");
			deletePlayer($pID);
		}
	}
	function deleteMember()
	{
		global $sql;

		$q = " DELETE FROM ".TBL_MEMBERS
		." WHERE (Division = '".$this->fields['DivisionID']."')"
		."   AND (User = ".USERID.")";
		$sql->db_Query($q);
	}
	//----------------------------------------------------------
	function deleteDivPlayers()
	{
		global $sql;
		$q_DivPlayers = "SELECT ".TBL_TEAMS.".*, "
		.TBL_PLAYERS.".*"
		." FROM ".TBL_TEAMS.", "
		.TBL_PLAYERS
		." WHERE (".TBL_TEAMS.".Division = '".$this->fields['DivisionID']."')"
		." AND (".TBL_PLAYERS.".Team = ".TBL_TEAMS.".TeamID)";
		$result_DivPlayers = $sql->db_Query($q_DivPlayers);
		$numDivPlayers = mysql_numrows($result_DivPlayers);
		for($j=0; $j<$numDivPlayers; $j++)
		{
			$pID  = mysql_result($result_DivPlayers,$j, TBL_PLAYERS.".PlayerID");
			deletePlayer($pID);
		}
	}
	function deleteDivTeams()
	{
		// Attention, need to make sure teams have no players/scores first
		global $sql;
		$q = "DELETE FROM ".TBL_TEAMS
		." WHERE (".TBL_TEAMS.".Division = '".$this->fields['DivisionID']."')";
		$result = $sql->db_Query($q);
	}
	function deleteDivMembers()
	{
		global $sql;
		$q = "DELETE FROM ".TBL_MEMBERS
		." WHERE (".TBL_MEMBERS.".Division = '".$this->fields['DivisionID']."')";
		$result = $sql->db_Query($q);
	}
	function deleteDiv()
	{
		global $sql;
		$q = "DELETE FROM ".TBL_DIVISIONS
		." WHERE (".TBL_DIVISIONS.".DivisionID = '".$this->fields['DivisionID']."')";
		$result = $sql->db_Query($q);
	}
	function addMember($user, $notify)
	{
		global $sql;
		global $time;
		
		$div_id = $this->fields['DivisionID'];
		$game_id = $this->fields['Game'];
		
		$q = "SELECT ".TBL_USERS.".*"
		." FROM ".TBL_USERS
		." WHERE (".TBL_USERS.".user_id = '$user')";
		$result = $sql->db_Query($q);
		$Name  = mysql_result($result,0, TBL_USERS.".user_name");
		$UniqueGameID = "";
		$gamerID = updateGamer($user, $game_id, $Name, $UniqueGameID);
		
		$q = " INSERT INTO ".TBL_MEMBERS."(Division,User,timestamp)
		VALUES ($div_id,$user,$time)";
		$sql->db_Query($q);

		// User will automatically be signed up to all current events this division participates in
		$q_2 = "SELECT ".TBL_TEAMS.".*, "
		.TBL_EVENTS.".*"
		." FROM ".TBL_TEAMS.", "
		.TBL_EVENTS
		." WHERE (".TBL_TEAMS.".Division = '$div_id')"
		." AND (".TBL_TEAMS.".Event = ".TBL_EVENTS.".EventID)"
		." AND (".TBL_EVENTS.".Status != 'finished')";

		$result_2 = $sql->db_Query($q_2);
		$num_rows_2 = mysql_numrows($result_2);
		if($num_rows_2>0)
		{
			for($j=0; $j<$num_rows_2; $j++)
			{
				$event_id  = mysql_result($result_2,$j, TBL_EVENTS.".EventID");
				$event = new Event($event_id);

				$team_id = mysql_result($result_2,$j, TBL_TEAMS.".TeamID");
				$team_banned = mysql_result($result_2,$j, TBL_TEAMS.".Banned");

				// Verify there is no other player for that user/event/team
				$q = "SELECT COUNT(*) as NbrPlayers"
				." FROM ".TBL_PLAYERS
				." WHERE (Event = '$event_id')"
				." AND (Team = '$team_id')"
				." AND (User = ".USERID.")";
				$result = $sql->db_Query($q);
				$row = mysql_fetch_array($result);
				$nbrplayers = $row['NbrPlayers'];
				if ($nbrplayers == 0)
				{
					$q = " INSERT INTO ".TBL_PLAYERS."(Event,Gamer,Team,ELORanking,TS_mu,TS_sigma,G2_r,G2_RD,G2_sigma,Joined,Banned)
					VALUES ($event_id, $gamerID, $team_id, ".$event->getField('ELO_default').", ".$event->getField('TS_default_mu').", ".$event->getField('TS_default_sigma').",".$event->fields['G2_default_r'].",".$event->fields['G2_default_RD'].",".$event->fields['G2_default_sigma'].",$time, $team_banned)";
					$sql->db_Query($q);
					$event->setFieldDB('IsChanged', 1);
				}
			}
		}
		
		if ($notify)
		{
			list($cname, $ctag, $cid) = $this->getClanInfo();
			$sendto = $user;
			$subject = SITENAME." ".$cname;
			$message = EB_CLANM_L39.$username.EB_CLANM_L40.$cname.EB_CLANM_L41.EB_CLANM_L43;
			sendNotification($sendto, $subject, $message, $fromid=0);

			// Send email
			$message = EB_CLANM_L39.$username.EB_CLANM_L39.$cname.EB_CLANM_L42.SITEURLBASE.e_PLUGIN_ABS."ebattles/claninfo.php?clanid=".$cid.EB_CLANM_L43;
			require_once(e_HANDLER."mail.php");
			sendemail($useremail, $subject, $message);
		}
	}
	
	function getClanInfo()
	{
		global $sql;
		$clan = '';
		$clantag = '';
		$q = "SELECT ".TBL_CLANS.".*, "
		.TBL_DIVISIONS.".*"
		." FROM ".TBL_CLANS.", "
		.TBL_DIVISIONS
		." WHERE (".TBL_DIVISIONS.".DivisionID = '".$this->fields['DivisionID']."')"
		."   AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)";
		$result = $sql->db_Query($q);
		$num_rows = mysql_numrows($result);
		if ($num_rows == 1)
		{
			$clan_id  = mysql_result($result,0, TBL_CLANS.".ClanID");
			$clanname  = mysql_result($result,0, TBL_CLANS.".Name");
			$clantag  = mysql_result($result,0, TBL_CLANS.".Tag") ."&nbsp;";
		}
		return array($clanname, $clantag, $clan_id);
	}
}

function getClanInfo($teamID)
{
	global $sql;
	$clan = '';
	$clantag = '';
	$q = "SELECT ".TBL_CLANS.".*, "
	.TBL_DIVISIONS.".*, "
	.TBL_TEAMS.".* "
	." FROM ".TBL_CLANS.", "
	.TBL_DIVISIONS.", "
	.TBL_TEAMS
	." WHERE (".TBL_TEAMS.".TeamID = '$teamID')"
	."   AND (".TBL_DIVISIONS.".DivisionID = ".TBL_TEAMS.".Division)"
	."   AND (".TBL_CLANS.".ClanID = ".TBL_DIVISIONS.".Clan)";
	$result = $sql->db_Query($q);
	$num_rows = mysql_numrows($result);
	if ($num_rows == 1)
	{
		$clan_id  = mysql_result($result,0, TBL_CLANS.".ClanID");
		$clanname  = mysql_result($result,0, TBL_CLANS.".Name");
		$clantag  = mysql_result($result,0, TBL_CLANS.".Tag") ."&nbsp;";
	}
	return array($clanname, $clantag, $clan_id);
}

?>
