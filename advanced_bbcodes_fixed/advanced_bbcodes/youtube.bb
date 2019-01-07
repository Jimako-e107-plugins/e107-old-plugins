/*
+---------------------------------------------------------------+
|        Plugin: Advanced Bbcodes - Youtube
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

$modele = '|/watch?|';
if(preg_match($modele, $code_text)){
    $parse_str = parse_url($code_text);
    parse_str($parse_str['query']);
    $url_object = 'http://www.youtube.com/v/'.$v;
}else{
    $url_object = $code_text;
}


$bbcode_youtube = '<object width="425" height="350"><param name="movie" value="'.$url_object.'"></param><param name="wmode" value="transparent"></param><embed src="'.$url_object.'" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';

return $bbcode_youtube;