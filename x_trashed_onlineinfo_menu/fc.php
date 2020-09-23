<?php
if (!defined('e107_INIT')) { exit; }
if($pref['onlineinfo_flashchatuse']){
	if(check_class($orderclass))
	{

		$onlineinfo_flashchat_sql = new db;
		
		
		// fix if pop up not loged them out
		$timenow=time();
		//flashchatconnections 
		//updated
		$script="SELECT * FROM ".$pref['onlineinfo_flashchatprefix']."flashchatconnections";
		$onlineinfo_checkoldrecords = $onlineinfo_flashchat_sql->db_Select_gen($script);
		
		if($onlineinfo_checkoldrecords!=0){
		//echo strtotime("2007-05-10 12:20:44 GMT");	
			
		while ($row = $onlineinfo_flashchat_sql->db_Fetch())
		{
		 	$lastupdated = strtotime($row['updated']);
		 	$cache = 300; 
			$idnum = $row['id'];		 	
		 	
		 	if(($timenow - $lastupdated) > $cache){			
						
			$script="DELETE FROM ".$pref['onlineinfo_flashchatprefix']."flashchatconnections WHERE id='".$idnum."'";	
			$result = mysql_query($script);			
			
			}		 
		}
		
	}
		

	if ($orderhide == 1)
		{

		$script='SELECT * FROM '.$pref['onlineinfo_flashchatprefix'].'flashchatconnections,'.$pref['onlineinfo_flashchatprefix'].'flashchatrooms WHERE userid IS NOT NULL AND ispublic IS NOT NULL AND '.$pref['onlineinfo_flashchatprefix'].'flashchatconnections.roomid = '.$pref['onlineinfo_flashchatprefix'].'flashchatrooms.id';
		$onlineinfo_flashinuse = $onlineinfo_flashchat_sql->db_Select_gen($script);


        $text .= '<div id="flashchat-title" style="cursor:hand; text-align:left; font-size: '.$onlineinfomenufsize.'px; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.OI_FLASHCHAT_1.'">&nbsp;'.OI_FLASHCHAT_1.'&nbsp;('.$onlineinfo_flashinuse.')</div>		
		<div id="flashchat" class="switchgroup1" style="display:none">
		<table style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:20px;"><tr><td>';

		}
		else
		{

		$text .= '<div class="smallblacktext" style="font-size: '.$onlineinfomenufsize.'px; font-weight:bold; margin-left:5px; margin-top:10px; width:'.$onlineinfomenuwidth.'">'.OI_FLASHCHAT_1.'</div><div style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:10px;"><table style="text-align:left; width:'.$onlineinfomenuwidth.'"><tr><td>';

		}

		// 0 users in 4 rooms

		// Gets rooms (id, name)
		$script="SELECT * FROM ".$pref['onlineinfo_flashchatprefix']."flashchatrooms WHERE ispublic IS NOT NULL order by ispermanent";
		$onlineinfo_flashrooms = $onlineinfo_flashchat_sql->db_Select_gen($script);
		while ($row = $onlineinfo_flashchat_sql->db_Fetch())
		{
			$onlineinfo_flashchat_sql2 = new db;

			$script="SELECT * FROM ".$pref['onlineinfo_flashchatprefix']."flashchatconnections WHERE userid IS NOT NULL AND roomid=".$row['id'];
			$onlineinfo_flashcountinroom = $onlineinfo_flashchat_sql2->db_Select_gen($script);

			if ($onlineinfo_flashcountinroom !=0)
			{


        $text .= '<div id="flashroom'.$row['name'].'-title" style="cursor:hand; text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.$row['name'].'">&nbsp;'.$row['name'].'&nbsp;('.$onlineinfo_flashcountinroom.')</div>
		<div id="flashroom'.$row['name'].'" class="switchgroup1" style="display:none">
		<table style="text-align:left; width:'.$onlineinfomenuwidth.'; margin-left:10px;"><tr><td class="smallblacktext" style="font-size: 10px;">';


				$onlineinfo_flashchat_sql3 = new db;
				$script="SELECT ".$pref['onlineinfo_flashchatprefix']."flashchatconnections.*,".MPREFIX."user.* FROM ".$pref['onlineinfo_flashchatprefix']."flashchatconnections JOIN ".MPREFIX."user ON ".$pref['onlineinfo_flashchatprefix']."flashchatconnections.userid = ".MPREFIX."user.user_id WHERE roomid =".$row['id'];
				$onlineinfo_flashuserinroom = $onlineinfo_flashchat_sql3->db_Select_gen($script);

				while ($row2 = $onlineinfo_flashchat_sql3->db_Fetch())
				{
					$text.='<a href="'.e_BASE.'user.php?id.'.$row2['user_id'].'">'.$row2['user_name'].'</a><br />';
				}

			$text .= '</td></tr></table></div>';
			}
			else
			{
				$text.='<div style="text-align:left; vertical-align: middle; width:'.$onlineinfomenuwidth.'; font-weight:bold;" title="'.$row['name'].'">'.$row['name'].'&nbsp;('.$onlineinfo_flashcountinroom.')</div>';
			}

		}

$enterroom = $onlineinfomenufsize-1;


	if ($pref['onlineinfo_flashchatwindow']=='e107')
	{
	$text.='<div class="smallblacktext" style="font-size: '.$enterroom.'px; font-weight:bold; text-align:center; width:'.$onlineinfomenuwidth.'">[<a href="'.e_PLUGIN.'onlineinfo_menu/flashchat.php">'.OI_FLASHCHAT_2.'</a>]</div>';
	}
	else
	{
	$text.='<div class="smallblacktext" style="font-size: '.$enterroom.'px; font-weight:bold; text-align:center; width:'.$onlineinfomenuwidth.'">[<a href="'.SITEURL.$pref['onlineinfo_flashchatlocation'].'/flashchat.php" target="_blank">'.OI_FLASHCHAT_2.'</a>]</div>';
	}

		$text .= '</td></tr></table><br /></div>';
		
	}
}
?>