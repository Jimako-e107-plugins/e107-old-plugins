<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7.4
|        Compatible with all games from www.ibproarcade.com
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stephen Sherlock
|        http://www.krooze.net/
|        aterlatus@krooze.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// corrected language to force English.php
require_once(e_PLUGIN."kroozearcade_menu/language/English.php");

#top users
$sql->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 0,5;");
$rows = $sql->db_Rows();
$text = "";
if ($rows == 0) {
                        $text .= "<b>".KROOZEARCADE_84."</b>";
                } else {
                        $text .= "<table width=125 ><td><b>".KROOZEARCADE_117."</b></td>";
#                        $text .= "<table width=125>";
			$text .= "<tr><th width=5>User</th><th width=5>Wins</th>";	
                        for ($i=0; $i < $rows; $i++) {
                          $result = $sql->db_fetch();
			  $user = @mysql_query("select user_name from ".MPREFIX."user where user_id='".$result['user_id']."'");
			  $user = mysql_fetch_array($user);
			  $text .= "<tr><td>".$user['user_name']."";
			  $text .= "<td>".$result['trophies']."</td>";
			}
	
			$text .= "</table><br><br>";
}

$title = KROOZEARCADE_118;
#$ns -> tablerender($title, $text);

// Show the last 5 high scores
#$text = "";
$sql->mySQLresult = @mysql_query("SELECT s.game_id, g.game_title, u.user_name, s.score, s.date_scored FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE u.user_id = s.user_id and g.game_id = s.game_id and g.game_enable = '1' ORDER BY s.date_scored DESC LIMIT 0,5;");
$rows = $sql->db_Rows();

if ($rows == 0) {
#                        $text .= "<b>".KROOZEARCADE_84."</b>";
                } else {
                        $text .= "<table width=125><th><b>".KROOZEARCADE_85."</b></th></table>";
                        $text .= "<table width=25>";  // Northwst added widths 7-19-06
                        $text .= "<tr><th width=5>".KROOZEARCADE_57."</th><th width=5>".KROOZEARCADE_86."</th><th>".KROOZEARCADE_87."</th>";
                                for ($i=0; $i < $rows; $i++) {
                                        $result = $sql->db_fetch();
                                        $datescored = date("m/d_H:i",$result['date_scored']);
                                        $text .= "<tr>";
                                        $text .= "<td><a href='".e_PLUGIN."kroozearcade_menu/play.php?gameid=".$result['game_id']."'>".$result['game_title']."</a></td>";
                                        $text .= "<td>".$result['user_name']."</td>";
                                        $text .= "<td><b><P ALIGN='right'>".$result['score']."</P></b></td>";
                                        $text .= "<tr><tr>";
                                        $text .= "<tr><th><b>Date:</b><td>".$datescored."</td><th></tr>";
                                        $text .= "</tr>";
                        }
                        $text .= "</table><br>";
                }

#$title = KROOZEARCADE_38;
$ns -> tablerender($title, $text);


?>
