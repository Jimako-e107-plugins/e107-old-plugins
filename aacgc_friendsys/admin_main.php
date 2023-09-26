<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #                 
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
require(e_PLUGIN . 'aacgc_friendsys/plugin.php');




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
		<td class='forumheader3'>AACGC FS 2010</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >Website</td>
		<td class='forumheader3'><a href='http://www.aacgc.com'>www.AACGC.com</a></td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2'>
		<strong>Support</strong><br /><br />Support for this plug-in is ONLY at AACGC and nowhere else!
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";


$ns->tablerender("AACGC Plugin Information", $plugin_text);


require_once(e_ADMIN . 'footer.php');

?>

