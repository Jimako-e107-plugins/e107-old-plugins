<?php
/*
+---------------------------------------------------------------+
+---------------------------------------------------------------+
|	4xA-UED v0.1 - by ***Operator99*** (www.e107.4xA.de) 04.06.2013
|	sorce: ../../4xA_UED/admin/admin_config_fields.php
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
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit;}
$lan_file = e_PLUGIN."4xA_UED/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_UED/languages/German.php");
require_once(e_ADMIN."auth.php");

$configtitle = LAN_4xA_UED_059;
$pageid = "prefs";
$show_preset = FALSE;
$pageid = "admin_userfields_pref"; 
//////////////////////////////////////////////////////////////////////
require_once(e_ADMIN."auth.php");
//////////////////////////////////////////////////////////////
$my_fields[]= "4xA_ued_user_loginname";
$my_fields[]= "4xA_ued_user_customtitle";
$my_fields[]= "4xA_ued_user_password";
$my_fields[]= "4xA_ued_user_sess";
$my_fields[]= "4xA_ued_user_email";
$my_fields[]= "4xA_ued_user_signature";
$my_fields[]= "4xA_ued_user_image";
$my_fields[]= "4xA_ued_user_timezone";
$my_fields[]= "4xA_ued_user_hideemail";
$my_fields[]= "4xA_ued_user_join";
$my_fields[]= "4xA_ued_user_lastvisit";
$my_fields[]= "4xA_ued_user_lastpost";
$my_fields[]= "4xA_ued_user_chats";
$my_fields[]= "4xA_ued_user_comments";
$my_fields[]= "4xA_ued_user_forums";
$my_fields[]= "4xA_ued_user_ip";
$my_fields[]= "4xA_ued_user_ban";
$my_fields[]= "4xA_ued_user_prefs";
$my_fields[]= "4xA_ued_user_new";
$my_fields[]= "4xA_ued_user_viewed";
$my_fields[]= "4xA_ued_user_visits";
$my_fields[]= "4xA_ued_user_admin";
$my_fields[]= "4xA_ued_user_login";
$my_fields[]= "4xA_ued_user_class";
$my_fields[]= "4xA_ued_user_perms";
$my_fields[]= "4xA_ued_user_realm";
$my_fields[]= "4xA_ued_user_pwchange";
$my_fields[]= "4xA_ued_user_xup";

$count_myfields=count($my_fields);
/////////////////////////////////////////////////////
if (isset($_POST['updatepagesets'])) 
{
for($i=0;$i< $count_myfields;$i++)
	{	
	$pref[$my_fields[$i]] = $_POST[$my_fields[$i]];
	}
save_prefs();
$message = LAN_4xA_UED_060;	
}
//////////////////////////  Voreinstellungen ////////////////////////////////////////////////////
$text="<br/><br/>
<form method='post' action='".e_SELF."'>
	<table class='fborder' style='margin-left:auto;margin-right:auto;width:96%'>";
for($i=0;$i< $count_myfields;$i++)
		{	
     $text.="<tr>
     	<td style='width:10px;vertical-align:top;' class='forumheader3'>".get_checkbox($my_fields[$i])."</td>
			<td style='width:45%;vertical-align:top;' class='forumheader3'>".$my_fields[$i]."</td>
 			";
 		$i++;
 		$text.="
    	<td style='width:10px;vertical-align:top;' class='forumheader3'>".get_checkbox($my_fields[$i])."</td>
			<td style='width:45%;vertical-align:top;' class='forumheader3'>".$my_fields[$i]."</td>
 		</tr>";
 		}
$text.="<td colspan='4' class='fcaption'><div align='center'><input class='button' name='updatepagesets' type='submit' value='".LAN_4xA_UED_061."' /></div></td>
     	</tr>
	</table>
</form></div>";
/// Respektiere die Arbeit von den Anderen und lasse diesen Text mit dem Link auf die Seite der Entwickler.
/// Denn nicht nur Du solltest von diese Arbeit profitieren, mach diese Arbeit Bekannt.
/// Nur so kann eine vernünftige und stabile Entwicklung/Support aufgebaut werden! Danke!!!
$text.="<br/><br/><font style='font-size:60%;'>.:: powered by <a href='http://www.e107.4xa.de' target='blank' title='".BESUCHE_MICH."'>".LAN_4xA_UED_PLUGINNAME."</a> v.0.2 ::.</font></div>";
if (isset($message))
	{
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
	}
$ns->tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");
//////////////////////  Functionen //////////////////////////////////////////////////
function get_checkbox($fieldname)
{
global $pref;
$checked = ($pref[$fieldname] == 1)? " checked='checked'" : "";
$ret .="<input  type='checkbox' name='".$fieldname."'  value='1' ".$checked." />";
return $ret;
}
/////////////////////////

?>