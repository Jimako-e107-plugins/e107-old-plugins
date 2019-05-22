<?php

require_once("../../class2.php");
require_once(HEADERF);
$text .='<center><OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab##version=5,0,0,0" WIDTH="700" HEIGHT="400">
					<PARAM NAME=movie VALUE="http://downloads2.kewlbox.com/games_online/minigolf/minigolf.swf">
					<PARAM NAME=quality VALUE=high>
					<PARAM NAME=bgcolor VALUE=000000>
					<EMBED src="http://downloads2.kewlbox.com/games_online/minigolf/minigolf.swf" quality=high bgcolor=000000 WIDTH=700 HEIGHT=400 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED>
					</OBJECT><br>
			Add this game to your website, <a href="http://www.kewlbox.com/games/code.cfm">click here.</a><br>
<br><br>Like this game? Download the full version.<br>
<a href="http://downloads2.kewlbox.com/games_pc/minigolf.exe">PC Version</a><br>
		</center>';
$ns -> tablerender("Mini Golf", $text);
require_once(FOOTERF);
?>