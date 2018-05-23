<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7
|        Compatible with all games from www.ibparcade.com
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        &copy;Paul Blundell
|        www.boreded.co.uk
|        mail@boreded.co.uk
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if(file_exists(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."kroozearcade_menu/language/English.php");
}

if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();}

// GET CATEGORIES USER IS ALLOWED TO SEE
$sql->mySQLresult = @mysql_query("SELECT category_userclass, cat_id FROM ".MPREFIX."arcade_categories");
$catrows = $sql->db_Rows();

$rest = "";
for ($i = 0; $i < $catrows; $i++) {
	$row = $sql->db_Fetch();

	if ($row['category_userclass'] == e_UC_ADMIN) {
		if (!ADMIN) {
		$display = "NO"; // Not in userclass so dont display
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	} elseif ($row['category_userclass'] == e_UC_MEMBER) {
		if (!USER) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	} elseif ($row['category_userclass'] == 255) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} elseif ($row['category_userclass'] == '' || $row['category_userclass'] == 0) {
		$display = "YES";
	} else {
		$userc = @mysql_query("SELECT user_class FROM ".MPREFIX."user WHERE user_id='".USERID."'");
		$userc = mysql_fetch_array($userc);
		$break = explode(",", $userc['user_class']);

		if (!in_array($row['category_userclass'], $break)) {
		$display = "NO";
		$rest1 = "g.game_category != ".$row['cat_id'];
		} else {
		$display = "YES";
		}
	}

	if ($display != YES) {
	$rest .= " AND ".$rest1;
	}
}
$n = "0";
$sql->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 0,".$pref['arcadeaddin_topuserwcount'].";");
$rows = $sql->db_Rows();
if ($rows == 0) {
$text = "<b>There are no scores in the database yet.</b>";
} else {
$text = "<table width='100%' class=''><td></td><td><b><u>User</u></b></td><td><b><u>Wins</u></b></td>";
	
	for ($i=0; $i < $rows; $i++) {
	$result = $sql->db_fetch();
        $user = @mysql_query("select user_name from ".MPREFIX."user where user_id='".$result['user_id']."'");
	$user = mysql_fetch_array($user);
$n++;
if ($pref['arcadeaddin_enable_gold'] == "1"){
        $userorb = "".$gold_obj->show_orb($result['user_id'])."";}
else
{$userorb = "".$user['user_name']."";}  

        $text .= "<tr><td class=''>".$n.".</td>";

        $text .= "<td style='width:100%' class=''>".$userorb."</td>";
	
	$text .= "<td class=''>".$result['trophies']."</td>";
	}
	
$text .= "</table>";}


$title2 .= "Top ".$pref['arcadeaddin_topuserwcount']." Arcade Members";





$ns -> tablerender($title2, $text);

?>

