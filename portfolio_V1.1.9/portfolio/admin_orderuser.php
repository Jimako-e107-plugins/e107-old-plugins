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
require_once(e_ADMIN . "auth.php");

if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}

$portfolio_sel = $_POST['portfolio_sel'];
// * If we are updating then update or insert the record
if (isset($_POST['portfolio_save']))
{
    foreach ($_POST['portfolio_personorder'] as $portfolio_key => $portfolio_row)
    {
        $sql->db_Update("portfolio_person", " portfolio_person_order='" . $portfolio_row . "' where portfolio_person_id='$portfolio_key'");
    }
    $portfolio_msg .= PORTFOLIO_A13 ;
    $portfolio_obj->cache_clear();
}

$portfolio_text .= "
<form method='post' action='" . e_SELF . "' id='portfoliopo'>
	<table style='" . ADMIN_WIDTH . "'class='fborder'>
		<tr>
			<td class='fcaption' colspan='2'>" . PORTFOLIO_A62 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'><b>$portfolio_msg</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader' colspan='2'>" . PORTFOLIO_A47 . "</td>
		</tr>
		<tr>
			<td style='width:30%;' class='forumheader3'>" . PORTFOLIO_A11 . "</td>
			<td class='forumheader3'>
				<select name='portfolio_sel' class='tbox' onchange=\"this.form.submit()\">";

if ($sql->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent ='0' order by portfoliocat_order"))
{
    while ($portfolio_row = $sql->db_Fetch())
    {
        $portfolio_text .= "<option value='" . $portfolio_row['portfoliocat_id'] . "'>" . $tp->toFORM($portfolio_row['portfoliocat_name']) . "</option>";

        if ($sql2->db_Select("portfolio_cat", "portfoliocat_id,portfoliocat_name", "portfoliocat_parent =" . $portfolio_row['portfoliocat_id'] . " order by portfoliocat_order"))
        {
            while ($portfolio_row2 = $sql2->db_Fetch())
            {
                // extract($portfolio_row);
                $portfolio_text .= "<option value='" . $portfolio_row2['portfoliocat_id'] . "'" .
                ($portfolio_sel == $portfolio_row2['portfoliocat_id']?" selected='selected'":"") . ">" . "&nbsp;&raquo;&nbsp;" . $tp->toFORM($portfolio_row2['portfoliocat_name']) . "</option>";
            }
        }
    }
}
else
{
    $portfolio_text .= "<option value='0'>" . PORTFOLIO_A92 . "</option>";
}

$portfolio_text .= "
				</select>
			</td>
		</tr>
	</table>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td class='forumheader' colspan='2'>" . PORTFOLIO_A62 . "</td>
		</tr>";

if ($portfolio_count = $sql->db_Select("portfolio_person", "portfolio_person_id, portfolio_person_name,portfolio_person_order", " portfolio_person_cat='$portfolio_sel' order by portfolio_person_order "))
{
    while ($portfolio_row = $sql->db_Fetch())
    {
        extract($portfolio_row);
        $portfolio_text .= "
		<tr>
			<td style='width:30%;' class='forumheader3'>$portfolio_person_name</td>
			<td class='forumheader3'>
				<select name='portfolio_personorder[$portfolio_person_id]' class='tbox'>";
        for ($portfolio_i = 1;$portfolio_i <= $portfolio_count; $portfolio_i ++)
        {
            $portfolio_text .= "
				<option value='$portfolio_i'" .
            ($portfolio_person_order == $portfolio_i?" selected='selected' ":"") . ">$portfolio_i</option>";
        }
        $portfolio_text .= "
				</select>
			</td>
		</tr>";
    }
}
else
{
    $portfolio_text .= "
		<tr>
			<td style='width:30%;' class='forumheader3'>$portfolio_person_name</td>
			<td class='forumheader3'>
				<select name='portfolio_person[0]' class='tbox'>
					<option value='0'>None</option>
				</select>
			</td>
		</tr>";
}
$portfolio_text .= "
		<tr>
			<td colspan='2' class='fcaption'>
				<input type='submit' class='tbox' name='portfolio_save' value='" . PORTFOLIO_A48 . "' />
			</td>
		</tr>
	</table>
</form>";

$portfolio_caption = PORTFOLIO_A19;
$ns->tablerender($portfolio_caption, $portfolio_text);

require_once(e_ADMIN . "footer.php");

?>