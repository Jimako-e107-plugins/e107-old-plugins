<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_players_import.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_players_import_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_players_import_lan.php");

require_once("../functionen.php");

$pageid = "admin_player";

require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");

///////////////////////////////

if(isset($_POST['textinput']))
{$message="";
echo $_POST['player_data'];
			  $IMPORTPERSONEN = explode(";|",$_POST['player_data']);
				$PERSONEN_ANZ= count($IMPORTPERSONEN);
			if($PERSONEN_ANZ > 1)
				{
				$test_inhalt="";	
				for($i=0; $i < $PERSONEN_ANZ-1; $i++ )
					{
					$PERSON = explode(";",$IMPORTPERSONEN[$i]);
					$Team	= 		intval($PERSON[0]);/// Team
					$Status	= 	intval($PERSON[1]);/// Status
					$pos	= 		intval($PERSON[2]);/// pos
					$Jersey	= 	intval($PERSON[3]);/// Jersey
					$Burtsday	= $PERSON[4];/// Burtsday
					$Name	= 		$PERSON[5];/// Name
					
					if($Burtsday !=0 || $Burtsday!="" || $Burtsday !='0')
						{
						$DAT=explode(".",$Burtsday);
						$UNIXZEIT= mktime(0,0,0,$DAT[1],$DAT[0],$DAT[2]);
						$inputstr = "'".$Name."', '', '0', '0','', '".$UNIXZEIT."', ''"; 
						}
					else{$inputstr = "'".$Name."', '', '0', '0','', '0', ''"; }
					$message .= ($sql -> db_Insert("league_players", "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
					$message .="".$inputstr."<br/>";
					////Neuerstelle Person die ID hollen
					$sql -> db_Select("league_players", "players_id", "players_name='".$Name."' ORDER BY players_id DESC LIMIT 1");
					$row = $sql-> db_Fetch();
					$NEW_ID=$row['players_id'];					
					$sql -> db_Select("league_leagueteams", "*", "leagueteam_id='".$Team."' LIMIT 1");
					$row = $sql-> db_Fetch();
					$NEW_LIG_ID=$row['leagueteam_league_id'];
					////roster erstellen 
					if($pos==2 ||$pos==3)
						{
						$im_feld=1;
						}
					$inputstr = "'".$Name."', '".$NEW_LIG_ID."', '".$NEW_ID."', '".$Team."','".$Status."', '".$Jersey."', '".$im_feld."', '".$pos."', '', '', '', '', ''"; 
					$test_inhalt.=$inputstr."<br/>";
					
					$message .= ($sql -> db_Insert("league_roster", "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
					$message .="".$inputstr."<br/>";
				}
			$message= LAN_LEAGUE_PAYERS_IMPORT_ADMIN_2.($PERSONEN_ANZ-1)." ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_3."<br/>";
			
			
			   $qry1="
  		SELECT a.*, b.*, c.*, d.*, e.* FROM ".MPREFIX."league_roster AS a 
   		LEFT JOIN ".MPREFIX."league_players AS b ON b.players_id=a.roster_player_id
   		LEFT JOIN ".MPREFIX."league_leagueteams AS c ON c.leagueteam_id=a.roster_team_id
   		LEFT JOIN ".MPREFIX."league_teams AS d ON d.team_id=c.leagueteam_team_id
   		LEFT JOIN ".MPREFIX."league_leagues AS e ON e.league_id=c.leagueteam_league_id
  	 	WHERE a.roster_name!='0' ORDER BY a.roster_id DESC LIMIT ".($PERSONEN_ANZ-1)."
   		";
		$sql->db_Select_gen($qry1);
		while($row = $sql-> db_Fetch()){
        extract($row);
				$message.= $players_id."-".$players_name."(".(strftime("%D.%m.%Y",$players_burthday)).")".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_4."".$team_name."".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_5."".$league_name."<br/>";
					}
			}
		else{$message= LAN_LEAGUE_PAYERS_IMPORT_ADMIN_6;}
}
/////////////////////////////////////
if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}

$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";          
$text .= "<tr>
						<td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
	<div style='font-size:130%;color:#f00;font-weight:bold;background:#f99;padding:5px;border:2px #f66 solid;text-align:center;'>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_24."</div><br/><br/>
						
<font style='font-size:120%;color:#f66;font-weight:bold;'>1) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_7.":</font> <i>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_8."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>2) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_9.":</font> ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_10."<br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>3) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_11.":</font> ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_12."<br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>3) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_13.":</font> ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_14."<br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>5) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_15.":</font>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_16."<br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>6) ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_17.":</font> ".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_18."<br/><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>7)</font>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_25."<br/><br/>
<b>".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_19.":</b><br/>

".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_20."<br/><br/>
						</td>
						<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
								<form method='post' action='".e_SELF."' id='import_plaer'>
									<textarea name='player_data' cols='60' rows='20'></textarea>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:100%;'>
							<input class='button' type='submit' id='textinput' name='textinput' value='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_21."' />
								</form>
								<form method='post' action='admin_players.php' id='zur'>
										<input class='button'type='submit' id='zur' name='zur' value='".LAN_LEAGUE_PAYERS_IMPORT_ADMIN_23."'/><br/>
									</form>
								
						</td>		
					</tr>
</table><br/><br/><br/>
";
$configtitle =LAN_LEAGUE_PAYERS_IMPORT_ADMIN_22;
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>