<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_themes/lamb/forum_viewtopic_template.php,v $
|     $Revision: 1.14 $
|     $Date: 2007/07/27 19:08:33 $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$sc_style['LASTEDIT']['pre'] = "<br /><br /><span class='smallblacktext'>[ ".LAN_29." ";
$sc_style['LASTEDIT']['post'] = " ]</span>";

$icon = (file_exists(THEME."forum/e.png") ? THEME."forum/e.png" : e_PLUGIN."forum/images/lite/e.png");

$FORUMSTART = "
<table style='width:100%'>
<tr>
<td style='width:100%; text-align:center'><div class='mediumtext'><b>{THREADNAME}</b></div><br />{GOTOPAGES}</td>
</tr>
<tr><td class='smalltext' style='width:100%;text-align:center;'>{BREADCRUMB}<br/></td></tr>
</table>
";

$FORUMTHREADSTYLE = "
<div class='spacer'>
<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
<td class='nforumcaption3' style='vertical-align:middle; text-align:center; width:100%;'>\n<b>{POSTER}</b><br/>{THREADDATESTAMP}</td>
</tr>
<tr>
<td class='nforumthread' style='vertical-align:top'>{POLL}\n{POST}\n{LASTEDIT}\n</td>
</tr></table>

<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<td style='text-align:center'>\n{EDITIMG}\n{QUOTEIMG}\n</td></tr>
</table>
</div>";

$FORUMEND = "
<div class='spacer'>
{GOTOPAGES}
<table style='width:100%' class='nforumholder'>
<tr>	
<td style='text-align:center'>{BACKLINK}</td>
</tr>
</table>
</div>

<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
</tr>
</table>
</div>
<div class='spacer'>
<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
<td style='text-align:center' class='nforumthread2'>{QUICKREPLY}</td>
</tr>
</table>
</div>";


       $FORUMREPLYSTYLE = "
<div class='spacer'>
<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
<td class='nforumcaption3' style='vertical-align:middle; text-align:center; width:100%;'>\n<b>{POSTER}</b><br/>{THREADDATESTAMP}</td>
</tr>
<tr>
<td class='nforumthread' style='vertical-align:top'>{POLL}\n{POST}\n{LASTEDIT}\n</td>
</tr></table>

<table style='width:100%' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
<td style='text-align:center'>\n{REPORTIMG}\n{EDITIMG}\n{QUOTEIMG}\n</td></tr>
</table>
</div><br/>";

?>