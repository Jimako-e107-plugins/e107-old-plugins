<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (USER === false) {header("location:".e_BASE."index.php");}
require_once(HEADERF);
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}

define("FUID", (getperms("P") && IsSet($_GET['fuid']) ? intval($_GET['fuid']) : USERID));
$ffaction = (getperms("P") && IsSet($_GET['fuid']) ? e_SELF.'?fuid='.intval($_GET['fuid']) : e_SELF);

if (strtoupper($_POST['deleteok']) == 'OK') {
	$sql -> db_Select('macgurublog_rec', 'blogrec_id', 'blogrec_uid='.FUID);
	while($row = $sql-> db_Fetch()){
		$sql -> db_Delete('macgurublog_com', 'blogcom_rid='.$row['blogrec_id']);
	}
	$sql -> db_Delete('macgurublog_rec', 'blogrec_uid='.FUID);
	$sql -> db_Delete('macgurublog_main', 'blog_uid='.FUID);
	$sql -> db_Delete('macgurublog_tag', 'blogtag_uid='.FUID);
	$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_107.'</div>');
	$nowdeleted = true;
} elseif (IsSet($_POST['mgbcreatecat'])) {
	if ($_POST['macgurublog_catnewcapt'] != "") {
		$sql -> db_Insert("macgurublog_tag", "0, ".FUID.", '".$tp->toDB($_POST["macgurublog_catnewcapt"])."'");
		$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_121.'</div>');
	}
} elseif (IsSet($_POST['mgbdelcat'])) {
	$sql -> db_Update('macgurublog_rec', 'blogrec_tag=0 WHERE blogrec_tag='.intval($_POST['mgbcatid']));
	$sql -> db_Delete('macgurublog_tag', 'blogtag_id='.intval($_POST['mgbcatid']));
	$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_122.'</div>');
} elseif (IsSet($_POST['mgbeditcat'])) {
	$sql -> db_Update('macgurublog_tag', "blogtag_text='".$tp->toDB($_POST["mgbnewname"])."' WHERE blogtag_id=".intval($_POST['mgbcatid']));
	$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_123.'</div>');
}
// ============= START OF THE BODY ====================================
if (!$nowdeleted) {
	$text = '';
	$count = $sql->db_Count("macgurublog_main", "(*)", "WHERE blog_uid=".FUID);
	if ($count == 0 && !$pref['macgurublog_2']) {
		//create blog
		$sql -> db_Insert("macgurublog_main", FUID.", '', 1");
	}
	if ($count == 1 || !$pref['macgurublog_2']) {
		//the settings
		if (IsSet($_POST['mgbupdatesettings'])) {
			$macgurublog_title = $tp->toDB($_POST["macgurublog_desc"]);
			if ($_POST["macgurublog_enabled"] == NULL) {
				$macgurublog_enable = '0';
			} else {
				$macgurublog_enable = '1';
			}
			$sql -> db_Update("macgurublog_main", "blog_title='$macgurublog_title', blog_enable=$macgurublog_enable WHERE blog_uid=".FUID);
			$ns -> tablerender('', '<div style="text-align:center">'.MACGURUBLOG_MENU_28.'</div>');
		}
		$sql -> db_Select("macgurublog_main", "*", "blog_uid=".FUID);
		$row = $sql-> db_Fetch();
		$prefcapt[] = MACGURUBLOG_MENU_6;
		$prefname[] = "macgurublog_desc";
		$preftype[] = "text";
		$prefvalu[] = $tp->toForm($row['blog_title']);
		$predvalu[] = $tp->toForm($row['blog_title']);
		$prefcapt[] = MACGURUBLOG_MENU_7;
		$prefname[] = "macgurublog_enabled";
		$preftype[] = "checkbox";
		$prefvalu[] = "1";
		$predvalu[] = $row['blog_enable'];
		
		
		require_once("form_handler.php");
		$rs = new form_mgb;
		$text = "<div style='text-align:center'>
		<form method='post' action='".$ffaction."'>
		<table style='width:94%' class='fborder'>";
		
		for ($i=0; $i<count($prefcapt); $i++) {
			$form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
			$text .="
			<tr>
			<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
			<td style=\"width:70%\" class=\"forumheader3\">";
			$name = $prefname[$i];
			$text .= $rs->  user_extended_element_edit($form_send,$predvalu[$i],$name);
			$text .="</td></tr>";
		};
		
		$text .="<tr style='vertical-align:top'>
		<td colspan='2'  style='text-align:center' class='forumheader'>
		<input class='button' type='submit' name='mgbupdatesettings' value='".MACGURUBLOG_MENU_8."' />
		</td>
		</tr>
		</table>
		</form>
		</div>";
		
		$ns -> tablerender($pref['macgurublog_11'], $text);
		//categories
			//add;
		unset($prefcapt,$prefname,$preftype,$prefvalu,$predvalu);
		$prefcapt[] = MACGURUBLOG_MENU_116;
		$prefname[] = "macgurublog_catnewcapt";
		$preftype[] = "text";
		$prefvalu[] = "";
		$predvalu[] = "";
		$text = "<div style='text-align:center'>
		<form method='post' action='".$ffaction."' name='crcat' id='crcat'>
		<table style='width:94%' class='fborder'>";
		
		for ($i=0; $i<count($prefcapt); $i++) {
			$form_send = $prefname[$i] . "|" .$preftype[$i]."|".$prefvalu[$i];
			$text .="
			<tr>
			<td style=\"width:30%; vertical-align:top\" class=\"forumheader3\">".$prefcapt[$i].":</td>
			<td style=\"width:70%\" class=\"forumheader3\">";
			$name = $prefname[$i];
			$text .= $rs->  user_extended_element_edit($form_send,$predvalu[$i],$name);
			$text .="</td></tr>";
		};
		$text .="<tr style='vertical-align:top'>
		<td colspan='2'  style='text-align:center' class='forumheader'>
		<input class='button' type='submit' name='mgbcreatecat' value='".MACGURUBLOG_MENU_120."' />
		</td>
		</tr>
		</table>
		</form>
		</div>";
		$ns -> tablerender(MACGURUBLOG_MENU_119, $text);
			//del/edit
		$text = '<script language="javascript" type="text/javascript">
		function mgblonchange(o) {
			document.mgbcatsform.mgbnewname.value = o.options[o.selectedIndex].text;
			document.mgbcatsform.mgbeditcat.disabled = false;
			document.mgbcatsform.mgbdelcat.disabled = false;
		}
		function mgbnonchange() {
			if (document.mgbcatsform.newname.value == "") {
				document.mgbcatsform.mgbeditcat.disabled = true;
			} else {
				document.mgbcatsform.mgbeditcat.disabled = false;
			}
		}
		</script>
		'."<div style='text-align:center'>
		<form method='post' name='mgbcatsform' id='mgbcatsform' action='".$ffaction."'>
		<p><select name='mgbcatid' id='mgbcatid' size='5' style='width:200px;' class='tbox' onchange='mgblonchange(this);'>
		";
		$sql -> db_Select("macgurublog_tag", "*", "blogtag_uid=".FUID);
		while($row = $sql-> db_Fetch()){
			$cats[$row['blogtag_id']] = $row['blogtag_text'];
		}
		asort($cats);
		foreach($cats as $cid=>$cat) {
			$text .= '<option value="'.$cid.'">'.$cat."</option>\n";
		}
		$text .='</select></p>
		<div id="cateditdiv">
		<p>Category: <input type="text" class="tbox" name="mgbnewname" id="mgbnewname" maxlength="100" onkeyup="mgbnonchange();" style="width:150px;" /></p>
		<p><input type="submit" name="mgbeditcat" id="mgbeditcat" value="'.MACGURUBLOG_MENU_33.'" disabled="disabled" class="button" />
		<input type="submit" name="mgbdelcat" id="mgbdelcat" value="'.MACGURUBLOG_MENU_14.'" disabled="disabled" class="button" /></p>
		</div></form></div>';
		$ns -> tablerender(MACGURUBLOG_MENU_118, $text);
		
		
		//deletion
		$text = '
		<script type="text/javascript" language="javascript">
		function delchkjs() {
			if (document.getElementById("deleteok").value.toUpperCase() == "OK") {
				document.forms["deleteform"].submit();
			}
		}
		</script>
		<p><strong>'.MACGURUBLOG_MENU_105."</strong></p>
		<form method='post' name='deleteform' id='deleteform' action='".$ffaction."'>
		<p>".MACGURUBLOG_MENU_106.": <input name='deleteok' id='deleteok' type='text' class='tbox' size='10' /></p>
		<p><input type='button' class='button' name='deleterequest' value='".MACGURUBLOG_MENU_14."' onclick='delchkjs();' />
		</form>\n";
		$ns -> tablerender(MACGURUBLOG_MENU_104, "<div style='text-align:center'>${text}</div>");
	} else {
		$text = '<div style="text-align:center">'.MACGURUBLOG_MENU_88.'</div>';
		$ns -> tablerender($pref['macgurublog_11'], $text);
	}
}
// ========= End of the BODY ===================================================
require_once(FOOTERF);
?>