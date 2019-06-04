<?php

if (!defined('e107_INIT')) { exit; }

include_once(e_PLUGIN."ticker/languages/".e_LANGUAGE.".php");

$mydb = new db();
$mydb->db_select_gen("SELECT COUNT(id) FROM `".MPREFIX."ticker` WHERE `".MPREFIX."ticker`.`cat` != 'new'");
$tmp = $mydb->db_fetch();
$ticks = $tmp[0];

$text .= "<div style='padding-bottom: 2px;'><img src='".e_PLUGIN."ticker/images/ticker16.png' style='width: 16px; height: 16px; vertical-align: bottom' alt='' /> ".LAN_TICKS_STATUS." ".$ticks."</div>";

?>