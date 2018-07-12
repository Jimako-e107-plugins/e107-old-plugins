<?php
/*
+ ----------------------------------------------------------------------------------------------+
|     e107 website system  : http://e107.org.ru
|     Released under the terms and conditions of the GNU General Public License (http://gnu.org).
|
|     Plugin "my_gallery"
|     Author: Alex ANP alex-anp@ya.ru
+-----------------------------------------------------------------------------------------------+
*/

// Menu Settings
$caption = $pref['mygallery_menu_caption'];   //give you gallery title/name
$maxwidth = $pref['mygallery_menu_img_size']; //change the width of your image here
$max_foto_w = $pref['mygallery_foto_view_width']; //Image preview size
$max_foto_h = $pref['mygallery_foto_view_height'];
$gallery = $pref['mygallery_folder'];     //Image folder path
$cikle = $pref['mygallery_mine_cikle'];

$text = "<!-- ######## Random Image ####### -->";

for ($i=1; $i<=$cikle; $i++)  { 

$dir_s = e_PLUGIN."my_gallery/$gallery";

$a = array();
if ($handle = opendir($dir_s)) 
{
  while (false !== ($file = readdir($handle)))
  {
   if ($file != "." && $file != ".." && $file != "index.php")  $a[] = $file;
  }
closedir($handle);
}
$count = sizeof($a);
$r = rand(0,$count-1);
$folder_a = $a[$r];

$dir_s .= "/$folder_a";
$a = array();
if ($handle = opendir($dir_s)) 
{
  while (false !== ($file = readdir($handle)))
  {
   if ($file != "." && $file != ".." && $file != "index.php")  $a[] = $file;
  }
closedir($handle);
}
$count = sizeof($a);
$r = rand(0,$count-1);
$folder_b = $a[$r];

$dir_s .= "/$folder_b";
$a = array();
if ($handle = opendir($dir_s)) 
{
  while (false !== ($file = readdir($handle)))
  {
   $str_tn = substr_count("$file", "tn_") + substr_count("$file", "tv_"); ;
	$str_type = substr_count("$file", ".jpg") + substr_count("$file", ".JPG") + substr_count("$file", ".jpeg") + substr_count("$file", ".JPEG");
	if (($str_type!="0")&&($str_tn!="1"))
	   {
	   $a[]=$file;
	   $test++;
       }
  }
closedir($handle);
}
$count = sizeof($a);
$r = rand(0,$count-1);
$file = $a[$r];

$img_file = e_PLUGIN."my_gallery/$gallery/$folder_a/$folder_b/$file";
$img_url = "$gallery/$folder_a/$folder_b/$file";

$info = getimagesize("$img_file");

$text .= "<div id=highslide-container ></div>
<div align=center >
<a id='thumb_$img_url' href='".e_PLUGIN."my_gallery/foto.php?img=$img_url&h=$max_foto_h&w=$max_foto_w' 
class='highslide' onclick='return hs.expand(this)'>
<img src='".e_PLUGIN."my_gallery/foto.php?img=$img_url&w=$maxwidth&h=$maxwidth'>
</a>
<div class='highslide-caption' id='caption-for-thumb_$img_url'>
<a href='".e_PLUGIN."my_gallery/my_gallery.php?gallery=$gallery/$folder_a/$folder_b'>$folder_a/$folder_b</a>
<br><a href='".e_PLUGIN."my_gallery/dload.php?file=$img_url'>".MYGAL_L022."</a> ".MYGAL_L026."$info[0]x$info[1]
</div>
</div>";
}

$ns -> tablerender($caption, $text);
?>