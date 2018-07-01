<?php
if (!defined('e107_INIT')) { exit; }
if(check_class($extraclass)){



	if($extrahide==1){


        $text .= "<div id='lastv-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINEINFO_LOGIN_MENU_L31."'>&nbsp;".ONLINEINFO_LOGIN_MENU_L31."</div>";
	    $text .= "<div id='lastv' class='switchgroup1' style='display:none'>";
        $text .= "<table style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'>";


	}else{

	$text .= "<div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINEINFO_LOGIN_MENU_L31."</div><div style='text-align:left; width:".$onlineinfomenuwidth."; margin-left:5px;'><table style='text-align:left; width:".$onlineinfomenuwidth."'>";

	}

	$gen = new convert;

	if(!$sql -> db_Select("user", "user_id, user_name, user_currentvisit", "ORDER BY user_currentvisit DESC LIMIT 0,".$extrarecords."", "no_where")){
		$text .= "<div class='smalltext' style='text-align:left; width:".$onlineinfomenuwidth.";'>".ONLINEINFO_LOGIN_MENU_L47."</div>";
	}else{
		while(list($user_id, $user_name, $user_currentvisit) = $sql-> db_Fetch()){
			$user = $user_name;
			$userid = $user_id;
			//$datestamp = date("d/m H:m", $user_currentvisit);
			$datestamp = $gen->convert_date($user_currentvisit, "short");
		
	
		
            $text .= "<tr><td style='vertical-align:top; text-align:left; width:50%;' nowrap><a href='".e_BASE."user.php?id.".$user_id."'><span ".getuserclassinfo($user_id).">".$user."</span></a></td>
			<td style='vertical-align:top; text-align:right; width:50%; padding-right:20px;' nowrap>".$datestamp."</td></tr>";

		}
	}


		$text .= "</table><br /></div>";

}

?>