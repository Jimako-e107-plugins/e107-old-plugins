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
// always include the class2.php file - this is the main e107 file
if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
require_once(e_HANDLER."ren_help.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
require_once(e_HANDLER."file_class.php");
$fl = new e_file;

// this generates all the HTML up to the start of the main section
require_once(HEADERF);

// Include plugin language file, check first for site's preferred language
$pdir = e_PLUGIN."tutorials";
@include_once($pdir."/languages/".e_LANGUAGE.".php");
@include_once($pdir."/languages/English.php");

require_once($pdir."/tut_funcs.php");

if($pref['tuts_allowusersub']){
	//Admin is allowing users to submit tutorials
	if(USER){
		//User is logged in, we have all the authorization info we need, continue to the forms.
		if($_POST['submit_tut']){
			if(!(empty($_POST['iconpath'])||empty($_POST['tut_name'])||empty($_POST['tut_longdesc'])||empty($_POST['cat_id']))){
				if(!$sql -> db_Insert("tutsplugin_tutorial", array(
					'catID' => stripslashes($tp->toDB($_POST['cat_id'])),
					'name' => stripslashes($tp->toDB($_POST['tut_name'])),
					'shortdesc' => stripslashes($tp->toDB($_POST['tut_shortdesc'])),
					'longdesc' => stripslashes($tp->toDB($_POST['tut_longdesc'])),
					'icon' => stripslashes($tp->toDB($_POST['iconpath'])),
					'date' => time(),
					'poster_id' => stripslashes($tp->toDB($_POST['author_id'])),
					'accepted' => '0'
				))){
					$text = "<span style='background-color:#FF5555; display:block; width:100%;'><b>".TUT_ERROR_ADDTUT."</b></span>";
					$ns->tablerender(TUT_ADMIN_TITLE, $text);
					$text = "";
				}else{
					$sql -> db_Select("tutsplugin_cats", "indexed", "id=".$_POST['cat_id']);
					$i=$sql->db_Fetch();
					$text = "<b>".TUT_SUBM_THANKS."</b>";
					$ns->tablerender("", $text);
					$text = "";
				}
			}else{
				$text = "<span style='background-color:#FF5555; color:#FF0000; display:block; width:100%;'><b>".TUT_ERROR_MISS."</b></span>";
				$ns->tablerender("", $text);
				$text = "";
			}
		}else{
			if($_POST['preview_tut']){
				$text = $TABLE_START;
				$dateConv = @gmdate("l, F jS, Y.", time());
				$author_info=getAuthor(USERID);
				$sql -> db_Select("tutsplugin_cats", "name", "id=".$_POST['cat_id']);
				$category = $sql->db_Fetch();
				$text .= "
					<tr>
						<td class='fcaption'>
							<table width='100%' border='0' cellspacing='0' cellpadding='0'>
								<tr>
									<td width='100' rowspan='3' align='center' valign='middle'><img src='".stripslashes($tp->toHTML($_POST['iconpath'], false))."' border='0' alt='' /></td>
								</tr>
								<tr>
									<td valign='top'>".stripslashes($tp->toHTML($_POST['tut_name'], false))."</td>
								</tr>
								<tr>
									<td valign='top'>".stripslashes($tp->toHTML($_POST['tut_shortdesc'], true))."</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class='forumheader3'>".stripslashes($tp->toHTML($_POST['tut_longdesc'], true))."</td>
					</tr>
					<tr>
						<td class='fcaption'>".TUT_VIEW_BY." <a href='#'>".$author_info['user_name']."</a> ".TUT_VIEW_ON." ".$dateConv." ".TUT_VIEW_IN." ".$category['name'].".</td>
					</tr>";
				$text.= $TABLE_END."<br />";
			}
			$text .= $TABLE_START;
			
			$formurl = e_SELF."?".e_QUERY;
			$text .= $rs -> form_open("post", $formurl, "dataform", "", "enctype='multipart/form-data'");
			
			//Category:		|--Select_One--|v|
			$FORM_TOPIC = TUT_TADD_L1;
			$FORM_FIELD = $rs -> form_select_open("cat_id");
			$FORM_FIELD .= $rs -> form_option(" ".TUT_ADMIN_SELECT."  ", NULL, ""); // Mods by e107 Italia
			$sql->db_Select("tutsplugin_cats", "id, name", "1");
			while($row = $sql->db_Fetch()){
				$FORM_FIELD .= $rs->form_option($row['name'], NULL, $row['id']);
			}
			
			$author_info = getAuthor(USERID);
			$FORM_FIELD .= $rs->form_hidden("author_id", $author_info['user_id']);
			$FORM_FIELD .= $rs -> form_select_close();
			$text .= fill_in($TABLE_ROW_BASIC);
		
			//Name:		|______________|
			$FORM_TOPIC = TUT_TADD_L2;
			$FORM_FIELD = $rs -> form_text('tut_name', 60, (isset($_POST['tut_name']) ? stripslashes($tp->toForm($_POST['tut_name'])) : ''), 250);
			$text .= fill_in($TABLE_ROW_BASIC);
			
			//Descrip:	|				|
			//			|_______________|
			$FORM_TOPIC = TUT_TADD_L3;
			$insertjs = "onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
			$FORM_FIELD = $rs -> form_textarea("tut_shortdesc", 50, 6, (isset($_POST['tut_shortdesc']) ? stripslashes($tp->toForm($_POST['tut_shortdesc'])) : ''), $insertjs).'<br />'.display_help("");
			$text .= fill_in($TABLE_ROW_BASIC);
			
			//Text:		|				|
			//			|				|
			//			|				|
			//			|_______________|
			$FORM_TOPIC = TUT_TADD_L4;
			$insertjs = "onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'";
			$FORM_FIELD = $rs -> form_textarea("tut_longdesc", 50, 30, (isset($_POST['tut_longdesc']) ? stripslashes($tp->toForm($_POST['tut_longdesc'])) : ''), $insertjs)."<br />".display_help("");
			$text .= fill_in($TABLE_ROW_BASIC);
			
			//Icon:		|_______________| (_View_)
			$rejectlist = array('$.','$..','/','CVS','thumbs.db','Thumbs.db','*._$', 'index', 'null*', 'thumb_*');
			$iconlist = $fl->get_files(e_IMAGE."/icons","",$rejectlist);
			$FORM_TOPIC = TUT_TADD_L5;
			$FORM_FIELD = $rs -> form_text("iconpath", 80, (isset($_POST['iconpath']) ? stripslashes($tp->toForm($_POST['iconpath'])) : ''), 250)." ".$rs -> form_button("button", '', TUT_BUTTON_VIEWICON, "onclick=\"expandit('divicon')\"").
			"<div id='divicon' style='display:none;'>";
			if(empty($iconlist)){
				$FORM_FIELD .= TUT_TADD_L6;
			}else{
				foreach($iconlist as $icon){
					if(file_exists($icon['path'].$icon['fname'])){
						$img = "<img src='".$icon['path'].$icon['fname']."' style='border:0' alt='' />";
					}
					$FORM_FIELD .= "<a href=\"javascript:insertext('".$icon['path'].$icon['fname']."','iconpath','divicon')\">".$img."</a> ";
				}
			}
			$FORM_FIELD .="</div>";
			$text .= fill_in($TABLE_ROW_BASIC);
			
			//			(_Submit_) (_Preview_)
			$FORM_TOPIC = "";
			$FORM_FIELD = $rs -> form_button("submit", "submit_tut", TUT_BUTTON_SUBMIT) . $rs -> form_button("submit", "preview_tut", TUT_BUTTON_PREVIEW);
			$text .= fill_in($TABLE_ROW_BASIC);
			
			$text .= $rs->form_close();
			$text .= $TABLE_END;
		}
	}else{
		$ns->tablerender(TUT_SUBM_TITLE, TUT_SUBM_AUTH );
		exit; 
	}
}else{
	//Admin has disallowed user submissions, take them back to the homepage.
	header("location: ".e_BASE."index.php");
	exit;
}

// Ensure the pages HTML is rendered using the theme layout.
$ns->tablerender(TUT_SUBM_TITLE, TUT_SUBM_AGREE.'<br />'.$text);

// this generates all the HTML (menus etc.) after the end of the main section
require_once(FOOTERF);
?>