<?php
if (!defined('e107_INIT')) { exit; }
if(check_class($extraclass)){

    // Fourm
    if ($extrahide == 1)
    {

            $text .= "<div id='toppost-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L40."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L40."</div>";
	        $text .= "<div id='toppost' class='switchgroup1' style='display:none'>";
        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

 }
    else
    {

         $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_LOGIN_MENU_L40."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

    }
    
    
    
    	if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='toppost'";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
			if (!$sql->db_Select("user", "*", "ORDER BY user_forums DESC LIMIT 0, ".$extrarecords."", "no_where"))
    		{
    		 $arraydata="0|".ONLINEINFO_LOGIN_MENU_L45;
    		 
     		}else{
     		 $setarray=0;
        		while ($row = $sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".$user_forums;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$sql -> db_Update("onlineinfo_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='toppost'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='toppost'";
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
						
        		$user_forums = $blowmoredata[1];	
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
				if($user_id==0){
				 $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". ONLINEINFO_LOGIN_MENU_L45 ."</div>";
				 }else{
				$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$user_forums."</td></tr>";	
										
				}
				
			}          	
        }
			
			
	}else{
 

    if (!$sql->db_Select("user", "*", "ORDER BY user_forums DESC LIMIT 0, ".$extrarecords."", "no_where"))
    {
        $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". ONLINEINFO_LOGIN_MENU_L45 ."</div>";
    }
    else
    {
        while ($row = $sql->db_Fetch())
        {
            extract($row);

            $text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$user_forums."</td></tr>";
        }
    }



}

  $text .= "</table><br /></div>";

}
?>