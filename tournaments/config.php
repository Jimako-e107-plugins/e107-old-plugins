<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

require_once("../../class2.php");

if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."calendar/calendar_class.php");

$cal = new DHTML_Calendar(true);
function headerjs()
{
	global $cal;
	require_once(e_HANDLER."calendar/calendar_class.php");
	$cal = new DHTML_Calendar(true);
	return $cal->load_files();
}

if(file_exists(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."tournaments/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."tournaments/language/English.php");
}

if(isset($_POST['create_tournament_submit'])){
	$start = strtotime($_POST['start_date']);
	$end = strtotime($_POST['end_date']);
	
	//solving GMT time finding server timezone and adding to time submited in GMT
	$now = gettimeofday();
	$gm_now = strtotime(gmstrftime("%a %d %b %y %H:%M", $now['sec']));
	$diff = $now['sec'] - $gm_now;//dif from server time to GMT
	
	//adjusting time to server time instead of GMT
	$start += $diff;
	$end += $diff;
	
	if($start == -1 || $end == -1 || $end <= $start){
		$text = "<center><br><h1>".TOURNAMENTS_18."</h1><br></cdenter>";
	}
	else{
		$sql->mySQLresult = @mysql_query("INSERT INTO ".MPREFIX."tournaments_tournaments VALUES('', ".$_POST['game_id'].", \"".$_POST['tournament_desc']."\", \"".$_POST['tournament_prize']."\", $start, $end);");
		$text = "<center><br><h1>".TOURNAMENTS_19."</h1><br></center>";
	}
	
	$ns -> tablerender(TOURNAMENTS_17, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['add_tournament'])){
	
	$now = gettimeofday();
	$sql->mySQLresult = @mysql_query("SELECT game_id, game_title FROM ".MPREFIX."tournaments_games;");
	$rows = $sql->db_Rows();
	
	if($rows == 0){
		$text = "<center><br><h1>".TOURNAMENTS_16."</h1><br></center>";
		$ns -> tablerender(TOURNAMENTS_14, $text);
		require_once(e_ADMIN."footer.php");
		exit;
	}
	
	$tournaments_games = "<select name='game_id'>";
	for($i=0; $i<$rows; $i++){
		$row = $sql->db_Fetch();
		$tournaments_games .="
								<option value='".$row['game_id']."'>".$row['game_title']."</option>
							";
	}
	$tournaments_games .= "</select>";
	
	$text .= "
		<form name='add_tournament_form' method='post' action=".e_SELF.">
			<table width=90%>
				<tr>
					<td>".TOURNAMENTS_10."</td>
					<td>".$tournaments_games."</td>
				</tr>
				<tr>
					<td>".TOURNAMENTS_46."</td>
					<td><textarea name='tournament_desc' cols=30 rows=5></textarea></td>
				</tr>
				<tr>
					<td>".TOURNAMENTS_47."</td>
					<td><input type='text' name='tournament_prize'></td>
				</tr>
				<tr>
					<td>".TOURNAMENTS_11."</td>
					<td>";
					
	$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%Y/%m/%d %I:%M %P',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'start_date',
                 'value'       => gmstrftime('%Y/%m/%d %I:%M %P', $now['sec'])));
					
	$text .="
					</td>
				</tr>
				<tr>
					<td>".TOURNAMENTS_12."</td>
					<td>";
					
	$text .= $cal->make_input_field(
           array('firstDay'       => 1, // show Monday first
                 'showsTime'      => true,
                 'showOthers'     => true,
                 'ifFormat'       => '%Y/%m/%d %I:%M %P',
                 'weekNumbers'    => false,
                 'timeFormat'     => '12'),
           array('style'       => 'color: #840; background-color: #ff8; border: 1px solid #000; text-align: center',
                 'name'        => 'end_date',
                 'value'       => gmstrftime('%Y/%m/%d %I:%M %P', $now['sec'])));
					
	$text .="
					</td>
				</tr>
				<tr>
					<td>".TOURNAMENTS_13."</td>
					<td>".gmstrftime('%Y/%m/%d %I:%M %P', $now['sec'])."</td>
				</tr>
			</table>
			<br><br>
			<center><input type='submit' class='button' name='create_tournament_submit' value='".TOURNAMENTS_15."'>
		</form>
	";
	$ns -> tablerender(TOURNAMENTS_14, $text);
	require_once(e_ADMIN."footer.php");
	exit;

}

if(isset($_POST['delete_tournament_sure'])){
	$sql->mySQLresult = @mysql_query("DELETE FROM ".MPREFIX."tournaments_tournaments WHERE tournament_id=".$_POST['tournament_id'].";");
	$sql->mySQLresult = @mysql_query("DELETE FROM ".MPREFIX."tournaments_plays WHERE tournament_id=".$_POST['tournament_id'].";");
	header("Location: ".e_SELF);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['add_game_submit'])){
	if ($_FILES['game']['size'] == 0) {
		$text = "<center><br><h1>".TOURNAMENTS_28."</h1><br></center>";
	} elseif ($_FILES['game']['type'] != 'application/x-shockwave-flash') {
		$text = "<center><br><h1>".TOURNAMENTS_29."</h1><br></center>";
	} elseif (!is_writable(e_PLUGIN."tournaments/games/")) {
		$text = "<center><br><h1>".TOURNAMENTS_34."</h1><br></center>";
	} elseif($_POST['game_title'] == "" || $_POST['disp_width'] == "" || $_POST['disp_height'] == ""){
		$text = "<center><br><h1>".TOURNAMENTS_33."</h1><br></center>";
	}else {
		$filename=substr($_FILES['game']['name'], 0, strpos($_FILES['game']['name'], ".swf"));
		$game_title = $_POST['game_title'];
		$display_height = $_POST['disp_height'];
		$display_width = $_POST['disp_width'];
		$tmpid = $sql->db_Insert("tournaments_games", "'', \"$filename\", \"$game_title\", $display_width, $display_height");
		if ($tmpid == 0) {
			$text = "<center><br><h1>".TOURNAMENTS_30."</h1><br></center>";
		} else {
			$return = move_uploaded_file($_FILES['game']['tmp_name'], e_PLUGIN."tournaments/games/".$_FILES['game']['name']);
			chmod(e_PLUGIN."tournaments/games/".$_FILES['game']['name'], 0777);
			$text = "<center><br><h1>".TOURNAMENTS_31."</h1><br></center>";
		}
	}
	
	$ns -> tablerender(TOURNAMENTS_32, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['add_game'])){
	
	$text = "
			<form name='add_game_form' enctype=multipart/form-data method='post' action='".e_SELF."'>
				<center>
					<table width=90%>
						<tr>
							<td>".TOURNAMENTS_23."</td>
							<td><input type='text' name='game_title'></td>
						</tr>
						<tr>
							<td>".TOURNAMENTS_24."</td>
							<td><input type='file' name='game'></td>
						</tr>
						<tr>
							<td>".TOURNAMENTS_26."</td>
							<td><input type='text' name='disp_width' maxlength=4 size=4 value=640></td>
						</tr>
						<tr>
							<td>".TOURNAMENTS_27."</td>
							<td><input type='text' name='disp_height' maxlength=4 size=4 value=480></td>
						</tr>
					</table>
					<br><br>
					<input class='button' type='submit' name='add_game_submit' value='".TOURNAMENTS_25."'>
				</center>
			</form>
			";
	
	$ns -> tablerender(TOURNAMENTS_22, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['view_games'])){
	
	$sql->mySQLresult = @mysql_query("SELECT game_id, game_title, game_filename FROM ".MPREFIX."tournaments_games;");
	$rows = $sql->db_Rows();
	
	$text .= "
	<table width=90%>
	<tr>
	<th>".TOURNAMENTS_36."</th><th>".TOURNAMENTS_37."</th><th>".TOURNAMENTS_38."</th>
	</tr>
	";
	
	for($i=0; $i<$rows; $i++){
		$row = $sql->db_Fetch();
		$text .= "
				<tr>
					<td>".$row['game_title']."</td>
					<td>".$row['game_filename'].".swf</td>
					<td>
						<form method='post' action='".e_SELF."' name='delete_game_form'>
							<input type='submit' name='delete_game' value='".TOURNAMENTS_39."' class='button'>
							<input type='hidden' value='".$row['game_id']."' name='game_id'>
						</form>
					</td>
				</tr>
				";
	}
	
	$text .= "</table><br>";
	$ns -> tablerender(TOURNAMENTS_35, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['delete_tournament'])){
	$text = "<center>
			<br>
			<h1>".TOURNAMENTS_82."</h1>
			<br>
			<form name='delete_sure_form' method='post' action='".e_SELF."'>
				<input type='submit' class='button' name='delete_tournament_sure' value='".TOURNAMENTS_43."'>
				<input type='hidden' name='tournament_id' value='".$_POST['tournament_id']."'>
			</form>			
			</center>";
	
	$ns -> tablerender(TOURNAMENTS_41, $text);
	require_once(e_ADMIN."footer.php");
	exit;

}

if(isset($_POST['delete_game'])){
	$text = "<center>
			<br>
			<h1>".TOURNAMENTS_42."</h1>
			<br>
			<form name='delete_sure_form' method='post' action='".e_SELF."'>
				<input type='submit' class='button' name='delete_game_sure' value='".TOURNAMENTS_43."'>
				<input type='hidden' name='game_id' value='".$_POST['game_id']."'>
			</form>			
			</center>";
	
	$ns -> tablerender(TOURNAMENTS_41, $text);
	require_once(e_ADMIN."footer.php");
	exit;

}

if(isset($_POST['delete_game_sure'])){
	$sql->mySQLresult = @mysql_query("SELECT tournament_id FROM ".MPREFIX."tournaments_tournaments WHERE game_id=".$_POST['game_id'].";");
	$rows = $sql->db_Rows();
	$tournaments_ids[] = array();
	
	for($i=0; $i<$rows; $i++){
		$row = $sql->db_Fetch();
		$tournaments_ids[] = $row['tournament_id'];
	}
	
	for($i=0; $i<count($tournaments_id); $i++){
		$sql->mySQLresult = @mysql_query("DELETE FROM ".MPREFIX."tournaments_plays WHERE tournament_id=".$tournaments_ids[$i].";");
	}
	
	$sql->mySQLresult = @mysql_query("SELECT game_filename FROM ".MPREFIX."tournaments_games WHERE game_id=".$_POST['game_id'].";");
	$row = $sql->db_Fetch();
	unlink(e_PLUGIN."tournaments/games/".$row['game_filename'].".swf");
	
	$sql->mySQLresult = @mysql_query("DELETE FROM ".MPREFIX."tournaments_tournaments WHERE game_id=".$_POST['game_id'].";");
	$sql->mySQLresult = @mysql_query("DELETE FROM ".MPREFIX."tournaments_games WHERE game_id=".$_POST['game_id'].";");
	header("Location: ".e_SELF);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['edit_tournament'])){
	
	$sql->mySQLresult = @mysql_query("SELECT tournament_desc, tournament_prize FROM ".MPREFIX."tournaments_tournaments WHERE tournament_id=".$_POST['tournament_id'].";");
	$row = $sql->db_Fetch();
	$text = "
			<center>
				<form name='edit_tournament_submit_form' method='post' action='".e_SELF."'>
					<table>
						<tr>
							<td>".TOURNAMENTS_84."</td>
							<td><textarea name='tournament_desc' cols=30 rows=5>".$row['tournament_desc']."</textarea></td>
						</tr>
						<tr>
							<td>".TOURNAMENTS_85."</td>
							<td><input name='tournament_prize' type='text' value='".$row['tournament_prize']."'></td>
						</tr>
					</table>
					<br><br>
					<input type='hidden' name='tournament_id' value='".$_POST['tournament_id']."'>
					<input class='button' type='submit' name='edit_tournament_submit' value='".TOURNAMENTS_86."'>
				</form>
			";

	$ns -> tablerender(TOURNAMENTS_83, $text);
	require_once(e_ADMIN."footer.php");
	exit;
}

if(isset($_POST['edit_tournament_submit'])){
	$sql->mySQLresult = @mysql_query("UPDATE ".MPREFIX."tournaments_tournaments SET tournament_desc='".$_POST['tournament_desc']."', tournament_prize='".$_POST['tournament_prize']."' WHERE tournament_id=".$_POST['tournament_id'].";");
	header("Location: ".e_SELF);
	exit;
}

$sql->mySQLresult = @mysql_query("SELECT game_title, tournament_id, tournament_desc, tournament_prize, tournament_start, tournament_end FROM ".MPREFIX."tournaments_tournaments, ".MPREFIX."tournaments_games WHERE ".MPREFIX."tournaments_games.game_id=".MPREFIX."tournaments_tournaments.game_id;");
$rows = $sql->db_Rows();

$text .= "
<table width=100%>
<tr>
<th>".TOURNAMENTS_04."</th><th>".TOURNAMENTS_45."</th><th>".TOURNAMENTS_05."</th><th>".TOURNAMENTS_06."</th><th>".TOURNAMENTS_09."</th><th>".TOURNAMENTS_07."</th>
</tr>
";

for($i=0; $i<$rows; $i++){
	$row = $sql->db_Fetch();
	$now = gettimeofday();
	if($row['tournament_start'] > $now['sec']){
		$text .= "<tr bgcolor=#CC8811>";
	}
	elseif ($row['tournament_start'] < $now['sec'] && $row['tournament_end'] > $now['sec']){
		$text .= "<tr bgcolor=#00FF00>";
	}
	else{
		$text .= "<tr bgcolor=#FF0000>";
	}
	$text .= "
		<td>".$row['game_title']."</td>
		<td>".$row['tournament_prize']."</td>
		<td>".gmstrftime('%Y/%m/%d %I:%M %P', $row['tournament_start'])."</td>
		<td>".gmstrftime('%Y/%m/%d %I:%M %P', $row['tournament_end'])."</td>
		<td>".gmstrftime('%Y/%m/%d %I:%M %P', $now['sec'])."</td>
		<td>
			<form name='edit_tournament_form' action='".e_SELF."' method='post'>
				<input type='submit' name ='edit_tournament' value='".TOURNAMENTS_81."' class='button'>
				<input type='hidden' name='tournament_id' value='".$row["tournament_id"]."'>
			</form>
			<form name='delete_tournament_form' action='".e_SELF."' method='post'>
				<input type='submit' name ='delete_tournament' value='".TOURNAMENTS_20."' class='button'>
				<input type='hidden' name='tournament_id' value='".$row["tournament_id"]."'>
			</form>
		</td>
	</tr>
	";
}

$text .= "</table>";

$ns -> tablerender(TOURNAMENTS_08, $text);

require_once(e_ADMIN."footer.php");

?>