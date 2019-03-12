<?php
//**************************************************************************
//*
//*  Bug Tracker for e107 v7xx
//*
//**************************************************************************

include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = CWRITER_A3;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_category']['text'] = CWRITER_A8;
$var['admin_category']['link'] = "admin_category.php";

$var['admin_genre']['text'] = CWRITER_A4;
$var['admin_genre']['link'] = "admin_genre.php";

$var['admin_imag']['text'] = CWRITER_A5;
$var['admin_imag']['link'] = "admin_imag.php";

$var['admin_review']['text'] = CWRITER_A6;
$var['admin_review']['link'] = "admin_review.php";

$var['admin_vupdate']['text'] = CWRITER_A7;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(CWRITER_A2, $action, $var);

?>
