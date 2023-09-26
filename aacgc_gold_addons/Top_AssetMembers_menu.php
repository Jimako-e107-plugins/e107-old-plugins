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



//------------------------Top Asset Members---------------------------




$topassetmems_text .= "<table style='width:100%' class=''><tr><td style='width:0%'></td><td style='width:80%'><u>User</u></td><td style='width:20%'><u>Assets</u></td></tr>";


$n = "0";
$sql->mySQLresult = @mysql_query("select gasset_user_id, count(gasset_asset) as assets from ".MPREFIX."gold_asset group by gasset_user_id order by assets desc limit 0,".$pref['goldaddon_topassetcount'].";");
while($as = $sql->db_fetch()){
$user = @mysql_query("select user_name from ".MPREFIX."user where user_id='".$as['gasset_user_id']."'");
$user = mysql_fetch_array($user);

$mem = "".$gold_obj->show_orb($as['gasset_user_id'])."";
$assets = "".$as['assets']."";
$n++;


$topassetmems_text .= "<tr>
                <td style='width:'>".$n.".</td>
                <td style='width:'><a href='".e_BASE."user.php?id.".$as['gasset_user_id']."'>".$mem."</a></td>
                <td style='width:'>".$assets."</td>
                </tr>";}
          
 

$topassetmems_text .= "</table>
                ";



$topassetmems_title = "Top ".$pref['goldaddon_topassetcount']." Asset Members";

$ns -> tablerender($topassetmems_title, $topassetmems_text);
?>




