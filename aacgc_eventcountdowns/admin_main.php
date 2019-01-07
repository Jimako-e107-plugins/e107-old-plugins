<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Countdowns          #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once('../../class2.php');
if (!defined('e107_INIT'))
{exit;}
if (!getperms('P'))
{header('location:' . e_HTTP . 'index.php');
exit;}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{define(ADMIN_WIDTH, 'width:100%;');}
require(e_PLUGIN . 'aacgc_eventcountdowns/plugin.php');




$plugin_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='3'>Created by <a href='http://www.aacgc.com' target='_blank'>AACGC</a></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:0%' rowspan='8'><img src='".$eplug_icon_large."' ></td>
		<td class='forumheader3' style='width:15%;' >Plugin</td>
		<td class='forumheader3'>" . $eplug_name . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Author</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Version</td>
		<td class='forumheader3'>" . $eplug_version . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Status</td>
		<td class='forumheader3'>Released</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Disclaimer</td>
		<td class='forumheader3'>No responsibility can be accepted for the failure of this plugin in any way shape or form. You use entirely at your own risk.</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Copyright</td>
		<td class='forumheader3'>AACGC ECDS 2013</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Website</td>
		<td class='forumheader3'><a href='http://www.aacgc.com' target='_blank'>www.aacgc.com</a></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Support</td>
		<td class='forumheader3'>
		 Support for this plugin is ONLY at AACGC and nowhere else!
                 <br><br><a href='http://wiki.aacgc.com/index.php?title=Main_Page' target='_blank'>AACGC Wiki</a>
                 <br><a href='http://www.aacgc.com/e107_plugins/faq/faq.php' target='_blank'>AACGC FAQs</a>
                 <br><a href='http://www.aacgc.com/e107_plugins/bug_tracker/bugs.php' target='_blank'>AACGC BugTracker</a>
		 <br><br><b><a href='admin_vupdate.php'>Always Check For Updates!</a></b>
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='3'>&nbsp;</td>
	</tr>
</table>";


$ns->tablerender("AACGC Plugin Information", $plugin_text);


require_once(e_ADMIN . 'footer.php');

?>

