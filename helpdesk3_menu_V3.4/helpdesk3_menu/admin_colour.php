<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
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
if (isset($_POST['hdu_subit']))
{
    $HELPDESK_PREF['hduprefs_p1col'] = $tp->toDB($_POST['hduprefs_p1col']) ;
    $HELPDESK_PREF['hduprefs_p2col'] = $tp->toDB($_POST['hduprefs_p2col']) ;
    $HELPDESK_PREF['hduprefs_p3col'] = $tp->toDB($_POST['hduprefs_p3col']) ;
    $HELPDESK_PREF['hduprefs_p4col'] = $tp->toDB($_POST['hduprefs_p4col']) ;
    $HELPDESK_PREF['hduprefs_p5col'] = $tp->toDB($_POST['hduprefs_p5col']) ;

    $helpdesk_obj->save_prefs();
    $helpdesk_obj->helpdesk_cache_clear();
    $hdu_msgtext .= HDU_A189 ;
}
// Admin colour pickers
$hdu_colours = $helpdesk_obj->hdu_get_colours();
$hdu_text .= "
<script type='text/javascript' src=\"picker.js\">
</script>
<form id='hducolform' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='hduprefs_id' value='$hduprefs_id' />
	</div>
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . HDU_A34 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'><b>" . $hdu_msgtext . "</b>&nbsp;</td>
	</tr>

	<tr>
		<td class='forumheader2' style='width:30%'>" . HDU_A35 . "</td>
		<td class='forumheader2' >" . HDU_A36 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . HDU_A37 . "</td>
		<td class='forumheader3' >
			<input type='text' name='hduprefs_p1col' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_p1col']) . "' class='tbox' /><a href=\"javascript:TCP.popup(document.forms['hducolform'].elements['hduprefs_p1col'], 1)\"><img width=\"15\" height=\"13\" style='border:0;' title='" . HDU_A351 . "' alt='" . HDU_A351 . "' src=\"img/sel.gif\" /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . HDU_A38 . "</td>
		<td class='forumheader3' >
			<input type='text' name='hduprefs_p2col' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_p2col']) . "' class='tbox' /><a href=\"javascript:TCP.popup(document.forms['hducolform'].elements['hduprefs_p2col'], 1)\"><img width=\"15\" height=\"13\" style='border:0;' title='" . HDU_A351 . "' alt='" . HDU_A351 . "' src=\"img/sel.gif\" /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . HDU_A39 . "</td>
		<td class='forumheader3' >
			<input type='text' name='hduprefs_p3col' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_p3col']) . "' class='tbox' /><a href=\"javascript:TCP.popup(document.forms['hducolform'].elements['hduprefs_p3col'], 1)\"><img width=\"15\" height=\"13\" style='border:0;' title='" . HDU_A351 . "' alt='" . HDU_A351 . "' src=\"img/sel.gif\" /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . HDU_A40 . "</td>
		<td class='forumheader3' >
			<input type='text' name='hduprefs_p4col' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_p4col']) . "' class='tbox' /><a href=\"javascript:TCP.popup(document.forms['hducolform'].elements['hduprefs_p4col'], 1)\"><img width=\"15\" height=\"13\" style='border:0;' title='" . HDU_A351 . "' alt='" . HDU_A351 . "' src=\"img/sel.gif\" /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader3' >" . HDU_A41 . "</td>
		<td class='forumheader3' >
			<input type='text' name='hduprefs_p5col' value='" . $tp->toFORM($HELPDESK_PREF['hduprefs_p5col']) . "' class='tbox' /><a href=\"javascript:TCP.popup(document.forms['hducolform'].elements['hduprefs_p5col'], 1)\"><img width=\"15\" height=\"13\" style='border:0;' title='" . HDU_A351 . "' alt='" . HDU_A351 . "' src=\"img/sel.gif\" /></a>
		</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2'><input type='submit' name='hdu_subit' value='Submit' class='button' /></td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>
</form>";
$hdu_text .= $helpdesk_obj->display_priority($hdu_colours);
$ns->tablerender(HDU_A2, $hdu_text);
require_once(e_ADMIN . "footer.php");
