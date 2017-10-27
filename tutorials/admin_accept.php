<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."ren_help.php");

if (!getperms("P")) {
	header("location:".e_BASE."index.php");
	exit;
}
// Include plugin language file, check first for site's preferred language
$pdir = e_PLUGIN."tutorials";
@include_once($pdir."/languages/".e_LANGUAGE.".php");
@include_once($pdir."/languages/English.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;
require_once(e_HANDLER."mail.php");

require_once($pdir."/tut_funcs.php");
$text = '<script language="javascript" type="text/javascript">
function askRej(e){
	var reject = confirm("'.TUT_ACC_REJECT.'");
	if(reject){
		var reject_r = prompt("'.TUT_ACC_REASON.'", "");
		if(reject_r){
			document.getElementById("sub_type").value = "reject";
			document.getElementById("sub_id").value = e;
			document.getElementById("sub_reason").value = reject_r;
			document.getElementById("acceptForm").submit();
		}
	}
}
function askAcc(e){
	var accept = confirm("'.TUT_ACC_ACCEPT.'");
	if(accept){
		document.getElementById("sub_type").value = "accept";
		document.getElementById("sub_id").value = e;
		document.getElementById("sub_reason").value = "";
		document.getElementById("acceptForm").submit();
	}
}
</script>';

if(e_QUERY){
	$qs = explode(".", e_QUERY);
}

$mail_search = array("{USERNAME}", 	"{SITENAME}",		"{ADMINEMAIL}",			 "{REJECTREASON}",		"{TUTLINK}");
$mail_replace = array("BLANK", 		$pref['sitename'],	$pref['siteadminemail'], $_POST['sub_reason'],	'<a href="'.$pref['siteurl'].'e107_plugins/tutorials/tutorials.php?view.'.$_POST['sub_id'].'">'.$pref['siteurl'].'e107_plugins/tutorials/tutorials.php?view.'.$_POST['sub_id'].'</a>');
if($_POST['sub_type'] == "accept"){
	//Accept tutorial
	if($sql -> db_Update("tutsplugin_tutorial", "accepted='1' WHERE id=".$_POST['sub_id'])){
		$sql->db_Select("tutsplugin_tutorial", "*", "id=".$_POST['sub_id']);
		$r=$sql->db_Fetch();
		echo mysql_error();
		$sql->db_Select("tutsplugin_cats", "*", "id=".$r['catID']);
		$r=$sql->db_Fetch();
		$indexed = $r['indexed'] + 1;
		echo mysql_error();
		$sql->db_Update("tutsplugin_cats", "indexed='$indexed' WHERE id='".$r['id']."'");
		echo mysql_error();
		$message = TUT_ACC_COMPL_ACCEPT;
		if($pref['tuts_allownotify']){
			$sql->db_Select("tutsplugin_tutorial", "*", "id=".$_POST['sub_id']);
			$r=$sql->db_Fetch();
			$author_info = getAuthor($r['poster_id']);
			$mail_replace[0]=$author_info['user_name'];
			$mail_message = str_replace($mail_search, $mail_replace, TUT_EMAIL_MESSAGE_ACCEPT);
			//				TO EMAIL					SUBJECT			MESSAGE				TO NAME					FROM EMAIL				FROM NAME
			if(sendemail($author_info['user_email'], TUT_EMAIL_SUBJ_ACCEPT, $mail_message, $author_info['user_name'], $pref['siteadminemail'],  $pref['sitename'])){
				$message .= '<br />'.str_replace("{USERMAIL}", $author_info['user_email'], TUT_ACC_COMPL_EMAIL);
			}else{
				$message .= '<br /><span style="color:#FF0000;">'.str_replace("{USERMAIL}", $author_info['user_email'], TUT_ACC_FAIL_EMAIL).'</span>';
			}
		}
	}else{
		$message = '<span style="color:#FF0000;">'.TUT_ACC_FAIL_ACCEPT.'</span>';
	}
}else if($_POST['sub_type'] == "reject"){
	//Reject tutorial
	$sql->db_Select("tutsplugin_tutorial", "*", "id=".$_POST['sub_id']);
	$r=$sql->db_Fetch();
	if($sql -> db_Delete("tutsplugin_tutorial", "id=".$_POST['sub_id'])){
		$message = TUT_ACC_COMPL_REJECT;
		if($pref['tuts_allownotify']){
			$author_info = getAuthor($r['poster_id']);
			$mail_replace[0]=$author_info['user_name'];
			$mail_message = str_replace($mail_search, $mail_replace, TUT_EMAIL_MESSAGE_REJECT);
			//				TO EMAIL					SUBJECT			MESSAGE				TO NAME					FROM EMAIL				FROM NAME
			if(sendemail($author_info['user_email'], TUT_EMAIL_SUBJ_REJECT, $mail_message, $author_info['user_name'], $pref['siteadminemail'],  $pref['sitename'])){
				$message .= '<br />'.str_replace("{USERMAIL}", $author_info['user_email'], TUT_ACC_COMPL_EMAIL);
			}else{
				$message .= '<br /><span style="color:#FF0000;">'.str_replace("{USERMAIL}", $author_info['user_email'], TUT_ACC_FAIL_EMAIL).'</span>';
			}
		}
	}else{
		$message = '<span style="color:#FF0000;">'.TUT_ACC_FAIL_REJECT.'</span>';
	}
}

if($message){
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

//Show the list
$sql -> db_Select("tutsplugin_tutorial", "*", "accepted='0' ORDER BY id DESC");
$text.=$TABLE_START;
$count = 0;
while($row = $sql->db_Fetch()){
	$count++;
	$author_info = getAuthor($row['poster_id']);
	$category = getCategory($row['catID']);
	$text .='
	<tr>
		<td class="fcaption">#'.$count.'</td>
		<td class="forumheader3"><a href="'.$pdir.'/tutorials.php?view.'.$row['id'].'">'.stripslashes($tp->toHTML($row['name'])).'</a> - '.$category['name'].'</td>
		<td class="forumheader3"><a href="'.e_BASE.'user.php?id.'.$author_info['user_id'].'">'.stripslashes($tp->toHTML($author_info['user_name'])).'</a></td>
		<td class="forumheader3"><input name="accept" type="image" value="accept" src="'.$pdir.'/images/accept.png" onclick="askAcc('.$row['id'].')" /></td>
		<td class="forumheader3"><input name="deny" type="image" value="deny" src="'.$pdir.'/images/deny.png" onclick="askRej('.$row['id'].')" /></td>
	</tr>
	<tr>
		<td class="fcaption">'.TUT_ACC_SHORTDESC.'</td>
		<td colspan="4" class="forumheader3">'.stripslashes($tp->toHTML($row['shortdesc'], true)).'</td>
	</tr>';
}
$text.=$TABLE_END;

$formurl = e_SELF."?".e_QUERY;
$text .= $rs->form_open("post", $formurl, "acceptForm", "", "enctype='multipart/form-data'");
	$text .= $rs->form_hidden("sub_type", "");
	$text .= $rs->form_hidden("sub_id", "");
	$text .= $rs->form_hidden("sub_reason", "");
$text .= $rs->form_close();

$ns->tablerender(TUT_ADMIN_TITLE, $text);
require_once(e_ADMIN."footer.php");

?>