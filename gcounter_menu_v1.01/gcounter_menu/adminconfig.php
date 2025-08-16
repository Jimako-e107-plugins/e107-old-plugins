<?php

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
} 
require_once(e_ADMIN . "auth.php");
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "gcounter_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "gcounter_menu/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "gcounter_menu/languages/admin/English.php");
} 

if (e_QUERY == "update")
{ 
    // Update rest
    $pref['gcount_mode'] = $_POST['gcount_mode'];
    $pref['gcount_random'] = $_POST['gcount_random'];
    $pref['gcount_current'] = $_POST['gcount_current'];

    save_prefs();
    $gcount_msgtext = "<tr><td class='forumheader3' colspan = '2'><strong>" . GCOUNT_A10 . "</strong></td></tr>";
} 
if (empty($pref['gcount_mode']))
{
    $pref['gcount_mode'] = 0;
} 
$text .= "<form method='post' action='" . e_SELF . "?update' id='confgcount'>
<table style='width: 97%;' class='fborder'>
<tr><td colspan='2' class='fcaption'>" . GCOUNT_A2 . "</td></tr>$gcount_msgtext";
$text .= "
<tr>
<td style='width:30%'  valign='top' class='forumheader3'>" . GCOUNT_A4 . "</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='radio' name='gcount_mode' value='1'" .
($pref['gcount_mode'] == 1?" checked='checked'" :"") . " />" . GCOUNT_C1 . "<br />
<input class='tbox' type='radio' name='gcount_mode' value='2'" .
($pref['gcount_mode'] == 2?" checked='checked'" :"") . " />" . GCOUNT_C2 . "<br />
<input class='tbox' type='radio' name='gcount_mode' value='3'" .
($pref['gcount_mode'] == 3?" checked='checked'" :"") . " />" . GCOUNT_C3 . "<br />
<input class='tbox' type='radio' name='gcount_mode' value='4'" .
($pref['gcount_mode'] == 4?" checked='checked'" :"") . " />" . GCOUNT_C4 . "
</td>
</tr>
<tr>
<td style='width:30%; ' valign='top' class='forumheader3'>" . GCOUNT_A3 . "</td>
<td style='width:70%' class='forumheader3'>
<input class='tbox' type='radio' name='gcount_random' value='0'" .
($pref['gcount_randomdisplay'] == 0?" checked='checked'" :"") . " />" . GCOUNT_A6 . "<br />
<input class='tbox' type='radio' name='gcount_random' value='1'" .
($pref['gcount_random'] == 1?" checked='checked'" :"") . " />" . GCOUNT_A7 . "
</td>
</tr>";
// Current Set
$gcount_sel = "<select name='gcount_current' class='tbox'>
<option value='0'>" . GCOUNT_A11 . "</option>";
$gcount_db = new DB;
if ($gcount_db->db_Select("gcount_digits", "*", " order by gcount_digit_name", "nowhere"))
{
    while ($gcount_row = $gcount_db->db_Fetch())
    {
        extract($gcount_row);
        $gcount_sel .= "<option value='" . $gcount_digit_id . "'";
        if ($pref['gcount_current'] == $gcount_digit_id)
        {
            $gcount_sel .= " selected='selected' " ;
        } 
        $gcount_sel .= ">" . $gcount_digit_name . "</option>";
    } 
} 
$gcount_sel .= "</select>";
$text .= "
<tr>
<td style='width:30%' class='forumheader3'>" . GCOUNT_A8 . "</td>
<td style='width:70%' class='forumheader3'>$gcount_sel</td>
</tr>";
// Submit button
$text .= "
<tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='" . GCOUNT_A9 . "' class='button' />\n
</td>
</tr>";

$text .= "</table></form>";

$ns->tablerender(GCOUNT_A1, $text);

require_once(e_ADMIN . "footer.php");

?>