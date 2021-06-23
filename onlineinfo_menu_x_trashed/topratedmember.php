<?php

if (!defined('e107_INIT')) { exit; }
if(check_class($extraclass)){

	if ($extrahide == 1)
    {

        $text .= "<div id='toprate-title' style='cursor:hand; font-size: ".$onlineinfomenufsize."px; text-align:left; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".TOPMEMBERPLUGIN_3."'>&nbsp;".TOPMEMBERPLUGIN_3."</div>";
	           $text .= "<div id='toprate' class='switchgroup1' style='display:none'>";
        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";

    }
    else
    {
        $text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".TOPMEMBERPLUGIN_3."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";
    }

$query = "SELECT * FROM #rate as r LEFT JOIN #user AS u ON r.rate_itemid = u.user_id
WHERE rate_table ='user'
ORDER BY rate_rating/rate_votes DESC
LIMIT 0,".$extrarecords."";

if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='topratedmember'";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){	
		 	
			//run cache update
			$buildcache="";
			
			if (!$sql -> db_Select_gen($query))
    		{
    		 $arraydata="0|".ONLINEINFO_COUNTER_L9." ".TOPMEMBERPLUGIN_3;
    		 
     		}else{
     		 $setarray=0;
        		while ($row = $sql->db_Fetch())
       			 {
          			 	extract($row);            
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".round($rate_rating/$rate_votes,2);						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$sql -> db_Update("onlineinfo_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='topratedmember'");
			
		}				
			
			//use cache
			$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='topratedmember'";
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
						
        		$topratedmember = $blowmoredata[1];	
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
				
				if($user_id==0){
				 $text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>".ONLINEINFO_COUNTER_L9." ".TOPMEMBERPLUGIN_3."</div>";
				 }else{
				$text .= "<tr><td style='vertical-align:top; text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".$topratedmember."</td></tr>";	
										
				}
				
			}          	
        }
			
			
	}else{


	if($sql -> db_Select_gen($query)){

		while($row = $sql -> db_Fetch()){
			extract($row);


			$text .= "<tr><td style='vertical-align:top text-align:left; width:80%;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name."</a></td>
			<td style='vertical-align:top; text-align:right; width:20%; padding-right:20px;'>".round($rate_rating/$rate_votes,2)."</td></tr>";

		}
	}


}
        $text .= "</table><br /></div>";


}
?>