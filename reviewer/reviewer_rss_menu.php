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
global $PLUGINS_DIRECTORY, $pref;
if ($pref['plug_installed']['rss_menu'])
{
    include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
    $reviewermenu_text = '<div style="text-align:center" >' . REVIEWER_RSS07 . '<br /><br /><b>' . REVIEWER_RSS08 . '</b><br />
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.1.items"><img src="' . e_PLUGIN . 'rss_menu/images/rss1.png" style="border:0px" /></a>
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.2.items"><img src="' . e_PLUGIN . 'rss_menu/images/rss2.png" style="border:0px" /></a><br />
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.3.items"><img src="' . e_PLUGIN . 'rss_menu/images/rss3.png" style="border:0px" /></a>
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.4.items"><img src="' . e_PLUGIN . 'rss_menu/images/rss4.png" style="border:0px" /></a>';

    $reviewermenu_text .= '<br /><br /><b>' . REVIEWER_RSS09 . '</b><br />
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.1.reviews"><img src="' . e_PLUGIN . 'rss_menu/images/rss1.png" style="border:0px" /></a>
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.2.reviews"><img src="' . e_PLUGIN . 'rss_menu/images/rss2.png" style="border:0px" /></a><br />
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.3.reviews"><img src="' . e_PLUGIN . 'rss_menu/images/rss3.png" style="border:0px" /></a>
<a href="' . SITEURL . $PLUGINS_DIRECTORY . 'rss_menu/rss.php?reviewer.4.reviews"><img src="' . e_PLUGIN . 'rss_menu/images/rss4.png" style="border:0px" /></a>
</div>';
}
else
{
    return;
}

$ns->tablerender(REVIEWER_RSS06, $reviewermenu_text,'reviewer_rss');
