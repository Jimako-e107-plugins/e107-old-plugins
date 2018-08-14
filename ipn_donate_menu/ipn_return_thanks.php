<?php
require_once("../../class2.php");
require_once(HEADERF);

$caption = "Thank you";
$text = "<p>Thanks for your kind donation</p>";

$caption = $tp->toHtml($caption);
$text = $tp->toHtml($text);

$ns -> tablerender($caption, $text);
require_once(FOOTERF);
?>