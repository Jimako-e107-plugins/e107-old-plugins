<?php
//**************************************************************************
//*
//*  Newslinks Menu for e107 v7xx
//*
//**************************************************************************

include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = NEWSLINK_A1;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_cat']['text'] = NEWSLINK_A3;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_submit']['text'] = NEWSLINK_A4;
$var['admin_submit']['link'] = "admin_submit.php";

$var['admin_readme']['text'] = NEWSLINK_A111;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = NEWSLINK_A96;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(NEWSLINK_A2, $action, $var);

?>