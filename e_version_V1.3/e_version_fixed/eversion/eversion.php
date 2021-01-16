<?php

require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}

global $pref;

//e107::lan('eversion', true); 
//e107::lan('eversion', false, true); 
e107::lan('eversion');

require_once(e_HANDLER."userclass_class.php");
$evrsn_conv = new convert;
$evrsn_db = new DB;

 
$eversion_template   = e107::getTemplate('eversion'); 
$eversion_shortcodes = e107::getScBatch('eversion');
 
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
        $eversion_shortcodes->setVars($evrsn_row);	
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_SHOW_PRE'],false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_SHOW_HEADER'],false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_SHOW_DETAIL'],false, $eversion_shortcodes);
		$evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_SHOW_FOOTER'],true, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_SHOW_POST'],false, $eversion_shortcodes);
        break;
    case "list":
    default:
        if (!$pref['eversion_noplug'] > 0)
        {
            $pref['eversion_noplug'] = 10;
        }
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_LIST_PRE'],false, $eversion_shortcodes);
        $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_LIST_HEAD'],false, $eversion_shortcodes);
        if ($evrsn_db->db_Select("eversion", "*", " order by eversion_name limit $evrsn_from," . $pref['eversion_noplug'], "nowhere"))
        {
            while ($evrsn_row = $evrsn_db->db_Fetch())
            {
                $evrsn_row['evrsn_from'] =  $evrsn_from;
								$eversion_shortcodes->setVars($evrsn_row);
 
                $evrsn_text .= $tp->parseTemplate($eversion_template['EVRSN_LIST_LIST'],false, $eversion_shortcodes);
            } // while
        }
        $evrsn_text .=$tp->parseTemplate($eversion_template['EVRSN_LIST_FOOTER'],false, $eversion_shortcodes);   
        $evrsn_text .=$tp->parseTemplate($eversion_template['EVRSN_LIST_POST'],false, $eversion_shortcodes);   
} // switch
$ns->tablerender(EVERSION_4, $evrsn_text);
require_once(FOOTERF);

?>