/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes - Dailymotion
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

$url_object = $code_text;

$bbcode_dailymotion = '<object width="425" height="350"><param name="movie" value="http://www.dailymotion.com/swf/'.$url_object.'&amp;v3=1"></param><param name="wmode" value="transparent"></param><embed src="http://www.dailymotion.com/swf/'.$url_object.'&amp;v3=1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';

return $bbcode_dailymotion;