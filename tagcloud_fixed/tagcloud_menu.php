<?php

 global $tp;
 if (!defined('e107_INIT')) { exit; }

//if we can pass to this the "tag_item_id" values from the current pages {TAGS} SC
//we can contruct the cloud from relevant tags
//then cache this

   include_lan(e_PLUGIN.'tagcloud/languages/'.e_LANGUAGE.'/lan_tagcloud.php');
 $text = "{TAGCLOUD=15}
         <div style='text-align:center;'><a href='".e_PLUGIN_ABS."tagcloud/tagcloud.php'>".LAN_TG6."</a></div>
         " ;
 $text = $tp->parseTemplate($text)."\n";
 
 $caption = e107::getPlugConfig('tagcloud')->getPref('tags_menuname');

 $ns -> tablerender($caption, $text);

?>

