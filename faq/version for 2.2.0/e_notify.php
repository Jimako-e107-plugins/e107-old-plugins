<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php");
$config_category = FAQLAN_88;
$config_events = array('faqpost' => FAQLAN_87);

if (!function_exists('notify_faqpost'))
{
    function notify_faqpost($faqdata)
    {
        global $nt;
        $message = "<strong>" . FAQLAN_89 . ': </strong>' . $faqdata['user'] . '<br />';
        $message .= "<strong>" . FAQLAN_90 . ':</strong> ' . $faqdata['itemtitle'] . "<br /><br />" . FAQLAN_91 ;
        $message .= " " . FAQLAN_92 . " " . $faqdata['catid'] . "<br /><br />";
        $nt->send('faqpost', FAQLAN_88, $message);
    }
}

?>