<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_groups.php
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
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}
require_once("../settings/settings_groupslist.php");
//require_once("../settings/settings_admen.php");
require_once(e_ADMIN."auth.php");
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");

$ImageDELETE['PFAD']=e_PLUGIN."4xa_wm/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_025."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_024."' src='".$ImageEDIT['PFAD']."'>";

if (e_QUERY) {
	list($action,$id_round,$id_group,$id_team) = explode(".", e_QUERY);
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
require_once("../form_handler.php");
$rs = new form;

//////////////////////////////////////
if (isset($_POST['update_colls'])) {
	$pref['4xA_wm_coll']= $_POST['update_colls'];
  save_prefs();
	$message = LAN_4xA_SPORTTIPPS_047;
	$Pro_ZEILE=$pref['4xA_wm_coll'];
}
///////////////////////////////////////
if(isset($_POST['sort']))
	{
	$sql -> db_Select($tablename, "*", $primaryid."=".$_POST['ID']." LIMIT 1");
	$row = $sql-> db_Fetch();
	$old_sort=$row[$sortfild];
	$message="";
	$sort_value= $_POST['sort'];
	
	if($old_sort < $sort_value)
		{	
		for($i=$old_sort; $i< ($sort_value+1);$i++)
			{
			$inputstr=$sortfild."='".($i-1)."'";
			$message .= ($sql -> db_Update($tablename, "$inputstr WHERE ".$sortfild."='".$i."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;	
			}
		$inputstr=$sortfild."='".$sort_value."'";	
		$message .= ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;
		}
	elseif($old_sort > $sort_value)
		{
		for($i=$sort_value;$i< $old_sort;$i++)
			{
			$inputstr=$sortfild."='".($i+1)."'";
			$message .= ($sql -> db_Update($tablename, "$inputstr WHERE ".$sortfild."='".$i."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;	
			}
		$inputstr=$sortfild."='".$sort_value."'";
		$message .= ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;	
		}		
	else{			
		$inputstr=$sortfild."='".$sort_value."'";
		$message .= ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['ID']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;
		}
	}
/////////////////////////   Gruppe Löschen   ///////////////////
if(isset($_POST['delete']))
	{
	$tmp = $_POST['delete'];
	list($delete, $del_id) = explode("_", $tmp);
	$del_id2=$_POST['ID'];
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id2."' ")) ? LAN_4xA_SPORTTIPPS_030 : LAN_4xA_SPORTTIPPS_031;
	}
///////////////////////Teams aus der Gruppe Löschen ////////////
if(isset($_POST['delete2']))
	{
	$tmp = $_POST['delete2'];
	list($delete, $del_id) = explode("_", $tmp);
	$del_id2=$_POST['ID'];
	$message = ($sql -> db_Delete("4xa_wm_teams_in_groups", "teams_in_groups_id='".$del_id2."' ")) ? LAN_4xA_SPORTTIPPS_030 : LAN_4xA_SPORTTIPPS_031;
	}
////////////////////// Neu in DB Schreiben ////////////////
if(isset($_POST['submitit']))
	{
	$count = count($fieldname);
	for ($i=0; $i<$count; $i++) 
		{	
		$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
		$inputstr .= ($i < ($count -1)) ? "," : "";
		};
	$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_4xA_SPORTTIPPS_028 : LAN_4xA_SPORTTIPPS_029;
	}
	
///////////Team in DB schreiben  //////////
if(isset($_POST['submititeam']))
	{
	$inputstr .= " '".$tp->toDB($_POST['teams_virtual_name'])."', '".$tp->toDB($_POST['team_id'])."',  '".$tp->toDB($_POST['group_id'])."'";
	$message = ($sql -> db_Insert("4xa_wm_teams_in_groups", "0, ".$inputstr." ")) ? LAN_4xA_SPORTTIPPS_028 : LAN_4xA_SPORTTIPPS_029;
	}
////////////  Gruppe im DB Aktualisieren /////////
if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
			{
			if ($fieldtype[$i]=="date" || $fieldtype[$i] == "datestamp")
				{
				$year = $fieldname[$i]."_year";
				$month = $fieldname[$i]."_month";
				$day = $fieldname[$i]."_day";
       			if($fieldtype[$i]=="date")
					{
					$inputstr .= " ".$fieldname[$i]." = '".$_POST[$year]."-".$_POST[$month]."-".$_POST[$day]."'";
					}
				else{
         		$inputstr .= " ".$fieldname[$i]." = '".mktime (0,0,0,$_POST[$month],$_POST[$day],$_POST[$year])."' ";
					}
				}
			elseif($fieldtype[$i]=="checkbox_multi")
				{
				$sql -> db_Select("e4xA_ugl_data", "*", "e4xA_ugl_caption!='' ORDER BY e4xA_ugl_sort ");
				$inputstr .= " ".$fieldname[$i]." = '";
				while($row = $sql-> db_Fetch())
					{
					if($_POST[$row['e4xA_ugl_caption']]=="on")
						{$inputstr .=$row['e4xA_param_id'];}
					$inputstr .= "~";
					}
				$inputstr .= "'";
				}
			else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;
		}
///////////////////Teams im DB aktualisieren  //////////////////////
if(IsSet($_POST['update_teams']))
		{
		$fieldcapt2[] = LAN_4xA_SPORTTIPPS_032;
    $fieldname2[] = "teams_virtual_name";
    $fieldtype2[] = "text";
    $fieldvalu2[] = "";

    $fieldcapt2[] = LAN_4xA_SPORTTIPPS_033;
    $fieldname2[] = "team_id";
    $fieldtype2[] = "table";
    $fieldvalu2[] = "4xa_wm_teams,team_id,team_name,team_name";

    $fieldcapt2[] = LAN_4xA_SPORTTIPPS_034;
    $fieldname2[] = "group_id";
    $fieldtype2[] = "table";
    $fieldvalu2[] = "4xa_wm_groups,group_id,group_name,group_name,".$id."";
    
		$count = count($fieldname2);
		for ($i=0; $i<$count; $i++) 
			{
			$inputstr .= " ".$fieldname2[$i]." = '".$tp->toDB($_POST[$fieldname2[$i]])."'";
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update("4xa_wm_teams_in_groups", "$inputstr WHERE teams_in_groups_id='".$_POST['teams_id']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027 ;
		}
///////////////Benachritigung anzeigen  ////////
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
//////////////////////////////////////////
$sql -> db_Select($tablename, "*", "".$primaryid."!=''");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
	$fcount_global++;
	}
/////////////============================
$text = "<div style='text-align:center'>
	<table style='width:100%' class='' cellspacing='10' cellpadding='10'>
		<tr>
			<td style='padding:10px;text-align:right;'>
 				<form method='post' action='admin_create_groups.php?new.0.".$id_group."' id='new'>
 					<input class='button' type='submit' id='NEW_GROUP_CREATE' name='NEW_GROUP_CREATE' value='".LAN_4xA_SPORTTIPPS_036."' />
 				</form>
 			</td>	
 			<td style='padding:10px;text-align:left;'>
				<form method='post' action='".e_SELF."?list.".$id_round.".".$id_group."' id='list'>";

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
 </form></td></tr></table>
 <br/> 
 <br/><b>".LAN_4xA_SPORTTIPPS_037."</b><br/>";
$text .= create_WM_Rounds($id_group,0);

$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA- Sporttipps </a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);
require_once(e_ADMIN."footer.php");
//////////////////////   Functionen   /////////////////////////////
function multickeck_create($table_data)
{
$AUSGABE="";
$AUS_DB= explode(",",$table_data);
$USER_DATA=explode("~",$table_data);
global $sql2;	
$sql2 -> db_Select($AUS_DB[0], "*", "".$AUS_DB[2]."!='' ORDER BY ".$AUS_DB[3]." ");
$par_count =0;
while($row = $sql2-> db_Fetch())
	{
	$AUSGABE.="<input type='checkbox' name='".$row[$AUS_DB[2]]."' ";
	$AUSGABE.=" > ".$row[$AUS_DB[2]]."<br/>";
	}
return $AUSGABE;
}
////////////////////
function get_sort_box($index, $count, $box_name)
{
$Ausgabe="<select class='tbox' name='".$box_name."' style='width:40px;' onChange='this.form.submit()'>";
for($i=1; $i < $count+1; $i++)
	{
	$Ausgabe .="<option value='".$i."' ".(($i==$index) ?" selected='selected'":"").">".$i."</option>";
	} 
$Ausgabe .="</select>";
return $Ausgabe;
}
/////////////////////////
function create_WM_Rounds($rounde,$Group)
{
global $sql,$Pro_ZEILE;
$AUSGABE ="<br/><br/><table style='width:100%' class='' cellspacing='10' cellpadding='10'><tr>";
$sql -> db_Select("4xa_wm_rounds", "*", "round_name!='' order by round_order");
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
						<td class='fcaption'>".$MY_ROWS[$j]['round_name']."</td>
						</tr>
						<tr>
						<td class='forumheader3'>";
			$AUSGABE .=create_WM_groups($MY_ROWS[$j]['round_id'],0);				
			$AUSGABE .="</td></td></table>";
			$AUSGABE .="</td>";
			}
	$AUSGABE .= "</tr></table>";
return $AUSGABE;
}
//////////////////////////////
function create_WM_groups($rounde,$Group)
{
global $ImageEDIT,$ImageDELETE,$id_group;
global $sql2;
$AUSGABE2 ="";
$sql2 -> db_Select("4xa_wm_groups", "*", "group_round_id='".$rounde."' order by group_order");
$R=0;
    while($row = $sql2-> db_Fetch())
		{$MY_ROWS[$R]=$row; $R++;
		if($row['group_id']==$Group){$style="style='background:#fbb'";}else{$style="";}		
		$AUSGABE2 .="<br/><br/>
							<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
								<tr>
									<td class='fcaption' ".$style.">".$row['group_name']."</td>
									<td class='fcaption' ".$style.">
									<form method='post' action='".e_SELF."?".e_QUERY."' id='editform'>
															<input type='hidden' name='ID' value='".$row['group_id']."'>
															<input type='image' title='".LAN_DELETE."' name='delete[kat_{$row['group_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_SPORTTIPPS_041." [".$row['group_name']."] ".LAN_4xA_SPORTTIPPS_042."')\"/> | 
															<a href='".e_SELF."?edit.".$row['group_round_id'].".".$row['group_id']."'>".$ImageEDIT['LINK']."</a>|
															<a href='admin_create_teams.php?teams.".$row['group_round_id'].".".$row['group_id']."' style='text-decoration:none;'>
															<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_038."' src='../images/team_add.png'\>
															</a>|
															<a href='admin_games.php?list.".$row['group_round_id'].".".$row['group_id']."' style='text-decoration:none;'>
															<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_039."' src='../images/ical_symbol.png'\>
															</a>|
															<a href='admin_games.php?neu.".$row['group_round_id'].".".$row['group_id']."' style='text-decoration:none;'>
															<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_040."' src='../images/game_add.png'\>
															</a>
															</form>
									</td>
									</td>
								</tr>
								<tr>
								<td class='fcaption' ".$style." colspan='2'>
								".LAN_4xA_SPORTTIPPS_044."
								</td>
								</tr>
								<tr>
									<td class='forumheader3' colspan='2'>";								
	$AUSGABE2 .=create_WM_teamlist($row['group_round_id'],$row['group_id']);							
	$AUSGABE2 .="</td></tr><tr>
								<td class='fcaption' ".$style." colspan='2'>
									".LAN_4xA_SPORTTIPPS_043."
								</td></tr><tr>
								<td class='forumheader3' colspan='2'>
								";
$AUSGABE2 .=create_WM_gamelist($row['group_id']);									
$AUSGABE2 .="</td>
								</tr></table>
							";
		}
return $AUSGABE2;
}
//////////////////////////////

function create_WM_teamlist($rounde,$Group)
{
global $ImageEDIT,$ImageDELETE,$id_group;
global $sql,$id,$id_group;
$AUSGABE3 ="<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>";
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
			$teamlist[$teamscount]['logo']="<img border='0' style='vertical-align: middle' title='' src='../img_teams/active.gif'\>";
			$teamlist[$teamscount]['name']=$row2['teams_virtual_name'];
			}
		else
			{
			$teamlist[$teamscount]['logo']="<img border='0' style='vertical-align: middle' title='' src='../img_teams/".$row2['team_icon']."'\>";
			$teamlist[$teamscount]['name']=$row2['team_name'];
			}
		$teamscount++;	
		}	
			
for($i=0;  $i< $teamscount; $i++)			
		{
		$team_data=get_team_points($teamlist[$i]['teams_in_groups_id']);					
		$teamlist[$i]['team_points']=$team_data['P'];
		$teamlist[$i]['team_games']=$team_data['G'];
		$teamlist=teams_sortieren($teamlist,'team_points');
		}		
for($i=0; $i< $teamscount; $i++)			
		{	
$AUSGABE3 .="<tr>
							<td class='fcaption' style='width:10%'>".$teamlist[$i]['logo']."</td>
							<td class='fcaption' style='width:60%'>".$teamlist[$i]['name']." |".$teamlist[$i]['team_points']."|".$teamlist[$i]['team_games']."</td>
							<td class='fcaption' style='width:30%'>
								<form method='post' action='".e_SELF."?list.".$rounde.".".$Group.".".$teamlist[$i]['teams_in_groups_id']."' id='editform3'>
									<input type='hidden' name='ID' value='".$teamlist[$i]['teams_in_groups_id']."'>
									<input type='image' title='".LAN_DELETE."' name='delete2[kat_{$teamlist[$i]['teams_in_groups_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_SPORTTIPPS_045." [".$teamlist[$i]['name']."] ".LAN_4xA_SPORTTIPPS_046."')\"/>|
									<a href='admin_create_teams.php?edit_team.".$rounde.".".$Group.".".$teamlist[$i]['teams_in_groups_id']."'>".$ImageEDIT['LINK']."</a>
								</form><br/>";
$AUSGABE3 .="</td>
						</tr>";
		}
$AUSGABE3 .="</table>";		
return $AUSGABE3;
}
//////////////////////////////
function create_WM_gamelist($group)
{
$STATUS_COLOR[0]="#fff";
$STATUS_COLOR[1]="#ffcb00";
$STATUS_COLOR[2]="#fffa00";
$STATUS_COLOR[3]="#00f200";
$STATUS_COLOR[4]="#ff8888";
$STATUS_COLOR[5]="#f498ff";
$STATUS_COLOR[6]="#00cbff";
	
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
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
	$my_game[$i]['gast_virtual_name']=$row['teams_virtual_name'];
		}
for($i=0; $i < $counter; $i++)
		{
		if($my_game[$i]['team_icon']==''){$my_game[$i]['team_icon']="active.gif";}
		if($my_game[$i]['gast_icon']==''){$my_game[$i]['gast_icon']="active.gif";}
		if($my_game[$i]['mode']< 1 && ($my_game[$i]['timeof_game']-$condown) < time()){$my_game[$i]['mode']=4;}
		$AUSGABE4.="<div style='background:".$STATUS_COLOR[$my_game[$i]['mode']]."'><img src='../img_teams/".$my_game[$i]['team_icon']."' alt='' title='' border='0'>
									:
								<img src='../img_teams/".$my_game[$i]['gast_icon']."' alt='' title='' border='0'>
								".strftime("%d.%m.%y/%H:%M",$my_game[$i]['timeof_game'])."
								</div>";	
		}

return $AUSGABE4;
}
////////////////////////////////////////////////////////////////
function get_team_points($teamid)
{
$games['home']=0;
$games['gast']=0;
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
$POINTS['P']=($games['total_win']*3)+($games['total_un']*1);
$POINTS['G']=$games['total_games'];
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
?>
