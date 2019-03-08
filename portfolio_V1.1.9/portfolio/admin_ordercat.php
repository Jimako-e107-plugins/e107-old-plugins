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
*/require_once("../../class2.php");
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
    // print_a($_POST['portfolio_order']);
    foreach ($_POST['portfolio_order'] as $key => $portfolio_row)
    {
        $sql->db_Update("portfolio_cat", " portfoliocat_order = '" . $portfolio_row . "' where portfoliocat_id = '$key'");
    }
    $portfolio_msg .= PORTFOLIO_A13 ;
    $portfolio_obj->cache_clear();
}

$portfolio_text .= "
<form method = 'post' action = '" . e_SELF . "'  id = 'portfoliopo'>
	<table style='" . ADMIN_WIDTH . "' class = 'fborder'>
		<tr>
			<td class = 'fcaption' colspan = '2'>" . PORTFOLIO_CAT_11 . "</td>
		</tr>
		<tr>
			<td class = 'forumheader2' colspan = '2'><b>$portfolio_msg</b>&nbsp;</td>
		</tr>";

if ($portfolio_pcount = $sql->db_Select("portfolio_cat", "portfoliocat_id, portfoliocat_name,portfoliocat_order", "where portfoliocat_parent = 0 order by portfoliocat_order ", "nowhere"))
{
    while ($portfolio_row = $sql->db_Fetch())
    {
        $portfolio_text .= "
		<tr>
			<td class='forumheader3'><b>" . $tp->toHTML($portfolio_row['portfoliocat_name'], false) . "</b></td>
			<td class='forumheader3'>
				<select class='tbox' name='portfolio_order[" . $portfolio_row['portfoliocat_id'] . "]'>";
        for($portfolio_i = 1;$portfolio_i <= $portfolio_pcount;$portfolio_i++)
        {
            $portfolio_text .= "
					<option value = '$portfolio_i'" . ($portfolio_row['portfoliocat_order'] == $portfolio_i?" selected='selected' ":"") . ">$portfolio_i</option>";
        }
        $portfolio_text .= "
				</select></td>
		</tr>";

        if ($portfolio_ccount = $sql2->db_Select("portfolio_cat", "portfoliocat_id, portfoliocat_name,portfoliocat_order", "where portfoliocat_parent = " . $portfolio_row['portfoliocat_id'] . " order by portfoliocat_order asc", "nowhere"))
        {
            while ($portfolio_row2 = $sql2->db_Fetch())
            {
                $portfolio_text .= "
		<tr>
			<td style = 'width:30%;' class = 'forumheader3'>&nbsp;&raquo;&nbsp;" . $tp->toHTML($portfolio_row2['portfoliocat_name'], false) . "</td>
			<td class = 'forumheader3'>
				<select name='portfolio_order[" . $portfolio_row2['portfoliocat_id'] . "]' class = 'tbox'>";
                for ($portfolio_j = 1;$portfolio_j <= $portfolio_ccount; $portfolio_j ++)
                {
                    $portfolio_text .= "
					<option value = '$portfolio_j'" . ($portfolio_row2['portfoliocat_order'] == $portfolio_j?" selected='selected' ":"") . ">$portfolio_j</option>";
                }
                $portfolio_text .= "
				</select>
			</td>
		</tr>";
            }
        }
    }
}
else
{
    $portfolio_text .= "
		<tr>
			<td style = 'width:30%;' class = 'forumheader3'>$portfoliocat_name</td>
			<td class = 'forumheader3'>
				<select name='portfolio_cat[]' class = 'tbox'>
				<option value = '0'>None</option>
				</select>
				<input type = 'hidden' name = 'portfolio_catordder[]' value = '$portfoliocat_id' />
			</td>
		</tr>";
}
$portfolio_text .= "
		<tr>
			<td colspan = '2' class = 'forumheader2'>
				<input type = 'submit' class = 'tbox' name = 'portfolio_save' value = '" . PORTFOLIO_A48 . "' />
			</td>
		</tr>
		<tr>
			<td colspan = '2' class = 'fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";

$portfolio_caption = PORTFOLIO_CAT_01;
$ns->tablerender($portfolio_caption, $portfolio_text);

require_once(e_ADMIN . "footer.php");

?>