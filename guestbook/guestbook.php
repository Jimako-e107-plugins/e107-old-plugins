<?php
  /*
  +---------------------------------------------------------------+
  |
  |	e107 website system
  |	GUESTBOOK PLUGIN V4.0
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License Version 2 (http://gnu.org).
  |
  +---------------------------------------------------------------+
  | original: ©Andrew Rockwell 2003
  |	      http://2sdw.com
  |           chavo@2sdw.com
  +---------------------------------------------------------------+
  | updates:  ©Richard Perry 2005
  |           http://www.greycube.com
  |           code@greycube.com
  +---------------------------------------------------------------+
  | updates:  ©Titanik 2007
  |          http://upc.utc.sk
  |           tomasss@inmail.sk
  +---------------------------------------------------------------+
  | updates:  ©Smarti October 2007
  |          http://www.platinwebservice.de
  |           webmaster@platinwebservice.de
  +---------------------------------------------------------------+
  */

require_once("../../class2.php");
require_once(e_PLUGIN."/guestbook/guestbook_shortcodes.php");
//require_once(e_HANDLER."form_handler.php");

@include_once(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."guestbook/languages/English.php");
//-----------------------------------------------------------------------------------------------------------+

if (file_exists(THEME."guestbook_template.php"))
{
	require_once(THEME."guestbook_template.php");
}
else
{
	require_once("guestbook_template.php");
}

if (file_exists(e_PLUGIN."forum/images/".IMODE."/admin_edit.png"))
{
	define("FTHEME", e_PLUGIN."forum/images/".IMODE."/");
}
else
{
	define("FTHEME", e_IMAGE."forum/");
}

//-----------------------------------------------------------------------------------------------------------+

$use_securecode = ($pref['guestbook_securecode'] && extension_loaded("gd"));
if ($use_securecode) {
	require_once(e_HANDLER."secure_img_handler.php");
	$sec_img = new secure_image;
}
//-----------------------------------------------------------------------------------------------------------+
//$comment_frm = new form;
require_once(HEADERF);
if (!defined("USER_WIDTH")){ define("USER_WIDTH","width:95%"); }
//-----------------------------------------------------------------------------------------------------------+

if (isset($_POST['records']))
{
	$records = intval($_POST['records']);
	$order = ($_POST['order'] == 'ASC' ? 'ASC' : 'DESC');
	$from = 0;
}
else if(!e_QUERY)
{
	$records = $pref['guestbook_posts'];
	$from = 0;
	$order = "DESC";
}
else
{
	if ($qs[0] == "self")
	{
		$id = USERID;
	}
	else
	{
		if ($qs[0] == "id")
		{
			$id = $qs[1];
		}
		else
		{
			$qs = explode(".", e_QUERY);
			$from = intval($qs[0]);
			$records = intval($qs[1]);
			$order = ($qs[2] == 'ASC' ? 'ASC' : 'DESC');
		}
	}
}
if ($records > 30)
{
	$records = 30;
}

//-----------------------------------------------------------------------------------------------------------+

$from         = intval(e_QUERY);
$tmp          = explode(".", e_QUERY);
$action       = $tmp[0];
$guestbook_id = $tmp[1];

$time = time() + ($pref['time_offset'] * 3600);
$ip   = $e107->getip();
$host = ($e107->get_host_name($ip)?$e107->get_host_name($ip):$ip);

//-----------------------------------------------------------------------------------------------------------+

if ($pref['guestbook_bbcode'])
{
	require_once(e_HANDLER."ren_help.php");
	$text_bbcode = "<br /><input class='helpbox' type='text' name='helpb' style='width:100%' /><br />".ren_help(1, 'addtext', 'help');
		
	if($pref['smiley_activate'])
	{
		require_once(e_HANDLER."emote.php");
		$text_emote = "<tr><td class='forumheader3'>".GB_LAN_EMOTES."</td><td class='forumheader3'>".r_emote()."</td></tr>";
	}
}

if ($_POST['guestbook_submit'])
{
	if(USER)
    {
		$_POST['name']  = USERNAME;
		$_POST['email'] = USEREMAIL;
	}

	$_POST['name']    = trim($_POST['name']);
	$_POST['comment'] = trim($_POST['comment']);

	if ($use_securecode)
	{
		$_POST['code_verify'] = trim($_POST['code_verify']);
		if (!$_POST['name'] || !$_POST['comment'] || !$_POST['code_verify'])
		{
			message_handler("ALERT", 5);
		}
		if (!$sec_img->verify_code($_POST['rand_num'], $_POST['code_verify']))
		{
			message_handler("MESSAGE", GB_LAN_WRONGCODE."<br /><br />");header("refresh:6; url=guestbook.php", 10); require_once(FOOTERF); exit;
		}
	}
    else
	{
		if (!$_POST['name'] || !$_POST['comment'])
		{
			message_handler("ALERT", 5);
		}
	}
	$fp = new floodprotect;
    if (!$fp -> flood("guestbook", "time()"))
    {
		header("location:index.php"); exit;
	}
	if($pref['guestbook_repeat'] && $sql -> db_Select("guestbook", "*", "host='$host'"))
	{
		message_handler("MESSAGE", GB_LAN_REPEAT."<br /><br /><a href='javascript:history.go(-1)'>".GB_LAN_GOBACK."</a>"); require_once(FOOTERF); exit;
	}

	if (strlen($_POST['comment']) > strlen(strip_tags($_POST['comment'])))
	{
		message_handler("MESSAGE", GB_LAN_NOHTML."<br /><br /><a href='javascript:history.go(-1)'>".GB_LAN_GOBACK."</a>"); require_once(FOOTERF); exit;
	}
	
    $_POST['name']    = substr(strip_tags($_POST['name']), 0, 50);
    $_POST['comment'] = strip_tags($_POST['comment']);
    $_POST['comment'] = $tp->toForm($_POST['comment']);
    $_POST['comment'] = trim($_POST['comment']);
    $_POST['url']     = eregi_replace("http://", "", trim($_POST['url']));
    $_POST['url']     = ($_POST['url']?"http://".$_POST['url']:"");
	
	if($pref['guestbook_nolinks'] && ( eregi("http:\/", $_POST['name'].$_POST['comment']) || eregi("www\.", $_POST['name'].$_POST['comment'])))
	{
		message_handler("MESSAGE", GB_LAN_NOLINKS."<br /><br /><a href='javascript:history.go(-1)'>".GB_LAN_GOBACK."</a>"); require_once(FOOTERF); exit;
	}

	if (function_exists("ecaptcha_check"))  // PROTECT WITH ECAPTCHA
	{
		ecaptcha_check($_POST['comment']);
	}
	
	
	$admincheck = ($pref['guestbook_moderate']? "0":"1");
	
	if($sql -> db_Insert("guestbook", "'', '".$_POST['name']."', '".$_POST['email']."', '".$_POST['url']."', '$time', '$ip', '$host', '".$_POST['comment']."', '".USERID."', '".$admincheck."' ")){

	
	$edata_gb = array("gmessage" => $_POST['comment'], "name" => $_POST['name'], "ip" => $ip);
	$e_event -> trigger("guestbookpost", $edata_gb);
	$e107cache->clear("nq_guestbook");

	$msg ="thankyou";
	}
}

if ($msg == "thankyou")
{
	message_handler("MESSAGE", ($pref['guestbook_moderate']? GB_LAN_THANKYOUMOD : GB_LAN_THANKYOU));
}

if ($action == "delete")
{	
	if(!( getperms("P") || check_class($pref['guestbook_moderator_class']) ) )
	{
		message_handler("MESSAGE", GB_LAN_PERMISSION); require_once(FOOTERF); exit;
	}

	if ($_POST['guestbook_delete'])
	{    
		$sql -> db_Delete("guestbook", "id='".$guestbook_id."' ");
	}
	else
	{
		$sql -> db_Select("guestbook", "*", "id='".$guestbook_id."' ");
		list($g_id, $g_name, $g_email, $g_url, $g_date, $g_ip, $g_host, $g_comment, $g_user, $g_block) = $sql-> db_Fetch();
		
		$text = rendercomment($gbook);

		$text .= "
		<form method='post' action='".$_SERVER['PHP_SELF']."?delete.$guestbook_id'>
		<div style='text-align:center'>
		<br />
		".GB_LAN_CONFIRM."<br />
		<br />
		<input type='submit' name='guestbook_delete' class='button' value='".GB_LAN_DELETE."' /><br />
		<br />
		</div>
		</form>";
		$ns ->tablerender($pref['guestbook_title'], $text); require_once(FOOTERF); exit;
	}
}
  
  
if($action == "edit" || $action == "update")
{
	$sql -> db_Select("guestbook", "*", "id='".$guestbook_id."' ");
	list($g_id, $g_name, $g_email, $g_url, $g_date, $g_ip, $g_host, $g_comment, $g_user, $g_block) = $sql-> db_Fetch();

	if ( !( getperms("P") || check_class($pref['guestbook_moderator_class']) ) && !( $g_date > ($time - (60*5)) && $g_host == substr($host, 0, strlen($g_host)) ) )
	{
		message_handler("MESSAGE", GB_LAN_PERMISSION); require_once(FOOTERF); exit;
	}

	if ($_POST['guestbook_update'])
	{
		if(USER && !( getperms("P") || check_class($pref['guestbook_moderator_class']) ))
		{
			$_POST['email'] = USEREMAIL;
			$_POST['name']  = USERNAME;
		}

		$_POST['name']    = substr(strip_tags($_POST['name']), 0, 50);
		$_POST['comment'] = strip_tags($_POST['comment']);
		$_POST['comment'] = $tp->toEmail($_POST['comment']);
		$_POST['comment'] = trim($_POST['comment']);
		$_POST['url']     = eregi_replace("http://", "", trim($_POST['url']));
		$_POST['url']     = ($_POST['url']?"http://".$_POST['url']:"");

		$sql -> db_Update("guestbook", "name='".$_POST['name']."', email='".$_POST['email']."', url='".$_POST['url']."', date='$guestbook_date', ip='$guestbook_ip', host='$guestbook_host', comment='".$_POST['comment']."', user='$guestbook_user', block='2' WHERE id='$guestbook_id'");
		
		message_handler("MESSAGE", GB_LAN_UPDATED);
	}
}

if ($action == "edit")
{
	$text .="<div style='text-align:center'><br />
			<form method='post' action='".$_SERVER['PHP_SELF']."?update.$guestbook_id' id='dataform'>";
}
else
{
	$text .="<div style='text-align:center'>
			<span class='button' style='padding-left:10px;padding-right:10px;cursor:pointer' onclick=\"expandit('guestbook_sign')\">
			".GB_LAN_SIGN."
			</span>
			<br />
			<br />
			</div>";
	
	$text.="<div style='display:none' id='guestbook_sign'><br />
			<form method='post' action='".$_SERVER['PHP_SELF']."' id='dataform'>";
}

$text .="
	<table style='width:98%' class='fborder'>
	<tr>
		<td class='forumheader3' colspan='2'>".GB_LAN_NOTICE."</td>
	</tr>";

//-----------------------------------------------------------------------------------------------------------+

if( (USER && !( getperms("P") || check_class($pref['guestbook_moderator_class']) )) || ( (getperms("P") || check_class($pref['guestbook_moderator_class']) ) && $action != "edit") )
{
	$text .="
	<tr>
		<td class='forumheader3' style='width:80px'>".GB_LAN_NAME."</td>
		<td class='forumheader3'>".USERNAME."</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_EMAIL."</td>
		<td class='forumheader3'>".USEREMAIL."</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_WEBSITE."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='url'   value='".(USERURL?USERURL:"http://")."' /></td>
	</tr>";
}
else
{
	$text .="
	<tr>
		<td class='forumheader3' style='width:80px'>".GB_LAN_NAME."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='50' name='name'  value='$g_name' /></td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_EMAIL."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='email' value='$g_email' /></td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_WEBSITE."</td>
		<td class='forumheader3'><input type='text' class='tbox' style='width:100%' maxlength='128' name='url'   value='".($g_url?"$g_url":"http://")."' /></td>
	</tr>";
}

//-----------------------------------------------------------------------------------------------------------+

$text .="
	<tr>
		<td class='forumheader3'>".GB_LAN_COMMENT."</td>
		<td class='forumheader3'>
		<textarea name='comment' class='tbox' style='width:100%;height:100px' rows='10' cols='60' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>$g_comment</textarea>
		$text_bbcode
		</td>
	</tr>
	$text_emote";

if ($use_securecode)
{
$text .= "
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'>".GB_LAN_SECURE."
		<input type='hidden' name='rand_num' value='".$securecodeimg = $sec_img->random_number."'>
		".$sec_img->r_image()." 
		<input class='tbox' type='text' name='code_verify' size='15' maxlength='20'>
		</td>
	</tr>";
}

$text .= "
	<tr>
		<td class='forumheader' colspan='2' style='text-align:center'>
		<input type='submit' name='".($action=="edit"?"guestbook_update":"guestbook_submit")."' class='button' value='".GB_LAN_SUBMIT."' />
		</td>
	</tr>
	</table>
	</form>

	<br />
	<br />
	</div>";

//-----------------------------------------------------------------------------------------------------------+

  if ($action == "edit")
  {
    $ns ->tablerender($pref['guestbook_title'], $text); require_once(FOOTERF); exit;
  }
  
//-----------------------------------------------------------------------------------------------------------+


$text.="<br />
	<br />
	<center>
	<div style='text-align:center'>";
	
$entries_total = $sql->db_Count("guestbook","(*)", "WHERE block ='1' ");

if (!$sql->db_Select("guestbook", "*", "block = 1 ORDER BY id $order LIMIT $from,$records"))
{
	$text .="<div style='text-align:center'><b>".GB_LAN_ADM_28."</b></div>";
}
else
{
	$commentList = $sql->db_getList();

	foreach ($commentList as $row)
	{
		$text .= rendercomment($row, "short");
	}
	$text.="</div>
	</center>";
}


  if($pref['guestbook_enclose'])
  {
    $ns -> tablerender($pref['guestbook_title'], $text);
  }
  else
  {
    echo $text;
  }

$parms = $entries_total.",".$records.",".$from.",".e_SELF.'?[FROM].'.$records.".".$order;
echo "<div class='nextprev'>&nbsp;".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";


function rendercomment($id)
{
	global $sql, $pref, $tp, $sc_style, $guestbook_shortcodes,$GB_TEMPLATE;
	
	if(is_array($id))
	{
		$user = $uid;
	}
	else
	{
		if(!$user = get_user_data($uid))
		{
			return FALSE;
		}
	}

	return $tp->parseTemplate($GB_TEMPLATE, TRUE, $guestbook_shortcodes);

}

require_once(FOOTERF);
?>