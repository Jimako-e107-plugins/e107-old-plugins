<?php

require_once("../../class2.php");
require_once(HEADERF);
$text .='<center><OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab##version=5,0,0,0" WIDTH="640" HEIGHT="480">
					<PARAM NAME=movie VALUE="http://downloads.kewlbox.com/games_online/regalsolitaire/regalsolitaire.swf">
					<PARAM NAME=quality VALUE=high>
					<PARAM NAME=bgcolor VALUE=000000>
					<EMBED src="http://downloads.kewlbox.com/games_online/regalsolitaire/regalsolitaire.swf" quality=high bgcolor=000000 WIDTH=640 HEIGHT=480 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED>
					</OBJECT><br>
			Add this game to your website, <a href="http://www.kewlbox.com/games/code.cfm">click here.</a><br>
<br><br>Like this game? Download the full version.<br>
<a href="http://downloads2.kewlbox.com/games_pc/regalsolitaire.exe">PC Version</a><br>
		</center>';
$ns -> tablerender("Regal Solitaire", $text);
require_once(FOOTERF);
?>