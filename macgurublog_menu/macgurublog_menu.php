<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        e107 BLOG Engine by MacGuru
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
$text='';
$nil = true;
$obhidden = false;
$count = $sql->db_Count("macgurublog_main");
if ($count != 0) {
	$sql -> db_Query("select blog_uid, blog_title, blog_enable, user_name from ".MPREFIX."macgurublog_main left join ".MPREFIX."user on (".MPREFIX."macgurublog_main.blog_uid=".MPREFIX."user.user_id);");
	while($row = $sql-> db_Fetch()){
		$name = $row['user_name'];
		if ($row['blog_enable'] == 1) {
			if ($row['blog_title'] != NULL) {
				$bindex[strtolower($name)] = '<a href="'.e_PLUGIN.'macgurublog_menu/macgurublog.php?uid='.$row['blog_uid'].'" title="'.$row['blog_title'].'">'.$name."</a><br />\n";
			} else {
				$bindex[strtolower($name)] = '<a href="'.e_PLUGIN.'macgurublog_menu/macgurublog.php?uid='.$row['blog_uid'].'">'.$name."</a><br />\n";
			}
		} elseif (getperms("P")) {
			if ($row['blog_title'] != NULL) {
				$bindex[strtolower($name)] = '<a href="'.e_PLUGIN.'macgurublog_menu/macgurublog.php?uid='.$row['blog_uid'].'" title="'.$row['blog_title'].'" style="font-style:italic;">'.$name."</a><br />\n";
			} else {
				$bindex[strtolower($name)] = '<a href="'.e_PLUGIN.'macgurublog_menu/macgurublog.php?uid='.$row['blog_uid'].'" style="font-style:italic;">'.$name."</a><br />\n";
			}
		}
		if ($row['blog_uid'] == USERID) {
			$nil = false;
			if ($row['blog_enable'] == 0) {
				$obhidden = true;
			}
		}
	}
	//order
	if (is_array($bindex)) {
		ksort($bindex);
		reset($bindex);
		foreach($bindex as $row) {
			$text .= $row;
		}
	} else {
		$text .= MACGURUBLOG_MENU_1;
	}
	//
} else {
	$text .= MACGURUBLOG_MENU_1;
}
if (USER === true) {
	require(e_PLUGIN."macgurublog_menu/blognew.php");
	if (!$pref['macgurublog_3']) {
		$text .= '<hr /><span class="smalltext">'.$blognewlist.'</span>';
	}
	
	if (($nil && !$pref['macgurublog_2']) || !$nil || getperms("P")) {
		$text .= "<hr />";
	}
	if ($nil && !$pref['macgurublog_2']) {
		$text .= MACGURUBLOG_MENU_2 . "<br />\n";
		$text .= '<a href="'.e_PLUGIN.'macgurublog_menu/user_prefs.php">'.MACGURUBLOG_MENU_3."</a>\n";
		$it = true;
	} elseif (!$nil) {
		if ($obhidden) {
			$text .= MACGURUBLOG_MENU_20;
			$text .='<br /><a href="'.e_PLUGIN.'macgurublog_menu/macgurublog.php?uid='.USERID.'">'.MACGURUBLOG_MENU_21."</a><hr />\n";
		}
		$text .= '<a href="'.e_PLUGIN.'macgurublog_menu/blog_add.php">'.MACGURUBLOG_MENU_5."</a><br />\n";
		$text .= '<a href="'.e_PLUGIN.'macgurublog_menu/user_prefs.php">'.MACGURUBLOG_MENU_4."</a>\n";
		$it = true;
	}
	if (getperms("P")) {
		$text .= ($it?'<br />':'').'<a href="'.e_PLUGIN.'macgurublog_menu/admin_config.php">'.MACGURUBLOG_MENU_76."</a>\n";
	}
	
	if ($pref['macgurublog_3']) {
		$text .= '<hr /><span class="smalltext">'.$blognewlist.'</span>';
	}
}


$title = $pref['macgurublog_11'];
$ns -> tablerender($title, $text);


//categories
if (!$pref['macgurublog_12'] && IsSet($_GET['uid'])) {
	require(e_PLUGIN."macgurublog_menu/macgurublog_categories_menu.php");
	mgb_ctmenu();
}
?>