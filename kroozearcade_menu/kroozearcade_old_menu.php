<?
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

// Create a pull down list of the games in the menu
$text = "<center>".KROOZEARCADE_82."</center><br>";
$sql->db_Select("arcade_games", "game_id, game_title");
$rows = $sql->db_Rows();
$result = mysql_query("select game_title from e107_arcade_games");
$gamecount = mysql_num_rows($result);

$options = "";
	for ($i=0; $i < $rows; $i++) {
			$option = $sql->db_Fetch();
			$options .= "<option value='".$option['game_id']."'>".substr($option['game_title'],0,20)."</option>";

		}
$text .= "Games offered: $gamecount ";
		$text .= "<center><form action='".e_PLUGIN."kroozearcade_menu/play.php' method='POST'>";
		$text .= "<select name='gameid' onChange=\"go()\">".$options."</select><br><input type=submit class=button name=submit value='".KROOZEARCADE_83."'>";
		$text .= "</form></center><br>";
		#start of show random game -dambs 2/28/07
$sql->db_Select("arcade_games", "game_id,game_title,game_filename,game_category", "order by rand() limit 1", "no_where");
 	    	$row = $sql->db_Fetch();
   		$text .= "<center><a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=" . $row["game_category"] . "&gameid=" . $row["game_id"] . "'><img src='".e_PLUGIN."kroozearcade_menu/games/" . $row["game_filename"] . ".gif' /></a><br>
   		<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=" . $row["game_category"] . "&gameid=" . $row["game_id"] . "'>Play Random Game: " . $row["game_title"] . "</a><br><br></center>
		 ";
		####end of random game

		
// Show the last 5 high scores
$sql->mySQLresult = @mysql_query("SELECT s.game_id, g.game_title, u.user_name, s.score, s.date_scored FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE u.user_id = s.user_id and g.game_id = s.game_id and g.game_enable = '1' ORDER BY s.date_scored DESC LIMIT 0,5;");
$rows = $sql->db_Rows();

if ($rows == 0) {
			$text .= "<b>".KROOZEARCADE_84."</b>";
		} else {
			$text .= "<b>".KROOZEARCADE_85."</b><br>";
			$text .= "<table width=20>";  // Northwst added widths 7-19-06
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
$title = KROOZEARCADE_38;
$ns -> tablerender($title, $text);
?>
