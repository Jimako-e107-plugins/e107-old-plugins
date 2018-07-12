$modele = '|/watch?|';
if(preg_match($modele, $code_text)){
    $parse_str = parse_url($code_text);
    parse_str($parse_str['query']);
    $url_object = 'http://www.youtube.com/v/'.$v;
}else{
    $url_object = $code_text;
}


$bbcode_eblog = '<object width="425" height="350"><param name="movie" value="'.$url_object.'"></param><param name="wmode" value="transparent"></param><embed src="'.$url_object.'" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';

return $bbcode_eblog;