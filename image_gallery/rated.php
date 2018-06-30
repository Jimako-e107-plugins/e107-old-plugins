<?php
/*
+---------------------------------------------------------------+
|	e107 website system
| http://e107.org
|	/image_gallery/rated.php
|
| Revision: 0.9.6.2
| Date: 2008/02/15
| Author: Krassswr
|
|	krassswr@abv.bg
|
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$text .= '
<table class="fborder" style="width: 95%;">
<tbody>
    <tr>
        <td class="fcaption" colspan="2">'.image_gallery_rate_L1.'</td>
    </tr>
    <tr>
        <td style="text-align: right; vertical-align: middle; width: 20%;" class="forumheader2"><img src="'.THEME.'/forum/e.png" alt="" title="" style="border: 0pt none ;">&nbsp;</td>
        <td style="vertical-align: middle; width: 80%;" class="forumheader2">
        <br />'.image_gallery_rate_L2.'<br />
        <br />
        <span class="defaulttext"><a href="'.$_SERVER["HTTP_REFERER"].'">'.image_gallery_rate_L3.'</a><br />
        <a href="'.e_PLUGIN.'image_gallery/image_gallery.php">'.image_gallery_rate_L4.'</a></span><br /><br />
        </td>
    </tr>
</tbody>
</table>
';
?>