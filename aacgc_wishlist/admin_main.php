<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #    
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
require(e_PLUGIN . 'aacgc_wishlist/plugin.php');




$plugin_text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' rowspan='10'><center><img src='".$eplug_icon_custom."' /><center></td>
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
		<td class='forumheader3'>AACGC WL 2009</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Website</td>
		<td class='forumheader3'><a href='http://www.aacgc.com'>www.AACGC.com</a></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>Support</strong><br /><br />Support for this plug-in is ONLY at AACGC and nowhere else!
                 <br><a href='http://www.aacgc.com/SSGC/e107_plugins/faq/faq.php'>FAQs</a>
                <br><a href='http://www.aacgc.com/SSGC/e107_plugins/helpdesk3_menu/helpdesk.php'>HelpDesk</a>
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";


$ns->tablerender("AACGC Plugin Information", $plugin_text);


require_once(e_ADMIN . 'footer.php');

?>

