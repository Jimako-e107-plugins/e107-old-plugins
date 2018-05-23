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

if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
require_once(e_ADMIN."auth.php");
require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_4;
$text = KROOZEARCADE_7."<br/>";

if (isset($_POST['cancel_delete'])) { $messages = KROOZEARCADE_25; }
if (isset($_POST['delete_game_confirm'])) {
	$sql->db_Delete("arcade_games", "game_id='".$_POST['gameid']."'");
	$sql->db_Delete("arcade_scores", "game_id='".$_POST['gameid']."'");
	$sql->db_Delete("arcade_champs", "game_id='".$_POST['gameid']."'");
	unlink(e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".swf");
	unlink(e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".gif");
	$messages = $_POST['gamename']." ".KROOZEARCADE_26.".";
}

if (isset($_POST['modify_game'])) {

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_62." ".$_POST['gamename'];
$sql->db_Select("arcade_games", "*", "game_id='".$_POST['gameid']."'");
$row = $sql->db_Fetch();

$sql->db_Select("arcade_categories", "*");
$rows = $sql->db_Rows();
$options = "";
for ($i=0; $i < $rows; $i++) {
	$option = $sql->db_Fetch();
	if ($option['cat_id'] == $row['game_category']) {
		$options .= "<option value='".$option['cat_id']."' SELECTED>".$option['category_name']."</option>";
	} else {
		$options .= "<option value='".$option['cat_id']."'>".$option['category_name']."</option>";
	}
}
$text = "

<form enctype=multipart/form-data method='post' action='".e_SELF."'>
<input type='hidden' name='gameid' value='".$row['game_id']."'>
<input type='hidden' name='filename' value='".$row['game_filename']."'>
<input type='hidden' name='modify_game' value='true'>
<table>
<tr><td>".KROOZEARCADE_39.":</td><td><input type='text' name='gametitle' maxlength=64 value=\"".$row['game_title']."\" /></td></tr>
<tr><td>".KROOZEARCADE_41.":</td><td><input type='text' name='gamedescription' maxlength=255 value=\"".$row['game_description']."\" /></td></tr>
<tr><td>".KROOZEARCADE_42.":</td><td><input type='text' name='gamecontrols' maxlength=255 value=\"".$row['game_controls']."\" /></td></tr>
<tr><td>".KROOZEARCADE_104.":</td><td><input type='text' name='dispwidth' maxlength=4 value='".$row['display_width']."' /></td></tr>
<tr><td>".KROOZEARCADE_103.":</td><td><input type='text' name='dispheight' maxlength=4 value='".$row['display_height']."' /></td></tr>
<tr><td>".KROOZEARCADE_43.":</td><td><input type='checkbox' name='gameenabled'";
if ($row['game_enable'] == 1) {
	$text .= "checked";
}
$text .= "/></td></tr>
<tr><td>".KROOZEARCADE_44.":<br>(".KROOZEARCADE_63.")</td><td><input type='checkbox' name='reversescores'";
if ($row['reverse_score_order'] == 1) {
	$text .= "checked";
}
$text .= "/></td></tr>
<tr><td>".KROOZEARCADE_46.":</td><td><img src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'><br>
<input type='checkbox' name='changeimage'>".KROOZEARCADE_64." <input type=file name=newimage></td></tr>
<tr><td>".KROOZEARCADE_47.":</td><td><select name='catid'>".$options."</select></td></tr>
<td>&nbsp;</td><td><input class='button' type='submit' name='modify_game_submit' value='".KROOZEARCADE_62." ".KROOZEARCADE_57."' /></td></tr>
</table>
</form>
";

} elseif (isset($_POST['delete_game'])) {

// Confirm delete a game

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_51." ".$_POST['gamename'];
$text = "<font color=red><b>".KROOZEARCADE_55."</b></font> ".KROOZEARCADE_56."<br><br>";
$text .= "<a href='".e_BASE."e107_plugins/kroozearcade_menu/games/".$_POST['filename'].".swf'>".KROOZEARCADE_57."</a><br><a href='".e_BASE."e107_plugins/kroozearcade_menu/games/".$_POST['filename'].".gif'>".KROOZEARCADE_58."</a><br>".KROOZEARCADE_59."<br><br>";
$text .= "
<form method='post' action='".e_SELF."'>
	<input type='hidden' name='gameid' value='".$_POST['gameid']."' />
	<input type='hidden' name='gamename' value='".$_POST['gamename']."' />
	<input type='hidden' name='filename' value='".$_POST['filename']."' />
	<input class='button' style='width: 100%' type='submit' name='cancel_delete' value='".KROOZEARCADE_60."' /><br><br>
	<input class='button' style='width: 100%' type='submit' name='delete_game_confirm' value='".KROOZEARCADE_61."' />
</form>
";
} elseif (isset($_POST['delete_category'])) {
	$sql->db_Delete("arcade_categories", "cat_id='".$_POST['catid']."'");
	$messages = $_POST['catname']." ".KROOZEARCADE_26.".";
} else {

// Show list of all games in Admin menu
// 06-20 set to order by catagory Penbrock

$sql->mySQLresult = @mysql_query("SELECT g.game_id, g.game_filename, g.game_title, g.date_added, g.times_played, c.category_name from ".MPREFIX."arcade_games g, ".MPREFIX."arcade_categories c WHERE g.game_category = c.cat_id ORDER BY c.category_name;");
$rows = $sql->db_Rows();
$text .= "
	<table>
		<tr>
			<th>".KROOZEARCADE_65."</th><th>".KROOZEARCADE_66."</th><th>".KROOZEARCADE_67."</th><th>".KROOZEARCADE_68."</th><th>".KROOZEARCADE_49."</th><th>".KROOZEARCADE_50."</th>
		</tr>
	";

for ($i=0; $i < $rows; $i++) {
	$row = $sql->db_Fetch();
	$formatdate = date("m/d/Y H:i", $row['date_added']);
	$text .= "

		<tr>
			<td>".$row['game_id']."</td>
			<td><strong>".$row['game_title']."</strong></td>
			<td>".$formatdate."</td>
			<td><center>".$row['times_played']."</center></td>
			<td>".$row['category_name']."</td>
			<td>
				<form method='post' action='".e_SELF."'>
					<input type='hidden' name='gameid' value='".$row['game_id']."' />
					<input type='hidden' name='gamename' value='".$row['game_title']."' />
					<input type='hidden' name='filename' value='".$row['game_filename']."' />
					<input class='button' type='submit' name='modify_game' value='".KROOZEARCADE_62."' />
					<input class='button' type='submit' name='delete_game' value='".KROOZEARCADE_51."' />
				</form>
			</td>
		</tr>
	";
}

$text .= "</table>";



// Render the page, no more data
}
$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);

require_once(e_ADMIN."footer.php");

?>