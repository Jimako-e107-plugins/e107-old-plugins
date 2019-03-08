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

$hdu_ac_action = $_POST['hdu_ac_action'];
// * If we are updating then update or insert the record
if ($hdu_ac_action == 'update')
{
    $hdu_ac_id = intval($_POST['hdures_id']);
    if (empty($_POST['hdures_resolution']))
    {
        $hdu_ac_text2 .= HDU_A188 ;
        $hdu_ac_action = 'dothings';
        $_POST['hdu_ac_selres'] = $hdu_ac_id;
        $_POST['hdu_ac_recdel'] = 1;
    }
    else
    {
        if ($hdu_ac_id == 0)
        {
            // New record so add it
            $hdu_ac_args = "
		'0',
		'" . $tp->toDB($_POST['hdures_resolution']) . "',
		0,
		'" . $tp->toDB($_POST['hdures_help']) . "',
		'" . intval($_POST['hdures_closed']) . "'," . time();

            if ($sql->db_Insert("hdu_resolve", $hdu_ac_args))
            {
                $hdu_msg .= HDU_A85;
            }
            else
            {
                $hdu_msg .= HDU_A87;
            }
        }
        else
        {
            // Update existing
            $hdu_ac_args = "
		hdures_resolution='" . $tp->toDB($_POST['hdures_resolution']) . "',
		hdures_help='" . $tp->toDB($_POST['hdures_help']) . "',
		hdures_closed='" . intval($_POST['hdures_closed']) . "',
		hdures_lastupdate='" . time() . "'
		where hdures_id='$hdu_ac_id'";
            if ($sql->db_Update("hdu_resolve", $hdu_ac_args))
            {
                // Changes saved
                $hdu_msg .= HDU_A86;
            }
            else
            {
                $hdu_msg .= HDU_A88 ;
            }
        }
        $helpdesk_obj->helpdesk_cache_clear();
    }
}
// We are creating, editing or deleting a record
if ($hdu_ac_action == 'dothings')
{
    $hdu_ac_id = $_POST['hdu_ac_selres'];
    $hdu_ac_do = $_POST['hdu_ac_recdel'];
    $hdu_ac_dodel = false;

    switch ($hdu_ac_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("hdu_resolve", "*", "hdures_id='$hdu_ac_id'");
                $hdu_ac_row = $sql->db_Fetch() ;
                extract($hdu_ac_row);
                // $dept_namez=$dept_name;
                $hdu_ac_cap1 = HDU_A89;
                $hdu_ed = true;
                break;
            }
        case '2': // New department
            {
                // Create new record
                $hdures_id = 0;
                // set all fields to zero/blank
                $hdures_resolution = "";
                $hdures_help = "";
                $hdures_closed = 0;
                $hdu_ac_cap1 = HDU_A90;
                $hdu_ed = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['hdu_ac_okdel'] == '1')
                {
                    // We are going to delete this record
                    if (($sql->db_Count("hdunit", "(*)", "where hdu_resolution='$hdu_ac_id'") > 0) || $HELPDESK_PREF['hduprefs_defaultres'] == $hdu_ac_id || $HELPDESK_PREF['hduprefs_autocloseres'] == $hdu_ac_id)
                    {
                        // Record in use
                        $hdu_msg .= HDU_A104 ;
                    }
                    else
                    {
                        // Record not in use
                        if ($sql->db_Delete("hdu_resolve", " hdures_id='$hdu_ac_id'"))
                        {
                            // Deleted record OK
                            $helpdesk_obj->helpdesk_cache_clear();
                            $hdu_msg .= HDU_A102 ;
                        }
                        else
                        {
                            // Error deleting record
                            $hdu_msg .= HDU_A103 ;
                        }
                    }
                }
                else
                {
                    // Not confirmed deletion
                    $hdu_msg .= HDU_A91 . " " . HDU_A13 ;
                }
                $hdu_ac_dodel = true;
            } # End case
    } # end switch
    if (!$hdu_ac_dodel)
    {
        $hdu_ac_text .= "
<form id='deptformupdate' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='$hdures_id' name='hdures_id' />
		<input type='hidden' value='update' name='hdu_ac_action' />
		<input type='hidden' value='" . $_POST['hdu_ac_selres'] . "' name='hdu_ac_selres' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>$hdu_ac_cap1</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A92 . "</td>
			<td class='forumheader3'><input type='text' size='30' maxlength='30' class='tbox' name='hdures_resolution' value='" . $tp->toFORM($hdures_resolution) . "' /></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A105 . "</td>
			<td class='forumheader3'><textarea rows='5' cols='40' name='hdures_help' class='tbox'>" . $tp->toFORM($hdures_help) . "</textarea></td>
		</tr>";
        // Escalate on posted date or last action date
        $hdu_ac_text .= "
		<tr>
			<td style='vertical-align:top;' class='forumheader3'>" . HDU_A133 . "</td>
			<td style='vertical-align:top;' class='forumheader3'>
				<input type='radio' style='border:0px;'  class='radio' name='hdures_closed' id='hdures_closedY' value='1' " .
        ($hdures_closed == 1 ?"checked='checked'":"") . " /><label for='hdures_closedY' > " . HDU_A28 . "</label><br />
				<input type='radio' style='border:0px;' class='radio' name='hdures_closed' id='hdures_closedN' value='0' " .
        ($hdures_closed == 0 ?"checked='checked'":"") . " /><label for='hdures_closedN' > " . HDU_A29 . "</label>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><input type='submit' name='submitit' value='" . HDU_A101 . "' class='button' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
    }
}
if (!$hdu_ed)
{
    // Get the resolution names to display in combo box
    // then display actions available
    $hdu_ac_yes = false;
    if ($sql->db_Select("hdu_resolve", "hdures_id,hdures_resolution", " order by hdures_resolution", "nowhere"))
    {
        $hdu_ac_yes = true;
        while ($hdu_ac_row = $sql->db_Fetch())
        {
            extract($hdu_ac_row);
            $hdu_ac_catopt .= "<option value='$hdures_id' " . ($hdures_id == $_POST['hdu_ac_selres']?"selected='selected'":"") . ">" . $tp->toFORM($hdures_resolution) . "</option>";
        }
    }
    else
    {
        $hdu_ac_catopt .= "<option value='0'>" . HDU_A136 . "</option>";
    }
    $hdu_ac_text .= "
	<form id='hducatform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='hdu_ac_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . HDU_A94 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>$hdu_msg</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A43 . "</td><td  class='forumheader3'><select name='hdu_ac_selres' class='tbox'>$hdu_ac_catopt</select></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A59 . "</td><td class='forumheader3'><input type='radio' style='border:0px;' name='hdu_ac_recdel'  class='radio' id='hdu_ac_recdelE'  value='1' " . ($hdu_ac_yes?"checked='checked'":"disabled='disabled'") . " /><label for='hdu_ac_recdelE' > " . HDU_A75 . "</label><br />
				<input type='radio' name='hdu_ac_recdel' style='border:0px;' class='radio' id='hdu_ac_recdelN' value='2' " . (!$hdu_ac_yes?"checked='checked'":"") . "/><label for='hdu_ac_recdelN' > " . HDU_A76 . "</label><br />
				<input type='radio' name='hdu_ac_recdel' style='border:0px;' class='radio' id='hdu_ac_recdelD' value='3' /><label for='hdu_ac_recdelD' > " . HDU_A77 . "</label>
				<input type='checkbox'  style='border:0px;'  name='hdu_ac_okdel' id='hdu_ac_okdel' class='tbox' value='1' /><label for='hdu_ac_okdel' > " . HDU_A78 . "</label>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><input type='submit' name='submits' value='" . HDU_A100 . "' class='button' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
	</form>";
}

$ns->tablerender(HDU_A2, $hdu_ac_text);
require_once(e_ADMIN . "footer.php");

?>