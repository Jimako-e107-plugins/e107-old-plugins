<?php
/*
*************************************
*        PPGallery					*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
if (!isset($pref['plug_installed']['ppgallery'])) {return;}
include_lan(e_PLUGIN."ppgallery/languages/".e_LANGUAGE."/plugin.php");

echo "
<link rel='stylesheet' type='text/css' href='".e_PLUGIN."ppgallery/stuff/prettyPhoto.css'/>
<link rel='stylesheet' type='text/css' href='".e_PLUGIN."ppgallery/stuff/style.css'/>
<script src='".e_PLUGIN."ppgallery/stuff/script.js' type='text/javascript'></script>
<script src='".e_PLUGIN."ppgallery/stuff/prettyPhoto.js' type='text/javascript'></script>
";

$inc="<br /><br /><center>".POWERED." <a href='http://oyabunstyle.de' onclick='window.open(this.href);return false;'>Oyabunstyle.de</a></center>";
?>