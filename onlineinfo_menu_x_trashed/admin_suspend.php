<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once('../../class2.php');
if(!getperms('P')){ header("location:".e_BASE."index.php"); exit ;}
require_once(e_ADMIN.'auth.php');
require_once(e_HANDLER.'userclass_class.php');

$lan_file = e_PLUGIN.'onlineinfo_menu/languages/admin_'.e_LANGUAGE.'.php';
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.'onlineinfo_menu/languages/admin_English.php');

$text='';

if(isset($_POST['delete']))
{
	$tmp = array_keys($_POST['delete']);
	list($delete, $del_id) = explode('_', $tmp[0]);
}

if ($delete == 'main' && $del_id)
{

$sql->db_Delete("onlineinfo_suspend", "user_id=".$del_id." ");

$text.='<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px;">'.ONLINEINFO_LOGIN_MENU_A134.'&nbsp;'.$del_id.ONLINEINFO_LOGIN_MENU_A139.'</div>';

}

if(isset($_POST['suspend_user']))
	{



if (!$sql -> db_Select("onlineinfo_suspend", "*", "user_id=".$_POST['users'].""))
		{

		$sql -> db_Select("user", "user_loginname,user_ip"," user_id=".$_POST['users']." ORDER BY user_loginname ");
		if ($row = $sql -> db_Fetch())
		{
			extract($row);

			$username=$user_loginname;
			$ipaddress=$user_ip;

		}
			if ($sql -> db_Insert("onlineinfo_suspend", "".$_POST['users'].", '".$username."', '".$ipaddress."' "))
				{

				$text.='<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px; vertical-align:middle;"><img src="'.e_PLUGIN.'onlineinfo_menu/images/error.png" width="15" height="15" alt="'.ONLINEINFO_LOGIN_MENU_A133.'" title="'.ONLINEINFO_LOGIN_MENU_A133.'">&nbsp;&nbsp;'.ONLINEINFO_LOGIN_MENU_A132.'</div>';

				}else{

				$text.= '<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px; vertical-align:middle;"><img src="'.e_PLUGIN.'onlineinfo_menu/images/error.png" width="15" height="15" alt="'.ONLINEINFO_LOGIN_MENU_A132.'" title="'.ONLINEINFO_LOGIN_MENU_A132.'">&nbsp;&nbsp;'.ONLINEINFO_LOGIN_MENU_A133.'</div>';
				}
		}else{
			$text.= '<div style="text-align:center;font-weight:bold;padding: 5px 5px 5px 5px; vertical-align:middle;"><img src="'.e_PLUGIN.'onlineinfo_menu/images/error.png" width="15" height="15" alt="'.ONLINEINFO_LOGIN_MENU_A132.'" title="'.ONLINEINFO_LOGIN_MENU_A132.'">&nbsp;&nbsp;'.ONLINEINFO_LOGIN_MENU_A132.'</div>';

		}
	}

$text .= '<div style="text-align:center">
<form action="'.e_SELF.'" method="post" id="userlist">
<table class="fborder">
<tr>
<td class="forumheader3" style="vertical-align: middle;">'.ONLINEINFO_LOGIN_MENU_A129.'&nbsp;<select class="tbox" name="users" size="1" width="10">';

$sql = new db;
$sql -> db_Select("user", "user_login,user_name,user_id","user_name Like '%' ORDER BY user_name ");
while ($row = $sql -> db_Fetch())
{
	extract($row);
	if ($user_id<>USERID) {
		$text.='<option value="'.$user_id.'">'.($menu_pref['realname']==1 && $user_login <> '' ? $user_login : $user_name);
	}
}

$text.='</select>&nbsp;&nbsp;<input class="button" type="submit" name="suspend_user" value="'.ONLINEINFO_LOGIN_MENU_A130.'" title="'.ONLINEINFO_LOGIN_MENU_A130.'"></td></tr></table></form>';


$text.='<br /><br /><table class="fborder" width="60%">
<tr><td colspan="4" class="forumheader" style="vertical-align: middle; text-align:center;">'.ONLINEINFO_LOGIN_MENU_A127.'</td></tr>
<tr><td class="forumheader3" style="text-align:center;">'.ONLINEINFO_LOGIN_MENU_A134.'</td>
<td class="forumheader3" style="text-align:center;">'.ONLINEINFO_LOGIN_MENU_A135.'</td>
<td class="forumheader3" style="text-align:center;">'.ONLINEINFO_LOGIN_MENU_A137.'</td>
<td class="forumheader3" style="text-align:center;">'.ONLINEINFO_LOGIN_MENU_A136.'</td></tr>';


$script="SELECT * from ".MPREFIX."onlineinfo_suspend ORDER BY user_name";
$data = $sql->db_Select_gen($script);

if ($data)
    {
     	while ($row = $sql->db_Fetch())
        {
            extract($row);

			$text.='<tr><td class="forumheader3" width="10%" style="text-align:center;">'.$user_id.'</td>
				<td class="forumheader3" style="text-align:left;">'.$user_name.'</td>
				<td class="forumheader3" style="text-align:left;">'.$ip.'</td>
				<td class="forumheader3" width="10%" style="text-align:center;">
				<form action="'.e_SELF.'" id="deletesuspended" method="post">
				<input type="image" title="'.LAN_DELETE.'" name="delete[main_'.$user_id.']" src="'.e_PLUGIN.'onlineinfo_menu/images/cross.png" height="12" onclick="return jsconfirm(\''.ONLINEINFO_LOGIN_MENU_A138.' [ID: '.$user_id.' ]\')" /></form></td>
			</tr>';

		}
	}else{

	 $text.='<tr><td colspan="4" class="forumheader3" style="text-align:center;">'.ONLINEINFO_LOGIN_MENU_A131.'</td></tr>';

	}

$text.='</table>';

$text.='</div>';


$ns -> tablerender(ONLINEINFO_LOGIN_MENU_A2.' - '.ONLINEINFO_LOGIN_MENU_A127, $text);

require_once(e_ADMIN.'footer.php');

?>