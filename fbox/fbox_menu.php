<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: fbox_menu.php 671 2007-11-16 12:16:55Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
global $tp, $fbox_shortcodes;

if(!check_class($pref['fbox_permission']))
    return '';

$lan_file = e_PLUGIN."fbox/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

$mtmpl = $pref['fbox_menutmpl'] ? '&use_template='. $pref['fbox_menutmpl'] : '';

$text = $tp -> parseTemplate('{FBOX=get_one=1&random=1&tablerender=0&render_mod=fbox_menu'.$mtmpl.'}');

$nav = '';
if($pref['fbox_js'] && $text)
    $nav = '<br /><br />'.$tp -> parseTemplate('{FBOX=random=1&navigation=1'.$mtmpl.'}');

if($text)  {
    $text = "<div id='fbox-cont'>".$text."</div>".$nav;
    $ns -> tablerender(FBOX_MENU_1, $text, 'fbox');
}
?>