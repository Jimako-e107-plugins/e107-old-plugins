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



$topgold_title .= "Top ".$pref['goldaddon_richcount']." Richest Members";


$topgold_text .= "<table style='width:100%' class=''><tr>
                  <td></td>
                  <td><u>User</u></td>
                  <td><u>Balance</u></td>
                 ";


global $GOLD_PREF, $sql2, $gold_obj, $grpg_obj, $tp,$PLUGINS_DIRECTORY;

$n = "0";
$gold_arg = 'select user_name,gold_id,gold_orb,gold_balance from #gold_system left join #user on user_id=gold_id ORDER BY gold_balance DESC LIMIT ' . $pref['goldaddon_richcount'];
$sql2->db_Select_gen($gold_arg, false);
while ($gold_rows = $sql2->db_Fetch())
{$n++;

if ($pref['goldaddon_enable_orbs'] == "1")
{$userorb = "".$gold_obj->show_orb($gold_rows['gold_id'])."";}
else
{$userorb = "".$gold_rows['user_name']."";}



$topgold_text .= "
<tr>
<td>".$n.".</td>
<td style='width:60%'><a href='".e_BASE."user.php?id.".$gold_rows['gold_id']."'>".$userorb."</a></td>
<td style='width:40%'>".$gold_obj->formation($gold_rows['gold_balance'])."</td>
</tr>
";}



$topgold_text .= "</table>";



$ns->tablerender($topgold_title, $topgold_text);

?>