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
if (isset($_POST['updatesettings']))
{
    $GOLD_PREF['gold_reward_type'] = $_POST['gold_reward_type'];

    $GOLD_PREF['forum_addsub'] = intval($_POST['forum_addsub']);
    $GOLD_PREF['gold_threadmin'] = intval($_POST['gold_threadmin']);
    $GOLD_PREF['gold_threadbonus'] = intval($_POST['gold_threadbonus']);
    $GOLD_PREF['gold_threadrate'] = intval($_POST['gold_threadrate']);
    $GOLD_PREF['gold_newthread_post'] = $tp->toDB($_POST['gold_newthread_post']);
    $GOLD_PREF['gold_reply_post'] = $tp->toDB($_POST['gold_reply_post']);
    $GOLD_PREF['gold_newthread_length'] = $tp->toDB($_POST['gold_newthread_length']);
    $GOLD_PREF['gold_reply_length'] = $tp->toDB($_POST['gold_reply_length']);
    // forum layout settings
    $GOLD_PREF['forum_layout_1'] = $tp->toDB($_POST['forum_layout_1']);
    $GOLD_PREF['forum_layout_2'] = $tp->toDB($_POST['forum_layout_2']);
    $GOLD_PREF['forum_layout_3'] = $tp->toDB($_POST['forum_layout_3']);
    $GOLD_PREF['forum_layout_4'] = $tp->toDB($_POST['forum_layout_4']);
    $GOLD_PREF['forum_layout_5'] = $tp->toDB($_POST['forum_layout_5']);
    $GOLD_PREF['forum_layout_6'] = $tp->toDB($_POST['forum_layout_6']);
    $GOLD_PREF['forum_layout_7'] = $tp->toDB($_POST['forum_layout_7']);
    $GOLD_PREF['forum_layout_8'] = $tp->toDB($_POST['forum_layout_8']);
    $GOLD_PREF['forum_layout_9'] = $tp->toDB($_POST['forum_layout_9']);
    $GOLD_PREF['forum_layout_10'] = $tp->toDB($_POST['forum_layout_10']);
    $GOLD_PREF['forum_layout_11'] = $tp->toDB($_POST['forum_layout_11']);
    $GOLD_PREF['forum_layout_12'] = $tp->toDB($_POST['forum_layout_12']);

    $gold_obj->save_prefs();

    $gold_msg = ADLAN_GS_F60;
}

for ($i = 1; $i <= 12; $i++)
{
    switch ($GOLD_PREF['forum_layout_' . $i])
    {
        case 'custom_title':
            $custom_title_s[$i] = ' selected="selected"';
            break;
        case 'avatar':
            $avatar_s[$i] = ' selected="selected"';
            break;
        case 'stars':
            $stars_s[$i] = ' selected="selected"';
            break;
        case 'rank':
            $rank_s[$i] = ' selected="selected"';
            break;
        case 'moderator':
            $moderator_s[$i] = ' selected="selected"';
            break;
        case 'member':
            $member_s[$i] = ' selected="selected"';
            break;
        case 'rpg':
            $rpg_s[$i] = ' selected="selected"';
            break;
        case 'joined':
            $joined_s[$i] = ' selected="selected"';
            break;
        case 'location':
            $location_s[$i] = ' selected="selected"';
            break;
        case 'posts':
            $posts_s[$i] = ' selected="selected"';
            break;
        case 'gold':
            $gold_s[$i] = ' selected="selected"';
            break;
        case 'spent':
            $spent_s[$i] = ' selected="selected"';
            break;
    }
}

for ($j = 1; $j <= 2; $j++)
{
    $forum_layout_1[$j] = '<option></option>
	<option value="custom_title"' . $custom_title_s[$j] . '>' . ADLAN_GS_F70 . '</option>
	<option value="avatar"' . $avatar_s[$j] . '>' . ADLAN_GS_F71 . '</option>';
}

for ($k = 3; $k <= 12; $k++)
{
    $forum_layout_2[$k] = '<option></option>
	<option value="stars"' . $stars_s[$k] . '>' . ADLAN_GS_F72 . '</option>
	<option value="rank"' . $rank_s[$k] . '>' . ADLAN_GS_F73 . '</option>
	<option value="moderator"' . $moderator_s[$k] . '>' . ADLAN_GS_F74 . '</option>
	<option value="member"' . $member_s[$k] . '>' . ADLAN_GS_F75 . '</option>
	<option value="rpg"' . $rpg_s[$k] . '>' . ADLAN_GS_F76 . '</option>
	<option value="joined"' . $joined_s[$k] . '>' . ADLAN_GS_F77 . '</option>
	<option value="location"' . $location_s[$k] . '>' . ADLAN_GS_F78 . '</option>
	<option value="posts"' . $posts_s[$k] . '>' . ADLAN_GS_F79 . '</option>
	<option value="gold"' . $gold_s[$k] . '>' . ADLAN_GS_F80 . '</option>
	<option value="spent"' . $spent_s[$k] . '>' . ADLAN_GS_F81 . '</option>';
}
if ($GOLD_PREF['gold_reward_type'] == 'post')
{
    $post_checked = ' checked="checked" ';
    $length_checked = ' ';
}
else
{
    $post_checked = ' ';
    $length_checked = ' checked="checked" ';
}
$gold_text = '
<form method="post" action="' . e_SELF . '" id="gold_form" >
	<table class="fborder" style="' . ADMIN_WIDTH . '" >
		<tr>
			<td class="fcaption" colspan="2" style="text-align:left">' . ADLAN_GS_F84 . '</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
		</tr>
				<tr>
			<td class="forumheader3"  style="width:30%;text-align:left">' . ADLAN_GS_F01 . '</td>
			<td class="forumheader3"  style="width:70%;text-align:left">
				<input type="checkbox" name="forum_addsub" value="1" ' . ($GOLD_PREF['forum_addsub'] == 1?'checked="checked"':'') . ' />
			</td>
		</tr>
			<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_33 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="radio"' . $post_checked . 'name="gold_reward_type" class="tbox"  value="post" /> ' . ADLAN_GS_34 . '<br />
			<input type="radio"' . $length_checked . 'name="gold_reward_type" class="tbox" value="length" /> ' . ADLAN_GS_35 . '
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F02 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_threadmin" value="' . $GOLD_PREF['gold_threadmin'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F40 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_newthread_post" value="' . $GOLD_PREF['gold_newthread_post'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F41 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_reply_post" value="' . $GOLD_PREF['gold_reply_post'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F04 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_newthread_length" value="' . $GOLD_PREF['gold_newthread_length'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F05 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_reply_length" value="' . $GOLD_PREF['gold_reply_length'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F03 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_threadbonus" value="' . $GOLD_PREF['gold_threadbonus'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . ADLAN_GS_F06 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="gold_threadrate" value="' . $GOLD_PREF['gold_threadrate'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader2"  style="width:30%;text-align:left"><b>' . ADLAN_GS_F86 . '</b></td>
		<td class="forumheader2"  style="width:70%;text-align:left"><b>' . ADLAN_GS_F87 . '</b></td>
	</tr>
	<tr>
		<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 1</td>
		<td class="forumheader3">
			<select class="tbox" name="forum_layout_1">' . $forum_layout_1[1] . '</select>
		</td>
	</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 2</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_2">' . $forum_layout_1[2] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 3</td>
			<td class="forumheader3">
				<select  class="tbox" name="forum_layout_3">' . $forum_layout_2[3] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 4</td>
			<td class="forumheader3">
				<select  class="tbox" name="forum_layout_4">' . $forum_layout_2[4] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left">' . ADLAN_GS_F85 . ' 5</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_5">' . $forum_layout_2[5] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left">' . ADLAN_GS_F85 . ' 6</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_6">' . $forum_layout_2[6] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left">' . ADLAN_GS_F85 . ' 7</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_7">' . $forum_layout_2[7] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 8</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_8">' . $forum_layout_2[8] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left">' . ADLAN_GS_F85 . ' 9</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_9">' . $forum_layout_2[9] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 10</td>
			<td class="forumheader3">
				<select  class="tbox" name="forum_layout_10">' . $forum_layout_2[10] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 11</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_11">' . $forum_layout_2[11] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader3"  style="text-align:left">' . ADLAN_GS_F85 . ' 12</td>
			<td class="forumheader3">
				<select class="tbox"  name="forum_layout_12">' . $forum_layout_2[12] . '</select>
			</td>
		</tr>
		<tr>
			<td class="forumheader2" colspan="2" style="text-align:left">
				<input type="submit" class="button" name="updatesettings" value="' . ADLAN_GS_18 . '" />
			</td>
		</tr>
		<tr>
			<td class="fcaption" colspan="2" style="text-align:left">&nbsp;
			</td>
		</tr>

	</table>
</form>';

$ns->tablerender(ADLAN_GS, $gold_text);
require_once(e_ADMIN . 'footer.php');
