<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
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
global $GOLD_PREF, $gold_obj, $pref, $PLUGINS_DIRECTORY,$gold_shortcodes,$forum_shortcodes;
if (!isset($pref['plug_installed']['gold_system']))
{
    return ;
}

echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'gold_system/includes/gold_system.css" type="text/css" />';
echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'gold_system/includes/tabview/css/dynamic_list.css" type="text/css" />';
echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'gold_system/includes/tabview/css/tab-view.css" type="text/css" />';
echo '<link rel="stylesheet" href="' . e_PLUGIN_ABS . 'gold_system/includes/bubble/css/bubble-tooltip.css" type="text/css"  media="screen" />';

echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/gold_system.js"></script>';

echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/tabview/js/ajax.js"></script>';
echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/tabview/js/ajax-dynamic-list.js"></script>';
echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/tabview/js/tab-view.js"></script>';
echo '<script type="text/javascript" src="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/includes/bubble/js/bubble-tooltip.js"></script>';

require_once(e_PLUGIN . 'gold_system/includes/gold_class.php');

require_once(e_HANDLER . 'userclass_class.php');
if (!is_object($gold_obj))
{
    $gold_obj = new gold;
}

if (e_PAGE == 'user.php')
{
    $gold_uuid = intval($qs[1]);
    $goldID = $gold_obj->gold_balance($gold_uuid);
    $gold_linkHist = "";
    $sql->db_Select("plugin", "plugin_id", "plugin_name = 'Gold System'");
    $gold_plugin_row = $sql->db_Fetch();
    $gold_pluginid = $gold_plugin_row['plugin_id'];
    if ($gold_uuid == USERID)
    {
        $gold_linkHist = "<a href='" . e_PLUGIN . "gold_system/history.php' ><img src='" . e_IMAGE . "admin_images/prefs_16.png' style='border:0px;' alt='View History'></a>";
    }
    else if (getPerms($gold_pluginid))
    {
        $gold_linkHist = "<a href='" . e_PLUGIN . "gold_system/admin_gold.php?0.history." . $gold_uuid . "'><img src='" . e_IMAGE . "admin_images/prefs_16.png' style='border:0px;' alt='View History'></a>";
    }
    $detect1 = strpos($USER_FULL_TEMPLATE, "{USER_VISITS}");
    $detect2 = strpos($USER_FULL_TEMPLATE, "{USER_UPDATE_LINK}") - 1;
    $detect = $detect2 - $detect1;
    $profile_old = substr($USER_FULL_TEMPLATE, $detect1, $detect);
    $profile_new = "
<tr>
	<td style='width:30%' class='forumheader3'><a href='" . e_PLUGIN . "gold_system/donate.php?{$gold_uuid}'>{$GOLD_PREF['gold_currency_name']}</a></td>
	<td style='width:70%' class='forumheader3'>" . $gold_obj->formation($goldID) . $gold_linkHist . "</td>
</tr>
<tr>
	<td style='width:30%' class='forumheader3'>" . LAN_GS_GM013 . "</td>
	<td style='width:70%' class='forumheader3'>{USER_SPENT}</td>
</tr>";
    $USER_FULL_TEMPLATE = str_replace($profile_old, $gold_form . $profile_old . $profile_new, $USER_FULL_TEMPLATE);
}

if (e_PAGE == 'forum_viewtopic.php' && isset($pref['plug_installed']['gold_rpg']) && $gold_obj->plugin_active('gold_rpg'))
{
    // detect if rpg installed.
    #$gold_rpg = false;

    #$gold_rpg = true;
    if (!is_object($grpg_obj))
    {
        include_lan(e_PLUGIN . 'gold_rpg/languages/' . e_LANGUAGE . '.php');
        require_once(e_PLUGIN . 'gold_rpg/includes/gold_rgp_class.php');
        $grpg_obj = new gold_rpg;
    }
    // get the template for the forum
    if (file_exists(THEME . 'forum_viewtopic_template.php'))
    {
        // if the theme has a forum topic then get that
        require_once(THEME . 'forum_viewtopic_template.php');
    }
    else
    {
        require_once(e_PLUGIN . 'forum/templates/forum_viewtopic_template.php');
    }
    // get location in forumthreadstyle
    $detect1 = strpos($FORUMTHREADSTYLE, "{CUSTOMTITLE}");
    $detect2 = strpos($FORUMTHREADSTYLE, "{POSTS}") + 7;
    $detect = $detect2 - $detect1;
    $forum_old = substr($FORUMTHREADSTYLE, $detect1, $detect);
    // get location in forumreplystyle
    $detectr1 = strpos($FORUMREPLYSTYLE, "{CUSTOMTITLE}");
    $detectr2 = strpos($FORUMREPLYSTYLE, "{POSTS}") + 7;
    $detectr = $detectr2 - $detectr1;
    $forum_rold = substr($FORUMREPLYSTYLE, $detectr1, $detectr);
    // prepare for new layout
    $layout_1 = '';
    $layout_2 = '';

    for ($i = 1; $i <= 12; $i++)
    {
        switch ($GOLD_PREF["forum_layout_{$i}"])
        {
            case 'custom_title':
                $layout_1 .= "{CUSTOMTITLE}";
                break;
            case 'avatar':
                $layout_1 .= "{AVATAR}";
                break;
            case 'stars':
                $layout_2 .= "{LEVEL=pic}";
                break;
            case 'rank':
                $layout_2 .= "{LEVEL=name}";
                break;
            case 'moderator':
                $layout_2 .= "{LEVEL=special}";
                break;
            case 'member':
                $layout_2 .= "{MEMBER}";
                break;
            case 'rpg':
                if ($gold_rpg)
                {
                    $layout_2 .= "{RPGX}";
                }
                break;
            case 'joined':
                $layout_2 .= "{JOINEDX=j-M-Y}";
                break;
            case 'location':
                $layout_2 .= "{$location_tpl}<br />";
                break;
            case 'posts':
                $layout_2 .= "{POSTS}";
                break;
            case 'gold':
                $layout_2 .= "{FORUMGOLD}<br />";
                break;
            case 'spent':
                $layout_2 .= "{SPENT}<br />";
                break;
        }
    }
    $forum_new = $layout_1 . '<div class="smalltext">' . $layout_2 . '</div>';
    $FORUMTHREADSTYLE = str_replace($forum_old, $forum_new, $FORUMTHREADSTYLE);
    $FORUMREPLYSTYLE = str_replace($forum_rold, $forum_new, $FORUMREPLYSTYLE);
    $FORUMEND = $FORUMEND . $gold_form;
}

?>