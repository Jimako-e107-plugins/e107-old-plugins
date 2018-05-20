<?php
/**
*SubmitReplay.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");
require_once(HEADERF);
require_once(e_PLUGIN."ebattles/include/ebattles_header.php");

global $sql;
$event_id = intval($_GET['eventid']);

$MAX_FILE_SIZE = 4000000;

//$text .= '<div class="ui-widget ui-widget-content ui-corner-all">';
$text .= '
<form enctype="multipart/form-data" action="'.$SERVER['REQUEST_URI'].'" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="'.$MAX_FILE_SIZE.'" />
Choose file to upload: <input name="userfile" type="file" /><br />
<input type="submit" value="Upload File" />
</form>
';

if (isset($_FILES['userfile'])) {
	$error = $_FILES['userfile']['error'];
	$type = $_FILES['userfile']['type'];
	$name = $_FILES['userfile']['name'];
	$tmpname = $_FILES['userfile']['tmp_name'];
	$size = $_FILES['userfile']['size'];
	$err = false;
	if ($size >= $MAX_FILE_SIZE) {
		$text .= "Error: The uploaded file was too large. The maximum size is ".$MAX_FILE_SIZE." bytes.<br />";
		$err = true;
	}
	if ($error == UPLOAD_ERR_PARTIAL) {
		$text .= "Error: The upload was not completed successfully. Please try again.<br />";
		$err = true;
	}
	if ($error == UPLOAD_ERR_NO_FILE) {
		$text .= "Error: No file was selected for uploading.<br />";
		$err = true;
	}
	if (!is_uploaded_file($tmpname)) {
		$text .= "Error: Uploaded filename doesn't point to an uploaded file.<br />";
		$err = true;
	}
	if ($err !== true) {
		if (class_exists("MPQFile") || (include './include/replays/mpqfile.php')) {
			$start = microtime_float();
			$parseDurationString = "";
			$debug = 0;

			$a = new MPQFile($tmpname,true,$debug);
			$init = $a->getState();

			if ($init == false)
			$text .= "Error parsing uploaded file, make sure it is a valid MPQ archive!<br />\n";
			else if ($a->getFileType() == "SC2replay") {
				$b = $a->parseReplay();
				$parseDurationString .= sprintf("Parsed replay in %d ms.<br />\n",((microtime_float() - $start)*1000));
				$players = $b->getPlayers();
				$recorder = $b->getRecorder();

				$error_str = '';

				if ($event_id) {
					$event = new Event($event_id);
					$match = new Match();

					// Check if replay->TeamSize == event->MatchType
					if ($b->getTeamSize() != $event->getField('MatchType'))
					$error_str .= '<li>'.EB_SUBMITREPLAY_L3.'</li>';

					// Check if winner is known
					if (!$b->isWinnerKnown())
					$error_str .= '<li>'.EB_SUBMITREPLAY_L4.'</li>';
					
					// Check if the replay has already been submitted.
					$q2 = "SELECT ".TBL_MATCHS.".*"
					." FROM ".TBL_MATCHS
					." WHERE (".TBL_MATCHS.".TimePlayed = '".$b->getCtime()."')";
					$result2 = $sql->db_Query($q2);
					$num_rows = mysql_numrows($result2);
					if ($num_rows!=0)
					{
						$error_str .= '<li>'.EB_SUBMITREPLAY_L7.'</li>';
					}					
					
					$match->setField('Event', $event_id);
					$match->setField('ReportedBy', USERID);
					$match->setField('TimeReported', $time);
					$match->setField('Status', 'pending');
					$match->setField('GameLength', $b->getGameLength());
					$match->setField('GameSpeed', $b->getGameSpeedText());
					$match->setField('Realm', $b->getRealm());
					$match->setField('TimePlayed', $b->getCtime());

					// Map
					$q2 = "SELECT ".TBL_MAPS.".*"
					." FROM ".TBL_MAPS
					." WHERE (".TBL_MAPS.".Game = '".$event->getField('Game')."')"
					." AND (".TBL_MAPS.".Name = '".$tp->toDB($b->getMapName())."')";
					$result2 = $sql->db_Query($q2);
					$num_rows = mysql_numrows($result2);
					if ($num_rows!=0)
					{
						$map = mysql_result($result2, 0, TBL_MAPS.".MapID");
					}
					else
					{
						$q2 = "INSERT INTO ".TBL_MAPS."(Game,Image,Name,Description)
						VALUES ('".$event->getField('Game')."','','".$tp->toDB($b->getMapName())."','')";
						$result2 = $sql->db_Query($q2);
						$map = mysql_insert_id();
					}
					$match->setField('Maps', $map);

					// Check if the replay players are event players
					$i = 0;
					$scores = array();
					foreach($players as $player) {
						if ($player['isObs']) {
							if ($obsString == "")
							$obsString = $player['name'];
							else
							$obsString .= ', '.$player['name'];
							$obsCount++;
							continue;
						}
						if ($player['isComp'])
						$error_str .= '<li>'.EB_SUBMITREPLAY_L5.'</li>';

						$q = "SELECT DISTINCT ".TBL_PLAYERS.".*"
						." FROM ".TBL_PLAYERS.", "
						.TBL_GAMERS
						." WHERE (".TBL_PLAYERS.".Event = '$event_id')"
						." AND (".TBL_PLAYERS.".Gamer = ".TBL_GAMERS.".GamerID)"
						." AND (".TBL_GAMERS.".UniqueGameID LIKE '".$player['name']."#___')";
						$result = $sql->db_Query($q);
						$numPlayers = mysql_numrows($result);

						if ($numPlayers == 0)
						{
							$error_str .= '<li>'.EB_SUBMITREPLAY_L6.$player['name'].'</li>';
						}
						else
						{
							$scores[$i]['Player'] = mysql_result($result, 0, TBL_PLAYERS.".PlayerID");

							$q2 = "SELECT ".TBL_FACTIONS.".*"
							." FROM ".TBL_FACTIONS
							." WHERE (".TBL_FACTIONS.".Game = '".$event->getField('Game')."')"
							." AND (".TBL_FACTIONS.".Name = '".$player['race']."')";
							$result2 = $sql->db_Query($q2);
							$scores[$i]['Faction'] = mysql_result($result2, 0, TBL_FACTIONS.".FactionID");

							$scores[$i]['Player_MatchTeam'] = ($player['team'] > 0)? $player['team'] : 0;
							$scores[$i]['Player_Rank'] = ($player['won'] == 1)?1:2;
							$scores[$i]['Color'] = $player['color'];
							$scores[$i]['sColor'] = $player['sColor'];
							$scores[$i]['APM'] = ($player['team'] > 0)?(round($player['apmtotal'] / ($b->getGameLength() / 60))):0;
							$i++;
						}
					}
					$nbr_players = $i;
					//var_dump($match);
					//var_dump($scores);
				} else {
					$error_str .= '<li>Error</li>';
				}

				if ($error_str!='')
				{
					$text .= '<p style="color:red">'.EB_SUBMITREPLAY_L2;
					$text .= '<ul style="color:red">'.$error_str.'</ul></p>';

					$text .= '<table class="eb_table table_left"><tbody>';
					$text .= '<td class="eb_td eb_tdc1">Version</td><td class="eb_td2">'.$a->getVersionString();
					$text .= '<tr><td class="eb_td eb_tdc1">Map name</td><td class="eb_td2">'.$b->getMapName().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Game length</td><td class="eb_td2">'.$b->getFormattedGameLength().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Team size</td><td class="eb_td2">'.$b->getTeamSize().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Game speed</td><td class="eb_td2">'.$b->getGameSpeedText().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Real team size</td><td class="eb_td2">'.$b->getRealTeamSize().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Realm</td><td class="eb_td2">'.$b->getRealm().'</td></tr>';
					$text .= '<tr><td class="eb_td eb_tdc1">Date and time played</td><td class="eb_td2">'.date('jS \of F Y \a\t H:i' ,$b->getCtime()).'</td></tr>';
					if ($recorder != null)
					$text .= '<tr><td class="eb_td eb_tdc1">Replay recorded by</td><td class="eb_td2">'.$recorder['name'].'</td></tr>';
					$text .= '</tbody></table>';

					$apmString = "<b>APM graphs</b><br />\n";
					$obsString = "";
					$obsCount = 0;
					$text .= '<br />';
					$text .= '<table class="table_left">
					<tr>
					<th class="eb_th2">Player name</th>
					<th class="eb_th2">Race</th><th>Color</th>
					<th class="eb_th2">Team</th>
					<th class="eb_th2">Average APM</th>
					<th class="eb_th2">Winner?</th>
					</tr>';
					foreach($players as $player) {
						if ($player['isObs']) {
							if ($obsString == "")
							$obsString = $player['name'];
							else
							$obsString .= ', '.$player['name'];
							$obsCount++;
							continue;
						}
						if ($b->isWinnerKnown())
						$wincolor = (isset($player['won']) && $player['won'] == 1)?0x00FF00:0xFF0000;
						else
						$wincolor = 0xFFFFFF;
						if ($player['isComp'] && $b->getTeamSize() !== null)
						$difficultyString = sprintf(" (%s)",SC2Replay::$difficultyLevels[$player['difficulty']]);
						else
						$difficultyString = "";
						$text .= sprintf("<tr><td>%s</td><td>%s</td><td><font color=\"#%s\">%s</font></td><td>%s</td><td style=\"text-align: center\">%d</td><td style=\"background-color: #%06X; text-align: center\">%d</td></tr>\n",
						//$player['name'].'#'.$player['uid'].'@'.$player['uidIndex'].$difficultyString,
						$player['name'].$difficultyString,
						$player['race'],
						$player['color'],
						$player['sColor'],
						($player['team'] > 0)?"Team ".$player['team']:"-",
						($player['team'] > 0)?(round($player['apmtotal'] / ($b->getGameLength() / 60))):0,
						((isset($player['won']))?$wincolor:0xFFFFFF),
						(isset($player['won']))?$player['won']:(($player['team'] > 0)?"Unknown":"-")
						);
						/*
						if (!$player['isObs'] && $player['ptype'] != 'Comp') {
						$apmFileName = 'tmp/'.$player['id']."_".md5($name).".png";
						createAPMImage($player['apm'],$b->getGameLength(),$apmFileName);
						$apmString .= sprintf("%s:<br /><img src=\"$apmFileName\" /><br />\n",$player['name']);
						}
						*/
					}
					$text .= "</table><br />";
					if ($obsCount > 0) {
						$text .= "Observers ($obsCount): $obsString<br />\n";
					}
				} else {
					// No errors, create the match
					$match_id = $match->insert();

					// Create scores
					for($i=0;$i < $nbr_players;$i++)
					{
						switch($event->getMatchPlayersType())
						{
						case 'Players':
							$q =
							"INSERT INTO ".TBL_SCORES."(MatchID,Player,Player_MatchTeam,Player_Score,Player_Rank,Faction,Color,sColor,APM)
							VALUES (
							$match_id,
							'".$scores[$i]['Player']."',
							'".$scores[$i]['Player_MatchTeam']."',
							0,
							'".$scores[$i]['Player_Rank']."',
							'".$scores[$i]['Faction']."',
							'".$scores[$i]['Color']."',
							'".$scores[$i]['sColor']."',
							'".$scores[$i]['APM']."'
							)";
							break;
						case 'Teams':
							break;
						default:
							$q = '';
						}
						$result = $sql->db_Query($q);
					}

					// Update scores stats
					$match->match_scores_update();

					// Automatically Update Players stats only if Match Approval is Disabled
					if ($event->getField('MatchesApproval') == eb_UC_NONE)
					{
						switch($event->getMatchPlayersType())
						{
						case 'Players':
							$match->match_players_update();
							break;
						case 'Teams':
							$match->match_teams_update();
							break;
						default:
						}
					}

					$event->setFieldDB('IsChanged', 1);
					
					// Save the replay
					$target_path = "uploads/";
					$target_file = $target_path . basename($name); 
					move_uploaded_file($tmpname, $target_file);
					
					$raw_name = urlencode($name);
					$target_file = $target_path . basename($raw_name); 
					$media_type = 'Replay';
					$media_path = $target_file;
					$submitter = USERID;
					$match->add_media($submitter , $media_path, $media_type);

					header("Location: matchinfo.php?matchid=$match_id");
					exit;
				}

			}
			else {
				// Not a SC2 Replay
				$text .= "Error parsing uploaded file, make sure it is a valid SC2 replay!<br />\n";
			}
			/*
			$text .= sprintf("<p>Peak memory usage: %d bytes<br /></p>\n",memory_get_peak_usage(true));
			$parseDurationString .= sprintf("Page generated in %d ms.<br />\n",((microtime_float() - $start)*1000));
			$text .= "<p>$parseDurationString</p>";
			*/
		}
	}
}

//$text .= '</div>'; // ui-widget
$ns->tablerender(EB_SUBMITREPLAY_L1, $text);
require_once(FOOTERF);
exit;

/* Functions */
function createAPMImage($vals, $length, $fn) {
	$width = 300;
	$height = 200;
	$pixelsPerSecond = $width/ $length;
	$pic = imagecreatetruecolor($width,$height);
	$lineColor = imagecolorallocate($pic,0,0,0);
	$lineColorGrey = imagecolorallocate($pic,192,192,192);
	$bgColor = imagecolorallocate($pic,255,255,255);
	$bgColorT = imagecolorallocatealpha($pic,255,255,255,127);
	imagefill($pic,0,0,$bgColorT);
	// first create x/y pairs
	// do this by adding up the actions of the 60 seconds before the pixel
	// if there are less than 60 seconds, extrapolate by multiplying with 60/$secs
	// the time index corresponding to a pixel can be calculated using the $pixelsPerSecond variable,
	// it should always be 0 < $pixelsPerSecond < 1
	$xypair = array();
	$maxapm = 0;
	for ($x = 1;$x <= $width;$x++) {
		$secs = ceil($x / $pixelsPerSecond);
		$apm = 0;
		if ($secs < 60) {
			for ($tmp = 0;$tmp < $secs;$tmp++)
			if (isset($vals[$tmp]))
			$apm += $vals[$tmp];
			$apm = $apm / $secs * 60;
		} else {
			for ($tmp = $secs - 60;$tmp < $secs;$tmp++)
			if (isset($vals[$tmp]))
			$apm += $vals[$tmp];
			$apm = $apm;
		}
		if ($apm > $maxapm)
		$maxapm = $apm;
		$xypair[$x] = $apm;

	}

	// draw the pixels
	if ($maxapm <= 0)
	return;
	for ($i = 2;$i <= $width;$i++) {
		imageline($pic,$i - 1,$height - $xypair[$i - 1] / $maxapm * $height, $i,$height - $xypair[$i] / $maxapm * $height,$lineColor);
	}
	// build a seperate container image
	$frame = imagecreatetruecolor($width +50,$height+50);
	imagefill($frame,0,0,$bgColor);

	imagerectangle($frame,40,0,$width + 40,$height,$lineColor);
	imageline($frame,40,$height / 2,$width + 40,$height / 2, $lineColorGrey);


	imagestringup($frame,4,5,$height - 15,"APM -->",$lineColor);
	imagestring($frame,4,55,$height + 20,"Time (minutes)",$lineColor);
	imagestring($frame,2,25,$height - 15,"0",$lineColor);
	imagestring($frame,2,20,($height / 2),floor($maxapm / 2),$lineColor);
	imagestring($frame,2,20,0,floor($maxapm),$lineColor);
	$lengthMins = ($length / 60);
	for ($i = 0;$i < $lengthMins;$i+=5) {
		imagestring($frame,2,40+($width / ($lengthMins / 5) * ($i / 5)),$height + 5,$i,$lineColor);
		if ($i > 0)
		imageline($frame,40+($width / ($lengthMins / 5) * ($i / 5)),0,40+($width / ($lengthMins / 5) * ($i / 5)),$height, $lineColorGrey);
	}
	// copy the graph onto the container image and save it
	imagecopy($frame,$pic,40,0,0,0,$width,$height);
	imagepng($frame,$fn);
	imagedestroy($frame);
	imagedestroy($pic);
}





?>