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
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');

if (e_QUERY)
{
    $gold_tmp = explode('.', e_QUERY);
    $gold_action = $gold_tmp[0];
    $gold_plugin = $gold_tmp[1];
} elseif (isset($_POST['gold_save']))
{
    $gold_action = 'gold_save';
    $gold_plugin = $_POST['gold_plugin'];
}
if (!empty($gold_plugin))
{
    require_once(e_PLUGIN . $gold_plugin . '/e_gold.php');
    if ($gold_action == 'gold_edit')
    {
        $tmp = $gold_plugin . '_configure_edit';
        if (function_exists($tmp))
        {
            $gold_text = $tmp();
        }
    }
    if ($gold_action == 'gold_save')
    {
        $tmp = $gold_plugin . '_configure_save';

        if (function_exists($tmp))
        {
            $gold_msg = $tmp();
            $gold_action = '';
        }
    }
}
// *****************************************************************************************************
// *
// *	Update the main list of gold enabled plugins
// *
// *****************************************************************************************************
if (isset($_POST['updatesettings']))
{
    $GOLD_PREF['gold_installed'] = ($_POST['gold_pluginstalled']);
    $GOLD_PREF['gold_title'] = ($_POST['gold_title']);
    $GOLD_PREF['gold_link'] = ($_POST['gold_link']);
    $GOLD_PREF['gold_menushow'] = ($_POST['gold_menushow']);
    $GOLD_PREF['gold_centreshow'] = ($_POST['gold_centreshow']);
    $gold_obj->save_prefs();
    $gold_msg = ADLAN_GS_MP11;
}
#print_a($_POST);
// *****************************************************************************************************
// *
// *	Display list of plugins that are installed which have e_gold.php
// *
// *****************************************************************************************************
if ($gold_action == '')
{
    $gold_pluglist = $pref['plug_installed'];
    ksort($gold_pluglist);
    // print_a($GOLD_PREF['gold_menushow']);
    foreach($gold_pluglist as $gold_plugin => $gold_version)
    {
        if (file_exists(e_PLUGIN . $gold_plugin . '/e_gold.php') && is_readable(e_PLUGIN . $gold_plugin . '/e_gold.php'))
        {
            require_once(e_PLUGIN . $gold_plugin . '/e_gold.php');
        }
    }

    $gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_plugins" >
<table class="fborder" style="' . ADMIN_WIDTH . '" >
	<tr>
		<td class="fcaption" colspan="7" style="text-align:left">' . ADLAN_GS_MP01 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="7" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2" style="width:15%;text-align:left"><b>' . ADLAN_GS_MP02 . '</b></td>
		<td class="forumheader2" style="width:7%;text-align:center"><b>' . ADLAN_GS_MP17 . '</b></td>
		<td class="forumheader2" style="width:7%;text-align:center"><b>' . ADLAN_GS_MP13 . '</b></td>
		<td class="forumheader2" style="width:23%;text-align:left"><b>' . ADLAN_GS_MP14 . '</b></td>
		<td class="forumheader2" style="width:34%;text-align:left"><b>' . ADLAN_GS_MP15 . '</b></td>
		<td class="forumheader2" style="width:7%;text-align:center"><b>' . ADLAN_GS_MP10 . '</b></td>
		<td class="forumheader2" style="width:7%;text-align:center"><b>' . ADLAN_GS_MP04 . '</b></td>
	</tr>';
    foreach($e_gold as $key)
    {
        $gold_text .= '
	<tr>
		<td class="forumheader3" style="text-align:left">' . $key['plug_name'] . '</td>';
        if ($key['gold_menu'])
            // there is a page to link to for the plugin
            $gold_text .= "
        <td class='forumheader3' style='text-align:center'>
			<input type='checkbox' class='tbox' name='gold_centreshow[" . $key['plug_folder'] . "]' value='1' " . ($GOLD_PREF['gold_centreshow'][$key['plug_folder']] == 1 ? "checked='checked'":"") . "/>
		</td>
		<td class='forumheader3' style='text-align:center'>
			<input type='checkbox' class='tbox' name='gold_menushow[" . $key['plug_folder'] . "]' value='1' " . ($GOLD_PREF['gold_menushow'][$key['plug_folder']] == 1 ? "checked='checked'":"") . "/>
		</td>
		<td class='forumheader3' style='text-align:left'><input type='text' style='width:95%;' class='tbox' name='gold_title[" . $key['plug_folder'] . "]'  value='" . (!empty($GOLD_PREF['gold_title'][$key['plug_folder']])?$GOLD_PREF['gold_title'][$key['plug_folder']]:$key['gold_title']) . "' /></td>
		<td class='forumheader3' style='text-align:left'><input type='text' style='width:95%;' class='tbox' name='gold_link[" . $key['plug_folder'] . "]'  value='" . (!empty($GOLD_PREF['gold_link'][$key['plug_folder']])?$GOLD_PREF['gold_link'][$key['plug_folder']]:$key['gold_link']) . "' /></td>";
        else
        {
            // this plugin does not link
            $gold_text .= '
            <td class="forumheader3" style="text-align:center">&nbsp;</td>
            <td class="forumheader3" style="text-align:center">&nbsp;</td>
		<td class="forumheader3" style="text-align:center" colspan="2">' . ADLAN_GS_MP16 . '</td>';
        }
        $gold_text .= '
		<td class="forumheader3" style="text-align:center">
			<input type="checkbox" class="tbox" name="gold_pluginstalled[' . $key['plug_folder'] . ']" value="1" ' . ($GOLD_PREF['gold_installed'][$key['plug_folder']] == 1 ? 'checked="checked"':'') . '/>
		</td>
		<td class="forumheader3" style="text-align:center"><a href="' . e_SELF . '?gold_edit.' . $key['plug_folder'] . '" ><img src="' . e_IMAGE . 'admin_images/edit_16.png" alt="' . ADLAN_GS_MP18 . '" title="' . ADLAN_GS_MP18 . '" /></a></td>
	</tr>';
    }
    $gold_text .= '
	<tr>
		<td class="forumheader2" colspan="7" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . ADLAN_GS_MP12 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="7" style="text-align:left">&nbsp;</td>
	</tr>
</table>
</form>';
}
$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . 'footer.php');
