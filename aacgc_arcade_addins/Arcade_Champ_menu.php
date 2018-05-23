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


//------------------------Arcade champs---------------------------

$sql->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 0,1;");
$result = $sql->db_fetch();
$user = @mysql_query("select * from ".MPREFIX."user where user_id='".$result['user_id']."'");
$user = mysql_fetch_array($user);

if ($pref['arcadeaddin_enable_gold'] == "1"){
$arcadechamp = "".$gold_obj->show_orb($result['user_id'])."";}
else
{$arcadechamp = "".$user['user_name']."";}

$champ1ts = "".$result['trophies']."";

$trophy = "<img src='".e_PLUGIN."aacgc_arcade_addins/images/trophy8.jpg'></img>";

if ($pref['arcadeaddin_enable_avatar'] == "1"){
if ($user['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $user[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['arcadeaddin_avatar_size']."px></img>";}}


$text = "<table style='width:95%' class=''><tr>
          <td><center><br>
          <a href='".e_PLUGIN."kroozearcade_menu/hof.php?u=".$result['user_id']."'>".$arcadechamp."<br>".$avatar."</a>
          <br>
          With ".$champ1ts." Wins!
          <br><br>
          ".$trophy."
          <br>
          </center></td>
          </tr></table>";



$title = "Current Arcade Champion";
$ns -> tablerender($title, $text);
?>



