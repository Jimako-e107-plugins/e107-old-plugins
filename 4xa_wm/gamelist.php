<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/gamelist.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(HEADERF);
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");
if( $pref['4xa_wm_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['4xa_wm_acces_class'], USERID, TRUE))
	{
if (e_QUERY) {
	list($id,$ud) = explode(".", e_QUERY);
	$id = intval($id);
	unset($tmp);
}
///////////////////////////
if(IsSet($_POST['set_tipp']))
{
	if($_POST['GAMES']>0){
	for($i=0; $i< $_POST['GAMES']; $i++)
		{
		$F_stat=	"GAMESTAT_".$i;
		if($_POST[$F_stat]==1)
			{
			continue;
			}		
		$F_bez=	"GAMEID_".$i;
		$F_bez2=	"goal_home_".$i;
		$F_bez3=	"goal_gast_".$i;
		$GAME=$_POST[$F_bez];
		$USER=USERID;
		$MY_TIP=get_mytipp($GAME,$USER);
		if(!$MY_TIP)
			{
			if($_POST["goal_home_".$i]!='x' && $_POST["goal_gast_".$i]!='x')	
				
			$inputstr ="'".$GAME."', '".$USER."', '".$_POST["goal_home_".$i].":".$_POST["goal_gast_".$i]."'";
			$message = ($sql -> db_Insert("4xa_wm_tipp", "0, ".$inputstr." ")) ? LAN_CREATED : LAN_CREATED_FAILED;
			}
		else{
				$updatestr="t_tipps = '".$_POST["goal_home_".$i].":".$_POST["goal_gast_".$i]."' WHERE t_game='".$GAME."' AND t_userid='".$USER."'";
				$message = ($sql -> db_Update("4xa_wm_tipp", $updatestr)) ? LAN_UPDATED: LAN_UPDATED_FAILED;
			}
		}
	}
}	

//////////////////////////////////////////////////////////////
if($id>0)
	{$MY_WERE="round_id='".$id."'";}
	else{$MY_WERE="round_id!='0'";}
if($id==777)
	{$MY_WERE="round_typ='1'";}
if($id==888)
	{$MY_WERE="round_typ='2'";}

	
$text="<div style='text-align:center'>";	
$header_image=e_PLUGIN."4xa_wm/images/header.png";
$text.=(file_exists($header_image) ? "<img src='".$header_image."' border='0'/>" : "");

$text.="<br/><br/><table style='width:100%' class='' cellspacing='0' cellpadding='0'>
   				<tr>
						<td style='background:transparent;border:0px;text-align:left;'>
							<a href='tipps.php'>".LAN_4xA_SPORTTIPPS_197."</a>
						</td>";
if($id > 0){$text.="<td style='background:transparent;border:0px;text-align:left;'>
								<a href='gamelist.php'>".LAN_4xA_SPORTTIPPS_222."</a>
								</td>";}
$text.="<td style='background:transparent;border:0px;text-align:right;'>
							<a href='groups.php'>".LAN_4xA_SPORTTIPPS_198."</a>
						</td>
					</tr>
				</table>";
///+++++++++++++++++++++++++
$sql -> db_Select("4xa_wm_rounds", "*", "".$MY_WERE." ORDER BY round_order");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
	$text.= creare_table($row['round_id'],$row['round_name'],$id);
	}
 }
else{
	
	$text="<br /><br /><b>".LAN_4xA_SPORTTIPPS_016."</b><br /><br /><br /></div>";
	} 

}
else
	{
	$text="<br /><br /><b>".LAN_4xA_SPORTTIPPS_017."</b><br /><br /><br /></div>";
	}

$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA-WM</a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";

$title=$pref['4xa_wm_cap'];
$ns -> tablerender($title, $text);
require_once(FOOTERF);
//////////////////////   Functionen   /////////////////////////////
function creare_table($id,$name,$only)
{
$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_002."' src='".$ImageEDIT['PFAD']."'>";
global $pref;
$condown=300;
$sqldat = new db;
$sqldat -> db_Select("4xa_wm_games", "*", "rounde='".$id."' ORDER BY timeof_game");
$fcount_global=0;
while($row = $sqldat-> db_Fetch())
  {
	$fcount_global++;
	}
$RET= "<div style=\"text-align:center\">
 <br/><form method='post' action='".e_SELF."?".$only."' id='table_$id'>
 <br/><b>".$name."</b><br/>
 	<div style='width:100%;text-align:center;'>
 		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
								<td class='".$pref['4xa_wm_tablestyle7']."'>".LAN_4xA_SPORTTIPPS_018."</td>
								<td class='".$pref['4xa_wm_tablestyle7']."'>".LAN_4xA_SPORTTIPPS_019."</td>
								<td class='".$pref['4xa_wm_tablestyle7']."' style='text-align:center;'>".LAN_4xA_SPORTTIPPS_020."</td>
								<td class='".$pref['4xa_wm_tablestyle7']."' style='text-align:center;'>".LAN_4xA_SPORTTIPPS_021."</td>
								<td class='".$pref['4xa_wm_tablestyle7']."' style='text-align:center;'>".LAN_4xA_SPORTTIPPS_006."</td>
   							</tr>";
if($fcount_global > 0)
  {
if($id!=0 && $from!=0){
	$MY_WERE="a.rounde='".$id."' AND a.group_pre='".$from."'";
	}
else{
$MY_WERE="game_id!='0'";
}
$qry="SELECT a.*, b.*, c.*, d.*, e.*,f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
    	LEFT JOIN ".MPREFIX."4xa_wm_groups AS d ON d.group_id=a.group_pre
   		LEFT JOIN ".MPREFIX."4xa_wm_rounds AS e ON e.round_id=a.rounde
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.rounde='".$id."' ORDER BY a.timeof_game";
$sqldat->db_Select_gen($qry);
$counter=0;
$MY_FLAG=FALSE;

while($row = $sqldat-> db_Fetch())
		{
		$my_game[$counter]=$row;
		$my_game[$counter]['home_tid']=$row['team_id'];
		$my_game[$counter]['home_name']=$row['team_name'];
		$my_game[$counter]['home_icon']=$row['team_icon'];
		if($row['team_id'] < 1)
			{
			$my_game[$counter]['home_name']=$row['teams_virtual_name'];
			$my_game[$counter]['home_icon']="active.gif";	
			}
		if(($my_game[$counter]['timeof_game']-$condown) > time()){$MY_FLAG=TRUE;}
		$counter++;
		}
for($i=0; $i < $counter; $i++)
		{
		$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.teams_in_groups_id='".$my_game[$i]['guest']."'LIMIT 1";   		
	$sqldat->db_Select_gen($qry);
	$row = $sqldat-> db_Fetch();

	if($row['team_id'] < 1)
		{
		$my_game[$i]['gast_name']=$row['teams_virtual_name'];
		$my_game[$i]['gast_icon']="active.gif";	
		continue;
		}
	else{
	$my_game[$i]['gast_tid']=$row['team_id'];
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
			}
	}
for($i=0; $i < $counter; $i++)
		{
		$RET.="<tr>
   				<td class='".$pref['4xa_wm_tablestyle8']."' width='100'>";
   				if(ADMIN){
   					$RET.="<a href='".e_PLUGIN."4xa_wm/admin/admin_games.php?edit.".$my_game[$i]['rounde'].".".$my_game[$i]['group_pre'].".".$my_game[$i]['game_id']."'>".$ImageEDIT['LINK']."</a>";
   					}
   			if(($my_game[$i]['timeof_game']-300) < time())
   			{$MATSH=1;}else{$MATSH=0;}
   			
   			$RET.="".strftime('%d.%m.%Y/%H:%M',$my_game[$i]['timeof_game'])."
   				</td>
					<td class='".$pref['4xa_wm_tablestyle8']."'>
					".$my_game[$i]['home_name']."
					<img src='img_teams/".$my_game[$i]['home_icon']."' alt='' title='' border='0'> v.s.
					<img src='img_teams/".$my_game[$i]['gast_icon']."' alt='' title='' border='0'>
					".$my_game[$i]['gast_name']."
					</td>
					<td class='".$pref['4xa_wm_tablestyle8']."' width='40' style='text-align:center;'>
					<input type='hidden' name='GAMEID_".$i."' value='".$my_game[$i]['game_id']."'>
					<input type='hidden' name='GAMESTAT_".$i."' value='".$MATSH."'>";
			if($my_game[$i]['mode']< 2 || ($my_game[$i]['timeof_game']+5400) > time())
				{
				$RET.="<b>?</b> : <b>?</b>";
				}						
			else{	
				$RET.="<b>".$my_game[$i]['goals_home']."</b> : <b>".$my_game[$i]['goals_guest']."</b>";
				}
			$RET.="</td>
					<td class='".$pref['4xa_wm_tablestyle8']."' width='110' style='text-align:center;'>";
		
		$MY_T=get_mytipp($my_game[$i]['game_id'],USERID);
		if(($my_game[$i]['timeof_game']-$condown) < time())
				{
				if($MY_T)
					{
						$RET.=$MY_T;
						list($TH,$TG) = explode(":", $MY_T);
					}
				else
					{
					$RET.=LAN_4xA_SPORTTIPPS_022;
					}
				
				}				
		else{
				if(!$MY_T)
						{
						$TH="x";$TG="x";
						}
				else{
						list($TH,$TG) = explode(":", $MY_T);
						}
					$RET.=get_list('goal_home_'.$i.'',$TH)." ".get_list('goal_gast_'.$i.'',$TG);
				}

				$RET.="</td><td class='".$pref['4xa_wm_tablestyle8']."' width='30' style='text-align:center;'>";
				if($my_game[$i]['mode']< 2 || ($my_game[$i]['timeof_game']+5400) > time())
					{
					$RET.="?";	
					}	
				else
					{
					$RET.=get_my_points($my_game[$i]['goals_home'],$my_game[$i]['goals_guest'],$TH,$TG);
					}			
   			$RET.="</td></tr>";
		}
	if($MY_FLAG)
			{
			$RET.="<tr>
							<td class='".$pref['4xa_wm_tablestyle9']."' width='100%' colspan='5' style='text-align:center;'>
								<input class='button' name='set_tipp' type='submit' value='".LAN_4xA_SPORTTIPPS_196."' />
							</td>
				 		</tr>";
			}
	
	}
else{
	$RET.="<tr><td class='".$pref['4xa_wm_tablestyle8']."' style='text-align:center' colspan='5'><br/><br/>".LAN_4xA_SPORTTIPPS_023."<br/><br/></td></tr>";
	}
$RET.= "</table></div><br/><input type='hidden' name='GAMES' value='".$counter."'></form>";
return $RET;
}
//////////////////////////////////
function get_list($Fild_name,$AA)
{
$ret ="<select class='tbox' style='width:40px'  name='".$Fild_name."'>";
for($i=0;$i< 20; $i++)
	{
$checked = ($AA == $i)? " selected='selected'" : "";
$ret .="<option value='".$i."' ".$checked." >".$i."</option>";
	}
$checked = ($AA == "x")? " selected='selected'" : "";
$ret .="<option value='x' ".$checked." >x</option>";
$ret .="</select>";
return $ret;
}
//////////////////////////////////
function get_mytipp($game_id,$user_id)
{
$sqldat2 = new db;
$sqldat2 -> db_Select("4xa_wm_tipp", "*", "t_userid='".$user_id."' AND t_game='".$game_id."' LIMIT 1");
$row2 = $sqldat2-> db_Fetch();
if($row2['t_userid']==0 ||$row2['t_userid']=='')
	{
	return false;
	}
return $row2['t_tipps'];
}
//////////////////////////////////
function get_my_points($home,$guest,$TH,$TG)
{
global $pref;

$points['voll']=$pref['4xa_wm_top_points'];
$points['dif']=$pref['4xa_wm_div_points'];
$points['tendenz']=$pref['4xa_wm_tendenz_points'];
$points['nite']=$pref['4xa_wm_niete_points'];


$MP=$points['nite'];

if($home > $guest && $TH > $TG)
	{
	$MP=$points['tendenz'];	
	if(($home - $guest) == ($TH-$TG))
			{
			$MP=$points['dif'];		
			if($home==$TH && $guest==$TG)
					{
					$MP=$points['voll'];	
					return $MP;
					}
			else return $MP;
			}
	else return $MP;
	}
elseif($home < $guest && $TH < $TG)
	{
	$MP=$points['tendenz'];	
	if(($home - $guest) == ($TH-$TG))
			{
			$MP=$points['dif'];		
			if($home==$TH && $guest==$TG)
					{
					$MP=$points['voll'];	
					return $MP;
					}
			else return $MP;
			}
	else return $MP;
	}
elseif($home == $guest && $TH == $TG && $TH!='x' && $TG!='x')
	{
	$MP=$points['voll'];	
	return $MP;	
	}
else return $MP;
}
///////////////////////////////
function benutzer_gruppe_pruefen($gruppe, $benutzer_ID,$typ)
{
if($gruppe==0){return true;}
elseif(!$gruppe ||$gruppe==255){return false;}
elseif($gruppe==252 && $benutzer_ID){return true;}
elseif($gruppe==254 || ($gruppe< 250 && $gruppe > 0))
	{
	global $sql, $tp;
 	$sql->db_Select("user", "*", "user_id ='".$benutzer_ID."'");
	if($row = $sql->db_Fetch())
		{
		if($gruppe==254 && $row['user_admin']==1){return true;}
		$u_Classes = explode(",", $row['user_class']);
		$count_class = count($u_Classes);
		for($i=0; $i < $count_class ; $i++)
			{$TESTT.= $u_Classes[$i];
			if($u_Classes[$i]==$gruppe){return $u_Classes[$i];}
			}
		}
	}
else{return false;}
return false;
}
//////////////////////////////////////////////////////////////////
?>
