<?php
// **************************************************************************
// *
// *  Newslink Menu for e107 v7xx
// *
// **************************************************************************
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
require_once(e_PLUGIN."newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$newslink_action = $_POST['newslink_action'];
$newslink_edit = false;
// * If we are updating then update or insert the record
if ($newslink_action == 'update')
{
    $newslink_id = $_POST['newslink_id'];
    if ($newslink_id == 0)
    {
        // New record so add it
        $newslink_args = "
		'0',
		'" . $tp->toDB($_POST['newslink_category_name']) . "',
		'" . $tp->toDB($_POST['newslink_category_description']) . "'," . time() . ",
		'" . $tp->toDB($_POST['newslink_category_read']) . "'";
        if ($sql->db_Insert("newslink_category", $newslink_args))
        {
            $newslink_msg .= "<strong>" . NEWSLINK_A26 . "</strong>";
        }
        else
        {
            $newslink_msg .= "<strong>" . NEWSLINK_A27 . "</strong>";
        }
    }
    else
    {
        // Update existing
        $newslink_args = "
		newslink_category_name='" . $tp->toDB($_POST['newslink_category_name']) . "',
		newslink_category_description='" . $tp->toDB($_POST['newslink_category_description']) . "',
		newslink_category_read='" . $tp->toDB($_POST['newslink_category_read']) . "',
		newslink_category_updated='" . time() . "'
		where newslink_category_id='$newslink_id'";
        if ($sql->db_Update("newslink_category", $newslink_args))
        {
            // Changes saved
            $newslink_msg .= "<strong>" . NEWSLINK_A28 . "</strong>";
        }
        else
        {
            $newslink_msg .= "<strong>" . NEWSLINK_A29 . "</strong>";
        }
    }
}
// We are creating, editing or deleting a record
if ($newslink_action == 'dothings')
{
    $newslink_id = $_POST['newslink_selcat'];
    $newslink_do = $_POST['newslink_recdel'];
    $newslink_dodel = false;

    switch ($newslink_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("newslink_category", "*", "newslink_category_id='$newslink_id'");
                $newslink_row = $sql->db_Fetch() ;
                extract($newslink_row);
                $newslink_cap1 = NEWSLINK_A24;
                $newslink_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $newslink_id = 0;
                // set all fields to zero/blank
                $newslink_category_name = "";
                $newslink_category_description = "";
                $newslink_cap1 = NEWSLINK_A23;
                $newslink_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['newslink_okdel'] == '1')
                {
                    if ($sql->db_Select("newslink_newslink", "newslink_id", " where newslink_category='$newslink_id'", "nowhere"))
                    {
                        $newslink_msg .= "<strong>" . NEWSLINK_A59 . "</strong>";
                    }
                    else
                    {
                        if ($sql->db_Delete("newslink_category", " newslink_category_id='$newslink_id'"))
                        {
                            $newslink_msg .= "<strong>" . NEWSLINK_A30 . "</strong>";
                        }
                        else
                        {
                            $newslink_msg .= "<strong>" . NEWSLINK_A32 . "</strong>";
                        }
                    }
                }
                else
                {
                    $newslink_msg .= "<strong>" . NEWSLINK_A31 . "</strong>";
                }

                $newslink_dodel = true;
                $newslink_edit = false;
            }
    }

    if (!$newslink_dodel)
    {
        $newslink_text .= "
<form id='catupdate' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='$newslink_id' name='newslink_id' />
		<input type='hidden' value='update' name='newslink_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>$newslink_cap1</td>
		</tr>
		<tr>
			<td style='width:20%;vertical-align:top;' class='forumheader3'>" . NEWSLINK_A21 . "</td>
			<td  class='forumheader3'><input type='text' class='tbox' name='newslink_category_name' value='" . $tp->toFORM($newslink_category_name) . "' /></td>
		</tr>
		<tr>
			<td style='width:20%;vertical-align:top;' class='forumheader3'>" . NEWSLINK_A22 . "</td>
			<td  class='forumheader3'><textarea rows='6' cols='50' class='tbox' name='newslink_category_description' >" . $tp->toFORM($newslink_category_description) . "</textarea><br /></td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . NEWSLINK_A80 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("newslink_category_read", $newslink_category_read) . "</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'><input type='submit' name='submits' value='" . NEWSLINK_A10 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";
    }
}
if (!$newslink_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $newslink_yes = false;
    if ($sql2->db_Select("newslink_category", "newslink_category_id,newslink_category_name", " order by newslink_category_name", "nowhere"))
    {
        $newslink_yes = true;
        while ($newslink_row = $sql2->db_Fetch())
        {
            extract($newslink_row);
            $newslink_catopt .= "<option value='$newslink_category_id'" .
            ($newslink_id == $newslink_category_id?" selected='selected'":"") . ">$newslink_category_name</option>";
        }
    }
    else
    {
        $newslink_catopt .= "<option value='0'>" . NEWSLINK_A19 . "</option>";
    }

    $newslink_text .= "
<form id='catform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='newslink_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . NEWSLINK_A11 . "	</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'>$newslink_msg&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . NEWSLINK_A12 . "</td><td  class='forumheader3'><select name='newslink_selcat' class='tbox'>" . $newslink_catopt . "</select></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . NEWSLINK_A18 . "</td>
			<td  class='forumheader3'>
				<input type='radio' name='newslink_recdel' value='1' " . ($newslink_yes?"checked='checked'":"disabled='disabled'") . " /> " . NEWSLINK_A13 . "<br />
				<input type='radio' name='newslink_recdel' value='2'" . (!$newslink_yes?"checked='checked'":"") . " /> " . NEWSLINK_A14 . "<br />
				<input type='radio' name='newslink_recdel' value='3' /> " . NEWSLINK_A15 . "
				<input type='checkbox' name='newslink_okdel' value='1' />" . NEWSLINK_A16 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>
				<input type='submit' name='submits' value='" . NEWSLINK_A17 . "' class='tbox' />
			</td>
		</tr>
	</table>
</form>";
}

$ns->tablerender(NEWSLINK_A2, $newslink_text);

require_once(e_ADMIN . "footer.php");

?>