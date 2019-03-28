<?php
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
require_once("includes/faq_class.php");
if (!is_object($faq_obj)) {
	$faq_obj=new FAQ;
}
if (!$faq_obj->faq_viewstats)
{
    require_once(HEADERF);
    print "Not permitted to view stats";
    require_once(FOOTERF);
    exit;
}
$barl = (file_exists(THEME . "images/barl.png") ? THEME . "images/barl.png" : e_PLUGIN . "poll/images/barl.png");
$barr = (file_exists(THEME . "images/barr.png") ? THEME . "images/barr.png" : e_PLUGIN . "poll/images/barr.png");
$bar = (file_exists(THEME . "images/bar.png") ? THEME . "images/bar.png" : e_PLUGIN . "poll/images/bar.png");

require_once(HEADERF);
// Top Items
// Top 10 popular authors
// top 10 popular books
// top 10 rated books
// top 10 rated authors
$faq_gen = new convert;
$faq_dlurl = e_BASE;

$numfaqs = $sql->db_Count("faq", "(*)", "where faq_approved > 0", false);

$numcats = $sql->db_Count("faq_info", "(*)", "where faq_info_parent>0", false);

$sql->db_Select("faq", "sum(faq_views) as numviews", "where faq_approved>0", false);
$faq_row = $sql->db_Fetch();
$numviews = $faq_row['numviews'];

$sql->db_Select("faq", "sum(faq_unique) as numunique", "where faq_approved>0", false);
$faq_row = $sql->db_Fetch();
$numunique = $faq_row['numunique'];

$faq_arg = "select count(c.comment_item_id) as numcom from #comments as c
left join #faq as m on comment_item_id =faq_id
where faq_approved > 0 and comment_type='3'";

$sql->db_Select_gen($faq_arg, false);
$faq_row = $sql->db_Fetch();
$numcom = $faq_row['numcom'];

$latedl .= "
<table class='fborder' style='width:100%;'>
	<tr>
		<td class='fcaption' colspan='4'>" . FAQLAN_110 . "</td>
	</tr>";
if (file_exists("./images/faq_logo.png"))
{
    $latedl .= "<tr><td class='forumheader3' colspan='4' style='text-align:center;'><img src='./images/faq_logo.png' alt='logo' title='' /></td></tr>";
}
$latedl .= "

	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_109 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . FAQLAN_107 . "</td>
		<td class='forumheader3' colspan='2'>" . $numfaqs . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . FAQLAN_108 . "</td>
		<td class='forumheader3' colspan='2'>" . $numcats . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . FAQLAN_111 . "</td>
		<td class='forumheader3' colspan='2'>" . $numviews . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>" . FAQLAN_112 . "</td>
		<td class='forumheader3' colspan='2'>" . $numunique . "</td>
	</tr>

	<tr>
		<td class='forumheader3' colspan='2'>" . FAQLAN_113 . "</td>
		<td class='forumheader3' colspan='2'>" . $numcom . "</td>
	</tr>			";
// ********************************************************************
// ********************************************************************
// Top 10 by views
// ********************************************************************
// ********************************************************************
$latedl .= "

	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_120 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_121 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_122 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top 10 by views
$sql->db_Select("faq", "faq_id,faq_question,faq_views,faq_parent", "where faq_approved>0 order by faq_views desc limit 0,10", "nowhere", false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['faq_views'] / $numviews) * 100), 2);
    $latedl .= "
    <tr>
    	<td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent']."." . $faq_row['faq_id'] . "'><strong>" . $tp->toHTML($faq_row['faq_question']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['faq_views'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10 by views
// ********************************************************************
// ********************************************************************
// Top 10 by unique views
// ********************************************************************
// ********************************************************************
$latedl .= "

	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_124 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_121 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_122 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top 10 by unique views
$sql->db_Select("faq", "faq_id,faq_question,faq_unique,faq_parent", "where faq_approved>0 order by faq_unique desc limit 0,10", "nowhere", false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['faq_unique'] / $numunique) * 100), 2);
    $latedl .= "
    <tr>
    	<td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent']."." . $faq_row['faq_id'] . "'><strong>" . $tp->toHTML($faq_row['faq_question']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['faq_unique'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10 by views
// ********************************************************************
// ********************************************************************
// Top 10  posters
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_125 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_127 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_126 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top 10 authors
$sql->db_Select("faq", "faq_author, count(faq_author) as numpost", "where faq_approved > 0 group by faq_author order by numpost desc limit 0,10", "nowhere", false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['numpost'] / $numfaqs) * 100), 2);
    $faq_tmp = explode(".", $faq_row['faq_author'], 2);
    $latedl .= "
	<tr>
		<td class='forumheader3' ><a href='" . "../../user.php?id." . $faq_tmp[0] . "'><strong>" . $tp->toFORM($faq_tmp[1]) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10  posters
// ********************************************************************
if ($FAQ_PREF['faq_rating'] > 0)
{
    // ********************************************************************
    // Top 10  by rating
    // ********************************************************************
    // ********************************************************************
    $latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_128 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_121 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_130 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
    // Get top 10 authors
    $faq_arg = "select r.*,m.*, r.rate_rating/r.rate_votes as rating from #rate as r
left join #faq as m on rate_itemid=faq_id
where rate_table='faq' and faq_approved > 0
order by rating desc
limit 0,10";
    $sql->db_Select_gen($faq_arg, false);
    while ($faq_row = $sql->db_Fetch())
    {
        $percentage = round((($faq_row['rating'] / 10) * 100), 2);
        $latedl .= "
    <tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent']."." . $faq_row['faq_id'] . "' ><strong>" . $tp->toFORM($faq_row['faq_question']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['rating'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
    } // while
    // end // Top 10 by rating
    // ********************************************************************
}
// Top 10 by comments
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_129 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_121 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_132 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top 10 recipes by comments
$faq_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #faq as m on comment_item_id =faq_id
where faq_approved > 0 and comment_type='3' group by comment_item_id order by numpost desc limit 0,10";

$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['numpost'] / $numcom) * 100), 2);
    $latedl .= "
	<tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent']."." . $faq_row['faq_id'] . "' ><strong>" . $tp->toFORM($faq_row['faq_question']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // Top 10 by comments
// ********************************************************************
// Top 10 Categories by FAQ
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_133 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_131 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_126 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top categories by number of recipes
$faq_arg = "select COUNT(r.faq_id) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved > 0
group by faq_info_id
order by numpost desc
limit 0,10";
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['numpost'] / $numfaqs) * 100), 2);

    $latedl .= "
	<tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent'].".0' ><strong>" . $tp->toFORM($faq_row['faq_info_title']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
// end // top categories by number of faqs
// ********************************************************************
// Top 10 Categories by views
// ********************************************************************
// ********************************************************************
$latedl .= "
	<tr>
		<td class='forumheader' colspan='4'>" . FAQLAN_134 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:45%;'>" . FAQLAN_131 . "</td>
		<td class='forumheader2' style='width:5%;'>" . FAQLAN_122 . "</td>
		<td class='forumheader2' style='width:10%;'>" . FAQLAN_123 . "</td>
		<td class='forumheader2' style='width:40%;'>&nbsp;</td>
	</tr>";
// Get top 10 categories by views
$faq_arg = "select sum(faq_views) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved>0 and faq_views>0
group by faq_info_id
order by numpost desc
limit 0,10";
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $percentage = round((($faq_row['numpost'] / $numviews) * 100), 2);
    $latedl .= "
	<tr>
        <td class='forumheader3' ><a href='" . e_PLUGIN . "faq/faq.php?0.cat.".$faq_row['faq_parent'].".0' ><strong>" . $tp->toFORM($faq_row['faq_info_title']) . "</strong></a></td>
		<td class='forumheader3' >" . $faq_row['numpost'] . "</td>
		<td class='forumheader3' >" . $percentage . "</td>
		<td class='forumheader3'>
			<div style='background-image: url($barl); width: 5px; height: 14px; float: left;'></div>
			<div style='background-image: url($bar); width: " . intval($percentage) / 2 . "%; height: 14px; float: left;'></div>
			<div style='background-image: url($barr); width: 5px; height: 14px; float: left;'></div>
		</td>
	</tr>";
} // while
$latedl .= "</table>";

$ns->tablerender(FAQLAN_110, $latedl);
require_once(FOOTERF);

?>