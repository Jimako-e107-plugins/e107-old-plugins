<?php

if ($pref['tags_usecumulus']){
echo '<script type="text/javascript" src="'.e_PLUGIN.'tagcloud/cumulus/swfobject.js"></script>';
}

if (e_PAGE == "news.php" && $pref['tags_emetanews']) {
        //echo "meta started";

	//require_once(THEME."theme.php");

	$old = "{EXTENDED}";
        $new = "{EXTENDED}<p><br>{TAGS}";

	$NEWSSTYLE = str_replace($old, $new, $NEWSSTYLE);
}


if (e_PAGE == "forum_viewtopic.php" && $pref['tags_emetaforum']) {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");

	$forum_old = "{PROFILEIMG}";
	$forum_new = "{TAGS}<br>{PROFILEIMG}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE  = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
}

if (e_PAGE == "download.php" && $pref['tags_emetadownload']) {

	include_once(THEME."theme/download_template.php");

	$old = "{DOWNLOAD_VIEW_DESCRIPTION}";
        $new = "{DOWNLOAD_VIEW_DESCRIPTION}{TAGS}";

	$DOWNLOAD_VIEW_TABLE = str_replace($old, $new, $DOWNLOAD_VIEW_TABLE);
}


/*   --rendering content fails?
if (e_PAGE == "content.php" && $pref['tags_emetadownload']) {

	include_once(e_PLUGIN."content/templates/default/content_content_template.php");

	$old = "{CONTENT_CONTENT_TABLE_TEXT}";
        $new = "{CONTENT_CONTENT_TABLE_TEXT}{TAGS}TEST";

	$CONTENT_CONTENT_TABLE = str_replace($old, $new, $CONTENT_CONTENT_TABLE);
}
*/


?>