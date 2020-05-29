<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/tipps.php
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

$text ="<script type=\"text/javascript\" src=\"".e_PLUGIN."4xa_wm/wz_tooltip.js\"></script>";
$text.="<div style='width:100%;text-align:center;'>";
if( $pref['4xa_wm_acces_class']!=255 )
{
if(ADMIN || benutzer_gruppe_pruefen($pref['4xa_wm_acces_class'], USERID, TRUE))
	{	//////////////////////////////////////////////////////////////
$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_002."' src='".$ImageEDIT['PFAD']."'>";

$COLLS=$pref['4xa_wm_games_count'];
$gametime=($pref['4xa_wm_gametime']*60);
if (e_QUERY) {
	list($site,$from) = explode(".", e_QUERY);
	$site = intval($site);
	unset($tmp);
}

//   +++++++++++++++++++  Aktuelle Seite fesstellen  +++++++++++++++++++
if($site==0)
{
$sqldat = new db;
$qry="SELECT a.*, b.*, c.*, d.*, e.*,f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
    	LEFT JOIN ".MPREFIX."4xa_wm_groups AS d ON d.group_id=a.group_pre
   		LEFT JOIN ".MPREFIX."4xa_wm_rounds AS e ON e.round_id=a.rounde
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.game_id!=0 ORDER BY a.timeof_game";
$sqldat->db_Select_gen($qry);
$counter=0;
$counter2=0;
while($row = $sqldat-> db_Fetch())
		{
		if($row['timeof_game'] < time())
			{
			$counter2++;continue;		
			}
		}
$site = $counter2 / $COLLS;
$site = intval($site);
}
else{
$site--;
}
//////////////////////////////  Datenbank- Abfrage 
$sqldat = new db;
$qry="SELECT a.*, b.*, c.*, d.*, e.*,f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
    	LEFT JOIN ".MPREFIX."4xa_wm_groups AS d ON d.group_id=a.group_pre
   		LEFT JOIN ".MPREFIX."4xa_wm_rounds AS e ON e.round_id=a.rounde
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.game_id!=0 ORDER BY a.timeof_game";
$sqldat->db_Select_gen($qry);
$counter=0;
$counter2=0;
while($row = $sqldat-> db_Fetch())
		{
		if($counter2 > (($COLLS)*($site+1)-1) || $counter2 < $COLLS*$site)
			{$counter2++;continue;}	
		$my_game[$counter]=$row;
		$my_game[$counter]['home_tid']=$row['team_id'];
		$my_game[$counter]['home_name']=$row['team_name'];
		$my_game[$counter]['home_icon']=$row['team_icon'];
		if($row['team_id'] < 1)
			{
			$my_game[$counter]['home_name']=$row['teams_virtual_name'];
			$my_game[$counter]['home_icon']="active.gif";	
			}
			
		if($row['mode']< 2 || $row['timeof_game']> (time()+$gametime))
			{
			$my_game[$counter]['goals_home']="X";
			$my_game[$counter]['goals_guest']="X";	
			}
		$counter++;$counter2++;
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

$A=($counter2 / $COLLS);
$B=round(($counter2 / $COLLS));

if($A > $B){$B++;}
$NAV_LINKS= "";
for($i=0; $i< $B; $i++)
	{
	if($i==$site)
		{
		$NAV_LINKS.= "[".($i+1)."]   ";		
		}
	else{
		$NAV_LINKS.="<a href='".e_SELF."?".($i+1)."'>".($i+1)."</a>   ";	
		}
	}
$header_image=e_PLUGIN."4xa_wm/images/header.png";
$text.=(file_exists($header_image) ? "<img src='".$header_image."' border='0'/><br/><br/>" : "");




$text.="<br/><br/><table style='width:100%' class='' cellspacing='0' cellpadding='0'>
   				<tr>
						<td style='background:transparent;border:0px;text-align:left;width:35%'>
							<a href='gamelist.php'>
							".LAN_4xA_SPORTTIPPS_176."
							</a>
						</td>
						<td style='background:transparent;border:0px;text-align:center;width:30%'>
							<a href='regeln.php'>
							".LAN_4xA_SPORTTIPPS_195."
							</a>
						</td>	
						<td style='background:transparent;border:0px;text-align:right;width:35%'>
						<a href='groups.php'>
						".LAN_4xA_SPORTTIPPS_198."
						</a>
						</td>
					</tr>
				</table><br/><br/>";
$text.=$NAV_LINKS;
$text.="<br/><br/>";
$text.="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";

$text.="<tr><td class='".$pref['4xa_wm_tablestyle1']."'>".LAN_4xA_SPORTTIPPS_001."</td>";
for($i=0; $i < $counter; $i++)
		{
		$text.="<td class='".$pref['4xa_wm_tablestyle1']."' style='text-align:center;'>";
		if(ADMIN){
   			$text.="<a href='".e_PLUGIN."4xa_wm/admin/admin_games.php?edit.".$my_game[$i]['rounde'].".".$my_game[$i]['group_pre'].".".$my_game[$i]['game_id']."'>".$ImageEDIT['LINK']."</a><br/>";
   			}		
		$text.="<img src='img_teams/".$my_game[$i]['home_icon']."' alt='' title='".$my_game[$i]['home_name']."' border='0'><br/>";
		$text.="-<br/><img src='img_teams/".$my_game[$i]['gast_icon']."' alt='' title='".$my_game[$i]['gast_name']."' border='0'><br/>";
						
		$text.="<a href=\"".e_PLUGIN."4xa_wm/groups.php\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."4xa_wm/images/bc.png) repeat-x;background-position:bottom;padding-bottom:5px;\'><table style=\'width:100%\' class=\'\' cellspacing=\'0\' cellpadding=\'0\' border=\'0\'><tr><td style=\'padding:5px;text-align:center;color:black;\' colspan=\'3\'>".$my_game[$i]['round_name']."-".$my_game[$i]['group_name']."</td></tr><tr><td style=\'padding:5px;text-align:right;\'><img src=\'".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['home_icon']."\' width=\'80\'></td><td style=\'text-align:center;font-size:150%;font-weight:bold;color:black;\'>".$my_game[$i]['goals_home']." : ".$my_game[$i]['goals_guest']."</td><td style=\'padding:5px;text-align:left;\'><img src=\'".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['gast_icon']."\' width=\'80\'></td></tr><tr><td style=\'padding:5px;text-align:right;\'><font color=\'#800000\' size=\'3\'><b>".$my_game[$i]['home_name']."</b></font></td><td style=\'padding:5px;text-align:center;\'> V.S.</td><td style=\'padding:5px;text-align:left;\'><font size=\'3\' color=\'#000080\'><b>".$my_game[$i]['gast_name']."</b></font></td></tr><tr><td colspan=\'3\' style=\'padding:5px;text-align:left;color:black;\'><img src=\'".e_PLUGIN."4xa_wm/img_stations/".$my_game[$i]['stadion_icon']."\' alt=\'\' title=\'".$my_game[$i]['stadion_name']."\' border=\'0\' style=\'float:left; margin:5px 5px 10px 0px;color:black;\'>".LAN_4xA_SPORTTIPPS_192."<b>".$my_game[$i]['stadion_name']."</b><br/><b>".$my_game[$i]['stadion_ort']."</b><br/>".LAN_4xA_SPORTTIPPS_003." <b>".strftime("%a. %d %b. %Y",$my_game[$i]['timeof_game'])."</b><br/>".LAN_4xA_SPORTTIPPS_004." <b>".strftime("%H:%M",$my_game[$i]['timeof_game'])."</b> ".LAN_4xA_SPORTTIPPS_005."<br/><br/><br/></td></tr></table></td><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"><b>".$my_game[$i]['goals_home']." : ".$my_game[$i]['goals_guest']."</b></a>";			
		$text.="</td>";
		}
$text.="<td class='".$pref['4xa_wm_tablestyle1']."'>".LAN_4xA_SPORTTIPPS_006."</td></tr>";
/*
$qry="SELECT a.*, b.*, c.* FROM ".MPREFIX."user AS a
   		RIGHT JOIN ".MPREFIX."4xa_wm_tipp AS b ON b.t_userid=a.user_id
   		RIGHT JOIN ".MPREFIX."user_extended AS c ON c.user_extended_id=a.user_id 
   		WHERE b.t_game!='' 
   		GROUP BY a.user_id 
   		ORDER BY a.user_name";
*/
$qry="SELECT a.*, b.* FROM ".MPREFIX."user AS a
   		RIGHT JOIN ".MPREFIX."4xa_wm_tipp AS b ON b.t_userid=a.user_id
   		WHERE b.t_game!='' 
   		GROUP BY a.user_id 
   		ORDER BY a.user_name";
$sql->db_Select_gen($qry);

$usercounter=0;
$MY_FLAG=FALSE;
while($row = $sql-> db_Fetch())
		{
		$user[$usercounter]=$row;
		$user[$usercounter]['points']=get_my_all_points($row['user_id']);	
		$usercounter++;
		}
$user=user_sortieren($user,"points");
$MY_STYLYS[0]=$pref['4xa_wm_niete_points_color'];
$MY_STYLYS[1]=$pref['4xa_wm_tendenz_color'];
$MY_STYLYS[2]=$pref['4xa_wm_div_points_color'];
$MY_STYLYS[3]=$pref['4xa_wm_top_points_color'];
$MY_STYLYS[4]=$pref['4xa_wm_verdeckt_field_color'];

for($j=0; $j < $usercounter; $j++)
		{
		$MY_POINTS=0;
		$fieldname="user_".$pref['4xa_wm_user_scype_field'];
		$text.="<tr><td class='".$pref['4xa_wm_tablestyle6']."'>";
		if($user[$j][$fieldname]!='')
			{
			$SCYPE=get_scype($user[$j][$fieldname]);
			}else{$SCYPE="";}
		$AVATAR=get_avatar($user[$j]['user_image']);
		$USER_ONLINE=online_status($user[$j]['user_id'].".".$user[$j]['user_name']);
		$text.="<a href=\"../../user.php?id.".$user[$j]['user_id']."\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."4xa_wm/images/bc.png) repeat-x;background-position:bottom;padding-bottom:6px;color:black;\'>".$AVATAR." <b>".$user[$j]['user_name']."</b><br/>".LAN_4xA_SPORTTIPPS_193."<b>".$user[$j]['points']."</b><br/>".LAN_4xA_SPORTTIPPS_194."<br/><b>".(strftime("%a. %d.%B.%Y<br/>%H:%M",$user[$j]['user_lastvisit']))."</b><br/>".$SCYPE."  ".$USER_ONLINE."</td><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"><b>".$user[$j]['user_name']."</b></a>";
		$text.="</td>";
		for($i=0; $i < $counter; $i++)
				{
					$MY_T=get_mytipp($my_game[$i]['game_id'],$user[$j]['user_id']);
					if($MY_T)
						{
						if($my_game[$i]['goals_home']=="X")
							{
							$text.="<td class='".$pref['4xa_wm_tablestyle2']."' style='background:#".$pref['4xa_wm_verdeckt_field_color'].";text-align:center;center; color:#000;'>";
							$text.=LAN_4xA_SPORTTIPPS_008;
							$text.="</td>";
							continue;
							}
						else{
							list($TH,$TG) = explode(":", $MY_T);
							$MY_POINT=(get_my_points($my_game[$i]['goals_home'],$my_game[$i]['goals_guest'],$TH,$TG));
							$text.="<td class='".$pref['4xa_wm_tablestyle2']."' style='background:#".$MY_STYLYS[$MY_POINT].";text-align:center; color:#000;'>";
							$text.=$MY_T;
							$text.="</td>";
							$MY_POINTS=$MY_POINTS+$MY_POINT;
							continue;
							}
						}
					elseif($my_game[$i]['goals_home']!="X")
						{
						$text.="<td class='".$pref['4xa_wm_tablestyle2']."' style='background:#".$pref['4xa_wm_kA_field_color'].";text-align:center;center; color:#000;'>";
						$text.=LAN_4xA_SPORTTIPPS_007;
						$text.="</td>";
						continue;
						}
					else
						{
						$text.="<td class='".$pref['4xa_wm_tablestyle2']."' style='background:#".$pref['4xa_wm_xx_field_color'].";text-align:center;center; color:#000;'>";
						$text.=LAN_4xA_SPORTTIPPS_009;
						$text.="</td>";
						continue;
						}
				}
		$text.="<td class='".$pref['4xa_wm_tablestyle6']."'>";
		
		$text.=get_my_all_points($user[$j]['user_id']);	
		$text.="</td></tr>";
		}
$text.="</table><br/>";

$text.="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$MY_STYLYS[0].";text-align:center'>0
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_010."
				</td>
			</tr>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$MY_STYLYS[1].";text-align:center'>1
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_011."
				</td>
			</tr>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$MY_STYLYS[2].";text-align:center'>2
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_012."
				</td>
			</tr>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$MY_STYLYS[3].";text-align:center'>3
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_013."
				</td>
			</tr>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$MY_STYLYS[4].";width:40px;text-align:center'>".LAN_4xA_SPORTTIPPS_008."
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left;'>".LAN_4xA_SPORTTIPPS_014."
				</td>
			</tr>
			<tr>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$pref['4xa_wm_kA_field_color'].";text-align:center'>".LAN_4xA_SPORTTIPPS_007."
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_015."
				</td>
			</tr>
			<td class='".$pref['4xa_wm_tablestyle2']."' style='color:black;background:#".$pref['4xa_wm_xx_field_color'].";text-align:center'>".LAN_4xA_SPORTTIPPS_009."
				</td>
				<td class='".$pref['4xa_wm_tablestyle2']."' style='text-align:left'>".LAN_4xA_SPORTTIPPS_191."
				</td>
			</tr>
		</table>
		";

///++++++++++++++++++++++++
 }
else{	
	$text="<div style='text-align:center'><br /><br /><b>".LAN_4xA_SPORTTIPPS_016."</b><br /><br /><br /></div>";
	} 

}
else
	{
	$text="<div style='text-align:center'><br /><br /><b>".LAN_4xA_SPORTTIPPS_017."</b><br /><br /><br /></div>";
	}
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA-WM</a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
$title= "Tipper- Tabelle";
$ns -> tablerender($title, $text);
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
	$MP=$points['tendenz'];
		if($home==$TH  && $guest==$TG)
			{
			$MP=$points['voll'];
			}
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
global $pref;
$MY_POINTS=0;$COUNT_Y_TIPPS=0;
$condown=$pref['4xa_wm_timer'];
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
return $MY_POINTS;
}
/////////////////////////////////////
function get_my_tipp_per_gameid($user_id,$game_id)
{
	return false;
}
/////////////////////////////////////
function get_avatar($user_image)
{

if(!$user_image)
{
 return "<img src=\'".e_PLUGIN."4xa_wm/images/default_user.png\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>";
}
$tt=explode("http://", $user_image);
if($tt[1]!='')
	{
	return "<img src=\'".$user_image."\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>";
	}
$tt=explode("-upload-", $user_image);
if($tt[1]!='')
	{
	$user_image=e_FILE."public/avatars/".$tt[1];
	return (file_exists($user_image) ? "<img src=\'".$user_image."\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>" : "<img src=\'".e_PLUGIN."4xa_wm/images/default_user.png\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>");
	}
$user_image=e_IMAGE."avatars/".$user_image;
return (file_exists($user_image) ? "<img src=\'".$user_image."\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>" : "<img src=\'".e_PLUGIN."4xa_wm/images/default_user.png\' border=\'0\' width=\'80\' style=\'float:left; margin:5px 5px 10px 0px;\'/>");
}
/////////////////////////////////////
function get_scype($scype_name)
{
$skypeStatus = trim(file_get_contents("http://mystatus.skype.com/".$scype_name.".num"));
switch($skypeStatus)
	{
	case '2':
	  return "<img src=\'".e_PLUGIN."4xa_wm/images/scype_2.png\' border=\'0\'>";
	  break;
	case '3':
	  return "<img src=\'".e_PLUGIN."4xa_wm/images/scype_3.png\' border=\'0\'>.";
	  break;
	case '4':
	  return "<img src=\'".e_PLUGIN."4xa_wm/images/scype_4.png\' border=\'0\'>";
	  break;
	case '1':
	  return "<img src=\'".e_PLUGIN."4xa_wm/images/scype_1.png\' border=\'0\'>";
	  break;
	default:
		return "<img src=\'".e_PLUGIN."4xa_wm/images/scype_0.png\' border=\'0\'>";
	  break;
	}	
}
/////////////////////////////////////
function online_status($user)
{
global $sql;
	$mysql_result = mysql_query("SELECT * FROM ".MPREFIX."online WHERE online_user_id='".$user."'") or die(mysql_error());
  $mysql_row = mysql_fetch_array($mysql_result);

if ($mysql_row > 0)  {
	
	$online = "<img src=\'".e_PLUGIN."4xa_wm/images/onlineuser.gif\' title=\'\' alt=\'online\'  />";
    } else {
  $online = "<img src=\'".e_PLUGIN."4xa_wm/images/offlineuser.gif\' title=\'\' alt=\'offline\'  />";
}
return $online;
}
/////////////////////////////////////
function user_sortieren($userlist,$field)
{
$countT=count($userlist);
for($i=0; $i< ($countT-1);$i++)
	{
	for($j=$i; $j< $countT;$j++)
		{
			if($userlist[$i][$field] < $userlist[$j][$field])
				{
					$temp=$userlist[$i];
					$userlist[$i]=$userlist[$j];
					$userlist[$j]=$temp;
				}
			else{
				continue;
			}
		}
	}
return $userlist;
}
?>
