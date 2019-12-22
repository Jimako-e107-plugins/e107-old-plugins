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

$eplug_admin = TRUE;

require_once("../../class2.php");

if(!getperms("P")) { header("location:".e_BASE."index.php"); exit; }

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English.php");
}

if (file_exists(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php")) {
	include_once(e_PLUGIN."chatbox2/languages/".e_LANGUAGE."/".e_LANGUAGE."_config.php");
} else {
	include_once(e_PLUGIN."chatbox2/languages/English/English_config.php");
}

require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");

$text="";


if (isset($_POST['mj_editmess'])){
	$mj_mess=$_POST['mj_editmess'];
	$mj_editid=$_POST['mj_editid'];

	$search[0] = "/\s/si";
	$replace[0] = " ";
	$search[1] = "#\[.*?\](.*?)\[/.*?\]#s";
	$replace[1] = "\\1";
	$mj_mess = preg_replace($search, $replace, $mj_mess);
	$mj_mess = $tp -> toDB($mj_mess);

	$new_message = preg_replace("#\[.*?\](.*?)\[/.*?\]#s", "\\1", $mj_mess);

	$work=mysql_query("UPDATE ".MPREFIX."chatbox2 SET cb2_message='$new_message' WHERE cb2_id='$mj_editid'");

	if (!$work){
		die ("Error: ".mysql_error());
	}

	$mj_send=e_PLUGIN."chatbox2/chat2.php";
	header("Location: $mj_send");
	$text .="Changed OK... please wait...!";

}



if (isset($_GET['id'])){

	$mj_message=$_GET['id'];

	$work=mysql_query("SELECT * FROM ".MPREFIX."chatbox2 WHERE cb2_id=$mj_message");
	$row=mysql_fetch_array($work);

	$text="
		<table width='60%'>
		<tr>
			<td class='center'>
				<b>".NT_LAN_CB2_3.":</b> ".$row['cb2_nick']." <b> ".NT_LAN_CB2_4.":</b> ".$row['cb2_ip']."
			</td>
		</tr>
	";

	$text .="
		<table width='60%'>
		<tr>
			<td class='center'>
				<b>".NT_LAN_CB2_5."</b>
			</td>
		</tr>
		<tr>
			<td class='center'>
				<form name='mj_edit' action='editchat2.php' method='POST'>
					<textarea rows='4' cols='30' name='mj_editmess'>".$row['cb2_message']."</textarea>
					<br /><br />
					<input type='submit' value='".CB2_L4."'>
					<input type='hidden' name='mj_editid' value=".$row['cb2_id'].">
				</form>
			</td>
		</tr>
		</table>
	";

}

// else

// header location back to chat

$ns->tablerender(CB2LAN_20, $text);

require_once(e_ADMIN."footer.php");
?>