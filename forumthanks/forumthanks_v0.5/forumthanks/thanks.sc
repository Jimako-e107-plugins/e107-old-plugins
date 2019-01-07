parse_str($parm);
   global $post_info, $sql;

   $postowner  = $post_info['user_id'];
   $post_id    = $post_info['thread_id'];


   if ($pref['thanks_start'])
   {
    if ($post_info['thread_parent']<>0){return;}
   }
   if (USER){
      if (!$sql->db_select("forum_thanks","1","Thanks_FromUserID=".USERID." AND Thanks_PostID=".$post_id) )
         if (USERID <> $postowner){
            {
            if ($pref['thanks_icon'])
                {
                $text .=  "<a href='".e_PLUGIN."forumthanks/thanks.php?thank.".$post_id.".".$postowner."'>
                <img src=' ".e_PLUGIN."forumthanks/images/thanks.png'>
                </a>";
                }
            else{
                 $text .=  "<a href='".e_PLUGIN."forumthanks/thanks.php?thank.".$post_id.".".$postowner."'>".LAN_T1."</a>";
                }
            }
         }
   }
return $text;