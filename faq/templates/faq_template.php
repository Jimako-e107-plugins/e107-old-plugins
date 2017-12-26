<?php
if (!defined("USER_WIDTH"))
{
    define(USER_WIDTH, "width:100%");
}
// *
// * FAQs list. This part is the front opening screen of the FAQ Plugin
// *
if (!isset($FAQ_LISTPARENT_HEADER))
{
    // Start of FAQ list
    // This is sent first
    $FAQ_LISTPARENT_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . "'>
		<table style='" . USER_WIDTH . "'>
        	<tr>
            	<td colspan='2' style='text-align:left;' class='fcaption'>" . FAQ_ADLAN_76 . "</td>
                <td class='fcaption' style='text-align:center;'>" . FAQLAN_42 . "</td>
            </tr>
			<tr>
				<td colspan='3' style='text-align:left;' class='forumheader3'>{FAQ_NEW}&nbsp;</td>
			</tr>
			<tr>
				<td class='forumheader3' style='text-align:center;'  colspan='3'>{FAQ_LOGO}</td>
			</tr>";
}
// *
if (!isset($FAQ_LISTPARENT_TABLE))
{
    // The main heading for the FAQs list
    // This displays the parent category
    $FAQ_LISTPARENT_TABLE = "
			<tr>
				<td class='fcaption' style='text-align:center;' >{FAQ_PARENT_CATICON}</td>
				<td class='fcaption' colspan='2' >{FAQ_PARENT_TITLE}<br /><span class='smalltext'>{FAQ_PARENT_ABOUT}</span></td>
			</tr>";
}
// *
if (!isset($FAQ_LISTPARENT_DETAIL))
{
    // Display each of the categories in this parent category
    $FAQ_LISTPARENT_DETAIL = "
			<tr>
				<td style='width:5%;text-align:center;' class='forumheader2'>{FAQ_PARENT_ICON=link}</td>
				<td style='width:75%' class='forumheader2'>{FAQ_PARENT_FAQ}<br /><span class='smalltext'>{FAQ_PARENT_ABOUT}</span></td>
				<td style='width:20%; text-align:center' class='forumheader2'>{FAQ_PARENT_COUNT}</td>
			</tr>";
}
// *
if (!isset($FAQ_LISTPARENT_FOOTER))
{
    // Footer for the page
    $FAQ_LISTPARENT_FOOTER .= "
			<tr>
				<td class='forumheader3' colspan='3' >{FAQ_STATS_LINK}&nbsp;</td>
			</tr>
    		<tr>
				<td class='fcaption' colspan='3' >&nbsp;</td>
			</tr>
		</table>
	</div>";
}
// *
// * This is the list of FAQs in a particular category
// *
if (!isset($FAQ_LIST_HEADER))
{
    // Start of FAQ list
    // This is sent first
    $FAQ_LIST_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . "'>
		<table style='" . USER_WIDTH . "'>
        	<tr>
				<td class='fcaption' colspan='2'>{FAQ_PARENT_CATICON} {FAQ_CAPTION}</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2'>{FAQ_UPDIR}&nbsp;{FAQ_NEW} <strong>{FAQ_MESSAGE}</strong></td>
			</tr>
						<tr>
				<td class='forumheader3' style='text-align:center;'  colspan='2'>{FAQ_LOGO}</td>
			</tr>";
}
// *
if (!isset($FAQ_LIST_DETAIL))
{
    // The main heading for the FAQs list
    // displayed second
    $FAQ_LIST_DETAIL = "
			<tr>
				<td style='width:5%;text-align:center;' class='forumheader2'>{FAQ_LIST_ICON}</td>
				<td style='width:95%' class='forumheader2'>{FAQ_LIST_FAQ}";
    if ($faq_obj->faq_rating)
    {
        $FAQ_LIST_DETAIL .= "<br /><span class='smalltext'>{FAQ_LIST_RATE}</span>";
    }
    $FAQ_LIST_DETAIL .= "
				</td>
			</tr>";
}
// *
if (!isset($FAQ_LIST_FOOTER))
{
    // The list of FAQs number of FAQs is set in admin config
    $FAQ_LIST_FOOTER = "
    		<tr>
				<td class='forumheader3' colspan='2' >{FAQ_NEXTPREV} {FAQ_STATS_LINK}&nbsp;</td>
			</tr>
			<tr>
    			<td class='fcaption' colspan='2' >&nbsp;</td>
    		</tr>
		</table>
	</div>";
}
// *
// * Displays the individual FAQ
// *
if (!isset($FAQ_ITEM_HEADER))
{
    // Start of FAQ list
    // This is sent first
    $FAQ_ITEM_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . "'>
		<table style='" . USER_WIDTH . "'>
        	<tr>
				<td class='fcaption' colspan='2'>{FAQ_ITEM_CAPTION}</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2'>{FAQ_UPDIR}&nbsp;&nbsp;{FAQ_ITEM_EDIT}&nbsp;&nbsp;{FAQ_ITEM_PRINT}&nbsp;&nbsp;{FAQ_EMAIL}&nbsp;{FAQ_PDF}</td>
			</tr>
			";
}
// *
if (!isset($FAQ_ITEM_DETAIL))
{
    // The main heading for the FAQs list
    // displayed second
    $FAQ_ITEM_DETAIL = "
			<tr>
				<td class='forumheader3' style='text-align:center;vertical-align:top;width:20%'>{FAQ_ITEM_QICON}</td>
        		<td class='forumheader3' style='vertical-align:top'>{FAQ_ITEM_QUESTION}</td>
			</tr>
        	<tr>
				<td class='forumheader3' style='text-align:center;vertical-align:top;width:20%'>{FAQ_ITEM_AICON}</td>
        		<td class='forumheader3'>{FAQ_ITEM_ANSWER}</td>
			</tr>
			<tr>
				<td class='forumheader3' >" . FAQLAN_96 . "</td>
				<td class='forumheader3' >{FAQ_ITEM_VIEWS} (" . FAQLAN_106 . " {FAQ_ITEM_UNIQUE})</td>
			</tr>";
    if ($faq_obj->faq_rating)
    {
        $FAQ_ITEM_DETAIL .= "
			<tr>
				<td class='forumheader3' >" . FAQLAN_119 . "</td>
				<td class='forumheader3' >{FAQ_ITEM_RATE}</td>
			</tr>";
    }
    // Only show poster details if set in admin config
    if ($faq_obj->faq_showposter)
    {
        $FAQ_ITEM_DETAIL .= "
			<tr>
				<td class='forumheader3' >" . FAQLAN_76 . "</td>
				<td class='forumheader3' >{FAQ_ITEM_AUTHOR}</td>
			</tr>
			<tr>
				<td class='forumheader3' >" . FAQLAN_65 . "</td>
				<td class='forumheader3' >".FAQLAN_151." {FAQ_ITEM_POSTED=long}<br />".FAQLAN_152." {FAQ_ITEM_UPDATED=long}</td>
			</tr>";
    }
}
// *
if (!isset($FAQ_ITEM_FOOTER))
{
    // The list of FAQs number of FAQs is set in admin config
    $FAQ_ITEM_FOOTER = "
		    <tr>
				<td class='fcaption' colspan='2'>&nbsp;</td>
			</tr>
		</table>
	</div>";
}
// *
// *
// *
if (!isset($FAQ_EDIT_HEADER))
{
    // Start of FAQ list
    // This is sent first
    $FAQ_EDIT_HEADER = "
	<div class='fborder' style='" . USER_WIDTH . "'>
		<table style='" . USER_WIDTH . "'>
        	<tr>
				<td class='fcaption' colspan='2'>{FAQ_EDIT_CAPTION}</td>
			</tr>
			<tr>
				<td class='forumheader3' colspan='2'>{FAQ_UPDIR} <strong>{FAQ_MESSAGE}</strong></td>
			</tr>";
}
// *
if (!isset($FAQ_EDIT_DETAIL))
{
    // The main heading for the FAQs list
    // displayed second
    $FAQ_EDIT_DETAIL = "
    		<tr>
				<td class='forumheader3' style='width:20%;'>" . FAQ_ADLAN_78 . "</td>
        		<td class='forumheader3' style='width:80%;'>{FAQ_EDIT_CATEGORY}</td>
        	</tr>";
    if (!USER)
    {
        $FAQ_EDIT_DETAIL .= "
			<tr>
				<td class='forumheader3' style='width:20%;'>" . FAQ_ADLAN_131 . "</td>
        		<td class='forumheader3' style='width:80%;'>{FAQ_EDIT_USER}</td>
        	</tr>";
    }
    $FAQ_EDIT_DETAIL .= "
			<tr>
        		<td class='forumheader3' style='width:20%;'>" . FAQ_ADLAN_51 . "</td>
        		<td class='forumheader3' style='width:80%;'>{FAQ_EDIT_QUESTION}</td>
			</tr>
			<tr>
        		<td class='forumheader3' style='width:20%;vertical-align:top;'>" . FAQ_ADLAN_60 . "</td>
        		<td class='forumheader3' style='width:80%;'>{FAQ_EDIT_ANSWER}</td>
			</tr>";
    // If pictures can be uploaded
    if ($faq_obj->faq_picupload)
    {
        $FAQ_EDIT_DETAIL .= "
			<tr>
				<td class='forumheader3' >" . FAQLAN_81 . "</td>
				<td class='forumheader3' >{FAQ_EDIT_PICTURE}</td>
			</tr>";
    }
    if (check_class($pref['faq_allowcomments']))
    {
        $FAQ_EDIT_DETAIL .= "
			<tr>
          		<td class='forumheader3'  style=\"width:20%; vertical-align:top\">" . FAQ_ADLAN_52 . "</td>
		  		<td class='forumheader3' >{FAQ_EDIT_COMMENTS}</td>
			</tr>";
    }
    $FAQ_EDIT_DETAIL .= "
    		<tr>
				<td class='forumheader3' colspan='2'>{FAQ_EDIT_SUBMIT}</td>
        	</tr>";
}
// *
if (!isset($FAQ_EDIT_FOOTER))
{
    // The list of FAQs number of FAQs is set in admin config
    $FAQ_EDIT_FOOTER = "
		</table>
	</div>";
}

if (!isset($FAQ_NO_ACCESS))
{
    // Not permitted access
    $FAQ_NO_ACCESS = "
<table class='fborder' style='" . USER_WIDTH . "' >
   	<tr>
   		<td class='fcaption'>" . FAQLAN_FAQ . "</td>
   	</tr>
   	<tr>
   		<td class='forumheader3'>" . FAQLAN_148 . "</td>
   	</tr>
</table>";
}

?>