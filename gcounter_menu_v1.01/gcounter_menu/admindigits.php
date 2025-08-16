<?php
require_once("../../class2.php");

if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
} 

if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "gcounter_menu/languages/admin/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "gcounter_menu/languages/admin/" . e_LANGUAGE . ".php");
} 
else
{
    include_once(e_PLUGIN . "gcounter_menu/languages/admin/English.php");
} 

require_once(e_ADMIN . "auth.php");
$gcount_edit = false;
$gcount_db = new DB;
$gcount_action = $_POST['gcountaction'];
// * If we are updating then update or insert the record
if ($gcount_action == 'update')
{
    $gcount_edit = false;
    $gcount_id = $_POST['gcount_id'];
    if ($gcount_id == 0)
    { 
        // New record so add it
        $gcount_args = "
		'0',
		'" . $_POST['gcount_digit_namez'] . "',
		'" . $_POST['gcount_digit_postfix'] . "',
		'" . $_POST['gcount_digit_width'] . "',
		'" . $_POST['gcount_digit_height'] . "',
		'" . $_POST['gcount_digit_pad'] . "'";
        if ($gcount_db->db_Insert("gcount_digits", $gcount_args))
        {
            $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A26 . "</b></td></tr>";
        } 
        else
        {
            $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A27 . "</b></td></tr>";
        } 
    } 
    else
    { 
        // Update existing
        $gcount_args = "
		gcount_digit_name='" . $_POST['gcount_digit_namez'] . "',
		gcount_digit_postfix='" . $_POST['gcount_digit_postfix'] . "',
		gcount_digit_width='" . $_POST['gcount_digit_width'] . "',
		gcount_digit_height='" . $_POST['gcount_digit_height'] . "',
		gcount_digit_pad='" . $_POST['gcount_digit_pad'] . "'
		where gcount_digit_id='$gcount_id'";
        if ($gcount_db->db_Update("gcount_digits", $gcount_args))
        { 
            // Changes saved
            $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A26 . "</b></td></tr>";
        } 
        else
        {
            $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A27 . "</b></td></tr>";
        } 
    } 
} 
// We are creating, editing or deleting a record
if ($gcount_action == 'dothings')
{
    $gcount_id = $_POST['gcount_selcat'];
    $gcount_do = $_POST['gcount_recdel'];
    $gcount_dodel = false;
    $gcount_edit = true;
    switch ($gcount_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $gcount_db->db_Select("gcount_digits", "*", "gcount_digit_id='$gcount_id'");
                $gcount_row = $gcount_db->db_Fetch() ;
                extract($gcount_row);
                $gcount_digit_namez = $gcount_digit_name;
                $gcount_cap1 = GCOUNT_A29;
                break;
            } 
        case '2': // New department
            {
                // Create new record
                $gcount_id = 0; 
                // set all fields to zero/blank
                $gcount_digit_name = "";
                $gcount_cap1 = GCOUNT_A28;
                break;
            } 
        case '3':
            {
                $gcount_edit = false; 
                // delete the record
                if ($_POST['gcount_okdel'] == '1')
                {
                    if ($gcount_db->db_Delete("gcount_digits", " gcount_digit_id='$gcount_id'"))
                    {
                        $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A32 . "</b></td></tr>";
                    } 
                    else
                    {
                        $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A33 . "</b></td></tr>";
                    } 
                } 
                else
                {
                    $gcount_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . GCOUNT_A30 . "</b></td></tr>";
                } 
                $gcount_dodel = true;
            } 
    } 
    if (!$gcount_dodel)
    {
        $gcount_text .= "<form id='gcountformupdate' method='post' action='" . e_SELF . "'>
		<input type='hidden' value='$gcount_id' name='gcount_id' />
		<input type='hidden' value='update' name='gcountaction' />
		<table width='97%' class='fborder'>
		
		<tr><td colspan='2' class='fcaption'>$gcount_cap1</td></tr>
		$gcount_msg
		<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A24 . "</td><td  class='forumheader3'><input type='text' class='tbox' size='30' name='gcount_digit_namez' value='$gcount_digit_namez' /></td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A20 . "</td><td  class='forumheader3'><input type='text' class='tbox'  size='20' name='gcount_digit_postfix' value='$gcount_digit_postfix' /></td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A21 . "</td><td  class='forumheader3'><input type='text' class='tbox'  size='10' name='gcount_digit_width' value='$gcount_digit_width' /></td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A22 . "</td><td  class='forumheader3'><input type='text' class='tbox' size='10' name='gcount_digit_height' value='$gcount_digit_height' /></td></tr>
		<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A23 . "</td><td  class='forumheader3'><input type='text' class='tbox' size='10'name='gcount_digit_pad' value='$gcount_digit_pad' /></td></tr>
		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . GCOUNT_A25 . "' class='tbox' /></td></tr>
		</table></form>";
    } 
} 
if (!$gcount_edit)
{
    $gcount2_db = new DB;
    if ($gcount2_db->db_Select("gcount_digits", "gcount_digit_id,gcount_digit_name", " order by gcount_digit_name", "nowhere"))
    {
        while ($gcount_row = $gcount2_db->db_Fetch())
        {
            extract($gcount_row);
            $gcount_catopt .= "<option value='$gcount_digit_id'" .
            ($gcount_id == $gcount_digit_id?" selected='selected'":"") . ">$gcount_digit_name</option>";
        } 
    } 

    $gcount_text .= "<form id='deptform' method='post' action='" . e_SELF . "'>
	<input type='hidden' value='dothings' name='gcountaction' />
	<table width='97%' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . GCOUNT_A13 . "</td></tr>$gcount_msg
	<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A13 . "</td><td  class='forumheader3'><select name='gcount_selcat' class='tbox'>$gcount_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . GCOUNT_A14 . "</td><td  class='forumheader3'>
	<input type='radio' name='gcount_recdel' value='1' checked='checked' /> " . GCOUNT_A15 . "<br />
	<input type='radio' name='gcount_recdel' value='2' /> " . GCOUNT_A16 . "<br />
	<input type='radio' name='gcount_recdel' value='3' /> " . GCOUNT_A17 . "
	<input type='checkbox' name='gcount_okdel' value='1' />" . GCOUNT_A18 . "</td></tr>
	<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . GCOUNT_A19 . "' class='tbox' /></td></tr>
	</table></form>";
} 
$gcount_caption = GCOUNT_A19;
$ns->tablerender(GCOUNT_A1, $gcount_text);

require_once(e_ADMIN . "footer.php");

?>