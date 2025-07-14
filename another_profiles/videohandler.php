<?php

if (!defined('e107_INIT')) { exit; }

function pic_url($video_site, $video_code) {
	if($video_site == "youtube") {
		$video_pic_url = "http://img.youtube.com/vi/".$video_code."/hqdefault.jpg";
		if(!fopen($video_pic_url, 'r')){
			$video_pic_url = "images/nopreview.png";
		}
		return $video_pic_url;
	}
	if($video_site == "vimeo") {
		$vimeo_url = "http://vimeo.com/".$video_code."";
		$vimeofile = fopen($vimeo_url, "r");
		$vimeofiledata = stream_get_contents($vimeofile);
		$vimeo_content = strpos($vimeofiledata,"<meta property=\"og:image\" content=\"");
		$vimeo_string = substr($vimeofiledata, $vimeo_content, 94);
		$vimeo_id_array = explode("\"", $vimeo_string);
		$video_pic_url = $vimeo_id_array[3];
		if(!fopen($video_pic_url, 'r')){
			$video_pic_url = "images/nopreview.png";
		}
		return $video_pic_url;
	}
	if($video_site == "indavideo") {
		$vimeo_url = "http://indavideo.hu/video/".$video_code."";
		$vimeofile = fopen($vimeo_url, "r");
		$vimeofiledata = stream_get_contents($vimeofile);
		$vimeo_content = strpos($vimeofiledata,"content=\"video\"");
		$vimeo_string = substr($vimeofiledata, $vimeo_content, 200);
		$vimeo_id_array = explode("\"", $vimeo_string);
		$vimeo_pic_url = $vimeo_id_array[5];
		if(!fopen($video_pic_url, 'r')){
			$video_pic_url = "images/nopreview.png";
		}
		return $video_pic_url;
	}
	if($video_site == "metacafe") {
		$vimeo_url = "http://www.metacafe.com/watch/".$video_code."";
		$video_pic_url = "http://s1.mcstatic.com/thumb/".$video_code.".jpg";
		if(!fopen($video_pic_url, 'r')){
			$video_pic_url = "images/nopreview.png";
		}
		return $video_pic_url;
	}
}

function vid_url($video_site, $video_code) {
	global $pref;
	$videowidth = $pref['profile_videowidth'];
	if($videowidth < 100 || $videowidth > 2000) {
		$videowidth = 640;
	}
	$videoheight = intval($videowidth * 0.6);
	if($video_site == "youtube") {
		$vid_embed_code .= "
		<object width='".$videowidth."' height='".$videoheight."'>
			<embed src='http://www.youtube.com/v/".$video_code."?fs=1&amp;hl=hu_HU&amp;rel=0&amp;showinfo=0&amp;disablekb=1&amp;modestbranding=1&amp;controls=1&amp;autohide=1' type='application/x-shockwave-flash' allowNetworking='internal' allowfullscreen='true' allowscriptaccess='never' width='".$videowidth."' height='".$videoheight."'></embed>
		</object>";
		return $vid_embed_code;
	}
	if($video_site == "vimeo") {
		$vimeo_url = "http://vimeo.com/".$video_code."";
		$vimeofile = fopen($vimeo_url, "r");
		$vimeofiledata = stream_get_contents($vimeofile);
		$vimeo_content = strpos($vimeofiledata,"type=\"application/x-shockwave-flash\" width=\"");
		$vimeo_string = substr($vimeofiledata, $vimeo_content, 84);
		$vimeo_width_array = explode("\"", $vimeo_string);
		$vimeo_width_string = intval($vimeo_width_array[3]);
		$vimeo_height_string = intval($vimeo_width_array[5]);
		$vid_embed_code .= "
		<object width='".$videowidth."' height='".$videoheight."'>
			<iframe src='http://player.vimeo.com/video/".$video_code."' width='".$videowidth."' height='".$videoheight."'></iframe>
		</object>";
		return $vid_embed_code;
	}
	if($video_site == "indavideo") {
		$vimeo_url = "http://indavideo.hu/video/".$video_code."";
		$vimeofile = fopen($vimeo_url, "r");
		$vimeofiledata = stream_get_contents($vimeofile);
		$vimeo_content = strpos($vimeofiledata,"http://files.indavideo.hu/player/gup.swf?vID=");
		$vimeo_string = substr($vimeofiledata, $vimeo_content, 55);
		$vimeo_content1 = strpos($vimeofiledata,"<meta name=\"video_height\"");
		$vimeo_width_string = substr($vimeofiledata, $vimeo_content1, 150);
		$vimeo_width_array = explode("\"", $vimeo_width_string);
		$vimeo_width_string = intval($vimeo_width_array[7]);
		$vimeo_height_string = intval($vimeo_width_array[3]);
		$vid_embed_code .= "
		<object width='".$videowidth."' height='".$videoheight."'>
			<embed src='$vimeo_string' width='".$videowidth."' height='".$videoheight."'></embed>
		</object>";
		return $vid_embed_code;
	}
	if($video_site == "metacafe") {
		$vimeo_url = "http://www.metacafe.com/watch/".$video_code."";
		$vimeofile = fopen($vimeo_url, "r");
		$vimeofiledata = stream_get_contents($vimeofile);
		$vimeo_content = strpos($vimeofiledata,"<link rel=\"video_src\" href=\"http://www.metacafe.com/fplayer/");
		$vimeo_string = substr($vimeofiledata, $vimeo_content, 150);
		$vimeo_id_array = explode("\"", $vimeo_string);
		$video_code = $vimeo_id_array[3];
		$vimeo_content1 = strpos($vimeofiledata,"<meta name=\"video_height\"");
		$vimeo_width_string = substr($vimeofiledata, $vimeo_content1, 150);
		$vimeo_width_array = explode("\"", $vimeo_width_string);
		$vimeo_width_string = intval($vimeo_width_array[7]);
		$vimeo_height_string = intval($vimeo_width_array[3]);
//		$video_size = vid_size($vimeo_width_string,$vimeo_height_string);
		$vid_embed_code .= "
		<object width='".$videowidth."' height='".$videoheight."'>
			<embed src='".$video_code."' type='application/x-shockwave-flash' width='".$videowidth."' height='".$videoheight."'></embed>
		</object>";
		return $vid_embed_code;
	}
}

/*
function vid_size($video_site, $video_code) {

}
*/
?>