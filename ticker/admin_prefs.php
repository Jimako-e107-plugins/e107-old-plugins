<?php

require_once("../../class2.php");
require_once(e_ADMIN."auth.php");

include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE."_admin.php");

if(!getperms("P")) {

	header("location: ".e_BASE."index.php") and exit;

}

$text = null;

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$ticker_startdaily = (is_numeric($_POST['ticker_startdaily']) ? $_POST['ticker_startdaily'] : "0");
	$ticker_menu_caption = $tp->toDB($_POST['ticker_menu_caption']);
	$ticker_menu_text = $tp->toDB($_POST['ticker_menu_text']);
	$ticker_admin_class = (is_numeric($_POST['ticker_admin_class']) ? $_POST['ticker_admin_class'] : "0");

	global $pref;
	$pref['ticker'] = array("startdaily" => $ticker_startdaily,"admin_class" => $ticker_admin_class,"menu_caption" => $ticker_menu_caption,"menu_text" => $ticker_menu_text,"menu_admin" => USERID);

	save_prefs();

	$text = LAN_PREFS_SAVED."<br>".print_r($pref['ticker']);

	header("refresh:2;url=admin_prefs.php");


} else {

	$startdaily = $pref['ticker']['startdaily'];
	$text = "

		<form method='post' action='".e_SELF."'>

		<table cellspacing='10' cellpadding='0' border='0' style='width:100%;'>

			<colgroup>

				<col style='width:50%;'>
				<col style='width:50%;'>

			</colgroup>

			<tr>

				<td>

					<label for='ticker_startdaily' style='font-weight:bold;'>".LAN_TICKER_STARTDAILY."</label>

				</td>
				<td>

					<select name='ticker_startdaily' class='tbox'>
						<option value='1' ".($startdaily == '1' ? 'selected' : '').">".LAN_YES."</option>
						<option value='0' ".($startdaily == '0' ? 'selected' : '').">".LAN_NO."</option>
					</select>

				</td>

			</tr>
			<tr>

				<td>

					<label for='ticker_admin_class' style='font-weight:bold;'>".LAN_TICKER_ADMIN_CLASS."</label>

				</td>
				<td>

					<select name='ticker_admin_class' class='tbox'>

	";

				$sql->db_select_gen("SELECT userclass_id,userclass_name FROM `".MPREFIX."userclass_classes` union select '0','".LAN_TICKER_ADMIN_ONLY."'");

				while($row = $sql->db_fetch()) {

					$class_selected = ($row[0] == $pref['ticker']['admin_class'] ? "selected" : "");

					$text .= "<option value='".$row[0]."' $class_selected>".$row[1]."</option>";

				}

	$text .= "

					</select>

				</td>
			
			</tr>
			<tr>

				<td>

					<label for='ticker_menu_caption' style='font-weight:bold;'>".LAN_TICKER_MENU_CAPTION."</label>

				</td>
				<td>

					<input size='50' type='text' name='ticker_menu_caption' class='tbox' value='".$pref['ticker']['menu_caption']."'>
					
				</td>
			
			</tr>
			<tr>

				<td>
	
					<label for='ticker_menu_text' style='font-weight:bold;'>".LAN_TICKER_MENU_TEXT."</label>

				</td>
				<td>

					<textarea name='ticker_menu_text' class='tbox' rows='10' cols='100'>".$pref['ticker']['menu_text']."</textarea>
			
				</td>

			</tr>
			<tr>

				<td colspan='2' style='text-align:center;'>
			
					<input type='submit' value='".LAN_SUBMIT."' class='button'>

				</td>

			</tr>

		</table>

		</form>

	";

}

$ns->tablerender(LAN_PREFERENCES,$text);

require_once(e_ADMIN."footer.php");

?>