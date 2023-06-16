<?php
/*
*************************************
*        Visitors Book				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
require_once("../../class2.php");
require_once(HEADERF);
include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");

// Grundeinstellungen laden
$vibo_pref=mysql_query("SELECT * FROM ".MPREFIX."visitors_book_prefs WHERE admin>'-1'");
$vibo_pref=mysql_fetch_array($vibo_pref);
// Moderatorinformation
if(check_class($vibo_pref['admin'])) {} else {header("location:".e_BASE."index.php");exit;}
// Löschen
$sql->db_Select_gen("DELETE FROM ".MPREFIX."visitors_book WHERE id=".$_GET['id']."");
$message=VIBO_LAN_33;
// Inhalt
$caption=VIBO_LAN_33;
$text="
<p style='text-align:center'>".$message."</p>
<p style='text-align:center'>
<a href='visitors_book.php' class='button'>".VIBO_LAN_08."</a>
</p>
";
$ns -> tablerender($caption, $text); 
require_once(FOOTERF); 
?> 