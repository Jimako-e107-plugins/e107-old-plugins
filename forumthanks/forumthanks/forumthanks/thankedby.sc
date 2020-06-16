parse_str($parm);
   global $post_info, $sql , $gen;

   $post_id    = $post_info['thread_id'];
   
   $postwoner_name = $post_info['user_name'];

   $thankcount = 0;
   $thankcount = $sql->db_count("forum_thanks","(*)","WHERE Thanks_PostID= {$post_id} ");
   if ($thankcount <> 1){$plural="";}
    $sql2 = new db;
    if ($sql2->db_select("forum_thanks","*","Thanks_PostID=".$post_id))
       {
         while ($row = $sql2->db_Fetch())
              {
                    $user_id = $row['Thanks_FromUserID'];
                    $timestamp = $row['Thanks_datestamp'];
                    //$userinfo  = getx_user_data($user_id);
                    $userinfo  = e107::user($user_id);
                    $user_name = $userinfo["user_name"];
                    $thanks_id = $row['Thanks_ID'];
                    $thankeduserid = $row['Thanks_ToUserID'];
                    
                    $time     = time();
					$today = $time - 86400;
					$yesterday = $time - 172800;
					$two_day = $time - 259200;
					$three_day = $time - 345600;
					$four_day = $time - 432000;
					$five_day = $time - 518400;
					$six_day = $time - 604800;
					$lastweek = $time - 691200;
					$thank_date = "";
                    
                    if ($pref['thanks_show_date'])
                    {
					if($today < $timestamp)
					{
						$thank_date = LAN_T39;
					}
					else if($yesterday < $timestamp)
					{
						$thank_date = LAN_T40;
					}
					else if($two_day < $timestamp)
					{
						$thank_date = LAN_T41;
					}
					else if($three_day < $timestamp)
					{
						$thank_date = LAN_T42;
					}
					else if($four_day < $timestamp)
					{
						$thank_date = LAN_T43;
					}
					else if($five_day < $timestamp)
					{
						$thank_date = LAN_T44;
					}
					else if($six_day < $timestamp)
					{
						$thank_date = LAN_T45;
					}
					else if($lastweek < $timestamp)
					{
						$thank_date = LAN_T46;
					}
					else
					{
						$thank_date = "(".$gen->convert_date($timestamp,"short").")";
					}
					}
                    $userlist .="".$com."&nbsp;<a href='".e_BASE."user.php?id.".$user_id."'>".$user_name."</a>"." ".$thank_date." ";
                    $com = ",";
                    $user_in_array[] = $user_id;
               }
               
               if(in_array(USERID,$user_in_array) && $pref['allow_remove_thanks']){$delete_thank = "<div id=\"rem_thank_btn_div_{$post_id}\" style='text-align:left'><a href=\"".e_PLUGIN."forumthanks/thanks.php?remove.".$post_id.".".$thanks_id."\" onclick=\"remove_ajax_thanks(".$post_id.",".$thanks_id.",".$thankeduserid."); return false;\">".LAN_T50."</a></div>";}


                  $text .="
<table border=\"0\" width=\"100%\" style=\"border-style: solid; border-width: 1px; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px\">
	<tr>
		<td class='fcaption' valign=\"top\" width=\"70%\">".LAN_T36." ".$thankcount." ".LAN_T37."<a href='".e_BASE."user.php?id.".$user_id."'> ".$postwoner_name."</a> ".LAN_T38." : </td>
		<td class='fcaption' valign=\"top\" width=\"30%\">".$delete_thank."</td>
	</tr>
	<tr>
		<td valign=\"top\" colspan=\"2\" width=\"100%\">".$userlist."</td>
	</tr>
</table>";
	

   }

return $text;
