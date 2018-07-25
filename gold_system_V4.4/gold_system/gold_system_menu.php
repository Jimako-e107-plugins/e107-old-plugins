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
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_gold_system.php');
if (!defined('e107_INIT'))
{
    exit;
}
global $GOLD_PREF, $sql2, $gold_obj, $grpg_obj, $tp, $PLUGINS_DIRECTORY;
if (!USER)
{
    $gold_text = LAN_GS_GM012 . '<br />';
}
else
{
    if ($GOLD_PREF['gold_showpresent'] == 1 && $gold_obj->plugin_active('gold_present'))
    {
        $gold_present = '<div style="text-align:center;">
		<a href="' . e_PLUGIN . 'gold_present/index.php">' . $tp->parsetemplate('{GOLD_PRESENT_LATEST}') . '</a><br />
		</div>';
    }
    $gold_account .= '
			' . ($GOLD_PREF['gold_mbuy'] == 1?'<a href="' . e_PLUGIN . 'gold_system/buy_gold.php" >' . LAN_GS_GM002 . ' ' . $GOLD_PREF['gold_currency_name'] . '</a><br />':'') . '
			' . ($GOLD_PREF['gold_mdonate'] == 1?'<a href="' . e_PLUGIN . 'gold_system/donate.php" >' . LAN_GS_GM003 . ' ' . $GOLD_PREF['gold_currency_name'] . '</a><br />':'') . '
			' . ($GOLD_PREF['gold_mhistory'] == 1?'<a href="' . e_PLUGIN . 'gold_system/history.php" >' . LAN_GS_GM004 . '</a><br />':'') . '
	';
    $gold_pluglist = $gold_obj->gold_plugins;
    ksort($gold_pluglist);

    foreach($gold_pluglist as $gold_row => $it)
    {
        if ($gold_obj->plugin_active($gold_row) && $GOLD_PREF['gold_menushow'][$gold_row] == 1 && !empty($GOLD_PREF['gold_link'][$gold_row]) && !empty($GOLD_PREF['gold_title'][$gold_row]))
        {
            $gold_link = str_replace('{e_PLUGIN}', e_PLUGIN, $GOLD_PREF['gold_link'][$gold_row]);
            $gold_pluginlist .= '<a href="' . $gold_link . '" >' . $GOLD_PREF['gold_title'][$gold_row] . '</a><br />' ;
        }
    }
    if ($GOLD_PREF['gold_msummary'] == 1)
    {
        $gold_balance = $gold_obj->gold_balance(USERID);
        $gold_summary .= '<b>' . LAN_GS_GM006 . ':</b><div id="gold_mybalance">' . $gold_obj->formation($gold_balance) . '</div>';
        $gold_summary .= '<b>' . LAN_GS_GM013 . ':</b><div id="gold_myspent">' . $gold_obj->formation($gold_obj->gold_spent(USERID)) . '</div>';
        $gold_summary .= '<b>' . LAN_GS_GM008 . ':</b><div id="gold_mycredit">' . $gold_obj->formation($gold_obj->gold_received(USERID)) . '</div>';
    }
    if ($gold_obj->plugin_active('gold_rpg'))
    {
        $gold_rpg = $grpg_obj->rpgx($gold_obj->gold_member[USERID]['user_join'], $gold_obj->gold_member[USERID]['user_forums']) . '<br />';
    }
    if ($GOLD_PREF['gold_mrichest'] > 0)
    {
        unset($gold_richest);
        $gold_arg = 'select user_name,gold_id,gold_orb,gold_balance from #gold_system left join #user on user_id=gold_id ORDER BY gold_balance DESC LIMIT 0,' . $GOLD_PREF['gold_mrichest'];
        if ($fred = $sql2->db_Select_gen($gold_arg, false))
        {
            // $gold_rows = $sql2->db_Fetch();
            // print_a($gold_rows);
            while ($gold_rows = $sql2->db_Fetch())
            {
                $gold_richest .= '<a href="' . e_BASE . 'user.php?id.' . $gold_rows['gold_id'] . '">' . $gold_obj->show_orb($gold_rows['gold_id'], $gold_rows['user_name']) . '</a> ' . $gold_obj->formation($gold_rows['gold_balance']) . '<br />';
            }
        }
    }
    if ($GOLD_PREF["gold_expanding"] != 1)
    {
        $gold_text .= '
	<b>' . LAN_GS_GM001 . '</b>';
        if (isset($gold_present))
        {
            $gold_text .= $gold_present;
        }
        $gold_text .= $gold_account;
        if (isset($gold_summary))
        {
            $gold_text .= $gold_summary;
        }

        if (isset($gold_pluginlist))
        {
            $gold_text .= '
	<b>' . LAN_GS_GM015 . '</b></br>';
            $gold_text .= $gold_pluginlist;
        }

        if (isset($gold_richest))
        {
            $gold_text .= '
	<b>' . LAN_GS_GM011 . '</b><br />';
            $gold_text .= $gold_richest;
        }
        if (isset($gold_rpg))
        {
            $gold_text .= $gold_rpg;
        }
    }
    // do panel
    else
    {
        $gold_text .= '
<div class="fcaption" onclick="gold_menu(\'gold_mine\')" id="gold_mine_div" style="cursor:hand;background-image:url(\'' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/close.png\');background-repeat:no-repeat;background-position:right;" >' . LAN_GS_GM001 . '</div>
	<div id="gold_mine" style="display:;">';
        if (isset($gold_present))
        {
            $gold_text .= $gold_present;
        }
        $gold_text .= $gold_account;
        if (isset($gold_summary))
        {
            $gold_text .= $gold_summary;
        }

        if (isset($gold_pluginlist))
        {
            $gold_text .= '
 	</div>
<div class="fcaption" onclick="gold_menu(\'gold_app\')" id="gold_app_div"  style="cursor:hand;background-image:url(\'' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/close.png\');background-repeat:no-repeat;background-position:right;" >' . LAN_GS_GM015 . '</div>
	<div id="gold_app" style="display:;">';

            $gold_text .= $gold_pluginlist;
            $gold_text .= '
 	</div>';
        }

        if (isset($gold_richest))
        {
            $gold_text .= '
<div class="fcaption" onclick="gold_menu(\'gold_rich\')" id="gold_rich_div" style="cursor:hand;background-image:url(\'' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/close.png\');background-repeat:no-repeat;background-position:right;" >' . LAN_GS_GM011 . '</div>
	<div id="gold_rich" style="display:;">';

            $gold_text .= $gold_richest;
            $gold_text .= '
 	</div>';
        }
        if (isset($gold_rpg))
        {
            $gold_text .= '
<div class="fcaption" onclick="gold_menu(\'gold_rpg\')" id="gold_rpg_div" style="cursor:hand;background-image:url(\'' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/close.png\');background-repeat:no-repeat;background-position:right;" >' . LAN_GS_GM016 . '</div>
	<div id="gold_rpg" style="display:;">';
            $gold_text .= $gold_rpg;
            $gold_text .= '
 	</div>';
        }
        $gold_text .= '
        <script type="text/javascript" >
        var goldmenu_sections = new Array("gold_mine","gold_app"' . (isset($gold_richest)?',"gold_rich"':'') . '' . (isset($gold_rpg) ?',"gold_rpg"':'') . ')
        var goldmenu_open = new Array(true,true,false,false) // initial menu status
        var gold_menu_img_open="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/open.png"
        var gold_menu_img_close="' . SITEURL . $PLUGINS_DIRECTORY . 'gold_system/images/close.png"

gold_menu()
        </script>';
}
}
if (file_exists(e_PLUGIN . 'gold_system/images/gold_menu.png'))
{
$gold_caption = '<img src="' . e_PLUGIN . 'gold_system/images/gold_menu.png" style="border:0px;" alt="' . $GOLD_PREF['gold_currency_name'] . '" /> ' . $GOLD_PREF['gold_currency_name'];
}
else
{
$gold_caption = $GOLD_PREF['gold_currency_name'];
}
$ns->tablerender($gold_caption , $gold_text, 'gold_system');

?>