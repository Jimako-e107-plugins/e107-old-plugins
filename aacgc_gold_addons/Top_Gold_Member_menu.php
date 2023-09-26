<?php
/*
+---------------------------------------------------------------+
   AACGC Gold Addons
   M@CH!N3
   admin@aacgc.com
   www.aacgc.com
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{exit;}

if ($pref['goldaddon_enable_orbs'] == "1")
{$gold_obj = new gold();}



$rm_title .= "Richest Member";


global $GOLD_PREF, $sql2, $gold_obj, $grpg_obj, $tp,$PLUGINS_DIRECTORY;

$sql->db_Select("gold_system", "*", "ORDER BY gold_balance DESC LIMIT 0,1", "");
$row = $sql->db_fetch();

/*    
$gold_arg = 'select user_name,gold_id,gold_orb,gold_balance from #gold_system left join #user on user_id=gold_id ORDER BY gold_balance DESC LIMIT ' . $GOLD_PREF['gold_mrichest'];
$sql2->db_Select_gen($gold_arg, false);
$gold_rows = $sql2->db_Fetch();
*/

$sql3 = new db;
$sql3->db_Select("user", "*", "WHERE user_id=".$row['gold_id']."", "");
$user = $sql3->db_fetch();

if ($pref['goldaddon_enable_orbs'] == "1")
{$userorb = "".$gold_obj->show_orb($row['gold_id'])."";}
else
{$userorb = "".$row['user_name']."";}
     
if ($pref['goldaddon_enable_avatar'] == "1"){
if ($user['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $user[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['goldaddon_avatarsize']."px></img>";}}



$rm_text .= "<table style='width:100%' class=''>
            <tr>
            <td style='width:60%'><center>
            <br>
            <a href='".e_BASE."user.php?id.".$row['gold_id']."'>".$userorb."<br>".$avatar."</a></font>
            <br>
            With ".$gold_obj->formation($row['gold_balance'])."
            <br><br>
            <img width='".$pref['goldaddon_topgoldmemimg']."px' src='".e_PLUGIN."aacgc_gold_addons/images/money.gif'></img>
            <br>
            </center></td></tr></table>";



$ns->tablerender($rm_title, $rm_text);

?>
