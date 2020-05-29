<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        Â©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/admin_games_bath_del.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_games_bath_del_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_games_bath_del_lan.php");
require_once("../functionen.php");

if (e_QUERY) {
	list($LIGid, $GAM) = explode(".", e_QUERY);
	$LIGid = intval($LIGid);
	$GAM = intval($GAM);
	unset($tmp);
}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION ++++++++++++++++++++++
 $configtitle = LAN_LEAGUE_GAMES_ADMIN_1;
 $tablename = "league_games";   // becomes e107_user2 or yourprefix_user2.
 $pageid = "admin_games";  // unique name that matches the one used in admin_menu.php.
//---------------------------------------------------------------
require_once(e_ADMIN."auth.php");
require_once("../form_handler.php");
///////////////----------------------------------------------
////////////////// Datensatz Löschen ////////////////////////
if(isset($_POST['delete']))
{
$Anzahl=$_POST['count'];
for($i=0; $i< $Anzahl; $i++)
	{
	if($_POST['del_'.$i.'']!=""){
	$Game_ID=$_POST['del_'.$i.''];
   $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_id ='".$Game_ID."' LIMIT 1
   		";	
$sql->db_Select_gen($qry1);	
$row = $sql-> db_Fetch();
	 			{
	 			$GAME['game_id']=$row['game_id'];
	 			$GAME['game_home_id']=$row['game_home_id'];
	 			$GAME['game_gast_id']=$row['game_gast_id'];
	 			$GAME['game_home_name']=$row['team_name'];
	 			}
	$qry1="
  SELECT a.*, b.* FROM ".MPREFIX."league_leagueteams AS a
  LEFT JOIN ".MPREFIX."league_teams AS b ON b.team_id=a.leagueteam_team_id
  WHERE a.leagueteam_id ='".$GAME['game_gast_id']."' LIMIT 1
   			";
			$sql->db_Select_gen($qry1);
			$row = $sql-> db_Fetch();
			$GAME['game_gast_name']=$row['team_name'];
					
	$sql -> db_Delete("league_points", "points_game_id='".$Game_ID."'");
	$sql -> db_Delete("league_anw", "anw_game_id='".$Game_ID."'");
	echo ($sql -> db_Delete("league_games", "game_id='".$Game_ID."' ")) ? "Spiel (".$GAME['game_home_name']." v.s. ".$GAME['game_gast_name'].") wirde gelöscht" : "Spiel (".$GAME['game_home_name']." v.s. ".$GAME['game_gast_name'].") konnte nicht gelöscht werden";	
		}	
	}
}
///////////////////////////////////////////////////		
$text = "<div style='text-align:center'>";
///////////////////////////////////////////////////	
$text .= "
 <br/><form method='post' action='".e_SELF."?".$LIGid."' id='delll'>
 <br/><table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>";
$text .="<tr> 
	  <td class='fcaption' style='text-align:center; width:90px;'>".LAN_LEAGUE_GAMES_ADMIN_2."</td>
	  <td class='fcaption' style='text-align:center; width:30px;'>".LAN_LEAGUE_GAMES_ADMIN_3."</td>
	 	<td class='fcaption' style='text-align:left;'>".LAN_LEAGUE_GAMES_ADMIN_4."</td>
		<td class='fcaption' style='text-align:center; width:30px;'>".LAN_LEAGUE_GAMES_ADMIN_5."</td>
		 <td class='fcaption' style='text-align:center; width:30px;'>".LAN_LEAGUE_GAMES_ADMIN_6."</td>
		<td class='fcaption' style='text-align:center; width:20px;'>".LAN_LEAGUE_GAMES_ADMIN_7."</td>
	</tr>";

//////////////////////////  und dann einzelne Zeilenn ///////////////////////////////////////
   $qry1="
   SELECT a.*, ae.*, ab.* FROM ".MPREFIX."league_games AS a 
   LEFT JOIN ".MPREFIX."league_leagueteams AS ae ON ae.leagueteam_id=a.game_home_id
   LEFT JOIN ".MPREFIX."league_teams AS ab ON ab.team_id=ae.leagueteam_team_id
   WHERE a.game_league_id ='".$LIGid."' ORDER BY a.game_date
   		";
  		
   	$GAMES_DATAS_COUNT=0;	
		$sql->db_Select_gen($qry1);	
	 	while($row = $sql-> db_Fetch())
	 			{
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_id']=$row['game_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_date']=$row['game_date'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_time']=$row['game_time'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_id']=$row['game_home_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_gast_id']=$row['game_gast_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_goals_home']=$row['game_goals_home'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_goals_gast']=$row['game_goals_gast'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_un']=$row['game_un'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_enable']=$row['game_enable'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_description']=$row['game_description'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_news_id']=$row['game_news_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_name']=$row['team_name'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_kurzname']=$row['team_kurzname'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_admin_id']=$row['team_admin_id'];
	 			$GAMES_DATAS[$GAMES_DATAS_COUNT]['game_home_icon']=$row['team_icon'];
	 			$GAMES_DATAS_COUNT++;
	 			}
$aktTerm=0;
		for($i=0; $i < $GAMES_DATAS_COUNT ;$i++)
			{
		 $qry1="
   			SELECT a.*, ae.* FROM ".MPREFIX."league_leagueteams AS a
   			LEFT JOIN ".MPREFIX."league_teams AS ae ON ae.team_id=a.leagueteam_team_id
   			WHERE a.leagueteam_id ='".$GAMES_DATAS[$i]['game_gast_id']."'
   			";
			$sql->db_Select_gen($qry1);
			$row = $sql-> db_Fetch();
			$GAMES_DATAS[$i]['game_gast_name']=$row['team_name'];
	 		$GAMES_DATAS[$i]['game_gast_kurzname']=$row['team_kurzname'];
	 		$GAMES_DATAS[$i]['game_gast_admin_id']=$row['team_admin_id'];
	 		$GAMES_DATAS[$i]['game_gast_icon']=$row['team_icon'];
			$AKT_GAMES_DATAS[$aktTerm]=$GAMES_DATAS[$i];
			$aktTerm++;
			}
//////////////////////////////////   Aktuelle Termine
if($aktTerm > 0)
	{
		for($i=0; $i < $aktTerm ;$i++)
			{$TABLE_INDEX++;
			if($AKT_GAMES_DATAS[$i]['game_date'] < time()&&$AKT_GAMES_DATAS[$i]['game_enable']!='1')
				{$BGFARBE="#ff0000";}
			elseif($AKT_GAMES_DATAS[$i]['game_date'] < time()&&$AKT_GAMES_DATAS[$i]['game_enable']=='1'){$BGFARBE="#00ff00";}
			else{$BGFARBE="#ffff00";}
			
			$text .="<tr>";
			$text .="<td class='forumheader' style='text-align:center;'>".strftime("%a. %d.%b.%Y",$AKT_GAMES_DATAS[$i]['game_date'])."</td>";
			$text .="<td class='forumheader' style='text-align:center;'>".strftime("%H:%M",$AKT_GAMES_DATAS[$i]['game_date'])."";
			if($AKT_GAMES_DATAS[$i]['game_time']!=0)
				{$text .="<div style='color:#f00'>".$AKT_GAMES_DATAS[$i]['game_time']."</div>";}
			$text .="</td>";
			$text .="<td class='forumheader' style='text-align:center;'><img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_8."' src='".e_PLUGIN."sport_league_e107/logos/".$AKT_GAMES_DATAS[$i]['game_home_icon']."' height='15'> ".$AKT_GAMES_DATAS[$i]['game_home_name']." vs. ".$AKT_GAMES_DATAS[$i]['game_gast_name']." <img border='0' style='vertical-align: middle' title='".LAN_LEAGUE_GAMES_ADMIN_8."' src='".e_PLUGIN."sport_league_e107/logos/".$AKT_GAMES_DATAS[$i]['game_gast_icon']."' height='15'> </td>";
			$text .="<td class='forumheader' style='text-align:center;'><b>".$AKT_GAMES_DATAS[$i]['game_goals_home'].":".$AKT_GAMES_DATAS[$i]['game_goals_gast']."</b>";
			if($AKT_GAMES_DATAS[$i]['game_un'])
				{$text .=" n.P.";}

$text .="</td>";
$text .="<td class='forumheader3' style='text-align:center;background-color:".$BGFARBE."'>(".$TABLE_INDEX.")".$AKT_GAMES_DATAS[$i]['game_id']."</td>";
			$text .="<td class='forumheader' style='text-align:center;'>
			<input  type='checkbox' name='del_".$i."'  value='".$AKT_GAMES_DATAS[$i]['game_id']."' />
			<input type='hidden' name='id_".$i."' value='".$AKT_GAMES_DATAS[$i]['game_id']."'>
			</td></tr>";
      }
	}
else{
	$text .="<tr><td class='forumheader3' colspan='6' style='text-align:center;'>".LAN_LEAGUE_GAMES_ADMIN_9."</td></tr>";
	}
/////////////////////////////////
$text .="</table><br/><br/>
				<input type='hidden' name='count' value='".$i."'>
				<input class='button' type='submit' id='delete' name='delete' value='".LAN_LEAGUE_GAMES_ADMIN_10."'/>
</form>   
<form method='post' action='admin_games_config.php?list.".$LIGid."' id='back'>
<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAMES_ADMIN_10."'/>
</form>
";
 $text .= "<div style=\"text-align:center\"><br/><br/><br/>";
 $text.=powered_by();
 $text.="</div>";
$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
?>