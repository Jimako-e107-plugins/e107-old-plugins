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
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
$e_wysiwyg = "cwriter_terms";
if ($pref['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_HANDLER . "ren_help.php");
require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");

if (e_QUERY == "update")
{
    // Update rest
    if ($pref['cwriter_thumbheight'] <> $_POST['cwriter_thumbheight'])
    {
        require_once("upload_pic.php");
        // Resize thumbnails
        if ($handle = opendir("./images/books"))
        {
            while (false !== ($file = readdir($handle)))
            {
                // go through each file in the directory and create a thumbnail image
                // Do not try on index.htm or on existing thumbnails
                // All thumbnails are generated as type .jpg
                if ($file <> "." && $file <> ".." && $file <> "index.htm" && substr($file, 0, 6) <> "thumb_")
                {
                    makeThumbnail($file, $t_ht = $_POST['cwriter_thumbheight']);
                }
            }

            closedir($handle);
            ##$cwriter_msgtext .= CWRITER_A64 . "<br />";
        }
    }
    $pref['cwriter_approval'] = intval($_POST['cwriter_approval']);
    $pref['cwriter_read'] = intval($_POST['cwriter_read']);
    $pref['cwriter_create'] = intval($_POST['cwriter_create']);
    $pref['cwriter_admin'] = intval($_POST['cwriter_admin']);
    $pref['cwriter_terms'] = $tp->toDB($_POST['cwriter_terms']);
    $pref['cwriter_perpage'] = intval($_POST['cwriter_perpage']);
    $pref['cwriter_pich'] = intval($_POST['cwriter_pich']);
    $pref['cwriter_picw'] = intval($_POST['cwriter_picw']);
    $pref['cwriter_currency'] = $tp->toDB($_POST['cwriter_currency']);
    $pref['cwriter_metad'] = $tp->toDB($_POST['cwriter_metad']);
    $pref['cwriter_metak'] = $tp->toDB($_POST['cwriter_metak']);
    $pref['cwriter_thumbs'] = intval($_POST['cwriter_thumbs']);
    $pref['cwriter_icons'] = intval($_POST['cwriter_icons']);
    $pref['cwriter_thumbheight'] = intval($_POST['cwriter_thumbheight']);
	$pref['cwriter_dformat'] = $tp->toDB($_POST['cwriter_dformat']);
	$pref['cwriter_userating'] = intval($_POST['cwriter_userating']);
	$pref['cwriter_usecomments'] = intval($_POST['cwriter_usecomments']);
	save_prefs();

    $cwriter_msgtext .= CWRITER_A62 ;
}

$cwriter_text = "
<form id=\"dataform\" method=\"post\" action=\"" . e_SELF . "?update\">
	<table class=\"fborder\" width='97%'>
	<tr>
		<td class='fcaption' colspan='2' style='text-align:left'>" . CWRITER_A3 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:left'><strong>$cwriter_msgtext</strong>&nbsp;</td>
	</tr>";
$cwriter_text .= "
	<tr>
		<td class='forumheader3'>" . CWRITER_A25 . "</td><td class='forumheader3'>
			<select class='tbox' name='cwriter_approval'>
				<option value='1' " . ($pref['cwriter_approval'] == "1" || empty($apreq)?"selected='selected'":"") . ">" . CWRITER_A26 . "</option>
				<option value='0' " . ($pref['cwriter_approval'] <> "1"?"selected='selected'":"") . ">" . CWRITER_A27 . "</option>
			</select>
		</td>
	</tr>";
$cwriter_text .= "
	<tr>
		<td style='width:30%' class='forumheader3'>" . CWRITER_A29 . "</td>
		<td style='width:70%' class='forumheader3'>" . r_userclass("cwriter_read", $pref['cwriter_read'], "off", 'public,guest, nobody, member, admin, classes') . "</td>
	</tr>";
$cwriter_text .= "
	<tr>
		<td style='width:30%' class='forumheader3'>" . CWRITER_A48 . "</td>
		<td style='width:70%' class='forumheader3'>" . r_userclass("cwriter_admin", $pref['cwriter_admin'], "off", 'nobody, member, admin, classes') . "</td>
	</tr>";
$cwriter_text .= "
	<tr>
		<td style='width:30%' class='forumheader3'>" . CWRITER_A28 . "</td>
		<td style='width:70%' class='forumheader3'>" . r_userclass("cwriter_create", $pref['cwriter_create'], "off", 'nobody, member, admin, classes') . "</td>
	</tr>";
// date format
$cwriter_text .= "
<tr>
	<td style='width:30%' class='forumheader3'>" . CWRITER_A49 . "</td>
	<td style='width:70%' class='forumheader3'>
		<select class='tbox' name='cwriter_dformat'>
			<option value='d-m-Y' ".($pref['cwriter_dformat']=="d-m-Y"?"selected='selected'":"").">d-m-Y</option>
			<option value='m-d-Y' ".($pref['cwriter_dformat']=="m-d-Y"?"selected='selected'":"").">m-d-Y</option>
			<option value='Y-m-d' ".($pref['cwriter_dformat']=="Y-m-d"?"selected='selected'":"").">Y-m-d</option>
		</select>
	</td>
</tr>";
$cwriter_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . CWRITER_A50 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='cwriter_userating' value='1'" .
($pref['cwriter_userating'] > 0?"checked='checked'":"") . " />
</td></tr>";
$cwriter_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . CWRITER_A66 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='cwriter_usecomments' value='1'" .
($pref['cwriter_usecomments'] > 0?"checked='checked'":"") . " />
</td></tr>";


$cwriter_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . CWRITER_A51 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='cwriter_icons' value='1'" .
($pref['cwriter_icons'] > 0?"checked='checked'":"") . " />
</td></tr>";


$cwriter_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . CWRITER_A52 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='cwriter_thumbs' value='1'" .
($pref['cwriter_thumbs'] > 0?"checked='checked'":"") . " />
</td></tr>";
$cwriter_text .= "<tr><td class='forumheader3' style='width:30%;'>" . CWRITER_A53 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='cwriter_thumbheight' value='" . $pref['cwriter_thumbheight'] . "' /></td></tr>";


$cwriter_text .= "<tr><td class='forumheader3' style='width:30%;'>" . CWRITER_A54 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='cwriter_pich' value='" . $pref['cwriter_pich'] . "' /></td></tr>";

$cwriter_text .= "<tr><td class='forumheader3' style='width:30%;'>" . CWRITER_A55 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='cwriter_picw' value='" . $pref['cwriter_picw'] . "' /></td></tr>";

$cwriter_text .= "<tr><td class='forumheader3' style='width:30%;'>" . CWRITER_A56 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='cwriter_currency' value='" . $tp->toFORM($pref['cwriter_currency']) . "' /></td></tr>";

$cwriter_text .= "<tr><td class='forumheader3' style='width:30%;'>" . CWRITER_A57 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='cwriter_perpage' value='" . $pref['cwriter_perpage'] . "' /></td></tr>";

## html area for t&CC
$cwriter_text .= "
<tr><td class='forumheader3'>" . CWRITER_A58 . "</td><td class='forumheader3'>";
#	<textarea name='cwriter_terms' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['cwriter_terms'] . "</textarea></td></tr>";


    $insertjs = (!$pref['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
    "rows='20' style='width:100%' ";
    $cwriter_terms = $tp->toForm($pref['cwriter_terms']);
    $cwriter_text .= "<textarea class='tbox' id='cwriter_terms' name='cwriter_terms' cols='80'  style='width:95%' $insertjs>" . (strstr($cwriter_terms, "[img]http") ? $cwriter_terms : str_replace("[img]../", "[img]", $cwriter_terms)) . "</textarea>";

    if (!$pref['wysiwyg'])
    {
        $cwriter_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
    }



##end html
$cwriter_text .= "</td></tr>
<tr><td class='forumheader3'>" . CWRITER_A59 . "</td><td class='forumheader3'>
	<textarea name='cwriter_metad' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['cwriter_metad'] . "</textarea></td></tr>";

$cwriter_text .= "
<tr><td class='forumheader3'>" . CWRITER_A60 . "</td><td class='forumheader3'>
	<textarea name='cwriter_metak' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['cwriter_metak'] . "</textarea></td></tr>";

$cwriter_text .= "<tr><td class='forumheader' colspan='2' style='text-align:left;vertical-align:top;'>
<input class='button' name='savesettings' type='submit' value='" . CWRITER_A61 . "' /></td></tr>";

$cwriter_text .= "</table></form>";
$ns->tablerender(CWRITER_A1, $cwriter_text);
require_once(e_ADMIN . "footer.php");

?>