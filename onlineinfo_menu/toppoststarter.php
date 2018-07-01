<?php
if (!defined('e107_INIT')) { exit; }
if(check_class($extraclass)){

    // Fourm
    if ($extrahide == 1)
    {

        $text .= "<div id='topstarter-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L55."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L55."</div>";
		$text .= "<div id='topstarter' class='switchgroup1' style='display:none'>";
        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

    }
    else
    {

        $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_LOGIN_MENU_L55."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

    }

			$query="SELECT FLOOR(thread_user) as t_user, COUNT(FLOOR(ft.thread_user)) AS ucount, u.user_name, u.user_id FROM #forum_t as ft
		LEFT JOIN #user AS u ON FLOOR(ft.thread_user) = u.user_id
		WHERE ft.thread_parent=0
		GROUP BY t_user
		ORDER BY ucount DESC
		LIMIT 0,".$extrarecords."";

if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='toppoststarter'";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
							
			$sql -> db_Select_gen($query);
			
    	
     		 $setarray=0;
        		while ($row = $sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $t_user."|".$user_name."=>".$ucount;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			
			
			$sql -> db_Update("onlineinfo_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='toppoststarter'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='toppoststarter'";
			$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);
        	
        	$blowdata = explode(",", $cache);        	
        	$countdata= count($blowdata);
        	
        	for ($z = 0; $z <= ($countdata-1); $z++)
        	{				
        		$blowmoredata = explode("=>",$blowdata[$z]);        
				$blowdataagain = explode("|",$blowmoredata[0]);
						
        		$toppoststarter = $blowmoredata[1];	
        		$t_user = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
			if($t_user=="0"){
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'>".ONLINEINFO_LOGIN_MENU_L56."</td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppoststarter."</td></tr>";
		}else{
		
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$t_user."' ".getuserclassinfo($t_user).">".$user_name."</a></td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$toppoststarter."</td></tr>";
		}
					
			}          	
        }
			
			
	}else{

	
		$sql -> db_Select_gen($query);
		$posters = $sql -> db_getList();
		foreach($posters as $poster)
		
		{
		
		if($poster['t_user']=="0"){
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'>".ONLINEINFO_LOGIN_MENU_L56."</td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td></tr>";
		}else{
		
		    $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$poster['user_id']."' ".getuserclassinfo($poster['user_id']).">".$poster['user_name']."</a></td>
					<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$poster['ucount']."</td></tr>";
		}
		}


 }
 
  $text .= "</table></div>";

}
?>