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

$file = $_GET['file'];

header('Content-type: image/jpeg');
readfile($file);

?>