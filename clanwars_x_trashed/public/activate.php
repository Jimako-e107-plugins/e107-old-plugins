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

if (!defined('WARS_PUB') or stristr($_SERVER['SCRIPT_NAME'], "activate.php")) {
    die ("You can't access this file directly...");
}

if(!USER){
	$text = "<center><br />"._WLOGINFIRST."<br /><br /></center>";
}else{
	if(intval($_GET['userid']) != USERID){
		$text = '<center><br />'._WWRONGACCOUNT.'<br /><br /></center>';
		$ns->tablerender(_CLANWARS, $text);
		require_once(FOOTERF);
		exit;
	}
	
	$result = $sql->db_Select("clan_wars_mail", "*", "member='".USERID."' AND active='0' AND code!=''");
	if($sql->db_Rows() > 0){
		$row = $sql->db_Fetch();  
		if($row['code'] == mysql_real_escape_string($_GET['code'])){
			$result = $sql->db_Update("clan_wars_mail", "active='1', code='' WHERE mid='".$row['mid']."'");
			$text = "<center><br />"._WACCACTIVE."<br /><br /></center>";
		}else{
			$text = "<center><br />"._WINCACTCODE."<br /><br /></center>";
		}
	}else{
		$text = "<center><br />"._WNOMAILINLIST."<br /><br /></center>";
	}
}
	$ns->tablerender(_CLANWARS, $text);
?>