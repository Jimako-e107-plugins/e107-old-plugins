<?php
if (!defined('e107_INIT')) { exit(); }
$e_comment['eplug_comment_ids'] = 'eg_comment';
$e_comment['reply_location'] = e_PLUGIN."easygallery/gallery.php?comment={NID}";
$e_comment['plugin_name'] = 'EasyGallery';
$e_comment['plugin_path'] = 'easygallery';
//This is the name of the field in your plugin's db table that corresponds to it's name or title.
$e_comment['db_title'] = 'image';
//This is the name of the field in your plugin's db table that correspond to it's unique id number.
$e_comment['db_id'] = 'id';
//qry must be set with a select_gen query.
//the main reason would be to check if a category from another table has a class restriction
//the id of the item should be provided as {NID}
//returned fields should at least contain the 'link_id' and 'db_id' fields set above
$e_comment['qry'] = "
SELECT *
FROM #eg_comment
WHERE id='{NID}'";
?>