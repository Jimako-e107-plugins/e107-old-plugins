<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
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

include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
$config_category = REVIEWER_N01;
$config_events = array('reviewer' => REVIEWER_N02,'editreviewer' => REVIEWER_N08,'reviewer_newitem'=>REVIEWER_N09,'reviewer_edititem'=>REVIEWER_N10);

if (!function_exists('notify_reviewer'))
{
    function notify_reviewer($data)
    {
        global $nt;
        $message = "<strong>" . REVIEWER_N03 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . REVIEWER_N04 . ':</strong> ' . $data['itemtitle'] . "<br /><br />";
        $message .= "<strong>".REVIEWER_N06."</strong> ".$data['itemname']."<br /><strong>" . REVIEWER_N05 . "</strong> " . $data['catname'] . "<br /><br />";
        $nt->send('reviewer', REVIEWER_N02, $message);
    }
}
if (!function_exists('notify_editreviewer'))
{
    function notify_editreviewer($data)
    {
        global $nt;
        $message = "<strong>" . REVIEWER_N03 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . REVIEWER_N04 . ':</strong> ' . $data['itemtitle'] . "<br /><br />";
        $message .= "<strong>".REVIEWER_N06."</strong> ".$data['itemname']."<br /><strong>" . REVIEWER_N05 . "</strong> " . $data['catname'] . "<br /><br />";
        $nt->send('editreviewer', REVIEWER_N07, $message);
    }
}
if (!function_exists('notify_reviewer_newitem'))
{
    function notify_reviewer_newitem($data)
    {
        global $nt;
        $message = "<strong>" . REVIEWER_N03 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . REVIEWER_N04 . ':</strong> ' . $data['itemtitle'] . "<br /><br />";
        $message .= "<strong>".REVIEWER_N06."</strong> ".$data['itemdesc']."<br /><br />";
        $nt->send('reviewer_newitem', REVIEWER_N09, $message);
    }
}
if (!function_exists('notify_reviewer_edititem'))
{
    function notify_reviewer_edititem($data)
    {
        global $nt;
        $message = "<strong>" . REVIEWER_N03 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . REVIEWER_N04 . ':</strong> ' . $data['itemtitle'] . "<br /><br />";
        $message .= "<strong>".REVIEWER_N06."</strong> ".$data['itemdesc']."<br /><br />";
        $nt->send('reviewer_edititem', REVIEWER_N10, $message);
    }
}
?>