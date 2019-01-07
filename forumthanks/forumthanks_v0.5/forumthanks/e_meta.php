<?php

if (e_PAGE == "forum_viewtopic.php") {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	

	$forum_old = "{MODOPTIONS}";
	
        if ($pref['thanks_thanklist']){
	   $forum_new = "{THANKS}{THANKEDBY}{MODOPTIONS}";}
        else {$forum_new = "{THANKS}{MODOPTIONS}";}

	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);

        if ($pref['thanks_replaceposts']){
	$forum_old = "{POSTS}";
	$forum_new = "{POSTS}{THANKSPOSTS}";
	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE  = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);
        }

        $forum_old = "Powered by <b>e107 Forum System</b>";
	$forum_new = "Powered by <b>e107 Forum System</b><a href='http://www.wistop.com/blog'>{SITENAME} uses forum thanks</a>";
	$FORUMEND = str_replace($forum_old, $forum_new, $FORUMEND);
}

if (e_PAGE == "user.php") {
        require_once(e_THEME."/templates/user_template.php");
        include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');


        if ($pref['thanks_showuser']){
           $tmp        = explode(".", e_QUERY);
           $thanks_user= intval($tmp[1]);
           $thanks_rec = $sql->db_count("forum_thanks","(*)","WHERE Thanks_ToUserID   = {$thanks_user}");
           $thanks_giv = $sql->db_count("forum_thanks","(*)","WHERE Thanks_FromUserID = {$thanks_user}");
	   $forum_old  = "{USER_FORUM_LINK}";
	   $forum_new  = "
           {USER_FORUM_LINK}
           <tr>
	   <td style='width:30%' class='forumheader3'>".LAN_T29."</td>
	   <td style='width:70%' class='forumheader3'>".$thanks_rec."</td>
           </tr>
           <tr>";
           if ($thanks_rec>0){
              $forum_new  .= "
	      <td colspan=2 class='forumheader3'>
              <a href='".e_PLUGIN."forumthanks/thanks.php?posts.0.".$thanks_user."'>".LAN_T30."</a><br>
              </td>
              </tr>";
              }
           $forum_new  .= "
           <tr>
	   <td style='width:30%' class='forumheader3'>".LAN_T31."</td>
	   <td style='width:70%' class='forumheader3'>".$thanks_giv."</td>
           </tr>";
           if ($thanks_giv>0){
              $forum_new  .= "
              <tr>
	      <td colspan=2 class='forumheader3'>
              <a href='".e_PLUGIN."forumthanks/thanks.php?posts.1.".$thanks_user."'>".LAN_T32."</a>
              </td>
              </tr>";
              }

	   $USER_FULL_TEMPLATE = str_replace($forum_old, $forum_new, $USER_FULL_TEMPLATE);
        }

}



if (e_PAGE == "forum.php") {

        if ($pref['thanks_statlink']){
	   require_once(e_PLUGIN."forum/templates/forum_template.php");
           include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');

           $ty .= " | <a href='".e_PLUGIN."forumthanks/thanks.php?posts.2'>".LAN_T28."</a> | " ;
           $ty .= "<a href='".e_PLUGIN."forumthanks/thanks.php?user.0'>".LAN_T22."</a> | " ;
           $ty .= "<a href='".e_PLUGIN."forumthanks/thanks.php?user.1'>".LAN_T23."</a>" ;

	   $forum_old = "{USERINFO}";
           $forum_new = "{USERINFO}".$ty;


	$FORUM_MAIN_END = str_replace($forum_old, $forum_new, $FORUM_MAIN_END);
        }
}

if (e_PAGE == "forum_viewtopic.php") {
             include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');
}



?>