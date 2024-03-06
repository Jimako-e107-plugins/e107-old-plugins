<?php
require_once("../../../class2.php");
if (!defined('e107_INIT')) { exit; }
if (!getperms("P")) { header("location:" . e_HTTP . "index.php"); exit; }
include_lan(e_PLUGIN . "export_emails/languages/" . e_LANGUAGE . ".php");
require_once("../plugin.php");
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH')) { define(ADMIN_WIDTH, "width:100%;"); }
$text = "
<table class='fborder' style='" . ADMIN_WIDTH . "'>
	<tr>
		<td class='fcaption' colspan='2'>" . $eplug_name . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EE_ADMIN_README_01 . "</td>
		<td class='forumheader3'>" .$eplug_name . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EE_ADMIN_README_02 . "</td>
		<td class='forumheader3'>" . $eplug_author . "</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EE_ADMIN_README_03 . "</td>
		<td class='forumheader3'>" .$eplug_version . "&nbsp;</td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EE_ADMIN_README_04 . "</td>
		<td class='forumheader3'><a href='http://lonalore.hu' target='_blank'>" . EE_ADMIN_README_05 . "</a></td>
	</tr>
	<tr>
		<td class='forumheader3' style='width:15%;' >" . EE_ADMIN_README_06 . "</td>
		<td class='forumheader3'>" . EE_ADMIN_README_07 . "</td>
	</tr>
	<tr>
		<td class='forumheader3' colspan='2' style='text-align:justify;'>
			<strong>" . EE_ADMIN_README_08 . "</strong><br /><br />" . EE_ADMIN_README_09 . "<br /><br /><a href='http://devarea.lonalore.hu' target='_blank'>" . EE_ADMIN_README_10 . "</a>
		</td>
	</tr>
	<tr>
		<td class='fcaption' colspan='2'>&nbsp;</td>
	</tr>
</table>";
$ns->tablerender($eplug_name, $text);
require_once(e_ADMIN . "footer.php");
?>