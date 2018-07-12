//USAGE [highslide]image link[/highslide]
global $pref, $e107;

$file_headers = @get_headers($code_text);
if($file_headers[0] == 'HTTP/1.1 404 Not Found') {

$text = "<img src='".e_PLUGIN."my_gallery/images/badimg.png'>";

} else {

$tn_scr = "foto.php";
if ($pref['mygallery_slide_show']) $tn_scr = "tn_foto.php";

$img_file = str_replace(SITEURL, '{e_BASE}',$code_text); //site link

$text = "<a id='thumb_$img_file' href='".e_PLUGIN."my_gallery/foto.php?img=".$code_text."&h=".$pref['mygallery_foto_view_height']."&w=".$pref['mygallery_foto_view_width']."' class='highslide' onclick=\"return hs.expand(this, { captionId: 'caption_$img_file' } )\"><img src='".e_PLUGIN."my_gallery/".$tn_scr."?img=".$code_text."&h=".$pref['mygallery_foto_icon_height']."&w=".$pref['mygallery_foto_icon_width']."' /></a><div class='highslide-caption' id='caption_$img_file'>".$tp->toHTML($code_text, true)."</div>";

}

return $text;