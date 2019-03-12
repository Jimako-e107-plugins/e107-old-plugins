<?php
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
$sql->db_Select("hdu_prefs", "*");
if (e_QUERY == "update")
{
    // Get the existing pref id for updating
    // Update prefs
    $HELPDESK_PREF['hduprefs_mailhelpdesk'] = intval($_POST['hduprefs_mailhelpdesk']);
    $HELPDESK_PREF['hduprefs_mailtechnician'] = intval($_POST['hduprefs_mailtechnician']);
    $HELPDESK_PREF['hduprefs_mailuser'] = intval($_POST['hduprefs_mailuser']);
    $HELPDESK_PREF['hduprefs_helpdeskemail'] = $tp->toDB($_POST['hduprefs_helpdeskemail']);
    $HELPDESK_PREF['hduprefs_usersubject'] = $tp->toDB($_POST['hduprefs_usersubject']) ;
    $HELPDESK_PREF['hduprefs_techniciansubject'] = $tp->toDB($_POST['hduprefs_techniciansubject']) ;
    $HELPDESK_PREF['hduprefs_helpupsubject'] = $tp->toDB($_POST['hduprefs_helpupsubject']);
    $HELPDESK_PREF['hduprefs_technicianupsubject'] = $tp->toDB($_POST['hduprefs_technicianupsubject']);
    $HELPDESK_PREF['hduprefs_userupsubject'] = $tp->toDB($_POST['hduprefs_userupsubject']);
    $HELPDESK_PREF['hduprefs_emailfrom'] = $tp->toDB($_POST['hduprefs_emailfrom']) ;
    $HELPDESK_PREF['hduprefs_sendas'] = $tp->toDB($_POST['hduprefs_sendas']) ;
    $HELPDESK_PREF['hduprefs_usertext'] = $tp->toDB($_POST['hduprefs_usertext']) ;
    $HELPDESK_PREF['hduprefs_techniciantext'] = $tp->toDB($_POST['hduprefs_techniciantext']) ;
    $HELPDESK_PREF['hduprefs_helpdesktext'] = $tp->toDB($_POST['hduprefs_helpdesktext']) ;
    $HELPDESK_PREF['hduprefs_updateuser'] = $tp->toDB($_POST['hduprefs_updateuser']) ;
    $HELPDESK_PREF['hduprefs_updatetechnician'] = $tp->toDB($_POST['hduprefs_updatetechnician']) ;
    $HELPDESK_PREF['hduprefs_updatehelpdesk'] = $tp->toDB($_POST['hduprefs_updatehelpdesk']);
    $HELPDESK_PREF['hduprefs_helpdesksubject'] = $tp->toDB($_POST['hduprefs_helpdesksubject']);
    $HELPDESK_PREF['hduprefs_pmfrom'] = intval($_POST['hduprefs_pmfrom']) ;
    $HELPDESK_PREF['hduprefs_mailpdf'] = intval($_POST['hduprefs_mailpdf']) ;

    $helpdesk_obj->save_prefs();
    $helpdesk_obj->helpdesk_cache_clear();
    $hdu_msg .= HDU_A12 ;
}
// Display config options form
$hdu_caption = HDU_A2;
$hdu_text .= "
<form method='post' action='" . e_SELF . "?update' id='hduconf'>
	<table  style='" . ADMIN_WIDTH . "' class='fborder' >
		<tr>
			<td class='fcaption' colspan='2'>" . HDU_A201 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>" . $hdu_msg . "&nbsp;</td>
		</tr>";
// Notify user
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A3 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<select class='tbox' name='hduprefs_mailuser'>
					<option value='0' " . ($HELPDESK_PREF['hduprefs_mailuser'] == 0 ?"selected='selected'":"") . " >" . HDU_A468 . "</option>
					<option value='1' " . ($HELPDESK_PREF['hduprefs_mailuser'] == 1 ?"selected='selected'":"") . " >" . HDU_A469 . "</option>
					<option value='2' " . ($HELPDESK_PREF['hduprefs_mailuser'] == 2 ?"selected='selected'":"") . " >" . HDU_A470 . "</option>
				</select>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_muser\")' />
				<div id='hdu_muser' style='display:none' ><em>" . HDU_A340 . "</em></div>
			</td>
		</tr>";
// Notify helpdesk
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A4 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<select class='tbox' name='hduprefs_mailhelpdesk'>
					<option value='0' " . ($HELPDESK_PREF['hduprefs_mailhelpdesk'] == 0 ?"selected='selected'":"") . " >" . HDU_A468 . "</option>
					<option value='1' " . ($HELPDESK_PREF['hduprefs_mailhelpdesk'] == 1 ?"selected='selected'":"") . " >" . HDU_A469 . "</option>
					<option value='2' " . ($HELPDESK_PREF['hduprefs_mailhelpdesk'] == 2 ?"selected='selected'":"") . " >" . HDU_A470 . "</option>
				</select>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_mdesk\")' />
				<div id='hdu_mdesk' style='display:none' ><em>" . HDU_A506 . "</em></div>
			</td>
		</tr>";
		$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A5 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<select class='tbox' name='hduprefs_mailtechnician'>
					<option value='0' " . ($HELPDESK_PREF['hduprefs_mailtechnician'] == 0 ?"selected='selected'":"") . " >" . HDU_A468 . "</option>
					<option value='1' " . ($HELPDESK_PREF['hduprefs_mailtechnician'] == 1 ?"selected='selected'":"") . " >" . HDU_A469 . "</option>
					<option value='2' " . ($HELPDESK_PREF['hduprefs_mailtechnician'] == 2 ?"selected='selected'":"") . " >" . HDU_A470 . "</option>
				</select>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_tdesk\")' />
				<div id='hdu_tdesk' style='display:none' ><em>" . HDU_A341 . "</em></div>
			</td>
		</tr>";
// email of helpdesk
/*$hdu_text .="<tr>
	<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A6 . "</td>
	<td style='width:70%; vertical-align:top;' class='forumheader3'><input type='text' size='50' class='tbox' name='hduprefs_helpdeskemail' maxlength='100' value=\"$hduprefs_helpdeskemail\" />
	</td>
	</tr>";
*/
// PM from
$sql->db_Select("user", "user_id,user_name", "order by user_name", "nowhere", false);
$hdu_ul = "<select class='tbox' name='hduprefs_pmfrom'>";
while ($hdu_row = $sql->db_Fetch())
{
    extract($hdu_row);
    $hdu_ul .= "<option value='$user_id' " . ($user_id == $HELPDESK_PREF['hduprefs_pmfrom']?"selected='selected'":"") . ">" . $tp->toFORM($user_name) . "</option>";
} // while
$hdu_ul .= "</select>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_pmfo\")' />";
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A471 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>$hdu_ul
				<div id='hdu_pmfo' style='display:none' ><em>" . HDU_A472 . "</em></div>
			</td>
		</tr>";
// email From
$hdu_text .= "
		<tr>
 			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A121 . "</td>
 			<td style='width:70%; vertical-align:top;' class='forumheader3'>
			 	<input type='text' size='50' class='tbox' name='hduprefs_emailfrom' maxlength='100' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_emailfrom']) . "' />&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_efro\")' />
				<div id='hdu_efro' style='display:none' ><em>" . HDU_A342 . "</em></div>
			</td>
	 	</tr>";
// Include pdf with email
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A202 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='radio' style='border:0px;' class='radio' name='hduprefs_mailpdf' id='hduprefs_mailpdfY' value='1' " .
($HELPDESK_PREF['hduprefs_mailpdf'] == 1 ?"checked='checked'":"") . " /><label for='hduprefs_mailpdfY' > " . HDU_A28 . "&nbsp;</label>&nbsp;&nbsp;
				<input type='radio' style='border:0px;' class='radio' name='hduprefs_mailpdf' id='hduprefs_mailpdfN' value='0' " .
($HELPDESK_PREF['hduprefs_mailpdf'] == 0 ?"checked='checked'":"") . " /><label for='hduprefs_mailpdfN' > " . HDU_A29."&nbsp;</label><img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_mpdf\")' />";
$hdu_text .= "
				<div id='hdu_mpdf' style='display:none' ><em>" . HDU_A331 . "</em></div>
			</td>
		</tr>";
// User subject
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A118 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='text' size='50' class='tbox' name='hduprefs_usersubject' maxlength='100' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_usersubject']) . "' />&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_usub\")' />
				<div id='hdu_usub' style='display:none' ><em>" . HDU_A343 . "</em></div>
			</td>
		</tr>";
// Helpdesk  subject
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A120 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='text' size='50' class='tbox' name='hduprefs_helpdesksubject' maxlength='100' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_helpdesksubject']) . "' />&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_hsub\")' />
				<div id='hdu_hsub' style='display:none' ><em>" . HDU_A344 . "</em></div>
			</td>
		</tr>";
// User update subject
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A137 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='text' size='50' class='tbox' name='hduprefs_userupsubject' maxlength='100' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_userupsubject']) . "' />&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_uups\")' />
				<div id='hdu_uups' style='display:none' ><em>" . HDU_A345 . "</em></div>
			</td>
		</tr>";
// Helpdesk update  subject
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A139 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<input type='text' size='50' class='tbox' name='hduprefs_helpupsubject' maxlength='100' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_helpupsubject']) . "' />&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_hups\")' />
				<div id='hdu_hups' style='display:none' ><em>" . HDU_A346 . "</em></div>
			</td>
		</tr>";
// Message user new ticket
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A122 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<textarea class='tbox' name='hduprefs_usertext' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_usertext']) . "</textarea>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_hpref\")' />
				<div id='hdu_hpref' style='display:none' ><em>" . HDU_A347 . "</em></div>
			</td>
		</tr>";
// Message helpdesk new ticket
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A124 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<textarea class='tbox' name='hduprefs_helpdesktext' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_helpdesktext']) . "</textarea>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_hntik\")' />
				<div id='hdu_hntik' style='display:none' ><em>" . HDU_A348 . "</em></div>
			</td>
		</tr>";
// Message user update ticket
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A125 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<textarea class='tbox' name='hduprefs_updateuser' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_updateuser']) . "</textarea>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_uuuser\")' />
				<div id='hdu_uuuser' style='display:none' ><em>" . HDU_A349 . "</em></div>
			</td>
		</tr>";
// Message helpdesk update ticket
$hdu_text .= "
		<tr>
			<td style='width:30%; vertical-align:top;' class='forumheader3'>" . HDU_A127 . "</td>
			<td style='width:70%; vertical-align:top;' class='forumheader3'>
				<textarea class='tbox' name='hduprefs_updatehelpdesk' rows='4' cols='50'>" . $tp->toFORM($HELPDESK_PREF['hduprefs_updatehelpdesk']) . "</textarea>&nbsp;<img src='".e_IMAGE."admin_images/docs_16.png'  alt='".HDU_A503."' title='".HDU_A503."' onclick='expandit(\"hdu_uhdesk\")' />
				<div id='hdu_uhdesk' style='display:none' ><em>" . HDU_A350 . "</em></div>
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
		</tr>
	</table>
</form>";

$ns->tablerender(HDU_A2, $hdu_text);

require_once(e_ADMIN . "footer.php");
