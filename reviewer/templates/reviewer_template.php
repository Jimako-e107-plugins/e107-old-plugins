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
if (!defined('USER_WIDTH'))
{
    define(USER_WIDTH, "width:100%;");
}
global $reviewer_shortcodes;
// **********************************************************************************************************************
// **********************************************************************************************************************
// * Terms and conditions
// **********************************************************************************************************************
// **********************************************************************************************************************
if (!isset($REVIEWER_TC))
{
    $REVIEWER_TC = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' >" . REVIEWER_TANDC01 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' >{REVIEWER_TANDC}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ACCEPT}&nbsp;&nbsp;&nbsp;{REVIEWER_REJECT}</td>
	</tr>
</table>	";
}
// **********************************************************************************************************************
// **********************************************************************************************************************
// * List all items in category
// **********************************************************************************************************************
// **********************************************************************************************************************
if (!isset($REVIEWER_LIST_HEADER))
{
    $REVIEWER_LIST_HEADER = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='6' >" . REVIEWER_H001 . "</td>
	</tr>
    	<tr>
		<td class='forumheader3' colspan='6' ><b>{REVIEWER_MESSAGE}</b>&nbsp;</td>
	</tr>
	";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_LIST_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='6' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_LIST_HEADER .= "

	<tr>
		<td class='forumheader2' colspan='6' >" . REVIEWER_H003 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:center;' colspan='6' >{REVIEWER_CATICONS}<br />{REVIEWER_CATLIST}&nbsp;{REVIEWER_CATFILTER}<br />{REVIEWER_CATDESC}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='6' >{REVIEWER_VIEW_CREATE} {REVIEWER_VIEW_NEXTPREV}</td>
	</tr>
	<tr>
		<td class='forumheader2' style='width:40px;text-align:left' ><span class='smalltext'>&nbsp;</span></td>
		<td class='forumheader2' style='width:30%;text-align:left' ><span class='smalltext'>" . REVIEWER_H010 . "</span></td>
		<td class='forumheader2' style='width:15%;text-align:center' ><span class='smalltext'>" . REVIEWER_H011 . "</span></td>
		<td class='forumheader2' style='width:15%;text-align:center' ><span class='smalltext'>" . REVIEWER_H012 . "</span></td>
		<td class='forumheader2' style='width:20%;text-align:center' ><span class='smalltext'>" . REVIEWER_H013 . "</span></td>
		<td class='forumheader2' style='width:20%;text-align:center' ><span class='smalltext'>" . REVIEWER_H014 . "</span></td>
	</tr>
	";
}
if (!isset($REVIEWER_LIST_DETAIL))
{
    $REVIEWER_LIST_DETAIL = "
	<tr>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEMS_IMAGE}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEMS_NAME}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEMS_STARS}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEMS_VOTES}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEMS_LASTPOST=d/m/Y}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEMS_VIEW}</td>
	</tr>	";
}
if (!isset($REVIEWER_LIST_FOOTER))
{
    $REVIEWER_LIST_FOOTER = "
	<tr>
		<td class='forumheader3' colspan='6' >{REVIEWER_VIEW_CREATE} {REVIEWER_VIEW_NEXTPREV}</td>
	</tr>
		<tr>
		<td class='fcaption' colspan='6' >&nbsp;</td>
	</tr>
</table>";
}
// **********************************************************************************************************************
// **********************************************************************************************************************
// *  Show the items details and all the  reviews for this item
// **********************************************************************************************************************
// **********************************************************************************************************************
if (!isset($REVIEWER_ITEM_HEADER))
{
    $reviewer_colleft = intval($reviewer_colspan / 2);
    $reviewer_colright = $reviewer_colspan - $reviewer_colleft;

    $REVIEWER_ITEM_HEADER = "<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >" . REVIEWER_H001 . "</td>
	</tr>
<tr>
		<td class='forumheader2' colspan='$reviewer_colspan' >{REVIEWER_BACK} {REVIEWER_LIST_UPDIR} &nbsp;{REVIEWER_VIEW_PRINT}&nbsp; {REVIEWER_VIEW_EMAIL} &nbsp;{REVIEWER_ITEM_EDIT} {REVIEWER_MESSAGE}</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_ITEM_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_ITEM_HEADER .= "
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
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE1}&nbsp;{REVIEWER_RATE1}<br />";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE2}&nbsp;{REVIEWER_RATE2}<br />";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE3}&nbsp;{REVIEWER_RATE3}<br />";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE4}&nbsp;{REVIEWER_RATE4}<br />";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE5}&nbsp;{REVIEWER_RATE5}<br />";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE6}&nbsp;{REVIEWER_RATE6}<br />";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE7}&nbsp;{REVIEWER_RATE7}<br />";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE8}&nbsp;{REVIEWER_RATE8}<br />";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE9}&nbsp;{REVIEWER_RATE9}<br />";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "{REVIEWER_ITEM_RATE10}&nbsp;{REVIEWER_RATE10}<br />";
    }

    $REVIEWER_ITEM_HEADER .= REVIEWER_V008 . "&nbsp;{REVIEWER_ITEM_VOTES}&nbsp;" . REVIEWER_V009 . "<br />{REVIEWER_ITEM_SITE}
		</td>
	</tr>	";
    $REVIEWER_ITEM_HEADER .= "
		<tr>
		<td class='forumheader2' style='text-align:left' colspan='$reviewer_colspan' >{REVIEWER_VIEW_NEXTPREV}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader2' style='text-align:left' ><span class='smalltext'>Reviewer</span></td>
		<td class='forumheader2' style='width:20%;text-align:center' ><span class='smalltext'>Date</span></td>";
    $count = 0;

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE1}</span></td>";
        $count++;
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE2}</span></td>";
        $count++;
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE3}</span></td>";
        $count++;
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE4}</span></td>";
        $count++;
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE5}</span></td>";
        $count++;
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE6}</span></td>";
        $count++;
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE7}</span></td>";
        $count++;
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE8}</span></td>";
        $count++;
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE9}</span></td>";
        $count++;
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>{REVIEWER_RATE10}</span></td>";
        $count++;
    }
    $REVIEWER_ITEM_HEADER .= "
		<td class='forumheader2' style='width:10%;text-align:center' ><span class='smalltext'>Action</span></td>
	</tr>
";
}
if (!isset($REVIEWER_ITEM_DETAIL))
{
    $REVIEWER_ITEM_DETAIL = "
	<tr>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_POSTER}</td>
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEM_POSTDATE=d/m/Y}</td>";

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE1}</td>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE2}</td>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE3}</td>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE4}</td>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE5}</td>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE6}</td>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE7}</td>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE8}</td>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE9}</td>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_VIEW_RATE10}</td>";
    }
    $REVIEWER_ITEM_DETAIL .= "
		<td class='forumheader3' style='text-align:center' >{REVIEWER_ITEM_DETAIL}</td>
	</tr>	";
}

if (!isset($REVIEWER_ITEM_NOREVIEWS))
{
    $REVIEWER_ITEM_NOREVIEWS = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >" . REVIEWER_H001 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='$reviewer_colspan' >{REVIEWER_BACK} {REVIEWER_LIST_UPDIR}</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_ITEM_NOREVIEWS .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='$reviewer_colspan' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_ITEM_NOREVIEWS .= "
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
	<tr>
		<td class='forumheader2' style='text-align:left' colspan='$reviewer_colspan' >{REVIEWER_ADD_REVIEW}&nbsp;</td>
	</tr>
		<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >{REVIEWER_VIEW_NEXTPREV}&nbsp;</td>
	</tr>
</table>";
}
if (!isset($REVIEWER_ITEM_NOITEMS))
{
    $REVIEWER_ITEM_NOITEMS = "
	<tr>
		<td class='forumheader3' colspan='$reviewer_colspan' style='text-align:center' ><b>" . REVIEWER_H025 . "</b>&nbsp;</td>
	</tr>
";
}
if (!isset($REVIEWER_ITEM_FOOTER))
{
    $REVIEWER_ITEM_FOOTER = "
	<tr>
		<td class='forumheader2' style='text-align:left' colspan='$reviewer_colspan' >{REVIEWER_ADD_REVIEW}&nbsp;</td>
	</tr>
		<tr>
		<td class='fcaption' colspan='$reviewer_colspan' >{REVIEWER_VIEW_NEXTPREV}&nbsp;</td>
	</tr>


	</table>";
}
// **********************************************************************************************************************
// * View a record
// **********************************************************************************************************************
if (!isset($REVIEWER_VIEW_HEADER))
{
    $REVIEWER_VIEW_HEADER = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='2' >" . REVIEWER_H001 . "</td>
	</tr>
	<tr>
		<td class='forumheader2' colspan='2' >{REVIEWER_BACK} {REVIEWER_ITEM_UPDIR} &nbsp;{REVIEWER_VIEW_PRINT}&nbsp; {REVIEWER_VIEW_EMAIL}</td>
	</tr>";
    if ($reviewer_logoexists)
    {
        // if the logo for the category exists then display it
        $REVIEWER_VIEW_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='2' >{REVIEWER_CATLOGO}</td>
	</tr>";
    }
    $REVIEWER_VIEW_HEADER .= "
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='2' ><b>{REVIEWER_ITEMNAME}</b>&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_PICTURE}&nbsp;</td>
		<td class='forumheader3'  style='text-align:left' >{REVIEWER_ITEMDESC}&nbsp;</td>
	</tr>";
}
if (!isset($REVIEWER_VIEW_DETAIL))
{
    $REVIEWER_VIEW_DETAIL = "
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
        $REVIEWER_VIEW_DETAIL .= "
        <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE1}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE1}</td>
		</tr>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE2}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE2}</td>
		</tr>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE3}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE3}</td>
		</tr>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE4}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE4}</td>
		</tr>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE5}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE5}</td>
	</tr>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE6}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE6}</td>
	</tr>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE7}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE7}</td>
	</tr>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE8}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE8}</td>
	</tr>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE9}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE9}</td>
	</tr>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE10}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_VIEW_RATE10}</td>
	</tr>";
    }
    $REVIEWER_VIEW_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V004 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEMS_EDIT} {REVIEWER_ITEMS_DELETE}</td>
	</tr>	";
}
if (!isset($REVIEWER_VIEW_FOOTER))
{
    $REVIEWER_VIEW_FOOTER = "
	<tr>
		<td class='fcaption' colspan='2' >&nbsp;</td>
	</tr>
</table>";
}
// **********************************************************************************************************************
// * Add / Edit a record
// **********************************************************************************************************************
if (!isset($REVIEWER_EDIT_HEADER))
{
    $REVIEWER_EDIT_HEADER = "<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' colspan='2' >" . REVIEWER_H001 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' >{REVIEWER_BACK} {REVIEWER_EDIT_UPDIR} {REVIEWER_EDIT_MESSAGE}</td>
	</tr>
	<tr>
		<td class='forumheader2' style='text-align:center' colspan='2' >{REVIEWER_ITEMNAME}&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:left' >{REVIEWER_ITEMDESC}&nbsp;</td>
	</tr>";
}
if (!isset($REVIEWER_EDIT_DETAIL))
{
    $REVIEWER_EDIT_DETAIL = "
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V001 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_POSTER} {REVIEWER_EDIT_SECURE}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V002 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_ITEM_POSTDATE=d/m/Y}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%;text-align:left' >" . REVIEWER_V003 . "</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_COMMENTS}</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:center' >" . REVIEWER_V014 . "<br />
		{REVIEWER_EDIT_STARS=05}
		{REVIEWER_EDIT_STARS=10}
		{REVIEWER_EDIT_STARS=15}
		{REVIEWER_EDIT_STARS=20}
		{REVIEWER_EDIT_STARS=25}
		{REVIEWER_EDIT_STARS=30}
		{REVIEWER_EDIT_STARS=35}
		{REVIEWER_EDIT_STARS=40}
		{REVIEWER_EDIT_STARS=45}
		{REVIEWER_EDIT_STARS=50}
		</td>
	</tr>		";

    if ($reviewer_use1 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
        <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE1}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE1}</td>
		</tr>";
    }
    if ($reviewer_use2 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE2}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE2}</td>
		</tr>";
    }
    if ($reviewer_use3 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE3}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE3}</td>
		</tr>";
    }
    if ($reviewer_use4 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
                <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE4}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE4}</td>
		</tr>";
    }
    if ($reviewer_use5 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE5}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE5}</td>
	</tr>";
    }
    if ($reviewer_use6 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE6}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE6}</td>
	</tr>";
    }
    if ($reviewer_use7 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE7}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE7}</td>
	</tr>";
    }
    if ($reviewer_use8 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE8}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE8}</td>
	</tr>";
    }
    if ($reviewer_use9 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE9}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE9}</td>
	</tr>";
    }
    if ($reviewer_use10 == 1)
    {
        $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='forumheader3' style='width:25%;text-align:left' >{REVIEWER_RATE10}</td>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_EDIT_RATE10}</td>
	</tr>";
    }

    $REVIEWER_EDIT_DETAIL .= "
    <tr>
		<td class='fcaption' colspan='2' style='text-align:left' >{REVIEWER_EDIT_SAVE}</td>
	</tr>	";
}
if (!isset($REVIEWER_EDIT_FOOTER))
{
    $REVIEWER_EDIT_FOOTER = "</table>";
}
if (!isset($REVIEWER_CONFIRM_DELETE))
{
    $REVIEWER_CONFIRM_DELETE = "
<table class='fborder' style='" . USER_WIDTH . "' >
	<tr>
		<td class='fcaption' style='text-align:left' >" . REVIEWER_H015 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='text-align:left' >{REVIEWER_BACK} {REVIEWER_CONFIRM_UPDIR}</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:25%;text-align:center' >" . REVIEWER_H018 . "<br />{REVIEWER_CONFIRMDELETE}&nbsp;&nbsp;{REVIEWER_CANCELDELETE}
		</td>

	</tr>
		<td class='fcaption' style='text-align:left' >&nbsp;</td>
	</tr>
</table>";
}
if (!isset($REVIEWER_SUBMITNEW))
{
    $REVIEWER_SUBMITNEW = '
	<table style="' . USER_WIDTH . '" class="fborder">
		<tr>
			<td class="fcaption" colspan="2" >' . REVIEWER_AI029 . '</td>
		</tr>
	   	<tr>
			<td class="forumheader3" colspan="2" ><b>{REVIEWER_MESSAGE}</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:25%;text-align:left" >' . REVIEWER_AI004 . '</td>
			<td class="forumheader3" >{REVIEWER_SUBMIT_CAT}</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:25%;text-align:left" >' . REVIEWER_AI007 . '</td>
			<td class="forumheader3" >{REVIEWER_SUBMIT_NAME}</td>
		</tr>
		<tr>
			<td class="forumheader3" style="width:25%;text-align:left">' . REVIEWER_AI008 . '</td>
			<td class="forumheader3" style="text-align:left;">{REVIEWER_SUBMIT_DESC}</td>
		</tr>
		<tr>
			<td class="forumheader3" style="text-align:left">' . REVIEWER_AI009 . "</td>
			<td class='forumheader3' style='text-align:left'>{REVIEWER_SUBMIT_URL}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_AI020 . "</td>
			<td class='forumheader3' style='text-align:left'>{REVIEWER_SUBMIT_PIC}<br />{REVIEWER_SUBMIT_UPLOAD}</td>
		</tr>
		<tr>
			<td class='forumheader3' style='text-align:left'>" . REVIEWER_H022 . "</td>
			<td class='forumheader3' style='text-align:left'>{REVIEWER_SUBMIT_APPROVAL}</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:center'>{REVIEWER_SUBMIT_OK}</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' >&nbsp;</td>
		</tr>
</table>";
}
if (!isset($REVIEWER_ULIST_HEADER))
{
    $REVIEWER_ULIST_HEADER = '
	<table style="' . USER_WIDTH . '" class="fborder">
		<tr>
			<td class="fcaption" colspan="5" >' . REVIEWER_UL01 . '</td>
		</tr>
	   	<tr>
			<td class="forumheader2" colspan="5" >{REVIEWER_BACK} ' . REVIEWER_UL07 . ' <b>{REVIEWER_UMEMBER}</b>&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:15%" ><b>' . REVIEWER_UL02 . '</b></td>
			<td class="forumheader2" style="width:20%" ><b>' . REVIEWER_UL03 . '</b></td>
			<td class="forumheader2" style="width:40%" ><b>' . REVIEWER_UL04 . '</b></td>
			<td class="forumheader2" style="width:20%" ><b>' . REVIEWER_UL05 . '</b></td>
			<td class="forumheader2" style="width:5%" ><b>' . REVIEWER_UL06 . '</b></td>
		</tr>
	';
}
if (!isset($REVIEWER_ULIST_DETAIL))
{
    $REVIEWER_ULIST_DETAIL = '
		<tr>
			<td class="forumheader3" >{REVIEWER_ULIST_DATE=d M Y}</td>
			<td class="forumheader3" >{REVIEWER_ULIST_ITEM}</td>
			<td class="forumheader3" >{REVIEWER_ULIST_REVIEW}</td>
			<td class="forumheader3" >{REVIEWER_ULIST_RATE}</td>
			<td class="forumheader3" style="text-align:center;" >{REVIEWER_ULIST_VIEW}</td>

		</tr>	';
}
if (!isset($REVIEWER_ULIST_FOOTER))
{
    $REVIEWER_ULIST_FOOTER = '
		<tr>
			<td class="fcaption" colspan="5" >&nbsp;</td>
		</tr>
</table>	';
}
// list reviewers with number of reviews
if (!isset($REVIEWER_RLIST_HEADER))
{
	$REVIEWER_RLIST_HEADER = '
	<table style="' . USER_WIDTH . '" class="fborder">
		<tr>
			<td class="fcaption" colspan="3" >' . REVIEWER_RL01 . '</td>
		</tr>
	   	<tr>
			<td class="forumheader2" colspan="3" >{REVIEWER_BACK}&nbsp;</td>
		</tr>
		<tr>
			<td class="forumheader2" style="width:50%" ><b>' . REVIEWER_RL02 . '</b></td>
			<td class="forumheader2" style="width:20%;text-align:right;" ><b>' . REVIEWER_RL03 . '</b></td>
			<td class="forumheader2" style="width:30%" ><b>' . REVIEWER_RL04 . '</b></td>
		</tr>
	';
}
if (!isset($REVIEWER_RLIST_DETAIL))
{
	$REVIEWER_RLIST_DETAIL = '
		<tr>
			<td class="forumheader3" style="text-align:left;">{REVIEWER_RLIST_MEMBER}</td>
			<td class="forumheader3" style="text-align:right;">{REVIEWER_RLIST_NUMBER}</td>
			<td class="forumheader3" style="text-align:left;">{REVIEWER_RLIST_DATE=d M Y}</td>
		</tr>';
}

if (!isset($REVIEWER_RLIST_FOOTER))
{
	$REVIEWER_RLIST_FOOTER = '
		<tr>
			<td class="fcaption" colspan="3" >&nbsp;</td>
		</tr>
</table>	';
}
