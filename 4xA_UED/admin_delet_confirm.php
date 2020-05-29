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
///////////---------------------------------------------------------------------------------
$text = "<link rel='stylesheet' type='text/css' href='".THEME."style.css'>
					<div style='text-align:center; padding:20px;'>";
///////////---------------------------------------------------------------------------------
if(isset($_POST['delete_confirm']))
{$message ="";
	$players = explode(";", $_POST['daten']);
	$count_del_players=count($players);$count_del_players--;
	
	for($i=0; $i< $count_del_players;$i++){
		echo $players[$i];
		$tmp=explode(":", $players[$i]);
	$message .=($sql -> db_Delete("user", "user_id='".$tmp[0]."'"))? 	"<div style='padding:10px;background:#cfe09b;color:#297825;border:3px #297825 solid;'>".LAN_4xA_UED_001." <b>".$tmp[1]."</b>".LAN_4xA_UED_002."</div><br/>":
																																			"<div style='padding:10px;background:#ffaaaa;color:#ff000; border:3px #ff0000 solid;'>".LAN_4xA_UED_001." <b>".$tmp[1]."</b>".LAN_4xA_UED_003."</div><br/>";
	}
}
///////////---------------------------------------------------------------------------------
elseif(isset($_POST['bann_confirm']))
{$message ="";
	$players = explode(";", $_POST['daten']);
	$count_del_players=count($players);$count_del_players--;
	
	for($i=0; $i< $count_del_players;$i++){
	echo $players[$i];
	$tmp=explode(":", $players[$i]);
	$message .=($sql ->  db_Update("user", "user_ban='1' WHERE user_id='".$tmp[0]."' "))? 	"<div style='padding:10px;background:#cfe09b;color:#297825;border:3px #297825 solid;'>".LAN_4xA_UED_001." <b>".$tmp[1]."</b>".LAN_4xA_UED_004."</div><br/>":
																																											"<div style='padding:10px;background:#ffaaaa;color:#ff000; border:3px #ff0000 solid;'>".LAN_4xA_UED_001." <b>".$tmp[1]."</b>".LAN_4xA_UED_005."</div><br/>";																														"<div style='padding:10px;background:#ffaaaa;color:#ff000; border:3px #ff0000 solid;'><b>Benutzer <b>".$tmp[1]."</b> konnte  <b>NICHT</b>gebannt werden!!!!</b></div><br/>";
	}
}
///////////---------------------------------------------------------------------------------
else{
if(count($_POST['checkbox']) > 0)
	{
	if(isset($_POST['delete']))	
		{
		$text .= "<div style='padding:20px;background:#faa;color:#f00;border:3px #f00 solid;'>
							<b>".LAN_4xA_UED_006."</b>
						</div><br/><br/>";
		}
	elseif(isset($_POST['bannen']))	
		{		
		$text .= "<div style='padding:20px;background:#faa;color:#f00;border:3px #f00 solid;'>
							<b>".LAN_4xA_UED_007."</b>
						</div><br/><br/>";
		}
$weitergabe="";
$user_count=0;
foreach($_POST['checkbox'] as $user_id){
  $sql -> db_Select("user", "user_id,user_name,user_email,user_admin", " user_id='".$user_id."' ");
	$user_data[$user_count] = $sql-> db_Fetch();
	$weitergabe.=$user_data[$user_count]['user_id'].":".$user_data[$user_count]['user_name'].";";
	$user_count++; 
	}
$text .= "<table style='width:90%' class='fborder'>";
for($i=0;$i< $user_count;$i++)
	{
	$text .= "<tr>
							<td class='forumheader'>(".$user_data[$i]['user_id'].") </td>
							<td class='forumheader'>".(($user_data[$i]['user_admin'])? "<img src='".e_PLUGIN."/4xA_UED/images/admin.png' style='border:0px;' title='' alt='Admin'/>":"")."</td>
							<td class='forumheader'>".$user_data[$i]['user_name']."</td>
							<td class='forumheader'>".$user_data[$i]['user_email']."</td>
						</tr>	
							";
	}
$text .= "</table><br/><br/>";
if(isset($_POST['delete']))	
		{
$text .= "<form name='select_anzahl' method='post' action='".e_SELF."'>
						<input type='hidden' name='daten' value='".$weitergabe."'>
						<input class='button' style='width:50%;font-size: 15px;font-weight: bold; border:2px #777 solid;background:#faa;padding:5px;cursor:pointer;' name='delete_confirm'  id='delete_confirm' type='submit' value='".LAN_4xA_UED_009."' ><br/>
					</form>";
		$caption="<b>".LAN_4xA_UED_012."</b>";
		}			
	elseif(isset($_POST['bannen']))	
		{
$text .= "<form name='select_anzahl' method='post' action='".e_SELF."'>
						<input type='hidden' name='daten' value='".$weitergabe."'>
						<input class='button' style='width:50%;font-size: 15px;font-weight: bold; border:2px #777 solid;background:#faa;padding:5px;cursor:pointer;' name='bann_confirm'  id='bann_confirm' type='submit' value='".LAN_4xA_UED_010."' ><br/>
					</form>";
		$caption="<b>".LAN_4xA_UED_013."</b>";
		}							
}
else{	$text .= "<div style='padding:20px;background:#faa;color:#f00;border:3px #f00 solid;'>
							<b>".LAN_4xA_UED_011."</b>
						</div><br/><br/>";
	}
}
$text .= "<div style=\"text-align:center\"><br/><a href='javascript:window.close()' style='color:#000'><div style='width:50%;font-size: 15px;font-weight: bold; border:2px #777 solid;background:#ccc;padding:5px;cursor:pointer;'>".LAN_4xA_UED_014."</div></a><br/>";
$text .= "</div><br/><br/>";
///+++++++++++++++++++++++++++++++++++++++++++++
$text .= "
     	</table>
     </form>
    </div>";
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler. 
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt. 
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!   
$text.="<div style='text-align:center;font-size:60%;'>.:: powered by 4xA-UED from <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>e107-Templates</a> ::.</div>";   
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
$ns->tablerender($caption, $text);
//////////////////////
?>