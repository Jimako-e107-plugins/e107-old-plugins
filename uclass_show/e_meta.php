<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."uclass_show/languages/".e_LANGUAGE.".php");
global $class2, $pref;

//pref e107 avatar e max-width
$max_width = "max-width:".$pref['im_width']."px";
//visualizzazione condizionale
(($pref['uclass_show_hide_guest'] == 1) && (USER == FALSE)) ? $show = 0 : $show = 1;

if (($pref['uclass_show_active'] == 1) && ($show == 1)){
   
   //forum
   if ($pref['uclass_show_forum'] == 1) {
   
      //prelevo template forum_viewtopic
      if (file_exists(THEME."forum_viewtopic_template.php")){
         require_once(THEME."forum_viewtopic_template.php");
      }else{
         require_once(e_BASE.$PLUGINS_DIRECTORY."forum/templates/forum_viewtopic_template.php");
      }
      
      //upgrade 1.01 12 nov 12 rev. 12 nov 2012 09.42
      //for custom templates who use custom shortcodes
      (($pref['uclass_show_use_custom'] == 1) && ($pref['uclass_show_use_custom_forum'] != "")) ? $SC_SEARCH_FORUM = $pref['uclass_show_use_custom_forum'] : $SC_SEARCH_FORUM = "{AVATAR}";
      
      //sostituzioni nel template
      if($FORUMTHREADSTYLE){
         
         $FORUMTHREADSTYLE = str_replace("".$SC_SEARCH_FORUM."","".$SC_SEARCH_FORUM."<div style='clear:both;".$max_width.";'>{FORUMUCSHOW}</div>",$FORUMTHREADSTYLE);
			
	}
      if($FORUMREPLYSTYLE){
         
         $FORUMREPLYSTYLE = str_replace("".$SC_SEARCH_FORUM."","".$SC_SEARCH_FORUM."<div style='clear:both;".$max_width."'>{FORUMUCSHOW}</div>",$FORUMREPLYSTYLE);
			
	}
      if($FORUMREPLYSTYLE_ALT){
         
         $FORUMREPLYSTYLE_ALT = str_replace("".$SC_SEARCH_FORUM."","".$SC_SEARCH_FORUM."<div style='clear:both;".$max_width."'>{FORUMUCSHOW}</div>",$FORUMREPLYSTYLE_ALT);
			
	}       
   
   }
   
   //user_template
   if ($pref['uclass_show_profile'] == 1) {
   
      //prelevo template forum_viewtopic
      if (file_exists(THEME."user_template.php")){
         require_once(THEME."forum_viewtopic_template.php");
      }else{
         require_once(e_BASE.$THEMES_DIRECTORY."templates/user_template.php");
      }
      
      //upgrade 1.01 12 nov 12 rev. 12 nov 2012 09.42
      //for custom templates who use custom shortcodes
      (($pref['uclass_show_use_custom'] == 1) && ($pref['uclass_show_use_custom_user'] != "")) ? $SC_SEARCH_USER = $pref['uclass_show_use_custom_user'] : $SC_SEARCH_USER = "{USER_LOGINNAME}";      
      
      
      //sostituzioni nel template
      if($USER_FULL_TEMPLATE){
         
         $USER_FULL_TEMPLATE = str_replace("".$SC_SEARCH_USER."","".$SC_SEARCH_USER."<div style='clear:both'>{USERUCSHOW}</div>",$USER_FULL_TEMPLATE);
         

	}   
   
   }
   
   //comment_style
   if ($pref['uclass_show_comment'] == 1) {
      
      //upgrade 1.01 12 nov 12 rev. 12 nov 2012 09.42
      //for custom templates who use custom shortcodes
      (($pref['uclass_show_use_custom'] == 1) && ($pref['uclass_show_use_custom_comment'] != "")) ? $SC_SEARCH_COMMENT = $pref['uclass_show_use_custom_comment'] : $SC_SEARCH_COMMENT = "{AVATAR}";
       
      //sostituzioni nel template
      if($COMMENTSTYLE){
         
         $COMMENTSTYLE = str_replace("".$SC_SEARCH_COMMENT."","".$SC_SEARCH_COMMENT."<div style='clear:both;".$max_width."'>{COMMENTUCSHOW}</div>",$COMMENTSTYLE);
         
	}else{
         
         require_once(e_BASE.$THEMES_DIRECTORY."templates/comment_template.php");
         $COMMENTSTYLE = str_replace("".$SC_SEARCH_COMMENT."","".$SC_SEARCH_COMMENT."<div style='clear:both;".$max_width."'>{COMMENTUCSHOW}</div>",$COMMENTSTYLE);
      }   
   
   }   

}

   




?>