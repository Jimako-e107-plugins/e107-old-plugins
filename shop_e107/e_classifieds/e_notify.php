<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
   exit;
}

include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');

$config_category = ECLASSF_A43;
$config_events = array('eclassfpost' => ECLASSF_A44);
if (!function_exists('notify_eclassfpost'))
{
    function notify_eclassfpost($data)
    {
        global $nt;

        if ($data['action'] = 'update')
        {
            $message = "<strong>" . ECLASSF_A49 . ': </strong>' . $data['user'] . '<br />';
        }
        else
        {
            $message = "<strong>" . ECLASSF_A45 . ': </strong>' . $data['user'] . '<br />';
        }
        $message .= "<strong>" . ECLASSF_A46 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . ECLASSF_A48 ;
        $message .= ' ' . ECLASSF_A47 . ' ' . $data['catid'] . '<br /><br />';
        $nt->send('eclassfpost', ECLASSF_A44, $message);
    }
}

?>