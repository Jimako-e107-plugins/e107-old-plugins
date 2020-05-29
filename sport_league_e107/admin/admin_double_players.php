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
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_double_players.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/

require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }

$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_double_players_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_double_players_lan.php");

require_once("../functionen.php");

$ImageDELETE['PFAD']=e_PLUGIN."sport_league_e107/images/system/delete_32.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_2."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."sport_league_e107/images/system/edit_32.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_3."' src='".$ImageEDIT['PFAD']."'>";

$ImagePREW['PFAD']=e_PLUGIN."sport_league_e107/images/system/search_32.png";
$ImagePREW['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_1."' src='".$ImagePREW['PFAD']."'>";

$pageid = "admin_player";

if (e_QUERY) {
	list($action, $id, $id2) = explode(".", e_QUERY);
	$id = intval($id);
	$id2 = intval($id2);
	unset($tmp);
}
/////////////////////////////////////////////////
if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode("_", $tmp[0]);
	$message = ($sql -> db_Delete("league_players", "players_id='".$del_id."' ")) ? LAN_DELETED : LAN_DELETED_FAILED;
}
//////////////////////////////////
if($action=="abgleich")
{
	$sql -> db_Select("league_players", "*", "players_id='".$id."' LIMIT 1");
	$row1 = $sql-> db_Fetch();	
	$sql -> db_Select("league_players", "*", "players_id='".$id2."' LIMIT 1");
	$row2 = $sql-> db_Fetch();	
$flag=false;
$SQL_QUERY_TEXT ="";
if($row1['players_image']&& $row1['players_image']!="default.jpg" && !$row2['players_image'] || $row1['players_image']&& $row1['players_image']!="default.jpg" && $row2['players_image']=="default.jpg" )
	{$flag=true;
	$SQL_QUERY_TEXT .="players_image='".$row1['players_image']."'"; 	
	}
if($row1['players_burthday'] && !$row1['players_burthday'] && $row1['players_burthday']!="0")
	{ $flag=true;
	$SQL_QUERY_TEXT .=", players_burthday='".$row1['players_burthday']."'"; 	
	}
$message .=	($sql -> db_Update("league_roster", "roster_player_id=".$id2." WHERE roster_player_id='".$id."'"))? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_4:LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_5;	
if($flag)
	{
	$message .="<br/>";
	$message .=	($sql -> db_Update("league_players", "".$SQL_QUERY_TEXT." WHERE players_id='".$id2."'"))? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_6:LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_7;	
	}
$id=$id2;
}
///////////////////////////////////

require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
require_once("../functionen.php");

if(IsSet($message)){
		$ns -> tablerender("", "<div style='text-align:center'>".$message."</div>");
}
//////==============================================================
$pers[0]=get_person($id);
$weitere=get_moreperson($pers[0]['players_name'], $pers[0]['players_id']);
$count_weitere=count($weitere);
for($i=0;$i< $count_weitere; $i++)
	{
	$pers[$i+1]=$weitere[$i];
	}
//////==============================================================
$text = "<div style='text-align:center'><br/>";
$text .= "<table class='border' style='width:95%;text-align:center;padding:10px;margin:10px;'>";
$text .= "<tr>";
for($i=0;$i< $count_weitere+1; $i++)
	{
	
$text .="<td class='fcaption' style='width:".(round(100 /count($pers)))."%; vertical-align:top;text-align:left;padding:10px;margin:10px;background:#ccc;border:1px #444 solid;'>";
$text .= "<div style='float:right;width:100px;text-align:right;'>
					<form method='post' action='".e_SELF."?list.".$id."' id='editform_".$pers[$i]['players_id']."'>
								<input type='hidden' name='T_ID' value='".$pers[$i]['players_id']."'>
								<a href='admin_player_list.php?edit.".$pers[$i]['players_id']."'>".$ImageEDIT['LINK']."</a> |
								<input type=\"image\" title=\"".LAN_DELETE."\" name='delete[team_{$pers[$i]['players_id']}]' style=\"vertical-align: middle\" src=\"".$ImageDELETE['PFAD']."\" onclick=\"return jsconfirm('".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_8."[".$pers[$i]['players_id']."]')\"/>
								</form></div>
<h3><a href='admin_player_list.php?edit.".$pers[$i]['players_id']."'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_9." ".($i+1)."</a></h3>
";
if($i == $count_weitere){$text .=get_double_pers($pers[$i],$pers[$i-1],"r");}
else
	{
	$text .=get_double_pers($pers[$i],$pers[$i+1],"v");
	}
$text .= "</td>";

}
$text .= "</tr></table>";
$text .= "<div style='text-align:center;'><br/><br/>
					<form method='post' action='admin_players.php' id='back'>
					<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_10."' />
					</form>
					<br/><br/><br/>";
$text.=powered_by();
$text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
////////////////////////////////////////////////////////
function get_person($id)
{
global 	$sql;
$sql->db_Select("league_players", "*", "players_id='".$id."' LIMIT 1");	
return $row = $sql-> db_Fetch();
}
//////////////////////////////////////////////////////////
function get_moreperson($name, $id)
{
global 	$sql;
$sql->db_Select("league_players", "*", "players_name='".$name."' AND players_id!='".$id."'");
	while($row = $sql-> db_Fetch()){
		$personenlist[]=$row;
		}
return $personenlist; 
}
//////////////////////////////////////////////////////////
function get_double_list($double)
{
$countf =count($double);
$AUSGABE="";
for($i=0; $i< $countf; $i++ )
	{
	$tmp1=explode(";", $double[$i]['namens']);
	$tmp2=explode(";", $double[$i]['ids']);	
  $duplicate1=count($tmp1);
	for($k=0; $k< $duplicate1; $k++ )
			{
			$roster=get_roster_id($tmp2[$k]);
			$AUSGABE .="<a href='../profil.php?player_id=".$roster['id']."'>".$tmp2[$k]."-".$tmp1[$k]."</a> <i>(".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_11." <b>".$roster['count']."</b>x ".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_12.", ".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_13.":<b>".$roster['id'].")</b></i>, ";	
			}
	$AUSGABE .="<br/>";
	}
return $AUSGABE;
}
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
   WHERE a.roster_player_id='".$person."' ORDER BY d.saison_order, c.league_id
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
function get_double_pers($pers1,$pers2,$z)
{
global $tp;	
$AT=$tp->toHTML($pers1['players_description'], TRUE);
$desc=$tp->html_truncate($AT, 100,"...");
if($z=="v")
{
$AUSGABE="<table style='border:1px #000 solid;width:100%;'>
						<tr>
							<td rowspan='5' style='width:160px;'>
								<img src='../fotos/".$pers1['players_image']."' style='width:150px;height:150px;padding-right:5px;'>
							</td>
							<td style='border-bottom:1px #555 dashed;'>".$pers1['players_name']."
							</td>
							<td rowspan='5' style='border-left:1px #000 solid;width:20px;vertical-align:top; padding-top:50px;text-align:right; padding-right:10px;'>
								<a href='".e_SELF."?abgleich.".$pers1['players_id'].".".$pers2['players_id']."'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_33."' src='".e_PLUGIN."sport_league_e107/images/system/Left.png'></a>
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_14.":".(($pers1['players_burthday']==0)? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_15 : strftime("%d %B. %Y",$pers1['players_burthday']))."
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_16.":".(($pers1['players_description']=='')? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_15: $desc)."
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_17.": ".$pers1['players_id']."
							</td>
						</tr>
					</table>";
$AUSGABE.=get_saisonslist($pers1['players_id']);
}
else{
$AUSGABE="<table style='border:1px #000 solid;width:100%;'>
						<tr>
							<td rowspan='5' style='border-right:1px #000 solid;width:20px;vertical-align:top; padding-top:50px;text-align:left; padding-left:10px;'>
								<a href='".e_SELF."?abgleich.".$pers1['players_id'].".".$pers2['players_id']."'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_33."' src='".e_PLUGIN."sport_league_e107/images/system/Right.png'></a>
							</td>
							<td rowspan='5' style='width:160px;'>
								<img src='../fotos/".$pers1['players_image']."' style='width:150px;height:150px;padding-right:5px;'>
							</td>
							<td style='border-bottom:1px #555 dashed;'>".$pers1['players_name']."
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_14.":".(($pers1['players_burthday']==0)? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_15 : strftime("%d %B. %Y",$pers1['players_burthday']))."
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_16."".(($pers1['players_description']=='')? LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_15: $desc)."
							</td>
						</tr>
						<tr>	
							<td style='border-bottom:1px #555 dashed;'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_17.": ".$pers1['players_id']."
							</td>
						</tr>
					</table>";
$AUSGABE.=get_saisonslist($pers1['players_id']);


}			
return $AUSGABE;
}
//////////////////////////////////////
function get_saisonslist($id)
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
$AUSGABE="<table style='border:1px #000 solid;width:100%;'>";
for($i=0; $i< $e; $i++)
{
if(!$datas[$i]['roster_image'] || $datas[$i]['roster_image']=="")
{$datas[$i]['roster_image']=$datas[$i]['players_image'];}
if(!$datas[$i]['roster_image'] || $datas[$i]['roster_image']=="")
{$datas[$i]['roster_image']="default.jpg";}

$pos[1]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_18;
$pos[2]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_19;	
$pos[3]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_20;
$pos[4]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_21;
$pos[5]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_22;
$pos[6]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_23;
$pos[7]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_24;
$pos[8]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_25;
$pos[9]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_26;
$pos[10]=LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_27;
$AUSGABE.="<tr>	
							<td class='forumheader'>".$datas[$i]['saison_name']."<br/><a target='_blank' href='../league_teams.php?".$datas[$i]['league_id']."' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_28."'>".$datas[$i]['league_name']."</a>
							</td>
							<td class='forumheader'><a target='_blank' href='admin_roster_config.php?list.".$datas[$i]['leagueteam_id']."' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_29."'>".$datas[$i]['team_name']."</a><br/>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_30." ".$datas[$i]['roster_jersy']." ".$pos[($datas[$i]['roster_position'])]."
							</td>
							<td class='forumheader'>".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_31.":<a target='_blank' href='admin_roster_config.php?edit.".$datas[$i]['roster_id'].".".$datas[$i]['leagueteam_id']."' title='".LAN_LEAGUE_DOUBLE_PAYERS_ADMIN_32."'>".$datas[$i]['roster_id']."</a> <img src='../fotos/".$datas[$i]['roster_image']."' style='width:20px;margin:3px;'>
							</td>
						</tr>";
}
$AUSGABE.="</table>";
return $AUSGABE;
}
?>
