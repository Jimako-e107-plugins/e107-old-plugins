<?php
/*
Textsizer Menu
Autor:stafex@gmail.com
e107.bg
version:1.1
*/
if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN."textsizer_menu/e_meta.php");
$lan_file = e_PLUGIN."textsizer_menu/languages/".e_LANGUAGE.".php";
include_lan($lan_file);
$text = "<a href='#' onclick='dw_fontSizerDX.adjust(10); return false' title='".TEXTSIZER_LAN_889."'><b>+ A</b></a> | <a href='#' onclick='dw_fontSizerDX.adjust(-10); return false' title='".TEXTSIZER_LAN_890."'><b>- a</b></a>  | <a href='#' onclick='dw_fontSizerDX.reset(); return false' title='".TEXTSIZER_LAN_891."'><b>".TEXTSIZER_LAN_891."</b></a>";
$title = TEXTSIZER_LAN_888;
$ns->tablerender($title, $text);
?>