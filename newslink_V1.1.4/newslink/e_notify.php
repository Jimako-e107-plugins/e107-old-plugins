<?php
include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");
if (defined('ADMIN_PAGE') && ADMIN_PAGE === true)
{
    $config_category = NEWSLINK_A90;
    $config_events = array('newslinkedit' => NEWSLINK_A99, 'newslinkpost' => NEWSLINK_A91);
}

if (!function_exists('notify_newslinkpost'))
{
    function notify_newslinkpost($data)
    {
        global $nt;
        $message = "<strong>" . NEWSLINK_A92 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . NEWSLINK_A94 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . NEWSLINK_A93 ;
        $message .= " " . NEWSLINK_A95 . " " . $data['catid'] . "<br /><br />";
        $nt->send('newslinkpost', NEWSLINK_A91, $message);
    }
}
if (!function_exists('notify_newslinkedit'))
{
    function notify_newslinkedit($data)
    {
        global $nt;
        $message = "<strong>" . NEWSLINK_A100 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . NEWSLINK_A94 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . NEWSLINK_A93 ;
        $message .= " " . NEWSLINK_A95 . " " . $data['catid'] . "<br /><br />";
        $nt->send('newslinkedit', NEWSLINK_A91, $message);
    }
}

?>