<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_games.php
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
require_once("../settings/settings_games.php");
//require_once("../settings/settings_admen.php");
require_once(e_ADMIN."auth.php");
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");

$ImageDELETE['PFAD']=e_PLUGIN."4xa_wm/images/banlist_16.png";
$ImageDELETE['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_025."' src='".$ImageDELETE['PFAD']."'>";

$ImageEDIT['PFAD']=e_PLUGIN."4xa_wm/images/edit_16.png";
$ImageEDIT['LINK']="<img border='0' style='vertical-align: middle' title='".LAN_4xA_SPORTTIPPS_024."' src='".$ImageEDIT['PFAD']."'>";

if (e_QUERY) {
	list($action,$Rid,$Gid,$editid) = explode(".", e_QUERY);
	$Rid = intval($Rid);
	$Gid = intval($Gid);
	$editid = intval($editid);
	unset($tmp);
}

///////////////////////////////////////
$my_teams_list="";
if($Gid!=0){
$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.group_id='$Gid' ORDER BY b.team_name";   		
$sql->db_Select_gen($qry);
while($row = $sql-> db_Fetch())
		{
		$my_teams_list.=",".$row['teams_in_groups_id'].":".$row['team_name']."(".$row['teams_virtual_name'].")";
		}
	}
else{
$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE b.team_name!='' ORDER BY b.team_name";   		
$sql->db_Select_gen($qry);
while($row = $sql-> db_Fetch()){
		$my_teams_list.=",".$row['teams_in_groups_id'].":".$row['team_name']."(".$row['teams_virtual_name'].")";
		}
	}

// =================================================================
require_once("../form_handler.php");
$rs = new form;


if(isset($_POST['delete']))
	{
	$tmp = $_POST['delete'];
	list($delete, $del_id) = explode("_", $tmp);
	$del_id2=$_POST['ID'];
	$message = ($sql -> db_Delete($tablename, "$primaryid='".$del_id2."' ")) ? LAN_4xA_SPORTTIPPS_030 : LAN_4xA_SPORTTIPPS_031;
	}
////////////////////// Neu Erstellen ////////////////
if(isset($_POST['submitit']))
	{
	$count = count($fieldname);
	for ($i=0; $i<$count; $i++) 
		{
		if ($fieldtype[$i]=="caleder")
			{
			$dat_data=explode(" / ",$_POST[$fieldname[$i]]);
			$datum_ganz=$dat_data[0];
			$time_ganz=$dat_data[1];
			$datum_data=explode(".",$datum_ganz);
			$Jahr=$datum_data[2];$Monat=$datum_data[1];$Tag=$datum_data[0];
			$time_data=explode(":",$time_ganz);
			$Stunden=$time_data[0]; $Minuten=$time_data[1];
			$inputstr .= " '".mktime ($Stunden,$Minuten,0,$Monat,$Tag,$Jahr)."' ";				
			}	
		else{
			$inputstr .= " '".$tp->toDB($_POST[$fieldname[$i]])."'";
			}
		$inputstr .= ($i < ($count -1)) ? "," : "";
		};
	$message = ($sql -> db_Insert($tablename, "0, ".$inputstr." ")) ? LAN_4xA_SPORTTIPPS_028 : LAN_4xA_SPORTTIPPS_029;
	$message .=$inputstr ;
	}
	
///////////////////////////
/////////////////////
if(IsSet($_POST['update']))
		{
		$count = count($fieldname);
		for ($i=0; $i<$count; $i++) 
			{
		if ($fieldtype[$i]=="caleder")
			{
			$dat_data=explode(" / ",$_POST[$fieldname[$i]]);
			$datum_ganz=$dat_data[0];
			$time_ganz=$dat_data[1];
			$datum_data=explode(".",$datum_ganz);
			$Jahr=$datum_data[2];$Monat=$datum_data[1];$Tag=$datum_data[0];
			$time_data=explode(":",$time_ganz);
			$Stunden=$time_data[0]; $Minuten=$time_data[1];
			$inputstr .= " ".$fieldname[$i]." = '".mktime ($Stunden,$Minuten,0,$Monat,$Tag,$Jahr)."' ";				
			}
			else{
				$inputstr .= " ".$fieldname[$i]." = '".$tp->toDB($_POST[$fieldname[$i]])."'";
				}	
			$inputstr .= ($i < ($count -1)) ? "," : "";
			}
		$message = ($sql -> db_Update($tablename, "$inputstr WHERE $primaryid='".$_POST['table_id']."' ")) ? LAN_4xA_SPORTTIPPS_026: LAN_4xA_SPORTTIPPS_027;
		}
///////////////////////////////////////////////////////////////////
///////////////////////
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
if($action == "neu")
	{	
	$text = "<div style='text-align:center'>\n";
	$text .= "<form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='adminform_new'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>

		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[0]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[0] . "|" .$fieldtype[0]."|".$fieldvalu[0].",".$Rid;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[0]],$fieldname[0]);
		$text .= "	
			</td>
		</tr>

		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[1]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[1] . "|" .$fieldtype[1]."|".$fieldvalu[1].",".$Gid;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[1]],$fieldname[1]);
		$text .= "	
			</td>
		</tr>
		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[2]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[2] . "|" .$fieldtype[2]."|".$fieldvalu[2];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[2]],$fieldname[2]);
		$text .= "	
			</td>
		</tr>
		
		<tr>
			<td class='fcaption' style='width:47%; vertical-align:top; text-align:right'>".$fieldcapt[3]."</td>
			<td class='fcaption' style='width:6%; text-align:center'></td>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[4]."</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:47%; vertical-align:top; text-align:right'>";
		$form_send = $fieldcapt[3] . "|" .$fieldtype[3]."|".$my_teams_list;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[3]],$fieldname[3]);
		$text .= "</td>
			<td class='fcaption' style='width:6%; text-align:center'>v.s.</td>
				<td style='width:47%; vertical-align:top' class='forumheader3'>";
		$form_send = $fieldcapt[4] . "|" .$fieldtype[4]."|".$my_teams_list;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[4]],$fieldname[4]);
		$text .= "</td>
		</tr>		
		
		<tr>
			<td class='fcaption' style='width:47%; vertical-align:top; text-align:right'>".$fieldcapt[5]."</td>
			<td class='fcaption' style='width:6%; text-align:center'></td>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[6]."</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:47%; vertical-align:top; text-align:right'>";
		$form_send = $fieldcapt[5] . "|" .$fieldtype[5]."|".$fieldvalu[5];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[5]],$fieldname[5]);
		$text .= "</td>
			<td class='fcaption' style='width:6%; text-align:center'>:</td>
				<td style='width:47%; vertical-align:top' class='forumheader3'>";
		$form_send = $fieldcapt[6] . "|" .$fieldtype[6]."|".$fieldvalu[6];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[6]],$fieldname[6]);
		$text .= "</td>
		</tr>

		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[7]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[7] . "|" .$fieldtype[7]."|".$fieldvalu[7];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[7]],$fieldname[7]);
		$text .= "	
			</td>
		</tr>
		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[8]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[8] . "|" .$fieldtype[8]."|".$fieldvalu[8];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[8]],$fieldname[8]);
		$text .= "	
			</td>
		</tr>
		";
	$text .= "<tr><td colspan='3' class='forumheader' style='text-align:center'>
		<input class='button' type='submit' id='submitit' name='submitit' value='".LAN_4xA_SPORTTIPPS_048."' />
		</form><form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='back'><input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' /></form></td></tr></table></div>";
	
	$configtitle="<b>".LAN_4xA_SPORTTIPPS_051."</b>";
	}
/////////////////
elseif($action == "edit")
	{
	$sql -> db_Select($tablename, "*", " $primaryid='".$editid."' ");
	$row = $sql-> db_Fetch();
	$text = "<div style=\"text-align:center\">\n";
	
	$text .= "<form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='adminform'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>

		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[0]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[0] . "|" .$fieldtype[0]."|".$fieldvalu[0];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[0]],$fieldname[0]);
		$text .= "	
			</td>
		</tr>

		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[1]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[1] . "|" .$fieldtype[1]."|".$fieldvalu[1];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[1]],$fieldname[1]);
		$text .= "	
			</td>
		</tr>
		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[2]."- ".$row[$fieldname[2]]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[2] . "|" .$fieldtype[2]."|".$fieldvalu[2];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[2]],$fieldname[2]);
		$text .= "	
			</td>
		</tr>



		<tr>
			<td class='fcaption' style='width:47%; vertical-align:top; text-align:right'>".$fieldcapt[3]."</td>
			<td class='fcaption' style='width:6%; text-align:center'></td>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[4]."</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:47%; vertical-align:top; text-align:right'>";
		$form_send = $fieldcapt[3] . "|" .$fieldtype[3]."|".$my_teams_list;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[3]],$fieldname[3]);
		$text .= "</td>
			<td class='fcaption' style='width:6%; text-align:center'>v.s.</td>
				<td style='width:47%; vertical-align:top' class='forumheader3'>";
		$form_send = $fieldcapt[4] . "|" .$fieldtype[4]."|".$my_teams_list;
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[4]],$fieldname[4]);
		$text .= "</td>
		</tr>
		
		
		<tr>
			<td class='fcaption' style='width:47%; vertical-align:top; text-align:right'>".$fieldcapt[5]."</td>
			<td class='fcaption' style='width:6%; text-align:center'></td>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[6]."</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:47%; vertical-align:top; text-align:right'>";
		$form_send = $fieldcapt[5] . "|" .$fieldtype[5]."|".$fieldvalu[5];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[5]],$fieldname[5]);
		$text .= "</td>
			<td class='fcaption' style='width:6%; text-align:center'>:</td>
				<td style='width:47%; vertical-align:top' class='forumheader3'>";
		$form_send = $fieldcapt[6] . "|" .$fieldtype[6]."|".$fieldvalu[6];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[6]],$fieldname[6]);
		$text .= "</td>
		</tr>

		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[7]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[7] . "|" .$fieldtype[7]."|".$fieldvalu[7];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[7]],$fieldname[7]);
		$text .= "	
			</td>
		</tr>
		
		
		<tr>
			<td style='width:47%; vertical-align:top' class='fcaption'>".$fieldcapt[8]."</td>
			<td style='vertical-align:top' class='forumheader3' colspan='2'>";
		$form_send = $fieldcapt[8] . "|" .$fieldtype[8]."|".$fieldvalu[8];
		$text .= $rs->  user_extended_element_edit($form_send,$row[$fieldname[8]],$fieldname[8]);
		$text .= "	
			</td>
		</tr>
		";
		
	$text .= "<tr><td colspan=\"3\" class=\"forumheader\" style=\"text-align:center\">
		<input class='button' type='submit' id='update' name='update' value='".LAN_4xA_SPORTTIPPS_050."' />
		<input type='hidden' name='table_id' value='".$row[$primaryid]."'></form>
		<form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='back'>
		<input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' />
		</form></td></tr></table></div>";
	$configtitle="<b></b>";	
	}
///+++++++++++++++++++++++++
else{
if($Rid!=0 && $Gid!=0){
	$MY_WERE="rounde='".$Rid."' AND group_pre='".$Gid."'";
	}
else{
$MY_WERE="game_id!='0'";
}

$sql -> db_Select($tablename, "*", "".$MY_WERE." ORDER BY timeof_game");
$fcount_global=0;
while($row = $sql-> db_Fetch())
  {
		$fcount_global++;
	}
$text .= "<div style=\"text-align:center\">
 <form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='neu'><div style='font-size: 14px;color:#00b42a;font-weight: bold;'>
 <a href='".e_SELF."?neu.".$Rid.".".$Gid."'>".LAN_4xA_SPORTTIPPS_048."</a></div>
 </form>
 <br/> 
 <br/><b>".LAN_4xA_SPORTTIPPS_060."</b><br/>
 	<div style='width:96%'>
 		<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
   							<tr>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_052."</td>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_053."</td>
								<td class='fcaption'>".LAN_4xA_SPORTTIPPS_054."</td>
								<td class='fcaption' colspan='2'>".LAN_4xA_SPORTTIPPS_055."</td>
								<td class='fcaption' width='60'>".LAN_4xA_SPORTTIPPS_056."</td>
   							</tr>";
if($fcount_global > 0)
  {
if($Rid!=0 && $Gid!=0){
	$MY_WERE="a.rounde='".$Rid."' AND a.group_pre='".$Gid."'";
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
   		WHERE ".$MY_WERE." ORDER BY a.timeof_game";   		
$sql->db_Select_gen($qry);
$counter=0;
while($row = $sql-> db_Fetch())
		{
		$my_game[$counter]=$row;
		$my_game[$counter]['home_tID']=$row['team_id'];
		$counter++;
		}
for($i=0; $i < $counter; $i++)
		{
		$qry="SELECT a.*, b.* FROM ".MPREFIX."4xa_wm_teams_in_groups AS a
   		LEFT JOIN ".MPREFIX."4xa_wm_teams AS b ON b.team_id=a.team_id
   		WHERE a.teams_in_groups_id='".$my_game[$i]['guest']."'LIMIT 1";   		
	$sql->db_Select_gen($qry);
	$row = $sql-> db_Fetch();
	$my_game[$i]['gast_name']=$row['team_name'];
	$my_game[$i]['gast_icon']=$row['team_icon'];
	$my_game[$i]['gast_tID']=$row['team_id'];
	$my_game[$i]['gast_virtual_name']=$row['teams_virtual_name'];
		}

$STATUS_COLOR[0]="#fff";
$STATUS_COLOR[1]="#ffcb00";
$STATUS_COLOR[2]="#fffa00";
$STATUS_COLOR[3]="#00f200";
$STATUS_COLOR[4]="#ff8888";
$STATUS_COLOR[5]="#f498ff";
$STATUS_COLOR[6]="#00cbff";
for($i=0; $i < $counter; $i++)
		{
		if($my_game[$i]['home_tID']< 1)
			{
			$image_home="active.gif";
			$name_home=$my_game[$i]['teams_virtual_name'];
			}
			else{
			$image_home=$my_game[$i]['team_icon'];
			$name_home=$my_game[$i]['team_name'];;
			}		
		if($my_game[$i]['home_tID']< 1)
			{
			$image_gast="active.gif";
			$name_gast=$my_game[$i]['gast_virtual_name'];
			}
			else{
			$image_gast=$my_game[$i]['gast_icon'];
			$name_gast=$my_game[$i]['gast_name'];;
			}
			
if($my_game[$i]['mode']< 1 && ($my_game[$i]['timeof_game']-$condown) < time()){$my_game[$i]['mode']=4;}
	$text .="<tr>
   				<td class='forumheader' style='background:".$STATUS_COLOR[$my_game[$i]['mode']]."'>".$my_game[$i]['game_id']."</td>
   				<td class='forumheader'>".$my_game[$i]['group_name']." in ".$my_game[$i]['round_name']."<br/>
   																".strftime("am %d.%m.%Y um %H:%M",$my_game[$i]['timeof_game'])."
   				</td>
   				<td class='forumheader'>".$my_game[$i]['stadion_name']."<br/>
   																".$my_game[$i]['stadion_ort']."
   				</td>
   				
					<td class='forumheader'>".$name_home." <img src='../img_teams/".$image_home."' alt='' title='' border='0'> v.s.
					<img src='../img_teams/".$image_gast."' alt='' title='' border='0'> ".$name_gast."
					</td>
					<td class='forumheader'>".$my_game[$i]['goals_home'].":".$my_game[$i]['goals_guest']."
					</td>
					<td class='forumheader' width='60'>
					<form method='post' action='".e_SELF."?list.".$Rid.".".$Gid."' id='editform'>
															<input type='hidden' name='ID' value='".$my_game[$i]['game_id']."'>
															<input type='image' title='".LAN_4xA_SPORTTIPPS_025."' name='delete[kat_{$my_game[$i]['game_id']}]' style='vertical-align: middle' src='".$ImageDELETE['PFAD']."' onclick=\"return jsconfirm('".LAN_4xA_SPORTTIPPS_057."[".$my_game[$i]['team_name']." v.s. ".$my_game[$i]['gast_name']."]".LAN_4xA_SPORTTIPPS_058."')\"/> | 
															<a href='".e_SELF."?edit.".$Rid.".".$Gid.".".$my_game[$i]['game_id']."'>".$ImageEDIT['LINK']."</a>
															</form></td>
   				</tr>"; 	
		}
	}
else{
	$text .="<tr>".$fields_count_global."<td class='forumheader' style='text-align:center' colspan='8'><br/><br/>".LAN_4xA_SPORTTIPPS_059."<br/><br/></td></tr>";
	}
$text .= "</table><br/><br/><br/>
<form method='post' action='admin_groups.php?list.".$Rid.".".$Gid."' id='editform'>
<input class='button' type='submit' id='back' name='back' value='".LAN_4xA_SPORTTIPPS_049."' />
</form>";
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>4xA- Sporttipps </a> v.".LAN_4xA_SPORTTIPPS_VERS." ::.</font></div>";
}

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
?>
