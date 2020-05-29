<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/userlist.php
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
require_once("languages/".e_LANGUAGE.".php");
$Wtext="<div style='width:100%;text-align:center;'>";
if( $pref['4xa_wm_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['4xa_wm_acces_class'], USERID, TRUE))
	{	
///////////////////////////
//////////////////////////////////////////////////////////////
$Wtext.="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   				<tr>
						<td class='fcaption'>Mitglied</td>
						<td class='fcaption'>Punkte</td>
   				</tr>";

$qry="SELECT a.*, b.* FROM ".MPREFIX."user AS a
   		RIGHT JOIN ".MPREFIX."4xa_wm_tipp AS b ON b.t_userid=a.user_id
   		WHERE b.t_game!='' 
   		GROUP BY a.user_id 
   		ORDER BY a.user_name";
$sql->db_Select_gen($qry);
$counter=0;
$MY_FLAG=FALSE;

while($row = $sql-> db_Fetch())
		{
		$Wtext.="<tr>
							<td class='forumheader2'>";
		$Wtext.=$row['user_name'];
		$Wtext.="</td>
								<td class='forumheader'>";
		$Wtext.=get_my_all_points($row['user_id']);
		$Wtext.="</td></tr>";
		$counter++;
		}
$Wtext.="</table>";
///++++++++++++++++++++++++
 }
else{	
	$Wtext="<div style='text-align:center'><br /><br /><b>Sorry, Sie haben keinen zugriff!</b><br /><br /><br /></div>";
	} 

}
else
	{
	$Wtext="<div style='text-align:center'><br /><br /><b>Sorry, Ist nicht freigeschaltet!</b><br /><br /><br /></div>";
	}
$Wtext.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA-WM</a> v.0.5 ::.</font></div>";
$title= "Tipper- Liste";
$ns -> tablerender($title, $Wtext);
require_once(FOOTERF);
//////////////////////   Functionen   /////////////////////////////
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
{global $pref;
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
function get_my_all_points($user_id)
{
$MY_POINTS=0;$COUNT_Y_TIPPS=0;
$condown=300;
$timer= (time())+$condown;

$sqldat = new db;
$qry="SELECT a.*, b.*, c.*, d.*, e.*,f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
    	LEFT JOIN ".MPREFIX."4xa_wm_groups AS d ON d.group_id=a.group_pre
   		LEFT JOIN ".MPREFIX."4xa_wm_rounds AS e ON e.round_id=a.rounde
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.game_id!=0 AND a.timeof_game <'".$timer."' ORDER BY a.timeof_game";
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
$MY_T=get_mytipp($my_game[$i]['game_id'],$user_id);
if($MY_T){$COUNT_Y_TIPPS++;}

list($TH,$TG) = explode(":", $MY_T);
$MY_POINTS=$MY_POINTS+(get_my_points($my_game[$i]['goals_home'],$my_game[$i]['goals_guest'],$TH,$TG));
	}
return "Tipps angerechnet: ".$COUNT_Y_TIPPS." Points: ".$MY_POINTS;
}
?>
