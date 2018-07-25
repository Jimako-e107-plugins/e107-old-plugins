<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
require_once(e_HANDLER."ren_help.php");
require_once(e_HANDLER."emote.php");
$WYSIWYG = $pref['wysiwyg'];
$e_wysiwyg = "mgblog_rectext";
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
if(USER === false){ header("location:".e_BASE."index.php"); }
// ============= START OF THE BODY ====================================
if ($sql -> db_Count('macgurublog_main', '(*)', 'where blog_uid='.USERID) == 1 || !$pref['macgurublog_2']) {
	if (IsSet($_POST['mgblog_recsend'])) {
		//save entry
		$entry_title = $tp->toDB($_POST["mgblog_rectitle"]);
		$entry_text = $tp->toDB($_POST["mgblog_rectext"]);
		$t = time();
		$uid = USERID;
		if ($entry_text != NULL) {
			$sql -> db_Insert("macgurublog_rec", "0, $uid, $t, '$entry_title', '$entry_text', ".intval($_POST["mgblog_reccat"]));
			$msg = MACGURUBLOG_MENU_18;
		} else {
			$msg = MACGURUBLOG_MENU_19;
		}
		$ns -> tablerender('', '<div style="text-align:center;">'.$msg.'</div>');
	} elseif (IsSet($_POST['submitupload'])) {
		//handle uploaded file
		$pref['upload_storagetype'] = "1";
		require_once(e_HANDLER."upload_handler.php");
		$udirbase = e_IMAGE."blog/".USERID."/";
		if (!is_dir($udirbase)) {
			@mkdir($udirbase);
		}		
		$uploaded = file_upload($udirbase);
		foreach($_POST['uploadtype'] as $key=>$uploadtype){
			if($uploadtype == "thumb"){
				rename($udirbase.$uploaded[$key]['name'],$udirbase."thumb_".$uploaded[$key]['name']);
			} elseif ($uploadtype == "resize") {
				$rval = (!empty($_POST['resize_value']) ? $_POST['resize_value'] : 100);
				require_once(e_HANDLER."resize_handler.php");
				resize_image($udirbase.$uploaded[$key]['name'], $udirbase.$uploaded[$key]['name'], $rval, "copy");
			}
		}
		$be_title = $_POST['mgblog_rectitle'];
		$be_text = $_POST['mgblog_rectext'];
		$be_cid = $_POST["mgblog_reccat"];
	}
	$sql -> db_Select("macgurublog_tag", "*", "blogtag_uid=".USERID);
	while($row = $sql-> db_Fetch()){
		$cats[$row['blogtag_id']] = $row['blogtag_text'];
	}
	asort($cats);
	$cats[0] = MACGURUBLOG_MENU_114;
	foreach($cats as $cid=>$cat) {
		$ncats .= '<option value="'.$cid.'"'.($be_cid == $cid ? ' selected="selected" ' : '').'>'.$cat."</option>\n";
	}
	
	echo("<form method=\"post\" action=\"".e_SELF."\" name=\"macgurublog_addentry\" id=\"entryform\" enctype=\"multipart/form-data\">");
	$text = "<div style='text-align:center'>
	<table style=\"width:85%\" class=\"fborder\">
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".MACGURUBLOG_MENU_15.":</td>
	<td style=\"width:60%\" class='forumheader3'>
	<input class=\"tbox\" type=\"text\" name=\"mgblog_rectitle\" size=\"40\" maxlength=\"100\" value=\"${be_title}\" />
	</td>
	</tr>
	<tr>
	<td style=\"width:40%\" class='forumheader3'>".MACGURUBLOG_MENU_116.":</td>
	<td style=\"width:60%\" class='forumheader3'>
	<select class=\"tbox\" name=\"mgblog_reccat\" style=\"width: 200px;\">
	".$ncats."
	</select>
	</td>
	</tr>
	<tr>
	<td style=\"width:100%\" class='forumheader3' colspan=\"2\">
	<div>".MACGURUBLOG_MENU_16.":</div>
	<div style=\"text-align:center;\">
	<textarea class=\"tbox\" style=\"width:95%;\" type=\"text\" name=\"mgblog_rectext\" rows='15' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'>${be_text}</textarea>
	</div>
	".($WYSIWYG ? '' : "<div style=\"text-align:center;\">
	<input class='helpbox' type='text' name='helpr' id='helpr' size='100' readonly=\"readonly\" /> <br />
	".display_help('helpr')."<br />".r_emote()."
	</div>")."
	</td>
	</tr>
	<tr style=\"vertical-align:top\"> 
	<td colspan=\"2\"  style=\"text-align:center;\" class='forumheader'>
	<input class=\"button\" type=\"submit\" name=\"mgblog_recsend\" value=\"".MACGURUBLOG_MENU_17."\" />
	</td>
	</tr>
	</table>
	</div>";
	$ns -> tablerender($pref['macgurublog_11'], $text);
	
	//file uploading
	if ($pref['macgurublog_14'] && $pref['upload_enabled']) {
		if (file_exists(e_LANGUAGEDIR.e_LANGUAGE."/admin/lan_newspost.php")) {
			require_once(e_LANGUAGEDIR.e_LANGUAGE."/admin/lan_newspost.php");
		} else {
			require_once(e_LANGUAGEDIR."English/admin/lan_newspost.php");
		}
		$fileuploadsection = "<div style='text-align:center;'><div style='width:85%;margin:auto;'>\n";
		if (!is_writable(e_FILE."downloads")) {
			$fileuploadsection .= LAN_UPLOAD_777."<b>".str_replace("../","",e_FILE."downloads/")."</b><br /><br />";
		} if (!is_writable(e_IMAGE."newspost_images")) {
			$fileuploadsection .= LAN_UPLOAD_777."<b>".str_replace("../","",e_IMAGE."newspost_images/")."</b><br /><br />";
		}

		$up_name = array(LAN_NEWS_24,NWSLAN_67,LAN_NEWS_22);
		$up_value = array("resize","image","thumb");

		$fileuploadsection .= "<div id='up_container' >
		<span id='upline' style='white-space:nowrap'>
		<input class='tbox' type='file' name='file_userfile[]' size='40' />
		<select class='tbox' name='uploadtype[]'>";
		for ($i=0; $i<count($up_value); $i++)
		{
			$selected = ($_POST['uploadtype'] == $up_value[$i]) ? "selected='selected'" : "";
			$fileuploadsection .= "<option value='".$up_value[$i]."' $selected>".$up_name[$i]."</option>\n";
		}

		$fileuploadsection .="</select>&nbsp;</span>

		</div>
		<table style='width:100%'>
		<tr><td><input type='button' class='button' value='".LAN_NEWS_26."' onclick=\"duplicateHTML('upline','up_container');\"  /></td>
		<td><span class='smalltext'>".LAN_NEWS_25."</span>&nbsp;<input class='tbox' type='text' name='resize_value' value='".($_POST['resize_value'] ? $_POST['resize_value'] : '100')."' size='3' />&nbsp;px</td>
		<td><input class='button' type='submit' name='submitupload' value='".NWSLAN_66."' /></td>
		</tr></table>";
		$ns -> tablerender(MACGURUBLOG_MENU_128, $fileuploadsection);
	}
	echo("</form>");
} else {
	$text = '<div style="text-align:center">'.MACGURUBLOG_MENU_88.'</div>';
	$ns -> tablerender($pref['macgurublog_11'], $text);
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>