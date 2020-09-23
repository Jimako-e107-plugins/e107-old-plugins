<?php
if (!defined('e107_INIT')) { exit; }


if(check_class($extraclass)){



$lvisit = USERLV;


$userfound = $sql -> db_Select("onlineinfo_read","*","user_id=".USERID."");


if ($userfound==0){
	
	$sql->db_Insert(onlineinfo_read,"".USERID.",'','','','','','','','','','','','','','','','','','','','',''","user_id=".USERID."");			
	
}


while($row = $sql -> db_Fetch()){
	extract($row);

$newsread = cleanup($news);
$chatboxread = cleanup($chatbox);
$commentsread = cleanup($comments);
$contentsread = cleanup($contents);
$downloadsread = cleanup($downloads);
$guestbookread = cleanup($guestbook);
$picturesread = cleanup($pictures);
$moviesread = cleanup($movies);
$linksread = cleanup($links);
$sitemembersread = cleanup($sitemembers);
$gamesread = cleanup($games);
$gametopread = cleanup($game_top);
$galleryread = cleanup($gallery);
$ibfread = cleanup($ibf);
$smfread = cleanup($smf);
$bugread = cleanup($bug);
$chatbox2read = cleanup($chatbox2);
$copperread = cleanup($copper);
$jokesread = cleanup($jokes);
$blogsread = cleanup($blogs);
$suggestionsread = cleanup($suggestions);
}													    	

if($pref['onlineinfo_shownews']==1){



if($newsread != "")
		{
			$news_read = " AND news_id NOT IN (".$newsread.")";
		}

    $new_news = $sql->db_Count("news", "(*)", "WHERE news_datestamp>'" . $lvisit . "' and news_class IN (".USERCLASS_LIST.") ".$news_read."");

    if (!$new_news)
    {
        $new_news = ONLINEINFO_COUNTER_L9;
    }

}



$checkfornew=0;
$splitcomments= explode("|",$commentsread);

if($splitcomments[0] != "")
		{
			$comments_read = " AND comment_id NOT IN (".$splitcomments[0].")";
		}


    $new_comments = $sql->db_Count("comments", "(*)", "WHERE comment_datestamp>'" . $lvisit . "'".$comments_read."");


if ($pref['onlineinfo_bugtracker3'] == 1)
{
	
	if($splitcomments[3] != "")
		{
			$btdcomments_read = " AND bugtracker3_devc_timestamp NOT IN (".$splitcomments[3].")";
		}
	
	
    $new_bugdev_comments = $sql -> db_Count("bugtracker3_developer_comments", "(*)", " WHERE bugtracker3_devc_timestamp>$lvisit".$btdcomments_read."");
    }else{
	$new_bugdev_comments =0;	
	}


if ($pref['onlineinfo_coppermine'] == 1)
{
	
	if($splitcomments[1] != "")
		{
			$ccomments_read = " AND msg_id NOT IN (".$splitcomments[1].")";
		}
	
	
    $new_pic_comments = $sql -> db_Count("CPG_comments", "(*)", " WHERE UNIX_TIMESTAMP(msg_date)>$lvisit".$ccomments_read."");
    }else{
	$new_pic_comments =0;	
	}
	

	
	
	
    
    if ($pref['onlineinfo_gallery2use'] == 1)
    {
    	
    		if($splitcomments[2] != "")
		{
			$gcomments_read = " AND g_id NOT IN (".$splitcomments[2].")";
		}
    	
    	$query="SELECT COUNT(*) as records FROM ".$pref['onlineinfo_gallery2prefix']."Comment WHERE g_date>$lvisit".$gcomments_read."";
    	
		if($new_gcomments = $sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
			
			extract($row);
		$new_gallery_comments = $records;				
			
		}}
		
    }else{
		$new_gallery_comments=0;
	}


    $new_comments= $new_comments + $new_pic_comments + $new_gallery_comments + $new_bugdev_comments;

    if (!$new_comments)
    {

        $new_comments = ONLINEINFO_COUNTER_L9;
    }





    if ($pref['onlineinfo_chatbox'] == 1)
    {
    	
    	if($chatboxread != "")
		{
			$chatboxread = " AND cb_id NOT IN (".$chatboxread.")";
		}
    	
		$new_chat = $sql->db_Count("chatbox", "(*)", "WHERE cb_datestamp>'".$lvisit."'".$chatboxread."");

		if (!$new_chat)
		{
			$new_chat = ONLINEINFO_COUNTER_L9;
		}
    }
    
        if ($pref['onlineinfo_chatboxII'] == 1)
    {
    	
    	if($chatbox2read != "")
		{
			$chatbox2read = " AND cb2_id NOT IN (".$chatbox2read.")";
		}
    	
		$new_chat2 = $sql->db_Count("chatbox2", "(*)", "WHERE cb2_datestamp>'".$lvisit."'".$chatbox2read."");

		if (!$new_chat2)
		{
			$new_chat2 = ONLINEINFO_COUNTER_L9;
		}
    }
    
     if ($pref['onlineinfo_joke'] == 1)
    {
    	
    	if($jokesread != "")
		{
			$jokesread = " AND joke_id NOT IN (".$jokesread.")";
		}
    	
		$new_joke = $sql->db_Count("jokemenu_jokes", "(*)", "WHERE joke_posted>'".$lvisit."'".$jokesread."");

		if (!$new_joke)
		{
			$new_joke = ONLINEINFO_COUNTER_L9;
		}
    }
    
    
        
     if ($pref['onlineinfo_suggestions'] == 1)
    {
    	
    	if($suggestionsread != "")
		{
			$suggestionsread = " AND suggestion_id NOT IN (".$suggestionsread.")";
		}
    	
		$new_suggestions = $sql->db_Count("sugg_suggs", "(*)", "WHERE suggestion_posted>'".$lvisit."' AND suggestion_approved=1".$suggestionsread."");

		if (!$new_suggestions)
		{
			$new_suggestions = ONLINEINFO_COUNTER_L9;
		}
    }
    
    

    if ($pref['onlineinfo_forum'] == 1)
    {

	// forum_class from form header = user class
$userviewed = USERVIEWED;

$viewed = "";
		if($userviewed)
		{
			$viewed = preg_replace("#\.+#", ".", $userviewed);
			$viewed = preg_replace("#^\.#", "", $viewed);
			$viewed = preg_replace("#\.$#", "", $viewed);
			$viewed = str_replace(".", ",", $viewed);
		}
		if($viewed != "")
		{
			$viewed = " AND ft.thread_id NOT IN (".$viewed.")";
		}
		
	$qry = "SELECT ft.*, fp.thread_name as post_subject, fp.thread_total_replies as replies, u.user_id, f.forum_name,f.forum_id, u.user_name, f.forum_class
		FROM #forum_t AS ft
		LEFT JOIN #forum_t as fp ON fp.thread_id = ft.thread_parent
		LEFT JOIN #user as u ON u.user_id = SUBSTRING_INDEX(ft.thread_user,'.',1)
		LEFT JOIN #forum as f ON f.forum_id = ft.thread_forum_id
		WHERE ft.thread_datestamp > ".$lvisit. "
		AND f.forum_class IN (".USERCLASS_LIST.")
		{$viewed}
		ORDER BY ft.thread_datestamp DESC LIMIT 0, ".$pref['onlineinfo_forumnum'];		
		
		$new_forum = $sql->db_Select_gen($qry);


		if (!$new_forum)
		{
			$new_forum = ONLINEINFO_COUNTER_L9;
		}

    }


if ($pref['onlineinfo_members'] == 1)
    {

if($sitemembersread != "")
		{
			$newmembers = " AND user_id NOT IN (".$sitemembersread.")";
		}

    $new_users = $sql->db_Count("user", "(*)", "WHERE user_join>'" . $lvisit . "' ".$newmembers."");
    if (!$new_users)
    {
        $new_users = ONLINEINFO_COUNTER_L9;
    }

}


if ($pref['onlineinfo_smfuse']==1)

{
	if($smfread != "")
		{
			$newsmf = " AND ID_MSG NOT IN (".$smfread.")";
		}
		
			$script="SELECT * FROM ".$pref['onlineinfo_smfprefix']."messages WHERE posterTime >='". $lvisit ."'".$newsmf;
			$onlineinfo_smf_sql = new db;
			$onlineinfo_getsmfinfo = $onlineinfo_smf_sql->db_Select_gen($script);
		
			if (!$onlineinfo_getsmfinfo)
			{
				$onlineinfo_getsmfinfo=ONLINEINFO_COUNTER_L9;
			}


}


if ($pref['onlineinfo_ibfuse']==1)

{
	if($ibfread != "")
		{
			$newibf = " AND topic_id NOT IN (".$ibfread.")";
		}
		
			$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."posts WHERE post_date >='". $lvisit ."'".$newibf;
			$onlineinfo_ipb_sql = new db;
			$onlineinfo_getipbinfo = $onlineinfo_ipb_sql->db_Select_gen($script);
		
			if (!$onlineinfo_getipbinfo)
			{
				$onlineinfo_getipbinfo=ONLINEINFO_COUNTER_L9;
			}


}

if ($pref['onlineinfo_gallery2use']==1)

{

   	if($galleryread != "")
		{
			$newgallery = " AND g_id NOT IN (".$galleryread.")";
		}
		
		
			$script="SELECT * FROM ".$pref['onlineinfo_gallery2prefix']."Item WHERE g_canContainChildren ='0' AND g_viewedSinceTimestamp >='". $lvisit ."' ".$newgallery;
			$onlineinfo_gallery2_sql = new db;
			$onlineinfo_getgallery2info = $onlineinfo_gallery2_sql->db_Select_gen($script);
			
			if (!$onlineinfo_getgallery2info)
			{
				$onlineinfo_getgallery2info=ONLINEINFO_COUNTER_L9;
			}

}



	if ($pref['onlineinfo_guestbook'] == 1)
    {
    	
    	    	if($guestbookread != "")
		{
			$newguestbook = " AND id NOT IN (".$guestbookread.")";
		}
		
    $new_guestbook = $sql->db_Count("guestbook", "(*)", "WHERE date>'" . $lvisit . "' ".$newguestbook."");
 
	        if (!$new_guestbook)
	        {
	            $new_guestbook = ONLINEINFO_COUNTER_L9;
        }
    }




    	if ($pref['onlineinfo_content'] == 1)
	    {

		if($contentsread != "")
		{
			$newcontents = " AND content_id NOT IN (".$contentsread.")";
		}
    	

	    $new_content = $sql->db_Count("pcontent", "(*)", "WHERE content_datestamp>'" . $lvisit . "'  AND content_parent!='0' and content_class IN (".USERCLASS_LIST.") ".$newcontents."");
	    
		        if (!$new_content)
		        {
		            $new_content = ONLINEINFO_COUNTER_L9;
	        }
    }


    if ($pref['onlineinfo_coppermine'] == 1)
    {
    	
    	if($picturesread != "")
		{
			$newpictures = " AND pid NOT IN (".$picturesread.")";
		}
    	
    	
        $new_picture = $sql->db_Count("CPG_pictures", "(*)", "WHERE ctime>'" . $lvisit . "' ".$newpictures."");
       
        if (!$new_picture)
        {
            $new_picture = ONLINEINFO_COUNTER_L9;
        }
    }

    if ($pref['onlineinfo_sa_coppermineuse'] == 1)
    {
    	
    	if($copperread != "")
		{
			$newcopper = " AND pid NOT IN (".$copperread.")";
		}
    	
	
		$script="SELECT * FROM ".$pref['onlineinfo_sa_coppermineprefix']."pictures WHERE ctime >='". $lvisit ."' ".$newcopper;
		$onlineinfo_copper_sql = new db;
		$new_copper = $onlineinfo_copper_sql->db_Select_gen($script);
		
		if (!$new_copper)
		{
			$new_copper=ONLINEINFO_COUNTER_L9;
		}

    }

if ($pref['onlineinfo_blog'] == 1)
    {
	if($blogsread != "")
		{
			$newblog = " AND userjournals_id NOT IN (".$blogsread.")";
		}

    $new_blog = $sql->db_Count("userjournals", "(*)", "WHERE userjournals_timestamp>'".$lvisit."' ".$newblog."");
    
	    if (!$new_blog)
	    {
	        $new_blog = ONLINEINFO_COUNTER_L9;
	    }
}



    if ($pref['onlineinfo_downloads'] == 1)
    {
    	
    	if($downloadsread != "")
		{
			$newdownloads = " AND download_id NOT IN (".$downloadsread.")";
		}

        $new_downloads = $sql->db_Count("download", "(*)", "WHERE download_datestamp>'" . $lvisit . "'  and download_active=1 and download_visible IN (".USERCLASS_LIST.") ".$newdownloads."");
      
        if (!$new_downloads)
        {
            $new_downloads = ONLINEINFO_COUNTER_L9;
        }
    }
    
if ($pref['onlineinfo_links'] == 1)
    {
	if($linksread != "")
		{
			$newlinks = " AND link_id NOT IN (".$linksread.")";
		}

    $new_link = $sql->db_Count("links_page", "(*)", "WHERE link_datestamp>'".$lvisit."' and link_class IN (".USERCLASS_LIST.") ".$newlinks."");
    
	    if (!$new_link)
	    {
	        $new_link = ONLINEINFO_COUNTER_L9;
	    }
}

if ($pref['onlineinfo_youtube'] == 1)
    {
    	
    	if($moviesread != "")
		{
			$newmovie = " AND movie_id NOT IN (".$moviesread.")";
		}
    	
    $new_tube = $sql->db_Count("er_ytm_gallery_movies", "(*)", "WHERE UNIX_TIMESTAMP(timestamp)>'".$lvisit."' ".$newmovie."");
  
	    if (!$new_tube)
	    {
	        $new_tube = ONLINEINFO_COUNTER_L9;
	    }

	}
	
	if ($pref['onlineinfo_kroozearcade'] == 1)
{

if($gamesread != "")
		{
			$newgames = " AND game_id NOT IN (".$gamesread.")";
		}

	$new_game = $sql -> db_Count("arcade_games", "(*)","WHERE date_added>'".$lvisit."' ".$newgames."");
	
	    if (!$new_game)
	    {
	        $new_game = ONLINEINFO_COUNTER_L9;
	    }

}

if ($pref['onlineinfo_kroozearcadetop'] == 1)
{
	
	if($gametopread != "")
		{
			$newtopscore = " AND champ_id NOT IN (".$gametopread.")";
		}

	$new_gametop = $sql -> db_Count("arcade_champs", "(*)","WHERE date_scored>'".$lvisit."' ".$newtopscore."");
	
	    if (!$new_gametop)
	    {
	        $new_gametop = ONLINEINFO_COUNTER_L9;
	    }

}


if ($pref['onlineinfo_bugtracker3'] == 1)
{
	
	if($bugread != "")
		{
			$bugread = "AND ".MPREFIX."bugtracker3_bugs.bugtracker3_bugs_id NOT IN (".$bugread.")";
		}

	$new_bugs = $sql -> db_Count("bugtracker3_bugs", "(*)","WHERE bugtracker3_bugs_update_timestamp>'".$lvisit."' ".$bugread."");
	
	    if (!$new_bugs)
	    {
	        $new_bugs = ONLINEINFO_COUNTER_L9;
	    }

}






    if ($extrahide == 1)
    {

$checkfornew=$onlineinfo_getgallery2info+$onlineinfo_getipbinfo+$onlineinfo_getsmfinfo+$new_bugs+$new_gametop+$new_game+$new_tube+$new_link+$new_downloads+$new_blog+$new_copper+$new_picture+$new_content+$new_guestbook+$new_users+$new_forum+$new_suggestions+$new_joke+$new_chat2+$new_chat+$new_comments+$new_news;

        $text .= "<div id='updates-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L39.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L39.($checkfornew>0 ? " (".$checkfornew.")" : " (0)")."</div>";
	    $text .= "<div id='updates' class='switchgroup1' style='display:none'>";
        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><tr><td>";

    }
    else
    {

    	$text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_LOGIN_MENU_L39."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'><tr><td>";
    }

 if ($pref['onlineinfo_hideadminarea'] == 1){
    if (ADMIN == true){
	$e_sub_cat = 'main';

	if ($pref['onlineinfo_hideadmin'] == 1)
    {

        $text .= "<div id='admin-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='ADMIN SECTION'><b>&nbsp;".ADLAN_LAT_1."</b></div>";
         $text .= "<div id='admin' class='switchgroup1' style='display:none; border-style:inset; padding-left: 2px;'>";
	}
    else
    {
		$text .= '<div style="text-align:left; vertical-align: middle; font-size: '.$onlineinfomenufsize.'px; width:".$onlineinfomenuwidth.";"><b>'.ADLAN_LAT_1.'</b></div><div style="border-style:inset; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth.";">';
	}
	
	// ADMIN Section
	
if (ADMIN) {
						
			global $sql, $ns, $pref;

	   		$active_uploads = $sql -> db_Count("upload", "(*)", "WHERE upload_active = '0' ");
			$submitted_news = $sql -> db_Count("submitnews", "(*)", "WHERE submitnews_auth = '0' ");

			$text .= "<div style='padding-bottom: 2px;'>".E_16_NEWS.($submitted_news ? " <a href='".e_ADMIN."newspost.php?sn'>".ADLAN_LAT_2.": $submitted_news</a>" : " ".ADLAN_LAT_2.": 0")."</div>";
			$text .= "<div style='padding-bottom: 2px;'>".E_16_UPLOADS.($active_uploads ? " <a href='".e_ADMIN."upload.php'>".ADLAN_LAT_7.": $active_uploads</a>" : " ".ADLAN_LAT_7.": ".$active_uploads)."</div>";

			foreach($pref['e_latest_list'] as $val)
			{
				if (is_readable(e_PLUGIN.$val."/e_latest.php"))
				{
				   		include_once(e_PLUGIN.$val."/e_latest.php");
				}
			}

			$messageTypes = array("Broken Download", "Dev Team Message");
			$queryString = "";
			foreach($messageTypes as $types) {
				$queryString .= " gen_type='$types' OR";
			}
			$queryString = substr($queryString, 0, -3);

			if($amount = $sql -> db_Select("generic", "*", $queryString)) {
				$text .= "<br /><b><a href='".e_ADMIN."message.php'>".ADLAN_LAT_8." [".$amount."]</a></b>";
			}

		
}

  
    $text.="</div><br />";

    }

}

 if ($pref['onlineinfo_whatsnewtype'] == 1){
    $text .= "<a href='" . e_PLUGIN . "onlineinfo_menu/new.php'>" . ONLINEINFO_LOGIN_MENU_L24 . "</a>";
    }else{
    $text .= "<a href='" . e_PLUGIN . "list_new/list.php?new'>" . ONLINEINFO_LOGIN_MENU_L24 . "</a>";
}


if ($pref['onlineinfo_new_icon'] == 1)
        {
		$newicon="<img src='" . e_PLUGIN . "onlineinfo_menu/images/" . $pref['onlineinfo_new_icontype'] . "' alt='' style='vertical-align:middle' />";
		}else{
		$newicon="";
		}

if($unreadpms==0)
{
$n=0;
}

if ($pref['onlineinfo_flashtext'] == 1)
        {
        $flashnew[0]="<div id='flashlink";
        $flashnew[1]="' flashtype=0 flashcolor='".$onlineinfomenucolour."'>";

        }else{
        $flashnew[0]="<div ";
        $flashnew[1]="style='text-align:left;'>";
        $n="";
        }


$newitems=0;


    $text.="<div style='font-weight:bold;'>".ONLINEINFO_LOGIN_MENU_L27."</div>";

if($pref['onlineinfo_shownews']==1){

    if ($new_news <> ONLINEINFO_COUNTER_L9)
    {
            $text .= $flashnew[0].$n.$flashnew[1].$new_news." ".($new_news == 1 ? ONLINEINFO_LOGIN_MENU_L14 : ONLINEINFO_LOGIN_MENU_L15).$newicon."</div>";
            $newitems++;
            if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    }
    else
    {
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_news." ".ONLINEINFO_LOGIN_MENU_L15."</div>";
        $newitems++;
        }
        
    }
}

    if ($pref['onlineinfo_content'] == 1)
	    {
	    if ($new_content <> ONLINEINFO_COUNTER_L9)
		        {
		         $text .= $flashnew[0].$n.$flashnew[1].$new_content." ".($new_content == 1 ? ONLINEINFO_LOGIN_MENU_L58 : ONLINEINFO_LOGIN_MENU_L59).$newicon."</div>";
		         $newitems++;
		          if ($pref['onlineinfo_flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($pref['onlineinfo_hideifnonew']==0){    	
		            $text .= "<div style='text-align:left;'>".$new_content." ".ONLINEINFO_LOGIN_MENU_L59."</div>";
		            $newitems++;
					}
	        }



}

    if ( $new_comments <> ONLINEINFO_COUNTER_L9)
	    {
	            $text .= $flashnew[0].$n.$flashnew[1].$new_comments." ".($new_comments == 1 ? ONLINEINFO_LOGIN_MENU_L18 : ONLINEINFO_LOGIN_MENU_L19).$newicon."</div>";
	            $newitems++;
	            if ($pref['onlineinfo_flashtext'] == 1){$n++;}
	    }
	    else
	    {
	    	if($pref['onlineinfo_hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_comments." ".ONLINEINFO_LOGIN_MENU_L19."</div>";
	        $newitems++;
	        }
   		}



    if ($pref['onlineinfo_chatbox'] == 1)
    {


    if ($new_chat <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_chat." ".($new_chat == 1 ? ONLINEINFO_LOGIN_MENU_L16 : ONLINEINFO_LOGIN_MENU_L17).$newicon."</div>";    
	    $newitems++;    
	    if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    
    }else{
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_chat." ".ONLINEINFO_LOGIN_MENU_L17."</div>";
        $newitems++;
        }
    }



	}
	
	    if ($pref['onlineinfo_chatboxII'] == 1)
    {


    if ($new_chat2 <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_chat2." ".($new_chat2 == 1 ? ONLINEINFO_LOGIN_MENU_L112 : ONLINEINFO_LOGIN_MENU_L113).$newicon."</div>";    
	    $newitems++;    
	    if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    
    }else{
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_chat2." ".ONLINEINFO_LOGIN_MENU_L113."</div>";
        $newitems++;
        }
    }



	}
	
	    if ($pref['onlineinfo_joke'] == 1)
    {


    if ($new_joke <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_joke." ".($new_joke == 1 ? ONLINEINFO_LOGIN_MENU_L117 : ONLINEINFO_LOGIN_MENU_L118).$newicon."</div>";    
	    $newitems++;    
	    if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    
    }else{
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_joke." ".ONLINEINFO_LOGIN_MENU_L118."</div>";
        $newitems++;
        }
    }



	}	
	
	    if ($pref['onlineinfo_suggestions'] == 1)
    {


    if ($new_suggestions <> ONLINEINFO_COUNTER_L9)
    {
	    $text .= $flashnew[0].$n.$flashnew[1].$new_suggestions." ".($new_suggestions == 1 ? ONLINEINFO_LOGIN_MENU_L121 : ONLINEINFO_LOGIN_MENU_L122).$newicon."</div>";    
	    $newitems++;    
	    if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    
    }else{
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_suggestions." ".ONLINEINFO_LOGIN_MENU_L122."</div>";
        $newitems++;
        }
    }

	}
	
	
	
    if ($pref['onlineinfo_forum'] == 1)
    {

    if ($new_forum <> ONLINEINFO_COUNTER_L9)
    {
      $text .= $flashnew[0].$n.$flashnew[1].$new_forum." ".($new_forum == 1 ? ONLINEINFO_LOGIN_MENU_L20 : ONLINEINFO_LOGIN_MENU_L21).$newicon."</div>";
      $newitems++;
      if ($pref['onlineinfo_flashtext'] == 1){$n++;}
    }
    else
    {
    	if($pref['onlineinfo_hideifnonew']==0){    	
        $text .= "<div style='text-align:left;'>".$new_forum." ".ONLINEINFO_LOGIN_MENU_L21."</div>";
        $newitems++;
        }   	
    }

    }

    if ($pref['onlineinfo_downloads'] == 1)
    {
        if ($new_downloads <> ONLINEINFO_COUNTER_L9)
        {
          $text .= $flashnew[0].$n.$flashnew[1].$new_downloads." ".($new_downloads == 1 ? ONLINEINFO_LOGIN_MENU_L32 : ONLINEINFO_LOGIN_MENU_L33).$newicon."</div>";
          $newitems++;
           if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }
        else
        {
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_downloads." ".ONLINEINFO_LOGIN_MENU_L33."</div>";
            $newitems++;
            }
        }


    }

if ($pref['onlineinfo_smfuse']==1)
	{

	if ($onlineinfo_getsmfinfo <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getsmfinfo." ".($onlineinfo_getsmfinfo == 1 ? ONLINEINFO_LOGIN_MENU_L104 : ONLINEINFO_LOGIN_MENU_L105).$newicon."</div>";
                $newitems++;
                if ($pref['onlineinfo_flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($pref['onlineinfo_hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getsmfinfo." ".ONLINEINFO_LOGIN_MENU_L105."</div>";
		         $newitems++;
		         }
        		}



	}


if ($pref['onlineinfo_ibfuse']==1)
	{

	if ($onlineinfo_getipbinfo <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getipbinfo." ".($onlineinfo_getipbinfo == 1 ? ONLINEINFO_LOGIN_MENU_L64 : ONLINEINFO_LOGIN_MENU_L65).$newicon."</div>";
                $newitems++;
                if ($pref['onlineinfo_flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($pref['onlineinfo_hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getipbinfo." ".ONLINEINFO_LOGIN_MENU_L65."</div>";
		         $newitems++;
		         }
        		}



	}


if ($pref['onlineinfo_gallery2use']==1)
	{

	if ($onlineinfo_getgallery2info <> ONLINEINFO_COUNTER_L9)
		        {
                $text .= $flashnew[0].$n.$flashnew[1].$onlineinfo_getgallery2info." ".($onlineinfo_getgallery2info == 1 ? ONLINEINFO_LOGIN_MENU_L86 : ONLINEINFO_LOGIN_MENU_L87).$newicon."</div>";
                $newitems++;
                if ($pref['onlineinfo_flashtext'] == 1){$n++;}
		        }
		        else
		        {
		        	if($pref['onlineinfo_hideifnonew']==0){    	
		         $text .= "<div style='text-align:left;'>".$onlineinfo_getgallery2info." ".ONLINEINFO_LOGIN_MENU_L87."</div>";
		         $newitems++;
		         }
        		}



	}




if ($pref['onlineinfo_guestbook'] == 1)
    {
    if ($new_guestbook <> ONLINEINFO_COUNTER_L9)
	        {
            $text .= $flashnew[0].$n.$flashnew[1].$new_guestbook." " . ($new_guestbook == 1 ? ONLINEINFO_LOGIN_MENU_L53 : ONLINEINFO_LOGIN_MENU_L54).$newicon."</div>";
            $newitems++;
			if ($pref['onlineinfo_flashtext'] == 1){$n++;}
	        }
	        else
	        {
	        	if($pref['onlineinfo_hideifnonew']==0){    	
	         $text .= "<div style='text-align:left;'>".$new_guestbook." ".ONLINEINFO_LOGIN_MENU_L54."</div>";
	         $newitems++;
	         }
       		 }


}


    if ($pref['onlineinfo_coppermine'] == 1)
    {
        if ($new_picture <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_picture." ".($new_picture == 1 ? ONLINEINFO_LOGIN_MENU_L34 : ONLINEINFO_LOGIN_MENU_L35).$newicon."</div>";
         $newitems++;
         if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }
        else
        {
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_picture." ".ONLINEINFO_LOGIN_MENU_L35."</div>";
            $newitems++;
            }
        }


    }
    
    
        if ($pref['onlineinfo_sa_coppermineuse'] == 1)
    {
        if ($new_copper <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_copper." ".($new_copper == 1 ? ONLINEINFO_LOGIN_MENU_L114 : ONLINEINFO_LOGIN_MENU_L115).$newicon."</div>";
         $newitems++;
         if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }
        else
        {
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_copper." ".ONLINEINFO_LOGIN_MENU_L115."</div>";
            $newitems++;
            }
        }


    }
    
    if ($pref['onlineinfo_youtube'] == 1)
{
    
    if ($new_tube <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_tube." ".($new_tube == 1 ? ONLINEINFO_LOGIN_MENU_L88 : ONLINEINFO_LOGIN_MENU_L89).$newicon."</div>";
         $newitems++;
         if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }
        else
        {
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_tube." ".ONLINEINFO_LOGIN_MENU_L89."</div>";
            $newitems++;
            }
        }


    }
    
        if ($pref['onlineinfo_kroozearcade'] == 1)
{
    
    if ($new_game <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_game." ".($new_game == 1 ? ONLINEINFO_LOGIN_MENU_L100 : ONLINEINFO_LOGIN_MENU_L101).$newicon."</div>";
         $newitems++;
         if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }else{
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_game." ".ONLINEINFO_LOGIN_MENU_L101."</div>";
            $newitems++;
            }
        }


    }
    
    
            if ($pref['onlineinfo_kroozearcadetop'] == 1)
{
    
    if ($new_gametop <> ONLINEINFO_COUNTER_L9)
        {
         $text .= $flashnew[0].$n.$flashnew[1].$new_gametop." ".($new_gametop == 1 ? ONLINEINFO_LOGIN_MENU_L102 : ONLINEINFO_LOGIN_MENU_L103).$newicon."</div>";
         $newitems++;
         if ($pref['onlineinfo_flashtext'] == 1){$n++;}
        }else{
        	if($pref['onlineinfo_hideifnonew']==0){    	
            $text .= "<div style='text-align:left;'>".$new_gametop." ".ONLINEINFO_LOGIN_MENU_L103."</div>";
            $newitems++;
            }
        }


    }
    
    

if ($pref['onlineinfo_links'] == 1)
    {
        if ($new_link <> ONLINEINFO_COUNTER_L9)
	    {
			$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_link." ".($new_link == 1 ? ONLINEINFO_LOGIN_MENU_L60 : ONLINEINFO_LOGIN_MENU_L61).$newicon."</div>";
		if ($pref['onlineinfo_flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($pref['onlineinfo_hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_link." ".ONLINEINFO_LOGIN_MENU_L61."</div>";
			$newitems++;
	        }
    }
}



if ($pref['onlineinfo_bugtracker3'] == 1)
    {
        if ($new_bugs <> ONLINEINFO_COUNTER_L9)
	    {
		$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_bugs." ".($new_bugs == 1 ? ONLINEINFO_LOGIN_MENU_L109 : ONLINEINFO_LOGIN_MENU_L110).$newicon."</div>";
		if ($pref['onlineinfo_flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($pref['onlineinfo_hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_bugs." ".ONLINEINFO_LOGIN_MENU_L110."</div>";
	        $newitems++;
	        }
    }
}


if ($pref['onlineinfo_blog'] == 1)
    {
        if ($new_blog <> ONLINEINFO_COUNTER_L9)
	    {
		$newitems++;
	     $text .= $flashnew[0].$n.$flashnew[1].$new_blog." ".($new_blog == 1 ? ONLINEINFO_LOGIN_MENU_L119 : ONLINEINFO_LOGIN_MENU_L120).$newicon."</div>";
		if ($pref['onlineinfo_flashtext'] == 1){$n++;}

	    }
	    else
	    {
	    	if($pref['onlineinfo_hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_blog." ".ONLINEINFO_LOGIN_MENU_L119."</div>";
	        $newitems++;
	        }
    }
}



	if ($pref['onlineinfo_members'] == 1)
	    {
	    if ($new_users <> ONLINEINFO_COUNTER_L9)
	    {
	        $text .= $flashnew[0].$n.$flashnew[1].$new_users." ".($new_users == 1 ? ONLINEINFO_LOGIN_MENU_L22 : ONLINEINFO_LOGIN_MENU_L23).$newicon."</div>";
			$newitems++;
	    }
	    else
	    {
	    	if($pref['onlineinfo_hideifnonew']==0){    	
	        $text .= "<div style='text-align:left;'>".$new_users." ".ONLINEINFO_LOGIN_MENU_L23."</div>";
	        $newitems++;
	        }
	    }	    
	    
	}
	
	
	if($newitems == 0){$text .= "<div style='text-align:left; font-weight:bold;'>".ONLINEINFO_LOGIN_MENU_L111."</div>";}
	

		if ($extrahide == 1){
		$text.="</td></tr></table><br /></div>";
		}else{
	        $text .= "</td></tr></table></div>";
	        }
	

}



require_once(e_PLUGIN."onlineinfo_menu/regusers.php");


?>