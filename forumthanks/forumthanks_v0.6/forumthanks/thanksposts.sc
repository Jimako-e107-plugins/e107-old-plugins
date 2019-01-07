parse_str($parm);
   global $post_info, $sql;

   $postowner  = $post_info['user_id'];


   $posts       = $sql->db_count("forum_thanks","(distinct Thanks_PostID)","WHERE Thanks_ToUserID = {$postowner}");
   $thankcount  = $sql->db_count("forum_thanks","(*)","WHERE Thanks_ToUserID = {$postowner}");

   if ($thankcount <> 1){$plural="";}
   if ($post_info['user_forums'] <> 1){$plural2="";}

   $text .= "<a href='".e_PLUGIN."forumthanks/thanks.php?posts.0.".$postowner."'>";
   $text .= LAN_T4.$thankcount.LAN_T5.$plural.LAN_T6.$posts.LAN_T7.$plural2."<br />";
   $text .= "</a>";
return $text;