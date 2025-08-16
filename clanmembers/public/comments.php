<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

if (!defined('CM_PUB')) {
    die ("You can't access this file directly...");
}

$memberid = intval($_GET['memberid']);
//Comments

if(ADMIN && check_class($conf['commentsclass'])){

	$sql->db_Select("clan_members_comments", "*", "userid='$memberid' order by postdate DESC, cid DESC");
		while ($row = $sql->db_Fetch()) {
			$cid = $row['cid'];
			$posterid = $row['posterid'];
			$poster = cm_getuser_name($posterid);
			$comment = $row['comment'];
			$postdate = $row['postdate'];
			
		$text .= "<table width='100%' class='fborder' style='margin-bottom: 2px;'>
					<tr>
						<td width='100%' align='left' valign='top' class='forumheader3'><b>$poster</b><br /><div id='commenttext$cid' style='padding-left:2px;'>".nl2br($comment)."</div></td>
					</tr>
				</table>";
		}
	
	echo $text;
}
?>