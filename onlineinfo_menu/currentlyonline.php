<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|     onlineinfo_menu_v8.5.3
|     UTF-8 encoded
|     translated for: http://www.e107cms.de
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $HeadURL: https://e107german.svn.sourceforge.net/svnroot/e107german/trunk/e107_0.7/e107_plugins/onlineinfo_menu/currentlyonline.php $ 
|     $Revision: 159 $
|     $Date: 2011-09-29 18:55:56 +0200 (Do, 29. Sep 2011) $
|     $Id: currentlyonline.php 159 2011-09-29 16:55:56Z lars78 $
|     $Author: lars78 $
|
|     $updated by: webmaster@e107cms.de (http://www.e107cms.de)$
|     Uhrzeit Format auf 24-Stunden Anzeige geändert
|     . hinter Tag im Datum eingefügt
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if(check_class($orderclass)){



if ($pref['onlineinfo_nolocations']==1){





		if ($pref['onlineinfo_ibfuse'] == 1)
		{

			$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."sessions WHERE running_time >= UNIX_TIMESTAMP(DATE_SUB(UTC_TIMESTAMP(),INTERVAL ".$pref['onlineinfo_ibftime']." MINUTE)) ORDER BY member_name ASC ";
			$onlineinfo_ipb_sql = new db;
			$onlineinfo_getipbinfo = $onlineinfo_ipb_sql->db_Select_gen($script);

			}



$totalonline=MEMBERS_ONLINE + GUESTS_ONLINE + $onlineinfo_getipbinfo;


if ($orderhide == 1){


    $text .= '<div id="current-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.ONLINEINFO_LOGIN_MENU_L30.' ('.ONLINE_EL2.MEMBERS_ONLINE.', '.ONLINE_EL1.GUESTS_ONLINE;


   if ($pref['onlineinfo_ibfuse'] == 1){ $text.=', '.ONLINEINFO_LIST_31.': '.$onlineinfo_getipbinfo;}

    $text.=')">&nbsp;'.ONLINEINFO_LOGIN_MENU_L30.' ('.$totalonline.')</div>';
	$text .= '<div id="current" class="switchgroup1" style="display:none; margin-left:2px;">';

}else{

 $text .= '<br /><div class="smallblacktext" style="font-size: '.$onlineinfomenufsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.ONLINEINFO_LOGIN_MENU_L30.'</div><div>';

}

    if(!defined('e_TRACKING_DISABLED') && (isset($pref['track_online']) && $pref['track_online'])) {


$fsize=$onlineinfomenufsize-1;


if ($pref['onlineinfo_hideusers'] == 1)
{

        $text .= '<div id="members-title" style="cursor:hand; margin-left:15px; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-size: '.$fsize.'px; font-weight:bold;" title="'.ONLINE_EL2.'">&nbsp;'.ONLINE_EL2.'('.MEMBERS_ONLINE.')</div>';
		$text .= '<div id="members" class="switchgroup1" style="display:none">';
        $text .= '<table style="text-align:left; width:'.$onlineinfomenuwidth.';"><tr><td>';



}ELSE{

         $text .= '<div class="smallblacktext" style="font-size: '.$fsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.ONLINE_EL2.'('.MEMBERS_ONLINE.')</div><div style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:10px;"><table style="text-align:left; width:'.$onlineinfomenuwidth.'"><tr><td>';


}




			 $script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id!='0' GROUP BY ".MPREFIX."user.user_id ORDER BY ".MPREFIX."user.user_name ASC";



			  $sql->db_Select_gen($script);


            while ($row = $sql->db_Fetch())
            {
                extract($row);


 						$isadmin = $row['user_admin'];
						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
						$online_location = $row['online_location'];
						$user_image=$row['user_image'];
						$user_chats=$row['user_chats'];
						$user_visits=$row['user_visits'];
						$user_comments=$row['user_comments'];
						$user_forums=$row['user_forums'];
						$user_customtitle=$row['user_customtitle'];
						$user_ipaddress=$row['online_ip'];


                if ($pref['onlineinfo_avatar'] == 1)
                {

					$joindate='';
					$lastvisit='';
					$lastpost='';



						$format = '%d %b %Y %T';
						$joindate =strftime($format,$row['user_join']);
						$lastvisit =strftime($format,$row['user_currentvisit']);

						if($row['user_lastpost']!=0){
						$lastpost =strftime($format,$row['user_lastpost']);

						}


	include_once(e_HANDLER.'rate_class.php');
	$rater = new rater;
	$rate='';
	if($rating = $rater->getrating('user', $user_id))
	{

	$rate='<strong>'.TOPMEMBERPLUGIN_1.'&nbsp;'.TOPMEMBERPLUGIN_2.':</strong>&nbsp;';
	$num = $rating[1];
	$rate.='('.$num.'/10)&nbsp;';
		for($i=1; $i<= $num; $i++)
		{
		$rate .= '<img src='.e_IMAGE_ABS.'user_icons/user_star_'.IMODE.'.png>';
		}
	}

	$sql3 = new db;
	$bikeplugin = $sql3->db_Count("plugin", "(*)", "WHERE plugin_name='My Bike' and plugin_installflag='1'");

	if ($bikeplugin)
	{

	$bike='';
	$there_votes=0;

	$script="SELECT sum(votes) as total_votes FROM ".MPREFIX."bikes";

		$tvotes_sql = new db;
		$tvotes = $tvotes_sql->db_Select_gen($script);
				while ($row2 = $tvotes_sql->db_Fetch())
			{

			$totalvotes= $row2['total_votes'];

			}

	$script="SELECT votes FROM ".MPREFIX."bikes WHERE user_id='".$user_id."'";

	$votes_sql = new db;
			$gvotes = $votes_sql->db_Select_gen($script);
					while ($row2 = $votes_sql->db_Fetch())
				{

				$there_votes= $row2['votes'];

			}

			$percentofvotes= round((100/$totalvotes)*$there_votes,2);

				$bike = '<strong>Bike Votes: </strong>'.$there_votes.' ('.$percentofvotes.'%)';

	}


	// car plugin for Andy

	$sql4 = new db;
		$carplugin = $sql4->db_Count("plugin", "(*)", "WHERE plugin_name='My Car' and plugin_installflag='1'");

		if ($carplugin)
		{

		$car='';
		$there_votes=0;

		$script="SELECT sum(votes) as total_votes FROM ".MPREFIX."cars";

			$tvotes_sql = new db;
			$tvotes = $tvotes_sql->db_Select_gen($script);
					while ($row2 = $tvotes_sql->db_Fetch())
				{

				$totalvotes= $row2['total_votes'];

				}

		$script="SELECT votes FROM ".MPREFIX."cars WHERE user_id='".$user_id."'";

		$votes_sql = new db;
				$gvotes = $votes_sql->db_Select_gen($script);
						while ($row2 = $votes_sql->db_Fetch())
					{

					$there_votes= $row2['votes'];

				}

				$percentofvotes= round((100/$totalvotes)*$there_votes,2);

					$car = '<strong>Car Votes: </strong>'.$there_votes.' ('.$percentofvotes.'%)';

	}




				if ($user_image == '')
                        {
                            $user_image =  e_PLUGIN.'onlineinfo_menu/images/default.png';
                            $AVATAR = '<div class="spacer"><a href="javascript:void(0)" onMouseover="onlineinfoddrivetip(\'<table border=0 cellspacing=0 cellpadding=0><tr><td rowspan=10><img src='.$user_image.'>&nbsp;&nbsp;&nbsp;&nbsp;<br /><strong>'.$user_customtitle.'</strong>&nbsp;&nbsp;</td><td><strong>'.ONLINEINFO_LOGIN_MENU_L48.':</strong>&nbsp;'.$joindate.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L77.':</strong>&nbsp;'.$lastvisit.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L78.':</strong>&nbsp;'.$lastpost.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L49.':</strong>&nbsp;'.$user_visits.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L50.':</strong>&nbsp;'.$user_chats.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L51.':</strong>&nbsp;'.$user_forums.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L52.':</strong>&nbsp;'.$user_comments.'</td></tr>';

                           if(ADMIN == TRUE){
							   $AVATAR.='<tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L124.':</strong>&nbsp;'.$user_ipaddress.'</td></tr>';
}
                            $AVATAR .='<tr><td colspan=2>'.$rate.'</td></tr><tr><td colspan=2>'.$bike.'</td></tr><tr><td colspan=2>'.$car.'</td></tr></table>\',\'\',\'450\')"  onMouseout="hideonlineinfoddrivetip()"><img src="'.$user_image.'" width="25" alt="" border="0" /></a></div>';

						 }else{

                            $user_image = str_replace(' ', '%20', $user_image);
                            require_once(e_HANDLER.'avatar_handler.php');
                            $userimage = avatar($user_image);
                            $AVATAR = '<div class="spacer"><a href="javascript:void(0)" onMouseover="onlineinfoddrivetip(\'<table border=0 cellspacing=0 cellpadding=0><tr><td rowspan=10><img src='.$userimage.'>&nbsp;&nbsp;&nbsp;&nbsp;<br /><strong>'.$user_customtitle.'</strong>&nbsp;&nbsp;</td><td><strong>'.ONLINEINFO_LOGIN_MENU_L48.':</strong>&nbsp;'.$joindate.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L77.':</strong>&nbsp;'.$lastvisit.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L78.':</strong>&nbsp;'.$lastpost.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L49.':</strong>&nbsp;'.$user_visits.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L50.':</strong>&nbsp;'.$user_chats.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L51.':</strong>&nbsp;'.$user_forums.'</td></tr><tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L52.':</strong>&nbsp;'.$user_comments.'</td></tr>';

                           if(ADMIN == TRUE){
							   $AVATAR .='<tr><td><strong>'.ONLINEINFO_LOGIN_MENU_L124.':</strong>&nbsp;'.$user_ipaddress.'</td></tr>';
}
                            $AVATAR .='<tr><td colspan=2>'.$rate.'</td></tr><tr><td colspan=2>'.$bike.'</td></tr><td colspan=2>'.$car.'</td></tr></table>\',\'\',\'450\')"  onMouseout="hideonlineinfoddrivetip()"><img src="'.$userimage.'" width="25" alt="" border="0" /></a></div>';

                        }

                }
                else
                {
                    $AVATAR = '<div class="spacer"><img src="'.e_PLUGIN.'onlineinfo_menu/images/default.png"  alt="" style="vertical-align:middle;" width="25" alt="" border="0" /></div>';
                }

                $oid = $user_id;
                $oname = $user_name;
                $online_location_page = eregi_replace('.php', '', substr(strrchr($online_location, '/'), 1));
                if ($online_location_page == 'log' || $online_location_page == 'error')
                {
                    $online_location = 'news.php';
                    $online_location_page = ONLINE_EL13;
                }
                if ($online_location_page == 'request')
                {
                    $online_location = 'download.php';
                }
                if ($online_location_page == 'request.php')
				{
				$online_location = 'download.php';
				}

                if (strstr($online_location_page, 'forum'))
                {


				  $forumlocation= explode('.',$online_location_page);
				  $online_location = eregi_replace('forum_viewtopic.php.', 'forum_viewtopic.php?', $online_location);
				  $online_location = eregi_replace('forum_viewforum.php.', 'forum_viewforum.php?', $online_location);

				if($forumlocation[0]=='forum')
				{
				$online_location_page=ONLINE_EL14;
				}

				if($forumlocation[0]=='forum_viewforum')
				{
				$online_location_page=ONLINEINFO_LOGIN_MENU_L68. $forumlocation[1];
				}

				if($forumlocation[0]=='forum_viewtopic')
				{
				$online_location_page=ONLINEINFO_LOGIN_MENU_L67. $forumlocation[1];
				}


                }


		$sql2 = new db;
							 				if (strstr($online_location_page, 'recent.'))

							               {
							                	$online_location = eregi_replace('content.php.recent.', 'content.php?recent.', $online_location);


												$getthenum= explode('?recent.',$online_location);

												$sql2->db_Select("pcontent", "content_heading", "content_id='$getthenum[1]'");
												while ($row = $sql2->db_Fetch())
												{
												extract($row);
												$online_location_page =$content_heading;
												}


											}


				if (strstr($online_location_page, '.content.'))


				{
							$getthenum= explode('content.php.content.',$online_location);

							$sql2->db_Select("pcontent", "content_heading", "content_id='$getthenum[1]'");
							while ($row = $sql2->db_Fetch())
								{
								extract($row);
								$online_location_page =$content_heading;
								}

					$online_location = eregi_replace('content.php.content.', 'content.php?content.', $online_location);
		}

		$online_location = eregi_replace('getxml.php', 'flashchat.php', $online_location);
		$online_location = eregi_replace('comment.php.', 'comment.php?', $online_location);
		$online_location = eregi_replace('content.php.','content.php?', $online_location);


		$online_location_page=getpage($online_location_page);


                $text .= '<div style="text-align:left;"><table style="width:'.$onlineinfomenuwidth.';">';
                $text .= '<tr><td style="vertical-align:middle;text-align:left;"';

                if ($pref['onlineinfo_showicons'] == 1)
                {
                    $text .= ' rowspan="2" ';
                }
                $online_eloc = ONLINE_EL7;

                if ($isadmin)
                {
                    $online_location = 'javascript:void(0)';
                    $online_location_page = ONLINEINFO_LOGIN_MENU_L43;
                    $online_eloc = '';
                }

                if ($pref['onlineinfo_showicons'] == 1)
                {

                $text .= '>'.$AVATAR.'</td>
					<td valign="middle" align="left" style="font-size:'.$pref["onlineinfo_usernamefontsize"].'px"><span '.getuserclassinfo($oid).'>'.$oname.'</span>'.$online_eloc.' <a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';

				}else{

				$text .= '>'.$AVATAR.'</td>
					<td valign="middle" align="left" style="font-size:'.$pref["onlineinfo_usernamefontsize"].'px"><a href="'.e_BASE.'user.php?id.'.$oid.'" '.getuserclassinfo($oid).'>'.$oname.'</a>'.$online_eloc.' <a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';
				}


                if ($pref['onlineinfo_showicons'] == 1)
                {
                    $text .= '<tr><td valign="middle">';


if (USER == true){
if(USERID != $oid){
                        $text .= '<a href="'.e_PLUGIN.'pm/pm.php?send.'.$oid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/icon_pm.png"  alt="'.ONLINEINFO_LOGIN_MENU_L70.'" style="vertical-align:middle;border:0;" /></a>&nbsp;&nbsp;';

}



}

                    $text .= '<a href="'.e_BASE.'user.php?id.'.$oid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/profile.png"  alt="'.ONLINEINFO_LOGIN_MENU_L69.'" style="vertical-align:middle;border:0;" /></a>&nbsp;&nbsp;';


if($pref['onlineinfo_amigo']!='255'){

			if(USERID != $oid){

			$text .= '<a href="javascript:void(0);" NAME="Add Buddy" title="" onClick=window.open("'.e_PLUGIN.'onlineinfo_menu/addamigo.php?addbuddy.'.$oid.'","Rating","width=80,height=40,left=150,top=200,toolbar=0,status=0,");><img src="'.e_PLUGIN.'onlineinfo_menu/images/friend.png"  alt="'.AMIGO_11.'" style="vertical-align:middle;border:0;" /></a>&nbsp;';

}
}





                    if ($pref['onlineinfo_showadmin'] == 1)
                    {
                        if ($isadmin == 1)
                        {
                            $text .= '<img src="'.e_PLUGIN.'onlineinfo_menu/images/admin.png"  alt="'.ONLINEINFO_LOGIN_MENU_L11.'" style="vertical-align:middle;border:0;" />&nbsp;';
                        }
                    }


$text.='<br />';


						$sql3 = new db;
						$bikeplugin = $sql3->db_Count("plugin", "(*)", "WHERE plugin_name='My Bike' and plugin_installflag='1'");

					  if ($bikeplugin)
				      {
				         $text .= '<a href="'.e_PLUGIN.'bikes/bike.php?id.'.$oid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/bike.png"  alt="View My Bike" style="vertical-align:middle;border:0;" /></a>';
    				  }


// added for Car plugin for Andy

						$sql4 = new db;
						$carplugin = $sql4->db_Count("plugin", "(*)", "WHERE plugin_name='My Car' and plugin_installflag='1'");

					  if ($carplugin)
				      {
				         $text .= '<a href="'.e_PLUGIN.'cars/car.php?id.'.$oid.'"><img src="'.e_PLUGIN.'onlineinfo_menu/images/car.png"  alt="View My Car" style="vertical-align:middle;border:0;" /></a>';
    				  }



                    $text .= '</td></tr><tr><td colspan="2" ></td></tr>';
                }

                $text .= '</table></div>';


}





$text.='</td></tr></table></div>';
            if ($pref['onlineinfo_guest'] == 1)
            {

           		if ($pref['onlineinfo_hideguest'] == 1)
            	{


        $text .= '<div id="guests-title" style="cursor:hand; margin-left:15px; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold; font-size: '.$fsize.'px;" title="'.ONLINE_EL1.'">&nbsp;'.ONLINE_EL1.'('.GUESTS_ONLINE.')</div>';
		$text .= '<div id="guests" class="switchgroup1" style="display:none">';
        $text .= '<table style="text-align:left; width:'.$onlineinfomenuwidth.';">';


            }else{

         $text .= '<div class="smallblacktext" style="font-size: '.$fsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.ONLINE_EL1.'('.GUESTS_ONLINE.')</div><div style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:20px;"><table style="text-align:left; width:'.$onlineinfomenuwidth.'">';

            }


                $script="SELECT online_user_id, online_location, online_ip FROM `".MPREFIX."online` WHERE online_user_id='0' GROUP BY online_user_id, online_location, online_ip ORDER BY online_location ASC";
			  $sql->db_Select_gen($script);

                while ($row = $sql->db_Fetch())
                {
                    extract($row);
                    $oname = $online_ip;
                    $online_location_page = eregi_replace('.php', '', substr(strrchr($online_location, '/'), 1));
                    if ($online_location_page == 'log' || $online_location_page == 'error')
					                {
					                    $online_location = 'news.php';
					                    $online_location_page = ONLINE_EL13;
					                }
					                if ($online_location_page == 'request')
					                {
					                    $online_location = 'download.php';
					                }
					                if ($online_location_page == 'request.php')
									{
									$online_location = 'download.php';
									}
					                if (strstr($online_location_page, 'forum'))
					                {

					$online_location = eregi_replace('forum_viewtopic.php.', 'forum_viewtopic.php?', $online_location);
					$online_location = eregi_replace('forum_viewforum.php.', 'forum_viewforum.php?', $online_location);

				  $forumlocation= explode('.',$online_location_page);


				if($forumlocation[0]=='forum')
				{
				$online_location_page=ONLINE_EL14;
				}

				if($forumlocation[0]=='forum_viewforum')
				{
				$online_location_page=ONLINEINFO_LOGIN_MENU_L68. $forumlocation[1];
				}

				if($forumlocation[0]=='forum_viewtopic')
				{
				$online_location_page=ONLINEINFO_LOGIN_MENU_L67. $forumlocation[1];
				}


					                }

$sql2 = new db;
					 				if (strstr($online_location_page, 'recent.'))

					               {
					                	$online_location = eregi_replace('content.php.recent.', 'content.php?recent.', $online_location);


										$getthenum= explode('?recent.',$online_location);

										$sql2->db_Select("pcontent", "content_heading", "content_id='$getthenum[1]'");
										while ($row = $sql2->db_Fetch())
										{
										extract($row);
										$online_location_page =$content_heading;
										}


									}


		if (strstr($online_location_page, '.content.'))


		{
					$getthenum= explode('content.php.content.',$online_location);

					$sql2->db_Select("pcontent", "content_heading", "content_id='$getthenum[1]'");
					while ($row = $sql2->db_Fetch())
						{
						extract($row);
						$online_location_page =$content_heading;
						}



			$online_location = eregi_replace('content.php.content.', 'content.php?content.', $online_location);
		}

		$online_location = eregi_replace('getxml.php', 'flashchat.php', $online_location);
		$online_location = eregi_replace('comment.php.', 'comment.php?', $online_location);
		$online_location = eregi_replace('content.php.','content.php?', $online_location);

		$online_location_page=getpage($online_location_page);



	//  Find Bots
	// ***********

	$webbot ='';
	$boticon='';

if($pref['onlineinfo_botchecker']==1){

	$host = $e107->get_host_name($oname);
	$getbot= explode('.',$host);

	if ($getbot[1]=='inktomisearch'){$webbot='Inktomi/Yahoo';$boticon='robot_yahoo.png';}
	if ($getbot[2]=='Yahoo'){$webbot='Yahoo';$boticon='robot_yahoo.png';}
	if ($getbot[1]=='msn'){$webbot='MSN';$boticon='robot_msn.png';}
	if ($getbot[1]=='gigablast'){$webbot='Gigablast';$boticon='robot_gigablast.png';}
	if ($getbot[1]=='googlebot'){$webbot='Google';$boticon='robot_google.png';}
	if ($getbot[1]=='lycos'){$webbot='Lycos';$boticon='robot_lycos.png';}
	if ($getbot[2]=='lycos'){$webbot='Lycos';$boticon='robot_lycos.png';}
	if ($getbot[1]=='t-online'){$webbot='Infoseek';$boticon='robot_infoseek.png';}
	if ($getbot[1]=='askj'){$webbot='Teoma/Ask';$boticon='robot_askjeeves.png';}
	if ($getbot[1]=='ask'){$webbot='Teoma/Ask';$boticon='robot_askjeeves.png';}
	if ($getbot[2]=='ask'){$webbot='Teoma/Ask';$boticon='robot_askjeeves.png';}
	if ($getbot[1]=='looksmart'){$webbot='Looksmart';$boticon='robot_looksmart.png';}
	if ($getbot[1]=='cosmixcorp'){$webbot='Kosmix';$boticon='robot_kosmix.png';}
	if ($getbot[1]=='goo'){$webbot='Goo';$boticon='robot_goo.png';}
	if ($getbot[1]=='exabot'){$webbot='Exalead';$boticon='robot_exalead.png';}
	if ($getbot[4]=='become'){$webbot='Become';$boticon='robot_become.png';}
	if ($getbot[1]=='search' && $getbot[2]=='live'){$webbot='Windows Live';$boticon='robot_windows_live_search.png';}
	if ($getbot[1]=='browster'){$webbot='Browster';$boticon='robot_browster.png';}
	if ($getbot[1]=='attentio.com'){$webbot='Attentio';$boticon='robot_attentio.png';}
	if ($getbot[2]=='yahoo'){$webbot='Yahoo';$boticon='robot_yahoo.png';}
	if ($getbot[3]=='searchme'){$webbot='Search Me';$boticon='robot_searchme.png';}
	if ($getbot[1]=='cuill'){$webbot='Cuill';$boticon='robot_cuill.png';}
	if ($getbot[1]=='search' && $getbot[2]=='msn'){$webbot='Windows Live';$boticon='robot_windows_live_search.png';}
	if ($getbot[1]=='entireweb'){$webbot='Entireweb';$boticon='robot_entireweb.png';}
	if ($getbot[1]=='cuil'){$webbot='Cuil';$boticon='robot_cuil.png';}
	if ($getbot[2]=='baidu'){$webbot='Baidu';$boticon='robot_baidu.png';}
	if ($getbot[1]=='naver'){$webbot='Naver';$boticon='robot_naver.png';}
	if ($getbot[1]=='dotnetdotcom'){$webbot='Dotbot';$boticon='robot_robot.png';}

	if(ip2long($oname)>=ip2long('65.214.36.0') && ip2long($oname)<=ip2long('65.214.39.255')){$webbot='Teoma/Ask';$boticon='robot_askjeeves.png';}
	if(ip2long($oname)>=ip2long('220.181.0.0') && ip2long($oname)<=ip2long('220.181.255.255')){$webbot='SoGou';$boticon='robot_sogou.png';}
	if(ip2long($oname)>=ip2long('66.151.181.0') && ip2long($oname)<=ip2long('66.151.181.255')){$webbot='Fast Search';$boticon='robot_fastsearch.png';}
	if(ip2long($oname)>=ip2long('70.42.51.0') && ip2long($oname)<=ip2long('70.42.51.0')){$webbot='Fast Search';$boticon='robot_fastsearch.png';}
	if(ip2long($oname)>=ip2long('69.25.71.0') && ip2long($oname)<=ip2long('69.25.71.255')){$webbot='Fast Search';$boticon='robot_fastsearch.png';}
	if(ip2long($oname)>=ip2long('209.59.128.0') && ip2long($oname)<=ip2long('209.59.191.255')){$webbot='AbiLogic';$boticon='robot_abilogic.png';}
	if(ip2long($oname)>=ip2long('69.25.71.0') && ip2long($oname)<=ip2long('69.25.71.255')){$webbot='Accoona';$boticon='robot_accoona.png';}
	if(ip2long($oname)>=ip2long('81.205.0.0') && ip2long($oname)<=ip2long('81.205.255.255')){$webbot='Walhello';$boticon='robot_walhello.png';}
	if(ip2long($oname)>=ip2long('202.106.0.0') && ip2long($oname)<=ip2long('202.106.255.255')){$webbot='Baidu';$boticon='robot_baidu.png';}
	if(ip2long($oname)>=ip2long('202.108.0.0') && ip2long($oname)<=ip2long('202.108.255.255')){$webbot='Baidu';$boticon='robot_baidu.png';}
	if(ip2long($oname)>=ip2long('216.148.252.96') && ip2long($oname)<=ip2long('216.148.252.111')){$webbot='Bloglines';$boticon='robot_bloglines.png';}
	if(ip2long($oname)>=ip2long('64.152.0.0') && ip2long($oname)<=ip2long('64.159.255.255')){$webbot='BlogPulse';$boticon='robot_blogpulse.png';}
	if(ip2long($oname)>=ip2long('84.136.0.0') && ip2long($oname)<=ip2long('84.191.25.255')){$webbot='BtBot';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('88.104.0.0') && ip2long($oname)<=ip2long('88.107.255.255')){$webbot='Burf';$boticon='robot_burf.png';}
	if(ip2long($oname)>=ip2long('70.84.0.0') && ip2long($oname)<=ip2long('70.87.127.255')){$webbot='CamCrawler';$boticon='robot_camcrawler.png';}
	if(ip2long($oname)>=ip2long('212.27.33.0') && ip2long($oname)<=ip2long('212.27.33.255')){$webbot='Pompos';$boticon='robot_pompos.png';}
	if(ip2long($oname)>=ip2long('133.9.0.0') && ip2long($oname)<=ip2long('133.9.255.255')){$webbot='e-Society';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('64.29.176.0') && ip2long($oname)<=ip2long('64.29.191.255')){$webbot='Filangy';$boticon='robot_filangy.png';}
	if(ip2long($oname)>=ip2long('80.239.38.0') && ip2long($oname)<=ip2long('80.239.38.255')){$webbot='Findexa';$boticon='robot_findexa.png';}
	if(ip2long($oname)>=ip2long('64.210.192.0') && ip2long($oname)<=ip2long('64.210.255.255')){$webbot='Girafa';$boticon='robot_girafa.png';}
	if(ip2long($oname)>=ip2long('209.237.237.0') && ip2long($oname)<=ip2long('209.237.238.255')){$webbot='Alexa';$boticon='robot_alexa.png';}
	if(ip2long($oname)>=ip2long('87.218.0.0') && ip2long($oname)<=ip2long('87.218.255.254')){$webbot='Ipselon';$boticon='robot_ipselon.png';}
	if(ip2long($oname)>=ip2long('128.194.0.0') && ip2long($oname)<=ip2long('128.194.255.255')){$webbot='IRL crawler';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('64.71.128.0') && ip2long($oname)<=ip2long('64.71.191.255')){$webbot='IRL crawler';$boticon='robot_krugle.png';}
	if(ip2long($oname)>=ip2long('82.131.195.0') && ip2long($oname)<=ip2long('82.131.195.255')){$webbot='Lapozz';$boticon='robot_lapozz.png';}
	if(ip2long($oname)>=ip2long('216.52.252.192') && ip2long($oname)<=ip2long('216.52.252.255')){$webbot='Local';$boticon='robot_local.png';}
	if(ip2long($oname)>=ip2long('64.242.88.0') && ip2long($oname)<=ip2long('64.242.88.255')){$webbot='Look Smart';$boticon='robot_looksmart.png';}
	if(ip2long($oname)>=ip2long('217.154.244.0') && ip2long($oname)<=ip2long('217.154.245.255')){$webbot='LOOP Improvements';$boticon='robot_mirago.png';}
	if(ip2long($oname)>=ip2long('213.251.136.0') && ip2long($oname)<=ip2long('213.251.143.255')){$webbot='Misterbot';$boticon='robot_misterbot.png';}
	if(ip2long($oname)>=ip2long('217.155.192.0') && ip2long($oname)<=ip2long('217.155.207.255')){$webbot='Mojeek';$boticon='robot_mojeek.png';}
	if(ip2long($oname)>=ip2long('220.72.0.0') && ip2long($oname)<=ip2long('220.87.255.255')){$webbot='Naver';$boticon='robot_naver.png';}
	if(ip2long($oname)>=ip2long('222.96.0.0') && ip2long($oname)<=ip2long('222.122.255.255')){$webbot='Naver';$boticon='robot_naver.png';}
	if(ip2long($oname)>=ip2long('67.104.0.0') && ip2long($oname)<=ip2long('67.111.255.255')){$webbot='Zoominfo';$boticon='robot_zoominfo.png';}
	if(ip2long($oname)>=ip2long('72.5.115.0') && ip2long($oname)<=ip2long('72.5.115.127')){$webbot='NimbleCrawler';$boticon='robot_nimblecrawler.png';}
	if(ip2long($oname)>=ip2long('194.224.199.0') && ip2long($oname)<=ip2long('194.224.199.25')){$webbot='noXtrum';$boticon='robot_noxtrum.png';}
	if(ip2long($oname)>=ip2long('84.9.136.0') && ip2long($oname)<=ip2long('84.9.139.255')){$webbot='Nusearch';$boticon='robot_nusearch.png';}
	if(ip2long($oname)>=ip2long('64.127.124.0') && ip2long($oname)<=ip2long('64.127.124.255')){$webbot='Omni-Explorer';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('213.180.128.0') && ip2long($oname)<=ip2long('213.180.131.255')){$webbot='OnetSzukaj';$boticon='robot_onetszukaj.png';}
	if(ip2long($oname)>=ip2long('217.208.0.0') && ip2long($oname)<=ip2long('217.215.255.255')){$webbot='Picsearch';$boticon='robot_picsearch.png';}
	if(ip2long($oname)>=ip2long('81.19.64.0') && ip2long($oname)<=ip2long('81.19.66.255')){$webbot='StackRambler';$boticon='robot_stackrambler.png';}
	if(ip2long($oname)>=ip2long('66.151.181.0') && ip2long($oname)<=ip2long('66.151.181.255')){$webbot='Scirus';$boticon='robot_scirus.png';}
	if(ip2long($oname)>=ip2long('195.27.215.64') && ip2long($oname)<=ip2long('195.27.215.95')){$webbot='Seekport';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('70.42.51.0') && ip2long($oname)<=ip2long('70.42.51.127')){$webbot='Sensis';$boticon='robot_sensis.png';}
	if(ip2long($oname)>=ip2long('38.0.0.0') && ip2long($oname)<=ip2long('38.255.255.255')){$webbot='Snap';$boticon='robot_snap.png';}
	if(ip2long($oname)>=ip2long('66.234.128.0') && ip2long($oname)<=ip2long('66.234.159.255')){$webbot='Snap';$boticon='robot_snap.png';}
	if(ip2long($oname)>=ip2long('81.208.26.0') && ip2long($oname)<=ip2long('81.208.26.63')){$webbot='Sygo';$boticon='robot_sygo.png';}
	if(ip2long($oname)>=ip2long('217.113.244.112') && ip2long($oname)<=ip2long('217.113.244.127')){$webbot='Ulysseek';$boticon='robot_ulysseek.png';}
	if(ip2long($oname)>=ip2long('193.252.148.0') && ip2long($oname)<=ip2long('193.252.148.255')){$webbot='Voila';$boticon='robot_voila.png';}
	if(ip2long($oname)>=ip2long('202.51.8.0') && ip2long($oname)<=ip2long('202.51.15.255')){$webbot='Wadaino';$boticon='robot_wadaino.png';}
	if(ip2long($oname)>=ip2long('64.13.128.0') && ip2long($oname)<=ip2long('64.13.191.255')){$webbot='Wink';$boticon='robot_wink.png';}
	if(ip2long($oname)>=ip2long('66.231.188.186') && ip2long($oname)<=ip2long('66.231.188.186')){$webbot='Gigablast';$boticon='robot_gigablast.png';}
	if(ip2long($oname)>=ip2long('62.113.137.5') && ip2long($oname)<=ip2long('62.113.137.5')){$webbot='Fast Search';$boticon='robot_fastsearch.png';}
	if(ip2long($oname)>=ip2long('65.214.44.29') && ip2long($oname)<=ip2long('65.214.44.29')){$webbot='Bloglines';$boticon='robot_bloglines.png';}
	if(ip2long($oname)>=ip2long('195.113.214.201') && ip2long($oname)<=ip2long('195.113.214.201')){$webbot='CESNET';$boticon='robot_robot.png';}
	if(ip2long($oname)>=ip2long('88.131.106.0') && ip2long($oname)<=ip2long('88.131.106.26')){$webbot='Entireweb';$boticon='robot_entireweb.png';}



	// ***********

}
                    $text .= '<tr><td><div style="text-align:left;">
					<table style="width:'.$onlineinfomenuwidth.';">';

					if($webbot==''){

                    if (ADMIN)
                    {

if($pref['onlineinfo_ipchecker']==1){
                    $host = $e107->get_host_name($oname);
                    $data = '<b>'.ONLINEINFO_LOGIN_MENU_L75.'</b>'.$oname.' [ '.ONLINEINFO_LOGIN_MENU_L76.$host.' ]';

                        $text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><a href="javascript:void(0)" onMouseover="onlineinfoddrivetip(\''.$data.'\',\'\',\'500\')"  onMouseout="hideonlineinfoddrivetip()"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guest.png" alt="" style="vertical-align:middle;" border="0" /></a></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px"><a href="'.e_ADMIN.'userinfo.php?'.$oname.'">'.$oname.'</a>'.ONLINE_EL15.'<a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';
                   		}else{

						$text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guest.png" alt="" style="vertical-align:middle;" border="0" /></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px"><a href="'.e_ADMIN.'userinfo.php?'.$oname.'">'.$oname.'</a>'.ONLINE_EL15.'<a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';

						}
				    }
                    else
                    {
                    $tmp = explode('.', $oname);
                    $oname = $tmp[0].'.'.$tmp[1].'.xx.xx';
                        $text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guest.png" alt="" style="vertical-align:middle;" /></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px">'.$oname.ONLINE_EL15.'<a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';
                    }
                 }
                 else
                 {


					if (ADMIN)
                    {
                     if($pref['onlineinfo_ipchecker']==1){

                    	$host = $e107->get_host_name($oname);
					    $data = '<b>'.ONLINEINFO_LOGIN_MENU_L75.'</b>'.$oname.' [ '.ONLINEINFO_LOGIN_MENU_L76.$host.' ]';


						$text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><a href="javascript:void(0)" onMouseover="onlineinfoddrivetip(\''.$data.'\',\'\',\'500\')"  onMouseout="hideonlineinfoddrivetip()"><img src="'.e_PLUGIN.'onlineinfo_menu/images/robots/'.$boticon.'" alt="" style="vertical-align:middle;" border="0" /></a></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px">'.$webbot.' - <a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';
}else{

	$text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/robots/'.$boticon.'" alt="" style="vertical-align:middle;" border="0" /></a></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px">'.$webbot.' - <a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';

}
					}else{

                 		$text .= '<tr><td style="vertical-align:top; text-align:left;" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/robots/'.$boticon.'" alt="" style="vertical-align:middle;" /></td>
								<td valign="top" align="left" style="vertical-align:top; text-align:left; font-size:9px">'.$webbot.' - <a href="'.$online_location.'">'.$online_location_page.'</a></td></tr>';
					}


                 }

                    $text .= '</table></div></td></tr>';
                }

		$text .= '</table></div>';

        }



		if ($pref['onlineinfo_ibfuse'] == 1)
		{


if ($pref['onlineinfo_ibfautohide'] == 1)
{

        $text .= '<div id="ibfuse-title" style="cursor:hand; margin-left:15px; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold; font-size: '.$fsize.'px;" title="'.ONLINEINFO_LIST_31.'">&nbsp;'.ONLINEINFO_LIST_31.'('.$onlineinfo_getipbinfo.')</div>';
		$text .= '<div id="ibfuse" class="switchgroup1" style="display:none">';
        $text .= '<table style="text-align:left; width:'.$onlineinfomenuwidth.';">';

}else{

         $text .= '<div class="smallblacktext" style="font-size: '.$fsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.ONLINEINFO_LIST_31.': ('.$onlineinfo_getipbinfo.')</div><div style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:20px;"><table style="text-align:left; width:'.$onlineinfomenuwidth.'">';


}

				    if ($onlineinfo_getipbinfo)
				    {

					while ($row = $onlineinfo_ipb_sql->db_Fetch())
					{

					if($row['location_1_type']!='topic')
					{

						if($row['location_2_type']=='forum')
						{
							$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."forums WHERE id='".$row['location_2_id']."'";
							$onlineinfo_ipb_sql2 = new db;
							$onlineinfo_getipbforum = $onlineinfo_ipb_sql2->db_Select_gen($script);
							while ($row2 = $onlineinfo_ipb_sql2->db_Fetch())
							{
							$forumname='Forum - '.$row['location_2_id'];
							$forumpath='/index.php?showforum='.$row['location_2_id'];
							$forumalt='Forum: '.$row2['name'];

							}
						}
						else
						{
						$forumname='Front Page';
						$forumpath='';
						$forumalt='Front Page';

						}

					}

					if($row['location_1_type']=='topic')
					{
							$script="SELECT * FROM ".$pref['onlineinfo_ibfprefix']."topics WHERE tid='".$row['location_1_id']."'";
							$onlineinfo_ipb_sql2 = new db;
							$onlineinfo_getipbforum = $onlineinfo_ipb_sql2->db_Select_gen($script);
							while ($row2 = $onlineinfo_ipb_sql2->db_Fetch())
							{
							$forumname='Topic - '.$row['location_1_id'];
							$forumpath='/index.php?showtopic='.$row['location_1_id'];
							$forumalt='Topic: '.$row2['title'];

							}

					}


					$overlink= 'onMouseover="onlineinfoddrivetip(\''.$forumalt.'\',\'\',\'380\')"  onMouseout="hideonlineinfoddrivetip()"';


						if ($row['member_name']!='')
						{
							$text .= '<tr><td style="vertical-align:top; text-align:left; font-size:9px" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/user.png" alt="" style="vertical-align:middle;" /></td><td valign="top" align="left" style="vertical-align:top; text-align:left;"><a href="'.SITEURL.$pref['onlineinfo_ibflocation'].'/index.php?showuser='.$row['member_id'].'">'.$row['member_name'].'</a>'.ONLINE_EL15.'<a href="'.SITEURL.$pref['onlineinfo_ibflocation'].$forumpath.'" '.$overlink.'>'.$forumname.'</a></td></tr>';
						}
						else
						{

							if (ADMIN)
                   			{
                   				$text .= '<tr><td style="vertical-align:top; text-align:left; font-size:9px" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guest.png" alt="" style="vertical-align:middle;" /></td><td valign="top" align="left" style="vertical-align:top; text-align:left;">'.$row['ip_address'].ONLINE_EL15.'<a href="'.SITEURL.$pref['onlineinfo_ibflocation'].$forumpath.'" '.$overlink.'>'.$forumname.'</a></td></tr>';

                    		}
                    		else
                    		{

							$tmp = explode('.', $row['ip_address']);
                    		$ipaddress = $tmp[0].'.'.$tmp[1].'.xx.xx';
							$text .= '<tr><td style="vertical-align:top; text-align:left; font-size:9px" align="left"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guest.png" alt="" style="vertical-align:middle;" /></td><td valign="top" align="left" style="vertical-align:top; text-align:left;">'.$ipaddress.ONLINE_EL15.'<a href="'.SITEURL.$pref['onlineinfo_ibflocation'].$forumpath.'" '.$overlink.'>'.$forumname.'</a></td></tr>';
							}

						}
					}


			}
			$text.='</table>';
			$text .= '</div>';
		}


    } else {
		$text .= TRACKING_MESSAGE;
}


}else{

	// new plain online info
		if ($orderhide == 1){


	    $text .= '<div id="current-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.ONLINEINFO_LOGIN_MENU_L30.' ('.ONLINE_EL2.MEMBERS_ONLINE.', '.ONLINE_EL1.GUESTS_ONLINE;
		$totalonline=MEMBERS_ONLINE + GUESTS_ONLINE;

	    $text.=')">&nbsp;'.ONLINEINFO_LOGIN_MENU_L30.' ('.$totalonline.')</div>';
		$text .= '<div id="current" class="switchgroup1" style="display:none; margin-left:2px;">';

	}else{

	 $text .= '<br /><div class="smallblacktext" style="font-size: '.$onlineinfomenufsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.ONLINEINFO_LOGIN_MENU_L30.'</div><div>';

	}

	$membersfound='';


$c = 0;
			//get members



			 $script="SELECT ".MPREFIX."user.user_id,".MPREFIX."user.user_name FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id=CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id!='0' GROUP BY ".MPREFIX."user.user_id ORDER BY ".MPREFIX."user.user_name ASC";

			$sql->db_Select_gen($script);
			while ($row = $sql->db_Fetch())
            {
                extract($row);

					$user_id=$row['user_id'];
					$user_name=$row['user_name'];


$user[$c]='<a href="'.e_BASE.'user.php?id.'.$user_id.'" '.getuserclassinfo($user_id).'>'.$user_name.'</a>';

			$c++;
				}



for ($a = 0; $a <= ($c-1); $a++)
	{
	 	$membersfound.=$user[$a];
		$membersfound.= ($a < $c-1 ) ? ', ' : '';
	}



	$countonline = MEMBERS_ONLINE + GUESTS_ONLINE;


$text.='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'onlineinfo_menu/images/members.png" height="18px" /><b>'.ONLINENOW_3.'</b> ('.MEMBERS_ONLINE.')</div>';
$text.='<div style="text-align:left;">'.$membersfound.'</div><br />';

$text.='<div style="text-align:left;" class="mediumtext"><img src="'.e_PLUGIN.'onlineinfo_menu/images/guests.png" height="18px" /><b>'.ONLINENOW_4.'</b> ('.GUESTS_ONLINE.')</div><br />';



}


$text.='</div>';
}

?>