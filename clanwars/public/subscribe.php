<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "subscribe.php")) {
    die ("You can't access this file directly...");
}

$react = intval($_GET['react']);
$email = mysql_real_escape_string($_GET['email']);

if($react == 1){
	//Reactivate
	$result = $sql->db_Update("clan_wars_mail", "active='1' WHERE member='".USERID."'");
	if($result){
		print '1';
	}	
}else{
	if($sql->db_Count("clan_wars_mail", "(*)", "WHERE member='".USERID."'") > 0){
		die('userinlist');
	}if($sql->db_Count("clan_wars_mail", "(*)", "WHERE email='$email'") > 0){
		die('emailinlist');
	}
	//subscribe
	if($conf['emailact']){
		$letters = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
		$code = "";
		for($i=0;$i<25;$i++){
			if(rand(0,1) == 1){
				if(rand(0,1) == 1){
					$code .= strtoupper($letters[rand(0,25)]);			
				}else{
					$code .= $letters[rand(0,25)];
				}
			}else{
				$code .= rand(0,9);
			}
		}
		$result = $sql->db_Insert("clan_wars_mail", array("member" => USERID, "email" => $email, "active" => 0, "code" => $code, "subscrtime" => time()));	
		if(intval($result) > 0){
			//EMAIL
			$pageURL = 'http';
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://".dirname($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
			$message = _WACTMAILTEXT.": ".$pageURL."/clanwars.php?Activate&userid=".USERID."&code=$code";		
				
			$fromaddress = "wars@".str_replace(array("http://", "https://", "www"), array("","",""), SITEURLBASE);
			$headers = "From: ".SITENAME." <".$fromaddress.">"
			. "\r\n" 
			. 'X-Mailer: PHP/' . phpversion();
				
			if(!mail($email, _WACTMAILTITLE, $message, $headers)){
				echo "mailfail";
			}
			print '1';
		}
	}else{
		$result = $sql->db_Insert("clan_wars_mail", array("member" => USERID, "email" => $email, "active" => 1, "subscrtime" => time()));	
		if(intval($result) > 0){
			print '1';
		}
	}
}


?>