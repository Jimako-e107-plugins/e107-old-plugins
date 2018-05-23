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
if (isset($_GET['catid'])) {
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
		$text .= " --> <a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$_GET['catid']."&gameid='".$_GET['gameid']."'>".$row['game_title']."</a>";
	}
	$title = "<b>".KROOZEARCADE_38."</b>";
	$ns -> tablerender($title, $text);
} else {
	$text = "";

	$col = 1;
	$text .= "<table style='width:95%'><tr>";
	$sql->db_Select("arcade_categories", "*");
	$rows = $sql->db_Rows();
	for ($i = 0; $i < $rows; $i++) {
		
		$row = $sql->db_Fetch();
		if ($_GET['catid'] == $row['cat_id']) {
			$text .= "<td>".$row['category_name']."</td>";
			$catname = $row['category_name'];
		} else {
                       #random category image start
                       $result = "";
                       $rcount = "";
                       #this should be changed to db_Fetch eventually
                       $result = mysql_query("select game_filename from ".MPREFIX."arcade_games where game_category='".$row['cat_id']."';");
		       $catcount = mysql_num_rows($result);
                       $result = mysql_query("select game_filename from ".MPREFIX."arcade_games where game_category='".$row['cat_id']."' order by rand() limit 1;");
                       $rcount = mysql_num_rows($result);
                       if ($rcount == "0"){
                        $text .= "<td bordercolor:'#000000'> &nbsp; <center><a href='".e_PLUGIN."kroozearcade_menu/kroozearcade.php?catid=".$row['cat_id']."'>".$row['category_name']."($catcount)</a></center> &nbsp; </td>";
                       }else{
                       $imgrow = mysql_fetch_array($result);
                       $text .= "<td bordercolor:'#000000'> &nbsp; <center><a href='".e_PLUGIN."kroozearcade_menu/kroozearcade.php?catid=".$row['cat_id']."'>".$row['category_name']."($catcount)<br><img src='".e_PLUGIN."kroozearcade_menu/games/" . $imgrow["game_filename"] . ".gif' /></a></center> &nbsp; </td>";
                       }
                       #random category image end

			if ($col == 3) {
				$text .= "<td><p></p></td></tr>";
				$col = 1;
				}else{
			$col++;
			}
		}
#		$col++;
	}
	//while ($col != 6) {
	//	$text .= "<td>&nbsp;</td>";
	//	$col++;	
	$text .= "</tr></table>";
	
	$title = "<b>".KROOZEARCADE_69."</b>";
	$ns -> tablerender($title, $text);
}

if (isset($_GET['catid'])) {
	$title = "<b>".$catname."</b>";
	$text = "";

	$sql->mySQLresult = @mysql_query("SELECT game_id, game_filename, game_title, game_description, date_added, times_played, round((times_played / ((".(time())." - date_added)/86400)),2) as popularity FROM ".MPREFIX."arcade_games WHERE game_enable=1 AND game_category=".$_GET['catid']." ORDER BY popularity DESC;");
	$rows = $sql->db_Rows();

	$text .= "<table>";

	for ($i = 0; $i < $rows; $i++) {
		$row = $sql->db_Fetch();
		$dateadded = date("d/m/y", $row['date_added']);

// Get score order
$scoreresult = @mysql_query("SELECT reverse_score_order FROM ".MPREFIX."arcade_games WHERE game_id='".$row['game_id']."';");
$scoreresult = mysql_fetch_array($scoreresult);
if ($scoreresult['reverse_score_order'] == 1) {
	$scoreorder = 'ASC';
} else {
	$scoreorder = 'DESC';
}
	
		$text .= "<tr><td rowspan=10 valign=top><img src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'></td><td align=right><b>".KROOZEARCADE_70.":</b></td><td>".$row['game_title']."</td><tr>";
		$text .= "<tr><td align=right><b>".KROOZEARCADE_41.":</b></td><td>".$row['game_description']."</td></tr>";
		$text .= "<tr><td align=right><b>".KROOZEARCADE_67.":</b></td><td>".$dateadded."</td></tr>";
		$text .= "<tr><td align=right><b>".KROOZEARCADE_68.":</b></td><td>".$row['times_played']."</td></tr>";
		$text .= "<tr><td align=right><b>".KROOZEARCADE_71.":</b></td><td>".$row['popularity']."</td></tr>";

		$scoreresult = @mysql_query("SELECT c.score, u.user_name FROM ".MPREFIX."arcade_champs c, ".MPREFIX."user u WHERE c.game_id='".$row['game_id']."' AND c.user_id=u.user_id ORDER BY c.score ".$scoreorder." LIMIT 0,1;");
		$scoreresult = mysql_fetch_array($scoreresult);
		$text .= "<tr><td align=right><b>".KROOZEARCADE_73.":</b></td><td>";
		if ($scoreresult['user_name'] == "") {
			$text .= KROOZEARCADE_72." ".$row['game_title'].".";
		} else {
			$text .= $scoreresult['user_name']." ".KROOZEARCADE_20." ".$scoreresult['score'];
		}
		$text .= "</td></tr>";

		$monthstart = mktime(0, 0, 0, (date("m", time())-1), 1, (date("Y", time())));
		$monthend = mktime(23, 59, 59, (date("m", time())), 0, (date("Y", time())));
		$scoreresult = @mysql_query("SELECT s.score, u.user_name FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u WHERE s.game_id='".$row['game_id']."' AND s.user_id=u.user_id AND s.date_scored > ".$monthstart." AND s.date_scored < ".$monthend." ORDER BY s.score ".$scoreorder." LIMIT 0,1;");
		$scoreresult = mysql_fetch_array($scoreresult);
		$text .= "<tr><td align=right><b>".KROOZEARCADE_74.":</b></td><td>";
		if ($scoreresult['user_name'] == "") {
			$text .= KROOZEARCADE_75." ".$row['game_title']." ".KROOZEARCADE_76.".";
		} else {
			$text .= $scoreresult['user_name']." ".KROOZEARCADE_20." ".$scoreresult['score'];
		}
		$text .= "</td></tr>";

		$monthstart = mktime(0, 0, 0, (date("m", time())), 1, (date("Y", time())));
		$scoreresult = @mysql_query("SELECT s.score, u.user_name FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u WHERE s.game_id='".$row['game_id']."' AND s.user_id=u.user_id AND s.date_scored > ".$monthstart." ORDER BY s.score ".$scoreorder." LIMIT 0,1;");
		$scoreresult = mysql_fetch_array($scoreresult);
		$text .= "<tr><td align=right><b>".KROOZEARCADE_77.":</b></td><td>";
		if ($scoreresult['user_name'] == "") {
			$text .= KROOZEARCADE_78." ".$row['game_title']." ".KROOZEARCADE_79.".";
		} else {
			$text .= $scoreresult['user_name']." ".KROOZEARCADE_20." ".$scoreresult['score'];
		}
		$text .= "</td></tr>";

		$text .= "<tr><td>&nbsp;</td><td><a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$_GET['catid']."&gameid=".$row['game_id']."'>".KROOZEARCADE_80." ".$row['game_title']."</a></td></tr>";
		$text .= "<tr><td colspan=3><br><br></td></tr>";
	}

	$text .= "</table>";

	$title = "<b>".KROOZEARCADE_81."</b>";
	$ns -> tablerender($title, $text);
}

require_once(FOOTERF);
?>
