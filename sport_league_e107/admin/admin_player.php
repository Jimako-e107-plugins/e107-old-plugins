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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_player.php$
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_player_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_player_lan.php");
require_once("../functionen.php");
$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_PAYERS_ADMIN_2."' src='".$ImageDELETE['PFAD']."'>";
$pageid = "admin_player";

require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message =delete_player($del_id);
}
/////////////////////
if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
$text = "<div style='text-align:center'><br/>";
$e=0;
$sql->db_Select("league_players", "*", "players_name LIKE '%".$tp->toDB($_POST['player_name'])."%' ORDER BY players_name");
while($row = $sql-> db_Fetch())
  	{
    $personenlist[]=$row;
    $e++;
		}
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";       
$text .= "<tr><td class='fcaption' style='text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<br/>".LAN_LEAGUE_PAYERS_ADMIN_3."<b>\"".$_POST['player_name']."\"</b><br/><br/>";
$text.= get_personenlist_wit_img($personenlist);
$text.= get_personenlist_no_img($personenlist);
if($e< 1)
{
$text.="<div style='text-align:center;color:#a00;'><b><img border='0' style='vertical-align: middle' title='' src='".e_PLUGIN."sport_league_e107/images/system/nocheck_12.png'>".LAN_LEAGUE_PAYERS_ADMIN_4."</b></div><br/><br/>";	
}
$text .= "</td></tr></table>";
$text .= "<br/><br/>";
$text .= "<form method='post' action='admin_players.php' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_PAYERS_ADMIN_1."' /></form>";
$text .= "<br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$configtitle="<b>".LAN_LEAGUE_PAYERS_ADMIN_5."</b>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
///////-----------------------------------------------
///////-----------------------------------------------
//////////////////////////////////////////////////////////
function  get_personenlist_wit_img($personenlist)
{
global $ImageDELETE;	
$AUSGABE="";
$personen_count=count($personenlist);


for($i=0; $i< $personen_count; $i++)
		{
		if($personenlist[$i]['players_image'] && $personenlist[$i]['players_image']!="default.jpg")
			{
			$sekond_ing=get_sek_img($personenlist[$i]['players_id']);
			$bg=get_personenlist_bg($personenlist[$i]['players_id']);
			$F_size = getimagesize("../fotos/".$personenlist[$i]['players_image']);
			$Im_size= "<b>".$F_size[0]."</b>x<b>".$F_size[1]."</b>px";
			$team_logo=get_one_teams_img($personenlist[$i]['players_id']);
			$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:70px;vertical-align:top;text-align:left;padding:3px;background:#AAA ".$bg.";margin:4px;'>
			<form method='post' action='".e_SELF."' id='editform_".$personenlist[$i]['players_id']."'>
			<input type='hidden' name='player_name' value='".$_POST['player_name']."'>
			<a target='_blank' href='admin_players.php?edit.".$personenlist[$i]['players_id']."'><img src='../fotos/".$personenlist[$i]['players_image']."' style='width:40px;float:left;margin:3px;'></a><b><a target='_blank' href='admin_players.php?edit.".$personenlist[$i]['players_id']."'>".$personenlist[$i]['players_name']."</a></b><br/>(".(chek_burtday($personenlist[$i]['players_burthday'], "%d.%m.%Y")).")<br/>".LAN_LEAGUE_PAYERS_ADMIN_6."<b>".$sekond_ing."</b><br/>".$Im_size." ".$team_logo."
			<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_7." [".$personenlist[$i]['players_name']."]')\"/>			
			</form>
			</div>";	
			}
		}
$AUSGABE.="";	
return $AUSGABE;	
}
//////////////////////////////////////////////////////////	
function  get_personenlist_no_img($personenlist)
{
global $ImageDELETE;	
$AUSGABE="";	
$personen_count=count($personenlist);
for($i=0; $i< $personen_count; $i++)
		{
		if(!$personenlist[$i]['players_image'] || $personenlist[$i]['players_image']=="default.jpg")
			{
			$team_logo=get_one_teams_img($personenlist[$i]['players_id']);
			$bg=get_personenlist_bg($personenlist[$i]['players_id']);	
			$AUSGABE.="<div class='fcaption' style='float:left;width:150px;height:70px;text-align:left;padding:3px;background:#AAA ".$bg.";margin:4px;'>
			<form method='post' action='".e_SELF."' id='editform_".$personenlist[$i]['players_id']."'>
			<input type='hidden' name='player_name' value='".$_POST['player_name']."'>
			<a href='admin_players.php?edit.".$personenlist[$i]['players_id']."'>".$personenlist[$i]['players_name']."</a><br/>(".(chek_burtday($personenlist[$i]['players_burthday'], "%d.%m.%Y")).")  ".$team_logo."
			<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$personenlist[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_PAYERS_ADMIN_7." [".$personenlist[$i]['players_name']."]')\"/>
			</form>
			</div>";	
			}
		}
$AUSGABE.="";	
return $AUSGABE;	
}
//////////////////////////////////////////////////////////	
//////////////////////////////////////////////////////////	
function get_roster_id($person)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   WHERE a.roster_player_id='".$person."' ORDER BY d.saison_order, c.league_id DESC
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
      $AUSGABE['id']=$row['roster_id'];
      $e++;
			}
$AUSGABE['count']=$e;
return   $AUSGABE;
}
////////////////////////////////////
function get_sek_img($id)
{
$pers_sek_img=0;
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' AND roster_image!=''");
	while($row = $sql-> db_Fetch()){
		$pers_sek_img++;
		}
return $pers_sek_img;	
}
//////////////////////////////////////
function get_pers_img_data($id)
{
$pers_sek_img="";
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' AND roster_image!=''");
	while($row = $sql-> db_Fetch()){
		$pers_sek_img.="<a target='_blank' href='admin_roster_config.php?edit.".$row['roster_id'].".".$row['roster_team_id']."' ><img src='../fotos/".$row['roster_image']."' style='width:20px;'></a>";
		}
return $pers_sek_img;	
}
//////////////////////////////////////
function get_saisons_teams_img($id)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.*, e.*, f.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   LEFT JOIN ".MPREFIX."league_teams AS e ON e.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_players AS f ON f.players_id=a.roster_player_id
   WHERE a.roster_player_id='".$id."' ORDER BY d.saison_order DESC, c.league_id
   		";
	$sql->db_Select_gen($qry1);
	$teamscount1=0;
	  while($row = $sql-> db_Fetch())
  		{
      $datas[$e]=$row;
      $e++;
			}
for($i=0; $i< $e; $i++)
{
$AUSGABE.="<a target='_blank' href='".$datas[$i]['team_url']."'><img border='0' style='vertical-align: middle' title='".$datas[$i]['league_name'].", ".$datas[$i]['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_8."".$datas[$i]['team_name']."' src='".e_PLUGIN."sport_league_e107/logos/".$datas[$i]['team_icon']."' width='30' /></a>";
}
return $AUSGABE;
}
//////////////////////////////////////
function get_one_teams_img($id)
{
global $sql;
$e=0;
   $qry1="
   SELECT a.*, b.*, c.*, d.*, e.*, f.* FROM ".MPREFIX."league_roster AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS b ON b.leagueteam_id=a.roster_team_id
   LEFT JOIN ".MPREFIX."league_leagues AS c ON c.league_id=b.leagueteam_league_id
   LEFT JOIN ".MPREFIX."league_saison AS d ON d.saison_id=c.league_saison_id
   LEFT JOIN ".MPREFIX."league_teams AS e ON e.team_id=b.leagueteam_team_id
   LEFT JOIN ".MPREFIX."league_players AS f ON f.players_id=a.roster_player_id
   WHERE a.roster_player_id='".$id."' ORDER BY d.saison_order DESC, c.league_id LIMIT 1
   		";
	$sql->db_Select_gen($qry1);
	$row = $sql-> db_Fetch();
$AUSGABE.="<a target='_blank' href='".$row['team_url']."'><img border='0' style='vertical-align: middle' title='".$row['league_name'].", ".$row['saison_name'].",".LAN_LEAGUE_PAYERS_ADMIN_8."".$row['team_name']."' src='".e_PLUGIN."sport_league_e107/logos/".$row['team_icon']."' width='30' /></a>";
return $AUSGABE;
}
//////////////////////
function chek_burtday($value, $format)
{
if(!$format){$format="%d.%m.%Y";}
if(!$value || $value==0 || $value=="-3600" || $value=="-1"){return "<span style='color:#f00;'>".LAN_LEAGUE_PAYERS_ADMIN_9."</span>";}
else{return "<span style='color:#006600;'>".(strftime($format,$value))."</span>";}
}
/////////////////////////////
function  get_personenlist_bg($id)
{
$pers_sek_img="";
global 	$sql;
$sql->db_Select("league_roster", "*", "roster_player_id='".$id."' ORDER BY roster_league_id LIMIT 1");
$row = $sql-> db_Fetch();

switch ($row['roster_position']) {
	case "1":
  return "url(../images/tw.jpg) no-repeat; background-position:right";
	break;
///-------
	case "2":
  return "url(../images/vt.jpg) no-repeat; background-position:right";
	break;
///-------
	case "3":
  return "url(../images/st.jpg) no-repeat; background-position:right";
	break;
///-------
	case "9":
  return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
///-------
	case "10":
   return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
///-------
	case "11":
   return "url(../images/tr.jpg) no-repeat; background-position:right";
	break;
	
	default:
  return " ";
	break;
	}
}
?>