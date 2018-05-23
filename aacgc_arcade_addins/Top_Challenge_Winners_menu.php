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

require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");

global $arcade_prefs;

// Create an array of all the users who have played a challenge
$users = Array();
$n = "0";
	// Get Users who sent
$sql->mySQLresult = @mysql_query("SELECT chalto FROM ".MPREFIX."arcade_challenges WHERE finished=1");
$rows = $sql->db_Rows();

for ($i=0;$i<$rows;$i++) {
$row = $sql->db_Fetch();

if (!in_array($row['chalto'], $users)) {
$users[] = $row['chalto'];
}

}

	// Get Users who recieved
$sql->mySQLresult = @mysql_query("SELECT chalby FROM ".MPREFIX."arcade_challenges WHERE finished=1");
$rows = $sql->db_Rows();

for ($i=0;$i<$rows;$i++) {
$row = $sql->db_Fetch();

if (!in_array($row['chalby'], $users)) {
$users[] = $row['chalby'];
}

}


// Get statistical data for each user
foreach ($users as $u) {

$sql->mySQLresult = @mysql_query("SELECT COUNT(won) as won FROM ".MPREFIX."arcade_challenges WHERE (chalto='".$u."' OR chalby='".$u."') AND won=".$u." AND finished=1 AND status != 0");
$won = $sql->db_Fetch();

$sql->mySQLresult = @mysql_query("SELECT COUNT(won) as draw FROM ".MPREFIX."arcade_challenges WHERE finished=1 AND (chalto=".$u." OR chalby=".$u.") AND won='DR' AND status != 0 ");
$draw = $sql->db_Fetch();

$sql->mySQLresult = @mysql_query("SELECT COUNT(won) as lost FROM ".MPREFIX."arcade_challenges WHERE finished=1 AND (chalto=".$u." OR chalby=".$u.") AND won!=".$u." AND status != 0 ");
$lost = $sql->db_Fetch();

$statswon[$u] = $won['won'];
$statsdraw[$u] = $draw['draw'];
$statslost[$u] = $lost['lost'];

$points = ($won['won'] * $arcade_prefs['challengemenuwin']) + ($draw['draw'] * $arcade_prefs['challengemenudraw']) + ($lost['lost'] * $arcade_prefs['challengemenuloss']);

$statspoints[$u] = $points;

}


// Order by number won and output
$text = "
<table width='100%' class=''><tr>
<td></td>
<td><u>".KROOZEARCADE_MENU_1."</u></td>
<td><u>".KROOZEARCADE_MENU_2."</u></td>
<td><u>".KROOZEARCADE_MENU_3."</u></td>
<td><u>".KROOZEARCADE_MENU_4."</u></td>
<td><center><u>".KROOZEARCADE_MENU_5."</u></center></td>
</tr>";

arsort($statspoints);
$count = 0;
foreach ($statspoints as $user => $s) {

if ($count != $pref['arcadeaddin_topuserccount']) {
$name = get_user_data($user);

if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();
$challusers = "".$gold_obj->show_orb($name['user_id'])."";}
else
{$challusers = "".$name['user_name']."";}
$n++;
$text .= "<tr>
<td class=''>".$n.".</td>
<td><a href='".e_BASE."user.php?id.".$user."'>".$challusers."</a></td>
<td>".$statswon[$user]."</td>
<td>".$statsdraw[$user]."</td>
<td>".$statslost[$user]."</td>
<td><center>".$s."</center></td>
</tr>";

$count++;
}

}

$text .= "</table>";

$title = "Top ".$pref['arcadeaddin_topuserccount']." Challenge Members";
$ns -> tablerender($title, $text);
?>
