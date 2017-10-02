<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

global $otd_obj;
if (!is_object($otd_obj))
{
    require_once(e_PLUGIN . "onthisday_menu/includes/onthisday_class.php");
    $otd_obj = new onthisday;
}

$config_category = OTD_002;
$config_events = array('onthisday_menupost' => OTD_003, 'onthisday_menuupdate' => OTD_004);

if (!function_exists('notify_onthisday_menupost'))
{
    function notify_onthisday_menupost($data)
    {
        global $nt;
        $message = "<strong>" . OTD_005 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . OTD_006 . ':</strong> ' . $data['otd_brief'] . "<br /><br />" ;
        $message .= " " . OTD_007 . " " . $data['date'] . "<br /><br />";
        $nt->send('onthisday_menupost', OTD_008, $message);
    }
}
if (!function_exists('notify_onthisday_menuupdate'))
{
    function notify_onthisday_menuupdate($data)
    {
        global $nt;
        $message = "<strong>" . OTD_005 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . OTD_006 . ':</strong> ' . $data['otd_brief'] . "<br /><br />" ;
        $message .= " " . OTD_007 . " " . $data['date'] . "<br /><br />";
        $nt->send('onthisday_menuupdate', OTD_009, $message);
    }
}

?>