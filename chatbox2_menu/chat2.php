<?php
/*
################################################################
#
#	CHATBOX II
#
#		Billy Smith
#		http://www.vitalogix.com
#		chicks_hate_me@hotmail.com
#
#	Designed for use with the e107 website system.
#		http://e107.org
#
#	Released under the terms and conditions of the GNU GPL.
#		GNU General Public License (http://gnu.org)
#
#	Leave Acknowledgements in ALL Distributions and derivatives.
#
################################################################
*/

require_once("../../class2.php");

if (file_exists(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2_menu/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2_menu/languages/English/English.php");
}
require_once(HEADERF);

$sql->db_Select("menus", "*", "menu_name='chatbox2_menu'");
$row = $sql->db_Fetch();

if (!check_class($row['menu_class'])) {
	$ns->tablerender(CB2_L23, "<div style='text-align:center'>".CB2_L24."</div>");
	require_once(FOOTERF);
	exit;
}

if(!isset($pref['cb2_mod_class']))
{
	$pref['cb2_mod_class'] = e_UC_ADMIN;
}
define("CB2_MOD", check_class($pref['cb2_mod_class']));

if($_POST['moderate'] && CB2_MOD)
{
	if(isset($_POST['block']))
	{
		foreach(array_keys($_POST['block']) as $k){ $kk[] = intval($k); }
		$blocklist = implode(",", $kk);
		$sql->db_Select_gen("UPDATE #chatbox2 SET cb2_blocked=1 WHERE cb2_id IN ({$blocklist})");
	}

	if(isset($_POST['unblock']))
	{
		foreach(array_keys($_POST['unblock']) as $k){ $kk[] = intval($k); }
		$unblocklist = implode(",", $kk);
		$sql->db_Select_gen("UPDATE #chatbox2 SET cb2_blocked=0 WHERE cb2_id IN ({$unblocklist})");
	}

	if(isset($_POST['delete']))
	{
		$deletelist = implode(",", array_keys($_POST['delete']));
		$sql -> db_Select_gen("SELECT c.cb2_id, u.user_id FROM #chatbox2 AS c
		LEFT JOIN #user AS u ON SUBSTRING_INDEX(c.cb2_nick,'.',1) = u.user_id
		WHERE c.cb2_id IN (".$deletelist.")");
		$rowlist = $sql -> db_getList();
		foreach ($rowlist as $row) {
			$sql -> db_Select_gen("UPDATE #user SET user_chats=user_chats-1 where user_id = ".intval($row['user_id']));
		}
		$sql -> db_Select_gen("DELETE FROM #chatbox2 WHERE cb2_id IN ({$deletelist})");
	}
	$e107cache->clear("nq_chatbox2");
	$message = CB2_L18;
}

// when coming from search.php
if (strstr(e_QUERY, "fs")) {
	$cgtm = str_replace(".fs", "", e_QUERY);
	$fs = TRUE;
}
// end search

if (e_QUERY ? $from = e_QUERY : $from = 0);

$chat_total = $sql->db_Count("chatbox2");

$qry_where = (CB2_MOD ? "1" : "cb2_blocked=0");

// when coming from search.php calculate page number
if ($fs) {
	$page_count = 0;
	$row_count = 0;
	$sql->db_Select("chatbox2", "*", "{$qry_where} ORDER BY cb2_datestamp DESC");
	while ($row = $sql -> db_Fetch()) {
		if ($row['cb2_id'] == $cgtm) {
			$from = $page_count;
			break;
		}
		$row_count++;
		if ($row_count == 30) {
			$row_count = 0;
			$page_count += 30;
		}
	}
}
// end search

$sql->db_Select("chatbox2", "*", "{$qry_where} ORDER BY cb2_datestamp DESC LIMIT ".intval($from).", 30");
$obj2 = new convert;

$chatList = $sql->db_getList();
foreach ($chatList as $row)
{
	$CHAT_TABLE_DATESTAMP = $obj2->convert_date($row['cb2_datestamp'], "long");
	$CHAT_TABLE_NICK = preg_replace("/[0-9]+\./", "", $row['cb2_nick']);
	$cb2_message = $tp->toHTML($row['cb2_message'], TRUE,'USER_BODY');

	if($row['cb2_blocked'])
	{
		$cb2_message .= "<br />".CB2_L25;
	}
	if(CB2_MOD)
	{
		$cb2_message .= "<br /><input type='checkbox' name='delete[{$row['cb2_id']}]' value='1' />".CB2_L10;
		if($row['cb2_blocked'])
		{
			$cb2_message .= "&nbsp;&nbsp;&nbsp;<input type='checkbox' name='unblock[{$row['cb2_id']}]' value='1' />".CB2_L7;
		}
		else
		{
			$cb2_message .= "&nbsp;&nbsp;&nbsp;<input type='checkbox' name='block[{$row['cb2_id']}]' value='1' />".CB2_L9;
		}

		$cb2_message .= "&nbsp;&nbsp;&nbsp;<a href='editchat2.php?id=".$row['cb2_id']."'><img src='images/edit_16.png' alt='Edit' border='0' /></a>&nbsp;".CB2_L26;

	}

	$CHAT_TABLE_MESSAGE = $cb2_message;
	$CHAT_TABLE_FLAG = ($flag ? "forumheader3" : "forumheader4");

	if (!$CHAT_TABLE) {
		if (file_exists(THEME."chat_template.php"))
		{
			require_once(THEME."chat_template.php");
		}
		else
		{
			require_once(e_PLUGIN."chatbox2_menu/chat2_template.php");
		}
	}
	$textstring .= preg_replace("/\{(.*?)\}/e", '$\1', $CHAT_TABLE);
	$flag = (!$flag ? TRUE : FALSE);
}

$textstart = preg_replace("/\{(.*?)\}/e", '$\1', $CHAT_TABLE_START);
$textend = preg_replace("/\{(.*?)\}/e", '$\1', $CHAT_TABLE_END);
$text = $textstart.$textstring.$textend;
if(CB2_MOD)
{
	$text = "<form method='post' action='".e_SELF."'>".$text."<input type='submit' class='button' name='moderate' value='".CB2_L13."' /></form>";
}
if($message)
{
	$ns->tablerender("", $message);
}

$ns->tablerender(CB2_L20, $text);


require_once(e_HANDLER."np_class.php");
$ix = new nextprev("chat2.php", $from, 30, $chat_total, CB2_L21);

require_once(FOOTERF);
?>