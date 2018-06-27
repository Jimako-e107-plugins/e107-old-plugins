<?php
global $PHPTHUMB_CONFIG, $THCONFIG_THDEF, $tp, $sgal_pref, $pref, $sgalobj, $sql;

if (!defined('e107_INIT')) { exit; }
if (!defined('SGAL_INIT')) { 
	require_once(e_PLUGIN.'sgallery/init.php');
}

if(check_class($pref['sgal_active']) && check_class($pref['sgal_album_comments'])) { 
    include_lan(SGAL_LAN.'_ecomment.php');
    $e_comment['eplug_comment_ids'] = "sgallery"; //This is set to the table name you have decided to use.
    $e_comment['plugin_path'] = "sgallery"; //The path of your plugin.
    $e_comment['plugin_name'] = SGAL_COMLAN_0; //A name for your plugin. It will be used in links to comments, in list_new/new.php.
    //This is set to the location you'd like the user to return to after replying to a comment.
    $e_comment['reply_location'] = SGAL_PATH_ABS."gallery.php?comment_reply.{NID}"; 
    $e_comment['db_title'] = "title"; //This is the name of the field in your plugin's db table that corresponds to it's name or title.
    $e_comment['db_id'] = "album_id"; // This is the name of the field in your plugin's db table that correspond to it's unique id number.
    
    //qry must be set with a select_gen query.
    //the main reason would be to check if a category from another table has a class restriction
    //the id of the item should be provided as {NID}
    //returned fields should at least contain the 'link_id' and 'db_id' fields set above
    $e_comment['qry'] = '';
    if(!check_class($sgal_pref['sgal_usermod_visible'])) {
    	$e_comment['qry'] = "al.sgal_user='' AND ";
    } else {
        $e_comment['qry'] = "(c.active > 0 || al.sgal_user!='') AND ";
    }
    
    $e_comment['qry']				= "
    SELECT al.* 
    FROM #sgallery as al 
    LEFT JOIN #sgallery_cats as c ON c.cat_id=al.cat_id 
    WHERE {$e_comment['qry']}al.album_id='{NID}' AND al.active=1 AND al.album_ustatus > 0
    ";
}
?>