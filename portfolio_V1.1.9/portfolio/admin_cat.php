<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
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
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
require_once(e_HANDLER . "ren_help.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
$e_wysiwyg = "portfoliocat_desctop,portfoliocat_descleft";
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
$portfolio_ed = false;
$portfolio_action = $_POST['portfolioaction'];
// * If we are updating then update or insert the record
if (isset($_POST['savedept']))
{
    $portfolio_id = intval($_POST['portfolio_id']);
    if ($portfolio_id == 0)
    {
        // New record so add it
        $portfolio_args = "
		'0',
		'" . $tp->toDB($_POST['portfoliocat_namez']) . "',
		'" . $tp->toDB($_POST['portfoliocat_description']) . "',
		'" . time() . "',
		'" . time() . "','0',
		'" . intval($_POST['portfoliocat_parent']) . "'";
        if ($portfolio_id = $sql->db_Insert("portfolio_cat", $portfolio_args, false))
        {
            $portfolio_msg .= PORTFOLIO_CAT_14;
        }
        else
        {
            $portfolio_msg .= PORTFOLIO_CAT_15;
        }
    }
    else
    {
        // Update existing
        $portfolio_args = "
		portfoliocat_name='" . $tp->toDB($_POST['portfoliocat_namez']) . "',
		portfoliocat_description='" . $tp->toDB($_POST['portfoliocat_description']) . "',
		portfoliocat_parent='" . intval($_POST['portfoliocat_parent']) . "',
		portfoliocat_updated='" . time() . "'
		where portfoliocat_id='$portfolio_id'";
        if ($sql->db_Update("portfolio_cat", $portfolio_args, false))
        {
            // Changes saved
            $portfolio_msg .= PORTFOLIO_CAT_16;
        }
        else
        {
            $portfolio_msg .= PORTFOLIO_CAT_15;
        }
    }
    $portfolio_obj->cache_clear();
}
// We are creating, editing or deleting a record
if ($portfolio_action == 'dothings')
{
    $portfolio_id = $_POST['portfolio_selcat'];
    $portfolio_do = $_POST['portfolio_recdel'];
    $portfolio_dodel = false;
    $portfolio_ed = true;
    switch ($portfolio_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("portfolio_cat", "*", "portfoliocat_id='$portfolio_id'");
                $portfolio_row = $sql->db_Fetch() ;
                extract($portfolio_row);
                $portfoliocat_namez = $portfoliocat_name;
                $portfolio_cap1 = PORTFOLIO_CAT_18;
                break;
            }
        case '2': // New portfolio
            {
                // Create new record
                $portfolio_id = 0;
                // set all fields to zero/blank
                $portfoliocat_namez = "";
                $portfolio_cap1 = PORTFOLIO_CAT_17;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['portfolio_okdel'] == '1')
                {
                    if ($sql->db_Select("portfolio_person", "portfolio_person_id", "where portfolio_person_cat = '$portfolio_id' ", "nowhere", false))
                    {
                        $portfolio_msg .= PORTFOLIO_A109 ;
                    } elseif ($sql->db_Select("portfolio_cat", "portfoliocat_id", "where portfoliocat_parent = '$portfolio_id' ", "nowhere", false))
                    {
                        $portfolio_msg .= PORTFOLIO_A110 ;
                    } elseif ($sql->db_Delete("portfolio_cat", " portfoliocat_id='$portfolio_id'"))
                    {
                        $portfolio_obj->cache_clear();
                        $portfolio_msg .= PORTFOLIO_A18 ;
                    }
                    else
                    {
                        $portfolio_msg .= PORTFOLIO_A20;
                    }
                }
                else
                {
                    $portfolio_msg .= PORTFOLIO_A59 ;
                }
                $portfolio_dodel = true;
                $portfolio_ed = false;
            }
    }
    if (!$portfolio_dodel)
    {
        // Get list of files
        $portfolio_parentsel = "<select class='tbox' name='portfoliocat_parent'>";
        $portfolio_parentsel .= "<option value='0'>" . PORTFOLIO_CAT_13 . "</option>";
        if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_id <> '$portfolio_id' and portfoliocat_parent='0'"))
        {
            while ($portfolio_row = $sql->db_Fetch())
            {
                extract($portfolio_row);
                $portfolio_parentsel .= "<option value='$portfoliocat_id'" .
                ($portfoliocat_id == $portfoliocat_parent?"selected='selected'":"") . ">" . $portfoliocat_name . "</option>";
            }
        }
        $portfolio_parentsel .= "</select>";
        if ($handle = opendir("./uploads/category"))
        {
            $portfolio_urls .= "<option value=''> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                    $portfolio_urls .= "<option value='" . $file . "' " .
                    ($file == $tp->toFORM($portfoliocat_imageurl) ? " selected " : " ") . ">" . $file . "</option>";
            }
            closedir($handle);
        }

        $portfolio_text .= "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='" . $portfolio_id . "' name='portfolio_id' />
		<input type='hidden' value='update' name='portfolioaction' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . $portfolio_cap1 . "</td>
		</tr>
		" . $portfolio_msg . "
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_CAT_12 . "</td>
			<td  class='forumheader3'>" . $portfolio_parentsel . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_A27 . "</td>
			<td  class='forumheader3'>
				<input type='text' size = '60%' class='tbox' name='portfoliocat_namez' value='" . $tp->toForm($portfoliocat_namez) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_A33 . "</td>
			<td  class='forumheader3'>";
        $insertjs = (!$pref['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\"":
        "rows='20' style='width:100%' ";
        $portfoliocat_desctop = $tp->toForm($portfoliocat_desctop);
        $portfolio_text .= "<textarea class='tbox' id='portfoliocat_description' name='portfoliocat_description' cols='80'  style='width:95%' $insertjs>" . (strstr($portfoliocat_description, "[img]http") ? $portfoliocat_description : str_replace("[img]../", "[img]", $portfoliocat_description)) . "</textarea>";
        if (!$pref['wysiwyg'])
        {
            $portfolio_text .= "
					<input  type='text' class='helpbox' id='helpb' name='helpb' style='width:100%'/><br />" . display_help("helpb");
        }
        $portfolio_text .= "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>
				<input type='submit' name='savedept' value='" . PORTFOLIO_A8 . "' class='tbox' />
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
    }
}
if (!$portfolio_ed)
{
    // Get the portfolio names to display in combo box
    // then display actions available
    $portfolio_new = false;
    if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent ='0' order by portfoliocat_order"))
    {
        $portfolio_new = true;
        while ($portfolio_row = $sql->db_Fetch())
        {
            $portfolio_catopt .= "<option value='" . $portfolio_row['portfoliocat_id'] . "'>" . $tp->toFORM($portfolio_row['portfoliocat_name']) . "</option>";

            if ($sql2->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent =" . $portfolio_row['portfoliocat_id'] . " order by portfoliocat_order"))
            {
                while ($portfolio_row2 = $sql2->db_Fetch())
                {
                    // extract($portfolio_row);
                    $portfolio_catopt .= "<option value='" . $portfolio_row2['portfoliocat_id'] . "'" .
                    ($portfolio_id == $portfolio_row2['portfoliocat_id']?" selected='selected'":"") . ">" . "&nbsp;&raquo;&nbsp;" . $tp->toFORM($portfolio_row2['portfoliocat_name']) . "</option>";
                }
            }
        }
    }
    else
    {
        $portfolio_catopt .= "<option value='0'>" . PORTFOLIO_CAT_02 . "</option>";
    }

    $portfolio_text .= "
<form id='deptform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='portfolioaction' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . PORTFOLIO_CAT_03 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>" . $portfolio_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_CAT_04 . "</td>
			<td  class='forumheader3'>
				<select name='portfolio_selcat' class='tbox'>" . $portfolio_catopt . "</select>
			</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_CAT_08 . "</td>
			<td  class='forumheader3'><input type='radio' name='portfolio_recdel' value='1' " . ($portfolio_new?"checked='checked'":"disabled='disabled'") . " /> " . PORTFOLIO_CAT_05 . "<br />
				<input type='radio' name='portfolio_recdel' value='2' " . (!$portfolio_new?"checked='checked'":"") . "/> " . PORTFOLIO_CAT_06 . "<br />
				<input type='radio' name='portfolio_recdel' value='3' /> " . PORTFOLIO_CAT_07 . "
				<input type='checkbox' name='portfolio_okdel' value='1' />" . PORTFOLIO_CAT_09 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><input type='submit' name='submits' value='" . PORTFOLIO_CAT_10 . "' class='tbox' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
}

$ns->tablerender(PORTFOLIO_CAT_01, $portfolio_text);

require_once(e_ADMIN . "footer.php");

?>