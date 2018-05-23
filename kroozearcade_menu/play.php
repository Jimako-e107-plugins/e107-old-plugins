<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7
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
require_once("../../class2.php");
require_once(HEADERF);
require_once("language/".e_LANGUAGE.".php");

// Print navigation menu
$text = "";
$text .= "<a href='".e_PLUGIN."kroozearcade_menu/kroozearcade.php'>".KROOZEARCADE_1."</a>";
if (isset($_GET['catid'])) {
	$sql->mySQLresult = @mysql_query("SELECT category_name FROM ".MPREFIX."arcade_categories WHERE cat_id='".$_GET['catid']."';");
	$row = $sql->db_Fetch();
	$text .= " --> <a href='".e_PLUGIN."kroozearcade_menu/kroozearcade.php?catid=".$_GET['catid']."'>".$row['category_name']."</a>";
}
if (isset($_GET['gameid'])) {
	$sql->mySQLresult = @mysql_query("SELECT game_title FROM ".MPREFIX."arcade_games WHERE game_id='".$_GET['gameid']."';");
	$row = $sql->db_Fetch();
	$text .= " --> <a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$_GET['catid']."&gameid=".$_GET['gameid']."'>".$row['game_title']."</a>";
}
$title = "<b>".KROOZEARCADE_38."</b>";
$ns -> tablerender($title, $text);

$text = "";

if (isset($_GET['gameid'])) { $_POST['gameid'] = $_GET['gameid']; }
if (isset($_GET['playing_game'])) {
	$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_games SET times_played = times_played + 1 WHERE game_id = '".$_POST['gameid']."';");
	$text .= "<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$_GET['catid']."&gameid=".$_POST['gameid']."'>".KROOZEARCADE_89."</a>";
} elseif (!isset($_POST['gameid'])) {
	$text = "".KROOZEARCADE_90."!";
} else {

	$sql->db_Select("arcade_games WHERE game_id='".$_POST['gameid']."'", "game_filename, game_title, game_description, game_controls, times_played, game_enable, display_height, display_width");
	$result = $sql->db_Fetch();
	$text .= "<table>";
	$text .= "<tr><td rowspan=5><img src='".e_PLUGIN."kroozearcade_menu/games/".$result['game_filename'].".gif'></td><td align=right><b>".KROOZEARCADE_70.":</b></td><td>".$result['game_title']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_41.":</b></td><td>".$result['game_description']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_42.":</b></td><td>".$result['game_controls']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_68.":</b></td><td>".$result['times_played']."</td></tr>";
	$text .= "<tr><td>&nbsp;</td><td>";
	if ($result['game_enable'] == "0") {
		$text .= "".KROOZEARCADE_91."!";
	} else {
// Start game in new window
// todo add prefs
// 		$text .= "<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$_GET['catid']."&playing_game=true&gameid=".$_POST['gameid']."' onClick='javascript:window.open(\"".e_PLUGIN."kroozearcade_menu/games/".$result['game_filename'].".swf\", \"playgame\", \"toolbar=0,location=0,directories=0,status=0, menubar=0,scrollbars=0,resizable=1,width=".$result['display_width'].",height=".$result['display_height']."\");'>".KROOZEARCADE_83."</a>";
// <a href="http://www.adobe.com/products/flashplayer/include/marquee/design.swf?width=792&amp;height=294" rel="prettyPhoto[flash]" title="Flash 10 demo"><img src="images/thumbnails/flash-logo.jpg" alt="Flash 10 demo" width="60" /></a>
  $width =  $result['display_width'];
  $height = $result['display_height'];
  $text .="<a href='".e_PLUGIN."kroozearcade_menu/games/".$result['game_filename'].".swf?width=".$width."&amp;height=".$height."'  flash='prettyPhoto[flash]'   
  title='".$result['game_filename']."'>".KROOZEARCADE_83."</a>";
 
  
  
	}
	$text .= "</td></tr>";
	$text .= "</table><br><br>";

}

$title = "<b>".KROOZEARCADE_38." - ".KROOZEARCADE_82."</b>";
$ns -> tablerender($title, $text);

// Get score order
$sql->db_select("arcade_games WHERE game_id='".$_POST['gameid']."'", "reverse_score_order");
$result = $sql->db_Fetch();
if ($result['reverse_score_order'] == 1) {
	$scoreorder = 'ASC';
} else {
	$scoreorder = 'DESC';
}

// Highest score of all time
$text = "";
$monthstart = mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time())));
$monthend = mktime(23, 59, 59, (date("m", time())), 0, (date("Y", time())));
$sql->mySQLresult = @mysql_query("SELECT c.score, c.date_scored, g.game_title, u.user_name, g.game_filename FROM ".MPREFIX."arcade_champs c, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE g.game_id='".$_POST['gameid']."' and c.game_id='".$_POST['gameid']."' and c.user_id = u.user_id ORDER BY c.score ".$scoreorder." LIMIT 0,1;");
$rows = $sql->db_Rows();
if ($rows == 0) {
	$text .= KROOZEARCADE_92."!";
} else {
	$result = $sql->db_fetch();
	$datescored = date("d/m/Y H:i", $result['date_scored']);
	$text .= "<table>";
	$text .= "<tr><td rowspan=3><img src='".e_PLUGIN."kroozearcade_menu/games/".$result['game_filename'].".gif'></td><td align=right><b>".KROOZEARCADE_93." ".(date("M", mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time()))))).":</td><td>".$result['user_name']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_94.":</td><td>".$result['score']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_95.":</td><td>".$datescored."</td></tr>";
	$text .= "</table>";
}
$title = "<b>".KROOZEARCADE_96." ".$result['game_title']."</b>";
$ns->tablerender($title, $text);

// Display highest score last month
$text = "";
$monthstart = mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time())));
$monthend = mktime(23, 59, 59, (date("m", time())), 0, (date("Y", time())));
$sql->mySQLresult = @mysql_query("SELECT s.score, s.date_scored, g.game_title, u.user_name, g.game_filename FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE g.game_id='".$_POST['gameid']."' and s.game_id='".$_POST['gameid']."' and s.user_id = u.user_id and s.date_scored > ".$monthstart." and s.date_scored < ".$monthend." ORDER BY s.score ".$scoreorder." LIMIT 0,1;");
$rows = $sql->db_Rows();
if ($rows == 0) {
	$text .= KROOZEARCADE_97." ".(date("M", mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time())))))."!";
} else {
	$result = $sql->db_fetch();
	$datescored = date("d/m/Y H:i", $result['date_scored']);
	$text .= "<table>";
	$text .= "<tr><td rowspan=3><img src='".e_PLUGIN."kroozearcade_menu/games/".$result['game_filename'].".gif'></td><td align=right><b>".KROOZEARCADE_93." ".(date("M", mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time()))))).":</td><td>".$result['user_name']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_94.":</td><td>".$result['score']."</td></tr>";
	$text .= "<tr><td align=right><b>".KROOZEARCADE_95.":</td><td>".$datescored."</td></tr>";
	$text .= "</table>";
}
$title = "<b>".KROOZEARCADE_98." ".$result['game_title']."</b>";
$ns->tablerender($title, $text);


// Display high score table
$text = "";
$monthstart = mktime(0, 0, 0, (date("m", time())), 1, (date("Y", time())));
$sql->mySQLresult = @mysql_query("SELECT s.score, s.date_scored, g.game_title, u.user_name FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE g.game_id='".$_POST['gameid']."' and s.game_id='".$_POST['gameid']."' and s.user_id = u.user_id and s.date_scored > ".$monthstart." ORDER BY s.score ".$scoreorder." LIMIT 0,10;");
$rows = $sql->db_Rows();

if ($rows == 0) {
	$text .= KROOZEARCADE_99." ".$result['game_title']." ".KROOZEARCADE_79.".";
} else {
	$text .= "<table>";
	$text .= "<tr><th>".KROOZEARCADE_100."</th><th>".KROOZEARCADE_101."</th><th>".KROOZEARCADE_87."</th><th>".KROOZEARCADE_95."</th></tr>";

	for ($i=0; $i < $rows; $i++) {
		$result = $sql->db_fetch();
		$datescored = date("d/m/Y H:i", $result['date_scored']);
		$text .= "<tr>";
		$text .= "<td>".($i+1)."</td>";
		$text .= "<td>".$result['user_name']."</td>";
		$text .= "<td>".$result['score']."</td>";
		$text .= "<td>".$datescored."</td>";
		$text .= "</tr>";
	}
	$text .= "</table>";
}

$title = "<b>".$result['game_title']." ".KROOZEARCADE_102."</b>";
$ns->tablerender($title, $text);

require_once(FOOTERF);
?>
