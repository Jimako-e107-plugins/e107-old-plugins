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
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/admin/English.php");
}
$e_wysiwyg = "eclassf_terms";
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
    if ($pref['eclassf_thumbheight'] <> $_POST['eclassf_thumbheight'])
    {
        require_once("upload_pic.php");
        // Resize thumbnails
        if ($handle = opendir("./images/classifieds"))
        {
            while (false !== ($file = readdir($handle)))
            {
                // go through each file in the directory and create a thumbnail image
                // Do not try on index.htm or on existing thumbnails
                // All thumbnails are generated as type .jpg
                if ($file <> "." && $file <> ".." && $file <> "index.htm" && substr($file, 0, 6) <> "thumb_")
                {
                    makeThumbnail($file, $t_ht = $_POST['eclassf_thumbheight']);
                }
            }

            closedir($handle);
            $eclassf_msgtext .= ECLASSF_A116 . "<br />";
        }
    }
    $pref['eclassf_email'] = $tp->toDB($_POST['eclassf_email']);
    $pref['eclassf_approval'] = $tp->toDB($_POST['eclassf_approval']);
    $pref['eclassf_valid'] = $tp->toDB($_POST['eclassf_valid']);
    $pref['eclassf_read'] = $tp->toDB($_POST['eclassf_read']);
    $pref['eclassf_create'] = $tp->toDB($_POST['eclassf_create']);
    $pref['eclassf_admin'] = $tp->toDB($_POST['eclassf_admin']);
    $pref['eclassf_useremail'] = $tp->toDB($_POST['eclassf_useremail']);
    $pref['eclassf_pictype'] = $tp->toDB($_POST['eclassf_pictype']);
    $pref['eclassf_terms'] = $tp->toDB($_POST['eclassf_terms']);
    $pref['eclassf_perpage'] = $tp->toDB($_POST['eclassf_perpage']);
    $pref['eclassf_pich'] = $tp->toDB($_POST['eclassf_pich']);
    $pref['eclassf_picw'] = $tp->toDB($_POST['eclassf_picw']);
    $pref['eclassf_currency'] = $tp->toDB($_POST['eclassf_currency']);
    $pref['eclassf_metad'] = $tp->toDB($_POST['eclassf_metad']);
    $pref['eclassf_metak'] = $tp->toDB($_POST['eclassf_metak']);
    $pref['eclassf_leadz'] = $tp->toDB($_POST['eclassf_leadz']);
    $pref['eclassf_thumbs'] = $tp->toDB($_POST['eclassf_thumbs']);
    $pref['eclassf_icons'] = $tp->toDB($_POST['eclassf_icons']);
    $pref['eclassf_counter']=$tp->toDB($_POST['eclassf_counter']);
    $pref['eclassf_thumbheight'] = $tp->toDB($_POST['eclassf_thumbheight']);
    $pref['eclassf_subdrop'] = $tp->toDB($_POST['eclassf_subdrop']);
	$pref['eclassf_dformat'] = $tp->toDB($_POST['eclassf_dformat']);
	$pref['eclassf_userating'] = $tp->toDB($_POST['eclassf_userating']);
	save_prefs();

    $eclassf_msgtext .= ECLASSF_A14 ;
}

$eclassf_text = "<form id=\"config\" method=\"post\" action=\"" . e_SELF . "?update\">
		<table class=\"fborder\" width='97%'>";
$eclassf_text .= "<tr><td class='fcaption' colspan='2' style='text-align:left'>" . ECLASSF_A2 . "</td></tr>";

$eclassf_text .= "<tr><td class='forumheader3' colspan='2' style='text-align:left'><strong>$eclassf_msgtext</strong>&nbsp;</td></tr>";
// $eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A6 . "</td><td class='forumheader3'>
// <input class='tbox' style='width:190px' type='text' name='eclassf_email' value='" . $pref['eclassf_email'] . "' /></td></tr>";
$eclassf_text .= "
<tr><td class='forumheader3'>" . ECLASSF_A7 . "</td><td class='forumheader3'>
		<select class='tbox' name='eclassf_approval'>
			<option value='1' " . ($pref['eclassf_approval'] == "1" || empty($apreq)?"selected='selected'":"") . ">" . ECLASSF_A8 . "</option>
			<option value='0' " . ($pref['eclassf_approval'] <> "1"?"selected='selected'":"") . ">" . ECLASSF_A9 . "</option>
		</select>
	</td></tr>";
$eclassf_text .= "
<tr><td class='forumheader3'>" . ECLASSF_A10 . "</td><td class='forumheader3'>
	<input type='text' name='eclassf_valid' class='tbox' value='" . $pref['eclassf_valid'] . "' /><br /><i>" . ECLASSF_A11 . "</i></td></tr>";
$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A37 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_read", $pref['eclassf_read'], "off", 'public,guest, nobody, member, admin, classes') . "
</td></tr>";

$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A38 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_admin", $pref['eclassf_admin'], "off", 'nobody, member, admin, classes') . "
</td></tr>";
$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A53 . "</td>
<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_create", $pref['eclassf_create'], "off", 'nobody, member, admin, classes') . "
</td></tr>";
// date format
$eclassf_text .= "
<tr>
	<td style='width:30%' class='forumheader3'>" . ECLASSF_A122 . "</td>
	<td style='width:70%' class='forumheader3'>
		<select class='tbox' name='eclassf_dformat'>
			<option value='d-m-Y' ".($pref['eclassf_dformat']=="d-m-Y"?"selected='selected'":"").">d-m-Y</option>
			<option value='m-d-Y' ".($pref['eclassf_dformat']=="m-d-Y"?"selected='selected'":"").">m-d-Y</option>
			<option value='Y-m-d' ".($pref['eclassf_dformat']=="Y-m-d"?"selected='selected'":"").">Y-m-d</option>
		</select>
	</td>
</tr>";
$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A123 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='eclassf_userating' value='1'" .
($pref['eclassf_userating'] > 0?"checked='checked'":"") . " />
</td></tr>";


$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A39 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='eclassf_useremail' value='1'" .
($pref['eclassf_useremail'] > 0?"checked='checked'":"") . " />
</td></tr>";
$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A113 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='eclassf_icons' value='1'" .
($pref['eclassf_icons'] > 0?"checked='checked'":"") . " />
</td></tr>";
$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A120 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='eclassf_subdrop' value='1'" .
($pref['eclassf_subdrop'] > 0?"checked='checked'":"") . " />
</td></tr>";




$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A114 . "</td>
<td style='width:70%' class='forumheader3'>
	<input type='checkbox' class='tbox' name='eclassf_thumbs' value='1'" .
($pref['eclassf_thumbs'] > 0?"checked='checked'":"") . " />
</td></tr>";
$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A115 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_thumbheight' value='" . $pref['eclassf_thumbheight'] . "' /></td></tr>";

$eclassf_text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . ECLASSF_A40 . "</td>
<td style='width:70%' class='forumheader3'>
<select name='eclassf_pictype' class='tbox'>
<option value='0' " .
($pref['eclassf_pictype'] == 0?"selected='selected'":"") . ">" . ECLASSF_A98 . "</option>
<option value='1' " .
($pref['eclassf_pictype'] == 1?"selected='selected'":"") . ">" . ECLASSF_A99 . "</option>
<option value='2' " .
($pref['eclassf_pictype'] == 2?"selected='selected'":"") . ">" . ECLASSF_A100 . "</option>
</select>
</td></tr>";

$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A94 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_pich' value='" . $pref['eclassf_pich'] . "' /></td></tr>";

$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A93 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_picw' value='" . $pref['eclassf_picw'] . "' /></td></tr>";

$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A95 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_currency' value='" . $pref['eclassf_currency'] . "' /></td></tr>";

$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A42 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_perpage' value='" . $pref['eclassf_perpage'] . "' /></td></tr>";
$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A109 . "</td><td class='forumheader3'>
<input class='tbox' style='width:10%;' type='text' name='eclassf_leadz' value='" . $pref['eclassf_leadz'] . "' /></td></tr>";


$eclassf_text .= "<tr><td class='forumheader3' style='width:30%;'>" . ECLASSF_A117 . "</td><td class='forumheader3'>
	<select class='tbox' name='eclassf_counter'>
	<option value='NONE' " . ($pref['eclassf_counter'] == 'NONE'?"selected='selected'":"") . ">" . ECLASSF_A118 . "</option>
	<option value='ALL' " . ($pref['eclassf_counter'] == 'ALL'?"selected='selected'":"") . ">" . ECLASSF_A119 . "</option>
	<option value='cb' " . ($pref['eclassf_counter'] == 'cb'?"selected='selected'":"") . ">Coloured Blocks</option>
	<option value='crt' " . ($pref['eclassf_counter'] == 'crt'?"selected='selected'":"") . ">CRTs</option>
	<option value='flame' " . ($pref['eclassf_counter'] == 'flame'?"selected='selected'":"") . ">Flames</option>
	<option value='floppy' " . ($pref['eclassf_counter'] == 'floppy'?"selected='selected'":"") . ">Floppy Disks</option>
	<option value='heart' " . ($pref['eclassf_counter'] == 'heart'?"selected='selected'":"") . ">Hearts</option>
	<option value='jelly' " . ($pref['eclassf_counter'] == 'jelly'?"selected='selected'":"") . ">Jelly</option>
	<option value='lcd' " . ($pref['eclassf_counter'] == 'lcd'?"selected='selected'":"") . ">LCD HP Calculator</option>
	<option value='lcdg' " . ($pref['eclassf_counter'] == 'lcdg'?"selected='selected'":"") . ">LED Green</option>
	<option value='purple' " . ($pref['eclassf_counter'] == 'purple'?"selected='selected'":"") . ">Purple</option>
	<option value='slant' " . ($pref['eclassf_counter'] == 'slant'?"selected='selected'":"") . ">Slant</option>
	<option value='snowm' " . ($pref['eclassf_counter'] == 'snowm'?"selected='selected'":"") . ">Snowman</option>
	<option value='text' " . ($pref['eclassf_counter'] == 'text'?"selected='selected'":"") . ">Text</option>
	<option value='tree' " . ($pref['eclassf_counter'] == 'tree'?"selected='selected'":"") . ">Christmas Tree</option>
	<option value='turf' " . ($pref['eclassf_counter'] == 'turf'?"selected='selected'":"") . ">Turf</option>
	</select>
</td></tr>";

## html area for t&CC
$eclassf_text .= "
<tr><td class='forumheader3'>" . ECLASSF_A41 . "</td><td class='forumheader3'>";
#	<textarea name='eclassf_terms' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['eclassf_terms'] . "</textarea></td></tr>";


    $insertjs = (!$pref['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
    "rows='20' style='width:100%' ";
    $eclassf_terms = $tp->toForm($pref['eclassf_terms']);
    $eclassf_text .= "<textarea class='tbox' id='eclassf_terms' name='eclassf_terms' cols='80'  style='width:95%' $insertjs>" . (strstr($eclassf_terms, "[img]http") ? $eclassf_terms : str_replace("[img]../", "[img]", $eclassf_terms)) . "</textarea>";

    if (!$pref['wysiwyg'])
    {
        $eclassf_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
    }



##end html
$eclassf_text .= "</td></tr>
<tr><td class='forumheader3'>" . ECLASSF_A96 . "</td><td class='forumheader3'>
	<textarea name='eclassf_metad' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['eclassf_metad'] . "</textarea></td></tr>";

$eclassf_text .= "
<tr><td class='forumheader3'>" . ECLASSF_A97 . "</td><td class='forumheader3'>
	<textarea name='eclassf_metak' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $pref['eclassf_metak'] . "</textarea></td></tr>";

$eclassf_text .= "<tr><td class='forumheader' colspan='2' style='text-align:left;vertical-align:top;'>
<input class='button' name='savesettings' type='submit' value='" . ECLASSF_A15 . "' /></td></tr>";

$eclassf_text .= "</table></form>";
$ns->tablerender(ECLASSF_A12, $eclassf_text);
require_once(e_ADMIN . "footer.php");

?>