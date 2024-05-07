<?php
// ------------------------------------------------------------------------- //
// Coppermine Photo Gallery 1.3.2                                            //
// ------------------------------------------------------------------------- //
// Copyright (C) 2002-2004 Gregory DEMAR                                     //
//  http://www.chezgreg.net/coppermine/                                      //
// ------------------------------------------------------------------------- //
//  Based on PHPhotoalbum by Henning Støverud <henning@stoverud.com>         //
//  http://www.stoverud.com/PHPhotoalbum/                                    //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //
//
//  e107 Integration for Coppermine
//
// ------------------------------------------------------------------------- //

// ------------------------------------------------------------------------- //
//  Modify the values below according to your e107 installation
// ------------------------------------------------------------------------- //

while (ob_get_level() > 1) {
    ob_end_flush(); // Kill extra cpg buffering
}

if(!eregi("fullsize", e_QUERY) && !preg_match("/xp_publish/",e_SELF)){
	if(!defined("SHOWTHUMB_PHP") && !defined("ADDPIC_PHP")){
		require_once(HEADERF);
	}
}

define('E107_ADMIN_GROUP', 1);
define('E107_MEMBERS_GROUP', 2);
define('E107_GUEST_GROUP', 3);
define('E107_BANNED_GROUP', 4);

// e107 tests filesystem every time for safety...
function test_fs()
{
	$errors="";
	// albums must be writable to upload pictures
	$dir=e_PLUGIN."coppermine_menu/albums";
	if (! is_dir($dir)){
		$errors .= "<hr /><br />A subdirectory called '{$dir}' should normally exist in the directory where you uploaded Coppermine. The installer can't find this directory. Check that you have uploaded all Coppermine files to your server.<br /><br />";
	} elseif (! is_writable($dir)){
		$errors .= "<hr /><br />The '{$dir}' directory (located in the directory where you uploaded Coppermine) should be writable in order to allow pictures upload. Use your FTP program to change its mode to 777.<br /><br />";
	}

	// userpics must be writable to upload pictures
	$dir=e_PLUGIN."coppermine_menu/albums/userpics";
	if (! is_dir("{$dir}")){
		$errors .= "<hr /><br />A subdirectory called 'userpics' should normally exist in the 'albums' directory. The installer can't find this directory. Check that you have uploaded all Coppermine files to your server.<br /><br />";
	} elseif (! is_writable("{$dir}")){
		$errors .= "<hr /><br />The 'userpics' directory (located in the 'albums' directory on your server) should be writable in order to allow pictures upload. Use your FTP program to change its mode to 777.<br /><br />";
	}

	// edit dir must be writable to upload pictures
	$dir=e_PLUGIN."coppermine_menu/albums/edit";
	if (! is_dir("{$dir}")){
		$errors .= "<hr /><br />A subdirectory called 'edit' should normally exist in the 'albums' directory. The installer can't find this directory. Check that you have uploaded all Coppermine files to your server.<br /><br />";
	} elseif (! is_writable("{$dir}")){
		$errors .= "<hr /><br />The 'edit' directory (located in the 'albums' directory on your server) should be writable in order to allow pictures upload. Use your FTP program to change its mode to 777.<br /><br />";
	}


	if($errors){
		global $ns;
		$ns -> tablerender("Error",$errors);
		require_once(FOOTERF);
		exit;
	}
}

// Authenticate a user using cookies
// Also, handle certain verification and validation functions
function udb_authenticate()
{
global $HTTP_COOKIE_VARS, $USER_DATA, $UDB_DB_LINK_ID, $UDB_DB_NAME_PREFIX, $CONFIG;
global $HTTP_SERVER_VARS, $HTTP_X_FORWARDED_FOR, $HTTP_PROXY_USER, $REMOTE_ADDR, $USER;

if(ADMIN){ test_fs(); }
//?? mysql_free_result($results);
// Set error logging level
if ($CONFIG['debug_mode']) {
    error_reporting (E_ALL);
} else {
    error_reporting (E_ALL ^ E_NOTICE);
}

$USER['lang']=strtolower(e_LANGUAGE);

// For error checking
$CONFIG['TABLE_USERS'] = '**ERROR**';

// Permissions for a default group
$default_group = array('group_id' => E107_GUEST_GROUP,
        'group_name' => 'Unknown',
        'has_admin_access' => 0,
        'can_see_all_albums' => 0,
        'can_send_ecards' => 0,
        'can_rate_pictures' => 0,
        'can_post_comments' => 0,
        'can_upload_pictures' => 0,
        'can_create_albums' => 0,
        'pub_upl_need_approval' => 1,
        'priv_upl_need_approval' => 1,
        'upload_form_config' => 0,
        'custom_user_upload' => 0,
        'num_file_upload' => 0,
        'num_URI_upload' => 0,
);
// get first 50 chars
$HTTP_USER_AGENT=substr($HTTP_SERVER_VARS['HTTP_USER_AGENT'],0,50);
$REMOTE_ADDR=substr($HTTP_SERVER_VARS['REMOTE_ADDR'],0,50);

if(USER===TRUE){
        define('USER_ID', USERID);
        define('USER_NAME', USERNAME);
        $USER_DATA['user_name']=USERNAME;
        if(ADMINPERMS=="0" || check_class("COPPERMINE_ADMIN")){
                $USER_DATA['mgroup']=E107_ADMIN_GROUP;
        } else {
                $sql = "SELECT * ".
                           "FROM {$CONFIG['TABLE_USERGROUPS']} ORDER BY group_name";
                $result = db_query($sql);
                if(mysql_num_rows($result)){
                        while(($row = mysql_fetch_array($result)) && empty($USER_DATA['mgroup'])){
                                extract($row);
                                if(check_class(strtoupper($group_name))){
                                        $USER_DATA['mgroup']=$group_id;
                                }
                        }
                }
                if(empty($USER_DATA['mgroup'])){
                        $USER_DATA['mgroup']=E107_MEMBERS_GROUP;
                }
        }

        // Retrieve group information
        $sql = "SELECT * "."FROM {$CONFIG['TABLE_USERGROUPS']} ". "WHERE group_id = '{$USER_DATA['mgroup']}'";
        $result = db_query($sql);
        if (mysql_num_rows($result)){
                $USER_DATA2 = mysql_fetch_array($result);
        } else {
                $USER_DATA2 = $default_group;
        }

        $USER_DATA = array_merge($USER_DATA, $USER_DATA2);

                $USER_DATA['has_admin_access']= ($USER_DATA['mgroup'] == E107_ADMIN_GROUP);
                $USER_DATA['can_see_all_albums'] = $USER_DATA['has_admin_access'];
                $USER_DATA['groups'] = array($USER_DATA['group_id']);

           define('USER_GROUP', $USER_DATA['group_name']);
           define('USER_GROUP_SET', '('.$USER_DATA['group_id'].')');
           define('USER_IS_ADMIN', ($USER_DATA['mgroup'] == E107_ADMIN_GROUP));
           define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
           define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
           define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
           define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
           define('USER_CAN_CREATE_ALBUMS', (int)$USER_DATA['can_create_albums']);
        define('USER_UPLOAD_FORM', (int)$USER_DATA['upload_form_config']);
        define('CUSTOMIZE_UPLOAD_FORM', (int)$USER_DATA['custom_user_upload']);
        define('NUM_FILE_BOXES', (int)$USER_DATA['num_file_upload']);
        define('NUM_URI_BOXES', (int)$USER_DATA['num_URI_upload']);
           mysql_free_result($result);
        } else {
                $result = db_query("SELECT * FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = ".E107_GUEST_GROUP);
                if (!mysql_num_rows($result)) {
                        $USER_DATA = $default_group;
                } else {
                        $USER_DATA = mysql_fetch_array($result);
                }

        $USER_DATA['groups'] = array(E107_GUEST_GROUP);

           define('USER_ID', 0);
           define('USER_NAME', 'Anonymous');
                define('USER_GROUP_SET', '('.E107_GUEST_GROUP.')');
           define('USER_IS_ADMIN', 0);
           define('USER_CAN_SEND_ECARDS', (int)$USER_DATA['can_send_ecards']);
           define('USER_CAN_RATE_PICTURES', (int)$USER_DATA['can_rate_pictures']);
           define('USER_CAN_POST_COMMENTS', (int)$USER_DATA['can_post_comments']);
           define('USER_CAN_UPLOAD_PICTURES', (int)$USER_DATA['can_upload_pictures']);
           define('USER_CAN_CREATE_ALBUMS', 0);
        define('USER_UPLOAD_FORM', (int)$USER_DATA['upload_form_config']);
        define('CUSTOMIZE_UPLOAD_FORM', (int)$USER_DATA['custom_user_upload']);
        define('NUM_FILE_BOXES', (int)$USER_DATA['num_file_upload']);
        define('NUM_URI_BOXES', (int)$USER_DATA['num_URI_upload']);
                mysql_free_result($result);
        }
}
// Retrieve the name of a user
function udb_get_user_name($uid)
{
	$sql2 = new db;
	if(USER===TRUE){
		if(!empty($uid)){
			if($sql2 -> db_Select("user","user_name","user_id='{$uid}'")){
				$row = $sql2 -> db_Fetch();
				return $row['user_name'];
			} else {
				return "Unknown";
			}
		} else {
			return USERNAME;
		}
	} else {
		return "";
	}
}

// Retrieve the name of a user (Added to fix banning w/ bb integration - Nibbler)
function udb_get_user_id($username)
{
    global $CONFIG;

    $username = addslashes($username);
    $sql2 = new db;
    if (!(USER===TRUE)) return '';
    if ($sql2 -> db_Select("user","user_id","user_name='{$username}'")){
        $row = $sql2 -> db_Fetch();
        return $row['user_id'];
    } else {
        return '';
    }
}

// Redirect
function udb_redirect($target)
{
        header('Location: '.$target);
        exit;
}

// For e107, these are all disabled...
// Register
function udb_register_page()
{
}
// Login
function udb_login_page()
{
}
// Logout
function udb_logout_page()
{
}
// Edit users
function udb_edit_users()
{
        $target = e_ADMIN.'users.php';
        udb_redirect($target);
}

function udb_get_user_infos($uid)
{
	// if $uid is the current user, it's ok.
	// Return enough info to show their own data in Coppermine, and to send ecards
	$ret = array();
	if(USER===TRUE && USER_ID == $uid){
		$sql2 = new db;
		if($sql2 -> db_Select("user","user_login,user_email","user_id='{$uid}'")){
			$row = $sql2 -> db_Fetch();
			$ret['user_name']	=$row['user_login'];
			$ret['user_email']=$row['user_email'];
		}
	}

	return $ret;
}

// Edit user profile
function udb_edit_profile($uid)
{
        $target = e_HTTP.'usersettings.php';
        udb_redirect($target);
}
// Query used to list users
function udb_list_users_query(&$user_count)
{
        global $CONFIG, $FORBIDDEN_SET;

  if ($FORBIDDEN_SET != "") $forbidden = "AND $FORBIDDEN_SET";
       $sql =  "SELECT (category - ".FIRST_USER_CAT.") as user_id,".  " '???' as user_name,". " COUNT(DISTINCT a.aid) as alb_count,". "                COUNT(DISTINCT pid) as pic_count,". " MAX(pid) as thumb_pid ". "FROM {$CONFIG['TABLE_ALBUMS']} AS a ". "INNER JOIN {$CONFIG['TABLE_PICTURES']} AS p ON p.aid = a.aid ". "WHERE approved = 'YES' AND category > ".FIRST_USER_CAT. " $forbidden GROUP BY category ". "ORDER BY category ";
        $result = db_query($sql);

        $user_count = mysql_num_rows($result);

        return $result;
}

// Retrieve the album list used in gallery admin mode
function udb_get_admin_album_list()
{
        global $CONFIG, $UDB_DB_NAME_PREFIX, $UDB_DB_LINK_ID, $FORBIDDEN_SET;
                $sql = "SELECT aid, IF(category > ".FIRST_USER_CAT.", CONCAT('* ', title), CONCAT(' ', title)) AS title ".
                           "FROM {$CONFIG['TABLE_ALBUMS']} ".
                           "ORDER BY title";
                return $sql;
}

function udb_list_users_retrieve_data($result, $lower_limit, $count) {

        global $CONFIG, $mySQLprefix;

        mysql_data_seek($result, $lower_limit);

        $rowset = array();
        $i=0;
        $user_id_set='';

        while (($row = mysql_fetch_array($result)) && ($i++ < $count)){
                $user_id_set .= $row['user_id'].',';
                $rowset[] = $row;
        }
        mysql_free_result($result);

        $user_id_set = '('.substr($user_id_set, 0, -1).')';
   $sql = "SELECT user_id as user_id, user_name as user_name ". "FROM ".$mySQLprefix."user ". "WHERE user_id IN $user_id_set";
        $result = db_query($sql);
        while ($row = mysql_fetch_array($result)){
                $name[$row['user_id']] = $row['user_name'];
        }
        for($i=0; $i<count($rowset); $i++){
                $rowset[$i]['user_name'] = empty($name[$rowset[$i]['user_id']]) ? '???' : $name[$rowset[$i]['user_id']];
        }

        return $rowset;
}
// Group table synchronisation
function udb_synchronize_groups()
{
        global $CONFIG,$mySQLprefix;

        $result = db_query("SELECT userclass_id, userclass_name FROM ".$mySQLprefix."userclass_classes WHERE 1");
        while ($row = mysql_fetch_array($result)){
                $e107_groups[$row['userclass_id']+4] = $row['userclass_name'];
        }
        mysql_free_result($result);

        $result=db_query("SELECT group_id, group_name FROM {$CONFIG['TABLE_USERGROUPS']} WHERE 1");
        while ($row = mysql_fetch_array($result)){
                $cpg_groups[$row['group_id']] = $row['group_name'];
        }
        mysql_free_result($result);
        // Scan Coppermine groups that need to be deleted
        foreach($cpg_groups as $c_group_id => $c_group_name){
            if ((!isset($e107_groups[$c_group_id]) && $c_group_id > 4)) {
                           db_query("DELETE FROM {$CONFIG['TABLE_USERGROUPS']} WHERE group_id = '".$c_group_id."' LIMIT 1");
                        unset($cpg_groups[$c_group_id]);
                }
        }
        // Scan e107 groups that need to be created inside Coppermine table
        if(count($e107_groups)){
                foreach($e107_groups as $i_group_id => $i_group_name){
                        if ((!isset($cpg_groups[$i_group_id]))) {
                                if($i_group_name != "COPPERMINE_ADMIN"){
                                        db_query("INSERT INTO {$CONFIG['TABLE_USERGROUPS']} (group_id, group_name) VALUES ('$i_group_id', '".addslashes($i_group_name)."')");
                                        $cpg_groups[$i_group_id] = $i_group_name;
                                }
                        }
                }
        // Update Group names
                foreach($e107_groups as $i_group_id => $i_group_name){
                        if ($cpg_groups[$i_group_id] != $i_group_name) {
                                db_query("UPDATE {$CONFIG['TABLE_USERGROUPS']} SET group_name = '".addslashes($i_group_name)."' WHERE group_id = '$i_group_id' LIMIT 1");
                        }
                }
        }
}


function udb_util_filloptions()
{
    global $albumtbl, $picturetbl, $categorytbl, $lang_util_php, $CONFIG,$mySQLprefix;

    $usertbl = $mySQLprefix."user";

    if (UDB_CAN_JOIN_TABLES) {

        $query = "SELECT aid, category, IF(user_name IS NOT NULL, CONCAT('(', user_name, ') ', a.title), CONCAT(' - ', a.title)) AS title " . "FROM $albumtbl AS a " . "LEFT JOIN $usertbl AS u ON category = (" . FIRST_USER_CAT . " + user_id) " . "ORDER BY category, title";
        $result = db_query($query, $UDB_DB_LINK_ID);
        // $num=mysql_numrows($result);
        echo '<select size="1" name="albumid">';
        echo "<option value=\"-99\">".$lang_util_php['process_all_albums']."</option>\n";

        while ($row = mysql_fetch_array($result)) {
            $sql = "SELECT name FROM $categorytbl WHERE cid = " . $row["category"];
            $result2 = db_query($sql);
            $row2 = mysql_fetch_array($result2);

            print "<option value=\"" . $row["aid"] . "\">" . $row2["name"] . $row["title"] . "</option>\n";
        }

        print '</select> (3)';
        print '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$lang_util_php['submit_form'].'" class="submit" /> (4)';
        print '</form>';

    } else {

        // Query for list of public albums

        $public_albums = db_query("SELECT aid, title, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE category < " . FIRST_USER_CAT . " ORDER BY title");

        if (mysql_num_rows($public_albums)) {
            $public_result = db_fetch_rowset($public_albums);
        } else {
            $public_result = array();
        }

        // Initialize $merged_array
        $merged_array = array();

        // Count the number of albums returned.
        $end = count($public_result);

        // Cylce through the User albums.
        for($i=0;$i<$end;$i++) {

            //Create a new array sow we may sort the final results.
            $merged_array[$i]['id'] = $public_result[$i]['aid'];
            $merged_array[$i]['album_name'] = $public_result[$i]['title'];

            // Query the database to get the category name.
            $vQuery = "SELECT name, parent FROM " . $CONFIG['TABLE_CATEGORIES'] . " WHERE cid='" . $public_result[$i]['category'] . "'";
            $vRes = mysql_query($vQuery);
            $vRes = mysql_fetch_array($vRes);
            if (isset($merged_array[$i]['username_category'])) {
                $merged_array[$i]['username_category'] = (($vRes['name']) ? '(' . $vRes['name'] . ') ' : '').$merged_array[$i]['username_category'];
            } else {
                $merged_array[$i]['username_category'] = (($vRes['name']) ? '(' . $vRes['name'] . ') ' : '');
            }

        }

        // We transpose and divide the matrix into columns to prepare it for use in array_multisort().
        foreach ($merged_array as $key => $row) {
           $aid[$key] = $row['id'];
           $title[$key] = $row['album_name'];
           $album_lineage[$key] = $row['username_category'];
        }

        // We sort all columns in descending order and plug in $album_menu at the end so it is sorted by the common key.
        array_multisort($album_lineage, SORT_ASC, $title, SORT_ASC, $aid, SORT_ASC, $merged_array);

        // Query for list of user albums

        $user_albums = db_query("SELECT aid, title, category FROM {$CONFIG['TABLE_ALBUMS']} WHERE category >= " . FIRST_USER_CAT . " ORDER BY aid");
        if (mysql_num_rows($user_albums)) {
            $user_albums_list = db_fetch_rowset($user_albums);
        } else {
            $user_albums_list = array();
        }

        // Query for list of user IDs and names

        $user_album_ids_and_names = db_query("SELECT (user_id + ".FIRST_USER_CAT.") as id, CONCAT('(', user_name, ') ') as name FROM $usertbl ORDER BY name ASC",$UDB_DB_LINK_ID);

        if (mysql_num_rows($user_album_ids_and_names)) {
            $user_album_ids_and_names_list = db_fetch_rowset($user_album_ids_and_names);
        } else {
            $user_album_ids_and_names_list = array();
        }

        // Glue what we've got together.

        // Initialize $udb_i as a counter.
        if (count($merged_array)) {
            $udb_i = count($merged_array);
        } else {
            $udb_i = 0;
        }

        //Begin a set of nested loops to merge the various query results.
        foreach ($user_albums_list as $aq) {
            foreach ($user_album_ids_and_names_list as $uq) {
                if ($aq['category'] == $uq['id']) {
                    $merged_array[$udb_i]['id']= $aq['category'];
                    $merged_array[$udb_i]['album_name']= $aq['title'];
                    $merged_array[$udb_i]['username_category']= $uq['name'];
                    $udb_i++;
                }
            }
        }

        // The user albums and public albums have been merged into one list. Print the dropdown.
        echo '<select size="1" name="albumid">';
	echo "<option value=\"-99\">".$lang_util_php['process_all_albums']."</option>\n";

        foreach ($merged_array as $menu_item) {

            echo "<option value=\"" . $menu_item['id'] . "\">" . (isset($menu_item['username_category']) ? $menu_item['username_category'] : '') . $menu_item['album_name'] . "</option>\n";

        }

        // Close list, etc.
        print '</select> (3)';
        print '&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="'.$lang_util_php['submit_form'].'" class="submit" /> (4)';
        print '</form>';

    }

}


?>