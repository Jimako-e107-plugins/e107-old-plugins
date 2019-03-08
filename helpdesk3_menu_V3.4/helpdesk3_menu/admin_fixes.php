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

$hdu_ac_edit = false;
$hdu_ac_action = $_POST['action'];
// * If we are updating then update or insert the record
if ($hdu_ac_action == 'update')
{
    $hdu_ac_id = intval($_POST['hdufix_id']);
    if (empty($_POST['hdufix_fix']))
    {
        $hdu_ac_text2 .= HDU_A187 ;
        $hdu_ac_action = 'dothings';
        $_POST['hdu_ac_selfix'] = $hdu_ac_id;
        $_POST['hdu_ac_recdel'] = 1;
    }
    else
    {
        if ($hdu_ac_id == 0)
        {
            // New record so add it
            $hdu_ac_args = "
		'0',
		'" . $tp->toDB($_POST['hdufix_fix']) . "',
		'" . $tp->toDB($_POST['hdufix_fixcost']) . "',
		0," . time();
            if ($sql->db_Insert("hdu_fixes", $hdu_ac_args))
            {
                // inserted ok
                $hdu_ac_msg .= HDU_A65 ;
            }
            else
            {
                // failed to insert
                $hdu_ac_msg .= HDU_A67 ;
            }
            $hdu_ac_edit = false;
        }
        else
        {
            // Update existing
            $hdu_ac_args = "
		hdufix_fix='" . $tp->toDB($_POST['hdufix_fix']) . "',
		hdufix_fixcost='" . $tp->toDB($_POST['hdufix_fixcost']) . "',
		hdufix_lastupdate='" . time() . "'
		where hdufix_id='$hdu_ac_id'";
            if ($sql->db_Update("hdu_fixes", $hdu_ac_args))
            {
                // Changes saved
                $hdu_ac_msg .= HDU_A66 ;
            }
            else
            {
                // failed to save changes
                $hdu_ac_msg .= HDU_A68;
            }
            $hdu_ac_edit = false;
        }
        $helpdesk_obj->helpdesk_cache_clear();
    }
}
// We are creating, editing or deleting a record
if ($hdu_ac_action == 'dothings')
{
    $hdu_ac_id = intval($_POST['hdu_ac_selfix']);
    $hdu_ac_do = intval($_POST['hdu_ac_recdel']);
    $hdu_ac_dodel = false;

    switch ($hdu_ac_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("hdu_fixes", "*", "hdufix_id='$hdu_ac_id'");
                $hdu_ac_row = $sql->db_Fetch() ;
                extract($hdu_ac_row);
                $hdu_ac_cap1 = HDU_A69;
                $hdu_ac_edit = true;

                break;
            }
        case '2': // New department
            {
                // Create new record
                $hdufix_id = 0;
                // set all fields to zero/blank
                $hdufix_fix = "";
                $hdufix_cost = 0;
                $hdu_ac_cap1 = HDU_A70;
                $hdu_ac_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['hdu_ac_okdel'] == '1')
                {
                    // We are going to delete this record
                    if ($sql->db_Count("hdunit", "(*)", "where hdu_fix='$hdu_ac_id'"))
                    {
                        // Record in use
                        $hdu_ac_msg .= HDU_A84 ;
                    }
                    else
                    {
                        // Record not in use
                        if ($sql->db_Delete("hdu_fixes", " hdufix_id='$hdu_ac_id'"))
                        {
                            // Deleted record OK
                            $hdu_ac_msg .= HDU_A82;
                            $helpdesk_obj->helpdesk_cache_clear();
                        }
                        else
                        {
                            // Error deleting record
                            $hdu_ac_msg .= HDU_A83 ;
                        }
                    }
                }
                else
                {
                    // Not confirmed deletion
                    $hdu_ac_msg .= HDU_A71 ;
                }
                $hdu_ac_dodel = true;
                $hdu_ac_edit = false;
            } # End case
    } # end switch
    if (!$hdu_ac_dodel)
    {
        $hdu_ac_text .= "
<form id='deptformupdate' method='post' action=''>
	<div>
		<input type='hidden' value='$hdufix_id' name='hdufix_id' />
		<input type='hidden' value='update' name='action' />
		<input type='hidden' name='hdu_ac_selfix' value='" . $_POST['hdu_ac_selfix'] . "' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>$hdu_ac_cap1</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A72 . "</td>
			<td  class='forumheader3'><input type='text' size='30' maxlength='30' class='tbox' name='hdufix_fix' value='" . $tp->toFORM($hdufix_fix) . "' /></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A132 . "</td>
			<td  class='forumheader3'><input type='text' size='12' maxlength='10' class='tbox' name='hdufix_fixcost' value='" . $tp->toFORM($hdufix_fixcost) . "' style='text-align:right;' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'><input type='submit' name='submitit' value='" . HDU_A81 . "' class='button' /></td>
		</tr>
	</table>
</form>";
    }
}
if (!$hdu_ac_edit)
{
    // Get the department names to display in combo box
    // then display actions available
    $hdu_ac_yes = false;
    if ($sql->db_Select("hdu_fixes", "hdufix_id,hdufix_fix", " order by hdufix_fix", "nowhere"))
    {
        $hdu_ac_yes = true;
        while ($hdu_ac_row = $sql->db_Fetch())
        {
            extract($hdu_ac_row);
            $hdu_ac_catopt .= "<option value='$hdufix_id' " . ($hdufix_id == $_POST['hdu_ac_selfix']?"selected='selected'":"") . ">" . $tp->toFORM($hdufix_fix) . "</option>";
        }
    }
    else
    {
        $hdu_ac_catopt .= "<option value='0'>" . HDU_A135 . "</option>";
    }
    $hdu_ac_text .= "
<form id='hducatform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . HDU_A74 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>" . $hdu_ac_msg . "</b>&nbsp;</td>
		</tr>

		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A44 . "</td>
			<td class='forumheader3'><select name='hdu_ac_selfix' class='tbox'>$hdu_ac_catopt</select></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . HDU_A59 . "</td><td class='forumheader3'><input type='radio' style='border:0px;' name='hdu_ac_recdel'  class='radio' id='hdu_ac_recdelE'  value='1' " . ($hdu_ac_yes?"checked='checked'":"disabled='disabled'") . " /><label for='hdu_ac_recdelE' > " . HDU_A75 . "</label><br />
				<input type='radio' name='hdu_ac_recdel' style='border:0px;' class='radio' id='hdu_ac_recdelN' value='2' " . (!$hdu_ac_yes?"checked='checked'":"") . "/><label for='hdu_ac_recdelN' > " . HDU_A76 . "</label><br />
				<input type='radio' name='hdu_ac_recdel' style='border:0px;' class='radio' id='hdu_ac_recdelD' value='3' /><label for='hdu_ac_recdelD' > " . HDU_A77 . "</label>
				<input type='checkbox'  style='border:0px;'  name='hdu_ac_okdel' id='hdu_ac_okdel' class='tbox' value='1' /><label for='hdu_ac_okdel' > " . HDU_A78 . "</label>
			</td>
		</tr>
				<tr>
			<td colspan='2' class='forumheader2'><input type='submit' name='submits' value='" . HDU_A80 . "' class='button' /></td>
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