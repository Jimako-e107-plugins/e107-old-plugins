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

if (!defined('e107_INIT')) { exit; };

function update_random_avatar()
{
    global $pref, $tp, $sql;
    
    switch($pref['rndava_freq'])
    {
        case 's': $time = date('is'); break;
        case 'h': $time = date('H'); break;
        case 'd': $time = date('z'); break;
        case 'w': $time = date('W'); break;
        case 'm': $time = date('m'); break;
        default: $time = date('is');
    }
    
    if ($pref['rndava_timestamp'] != $time)
    {
        $pref['rndava_timestamp'] = $time;
        
        if ($pref['rndava_exclude'] != '')
        {
            $add_qry = 'AND (user_image NOT IN ("'.implode('","',$tp->toDB($pref['rndava_exclude'])).'"))';
        }
        else
        {
            $add_qry = '';
        }
        
        if ($sql->db_Select('user', 'user_id, user_image',"(user_image != '') {$add_qry} ORDER BY RAND() LIMIT ".intval($pref['rndava_user_limit'])))
        {
            $pref['rndava_user_id'] = array();
            while($user = $sql->db_Fetch())
            {
                array_push($pref['rndava_user_id'],$user['user_id']);
            }
        }
        
        save_prefs();
    }
}

?>