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
$text = "<table width='100%' class=''>";

arsort($statspoints);
$count = 0;
foreach ($statspoints as $user => $s) {

if ($count != 1) {
$name = get_user_data($user);

if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();

$challuser = "".$gold_obj->show_orb($name['user_id'])."";}
else
{$challuser = "".$name['user_name']."";}

if ($pref['arcadeaddin_enable_avatar'] == "1"){
if ($name['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $name[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['arcadeaddin_avatar_size']."px></img>";}}

$text .= "<tr>
<td><br><center>
<a href='".e_BASE."user.php?id.".$user."'>".$challuser."<br>".$avatar."</a>
<br>
With ".$s." Points!
</td>
</tr><tr>
<td><center>
(".$statswon[$user].") Wins
<br>
(".$statsdraw[$user].") Draws
<br>
(".$statslost[$user].") Lost
</td>
</tr><tr>
<td><center><br><img src='".e_PLUGIN."aacgc_arcade_addins/images/challchamp.jpg'></img></td>
</tr>";

$count++;}}


$text .= "</table>";

$title = "Current Challenges Champion";
$ns -> tablerender($title, $text);
?>
