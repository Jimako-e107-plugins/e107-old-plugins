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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_games_import.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_games_import_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_games_import_lan.php");
require_once("../functionen.php");
$pageid = "admin_games";
require_once(e_ADMIN."auth.php");
require_once("../functionen.php");
///////////////////////////////
if(isset($_POST['textinput']))
{$message=""; $games_coun=0;$flag=false;
echo $_POST['games_data'];
			  $IMPORTGAMES = explode("|",$_POST['games_data']);
				$GAMES_ANZ= count($IMPORTGAMES);
			if($GAMES_ANZ > 1)
				{
				$test_inhalt="";	
				for($i=0; $i < $GAMES_ANZ-1; $i++ )
					{
					$GAMES = explode(";",$IMPORTGAMES[$i]);
					$Liga	=		intval($GAMES[0]);/// Team Home
					$Home	=		intval($GAMES[1]);/// Team Home
					$Gast	= 	intval($GAMES[2]);/// Team Gast		
					$Datum	= $GAMES[3];/// Datum   			Default 01.01.2011
					$Time	= 	$GAMES[4];/// Uhrzeit   		Default 20:00
					$Goal_H	= intval($GAMES[5]);/// Goal Home   	Default 0
					$Goal_G	= intval($GAMES[6]);/// Goal Gast   	Default 0
					$UNENT	= intval($GAMES[7]);/// Goal Home   	Default 0
					$GAME_END	= intval($GAMES[8]);/// Goal Gast  	Default 0

				if($Home < 1 || $Gast < 1)
					{$message.="<br/> Fehler!! ";continue;}
				else{					
					if($Datum !=0 || $Datum!="" || $Datum !='0')
						{
						$DAT=explode(".",$Datum);
						$TIM=explode(":",$Time);
						
						$UNIXZEIT= mktime($TIM[0],$TIM[1],0,$DAT[1],$DAT[0],$DAT[2]);
						$inputstr = "'".$Liga."', '', '".$UNIXZEIT."', '".$UNIXZEIT."','".$Home."', '".$Gast."', '".$Goal_H."', '".$Goal_G."', '".$UNENT."', '".$GAME_END."', '', '', '', '', '', '', '', ''"; 
						}
					else{$inputstr = "'".$Liga."', '', '0', '0','".$Home."', '".$Gast."', '".$Goal_H."', '".$Goal_G."', '".$UNENT."', '".$GAME_END."', '', '', '', '', '', '', '', ''";  }
					$flag= ($sql -> db_Insert("league_games", "0, ".$inputstr." ")) ? true : false;
					if($flag){$games_count++;}
				 	}
				}
			}
		else{$message= LAN_LEAGUE_GAMES_ADMIN_39;}
}
/////////////////////////////////////
if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";         
$text .= "<tr>
						<td style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
<div style='font-size:130%;color:#f00;font-weight:bold;background:#f99;padding:5px;border:2px #f66 solid;text-align:center;'>".LAN_LEAGUE_GAMES_ADMIN_62."</div><br/><br/>					
<font style='font-size:120%;color:#f66;font-weight:bold;'>1) ".LAN_LEAGUE_GAMES_ADMIN_40."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_41."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>2) ".LAN_LEAGUE_GAMES_ADMIN_42."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_43."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>3) ".LAN_LEAGUE_GAMES_ADMIN_44."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_45."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>4) ".LAN_LEAGUE_GAMES_ADMIN_46."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_47."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>5) ".LAN_LEAGUE_GAMES_ADMIN_48."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_49."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>6) ".LAN_LEAGUE_GAMES_ADMIN_50."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_51."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>7) ".LAN_LEAGUE_GAMES_ADMIN_52."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_53."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>8) ".LAN_LEAGUE_GAMES_ADMIN_54."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_55."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>9) ".LAN_LEAGUE_GAMES_ADMIN_56."</font> <i>".LAN_LEAGUE_GAMES_ADMIN_57."</i><br/>
<font style='font-size:120%;color:#f66;font-weight:bold;'>10)</font>".LAN_LEAGUE_GAMES_ADMIN_63."<br/><br/>
<b>".LAN_LEAGUE_GAMES_ADMIN_58.":</b><br/><br/>					
						</td>
						<td style='text-align:right;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:50%;'>
								<form method='post' action='".e_SELF."' id='import_plaer'>
									<textarea name='games_data' cols='60' rows='20'></textarea>
						</td>
					</tr>
					<tr>
						<td colspan='2' style='text-align:center;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;width:100%;'>
							<input class='button' type='submit' id='textinput' name='textinput' value='".LAN_LEAGUE_GAMES_ADMIN_59."' />
								</form>
								<form method='post' action='admin_games_config.php?list.".$_POST['ligaid']."' id='zur'>
										<input class='button'type='submit' id='zur' name='zur' value='".LAN_LEAGUE_GAMES_ADMIN_60."'/><br/>
									</form>
						</td>		
					</tr>
</table><br/><br/><br/>
";
$configtitle = LAN_LEAGUE_GAMES_ADMIN_61;
$text .= "<div style=\"text-align:center\"><br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>