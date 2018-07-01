<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        Last Seen Menu v1.0 for e107 v0.7+ by TheMadMonk
|              TheMadMonk@GamingMad.com
|
|      Released under the terms and conditions of the
|      GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

if(check_class($orderclass)){
	
	
$membersfound="";
$c = 0;

$script="SELECT user_id, user_name, user_currentvisit FROM ".MPREFIX."user WHERE DATEDIFF(FROM_UNIXTIME(user_currentvisit),CURRENT_TIMESTAMP()) = 0 ORDER BY user_currentvisit DESC";

$sql -> db_Select_gen($script);

$userArray = $sql -> db_getList();
$gen = new convert;	

foreach($userArray as $user)
{
	//USER_LASTVISIT_LAPSE
	
	$seen_ago = $gen -> computeLapse($user['user_currentvisit'], false, false, true, 'short');
	

	$user_id=$user['user_id'];
	$user_name=$user['user_name'];		
	
	
$u[$c]="<a href='".e_BASE."user.php?id.".$user_id."' ".getuserclassinfo($user_id)." title='".ONLINELASTSEEN_1.": ".$seen_ago."'>".$user_name."</a>";	
		
		
	$c++;			

}

$memberstoday= $c;

for ($a = 0; $a <= ($c-1); $a++)
	{
	 	$membersfound.=$u[$a];
		$membersfound.= ($a < $c-1 ) ? ", " : "";
	}



if ($orderhide == 1){


    $text .= "<div id='tmember-title' style='cursor:hand; text-align:left; font-size: ".$onlineinfomenufsize."px; vertical-align: middle; width:".$onlineinfomenuwidth."; font-weight:bold;' title='".ONLINELASTSEEN_11." (".$memberstoday.")";



    $text.=")'>&nbsp;".ONLINELASTSEEN_11.": ".$memberstoday."</div>";
	$text .= "<div id='tmember' class='switchgroup1' style='display:none; margin-left:2px;'>";

}else{

 $text .= "<br /><div class='smallblacktext' style='font-size: ".$onlineinfomenufsize."px; font-weight:bold; margin-left:5px; margin-top:10px; width:".$onlineinfomenuwidth."'>".ONLINELASTSEEN_11.": ".$memberstoday."</div><div>";

}


$text.="<div style='text-align:left;'>".ONLINELASTSEEN_3.$membersfound."</div><br />";

$text.="</div>";

}

?>