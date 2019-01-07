parse_str($parm);
   global $post_info, $sql , $pref;

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
            
            	$thanks_icon = "<img src='".e_PLUGIN."forumthanks/user_images/thank/".$pref['thanks_icon']."'>";
	
				if(!file_exists(e_PLUGIN."forumthanks/user_images/thank/".$pref['thanks_icon'].""))
				{
					$thanks_icon = "<img src='".e_PLUGIN."forumthanks/images/thanks.png'>";
				}
				
                $text .=  "<a href='".e_PLUGIN."forumthanks/thanks.php?thank.".$post_id.".".$postowner."' onclick=\"make_ajax_thanks(".$post_id.",".$postowner."); return false;\">
                $thanks_icon
                </a>";
                
            }
         }
   }
return $text;