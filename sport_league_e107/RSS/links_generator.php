<?
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2006
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/league_teams.php
|		$Revision: 1.0 $
|		$Date: 2008/07/04 $
|		$Author: ***RuSsE*** $   
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");                                                                                       
require_once(HEADERF); 
require_once("../functionen.php");
$TEMLATES_SITE="http://www.neusserev-1b.org/page.php?12";
if (file_exists(e_PLUGIN."sport_league_e107/handler/Scroll_main15.js")){
echo "<script type='text/javascript' src='".e_PLUGIN."sport_league_e107/handler/Scroll_main15.js' language='JavaScript1.2'></script>";
} 


$text ="";
//$LOGO_X=$pref['sport_league_logo_w_menu'];
//$LOGO_Y=$pref['sport_league_logo_h_menu'];
$LOGO_X="70";
$LOGO_Y="70";
$TAX=$LOGO_X;
$COLS=2;
///////////////////////////////////
$expand_autohide = "display:none; ";    
if(e_QUERY)
	{
	list($Saison,$liga,$from) = explode(".", e_QUERY);
	$Saison = intval($Saison);
	$liga = intval($liga);
	$from = intval($from);
	unset($tmp);
	}
if(!$Saison)
	{
	$Saison=$pref['league_my_saison'];
	}
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_saison AS a 
   	LEFT JOIN ".MPREFIX."league_leagues AS ae ON ae.league_saison_id=a.saison_id   
   	WHERE a.saison_id='$Saison'
   			";
if($liga)
	{
	$qry1.=" AND ae.league_id='".$liga."'";	
	}
$text ="Hallo Besucher! Wenn du unnsere Liga-Daten bei sich auf deine Seite presentieren möchtest, kannst du es mit dem \"iframe\" machen beispiele sind <a href='beispiele.html'> >>HIER<< </a>.
				Was du brauchst dass ist der Link zu der Seit. Diesen kannst dir hier generieren lassen. Wähle einfach die benötigte daten und klicke auf den Button unten.
				Bitte beachte die Komentare zu einzelner Parameter und wähle die Daten richtig. so ist es nicht sinnvol eine Mannschaft aus eine Liga /Gruppe zu wähle aber gleichzeitig andere  Liga /Gruppe auswählen.
				Die Seiten die Momentann zu Verfügung stehnen sind: Spieltermiene, Ligatabelle und Team-Kader.<br/>
				Wenn du Informationen besitzt und möchte uns helfen die Daten aktuell zu halten (besonders Erfassung von Spielberichten, damit auch die Spieler-Statistik vollständig wird), dann melde dich bitte bei mir oder schreibe einfach im Forum.
				Jede Hilfe ist uns willkommen!!!
				";
$sql->db_Select_gen($qry1);
$saisoncount=0;
while($row = $sql-> db_Fetch())
	 		{
			$SAISONL[$saisoncount]['league_name']=$row['league_name'];
			$SAISONL[$saisoncount]['saison_name']=$row['saison_name'];
			$SAISONL[$saisoncount]['saison_id']=$row['saison_id'];
			$SAISONL[$saisoncount]['league_id']=$row['league_id'];
			$saisoncount++;
			}
$Ligalistvalue="";
for($i=0;$i < $saisoncount;$i++)
		{
		$Ligalistvalue.="".$SAISONL[$i]['league_id'].":".$SAISONL[$i]['league_name']."";
		if($i< $saisoncount-1)$Ligalistvalue.=",";
		}
///////////////////////////////////////////////////////////////
	  $qry1="
   	SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a 
   	LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id   
   	WHERE a.leagueteam_league_id='".$SAISONL[0]['league_id']."'";
for($i=1;$i < $saisoncount;$i++)
	{
	$qry1.=" OR a.leagueteam_league_id='".$SAISONL[$i]['league_id']."'";	
	}
$qry1.=" ORDER BY ae.team_name";
$sql->db_Select_gen($qry1);
$teamscount=0;
while($row = $sql-> db_Fetch())
	 		{
			$TEAMS[$teamscount]['leagueteam_id']=$row['leagueteam_id'];
			$TEAMS[$teamscount]['team_name']=$row['team_name'];
			$teamscount++;
			}
$teamlslistvalue="";
for($i=0;$i < $teamscount;$i++)
		{
		$teamlslistvalue.="".$TEAMS[$i]['leagueteam_id'].":".$TEAMS[$i]['team_name']."";
		if($i< $teamscount-1)$teamlslistvalue.="~";
		}

    $fieldcapt[0] = "Liga wählen";
    $fieldname[0] = "Liga";
    $fieldtype[0] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[0] = $Ligalistvalue;

    $fieldcapt[1] = "Team wählen<br/>Wenn man z.B. Alle Spiele der Liga ansehen möchte und nicht nur die Spiele Einer Mannschaft, dann bitte hier frei lassen!";
    $fieldname[1] = "TeamID";
    $fieldtype[1] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[1] = $teamlslistvalue;

    $fieldcapt[2] = "Template wählen<br/> <a href='".$TEMLATES_SITE."'>++HIER++</a> sind Beispiele, wie die einzelne Templates aussehen";
    $fieldname[2] = "Template";
    $fieldtype[2] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[2] = "4xa_003:4xa_003~4xA_011:4xA_011~4xA_026:4xA_026~4xa_027:4xA_027~MaW04:MaW04~MaW31:MaW31~MaW39:MaW39~MaW49:MaW49~vekna_blue:vekna_blue";

    $fieldcapt[3] = "Zu welche Seite verlinken";
    $fieldname[3] = "site";
    $fieldtype[3] = "dropdown2";  // pulldown menu from a db table.
    $fieldvalu[3] = "league_games.php:Spieltermiene~league_table.php:Ligatabelle~roster_table.php:Team-Kader";

require_once("../form_handler.php");
$rs = new form;


	$text .= "<div style=\"text-align:center\">\n";
	$text .= "<form method='post' action='".e_SELF."' id='generator'>
						<table class='fborder' style='margin-left:auto;margin-right:auto;width:100%'>
					<tr>
					<td style=\"width:50%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[3]." :</td>
					<td style=\"width:50%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[3] . "|" .$fieldtype[3]."|".$fieldvalu[3];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[3]],$fieldname[3]);
	$text .="</td></tr>
				<tr>
					<td style=\"width:50%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[0]." :</td>
					<td style=\"width:50%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[0] . "|" .$fieldtype[0]."|".$fieldvalu[0];
	$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[0]],$fieldname[0]);
	$text .="</td></tr><tr>
					<td style=\"width:50%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[1]." :</td>
					<td style=\"width:50%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[1] . "|" .$fieldtype[1]."|".$fieldvalu[1];
	$text .= $rs->  user_extended_element_edit($form_send,'',$fieldname[1]);
	$text .="</td></tr><tr>
					<td style=\"width:50%; vertical-align:top\" class=\"forumheader3\">".$fieldcapt[2]." :</td>
					<td style=\"width:50%\" class=\"forumheader3\">";
	$form_send = $fieldcapt[2] . "|" .$fieldtype[2]."|".$fieldvalu[2];
	$text .= $rs->  user_extended_element_edit($form_send,'',$fieldname[2]);
	$text .="</td></tr><tr>
					<td class='forumheader3' style='width:100%; text-align:center' colspan='2'><input class='button' type='submit' id='generat' name='generat' value='Link generiren' /></td></tr></table></form>";

if(isset($_POST['generat']))
	{
	$AUSGABE="Ausgabe. Einfach den Text unten kopieren und im HTML Code einsetzen<br/><textarea class='tbox' id='AUSGABE' name='AUSGABE'  cols='80'  style='width:90%;height:100px'><iframe height='800' width='100%' border='0' src='http://www.neusserev-1b.org/e107_plugins/sport_league_e107/RSS/".$_POST['site']."?Saison=".$_POST['Liga']."&Team=".$_POST['TeamID']."&Template=".$_POST['Template']."' scrolling='auto'></iframe></textarea>";	
	}
$text .="<br/><br/><br/>".$AUSGABE."<br/><br/><br/>";

$text .=powered_by();
$text .="</div>";
$title = "Links Generator";

$From="league_table.php?1.1";
$ns -> tablerender($title, $text);                                                                              
// ========= End of the BODY ===================================================                                                                                    
require_once(FOOTERF);     
?>

