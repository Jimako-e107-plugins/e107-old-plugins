<?php
/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

$icon = (file_exists(THEME."forum/e.png") ? THEME."forum/e.png" : e_PLUGIN."forum/images/lite/e.png");

 $FORUM_VIEW_START = "
<table style='width:100%' class='nforumholder' cellpadding=0 cellspacing=0>

<tr><td>{SUBFORUMS}</td>
</tr>
</table>

<table style='width:100%'>
<td style='width:100%;text-align:center;'><div class='mediumtext'><b>{FORUMTITLE}</b></div></td>
</tr><tr>
<td class='smalltext' style='width:100%;text-align:center;'>{BREADCRUMB}</td>
</tr>
</table>

<table style='width:100%; vertical-align:top; text-align:center;' class='nforumholder' cellpadding='0' cellspacing='0'>
<tr>
<td style='width:50%; text-align:center' class='nforumcaption'>{THREADTITLE}</td>
<td style='width:25%; text-align:center' class='nforumcaption'>{LASTPOSTITLE}</td>
<td style='width:25%; text-align:center' class='nforumcaption'>{REPLYTITLE}</td>
</tr></table>";


$FORUM_VIEW_FORUM = "
<table style='width:100%'>
<tr>
<td style='width:50%' class='nforumview2'><span class='mediumtext'><b>{THREADNAME}</b></span> <span class='smalltext'>{PAGES}</span><br/>{THREADDATE}&nbsp;by&nbsp;{POSTER}</td>
<td style='vertical-align:middle; text-align:center; width:25%' class='nforumview2'><span class='smalltext'>{LASTPOST}</span></td>
<td style='vertical-align:middle; text-align:center; width:25%' class='nforumview2'><span class='smalltext'>{REPLIES}</span></td>
</tr>";



 $FORUM_VIEW_END = "
</table>
<table style='width:100%' class='nforumholder'>
<tr>
<td style='width:auto'><span class='mediumtext'>{THREADPAGES}</span>
</td>
<td style='width:auto; text-align:right'>
{NEWTHREADBUTTON}
</td>
</tr>
</table>


<div class='spacer'>
<table style='width:100%' class='nforumholder' cellpadding=0 cellspacing=0>
<tr>
<td style='vertical-align:middle;' class='nforumview3'><span class='smalltext'>{BROWSERS}</span></td>
</tr>
</table>

</div>
</div>";


$FORUM_VIEW_SUB_START = "
<tr>
<td colspan='2'>
<table style='width:100%'  cellpadding='0' cellspacing='0'>
<tr>
<td class='nforumcaption2' style='width: 50%'>".FORLAN_20."</td>
<td class='nforumcaption2' style='width: 10%; text-align: center;'>".FORLAN_21."</td>
<td class='nforumcaption2' style='width: 10%; text-align: center;'>".LAN_55."</td>
<td class='nforumcaption2' style='width: 30%; text-align: center;'>".FORLAN_22."</td>
</tr>
";

$FORUM_VIEW_SUB = "
<tr>
<td class='nforumview2' style='text-align:left'><b>{SUB_FORUMTITLE}</b><br />{SUB_DESCRIPTION}</td>
<td class='nforumview2' style='text-align:center'>{SUB_THREADS}</td>
<td class='nforumview2' style='text-align:center'>{SUB_REPLIES}</td>
<td class='nforumview2' style='text-align:center'>{SUB_LASTPOST}</td>
</tr>
";

$FORUM_VIEW_SUB_END = "
</table>
</td>
</tr>
";

 ?>