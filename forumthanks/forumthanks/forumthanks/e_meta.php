<?php

if (e_PAGE == "forum_viewtopic.php") {
	require_once(e_PLUGIN."forum/templates/forum_viewtopic_template.php");
	include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_thanks.php');
	
	// add ajax
	echo '<script src="'.e_PLUGIN.'forumthanks/js/jquery.js"></script>';
	
	$thank_link = '"'.e_PLUGIN.'forumthanks/thanks.php?thank." + post_id + "." + post_owner';
	
	$remove_link = '"'.e_PLUGIN.'forumthanks/thanks.php?remove." + post_id + "." + thank_id';
	
	$loading_icon = "<img src='".e_PLUGIN."forumthanks/user_images/loading/".$pref['thanks_loading_icon']."'>";
	
	if(!file_exists(e_PLUGIN."forumthanks/user_images/loading/".$pref['thanks_loading_icon'].""))
	{
		$loading_icon = "<img src='".e_PLUGIN."forumthanks/images/default.gif'>";
	}
	
	$thanks_icon = "<img src='".e_PLUGIN."forumthanks/user_images/thank/".$pref['thanks_icon']."'>";
	
	if(!file_exists(e_PLUGIN."forumthanks/user_images/thank/".$pref['thanks_icon'].""))
	{
		$thanks_icon = "<img src='".e_PLUGIN."forumthanks/images/thanks.png'>";
	}
	
	$thank_btn = '<a href=" + '.$thank_link.' + " onclick=\'make_ajax_thanks(" + post_id + "," + post_owner + "); return false;\'>'.$thanks_icon.' </a>';
	
	$loading_thank_contents_btn = "$loading_icon $thanks_icon";
	
	$remove_btn = '<a href=" + '.$remove_link.' + " onclick=\'remove_ajax_thanks(" + post_id + "," + thank_id + "); return false;\'>'.LAN_T50.' </a>';
	
	$loading_remove_thank_contents_btn = "$loading_icon ".LAN_T50;
	
	echo '
	</script>
	<script type="text/javascript">
	
	var show_loading;
	var loadErrortext;
	var thankbutton;
	
	 var $thank = jQuery.noConflict();

	
		function make_ajax_thanks(post_id,post_owner) {
			
			var thank_timer = setTimeout("alert(\''.LAN_T49.'\')", 30000);
			
			show_loading = "'.$loading_thank_contents_btn.'" ;
			
			document.getElementById("exp_thank_btn_div_" + post_id).innerHTML=show_loading;
			
			$thank("#exp_thanks_" + post_id).load('.$thank_link.',{ajax_thank : 1},function (responseText, textStatus, XMLHttpRequest) {
			
				if (textStatus == "success") {
				
						clearTimeout(thank_timer);
				
						document.getElementById("exp_thank_btn_div_" + post_id).innerHTML= " ";
						
				}
				if (textStatus == "error") {
				
						loadErrortext = "'.LAN_T48.'&nbsp; : &nbsp;";			
				
						thankbutton = loadErrortext + "'.$thank_btn.'";	
											
						document.getElementById("exp_thank_btn_div_" + post_id).innerHTML=thankbutton;
						
				}
});

		}
		
		function remove_ajax_thanks(post_id,thank_id,post_owner) {
			
			var rem_timer = setTimeout("alert(\''.LAN_T49.'\')", 30000);
			
			show_loading = "'.$loading_remove_thank_contents_btn.'" ;
			
			document.getElementById("rem_thank_btn_div_" + post_id).innerHTML=show_loading;
			
			$thank("#exp_thanks_" + post_id).load('.$remove_link.',{ajax_thank : 1},function (responseText, textStatus, XMLHttpRequest) {
			
				if (textStatus == "success") {
				
						thankbutton = "'.$thank_btn.'";
				
						clearTimeout(rem_timer);
						
						document.getElementById("exp_thank_btn_div_" + post_id).innerHTML=thankbutton;
						
						if(document.getElementById("rem_thank_btn_div_" + post_id))
						{
						document.getElementById("rem_thank_btn_div_" + post_id).innerHTML= " ";
						}
				}
				if (textStatus == "error") {
				
						loadErrortext = "'.LAN_T48.'&nbsp; : &nbsp;";		
				
						thankbutton = loadErrortext + "'.$remove_btn.'";		
						
						document.getElementById("rem_thank_btn_div_" + post_id).innerHTML=thankbutton;
						
				}
});

		}

	</script>';

	// End Ajax
	
	$forum_old = "{MODOPTIONS}";
	
	$forum_new = "<div id=\"exp_thank_btn_div_{RETURN_POST_ID}\" style='text-align:left'>{THANKS}</div>{MODOPTIONS}";

	$FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace($forum_old, $forum_new, $FORUMREPLYSTYLE);

	$thankcount = 0;
	$thankcount = $sql->db_count("forum_thanks","(*)","WHERE Thanks_PostID= {$post_id} ");
	
	$new_thank_list_style ='
	<tr>
    
	<td class=\'forumheader3\' style=\'vertical-align:top\' colspan="2" id="exp_thanks_{RETURN_POST_ID}">{THANKEDBY}</td>

	</tr>';
	
	$FORUMTHREADSTYLE .= $new_thank_list_style;
	$FORUMREPLYSTYLE .= $new_thank_list_style;

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