<?php

/*
#######################################
#     AACGC Event Tracker             #                
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
require(e_PLUGIN . 'aacgc_hos/plugin.php');




$plugin_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>Created by All American Computer Gamers Community (AACGC)</td>
	</tr>
	<tr>
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
		<td class='forumheader3'>AACGC HOS 2009</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Website</td>
		<td class='forumheader3'><a href='http://www.aacgc.com'>www.AACGC.com</a></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>Support</strong><br /><br />Support for this plug-in is ONLY at AACGC and nowhere else!
                 <br><a href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php'>FAQs</a>
                 <br><a href='http://www.aacgc.com/SSGC/e107_plugins/helpdesk3_menu/helpdesk.php'>HelpDesk/BugTracker</a>
                 <br><br><br>
AACGC creates plugins for free to help all E107 users make their websites the best they can be! Even thou AACGC Plugins are copyrighted, AACGC allows anyone to edit their plugins to best fit their website and needs, HOWEVER DO NOT release any edited version that was not done by AACGC or you may be subject to copyright laws. The copyright information is on the main page of each AACGC plugin. Also if you edit any AACGC plugin then you can no longer recieve tech support for the edited plugin. You must use the AACGC Released version to recieve tech support. AACGC is not responsible for any update that does not work due to an edited plugin. If you edit an AACGC plugin there is a good change of an update not working when installed due to it not matching the origanol AACGC plugin. So again you can edit any AACGC plugin as you wish as long as you DO NOT release it and no longer wish to recieve tech support or possibly updates for that plugin.

		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";


$ns->tablerender("AACGC Plugin Information", $plugin_text);


require_once(e_ADMIN . 'footer.php');

?>

