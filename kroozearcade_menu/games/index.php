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
require_once("../../../class2.php");
require_once("../language/".e_LANGUAGE.".php");

$sql->db_SetErrorReporting(TRUE);

$text = "";
$cheating = FALSE;

if ($_SERVER['HTTP_REFERER'] != "") {
	if (strpos($_SERVER['HTTP_REFERRER'], $SERVER['HTTP_HOST']) > 0) {
		$cheating = TRUE;
	}
}
#echo "</html></body>";
echo "<font color=\"#FFFFFF\">";
echo  "2d";
echo "&randchar=5&randchar2=196&savescore=1&blah=OK";
echo "0";
echo "</font>";
echo "<body text =\"#000000\">";

if ((!isset($_POST['gscore'])) or (!isset($_POST['gname']))) {
	$cheating = TRUE;
}

if ($cheating == TRUE) {
	$title = "<b>".KROOZEARCADE_9."</b>";
	$text .= KROOZEARCADE_10."<br><br>";
	$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_banlist WHERE user_id='".USERID."';");
	$rows = $sql->db_Rows();
	if ($rows == 0) {
		$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."arcade_banlist (user_id, strike_count) VALUES ('".USERID."', '1');");
		$text .= KROOZEARCADE_11." 1. 2 ".KROOZEARCADE_12."<br>";
	} else {
		$result = $sql->db_Fetch();
		$strikecount = $result['strike_count'] + 1;
		$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_banlist SET strike_count='".$strikecount."' WHERE user_id='".USERID."';");
		$text .= KROOZEARCADE_11." ".$strikecount.". ";
		if ($strikecount < 3) {
			$text .= (3-$strikecount)." ".KROOZEARCADE_12;
		} else {
			$text .= KROOZEARCADE_13;
			$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_banlist SET ban_reason='Three strikes for cheating', ban_date='".(time())."' WHERE user_id='".USERID."';");
		}
	}
} else {
	$score = $_POST['gscore'];
	$game = $_POST['gname'];

	$title = "<b>".KROOZEARCADE_14."</b>";
	$text = KROOZEARCADE_15."<br><br>";

	$sql->mySQLresult = @mysql_query("SELECT game_id, game_title FROM ".MPREFIX."arcade_games WHERE game_filename='".$game."';");
	$gamequery = $sql->db_Fetch();
	$gameid = $gamequery['game_id'];

	$monthstart = mktime(0, 0, 0, (date("m", time())), 1, (date("Y", time())));

// Get score order
$scoreresult = @mysql_query("SELECT reverse_score_order FROM ".MPREFIX."arcade_games WHERE game_id='".$gameid."';");
$scoreresult = mysql_fetch_array($scoreresult);
if ($scoreresult['reverse_score_order'] == 1) {
	$scoreorder = 'ASC';
} else {
	$scoreorder = 'DESC';
}

//	$sql->mySQLresult = @mysql_query("SELECT score FROM ".MPREFIX."arcade_scores WHERE game_id='".$gameid."' ORDER BY score ".$scoreorder." LIMIT 0,1;");
	$sql->mySQLresult = @mysql_query("SELECT score FROM ".MPREFIX."arcade_scores WHERE date_scored > ".$monthstart." AND game_id='".$gameid."' ORDER BY score ".$scoreorder." LIMIT 0,1;");
	$rows = $sql->db_Rows();
	$result = $sql->db_Fetch();
	if ($scoreorder == 'DESC') {
		if (($result['score'] < $score) or ($rows == 0)) {
			$text .= KROOZEARCADE_16."<br>";
		} else {
			$text .= KROOZEARCADE_17." ".$score." ".KROOZEARCADE_18." ".$result['score'].".";
		}
	} else {
		if (($result['score'] > $score) or ($rows == 0)) {
			$text .= KROOZEARCADE_16."<br>";
		} else {
			$text .= KROOZEARCADE_17." ".$score." ".KROOZEARCADE_18." ".$result['score'].".";
		}
	}

//	$sql->mySQLresult = @mysql_query("SELECT score_id, score FROM ".MPREFIX."arcade_scores WHERE user_id='".USERID."' AND game_id='".$gameid."';");
	$sql->mySQLresult = @mysql_query("SELECT score_id, score FROM ".MPREFIX."arcade_scores WHERE user_id='".USERID."' AND game_id='".$gameid."' AND date_scored > ".$monthstart.";");

	$rows = $sql->db_Rows();
	$scorequery = $sql->db_Fetch();
	if ($rows == 0) {
		$text .= KROOZEARCADE_19." ".$gamequery['game_title']." ".KROOZEARCADE_20." ".$score."!<br>";
		$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."arcade_scores (game_id, user_id, score, date_scored) VALUES ('".$gameid."', '".USERID."', '".$score."', '".(time())."');");
	} else {
		if ($scoreorder == 'DESC') {
			if ($score > $scorequery['score']) {
				$text .= KROOZEARCADE_21." ".$gamequery['game_title']." ".KROOZEARCADE_20." ".$score."!<br>";
				$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_scores SET score='".$score."', date_scored='".(time())."' WHERE score_id='".$scorequery['score_id']."';");
			}
		} else {
			if ($score < $scorequery['score']) {
				$text .= KROOZEARCADE_21." ".$gamequery['game_title']." ".KROOZEARCADE_20." ".$score."!<br>";
				$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_scores SET score='".$score."', date_scored='".(time())."' WHERE score_id='".$scorequery['score_id']."';");
			}
		}
	}

	$sql->mySQLresult = @mysql_query("SELECT score, champ_id FROM ".MPREFIX."arcade_champs WHERE game_id='".$gameid."';");
	$rows = $sql->db_Rows();
	$result = $sql->db_Fetch();
	if ($scoreorder == 'DESC') {
		if (($result['score'] < $score) or ($rows == 0)) {
			$text .= KROOZEARCADE_22." ".$gamequery['game_title']." ".KROOZEARCADE_23."!<br>";
			if ($rows == 0) {
				$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."arcade_champs (game_id, user_id, score, date_scored) VALUES ('".$gameid."', '".USERID."', '".$score."', '".(time())."');");
			} else {
				$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_champs SET score='".$score."', date_scored='".(time())."', user_id='".USERID."' WHERE champ_id='".$result['champ_id']."';");
			}
		}
	} else {
		if (($result['score'] > $score) or ($rows == 0)) {
			$text .= KROOZEARCADE_22." ".$gamequery['game_title']." ".KROOZEARCADE_23."!<br>";
			if ($rows == 0) {
				$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."arcade_champs (game_id, user_id, score, date_scored) VALUES ('".$gameid."', '".USERID."', '".$score."', '".(time())."');");
			} else {
				$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."arcade_champs SET score='".$score."', date_scored='".(time())."', user_id='".USERID."' WHERE champ_id='".$result['champ_id']."';");
			}
		}
	}

	$text .= "<br>".KROOZEARCADE_24;
}


//echo $title."<br>";
echo "<center><img src='../images/army.gif' alt='army'><br>";
echo $text;
echo "<br><br><form><input type='button' value='Play Again!' onClick='history.back()'>";
echo "<input type='button' value='Close' onClick='window.close()'></form></center>";

?>
