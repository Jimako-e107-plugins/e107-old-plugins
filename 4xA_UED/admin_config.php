<?php
/*
+---------------------------------------------------------------+
|	4xA-UED v0.1 - by ***Operator99*** (www.e107.4xA.de) 04.06.2013
|	sorce: ../../4xA_UED/admin_config.php
|
|
|	For the e107 website system
|	©Steve Dunsta
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

if (!getperms("P")) {
   header("location:".e_HTTP."index.php");
      exit;
}
$lan_file = e_PLUGIN."4xA_UED/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_UED/languages/German.php");
require_once(e_ADMIN."auth.php");

$pageid = "admin_userlist"; 

if(e_QUERY)
	{
	list($sort,$richt,$anz,$seite) = explode(".", e_QUERY);
	$sort = intval($sort);
	$anz = intval($anz);
	$seite = intval($seite);
	}
if(!$seite)
	{
	$seite=0;	
	}
if(!$sort){
	$sort = 0;
	}	
if($_GET['anzahl'])
	{
	$anzahl=$_GET['anzahl'];
	}
elseif($anz){
$anzahl=$anz;
}else{$anzahl=100;}

///////////////////  Datenbankfelder 
	$field[0]['f_name']="user_id";
	$field[1]['f_name']="user_name";
	$field[2]['f_name']="user_loginname";
  $field[3]['f_name']="user_customtitle";
  $field[4]['f_name']="user_password";
  $field[5]['f_name']="user_sess";
  $field[6]['f_name']="user_email";
  $field[7]['f_name']="user_signature";
  $field[8]['f_name']="user_image";
  $field[9]['f_name']="user_timezone";
  $field[10]['f_name']="user_hideemail";
  $field[11]['f_name']="user_join";
  $field[12]['f_name']="user_lastvisit";
  $field[13]['f_name']="user_currentvisit";
  $field[14]['f_name']="user_lastpost";
  $field[15]['f_name']="user_chats";
  $field[16]['f_name']="user_comments";
  $field[17]['f_name']="user_forums";
  $field[18]['f_name']="user_ip";
  $field[19]['f_name']="user_ban";
  $field[20]['f_name']="user_prefs";
  $field[21]['f_name']="user_new";
  $field[22]['f_name']="user_viewed";
  $field[23]['f_name']="user_visits";
  $field[24]['f_name']="user_admin";
  $field[25]['f_name']="user_login";
  $field[26]['f_name']="user_class";
  $field[27]['f_name']="user_perms";
  $field[28]['f_name']="user_realm";
  $field[29]['f_name']="user_pwchange";
  $field[30]['f_name']="user_xup";

	$field[0]['f_desc']=LAN_4xA_UED_020;
	$field[1]['f_desc']=LAN_4xA_UED_021;
	$field[2]['f_desc']=LAN_4xA_UED_022;
  $field[3]['f_desc']=LAN_4xA_UED_023;
  $field[4]['f_desc']=LAN_4xA_UED_024;
  $field[5]['f_desc']=LAN_4xA_UED_025;
  $field[6]['f_desc']=LAN_4xA_UED_026;
  $field[7]['f_desc']=LAN_4xA_UED_027;
  $field[8]['f_desc']=LAN_4xA_UED_028;
  $field[9]['f_desc']=LAN_4xA_UED_029;
  $field[10]['f_desc']=LAN_4xA_UED_030;
  $field[11]['f_desc']=LAN_4xA_UED_031;
  $field[12]['f_desc']=LAN_4xA_UED_032;
  $field[13]['f_desc']=LAN_4xA_UED_033;
  $field[14]['f_desc']=LAN_4xA_UED_034;
  $field[15]['f_desc']=LAN_4xA_UED_035;
  $field[16]['f_desc']=LAN_4xA_UED_036;
  $field[17]['f_desc']=LAN_4xA_UED_037;
  $field[18]['f_desc']=LAN_4xA_UED_038;
  $field[19]['f_desc']=LAN_4xA_UED_039;
  $field[20]['f_desc']=LAN_4xA_UED_040;
  $field[21]['f_desc']=LAN_4xA_UED_041;
  $field[22]['f_desc']=LAN_4xA_UED_042;
  $field[23]['f_desc']=LAN_4xA_UED_043;
  $field[24]['f_desc']=LAN_4xA_UED_044;
  $field[25]['f_desc']=LAN_4xA_UED_045;
  $field[26]['f_desc']=LAN_4xA_UED_046;
  $field[27]['f_desc']=LAN_4xA_UED_047;
  $field[28]['f_desc']=LAN_4xA_UED_048;
  $field[29]['f_desc']=LAN_4xA_UED_049;
  $field[30]['f_desc']=LAN_4xA_UED_050;
  
$fields=count($field);                              

$users = $sql->db_Count("user", "(*)", "WHERE user_id!=''"); 
$seiten= ceil($users / $anzahl);
$tmp=$seiten*$anzahl;
if($tmp < $users){$seiten++;}
if($seite >0)
	{
	$von=($anzahl*$seite);
	//$bis=($von+$anzahl);
	}
else{
	$von=0;
	$bis=$anzahl;
	}
	  $qry ="
	  SELECT a.*, b.*, c.*	  FROM #user AS a
    LEFT JOIN #user_extended AS b ON b.user_extended_id=a.user_id
    LEFT JOIN #online AS c ON c.online_ip=a.user_ip
	  WHERE user_name != '' ORDER by ".$field[$sort]['f_name']." ".$richt." LIMIT ".$von.", ".$anzahl."";
	  
    $sql->db_Select_gen($qry);
    $user_count=0;
while($row = $sql->db_Fetch()){
		$USERDATA[$user_count]= $row;
		$user_count++;
  	}
$caption="<b>Benutzertabelle</b>";
echo "<script language='JavaScript' type='text/JavaScript'>
<!--
function MM_openBrWindow(theURL,winName, breite, hoehe) { //v2.0
	links = (screen.width/2)-(breite/2);
	oben = (screen.height/2)-(hoehe/2);
	window.open (theURL,winName,\"height=\"+hoehe+\",width=\"+breite+\",status = no,toolbar = no,menubar = no,location = no,resizable = no,titlebar = no,scrollbars = yes,fullscreen = no,top =\"+oben+\",left =\"+links);
}
//-->
</script>";

$text = "<p>".LAN_4xA_UED_015."<b>".$users."</b>".LAN_4xA_UED_016."<b>".$field[$sort]['f_name']."</b>";
if($richt!="DESC"){$text .= " ".LAN_4xA_UED_017."";}else{$text .= " ".LAN_4xA_UED_018."";}

$anzahl_opt[]=10;
$anzahl_opt[]=50;
$anzahl_opt[]=100;
$anzahl_opt[]=500;
$anzahl_opt[]=1000;
$anzahl_count=count($anzahl_opt);
$text .= "<form name='select_anzahl' method='get' action='".e_SELF."?".$sort.".".$richt."'>
					<input type='hidden' name='sort' value='".$sort."'>
					<input type='hidden' name='richt' value='".$richt."'>
  				   ".LAN_4xA_UED_019."
    				 <select name='anzahl' size='1' onChange=\"document.select_anzahl.submit();\">";
for($i=0; $i < $anzahl_count; $i++)
  {if($anzahl_opt[$i]==$anzahl)
  	{$selected=" selected";}else{$selected="";}
   $text .= "<option".$selected.">".$anzahl_opt[$i]."</option>";
  }
$text .= "</select>
  				 ".LAN_4xA_UED_051."
				</form></p>";


for($i=0; $i< $seiten; $i++)
	{
	if($i==$seite)
		{
		$text .= "<div style='background:#eee;border:2px #666 dashed;float:left;margin:4px;padding:4px;'>".($i+1)."</div>";	
		}	
	else{	
		$text .= "<a href='".e_SELF."?".$sort.".".$richt.".".$anzahl.".".$i."'><div style='background:#999;border:2px #666 solid;float:left;margin:4px;padding:4px;'>".($i+1)."</div></a>";	
		}
	}


$text .= "<br/><br/><div style='text-align:center'>
  	<form method='post' name='list' action='admin_delet_confirm.php' target='meinFenster' onSubmit=\"MM_openBrWindow('','meinFenster','450','550'); return\">
 			<input type='hidden' name='user_count' value='".$user_count."'>	
 			<table style='width:100%' class='fborder'><tr><td class='fcaption' style='padding:2px;'>;-)</td>";
///++++++++++++++++++++++++++++++++++++++++++++++
for($i=0; $i< $fields; $i++)
	{	
	if($i>1){
		if($pref["4xA_ued_".$field[$i]['f_name']]!=1)
			{
			continue;
			}
		}		
		$text .= "<td class='fcaption' style='padding:2px;'><a href='".e_SELF."?".$i.".".(($sort==$i&&$richt!="DESC")? "DESC" : "").".".$anzahl."'>".$field[$i]['f_desc']."</a><br/>";
		if($sort==$i)
			{
			$text .=($richt!="DESC")? "<img src='".e_PLUGIN."/4xA_UED/images/ASC.png' style='border:0px;' title='' alt=''/>" : "<img src='".e_PLUGIN."/4xA_UED/images/DESC.png' style='border:0px;' title='' alt=''/>"; 					
			}	
		$text .= "</td>";
	}
for($j=0; $j< $user_count; $j++)
	{
		$TS=$j%2;
		$TDSTYLE=(!$TS)?"forumheader":"forumheader2";
		
		$text .= "<tr><td  class='".$TDSTYLE."' style='padding:2px;'><input type='checkbox' name='checkbox[]' value='".$USERDATA[$j][$field[0]['f_name']]."'></td>";
	
for($i=0; $i< $fields; $i++)
	{
	if($i>1){
		if($pref["4xA_ued_".$field[$i]['f_name']]!=1)
			{
			continue;
			}		
		}
		if($i>10 && $i< 15)
			{
			if((strftime("%x", $USERDATA[$j][$field[11]['f_name']]))==(strftime("%x", $USERDATA[$j][$field[12]['f_name']])))
					{	
					$USERDATA[$j][$field[12]['f_name']]=0;$USERDATA[$j][$field[13]['f_name']]=0;
					}
		 if($USERDATA[$j][$field[$i]['f_name']]==0)
					{
					$text .="<td style='background: #faa;'>0</td>";	
					}
			else{
				$text .="<td  class='".$TDSTYLE."' style='padding:2px;background: #afa;'>". strftime("%x", $USERDATA[$j][$field[$i]['f_name']])."</td>";
				}
			}
		elseif($i==16)
			{
			$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><a href='../../userposts.php?0.comments.".$USERDATA[$j][$field[0]['f_name']]."' title='".LAN_4xA_UED_052."'>".$USERDATA[$j][$field[$i]['f_name']]."</a></td>";
			}	
		elseif($i==17)
			{
			$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><a href='../../userposts.php?0.forums.".$USERDATA[$j][$field[0]['f_name']]."' title='".LAN_4xA_UED_053."'>".$USERDATA[$j][$field[$i]['f_name']]."</a></td>";
			}		
		elseif($i==19)
			{
			$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><img src='".e_PLUGIN."/4xA_UED/images/banlist_".$USERDATA[$j][$field[$i]['f_name']].".png' style='border:0px;' title='' alt='ban'/></td>";
			}
		elseif($i==24)
			{
			$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><img src='".e_PLUGIN."/4xA_UED/images/admin_".$USERDATA[$j][$field[$i]['f_name']].".png' style='border:0px;' title='' alt='ad'/></td>";
			}
		elseif($i==5||$i==7||$i==8)
			{
				if($USERDATA[$j][$field[$i]['f_name']]!="")
					{		
					$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><img src='".e_PLUGIN."/4xA_UED/images/banlist_0.png' style='border:0px;' title='' alt='images'/></td>";
					}
				else{		
					$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><img src='".e_PLUGIN."/4xA_UED/images/banlist_1.png' style='border:0px;' title='' alt='images'/></td>";
					}
		}	
		elseif($i==1)
			{
			$text .= "<td class='".$TDSTYLE."' style='padding:2px;'><a href='../../usersettings.php?".$USERDATA[$j][$field[0]['f_name']]."' title='".$USERDATA[$j][$field[6]['f_name']]."'>".$USERDATA[$j][$field[$i]['f_name']]."</a></td>";
			}		
	else{	
		$text .= "<td class='".$TDSTYLE."' style='padding:2px;'>".$USERDATA[$j][$field[$i]['f_name']]."</td>";
		}
	}	
	
		$text .= "</tr>";	
	
	}
///+++++++++++++++++++++++++++++++++++++++++++++
$text .= " 
     	<tr><td colspan='".($fields-1)."' class='fcaption' style='padding:2px;text-align:center'>
     	<input class='button' name='delete' type='submit' value='".LAN_4xA_UED_054."' >
     	<input class='button' name='bannen' type='submit' value='".LAN_4xA_UED_055."' ></td></tr>
     	</table>
     </form>
    </div>";
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:60%;'>.:: powered by 4xA-UED from <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>e107-Templates</a> ::.</div>";   
$ns->tablerender($caption, $text);
require_once(e_ADMIN."footer.php");
//////////////////////
?>