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
require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
$cwriter_action = $_POST['cwriter_action'];
$cwriter_edit = false;
// * If we are updating then update or insert the record
if ($cwriter_action == 'update')
{
    $cwriter_id = $_POST['cwriter_id'];
    if ($cwriter_id == 0)
    {
        // New record so add it
        $cwriter_args = "
		'0',
		'" . $tp->toDB($_POST['cwriter_catname']) . "',
		'" . $tp->toDB($_POST['cwriter_catdesc']) . "',
		'" . $tp->toDB($_POST['cwriter_catclass']) . "',
		'" . $tp->toDB($_POST['cwriter_caticon']) . "'";
        if ($sql->db_Insert("cwriter_cats", $cwriter_args))
        {
            $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A28 . "</strong></td></tr>";
        }
    }
    else
    {
        // Update existing
        $cwriter_args = "
		cwriter_catname='" . $tp->toDB($_POST['cwriter_catname']) . "',
		cwriter_catdesc='" . $tp->toDB($_POST['cwriter_catdesc']) . "',
		cwriter_catclass='" . $tp->toDB($_POST['cwriter_catclass']) . "',
		cwriter_caticon='" . $tp->toDB($_POST['cwriter_caticon']) . "'
		where cwriter_catid='$cwriter_id'";
        if ($sql->db_Update("cwriter_cats", $cwriter_args))
        {
            // Changes saved
            $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . ECLASSF_A28 . "</b></td></tr>";
        }
    }
}
// We are creating, editing or deleting a record
if ($cwriter_action == 'dothings')
{
    $cwriter_id = $_POST['cwriter_selcat'];
    $cwriter_do = $_POST['cwriter_recdel'];
    $cwriter_dodel = false;

    switch ($cwriter_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("cwriter_cats", "*", "cwriter_catid='$cwriter_id'");
                $cwriter_row = $sql->db_Fetch() ;
                extract($cwriter_row);
                $cwriter_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $cwriter_id = 0;
                // set all fields to zero/blank
                $cwriter_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['cwriter_okdel'] == '1')
                {
                    if ($sql->db_Select("cwriter_subcats", "cwriter_subid", " where cwriter_ccatid='$cwriter_id'", "nowhere"))
                    {
                        $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A29 . "</strong></td></tr>";
                    }
                    else
                    {
                        if ($sql->db_Delete("cwriter_cats", " cwriter_catid='$cwriter_id'"))
                        {
                            $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A30 . "</strong></td></tr>";
                        }
                        else
                        {
                            $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A31 . "</strong></td></tr>";
                        }
                    }
                }
                else
                {
                    $cwriter_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . ECLASSF_A32 . "</strong></td></tr>";
                }

                $cwriter_dodel = true;
                $cwriter_edit = false;
            }
    }

    if (!$cwriter_dodel)
    {
        $cwriter_iconlist = "<select name='cwriter_caticon' class='tbox'>";
        if ($handle = opendir("./images/icons"))
        {
            $cwriter_iconlist .= "<option value=\"\"> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                {

                    $cwriter_iconlist .= "<option value=\"" . $file . "\" " .
                    ($file == $cwriter_caticon ? " selected " : " ") . ">" . $file . "</option>";
                }
            }

            closedir($handle);
        }
        $cwriter_iconlist .= "</select>";
        $cwriter_text .= "
		<form id='myclassupdate' method='post' action='" . e_SELF . "'>

		<table style='width:97%;' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . ECLASSF_A17 . "
		<input type='hidden' value='$cwriter_id' name='cwriter_id' />
		<input type='hidden' value='update' name='cwriter_action' /></td></tr>
		$cwriter_msg
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A25 . "</td><td  class='forumheader3'><input type='text' class='tbox' name='cwriter_catname' value='$cwriter_catname' /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A26 . "</td><td  class='forumheader3'><textarea rows='6' cols='50' class='tbox' name='cwriter_catdesc' >$cwriter_catdesc</textarea><br /></td></tr>
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A27 . "</td><td style='width:70%' class='forumheader3'>" . r_userclass("cwriter_catclass", $cwriter_catclass, "off", 'public, nobody, member, admin, classes') . "
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_95 . "</td><td  class='forumheader3'>" . $cwriter_iconlist . "</td></tr>
		<tr><td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . ECLASSF_A24 . "' class='tbox' /></td></tr>
		</table></form>";
    }
}
if (!$cwriter_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $cwriter_yes=false;
    if ($sql2->db_Select("cwriter_cats", "cwriter_catid,cwriter_catname", " order by cwriter_catname", "nowhere"))
    {
    $cwriter_yes=true;
        while ($cwriter_row = $sql2->db_Fetch())
        {
            #extract($cwriter_row);
            $cwriter_catopt .= "<option value='".$cwriter_row['cwriter_catid']."'" .
            ($cwriter_id == $cwriter_row['cwriter_catid']?" selected='selected'":"") . ">".$cwriter_row['cwriter_catname']."</option>";
        }
    }
    else
    {
        $cwriter_catopt .= "<option value='0'>" . ECLASSF_A18 . "</option>";
    }

    $cwriter_text .= "
	<form id='myclassform' method='post' action='" . e_SELF . "'>

	<table width='97%' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . ECLASSF_A3 . "	<input type='hidden' value='dothings' name='cwriter_action' /></td></tr>
	$cwriter_msg
	<tr><td style='width:20%;' class='forumheader3'>" . ECLASSF_A3 . "</td><td  class='forumheader3'>
	<select name='cwriter_selcat' class='tbox'>$cwriter_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . ECLASSF_A19 . "</td><td  class='forumheader3'>
	<input type='radio' name='cwriter_recdel' value='1' ".($cwriter_yes?"checked='checked'":"disabled='disabled'")." /> " . ECLASSF_A20 . "<br />
	<input type='radio' name='cwriter_recdel' value='2' ".(!$cwriter_yes?"checked='checked'":"")."/> " . ECLASSF_A21 . "<br />
	<input type='radio' name='cwriter_recdel' value='3' /> " . ECLASSF_A22 . "
	<input type='checkbox' name='cwriter_okdel' value='1' />" . ECLASSF_A23 . "</td></tr>
	<tr><td colspan='2' class='fcaption'>
	<input type='submit' name='submits' value='" . ECLASSF_A24 . "' class='tbox' /></td></tr>


	</table></form>";
}

$ns->tablerender(ECLASSF_A1, $cwriter_text);

require_once(e_ADMIN . "footer.php");

?>