<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
$portfolio_fp = fopen("uploads/category/index.htm", "w+");
if ($portfolio_fp === false)
{
    $portfolio_msg .= PORTFOLIO_CON_07 . " ";
}
fclose($portfolio_fp);
$portfolio_fp = fopen("uploads/portfolio/index.htm", "w+");
if ($portfolio_fp === false)
{
    $portfolio_msg .= PORTFOLIO_CON_08 . " ";
}
fclose($portfolio_fp);
global $PORTFOLIO_PREF;
if (isset($_POST['portfolioupdate']))
{
    // Update rest
    $PORTFOLIO_PREF['portfolio_adminclass'] = intval($_POST['portfolio_adminclass']);
    $PORTFOLIO_PREF['portfolio_postclass'] = intval($_POST['portfolio_postclass']);
    $PORTFOLIO_PREF['portfolio_userclass'] = intval($_POST['portfolio_userclass']);
    $PORTFOLIO_PREF['portfolio_perpage'] = intval($_POST['portfolio_perpage']);
    $PORTFOLIO_PREF['portfolio_show'] = intval($_POST['portfolio_show']);
    $PORTFOLIO_PREF['portfolio_artisitsperpage'] = intval($_POST['portfolio_artisitsperpage']);
    $PORTFOLIO_PREF['portfolio_max'] = $tp->toDB($_POST['portfolio_max']);
    $PORTFOLIO_PREF['portfolio_imagepich'] = intval($_POST['portfolio_imagepich']);
    $PORTFOLIO_PREF['portfolio_imagepicw'] = intval($_POST['portfolio_imagepicw']);
    $PORTFOLIO_PREF['portfolio_catpich'] = intval($_POST['portfolio_catpich']);
    $PORTFOLIO_PREF['portfolio_cattpicv'] = intval($_POST['portfolio_cattpicv']);
   # $PORTFOLIO_PREF['portfolio_caption'] = $tp->toDB($_POST['portfolio_caption']);
   # $PORTFOLIO_PREF['portfolio_cat'] = $tp->toDB($_POST['portfolio_cat']);
   # $PORTFOLIO_PREF['portfolio_pa'] = $tp->toDB($_POST['portfolio_pa']);
   # $PORTFOLIO_PREF['portfolio_subcat'] = $tp->toDB($_POST['portfolio_subcat']);
   # $PORTFOLIO_PREF['portfolio_leader'] = $tp->toDB($_POST['portfolio_leader']);
   # $PORTFOLIO_PREF['portfolio_activities'] = $tp->toDB($_POST['portfolio_activities']);
    $PORTFOLIO_PREF['portfolio_metadesc'] = $tp->toDB($_POST['portfolio_metadesc']);
    $PORTFOLIO_PREF['portfolio_metakey'] = $tp->toDB($_POST['portfolio_metakey']);
    $PORTFOLIO_PREF['portfolio_maxattach'] = $tp->toDB($_POST['portfolio_maxattach']);
    $PORTFOLIO_PREF['portfolio_extnattach'] = $tp->toDB($_POST['portfolio_extnattach']);
    $PORTFOLIO_PREF['portfolio_maximage'] = $tp->toDB($_POST['portfolio_maximage']);
    $PORTFOLIO_PREF['portfolio_extnimage'] = $tp->toDB($_POST['portfolio_extnimage']);
    $PORTFOLIO_PREF['portfolio_lightbox'] = $tp->toDB($_POST['portfolio_lightbox']);
    $PORTFOLIO_PREF['portfolio_vote'] = $tp->toDB($_POST['portfolio_vote']);
    $PORTFOLIO_PREF['portfolio_comments'] = $tp->toDB($_POST['portfolio_comments']);
    $PORTFOLIO_PREF['portfolio_rate'] = $tp->toDB($_POST['portfolio_rate']);
    $portfolio_obj->save_prefs();
    $portfolio_obj->cache_clear();
    $portfolio_msg .= PORTFOLIO_CON_02;
}

$portfolio_text .= "
<form method='post' action='" . e_SELF . "' id='portfolio'>
	<table class='forumborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . PORTFOLIO_CON_01 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'><strong>" . $portfolio_msg . "</strong>&nbsp;</td>
		</tr>";
// userclass
$portfolio_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PORTFOLIO_CON_05 . ":<br />(" . PORTFOLIO_CON_06 . ")</td>
			<td class='forumheader3'>" . r_userclass("portfolio_adminclass", $PORTFOLIO_PREF['portfolio_adminclass'], "off", "nobody,admin,main,classes") . "</td>
		</tr>";
// userclass
$portfolio_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PORTFOLIO_CON_29 . ":<br />(" . PORTFOLIO_CON_30 . ")</td>
			<td class='forumheader3'>" . r_userclass("portfolio_postclass", $PORTFOLIO_PREF['portfolio_postclass'], "off", "nobody,members,admin,main,classes") . "</td>
		</tr>";
// userclass
$portfolio_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PORTFOLIO_CON_03 . ":<br />(" . PORTFOLIO_CON_04 . ")</td>
			<td class='forumheader3'>" . r_userclass("portfolio_userclass", $PORTFOLIO_PREF['portfolio_userclass'], "off", "nobody,public,guests,members,admin,main,classes") . "</td>
		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_09 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30'  name='portfolio_caption' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_caption']) . "' class='tbox' />
#			</td>
#		</tr>";

if ($pref['plug_installed']['vote'] &&  (file_exists(e_THEME . "vote_portfolio_template.php") || file_exists(e_PLUGIN . "portfolio/templates/vote_portfolio_template.php")) )
{
    $portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_35 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='checkbox'  name='portfolio_vote' value='1' " . ($PORTFOLIO_PREF['portfolio_vote'] == 1?"checked='checked'":"") . "' class='tbox' />
			</td>
		</tr>";
}
else
{
    $portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_35 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>" . PORTFOLIO_CON_37 . "
				<input type='hidden'  name='portfolio_vote' value='0' />
			</td>
		</tr>";
}
if ($pref['plug_installed']['lightbox'])
{
    $portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_36 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='checkbox'  name='portfolio_lightbox' value='1' " . ($PORTFOLIO_PREF['portfolio_lightbox'] == 1?"checked='checked'":"") . "' class='tbox' />
			</td>
		</tr>";
}
else
{
    $portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_36 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>" . PORTFOLIO_CON_38 . "
				<input type='hidden'  name='portfolio_lightbox' value='0' />
			</td>
		</tr>";
}
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_10 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30' name='portfolio_cat' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_cat']) . "' class='tbox' />
#			</td>
#		</tr>";
#
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_12 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30' name='portfolio_pa' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_pa']) . "' class='tbox' />
#			</td>
#		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_13 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30' name='portfolio_subcat' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_subcat']) . "' class='tbox' />
#			</td>
#		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_14 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30' name='portfolio_leader' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_leader']) . "' class='tbox' />
#			</td>
#		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_15 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='30' name='portfolio_activities' value='" . $tp->toFORM($PORTFOLIO_PREF['portfolio_activities']) . "' class='tbox' />
#			</td>
#		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_52 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='checkbox' name='portfolio_comments' value='1'" . ($PORTFOLIO_PREF['portfolio_comments'] == 1?"checked='checked'":"") . "' class='tbox' />
			</td>
		</tr>";

$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_53 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='checkbox' name='portfolio_rate' value='1'" . ($PORTFOLIO_PREF['portfolio_rate'] == 1?"checked='checked'":"") . "' class='tbox' />
			</td>
		</tr>";

#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_16 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='checkbox' name='portfolio_show' value='1'" . ($PORTFOLIO_PREF['portfolio_show'] == 1?"checked='checked'":"") . "' class='tbox' />
#			</td>
#		</tr>";

$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_17 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_perpage' value='" . $PORTFOLIO_PREF['portfolio_perpage'] . "' class='tbox' />
			</td>
		</tr>";
		$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_55 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_max' value='" . $PORTFOLIO_PREF['portfolio_max'] . "' class='tbox' />
			</td>
		</tr>";
// $portfolio_text .= "
// <tr>
// <td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_A98 . " :</td>
// <td class='forumheader3' style='vertical-align:top;'>
// <input type='text' size='4' name='portfolio_artisitsperpage' value='" . $PORTFOLIO_PREF['portfolio_artisitsperpage'] . "' class='tbox' />
// </td>
// </tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_18 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' size='50' name='portfolio_notify' value='" . $PORTFOLIO_PREF['portfolio_notify'] . "' class='tbox' />
#			</td>
#		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_19 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' style='width:10%;' name='portfolio_catpich' value='" . $PORTFOLIO_PREF['portfolio_catpich'] . "' class='tbox' />
#			</td>
#		</tr>";
#$portfolio_text .= "
#		<tr>
#			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_20 . " :</td>
#			<td class='forumheader3' style='vertical-align:top;'>
#				<input type='text' style='width:10%;' name='portfolio_cattpicv' value='" . $PORTFOLIO_PREF['portfolio_cattpicv'] . "' class='tbox' />
#			</td>
#		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_21 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_imagepich' value='" . $PORTFOLIO_PREF['portfolio_imagepich'] . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_22 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_imagepicw' value='" . $PORTFOLIO_PREF['portfolio_imagepicw'] . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_31 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_maxattach' value='" . $PORTFOLIO_PREF['portfolio_maxattach'] . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_32 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:50%;' name='portfolio_extnattach' value='" . $PORTFOLIO_PREF['portfolio_extnattach'] . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_33 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:10%;' name='portfolio_maximage' value='" . $PORTFOLIO_PREF['portfolio_maximage'] . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_34 . " :</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<input type='text' style='width:50%;' name='portfolio_extnimage' value='" . $PORTFOLIO_PREF['portfolio_extnimage'] . "' class='tbox' />
			</td>
		</tr>";

$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_23 . " : <br />" . PORTFOLIO_CON_24 . "</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<textarea style='width:80%' rows='5' name='portfolio_metadesc' class='tbox' >" . $PORTFOLIO_PREF['portfolio_metadesc'] . "</textarea>
			</td>
		</tr>";
$portfolio_text .= "
		<tr>
			<td style='vertical-align:top;width:40%' class='forumheader3'>" . PORTFOLIO_CON_25 . " : <br />" . PORTFOLIO_CON_26 . "</td>
			<td class='forumheader3' style='vertical-align:top;'>
				<textarea style='width:80%' rows='5' name='portfolio_metakey' class='tbox' >" . $PORTFOLIO_PREF['portfolio_metakey'] . "</textarea>
			</td>
		</tr>";
// Submit button
$portfolio_text .= "
		<tr>
			<td colspan='2' style='text-align: left;' class='fcaption'>
				<input type='submit' name='portfolioupdate' value='" . PORTFOLIO_CON_27 . "' class='tbox' />
			</td>
		</tr>";
$portfolio_text .= "</table></form>";
$ns->tablerender(PORTFOLIO_CON_28, $portfolio_text);
require_once(e_ADMIN . "footer.php");

?>