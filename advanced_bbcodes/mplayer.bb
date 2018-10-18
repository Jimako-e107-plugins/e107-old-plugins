/*
+---------------------------------------------------------------+
|        Plugin: Advanced BBcodes - Lecteur Mp3
|        Version: 0.4
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$advanced_bbcodes_path = e_PLUGIN.'advanced_bbcodes/';
$url_object = $code_text;

$bbcode_mplayer = '<object type="application/x-shockwave-flash" data="'.$advanced_bbcodes_path.'swf/dewplayer.swf?son='.$url_object.'" width="200" height="20">
<param name="movie" value="'.$advanced_bbcodes_path.'swf/dewplayer.swf?son='.$url_object.'" /></object>';

return $bbcode_mplayer;