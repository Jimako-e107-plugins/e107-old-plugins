<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     �Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_themes/templates/comment_template.php,v $
|     $Revision: 1.4 $
|     $Date: 2005/06/23 16:51:44 $
|     $Author: sweetas $
+----------------------------------------------------------------------------+
*/

global $sc_style, $comment_shortcodes;
global $pref, $comrow, $row2, $tp, $NEWIMAGE, $USERNAME, $RATING;

$sc_style['SUBJECT']['pre'] = "<b>";
$sc_style['SUBJECT']['post'] = "</b>";

$sc_style['USERNAME']['pre'] = "<b>";
$sc_style['USERNAME']['post'] = "</b>";

$sc_style['TIMEDATE']['pre'] = "";
$sc_style['TIMEDATE']['post'] = "";

$sc_style['REPLY']['pre'] = "";
$sc_style['REPLY']['post'] = "";

$sc_style['AVATAR']['pre'] = "<div class='spacer'>";
$sc_style['AVATAR']['post'] = "</div>";

$sc_style['COMMENTS']['pre'] = "";
$sc_style['COMMENTS']['post'] = "<br />";

$sc_style['JOINED']['pre'] = "";
$sc_style['JOINED']['post'] = "<br />";

$sc_style['COMMENT']['pre'] = "";
$sc_style['COMMENT']['post'] = "<br />";

$sc_style['RATING']['pre'] = "";
$sc_style['RATING']['post'] = "<br />";

$sc_style['IPADDRESS']['pre'] = "";
$sc_style['IPADDRESS']['post'] = "<br />";

$sc_style['LEVEL']['pre'] = "";
$sc_style['LEVEL']['post'] = "<br />";

$sc_style['LOCATION']['pre'] = "";
$sc_style['LOCATION']['post'] = "<br />";

$sc_style['SIGNATURE']['pre'] = "";
$sc_style['SIGNATURE']['post'] = "<br />";


$COMMENTSTYLE = "
<table class='fborder' style='width:100%;'>
<tr>
	<td colspan='2' class='forumheader''>
		{SUBJECT} {USERNAME} {TIMEDATE} {REPLY}
	</td>
</tr>
<tr>
	<td style='width:30%; vertical-align:top;'>
		{AVATAR}<span class='smalltext'>{COMMENTS}{JOINED}</span>
	</td>
	<td style='width:70%; vertical-align:top;'>
		{COMMENT}
		{IPADDRESS}
		{LEVEL}
		{LOCATION}
		{SIGNATURE}
	</td>
</tr>
</table>
<br />";


?>