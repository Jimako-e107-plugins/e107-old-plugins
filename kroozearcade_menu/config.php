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

if (isset($_POST['cancel_delete'])) { $messages = KROOZEARCADE_25; }
if (isset($_POST['delete_game_confirm'])) {
	$sql->db_Delete("arcade_games", "game_id='".$_POST['gameid']."'");
	$sql->db_Delete("arcade_scores", "game_id='".$_POST['gameid']."'");
	$sql->db_Delete("arcade_champs", "game_id='".$_POST['gameid']."'");
	unlink(e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".swf");
	unlink(e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".gif");
	$messages = $_POST['gamename']." ".KROOZEARCADE_26.".";
}
// reset scores added 06-20 Penbrock
if (isset($_POST['score_reset'])) {
	$sql->db_Delete("arcade_scores", "game_id='".$_POST['gameid']."'");
	$sql->db_Delete("arcade_champs", "game_id='".$_POST['gameid']."'");
	$messages = $_POST['gamename']." ".KROOZEARCADE_106.".";
}
if (isset($_POST['add_category'])) {
	$messages = "";
	$tmpid = $sql->db_Insert("arcade_categories (category_name)", "'".$_POST['catname']."'");
	if ($tmpid == 0) {
		$messages .= KROOZEARCADE_27."<br>".KROOZEARCADE_28."</br>";
	} else {
		$messages .= KROOZEARCADE_29."<br>";
	}
}
if (isset($_POST['modify_catname'])) {
        $messages = "";
        $tmpid = $sql->db_Update("arcade_categories", "category_name='".$_POST['catname']."' where cat_id='" .$_POST['catid']."'" );
        if ($tmpid == 0) {
                $messages .= KROOZEARCADE_112;
        } else {
                $messages .= KROOZEARCADE_113;
        }
}
if (isset($_POST['delete_category'])) {
        $sql->db_Select("arcade_games", "*", "game_category=".$_POST['catid']);
	$gcount = $sql->db_Rows();
	if ($gcount == 0){
	  $sql->db_Delete("arcade_categories", "cat_id='".$_POST['catid']."'");
	  $messages = $_POST['catname']." ".KROOZEARCADE_26.".";
	}else{
	$messages .= KROOZEARCADE_111;
	}
}
if (isset($_POST['modify_game_submit'])) {
	$args = "";
	$args .= "game_title='".$_POST['gametitle']."', ";
	$args .= "game_description='".$_POST['gamedescription']."', ";
	$args .= "game_controls='".$_POST['gamecontrols']."', ";
	$args .= "game_category='".$_POST['catid']."', ";
	$args .= "display_height='".$_POST['dispheight']."', ";
	$args .= "display_width='".$_POST['dispwidth']."', ";
	if ($_POST['gameenabled'] == 'on') {
		$args .= "game_enable='1', ";
	} else {
		$args .= "game_enable='0', ";
	}
	if ($_POST['reversescores'] == 'on') {
		$args .= "reverse_score_order='1'";
	} else {
		$args .= "reverse_score_order='0'";
	}
	$args .= " WHERE game_id='".$_POST['gameid']."'";
	$sql->db_Update("arcade_games", $args);
	$messages = "Game settings updated.<br>";
	if ($_POST['changeimage'] == 'on') {
		if ($_FILES['newimage']['size'] == 0) {
			$messages .= KROOZEARCADE_30."<br>";
		} elseif ($_FILES['newimage']['type'] != 'image/gif') {
			$messages .= KROOZEARCADE_31."<br>";
		} else {
			unlink(e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".gif");
			$return = move_uploaded_file($_FILES['newimage']['tmp_name'], e_PLUGIN."kroozearcade_menu/games/".$_POST['filename'].".gif");
			$messages .= KROOZEARCADE_32."<br>";
		}
	}
}
if (isset($_POST['add_game_submit'])) {
	if ($_FILES['game']['size'] == 0) {
		$messages .= KROOZEARCADE_33."<br>";
	} elseif ($_FILES['game']['type'] != 'application/x-shockwave-flash') {
		$messages .= KROOZEARCADE_34."<br>";
	} elseif ($_FILES['image']['size'] == 0) {
		$messages .= KROOZEARCADE_30."<br>";
	} elseif ($_FILES['image']['type'] != 'image/gif') {
		$messages .= KROOZEARCADE_31."<br>";
	} else {
		$filename=substr($_FILES['game']['name'], 0, strpos($_FILES['game']['name'], ".swf"));
		if ($_POST['gameenabled'] == 'on') { $enabled = '1'; } else { $enabled = '0'; }
		$game_category = $_POST['catid'];
		$date_added = time();
		$game_title = $_POST['gametitle'];
		$game_description = $_POST['gamedescription'];
		$game_controls = $_POST['gamecontrols'];
		$display_height = $_POST['dispheight'];
		$display_width = $_POST['dispwidth'];
		if ($_POST['reversescores'] == 'on') { $reverse_score_order = '1'; } else { $reverse_score_order = '0'; }
		$tmpid = $sql->db_Insert("arcade_games (game_filename, game_enable, game_category, date_added, game_title, game_description, game_controls, reverse_score_order, display_height, display_width)", "'".$filename."','".$enabled."','".$game_category."','".$date_added."','".$game_title."','".$game_description."','".$game_controls."','".$reverse_score_order."','".$display_height."','".$display_width."'");
		if ($tmpid == 0) {
			$messages .= KROOZEARCADE_35."<br>".KROOZEARCADE_36."</br>";
		} else {
			$imagename=substr($_FILES['game']['name'], 0, (strpos($_FILES['game']['name'], ".swf") + 1))."gif";
			$return = move_uploaded_file($_FILES['game']['tmp_name'], e_PLUGIN."kroozearcade_menu/games/".$_FILES['game']['name']);
			$return = move_uploaded_file($_FILES['image']['tmp_name'], e_PLUGIN."kroozearcade_menu/games/".$imagename);
			$messages .= KROOZEARCADE_37."<br>";
		}
	}
	
}

if (isset($messages)) {
$ns -> tablerender("", $messages);
}

if (isset($_POST['add_games'])) {

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_3;

$sql->db_Select("arcade_categories", "*");
$rows = $sql->db_Rows();
$options = "";
for ($i=0; $i < $rows; $i++) {
	$option = $sql->db_Fetch();
	if ($option['cat_id'] == $_POST['catid']) {
		$options .= "<option value='".$option['cat_id']."' SELECTED>".$option['category_name']."</option>";
	} else {
		$options .= "<option value='".$option['cat_id']."'>".$option['category_name']."</option>";
	}
}

if (!isset($_POST['dispwidth'])) { $_POST['dispwidth'] = 640; }
if (!isset($_POST['dispheight'])) { $_POST['dispheight'] = 480; }

$text = "

<form enctype=multipart/form-data method='post' action='".e_SELF."'>
<input type=hidden name='add_games' value='true'>
<table>
<tr><td>".KROOZEARCADE_39.":</td><td><input type='text' name='gametitle' maxlength=64 value='".$_POST['gametitle']."' /></td></tr>
<tr><td>".KROOZEARCADE_41.":</td><td><input type='text' name='gamedescription' maxlength=255 value='".$_POST['gamedescription']."' /></td></tr>
<tr><td>".KROOZEARCADE_42.":</td><td><input type='text' name='gamecontrols' maxlength=255 value='".$_POST['gamecontrols']."' /></td></tr>
<tr><td>".KROOZEARCADE_43.":</td><td><input type='checkbox' name='gameenabled' checked /></td></tr>
<tr><td>".KROOZEARCADE_44.":<br>(For games where lowest score wins)</td><td><input type='checkbox' name='reversescores' /></td></tr>
<tr><td>".KROOZEARCADE_45.":</td><td><input type=file name=game value='".$_POST['game']."'></td></tr>
<tr><td>".KROOZEARCADE_46.":</td><td><input type=file name=image value='".$_POST['image']."'></td></tr>
<tr><td>".KROOZEARCADE_47.":</td><td><select name='catid'>".$options."</select></td></tr>
<tr><td>".KROOZEARCADE_104.":</td><td><input type='text' name='dispwidth' maxlength=4 value='".$_POST['dispwidth']."' /></td></tr>
<tr><td>".KROOZEARCADE_103.":</td><td><input type='text' name='dispheight' maxlength=4 value='".$_POST['dispheight']."' /></td></tr>
<td>&nbsp;</td><td><input class='button' type='submit' name='add_game_submit' value='".KROOZEARCADE_40."' /></td></tr>
</table>
</form>
";

} elseif (isset($_POST['edit_scores'])) {

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_5;
$text = "Tournment is not yet implemented. Please make sure you are using the most recent version.";

// Start of score reset zone
$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_5;
$text = KROOZEARCADE_7."<br/>";

$sql->mySQLresult = @mysql_query("SELECT g.game_id, g.game_filename, g.game_title, g.date_added, g.times_played, c.category_name from ".MPREFIX."arcade_games g, ".MPREFIX."arcade_categories c WHERE g.game_category = c.cat_id;");
$rows = $sql->db_Rows();
$text .= "
	<table>
		<tr>
			<th>".KROOZEARCADE_65."</th><th>".KROOZEARCADE_66."</th><th>".KROOZEARCADE_67."</th><th>".KROOZEARCADE_68."</th><th>".KROOZEARCADE_50."</th>
		</tr>
	";

for ($i=0; $i < $rows; $i++) {
	$row = $sql->db_Fetch();
	$formatdate = date("m/d/Y H:i", $row['date_added']);
	$text .= "

<tr>
	<td>".$row['game_id']."</td>
	<td>".$row['game_title']."</td>
	<td>".$formatdate."</td>
	<td><center>".$row['times_played']."</center></td>
<td>

	<form method='post' action='".e_SELF."'>
		<input type='hidden' name='gameid' value='".$row['game_id']."' />
		<input type='hidden' name='gamename' value='".$row['game_title']."' />
		<input type='hidden' name='filename' value='".$row['game_filename']."' />
		<input class='button' type='submit' name='score_reset' value='".KROOZEARCADE_105."' />
	</form>
</td>
</tr>
	";

}
$text .= "</table>";
// end of score reset zone

} elseif (isset($_POST['tournment'])) {

	$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_107;
	$text = KROOZEARCADE_108;
	
} elseif (isset($_POST['modify_category'])) {

	$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_62;
#	$text = KROOZEARCADE_108;
	$text .="
	<table>
	<td>
	<form enctype=multipart/form-data method='post' action='".e_SELF."'>
	<input type=hidden name='edit_categories' value='true' />
	<input type=hidden name='catid' value='".$_POST['catid']."' />
	<b>".KROOZEARCADE_115."<b> <input type='text' name='catname' maxlength=64 value='".$_POST['catname']. "' /><br/>
	<td>
	<input class='button' type='submit' name='modify_catname' value='".KROOZEARCADE_116."' />
	</td>
	</table>
	</form>
	";
	

} elseif (isset($_POST['edit_categories'])) {

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_8;
$sql->mySQLresult = @mysql_query("SELECT cat_id, category_name from ".MPREFIX."arcade_categories;");
$rows = $sql->db_Rows();
$text .= "
<table>
<tr>
<th>".KROOZEARCADE_48."</th><th>".KROOZEARCADE_49."</th><th>".KROOZEARCADE_50."</th>
</tr>
";
// View modify Catagories
for ($i=0; $i < $rows; $i++) {
	$row = $sql->db_Fetch();
	$text .= "

<tr>
	<td>".$row['cat_id']."</td>
	<td>".$row['category_name']."</td>
	<td>
		<form method='post' action='".e_SELF."'>
			<input type='hidden' name='edit_categories' value='true' />
			<input type='hidden' name='catid' value='".$row['cat_id']."' />
			<input type='hidden' name='catname' value='".$row['category_name']."' />
			<input class='button' type='submit' name='delete_category' value='".KROOZEARCADE_51."' />
			<input class='button' type='submit' name='modify_category' value='".KROOZEARCADE_62."' />
		</form>
	</td>
</tr>
	";
}
$text .= "</table><br>";

$text .= "
<br><br>
<table>
<td><form enctype=multipart/form-data method='post' action='".e_SELF."'>
<input type=hidden name='edit_categories' value='true' />
<b>".KROOZEARCADE_53.":</b> <input type='text' name='catname' maxlength=64 value='".$_POST['catname']."' />
<input class='button' type='submit' name='add_category' value='".KROOZEARCADE_54."' />
</td>
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
} elseif (isset($_POST['modify_game'])) {

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

} elseif (isset($_POST['edit_banned'])) {
  $text = KROOZEARCADE_108;
  #ban list will be here, displaying ban list as default option.
  $configtitle = KROOZEARCADE_108;
} else {

$configtitle = KROOZEARCADE_38." - ".KROOZEARCADE_4;
$text = KROOZEARCADE_7."<br/>";

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

}

$ns -> tablerender("<div style='text-align:center'>$configtitle</div>", $text);

require_once(e_ADMIN."footer.php");

?>
