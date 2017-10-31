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

    require_once("../../class2.php");
    if (!getperms("P")) {
        header("location:".e_BASE);
        die;
    }
    require_once(e_ADMIN."auth.php");
    
    include_once(e_PLUGIN.'random_avatar_menu/languages/'.e_LANGUAGE.'.php');
    include_once(e_PLUGIN.'random_avatar_menu/languages/English.php');
    
    if (isset($_POST['submitbutton']))
    {
        $pref['rndava_freq'] = $tp->toDB($_POST['rndava_freq']);
        $pref['rndava_user_limit'] = intval($_POST['rndava_user_limit']);
        $pref['rndava_display_caption'] = $tp->toDB($_POST['rndava_display_caption']);
        
        $pref['rndava_exclude'] = array();
        foreach($_POST as $key => $value)
        {
            if ((substr($key,0,15) == 'rndava_exclude_') && ($value != ''))
            {
                array_push($pref['rndava_exclude'], $tp->toDB($value));
            }
        }
        
        if (($_POST['rndava_text_align']) && (strpos('none display real custom',$_POST['rndava_display_name']) !== FALSE))
        {
            $pref['rndava_display_name'] = $_POST['rndava_display_name'];
        }
        
        $pref['rndava_display_link'] = (isset($_POST['rndava_display_link'])) ? TRUE : FALSE;
        
        if (($_POST['rndava_text_align']) && (strpos('left center right',$pref['rndava_text_align']) !== FALSE))
        {
            $pref['rndava_text_align'] = $_POST['rndava_text_align'];
        }
        
        $pref['rndava_horizontal'] = (isset($_POST['rndava_horizontal'])) ? TRUE : FALSE;
        
        save_prefs();
        
        require_once(e_PLUGIN.'random_avatar_menu/updater.php');
        update_random_avatar();
    }
    
    $text = '';
    
    require_once(e_HANDLER.'form_handler.php');
    
    $text .= form::form_open('POST',e_SELF);
    $text .= "<table class='fborder' width='90%'>";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_102."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_select_open('rndava_freq').
            form::form_option(LAN_RNDAVA_SEC,($pref['rndava_freq'] == 's') ? TRUE : FALSE,'s').
            form::form_option(LAN_RNDAVA_HOUR,($pref['rndava_freq'] == 'h') ? TRUE : FALSE,'h').
            form::form_option(LAN_RNDAVA_DAY,($pref['rndava_freq'] == 'd') ? TRUE : FALSE,'d').
            form::form_option(LAN_RNDAVA_WEEK,($pref['rndava_freq'] == 'w') ? TRUE : FALSE,'w').
            form::form_option(LAN_RNDAVA_MONTH,($pref['rndava_freq'] == 'm') ? TRUE : FALSE,'m').
            form::form_select_close().
        "</td>\n</tr>";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_103."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_text('rndava_user_limit',20,$pref['rndava_user_limit'],100).
        "</td>\n</tr>";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_104."</td>\n<td class='forumheader3' style='width:50%'>";
    $i = 0;
    foreach ($pref['rndava_exclude'] as $exclude)
    {
        $text .= form::form_text('rndava_exclude_'.$i,20,$pref['rndava_exclude'][$i],100)."<br />\n";
        $i++;
    }
    $text .= form::form_text('rndava_exclude_'.$i,20,'',100);
    $text .= "</td>\n</tr>\n";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_105."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_select_open('rndava_display_name').
            form::form_option(LAN_RNDAVA_113,($pref['rndava_display_name'] == 'none') ? TRUE : FALSE, 'none').
            form::form_option(LAN_RNDAVA_114,($pref['rndava_display_name'] == 'display') ? TRUE : FALSE, 'display').
            form::form_option(LAN_RNDAVA_115,($pref['rndava_display_name'] == 'real') ? TRUE : FALSE, 'real').
            form::form_option(LAN_RNDAVA_116,($pref['rndava_display_name'] == 'custom') ? TRUE : FALSE, 'custom').
            form::form_select_close().
        "</td>\n</tr>\n";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_106."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_checkbox('rndava_display_link','',($pref['rndava_display_link']) ? TRUE : FALSE).
        "</td>\n</tr>\n";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_107."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_text('rndava_display_caption',20,$pref['rndava_display_caption'],100).
        "</td>\n</tr>\n";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_109."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_select_open('rndava_text_align').
            form::form_option(LAN_RNDAVA_110,($pref['rndava_text_align'] == 'left') ? TRUE : FALSE, 'left').
            form::form_option(LAN_RNDAVA_111,($pref['rndava_text_align'] == 'center') ? TRUE : FALSE, 'center').
            form::form_option(LAN_RNDAVA_112,($pref['rndava_text_align'] == 'right') ? TRUE : FALSE, 'right').
            form::form_select_close().
        "</td>\n</tr>\n";
    
    $text .= "<tr>\n<td class='forumheader3' style='width:50%'>".LAN_RNDAVA_117."</td>\n<td class='forumheader3' style='width:50%'>".
            form::form_checkbox('rndava_horizontal','',($pref['rndava_horizontal']) ? TRUE : FALSE).
        "</td>\n</tr>\n";
    
    $text .= "<tr><td class='forumheader3' colspan='2' style='text-align: center'>"
            .form::form_button("submit", "submitbutton", LAN_RNDAVA_108)."</td>
        </tr>\n";
    
    $text .= "</table>";
    
    require_once(e_ADMIN."header.php");
    
    $ns->tablerender(LAN_RNDAVA_101, $text);
    
    require_once(e_ADMIN."footer.php");

?>