<?php

require_once("../../class2.php");
require_once(HEADERF);
$text .='<center>
					<script src="http://downloads.kewlbox.com/games_online/inx2.js" type="text/javascript"></script>
					<script src="http://downloads.kewlbox.com/games_online/flash_detect.vbs" type="text/vbscript"></script>
					<script src="http://downloads.kewlbox.com/games_online/flash_detect.js" type="text/javascript"></script>
				</center>';
$ns -> tablerender("INXS: Beat the Drum", $text);
require_once(FOOTERF);
?>