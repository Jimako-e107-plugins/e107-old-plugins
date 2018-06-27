<?php

require_once '../../class2.php';

global $tp;

# !!! Important note !!!
#
# Copy css content from sgal1.css to your style.css

//function headerjs()
//{
//	return (is_readable(THEME.'sgal1.css')
//			? '<link rel="stylesheet" type="text/css" href="'.THEME.'sgal1.css" />'
//			: '<link rel="stylesheet" type="text/css" href="'.e_PLUGIN.'sgallery/sgal1.css" />'
//	);
//}

if (!is_a($tp, 'e_parse'))		$tp = new e_parse();

parse_str(htmlspecialchars_decode(e_QUERY), $query);

if (!isset($query['e_ajax']))	require_once HEADERF;

	echo $tp->parseTemplate(isset($query['e_ajax']) ? '{SGAL}' : '{SGAL=category=1&pps=8&slideshow=5}');

if (!isset($query['e_ajax']))	require_once FOOTERF;

exit;