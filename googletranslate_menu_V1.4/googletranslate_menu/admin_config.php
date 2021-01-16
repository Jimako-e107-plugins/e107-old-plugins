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

require_once(e_PLUGIN . 'googletranslate_menu/includes/google_trans_class.php');
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
if (!is_object($gtrans_obj))
{
    $gtrans_obj = new google_translate;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if (isset($_POST['gtransadd']))
{
    $GTRANS_PREFS['gtrans_langs']['xx'] = array('code' => 'xx', 'language' => '', 'flag' => '', 'alt' => utf8_encode(''));
}
$tmp = explode('.', e_QUERY);

if ($tmp[0] == 'delete')
{
    unset($GTRANS_PREFS['gtrans_langs'][$tmp[1]]);
    $gtrans_obj->save_prefs();
}
// print_a($GTRANS_PREFS['gtrans_langs']);
if (isset($_POST['gtransok']))
{
    // print_a($_POST);
    // print_a($GTRANS_PREFS['gtrans_langs']);
    foreach($_POST['codeid'] as $key)
    {
        // print $key;
        if ($key != $_POST['code'][$key])
        {
            unset($GTRANS_PREFS['gtrans_langs'][$key]);
            $GTRANS_PREFS['gtrans_langs'][$_POST['code'][$key]] = array('code' => $_POST['code'][$key], 'language' => $_POST['language'][$key], 'flag' => $_POST['flag'][$key], 'alt' => utf8_encode($_POST['alt'][$key]));
        }
        else
        {
            $GTRANS_PREFS['gtrans_langs'][$key] = array('code' => $_POST['code'][$key], 'language' => $_POST['language'][$key], 'flag' => $_POST['flag'][$key], 'alt' => utf8_encode($_POST['alt'][$key]));
        }
    }
    $gtrans_obj->save_prefs();
    // print_a(print_a($GTRANS_PREFS['gtrans_langs']));
}
$gtrans_text = "
<form id='gtransform' method='post' action='" . e_SELF . "' />
<table class='fborder' style='" . ADMIN_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='5'>" . GTM_LAN_P01 . "</td>
	</tr>
	<tr>
		<td class='forumheader2'  colspan='5'><b>" . $gtrans_msg . "</b>&nbsp;</td>
	</tr>
		<tr>
		<td class='forumheader2' style='width:15%' ><b>" . GTM_LAN_C01 . "</b></td>
		<td class='forumheader2' style='width:20%' ><b>" . GTM_LAN_C02 . "</b></td>
		<td class='forumheader2' style='width:25%' ><b>" . GTM_LAN_C03 . "</b></td>
		<td class='forumheader2' style='width:30%' ><b>" . GTM_LAN_C04 . "</b></td>
		<td class='forumheader2' style='width:10%;text-align:center;' ><b>" . GTM_LAN_C06 . "</b></td>
	</tr>";
foreach($GTRANS_PREFS['gtrans_langs'] as $frr)
{
    $gtrans_text .= "
	<tr>
		<td class='forumheader3' >
			<input type='hidden' name='codeid[{$frr['code']}]' value='" . $frr['code'] . "' />
			<input type='text' style='width:40%;' class='tbox'  name='code[{$frr['code']}]' value='" . $frr['code'] . "' />
			</td>
		<td class='forumheader3' ><input type='text' style='width:90%;' class='tbox'  name='language[{$frr['code']}]' value='" . $frr['language'] . "' /></td>
		<td class='forumheader3' style='vertical-align:middle;'>
			<input type='text' style='width:65%;' class='tbox'  name='flag[{$frr['code']}]' value='" . $frr['flag'] . "' />
			<img src='" . e_PLUGIN . "googletranslate_menu/images/" . $frr['flag'] . "' alt='' style='border:0px;' /> </td>
		<td class='forumheader3' ><input type='text' style='width:90%;' class='tbox'  name='alt[{$frr['code']}]' value='" . utf8_decode($frr['alt']) . "' /></td>
		<td class='forumheader3'  style='text-align:center;' ><a href='" . e_SELF . "?delete.{$frr['code']}' onclick=\"return confirm('".GTM_LAN_C08."')\"><img src='" . e_IMAGE . "admin_images/delete_16.png' alt='' style='border:0px;' /></a></td>
	</tr>";
}
$gtrans_text .= '
	<tr>
		<td class="forumheader2"  colspan="5">
		<input type="submit" class="button" name="gtransok" value="' . GTM_LAN_C05 . '" />
		<input type="submit" class="button" name="gtransadd"  value="' . GTM_LAN_C07 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="5">&nbsp;</td>
	</tr>
</table>
</form>';
$ns->tablerender(GTM_LAN_P01, $gtrans_text);
require_once(e_ADMIN . 'footer.php');

?>