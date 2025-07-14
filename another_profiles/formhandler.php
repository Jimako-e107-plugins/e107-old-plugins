<?php

if(!defined("e107_INIT")) {
	require_once("../../class2.php");
}
if (isset($_POST['uid']) && $_POST['uid'] != USERID) {
	// ADMIN IS EDITING THEIR PROFILE
	if (!ADMIN || !getperms("4")) {
		header("location:".e_BASE."index.php");
		exit() ;
	}
}

// ACCEPT/REJECT FRIEND REQUESTS
if(isset($_POST['box'])) {
	$id = intval($_POST['uid']);
	foreach($_POST['box'] as $tick) {
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".intval($tick)."' ");
		$new = $sql->db_Fetch();
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$new2 = $sql->db_Fetch();
		$newfriends = str_replace("|".$id."|" , "|", $new['user_friends']);
		$newfriends = str_replace("  " , " ", $newfriends);
		if($newfriends == ' 0') {
			$newfriends = '';
		}
		$newfriends2 = str_replace("|".$tick."|" , "|", $new2['user_friends']);
		$newfriends2 = str_replace("  " , " ", $newfriends2);
		if($newfriends2 == ' 0') {
			$newfriends2 = '';
		}
		$sql -> db_Update("another_profiles", "user_friends='".$newfriends."' WHERE user_id='".intval($tick)."' ");
		$sql -> db_Update("another_profiles", "user_friends='".$newfriends2."' WHERE user_id='".$id."' ");
	}
	if ($id == USERID) {
		header('Location: newusersettings.php?page=friends');
	} else {
		header("Location: newusersettings.php?uid=".$id."&page=friends");
	}
}

// ACCEPT/REJECT FRIEND CHECK
if(isset($_POST['boxfr'])) {
	$id = intval($_POST['uid']);
	foreach($_POST['boxfr'] as $tick) {
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".intval($tick)."' ");
		$new = $sql->db_Fetch();
		$sql->mySQLresult = @mysql_query("SELECT user_id, user_friends, user_friends_request FROM ".MPREFIX."another_profiles WHERE user_id='".$id."' ");
		$new2 = $sql->db_Fetch();
		$newfriends = str_replace("|".$id."|" , "|", $new['user_friends_request']);
		$newfriends = str_replace("  " , " ", $newfriends);
		if($newfriends == ' 0') {
			$newfriends = '';
		}
		$newfriends2 = str_replace("|".$tick."|" , "|", $new2['user_friends_request']);
		$newfriends2 = str_replace("  " , " ", $newfriends2);
		if($newfriends2 == ' 0') {
			$newfriends2 = '';
		}
		$sql -> db_Update("another_profiles", "user_friends_request='".$newfriends."' WHERE user_id='".intval($tick)."' ");
		$sql -> db_Update("another_profiles", "user_friends_request='".$newfriends2."' WHERE user_id='".$id."' ");
	}
	if ($id == USERID) {
		header('Location: newusersettings.php?page=friends');
	} else {
		header("Location: newusersettings.php?uid=".$id."&page=friends");
	}
}

// DELETE IMAGES
if(isset($_POST['delimages'])) {
	$id = intval($_POST['uid']);
	if (isset($_POST['chbox'])) {
		foreach($_POST['chbox'] as $select) {
			$file = "userimages/".$id."/".$select;
			$break = explode("/", $select);
			$thumbfile = "userimages/".$id."/".$break[0]."/thumbs/".$break[1];
			unlink($file);
			unlink($thumbfile);
			$sql->db_Delete("another_profiles_com", "com_to='$id' && com_type='pics' && com_extra='".mysql_real_escape_string($_POST['album'])."/".mysql_real_escape_string($break[1])."'");

			$query = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/".mysql_real_escape_string($thumbfile)."' || user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/".mysql_real_escape_string($file)."' LIMIT 1 ");
			$rows = mysql_num_rows($query);
			if( $rows == 1 ) {
				mysql_query("UPDATE ".MPREFIX."user SET user_image='' WHERE user_id='".intval($_POST['uid'])."' ");
			}

		}
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_custompage='delete_album_image' WHERE user_id='".$id."' ");
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images&album=".$_POST['album']."&del");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images&album=".$_POST['album']."&del");
		}
	} else {
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images");
		} else {
			header("Location: newusersettings.php?page=images");
		}
	}
}

// DELETE PICTURE COMMENTS
if (isset($_POST['combox'])) {
	foreach($_POST['combox'] as $cid) {
		$sql->db_Delete("another_profiles_com", "com_id='".intval($cid)."' ");
	}
	if ($_POST['uid'] == USERID) {
		header("Location: newusersettings.php?page=images&album=".$_POST['album']."&pic=".$_POST['image']."");
	} else {
		header("Location: newusersettings.php?uid=".$_POST['uid']."&page=images&album=".$_POST['album']."&pic=".$_POST['image']."");
	}
}

// COMMENT MEMBER
if (isset($_POST['user_comment'])) {
	$by = USERID;
	$to = intval($_POST['id']);
	$comment = $_POST['user_comment'];
	$comment = $tp -> toDB($comment);
	$date = time();
	$sql->db_Insert("another_profiles_com", "'', '".$by."', '".$to."', '".mysql_real_escape_string($comment)."', '".$date."', 'prof', '' ");
	header("Location: newuser.php?id=".$to."&page=comments");
}

// COMMENT PICTURE
if (isset($_POST['user_picture_comment'])) {
	$to = intval($_POST['id']);
	$pic = $_POST['pic'];
	$picfull = $_POST['picfull'];
	$comment = $_POST['user_picture_comment'];
	$comment = $tp -> toDB($comment);
	$date = time();
	$sql->db_Insert("another_profiles_com", "'', '".USERID."', '".$to."', '".mysql_real_escape_string($comment)."', '".$date."', 'pics', '".mysql_real_escape_string($picfull)."' ");
	header("Location: newuser.php?id=".$to."&page=images&album=".$_POST['album']."&pic=".$pic."");
}

// DELETE COMMENTS
if (isset($_POST['cbox'])) {
	foreach($_POST['cbox'] as $cid) {
		$sql->db_Delete("another_profiles_com", "com_id='".intval($cid)."'");
	}
	if ($_POST['uid'] == USERID) {
		header('Location: newusersettings.php?page=comments');
	} else {
		header("Location: newusersettings.php?uid=".$_POST['uid']."&page=comments");
	}
}

// UPDATE SETTINGS
if (isset($_POST['update_settings'])) {
	$id = intval($_POST['update_settings']);
	if (isset($_POST['friendsonly'])) {
		$friends = 1;
	} else {
		$friends = 0;
	}
	if (isset($_POST['friendscomonly'])) {
		$friendscom = 1;
	} else {
		$friendscom = 0;
	}
	if (isset($_POST['friendspiccomonly'])) {
		$friendspiccom = 1;
	} else {
		$friendspiccom = 0;
	}
	if (isset($_POST['friendsvidcomonly'])) {
		$friendsvidcom = 1;
	} else {
		$friendsvidcom = 0;
	}
	if (isset($_POST['forumadd'])) {
		$forumadd = 1;
	} else {
		$forumadd = 0;
	}
	if (isset($_POST['sendpmonfriend'])) {
		$sendpm = 1;
	} else {
		$sendpm = 0;
	}
	if (isset($_POST['sendpmonfriendfriends'])) {
		$sendpmonfriendfriends = 1;
	} else {
		$sendpmonfriendfriends = 0;
	}
	if (isset($_POST['sendpmonfriendvideos'])) {
		$sendpmonfriendvideos = 1;
	} else {
		$sendpmonfriendvideos = 0;
	}
	if (isset($_POST['sendpmonfriendpictures'])) {
		$sendpmonfriendpictures = 1;
	} else {
		$sendpmonfriendpictures = 0;
	}
	if (isset($_POST['sendpmonfriendprofilecomments'])) {
		$sendpmonfriendprofilecomments = 1;
	} else {
		$sendpmonfriendprofilecomments = 0;
	}
	if (isset($_POST['sendpmonfriendmp3'])) {
		$sendpmonfriendmp3 = 1;
	} else {
		$sendpmonfriendmp3 = 0;
	}
	if (isset($_POST['sendemailonfriend'])) {
		$sendemailonfriend = 1;
	} else {
		$sendemailonfriend = 0;
	}
	if (isset($_POST['setavatar'])) {
		$sql -> db_Update("user", "user_image='' WHERE user_id='".$id."' ");
	}

	$result = mysql_query("SELECT user_id FROM ".MPREFIX."another_profiles WHERE user_id='".$id."'");
	$result = mysql_num_rows($result);

	$settings = $friends."|".$friendscom."|".$friendspiccom."|".$forumadd."|".$friendsvidcom."|".$sendpm."|".$sendpmonfriendfriends."|".$sendpmonfriendvideos."|".$sendpmonfriendpictures."|".$sendpmonfriendprofilecomments."|".$sendpmonfriendmp3."|".$sendemailonfriend;
	if ($result == 0) {
		$sql->db_Insert("another_profiles", "'".$id."', '', '', '', '', '".$settings."', '1', '', '0', '0', ''  ");
	} else {
		$sql -> db_Update("another_profiles", "user_settings='".$settings."' WHERE user_id='".$id."' ");
	}
	if ($id == USERID && isset($_POST['unreg'])) {
		header("Location: unreg.php");
	} else if ($id == USERID) {
		header('Location: newusersettings.php?page=settings');
	} else {
		header("Location: newusersettings.php?uid=".$id."&page=settings");
	}
}

// UPDATE VIDEO
if (isset($_POST['updatevideos'])) {
	$id = intval($_POST['uid']);
	$vidid = intval($_POST['vidid']);
	$title = $tp -> toDB($_POST['title']);
	$desc = $tp -> toDB($_POST['description']);
	$embed = $tp -> toDB($_POST['embed']);
	$share_site = $tp -> toDB($_POST['share_site']);

	require_once("videohandler.php");
	$pic_url = pic_url($share_site,$embed);
	if($pic_url != "images/nopreview.png") {
		$date = time();
		$sql->db_Update("another_profiles_vids", "vid_name='".mysql_real_escape_string($title)."', vid_desc='".mysql_real_escape_string($desc)."', vid_embed='".mysql_real_escape_string($share_site)." ".mysql_real_escape_string($embed)."' WHERE vid_id='".$vidid."' ");
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_custompage='update_video' WHERE user_id='".$id."' ");
	} else {
		$video_error = 1;
	}
	if ($id == USERID) {
		if($video_error) {
			header("Location: newusersettings.php?page=videos&vid=".$vidid."&error=1");
		} else {
			header("Location: newusersettings.php?page=videos");
		}
	} else {
		if($video_error) {
			header("Location: newusersettings.php?uid=".$id."&page=videos&vid=".$vidid."&error=1");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=videos");
		}
	}
}

// ADD NEW VIDEO
if (isset($_POST['addnewvideos'])) {
	$id = intval($_POST['uid']);
	$title = $tp -> toDB($_POST['title']);
	$desc = $tp -> toDB($_POST['description']);
	$embed = $tp -> toDB($_POST['embed']);
	$share_site = $tp -> toDB($_POST['share_site']);
	require_once("videohandler.php");
	$pic_url = pic_url($share_site,$embed);
	if($pic_url != "images/nopreview.png") {
	
		$date = time();
		$sql->db_Insert("another_profiles_vids", "'', '".$id."', '".mysql_real_escape_string($title)."', '".mysql_real_escape_string($desc)."', '".mysql_real_escape_string($share_site)." ".mysql_real_escape_string($embed)."', '".$date."' ");
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_custompage='add_video' WHERE user_id='".$id."' ");
	} else {
		$video_error = 1;
	}
	if ($id == USERID) {
		if($video_error) {
			header("Location: newusersettings.php?page=videos&addnew&error=1");
		} else {
			header("Location: newusersettings.php?page=videos");
		}
	} else {
		if($video_error) {
			header("Location: newusersettings.php?uid=".$id."&page=videos&addnew&error=1");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=videos");
		}
	}
}

// DELETE VIDEOS
if (isset($_POST['viddel'])) {
	$id = intval($_POST['uid']);
	$viddel = $_POST['viddel'];

	foreach ($viddel as $vid) {
		$sql->db_Delete("another_profiles_vids", "vid_id='".intval($vid)."'");
		$sql->db_Delete("another_profiles_com", "com_type='vids' && com_extra='".intval($vid)."'");
	}
	new_user_row($id);
	$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
	$sql -> db_Update("another_profiles", "user_custompage='delete_video' WHERE user_id='".$id."' ");

	if ($id == USERID) {
		header('Location: newusersettings.php?page=videos');
	} else {
		header("Location: newusersettings.php?uid=".$id."&page=videos");
	}
}

// COMMENT VIDEOS
if (isset($_POST['user_video_comment'])) {
	$to = intval($_POST['id']);
	$vid = $_POST['vid'];
	$comment = $_POST['user_video_comment'];
	$comment = $tp -> toDB($comment);
	$date = time();
	$sql->db_Insert("another_profiles_com", "'', '".USERID."', '".$to."', '".mysql_real_escape_string($comment)."', '".$date."', 'vids', '".intval($vid)."' ");
	header("Location: newuser.php?id=".$to."&page=videos&vid=".$vid."");
}

// DELETE VIDEO COMMENTS
if (isset($_POST['delvidcom'])) {
	$id = intval($_POST['uid']);
	$vid = $_POST['vidid'];
	$comdel = $_POST['delvidcom'];

	foreach ($comdel as $com) {
		$sql->db_Delete("another_profiles_com", "com_id='".intval($com)."'");
	}

	if ($id == USERID) {
		header("Location: newusersettings.php?page=videos&vid=".$vid."");
	} else {
		header("Location: newusersettings.php?uid=".$id."&page=videos&vid=".$vid."");
	}
}

// CREATE NEW ALBUM
if (isset($_POST['newalbum'])) {
	$id = intval($_POST['id']);
	// Check if name exists already
	$exists = 0;
	$dir = "userimages/".$id."/";
	if ($handle = opendir($dir)) {
    	while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != "Thumbs.db") {
				if ($_POST['newalbum'] == $file) {
					$exists = 1;
				}
			}
		}
	}
	if ($pref['profile_kepekezet'] == "Yes") {
		$pmatch = "/^[\w-éáíűőúöüóÉÁÍŰŐÚÖÜÓ ]+$/i";
	} else {
		$pmatch = "/^[a-z0-9 ]+$/i";
	}
	//	if (preg_match('/^[a-z0-9 ]+$/i', $_POST['newalbum']) && $_POST['newalbum'] != "root" && $exists != 1) {

	if (preg_match($pmatch, $_POST['newalbum']) && $_POST['newalbum'] != "root" && $exists != 1) {
		$name = str_replace(" ", "_", $_POST['newalbum']);
		mkdir("userimages/".$id."/".$name."", 0755);
		mkdir("userimages/".$id."/".$name."/thumbs/", 0755);
		fopen("userimages/".$id."/".$name."/index.htm",'a');
		fopen("userimages/".$id."/".$name."/thumbs/index.htm",'a');
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_custompage='create_album' WHERE user_id='".$id."' ");
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images");
		}
	} else {
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images&error");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images&error");
		}
	}
}

// DELETE ALBUM
if(isset($_POST['delalbum'])) {
	function DELETE_RECURSIVE_DIRS($dirname) {
		// all subdirectories and contents:
		if(is_dir($dirname))$dir_handle=opendir($dirname);
		while($file=readdir($dir_handle)) {
			if($file!="." && $file!="..") {
				if(!is_dir($dirname."/".$file)) unlink ($dirname."/".$file);
			else DELETE_RECURSIVE_DIRS($dirname."/".$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

	$id = intval($_POST['uid']);
	new_user_row($id);
	$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
	$sql -> db_Update("another_profiles", "user_custompage='delete_image_or_album' WHERE user_id='".$id."' ");
	if(isset($_POST['delrootpic'])) {
		foreach($_POST['delrootpic'] as $select) {
			$file = "userimages/".$id."/".$select;
			$thumbfile = "userimages/".$id."/thumbs/".$select;
			$break = explode(".", $select);
			unlink($file);
			unlink($thumbfile);
			$sql->db_Delete("another_profiles_com", "com_to='$id' && com_type='pics' && com_extra='root/".mysql_real_escape_string($select)."'");			
			$query = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/".mysql_real_escape_string($thumbfile)."' || user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/".mysql_real_escape_string($file)."' LIMIT 1 ");
			$rows = mysql_num_rows($query);
			if( $rows == 1 ) {
				mysql_query("UPDATE ".MPREFIX."user SET user_image='' WHERE user_id='".intval($_POST['uid'])."' ");
			}			
		}
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images&del");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images&del");
		}
	} elseif (isset($_POST['delal'])) {
		foreach($_POST['delal'] as $select) {
			DELETE_RECURSIVE_DIRS("userimages/".$id."/".$select."/");
		}
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images&del&".$select."");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images&del");
		}
	} else {
		if ($id == USERID) {
			header("Location: newusersettings.php?page=images");
		} else {
			header("Location: newusersettings.php?uid=".$id."&page=images");
		}
	}
}

// RENAME PHOTO ALBUM
if (isset($_POST['renamealbum'])) {
	$newname = str_replace(" ", "_", $_POST['newname']);
	// Check if name exists already
	$exists = 0;
	$dir = "userimages/".$_POST['uid']."/";
	if ($handle = opendir($dir)) {
    	while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != "Thumbs.db") {
				if ($newname == $file) {
					$exists = 1;
				}
			}
		}
	}
	if ($pref['profile_kepekezet'] == "Yes") {
		$pmatch = "/^[\w-éáíűőúöüóÉÁÍŰŐÚÖÜÓ ]+$/i";
	} else {
		$pmatch = "/^[a-z0-9 ]+$/i";
	}
	if (preg_match($pmatch, $_POST['newname']) & $exists != 1) {
		rename("userimages/".$_POST['uid']."/".$_POST['origname']."", "userimages/".$_POST['uid']."/".$newname."");
		$query = mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_to='".intval($_POST['uid'])."' && com_type='pics' && com_extra like '".mysql_real_escape_string($_POST['origname'])."/%' ");
		$rows = mysql_num_rows($query);
		$getdata = $sql->db_Fetch();
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".intval($id)."' ");
		$sql -> db_Update("another_profiles", "user_custompage='rename_album' WHERE user_id='".intval($id)."' ");
		for ($i = 0; $i < $rows; $i++) {
			$row = mysql_fetch_assoc($query);
			$oldfullname = $row['com_extra'];
			$picname = str_replace($_POST['origname']."/", "", $oldfullname);
			mysql_query("UPDATE ".MPREFIX."another_profiles_com SET com_extra='".mysql_real_escape_string($newname)."/".mysql_real_escape_string($picname)."' WHERE com_to='".intval($_POST['uid'])."' && com_type='pics' && com_extra like '".mysql_real_escape_string($_POST['origname'])."/".mysql_real_escape_string($picname)."' ");

			if (extension_loaded('gd') && function_exists('gd_info')) {
				$avpicdir = "/thumbs";
			} else {
				$avpicdir = "";
			}
		}
		$query = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id='".intval($_POST['uid'])."' && user_image like '".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid'])."/".mysql_real_escape_string($_POST['origname'])."%' LIMIT 1 ");
		$rows = mysql_num_rows($query);
		if( $rows == 1 ) {
			$row = mysql_fetch_assoc($query);
			$oldfullname = $row['user_image'];
			$new_picname = str_replace($_POST['origname'], $newname, $oldfullname);
			mysql_query("UPDATE ".MPREFIX."user SET user_image='".mysql_real_escape_string($new_picname)."' WHERE user_id='".intval($_POST['uid'])."' && user_image like '".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid'])."/".mysql_real_escape_string($_POST['origname'])."%' ");
		}
		if ($_POST['uid'] == USERID) {
			header("Location: newusersettings.php?page=images&album=".$newname."");
		} else {
			header("Location: newusersettings.php?uid=".$_POST['uid']."&page=images&album=".$newname."");
		}
	} else {
		if ($_POST['uid'] == USERID) {
			header("Location: newusersettings.php?page=images&album=".$_POST['origname']."&renameerror");
		} else {
			header("Location: newusersettings.php?uid=".$_POST['uid']."&page=images&album=".$_POST['origname']."&renameerror");
		}
	}
}

if (isset($_POST['renameimage'])) {
	$split = explode(".", $_POST['origname']);
	$counter=0;
	foreach($split as $string) {
		$counter++;
		if ($string == '') {
			$split_id = $split[$counter];
			$id = $split_id;
			$lnk=true;
			break;
		}
	}
	$kiterjesztes = $split[$counter - 1];
	$exists = 0;
	// Check if name exists already
	if ($_POST['album'] == "root") {
		$dir = "userimages/".$_POST['uid']."/";
	} else {
		$dir = "userimages/".$_POST['uid']."/".$_POST['album']."/";
	}
	if ($handle = opendir($dir)) {
    	while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && $file != "Thumbs.db") {
				if ($_POST['newname'].".".$kiterjesztes == $file) {
					$exists = 1;
				}
			}
		}
	}
	if ($pref['profile_kepekezet'] == "Yes") {
		$pmatch = "/^[\w-éáíűőúöüóÉÁÍŰŐÚÖÜÓ ]+$/i";
	} else {
		$pmatch = "/^[a-z0-9 ]+$/i";
	}
	if (preg_match($pmatch, $_POST['newname']) && $exists != 1) {
		$newname = str_replace(" ", "_", $_POST['newname']);
		if ($_POST['album'] == "root") {
			rename("userimages/".$_POST['uid']."/".$_POST['origname']."", "userimages/".$_POST['uid']."/".$newname.".".$kiterjesztes."");
			rename("userimages/".$_POST['uid']."/thumbs/".$_POST['origname']."", "userimages/".$_POST['uid']."/thumbs/".$newname.".".$kiterjesztes."");
		} else {
			rename("userimages/".$_POST['uid']."/".$_POST['album']."/".$_POST['origname']."", "userimages/".$_POST['uid']."/".$_POST['album']."/".$newname.".".$kiterjesztes."");
			rename("userimages/".$_POST['uid']."/".$_POST['album']."/thumbs/".$_POST['origname']."", "userimages/".$_POST['uid']."/".$_POST['album']."/thumbs/".$newname.".".$kiterjesztes."");
		}
		new_user_row($id);
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".intval($id)."' ");
		$sql -> db_Update("another_profiles", "user_custompage='rename_image' WHERE user_id='".intval($id)."' ");
		$query = mysql_query("SELECT * FROM ".MPREFIX."another_profiles_com WHERE com_to= '".intval($_POST['uid'])."' && com_type='pics' && com_extra = '".mysql_real_escape_string($_POST['album'])."/".mysql_real_escape_string($_POST['origname'])."' ");
		$rows = mysql_num_rows($query);
		for ($i = 0; $i < $rows; $i++) {
			$row = mysql_fetch_assoc($query);
			mysql_query("UPDATE ".MPREFIX."another_profiles_com SET com_extra='".mysql_real_escape_string($_POST['album'])."/".mysql_real_escape_string($newname).".".mysql_real_escape_string($kiterjesztes)."' WHERE com_id='".$row['com_id']."' ");
		}

		if (extension_loaded('gd') && function_exists('gd_info')) {
			$avpicdir = "/thumbs";
		} else {
			$avpicdir = "";
		}
		if ($_POST['album'] == "root") {
			$query = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id='".intval($_POST['uid'])."' && user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid']).mysql_real_escape_string($avpicdir)."/".mysql_real_escape_string($_POST['origname'])."' LIMIT 1");
			$rows = mysql_num_rows($query);
			if( $rows == 1 ) {
				mysql_query("UPDATE ".MPREFIX."user SET user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid']).mysql_real_escape_string($avpicdir)."/".mysql_real_escape_string($newname).".".mysql_real_escape_string($kiterjesztes)."' WHERE user_id='".intval($_POST['uid'])."' ");
			}
		} else {
			$query = mysql_query("SELECT * FROM ".MPREFIX."user WHERE user_id='".intval($_POST['uid'])."' && user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid'])."/".mysql_real_escape_string($_POST['album']).mysql_real_escape_string($avpicdir)."/".mysql_real_escape_string($_POST['origname'])."' LIMIT 1 ");
			$rows = mysql_num_rows($query);
			if( $rows == 1 ) {
				mysql_query("UPDATE ".MPREFIX."user SET user_image='".SITEURLBASE.e_PLUGIN_ABS."another_profiles/userimages/".intval($_POST['uid'])."/".mysql_real_escape_string($_POST['album']).mysql_real_escape_string($avpicdir)."/".mysql_real_escape_string($newname).".".mysql_real_escape_string($kiterjesztes)."' WHERE user_id='".intval($_POST['uid'])."' ");
			}
		}
		if ($_POST['uid'] == USERID) {
			header("Location: newusersettings.php?page=images&album=".$_POST['album']."&pic=".$newname.".".$kiterjesztes."");
		} else {
			header("Location: newusersettings.php?uid=".$_POST['uid']."&page=images&album=".$_POST['album']."&pic=".$newname.".".$kiterjesztes."");
		}
	} else {
		if ($_POST['uid'] == USERID) {
			header("Location: newusersettings.php?page=images&album=".$_POST['album']."&pic=".$_POST['origname']."&renameerror");
		} else {
			header("Location: newusersettings.php?uid=".$_POST['uid']."&page=images&album=".$_POST['album']."&pic=".$_POST['origname']."&renameerror");
		}
	}
}

// UPDATE PROFILE SONG
if (isset($_POST['updatesong'])) {
	if (isset($_POST['uid'])) {
		$id = intval($_POST['uid']);
		$luid = "&uid=".$id."";
	} else {
		$id = USERID;
	}
	if ($_POST['usemp3'] == "remote") {
		$pmatch = "/^(http|https|ftp):\/\/[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+(mp3|MP3)+$/i";
		if (preg_match($pmatch, $_POST['remote'])) {
			new_user_row($id);
			mysql_query("UPDATE ".MPREFIX."another_profiles SET user_mp3 = '".$_POST['remote']."' WHERE user_id='".$id."' ");
			$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
			$sql -> db_Update("another_profiles", "user_custompage='update_profile_song' WHERE user_id='".$id."' ");
			if (ADMIN && getperms("4")) {
				header("Location: newusersettings.php?mp3done".$luid."");
			} else {
				header("Location: newusersettings.php?mp3done");
			}
		} else {
			if (ADMIN && getperms("4")) {
				header("Location: newusersettings.php?mp3failed".$luid."");
			} else {
				header("Location: newusersettings.php?mp3failed");
			}
		}
	} elseif ($_POST['usemp3'] == "none") {
		mysql_query("UPDATE ".MPREFIX."another_profiles SET user_mp3 = '' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
		$sql -> db_Update("another_profiles", "user_custompage='delete_profile_song' WHERE user_id='".$id."' ");
		if (ADMIN && getperms("4")) {
			header("Location: newusersettings.php?mp3done".$luid."");
		} else {
			header("Location: newusersettings.php?mp3done");
		}
	} else {
		require_once(e_HANDLER."upload_handler.php");
		$uploaded = file_upload("usermp3/", "unique");
		$file = $uploaded[0]['name'];
		$filetype = $uploaded[0]['type'];
		$filesize = $uploaded[0]['size'];
		$type = substr(strrchr($file, '.'), 1);
		if (file_exists("usermp3/".$id.".".$type)) {
			unlink("usermp3/".$id.".".$type."");
		}
		rename("usermp3/".$file, "usermp3/".$id.".".$type);
		if (($filetype == "audio/x-mp3") || ($filetype == "audio/mpeg") && (($filesize * 0.0009765625) < $pref['profile_mp3size']) && $file != "" && $pref['upload_enabled']) {
			new_user_row($id);
			mysql_query("UPDATE ".MPREFIX."another_profiles SET user_mp3 = '".$file."'  WHERE user_id='".$id."' ");
			$sql -> db_Update("another_profiles", "user_lastupdated='".time()."' WHERE user_id='".$id."' ");
			$sql -> db_Update("another_profiles", "user_custompage='upload_profile_song' WHERE user_id='".$id."' ");
			if (ADMIN && getperms("4")) {
				header("Location: newusersettings.php?mp3done".$luid."");
			} else {
				header("Location: newusersettings.php?mp3done");
			}
		} else {
			unlink("usermp3/".$id.".".$type."");
		if (ADMIN && getperms("4")) {
				header("Location: newusersettings.php?mp3failed".$luid."");
			} else {
				header("Location: newusersettings.php?mp3failed");
			}
		}
	}
}

function new_user_row($member_id) {
	global $sql;
	$sql -> db_Select("another_profiles", "*", "user_id='".intval($member_id)."'");
	$count = $sql -> db_Rows();
	if ($count == 0) {
	return	$sql -> db_Insert("another_profiles", "'".intval($member_id)."', '', '', '', '', '', '', '', '', '', ''");
	}
}

?>