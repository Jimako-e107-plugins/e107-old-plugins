<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v0.9 - by ***RuSsE*** (www.e107.4xA.de)
|	released 28.06.2011
|	sorce: ../../4xa_wm/groups.php
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
if (e_QUERY) {
	list($id_round,$id_group,$id_team) = explode(".", e_QUERY);
	$id_round = intval($id_round);
	$id_group = intval($id_group);
	$id_team = intval($id_team);
	unset($tmp);
}

$Pro_ZEILE=$pref['4xA_wm_coll'];

$sql -> db_Select($tablename, "*", "".$primaryid."='$id_group'");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
	$fcount_global++;
	}
// =================================================================

//////////////////////////////////////
if (isset($_POST['update_colls'])) {
	$pref['4xA_wm_coll']= $_POST['update_colls'];
  save_prefs();
	$message = LAN_4xA_SPORTTIPPS_047;
	$Pro_ZEILE=$pref['4xA_wm_coll'];
}
///////////////////////////////////////

//////////////////////////////////////////
$sql -> db_Select($tablename, "*", "".$primaryid."!=''");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
	$fcount_global++;
	}
/////////////============================
$text = "<link rel='stylesheet' href='".THEME."style.css' />\n
					<script type=\"text/javascript\" src=\"".e_PLUGIN."4xa_wm/wz_tooltip.js\"></script>";
$text .= "<div style='text-align:center'>";
$header_image=e_PLUGIN."4xa_wm/images/header.png";
$text.=(file_exists($header_image) ? "<img src='".$header_image."' border='0'/>" : "");
$text .= "
	<table style='width:100%' class='' cellspacing='10' cellpadding='10'>
		<tr>
 			<td style='padding:5px;text-align:left;'>
				<form method='post' action='".e_SELF."?".$id_round.".".$id_group."' id='list'>";
$cell_select = " ".LAN_4xA_SPORTTIPPS_035." <select name='update_colls' size='1' style='width:40px;text-align:right;vertical-align:top;' onChange='this.form.submit()'>";
for($i=1; $i < 6; $i++)
		{
		$cell_select.="<option ";
		if($i==$pref['4xA_wm_coll'])
			{
			$cell_select.="selected ";
			}
		$cell_select.="value='".$i."'>".$i."</option>";
		}
$cell_select.="</select>";

$text .=$cell_select."
 			</form>
 			<a href='tipps.php'>".LAN_4xA_SPORTTIPPS_197."</a>
 			<br/>
			<a href='gamelist.php'>".LAN_4xA_SPORTTIPPS_176."</a>
			 </td>			
				<td style='padding:5px;text-align:right;'>";
$text .= get_round_link();
$text .= "</td></tr></table> 
 <br/>";
$text .= create_WM_Rounds($id_group,$id_round);
$title=$pref['4xa_wm_cap'];
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA- Sporttipps </a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
$ns -> tablerender($title, $text);
require_once(FOOTERF);
//////////////////////   Functionen   /////////////////////////////
/////////////////////////
function create_WM_Rounds($rounde,$ROUND)
{
if($ROUND > 0)
	{$MYQUERY=" AND round_id='".$ROUND."'";}
if($ROUND == 777)
	{$MYQUERY=" AND round_typ='1'";}
if($ROUND == 888)
	{$MYQUERY=" AND round_typ='2'";}
global $sql,$Pro_ZEILE,$pref;
$AUSGABE ="<table style='width:100%' class='' cellspacing='10' cellpadding='10'><tr>";
$sql -> db_Select("4xa_wm_rounds", "*", "round_name!=''".$MYQUERY." order by round_order");
$R=0;$M=0;
    while($row = $sql-> db_Fetch())
		{
		$MY_ROWS[$R]=$row;
		$R++;
		}
		for($j=0; $j< $R; $j++)
			{
			if($M==$Pro_ZEILE)	
				{
				$AUSGABE.="</tr><tr>";
				$M=0;
				}
			$M++;
			$AUSGABE .="<td style='padding-bottom:20px;border-bottom:1px dashed #000;'>
				<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>	
					<tr>
						<td class='".$pref['4xa_wm_tablestyle10']."'>".$MY_ROWS[$j]['round_name']."</td>
						</tr>
						<tr>
						<td class='".$pref['4xa_wm_tablestyle11']."' style='background:transparent;vertical-align:top;'>";
			$AUSGABE .=create_WM_groups($MY_ROWS[$j]['round_id'],0,$ROUND);				
			$AUSGABE .="</td></td></table>";
			$AUSGABE .="</td>";
			}
	$AUSGABE .= "</tr></table>";
return $AUSGABE;
}
//////////////////////////////
function create_WM_groups($rounde,$Group,$RTYP)
{
global $ImageEDIT,$ImageDELETE,$id_group;
global $sql2, $pref;
$AUSGABE2 ="";
$WWC=0;
		if($RTYP==777)
			{
			$AUSGABE2 .="<table style='width:100%;' class='fborder' cellspacing='0' cellpadding='0'>
								<tr>";
			}
$sql2 -> db_Select("4xa_wm_groups", "*", "group_round_id='".$rounde."' order by group_order");
$R=0;
    while($row = $sql2-> db_Fetch())
		{$MY_ROWS[$R]=$row; $R++;$WWC++;
		if($row['group_id']==$Group){$style="style='background:#fbb'";}else{$style="";}
		if($RTYP==777)
			{
			$AUSGABE2 .="<td style='width:50%;padding:10px;vertical-align:top;'>";
			}
			$AUSGABE2 .="
							<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
								<tr>
									<td class='".$pref['4xa_wm_tablestyle12']."' ".$style.">".$row['group_name']."</td>
									</td>
								</tr>";							
			$AUSGABE2 .=create_WM_teamlist($row['group_round_id'],$row['group_id']);
			$AUSGABE2 .="</td>
								</tr></table><br/><br/>";
		if($RTYP==777)
			{
			$AUSGABE2 .="</td>";	
			if($WWC==2)
				{
				$AUSGABE2 .="</tr><tr>";
				$WWC=0;
				}
			}
		}
	if($RTYP==777)
		{
		$AUSGABE2 .="</table>";
		}	
return $AUSGABE2;
}
//////////////////////////////

function create_WM_teamlist($rounde,$Group)
{
global $ImageEDIT,$ImageDELETE,$id_group;
global $sql,$id,$id_group,$pref;
$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.group_id='".$Group."'";
$teamscount=0;   		
$sql->db_Select_gen($qry);
while($row2 = $sql-> db_Fetch())
		{
		$teamlist[$teamscount]=$row2;			
		if(!$row2['team_icon'])
			{
			$teamlist[$teamscount]['logo']="<img border='0' style='vertical-align: middle' title='' src='images/active.gif'\>";
			$teamlist[$teamscount]['name']=$row2['teams_virtual_name'];
			}
		else
			{
			$teamlist[$teamscount]['logo']="<img border='0' style='vertical-align: middle' title='' src='img_teams/".$row2['team_icon']."'\>";
			$teamlist[$teamscount]['name']=$row2['team_name'];
			}
		$teamscount++;	
		}	
			
for($i=0;  $i< $teamscount; $i++)			
		{
		$team_data=get_team_points($teamlist[$i]['teams_in_groups_id']);					
		$teamlist[$i]['team_points']=$team_data['P'];
		$teamlist[$i]['team_games']=$team_data['G'];
		$teamlist[$i]['team_MG']=$team_data['MG'];
		$teamlist[$i]['team_GG']=$team_data['GG'];
		$teamlist[$i]['team_D']=$team_data['D'];
		$teamlist=teams_sortieren($teamlist,'team_D');
		$teamlist=teams_sortieren($teamlist,'team_points');
		}
$total_games=0;
$sql -> db_Select("4xa_wm_games", "*", "group_pre='".$Group."' ORDER BY timeof_game");
while($row = $sql-> db_Fetch())
		{
		$total_games++;	
		}
if($total_games > 1)
	{
	$AUSGABE3 ="<tr>
								<td class='".$pref['4xa_wm_tablestyle13']."' ".$style." colspan='2'>
								".LAN_4xA_SPORTTIPPS_044."
								</td>
								</tr>
								<tr>
									<td class='".$pref['4xa_wm_tablestyle13']."' colspan='2'>";
	$AUSGABE3 .="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
	$AUSGABE3 .="<tr>
							<td class='".$pref['4xa_wm_tablestyle14']."' style='width:60%' colspan='2'>-/-</td>
							<td class='".$pref['4xa_wm_tablestyle14']."' style='width:5%;text-align:center;'>".LAN_4xA_SPORTTIPPS_187."</td>
							<td class='".$pref['4xa_wm_tablestyle14']."' style='width:15%;text-align:center;'>".LAN_4xA_SPORTTIPPS_188."</td>
							<td class='".$pref['4xa_wm_tablestyle14']."' style='width:15%;text-align:center;'>".LAN_4xA_SPORTTIPPS_189."</td>
							<td class='".$pref['4xa_wm_tablestyle14']."' style='width:5%;text-align:center;'>".LAN_4xA_SPORTTIPPS_190."</td>
						</tr>";	
	for($i=0; $i< $teamscount; $i++)			
		{
	$AUSGABE3 .="<tr>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:10%;text-align:center;'>".$teamlist[$i]['logo']."</td>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:50%'>".$teamlist[$i]['name']."</td>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:5%;text-align:center;'>".$teamlist[$i]['team_games']."</td>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:15%;text-align:center;'>".$teamlist[$i]['team_MG'].":".$teamlist[$i]['team_GG']."</td>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:15%;text-align:center;'>".$teamlist[$i]['team_D']."</td>
							<td class='".$pref['4xa_wm_tablestyle15']."' style='width:5%;text-align:center;'><b>".$teamlist[$i]['team_points']."</b></td>
						</tr>";
		}
	$AUSGABE3 .="</table>";
	$AUSGABE3 .="</td></tr><tr>
								<td class='".$pref['4xa_wm_tablestyle13']."' ".$style." colspan='2'>
									".LAN_4xA_SPORTTIPPS_043."
								</td></tr><tr>
								<td class='".$pref['4xa_wm_tablestyle14']."' colspan='2'>
								";
	$AUSGABE3 .=create_WM_gamelist($Group);
	}
else{
	$AUSGABE3 ="<tr>
								<td class='".$pref['4xa_wm_tablestyle14']."' ".$style." colspan='2'>
									";
	$AUSGABE3 .=create_WM_gamelist2($Group);
	}
return $AUSGABE3;
}
//////////////////////////////
function create_WM_gamelist($group)
{
	
global $pref;
$sqldat =& new db;
$qry="SELECT a.*, b.*, c.*, f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.group_pre='".$group."' ORDER BY a.timeof_game";   		
$sqldat->db_Select_gen($qry);
$counter=0;
while($row3 = $sqldat-> db_Fetch())
		{
		$my_game[$counter]=$row3;
		$counter++;
		}
for($i=0; $i < $counter; $i++)
		{
		$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.teams_in_groups_id='".$my_game[$i]['guest']."'LIMIT 1";   		
	$sqldat->db_Select_gen($qry);
	$row = $sqldat-> db_Fetch();
	$my_game[$i]['home_icon']=$my_game[$i]['team_icon'];
	$my_game[$i]['home_name']=$my_game[$i]['team_name'];
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
	$my_game[$i]['gast_virtual_name']=$row['teams_virtual_name'];
		}
for($i=0; $i < $counter; $i++)
		{
		if($my_game[$i]['team_icon']==''){$my_game[$i]['home_icon']="active.gif";}
		if($my_game[$i]['gast_icon']==''){$my_game[$i]['gast_icon']="active.gif";}
		$AUSGABE4.="<div class='".$pref['4xa_wm_tablestyle16']."'><img src='img_teams/".$my_game[$i]['home_icon']."' alt='' title='' border='0'>
									:
								<img src='img_teams/".$my_game[$i]['gast_icon']."' alt='' title='' border='0'>
								".strftime("%d.%m.%y (%H:%M)",$my_game[$i]['timeof_game'])."   ";
								
		$AUSGABE4.="<a href=\"".e_PLUGIN."4xa_wm/groups.php\" onmouseover=\"Tip('<table cellpadding=\'0\' cellspacing=\'0\'><tr><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tl.png) no-repeat;\'></td><td style=\'height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tc.png) repeat-x;\'></td><td style=\'width:17px;height:14px;background:transparent url(".e_PLUGIN."4xa_wm/images/tr.png) no-repeat;\'></td></tr><tr><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/bl.png) no-repeat;background-position:bottom;\'></td><td style=\'background:transparent url(".e_PLUGIN."4xa_wm/images/bc.png) repeat-x;background-position:bottom;padding-bottom:5px;\'><table style=\'width:100%;font-size:12px;\' class=\'\' cellspacing=\'0\' cellpadding=\'0\' border=\'0\'><tr><td style=\'padding:5px;text-align:right;\'><img src=\'".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['home_icon']."\' width=\'80\'></td><td style=\'text-align:center;font-size:150%;font-weight:bold;color:black;\'>".$my_game[$i]['goals_home']." : ".$my_game[$i]['goals_guest']."</td><td style=\'padding:5px;text-align:left;\'><img src=\'".e_PLUGIN."4xa_wm/img_teams/".$my_game[$i]['gast_icon']."\' width=\'80\'></td></tr><tr><td style=\'padding:5px;text-align:right;\'><font color=\'#800000\' size=\'3\'><b>".$my_game[$i]['home_name']."</b></font></td><td style=\'padding:5px;text-align:center;\'> V.S.</td><td style=\'padding:5px;text-align:left;\'><font size=\'3\' color=\'#000080\'><b>".$my_game[$i]['gast_name']."</b></font></td></tr><tr><td colspan=\'3\' style=\'padding:5px;text-align:left;color:black;\'><img src=\'".e_PLUGIN."4xa_wm/img_stations/".$my_game[$i]['stadion_icon']."\' alt=\'\' title=\'".$my_game[$i]['stadion_name']."\' border=\'0\' style=\'float:left; margin:5px 5px 10px 0px;color:black;\'>".LAN_4xA_SPORTTIPPS_192."<b>".$my_game[$i]['stadion_name']."</b><br/><b>".$my_game[$i]['stadion_ort']."</b><br/>".LAN_4xA_SPORTTIPPS_003." <b>".strftime("%a. %d %b. %Y",$my_game[$i]['timeof_game'])."</b><br/>".LAN_4xA_SPORTTIPPS_004." <b>".strftime("%H:%M",$my_game[$i]['timeof_game'])."</b> ".LAN_4xA_SPORTTIPPS_005."<br/><br/><br/></td></tr></table></td><td style=\'width:17px;background:transparent url(".e_PLUGIN."4xa_wm/images/br.png) no-repeat;background-position:bottom;\'></td></tr></table>')\" onmouseout=\"UnTip()\"><b>".$my_game[$i]['goals_home']." : ".$my_game[$i]['goals_guest']."</b></a>";
								
		$AUSGABE4.="	</div>";	
		}

return $AUSGABE4;
}
//////////////////////////////
function create_WM_gamelist2($group)
{
global $pref;
$sqldat =& new db;
$qry="SELECT a.*, b.*, c.*, f.* FROM ".MPREFIX."4xa_wm_games AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams_in_groups AS b ON b.teams_in_groups_id=a.home
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS c ON c.team_id=b.team_id
   		LEFT JOIN ".MPREFIX."4xa_wm_stadions AS f ON f.stadion_id=a.stadion
   		WHERE a.group_pre='".$group."' ORDER BY a.timeof_game";   		
$sqldat->db_Select_gen($qry);
$counter=0;
while($row3 = $sqldat-> db_Fetch())
		{
		$my_game[$counter]=$row3;
		$counter++;
		}
for($i=0; $i < $counter; $i++)
		{
		$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.teams_in_groups_id='".$my_game[$i]['guest']."'LIMIT 1";   		
	$sqldat->db_Select_gen($qry);
	$row = $sqldat-> db_Fetch();
	$my_game[$i]['home_icon']=$my_game[$i]['team_icon'];
	$my_game[$i]['home_name']=$my_game[$i]['team_name'];
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
	$my_game[$i]['gast_virtual_name']=$row['teams_virtual_name'];
		}
for($i=0; $i < $counter; $i++)
		{
		if($my_game[$i]['home_icon']==''){$my_game[$i]['home_icon']="active.gif";$my_game[$i]['home_name']=$my_game[$i]['teams_virtual_name'];}
		if($my_game[$i]['gast_icon']==''){$my_game[$i]['gast_icon']="active.gif";$my_game[$i]['gast_name']=$my_game[$i]['gast_virtual_name'];}
		$AUSGABE4.="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
										<tr>
											<td  class='".$pref['4xa_wm_tablestyle16']."' colspan='3'>
												".strftime("".LAN_4xA_SPORTTIPPS_003." %A.%d.%m.%y ".LAN_4xA_SPORTTIPPS_004." %H:%M",$my_game[$i]['timeof_game'])."
											</td>
										</tr>
										<tr>
											<td class='".$pref['4xa_wm_tablestyle16']."' style='width:10%;text-align:center;'>
											<img src='img_teams/".$my_game[$i]['home_icon']."' alt='' title='' border='0'>
											</td>
											<td class='".$pref['4xa_wm_tablestyle16']."'>
												".$my_game[$i]['home_name']."
											</td>
											<td class='".$pref['4xa_wm_tablestyle16']."' style='width:10%;text-align:center;'>
												".$my_game[$i]['goals_home']."
											</td>
										</tr>
										<tr>
											<td class='".$pref['4xa_wm_tablestyle16']."' style='width:10%;text-align:center;'>
											<img src='img_teams/".$my_game[$i]['gast_icon']."' alt='' title='' border='0'>
											</td>
											<td class='".$pref['4xa_wm_tablestyle16']."'>
												".$my_game[$i]['gast_name']."
											</td>
											<td class='".$pref['4xa_wm_tablestyle16']."' style='width:10%;text-align:center;'>
												".$my_game[$i]['goals_guest']."
											</td>
										</tr>
									</table>";	
		}

return $AUSGABE4;
}
////////////////////////////////////////////////////////////////
function get_team_points($teamid)
{
$games['home']=0;
$games['goals_home']=0;
$games['Ggoals_home']=0;
$games['gast']=0;
$games['goals_gast']=0;
$games['Ggoals_gast']=0;
$games['home_win']=0;
$games['gast_win']=0;
$games['home_lost']=0;
$games['gast_lost']=0;
$games['home_un']=0;
$games['gast_un']=0;
$sqldat2 = new db;
$sqldat2 -> db_Select("4xa_wm_games", "*", "home='".$teamid."' AND timeof_game <'".(time())."' AND mode > '1'");
while($row = $sqldat2-> db_Fetch())
		{
		$games['home']++;
		$games['goals_home']=$games['goals_home']+$row['goals_home'];
		$games['Ggoals_home']=$games['Ggoals_home']+$row['goals_guest'];
		if($row['goals_home'] > $row['goals_guest'])
			{
			$games['home_win']++;
			}
		elseif($row['goals_home'] < $row['goals_guest'])
			{
			$games['home_lost']++;
			}
		else
			{
			$games['home_un']++;
			}
		}
//+++++++++++++++++++++++++++++++++++++++
$sqldat2 -> db_Select("4xa_wm_games", "*", "guest='".$teamid."' AND timeof_game <'".(time())."' AND mode > '1'");
while($row = $sqldat2-> db_Fetch())
		{
		$games['gast']++;
		$games['goals_gast']=$games['goals_gast']+$row['goals_guest'];
		$games['Ggoals_gast']=$games['Ggoals_gast']+$row['goals_home'];
		if($row['goals_home'] < $row['goals_guest'])
			{
			$games['gast_win']++;
			}
		elseif($row['goals_home'] > $row['goals_guest'])
			{
			$games['gast_lost']++;
			}
		else
			{
			$games['gast_un']++;
			}
		}
$games['total_games']=$games['home']+$games['gast'];
$games['total_win']=$games['home_win']+$games['gast_win'];
$games['total_lost']=$games['home_lost']+$games['gast_lost'];
$games['total_un']=$games['home_un']+$games['gast_un'];
$games['total_MG']=$games['goals_home']+$games['goals_gast'];
$games['total_GG']=$games['Ggoals_home']+$games['Ggoals_gast'];

$POINTS['P']=($games['total_win']*3)+($games['total_un']*1);
$POINTS['G']=$games['total_games'];
$POINTS['MG']=$games['total_MG'];
$POINTS['GG']=$games['total_GG'];
$POINTS['D']=$games['total_MG']-$games['total_GG'];
return $POINTS;
}
///////////////////////////////////////////////////////////
function teams_sortieren($teamlist,$field)
{
$countT=count($teamlist);
for($i=0; $i< ($countT-1);$i++)
	{
	for($j=$i; $j< $countT;$j++)
		{
			if($teamlist[$i][$field] < $teamlist[$j][$field])
				{
					$temp=$teamlist[$i];
					$teamlist[$i]=$teamlist[$j];
					$teamlist[$j]=$temp;
				}
			else{
				continue;
			}
		}
	}
return $teamlist;
}
/////////////////////////////////////////////
function get_round_link()
{
global $sql2;
$AUSGABE3 ="";
$sql2 -> db_Select("4xa_wm_rounds", "*", "round_name!='' order by round_order");
$R=0;
    while($row = $sql2-> db_Fetch())
		{
		$AUSGABE3 .="<a href='".e_SELF."?".$row['round_id']."'>".LAN_4xA_SPORTTIPPS_184." ".$row['round_name']." ".LAN_4xA_SPORTTIPPS_185."</a><br/>";
		}
$AUSGABE3 .="<br/><a href='".e_SELF."?777'>".LAN_4xA_SPORTTIPPS_184." ".LAN_4xA_SPORTTIPPS_220." ".LAN_4xA_SPORTTIPPS_185."</a><br/>";
$AUSGABE3 .="			<a href='".e_SELF."?888'>".LAN_4xA_SPORTTIPPS_184." ".LAN_4xA_SPORTTIPPS_221." ".LAN_4xA_SPORTTIPPS_185."</a><br/>";
$AUSGABE3 .="<br/><a href='".e_SELF."?0'>".LAN_4xA_SPORTTIPPS_186."</a><br/>";
return $AUSGABE3;
}
?>
