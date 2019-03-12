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

if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
require_once(HEADERF);

if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%;");
}
$portfolio_ed = false;
$portfolio_action = $_POST['portfolioaction'];
// * If we are updating then update or insert the record
if ($portfolio_action == 'update')
{
    $portfolio_id = $_POST['portfolio_id'];
    if ($portfolio_id == 0)
    {
        // New record
        $portfolio_show = $_POST['portfolio_person_show'][0];
        $portfolio_args = "
		'0',
		'" . $tp->toDB($_POST['portfolio_person_name']) . "',
		'" . $tp->toDB($_POST['portfolio_person_title']) . "',
		'" . $tp->toDB($_POST['portfolio_person_phone']) . "',
		'" . $tp->toDB($_POST['portfolio_person_email']) . "',
		'" . $tp->toDB($_POST['portfolio_person_websiteurl']) . "',
		'" . $tp->toDB($_POST['portfolio_person_websitename']) . "',
		'" . $tp->toDB($_POST['portfolio_person_biography']) . "',
		'" . $tp->toDB($_POST['portfolio_person_cat']) . "',
		'" . time() . "',
		'" . time() . "','0',
		'$portfolio_show',
		'" . $tp->toDB($_POST['portfolio_person_showemail']) . "',
		'" . $tp->toDB($_POST['portfolio_person_showphone']) . "',
		'" . $tp->toDB($_POST['portfolio_person_showimage']) . "',
		'" . $tp->toDB($_POST['portfolio_person_showdetails']) . "',
		'" . $tp->toDB($_POST['portfolio_person_bigpic']) . "'";
        if ($portfolio_id = $sql->db_Insert("portfolio_person", $portfolio_args))
        {
            $portfolio_msg .= PORTFOLIO_A37;
        }
        else
        {
            $portfolio_msg .= PORTFOLIO_A89 ;
        }
    }
    else
    {
        // Update existing
        $portfolio_show = $_POST['portfolio_person_show'][0];
        $portfolio_args = "
		portfolio_person_name='" . $tp->toDB($_POST['portfolio_person_name']) . "',
		portfolio_person_title='" . $tp->toDB($_POST['portfolio_person_title']) . "',
		portfolio_person_phone='" . $tp->toDB($_POST['portfolio_person_phone']) . "',
		portfolio_person_email='" . $tp->toDB($_POST['portfolio_person_email']) . "',
		portfolio_person_websiteurl='" . $tp->toDB($_POST['portfolio_person_websiteurl']) . "',
		portfolio_person_websitename='" . $tp->toDB($_POST['portfolio_person_websitename']) . "',
		portfolio_person_biography='" . $tp->toDB($_POST['portfolio_person_biography']) . "',
		portfolio_person_cat='" . $tp->toDB($_POST['portfolio_person_cat']) . "',
		portfolio_person_updated='" . time() . "',
		portfolio_person_showemail='" . $tp->toDB($_POST['portfolio_person_showemail']) . "',
		portfolio_person_showphone='" . $tp->toDB($_POST['portfolio_person_showphone']) . "',
		portfolio_person_showimage='" . $tp->toDB($_POST['portfolio_person_showimage']) . "',
		portfolio_person_showdetails='" . $tp->toDB($_POST['portfolio_person_showdetails']) . "',
		portfolio_person_bigpic='" . $tp->toDB($_POST['portfolio_person_bigpic']) . "'
		where portfolio_person_id='$portfolio_id'";
        if ($sql->db_Update("portfolio_person", $portfolio_args))
        {
            $portfolio_msg .= PORTFOLIO_A13 ;
        }
        else
        {
            $portfolio_msg .= PORTFOLIO_A89 ;
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
                $sql->db_Select("portfolio_person", "*", "where portfolio_person_id='$portfolio_id'", "nowhere");
                $portfolio_row = $sql->db_Fetch() ;
                extract($portfolio_row);
                $portfolio_person_namez = $portfolio_person_name;
                $portfolio_cap1 = PORTFOLIO_A38;
                break;
            }
        case '2': // New Staff member
            {
                $portfolio_id = 0;
                // set all fields to zero/blank
                $portfolio_person_name = "";
                $portfolio_person_title = "";
                $portfolio_person_phone = "";
                $portfolio_person_email = "";
                $portfolio_person_websiteurl = "";
                $portfolio_person_biography = "";
                $persont_dept = "0";
                $personshow = 0;
                $portfolio_cap1 = PORTFOLIO_A39;
                break;
            }
        case '3':
            {
                if ($_POST['portfolio_okdel'] == '1')
                {
                    if ($sql->db_Delete("portfolio_person", " portfolio_person_id='$portfolio_id'"))
                    {
                        $portfolio_msg .= PORTFOLIO_A60 ;
                        $portfolio_obj->cache_clear();
                    }
                    else
                    {
                        $portfolio_msg .= PORTFOLIO_A20 ;
                    }
                }
                else
                {
                    $portfolio_msg .= PORTFOLIO_A59;
                }

                $portfolio_dodel = true;
                $portfolio_ed = false;
            }
    }
    if (!$portfolio_dodel)
    {
        // Get list of files for image
        if ($handle = opendir("./images/staff"))
        {
            $portfolio_urls .= "<option value=''> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                    $portfolio_urls .= "<option value='$file' " .
                    ($file == $portfolio_person_websiteurl ? " selected " : " ") . ">$file</option>";
            }

            closedir($handle);
        }
        // Get list of files for BIG image
        if ($handle = opendir("./images/staff"))
        {
            $portfolio_burls .= "<option value=''> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                    $portfolio_burls .= "<option value='$file' " .
                    ($file == $portfolio_person_bigpic ? " selected " : " ") . ">$file</option>";
            }

            closedir($handle);
        }
        // Get list of people staff can be assigned to
#        $sql->db_Select("portfolio_cat", "*", " order by portfoliocat_parent", "nowhere", false);
#        while ($portfolio_row = $sql->db_Fetch())
#        {
#            extract($portfolio_row);
#            $portfolio_opts .= "<option value='$portfoliocat_id' " .
#            ($portfoliocat_parent==0?"disabled='disabled'":"").
#            ($portfoliocat_id == $portfolio_person_cat ? " selected='selected' " : " ") . ">$portfoliocat_name</option>";
#        }
    if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent ='0' order by portfoliocat_order"))
    {
        while ($portfolio_row = $sql->db_Fetch())
        {
            $portfolio_opts .= "<option value='" . $portfolio_row['portfoliocat_id'] . "' disabled='disabled'>" . $tp->toFORM($portfolio_row['portfoliocat_name']) . "</option>";

            if ($sql2->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent =" . $portfolio_row['portfoliocat_id'] . " order by portfoliocat_order"))
            {
                while ($portfolio_row2 = $sql2->db_Fetch())
                {
                    // extract($portfolio_row);
                    $portfolio_opts .= "<option value='" . $portfolio_row2['portfoliocat_id'] . "'" .
                    ($portfolio_person_cat == $portfolio_row2['portfoliocat_id']?" selected='selected'":"") . ">" . "&nbsp;&raquo;&nbsp;" . $tp->toFORM($portfolio_row2['portfoliocat_name']) . "</option>";
                }
            }
        }
    }
    else
    {
        $portfolio_catopt .= "<option value='0'>" . PORTFOLIO_A92 . "</option>";
    }
        $portfolio_text .= "
<form id='deptformupdate' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='$portfolio_id' name='portfolio_id' />
		<input type='hidden' value='update' name='portfolioaction' />
	</div>";
$portfolio_text .=  $tp->parseTemplate($PORTFOLIO_EDIT_PERSON, false, $portfolio_shortcodes);
$portfolio_text .= "
</form>";
    }
}
if (!$portfolio_ed)
{
    // Get the portfolio names to display in combo box
    // then display actions available
        $portfolio_new = false;
    if ($sql2->db_Select("portfolio_person", "portfolio_person_id,portfolio_person_name", " order by portfolio_person_name", "nowhere"))
    {
        $portfolio_new = true;
        while ($portfolio_row = $sql2->db_Fetch())
        {
            extract($portfolio_row);
            $portfolio_catopt .= "<option value='$portfolio_person_id'" .
            ($portfolio_person_id == $portfolio_id?" selected='selected'":"") . ">$portfolio_person_name</option>";
        }
    }
    else
    {
        $portfolio_catopt .= "<option value='0'>" . PORTFOLIO_A93 . "</option>";
    }

    $portfolio_text .= "
<form id='deptform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='portfolioaction' />
	</div>
	<table style='" . USER_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . PORTFOLIO_A52 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>$portfolio_msg</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_A12 . "</td>
			<td  class='forumheader3'><select name='portfolio_selcat' class='tbox'>$portfolio_catopt</select></td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . PORTFOLIO_A56 . "</td>
			<td  class='forumheader3'>
				<input type='radio' name='portfolio_recdel' value='1' checked='checked' /> " . PORTFOLIO_A49 . "<br />
				<input type='radio' name='portfolio_recdel' value='2' /> " . PORTFOLIO_A50 . "<br />
				<input type='radio' name='portfolio_recdel' value='3' /> " . PORTFOLIO_A51 . "
				<input type='checkbox' name='portfolio_okdel' value='1' />" . PORTFOLIO_A58 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'><input type='submit' value='" . PORTFOLIO_A48 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";
}

$portfolio_caption = PORTFOLIO_A52;
$ns->tablerender($portfolio_caption, $portfolio_text);

require_once(FOOTERF);

?>