<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/pagerestriction/admin_pagerestriction_config.php,v $
|    $Revision: 1.0 $
|    $Date: 2006/07/23 08:03:58 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

require_once("../../class2.php");
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."userclass_class.php");
require_once(e_HANDLER."form_handler.php");
$rs = new form;
unset($text);

// ##### language -----------------------------------------
@include_once(e_PLUGIN.'pagerestriction/languages/'.e_LANGUAGE.'.php');
@include_once(e_PLUGIN.'pagerestriction/languages/English.php');

// ##### template -----------------------------------------
if (is_readable(THEME."pagerestriction_template.php")) {
	require_once(THEME."pagerestriction_template.php");
	} else {
	require_once(e_PLUGIN."pagerestriction/pagerestriction_template.php");
}

//print_a($_POST);

// ##### update data in database --------------------------
if(isset($_POST['update_pagerestriction'])){
	while(list($key, $value) = each($_POST)){
		if($key != "update_pagerestriction"){
			$loop = 0;

			//plugins
			if(isset($_POST['plugin']) && is_array($_POST['plugin'])){
				foreach($_POST['plugin'] as $k => $v){
					$prpref['protect'][$loop]['type'] = 'plugin';
					$prpref['protect'][$loop]['url'] = $k;
					$prpref['protect'][$loop]['class'] = $v;
					$loop++;
				}
			}

			//pages
			if(isset($_POST['page']) && is_array($_POST['page'])){
				foreach($_POST['page'] as $k => $v){
					$prpref['protect'][$loop]['type'] = 'page';
					$prpref['protect'][$loop]['url'] = $k;
					$prpref['protect'][$loop]['class'] = $v;
					$loop++;
				}
			}

			//new pages
			if(isset($_POST['newpage']) && is_array($_POST['newpage'])){
				if(count($_POST['newpage']['key']) == count($_POST['newpage']['val'])){
					for($i=0;$i<count($_POST['newpage']['key']);$i++){
						if($_POST['newpage']['key'][$i] != LAN_PAGERESTRICTION_10 && $_POST['newpage']['key'][$i] != 'index.php'){
							$prpref['protect'][$loop]['type'] = 'page';
							$prpref['protect'][$loop]['url'] = $_POST['newpage']['key'][$i];
							$prpref['protect'][$loop]['class'] = $_POST['newpage']['val'][$i];
							$loop++;
						}
					}
				}
			}

			//options
			$prpref['option']['pagerestriction_redirect'] = $_POST['pagerestriction_redirect'];
		}
	}
	$tmp = $eArrayStorage->WriteArray($prpref);
//print_a($tmp);
	$sql -> db_Update("core", "e107_value='$tmp' WHERE e107_name='pagerestriction' ");

	$message = LAN_PAGERESTRICTION_9;
}

// ##### check data from database -------------------------
if(!is_object($sql)){ $sql = new db; }
$num_rows = $sql -> db_Select("core", "*", "e107_name='pagerestriction' ");
if($num_rows == 0){
	$sql -> db_Insert("core", "'pagerestriction', '' ");
	$sql -> db_Select("core", "*", "e107_name='pagerestriction' ");
}
$row = $sql -> db_Fetch();
$prpref = $eArrayStorage->ReadArray($row['e107_value']);

// ##### prepare preferences ------------------------------
for($i=0;$i<count($prpref['protect']);$i++){
	if($prpref['protect'][$i]['type'] == 'plugin'){
		$plugin[$prpref['protect'][$i]['url']] = $prpref['protect'][$i]['class'];
	}elseif($prpref['protect'][$i]['type'] == 'page'){
		$pages[$prpref['protect'][$i]['url']] = $prpref['protect'][$i]['class'];
	}
}

// ##### render message -----------------------------------
if(isset($message)){
	$caption = LAN_PAGERESTRICTION_12;
	$ns -> tablerender($caption, $message);
}

$text = $PR_PAGE_START;

// ##### plugin : installed -------------------------------
	if($numbers = $sql2 -> db_Select("plugin", "*", "plugin_installflag = '1' AND plugin_path != 'pagerestriction' ORDER BY plugin_name ")){
		$HEADING = LAN_PAGERESTRICTION_1;
		$HEADING_LEFT = LAN_PAGERESTRICTION_4;
		$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_START);
		while($row2 = $sql2 -> db_Fetch()){
			$plugin_path = $row2['plugin_path'];
			$FIELD_KEY = $row2['plugin_name']." (".$row2['plugin_version'].")";
			$FIELD_VAL = r_userclass("plugin[$plugin_path]", $plugin[$plugin_path], "", "admin,public,guest,nobody,member,classes");
			$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_ROW);
		}
		$text .= $PR_END;
	}

// ##### plugin : uninstalled -----------------------------
	if($numbers = $sql2 -> db_Select("plugin", "*", "plugin_installflag = '0' AND plugin_path != 'pagerestriction' ORDER BY plugin_name ")){
		$HEADING = LAN_PAGERESTRICTION_2;
		$HEADING_LEFT = LAN_PAGERESTRICTION_4;
		$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_START);
		while($row2 = $sql2 -> db_Fetch()){
			$plugin_path = $row2['plugin_path'];
			$FIELD_KEY = $row2['plugin_name']." (".$row2['plugin_version'].")";
			$FIELD_VAL = r_userclass("plugin[$plugin_path]", $plugin[$plugin_path], "", "admin,public,guest,nobody,member,classes");
			$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_ROW);
		}
		$text .= $PR_END;
	}

// ##### page rows ----------------------------------------
	$text .= $PR_PAGEROW_START;
	foreach($pages as $key => $value){
		if(strpos($key, ".php") && $value>0){
			$FIELD_KEY = $key;
			$FIELD_VAL = r_userclass("page[$key]", $value, "", "admin,public,guest,nobody,member,classes");
			$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_PAGEROW_ROW);
		}
	}
	$FIELD_KEY = "<input class='tbox' type='text' name='newpage[key][]' value='".LAN_PAGERESTRICTION_10."' size='30' maxlength='50' onfocus=\"if(this.value=='".LAN_PAGERESTRICTION_10."'){ this.value=''; }\" />";
	$FIELD_VAL = r_userclass('newpage[val][]', '', "", "admin,public,guest,nobody,member,classes");
	$FIELD_BUT = $rs -> form_button("button", "add", LAN_PAGERESTRICTION_11, "onclick=\"duplicateHTML('upline','up_container');\"" );
	$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_PAGEROW_END);

// ##### options ------------------------------------------
	$text .= $PR_OPT_START;

	$FIELD_KEY = LAN_PAGERESTRICTION_14;
	$FIELD_VAL = "<input class='tbox' type='text' name='pagerestriction_redirect' value='".$prpref['option']['pagerestriction_redirect']."' size='50' maxlength='100' />";
	$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_OPT_ROW);

	$text .= $PR_OPT_END;

// ##### page end -----------------------------------------
	$FIELD_BUT = $rs -> form_button("submit", "update_pagerestriction", LAN_PAGERESTRICTION_7);
	$text .= preg_replace("/\{(.*?)\}/e", '$\1', $PR_PAGE_END);

// ##### render -----------------------------------------
	$ns -> tablerender(LAN_PAGERESTRICTION_8, $text);

require_once(e_ADMIN."footer.php");

?>
