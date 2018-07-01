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
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
//require_once(e_HANDLER.'form_handler.php');
//require_once("guestbook_class.php");

  if (!getperms("P")) {
		header("location:".e_BASE."index.php");
	}
 
//-----------------------------------------------------------------------------------------------------------+

  @include_once(e_PLUGIN."guestbook/languages/".e_LANGUAGE.".php");
  @include_once(e_PLUGIN."guestbook/languages/English.php");

$e_sub_cat = 'notify';
$nc = new notify_config;

class notify_config {

	var $notify_prefs;

	function notify_config()
	{
		global $sysprefs, $eArrayStorage, $tp, $sql,$pref;
		$this -> notify_prefs = $sysprefs -> get('notify_prefs');
		$this -> notify_prefs = $eArrayStorage -> ReadArray($this -> notify_prefs);
	}

	function config()
	{
		global $ns,$tp;
		$text = "<div style='text-align:left;font-weight:bold'>( ";

		foreach ($this -> notify_prefs['plugins'] as $plugin_id => $plugin_settings)
		{
			if(is_readable(e_PLUGIN.'guestbook/e_notify.php') && $plugin_id =="guestbook")
			{
				require(e_PLUGIN.$plugin_id.'/e_notify.php');
				foreach ($config_events as $event_id => $event_text)
				{
					$text .= (($this -> notify_prefs['event'][$event_id]['type'] == 'off' || !$this -> notify_prefs['event'][$event_id]['type']) ? GB_LAN_NT_7 : GB_LAN_NT_8);
				}
			}
		}
		$text .=" )</div>";
		return $text;
	}
}

if (e_QUERY)
{
	$tmp = explode(".", e_QUERY);
	$action = $tmp[0];
	$sub_action = $tmp[1];
	$id = $tmp[2];
	$block = $tmp[3];
	$from = ($tmp[4] ? $tmp[4] : 0);
	unset($tmp);
}

$from = (isset($from)) ? $from : 0;
$amount = $pref['guestbook_posts'];

//-----------------------------------------------------------------------------------------------------------+

if($_POST['updatesettings'])
{
	$pref['guestbook_posts']   = $_POST['guestbook_posts'];
	$pref['guestbook_enclose'] = $_POST['guestbook_enclose'];
	$pref['guestbook_title']   = $_POST['guestbook_title'];
	$pref['guestbook_bbcode']  = $_POST['guestbook_bbcode'];
	$pref['guestbook_repeat']  = $_POST['guestbook_repeat'];
	$pref['guestbook_nolinks'] = $_POST['guestbook_nolinks'];
	$pref['guestbook_hideurl'] = $_POST['guestbook_hideurl'];
	$pref['guestbook_securecode'] = $_POST['guestbook_securecode'];
	$pref['guestbook_edittime'] = $_POST['guestbook_edittime'];
	$pref['guestbook_moderator_class']  = $_POST['guestbook_moderator_class'];
	$pref['guestbook_moderate'] = $_POST['guestbook_moderate'];
	save_prefs();

	message_handler("ADMIN_MESSAGE", GB_LAN_ADM_18);
}

if (!e_QUERY || $action =="main")
{
	show_prefs($action);
}

if ($action =="overview" || $action =="viewnew" || $action =="viewblock")
{
	global $action,$sub_action;
	
	view_comments($action,$sub_action,$id,$block,$from,$amount);
}

function view_comments($action,$sub_action,$id,$block,$from,$amount)
{
	global $action,$sub_action,$from,$id,$block,$sql,$ns,$tp,$pref,$gbook;

	if ($sub_action=="admindelete")
	{
		if($sql->db_Delete("guestbook","id='".$id."' "))		
		message_handler("MESSAGE", GB_LAN_ADM_25.$id.GB_LAN_ADM_27);
		
	}

	if ($sub_action=="adminblock")
	{
		if($sql->db_Update("guestbook","block='".$block."' WHERE id='".$id."' "))
		{		
		message_handler("MESSAGE", GB_LAN_ADM_25.$id.($block=="2"? GB_LAN_ADM_31:GB_LAN_ADM_26));
		}
	}
	if ($sub_action=="adminactivate")
	{
		if($sql->db_Update("guestbook", "block='1' WHERE id='".$id."' "))		
		message_handler("ADMIN_MESSAGE", GB_LAN_ADM_25.$id.GB_LAN_ADM_26);

	}
	
	$sub_action = "admin";
	unset ($id);
	if ($action =="viewnew")
	{
		$list="WHERE block ='0'";
	}
	else if($action=="viewblock")
	{
		$list="WHERE block ='2'";
	}
	else
	{
		$list="WHERE block !='0'";
	}
	
	if($gbook_total = $sql->db_Select("guestbook" , "*", $list." ORDER BY id DESC LIMIT $from,$amount", $mode=""))
	{
		$gbArray = $sql -> db_getList();
     	foreach($gbArray as $entry)
		{
	 		$id = $entry['id'];
        	$name = $entry['name'];
			$email = $entry['email'];
			$url = $entry['url'];
			$date = $entry['date'];
			$ip = $entry['ip'];
			$host = $entry['host'];
			$comment = $entry['comment'];
			$user = $entry['user'];
			$block = $entry['block'];

			$comment = $tp->toEmail($comment);
		    if(!$pref['guestbook_bbcode'])
	 		{
				$comment = strip_tags($comment, "<br>");
    		}
			switch ($block)
			{
	    		case "0":
    			$status 	= "<img src='".e_IMAGE."fileinspector/integrity_fail.png' alt='".GB_LAN_ADM_23."' title='".GB_LAN_ADM_23."'>".GB_LAN_ADM_23;
	  			$gb_action	= "<span class='button'  ><a href='".e_SELF."?viewnew.adminactivate.$id.1'>".GB_LAN_ADM_5."</a></span>&nbsp;
					  <span class='button' ><a href='".e_SELF."?viewnew.admindelete.$id.0'>".GB_LAN_ADM_6."</a></span>";
				break;

				case "1":
				$status = "<img src='".e_IMAGE."fileinspector/integrity_pass.png' alt='".GB_LAN_ADM_24."' title='".GB_LAN_ADM_24."'>".GB_LAN_ADM_24;
				$gb_action	= "<span class='button'><a href='".e_SELF."?overview.adminblock.$id.2'>".GB_LAN_ADM_9."</a></span>&nbsp;
						<span class='button'><a href='".e_SELF."?overview.admindelete.$id.0'>".GB_LAN_ADM_6."</a></span>";
				break;

				case "2":
				$status = "<img src='".e_IMAGE."fileinspector/warning.png' alt='".GB_LAN_ADM_32."' title='".GB_LAN_ADM_32."'>".GB_LAN_ADM_32;
				$gb_action	= "<span class='button'><a href='".e_SELF."?viewblock.adminblock.$id.1'>".GB_LAN_ADM_5."</a></span>&nbsp;
						<span class='button'><a href='".e_SELF."?overview.admindelete.$id.0'>".GB_LAN_ADM_6."</a></span>";
				break;
			}
    		$con = new convert;
    		$gb_date = $con -> convert_date($date, long);

			$ip_public  = $ip;
    		$ip_private = ( (getperms("P") || check_class($pref['guestbook_moderator_class'])) ? $ip:"");
    		$host_public  = $host;
    		$host_private = ( (getperms("P") || check_class($pref['guestbook_moderator_class'])) ? $host:"");

			$text.="<table class='forumheader' style='width:98%' cellpadding='0' cellspacing='0'>
			<th colspan='4' class='fcaption' style='text-align:center'>".GB_LAN_ADM_1.": ".$id."</th>
			<tr>
			<td class='forumheader' style='width:100px'>".GB_LAN_ADM_2."</td>
			<td class='forumheader2'>".$name."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width:100px'>".GB_LAN_ADM_3."</td>
	    	<td class='forumheader2' >".$status."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width:100px'>".GB_LAN_ADM_7."</td>
    		<td class='forumheader2' >".$gb_date."</td>
			</tr>
			<tr>
			<td class='forumheader' style='width:100px'>".GB_LAN_ADM_8."</td>
    		<td class='forumheader2' ><a title='".$ip_private."'>".$host_private."</a></td>
			</tr>
			<tr>
			<td class='forumheader' style='vertical-align:top'>".GB_LAN_ADM_1."</td>
			<td class='forumheader3 tbox' >".
			$tp->toHTML($comment)."
			</td>
			</tr>
			<tr>
			<td colspan='2' class='forumheader' style='height:30px;text-align:center'>".
			$gb_action."
			</td>
			</tr>
			</table>
			<br />
			<br />";
		}
	}

	$entries = $sql->db_Count("guestbook ".$list);

	if ($entries > $amount)
	{
		$parms = "{$entries},{$amount},{$from},".e_SELF."?".(e_QUERY ? "$action.$sub_action.$id.$block." : "main.user_id.desc.")."[FROM]";
		$text .= "<br /><div style='text-align:center;'>".$tp->parseTemplate("{NEXTPREV={$parms}}")."</div>";
	}
	$ns -> tablerender($pref['guestbook_title'], $text);

}

function show_prefs($action)
{
	global $sql,$ns,$pref,$nc;
  $text = "
	<div style='text-align:center'>
	<form method='post' action='".e_SELF."'>
	<table style='width:95%' class='fborder'>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_11."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input class='tbox' type='text' name='guestbook_title' size='20' value='".$pref['guestbook_title']."' maxlength='50' />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_ADM_29."</td>
		<td class='forumheader3' style='text-align:center'>"
		.r_userclass("guestbook_moderator_class", $pref['guestbook_moderator_class'],'off','nobody, member, admin, classes').
		"</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_ADM_10."</td>
		<td class='forumheader3' style='text-align:center'>
		<input class='tbox' type='text' size='5' name='guestbook_posts' value='".$pref['guestbook_posts']."' />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>".GB_LAN_ADM_30."</td>
		<td class='forumheader3' style='text-align:center'>
		<input class='tbox' type='text' size='5' name='guestbook_edittime' value='".$pref['guestbook_edittime']."' />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_12."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_enclose' value='1' ".($pref['guestbook_enclose']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_13."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_bbcode' value='1' ".($pref['guestbook_bbcode']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_14."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_repeat' value='1' ".($pref['guestbook_repeat']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_15."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_nolinks' value='1' ".($pref['guestbook_nolinks']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_16."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_hideurl' value='1' ".($pref['guestbook_hideurl']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_19."<br />
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_securecode' value='1' ".($pref['guestbook_securecode']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader3'>
		".GB_LAN_ADM_22."<br />".($pref['guestbook_moderate']? $nc -> config():"")."
		</td>
		<td class='forumheader3' style='text-align:center'>
		<input type='checkbox' name='guestbook_moderate' value='1' ".($pref['guestbook_moderate']?"checked='checked'":"")." />
		</td>
	</tr>
	<tr>
		<td class='forumheader' style='text-align:center' colspan='2'>
		<input class='button' type='submit' name='updatesettings' value='".GB_LAN_ADM_17."' />
		</td>
	</tr>
	</table>
	</form>
	</div>
	";
	
	$ns -> tablerender($pref['guestbook_title'], $text);
}

function show_options($action)
{
	global $sql;
	if ($action == "")
	{
		$action = "main";
	}
	$var['main']['text'] = GB_LAN_M_2;
	$var['main']['link'] = e_SELF;

	$var['overview']['text'] = GB_LAN_M_3;
	$var['overview']['link'] = e_SELF."?overview.admin";
	
	$gcount =	$sql->db_Count("guestbook WHERE block='0'");
	if($gcount)
	{	
		$var['viewnew']['text'] = GB_LAN_M_4."&nbsp;(".$gcount.")";
		$var['viewnew']['link'] = e_SELF."?viewnew.admin";
	}

	$bcount =	$sql->db_Count("guestbook WHERE block='2'");
	if($bcount)
	{	
		$var['viewblock']['text'] = GB_LAN_M_5."&nbsp;(".$bcount.")";
		$var['viewblock']['link'] = e_SELF."?viewblock.admin";
	}	
	show_admin_menu(GB_LAN_M_1, $action, $var);
}

function admin_guestbook_adminmenu()
{
	global $pnlpost;
	global $action;
	show_options($action);
}
	require_once(e_ADMIN."footer.php");
?>
