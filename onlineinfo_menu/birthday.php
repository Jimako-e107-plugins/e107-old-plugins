<?php
if (!defined('e107_INIT')) { exit; }
if(check_class($extraclass)){

$sql2=new db;

	$birthdayavatar=$pref['onlineinfo_bavatar'];

	
    $onlineinfo_birthday_sql = new db;

    $onlineinfo_birthday_now = time();
    $onlineinfo_birthday_today = date("Y-m-d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_month = date("m", $onlineinfo_birthday_now);
    $onlineinfo_birthday_day = date("d", $onlineinfo_birthday_now);
    $onlineinfo_birthday_year = date("Y", $onlineinfo_birthday_now);
    
    $BDAY_now = time();
    
    	if($extraacache==1){
		$cachet = $extracachetime*60;
		$currenttime=time();
		
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='birthday'";		
		$sql->db_Select_gen($script);	
		while ($row = $sql->db_Fetch())
        {
        	extract($row);            
        $lasttimerun= $cache_timestamp;   
        }
        
        	
    	if(($currenttime - $lasttimerun) > $cachet){
		//run cache update
			$buildcache="";
		
			$script="select *,YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age
from #user_extended left join #user on user_extended_id = user_id
where (YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d'))!=-1) AND (user_birthday != '0000-00-00' and user_name!='' AND ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now()))*366)+
DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d')))>=DAYOFYEAR(now())) ORDER BY
((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))),date_format(user_birthday,'%m%d') asc
limit 0,".$extrarecords."";
		
		if (!$sql->db_Select_gen($script)){
			
			 $arraydata="0|".ONLINEINFO_BDAY_L2;
			
		}else{
			$setarray=0;
			while ($row = $sql->db_Fetch())
       			 {
          			 	extract($row);  
          			 	
						$onlineinfo_birthday_age  = date("Y-m-d", $BDAY_now) - $user_birthday;
						             
            			$buildcache[$setarray] = $user_id."|".$user_name."=>".$user_birthday."¬".$onlineinfo_birthday_age;						
						$setarray++;
            	}
        			$arraydata="";					
					for ($y = 0; $y <= ($setarray-1); $y++)
					{
	 					$arraydata.=$buildcache[$y];
						$arraydata.= ($y < $setarray-1 ) ? "," : "";
					}					
						
				
			}
			
			$sql -> db_Update("onlineinfo_cache", "cache='".$arraydata."',cache_timestamp='".time()."' WHERE type='birthday'");
			
		}	
		 //use cache
		 $x=0;
		 $y=0;
		 
		$script="SELECT * FROM ".MPREFIX."onlineinfo_cache Where type='birthday'";
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
				$blowevenmoredata=explode("¬",$blowmoredata[1]);						
        		$onlineinfo_birthday_datepart = explode("-", $blowevenmoredata[0]);		
				$user_birthday = $onlineinfo_birthday_datepart[1]."-".$onlineinfo_birthday_datepart[2];	
				$onlineinfo_birthday_age = $blowevenmoredata[1];
        		$user_id = $blowdataagain[0];
				$user_name = $blowdataagain[1];
					
					
					if($user_birthday == date("m-d",time()))
					{
				 
					 	if($y==0){
						  $hbtext .= "<div style='text-align:center;'><img src='".e_PLUGIN."onlineinfo_menu/images/hb.gif' alt='Happy Birthday' /></div><div style='text-align:center; font-size: 14px; font-weight:bold;'><table width='100%'>";
						  $y++;
						 }
						 
						 // AVATAR ADDITION
						 $script="SELECT user_image FROM ".MPREFIX."user Where user_id='".$user_id."'";
		$sql2->db_Select_gen($script);	
		while ($row2 = $sql2->db_Fetch())
        {
        	extract($row2);
        	$avatar= $row2['user_image'];
        	$avatar = str_replace(" ", "%20", $avatar);
        	if ($row2['user_image'] == "")
                        {
                            $avatar =  e_PLUGIN.'onlineinfo_menu/images/default.png';
						}else{				
						
			require_once(e_HANDLER."avatar_handler.php");
				$avatar = avatar($avatar);
				}	
        }
        
        if($birthdayavatar==1){
			$bavatar="<a href='javascript:void(0)' onMouseover='onlineinfoddrivetip(\"<center><img src=".e_PLUGIN."onlineinfo_menu/images/hb.gif /><img src=".$avatar."><br /><b>".$user_name."<br />".$onlineinfo_birthday_age." ".ONLINEINFO_BDAY_L0."</b></center>\",\"\",\"150\")'  onMouseout='hideonlineinfoddrivetip()'><img src='".$avatar."' width='25' alt='' border='0' /></a>";
		}else{
			$bavatar="";
		}
						 
						 
				 		$hbtext .= "<tr><td>".$bavatar."</td><td style='text-align:left; font-size: 14px; font-weight:bold;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></td></tr>";
					}else{
								
				
				
				if($user_id==0){  //no data				 
							     if ($extrahide == 1)
			    				{
			
			           				 $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
				       				 $nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
			   					 }
			   					 else
			   					 {
			   	    				 $nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
			   					 }
			   					 	 $nbtext .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>". ONLINEINFO_BDAY_L2 ."</div>";						 
				 }else{

						//data
						
						if($x==0){
						if ($extrahide == 1)
   						 {

        				    $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
	        				$nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
    					}else{
        					$nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
   						 }
							$x++;
							}
						
						if ($pref['onlineinfo_formatbdays'] == "1"){
               				 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[2]."/".$onlineinfo_birthday_datepart[1]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
           				 }else{
                			 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[1]."/".$onlineinfo_birthday_datepart[2]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
        }
										
				}
				
			}          	
        }
        
        if($y==0){$text.= $nbtext;}else{$text.= $hbtext."</table></div>".$nbtext;}
        
        
        
        
		 
		 }
		 
		 }else{
		
    		// no cache
    		$script="select *,YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d')) AS age from #user_extended left join #user on user_extended_id = user_id where (YEAR(NOW()) - YEAR(user_birthday) -( DATE_FORMAT(NOW(), '%m-%d') < DATE_FORMAT(user_birthday, '%m-%d'))!=-1) AND (user_birthday != '000-/00-00' and user_name!='' AND ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now()))*366)+ DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d')))>=DAYOFYEAR(now())) ORDER BY ((DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))) < DAYOFYEAR(now())) * 366) + DAYOFYEAR(CONCAT(DATE_FORMAT(NOW(), '%Y-'), DATE_FORMAT(user_birthday,'%m-%d'))),date_format(user_birthday,'%m%d') asc limit 0,".$extrarecords."";

$x=0;
$y=0;
			$sql->db_Select_gen($script);
    		while ($row = $sql->db_Fetch())
       			 {
          			 	extract($row);  
          			 	
									$onlineinfo_birthday_age  = date("Y-m-d", $BDAY_now) - $user_birthday;
									
    					$onlineinfo_birthday_datepart = explode("-", $user_birthday);		
						$user_birth = $onlineinfo_birthday_datepart[1]."-".$onlineinfo_birthday_datepart[2];	
    
    					
					if($user_birth == date("m-d",time()))
					{
				 
					 	if($y==0){
						  $hbtext .= "<div style='text-align:center;'><img src='".e_PLUGIN."onlineinfo_menu/images/hb.gif' alt='Happy Birthday' /></div><div style='text-align:center; font-size: 14px; font-weight:bold;'><table width='100%'>";
						  $y++;
						 }
						 
						  // AVATAR ADDITION
						   $script="SELECT user_image FROM ".MPREFIX."user Where user_id='".$user_id."'";
		$sql2->db_Select_gen($script);	
		while ($row2 = $sql2->db_Fetch())
        {
        	extract($row2);
        	$avatar= $row2['user_image'];
        	$avatar = str_replace(" ", "%20", $avatar);
        	if ($row2['user_image'] == "")
                        {
                            $avatar =  e_PLUGIN.'onlineinfo_menu/images/default.png';
						}else{				
						
			require_once(e_HANDLER."avatar_handler.php");
				$avatar = avatar($avatar);
				}	
        }
						 
        if($birthdayavatar==1){
			$bavatar="<a href='javascript:void(0)' onMouseover='onlineinfoddrivetip(\"<center><img src=".e_PLUGIN."onlineinfo_menu/images/hb.gif /><img src=".$avatar."><br /><b>".$user_name."<br />".$onlineinfo_birthday_age." ".ONLINEINFO_BDAY_L0."</b></center>\",\"\",\"150\")'  onMouseout='hideonlineinfoddrivetip()'><img src='".$avatar."' width='25' alt='' border='0' /></a>";
		}else{
			$bavatar="";
		}
						 
						 
				 		$hbtext .= "<tr><td>".$bavatar."</td><td style='text-align:left; font-size: 14px; font-weight:bold;'><a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></td></tr>";
					}else{
    
    	
						if($x==0){
						if ($extrahide == 1)
   						 {

        				    $nbtext .= "<div id='bdays-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth.";' title='".ONLINEINFO_BDAY_L3."'><b>&nbsp;".ONLINEINFO_BDAY_L3."</b></div>";
	        				$nbtext .= "<div id='bdays' class='switchgroup1' style='display:none'>";
    					}else{
        					$nbtext .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_BDAY_L3."</div>";
   						 }
							$x++;
							}
						
						if ($pref['onlineinfo_formatbdays'] == "1"){
               				 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[2]."/".$onlineinfo_birthday_datepart[1]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
           				 }else{
                			 $nbtext .= "<div style='margin-left:5px; text-align:left; width:".$onlineinfomenuwidth.";'>".$onlineinfo_birthday_datepart[1]."/".$onlineinfo_birthday_datepart[2]." <a title='".$onlineinfo_birthday_datepart[2].".".$onlineinfo_birthday_datepart[1].".".$onlineinfo_birthday_datepart[0]."' href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id).">".$user_name." (".$onlineinfo_birthday_age.")</a></div>";
        }
    
    
    				}   
    
    			}
    			
    			if($y==0){$text.= $nbtext;}else{$text.= $hbtext."</table></div>".$nbtext;}
    
  
}

  if ($extrahide == 1)
    {
        $text .= "<br /></div>";
    }

}
?>