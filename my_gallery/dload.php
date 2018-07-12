<?php
$file = $_GET['file'];
$date_txt = date("y-m-d_H-i-s");
$text = "Content-Disposition: attachment; filename=".$_SERVER["SERVER_NAME"]."_e107_my_gallery_".$date_txt.".jpg";
header('Content-type: image/jpeg');
header($text);
readfile($file);
?>