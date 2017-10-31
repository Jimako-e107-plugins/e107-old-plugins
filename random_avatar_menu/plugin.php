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

    $eplug_folder       = "random_avatar_menu";
    
    include_once(e_PLUGIN.$eplug_folder."/languages/".e_LANGUAGE.".php");
    include_once(e_PLUGIN.$eplug_folder."/languages/English.php");
    
    $eplug_name         = "Random Avatar Menu";
    $eplug_version      = "0.2.2";
    $eplug_author       = "Eugen Beck(alias Killerpope)";
    $eplug_url          = "http://killerpopes-world.com";
    $eplug_email        = "killerpope68@yahoo.de";
    $eplug_description  = LAN_RNDAVA_1;
    $eplug_compatible   = "e107v0.7+";
    $eplug_readme       = "";
    $eplug_compliant    = FALSE;
    $eplug_conffile     = "admin_config.php";
    $eplug_caption      = LAN_RNDAVA_2;
    
    $eplug_icon = $eplug_folder."/images/logo_32.png";
    $eplug_icon_small = $eplug_folder."/images/logo_16.png";
    
    $eplug_done         = LAN_RNDAVA_3;
    $eplug_upgrade_done = LAN_RNDAVA_4;
    
    $eplug_prefs = array(
        "rndava_freq" => 'd',
        "rndava_user_id" => array(),
        "rndava_user_limit" => 1,
        "rndava_timestamp" => date('d'),
        "rndava_exclude" => array(),
        "rndava_display_name" => "display",
        "rndava_display_link" => true,
        "rndava_display_caption" => LAN_RNDAVA_5,
        "rndava_text_align" => "center",
        "rndava_horizontal" => false,
    );
    
    $upgrade_add_prefs = array (
        "rndava_text_align" => "center",
        "rndava_horizontal" => false,
    );
    
    $upgrade_remove_prefs = array();
    
    if (!function_exists('random_avatar_menu_install'))
    {
        require_once(e_PLUGIN.$eplug_folder.'/updater.php');
        function random_avatar_menu_install()
        {
            update_random_avatar();
        }
    }
?>