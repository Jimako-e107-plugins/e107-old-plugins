<?php
/*
+---------------------------------------------------------------+
|	Portfolio Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");
#global $portfolio_obj;
#require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
#if (!is_object($portfolio_obj))
#{

#    $portfolio_obj = new portfolio;
#}
$config_category = PORTFOLIO_NOT_01;
$config_events = array('portfolio_new' => PORTFOLIO_NOT_02, 'portfolio_update' => PORTFOLIO_NOT_03);

if (!function_exists('notify_portfolio_new'))
{
    function notify_portfolio_new($data)
    {
        global $nt,$PLUGINS_DIRECTORY;

        $message = "<strong>" . PORTFOLIO_NOT_04 . ': </strong>' . $data['user'] . '<br />';

        $message .= "<strong>" . PORTFOLIO_NOT_05 . ':</strong> ' . $data['itemtitle'] . "<br /><br />"  ;
        $message .= "<strong>" . PORTFOLIO_NOT_06 . ':</strong> ' . $data['biography'] . "<br /><br />" ;
        $message .= "<a href='".SITEURL.$PLUGINS_DIRECTORY."portfolio/portfolio.php?0.show.".$data['itemid']."'>" . PORTFOLIO_NOT_09 . "</a><br /><br />" ;
        $message .= "<br /><br />";
        $nt->send('portfolio_new', PORTFOLIO_NOT_07, $message);
    }
}

if (!function_exists('notify_portfolio_update'))
{
    function notify_portfolio_update($data)
    {
        global $nt,$PLUGINS_DIRECTORY;

        $message = "<strong>" . PORTFOLIO_NOT_04 . ': </strong>' . $data['user'] . '<br />';

        $message .= "<strong>" . PORTFOLIO_NOT_05 . ':</strong> ' . $data['itemtitle'] . "<br /><br />"  ;
        $message .= "<strong>" . PORTFOLIO_NOT_06 . ':</strong> ' . $data['biography'] . "<br /><br />";
        $message .= "<a href='".SITEURL.$PLUGINS_DIRECTORY."portfolio/portfolio.php?0.show.".$data['itemid']."'>" . PORTFOLIO_NOT_09 . "</a><br /><br />" ;
		$nt->send('portfolio_update', PORTFOLIO_NOT_08, $message);
    }
}

?>