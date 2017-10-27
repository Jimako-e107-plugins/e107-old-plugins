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

require_once($pdir."/tut_funcs.php");

if(e_QUERY){
	$qs = explode(".", e_QUERY);
}

if($qs[0] != "cat" && $qs[0] != "tut"){
	header("location:".$pdir."/admin_tut.php");
	exit;
}

function build_selection($curr){
	global $rs;
	$sql = new db();
	$sql->db_Select("tutsplugin_cats", "*", "1 ORDER BY id DESC");
	$text = $rs->form_select_open("type");
		$text .= $rs->form_option(TUT_REM_CAT_METHOD_DELETE, NULL, "delete");
		while($r=$sql->db_Fetch()){
			if($r['id'] != $curr){
				$text .= $rs->form_option(TUT_REM_CAT_METHOD_MOVE.$r['name'], NULL, $r['id']);
			}
		}
	$text .= $rs->form_select_close();
	return $text;
}

if($qs[0] == "cat"){
	if($_POST['cat_id']){
		$sql->db_Select("tutsplugin_cats", "*", "id='".$_POST['cat_id']."'");
		if($row=$sql->db_Fetch()){
			
			if($sql->db_Delete("tutsplugin_cats", "id='".$_POST['cat_id']."'")){
				$message = TUT_REM_CAT_SUCC;
				if($_POST['type'] == "delete"){
					if($sql->db_Delete("tutsplugin_tutorial", "catID='".$_POST['cat_id']."'")){
						$message .= '<br />'.TUT_REM_CAT_DEL_SUCC;
					}else{
						$message .= '<br />'.TUT_REM_CAT_DEL_FAIL;
					}
				}else{
					if($c=$sql->db_Update("tutsplugin_tutorial", "catID='".$_POST['type']."' WHERE catID='".$_POST['cat_id']."'")){
						$sql->db_Select("tutsplugin_cats", "indexed", "id='".$_POST['type']."'");
						$r=$sql->db_Fetch();
						$indexed=$r['indexed']+$c;
						$sql->db_Update("tutsplugin_cats", "indexed='".$indexed."' WHERE id='".$_POST['type']."'");
						$message .= '<br />'.TUT_REM_CAT_MOV_SUCC;
					}else{
						$message .= '<br />'.TUT_REM_CAT_MOV_FAIL;
					}
				}
			}else{
				$message .= TUT_REM_CAT_FAIL;
			}
		}else{
			$message = TUT_REM_CAT_NOEXIST;
		}
	}else{
		$sql->db_Select("tutsplugin_cats", "*", "1 ORDER BY id DESC");
		$text = $TABLE_START;
		$count=0;
		while($row = $sql->db_Fetch()){
			$count++;
			$formurl = e_SELF."?".e_QUERY;
			$text .= $rs -> form_open("post", $formurl, "dataform", "", "enctype='multipart/form-data'");
			$text .='
				<tr>
					<td class="fcaption">#'.$count.'</td>
					<td class="forumheader3">'.stripslashes($tp->toHTML($row['name'])).'</td>
					<td class="forumheader3">';
			$text .= build_selection($row['id']);
			$text .='<input type="hidden" name="cat_id" id="cat_id" value="'.$row['id'].'" /><input type="image" name="delete" id="delete" src="'.$pdir.'/images/waste.png" onclick="submit()" />
				</tr>';
			$text .= $rs->form_close();
		}
		$text .= $TABLE_END;
	}
}else if($qs[0] == "tut"){
	if($_POST['tut_id']){
		$sql->db_Select("tutsplugin_tutorial", "*", "id='".$_POST['tut_id']."'");
		if($r=$sql->db_Fetch()){
			if($sql->db_Delete("tutsplugin_tutorial", "id='".$_POST['tut_id']."'")){
				$sql->db_Select("tutsplugin_cats", "*", "id='".$r['catID']."'");
				$row=$sql->db_Fetch();
				$indexed = $row['indexed']-1;
				if($indexed < 0){
					$indexed = 0;
				}
				$sql->db_Update("tutsplugin_cats", "indexed='$indexed' WHERE id='".$r['catID']."'");
				$message .= TUT_REM_TUT_SUCC;
			}else{
				$message .= TUT_REM_TUT_FAIL;
			}
		}else{
			$message .= TUT_REM_TUT_NOEXIST;
		}
	}else if(is_numeric($qs[1])){
		$text .= $TABLE_START;
		$sql->db_Select("tutsplugin_tutorial", "*", "catID='".$qs[1]."' ORDER BY id DESC");
		$count=0;
		while($row=$sql->db_Fetch()){
			$count++;
			$formurl = e_SELF."?tut";
			$text .= $rs -> form_open("post", $formurl, "dataform", "", "enctype='multipart/form-data'");
			$text .='
				<tr>
					<td class="fcaption">#'.$count.'</td>
					<td class="forumheader3">'.stripslashes($tp->toHTML($row['name'])).'</td>
					<td class="forumheader3">'.$rs->form_hidden("tut_id", $row['id']).'<input type="image" name="delete" id="delete" src="'.$pdir.'/images/waste.png" onclick="submit()" /></td>
				<tr>';
			$text .= $rs -> form_close();
		}
		$text .= $TABLE_END;
	}else{
		$text .= $TABLE_START;
		$sql->db_Select("tutsplugin_cats", "*", "1 ORDER BY id DESC");
		$count = 0;
		while($r=$sql->db_Fetch()){
			$count++;
			$text .='
				<tr>
					<td class="fcaption">#'.$count.'</td>
					<td class="forumheader3"><a href="'.$pdir.'/admin_remove.php?tut.'.$r['id'].'">'.stripslashes($tp->toHTML($r['name'])).'</a></td>
				</tr>';
		}
		$text .= $TABLE_END;
	}
}

if($message){
	$ns->tablerender("", "<div style='text-align:center'><b>$message</b></div>");
}

$ns->tablerender(TUT_ADMIN_TITLE, $text);
require_once(e_ADMIN."footer.php");

?>