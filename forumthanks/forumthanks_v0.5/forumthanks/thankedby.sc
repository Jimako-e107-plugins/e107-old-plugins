parse_str($parm);
   global $post_info, $sql;

   $post_id    = $post_info['thread_id'];

   $thankcount = 0;
   $thankcount = $sql->db_count("forum_thanks","(*)","WHERE Thanks_PostID= {$post_id} ");
   if ($thankcount <> 1){$plural="s";}
    $sql2 = new db;
    if ($sql2->db_select("forum_thanks","Thanks_FromUserID","Thanks_PostID=".$post_id))
       {
         while ($row = $sql2->db_Fetch())
              {
                    $user_id = $row['Thanks_FromUserID'];
                    $userinfo  = get_user_data($user_id);
                    $user_name = $userinfo["user_name"];
                    $userlist .="".$com."&nbsp;<a href='".e_BASE."user.php?id.".$user_id."'>".$user_name."</a>&nbsp;";
                    $com = ",";
               }

                  $text .="
                  <div style='cursor:pointer' onclick=\"expandit('exp_thanks_{$post_id}')\">
                  ".LAN_T2.$thankcount.LAN_T3.$plural." 
                  </div>
                  <div id='exp_thanks_{$post_id}' style='display:none'>
                  ".$userlist."
                  </div></div>
                  ";

   }

return $text;
