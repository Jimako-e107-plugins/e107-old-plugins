<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
if (!defined('RPRINT_WIDTH'))
{
    define(RPRINT_WIDTH, "width:100%;");
}
global $tp, $REVIEWER_PREF, $sql, $gen, $reviewer_shortcodes, $reviewer_logoexists, $reviewer_caticon, $reviewer_colspan, $reviewer_votes, $reviewer_items_picture,
$reviewer_rate1, $reviewer_rate2, $reviewer_rate3, $reviewer_rate4, $reviewer_rate5, $reviewer_rate6, $reviewer_rate7, $reviewer_rate8, $reviewer_rate9, $reviewer_rate10,
$reviewer_category_name, $reviewer_items_name, $reviewer_items_description, $reviewer_reviewer_postername, $reviewer_reviewer_posted, $reviewer_reviewer_review,
$reviewer_reviewer_rate1, $reviewer_reviewer_rate2, $reviewer_reviewer_rate3, $reviewer_reviewer_rate4, $reviewer_reviewer_rate5, $reviewer_reviewer_rate6, $reviewer_reviewer_rate7, $reviewer_reviewer_rate8, $reviewer_reviewer_rate9, $reviewer_reviewer_rate10,
$reviewer_category_rate1, $reviewer_category_rate2, $reviewer_category_rate3, $reviewer_category_rate4, $reviewer_category_rate5, $reviewer_category_rate6, $reviewer_category_rate7, $reviewer_category_rate8, $reviewer_category_rate9, $reviewer_category_rate10,
$reviewer_use1, $reviewer_use2, $reviewer_use3, $reviewer_use4, $reviewer_use5, $reviewer_use6, $reviewer_use7, $reviewer_use8, $reviewer_use9, $reviewer_use10;
// **********************************************************************************************************************
// **********************************************************************************************************************
// * Terms and conditions
// **********************************************************************************************************************
// **********************************************************************************************************************
// **********************************************************************************************************************
// * View a record
// **********************************************************************************************************************
if (!isset($REVIEWER_PRINTABLE_HEADER))
{
    $REVIEWER_PRINTABLE_HEADER = "
<table class='fborder' style='" . RPRINT_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='2' >" . REVIEWER_H001 . "</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_PRINTABLE_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='2' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_PRINTABLE_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='2' ><b>{REVIEWER_ITEMNAME}</b>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:left' >{REVIEWER_ITEMDESC}&nbsp;</td>
	</tr>";
}
if (!isset($REVIEWER_PRINTABLE_DETAIL))
{
    $REVIEWER_PRINTABLE_DETAIL = "
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V001 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_POSTER}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V002 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_POSTDATE=d/m/Y}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V003 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_COMMENTS}</td>
	</tr>	";

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
        <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE1}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE1}</td>
		</tr>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE2}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE2}</td>
		</tr>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE3}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE3}</td>
		</tr>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE4}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE4}</td>
		</tr>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE5}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE5}</td>
	</tr>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE6}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE6}</td>
	</tr>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE7}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE7}</td>
	</tr>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE8}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE8}</td>
	</tr>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE9}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE9}</td>
	</tr>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_PRINTABLE_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE10}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE10}</td>
	</tr>";
    }
}
if (!isset($REVIEWER_PRINTABLE_FOOTER))
{
    $REVIEWER_PRINTABLE_FOOTER = "
	<tr>
		<td class='fcaption' colspan='2' >&nbsp;</td>
	</tr>
</table>";
}
// **********************************************************************************************************************
// **********************************************************************************************************************
// *  Show the items details and all the  reviews for this item
// **********************************************************************************************************************
// **********************************************************************************************************************
if (!isset($REVIEWER_PRINTITEM_HEADER))
{
    $reviewer_colleft = intval($reviewer_colspan / 2);
    $reviewer_colright = $reviewer_colspan - $reviewer_colleft;

    $REVIEWER_PRINTITEM_HEADER = "<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >" . REVIEWER_H001 . "</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_PRINTITEM_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_PRINTITEM_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' ><b>{REVIEWER_ITEMNAME}</b>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:center' colspan='$reviewer_colleft' >" . REVIEWER_H007 . "<br />{REVIEWER_ITEM_OVERALL}</td>
		<td class='forumheader3' style='text-align:center' colspan='$reviewer_colright' >{REVIEWER_ITEM_PICTURE}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:left' >{REVIEWER_ITEMDESC}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:left' >";
    if ($reviewer_use1 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE1}&nbsp;{REVIEWER_RATE1}<br />";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE2}&nbsp;{REVIEWER_RATE2}<br />";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE3}&nbsp;{REVIEWER_RATE3}<br />";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE4}&nbsp;{REVIEWER_RATE4}<br />";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE5}&nbsp;{REVIEWER_RATE5}<br />";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE6}&nbsp;{REVIEWER_RATE6}<br />";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE7}&nbsp;{REVIEWER_RATE7}<br />";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE8}&nbsp;{REVIEWER_RATE8}<br />";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE9}&nbsp;{REVIEWER_RATE9}<br />";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "{REVIEWER_ITEM_RATE10}&nbsp;{REVIEWER_RATE10}<br />";
    }

    $REVIEWER_PRINTITEM_HEADER .= REVIEWER_V008 . "&nbsp;{REVIEWER_ITEM_VOTES}&nbsp;" . REVIEWER_V009 . "<br />{REVIEWER_ITEM_SITE}
		</td>
	</tr>	";
    $REVIEWER_PRINTITEM_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:left' ><span class='smalltext'>Reviewer</span></td>
		<td class='forumheader2' style='width:20%;text-align:center' ><span class='smalltext'>Date</span></td>";

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE1}</span></td>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE2}</span></td>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE3}</span></td>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE4}</span></td>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE5}</span></td>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE6}</span></td>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE7}</span></td>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE8}</span></td>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE9}</span></td>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_PRINTITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE10}</span></td>";
    }
    $REVIEWER_PRINTITEM_HEADER .= "

	</tr>";
}
if (!isset($REVIEWER_PRINTITEM_DETAIL))
{
    $REVIEWER_PRINTITEM_DETAIL = "
	<tr>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_POSTER}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEM_POSTDATE=d/m/Y}</td>";

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE1}</td>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE2}</td>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE3}</td>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE4}</td>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE5}</td>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE6}</td>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE7}</td>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE8}</td>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE9}</td>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_PRINTITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE10}</td>";
    }
    $REVIEWER_PRINTITEM_DETAIL .= "
	</tr>	";
}

if (!isset($REVIEWER_PRINTITEM_NOREVIEWS))
{
    $REVIEWER_PRINTITEM_NOREVIEWS = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >" . REVIEWER_H001 . "</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_PRINTITEM_NOREVIEWS .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_PRINTITEM_NOREVIEWS .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' ><b>{REVIEWER_ITEMNAME}</b>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:center' colspan='$reviewer_colleft' >" . REVIEWER_H007 . "<br />{REVIEWER_ITEM_OVERALL}</td>
		<td class='forumheader3' style='text-align:center' colspan='$reviewer_colright' >{REVIEWER_ITEM_PICTURE}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:left' >{REVIEWER_ITEMDESC}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:left' >
		<tr>
			<td class='forumheader3' style='text-align:center' colspan='$reviewer_colspan' >" . REVIEWER_H019 . "</td>
		</tr>
</table>";
}
if (!isset($REVIEWER_PRINTITEM_NOITEMS))
{
    $REVIEWER_PRINTITEM_NOITEMS = "
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:center' ><b>" . REVIEWER_H019 . "</b>&nbsp;</td>
	</tr>
";
}
if (!isset($REVIEWER_PRINTITEM_FOOTER))
{
    $REVIEWER_PRINTITEM_FOOTER = "
	</table>";
}

?>