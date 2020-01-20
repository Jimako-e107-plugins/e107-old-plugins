/*
+---------------------------------------------------------------+
|        YouTube Gallery v3.00 - by Erich Radstake
|        Expention of old Youtube Menu by Erich Radstake
|
|        v3.00
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// USAGE: [yt=width,height]WeN8SvkU0Tw[/yt]

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");



$ytmovie_path   = $code_text;

$parm_array     = explode(",",$parm);

$width_type     = strpos($parm_array[0], "%") !== FALSE ? "%" : "";
$height_type    = strpos($parm_array[1], "%") !== FALSE ? "%" : "";

$width_value    = ereg_replace("[^0-9]","",$parm_array[0]);
$height_value   = ereg_replace("[^0-9]","",$parm_array[1]);

$width_value    = $width_value  ? $width_value.$width_type   : "200";
$height_value   = $height_value ? $height_value.$height_type : "200";

return "<object width='$width_value' height='$height_value'>
<param name='movie' value='http://www.youtube.com/v/$ytmovie_path'></param>
<param name='wmode' value='transparent'></param>
<embed src='http://www.youtube.com/v/$ytmovie_path' type='application/x-shockwave-flash' wmode='transparent' width='$width_value' height='$height_value'></embed>
</object>";

