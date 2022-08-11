<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Barry (recipe @ keal.me.uk)
|
|        v2.00 modifications foodisfunagain.com allergy support
|
|        This module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "recipe_menu/languages/admin/English.php");
} 
$config_category = RCPEMENU_A90;
$config_events = array('rcppost' => RCPEMENU_A91);

if (!function_exists('notify_rcppost'))
{
    function notify_rcppost($data)
    {
        global $nt;
        $message = "<strong>".RCPEMENU_A92 . ': </strong>' . $data['user'] . '<br />';
        $message .= "<strong>" . RCPEMENU_A94 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . RCPEMENU_A93 ;
        $message .= " ".RCPEMENU_A95." ".$data['catid']."<br /><br />";
		$nt->send('rcppost', RCPEMENU_A91, $message);
    } 
} 

?>