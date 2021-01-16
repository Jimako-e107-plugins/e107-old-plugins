<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
global $pref;
include_lan(e_PLUGIN."e_version/languages/".e_LANGUAGE.".php");

require_once(e_HANDLER . "userclass_class.php");
$evrsn_conv = new convert;
$evrsn_db = new DB;

if (is_readable(THEME . "eversion_template.php"))
{
    require_once(THEME . "eversion_template.php");
}
else
{
    require_once(e_PLUGIN . "e_version/eversion_template.php");
}
require_once(e_PLUGIN . "e_version/eversion_shortcodes.php");
require_once(HEADERF);

if (e_QUERY)
{
    $evrsn_tmp = explode(".", e_QUERY);
    $evrsn_from = $evrsn_tmp[0];
    $evrsn_action = $evrsn_tmp[1];
    $evrsn_id = $evrsn_tmp[2];
}
if (!$evrsn_from > 0)
{
    $evrsn_from = 0;
}
switch ($evrsn_action)
{
    case "view":
        $evrsn_db->db_Select("eversion", "*", "eversion_id=$evrsn_id");
        $evrsn_row = $evrsn_db->db_Fetch();
        #extract($evrsn_row);

        $evrsn_text .= $tp->parseTemplate($EVRSN_SHOW_PRE,false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($EVRSN_SHOW_HEADER,false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($EVRSN_SHOW_DETAIL,false, $eversion_shortcodes);
		$evrsn_text .= $tp->parseTemplate($EVRSN_SHOW_FOOTER,true, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($EVRSN_SHOW_POST,false, $eversion_shortcodes);
        break;
    case "list":
    default:
        if (!$pref['eversion_noplug'] > 0)
        {
            $pref['eversion_noplug'] = 10;
        }
        $evrsn_text .= $tp->parseTemplate($EVRSN_LIST_PRE,false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($EVRSN_LIST_HEAD,false, $eversion_shortcodes);
        if ($evrsn_db->db_Select("eversion", "*", " order by eversion_name limit $evrsn_from," . $pref['eversion_noplug'], "nowhere"))
        {
            while ($evrsn_row = $evrsn_db->db_Fetch())
            {
                extract($evrsn_row);
                $evrsn_text .= $tp->parseTemplate($EVRSN_LIST_LIST,false, $eversion_shortcodes);
            } // while
        }
        $evrsn_text .=$tp->parseTemplate($EVRSN_LIST_FOOTER,false, $eversion_shortcodes);
        $evrsn_text .=$tp->parseTemplate($EVRSN_LIST_POST,false, $eversion_shortcodes);
} // switch
$ns->tablerender(EVERSION_4, $evrsn_text);
require_once(FOOTERF);

?>