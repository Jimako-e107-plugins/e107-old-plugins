<?php
/*
+---------------------------------------------------------------+
|     e107 website system
|    GNU General Public License (http://gnu.org).
|		
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
//if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(HEADERF);
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipp_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipp_lan.php");
$tablename="league_tipp_users";

/// Mein ID Hollen 
if(USER)
	{
	if(isset($_POST['submitit']))
		{
			if($_POST['einferstanden']=="on")
				{
				$sql -> db_Select("league_tipp_users", "*", "lique_users_user_id ='".$_POST['user_ids']."' LIMIT 1");				
				if(!$row = $sql-> db_Fetch())	
					{
					$inputstr = "'".$tp->toDB($_POST['user_ids'])."', '".$tp->toDB(time())."', '".$pref['league_tipp_user_acc']."'";
					$sql -> db_Insert($tablename, "0, ".$inputstr." ");
					benachritigung($_POST['user_ids']);
					}
				}
			else{$inputstr = LAN_LEAGUE_TIPP_13;}
	}	

	$table_total = $sql -> db_Select("league_tipp_users", "*", "lique_users_user_id ='".USERID."' ");	
//	$sql -> db_Select("league_tipps_users", "*", "lique_users_user_id ='".USERID."' ");		
	if($table_total)
 	{
  	//$MYID=$row['lique_users_user_id'];

		$text="<div style='text-align:center'>
						<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
								<td style='width:100%; text-align:cener; vertical-align:top; padding-right:5px;'>
									<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."e107_league_tipp/images/tippspiel_08-09.jpg'> 
								</td>
							</tr>	
							<tr>
								<td style='width:100%; text-align:right; vertical-align:top; padding-right:5px;'>
									<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
										<tr>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."e107_league_tipp/league_tipp_userlist.php' title='".LAN_LEAGUE_TIPP_12."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/user.png'>
												</a><br/>
												<a href='".e_PLUGIN."e107_league_tipp/league_tipp_userlist.php' title='".LAN_LEAGUE_TIPP_12."'>
													".LAN_LEAGUE_TIPP_12."
												</a>
											</td>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."e107_league_tipp/lique_tip.php' title='".LAN_LEAGUE_TIPP_8."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/abgabe.png'>
												</a><br/>
												<a href='".e_PLUGIN."e107_league_tipp/lique_tip.php' title='".LAN_LEAGUE_TIPP_8."'>
													".LAN_LEAGUE_TIPP_8."
												</a>
											</td>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."e107_league_tipp/lique_tip_table.php' title='".LAN_LEAGUE_TIPP_9."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/tabelle.png'>
												</a><br/>
												<a href='".e_PLUGIN."e107_league_tipp/lique_tip_table.php' title='".LAN_LEAGUE_TIPP_9."'>
													".LAN_LEAGUE_TIPP_9."
												</a>
											</td>
										</tr>
										<tr>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."e107_league_tipp/tip_regeln.php' title='".LAN_LEAGUE_TIPP_7."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/regeln.png'>
												</a><br/>
												<a href='".e_PLUGIN."e107_league_tipp/tip_regeln.php' title='".LAN_LEAGUE_TIPP_7."'>
													".LAN_LEAGUE_TIPP_7."
												</a>
											</td>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."sport_league_e107/league_table.php?Saison=".$pref['league_tipp_saison']."' title='".LAN_LEAGUE_TIPP_10."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/ligatable.png'>
												</a><br/>
												<a href='".e_PLUGIN."sport_league_e107/league_table.php?Saison=".$pref['league_tipp_saison']."' title='".LAN_LEAGUE_TIPP_10."'>
													".LAN_LEAGUE_TIPP_10."
												</a>
											</td>
											<td class='forumheader3' style='width: 33%; text-align:center; font-size:16px; vertical-align:top; font-weight:bold;'>
												<a href='".e_PLUGIN."sport_league_e107/league_games.php?Saison=".$pref['league_tipp_saison']."' title='".LAN_LEAGUE_TIPP_11."'>
													<img border='0' src='".e_PLUGIN."e107_league_tipp/images/termine.png'>
												</a><br/>
												<a href='".e_PLUGIN."sport_league_e107/league_games.php?Saison=".$pref['league_tipp_saison']."' title='".LAN_LEAGUE_TIPP_11."'>		
													".LAN_LEAGUE_TIPP_11."
												</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table></div>";
	$title=LAN_LEAGUE_TIPP_6;
	}
	else
	{
		$text="<div style='text-align:center'>
						<form method='post' action='".e_SELF."' id='by_tipp'>
						<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
						<td style='width:100%; text-align:center; vertical-align:top; padding-right:5px;' colspan='2'>
							<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."e107_league_tipp/images/tippspiel_08-09.jpg'> 
						</td>
						</tr>
						<tr>
						<td style='width:100%; text-align:center; vertical-align:top; padding-right:5px;' colspan='2'>
							".LAN_LEAGUE_TIPP_3."
						</td>
						</tr>
						<tr>
						<td style='width:50%; text-align:right; vertical-align:top; padding-right:5px;'>
							".LAN_LEAGUE_TIPP_5." <input  type='checkbox' name='einferstanden' id='einferstanden' value='on' />
						</td>
						<td style='width:50%; text-align:left; vertical-align:top; padding-right:5px;'>
								<input type='hidden' name='user_ids' value='".USERID."'>
								<input class='button' type='submit' name='submitit' value='".LAN_LEAGUE_TIPP_4."' />
						</td>
					</tr>
				</table>
					</form>
					<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>";
					
					$sql -> db_Select("league_tipp_users", "*", "");	
					 while($row = $sql-> db_Fetch()){
					
					$text.="<tr>
										<td>".$row['lique_users_id']."</td>
										<td>".$row['lique_users_user_id']."</td>
										<td>".strftime("%a. %d-%b-%Y %H:%M ",$row['lique_users_date'])."</td>
										<td>".$row['lique_users_status']."</td>
									<tr>";
				
					}
					
			$text.="</table></div>";
			$title = LAN_LEAGUE_TIPP_1;
	}
 }
else{

$text="<div style='text-align:center'>
					<table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
						<tr>
							<td style='width:100%; text-align:cener; vertical-align:top; padding-right:5px;'>
								<img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."e107_league_tipp/images/tippspiel_08-09.jpg'> 
							</td>
						</tr>
					</table>
				</div>";

$text.=LAN_LEAGUE_TIPP_2;
		$title =LAN_LEAGUE_TIPP_1;
		}
if(IsSet($message)){
		$ns -> tablerender("", "<div style=\"text-align:center\"><b>".$message."</b></div>");
}

$text.="<div style='text-align:center'>
					<br/><br/>
					<div class='smalltext' style='width:100%; text-align: center;'>:: Powered by <a target='_blank' href='http://www.e107.4xa.de' title='besuche mich'>e107 LIGA-TIPP</a> - Version 1.5 ::</div>
					<br/>
				</div>";

$ns -> tablerender($title, $text);
require_once(FOOTERF);
////////////////////////////////////////////////////////////////////
//
//
///////////////////////////////////////////////////////////////////
function benachritigung($ID)
{
$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipp_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipp_lan.php");
require_once(e_HANDLER."mail.php");

global 	$sql;

		$sql -> db_Select("user", "*", "user_id ='".$ID."' LIMIT 1");
		$row = $sql-> db_Fetch();
		$User['name']=$row['user_name'];
   	$User['mail']=$row['user_email'];
$message =LAN_LEAGUE_TIPP_15;
if($pref['league_tipp_user_acc']==2)
	{
	$message.="".LAN_LEAGUE_TIPP_16."".SITENAME."";	
	}
else{
		$send_to= ADMINEMAIL;
		$subject=LAN_LEAGUE_TIPP_14;
		$message2=LAN_LEAGUE_TIPP_19;
		$to_name="Admin";
		$send_from="".LAN_LEAGUE_TIPP_18."".SITENAME."";
		$from_name="System";
		sendemail($send_to, $subject, $message2, $to_name, $send_from, $from_name, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");
		$message.="".LAN_LEAGUE_TIPP_17."".SITENAME."";
		}

$send_to= $User['mail'];
$subject=LAN_LEAGUE_TIPP_14;
$to_name=$User['name'];
$send_from=SITENAME;
$from_name=ADMINNAME;
//// email an den user
sendemail($send_to, $subject, $message, $to_name, $send_from, $from_name, $attachments='', $Cc='', $Bcc='', $returnpath='', $returnreceipt='',$inline ="");

}
?>