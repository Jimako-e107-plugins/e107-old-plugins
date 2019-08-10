<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: e_meta.php 667 2007-11-15 12:49:31Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/
if(!defined('e107_INIT')) { exit; }

if(check_class($pref['fbox_permission']) && (defsettrue('FBOX_JS') || $pref['fbox_js'])) {
    echo "<script src='".e_PLUGIN."fbox/fbox_switch.js' type='text/javascript'></script>";
    echo "<script type='text/javascript'> fboxCheckeAjax('".e_FILE_ABS."e_ajax.js'); </script>";
}
?>