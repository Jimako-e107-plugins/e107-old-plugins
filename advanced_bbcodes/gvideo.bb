/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes - GoogleVideo
|        Version: 0.4
|        Date: 12/01/2009
|        Auteur: The_Death_Raw 
|        Email: postmaster@e107plugins.fr
|        Website: www.e107plugins.fr
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

$bbcode_gvideo = '<embed id="VideoPlayback" src="http://video.google.fr/googleplayer.swf?docid='.$code_text.'&hl=fr&fs=true" style="width:425px;height:350px" allowFullScreen="true" type="application/x-shockwave-flash" flashvars=""></embed>';

return $bbcode_gvideo;