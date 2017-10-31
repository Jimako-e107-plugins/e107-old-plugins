<?php

/*
 Random Avatar Menu displays a random user avatar in a menu
 Copyright (C) 2007 Eugen Beck (alias Killerpope) (http://killerpopes-world.com)
 
 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version. 

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN.'random_avatar_menu/updater.php');
update_random_avatar();

require_once(e_HANDLER."avatar_handler.php");
$text = "<table style='border: 0px; text-align: {$pref['rndava_text_align']}; width: 100%;'>\n";
if ($pref['rndava_horizontal']) {
    $text .= "<tr>\n";
    if (($pref['rndava_text_align'] == "right") || ($pref['rndava_text_align'] == "center")) {
        $text .= "<td></td>";
    }
}
foreach($pref['rndava_user_id'] as $user_id)
{
    $user = get_user_data($user_id);
    if (!$pref['rndava_horizontal']) {
        $text .= "<tr>\n";
    }
    $text .= "<td style='width: {$pref['im_width']}px'>\n";
    
    if ($pref['rndava_display_link'])
    {
        $text .= '<a href="'.SITEURL.'user.php?id.'.$user['user_id'].'">';
    }
    $text .= '<img src="'.avatar($user['user_image']).'" /><br />';
    switch ($pref['rndava_dispaly_name'])
    {
        case 'none'   : break;
        case 'display': $text .= $user['user_name']; break;
        case 'real'   : $text .= ($user['user_login'] != '') ? $user['user_name'] : $user['user_login']; break;
        case 'custom' : $text .= ($user['user_login'] != '') ? $user['user_name'] : $user['user_customtitle']; break;
        default: $text .= $user['user_name'];
    }
    if ($pref['rndava_display_link'])
    {
        $text .= "</a>\n";
    }
    
    $text .= "</td>\n";
    if (!$pref['rndava_horizontal']) {
        $text .= "</tr>\n";
    }
}
if ($pref['rndava_horizontal']) {
    if (($pref['rndava_text_align'] == "left") || ($pref['rndava_text_align'] == "center")) {
        $text .= "<td></td>";
    }
    $text .= "</tr>\n";
}
$text .= "</table>\n";
$ns->tablerender($pref['rndava_display_caption'], $text, 'random_avatar_menu');

?>