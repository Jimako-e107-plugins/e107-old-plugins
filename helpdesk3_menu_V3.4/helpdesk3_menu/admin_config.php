<?php
// **************************************************************************
// *
// *  Helpdesk Ticketing configuration for e107 v6xx
// *
// **************************************************************************
require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
include_lan(e_PLUGIN . "helpdesk3_menu/languages/admin/" . e_LANGUAGE . "_helpdesk_admin.php");
if (!is_object($helpdesk_obj))
{
    require_once(e_PLUGIN . "helpdesk3_menu/includes/helpdesk_class.php");
    $helpdesk_obj = new helpdesk;
}

require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
// If updating then update prefs and tell user
if (e_QUERY == "update")
{
    // Update prefs
    if (intval($_POST['hduprefs_seo']) == 1)
    {
        $helpdesk_obj->regen_htaccess('on');
    }
    else
    {
        $helpdesk_obj->regen_htaccess('off');
    }
    $HELPDESK_PREF['hduprefs_messagetop'] = $tp->toDB($_POST['hduprefs_messagetop']);
    $HELPDESK_PREF['hduprefs_messagebottom'] = $tp->toDB($_POST['hduprefs_messagebottom']);
    $HELPDESK_PREF['hduprefs_phone'] = $tp->toDB($_POST['hduprefs_phone']) ;
    $HELPDESK_PREF['hduprefs_rows'] = intval($_POST['hduprefs_rows']) ;
    $HELPDESK_PREF['hduprefs_escalateon'] = intval($_POST['hduprefs_escalateon']);
    $HELPDESK_PREF['hduprefs_escalatedays'] = intval($_POST['hduprefs_escalatedays']);
    $HELPDESK_PREF['hduprefs_autoclosedays'] = intval($_POST['hduprefs_autoclosedays']);
    $HELPDESK_PREF['hduprefs_autocloseres'] = intval($_POST['hduprefs_autocloseres']);
    $HELPDESK_PREF['hduprefs_defaultres'] = intval($_POST['hduprefs_defaultres']);
    $HELPDESK_PREF['hduprefs_reopen'] = intval($_POST['hduprefs_reopen']);
    $HELPDESK_PREF['hduprefs_allread'] = intval($_POST['hduprefs_allread']);
    $HELPDESK_PREF['hduprefs_posteronly'] = intval($_POST['hduprefs_posteronly']);
    $HELPDESK_PREF['hduprefs_title'] = $tp->toDB($_POST['hduprefs_title']);
    $HELPDESK_PREF['hduprefs_menutitle'] = $tp->toDB($_POST['hduprefs_menutitle']) ;
    $HELPDESK_PREF['hduprefs_showassettag'] = intval($_POST['hduprefs_showassettag']) ;
    $HELPDESK_PREF['hduprefs_showfixes'] = intval($_POST['hduprefs_showfixes']) ;
    $HELPDESK_PREF['hduprefs_showfinance'] = intval($_POST['hduprefs_showfinance']);
    $HELPDESK_PREF['hduprefs_userclass'] = intval($_POST['hduprefs_userclass']);
    $HELPDESK_PREF['hduprefs_postclass'] = intval($_POST['hduprefs_postclass']) ;
    $HELPDESK_PREF['hduprefs_supervisorclass'] = intval($_POST['hduprefs_supervisorclass']);
    $HELPDESK_PREF['hduprefs_hourlyrate'] = $tp->toDB($_POST['hduprefs_hourlyrate']);
    $HELPDESK_PREF['hduprefs_callout'] = $tp->toDB($_POST['hduprefs_callout']) ;
    $HELPDESK_PREF['hduprefs_showfinusers'] = intval($_POST['hduprefs_showfinusers']) ;
    $HELPDESK_PREF['hduprefs_distancerate'] = $tp->toDB($_POST['hduprefs_distancerate']) ;
    $HELPDESK_PREF['hduprefs_force2col'] = $tp->toDB($_POST['hduprefs_force2col']) ;
    $HELPDESK_PREF['hduprefs_assignto'] = intval($_POST['hduprefs_assignto']);
    $HELPDESK_PREF['hduprefs_restech'] = intval($_POST['hduprefs_restech']);
    $HELPDESK_PREF['hduprefs_autoassign'] = intval($_POST['hduprefs_autoassign']);
    $HELPDESK_PREF['hduprefs_assigned'] = intval($_POST['hduprefs_assigned']);
    $HELPDESK_PREF['hduprefs_closestat'] = intval($_POST['hduprefs_closestat']);
    $HELPDESK_PREF['hduprefs_faq'] = $tp->toDB($_POST['hduprefs_faq']) ;
    $HELPDESK_PREF['hduprefs_seo'] = intval($_POST['hduprefs_seo']) ;
    $helpdesk_obj->save_prefs();
    $helpdesk_obj->helpdesk_cache_clear();
    $hdu_msg .= HDU_A12 ;
}
// Check if pdf out folder is writable
// If not display a massage
#print $HELPDESK_PREF['hduprefs_supervisorclass'];
$hdu_testfile = fopen("./pdfout/test.htm", "w");
if (!$hdu_testfile)
{
    $hdu_testmsg = HDU_A200;
}
fclose($hdu_testfile);
unlink("./pdfout/test.htm");
// Display config options form
$hdu_caption = HDU_A2;
$hdu_text .= "
<form method='post' action='" . e_SELF . "?update' id ='hduconf' >
	<table  style='" . ADMIN_WIDTH . "' class='fborder' >
	<tr>
		<td class='fcaption' colspan='2'>" . HDU_A2 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'>$hdu_msg&nbsp;</td>
	</tr>";
// Helpdesk Supervisor class
if (!empty($hdu_testmsg))
{
    $hdu_text .= "
	<tr>
		<td class='forumheader3' colspan='2'><strong>" . $hdu_testmsg . "</strong></td>
	</tr>";
}
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A504 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_seo' id='hduprefs_seoY' value='1' " .
($HELPDESK_PREF['hduprefs_seo'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_seoY' > " . HDU_A28 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_esca\")' /><br />
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_seo' id='hduprefs_seoN' value='2' " .
($HELPDESK_PREF['hduprefs_seo'] == 2 ?"checked='checked'":"") . " /><label for='hduprefs_seoN' > " . HDU_A29 . "</label>
			<div id='hdu_esca' style='display:none' ><em>" . HDU_A505 . "</em></div>
		</td>
	</tr>";
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A9 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>" . r_userclass("hduprefs_supervisorclass", $HELPDESK_PREF['hduprefs_supervisorclass'], "off", 'nobody, main,admin, classes') . "&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_super\")' />
			<div id='hdu_super' style='display:none' ><em>" . HDU_A301 . "</em></div>
		</td>
	</tr>";
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A203 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>" . r_userclass("hduprefs_postclass", $HELPDESK_PREF['hduprefs_postclass'], "off", 'nobody,member, main,admin, classes') . "&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_poster\")' />
			<div id='hdu_poster' style='display:none' ><em>" . HDU_A204 . "</em></div>
		</td>
	</tr>";
// Helpdesk User class
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A11 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>" . r_userclass("hduprefs_userclass", $HELPDESK_PREF['hduprefs_userclass'], "off", 'public,nobody, member,main,admin, classes') . "&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_user\")' />
			<div id='hdu_user' style='display:none' ><em>" . HDU_A302 . "</em></div>
		</td>
	</tr>";
// Message at the top
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A107 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><textarea class='tbox' name='hduprefs_messagetop' style='width:90%' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_messagetop']) . "</textarea>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_mtop\")' />
			<div id='hdu_mtop' style='display:none' ><em>" . HDU_A303 . "</em></div>
		</td>
	</tr>";
// Message at the bottom
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A108 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><textarea class='tbox' name='hduprefs_messagebottom' style='width:90%' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_messagebottom']) . "</textarea>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_mbot\")' />
			<div id='hdu_mbot' style='display:none' ><em>" . HDU_A304 . "</em></div>
		</td>
	</tr>";
// Phone no of helpdesk
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A20 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='30' class='tbox' name='hduprefs_phone' maxlength='20' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_phone']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_phone\")' />
			<div id='hdu_phone' style='display:none' ><em>" . HDU_A305 . "</em></div>
		</td>
	</tr>";
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A501 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='80%' class='tbox' name='hduprefs_faq' maxlength='200' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_faq']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_faq\")' />
			<div id='hdu_faq' style='display:none' ><em>" . HDU_A502 . "</em></div>
		</td>
	</tr>";
// How many entries per page
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A1 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='5' class='tbox' name='hduprefs_rows' maxlength='2' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_rows']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_rows\")' />
			<div id='hdu_rows' style='display:none' ><em>" . HDU_A306 . "</em></div>
		</td>
	</tr>";
// Title for menu
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A15 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='30' class='tbox' maxlength='30' name='hduprefs_menutitle' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_menutitle']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_menus\")' />
			<div id='hdu_menus' style='display:none' ><em>" . HDU_A307 . "</em></div>
		</td>
	</tr>";
// Title for Helpdesk
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A25 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='30' class='tbox' maxlength='30' name='hduprefs_title' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_title']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_title\")' />
			<div id='hdu_title' style='display:none' ><em>" . HDU_A308 . "</em></div>
		</td>
	</tr>";
// Hourly rate
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A115 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='10' class='tbox' maxlength='10' name='hduprefs_hourlyrate' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_hourlyrate']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_rate\")' />
			<div id='hdu_hrate' style='display:none' ><em>" . HDU_A309 . "</em></div>
		</td>
	</tr>";
// Distance rate
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A116 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='10' class='tbox' maxlength='10' name='hduprefs_distancerate' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_distancerate']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_dist\")' />
			<div id='hdu_dist' style='display:none' ><em>" . HDU_A310 . "</em></div>
		</td>
	</tr>";
// Escalate every n days
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A16 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='5' class='tbox' maxlength='3' name='hduprefs_escalatedays' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_escalatedays']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_esc\")' />
			<div id='hdu_esc' style='display:none' ><em>" . HDU_A311 . "</em></div>
		</td>
	</tr>";
// Escalate on posted date or last action date
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A23 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_escalateon' id='hduprefs_escalateonY' value='1' " .
($HELPDESK_PREF['hduprefs_escalateon'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_escalateonY' > " . HDU_A21 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_esca\")' /><br />
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_escalateon' id='hduprefs_escalateonN' value='2' " .
($HELPDESK_PREF['hduprefs_escalateon'] == 2 ?"checked='checked'":"") . " /><label for='hduprefs_escalateonN' > " . HDU_A22 . "</label>
			<div id='hdu_esca' style='display:none' ><em>" . HDU_A312 . "</em></div>
		</td>
	</tr>";
// Auto close after n days
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A17 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='5' class='tbox' maxlength='3' name='hduprefs_autoclosedays' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_autoclosedays']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_acld\")' />
			<div id='hdu_acld' style='display:none' ><em>" . HDU_A313 . "</em></div>
		</td>
	</tr>";
// Resolution for auto close
$hdu_pref_selbox1 = "<select name='hduprefs_autocloseres' class='tbox'><option value='0'>" . HDU_A128 . "</option>";
if ($sql->db_Select("hdu_resolve", "*", " order by hdures_resolution", "nowhere", false))
{
    while ($hdu_pref_row1 = $sql->db_Fetch())
    {
        extract($hdu_pref_row1);
        $hdu_pref_selbox1 .= "<option value='$hdures_id' " .
        ($hdures_id == $HELPDESK_PREF['hduprefs_autocloseres']?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>" ;
    } // while
    $hdu_pref_selbox1 .= "</select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_aclos\")' />";
}
else
{
    $hdu_pref_selbox1 = "<select name='hduprefs_autocloseres' class='tbox'>";
    $hdu_pref_selbox1 = "<option value='0'>" . HDU_A113 . "</option></select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_aclos\")' />";
}
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A112 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>$hdu_pref_selbox1
			<div id='hdu_aclos' style='display:none' ><em>" . HDU_A314 . "</em></div>
		</td>
	</tr>";
// Default resolution for new tickets
$hdu_pref_selbox2 = "<select name='hduprefs_defaultres' class='tbox'><option value='0'>" . HDU_A128 . "</option>";
if ($sql->db_Select("hdu_resolve", "*", " order by hdures_resolution", "nowhere"))
{
    while ($hdu_pref_row2 = $sql->db_Fetch())
    {
        extract($hdu_pref_row2);
        $hdu_pref_selbox2 .= "<option value='$hdures_id' " .
        ($hdures_id == $HELPDESK_PREF['hduprefs_defaultres']?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>" ;
    } // while
    $hdu_pref_selbox2 .= "</select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_aclre\")' />";
}
else
{
    $hdu_pref_selbox2 = "<select name='hduprefs_autocloseres' class='tbox'>";
    $hdu_pref_selbox2 = "<option value='0'>" . HDU_A113 . "</option></select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_aclre\")' />";
}
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A114 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>$hdu_pref_selbox2
			<div id='hdu_aclre' style='display:none' ><em>" . HDU_A315 . "</em></div>
		</td>
	</tr>";
// Default assignment for assignments hduprefs_assignto
$hdu_pref_selbox3 = "<select name='hduprefs_assigned' class='tbox'><option value='0'>" . HDU_A128 . "</option>";
if ($sql->db_Select("hdu_resolve", "*", " order by hdures_resolution", "nowhere"))
{
    while ($hdu_pref_row2 = $sql->db_Fetch())
    {
        extract($hdu_pref_row2);
        $hdu_pref_selbox3 .= "<option value='$hdures_id' " .
        ($hdures_id == $HELPDESK_PREF['hduprefs_assigned']?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>" ;
    } // while
    $hdu_pref_selbox3 .= "</select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_resv\")' />";
}
else
{
    $hdu_pref_selbox3 = "<select name='hduprefs_assigned' class='tbox'>";
    $hdu_pref_selbox3 = "<option value='0'>" . HDU_A113 . "</option></select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_resv\")' />";
}
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A198 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>$hdu_pref_selbox3
			<div id='hdu_resv' style='display:none' ><em>" . HDU_A316 . "</em></div>
		</td>
	</tr>";
// Default status for closed tickets
$hdu_pref_selbox4 = "<select name='hduprefs_closestat' class='tbox'><option value='0'>" . HDU_A128 . "</option>";
if ($sql->db_Select("hdu_resolve", "*", " order by hdures_resolution", "nowhere"))
{
    while ($hdu_pref_row2 = $sql->db_Fetch())
    {
        extract($hdu_pref_row2);
        $hdu_pref_selbox4 .= "<option value='$hdures_id' " .
        ($hdures_id == $HELPDESK_PREF['hduprefs_closestat']?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>" ;
    } // while
    $hdu_pref_selbox4 .= "</select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_clsta\")' />";
}
else
{
    $hdu_pref_selbox4 = "<select name='hduprefs_closestat' class='tbox'>";
    $hdu_pref_selbox4 = "<option value='0'>" . HDU_A113 . "</option></select>&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_clsta\")' />";
}
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A199 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>$hdu_pref_selbox4
			<div id='hdu_clsta' style='display:none' ><em>" . HDU_A317 . "</em></div>
		</td>
	</tr>";
// Send Restrict list to poster only
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A14 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_posteronly' id='hduprefs_posteronlyY' value='1' " .
($HELPDESK_PREF['hduprefs_posteronly'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_posteronlyY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_posteronly' id='hduprefs_posteronlyN' value='0' " .
($HELPDESK_PREF['hduprefs_posteronly'] == 0 ?"checked='checked'":"") . " /><label for='hduprefs_posteronlyN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_pony\")' />";
$hdu_text .= "
			<div id='hdu_pony' style='display:none' ><em>" . HDU_A318 . "</em></div>
		</td>
	</tr>";
// Allow user to reopen tickets
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A19 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='radio' style='border:0px;' class='radio' name='hduprefs_reopen' id='hduprefs_reopenY' value='1' " .
($HELPDESK_PREF['hduprefs_reopen'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_reopenY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
				<input type='radio' style='border:0px;' class='radio' name='hduprefs_reopen' id='hduprefs_reopenN' value='0' " .
($HELPDESK_PREF['hduprefs_reopen'] == 0 ?"checked='checked'":"") . " /><label for='hduprefs_reopenN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_reop\")' />";
$hdu_text .= "
				<div id='hdu_reop' style='display:none' ><em>" . HDU_A319 . "</em></div>
			</td>
	</tr>";
// Send View comments to poster only
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A18 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_allread' id='hduprefs_allreadY' value='1' " .
($HELPDESK_PREF['hduprefs_allread'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_allreadY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;' class='radio' name='hduprefs_allread' id='hduprefs_allreadN' value='0' " .
($HELPDESK_PREF['hduprefs_allread'] == 0 ?"checked='checked'":"") . " /><label for='hduprefs_allreadN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_allr\")' />";
$hdu_text .= "
			<div id='hdu_allr' style='display:none' ><em>" . HDU_A320 . "</em></div>
		</td>
	</tr>";
// Show tag no?
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A27 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio'  style='border:0px;' class='radio' name='hduprefs_showassettag' id='hduprefs_showassettagY' value='1' " .
($HELPDESK_PREF['hduprefs_showassettag'] == 1?" checked='checked'":"") . " /><label for='hduprefs_showassettagY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showassettag' id='hduprefs_showassettagN' value='0' " .
($HELPDESK_PREF['hduprefs_showassettag'] == 0?" checked='checked'":"") . " /><label for='hduprefs_showassettagN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_shat\")' />";
$hdu_text .= "
			<div id='hdu_shat' style='display:none' ><em>" . HDU_A321 . "</em></div>
		</td>
	</tr>";
// Show fixes
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A110 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfixes' id='hduprefs_showfixesY' value='1' " .
($HELPDESK_PREF['hduprefs_showfixes'] == 1?" checked='checked'":"") . " /><label for='hduprefs_showfixesY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfixes' id='hduprefs_showfixesN' value='0' " .
($HELPDESK_PREF['hduprefs_showfixes'] == 0?" checked='checked'":"") . " /><label for='hduprefs_showfixesN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_sfix\")' />";
$hdu_text .= "
			<div id='hdu_sfix' style='display:none' ><em>" . HDU_A322 . "</em></div>
		</td>
	</tr>";
// Show financials
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A111 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfinance' id='hduprefs_showfinanceY' value='1' " .
($HELPDESK_PREF['hduprefs_showfinance'] == 1?" checked='checked'":"") . " /><label for='hduprefs_showfinanceY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfinance' id='hduprefs_showfinanceN' value='0' " .
($HELPDESK_PREF['hduprefs_showfinance'] == 0?" checked='checked'":"") . " /><label for='hduprefs_showfinanceN' >" . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_sfin\")' />";
$hdu_text .= "
			<div id='hdu_sfin' style='display:none' ><em>" . HDU_A323 . "</em></div>
		</td>
	</tr>";
// show finance to users
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A130 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfinusers' id='hduprefs_showfinusersY' value='1' " .
($HELPDESK_PREF['hduprefs_showfinusers'] == 1?" checked='checked'":"") . " /><label for='hduprefs_showfinusersY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_showfinusers' id='hduprefs_showfinusersN' value='0' " .
($HELPDESK_PREF['hduprefs_showfinusers'] == 0?" checked='checked'":"") . " /><label for='hduprefs_showfinusersN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_sfu\")' />";
$hdu_text .= "
			<div id='hdu_sfu' style='display:none' ><em>" . HDU_A324 . "</em></div>
		</td>
	</tr>";
// Standard call out
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A129 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='10' class='tbox' name='hduprefs_callout' maxlength='10' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_callout']) . "' />&nbsp;<img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_cout\")' />
			<div id='hdu_cout' style='display:none' ><em>" . HDU_A325 . "</em></div>
		</td>
	</tr>";
// Auto assign if helpdesk defined
$hdu_text .= "
	<tr>
		<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A197 . "</td>
		<td style='width:70%; vertical-align:top;' class='forumheader3'>
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_autoassign' id='hduprefs_autoassignY' value='1' " .
($HELPDESK_PREF['hduprefs_autoassign'] == 1?" checked='checked'":"") . " /><label for='hduprefs_autoassignY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
			<input type='radio' style='border:0px;'  class='radio' name='hduprefs_autoassign' id='hduprefs_autoassignN' value='0' " .
($HELPDESK_PREF['hduprefs_autoassign'] == 0?" checked='checked'":"") . " /><label for='hduprefs_autoassignN' > " . HDU_A29 . "&nbsp;</label><img src='" . e_IMAGE . "admin_images/docs_16.png'  alt='" . HDU_A503 . "' title='" . HDU_A503 . "' onclick='expandit(\"hdu_aass\")' />";
$hdu_text .= "
			<div id='hdu_aass' style='display:none' ><em>" . HDU_A327 . "</em></div>
		</td>
	</tr>";
// Submit button
$hdu_text .= "
	<tr>
		<td style='text-align: left; ' colspan='2' class='forumheader2'>
			<input type='submit' name='update' value='" . HDU_A7 . "' class='button' />
		</td>
	</tr>
	<tr>
		<td style='text-align: left; ' colspan='2' class='fcaption'>
			&nbsp;
		</td>
	</tr>	";

$hdu_text .= "
	</table>
</form>";

$ns->tablerender(HDU_A2, $hdu_text);

require_once(e_ADMIN . "footer.php");
