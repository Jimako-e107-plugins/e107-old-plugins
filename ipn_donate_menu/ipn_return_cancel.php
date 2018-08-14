<?php
require_once("../../class2.php");
require_once(HEADERF);

$caption = "Donation Canceled";
$text = "<p>Were sorry you decided not to donate, thanks for thinking about it anyway.</p>";

$caption = $tp->toHtml($caption);
$text = $tp->toHtml($text);

$ns -> tablerender($caption, $text);
require_once(FOOTERF);
?>