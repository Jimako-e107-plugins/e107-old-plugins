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
if (!isset($pref['plug_installed']['visitors_book'])) {return;}

echo "
<script src='".e_PLUGIN."visitors_book/stuff/scripts.js' type='text/javascript'></script>
";
?>